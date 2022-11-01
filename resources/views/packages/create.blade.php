@extends('adminlte::page') @section('content')
<div class="container mt-2">
    <div class="card card-outline card-primary">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left mb-2" >
                        <h2 style="display:inline-block">Add New Package</h2>
                        <a
                            class="btn btn-secondary"
                            href="{{ route('packages.index') }}"
                            style="float:right">
                            Back</a
                        >
                    </div>
                </div>
            </div>
            @if(session('status'))
            <div class="alert alert-success mb-1 mt-1">
                {{ session("status") }}
            </div>
            @endif
            
            <br id="bre">

            <div class="alert alert-danger" id="err" role="alert" >
                {{-- {{ session("status") }} --}}
                
            </div>
            <div class="alert alert-success" id="succ" role="alert">
                {{-- <p>{{ $message }}</p> --}}
            </div>
            <form
                action="{{ route('packages.store') }}"
                method="POST"
                enctype="multipart/form-data"
                name="packageForm"
            >
                @csrf
                <br>
                    <h5>Package Details:</h5>
                    <div class="form-row">
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <strong>Package ID:</strong>
                                <input
                                    type="text"
                                    name="packageID"
                                    class="form-control"
                                    placeholder="Employee ID"
                                    value="<?php use App\Http\Controllers\PackageController;
                                    echo PackageController::getNextID(); ?>"
                                    readonly
                                />
                                @error('packageID')
                                <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <strong>Tracking Number:</strong>
                                <input
                                    type="text"
                                    name="trackingNumber"
                                    class="form-control"
                                    placeholder="Tracking Number"
                                    value="<?php echo PackageController::getNextTrackingNumber(); ?>"
                                    readonly
                                />
                                @error('trackingNumber')
                                <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-row align-items-center">

                        <div class="col-xs-12 col-sm-12 col-md-2    ">
                            <div class="form-group">
                                <strong>Package Length:</strong>
                                <div class="input-group">
                                    <input
                                        type="number"
                                        name="length"                                        
                                        id="length"
                                        class="form-control numeric"
                                        placeholder="Length"
                                        min="1"
                                    />
                                    <div class="input-group-append">
                                        <div class="input-group-text">cm</div>
                                    </div>
                                </div>
                                @error('length')
                                <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-2    ">
                            <div class="form-group">
                                <strong>Package Width:</strong>
                                <div class="input-group">
                                    <input
                                        type="number"
                                        id="width"
                                        name="width"
                                        class="form-control numeric"
                                        placeholder="Width"
                                        min="1"
                                    />
                                    <div class="input-group-append">
                                        <div class="input-group-text">cm</div>
                                    </div>
                                </div>
                                @error('width')
                                <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-2    ">
                            <div class="form-group">
                                <strong>Package Height:</strong>
                                <div class="input-group">
                                    <input
                                        type="number"
                                        name="height"
                                        id="height"
                                        class="form-control numeric"
                                        placeholder="Height"
                                        min="1"
                                    />
                                    <div class="input-group-append">
                                        <div class="input-group-text">cm</div>
                                    </div>
                                </div>
                                @error('height')
                                <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-2    ">
                            <div class="form-group">
                                <strong>Package Weight:</strong>
                                <div class="input-group">
                                    <input
                                        {{-- type='number' step='0.001' max="999999.999" --}}
                                        name="weight"
                                        id="weight"
                                        class="form-control numeric"
                                        placeholder="Weight"
                                        min="1"
                                    />
                                    <div class="input-group-append">
                                        <div class="input-group-text">kg</div>
                                    </div>
                                </div>
                                @error('weight')
                                <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group form-check">
                                <input
                                    id="isHazMat"
                                    type="checkbox"
                                    name="isHazMat"
                                    class="form-check-input"
                                />
                                <label for="isHazMat" class="form-check-label">
                                    <strong>Is a Hazardous Material</strong>
                                </label>
                        
                            </div>
                        </div> --}}
                    </div>

                    <hr>
                    <h5>Sender and Receiver Details:</h5>

                    <div class="form-row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Sender Address and Details:</strong>
                                <div class="input-group mb-3">
                                    <input
                                        type="text"
                                        name="senderDetails"
                                        class="form-control"
                                        aria-describedby="button-addon2"
                                        aria-label="Enter Sender Address and Details"
                                        placeholder="Enter Sender Address and Details"
                                        readonly
                                    />
                                    
                                    <div class="input-group-append">
                                    <button class="btn btn-outline-primary" type="button" id="button-addon2" onclick="openSenderModal()">Add Sender Details</button>
                                    </div>
                                    
                                </div>
                                <input type="hidden" name="senderID"/>
                                @error('senderDetails')
                                <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-xs-12 col-sm-12 col-md-12    ">
                            <div class="form-group">
                                <strong>Receiver Address and Details:</strong>
                                <div class="input-group">
                                    <input
                                        type="text"
                                        name="receiverDetails"
                                        class="form-control"
                                        aria-describedby="button-addon1"
                                        aria-label="Enter Receiver Address and Details"
                                        placeholder="Enter Receiver Address and Details"
                                        readonly
                                    />
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary" type="button" id="button-addon1" onclick="openRecModal()">Add Receiver Details</button>
                                    </div>
                                </div>
                                <input type="hidden" name="receiverID"/>

                                @error('receiverDetails')
                                <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    

                    <hr>
                        <h5>Carrier Details:</h5>
                        <!-- Button trigger modal -->
                        <button type="button" onclick="myFunction()" id="sampleBtn" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Search Carrier
                        </button>
                    
                    <div class="form-row">
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <strong>Carrier ID:</strong>
                                <input
                                    type="text"
                                    name="carrierID"
                                    id="carrierID"
                                    class="form-control"
                                    placeholder="Carrier ID"
                                    readonly
                                />
                                @error('carrierID')
                                <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <strong>Carrier Name:</strong>
                                <input
                                    type="text"
                                    name="carrierName"
                                    id="carrierName"
                                    class="form-control"
                                    placeholder="Carrier Name"
                                    readonly
                                />
                                @error('carrierName')
                                <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <strong>Carrier Contact Number:</strong>
                                <input
                                    type="text"
                                    name="carrierNumber"
                                    id="carrierNumber"
                                    class="form-control"
                                    placeholder="Carrier Contact Number"
                                    readonly
                                />
                                @error('carrierNumber')
                                <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <button type="button" onclick="submitForm()" class="btn btn-success btn-block">
                            Submit
                        </button>
                    </div>
                    
                    {{-- Add Sender Modal --}}
                    <div class="modal fade" id="senderModal" tabindex="-1" role="dialog" aria-labelledby="senderModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="modal-title">
                                            <h5>Enter Sender Address and Details</h5>
                                            <button type="button" onclick="selectSenderCustomer()" id="senderBtn" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#customerModal">
                                                Search Sender
                                            </button>
                                        </div>
                                        
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" id="senderModalBody">
                                        <form id="senderForm"
                                            {{-- action="{{ route('customers.store') }}"
                                            method="POST"
                                            enctype="multipart/form-data" --}}
                                            >
                                            <fieldset class="scheduler-border">
                                                <legend class="scheduler-border"><i><h5>Sender Details</h5></i></legend>
                                                <div class="form-row">
                                                    <div class="col-auto">
                                                        <div class="form-group">
                                                            <strong>Last Name:</strong>
                                                            <input
                                                                type="text"
                                                                name="lastName"
                                                                class="form-control"
                                                                placeholder="Last Name"
                                                            />
                                                            @error('lastName')
                                                            <div class="alert alert-danger mt-1 mb-1">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="form-group">
                                                            <strong>First Name:</strong>
                                                            <input
                                                                type="text"
                                                                name="firstName"
                                                                class="form-control"
                                                                placeholder="First Name"
                                                            />
                                                            @error('firstName')
                                                            <div class="alert alert-danger mt-1 mb-1">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="form-group">
                                                            <strong>Middle Name:</strong>
                                                            <input
                                                                type="text"
                                                                name="middleName"
                                                                class="form-control"
                                                                placeholder="Middle Name"
                                                            />
                                                            @error('middleName')
                                                            <div class="alert alert-danger mt-1 mb-1">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-auto">
                                                        <div class="form-group">
                                                            <strong>Contact Number:</strong>
                                                            <input
                                                                type="text"
                                                                name="contactNumber"
                                                                id="contactNumber"
                                                                class="form-control"
                                                                placeholder="Contact Number"
                                                            />
                                                            @error('contactNumber')
                                                            <div class="alert alert-danger mt-1 mb-1">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset class="scheduler-border">
                                                <legend class="scheduler-border"><i><h5>Sender Address</h5></i></legend>
                                                <div class="form-row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <strong>Unit/Floor Number:</strong>
                                                            <input
                                                                type="text"
                                                                name="floor_unit"
                                                                class="form-control"
                                                                placeholder="Unit/Floor Number"
                                                            />
                                                            @error('floor_unit')
                                                            <div class="alert alert-danger mt-1 mb-1">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <strong>Street Address:</strong>
                                                            <input
                                                                type="text"
                                                                name="streetAddress"
                                                                class="form-control"
                                                                placeholder="Street Address"
                                                            />
                                                            @error('streetAddress')
                                                            <div class="alert alert-danger mt-1 mb-1">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <strong>Province:</strong>
                                                            <select
                                                                type="text"
                                                                name="province"
                                                                id="province"
                                                                class="form-control"
                                                                placeholder="Select..."
                                                            >
                                                            @php
                                                                use App\Http\Controllers\PhilProvinceController;
                                                                $provinces = PhilProvinceController::getProvinces();   
                                                            @endphp
                                                            <option selected>Select...</option>
                                                            @foreach ($provinces as $province)
                                                                <option onchange="setCities()" value="{{ $province['provCode'] }}">{{ $province['provDesc'] }}</option>
                                                            @endforeach
                                                            </select>
                                                            @error('province')
                                                            <div class="alert alert-danger mt-1 mb-1">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <script type="text/javascript">
                                                    
                                                        document.getElementById('province').onchange = function() {
                                                                var provinceID = $(this).val();
                                                                console.log('province changed');
                                                                if(provinceID) {
                                                                    $.ajax({
                                                                        url: '/myform/ajax/'+provinceID,
                                                                        type: "GET",
                                                                        dataType: "json",
                                                                        success:function(data) {
                                                                            console.log(data);
                                                                            $('select[name="city_municipality"]').empty();
                                                                            $('select[name="city_municipality"]').append('<option>Select...</option>');
                                                                            $.each(data, function(key, value) {
                                                                                $('select[name="city_municipality"]').append('<option value="'+ value.citymunCode +'">'+ value.citymunDesc +'</option>');
                                                                            });
                                                                        }
                                                                    });
                                                                }else{
                                                                    $('select[name="city_municipality"]').empty();
                                                                }
                                                            };
                                                    </script>

                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <strong>City/Municipality:</strong>
                                                            <select
                                                                type="text"
                                                                name="city_municipality"
                                                                id="city_mun"
                                                                class="form-control"
                                                                placeholder="Select..."
                                                            >
                                                            <option selected>Select...</option>
                                                                {{-- <option value="{{ $city['citymunDesc'] }}">{{ $city['citymunDesc'] }}</option> --}}
                                                            </select>
                                                            @error('city_municipality')
                                                            <div class="alert alert-danger mt-1 mb-1">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <script>
                                                        document.getElementById('city_mun').onchange = function() {
                                                                var cityID = $(this).val();
                                                                console.log('city changed');
                                                                if(cityID) {
                                                                    $.ajax({
                                                                        url: '/getBarangays/ajax/'+cityID,
                                                                        type: "GET",
                                                                        dataType: "json",
                                                                        success:function(data) {
                                                                            console.log(data);
                                                                            $('select[name="barangay"]').empty();
                                                                            $('select[name="barangay"]').append('<option>Select...</option>');
                                                                            $.each(data, function(key, value) {
                                                                                $('select[name="barangay"]').append('<option value="'+ value.brgyCode +'">'+ value.brgyDesc +'</option>');
                                                                            });
                                                                        }
                                                                    });
                                                                }else{
                                                                    $('select[name="barangay"]').empty();
                                                                }
                                                            }; 
                                                    </script>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <strong>Barangay:</strong>
                                                            <select
                                                                type="text"
                                                                name="barangay"
                                                                id="barangay"
                                                                class="form-control"
                                                                placeholder="Select..."
                                                            >
                                                            
                                                            <option selected>Select...</option>
                                                            </select>
                                                            @error('barangay')
                                                            <div class="alert alert-danger mt-1 mb-1">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <strong>Zip Code:</strong>
                                                            <input
                                                                type="text"
                                                                name="zipCode"
                                                                class="form-control"
                                                                placeholder="Zip Code"
                                                            />
                                                            @error('zipCode')
                                                            <div class="alert alert-danger mt-1 mb-1">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" onclick="submitCustomerDetails()" class="btn btn-primary float-end">
                                            Save Sender Information
                                        </button>
                                        <button type="button" class="btn btn-secondary float-end" data-dismiss="modal" aria-label="Close">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {{-- End of Add Sender Modal --}}

                    {{-- Add Receiver Modal --}}

                        <div class="modal fade" id="receiverModal" tabindex="-1" role="dialog" aria-labelledby="receiverModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="modal-title">
                                            <h5>Enter Receiver Address and Details</h5>
                                            <button type="button" onclick="selectCustomer()" id="sampleBtn" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#customerModal">
                                                Search Receiver
                                            </button>
                                        </div>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" id="receiverModalBody">
                                        <form id="receiverForm"
                                            {{-- action="{{ route('customers.store') }}"
                                            method="POST"
                                            enctype="multipart/form-data" --}}
                                            >
                                            <fieldset class="scheduler-border">
                                                <legend class="scheduler-border"><i><h5>Receiver Details</h5></i></legend>
                                                <div class="form-row">
                                                    <div class="col-auto">
                                                        <div class="form-group">
                                                            <strong>Last Name:</strong>
                                                            <input
                                                                type="text"
                                                                name="reclastName"
                                                                class="form-control"
                                                                placeholder="Last Name"
                                                            />
                                                            @error('reclastName')
                                                            <div class="alert alert-danger mt-1 mb-1">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="form-group">
                                                            <strong>First Name:</strong>
                                                            <input
                                                                type="text"
                                                                name="recfirstName"
                                                                class="form-control"
                                                                placeholder="First Name"
                                                            />
                                                            @error('recfirstName')
                                                            <div class="alert alert-danger mt-1 mb-1">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="form-group">
                                                            <strong>Middle Name:</strong>
                                                            <input
                                                                type="text"
                                                                name="recmiddleName"
                                                                class="form-control"
                                                                placeholder="Middle Name"
                                                            />
                                                            @error('recmiddleName')
                                                            <div class="alert alert-danger mt-1 mb-1">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="col-auto">
                                                        <div class="form-group">
                                                            <strong>Contact Number:</strong>
                                                            <input
                                                                type="text"
                                                                name="reccontactNumber"
                                                                id="reccontactNumber"
                                                                class="form-control"
                                                                placeholder="Contact Number"
                                                            />
                                                            @error('reccontactNumber')
                                                            <div class="alert alert-danger mt-1 mb-1">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset class="scheduler-border">
                                                <legend class="scheduler-border"><i><h5>Receiver Address</h5></i></legend>
                                                <div class="form-row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <strong>Unit/Floor Number:</strong>
                                                            <input
                                                                type="text"
                                                                name="recfloor_unit"
                                                                class="form-control"
                                                                placeholder="Unit/Floor Number"
                                                            />
                                                            @error('recfloor_unit')
                                                            <div class="alert alert-danger mt-1 mb-1">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <strong>Street Address:</strong>
                                                            <input
                                                                type="text"
                                                                name="recstreetAddress"
                                                                class="form-control"
                                                                placeholder="Street Address"
                                                            />
                                                            @error('recstreetAddress')
                                                            <div class="alert alert-danger mt-1 mb-1">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <strong>Province:</strong>
                                                            <select
                                                                type="text"
                                                                name="recprovince"
                                                                id="recprovince"
                                                                class="form-control"
                                                                placeholder="Select..."
                                                            >
                                                            @php
                                                                $provinces = PhilProvinceController::getProvinces();   
                                                            @endphp
                                                            <option selected>Select...</option>
                                                            @foreach ($provinces as $province)
                                                                <option onchange="setCities()" value="{{ $province['provCode'] }}">{{ $province['provDesc'] }}</option>
                                                            @endforeach
                                                            </select>
                                                            @error('recprovince')
                                                            <div class="alert alert-danger mt-1 mb-1">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <script type="text/javascript">
                                                        document.getElementById('recprovince').onchange = function() {
                                                                var provinceID = $(this).val();
                                                                console.log('province changed');
                                                                if(provinceID) {
                                                                    $.ajax({
                                                                        url: '/myform/ajax/'+provinceID,
                                                                        type: "GET",
                                                                        dataType: "json",
                                                                        success:function(data) {
                                                                            console.log(data);
                                                                            $('select[name="reccity_municipality"]').empty();
                                                                            $('select[name="reccity_municipality"]').append('<option>Select...</option>');
                                                                            $.each(data, function(key, value) {
                                                                                $('select[name="reccity_municipality"]').append('<option value="'+ value.citymunCode +'">'+ value.citymunDesc +'</option>');
                                                                            });
                                                                        }
                                                                    });
                                                                }else{
                                                                    $('select[name="reccity_municipality"]').empty();
                                                                }
                                                            };
                                                    </script>

                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <strong>City/Municipality:</strong>
                                                            <select
                                                                type="text"
                                                                name="reccity_municipality"
                                                                id="reccity_mun"
                                                                class="form-control"
                                                                placeholder="Select..."
                                                            >
                                                            <option selected>Select...</option>
                                                                {{-- <option value="{{ $city['citymunDesc'] }}">{{ $city['citymunDesc'] }}</option> --}}
                                                            </select>
                                                            @error('reccity_municipality')
                                                            <div class="alert alert-danger mt-1 mb-1">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <script>
                                                        document.getElementById('reccity_mun').onchange = function() {
                                                                var cityID = $(this).val();
                                                                console.log('city changed');
                                                                if(cityID) {
                                                                    $.ajax({
                                                                        url: '/getBarangays/ajax/'+cityID,
                                                                        type: "GET",
                                                                        dataType: "json",
                                                                        success:function(data) {
                                                                            console.log(data);
                                                                            $('select[name="recbarangay"]').empty();
                                                                            $('select[name="recbarangay"]').append('<option>Select...</option>');
                                                                            $.each(data, function(key, value) {
                                                                                $('select[name="recbarangay"]').append('<option value="'+ value.brgyCode +'">'+ value.brgyDesc +'</option>');
                                                                            });
                                                                        }
                                                                    });
                                                                }else{
                                                                    $('select[name="recbarangay"]').empty();
                                                                }
                                                            }; 
                                                    </script>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <strong>Barangay:</strong>
                                                            <select
                                                                type="text"
                                                                name="recbarangay"
                                                                id="recbarangay"
                                                                class="form-control"
                                                                placeholder="Select..."
                                                            >
                                                            
                                                            <option selected>Select...</option>
                                                            </select>
                                                            @error('recbarangay')
                                                            <div class="alert alert-danger mt-1 mb-1">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <strong>Zip Code:</strong>
                                                            <input
                                                                type="text"
                                                                name="reczipCode"
                                                                class="form-control"
                                                                placeholder="Zip Code"
                                                            />
                                                            @error('reczipCode')
                                                            <div class="alert alert-danger mt-1 mb-1">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" onclick="submitReceiverDetails()" class="btn btn-primary float-end">
                                            Save Receiver Information
                                        </button>
                                        <button type="button" class="btn btn-secondary float-end" data-dismiss="modal" aria-label="Close">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {{-- End of Add Receiver Modal --}}

                        <style>
                            fieldset.scheduler-border {
                                border: 1px groove #ddd !important;
                                padding: 0 1.4em 1.4em 1.4em !important;
                                margin: 0 0 1.5em 0 !important;
                                -webkit-box-shadow:  0px 0px 0px 0px #000;
                                        box-shadow:  0px 0px 0px 0px #000;
                            }

                            legend.scheduler-border {
                                width:inherit; /* Or auto */
                                padding:0 10px; /* To give a bit of padding on the left and right */
                                border-bottom:none;
                            }
                        </style>

                        <script>
                            function submitCustomerDetails(){
                                event.preventDefault();

                                let lastName = $('input[name="lastName"]').val();
                                let firstName = $('input[name="firstName"]').val();
                                let middleName = $('input[name="middleName"]').val();
                                let contactNumber = $('input[name="contactNumber"]').val();
                                let floor_unit = $('input[name="floor_unit"]').val();
                                let streetAddress = $('input[name="streetAddress"]').val();
                                let province = $('select[name="province"]').val();
                                let city_municipality = $('select[name="city_municipality"]').val();
                                let barangay = $('select[name="barangay"]').val();
                                let zipCode = $('input[name="zipCode"]').val();

                                $.ajax({
                                    url: "/save-customer",
                                    type: "POST",
                                    data:{
                                        "_token": "{{ csrf_token() }}",
                                        lastName: lastName,
                                        firstName: firstName,
                                        middleName: middleName,
                                        contactNumber: contactNumber,
                                        floor_unit: floor_unit,
                                        streetAddress: streetAddress,
                                        province: province,
                                        city_municipality: city_municipality,
                                        barangay: barangay,
                                        zipCode: zipCode                                        
                                    },
                                    success:function(response){
                                        console.log(response);
                                        if(response != 'error')
                                        {
                                            $('input[name="senderDetails"]').val(response[1]);
                                            $('input[name="senderID"]').val(response[0]);
                                            
                                            $('#succ').show();
                                            $('#bre').show();
                                            $("#succ").html("Sender saved successfully!");
                                            $("#bre").fadeTo(2000, 500).slideUp(500, function(){
                                                $("#bre").slideUp(500);
                                            });
                                            $("#succ").fadeTo(2000, 500).slideUp(500, function(){
                                                $("#succ").slideUp(500);
                                            });
                                        }else{
                                            $('#err').show();
                                            $('#bre').show();
                                            $("#err").html("Customer already exists. Please select from existing customers.");
                                            $("#bre").fadeTo(2000, 500).slideUp(500, function(){
                                                $("#bre").slideUp(500);
                                            });
                                            $("#err").fadeTo(2000, 500).slideUp(500, function(){
                                                $("#err").slideUp(500);
                                            });

                                            $('#senderForm').trigger('reset');
                                        }
                                        $('#senderModal').modal('hide');
                                    }
                                });
                            };

                            function submitReceiverDetails(){
                                // e.preventDefault();

                                let lastName = $('input[name="reclastName"]').val();
                                let firstName = $('input[name="recfirstName"]').val();
                                let middleName = $('input[name="recmiddleName"]').val();
                                let contactNumber = $('input[name="reccontactNumber"]').val();
                                let floor_unit = $('input[name="recfloor_unit"]').val();
                                let streetAddress = $('input[name="recstreetAddress"]').val();
                                let province = $('select[name="recprovince"]').val();
                                let city_municipality = $('select[name="reccity_municipality"]').val();
                                let barangay = $('select[name="recbarangay"]').val();
                                let zipCode = $('input[name="reczipCode"]').val();

                                $.ajax({
                                    url: "/save-customer",
                                    type: "POST",
                                    data:{
                                        "_token": "{{ csrf_token() }}",
                                        lastName: lastName,
                                        firstName: firstName,
                                        middleName: middleName,
                                        contactNumber: contactNumber,
                                        floor_unit: floor_unit,
                                        streetAddress: streetAddress,
                                        province: province,
                                        city_municipality: city_municipality,
                                        barangay: barangay,
                                        zipCode: zipCode                                        
                                    },
                                    success:function(response){
                                        console.log(response);
                                        if(response != 'error')
                                        {
                                            $('input[name="receiverDetails"]').val(response[1]);
                                            $('input[name="receiverID"]').val(response[0]);
                                            
                                            $('#succ').show();
                                            $('#bre').show();
                                            $("#succ").html("Receiver saved successfully!");
                                            $("#bre").fadeTo(2000, 500).slideUp(500, function(){
                                                $("#bre").slideUp(500);
                                            });
                                            $("#succ").fadeTo(2000, 500).slideUp(500, function(){
                                                $("#succ").slideUp(500);
                                            });
                                        }else{
                                            $('#err').show();
                                            $('#bre').show();
                                            $("#err").html("Customer already exists. Please select from existing customers.");
                                            $("#bre").fadeTo(2000, 500).slideUp(500, function(){
                                                $("#bre").slideUp(500);
                                            });
                                            $("#err").fadeTo(2000, 500).slideUp(500, function(){
                                                $("#err").slideUp(500);
                                            });
                                            $('#receiverForm').trigger('reset');

                                        }
                                        $('#receiverModal').modal('hide');

                                    }
                                });
                            };
                        </script>


                    {{-- Search Carrier Modal  --}}

                    <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title">
                                    <h5>Select a Carrier</h5>
                                </div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="smallBody">
                                {{-- <div class="input-group col-md-5">
                                    <input class="form-control" id="myInput" type="text" onkeyup="searchCarrier()" placeholder="Search for carrier">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class="fas fa-search"></i></div>
                                    </div>
                                </div>
                                <br> --}}
                                <div>
                                    <table
                                        id="employees"
                                        class="table table-hover table-bordered dt-responsive display text-center"
                                    >
                                        <thead>
                                            <tr>
                                                <th>Carrier ID</th>
                                                <th width="200px">Carrier Name</th>
                                                <th width="150px">Carrier Contact Number</th>
                                                <th width="70px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php use App\Http\Controllers\EmployeeController;
                                                  $employees = EmployeeController::getCarriers(); ?>
                                            @if (count($employees) <= 0)
                                                <tr>
                                                    <td colspan="9" class="text-center"> No Carriers Yet </td>
                                                </tr>
                                            @endif
                                            @foreach ($employees as $employee)
                                            <tr>
                                                <td>{{ $employee->employeeID }}</td>
                                                <td>{{ $employee->firstName.' '.$employee->lastName }}</td>
                                                <td>{{ $employee->contactNumber }}</td>
                                                <td >
                                                        <a
                                                            class="btn btn-primary"
                                                            data-dismiss="modal"
                                                            onclick="selectCarrier('{{ $employee->employeeID }}', 
                                                                    '{{ $employee->firstName.' '.$employee->lastName }}',
                                                                    '{{ $employee->contactNumber }}')"
                                                            ><small>Select</small></a
                                                        >
                                                </td>
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>

                                    {{-- <div class="d-flex justify-content-end">
                                        {{ $employees->links() }}
                                    </div>  --}}
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary float-end" data-dismiss="modal" aria-label="Close">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- End of Search Carrier Modal  --}}


                {{-- Search Sender Modal  --}}

                <div class="modal fade" id="senderCustModal" tabindex="-1" role="dialog" aria-labelledby="senderCustModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title">
                                    <h5>Select a Customer</h5>
                                </div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="senderCustModalBody">
                                {{-- <div class="input-group col-md-5">
                                    <input class="form-control" id="searchCust" type="text" onkeyup="searchCust()" placeholder="Search for carrier">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class="fas fa-search"></i></div>
                                    </div>
                                </div>
                                <br> --}}
                                <div>
                                    <table
                                        id="customers"
                                        class="table table-hover table-bordered dt-responsive display text-center"
                                    >
                                        <thead>
                                            <tr>
                                                <th width="100px">Customer Name</th>
                                                <th width="100px">Contact Number</th>
                                                <th width="150px">Customer Address</th>
                                                <th width="50px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php use App\Http\Controllers\CustomerController;
                                                  $customers = CustomerController::getCustomers(); ?>
                                            @if (count($customers) <= 0)
                                                <tr>
                                                    <td colspan="9" class="text-center"> No Customers Yet </td>
                                                </tr>
                                            @endif
                                            @foreach ($customers as $customer)
                                            <tr>
                                                <td>{{ $customer->firstName.' '.$customer->lastName }}</td>
                                                <td>{{ $customer->contactNumber }}</td>
                                                <td>{{ $address = $customer->floor_unit.', '.$customer->streetAddress.', '.$customer->brgyDesc.', '. $customer->citymunDesc.', '.$customer->provDesc }}</td>
                                                <td>
                                                        <a
                                                            class="btn btn-primary"
                                                            data-dismiss="modal"
                                                            onclick="selectSender('{{ $customer->id }}', 
                                                                    '{{ $customer->firstName.' '.$customer->lastName }}',
                                                                    '{{ $customer->contactNumber }}', '{{ $address }}')"
                                                            ><small>Select</small></a
                                                        >
                                                </td>
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>

                                    {{-- <div class="d-flex justify-content-end">
                                        {{ $customers->links() }}
                                    </div>  --}}
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary float-end" data-dismiss="modal" aria-label="Close">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End of Search Sender Modal  --}}


                {{-- Search Receiver Modal  --}}
                <div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="modal-title">
                                    <h5>Select a Customer</h5>
                                </div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="customerModalBody">
                                {{-- <div class="input-group col-md-5">
                                    <input class="form-control" id="searchCust" type="text" onkeyup="searchCust()" placeholder="Search for carrier">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><i class="fas fa-search"></i></div>
                                    </div>
                                </div>
                                <br> --}}
                                <div class="table-responsive">
                                    <table
                                        id="customers-rec"
                                        class="table table-hover table-bordered dt-responsive display text-center"
                                    >
                                        <thead>
                                            <tr>
                                                <th width="100px">Customer Name</th>
                                                <th width="100px">Contact Number</th>
                                                <th width="150px">Customer Address</th>
                                                <th width="50px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                  $customers = CustomerController::getCustomers(); ?>
                                            @if (count($customers) <= 0)
                                                <tr>
                                                    <td colspan="9" class="text-center"> No Customers Yet </td>
                                                </tr>
                                            @endif
                                            @foreach ($customers as $customer)
                                            <tr>
                                                <td>{{ $customer->firstName.' '.$customer->lastName }}</td>
                                                <td>{{ $customer->contactNumber }}</td>
                                                <td>{{ $address = $customer->floor_unit.', '.$customer->streetAddress.', '.$customer->brgyDesc.', '. $customer->citymunDesc.', '.$customer->provDesc }}</td>
                                                <td>
                                                        <a
                                                            class="btn btn-primary"
                                                            data-dismiss="modal"
                                                            onclick="selectReceiver('{{ $customer->id }}', 
                                                                    '{{ $customer->firstName.' '.$customer->lastName }}',
                                                                    '{{ $customer->contactNumber }}', '{{ $address }}')"
                                                            ><small>Select</small></a
                                                        >
                                                </td>
                                            </tr>
                                            @endforeach
                                            
                                        </tbody>
                                    </table>

                                    {{-- <div class="d-flex justify-content-end">
                                        {{ $customers->links() }}
                                    </div>  --}}
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary float-end" data-dismiss="modal" aria-label="Close">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End of Search Receiver Modal  --}}
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
                <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
                <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
                <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        
                <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" type="text/javascript"></script>
                <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
                <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
                <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.bootstrap5.min.js"></script>
                <script src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>
                <script src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>
                <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.print.min.js"></script>
                <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
                <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
                    <script>
                        $(document).ready(function() {	
                            $('#err').hide();
                            $('#succ').hide();
                            $('#bre').hide();
                            // setInputFilter(document.getElementById("weight"), function(value) {
                            //     return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
                            // }, "Only digits and '.' are allowed");
                            // setInputFilter(document.getElementById("width"), function(value) {
                            //     return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
                            // }, "Only digits and '.' are allowed");
                            // setInputFilter(document.getElementById("length"), function(value) {
                            //     return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
                            // }, "Only digits and '.' are allowed");
                            // setInputFilter(document.getElementById("height"), function(value) {
                            //     return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
                            // }, "Only digits and '.' are allowed");

                            // $("#weight").forceNumeric();

                            // $('#weight').bind('input paste', function(){
                            //     this.value = this.value.replace(/[^\d*\.?\d+$]/g,'');
                            // });

                            $(".numeric").keydown(function (event) {
                            if (event.shiftKey == true) {
                                event.preventDefault();
                            }

                            if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {

                            } else {
                                event.preventDefault();
                            }

                            if($(this).val().indexOf('.') !== -1 && event.keyCode == 190 )
                                event.preventDefault();

                            });
                        });

                        // $(function () {
                        //     $("input[id*='txtQty']").keydown(function (event) {


                        //         if (event.shiftKey == true) {
                        //             event.preventDefault();
                        //         }

                        //         if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {

                        //         } else {
                        //             event.preventDefault();
                        //         }
                                
                        //         if($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
                        //             event.preventDefault();

                        //     });
                        // });


                        // jQuery.fn.forceNumeric = function () {
                        //     return this.each(function () {
                        //         $(this).keydown(function (e) {
                        //             var key = e.which || e.keyCode;

                        //             if (!e.shiftKey && !e.altKey && !e.ctrlKey &&
                        //             // numbers   
                        //                 key >= 48 && key <= 57 ||
                        //             // Numeric keypad
                        //                 key >= 96 && key <= 105 ||
                        //             // comma, period and minus, . on keypad
                        //                 key == 190 || key == 188 || key == 109 || key == 110 ||
                        //             // Backspace and Tab and Enter
                        //                 key == 8 || key == 9 || key == 13 ||
                        //             // Home and End
                        //                 key == 35 || key == 36 ||
                        //             // left and right arrows
                        //                 key == 37 || key == 39 ||
                        //             // Del and Ins
                        //                 key == 46 || key == 45)
                        //                 return true;

                        //             return false;
                        //         });
                        //     });
                        // }

                        // function setInputFilter(textbox, inputFilter, errMsg) {
                        //     ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop", "focusout"].forEach(function(event) {
                        //         textbox.addEventListener(event, function(e) {
                        //         if (inputFilter(this.value)) {
                        //             // Accepted value
                        //             if (["keydown","mousedown","focusout"].indexOf(e.type) >= 0){
                        //             this.classList.remove("input-error");
                        //             this.setCustomValidity("");
                        //             }
                        //             this.oldValue = this.value;
                        //             this.oldSelectionStart = this.selectionStart;
                        //             this.oldSelectionEnd = this.selectionEnd;
                        //         } else if (this.hasOwnProperty("oldValue")) {
                        //             // Rejected value - restore the previous one
                        //             this.classList.add("input-error");
                        //             this.setCustomValidity(errMsg);
                        //             this.reportValidity();
                        //             this.value = this.oldValue;
                        //             this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                        //         } else {
                        //             // Rejected value - nothing to restore
                        //             this.value = "";
                        //         }
                        //         });
                        //     });
                        //     };
                        function searchCarrier() {
                            // Declare variables
                            var input, filter, table, tr, td, i, txtValue;
                            input = document.getElementById("myInput");
                            filter = input.value.toUpperCase();
                            table = document.getElementById("employees");
                            tr = table.getElementsByTagName("tr");

                            // Loop through all table rows, and hide those who don't match the search query
                            for (i = 0; i < tr.length; i++) {
                                td = tr[i].getElementsByTagName("td")[1];
                                if (td) {
                                txtValue = td.textContent || td.innerText;
                                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                    tr[i].style.display = "";
                                } else {
                                    tr[i].style.display = "none";
                                }
                                }
                            }
                        };

                        function searchCust() {
                            // Declare variables
                            var input, filter, table, tr, td, i, txtValue;
                            input = document.getElementById("searchCust");
                            filter = input.value.toUpperCase();
                            table = document.getElementById("customers");
                            tr = table.getElementsByTagName("tr");

                            // Loop through all table rows, and hide those who don't match the search query
                            for (i = 0; i < tr.length; i++) {
                                td = tr[i].getElementsByTagName("td")[0];
                                if (td) {
                                txtValue = td.textContent || td.innerText;
                                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                    tr[i].style.display = "";
                                } else {
                                    tr[i].style.display = "none";
                                }
                                }
                            }
                        };

                        function selectCarrier(cID, cName, cNum){
                            document.getElementById('carrierID').value = cID;
                            document.getElementById('carrierName').value = cName;
                            document.getElementById('carrierNumber').value = cNum;
                        };

                        function selectReceiver(recID, recName, recNum, recAddress){
                            $('input[name="receiverDetails"]').val(recName + ' ' + recNum + ' ' + recAddress);
                            $('input[name="receiverID"]').val(recID);
                            $('#receiverModal').modal('hide');
                        }

                        function selectSender(ID, Name, Num, Address){
                            $('input[name="senderDetails"]').val(Name + ' ' + Num + ' ' + Address);
                            $('input[name="senderID"]').val(ID);
                            $('#senderModal').modal('hide');
                        }

                        // display sender modal
                        function openSenderModal() {
                            event.preventDefault();
                            let href = $(this).attr('data-attr');
                            $.ajax({
                                url: href,
                                beforeSend: function() {
                                    $('#loader').show();
                                },
                                // return the result
                                success: function(result) {
                                    $('#senderModal').modal("show");
                                },
                                complete: function() {
                                    $('#loader').hide();
                                    
                                },
                                error: function(jqXHR, testStatus, error) {
                                    console.log(error);
                                    alert("Page " + href + " cannot open. Error:" + error);
                                    $('#loader').hide();
                                },
                                timeout: 8000
                            })
                        };

                        // display sender modal
                        function openRecModal() {
                            event.preventDefault();
                            let href = $(this).attr('data-attr');
                            $.ajax({
                                url: href,
                                beforeSend: function() {
                                    $('#loader').show();
                                },
                                // return the result
                                success: function(result) {
                                    $('#receiverModal').modal("show");
                                },
                                complete: function() {
                                    $('#loader').hide();
                                },
                                error: function(jqXHR, testStatus, error) {
                                    console.log(error);
                                    alert("Page " + href + " cannot open. Error:" + error);
                                    $('#loader').hide();
                                },
                                timeout: 8000
                            })
                        };

                        // display a modal (small modal)
                        function myFunction() {
                            event.preventDefault();
                            let href = $(this).attr('data-attr');
                            $.ajax({
                                url: href,
                                beforeSend: function() {
                                    $('#loader').show();
                                },
                                // return the result
                                success: function(result) {
                                    $('#smallModal').modal("show");
                                },
                                complete: function() {
                                    $('#loader').hide();
                                },
                                error: function(jqXHR, testStatus, error) {
                                    console.log(error);
                                    alert("Page " + href + " cannot open. Error:" + error);
                                    $('#loader').hide();
                                },
                                timeout: 8000
                            })
                        };

                        function selectCustomer() {
                            event.preventDefault();
                            let href = $(this).attr('data-attr');
                            $.ajax({
                                url: href,
                                beforeSend: function() {
                                    $('#loader').show();
                                },
                                // return the result
                                success: function(result) {
                                    $('#customerModal').modal("show");
                                },
                                complete: function() {
                                    $('#loader').hide();
                                },
                                error: function(jqXHR, testStatus, error) {
                                    console.log(error);
                                    alert("Page " + href + " cannot open. Error:" + error);
                                    $('#loader').hide();
                                },
                                timeout: 8000
                            })
                        };

                        function selectSenderCustomer() {
                            event.preventDefault();
                            let href = $(this).attr('data-attr');
                            $.ajax({
                                url: href,
                                beforeSend: function() {
                                    $('#loader').show();
                                },
                                // return the result
                                success: function(result) {
                                    $('#senderCustModal').modal("show");
                                },
                                complete: function() {
                                    $('#loader').hide();
                                },
                                error: function(jqXHR, testStatus, error) {
                                    console.log(error);
                                    alert("Page " + href + " cannot open. Error:" + error);
                                    $('#loader').hide();
                                },
                                timeout: 8000
                            })
                        };
                    </script>

                    <script>
                        function submitForm(){
                            if($('input[name="senderID"]').val() != $('input[name="receiverID"]').val())
                            {
                                document.packageForm.submit();
                            }else{
                                $('#err').show();
                                $('#bre').show();
                                $("#err").html("You cannot have the same sender and receiver");
                                $("#err").fadeTo(2000, 500).slideUp(500, function(){
                                        $("#err").slideUp(500);
                                });
                                $("#bre").fadeTo(2000, 500).slideUp(500, function(){
                                        $("#bre").slideUp(500);
                                });
                            }
                        }
                    </script>
                    
            </form>

            
        </div>
    </div>
</div>
                    <script>

                        function phoneFormatter1() {
                            $('#contactNumber').attr('maxlength', '11');
                            $('#contactNumber').on('input', function() {
                                var number = $(this).val().replace(/[^\d]/g, '')
                                if (number.length == 7) {
                                    number = number.replace(/(\d{3})(\d{4})/, "$1-$2");
                                } else if (number.length == 11) {
                                    number = number.replace(/(\d{4})(\d{3})(\d{4})/, "($1) $2-$3");
                                }
                                else if(number.length>11){

                                }
                                $(this).val(number)
                            });
                        };

                        function phoneFormatter2() {
                            $('#reccontactNumber').attr('maxlength', '11');
                            
                            $('#reccontactNumber').on('input', function() {
                                var number = $(this).val().replace(/[^\d]/g, '')
                                if (number.length == 7) {
                                    number = number.replace(/(\d{3})(\d{4})/, "$1-$2");
                                } else if (number.length == 11) {
                                    number = number.replace(/(\d{4})(\d{3})(\d{4})/, "($1) $2-$3");
                                }
                                else if(number.length>11){

                                }
                                $(this).val(number)
                            });
                        };

                        $(phoneFormatter1); 
                        $(phoneFormatter2); 

                        
                        $('#customers').DataTable();    
                        $('#customers-rec').DataTable();    
                        $('#employees').DataTable();  
                    </script>
            
                    <style>
                        table.dataTable tbody th, table.dataTable tbody td {
                            padding: 2px 10px; 
                        }
                    </style>

@endsection
