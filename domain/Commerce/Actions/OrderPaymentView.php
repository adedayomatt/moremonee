<?php
namespace Domain\Commerce\Actions;

use App\Classes\Utils;
use App\Http\Controllers\Controller;
use Domain\Commerce\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class OrderPaymentView extends Controller
{
    public function __invoke(Request $request, $reference): Response
    {
        $order = Order::with("orderItems")->where(['reference' => $reference])
            ->firstOrFail();
        $request->session()->reflash();
        return Inertia::render('Commerce/Views/Checkout/Payment', compact('order'));
    }

}
