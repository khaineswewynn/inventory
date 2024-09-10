<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Provider;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderDetails;
use Illuminate\Http\Request;
use PDF;

class PurchaseController extends Controller
{
    public function __construct(){
        $this->middleware('permission:purchase-index|purchase-create|purchase-edit|
        purchase-show|purchase-delete',['only'=>['index']]);//index is function

        $this->middleware('permission:purchase-create',['only'=>['create','store']]);

        $this->middleware('permission:purchase-edit',['only'=>['edit','update']]);

        $this->middleware('permission:purchase-show',['only'=>['show']]);

        $this->middleware('permission:purchase-delete',['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchaseOrders = PurchaseOrder::all();
        return view('purchase.index', ['purchaseOrders'=>$purchaseOrders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $providers = Provider::all();
        $products = Product::all();
        return view('purchase.create', ['providers'=>$providers, 'products'=>$products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $purchaseOrder = new PurchaseOrder();
        $purchaseOrder->order_no = 'ORD-' . rand(100000, 999999);
        $purchaseOrder->purchaseorder_date = $request->input('purchaseorder_date');
        $purchaseOrder->provider_id = $request->input('provider_id');
        $purchaseOrder->save(); // Save the PurchaseOrder model first

        $total = 0;
        foreach ($request->input('product_id') as $key => $productId) {
            $productQty = $request->input('qty')[$key];
            $productPrice = $request->input('price')[$key];

            $purchaseOrderDetail = new PurchaseOrderDetails();
            $purchaseOrderDetail->purchase_order_id = $purchaseOrder->id; // Use the saved PurchaseOrder id
            $purchaseOrderDetail->product_id = $productId;
            $purchaseOrderDetail->qty = $productQty;
            $purchaseOrderDetail->price = $productPrice;
            $purchaseOrderDetail->save();

            $total += $productQty * $productPrice;
        }

        $purchaseOrder->total = $total;
        $purchaseOrder->save(); // Update the total of the PurchaseOrder model

        return redirect()->route('purchase.index')->with('createsuccess', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchaseorder = PurchaseOrder::find($id);
        $providers = Provider::all();
        $purchasedetails = PurchaseOrderDetails::where('purchase_order_id', $id)->get();;
        $products = Product::all();
        $id = $purchaseorder->order_id;
        return view('purchase.view', ['providers'=>$providers, 'purchaseDetails'=>$purchasedetails,
                     'products'=>$products, 'purchaseOrder'=>$purchaseorder,'id'=>$id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchaseOrder = PurchaseOrder::find($id);
        $purchaseDetails = PurchaseOrderDetails::where('purchase_order_id', $id)->get();
        $providers = Provider::all();
        $products = Product::all();
        return view('purchase.edit', ['purchaseOrder' => $purchaseOrder, 'purchaseDetails' =>$purchaseDetails, 'providers'=>$providers, 'products'=>$products]);
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
    $purchaseOrder = PurchaseOrder::find($id);

    $purchaseOrder->purchaseorder_date = $request->input('purchaseorder_date');
    $purchaseOrder->provider_id = $request->input('provider_id');
    $purchaseOrder->save(); // Update the PurchaseOrder model

    // Delete existing purchase order details
    PurchaseOrderDetails::where('purchase_order_id', $id)->delete();

    $total = 0;
    foreach ($request->input('product_id') as $key => $productId) {
        $productQty = $request->input('qty')[$key];
        $productPrice = $request->input('price')[$key];

        $purchaseOrderDetail = new PurchaseOrderDetails();
        $purchaseOrderDetail->purchase_order_id = $purchaseOrder->id;
        $purchaseOrderDetail->product_id = $productId;
        $purchaseOrderDetail->qty = $productQty;
        $purchaseOrderDetail->price = $productPrice;
        $purchaseOrderDetail->save();

        $total += $productQty * $productPrice;
    }

    $purchaseOrder->total = $total;
    $purchaseOrder->save(); // Update the total of the PurchaseOrder model

    return redirect()->route('purchase.index')->with('editsuccess', 'Purchase Order edited successfully.');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $purchaseOrder = PurchaseOrder::find($id);
        PurchaseOrderDetails::where('purchase_order_id', $id)->delete();
        $purchaseOrder->delete();
    
        return redirect()->route('purchase.index')->with('deletesuccess', 'Purchase Order deleted successfully.');
    }

    public function download($id)
    {
        $purchaseOrder = PurchaseOrder::find($id);
        if (!$purchaseOrder) {
            abort(404, 'Purchase order not found');
        }

        $purchaseDetails = PurchaseOrderDetails::where('purchase_order_id', $id)->get();
        $providers = Provider::all();
        $products = Product::all();

        $pdf = PDF::loadView('purchase.download', [
            'providers' => $providers,
            'purchaseDetails' => $purchaseDetails,
            'products' => $products,
            'purchaseOrder' => $purchaseOrder
        ]);

        return $pdf->download('invoice-' . $purchaseOrder->order_no . '.pdf');
    }
}
