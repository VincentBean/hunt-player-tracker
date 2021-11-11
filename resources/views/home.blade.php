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
    <h1 class="text-red-800 text-4xl">Hunt Player Tracker</h1>
    <p class="prose text-gray-100">
        This is a tool designed to attempt to track players in Hunt Showdown.
        <br/>
        Interested in how it works? <a class="text-blue-600" href="https://github.com/vincentbean/hunt-player-tracker">Check
            out the readme at the Github page</a>
        <br/>

        This tool is designed to work on multiple screens at the same time.
        <br/>
        Create a lobby and use the code to invite your friends!
        <br/>
    </p>
    <a class="text-blue-600 mt-8" href="/howto">Visit this page to learn how to tool works</a>
    <br/>

    <a href="/map"
        class="my-8 mx-auto inline-flex items-center px-12 py-6 border border-transparent text-4xl font-medium rounded-md shadow-sm text-gray-200 border-red-800 bg-red-900 hover:bg-red-800 focus:outline-none">
        Start
    </a>

    <br/>

    <span class="mt-4 text-sm text-gray-300 text-center">
            Are you a designer and hate how this site looks? Great!
            <a class="text-blue-600"
               href="https://github.com/vincentbean/hunt-player-tracker">Create a PR and fix it.</a>
        </span>
</main>

<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
