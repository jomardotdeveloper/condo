<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupplierItem;
use App\Models\Vendor;
use Illuminate\Http\Request;

class SupplierItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.supplier-items.index', [
            'supplier_items' => SupplierItem::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.supplier-items.create', [
            'vendors' => $this->getSelectOptions(
                Vendor::class,
                "company_name",
                Vendor::where('is_supplier', true)->get()
            ),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'vendor_id' => 'required',
            'lines' => 'required',
        ]);

        SupplierItem::create($request->all());

        return redirect()->route('supplier-items.index')->with('success', 'Supplier Item created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SupplierItem $supplierItem)
    {
        return view('admin.supplier-items.edit', [
            'supplier_item' => $supplierItem,
            'vendors' => $this->getSelectOptions(
                Vendor::class,
                "company_name",
                Vendor::where('is_supplier', true)->get()
            ),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SupplierItem $supplierItem)
    {
        $request->validate([
            'vendor_id' => 'required',
            'lines' => 'required',
        ]);

        $supplierItem->update($request->all());

        return redirect()->route('supplier-items.index')->with('success', 'Supplier Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SupplierItem $supplierItem)
    {
        $supplierItem->delete();

        return response()->json(["success" => "Supplier Item Record Deleted Successfully"],201);
    }
}
