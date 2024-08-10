<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public $warehouses;
    public $locations;
    public function __construct(Warehouse $warehouse, Location $Location)
    {
        $this->warehouses = $warehouse;
        $this->locations = $Location;
    }
    public function index()
    {
        $warehouses = $this->warehouses->with('Location')->get();
        $locations = $this->locations->all();
        return view('warehouse.index', compact(['warehouses', 'locations']));
    }

    public function create()
    {
        $warehouses = $this->warehouses->all()->pluck('name', 'id');
        $locations = $this->locations->all()->pluck('name', 'id');
        return view('warehouse.create', compact(['warehouses', 'locations']));
    }

    public function store(Request $request)
    {

        $warehouse = new Warehouse();
        $warehouse->name = $request->input('name');
        $warehouse->isRefrigerated = $request->input('isRefrigerated');
        $warehouse->location_id = $request->input('location_id');
        $warehouse->save();
        return redirect()->route('warehouse.index')->with('success', 'Warehouse created successfully.');
    }

    public function show($id)
    {
        $warehouses = $this->warehouses->findOrFail($id);
        return view('warehouse.show', compact('warehouses'));
    }

    public function edit($id)
    {
        $warehouses = $this->warehouses->findOrFail($id);
        $locations = $this->locations->all()->pluck('name', 'id');
        return view('warehouse.edit', compact(['warehouses', 'locations']));
    }

    public function update(Request $request, $id)
    {
        $warehouses = $this->warehouses->findOrFail($id);
        $warehouses->update($request->all());
        return redirect()->route('warehouse.index')->with('success', 'Warehouse Update Successfully!');
    }

    public function destroy($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $warehouse->delete();
        return redirect()->route('warehouse.index')->with('success', 'Warehouse deleted successfully.');
    }
}