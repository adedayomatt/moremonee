<?php


namespace Tests\Feature;


use App\User;
use Domain\Customers\Models\Customer;
use Domain\SavingsAccount\Models\SavingsAccount;
use Domain\Transactions\Contracts\NubanInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProvidusTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    public function test_can_create_nuban_account(): void
    {
        $data = app(NubanInterface::class)->createAccount([
            'account_name' => $this->faker->name,
            'bvn' => $bvn = random_int(11111111111, 99999999999),
        ]);

        self::assertEquals($data['bvn'], $bvn);
        self::assertNotNull($data['account_name']);
        self::assertNotNull($data['account_number']);
    }

    public function test_settlement_hook_success()
    {
        /** @var User $user */
        $user = User::query()->create($userdata = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'bvn' => $bvn = random_int(11111111111, 99999999999),
        ]);
        $accountOfficer = User::query()->create([
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
        ]);
        /** @var Customer $customer */
        $customer = $user->customer()->create($userdata);
        /** @var SavingsAccount $account */
        $account = $customer->savingsAccount()->create([
            'saving_product_id' => \Str::uuid(),
            'customer_id' => \Str::uuid(),
            'account_officer_id' => $accountOfficer->getKey(),
            'account_name' => 9977581536,
            'account_number' => 9977581536,
        ]);
//        $account->nuban()->create([
//            'account_name' => 9977581536,
//            'account_number' => 9977581536,
//            'bvn' => $bvn,
//        ]);

        $response = $this
            ->withHeader('X-Auth-Signature', 'BE09BEE831CF262226B426E39BD1092AF84DC63076D4174FAC78A2261F9A3D6E59744983B8326B69CDF2963FE314DFC89635CFA37A40596508DD6EAAB09402C7')
            ->post('settlement_notif', [
                "sessionId" => "0000042103011805345648005069266636442357859508",
                "accountNumber" => "9977581536",
                "tranRemarks" => "FROM UBA/ CASAFINA CREDIT-EASY LOAN-NIP/SEYI OLUFEMI/CASAFINA CAP/0000042103015656180548005069266636",
                "transactionAmount" => "1",
                "settledAmount" => "1",
                "feeAmount" => "0",
                "vatAmount" => "0",
                "currency" => "NGN",
                "initiationTranRef" => "",
                "settlementId" => "202210301006807600001432",
                "sourceAccountNumber" => "2093566866",
                "sourceAccountName" => "CASAFINA CREDIT-EASY LOAN",
                "sourceBankName" => "UNITED BANK FOR AFRICA",
                "channelId" => "1",
                "tranDateTime" => "2021-03-01 18:06:20"
            ]);

        $response->assertJson(['responseCode' => '00']);
    }
}
