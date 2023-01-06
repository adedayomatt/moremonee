<?php
namespace Domain\Commerce\Actions;

use App\Http\Controllers\Controller;
use Domain\Commerce\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class Checkout extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            "email" => ["required", "email"]
        ]);
        $this->setTempUser();
        return redirect()->route("checkout.view");
    }
}
