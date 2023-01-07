<?php
namespace Domain\Commerce\Actions;

use App\Http\Controllers\Controller;
use Domain\Commerce\Constants\Constants;
use Domain\Commerce\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProductList extends Controller
{
    public function __invoke(Request $request, $currency = null): Response
    {
        $currency = $currency && in_array($currency, config('business.currencies')) && config('business.enable_multiple_currency')
                ? $currency
                : config('business.currency');

        $this->setTempUser(["currency" => $currency]);
        $products = Product::where([
            "status" => Constants::STATUS_ENABLED,
            "currency" => $currency
        ])->latest()->paginate();
        return Inertia::render('Commerce/Views/ProductList', compact('products'));
    }

}
