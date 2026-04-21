<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Repository\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(private readonly ProductRepository $repository){}
    public function index(Request $request)
    {
        \Log::info(json_encode($request->all()));
        $page = $request->input('page', 1);
        $category_id = $request->input('category_id');
        $productData = $this->repository->getAllProducts($page, $category_id);
        return response()->json($productData);
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());
        return response()->json($this->repository->ProductToArray($product), 201);
    }

    public function show(Product $product)
    {
        return response()->json($this->repository->ProductToArray($product));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        return response()->json(['ok' => true]);
    }

    public function destroy(Product $product)
    {
        if ($product->trashed()) {
            $product->forceDelete();
        } else {
            $product->delete();
        }

        return response()->json(['ok' => true]);
    }
}
