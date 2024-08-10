<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provider;

class ProviderController extends Controller
{
    public function index()
    {
        return Provider::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);

        $providers = Provider::create($request->all());

        return response()->json($providers, 201);
    }

    public function show($id)
    {
        return Provider::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);


        $providers = Provider::findOrFail($id);
        $providers->update($request->all());

        return response()->json($providers, 200);
    }

    public function destroy($id)
    {
        Provider::findOrFail($id)->delete();

        return response()->json(null, 204);
    }
}
