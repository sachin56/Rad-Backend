<div class="dropdown">
    <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown">Action
        <span class="fa fa-caret-down"></span>
    </button>
    <ul class="dropdown-menu">
        @can('product-view')
            <li>
                <a class="btn dropdown-item" data-bs-toggle="modal"
                   data-bs-target="#productViewModal_{{$product['id']}}">
                    <i class="fa fa-eye"></i> View
                </a>
            </li>
        @endcan
        @can('product-edit')
            <li>
                <a class="btn dropdown-item" href="{{route('admin.product-edit', $product['id'])}}">
                    <i class="fa fa-edit"></i> Edit
                </a>
            </li>
        @endcan
        @can('stock-edit')
            <li>
                <a class="btn dropdown-item" data-bs-toggle="modal"
                   data-bs-target="#stockUpdateModal_{{$product['id']}}">
                    <i class="fa fa-eye"></i> Add Stock
                </a>
            </li>
        @endcan
        @can('stock-view')
            <li>
                <a class="btn dropdown-item" data-bs-toggle="modal"
                   data-bs-target="#stockHistoryModal_{{$product['id']}}">
                    <i class="fa fa-eye"></i> Stock History
                </a>
            </li>
        @endcan
        @can('product-delete')
            <li>
                <form method="POST" action="{{route('admin.product-delete', $product->id)}}" class="d-inline"
                      onsubmit="return submitProductDeleteForm(this)">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn dropdown-item">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </form>
            </li>
        @endcan
    </ul>
</div>
@include('admin.product.partials.modals._view')
@include('admin.product.partials.modals._stock')
@include('admin.product.partials.modals._stock_history')
