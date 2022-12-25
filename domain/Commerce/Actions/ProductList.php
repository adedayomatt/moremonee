<?php
namespace Domain\Commerce\Actions;

use App\Http\Controllers\Controller;
use Domain\Commerce\Models\Product;
use Inertia\Inertia;
use Inertia\Response;

class ProductList extends Controller
{
    public function __construct()
    {

    }

    public function __invoke(Product $model): Response
    {
        $products = $model
        ->where('status', 'enabled')->latest()->paginate();
        return Inertia::render('Commerce/Views/ProductList', compact('products'));
    }

}
