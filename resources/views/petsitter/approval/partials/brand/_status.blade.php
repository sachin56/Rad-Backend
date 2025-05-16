@if ($data->status == "P") 
    <span class="badge badge-warning text-white px-3 py-2 rounded-pill">Pending</span>
@elseif ($data->status == "A") 
    <span class="badge badge-success text-white px-3 py-2 rounded-pill">Approved</span>
@elseif ($data->status == "R") 
    <span class="badge badge-danger text-white px-3 py-2 rounded-pill">Rejected</span>
@else
    <span class="badge badge-secondary px-3 py-2 rounded-pill">N/A</span>';
@endif