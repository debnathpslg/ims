<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
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
                    'label' => 'Report',
                    // 'url' => route('home'),
                ],
                [
                    'label' => 'Stock',
                ],
            ],
        ];

        $stocks = Stock::query()
            ->select(
                'id',
                'item_id',
                'total_purchased',
                'total_issued',
                'total_scrapped',
                'total_returned_by_employee',
                'total_returned_to_vendor',
                'stock_in_hand',
            )
            ->with(
                [
                    'item:id,item_code,item_name,item_status'
                ]
            )
            ->get();

        return view('Stock.index', compact('breadCrumbProps', 'stocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
