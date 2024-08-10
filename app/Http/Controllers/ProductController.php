<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('product.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('product.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'reorder_qty' => 'required',
            'refrigerated' => 'required',
        ],
        [
            'name.required' => 'Please enter product name.',
            'code.required' => 'Please enter product code.',
            'description.required' => 'Please enter product description.',
            'category_id.required' => 'Please select category.',
            'reorder_qty.required' => 'Please enter reorder qty.',
            'refrigerated.required' => 'Please enter refrigerated.',
        ]);     
        Product::create($request->except('__token'));
        return redirect()->route('product.index')->with('success', 'Product added successfully.'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('product.view', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        return view('product.edit', ['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'reorder_qty' => 'required',
            'refrigerated' => 'required',
        ],
        [
            'name.required' => 'Please enter product name.',
            'code.required' => 'Please enter product code.',
            'description.required' => 'Please enter product description.',
            'category_id.required' => 'Please select category.',
            'reorder_qty.required' => 'Please enter reorder qty.',
            'refrigerated.required' => 'Please enter refrigerated.',
        ]); 
        $product->update($request->except('__token'));
        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    }
}
