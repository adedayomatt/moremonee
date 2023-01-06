<?php
namespace Domain\Commerce\Actions;

use App\Http\Controllers\Controller;
use Domain\Commerce\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class OrderList extends Controller
{

    public function __invoke(Request $request, $email = null)
    {
        if(!$email) {
            return redirect()->back()->with("toast", [
                "type" => "error",
                "message" => "Please provide your email address"
            ]);
        }
        $tempUser = $this->setTempUser((object) ['email' => $email]);
        $orders = Order::where(["email" => $tempUser->email])->latest()->paginate();
        return Inertia::render('Commerce/Views/OrderList', compact('orders'));
    }

}
