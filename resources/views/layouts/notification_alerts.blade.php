<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    $(function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        @if (Session::has('success'))
            Toast.fire({
                icon: 'success',
                title: "{{ Session::get('success') }}",
                //background: '#dff0d8',
                color: '#3c763d',
            })
            @php
                Session::forget('success');
            @endphp
        @endif


        @if (Session::has('error'))

            Toast.fire({
                icon: 'error',
                title: "{{ Session::get('error') }}",
                //background: '#f2dede',
                color: '#a94442',
            })
            @php
                Session::forget('error');
            @endphp
        @endif

        @if ($errors->any())

            @foreach ($errors->all() as $error)
                Toast.fire({
                    icon: 'error',
                    title: "{{ $error }}",
                    //background: '#f2dede',
                    color: '#a94442',
                })
            @endforeach

            @php
                Session::forget('error');
            @endphp
        @endif
    });

    // Notification start
    var translations = `{!! session('trans') !!}`;

    function trans(key) {
        var trans = JSON.parse(translations);
        return (trans[key] != null ? trans[key] : key);
    }

    $(document).ready(function() {
        var notificationListUrl = window.location.origin + "/admin/notification";

        function load_unseen_new_order_notification() {
            $.ajax({
                url: notificationListUrl,
                method: 'GET',
                success: function(response) {
                    $('#order_notification_box').html('');

                    // Display Unread Notifications
                    if (response.unread.length > 0) {
                        $.each(response.unread, function(index, value) {
                            var message = value.data.data;
                            var title = value.data.title;
                            var url = value.data.url;
                            var view_url = "/admin/view-order/" + value.id;
                            var markAsReadUrl = "{{ route('mark-as-read', ':id') }}"
                                .replace(':id', value.id);
                            var deleteUrl =
                                "{{ route('notifications.delete', ['id' => '__ID__']) }}"
                                .replace('__ID__', value.id);

                            var html = `
                                <li class="p-3 mb-2 rounded shadow-sm notification-item unread bg-light" style="max-width: 500px; margin-left: auto; margin-right: auto;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="font-weight-bold text-primary">● ${title}</span>
                                            <p class="mb-1 text-dark">${message}</p>
                                            <small class="text-muted">${new Date(value.created_at).toLocaleString()}</small>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <a href="${url}" class="mx-2 text-muted" title="View Order" target="_blank">
                                                <i class="fal fa-eye"></i>
                                            </a>
                                            <a href="${markAsReadUrl}" class="mx-2 text-muted" title="Mark as read">
                                                <i class="fal fa-check-circle"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="mx-2 text-muted delete-notification"
                                                data-id="${value.id}" title="Delete">
                                                <i class="fal fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>`;
                            $('#order_notification_box').append(html);
                        });
                    }

                    // Display Read Notifications
                    if (response.read.length > 0) {
                        $.each(response.read, function(index, value) {
                            var message = value.data.data;
                            var url = value.data.url;
                            var view_url = "/admin/view-order/" + value.id;
                            var deleteUrl =
                                "{{ route('notifications.delete', ['id' => '__ID__']) }}"
                                .replace('__ID__', value.id);

                            var html = `
                                <li class="p-3 mb-2 border rounded shadow-sm notification-item" style="max-width: 500px; margin-left: auto; margin-right: auto;">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="mb-1 text-dark">${message}</p>
                                            <small class="text-muted">${new Date(value.created_at).toLocaleString()}</small>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <a href="${url}" class="mx-2 text-muted" title="View Order" target="_blank">
                                                <i class="fal fa-eye"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="mx-2 text-muted delete-notification"
                                                data-id="${value.id}" title="Delete">
                                                <i class="fal fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>`;
                            $('#order_notification_box').append(html);
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error loading notifications:', error);
                }
            });
        }

        load_unseen_new_order_notification();

        setInterval(function() {
            load_unseen_new_order_notification();
        }, 30000);

        // DELETE Notification Function
        $(document).on('click', '.delete-notification', async function() {
            var notificationId = $(this).data('id');
            var deleteUrl = "{{ route('notifications.delete', ['id' => '__ID__']) }}".replace('__ID__', notificationId);

            // Confirm delete using Swal
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: deleteUrl,
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF Token
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Notification has been deleted.",
                                icon: "success",
                            });

                            // Reload notifications after deletion
                            load_unseen_new_order_notification();
                        },
                        error: function(xhr, status, error) {
                            console.error('Error deleting notification:', error);
                            Swal.fire({
                                title: "Error!",
                                text: "Failed to delete the notification. Try again.",
                                icon: "error",
                            });
                        }
                    });
                }
            });
        });

    });
</script>
