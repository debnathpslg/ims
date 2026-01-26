<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $breadCrumbProps = [
            'page_name' => "Item",
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
                    'label' => 'Item',
                ],
            ],
        ];

        $items = Item::select(
            'id',
            'item_code',
            'item_name',
            'item_type',
            'item_has_serial_no',
            'item_unit',
            'item_reorder_quantity',
            'is_item_scrapable',
            'is_item_refundable',
            'item_status'
        )
            ->get();

        return view('Item.index', compact('breadCrumbProps', 'items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $breadCrumbProps = [
            'page_name' => "Item",
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
                    'label' => 'Item',
                    'url' => route('item.index'),
                ],
                [
                    'label' => 'New Item',
                ],
            ],
        ];

        return view('Item.create', compact('breadCrumbProps'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'item_code'             => 'required|string|max:10|unique:items,item_code',
            'item_name'             => 'required|string|max:100|unique:items,item_name',
            'item_type'             => 'required|in:Consumable,Asset',
            'item_has_serial_no'    => 'required|boolean',
            'item_unit'             => 'nullable|string|max:20',
            'item_reorder_quantity' => 'nullable|integer|min:1',
            'is_item_scrapable'     => 'required|boolean',
            'is_item_refundable'    => 'required|boolean',
            'item_status'           => 'required|in:Active,Inactive',
        ]);

        // if ($request->item_status === 'Inactive' && ! $item->canBeInactivated()) {
        //     return back()->withErrors([
        //         'item_status' => 'Stock available. Item cannot be inactivated.',
        //     ]);
        // }

        Item::create($validated);

        return redirect()->route('item.index')
            ->with('success', 'Item was created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
        $breadCrumbProps = [
            'page_name' => "Item",
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
                    'label' => 'Item',
                    'url' => route('item.index'),
                ],
                [
                    'label' => 'Show Item Info',
                ],
            ],
        ];

        return view('Item.show', compact('breadCrumbProps', 'item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
        $breadCrumbProps = [
            'page_name' => "Item",
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
                    'label' => 'Item',
                    'url' => route('item.index'),
                ],
                [
                    'label' => 'Edit Item Details',
                ],
            ],
        ];

        return view('Item.edit', compact('breadCrumbProps', 'item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        //
        $validated = $request->validate([
            'item_code'             => [
                'required',
                'string',
                'max:10',
                Rule::unique('items', 'item_code')->ignore($item->id),
            ],
            'item_name'             => [
                'required',
                'string',
                'max:100',
                Rule::unique('items', 'item_name')->ignore($item->id),
            ],
            'item_type'             => 'required|in:Consumable,Asset',
            'item_has_serial_no'    => 'required|boolean',
            'item_reorder_quantity' => 'nullable|integer|min:1',
            'is_item_scrapable'     => 'required|boolean',
            'is_item_refundable'    => 'required|boolean',
            'item_status'           => 'required|in:Active,Inactive',
        ]);

        if ($request->item_status === 'Inactive' && ! $item->canBeInactivated()) {
            return back()->withErrors([
                'item_status' => 'Stock available. Item cannot be inactivated.',
            ]);
        }

        $item->update($validated);

        return redirect()->route('item.index')
            ->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */ public function destroy(Item $item)
    {
        //
        return redirect()->route('item.index');
    }
}
