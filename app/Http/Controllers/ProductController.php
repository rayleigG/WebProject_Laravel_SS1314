<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('active', 1)
            ->orderBy('orderNum')
            ->paginate(5);
        return view('admin.product', compact('products'));
    }
}
