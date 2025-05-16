@extends('petsitter.layouts.app')
@section('title')
    {{__(' Pet Sitter')}}
@endsection

@section('breadcrumb')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18"> Pet Sitter </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active"> Pet Sitter</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div>
@endsection

@section('content')
    

    <div class="row mt-4 mb-4">
        <div class="col-lg-1"></div>
            @include('petsitter.approval.partials.brand._view')
        <div class="col-lg-1"></div>
    </div>

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
                url: "{{ route('apporoval.get-apporoval') }}",
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'id',
                    className: 'text-center',
                       width: '5%'
                },
                {
                    data: 'userName',
                    name: 'userName',
                    className: 'text-center',
                    orderable: false,
                       width: '15%'
                },
                {
                    data: 'petName',
                    name: 'petName',
                    className: 'text-center',
                    orderable: false,
                    searchable: false,
                       width: '15%'
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
                text: "to delete this category?",
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
