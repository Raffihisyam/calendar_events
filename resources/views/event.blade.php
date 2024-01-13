<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css"
        integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Kalender</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12 mt-3">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
    <div id="modal-action" class="modal" tabindex="-1">

    </div>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.8/index.global.min.js'></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"
        integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('65e8886dcf7c70f50f10', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('calendar');
        channel.bind('events-calendar', function(data) {
            //alert(JSON.stringify(data));
        });
    </script>

    <script>
        const modal = $('#modal-action')
        const csrfToken = $('meta[name=csrf_token]').attr('content');
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                themeSystem: 'bootstrap5',
                events: `{{ route('events.list') }}`,
                editable: true,
                dateClick: function(info) {
                    $.ajax({
                        url: '{{ route('events.create') }}',
                        data: {
                            start_date: info.dateStr,
                            end_date: info.dateStr
                        },

                        success: function(res) {
                            $('#form-action').on('submit', function(event) {
                                event.preventDefault();
                                const form = this;
                                const formData = new FormData(form)
                                $.ajax({
                                    url: form.action,
                                    method: form.method,
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function(res) {
                                        modal.modal('hide');
                                        calendar.refetchEvents();
                                    }
                                });
                            })
                            modal.html(res);
                            modal.modal('show');

                        }
                    })
                },
                eventClick: function(info) {
                    const event = info.event;
                    $.ajax({
                        url: `{{ url('events') }}/${event.id}/edit`,

                        success: function(res) {
                            $('#form-action').on('submit', function(event) {
                                event.preventDefault();
                                const form = this;
                                const formData = new FormData(form)
                                $.ajax({
                                    url: form.action,
                                    method: form.method,
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function(res) {
                                        modal.modal('hide');
                                        calendar.refetchEvents();
                                    }
                                });
                            })
                            modal.html(res);
                            modal.modal('show');

                        }
                    })
                },
                eventDrop: function(info) {
                    const event = info.event
                    $.ajax({
                        url: `{{ url('events') }}/${event.id}`,
                        method: 'PUT',
                        data: {
                            id: event.id,
                            start_date: event.startStr,
                            end_date: event.end.toISOString().substring(0, 10),
                            title: event.title,
                            category: event.extendedProps.category


                        },
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            accept: 'application/json'

                        },
                        success: function(res) {
                            iziToast.success({
                                title: 'success',
                                message: res.message,
                                position: 'topRight',
                            });
                        },
                        error: function(res) {
                            const message = res.responseJSON.message
                            info.revert()
                            iziToast.error({
                                title: 'Error',
                                message: message ?? "Something went wrong",
                                position: 'topRight',
                            });
                        }
                    })
                },
                eventResize: function(info) {
                    const event = info.event;
                    $.ajax({
                        url: `{{ url('events') }}/${event.id}`,
                        method: 'PUT',
                        data: {
                            id: event.id,
                            start_date: event.startStr,
                            end_date: event.end.toISOString().substring(0, 10),
                            title: event.title,
                            category: event.extendedProps.category


                        },
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            accept: 'application/json'

                        },
                        success: function(res) {

                            iziToast.success({
                                title: 'success',
                                message: res.message,
                                position: 'topRight',
                            });

                        },
                        error: function(res) {
                            const message = res.responseJSON.message;
                            info.revert()
                            iziToast.error({
                                title: 'Error',
                                message: message ?? "Something went wrong",
                                position: 'topRight',
                            });
                        }
                    })
                }
            });
            calendar.render();
        });
    </script>


</body>

</html>
