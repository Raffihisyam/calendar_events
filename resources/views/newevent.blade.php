{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar'); // Ganti 'calendar' dengan id elemen kalender Anda
        var calendar = new FullCalendar.Calendar(calendarEl, {
            // Opsi kalender...
        });

        // Mengubah tampilan ke 'dayGridMonth'
        calendar.changeView('event');
    });
</script> --}}
{{-- <meta http-equiv="refresh" content="1"> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    {{-- <meta http-equiv="refresh" content="3"> --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="refresh" content="10">
    <title>Document</title>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <div id="child">
        @include('event')
    </div>
    <script>
        // setInterval(function() {
        //     $('#child').load('views/event.blade.php #child');
        // }, 10000);
        // function autorefresh(t) {
        //     setTimeout("location.reload(true)", t)
        // }
        // setTimeout(() => {
        //     location.reload(true)
        // }, 5000);
    </script>


</body>

</html>
