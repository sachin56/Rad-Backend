<div class="modal fade" id="brandEditModal_{{$clinics['id']}}" data-bs-backdrop="static" data-bs-keyboard="false"
     tabindex="-1"
     role="dialog" aria-labelledby="brandEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl d-flex justify-content-center" role="document">
        <form method="post" enctype="multipart/form-data" id="brandEditForm"
              action="{{route('clinics.update', $clinics->id)}}">
            @csrf
            @method('put')
            <div class="modal-content" id="modalContent"
                 >
                <div class="modal-header">
                    <h5 class="modal-title" id="brandEditModalLabel">Edit Clinics</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Brand Name -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="brandName">Clinics Name</label>
                                <input type="text" class="form-control" id="edit_brandName" name="name"
                                       @if(isset($clinics)) value="{{$clinics->name}}" @endif required>
                            </div>
                        </div>

                        <!-- Brand Logo Upload -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="brandLogo">Clinics Logo</label>
                                <input type="file" class="form-control" id="edit_brandLogo" name="logo">
                                <div class="mt-3">
                                    <img id="imagePreview" src="{{ $clinics->logoUrl }}" width="150px"
                                         style="display: {{ $clinics->logoUrl ? 'block' : 'none' }};" alt="Brand Logo Preview">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Change</button>
                </div>
            </div>
        </form>
    </div>
</div>
