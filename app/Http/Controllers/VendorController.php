<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $breadCrumbProps = [
            'page_name' => "Vendor",
            'bread_crumbs' => [
                [
                    'label' => 'Home',
                    'url' => route('home'),
                ],
                [
                    'label' => 'Inventory',
                    // 'url' => route('home'),
                ],
                [
                    'label' => 'Master',
                    // 'url' => route('home'),
                ],
                [
                    'label' => 'Vendor',
                ],
            ],
        ];

        $vendors = Vendor::select(
            'id',
            'vendor_code',
            'vendor_name',
            'vendor_address',
            'vendor_city',
            'vendor_state',
            'vendor_pin',
            'vendor_mobile',
            'vendor_email',
            'vendor_gst_no',
            'vendor_status'
        )
            ->get();

        return view('Vendor.index', compact('breadCrumbProps', 'vendors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $breadCrumbProps = [
            'page_name' => "Vendor",
            'bread_crumbs' => [
                [
                    'label' => 'Home',
                    'url' => route('home'),
                ],
                [
                    'label' => 'Inventory',
                    // 'url' => route('home'),
                ],
                [
                    'label' => 'Master',
                    // 'url' => route('home'),
                ],
                [
                    'label' => 'Vendor',
                    'url' => route('vendor.index'),
                ],
                [
                    'label' => 'New Vendor',
                ],
            ],
        ];

        return view('Vendor.create', compact('breadCrumbProps'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'vendor_code'        => 'required|string|max:10|unique:vendors,vendor_code',
            'vendor_name'        => 'required|string|max:100',
            'vendor_address'     => 'nullable|string',
            'vendor_city'        => 'required|string|max:30',
            'vendor_state'       => 'required|string|max:30',
            'vendor_pin'         => 'nullable|string|max:6',
            'vendor_email'       => 'required|max:50|email|unique:vendors,vendor_email',
            'vendor_mobile'      => 'nullable|max:20',
            'vendor_gst_no'      => 'nullable|max:15|min:15',
            'vendor_status'      => 'required|in:Active,Inactive',
        ]);

        Vendor::create($validated);

        return redirect()->route('vendor.index')
            ->with('success', 'Vendor was created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        //
        $breadCrumbProps = [
            'page_name' => "Vendor",
            'bread_crumbs' => [
                [
                    'label' => 'Home',
                    'url' => route('home'),
                ],
                [
                    'label' => 'Inventory',
                    // 'url' => route('home'),
                ],
                [
                    'label' => 'Master',
                    // 'url' => route('home'),
                ],
                [
                    'label' => 'Vendor',
                    'url' => route('vendor.index'),
                ],
                [
                    'label' => 'Show Vendor Details',
                ],
            ],
        ];

        return view('Vendor.show', compact('vendor', 'breadCrumbProps'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor)
    {
        //
        $breadCrumbProps = [
            'page_name' => "Vendor",
            'bread_crumbs' => [
                [
                    'label' => 'Home',
                    'url' => route('home'),
                ],
                [
                    'label' => 'Inventory',
                    // 'url' => route('home'),
                ],
                [
                    'label' => 'Master',
                    // 'url' => route('home'),
                ],
                [
                    'label' => 'Vendor',
                    'url' => route('vendor.index'),
                ],
                [
                    'label' => 'Edit Vendor Details',
                ],
            ],
        ];

        return view('Vendor.edit', compact('breadCrumbProps', 'vendor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendor $vendor)
    {
        //
        $validated = $request->validate([
            'vendor_code'        => [
                'required',
                'string',
                'max:10',
                Rule::unique('vendors', 'vendor_code')->ignore($vendor->id),
            ],
            'vendor_name'        => 'required|string|max:100',
            'vendor_address'     => 'nullable|string',
            'vendor_city'        => 'required|string|max:30',
            'vendor_state'       => 'required|string|max:30',
            'vendor_pin'         => 'nullable|string|max:6',
            'vendor_email'       => [
                'required',
                'max:50',
                'email',
                Rule::unique('vendors', 'vendor_email')->ignore($vendor->id),
            ],
            'vendor_mobile'      => 'nullable|max:20',
            'vendor_gst_no'      => 'nullable|string|max:20',
            'vendor_status'      => 'required|in:Active,Inactive',
        ]);

        $vendor->update($validated);

        return redirect()->route('vendor.index')
            ->with('success', 'Vendor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        //
        return redirect()->route('vendor.index')->with('error', 'This action is not permitted!!!');;
    }
}
