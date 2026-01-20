@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="m-b-0 text-white">Employee Creation Form</h4>
                </div>

                <form method="POST" action="{{ route('employee.store') }}" class="row g-3 m-2" novalidate>
                    @csrf

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
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" 
                                            for="employee_code"><span class="text-danger">* </span> Employee Code</label>
                                        <input type="text" 
                                            id="employee_code" 
                                            class="form-control text-uppercase @error('employee_code') is-invalid @enderror" 
                                            name="employee_code" 
                                            value="{{ old('employee_code') }}" 
                                            autofocus
                                            required />
                                        <div class="invalid-feedback">
                                            @error('employee_code')
                                                {{ $message }}
                                            @enderror
                                        </div> 
                                    </div>
                                </div>

                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label class="control-label" 
                                            for="employee_name"><span class="text-danger">* </span> Employee Name</label>
                                        <input type="text" 
                                            id="employee_name" 
                                            class="form-control text-capitalize @error('employee_name') is-invalid @enderror" 
                                            name="employee_name" 
                                            value="{{ old('employee_name') }}" 
                                            required />
                                        <div class="invalid-feedback">
                                            @error('employee_name')
                                                {{ $message }}
                                            @enderror
                                        </div> 
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label" 
                                            for="employee_designation"><span class="text-danger">* </span> Designation</label>
                                        <input type="text" 
                                            id="employee_designation" 
                                            class="form-control text-capitalize @error('employee_designation') is-invalid @enderror" 
                                            name="employee_designation" 
                                            value="{{ old('employee_designation') }}" 
                                            required />
                                        <div class="invalid-feedback">
                                            @error('employee_designation')
                                                {{ $message }}
                                            @enderror
                                        </div> 
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="control-label" 
                                            for="employee_email"><span class="text-danger">* </span> Email</label>
                                        <input type="email" 
                                            id="employee_email" 
                                            class="form-control text-lowercase @error('employee_email') is-invalid @enderror" 
                                            name="employee_email" 
                                            value="{{ old('employee_email') }}" 
                                            required />
                                        <div class="invalid-feedback">
                                            @error('employee_email')
                                                {{ $message }}
                                            @enderror
                                        </div> 
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="control-label" 
                                            for="employee_mobile"><span class="text-danger">* </span> Mobile</label>
                                        <input type="number" 
                                            id="employee_mobile" 
                                            class="form-control @error('employee_mobile') is-invalid @enderror" 
                                            name="employee_mobile" 
                                            value="{{ old('employee_mobile') }}" 
                                            required />
                                        <div class="invalid-feedback">
                                            @error('employee_mobile')
                                                {{ $message }}
                                            @enderror
                                        </div> 
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="control-label" 
                                            for="employee_status"><span class="text-danger">* </span> Status</label>
                                        <select class="form-control" 
                                            name="employee_status" 
                                            id="employee_status">
                                            <option value="Active" {{ old('status') == 'Active' ? "selected" : ''}}>Active</option>
                                            <option value="Inactive" {{ old('status') == 'Inactive' ? "selected" : ''}}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
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