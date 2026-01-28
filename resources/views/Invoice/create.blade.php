@extends('Layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="m-b-0 text-white">Invoice Creation Form</h4>
                </div>

                <form method="POST" action="{{ route('invoice.store') }}" class="row g-3 m-2" novalidate>
                    @csrf

                    <div class="card-body col-md-12">
                        <h4 class="card-title">Invoice Info</h4>
                        @if($errors->any())
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <hr>
                    <div class="form-body col-md-12">
                        <div class="card-body">
                            <div class="row p-t-20">
                                <x-form.text-input 
                                    colSpan='col-md-3'
                                    type="date"
                                    name="invoice_date"
                                    labelCaption="Invoice Date"
                                    {{-- extraClass="text-uppercase" --}}
                                    required
                                />

                                <x-form.text-input 
                                    colSpan='col-md-3'
                                    type="text"
                                    name="invoice_no"
                                    labelCaption="Invoice No"
                                    extraClass="text-uppercase"
                                    required
                                />

                                <x-form.select-input 
                                    colSpan='col-md-6'
                                    labelCaption="Vendor Name"
                                    name="vendor_id"
                                    :options="$vendors"
                                    required
                                />
                            </div>
                        </div>

                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-sm" id="invoiceTable">
                                <thead class="table-light bg-success text-white text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Item</th>
                                        <th>Type</th>
                                        <th>Serial No</th>
                                        <th>Qty</th>
                                        <th>Rate</th>
                                        <th>Amount</th>
                                        <th>Tax %</th>
                                        <th>Tax Amt</th>
                                        <th>Gross</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @for($i = 0; $i < 15; $i++)
                                    <tr>
                                        <td>{{ $i+1 }}</td>
                                        <td>
                                            <select name="items[{{ $i }}][item_id]"
                                                id="items[{{ $i }}][item_id]"
                                                class="form-control item-select">
                                                <option value="">-- Select --</option>
                                                @foreach($items as $item)
                                                <option value="{{ $item->id }}"
                                                        data-type="{{ $item->item_type }}"
                                                        data-serial="{{ $item->item_has_serial_no }}">
                                                    {{ $item->item_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </td>

                                        <td>
                                            <input type="text" class="form-control item-type"
                                            name="items[{{ $i }}][item-type]"
                                            id="items[{{ $i }}][item-type]" readonly />
                                        </td>

                                        <td>
                                            <input type="text"
                                                name="items[{{ $i }}][serial_no]"
                                                id="items[{{ $i }}][serial_no]"
                                                class="form-control serial-no"
                                                disabled />
                                        </td>

                                        <td>
                                            <input type="number"
                                                name="items[{{ $i }}][quantity]"
                                                id="items[{{ $i }}][quantity]"
                                                class="form-control qty"
                                                value="1"
                                                min="1" />
                                        </td>

                                        <td>
                                            <input type="number"
                                                name="items[{{ $i }}][rate]"
                                                id="items[{{ $i }}][rate]"
                                                class="form-control rate"
                                                step="0.50" />
                                        </td>

                                        <td>
                                            <input type="text" 
                                                class="form-control amount"
                                                name="items[{{ $i }}][amount]"
                                                id="items[{{ $i }}][amount]"
                                                readonly />
                                        </td>

                                        <td>
                                            <input type="number"
                                                name="items[{{ $i }}][tax_percent]"
                                                id="items[{{ $i }}][tax_percent]"
                                                class="form-control tax-percent"
                                                value="18"
                                                step="0.50" />
                                        </td>

                                        <td>
                                            <input type="text" 
                                                class="form-control tax-amount" 
                                                name="items[{{ $i }}][tax_amount]"
                                                id="items[{{ $i }}][tax_amount]"
                                                readonly />
                                        </td>

                                        <td>
                                            <input type="text" 
                                                class="form-control gross-amount" 
                                                name="items[{{ $i }}][gross_amount]"
                                                id="items[{{ $i }}][gross_amount]"
                                                readonly />
                                        </td>
                                    </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>

                        <div class="card-body row">
                            <div class="col-md-2">
                                <label>Total Amount</label>
                                <input type="text" 
                                    id="totalAmount" 
                                    name="total_amount"
                                    class="form-control" 
                                    readonly />
                            </div>

                            <div class="col-md-2">
                                <label>Total Tax</label>
                                <input type="text" 
                                    id="totalTax" 
                                    name="total_tax" 
                                    class="form-control" 
                                    readonly />
                            </div>

                            <div class="col-md-3">
                                <label>Gross Amount</label>
                                <input type="text" 
                                    id="grossAmount" 
                                    name="gross_amount" 
                                    class="form-control" 
                                    readonly />
                            </div>

                            <div class="col-md-2">
                                <label>Round Off</label>
                                <input type="text" 
                                    id="roundOff" 
                                    name="round_off" 
                                    class="form-control" 
                                    readonly />
                            </div>

                            <div class="col-md-3">
                                <label>Invoice Amount</label>
                                <input type="text" 
                                    id="invoiceAmount" 
                                    name="invoice_amount" 
                                    class="form-control fw-bold" 
                                    readonly />
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="action-form">
                                <div class="form-group m-b-0 text-right">
                                    <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                    <a type="submit" 
                                        class="btn btn-dark waves-effect waves-light"
                                        href="{{ route('invoice.index') }}">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
function recalcRow(row) {
    let qty   = parseFloat(row.find('.qty').val()) || 0;
    let rate  = parseFloat(row.find('.rate').val()) || 0;
    let taxP  = parseFloat(row.find('.tax-percent').val()) || 0;

    let amount = qty * rate;
    let taxAmt = amount * taxP / 100;
    let gross  = amount + taxAmt;

    row.find('.amount').val(amount.toFixed(2));
    row.find('.tax-amount').val(taxAmt.toFixed(2));
    row.find('.gross-amount').val(gross.toFixed(2));
}

function recalcTotals() {
    let total = 0, tax = 0;

    $('.amount').each(function () {
        total += parseFloat($(this).val()) || 0;
    });

    $('.tax-amount').each(function () {
        tax += parseFloat($(this).val()) || 0;
    });

    let gross = total + tax;
    let rounded = Math.round(gross);
    let roundOff = rounded - gross;

    $('#totalAmount').val(total.toFixed(2));
    $('#totalTax').val(tax.toFixed(2));
    $('#grossAmount').val(tax.toFixed(2));
    $('#roundOff').val(roundOff.toFixed(2));
    $('#invoiceAmount').val(rounded.toFixed(2));
}

$(document).on('change', '.item-select', function () {
    let row = $(this).closest('tr');
    let type = $(this).find(':selected').data('type');
    let hasSerial = $(this).find(':selected').data('serial');

    row.find('.item-type').val(type || '');

    if (type === 'Asset') {
        row.find('.qty').val(1).prop('readonly', true);
        row.find('.serial-no').prop('disabled', false).attr('required', true);
    } else {
        row.find('.qty').prop('readonly', false);
        row.find('.serial-no').prop('disabled', true).removeAttr('required').val('');
    }
});

$(document).on('input', '.qty, .rate, .tax-percent', function () {
    let row = $(this).closest('tr');
    recalcRow(row);
    recalcTotals();
});
</script>
@endpush
