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

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-109027299-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'UA-109027299-1');


            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-109027299-1', 'auto');
            ga('send', 'pageview');

        </script>
    </head>
    <body>
        <div class="container-fluid h-100" id="app">
            <div class="row mt-4 ml-1">
                <notification></notification>
            </div>
            <div class="row">
                <farmer></farmer>
            </div>

            <div class="row justify-content-center">
                <div class="form-text text-muted mb-2"><small>Not affiliated with this twitter account.</small></div>
                <div class="col-md-6 mt-3">
                    <a class="twitter-timeline" href="https://twitter.com/FarmAttacks?ref_src=twsrc%5Etfw">Tweets by FarmAttacks</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script> 
                </div>
            </div>
        </div>

	    <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
