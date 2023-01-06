<?php
namespace Domain\Commerce\Actions;

use App\Http\Controllers\Controller;
use Domain\Commerce\Models\Order;
use Domain\Commerce\Models\Product;
use Domain\Commerce\Requests\OrderRequest;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class OrderCreate extends Controller
{
    public function __construct()
    {

    }

    public function __invoke(OrderRequest $request)
    {
        session()->flash('previous-route', Route::current()->getName());
        $order = $this->createOrder($request);
        foreach ($request->items as $item) {
            $product = Product::find($item["product_id"]);
            $order->orderItems()->create([
                "product_id" => $product->id,
                "reference" => $order->reference."-".$product->id,
                "quantity" => $item["quantity"],
                "amount" => $product->price,
                "currency" => $product->currency,
            ]);
        }

        return redirect(null, 304)->route('order.pay.view', [ $order->reference ]);
    }

    /**
     * @param OrderRequest $request
     * @return mixed
     */
    public function createOrder(OrderRequest $request) {
        return Order::create([
            "reference" => Order::generateOrderRef(),
            "email" => $request->billing['email'],
            "billing" => $request->billing,
            "shipping" => $request->shipping,
        ]);
    }

}
