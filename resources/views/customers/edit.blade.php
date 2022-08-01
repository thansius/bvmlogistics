@extends('adminlte::page') @section('content')
<div class="container mt-2" onload="setDate()">
    <div class="container mt-2">
        <div class="card card-outline card-primary">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2 style="display: inline-block">Edit Customer Details</h2>
                            <a
                                class="btn btn-secondary float-right"
                                href="{{ route('customers.index') }}"
                                enctype="multipart/form-data"
                            >
                                Back</a
                            >
                        </div>
                        <div class="pull-right">
                            
                        </div>
                    </div>
                </div>
                @if(session('status'))
                <div class="alert alert-success mb-1 mt-1">
                    {{ session("status") }}
                </div>
                @endif
                <form
                    action="{{ route('customers.update',$customer->id) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    
                >
                    @csrf @method('PUT')
                    <fieldset class="scheduler-border">
                        <legend class="scheduler-border"><i><h5>Customer Details</h5></i></legend>
                            <div class="form-row">
                                <div class="col-auto">
                                    <div class="form-group">
                                        <strong>Last Name:</strong>
                                        <input
                                            type="text"
                                            name="lastName"
                                            class="form-control"
                                            placeholder="Last Name"
                                            value="{{ $customer->lastName }}"
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
                                                                    value="{{ $customer->firstName }}"
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
                                                                    value="{{ $customer->middleName }}"
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
                                                                    class="form-control"
                                                                    value="{{ $customer->contactNumber }}"
                                                                    placeholder="Contact Number"
                                                                    id="contactNumber"
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
                                                    <legend class="scheduler-border"><i><h5>Customer Address</h5></i></legend>
                                                    <div class="form-row">
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <strong>Unit/Floor Number:</strong>
                                                                <input
                                                                    type="text"
                                                                    name="floor_unit"
                                                                    value="{{ $customer->floor_unit }}"
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
                                                                    value="{{ $customer->streetAddress }}"
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
                                                                    id="recprovince"
                                                                    class="form-control"
                                                                    onchange="setCities()"
                                                                    placeholder="Select..."
                                                                >
                                                                @php
                                                                    use App\Http\Controllers\PhilProvinceController;
                                                                    $provinces = PhilProvinceController::getProvinces();   
                                                                @endphp
                                                                <option selected>Select...</option>
                                                                @foreach ($provinces as $province)
                                                                    <option value="{{ $province['provCode'] }}" <?php if (sprintf('%04d',$customer->province) == $province['provCode']) echo ' selected="selected"'; ?>>{{ $province['provDesc'] }}</option>
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
                                                                                $('select[name="city_municipality"]').empty();
                                                                                $('select[name="city_municipality"]').append('<option>Select...</option>');
                                                                                $.each(data, function(key, value) {
                                                                                    $('select[name="city_municipality"]').append('<option value="'+ value.citymunCode +'" >'+ value.citymunDesc +'</option>');
                                                                                });
                                                                                console.log(zeroPad({{ $customer->city_municipality }},6));
                                                                                selectElement('reccity_mun', zeroPad({{ $customer->city_municipality }},6));
                                                                                
                                                                                $( "#reccity_mun" ).change();
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
                                                                    id="reccity_mun"
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
                                                                                $('select[name="barangay"]').empty();
                                                                                $('select[name="barangay"]').append('<option>Select...</option>');
                                                                                $.each(data, function(key, value) {
                                                                                    $('select[name="barangay"]').append('<option value="'+ value.brgyCode +'">'+ value.brgyDesc +'</option>');
                                                                                });
                                                                                console.log(zeroPad({{ $customer->barangay }},9));
                                                                                selectElement('recbarangay', zeroPad({{ $customer->barangay }},9));
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
                                                                    id="recbarangay"
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
                                                                    value="{{ $customer->zipCode }}"
                                                                    
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
                        <div class="form-row">
                            <button type="submit" class="btn btn-success btn-block">
                                Submit
                            </button>
                        </div>
                </form>

                <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
            <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

            <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.standalone.min.css" rel="stylesheet" type="text/css" /> 

            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/inputmask.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/jquery.inputmask.js"></script>
            
            <script>
                const zeroPad = (num, places) => String(num).padStart(places, '0')

                function selectElement(id, valueToSelect) {    
                    let element = document.getElementById(id);
                    element.value = valueToSelect;
                 }
                $(document).ready(function() {	
                    var number = $('#contactNumber').val().replace(/[^\d]/g, '')
                        if (number.length == 7) {
                            number = number.replace(/(\d{3})(\d{4})/, "$1-$2");
                        } else if (number.length == 11) {
                            number = number.replace(/(\d{4})(\d{3})(\d{4})/, "($1) $2-$3");
                        }
                        else if(number.length>11){

                        }
                    $('#contactNumber').val(number);

                    $( "#recprovince" ).change();
                    $( "#reccity_mun" ).change();

                });

                $('#birthday').datepicker({ endDate: '-18Y', format: 'MM dd, yyyy' });

                function phoneFormatter() {
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

                $(phoneFormatter);

            </script>
            </div>
        </div>
    </div>
    @endsection
</div>
