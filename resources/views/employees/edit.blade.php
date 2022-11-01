@extends('adminlte::page') @section('content')
<div class="container mt-2" onload="setDate()">
    <div class="container mt-2">
        <div class="card card-outline card-primary">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2 style="display: inline-block">Edit Company</h2>
                            <a
                                class="btn btn-secondary float-right"
                                style="width: 100px"
                                href="{{ route('employees.index') }}"
                                enctype="multipart/form-data"
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
                <div class="alert alert-success" id="succ" role="alert">
                    {{-- <p>{{ $message }}</p> --}}
                </div>
                <form
                    action="{{ route('employees.update',$employee->employeeID) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    
                >
                    @csrf @method('PUT')

                    <div class="form-row">
                        <div class="col-xs-12 col-sm-12 col-md-3">
                        
                        <div class="form-group">
                                <strong>Employee ID:</strong>
                                <input
                                    type="text"
                                    name="employeeID"
                                    class="form-control"
                                    placeholder="Employee ID"
                                    id="employeeID"
                                    value="{{ $employee->employeeID }}"
                                    readonly
                                />
                                

                                @error('employeeID')
                                <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <br>
                            <a onclick="resetPassword()" class="btn btn-outline-primary">Reset Password</a>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <strong>Last Name:</strong>
                                <input
                                    type="text"
                                    name="lastName"
                                    value="{{ $employee->lastName }}"
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
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <strong>First Name:</strong>
                                <input
                                    type="text"
                                    name="firstName"
                                    value="{{ $employee->firstName }}"
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

                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <strong>Middle Name:</strong>
                                <input
                                    type="text"
                                    name="middleName"
                                    value="{{ $employee->middleName }}"
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
                                    <div class="datepicker date input-group ">
                                        <input type="text" placeholder="Birthday" name="birthday" class="form-control" id="birthday" value="{{ \Carbon\Carbon::parse($employee->birthday)->format('F j, Y') }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text px-4"><i class="fas fa-calendar"></i></span>
                                        </div>
    
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
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <strong>Department:</strong>
                                <select
                                    name="department"
                                    id="dept"
                                    class="form-control"
                                    placeholder="Department"
                                >
                                    <option value="Human Resources" {{ $employee->department == 'Human Resources' ? 'selected="selected"' : ''; }}>
                                        HR Department
                                    </option>
                                    <option value="Finance" {{ $employee->department == 'Finance' ? 'selected="selected"' : ''; }}>
                                        Finance Department
                                    </option>
                                    <option value="IT" {{ $employee->department == 'IT' ? 'selected="selected"' : ''; }}>
                                        IT Department
                                    </option>
                                    <option value="Delivery" {{ $employee->department == 'Delivery' ? 'selected="selected"' : ''; }}>
                                        Delivery Team
                                    </option>
                                </select>
                                @error('department')
                                <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <strong>Position:</strong>
                                <select
                                    name="position"
                                    id="position"
                                    class="form-control"
                                    placeholder="Position"
                                >
                                    <option value="Department Head" {{ $employee->position == 'Department Head' ? 'selected="selected"' : ''; }}>
                                        Department Head
                                    </option>
                                    <option value="Staff" {{ $employee->position == 'Staff' ? 'selected="selected"' : ''; }}>
                                        Staff
                                    </option>
                                    @if ($employee->department == 'Delivery')
                                        <option value="Carrier" {{ $employee->position == 'Carrier' ? 'selected="selected"' : ''; }}>Carrier</option>
                                    @endif
                                    
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
                        <div class="col-xs-12 col-sm-12 col-md-3">
                            <div class="form-group">
                                <strong>Contact Number:</strong>
                                <input
                                    type="text"
                                    name="contactNumber"
                                    id="contactNumber"
                                    class="form-control"
                                    value="{{ $employee->contactNumber }}"
                                    
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
                        <button type="submit" class="btn btn btn-success btn-block">
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
                $(document).ready(function() {	
                    $('#succ').hide();
                    var number = $('#contactNumber').val().replace(/[^\d]/g, '')
                        if (number.length == 7) {
                            number = number.replace(/(\d{3})(\d{4})/, "$1-$2");
                        } else if (number.length == 11) {
                            number = number.replace(/(\d{4})(\d{3})(\d{4})/, "($1) $2-$3");
                        }
                        else if(number.length>11){

                        }
                    $('#contactNumber').val(number)
                });

                $("#dept").change(function() {
                    
                    var el = $(this) ;
                    
                    if(el.val() === "Delivery" ) {
                    $("#position").append('<option value="Carrier">Carrier</option>');
                    }
                    else if(el.val() !== "Delivery" ) {
                        $("#position option[value='Carrier']").remove() ; }
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

                function resetPassword(){
                    event.preventDefault();

                    let empID = $('#employeeID').val();
                        $.ajax({
                            url: "/reset-password",
                            type: "POST",
                            data:{
                                "_token": "{{ csrf_token() }}",
                                employeeID: empID
                            },
                            success:function(response){
                                console.log(response);
                                if(response=='success'){
                                    $('#succ').show();
                                    $("#succ").html("Password has been updated successfully!");
                                    $("#succ").fadeTo(2000, 500).slideUp(500, function(){
                                        $("#succ").slideUp(500);
                                    });
                                }
                                
                                //$('#setStatus').modal('hide');
                            }
                        });
                    }

            </script>
            </div>
        </div>
    </div>
    @endsection
</div>
