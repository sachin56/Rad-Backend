@extends('veterinarian.layouts.app')
@section('title')
    {{__('View Appointments Edit')}}
@endsection

@section('breadcrumb')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">View Appointment Edit </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">View Appointment Edit</li>
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
        <div class="col-lg-12 ">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-10">
                            <h4 class="card-title">View E-Book</h4>
                            <p class="card-title-desc">View E-Book here.</p>
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
                                        <label class="form-label" for="lfCode">Pet Name</label>
                                        <input type="text" class="form-control" id="name" readonly
                                               name="name" @if(isset($appointment)) value="{{$appointment->pet->name ?? null}}"
                                               @endif required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Appointment Time</label>
                                        <input type="text" class="form-control" id="email" name="email"
                                              @if(isset($appointment)) value="{{$appointment->appointmentTime->time ?? null}}"
                                               @endif readonly required>
                                    </div>
                                </div>
                            </div>
                        </div>    
                        <div class="row ">
                            <div class="col-lg-12">
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Appointment Location</label>
                                        <input type="text" class="form-control" id="email" name="email"
                                              @if(isset($appointment)) value="{{$appointment->location->location ?? null}}"
                                               @endif readonly required>
                                    </div>
                                </div>
                            </div>
                        </div> 

                    </form>
                    <div class="row justify-content-end">
                        <div class="col-auto">
                            <a href="{{ route('appointment.index') }}" class="btn btn-info w-100">
                                <i class="bi bi-arrow-left-circle-fill me-1"></i> Back
                            </a>
                        </div>
                        {{-- Show Approve button only if not already approved --}}
                        @if($appointment->appointment_status != 'A'&& ($appointment->appointment_status == null))
                            <div class="col-auto">
                                <form method="POST" action="{{ route('appointment.status-change') }}">
                                    @csrf
                                    <input type="hidden" name="appointmentId" value="{{ $appointment->id }}">
                                    <input type="hidden" name="appointmentStatus" value="A">
                                    <button type="submit" class="btn btn-success w-100">
                                        <i class="bi bi-check-circle-fill me-1"></i> Approve
                                    </button>
                                </form>
                            </div>
                        @endif

                        {{-- Show Reject button only if not already rejected --}}
                        @if($appointment->appointment_status != 'R' && ($appointment->appointment_status == null))
                            <div class="col-auto">
                                <form method="POST" action="{{ route('appointment.status-change') }}">
                                    @csrf
                                    <input type="hidden" name="appointmentId" value="{{ $appointment->id }}">
                                    <input type="hidden" name="appointmentStatus" value="R">
                                    <button type="submit" class="btn btn-danger w-100">
                                        <i class="bi bi-x-circle-fill me-1"></i> Reject
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
