@extends('Layouts.app')

@section('content')
    <div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h3 class="box-title m-t-40">Employee Info</h3>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td width="390">Employee Code</td>
                                <td> {{ $employee->employee_code }} </td>
                            </tr>
                            <tr>
                                <td>Employee Name</td>
                                <td> {{ $employee->employee_name }} </td>
                            </tr>
                            <tr>
                                <td>Designation</td>
                                <td> {{ $employee->employee_designation }} </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td> {{ $employee->employee_email }} </td>
                            </tr>
                            <tr>
                                <td>Mobile</td>
                                <td> {{ $employee->employee_mobile }} </td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td> 
                                    @if ($employee->employee_status == 'Active')
                                        <h3>
                                            {{-- <i class="fa fa-circle text-success"></i> --}}
                                            <span class="badge badge-success">
                                                {{ $employee->employee_status }}
                                            </span>
                                    </h3>
                                    @else
                                        <h3>
                                            {{-- <i class="fa fa-circle text-danger"></i> --}}
                                            <span class="badge badge-danger">
                                                {{ $employee->employee_status }}
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