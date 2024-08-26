<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseDetails;
use App\Models\SalesDetails;
use App\Models\Product;

class StockController extends Controller
{
    /**
     * Display a summary of stock by date.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch distinct dates from both purchase and sales records
        $purchaseDates = PurchaseDetails::with('purchase')
            ->get()
            ->pluck('purchase.purchaseorder_date')
            ->unique();

        $salesDates = SalesDetails::with('sale')
            ->get()
            ->pluck('sale.date')
            ->unique();

        // Combine and sort the dates
        $dates = $purchaseDates->merge($salesDates)->unique()->sort();

        $stockData = [];
        $openingStock = 0;

        foreach ($dates as $date) {
            $datePurchases = PurchaseDetails::whereHas('purchase', function ($query) use ($date) {
                    $query->whereDate('purchaseorder_date', '=', $date);
                })->sum('qty');

            $dateSales = SalesDetails::whereHas('sale', function ($query) use ($date) {
                    $query->whereDate('date', '=', $date);
                })->sum('qty');

            $closingStock = $openingStock + $datePurchases - $dateSales;
            $stockData[$date] = $closingStock;

            // Set the closing stock as the opening stock for the next iteration
            $openingStock = $closingStock;
        }

        return view('stock.index', compact('stockData'));
    }

    /**
     * Display the stock details for a specific date.
     *
     * @param  string  $date
     * @return \Illuminate\View\View
     */
    public function details($date)
    {
        $products = Product::all();
        $stockDetails = [];

        foreach ($products as $product) {
            $openingStock = $this->getOpeningStock($product->id, $date);

            $purchases = $product->purchaseDetails()
                ->whereHas('purchase', function ($query) use ($date) {
                    $query->whereDate('purchaseorder_date', '=', $date);
                })->sum('qty');

            $sales = $product->salesDetails()
                ->whereHas('sale', function ($query) use ($date) {
                    $query->whereDate('date', '=', $date);
                })->sum('qty');

            $closingStock = $openingStock + $purchases - $sales;

            $stockDetails[] = [
                'product' => $product,
                'opening' => $openingStock,
                'purchases' => $purchases,
                'sales' => $sales,
                'closing' => $closingStock,
            ];
        }

        return view('stock.details', compact('stockDetails', 'date'));
    }

    /**
     * Get the opening stock for a product on a specific date.
     *
     * @param  int  $productId
     * @param  string  $date
     * @return int
     */
    private function getOpeningStock($productId, $date)
    {
        $purchasesBeforeDate = PurchaseDetails::where('product_id', $productId)
            ->whereHas('purchase', function ($query) use ($date) {
                $query->whereDate('purchaseorder_date', '<', $date);
            })->sum('qty');

        $salesBeforeDate = SalesDetails::where('product_id', $productId)
            ->whereHas('sale', function ($query) use ($date) {
                $query->whereDate('date', '<', $date);
            })->sum('qty');

        return $purchasesBeforeDate - $salesBeforeDate;
    }
}


