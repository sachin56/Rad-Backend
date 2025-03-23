@extends('layouts.app')

@section('title')
    {{__('Dashboard')}}
@endsection

@section('breadcrumb')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Dashboard </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active"></li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

        </div> <!-- container-fluid -->
    </div>
@endsection

@section('content')

    <div class="container-fluuid">
        <div class="row mx-4">
            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate">All Orders</span>
                                <h4 class="mb-3">
                                    <span class="counter-value" >0</span>
                                </h4>
                            </div>


                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Confirmed Orders</span>
                                <h4 class="mb-3">
                                    <span class="counter-value" >0</span>
                                </h4>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col-->

            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Canceled Orders</span>
                                <h4 class="mb-3">
                                    <span class="counter-value" >0</span>
                                </h4>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                        <span
                                            class="text-muted mb-3 lh-1 d-block text-truncate">Delivered Orders</span>
                                <h4 class="mb-3">
                                    <span class="counter-value" ></span>
                                </h4>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->


        </div>
        <div class="row mx-4">


            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <span
                                    class="text-muted mb-3 lh-1 d-block text-truncate">Partially Delivered Orders</span>
                                <h4 class="mb-3">
                                    <span class="counter-value"
                                         >0</span>
                                </h4>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12">
                                        <span
                                            class="text-muted mb-3 lh-1 d-block text-truncate">Cancel Requests</span>
                                <h4 class="mb-3">
                                    <span class="counter-value" >0</span>
                                </h4>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->


            </div>

            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12">
                                        <span
                                            class="text-muted mb-3 lh-1 d-block text-truncate">Pending Modifications Requests</span>
                                <h4 class="mb-3">
                                    <span class="counter-value"
                                          >0</span>
                                </h4>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->


            </div>

            <div class="col-xl-3 col-md-6">
                <!-- card -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12">
                                        <span
                                            class="text-muted mb-3 lh-1 d-block text-truncate">Approved Modifications Requests</span>
                                <h4 class="mb-3">
                                    <span class="counter-value"
                                          >0</span>
                                </h4>
                            </div>
                        </div>
                    </div><!-- end card body -->
                </div><!-- end card -->


            </div>
        </div>
        <div class="row">
            <div class="col-lg-1">

            </div>
            <div class="col-lg-5">
                <div id="order" style="height: 300px;"></div>
            </div>
            <div class="col-lg-5">
                <div id="dispatch" style="height: 300px;"></div>
            </div>
            <div class="col-lg-1">

            </div>
        </div>

        <div class="row mx-4 mb-5">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Orders Last 30 Days</h3>
                    </div>
                    <div class="card-body">
                        <div id="order_chart" style="height: 500px"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-1"></div>
        </div>

        <div class="row mx-4 mb-5">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">Cancel Requests</h3>
                </div>
                <div class="card-body">
                        <table id="cancel_request_list_table" class="table table-bordered dt-responsive">
                            <thead>
                            <tr>
                                <th class="bg-soft-info">Order ID</th>
                                <th class="bg-soft-info">Customer</th>
                                <th class="bg-soft-info">Sales Agent</th>
                                <th class="bg-soft-info">Order Date</th>
                                <th class="bg-soft-info">Amount</th>
                                <th class="bg-soft-info">Action</th>
                            </tr>
                            </thead>

                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-1"></div>
        </div>


        <div class="row mx-4 mb-5">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Today Orders</h3>
                    </div>
                    <div class="card-body">

                        <table id="today_orders_table" class="table table-bordered dt-responsive  nowrap w-100">
                            <thead>
                            <tr>
                                <th class="bg-soft-info">Order ID</th>
                                <th class="bg-soft-info">Customer</th>
                                <th class="bg-soft-info">Sales Agent</th>
                                <th class="bg-soft-info">Order Date</th>
                                <th class="bg-soft-info">Amount</th>
                                <th class="bg-soft-info">Action</th>
                            </tr>
                            </thead>

                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-1"></div>
        </div>


    </div>

@endsection

@section('scripts')

   

@endsection
