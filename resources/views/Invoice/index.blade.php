@extends('layouts.app')

@section('content')
    <div>
        <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered table-sm table-hover">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Invoice Date</th>
                        <th>Invoice No</th>
                        <th>Vendor Name</th>
                        <th>Invoice Amount</th>
                        <th>Payment Status</th>
                        <th>Payment Date</th>
                        <th>Remarks</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($invoices as $invoice)
                    <tr>
                        <td class="text-center">{{ $invoice->invoice_date }}</td>
                        <td>
                            {{-- <a href="{{ route('employee.show', $employee) }}"> --}}
                                {{ $invoice->invoice_no }}
                            {{-- </a> --}}
                        </td>
                        <td>{{ $invoice->vendor->vendor_name }}</td>
                        <td>{{ $invoice->invoice_amount }}</td>
                        <td class="text-white {{ $invoice->status == 'Paid' ? 'bg-success' : 'bg-danger' }} text-center">{{ $invoice->status }}</td>
                        <td>{{ $invoice->payment_date }}</td>
                        <td>{{ $invoice->remarks }}</td>
                        <td class="text-center">
                            {{-- <a href="{{ route('employee.show', $employee) }}">View</a>
                            <span> / </span>
                            <a href="{{ route('employee.edit', $employee) }}">Edit</a> --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7">
                            <a type="button" class="btn btn-info btn-rounded" href="{{ route('invoice.create') }}">Add New Invoice</a>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection