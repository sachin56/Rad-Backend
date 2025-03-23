<div class="row ">
    <div class="col-lg-6">
        <div>
            <div class="mb-3">
                <label class="form-label" for="firstName">First Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="firstName" name="firstName"
                       @if(isset($user)) value="{{$user->firstName}}" @endif required>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div>
            <div class="mb-3">
                <label class="form-label" for="lastName">Last Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="lastName" name="lastName"
                       @if(isset($user)) value="{{$user->lastName}}" @endif required>
            </div>
        </div>
    </div>
</div>
<div class="row ">
    <div class="col-lg-6">
        <div>
            <div class="mb-3">
                <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="email" name="email"
                       @if(isset($user)) value="{{$user->email}}" @endif required>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div>
            <div class="mb-3">
                <label class="form-label" for="userRoleId">User Role <span class="text-danger">*</span></label>
                <select class="form-control" name="userRoleId" id="userRoleId" required>
                    <option> - Please Select User Role -</option>
                    @if(isset($roles) && count($roles) > 0)
                        @foreach($roles as $role)
                            @if($role->name != 'super-admin')
                                <option value="{{$role->id}}"
                                        @if(isset($user) && ($user->userRoleId == $role->id)) selected @endif>{{$role->name}}</option>
                            @endif
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
    </div>
</div>

<div class="mt-4 mb-4 d-flex justify-content-end">
    <button type="submit" class="btn btn-primary w-md" id="save_user_btn">Submit</button>
</div>
