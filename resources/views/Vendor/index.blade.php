@extends('Layouts.app')

@section('content')
    <div>
        <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered table-sm table-hover">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Vendor Code</th>
                        <th>Vendor Name</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>State</th>
                        <th>PIN</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>GST No</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($vendors as $vendor)
                    <tr>
                        <td class="text-center">{{ $vendor->vendor_code }}</td>
                        <td>
                            <a href="{{ route('vendor.show', $vendor) }}">
                                {{ $vendor->vendor_name }}
                            </a>
                        </td>
                        <td>{{ $vendor->vendor_address }}</td>
                        <td>{{ $vendor->vendor_city }}</td>
                        <td>{{ $vendor->vendor_state }}</td>
                        <td>{{ $vendor->vendor_pin }}</td>
                        <td>{{ $vendor->vendor_email }}</td>
                        <td>{{ $vendor->vendor_mobile }}</td>
                        <td>{{ $vendor->vendor_gst_no }}</td>
                        <td class="text-white {{ $vendor->vendor_status == 'Active' ? 'bg-success' : 'bg-danger' }} text-center">{{ $vendor->vendor_status }}</td>
                        <td class="text-center">
                            <a href="{{ route('vendor.show', $vendor) }}">View</a>
                            <span> / </span>
                            <a href="{{ route('vendor.edit', $vendor) }}">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7">
                            <a type="button" class="btn btn-info btn-rounded" href="{{ route('vendor.create') }}">Add New Vendor</a>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection