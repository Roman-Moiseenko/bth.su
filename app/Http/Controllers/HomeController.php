<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        //TODO Фильтр по пагинации и категории

        return Inertia::render('Home', [
            'products' => Product::all(), //для теста
        ]);
    }
}
