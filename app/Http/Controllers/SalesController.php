<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sales;
use App\Models\SalesDetails;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sales::with('customer', 'salesDetails.product')->paginate(10);

        return view('sale.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        $customers = Customer::all();
        return view('sale.create_sales', ['products' => $products, 'customers' => $customers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'number' => 'required|string|max:255',
            'cus_id' => 'required|integer|exists:customers,id',
            'email' => 'required|email',
            'phone' => 'required|string|max:255',
            'products' => 'required|array',
            'products.*.product_id' => 'required|integer|exists:products,id',
            'products.*.price' => 'required|numeric',
            'products.*.qty' => 'required|integer|min:1',
            'products.*.total' => 'required|numeric',
        ], [
            'number.required' => 'The order number is required.',
            'cus_id.required' => 'The customer ID is required.',
            'cus_id.exists' => 'The selected customer does not exist.',
            'email.required' => 'The customer email is required.',
            'email.email' => 'The email must be a valid email address.',
            'phone.required' => 'The customer phone is required.',
            'products.required' => 'At least one product is required.',
            'products.array' => 'The products field must be an array.',
            'products.*.product_id.required' => 'Each product must have a valid product ID.',
            'products.*.product_id.exists' => 'The selected product does not exist.',
            'products.*.price.required' => 'The price for each product is required.',
            'products.*.qty.required' => 'The quantity for each product is required.',
            'products.*.qty.min' => 'The quantity must be at least 1.',
            'products.*.total.required' => 'The total for each product is required.',
        ]);

        DB::transaction(function () use ($validatedData) {
            $sale = Sales::create([
                'date' => Carbon::today()->toDateString(),
                'number' => $validatedData['number'],
                'cus_id' => $validatedData['cus_id'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
            ]);

            foreach ($validatedData['products'] as $product) {
                SalesDetails::create([
                    'sales_id' => $sale->id,
                    'product_id' => $product['product_id'],
                    'price' => $product['price'],
                    'qty' => $product['qty'],
                    'total' => $product['total'],
                ]);
            }
        });

        return redirect()->route('sale.index')->with('success', 'Sale created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sale = Sales::with('customer', 'salesDetails.product')->findOrFail($id);

        return view('sale.show', compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sale = Sales::with('salesDetails')->findOrFail($id);
        $customers = Customer::all();
        $products = Product::all();

        return view('sale.edit', compact('sale', 'customers', 'products'));
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
        $validatedData = $request->validate([
            'number' => 'required|string|max:255',
            'cus_id' => 'required|integer|exists:customers,id',
            'email' => 'required|email',
            'phone' => 'required|string|max:255',
            'products' => 'required|array',
            'products.*.product_id' => 'required|integer|exists:products,id',
            'products.*.price' => 'required|numeric',
            'products.*.qty' => 'required|integer|min:1',
            'products.*.total' => 'required|numeric',
        ], [
            'number.required' => 'The order number is required.',
            'cus_id.required' => 'The customer ID is required.',
            'cus_id.exists' => 'The selected customer does not exist.',
            'email.required' => 'The customer email is required.',
            'email.email' => 'The email must be a valid email address.',
            'phone.required' => 'The customer phone is required.',
            'products.required' => 'At least one product is required.',
            'products.array' => 'The products field must be an array.',
            'products.*.product_id.required' => 'Each product must have a valid product ID.',
            'products.*.product_id.exists' => 'The selected product does not exist.',
            'products.*.price.required' => 'The price for each product is required.',
            'products.*.qty.required' => 'The quantity for each product is required.',
            'products.*.qty.min' => 'The quantity must be at least 1.',
            'products.*.total.required' => 'The total for each product is required.',
        ]);

        DB::transaction(function () use ($validatedData, $id) {
            $sale = Sales::findOrFail($id);
            $sale->update([
                'number' => $validatedData['number'],
                'cus_id' => $validatedData['cus_id'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
            ]);

            SalesDetails::where('sales_id', $sale->id)->delete();

            foreach ($validatedData['products'] as $product) {
                SalesDetails::create([
                    'sales_id' => $sale->id,
                    'product_id' => $product['product_id'],
                    'price' => $product['price'],
                    'qty' => $product['qty'],
                    'total' => $product['total'],
                ]);
            }
        });

        return redirect()->route('sale.index')->with('success', 'Sale updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $sale = Sales::with('salesDetails')->findOrFail($id);

            foreach ($sale->salesDetails as $detail) {
                $detail->delete();
            }

            $sale->delete();
        });

        return redirect()->route('sale.index')->with('success', 'Sale order deleted successfully.');
    }
}