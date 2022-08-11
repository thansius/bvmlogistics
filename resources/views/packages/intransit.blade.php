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
                    @endif

                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-left">
                                <h2 style="display:inline-block ">PACKAGES IN-TRANSIT</h2>
                                {{-- <a
                                    class="btn btn-success float-right"
                                    href="{{ route('packages.create') }}"
                                    ><small class="fas fa-plus"></small> Create
                                    Package</a
                                >    --}}
                            </div>

                            @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                            @endif
                            <div class="table-responsive">
                            <table
                                id="employees"
                                class="table table-hover table-striped table-bordered dt-responsive display"
                            >
                                <thead class="text-center align-center">
                                    <tr>
                                        <th class="text-center align-middle" >Package ID</th>
                                        <th class="text-center align-middle">Tracking Number</thz>
                                        <th class="text-center align-middle">Dimensions (LxWxH Wt)</th>
                                        <th class="text-center align-middle">Sender Name</th>
                                        <th class="text-center align-middle">Receiver Name</th>
                                        <th class="text-center align-middle">Destination</th>
                                        <th class="text-center align-middle">Receiver Contact Number</th>
                                        <th class="text-center align-middle">Carrier Name</th>
                                        {{-- <th class="text-center align-middle">Status</th> --}}
                                        <th width="70px" class="text-center align-middle">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($packages) <= 0)
                                        <tr>
                                            <td colspan="9" class="text-center"> No Packages Yet </td>
                                        </tr>
                                    @endif
                                    @foreach ($packages as $package)
                                    <tr>
                                        <td>{{ $package->packageID }}</td>
                                        <td>{{ $package->trackingNumber }}</td>
                                        <td>{{ $package->length.'cm x '.$package->width.'cm x '.$package->height.'cm Wt:'.$package->weight.'kg' }}</td>
                                        <td>{{ $package->senderF.' '.$package->senderL }}</td>
                                        <td>{{ $package->recF.' '.$package->recL }}</td>
                                        <td>{{ $package->floor_unit.', '.$package->streetAddress.', '.$package->barangay.', '.$package->city_municipality.', '.$package->province.' '.$package->zipCode }}</td>
                                        <td>{{ $package->contactNumber }}</td>
                                        <td>{{ $package->firstName.' '.$package->lastName }}</td>
                                        {{-- @if ( $package->status == '1' )
                                            <td><span class="badge rounded-pill bg-secondary">In Warehouse</span></td>
                                        @elseif ( $package->status == '0' )
                                            <td><span class="badge rounded-pill bg-danger">Cancelled</span></td>
                                        @elseif ( $package->status == '2' )
                                            <td><span class="badge rounded-pill bg-primary">In Transit</span></td>
                                        @elseif ( $package->status == '3' )
                                            <td><span class="badge rounded-pill bg-success">Delivered</span></td>
                                        @elseif ( $package->status == '4')
                                            <td><span class="badge rounded-pill bg-warning">Delivery Failed</span></td>
                                        @endif --}}
                                        <td class="text-center align-middle">
                                            {{-- <form
                                                action="{{ route('packages.destroy',$package->packageID) }}"
                                                method="Post"
                                            >
                                                <a
                                                    class="btn btn-primary"
                                                    href="{{ route('packages.edit',$package->packageID) }}"
                                                    ><small
                                                        class="fas fa-edit"
                                                    ></small
                                                    >Edit</a
                                                >
                                                @csrf @method('DELETE')
                                                <button
                                                    type="submit"
                                                    class="btn btn-danger"
                                                >
                                                    <small
                                                        class="fas fa-trash"
                                                    ></small>
                                                    Delete
                                                </button>
                                            </form> --}}

                                            <a
                                                    class="btn btn-primary btn-sm"
                                                    href="{{ route('packages.edit',$package->packageID) }}"
                                                    ><small
                                                        class="fas fa-eye"
                                                    ></small
                                                    >View</a
                                                >
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{-- <div class="d-felx">
                                {!! $packages->links() !!}
                            </div> --}}
                        </div>
                        </div>

                    </div>
                </div>
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

        <script>
            var table = $('#employees').DataTable(
                {
                    "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                    "paging": true, 
                    "buttons": [
                        {
                            extend: 'pdf',
                            title: 'BVM Sanchez & Son Global Logistics \n LIST OF IN-TRANSIT PACKAGES',
                            orientation: 'landscape',
                            pageSize: 'LEGAL',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            title: 'BVM Sanchez & Son Global Logistics \n LIST OF IN-TRANSIT PACKAGES',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                            }
                        },
                        // 'csvHtml5',
                        // 'excelHtml5',
                        // 'pdf',
                        // 'print'
                    ]
                    
                }   
            );

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

