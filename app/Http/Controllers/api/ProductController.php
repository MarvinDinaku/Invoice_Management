<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json(['products' => $products], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('products')],
            'price' => ['required', 'numeric', 'min:0'],
        ]);

        $product = Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
        ]);

        return response()->json(['product' => $product], 201);
    }

    public function show(Product $product)
    {
        return response()->json(['product' => $product], 200);
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => ['string', 'max:255', Rule::unique('products')->ignore($product->id)],
            'price' => ['numeric', 'min:0'],
        ]);

        $product->update($request->only('name', 'price'));

        return response()->json(['product' => $product], 200);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(['message' => 'Product deleted'], 200);
    }
}

