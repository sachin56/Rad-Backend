@extends('layouts.app')
@section('title')
    {{__('Pet Edit')}}
@endsection

@section('breadcrumb')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Pet Edit </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Pet Edit</li>
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
                            <h4 class="card-title">Edit Pet</h4>
                            <p class="card-title-desc">Edit Pet here.</p>
                        </div>
                        <div class="col-lg-2">
                            <a class="btn btn-info float-end" href="{{route('registerd-pet.index')}}">Back</a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form method="post" enctype="multipart/form-data" id="PetForm"
                         >
                        @csrf
                        @method('put')
                        <div class="row ">
                            <div class="col-lg-6">
                                <div>
                                    <input type="hidden" value="{{$pet->id}}" name="hId" id="hId"/>
                                    <div class="mb-3">
                                        <label class="form-label" for="lfCode">User Name</label>
                                        <input type="text" class="form-control" id="name" readonly
                                               name="name" @if(isset($pet)) value="{{$pet->userName->name}}"
                                               @endif required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Pet Name</label>
                                        <input type="text" class="form-control" id="email" name="email"
                                               @if(isset($pet)) value="{{$pet->name}}" @endif readonly required>
                                    </div>
                                </div>
                            </div>
                        </div>    
                        <div class="row ">
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label" for="lfCode">Age</label>
                                        <input type="text" class="form-control" id="phoneNumber" readonly
                                               name="phoneNumber" @if(isset($pet)) value="{{$pet->age}}"
                                               @endif required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label" for="lfCode">Bread</label>
                                        <input type="text" class="form-control" id="phoneNumber" readonly
                                               name="phoneNumber" @if(isset($pet)) value="{{$pet->breed}}"
                                               @endif required>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="row ">
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label" for="lfCode">Gender</label>
                                        <input type="text" class="form-control" id="phoneNumber" readonly
                                               name="phoneNumber" @if(isset($pet)) value="{{$pet->gender}}"
                                               @endif required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label" for="lfCode">Weight</label>
                                        <input type="text" class="form-control" id="phoneNumber" readonly
                                               name="phoneNumber" @if(isset($pet)) value="{{$pet->weight}}"
                                               @endif required>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <!-- Medical Condition -->
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="medicalCondition">Medical Condition</label>
                                    <textarea class="form-control" id="medicalCondition" name="medical_condition" readonly required rows="3">@if(isset($pet)){{$pet->medical_condition}}@endif</textarea>
                                </div>
                            </div>
                        
                            <!-- Additional Note -->
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label" for="additionNote">Additional Note</label>
                                    <textarea class="form-control" id="additionNote" name="addition_note" readonly required rows="3">@if(isset($pet)){{$pet->addition_note}}@endif</textarea>
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
