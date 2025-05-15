@extends('shopvendor.layouts.app')
@section('title')
    {{__('Profile')}}
@endsection

@section('breadcrumb')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Profile </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10 ">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Update Profile</h4>
                    <p class="card-title-desc">Create new Profile/manufacture here.</p>
                </div>
                <div class="card-body p-4">
                    <form method="post" enctype="multipart/form-data" id="brandForm"
                            action="{{route('shop-vendor.profile.store')}}">
                        @csrf
                        <div class="row ">
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label" for="name">User Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ Auth::guard('shopvendor')->user()->name ?? null}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Shop Name</label>
                                        <input type="text" class="form-control" id="shopname" name="shopname" value="{{ Auth::guard('shopvendor')->user()->shop_name ?? null}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Shop Address</label>
                                        <input type="text" class="form-control" id="address" name="address" value="{{ Auth::guard('shopvendor')->user()->address ?? null}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Shop Phone Number</label>
                                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="{{ Auth::guard('shopvendor')->user()->phone_number ?? null}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label" for="logo">Shop Logo</label>
                                        <input type="file" class="form-control" id="logo" name="logo" required>
                                    </div>
                                    @php
                                         $logoUrl = (new App\Helpers\StorageHelper('shopvendor', Auth::guard('shopvendor')->user()->logo))->getUrl();
                                    @endphp
                                    @if(isset($logoUrl))
                                    <div class="mt-3">
                                        <img id="imagePreview" src="{{ $logoUrl }}" width="150px"
                                            style="display: {{ $logoUrl ? 'block' : 'none' }};" alt="Brand Logo Preview">
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-12 ">
                            <div>
                                <div class="mt-4 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary w-md">Submit</button>
                                </div>
                            </div>
                        </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-1"></div>
    </div>

@endsection
@section('scripts')

@endsection
