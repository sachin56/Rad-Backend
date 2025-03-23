<div class="modal fade" id="stockHistoryModal_{{$product['id']}}" data-bs-backdrop="static" data-bs-keyboard="false"
     tabindex="-1"
     role="dialog" aria-labelledby="stockHistoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="stockHistoryModalLabel">Stock History</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row ">
                    <table id="stock_table"
                           class="table table-bordered table-striped table-hover dt-responsive  nowrap w-100">
                        <thead>
                        <tr>
                            <th class="bg-soft-info">Quantity</th>
                            <th class="bg-soft-info">Comment</th>
                            <th class="bg-soft-info">Updated Date</th>
                            <th class="bg-soft-info">User</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if(!is_null($stockLogs) && count($stockLogs) > 0)
                            @foreach($stockLogs as $stk)
                                <tr>
                                    <td>{{ $stk->qty }}</td>
                                    <td>{{ $stk->comment }}</td>
                                    <td>{{ \Carbon\Carbon::parse($stk->updated_at)->format('Y-m-d H:i:s') }}</td>
                                    <td>
                                        @if(isset($stk['user']))
                                            {{ $stk->user->firstName . ' ' . $stk->user->lastName }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
