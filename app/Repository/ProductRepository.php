<?php

namespace App\Repository;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductRepository
{

    public function getAllProducts(int $page, int|null $categoryId = null)
    {
        $query = Product::orderBy('created_at', 'desc')->withTrashed();
        if (!is_null($categoryId)) {
            $query->where('category_id', $categoryId);
        }

        return $query->paginate(perPage: 10, page: $page)
            ->withQueryString()
            ->through(fn(Product $product) => $this->ProductToArray($product));
    }

    public function ProductToArray(Product $product): array
    {
        return [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'description' => $product->description,
            'category' => $product->category->name,
            'trashed' => $product->trashed(),
        ];
    }
}
