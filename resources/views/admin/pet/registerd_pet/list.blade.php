@extends('layouts.app')
@section('title')
    {{__('All Registerd Pet')}}
@endsection

@section('breadcrumb')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">All Registerd Pet </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                                <li class="breadcrumb-item active">All Registerd Pet</li>
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
    <div class="row mb-4">
        <div class="col-lg-1"></div>
        <div class="col-lg-12 ">
            <div class="card pb-4">
                {{-- <div class="card-header">
                    <h4 class="card-title">All Registerd Pet</h4>

                </div> --}}
                <div class="card-body">

                    <table id="dt-basic-example" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="bg-soft-info">#</th>
                            <th class="bg-soft-info">User Name</th>
                            <th class="bg-soft-info">Pet Name</th>
                            <th class="bg-soft-info">Pet Breead</th>
                            <th class="bg-soft-info">Edit</th>
                            <th class="bg-soft-info">activation</th>
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
@endsection
@section('scripts')

    <script>
        $(document).ready(function(){
            //csrf token error
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(function () {
                $('.select2').select2();
            });
    
            var table = $('#dt-basic-example').dataTable({
                processing: true,
                serverSide: true,
                ordering: false,
                searching: true,
                ajax: {
                    url: "{{ route('registerd-pet.get-pet') }}",
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id',
                        className: 'text-center',
                         width: '5%'
                    },
                    {
                        data: 'username',
                        name: 'username',
                        className: 'text-center',
                        orderable: false,
                         width: '15%'
                    },
                    {
                        data: 'petname',
                        name: 'petname',
                        className: 'text-center',
                        orderable: false,
                         width: '15%'
                    },
                    {
                        data: 'breed',
                        name: 'breed',
                        className: 'text-center',
                        orderable: false,
                         width: '15%'
                    },
                    {
                        data: 'edit',
                        name: 'edit',
                        className: 'text-center',
                        orderable: false,
                        searchable: false,
                         width: '10%'
                    },
                    {
                        data: 'activation',
                        name: 'activation',
                        className: 'text-center',
                        orderable: false,
                        searchable: false,
                         width: '10%'
                    },

                ],
                // Make sure table width remains consistent
                scrollX: true,
                scrollCollapse: true,
                autoWidth: false
            });



        });

        function submitDeleteForm(form) {
            new Swal({
                    title: "Are you sure?",
                    text: "to delete this Banner?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes Delete",
                    cancelButtonText: "Cancel",
                    closeOnConfirm: false,
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                })
            return false;
        }

        </script>
@endsection
