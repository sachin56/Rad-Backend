@can('menu-edit')
    <input type="button" class="btn btn-warning  m-2" value="Edit" @if(isset($menu)) data-value="{{$menu['id']}}"
           @endif data-bs-toggle="modal" data-bs-target="#brandEditModal_{{$menu['id']}}">
@endcan

@can('menu-delete')
    <form method="POST" action="{{route('menu.delete', $menu->id)}}" class="d-inline"
          onsubmit="return submitDeleteForm(this)">
        @csrf
        @method('delete')
        <input type="submit" class="btn btn-danger delete_brand" value="Delete">
    </form>
@endcan

@include('admin.general.partials.brand.modals._edit')
