<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Stock;
use App\Models\Vendor;
use App\Models\Invoice;
use App\Models\ItemSerial;
use App\Models\InvoiceItem;
use App\Models\ItemMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $breadCrumbProps = [
            'page_name' => "Invoice",
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
                    'label' => 'Transaction',
                    // 'url' => route('home'),
                ],
                [
                    'label' => 'Invoice',
                ],
            ],
        ];

        $invoices = Invoice::all();

        return view('Invoice.index', compact('breadCrumbProps', 'invoices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $breadCrumbProps = [
            'page_name' => "Invoice",
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
                    'label' => 'Transaction',
                    // 'url' => route('home'),
                ],
                [
                    'label' => 'Invoice',
                    'url' => route('invoice.index'),
                ],
                [
                    'label' => 'New Invoice',
                    // 'url' => route('home'),
                ],
            ],
        ];

        $vendors = $vendors = Vendor::where('vendor_status', 'Active')
            ->orderBy('vendor_name')
            ->pluck('vendor_name', 'id')
            ->toArray();

        $items = Item::where('item_status', 'Active')
            ->orderBy('item_name')
            ->get();

        return view('Invoice.create', compact('vendors', 'items', 'breadCrumbProps'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make(
            $request->all(),
            [
                'vendor_id'     => 'required|exists:vendors,id',
                'invoice_no'    => 'required|string|max:30',
                'invoice_date'  => 'required|date',
                'items'         => 'required|array|min:1',

                'items.*.item_id'      => 'nullable|exists:items,id',
                'items.*.quantity'     => 'nullable|required_with:items.*.item_id|integer|min:1',
                'items.*.rate'         => 'nullable|required_with:items.*.item_id|numeric|min:1',
                'items.*.tax_percent'  => 'nullable|required_with:items.*.item_id|numeric|min:0',
                'items.*.serial_no'    => 'nullable|string|max:128',
            ]
        );

        $validator->after(function ($validator) use ($request) {
            $validRows = collect($request->items)
                ->filter(fn($row) => !empty($row['item_id']));

            if ($validRows->isEmpty()) {
                $validator->errors()->add(
                    'items',
                    'At least one invoice item is required.'
                );
            }
            
            foreach ($request->items as $index => $row) {
                if (empty($row['item_id'])) {
                    continue;
                }

                $item = Item::find($row['item_id']);

                if ($item->item_type === 'Asset' && empty($row['serial_no'])) {
                    $validator->errors()->add(
                        "items.$index.serial_no",
                        'Serial number is required for asset item.'
                    );
                }
            }
        });

        $validated = $validator->validate();

        DB::transaction(function () use ($request) {

            /** ---------------- Invoice ---------------- */
            $invoice = Invoice::create([
                'vendor_id'    => $request->vendor_id,
                'invoice_no'   => $request->invoice_no,
                'invoice_date' => $request->invoice_date,
                'remarks'      => $request->remarks,
            ]);

            $totalAmount = 0;
            $totalTax    = 0;

            /** ---------------- Invoice Items ---------------- */
            foreach ($request->items as $row) {

                if (empty($row['item_id'])) {
                    continue; // dummy row skip
                }

                $item = Item::findOrFail($row['item_id']);

                $amount     = $row['quantity'] * $row['rate'];
                $taxPercent = $row['tax_percent'] ?? 0;
                $taxAmount  = ($amount * $taxPercent) / 100;
                $itemTotal  = $amount + $taxAmount;

                $invoiceItem = InvoiceItem::create([
                    'invoice_id'  => $invoice->id,
                    'item_id'     => $item->id,
                    'quantity'    => $row['quantity'],
                    'rate'        => $row['rate'],
                    'amount'      => $amount,
                    'tax_percent' => $taxPercent,
                    'tax_amount'  => $taxAmount,
                    'item_amount' => $itemTotal,
                ]);

                /** ---------- Stock Update ---------- */
                $stock = Stock::firstOrCreate(
                    ['item_id' => $item->id],
                    []
                );

                $stock->increment('total_purchased', $row['quantity']);
                $stock->increment('stock_in_hand', $row['quantity']);

                /** ---------- Asset Serial ---------- */
                if ($item->item_type === 'Asset') {

                    $serial = ItemSerial::create([
                        'item_id'    => $item->id,
                        'invoice_id' => $invoice->id,
                        'serial_no'  => $row['serial_no'],
                    ]);
                
                    ItemMovement::create([
                        'item_id'                    => $item->id,
                        'serial_id'                  => $serial->id,
                        'source_of_movement'         => 'Invoice',
                        'source_of_movement_id'      => $invoice->id,
                        'where_it_comes_from_type'   => 'Vendor',
                        'where_it_comes_from'        => $invoice->vendor_id,
                        'where_it_moves_to_type'     => 'Store',
                    ]);
                }

                $totalAmount += $amount;
                $totalTax    += $taxAmount;
            }

            /** ---------------- Invoice Totals ---------------- */
            $grossAmount = $totalAmount + $totalTax;
            $rounded     = round($grossAmount, 0);
            $roundOff    = $rounded - $grossAmount;

            $invoice->update([
                'total_amount'  => $totalAmount,
                'total_tax'     => $totalTax,
                'gross_amount'  => $grossAmount,
                'round_off'     => $roundOff,
                'invoice_amount' => $rounded,
            ]);
        });

        return redirect()->route('invoice.index')
            ->with('success', 'Invoice created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
