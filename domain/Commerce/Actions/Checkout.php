<?php
namespace Domain\Commerce\Actions;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class Checkout extends Controller
{
    public function __construct()
    {

    }

    public function __invoke(): Response
    {
        return Inertia::render('Commerce/Views/Checkout');
    }

}
