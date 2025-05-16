<input type="button" class="btn btn-warning  m-2" value="View" @if(isset($menu)) data-value="{{$menu['id']}}"
           @endif data-bs-toggle="modal" data-bs-target="#brandEditModal_{{$menu['id']}}">


@include('petsitter.approval.partials.brand.modals._edit')
