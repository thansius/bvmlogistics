@extends('adminlte::page') @section('content')
<div class="container mt-2">
    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session("status") }}
                    </div>
    @endif
                    <div class="alert alert-danger" id="err" role="alert" >
                        {{-- {{ session("status") }} --}}
                        
                    </div>
        <div class="alert alert-success" id="succ" role="alert">
            {{-- <p>{{ $message }}</p> --}}
        </div>
    <div class="row">
    <div class="col-xl-8">
    <div class="card card-outline card-primary">
            <div class="card-header"><h2>Account Details</h2></div>

            <?php
                use App\Http\Controllers\CustomAuthController;
                $user = CustomAuthController::getUser();
            ?>
            <div class="card-body">
                
                <form >
                    <!-- Form Group (username)-->
                    <!-- Form Row-->
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (first name)-->
                        <div class="col-md-4">
                            <label class="small mb-1" for="firstName">First name</label>
                            <input class="form-control" name="firstName" id="firstName" type="text" placeholder="Enter your first name" value="{{ $user['firstName'] }}" disabled>
                        </div>

                        <div class="col-md-4">
                            <label class="small mb-1" for="middleName">Middle name</label>
                            <input class="form-control" name="middleName" id="middleName" type="text" placeholder="Enter your middle name" value="{{ $user['middleName'] }}" disabled>
                        </div>

                        <!-- Form Group (last name)-->
                        <div class="col-md-4">
                            <label class="small mb-1" for="lastName">Last name</label>
                            <input class="form-control" name="lastName" id="lastName" type="text" placeholder="Enter your last name" value="{{ $user['lastName'] }}" disabled>
                        </div>
                    </div>
                    <!-- Form Row        -->
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (organization name)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="department">Department</label>
                            <input class="form-control" name="department" id="department" type="text" placeholder="Enter your department name" value="{{ $user['department'] }}" readonly>
                        </div>
                        <!-- Form Group (location)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="position">Position</label>
                            <input class="form-control" name="position" id="position" type="text" placeholder="Enter your position" value="{{ $user['position'] }}" readonly>
                        </div>
                    </div>
                    {{-- <!-- Form Group (email address)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="inputEmailAddress">Email address</label>
                        <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your email address" value="name@example.com">
                    </div> --}}
                    <!-- Form Row-->
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (phone number)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="contactNumber">Phone number</label>
                            <input class="form-control" name="contactNumber" id="contactNumber" type="tel" placeholder="Enter your phone number" value="{{ $user['contactNumber'] }}" disabled>
                        </div>
                        <!-- Form Group (birthday)-->
                        <div class="col-md-6">
                            
                                <label class="small mb-1" for="birthday">Birthday</label>
                                <div class="datepicker date input-group ">
                                <input class="form-control"  id="birthday" type="text" name="birthday" placeholder="Enter your birthday" value="{{ \Carbon\Carbon::parse($user['birthday'])->format('F j, Y') }} " disabled>
                                <div class="input-group-append">
                                    <span class="input-group-text px-4"><i class="fas fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Save changes button-->
                    <button class="btn btn-primary" id="update" type="button" >Update Profile</button>
                    <button class="btn btn-success" type="submit" id="savePro" onclick="updateProfile()" disabled>Save changes</button>
                </form>
            </div>
        </div>
    </div>

<div class="col-xl-4">
        <div class="card card-outline card-primary">
            <div class="card-header"><h2>Update Password</h2></div>

            <?php
                $user = CustomAuthController::getUser();
            ?>
            <div class="card-body">
                <form class="form" >
                    <!-- Form Group (username)-->
                   
                    <!-- Form Row-->
                        <!-- Form Group (first name)-->
                        <div class="col">
                            <label class="small mb-1" for="oldPw">Old Password</label>
                            <input class="form-control" name="oldPW" id="oldPw" type="password" placeholder="Enter your old password" disabled  aria-required="true" required>
                            @error('oldPW')
                                <div class="alert alert-danger mt-1 mb-1">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    <!-- Form Row        -->
                        <!-- Form Group (organization name)-->
                        <div class="col">
                            <div class="form-group">
                            <label class="small mb-1" for="newPW" >New Password</label>
                            <div class="input-group" id="show_hide_password">
                            <input class="form-control" name="newPW" id="newPW" type="password" placeholder="Enter your new password" disabled aria-required="true" required>
                            <div class="input-group-append">
                                <button class="input-group-text" id="showPW"><i class="fa fa-eye-slash" aria-hidden="true"></i></button>
                            </div>
                            <span id="newPWspan" value="0"></span>
                            </div>
                            </div>
                        </div>
                        <!-- Form Group (location)-->
                        <div class="col">
                            <div class="form-group">
                                <label class="small mb-1" for="connewPW" >Confirm Password</label>
                                <div class="input-group" id="show_hide_passwordCon">
                                <input class="form-control" name="connewPW" id="connewPW" type="password" placeholder="Confirm your new password" disabled aria-required="true" required>
                                <div class="input-group-append">
                                    <button class="input-group-text" id="showPW"><i class="fa fa-eye-slash" aria-hidden="true"></i></button>
                                </div>
                                <span id="connewPWspan" value="0"></span>
                                </div>
                                </div>
                        </div>
                        <br>

                    {{-- <!-- Form Group (email address)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="inputEmailAddress">Email address</label>
                        <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your email address" value="name@example.com">
                    </div> --}}
                    <!-- Form Row-->
                    {{-- <div class="row gx-3 mb-3">
                        <!-- Form Group (phone number)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputPhone">Phone number</label>
                            <input class="form-control" id="inputPhone" type="tel" placeholder="Enter your phone number" value="{{ $user['contactNumber'] }}">
                        </div>
                        <!-- Form Group (birthday)-->
                        <div class="col-md-6">
                            
                                <label class="small mb-1" for="inputBirthday">Birthday</label>
                                <div class="datepicker date input-group ">
                                <input class="form-control" id="inputBirthday" type="text" name="birthday" placeholder="Enter your birthday" value="{{ \Carbon\Carbon::parse($user['birthday'])->format('F j, Y') }}">
                                <div class="input-group-append">
                                    <span class="input-group-text px-4"><i class="fas fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!-- Save changes button-->
                    <div class="col">
                        <button class="btn btn-primary" id="updatePW" type="button">Update Password</button>

                        <button class="btn btn-success" type="submit" id="savePW" onclick="updatePassword()" disabled>Save New Password</button>
                    </div>
                </form>

                
            </div>
        </div>
    </div>
</div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
            <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />

            <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.standalone.min.css" rel="stylesheet" type="text/css" /> 

            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/inputmask.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/inputmask/jquery.inputmask.js"></script>
            
            <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
            <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

            
            <script>

                function checkPassword()
                {
                    var str = $('#newPW').val()
                    var re = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{10,}$/;
                    return re.test(str);
                };
                $("#newPW").blur(function() 
                {
                    var re = /^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{10,}$/;  
                    var str = $('#newPW').val()
                    if(!re.test(str)) 
                        $("#newPWspan").html('<font color="#cc0000">Password must be atleast 10 characters long and must contain an uppercase, lowercase, number and a special character.</font>');  
                    else
                        $("#newPWspan").html('<font color="#cc0000"></font>');  
                });
                
                $("#show_hide_password button").on('click', function(event) {
                    event.preventDefault();
                    if($('#show_hide_password input').attr("type") == "text"){
                        $('#show_hide_password input').attr('type', 'password');
                        $('#show_hide_password i').addClass( "fa-eye-slash" );
                        $('#show_hide_password i').removeClass( "fa-eye" );
                    }else if($('#show_hide_password input').attr("type") == "password"){
                        $('#show_hide_password input').attr('type', 'text');
                        $('#show_hide_password i').removeClass( "fa-eye-slash" );
                        $('#show_hide_password i').addClass( "fa-eye" );
                    }
                });
                
                $("#show_hide_passwordCon button").on('click', function(event) {
                    event.preventDefault();
                    if($('#show_hide_passwordCon input').attr("type") == "text"){
                        $('#show_hide_passwordCon input').attr('type', 'password');
                        $('#show_hide_passwordCon i').addClass( "fa-eye-slash" );
                        $('#show_hide_passwordCon i').removeClass( "fa-eye" );
                    }else if($('#show_hide_passwordCon input').attr("type") == "password"){
                        $('#show_hide_passwordCon input').attr('type', 'text');
                        $('#show_hide_passwordCon i').removeClass( "fa-eye-slash" );
                        $('#show_hide_passwordCon i').addClass( "fa-eye" );
                    }
                });

                $('#update').click(function() {
                    $("#savePro").prop("disabled",false);
                    $("#lastName").prop("disabled",false);
                    $("#firstName").prop("disabled",false);
                    $("#middleName").prop("disabled",false);
                    $("#contactNumber").prop("disabled",false);
                    $("#birthday").prop("disabled",false);
                    $("#update").prop("disabled",true);
                });

                $('#updatePW').click(function() {
                    $("#savePW").prop("disabled",false);
                    $("#oldPw").prop("disabled",false);
                    $("#newPW").prop("disabled",false);
                    $("#showPW").prop("disabled",false);
                    $("#connewPW").prop("disabled",false);
                    $("#updatePW").prop("disabled",true);
                });

                $(document).ready(function() {	
                    $('#succ').hide();
                    $('#err').hide();
                    $("#savePro").prop("disabled",true);
                    $("#savePW").prop("disabled",true);
                    $("#lastName").prop("disabled",true);
                    $("#firstName").prop("disabled",true);
                    $("#middleName").prop("disabled",true);
                    $("#contactNumber").prop("disabled",true);
                    $("#birthday").prop("disabled",true);
                    $("#oldPw").prop("disabled",true);
                    $("#newPW").prop("disabled",true);
                    $("#connewPW").prop("disabled",true);


                    $("#update").prop("disabled",false);

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


                function updateProfile(){
                    event.preventDefault();

                    let empID = "{{ $user['employeeID'] }}";

                    $.ajax({
                        url: "/save-profile",
                        type: "POST",
                        data:{
                            "_token": "{{ csrf_token() }}",
                            employeeID: empID,
                            firstName: $('#firstName').val(),
                            lastName: $('#lastName').val(),
                            middleName: $('#middleName').val(),
                            department: $('#department').val(),
                            position: $('#position').val(),
                            contactNumber: $('#contactNumber').val(),
                            birthday: $('#birthday').val(),
                        },
                        success:function(response){
                            console.log(response);
                            // $(document).ajaxStop(function(){
                            //     window.location.reload();
                            // });

                            $("#savePro").prop("disabled",true);
                            $("#lastName").prop("disabled",true);
                            $("#firstName").prop("disabled",true);
                            $("#middleName").prop("disabled",true);
                            $("#contactNumber").prop("disabled",true);
                            $("#birthday").prop("disabled",true);
                            $("#update").prop("disabled",false);

                            $('#succ').show();
                            $("#succ").html("Profile has been updated successfully!");

                            $("#succ").fadeTo(2000, 500).slideUp(500, function(){
                                        $("#succ").slideUp(500);
                                    });
                        }
                    });
                }

                function updatePassword(){
                    event.preventDefault();

                    let empID = "{{ $user['employeeID'] }}";
                    if($('#newPW').val() == $('#connewPW').val()){
                        $.ajax({
                            url: "/save-password",
                            type: "POST",
                            data:{
                                "_token": "{{ csrf_token() }}",
                                employeeID: empID,
                                newPW: $('#newPW').val(),
                                oldPW: $('#oldPw').val(),
                            },
                            success:function(response){
                                console.log(response);
                                if(response=='success'){
                                    $('#succ').show();
                                    $("#succ").html("Password has been updated successfully!");

                                    $("#oldPw").prop("disabled",true);
                                    $("#oldPw").val("");
                                    $("#newPW").prop("disabled",true);
                                    $("#showPW").prop("disabled",true);
                                    $("#newPW").val("");
                                    $("#connewPW").prop("disabled",true);
                                    $("#connewPW").val("");
                                    $("#savePW").prop("disabled", true);
                                    $("#updatePW").prop("disabled", false);

                                    $("#succ").fadeTo(2000, 500).slideUp(500, function(){
                                        $("#succ").slideUp(500);
                                    });
                                }else{
                                    $('#err').show();
                                    $("#err").html("Old Password is incorrect!");

                                    $("#oldPw").prop("disabled",true);
                                    $("#oldPw").val("");
                                    $("#newPW").prop("disabled",true);
                                    $("#showPW").prop("disabled",true);
                                    $("#newPW").val("");
                                    $("#connewPW").prop("disabled",true);
                                    $("#connewPW").val("");
                                    $("#savePW").prop("disabled", true);
                                    $("#updatePW").prop("disabled", false);

                                    $("#err").fadeTo(2000, 500).slideUp(500, function(){
                                        $("#err").slideUp(500);
                                    });
                                }
                                
                                //$('#setStatus').modal('hide');
                            }
                        });
                    }else{
                                    $('#err').show();
                                    $("#err").html("Passwords do not match");

                                    $("#oldPw").prop("disabled",true);
                                    $("#oldPw").val("");
                                    $("#newPW").prop("disabled",true);
                                    $("#showPW").prop("disabled",true);
                                    $("#newPW").val("");
                                    $("#connewPW").prop("disabled",true);
                                    $("#connewPW").val("");
                                    $("#savePW").prop("disabled", true);
                                    $("#updatePW").prop("disabled", false);

                                    $("#err").fadeTo(2000, 500).slideUp(500, function(){
                                        $("#err").slideUp(500);
                                    });
                    }
                    
                }


            </script>

@endsection