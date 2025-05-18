
    <input type="button" class="btn btn-warning  m-2" value="Edit" @if(isset($menu)) data-value="{{$menu['id']}}"
           @endif data-bs-toggle="modal" data-bs-target="#brandEditModal_{{$menu['id']}}">


    <form method="POST" action="{{route('categories.delete', $menu->id)}}" class="d-inline"
          onsubmit="return submitDeleteForm(this)">
        @csrf
        @method('delete')
        <input type="submit" class="btn btn-danger delete_brand" value="Delete">
    </form>


@include('shopvendor.categories.partials.brand.modals._edit')
