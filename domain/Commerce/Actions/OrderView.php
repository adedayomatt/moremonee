<?php
namespace Domain\Commerce\Actions;

use App\Http\Controllers\Controller;
use Domain\Commerce\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class OrderView extends Controller
{
    public function __invoke(Request $request, $reference): Response
    {
        $order = Order::with(["orderItems.product", "transactions"])->where(['reference' => $reference])
            ->firstOrFail();
        return Inertia::render('Commerce/Views/Order', compact('order'));
    }

}
