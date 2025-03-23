<div class="row mb-3">
    <div class="col-lg-6">
        <div>
            <div class="mb-3">
                <label class="form-label" for="name">Role
                    Name</label>
                <input type="text" class="form-control" id="name" name="name" @if(isset($role)) value="{{$role->name}}"
                       @endif required>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-10">
        @if(isset($userPermission) && count($userPermission) > 0)
            {{--@foreach($userPermission->chunk(4) as $chunkRow)
                <div class="row">--}}
            @foreach($userPermission as $key=>$cp)
                @if(str_contains($cp['name'], 'management'))
                    <div class="col-lg-3 @if($key != 0) pt-4 @endif">
                        <div class="form-check form-switch pb-2">
                            <input class="form-check-input" type="checkbox" id="permission_id_{{$cp['id']}}"
                                   name="permission_id[]" value="{{$cp['id']}}"
                                   @if(isset($role['hasRole']) && in_array($cp['id'], $permissions)) checked @endif>
                            <label class="form-check-label" for="permission_id_{{$cp['id']}}">{{$cp['name']}}</label>
                        </div>
                    </div>
                @else
                    <div class="col-lg-3">
                        <div class="form-check form-switch pb-2">
                            <input class="form-check-input" type="checkbox" id="permission_id_{{$cp['id']}}"
                                   name="permission_id[]" value="{{$cp['id']}}"
                                   @if(isset($role['hasRole']) && in_array($cp['id'], $permissions)) checked @endif>
                            <label class="form-check-label" for="permission_id_{{$cp['id']}}">{{$cp['name']}}</label>
                        </div>
                    </div>
                @endif
            @endforeach
            {{--</div>
        @endforeach--}}
        @endif
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="mb-4">
            <label class="form-label" for="submit_btn" style="visibility: hidden;">Submit</label><br>
            <button type="submit" id="submit_btn" class="btn btn-primary w-md">Submit</button>
        </div>
    </div>
</div>
