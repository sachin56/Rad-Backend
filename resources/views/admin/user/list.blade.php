@extends('layouts.app')
@section('title')
    {{__('All Users')}}
@endsection

@section('breadcrumb')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">All Users </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">All Users</li>
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
    @can('user-view')
        <div class="row mb-4">
            <div class="col-lg-1"></div>
            @include('admin.user.partials._table')
            <div class="col-lg-1"></div>
        </div>
    @endcan
@endsection
@section('scripts')
    <script src="{{url(env('ASSETS_PATH').'/js/admin/user.js')}}"></script>
@endsection
