<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.vendors.index', [
            'vendors' => Vendor::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $vendor = Vendor::create([
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'contact_no' => $request->contact_no,
            'email' => $request->email,
            'contact_person' => $request->contact_person,
            'is_contractor' => $request->is_contractor == 'on' ? 1 : 0,
            'is_supplier' => $request->is_supplier == 'on' ? 1 : 0,
            'industry' => $request->industry,
            'service' => $request->service,
        ]);
        return redirect()->route('vendors.index')->with('success', 'Vendor created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        return view('admin.vendors.show', [
            'vendor' => $vendor
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor)
    {
        return view('admin.vendors.edit', [
            'vendor' => $vendor
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendor $vendor)
    {
        $vendor->update([
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'contact_no' => $request->contact_no,
            'email' => $request->email,
            'contact_person' => $request->contact_person,
            'is_contractor' => $request->is_contractor == 'on' ? 1 : 0,
            'is_supplier' => $request->is_supplier == 'on' ? 1 : 0,
            'industry' => $request->industry,
            'service' => $request->service,
        ]);
        return redirect()->route('vendors.index')->with('success', 'Vendor updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return response()->json(["success" => "Vendor Record Deleted Successfully"],201);
    }
}
