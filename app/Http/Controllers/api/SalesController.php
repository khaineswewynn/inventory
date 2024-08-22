<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $sales = Sales::with('customer', 'salesDetails.product')->paginate(10);

        return response()->json($sales);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
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
        ]);

        $sale = DB::transaction(function () use ($validatedData) {
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

            return $sale;
        });

        return response()->json(['message' => 'Sale created successfully.', 'sale' => $sale], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $sale = Sales::with('customer', 'salesDetails.product')->findOrFail($id);

        return response()->json($sale);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
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
        ]);

        $sale = DB::transaction(function () use ($validatedData, $id) {
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

            return $sale;
        });

        return response()->json(['message' => 'Sale updated successfully.', 'sale' => $sale]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
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

        return response()->json(['message' => 'Sale deleted successfully.']);
    }
}
