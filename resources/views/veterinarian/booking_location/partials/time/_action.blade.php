
    <input type="button" class="btn btn-warning  m-2" value="Edit" @if(isset($data)) data-value="{{$data['id']}}"
           @endif data-bs-toggle="modal" data-bs-target="#brandEditModal_{{$data['id']}}">

    <form method="POST" action="{{route('booking-location.delete', $data->id)}}" class="d-inline"
          onsubmit="return submitDeleteForm(this)">
        @csrf
        @method('delete')
        <input type="submit" class="btn btn-danger delete_brand" value="Delete">
    </form>


@include('veterinarian.booking_location.partials.time.modals._edit')
