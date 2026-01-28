@extends('Layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="m-b-0 text-white">Vendor Creation Form</h4>
                </div>

                <form method="POST" action="{{ route('vendor.store') }}" class="row g-3 m-2" novalidate>
                    @csrf

                    <div class="card-body col-md-12">
                        <h4 class="card-title">Vendor Info</h4>
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
                                    name="vendor_code"
                                    labelCaption="Vendor Code"
                                    extraClass="text-uppercase"
                                    required
                                />

                                <x-form.text-input 
                                    colSpan='col-md-9'
                                    type="text"
                                    name="vendor_name"
                                    labelCaption="Vendor Name"
                                    extraClass="text-capitalize"
                                    required
                                />

                                <x-form.text-input 
                                    colSpan='col-md-12'
                                    type="text"
                                    name="vendor_address"
                                    labelCaption="Address"
                                    extraClass="text-capitalize"
                                    {{-- required --}}
                                    receivedData="Siliguri"
                                />

                                <x-form.text-input 
                                    colSpan='col-md-4'
                                    type="text"
                                    name="vendor_city"
                                    labelCaption="City"
                                    extraClass="text-capitalize"
                                    required
                                    receivedData="Siliguri"
                                />

                                <x-form.text-input 
                                    colSpan='col-md-4'
                                    type="text"
                                    name="vendor_state"
                                    labelCaption="State"
                                    extraClass="text-capitalize"
                                    required
                                    receivedData="West Bengal"
                                />

                                <x-form.text-input 
                                    colSpan='col-md-4'
                                    type="number"
                                    name="vendor_pin"
                                    labelCaption="PIN"
                                    {{-- extraClass="text-capitalize" --}}
                                    {{-- required --}}
                                    receivedData="734001"
                                />

                                <x-form.text-input 
                                    colSpan='col-md-5'
                                    type="email"
                                    name="vendor_email"
                                    labelCaption="Email"
                                    extraClass="text-lowercase"
                                    required
                                />

                                <x-form.text-input 
                                    colSpan='col-md-2'
                                    type="number"
                                    name="vendor_mobile"
                                    labelCaption="Mobile"
                                    {{-- extraClass="" --}}
                                    {{-- required --}}
                                />

                                <x-form.text-input 
                                    colSpan='col-md-3'
                                    type="text"
                                    name="vendor_gst_no"
                                    labelCaption="GST No"
                                    extraClass="text-uppercase"
                                    {{-- required --}}
                                    {{-- receivedData="734001" --}}
                                />

                                <x-form.select-input 
                                    colSpan='col-md-2'
                                    labelCaption="Status"
                                    name="vendor_status"
                                    :options="\App\Enums\StatusEnum::options()"
                                    required
                                />
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="action-form">
                                <div class="form-group m-b-0 text-right">
                                    <button type="submit" class="btn btn-info waves-effect waves-light">Save</button>
                                    <a type="submit" 
                                        class="btn btn-dark waves-effect waves-light"
                                        href="{{ route('vendor.index') }}">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection