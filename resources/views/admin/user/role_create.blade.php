@extends('layouts.app')

@section('title')
    {{__('User Role Setup')}}
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
                                <li class="breadcrumb-item active">Create User Role</li>
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
    @can('role-create')
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Create User Role </h4>
                        <p class="card-title-desc">Create New User Role here.</p>
                    </div>
                    <div class="card-body p-4">
                        <form method="post" id="userRoleForm" action="{{route('admin.user-role-store')}}">
                            @csrf
                            @include('admin.user.partials._role_form')
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-1"></div>
        </div>
    @endcan
@endsection
