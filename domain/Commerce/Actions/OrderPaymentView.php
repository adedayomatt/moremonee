<?php
namespace Domain\Commerce\Actions;

use App\Http\Controllers\Controller;
use Domain\Commerce\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class OrderPaymentView extends Controller
{
    public function __invoke(Request $request, $reference): Response
    {
        $request->session()->reflash();
        $order = Order::with("orderItems")->where(['reference' => $reference])
            ->firstOrFail();
        return Inertia::render('Commerce/Views/Checkout/Payment', compact('order'));
    }

}
