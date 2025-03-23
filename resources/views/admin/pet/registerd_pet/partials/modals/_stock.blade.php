<div class="modal fade" id="stockUpdateModal_{{$product['id']}}" data-bs-backdrop="static" data-bs-keyboard="false"
     tabindex="-1"
     role="dialog" aria-labelledby="stockUpdateModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg modal-dialog-centered " role="document" >
        <form method="post" id="stockEditForm"
              action="{{route('admin.stock-update', $product->id)}}">
            @csrf
            @method('put')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="stockUpdateModalLabel">Update Stock</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @if(!is_null($stock))
                            <p>
                                Remaining stock quantity : {{ $stock->qty }}
                            </p>
                        @else
                            <p>
                                This Product has no stock currently.
                            </p>
                        @endif

                    </div>
                    <div class="row ">
                        <input type="hidden" id="hid" name="hid" value="{{$product->id}}">
                        <div class="col-lg-3">
                            <div>
                                <div class="mb-3">
                                    <label class="form-label" for="qty">Add Color</label>
                                    <select class="form-control select2" name="color[]" id="color" required>
                                        @if(isset($colors))
                                            <option selected>Select Colors</option>
                                            @foreach ($colors as $color)
                                                <option value="{{$color->id}}" style="background-color:#4BB543 !important;"><li><a href="#"><span style='width:10px; height:10px; background-color:red;display:inline-block;'></span> Red</a></li></option>
                                            @endforeach   
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div>
                                <div class="mb-3">
                                    <label class="form-label" for="productFamilyId">Size</label>
                                    <select class="form-control select2" name="size[]" id="size" required>
                                    @if(isset($size))
                                        <option selected>Select Size</option>
                                        @foreach ($size as $sizes)
                                            <option value="{{$sizes->relatedProductSize->id}}">{{$sizes->relatedProductSize->product_size}}</option>
                                        @endforeach   
                                     @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div>
                                <div class="mb-3">
                                    <label class="form-label" for="qty">Add / Update Stock</label>
                                    <input type="text" class="form-control" id="qty_{{ $product['id'] }}" name="qty[]" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div>
                                <div class="mb-3">
                                    <br>
                                    <button type="button" class="btn btn-primary addnew btn-sm">Add New</button>
                                    <button type="button" class="btn btn-danger remove btn-sm">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="1" id="total_chq" name="total_chq">
                    <div  id="image_check_append"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Change</button>
                </div>
            </div>
        </form>
    </div>
