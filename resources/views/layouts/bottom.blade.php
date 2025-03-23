<!-- JAVASCRIPT -->
<script src="{{url('assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{url('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{url('assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{url('assets/libs/node-waves/waves.min.js')}}"></script>
<script src="{{url('assets/libs/feather-icons/feather.min.js')}}"></script>

<!-- Required datatable js -->
<script src="{{url('assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<!-- Buttons examples -->
<script src="{{url('assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{url('assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{url('assets/libs/jszip/jszip.min.js')}}"></script>
<script src="{{url('assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
<script src="{{url('assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
<script src="{{url('assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{url('assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{url('assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- Responsive examples -->
<script src="{{url('assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>

<!-- sweet alert -->
<script src="{{url('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>

<!-- Datatable init js -->

<!-- pace js -->
<script src="{{url('assets/libs/pace-js/pace.min.js')}}"></script>

<script src="{{url('assets/js/app.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<!-- daterangepicker -->
<script src="{{ url('assets/libs/moment/moment.min.js') }}"></script>
<script src="{{ url('assets/libs/daterangepicker/daterangepicker.js') }}"></script>

<script>
    var translations = `{!! session("trans") !!}`;

    function trans(key) {
        var trans = JSON.parse(translations);
        return (trans[key] != null ? trans[key] : key);
    }

    $(document).ready(function () {
        // updating the view with notifications using ajax
        function load_unseen_new_order_notification() {
            $.ajax({
                url: url('admin/new-order-notifications'),
                method: "GET",
                dataType: "json",
                success: function (data) {
                    if (data.count > 0) {
                        var notify = data.notifications;
                        $("#new_order_count").html(data.count);
                        $('#order_notification_box').html('');
                        var view_url = null;
                        $.each(notify, function ($index, $value) {
                            view_url = url('admin/view-order/') + $value.id;
                            var html = '';
                            html += '<a href="' + view_url + '" class="text-reset notification-item new-order-update" data-id="' + $value.id + '">';
                            html += '<div class="d-flex">';
                            html += '<div class="flex-grow-1">';
                            html += '<h6 class="mb-1">Order No:</h6>';
                            html += '<div class="font-size-13 text-muted">';
                            html += '<p class="mb-1">' + $value.orderNo + '</p>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html += '</a>';
                            $('#order_notification_box').append(html);
                        });
                    }
                }
            });
        }

        function load_unseen_cancel_request_notification() {
            $.ajax({
                url: url('admin/cancel-request-notifications'),
                method: "GET",
                dataType: "json",
                success: function (data) {
                    if (data.count > 0) {
                        var notify = data.notifications;
                        $("#cancel_request_count").html(data.count);
                        $('#cancel_request_notification_box').html('');
                        var view_url = null;
                        $.each(notify, function ($index, $value) {
                            view_url = url('admin/view-order/') + $value.id;
                            var html = '';
                            html += '<a href="' + view_url + '" class="text-reset notification-item cancel-request-update" data-id="' + $value.id + '">';
                            html += '<div class="d-flex">';
                            html += '<div class="flex-grow-1">';
                            html += '<h6 class="mb-1">Order No:</h6>';
                            html += '<div class="font-size-13 text-muted">';
                            html += '<p class="mb-1">' + $value.orderNo + '</p>';
                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html += '</a>';
                            $('#cancel_request_notification_box').append(html);
                        });
                    }
                }
            });
        }

        load_unseen_new_order_notification();
        load_unseen_cancel_request_notification();
// load new notifications

        $(document).on('click', '.new-order-update', function () {
            $.ajax({
                url: url('admin/update-new-order-notification-status'),
                method: "GET",
                data: 'id=' + $(this).attr("data-id"),
                dataType: "json",
                success: function (data) {
                    load_unseen_new_order_notification();
                }
            });
        });

        $(document).on('click', '.cancel-request-update', function () {
            $.ajax({
                url: url('admin/update-cancel-request-notification-status'),
                method: "GET",
                data: 'id=' + $(this).attr("data-id"),
                dataType: "json",
                success: function (data) {
                    load_unseen_cancel_request_notification();
                }
            });
        });

        setInterval(function () {
            load_unseen_new_order_notification();
            load_unseen_cancel_request_notification();
        }, 30000);

    });
</script>
<!-- Main dashboard -->
<script src="{{ url('assets/js/admin/main.js')}}"></script>
