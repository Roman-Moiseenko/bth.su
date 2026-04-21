<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repository\CategoryRepository;


class CategoryController extends Controller
{
    public function __construct(private readonly CategoryRepository $repository)
    {
    }

    public function index()
    {
        return response()->json($this->repository->getAll());
    }

}
