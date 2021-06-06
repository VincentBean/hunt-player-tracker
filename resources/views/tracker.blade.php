<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>Hunt Showdown: Player Tracker</title>

</head>
<body class="antialiased bg-gray-900">

    <div id="app">
        <tracker/>
    </div>

    <script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
