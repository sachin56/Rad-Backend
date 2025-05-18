<div class="modal fade" id="brandEditModal_{{$menu['id']}}" data-bs-backdrop="static" data-bs-keyboard="false"
     tabindex="-1"
     role="dialog" aria-labelledby="brandEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl d-flex justify-content-center" role="document">
        <form method="post" enctype="multipart/form-data" id="brandEditForm"
              action="{{route('products.update', $menu->id)}}">
            @csrf
            @method('put')
            <div class="modal-content" id="modalContent"
                 >
                <div class="modal-header">
                    <h5 class="modal-title" id="brandEditModalLabel">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   <div class="row ">
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Shop Category </label>
                                        <select class="form-control" id="categoryId" name="categoryId" required>
                                            <option value=""> Select Category</option>
                                            @if(isset($categories) && $categories->count() > 0)
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $menu->category_id == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>          
                                                @endforeach
                                            @endif
                                            <!-- Add more options as needed -->
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Product Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{$menu->name}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label" for="logo">Product Image</label>
                                        <input type="file" class="form-control" id="logo" name="logo"  >
                                        <div class="mt-3">
                                            <img id="imagePreview" src="{{ $menu->logoUrl }}" width="150px"
                                                style="display: {{ $menu->logoUrl ? 'block' : 'none' }};" alt="Brand Logo Preview">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Product Price</label>
                                        <input type="text" class="form-control" id="price" name="price" value="{{$menu->price}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Product Quantity</label>
                                        <input type="number" class="form-control" id="quantity" value="{{$menu->quantity}}" name="quantity" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div>
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Product Description</label>
                                        <textarea type="number" class="form-control" id="description" name="description" required>{{$menu->description}}</textarea>
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
