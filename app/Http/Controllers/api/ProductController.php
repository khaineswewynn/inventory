<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return Product::all();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:200',
        ]);
        $products = Product::create($validatedData);

        return response()->json($products, 201);
    }

    public function show($id)
    {
        return Product::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:200',
        ]);

        $products = Product::findOrFail($id);
        $products->update($validatedData);

        return response()->json($products, 200);
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return response()->json(null, 204);
    }
}
