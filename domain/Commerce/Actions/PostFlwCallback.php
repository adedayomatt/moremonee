<?php
namespace Domain\Commerce\Actions;

use App\Http\Controllers\Controller;
use Domain\Commerce\Models\Transaction;
use Illuminate\Http\Request;

class PostFlwCallback extends Controller
{

    public function __invoke(Request $request)
    {
        $transaction = Transaction::where(["reference" => $request->data['txRef']])->firstOrFail();
        return redirect()->back()->with("transaction", [
            "action_required" => "verify_transaction",
            "transaction" => $transaction
        ]);
    }

}
