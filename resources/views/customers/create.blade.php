@extends('adminlte::page') @section('content')
<div class="container mt-2">
    <div class="card card-outline card-primary">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left mb-2">
                        <h2 style="display: inline-block">Add Customer</h2>
                        <a
                            class="btn btn-secondary float-right"
                            href="{{ route('customers.index') }}"
                        >
                            Back</a
                        >
                    </div>
                </div>
            </div>
            @if(session('status'))
            <div class="alert alert-danger mb-1 mt-1">
                {{ session("status") }}
            </div>
            @endif
            <form
                action="{{ route('customers.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf
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
                                                                class="form-control"
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
                                                                id="recprovince"
                                                                class="form-control"
                                                                placeholder="Select..."
                                                            >
                                                            @php
                                                                use App\Http\Controllers\PhilProvinceController;
                                                                $provinces = PhilProvinceController::getProvinces();   
                                                            @endphp
                                                            <option selected>Select...</option>
                                                            @foreach ($provinces as $province)
                                                                <option onselect="setCities()" value="{{ $province['provCode'] }}">{{ $province['provDesc'] }}</option>
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
            <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.22/jquery-ui.min.js"></script>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
            <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

            <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.standalone.min.css" rel="stylesheet" type="text/css" /> 

            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/inputmask.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/jquery.inputmask.js"></script>
            
            <script>
                // (function($) {  
                //     var _datepicker = jQuery.fn.datepicker;
                    
                //     $.fn.datepicker = function(options) {
                //         var $date = _datepicker.apply(this, arguments);
                        
                //         if (options.altFormat && options.altField) {
                //             var altValue = $(options.altField).val();
                //             var value = $.datepicker.parseDate(options.altFormat, altValue);
                //             var dateFormat = _datepicker.call(this, 'option', 'dateFormat');
                //             $(this).val($.datepicker.formatDate(dateFormat, value));
                //         }
                //     };
                // })(jQuery);


                $('#birthday').datepicker({ 
                    endDate: '-18Y', 
                    format: 'MM dd, yyyy', 
                    // dateFormat: 'MM dd, yyyy', 
                    autoclose: true,
                    altFormat: "yyyy-mm-dd",
                    altField: "#altFormat"
                });
                

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
        </div>
    </div>
</div>

@endsection
