@extends('Layouts.app')

@section('content')
    <div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h3 class="box-title m-t-40">Item Info</h3>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td width="390">Item Code</td>
                                <td> {{ $item->item_code }} </td>
                            </tr>
                            <tr>
                                <td>Item Name</td>
                                <td> {{ $item->item_name }} </td>
                            </tr>
                            <tr>
                                <td>Item Type</td>
                                <td> {{ $item->item_type }} </td>
                            </tr>
                            <tr>
                                <td>Item Has Serial No</td>
                                <td> {{ $item->item_has_serial_no ? 'Yes' : 'No' }} </td>
                            </tr>
                            <tr>
                                <td>Item Unit</td>
                                <td> {{ $item->item_unit }} </td>
                            </tr>
                            <tr>
                                <td>Item Reorder Quantity</td>
                                <td> {{ $item->item_reorder_quantity }} </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td> {{ $item->is_item_scrapable ? 'Yes' : 'No' }} </td>
                            </tr>

                            <tr>
                                <td>Mobile</td>
                                <td> {{ $item->is_item_refundable ? 'Yes' : 'No' }} </td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td> 
                                    @if ($item->item_status == 'Active')
                                        <h3>
                                            {{-- <i class="fa fa-circle text-success"></i> --}}
                                            <span class="badge badge-success">
                                                {{ $item->item_status }}
                                            </span>
                                        </h3>
                                    @else
                                        <h3>
                                            {{-- <i class="fa fa-circle text-danger"></i> --}}
                                            <span class="badge badge-danger">
                                                {{ $item->item_status }}
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