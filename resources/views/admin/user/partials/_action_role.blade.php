@can('role-edit')
    @if($role->name != 'super-admin')
        <a class="btn btn-warning" href="{{route('admin.user-role-edit', $role->id)}}">Edit</a>
    @endif
@endcan
