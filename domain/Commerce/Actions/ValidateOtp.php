<?php
namespace Domain\Commerce\Actions;

use App\Classes\Utils;
use App\Http\Controllers\Controller;
use Domain\Commerce\Constants\Constants;
use Domain\Commerce\Models\Transaction;
use Domain\Commerce\Services\Flutterwave;
use Illuminate\Http\Request;

class ValidateOtp extends Controller
{

    public function __invoke(Request $request, $reference)
    {
        $transaction = Transaction::where("reference", $reference)->firstOrFail();
        $this->validate($request, [
            "otp" => ["required"]
        ]);
        $charge = Flutterwave::OtpValidation($reference, [
            "otp" => $request->otp,
            "flw_ref" => $transaction->provider_reference,
            "type" => "card"
        ]);
        if($charge && $charge->status == Constants::STATUS_SUCCESS) {
           if($charge->data->status === Constants::STATUS_SUCCESSFUL) {
               Utils::saveMemory($transaction->order->reference, [
                   "action_required" => Constants::ACTION_VERIFY_TRANSACTION,
                   "transaction" => $transaction
               ]);
               return redirect()->back()->with("transaction", Utils::getMemory($transaction->order->reference));
           }
            return redirect()->back()->with("toast", [
                "type" => "error",
                "message" => $charge->data->processor_response
            ]);
        }
        return redirect()->back()->with("toast", [
            "type" => "error",
            "message" => "Transaction failed. ".($charge && $charge->message ? $charge->message : "")
        ]);
    }

}
