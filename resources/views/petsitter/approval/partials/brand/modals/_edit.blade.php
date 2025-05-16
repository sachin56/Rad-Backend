<div class="modal fade" id="brandEditModal_{{$menu['id']}}" data-bs-backdrop="static" data-bs-keyboard="false"
     tabindex="-1"
     role="dialog" aria-labelledby="brandEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl d-flex justify-content-center" role="document">
    
            <div class="modal-content" id="modalContent"
                 >
                <div class="modal-header">
                    <h5 class="modal-title" id="brandEditModalLabel">View Pet Sitter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   <div class="row ">
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Pet Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{$menu->pet->name}}" readonly required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label" for="name">User Name</label>
                                        <input type="text" class="form-control" id="price" name="price" value="{{$menu->user->name}}" readonly required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Note</label>
                                        <textarea type="number" class="form-control" id="description" readonly name="description" required>{{$menu->note}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                <form  method="get" action="{{route('apporoval.change-status',$menu->id)}}" class="ml-2" id="checkOutForm">
                    @csrf
                    <input type="hidden" id="checkStatus" name="checkStatus" value="A" class="form-control" readonly>
                    <button type="submit" id="checkOutBtn" class="btn btn-success ml-2" >
                        <i class="fas fa-check"></i> Approve
                    </button>
                </form>

                <form  method="get" action="{{route('apporoval.change-status',$menu->id)}}" class="ml-2" id="checkInForm">
                    @csrf
                    <input type="hidden" id="checkStatus" name="checkStatus" value="R" class="form-control" readonly>
                    <button type="submit" id="checkInBtn" class="btn btn-danger ml-2" >
                        <i class="fas fa-door-open"></i> Reject
                    </button>
                </form>
                </div>
            </div>
 
    </div>
</div>
