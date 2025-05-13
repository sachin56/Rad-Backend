<div class="modal fade" id="brandEditModal_{{$data['id']}}" data-bs-backdrop="static" data-bs-keyboard="false"
     tabindex="-1" role="dialog" aria-labelledby="brandEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl d-flex justify-content-center" role="document">
        <form method="post" enctype="multipart/form-data" id="brandEditForm_{{$data['id']}}"
              action="{{ route('booking-location.update', $data['id']) }}">
            @csrf
            @method('put')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="brandEditModalLabel">Edit Booking Time</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Doctor Name -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="doctorId">Doctor Name</label>
                                <select class="form-control" id="doctor_id" name="doctorId" required>
                                    <option value="">Select Doctor</option>
                                    @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->id }}" {{ $data['doctor_id'] == $doctor->id ? 'selected' : '' }}>
                                            {{ $doctor->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Date & Time -->
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="location">Location</label>
                                <input type="text"
                                       value="{{ $data['location'] }}"
                                       class="form-control"
                                       id="location"
                                       name="location" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Change</button>
                </div>
            </div>
        </form>
    </div>
</div>
