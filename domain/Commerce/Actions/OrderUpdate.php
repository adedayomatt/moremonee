<?php
namespace Domain\Commerce\Actions;

use App\Http\Controllers\Controller;
use Domain\Commerce\Models\Order;
use Domain\Commerce\Requests\OrderRequest;

class OrderUpdate extends Controller
{
    public function __invoke(OrderRequest $request, $reference)
    {
        $order = Order::where("reference", $reference)->firstOrFail();
        $order->update($request->all());
        return redirect(null, 304)->route('order.pay.view', [ $order->reference ]);
    }

}
