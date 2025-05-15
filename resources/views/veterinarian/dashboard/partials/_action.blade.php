<td>
    <div class="btn-group" role="group">
        <button id="btnGroupVerticalDrop1" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Action <i class="mdi mdi-chevron-down"></i>
        </button>
        <div class="dropdown-menu" aria-labelledby="btnGroupVerticalDrop1">
            <a class="dropdown-item" href="{{route('admin.view-order', $order->id)}}">View</a>
            <form method="POST" action="{{route('admin.cancel-order', $order->id)}}"
                  class="d-inline"
                  onsubmit="return submitOrderCancelForm(this)">
                @csrf
                @method('put')
                <button type="submit" class="btn dropdown-item">
                    Accept
                </button>
            </form>
            <form method="POST" action="{{route('admin.cancel-request-reject', $order->id)}}"
                  class="d-inline"
                  onsubmit="return submitOrderCancelRejectForm(this)">
                @csrf
                @method('put')
                <button type="submit" class="btn dropdown-item">
                    Reject
                </button>
            </form>
        </div>
    </div>

</td>
