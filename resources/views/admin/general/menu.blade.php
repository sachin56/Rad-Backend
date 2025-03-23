@extends('layouts.app')
@section('title')
    {{__('Menu')}}
@endsection

@section('breadcrumb')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Menu </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Menu</li>
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
    @can('menu-create')
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10 ">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Create Menu</h4>
                        <p class="card-title-desc">Create new Menu/manufacture here.</p>
                    </div>
                    <div class="card-body p-4">
                        <form method="post" enctype="multipart/form-data" id="brandForm"
                              action="{{route('menu.store')}}">
                            @csrf
                            <div class="row ">
                                <div class="col-lg-6">
                                    <div>

                                        <div class="mb-3">
                                            <label class="form-label" for="name">Menu Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div>

                                        <div class="mb-3">
                                            <label class="form-label" for="logo">Menu Logo</label>
                                            <input type="file" class="form-control" id="logo" name="logo"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div>

                                        <div class="mb-3">
                                            <label class="form-label" for="backgroundImage">Menu Background Image</label>
                                            <input type="file" class="form-control" id="backgroundImage" name="backgroundImage"
                                                   required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div>

                                        <div class="mb-3">
                                            <label class="form-label" for="order">Menu Order</label>
                                            <input type="number" class="form-control" id="order" name="order"
                                                   required>
                                        </div>
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
    @endcan

    @can('menu-view')
        <div class="row mt-4 mb-4">
            <div class="col-lg-1"></div>
            @include('admin.general.partials.brand._view')
            <div class="col-lg-1"></div>
        </div>
    @endcan
@endsection
@section('scripts')

<script>
    $(document).ready(function() {
        var table = $('#dt-basic-example').dataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            searching: true,
            ajax: {
                url: "{{ route('menu.get-menu') }}",
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id',
                    className: 'text-center',
                       width: '5%'
                },
                {
                    data: 'name',
                    name: 'name',
                    className: 'text-center',
                    orderable: false,
                       width: '15%'
                },
                {
                    data: 'logo',
                    name: 'logo',
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                       width: '15%'
                },
                {
                    data: 'activation',
                    name: 'activation',
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                       width: '10%'
                },
                {
                    data: 'action',
                    name: 'action',
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
                text: "to delete this menu category?",
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
