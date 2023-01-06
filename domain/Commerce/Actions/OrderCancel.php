<?php
namespace Domain\Commerce\Actions;

use App\Http\Controllers\Controller;
use Domain\Commerce\Constants\Constants;
use Domain\Commerce\Models\Order;
use Illuminate\Http\Request;

class OrderCancel extends Controller
{

    public function __invoke(Request $request, $reference)
    {
        $order = Order::where("reference", $reference)->firstOrFail();
        $order->update([
            "status" => Constants::STATUS_CANCELLED
        ]);
        return redirect()->route("order.view", [$reference])->with("toast", [
            "type" => "success",
            "message" => "Order $reference cancelled"
        ]);
    }

}
