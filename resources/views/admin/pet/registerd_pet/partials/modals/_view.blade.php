<div class="modal fade" id="productViewModal_{{$product['id']}}" data-bs-backdrop="static" data-bs-keyboard="false"
     tabindex="-1"
     role="dialog" aria-labelledby="productViewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productViewModalLabel">Product View</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row ">
                    <div class="row">
                        <div class="col-lg-3">
                            <p class="font-size-14"><strong>Product Image: </strong></p>
                        </div>
                        <div class="col-lg-9">
                            <img src="{{$imageUrl}}" style="width: 40%;"/>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-lg-3">
                            <p class="font-size-14"><strong>Product Name: </strong></p>
                        </div>
                        <div class="col-lg-9">
                            <p class="font-size-14"> {{ $product['name'] }} </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <p class="font-size-14"><strong>Part Number (Code): </strong></p>
                        </div>
                        <div class="col-lg-9">
                            <p class="font-size-14"> {{ $product['lfCode'] }} </p>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-lg-3">
                            <p class="font-size-14"><strong>Brand Part Number: </strong></p>
                        </div>
                        <div class="col-lg-9">
                            <p class="font-size-14"> {{ $product['brandPartNumber'] }} </p>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-lg-3">
                            <p class="font-size-14"><strong>Brand: </strong></p>
                        </div>
                        <div class="col-lg-9">
                            <p class="font-size-14">
                                @if(is_null($product['brand']))
                                    {{ '' }}
                                @else
                                    {{ $product['brand']->brandName }}
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <p class="font-size-14"><strong>Retail Price Discount: </strong></p>
                        </div>
                        <div class="col-lg-9">
                            @if($product['retail_type'] == 2)
                             {{number_format($product['retail_price'], 2) . ' %'}}
                            @else
                             {{number_format($product['retail_price'], 2, ".", ",")}}
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <p class="font-size-14"><strong>Wholesale Price: </strong></p>
                        </div>
                        <div class="col-lg-9">
                            <p class="font-size-14"> {{ number_format($product['wholesale_price'], 2, ".", ",") }} </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <p class="font-size-14"><strong>Technical Note: </strong></p>
                        </div>
                        <div class="col-lg-9">
                            <p class="font-size-14"> {{ $product['technicalNote'] }} </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            @if(isset($product['compatibleBrand']) && count($product['compatibleBrand']) > 0)
                                <table
                                    class="table table-bordered table-striped table-hover dt-responsive">
                                    <caption style="caption-side: top;">Compatible Brands </caption>
                                    <thead>
                                    <tr>
                                        <th class="bg-soft-info">Compatible Brand</th>
                                        <th class="bg-soft-info">Compatible Part</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($product['compatibleBrand'] as $cBrand)
                                        <tr>
                                            <td>{{$cBrand['cBrand']->brandName}}</td>
                                            <td>{{$cBrand->compatiblePartName}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            @if(isset($product['productRange']) && count($product['productRange']) > 0)
                                <table
                                    class="table table-bordered table-striped table-hover dt-responsive">
                                    <caption style="caption-side: top;"> Complete Product Range </caption>
                                    <thead>
                                    <tr>
                                        <th class="bg-soft-info">Code</th>
                                        <th class="bg-soft-info">Name</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($product['productRange'] as $pro)
                                        <tr>
                                            <td>{{$pro['rProduct']->lfCode}}</td>
                                            <td>{{$pro['rProduct']->name}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
