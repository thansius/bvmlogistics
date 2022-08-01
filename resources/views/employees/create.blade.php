@extends('adminlte::page') @section('content')
<div class="container mt-2">
    <div class="card card-outline card-primary">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left mb-2">
                        <h2>Add Employee</h2>
                    </div>
                    <div class="pull-right">
                        <a
                            class="btn btn-secondary"
                            href="{{ route('employees.index') }}"
                        >
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
            <form
                action="{{ route('employees.store') }}"
                method="POST"
                enctype="multipart/form-data"
            >
                @csrf
                <br>
                    <div class="form-row">
                        <div class="col-auto">
                            <div class="form-group">
                                <strong>Employee ID:</strong>
                                <input
                                    type="text"
                                    name="employeeID"
                                    class="form-control"
                                    placeholder="Employee ID"
                                    value="<?php use App\Http\Controllers\EmployeeController;
                                    echo EmployeeController::getNextID(); ?>"
                                    readonly
                                />
                                @error('employeeID')
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
                        <div class="col-auto">
                            <div class="form-group">
                                <strong>Birthday:</strong>
                                <div class="datepicker date input-group ">
                                    <input type="text" placeholder="Birthday" name="birthday" class="form-control" id="birthday">
                                    <div class="input-group-append">
                                        <span class="input-group-text px-4"><i class="fas fa-calendar"></i></span>
                                    </div>

                                </div>
                                @error('birthday')
                                <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <strong>Department:</strong>
                                <select
                                    name="department"
                                    id="dept"
                                    class="form-control"
                                    placeholder="Department"
                                >
                                    <option value="Human Resources">
                                        HR Department
                                    </option>
                                    <option value="Finance">
                                        Finance Department
                                    </option>
                                    <option value="IT">
                                        IT Department
                                    </option>
                                    <option value="Delivery">Delivery Team</option>
                                </select>
                                @error('department')
                                <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <strong>Position:</strong>
                                <select
                                    name="position"
                                    id="position"
                                    class="form-control"
                                    placeholder="Position"
                                >
                                    <option value="Department Head">
                                        Department Head
                                    </option>
                                    <option value="Staff">
                                        Staff
                                    </option>
                                    <option value="Carrier">Carrier</option>
                                </select>
                                @error('position')
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
        </div>
    </div>
</div>

@endsection
