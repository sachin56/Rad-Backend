@if(isset($role['hasRole']) && count($role['hasRole']) > 0)
    @foreach($role['hasRole']->chunk(4) as $chunkPer)
        <div class="col-lg-12" style="margin-bottom: -15px !important;">
            <div class="row">
                @foreach($chunkPer as $per)
                    <div class="col-md-3">
                        <ul>
                            <li>{{$per['permission']->name}}</li>
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
@endif
