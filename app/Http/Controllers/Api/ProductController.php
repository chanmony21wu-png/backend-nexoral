<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    // the React shop reads the products here
    public function index()
    {
        return Product::orderBy('id')->get()->map(fn (Product $p) => $p->toApi())->values();
    }
}