@extends('adminlte::page') @section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <br>
            <div class="card card-outline card-primary">
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session("status") }}
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div>
                                <h2 style="display:inline-block">PACKAGE TRACKING</h2>
                                @if ($package->status == 3 || $package->status == 0)
                                @else
                                    <button class="btn btn-success" onclick="openSetStatusModal()" style="float:right">Update Status</button>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <?php
                                use App\Http\Controllers\PackageController;
                                $packageData = PackageController::getPackage($package->packageID);
                                $packageProgress = PackageController::getPackageProgressEdit($package->trackingNumber);
                            ?>
                            <fieldset class="packageDetails">

                            <legend class="packageDetails"><h5>Package Details</h5></legend>
                            
                            <p><b>Package ID: </b>{{ $package->packageID }}</p>
                            <p><b>Tracking Number: </b><span id="trackingNum">{{ $package->trackingNumber }}</span></p>
                            <p><b>Dimensions:</b> {{ $package->length.'cm x '.$package->width.'cm x '.$package->height.'cm x W:'.$package->weight.'kg' }}</p>
                            @foreach ( $packageData as $packageD)
                                <div class="card card-primary">
                                    <div class="card-header">
                                        Sender Details:
                                    </div>
                                    <div class="card-body">
                                        <p><b>Sender:</b> {{ $packageD->senderF.' '.$packageD->senderL }} </p>
                                        <p><b>Sender Contact Number:</b> {{ $packageD->senderCN }} </p>
                                    </div>
                                </div>

                                <div class="card card-success">
                                    <div class="card-header">
                                        Receiver Details:
                                    </div>
                                    <div class="card-body">
                                        <p><b>Receiver:</b> {{ $packageD->recF.' '.$packageD->recL }}</p>
                                        <p><b>Receiver Address:</b> {{ $packageD->floor_unit.', '.$packageD->streetAddress.', '.$packageD->barangay.', '.$packageD->city_municipality.', '.$packageD->province.' '.$packageD->zipCode }}</p>
                                        <p><b>Receiver Contact Number:</b> {{ $packageD->contactNumber}}</p>
                                    </div>
                                </div>

                                <div class="card card-warning">
                                    <div class="card-header">
                                        Carrier Details:
                                        @if ($package->status == 1)
                                            <button onclick="myFunction()" id="btnChangeCarrier" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="float:right">Change Carrier</button>

                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <input type="hidden" id="carrierID">
                                        <p><b>Carrier Name:</b> <span id="carrierName">{{ $packageD->firstName.' '.$packageD->lastName}}</span></p>
                                        <p><b>Carrier Contact Number:</b> <span id="carrierNumber">{{ $packageD->eCNum}}</span></p>
                                    </div>
                                </div>
                                
                                
                                
                            @endforeach
                            
                            </fieldset>

                        </div>
                        <div class="col">
                            <fieldset class="packageDetails">

                                <legend class="packageDetails"><h5>Package Progress</h5></legend>
                                
                                <div>
                                    <table class="table" id="progTable">
                                        <thead>
                                            <tr>
                                                <th>Date of Last Status</th>
                                                <th></th>
                                                <th>Transaction Status</th>
                                                <th>Updated By</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($packageProgress != null)
                                                @foreach ($packageProgress as $packProg)
                                                    <tr>
                                                        <td>{{ \Carbon\Carbon::parse($packProg->pdate)->format('F j, Y  g:i A') }}</td>
                                                        <td><i class="fas fa-check" style="color: green"></i></td>
                                                        <td>{{ $packProg->description }}</td>
                                                        <td>{{ $packProg->firstName.' '.$packProg->lastName }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td>No update yet</td>
                                                </tr>
                                            @endif
                                            
                                        </tbody>
                                    </table>
                                </div>
                            
                            </fieldset>
                        </div>

                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
                            <th>Carrier Name</th>
                            <th>Carrier Contact Number</th>
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
<div class="modal fade" id="setStatus" tabindex="-1" role="dialog" aria-labeled="setStatusLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    <h5>Update Status of Package</h5>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>  
            <div class="modal-body" id="setStatusBody">
                <div class="form-group">
                    <strong>Status:</strong>
                    <select name="status" id="status" onchange="enableTextArea()" class="form-control">
                        <option value="">--Select Status--</option>
                        <option value="Delivered">Mark as Delivered</option>
                        <option value="In-Transit">Package In-Transit</option>
                        <option value="Delivery Failed">Delivery Failed</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                </div>

                <div class="form-group" id="attempts">
                    <strong>Number of Delivery Attempts:</strong>
                    <input class="form-control" id="numAttempts" type="number" placeholder="Enter number of delivery attempts">
                </div>
                <div class="form-group">
                    <strong>Status Description:</strong>
                    <textarea id="statDesc" class="form-control" placeholder="Enter status description of package" disabled>
                    </textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" onclick="updatePackageStatus()">
                    Update
                </button>
                <button type="button" class="btn btn-secondary float-end" data-dismiss="modal" aria-label="Close">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>


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
    $("#attempts").hide();
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

    function selectCarrier(cID, cName, cNum){
                            document.getElementById('carrierID').value = cID;
                            document.getElementById('carrierName').value = cName;
                            document.getElementById('carrierNumber').value = cNum;
                            updateCarrier();
                        };

    function updateCarrier(){
        event.preventDefault();

        let packageID = '{{ $package->packageID }}';
        let carrierID = $('#carrierID').val();

        $.ajax({
            url: "/update-carrier",
            type: "POST",
            data:{
                "_token": "{{ csrf_token() }}",
                packageID: packageID,
                carrierID: carrierID
            },
            success:function(response){
                console.log(response);
                $(document).ajaxStop(function(){
                    window.location.reload();
                });
                $('#smallModal').modal('hide');
            }
        });
    }

    function openSetStatusModal(){
        event.preventDefault();
        let href = $(this).attr('data-attr');
        $.ajax({
            url: href,
            beforeSend: function(){
                $('#loader').show();
            },
            success: function(result) {
                $('#setStatus').modal("show");
            },
            complete: function() {
                $("#status").prop("selectedIndex", 0);
                $("#numAttempts").val("");
                $("#statDesc").val("");
                $("#numAttempts").attr("placeholder", "Enter number of delivery attempts");
                $("#statDesc").attr("placeholder", "Enter status description of package");
                $("#statDesc").prop("disabled", true);
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

    $("#status").change(function() {
    
        var el = $(this);
        
        if(el.val() === "Delivery Failed" ) {
            $("#attempts").show();
        }
        else if(el.val() !== "Delivery Failed" ) {
            $("#attempts").hide(); }
    });



    function enableTextArea(){
        var val = $('#status').val();
        if(val === 'Delivered' || val === '' || val === 'Cancelled'){
            $('#statDesc').prop('disabled', true);
        }
        else{
            $('#statDesc').prop('disabled', false);
            $('#statDesc').val('');
        }
    }

    function updatePackageStatus(){
        event.preventDefault();
        var val = $('#status').val();

        let trackingNumber = '{{ $package->trackingNumber }}';
        let statDesc = $('#statDesc').val();
        let attempts = $('#numAttempts').val();

        if(val === 'Delivered'){
            statDesc = 'Package Delivered Successfully';
        }else if(val === 'Cancelled'){
            statDesc = 'Package Delivery Cancelled';
        }

        $.ajax({
            url: "/save-update",
            type: "POST",
            data:{
                "_token": "{{ csrf_token() }}",
                trackingNumber: trackingNumber,
                stat: val,
                description: statDesc,
                numAttempts: attempts
            },
            success:function(response){
                console.log(response);
                $(document).ajaxStop(function(){
                    window.location.reload();
                });
                $('#setStatus').modal('hide');
            }
        });
    }
</script>

<style>
    fieldset.packageDetails {
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow:  0px 0px 0px 0px #000;
                box-shadow:  0px 0px 0px 0px #000;
    }

    legend.packageDetails {
        width:inherit; /* Or auto */
        padding:0 10px; /* To give a bit of padding on the left and right */
        border-bottom:none;
    }
</style>

@endsection