<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index()
    {
        $providers = Provider::all();
        return view('provider.index', compact('providers'));
    }

    public function create()
    {
        return view('provider.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);

        Provider::create($request->all());

        return redirect()->route('provider.index')->with('success', 'Provider created successfully.');
    }

    public function show(Provider $provider)
    {
        return view('provider.view', compact('provider'));
    }

    public function edit(Provider $provider)
    {
        return view('provider.edit', compact('provider'));
    }

    public function update(Request $request, Provider $provider)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);

        $provider->update($request->all());

        return redirect()->route('provider.index')->with('success', 'Provider updated successfully.');
    }

    public function destroy(Provider $provider)
    {
        $provider->delete();

        return redirect()->route('provider.index')->with('success', 'Provider deleted successfully.');
    }
}