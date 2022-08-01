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
                    
                    <div class="row">

                        <div class="col-xl-3 col-sm-6 col-12 mb-4">
                            <div class="card">
                              <div class="card-body">
                                <div class="d-flex justify-content-between px-md-1">
                                  <div>
                                    <h3 class="text-danger"><?php use App\Http\Controllers\EmployeeController;
                                        echo EmployeeController::countEmployees(); ?></h3>
                                    <p class="mb-0">Users</p>
                                  </div>
                                  <div class="align-self-center">
                                    <a href="/employees"><i class="fas fa-users text-danger fa-3x"></i></a>
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
                                    <h3 class="text-warning"><?php use App\Http\Controllers\CustomerController;
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
                                  <h3 class="text-info"><?php use App\Http\Controllers\PackageController;
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
                                    <i class="fas fa-warehouse text-secondary fa-3x"></i>
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
                                    <i class="fas fa-truck-moving text-primary fa-3x"></i>
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
                                    <i class="fas fa-clipboard-check text-success fa-3x"></i>
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
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
