<?php
namespace Domain\Commerce\Actions;

use App\Http\Controllers\Controller;
use Domain\Commerce\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Inertia\Inertia;

class CheckoutView extends Controller
{
    public function __invoke()
    {
        $tempUser = $this->getTempUser();
        $lastOrder = null;
        /**
         * Prevent repopulating with last orderDetails if coming from create order
         */
        if(!empty($tempUser["email"]) && !$this->isComingFromOrderCreate()) {
            $lastOrder = Order::where([ "email" => $tempUser["email"] ])->latest()->first();
        }
        return Inertia::render('Commerce/Views/Checkout/Index', compact("lastOrder"));
    }

    public function isComingFromOrderCreate() {
        return session()->get("previous-route") == "order.create";
    }
}
