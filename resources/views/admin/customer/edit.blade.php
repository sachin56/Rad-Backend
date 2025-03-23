@extends('layouts.app')
@section('title')
    {{__('Customer Edit')}}
@endsection

@section('breadcrumb')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Customer Edit </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Customer Edit</li>
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
    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-10 ">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-10">
                            <h4 class="card-title">Edit Customer</h4>
                            <p class="card-title-desc">Edit Customer here.</p>
                        </div>
                        <div class="col-lg-2">
                            <a class="btn btn-info float-end" href="{{route('customer.index')}}">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form method="post" enctype="multipart/form-data" id="CustomerForm"
                          action="{{route('customer.update', $customer->id)}}">
                        @csrf
                        @method('put')
                        <div class="row ">
                            <div class="col-lg-6">
                                <div>
                                    <input type="hidden" value="{{$customer->id}}" name="hId" id="hId"/>
                                    <div class="mb-3">
                                        <label class="form-label" for="lfCode">Name</label>
                                        <input type="text" class="form-control" id="name"
                                               name="name" @if(isset($customer)) value="{{$customer->name}}"
                                               @endif required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Email</label>
                                        <input type="text" class="form-control" id="email" name="email"
                                               @if(isset($customer)) value="{{$customer->email}}" @endif readonly required>
                                    </div>
                                </div>
                            </div>
                        </div>    
                        <div class="row ">
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label" for="lfCode">Phone Number</label>
                                        <input type="text" class="form-control" id="phoneNumber"
                                               name="phoneNumber" @if(isset($customer)) value="{{$customer->phone_number}}"
                                               @endif required>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="mt-4 mb-4 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary w-md">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-1"></div>
    </div>
@endsection
@section('scripts')
    <script>


        
    </script>
@endsection
