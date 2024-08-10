<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse;

class WarehouseController extends Controller
{
    public function index()
    {
        return Warehouse::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'isRefrigerated' => 'required',
            'location_id' => 'required',
        ],
        [
            'name' => 'required',
            'isRefrigerated' => 'required',
            'location_id' => 'required',
        ]);
        $warehouse = Warehouse::create($request->all());

        return response()->json($warehouse, 201);
    }

    public function show($id)
    {
        return Warehouse::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'isRefrigerated' => 'required',
            'location_id' => 'required',
        ],
        [
            'name' => 'required',
            'isRefrigerated' => 'required',
            'location_id' => 'required',
        ]);

        $warehouse = Warehouse::findOrFail($id);
        $warehouse->update($request->all());

        return response()->json($warehouse, 200);
    }

    public function destroy($id)
    {
        Warehouse::findOrFail($id)->delete();

        return response()->json(null, 204);
    }
}
