<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public $locations;
    public function __construct(Location $location)
    {
        $this->locations = $location;
    }
    public function index()
    {
        $locations = $this->locations->all();
        return view('location.index', compact('locations'));
    }

    public function create()
    {
        $locations = $this->locations->all()->pluck('name', 'id');
        return view('location.create', compact(['locations']));
    }

    public function store(Request $request)
    {
        $locations = new Location();
        $locations->name = $request->input('name');
        $locations->address = $request->input('address');
        $locations->save();
        return redirect()->route('location.index')->with('success', 'Location created Successfully!!');
    }

    public function show($id)
    {
        $locations = $this->locations->findOrFail($id);
        return view('location.show', compact('locations'));
    }

    public function edit($id)
    {
        $locations = $this->locations->findOrFail($id);
        return view('location.edit', compact('locations'));
    }

    public function update(Request $request, $id)
    {
        $locations = $this->locations->findOrFail($id);
        $locations->update($request->all());
        return redirect()->route('location.index')->with('success', 'Location Updated Successfully!!');
    }

    public function destroy($id)
    {
        $locations = Location::findOrFail($id);
        $locations->delete();
        return redirect()->route('location.index')->with('success', 'Location deleted Successfully!!');
    }
}