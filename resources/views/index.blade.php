<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

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
            <div class="row">
                <notification></notification>
            </div>
        </div>

        <script>
           /* if ('serviceWorker' in navigator && 'PushManager' in window) {
                window.addEventListener('load', function() {
                    navigator.serviceWorker.register('/service-worker.js').then(function(registration) {
                        // Registration was successful
                        console.log('ServiceWorker registration successful with scope: ', registration.scope);
                        /!*askPermission();
                        const subscribeOptions = {
                            userVisibleOnly: true,
                            applicationServerKey: urlBase64ToUint8Array(
                                publicKey
                            )
                        };

                        registration.pushManager.subscribe(subscribeOptions);*!/
                    }, function(err) {
                        // registration failed :(
                        console.log('ServiceWorker registration failed: ', err);
                    }).then(function (pushSubscription) {
                        /!*console.log('Received PushSubscription: ', JSON.stringify(pushSubscription));

                        const subscriptionObject = {
                            endpoint: pushSubscription.endpoint,
                            keys: {
                                p256dh: pushSubscription.getKeys('p256dh'),
                                auth: pushSubscription.getKeys('auth')
                            }
                        };

                        sendSubscriptionToBackEnd(subscriptionObject);

                        return pushSubscription;*!/
                    });
                });
            }*/

            /*self.addEventListener('push', function () {
                "use strict";
                console.log('ServiceWorker | Push Received');

                const title = 'Farm Attack';
                const options = {
                    body: 'Another farmer has left',
                    /!*icon: './icons/icon-32.png',
                    badge: './icons/icon-72.png',*!/
                    vibrate: [500, 110, 500],
                    sound: './sounds/9mm/mp3/9_mm.mp3',
                }

                event.waitUntil(self.registration.showNotification(title, options));
            });

            function askPermission() {
                return new Promise(function(resolve, reject) {
                    const permissionResult = Notification.requestPermission(function(result) {
                        resolve(result);
                    });

                    if (permissionResult) {
                        permissionResult.then(resolve, reject);
                    }
                })
                .then(function(permissionResult) {
                    if (permissionResult !== 'granted') {
                        throw new Error('We weren\'t granted permission.');
                    }
                });
            }*/
        </script>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
