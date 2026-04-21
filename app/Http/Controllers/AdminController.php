<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repository\ProductRepository;
use Inertia\Inertia;

class AdminController extends Controller
{

    public function __construct(private readonly ProductRepository $repository)
    {

    }
    public function products()
    {
        return Inertia::render('Admin/Product/Index', [
            'ok' => true,
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Product/Create', [
            'ok' => true,
        ]);
    }
    public function edit(int $id)
    {
        $product = Product::withTrashed()->find($id);
        return Inertia::render('Admin/Product/Edit', [
            'product' => $this->repository->ProductToArray($product),
        ]);
    }

    public function show(int $id)
    {
        $product = Product::withTrashed()->find($id);
        return Inertia::render('Admin/Product/Show', [
            'product' => $this->repository->ProductToArray($product),
        ]);

    }
}
