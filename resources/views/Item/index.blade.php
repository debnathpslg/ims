@extends('Layouts.app')

@section('content')
    <div>
        <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered table-sm table-hover">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Item Code</th>
                        <th>Item Name</th>
                        <th>Item Type</th>
                        <th>Item Has Serial No</th>
                        <th>Item Unit</th>
                        <th>Item Reorder Quantity</th>
                        <th>Is Item Scrapable</th>
                        <th>Is Item Refundable</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($items as $item)
                    <tr>
                        <td class="text-center">{{ $item->item_code }}</td>
                        <td>
                            <a href="{{ route('item.show', $item) }}">
                                {{ $item->item_name }}
                            </a>
                        </td>
                        <td>{{ $item->item_type }}</td>
                        <td>{{ $item->item_has_serial_no ? "Yes" : "No" }}</td>
                        <td>{{ $item->item_unit }}</td>
                        <td>{{ $item->item_reorder_quantity }}</td>
                        <td>{{ $item->is_item_scrapable ? "Yes" : "No" }}</td>
                        <td>{{ $item->is_item_refundable ? "Yes" : "No" }}</td>
                        <td class="text-white {{ $item->item_status == 'Active' ? 'bg-success' : 'bg-danger' }} text-center">{{ $item->item_status }}</td>
                        <td class="text-center">
                            <a href="{{ route('item.show', $item) }}">View</a>
                            <span> / </span>
                            <a href="{{ route('item.edit', $item) }}">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7">
                            <a type="button" class="btn btn-info btn-rounded" href="{{ route('item.create') }}">Add New Item</a>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection