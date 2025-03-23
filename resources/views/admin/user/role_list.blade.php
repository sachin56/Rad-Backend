@extends('layouts.app')

@section('title')
    {{__('User Role')}}
@endsection

@section('breadcrumb')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Users </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">User Role</li>
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
    @can('role-view')
        <div class="row mt-4 mb-4">
            <div class="col-lg-1"></div>
            <div class="col-lg-12">
                <div class="card pb-4">
                    <div class="card-header">
                        <h4 class="card-title">All User Roles</h4>

                    </div>
                    <div class="card-body">

                        <table id="user_role_table"
                               class="table table-bordered table-striped table-hover dt-responsive  nowrap w-100">
                            <thead>
                            <tr>
                                <th class="bg-soft-info">Role Name</th>
                                <th class="bg-soft-info">Permissions</th>
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
    @endcan
@endsection
@section('scripts')
    <script src="{{url('assets/js/admin/user_role.js')}}"></script>
@endsection
