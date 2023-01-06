<?php
namespace Domain\Commerce\Actions;

use App\Http\Controllers\Controller;
use Domain\Commerce\Constants\Constants;
use Domain\Commerce\Models\Order;
use Domain\Commerce\Models\Transaction;
use Domain\Commerce\Services\Flutterwave;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class OrderPayment extends Controller
{

    public function __invoke(Request $request, $reference)
    {
        $order = Order::where("reference", $reference)->firstOrFail();
        $this->validate($request, [
            "name_on_card" => ["required"],
            "card_number" => ["required"],
            "expiry" => ["required", "regex:/^(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})$/"],
            "cvv" => ["required", "regex:/[0-9]{3}/"]
        ]);

        $charge = Flutterwave::createCharge([
               "card_number" => $request->card_number,
               "cvv" => $request->cvv,
               "expiry_month" => explode("/", $request->expiry)[0],
               "expiry_year" => explode("/", $request->expiry)[1],
               "currency" => $order->currency,
               "amount" => $order->totalAmount,
               "fullname" => $order->billing->first_name." ".$order->billing->last_name,
               "email" => $order->email,
               "tx_ref" => Flutterwave::generateTxRef(),
               "redirect_url" => route("get.flw.callback"),
               "authorization" => [
                   "city" => $order->billing->address->city->name,
                   "address" => $order->billing->address->address,
                   "state" => $order->billing->address->state->isoCode,
                   "country" => $order->billing->address->country->isoCode,
                   "zipcode" => $order->billing->address->zipcode
                ]
        ]);

        if($charge && $charge->status == Constants::STATUS_SUCCESS && property_exists($charge, "data")) {
            $transaction = $order->transactions()->create([
                "amount" => $charge->data->amount,
                "reference" => $charge->data->tx_ref,
                "provider" => Flutterwave::SERVICE_NAME,
                "provider_reference" => $charge->data->flw_ref,
                "status" => $charge->data->status,
                "currency" => $charge->data->currency,
                "metadata" => [
                    "chargeId" => $charge->data->id,
                    "card" => $charge->data->card,
                    "customer" => $charge->data->customer
                ]
            ]);

            switch ($charge->meta->authorization->mode) {
                case Flutterwave::AUTH_OTP:
                    return redirect()->back()->with("transaction", [
                        "action_required" => "otp",
                        "message" => $charge->data->processor_response,
                        "transaction" => $transaction
                    ]);
                case Flutterwave::AUTH_REDIRECT:
                    return redirect()->back()->with("transaction", [
                        "action_required" => "redirect",
                        "redirect" => $charge->meta->authorization->redirect,
                        "transaction" => $transaction
                    ]);
            }
        }
        return redirect()->route("checkout.view")->with("toast", [
            "type" => "error",
            "message" => "Payment could not be completed. ".($charge && $charge->message ? $charge->message : "")
        ]);
    }

}
