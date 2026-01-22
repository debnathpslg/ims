@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="m-b-0 text-white">Employee Alteration Form</h4>
                </div>

                <form method="POST" action="{{ route('employee.update', $employee) }}" class="row g-3 m-2" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="card-body col-md-12">
                        <h4 class="card-title">Employee Info</h4>
                        {{-- @if($errors->any())
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif --}}
                    </div>
                    <hr>
                    <div class="form-body col-md-12">
                        <div class="card-body">
                            <div class="row p-t-20">
                                <x-form.text-input 
                                    colSpan='col-md-3'
                                    type="text"
                                    name="employee_code"
                                    labelCaption="Employee Code"
                                    extraClass="text-uppercase"
                                    required
                                    :receivedData="$employee->employee_code"
                                />

                                <x-form.text-input 
                                    colSpan='col-md-9'
                                    type="text"
                                    name="employee_name"
                                    labelCaption="Employee Name"
                                    extraClass="text-capitalize"
                                    required
                                    :receivedData="$employee->employee_name"
                                />

                                <x-form.text-input 
                                    colSpan='col-md-2'
                                    type="text"
                                    name="employee_designation"
                                    labelCaption="Designation"
                                    extraClass="text-capitalize"
                                    required
                                    :receivedData="$employee->employee_designation"
                                />

                                <x-form.text-input 
                                    colSpan='col-md-5'
                                    type="email"
                                    name="employee_email"
                                    labelCaption="Email"
                                    extraClass="text-lowercase"
                                    required
                                    :receivedData="$employee->employee_email"
                                />

                                <x-form.text-input 
                                    colSpan='col-md-3'
                                    type="number"
                                    name="employee_mobile"
                                    labelCaption="Mobile"
                                    extraClass=""
                                    required
                                    :receivedData="$employee->employee_mobile"
                                />

                                <x-form.select-input 
                                    colSpan='col-md-2'
                                    labelCaption="Status"
                                    name="employee_status"
                                    :options="\App\Enums\StatusEnum::options()"
                                    required
                                    :selectedData="$employee->employee_status"
                                />
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="action-form">
                                <div class="form-group m-b-0 text-right">
                                    <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                    <a type="submit" 
                                        class="btn btn-dark waves-effect waves-light"
                                        href="{{ route('employee.index') }}">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection