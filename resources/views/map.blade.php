<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <title>Hunt Showdown: Player Tracker</title>

</head>
<body class="antialiased bg-gray-900">

<main class="mt-4 text-center">
    <h1 class="text-red-800 text-4xl mb-6">Select your map</h1>

    <form id="start" action="/start" method="post">
        @csrf
        <select id="map" name="map" class="my-4 px-2 py-1">
            <option value="bayou">Stillwater Bayou</option>
        </select>

        <br/>

        <label class="mt-4 text-gray-100">Lobby code (for using with friends)</label>
        <br/>
        <input id="code" type="text" name="code" class="px-2 py-1 mt-1" placeholder="Lobby code (optional)"/>
        <br/>

    </form>

    <button onclick="submit()" type="submit"
            class="my-8 mx-auto inline-flex items-center px-12 py-6 border border-transparent text-4xl font-medium rounded-md shadow-sm text-gray-200 border-red-800 bg-red-900 hover:bg-red-800 focus:outline-none">
        Start
    </button>
</main>

<script src="{{ mix('/js/app.js') }}"></script>
<script>
    function submit() {

        let map = document.getElementById("map").value;
        let code = document.getElementById("code").value;

        if (code == '' || code == null || code.length === 0) {
            code = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
            document.getElementById("code").value = code;
        }

        window.localStorage.setItem('map', map);
        window.localStorage.setItem('code', code);

        document.getElementById("start").submit();
    }
</script>
</body>
</html>
