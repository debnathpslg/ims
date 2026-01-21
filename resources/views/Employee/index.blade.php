@extends('layouts.app')

@section('content')
    <div>
        <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered table-sm table-hover">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Employee Code</th>
                        <th>Employee Name</th>
                        <th>Designation</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($employees as $employee)
                    <tr>
                        <td class="text-center">{{ $employee->employee_code }}</td>
                        <td>
                            <a href="{{ route('employee.show', $employee) }}">
                                {{ $employee->employee_name }}
                            </a>
                        </td>
                        <td>{{ $employee->employee_designation }}</td>
                        <td>{{ $employee->employee_email }}</td>
                        <td>{{ $employee->employee_mobile }}</td>
                        <td class="text-white {{ $employee->employee_status == 'Active' ? 'bg-success' : 'bg-danger' }} text-center">{{ $employee->employee_status }}</td>
                        <td class="text-center">
                            <a href="{{ route('employee.show', $employee) }}">View</a>
                            <span> / </span>
                            Edit
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7">
                            <a type="button" class="btn btn-info btn-rounded" href="{{ route('employee.create') }}">Add New Contact</a>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection