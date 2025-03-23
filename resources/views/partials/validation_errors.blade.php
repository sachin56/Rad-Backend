<div class="row">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h5 class="text-danger">
                    <i class="fa fa-times"></i> {{__('Failed')}}
                </h5>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <h5 class="text-success">
                    <i class="fa fa-check"></i> {{__('Success')}}
                </h5>
                <p>
                    {{session()->get('success')}}
                </p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session()->has('failed'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h5 class="text-danger">
                    <i class="fa fa-times"></i> {{__('Failed')}}
                </h5>
                <p>
                    {{session()->get('failed')}}
                </p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
    <div class="col-lg-1"></div>
</div>
