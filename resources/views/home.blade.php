@extends('adminlte::page')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <br>
            <div class="card card-outline card-primary">
                <div class="card-header"><h2>DASHBOARD</h2></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <?php
                      use App\Http\Controllers\EmployeeController;
                      use App\Http\Controllers\CustomerController;
                      use App\Http\Controllers\PackageController;
                    ?>
                    
                    <div class="row">

                      @canany(['isAdmin','isManager'])
                          
                        <div class="col-xl-3 col-sm-6 col-12 mb-4">
                          <div class="card">
                            <div class="card-body">
                              <div class="d-flex justify-content-between px-md-1">
                                <div>
                                  <h3 class="text-danger"><?php 
                                      echo EmployeeController::countEmployees(); ?></h3>
                                  <p class="mb-0">Employees</p>
                                </div>
                                <div class="align-self-center">
                                  <a href="/employees"><i class="fas fa-users text-danger fa-3x"></i></a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      @endcanany
                        
                      @cannot('isCarrier')
                        
                        <div class="col-xl-3 col-sm-6 col-12 mb-4">
                            <div class="card">
                              <div class="card-body">
                                <div class="d-flex justify-content-between px-md-1">
                                  <div>
                                    <h3 class="text-warning"><?php 
                                        echo CustomerController::getCustomerCount(); ?></h3>
                                    <p class="mb-0">Customers</p>
                                  </div>
                                  <div class="align-self-center">
                                    <a href="/customers"><i class="fas fa-user text-warning fa-3x"></i></a>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>


                        <div class="col-xl-3 col-sm-6 col-12 mb-4">
                          <div class="card">
                            <div class="card-body">
                              <div class="d-flex justify-content-between px-md-1">
                                <div>
                                  <h3 class="text-info"><?php 
                                      echo PackageController::countAllPackages(); ?></h3>
                                  <p class="mb-0">Total Package</p>
                                </div>
                                <div class="align-self-center">
                                  <a href="/packages"><i class="fas fa-box text-info fa-3x"></i></a>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                    </div>

                    <div class="row">

                        <div class="col-xl-3 col-sm-6 col-12 mb-4">
                            <div class="card">
                              <div class="card-body">
                                <div class="d-flex justify-content-between px-md-1">
                                  <div>
                                    <h3 class="text-secondary"><?php 
                                        echo PackageController::countWarehousePackages(); ?></h3>
                                    <p class="mb-0">Package In Warehouse</p>
                                  </div>
                                  <div class="align-self-center">
                                    <a href="/packages/inwarehouse"><i class="fas fa-warehouse text-secondary fa-3x"></i></a>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6 col-12 mb-4">
                            <div class="card">
                              <div class="card-body">
                                <div class="d-flex justify-content-between px-md-1">
                                  <div>
                                    <h3 class="text-primary"><?php echo PackageController::countTransitPackages(); ?></h3>
                                    <p class="mb-0">Package In Transit</p>
                                  </div>
                                  <div class="align-self-center">
                                    <a href="/packages/intransit"><i class="fas fa-truck-moving text-primary fa-3x"></i></a>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6 col-12 mb-4">
                            <div class="card">
                              <div class="card-body">
                                <div class="d-flex justify-content-between px-md-1">
                                  <div>
                                    <h3 class="text-success"><?php echo PackageController::countDeliveredPackages(); ?></h3>
                                    <p class="mb-0">Package Delivered</p>
                                  </div>
                                  <div class="align-self-center">
                                    <a href="/packages/delivered"><i class="fas fa-clipboard-check text-success fa-3x"></i></a>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-sm-6 col-12 mb-4">
                            <div class="card">
                              <div class="card-body">
                                <div class="d-flex justify-content-between px-md-1">
                                  <div>
                                    <h3 class="text-danger"><?php echo PackageController::countDeliveryFailedPackages(); ?></h3>
                                    <p class="mb-0">Failed Deliveries</p>
                                  </div>
                                  <div class="align-self-center">
                                    <i class="fas fa-exclamation-circle  text-danger fa-3x"></i>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                        
                      @endcannot
                    </div>

                      @can('isCarrier')
                        <div class="row">

                            <div class="col-xl-3 col-sm-6 col-12 mb-4">
                              <div class="card">
                                <div class="card-body">
                                  <div class="d-flex justify-content-between px-md-1">
                                    <div>
                                      <h3 class="text-primary"><?php echo PackageController::countToDeliver(); ?></h3>
                                      <p class="mb-0">Package To Deliver</p>
                                    </div>
                                    <div class="align-self-center">
                                      <i class="fas fa-dolly text-primary fa-3x"></i>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-xl-3 col-sm-6 col-12 mb-4">
                              <div class="card">
                                <div class="card-body">
                                  <div class="d-flex justify-content-between px-md-1">
                                    <div>
                                      <h3 class="text-success"><?php echo PackageController::countDelivered(); ?></h3>
                                      <p class="mb-0">Package Delivered</p>
                                    </div>
                                    <div class="align-self-center">
                                      <i class="fas fa-clipboard-check text-success fa-3x"></i>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                      
                        <div class="row">
                            <div class="card card-outline card-primary" style="width: 100%;">
                              <div class="card-header"><h4>Package To Deliver</h4></div>
                              <?php 
                                $packages = PackageController::getToDeliver();
                                $delpackages = PackageController::getDeliveredCarrier();
                              ?>
                              <div class="card-body">
                                <div class="table-responsive">
                                  <table
                                      id="employees"
                                      class="table table-hover table-striped table-bordered dt-responsive display"
                                  >
                                      <thead class="text-center align-center">
                                          <tr>
                                              <th>Tracking Number</th>
                                              <th>Receiver Name</th>
                                              <th>Destination</th>
                                              <th>Receiver Contact Number</th>
                                              <th width="100px">Action</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          @if (count($packages) <= 0)
                                              <tr>
                                                  <td colspan="5" class="text-center"> No Packages Yet </td>
                                              </tr>
                                          @endif
                                          @foreach ($packages as $package)
                                          <tr>
                                              <td>{{ $package->trackingNumber }}</td>
                                              <td>{{ $package->recF.' '.$package->recL }}</td>
                                              <td>{{ $package->floor_unit.', '.$package->streetAddress.', '.$package->barangay.', '.$package->city_municipality.', '.$package->province.' '.$package->zipCode }}</td>
                                              <td>{{ $package->contactNumber }}</td>
                                              <td>
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
                                                          class="btn btn-primary"
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
                                </div>

                              </div>
                          </div>
                        </div>
                          <div class="row">
                            <div class="card card-outline card-success" style="width: 100%;">
                              <div class="card-header"><h4>Package Delivered</h4></div>
                              <div class="card-body">
                              <div class="table-responsive">
                                <table
                                    id="employees"
                                    class="table table-hover table-striped table-bordered dt-responsive display"
                                >
                                    <thead class="text-center align-center">
                                        <tr>
                                            <th>Tracking Number</th>
                                            <th>Receiver Name</th>
                                            <th>Destination</th>
                                            <th>Receiver Contact Number</th>
                                            <th width="100px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($delpackages) <= 0)
                                            <tr>
                                                <td colspan="5" class="text-center"> No Packages Yet </td>
                                            </tr>
                                        @endif
                                        @foreach ($delpackages as $package)
                                        <tr>
                                            <td>{{ $package->trackingNumber }}</td>
                                            <td>{{ $package->recF.' '.$package->recL }}</td>
                                            <td>{{ $package->floor_unit.', '.$package->streetAddress.', '.$package->barangay.', '.$package->city_municipality.', '.$package->province.' '.$package->zipCode }}</td>
                                            <td>{{ $package->contactNumber }}</td>
                                            <td>
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
                                                        class="btn btn-primary"
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
                              </div>
                            </div>
                            </div>
                          </div>

                        {{-- <div class="col-md-3 small-box bg-gradient-primary">
                            <div class="inner">
                            <h3>
                                </h3>
                            <p>User</p>
                            </div>
                            <div class="icon">
                            <i class="fas fa-users"></i>
                            </div>
                        </div> --}}

                        {{-- <div class="col-md-3 small-box bg-gradient-warning">
                            <div class="inner">
                                <h3><?php use App\Http\Controllers\PackageController;
                                    echo PackageController::countWarehousePackages(); ?>
                                    </h3>
                            <p>Package In Warehouse</p>
                            </div>
                            <div class="icon">
                            <i class="fas fa-warehouse"></i>
                            </div>
                        </div> --}}

                        {{-- <div class="col-md-3 small-box bg-gradient-info">
                            <div class="inner">
                                <h3><?php echo PackageController::countTransitPackages(); ?>
                                    </h3>
                            <p>Package In Transit</p>
                            </div>
                            <div class="icon">
                            <i class="fas fa-truck-moving"></i>
                            </div>
                        </div> --}}
                        {{-- <div class="col-md-3 small-box bg-gradient-success">
                            <div class="inner">
                                <h3><?php echo PackageController::countDeliveredPackages(); ?>
                                    </h3>
                            <p>Package In Delivered</p>
                            </div>
                            <div class="icon">
                            <i class="fas fa-clipboard-check"></i>
                            </div>
                        </div> --}}
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
