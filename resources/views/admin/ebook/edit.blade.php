@extends('layouts.app')
@section('title')
    {{__('View E-Book Edit')}}
@endsection

@section('breadcrumb')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">View E-Book Edit </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">View E-Book Edit</li>
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
                            <h4 class="card-title">View E-Book</h4>
                            <p class="card-title-desc">View E-Book here.</p>
                        </div>
                        <div class="col-lg-2">
                            <a class="btn btn-info float-end" href="{{route('customer.index')}}">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form method="post" enctype="multipart/form-data" id="CustomerForm"
                          >
                        @csrf
                        @method('put')
                        <div class="row ">
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label" for="lfCode">Name</label>
                                        <input type="text" class="form-control" id="name" readonly
                                               name="name" @if(isset($ebook)) value="{{$ebook->petName->name}}"
                                               @endif required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Title</label>
                                        <input type="text" class="form-control" id="email" name="email"
                                               @if(isset($ebook)) value="{{$ebook->title}}" @endif readonly required>
                                    </div>
                                </div>
                            </div>
                        </div>    
                        <div class="row ">
                            <div class="col-lg-12">
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label" for="lfCode">Phone Number</label>
                                        <textarea class="form-control" id="phoneNumber" readonly
                                        name="phoneNumber" @if(isset($ebook))>{{$ebook->description}}@endif</textarea>
                                    </div>
                                </div>
                            </div>
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
