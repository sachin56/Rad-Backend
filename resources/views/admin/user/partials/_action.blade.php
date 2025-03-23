@if($user['role']->name != 'super-admin')
    <div class="dropdown">
        <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown">Action
            <span class="fa fa-caret-down"></span>
        </button>
        <ul class="dropdown-menu">
            @can('user-edit')
                <li>
                    <a class="btn dropdown-item" href="{{route('admin.user-edit', $user['id'])}}">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                </li>
            @endcan
            @can('user-delete')
                <li>
                    <form method="POST" action="{{route('admin.user-delete', $user->id)}}" class="d-inline"
                          onsubmit="return submitUserDeleteForm(this)">
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
@endif
