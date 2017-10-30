<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta name="description" content="Keeping track of farmers lost due to violence in South Africa">
        <meta name="keywords" content="farm,murders,farm murders,farm attacks,assaults">
        <meta name="author" content="Gareth Nicholson">

        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/manifest.json">
        <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
        <meta name="theme-color" content="#ffffff">

        <title>Farm Attacks</title>

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <script>
            (function () {
                window.messageKey = '{{ env('PUSH_MESSAGE_PUBLIC_KEY') }}';
            })();
        </script>
    </head>
    <body>
        <div class="container-fluid h-100" id="app">
            <div class="row">
                <farmer></farmer>
            </div>
            <div class="row mt-4 ml-1">
                <notification></notification>
            </div>
        </div>

        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
