<?php
namespace Domain\Commerce\Actions;

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
               return redirect()->back()->with("transaction", [
                   "action_required" => "verify_transaction",
                   "transaction" => $transaction
               ]);
           } ;
            return redirect()->back()->with("toast", [
                "type" => "error",
                "message" => $charge->data->processor_response
            ]);
        }
        return redirect()->back()->with("toast", [
            "type" => "error",
            "message" => "Otp validation failed"
        ]);
    }



}
