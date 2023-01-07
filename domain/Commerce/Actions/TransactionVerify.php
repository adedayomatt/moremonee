<?php
namespace Domain\Commerce\Actions;

use App\Http\Controllers\Controller;
use Domain\Commerce\Constants\Constants;
use Domain\Commerce\Models\ExternalServiceRequest;
use Domain\Commerce\Models\Order;
use Domain\Commerce\Models\Transaction;
use Domain\Commerce\Services\Flutterwave;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TransactionVerify extends Controller
{

    public function __invoke(Request $request, $reference)
    {
        $transaction = Transaction::where("reference", $reference)->firstOrFail();
        $charge = Flutterwave::verifyCharge($transaction->reference, $transaction->metadata->chargeId);
        if($charge && $charge->status == Constants::STATUS_SUCCESS && $charge->data->status == Constants::STATUS_SUCCESSFUL) {
            $transaction->update([ "status" => Constants::STATUS_SUCCESS ]);
            $transaction->order->complete();
            return redirect()->route("order.view", [$transaction->order->reference])
                ->with("transaction", [
                    "action_required" => Constants::ACTION_CLEAR_CART
                ])
                ->with("toast", [
                    "type" => "success",
                    "message" => "Order completed"
                ]);
        }
        $transaction->update([
            "status" => Constants::STATUS_FAILED
        ]);
        $transaction->order->update([
            "status" => Constants::STATUS_FAILED
        ]);
        return redirect()->back()
            ->with("transaction", [
                "action_required" => Constants::ACTION_REQUERY_TRANSACTION,
                "message" => "Transaction failed, please try again" ,
                "transaction" => $transaction
            ])
            ->with("toast", [
                "type" => "error",
                "message" => "Payment could not be verified"
            ]);
    }

}
