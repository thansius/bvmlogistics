@extends('adminlte::page') @section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <br />
            <div class="card card-outline card-primary">
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session("status") }}
                    </div>
                    
                    <div class="alert alert-danger mb-1 mt-1">
                        {{ session("status") }}
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-left">
                                <h2 style="display:inline-block">EMPLOYEE RECORDS</h2>
                                <a
                                    class="btn btn-success float-end"
                                    href="{{ route('employees.create') }}"
                                    ><small class="fas fa-plus"></small> Create
                                    Employee</a
                                >
                            </div>
                            <br>

                            @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p id="succ">{{ $message }}</p>
                            </div>
                            @elseif ($message = Session::get('error'))
                            <div class="alert alert-danger">
                                <p id="err">{{ $message }}</p>
                            </div>
                            @endif

                            
                            <div class="tab-content table-responsive" id="ex1-content">
                                
                                <table
                                    id="employees"
                                    class="table table-hover table-bordered dt-responsive display nowrap"
                                    cellspacing="0"

                                >
                                    <thead>
                                        <tr>
                                            <th>Employee ID</th>
                                            <th>Last Name</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Birthday</th>
                                            <th>Position</th>
                                            <th>Department</th>
                                            <th>Contact Number</th>
                                            <th>Status</th>
                                            <th width="180px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($employees) <= 0)
                                            <tr>
                                                <td colspan="9" class="text-center"> No Employees Yet </td>
                                            </tr>
                                        @else
                                        @foreach ($employees as $employee)
                                        <tr>
                                            <td>{{ $employee->employeeID }}</td>
                                            <td>{{ $employee->lastName }}</td>
                                            <td>{{ $employee->firstName }}</td>
                                            <td>{{ $employee->middleName }}</td>
                                            <td>{{ date('M d, Y', strtotime($employee->birthday)) }}</td>
                                            <td>{{ $employee->position }}</td>
                                            <td>{{ $employee->department.' Department' }}</td>
                                            <td>{{ $employee->contactNumber }}</td>
                                            @if ($employee->status == 1)
                                                <td class="text-center align-middle"><span class="badge rounded-pill bg-success">Active</span></td>
                                            @else
                                                <td class="text-center align-middle"><span class="badge rounded-pill bg-danger">Inactive</span></td>
                                            @endif
                                            <td class="text-center">
                                                
                                                    <a
                                                        class="btn btn-primary btn-sm"
                                                        href="{{ route('employees.edit',$employee->employeeID) }}"
                                                        ><small
                                                            class="fas fa-edit"
                                                        ></small
                                                        ></a
                                                    >
                                                    
                                                    @if ($employee->status == 1)
                                                        <a
                                                            href="#myModal"
                                                            class="btn btn-danger btn-sm delete"
                                                            data-toggle="modal"
                                                            data-id="{{ $employee->employeeID }}"
                                                            data-target="#myModal"
                                                        >
                                                            <small
                                                                class="fas fa-trash"
                                                            ></small>
                                                        </a>

                                                    @else
                                                        <a
                                                            href="#myModal2"
                                                            class="btn btn-success btn-sm reactivate"
                                                            data-toggle="modal"
                                                            data-id="{{ $employee->employeeID }}"
                                                            data-target="#myModal2"
                                                        >
                                                            <small
                                                                class="fas fa-upload"
                                                            ></small>
                                                        </a>
                                                    @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>

                                {{-- <div class="d-flex justify-content-end">
                                    {{ $employees->links() }}
                                </div>  --}}
                            </div>
                            
                        
                    </div>
                </div>
            </div>
                <div id="myModal" class="modal fade">
                    <div class="modal-dialog modal-confirm">
                        <div class="modal-content">
                            <div class="modal-header flex-column">
                                <div class="icon-box">
                                    <i class="fas fa-times"></i>
                                </div>						
                                <h4 class="modal-title w-100">Are you sure?</h4>	
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <p>Do you really want to deactivate this record?</p>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <form
                                                action="{{ route('employees.destroy','id') }}"
                                                method="Post"
                                            >
                                            @csrf @method('DELETE')
                                            <input hidden id="id" name="id">
                                    <button type="submit" class="btn btn-danger">Deactivate</button>
                                
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="myModal2" class="modal fade">
                    <div class="modal-dialog modal-confirm">
                        <div class="modal-content">
                            <div class="modal-header flex-column">
                                <div class="icon-box2">
                                    <i class="fas fa-question"></i>
                                </div>						
                                <h4 class="modal-title w-100">Are you sure?</h4>
                                	
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <p>Do you really want to reactivate this record?</p>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <form>
                                    @csrf
                                    <input hidden id="empid" name="empid">
                                    <a onclick="reactivate()" class="btn btn-primary">Reactivate</a>
                                </form>
                                {{-- <form
                                                action="{{ route('reactivate-employee','id') }}"
                                                method="get"
                                            >
                                            @csrf 
                                            <input hidden id="id" name="id">
                                    <button type="submit" class="btn btn-primary">Reactivate</button>
                                
                                </form> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <style>.modal-confirm {		
                    color: #636363;
                    width: 400px;
                }
                .modal-confirm .modal-content {
                    padding: 20px;
                    border-radius: 5px;
                    border: none;
                    text-align: center;
                    font-size: 14px;
                }
                .modal-confirm .modal-header {
                    border-bottom: none;   
                    position: relative;
                }
                .modal-confirm h4 {
                    text-align: center;
                    font-size: 26px;
                    margin: 30px 0 -10px;
                }
                .modal-confirm .close {
                    position: absolute;
                    top: -5px;
                    right: -2px;
                }
                .modal-confirm .modal-body {
                    color: #999;
                }
                .modal-confirm .modal-footer {
                    border: none;
                    text-align: center;		
                    border-radius: 5px;
                    font-size: 13px;
                    padding: 10px 15px 25px;
                }
                .modal-confirm .modal-footer a {
                    color: #999;
                }		
                .modal-confirm .icon-box {
                    width: 80px;
                    height: 80px;
                    margin: 0 auto;
                    border-radius: 50%;
                    z-index: 9;
                    text-align: center;
                    border: 3px solid #f15e5e;
                }
                .icon-box2 {
                    width: 80px;
                    height: 80px;
                    margin: 0 auto;
                    border-radius: 50%;
                    z-index: 9;
                    text-align: center;
                    border: 3px solid #60C7C1;
                }
                .modal-confirm .icon-box i {
                    color: #f15e5e;
                    font-size: 46px;
                    display: inline-block;
                    margin-top: 13px;
                }
                .icon-box2 i {
                    color: #60C7C1;
                    font-size: 46px;
                    display: inline-block;
                    margin-top: 13px;
                }
                .modal-confirm .btn, .modal-confirm .btn:active {
                    color: #fff;
                    border-radius: 4px;
                    background: #60c7c1;
                    text-decoration: none;
                    transition: all 0.4s;
                    line-height: normal;
                    min-width: 120px;
                    border: none;
                    min-height: 40px;
                    border-radius: 3px;
                    margin: 0 5px;
                }
                .modal-confirm .btn-secondary {
                    background: #c1c1c1;
                }
                .modal-confirm .btn-secondary:hover, .modal-confirm .btn-secondary:focus {
                    background: #a8a8a8;
                }
                .modal-confirm .btn-danger {
                    background: #f15e5e;
                }
                .modal-confirm .btn-danger:hover, .modal-confirm .btn-danger:focus {
                    background: #ee3535;
                }</style>
            </div>
        </div>
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
        <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>

        <script>

            $(document).on("click", ".reactivate", function () 
                {

                    let id = $(this).attr('data-id');
                    //alert(id);
                    $('#empid').val(id);
                });
            $(document).on('click','.delete',function(){
                        let id = $(this).attr('data-id');
                        $('#id').val(id);
                    });
            var table = $('#employees').DataTable(
                {
                    "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    "paging": true, 
                    "buttons": [
                        {
                            extend: 'pdf',
                            title: 'BVM Sanchez & Son Global Logistics \n LIST OF EMPLOYEES',
                            pageSize: 'letter',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            title: 'BVM Sanchez & Son Global Logistics \n LIST OF EMPLOYEES',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                            }
                        },
                        // 'csvHtml5',
                        // 'excelHtml5',
                        // 'pdf',
                        // 'print'
                    ],}
            );

            function reactivate(){
                    event.preventDefault();

                    let empID = $('#empid').val();
                    console.log(empID);
                        $.ajax({
                            url: "/reactivate-employee",
                            type: "POST",
                            data:{
                                "_token": "{{ csrf_token() }}",
                                empid: empID
                            },
                            success:function(response){
                                console.log(response);
                                if(response=='success'){
                                    $('#myModal2').modal('hide');
                                    location.reload();
                                    $('#succ').show();
                                    $("#succ").html("Employee has been reactivated successfully!");
                                    $("#succ").fadeTo(2000, 500).slideUp(500, function(){
                                        $("#succ").slideUp(500);
                                    });
                                    
                                }
                                
                                //$('#setStatus').modal('hide');
                            }
                        });
                    };

            table.buttons().container()
                .appendTo( '#employees_wrapper .col-md-6:eq(0)' );    
        </script>

        <style>
            table.dataTable tbody th, table.dataTable tbody td {
                padding: 2px 10px; 
            }
        </style>
    </div>
</div>
@endsection
