@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-info">
                    <h4 class="m-b-0 text-white">Item Creation Form</h4>
                </div>

                <form method="POST" action="{{ route('item.store') }}" class="row g-3 m-2" novalidate>
                    @csrf

                    <div class="card-body col-md-12">
                        <h4 class="card-title">Item Info</h4>
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
                                    name="item_code"
                                    labelCaption="Item Code"
                                    extraClass="text-uppercase"
                                    required
                                />

                                <x-form.text-input 
                                    colSpan='col-md-9'
                                    type="text"
                                    name="item_name"
                                    labelCaption="Item Name"
                                    extraClass="text-capitalize"
                                    required
                                />

                                <x-form.select-input 
                                    colSpan='col-md-4'
                                    labelCaption="Item Type"
                                    name="item_type"
                                    :options="\App\Enums\ItemTypeEnum::options()"
                                    required
                                />

                                <x-form.select-input 
                                    colSpan='col-md-4'
                                    labelCaption="Item Has Sl No"
                                    name="item_has_serial_no"
                                    :options="['0' => 'No', '1' => 'Yes']"
                                    required
                                />

                                <x-form.text-input 
                                    colSpan='col-md-4'
                                    type="text"
                                    name="item_unit"
                                    labelCaption="Item Unit"
                                    extraClass="text-capitalize"
                                    {{-- required --}}
                                    receivedData="Piece"
                                />

                                <x-form.text-input 
                                    colSpan='col-md-3'
                                    type="number"
                                    name="item_reorder_quantity"
                                    labelCaption="Item Reorder Quantity"
                                    {{-- extraClass="text-capitalize" --}}
                                    {{-- required --}}
                                    receivedData="1"
                                />

                                <x-form.select-input 
                                    colSpan='col-md-3'
                                    labelCaption="Is Item Scrapable"
                                    name="is_item_scrapable"
                                    :options="['0' => 'No', '1' => 'Yes']"
                                    required
                                    selectedData="1"
                                />

                                <x-form.select-input 
                                    colSpan='col-md-3'
                                    labelCaption="Is Item Refundable"
                                    name="is_item_refundable"
                                    :options="['0' => 'No', '1' => 'Yes']"
                                    required
                                    selectedData="1"
                                />

                                <x-form.select-input 
                                    colSpan='col-md-3'
                                    labelCaption="Status"
                                    name="item_status"
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
                                        href="{{ route('item.index') }}">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection