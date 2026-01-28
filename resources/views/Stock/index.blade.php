@extends('Layouts.app')

@section('content')
    <div>
        <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered table-sm table-hover">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Item Code</th>
                        <th>Item Name</th>
                        <th>Total Purchased</th>
                        <th>Total Issued</th>
                        <th>Total Scrapped</th>
                        <th>Total Returned By Employee</th>
                        <th>Total Returned To Vendor</th>
                        <th>Stock In Hand</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($stocks as $stock)
                    <tr>
                        <td class="text-center">{{ $stock->item->item_code }}</td>
                        <td>{{ $stock->item->item_name }}</td>
                        <td>{{ $stock->total_purchased }}</td>
                        <td>{{ $stock->total_issued }}</td>
                        <td>{{ $stock->total_scrapped }}</td>
                        <td>{{ $stock->total_returned_by_employee }}</td>
                        <td>{{ $stock->total_returned_to_vendor }}</td>
                        <td>{{ $stock->stock_in_hand }}</td>
                        <td class="text-white {{ $stock->item->item_status == 'Active' ? 'bg-success' : 'bg-danger' }} text-center">{{ $stock->item->item_status }}</td>
                    </tr>
                    @endforeach
                </tbody>
                {{-- <tfoot>
                    <tr>
                        <td colspan="7">
                            <a type="button" class="btn btn-info btn-rounded" href="{{ route('item.create') }}">Add New Item</a>
                        </td>
                    </tr>
                </tfoot> --}}
            </table>
        </div>
    </div>
@endsection