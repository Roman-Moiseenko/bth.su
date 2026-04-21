<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        return Inertia::render('Home', [
            'home' => true,
        ]);
    }

    public function product(int $id) {
        $product = Product::withTrashed()->find($id);
        return Inertia::render('Product', [
           'product' => $product,
        ]);
    }

}
