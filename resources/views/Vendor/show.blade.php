@extends('Layouts.app')

@section('content')
    <div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h3 class="box-title m-t-40">Vendor Info</h3>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td width="390">Vendor Code</td>
                                <td> {{ $vendor->vendor_code }} </td>
                            </tr>
                            <tr>
                                <td>Vendor Name</td>
                                <td> {{ $vendor->vendor_name }} </td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td> {{ $vendor->vendor_address }} </td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td> {{ $vendor->vendor_city }} </td>
                            </tr>
                            <tr>
                                <td>State</td>
                                <td> {{ $vendor->vendor_state }} </td>
                            </tr>
                            <tr>
                                <td>PIN</td>
                                <td> {{ $vendor->vendor_pin }} </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td> {{ $vendor->vendor_email }} </td>
                            </tr>

                            <tr>
                                <td>Mobile</td>
                                <td> {{ $vendor->vendor_mobile }} </td>
                            </tr>
                            <tr>
                                <td>GST No</td>
                                <td> {{ $vendor->vendor_gst_no }} </td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td> 
                                    @if ($vendor->vendor_status == 'Active')
                                        <h3>
                                            {{-- <i class="fa fa-circle text-success"></i> --}}
                                            <span class="badge badge-success">
                                                {{ $vendor->vendor_status }}
                                            </span>
                                    </h3>
                                    @else
                                        <h3>
                                            {{-- <i class="fa fa-circle text-danger"></i> --}}
                                            <span class="badge badge-danger">
                                                {{ $vendor->vendor_status }}
                                            </span>
                                        </h3>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection