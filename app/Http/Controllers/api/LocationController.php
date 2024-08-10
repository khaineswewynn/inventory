<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        return Location::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
        ],
        [
            'name.required' => 'Please enter location name.',
            'address.required' => 'Please enter address.'
        ]);
        $locations = Location::create($request->all());

        return response()->json($locations, 201);
    }

    public function show($id)
    {
        return Location::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
        ],
        [
            'name.required' => 'Please enter location name.',
            'address.required' => 'Please enter address.'
        ]);

        $locations = Location::findOrFail($id);
        $locations->update($request->all());

        return response()->json($locations, 200);
    }

    public function destroy($id)
    {
        Location::findOrFail($id)->delete();

        return response()->json(null, 204);
    }
    
}
