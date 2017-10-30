export function registerServiceWorker() {
    if ('serviceWorker' in navigator && 'PushManager' in window) {
        console.log('Service Worker and Push is supported');

        navigator.serviceWorker.register('sw.js')
            .then(function(swReg) {
                console.log('Service Worker is registered', swReg);

                swRegistration = swReg;
            })
            .catch(function(error) {
                console.error('Service Worker Error', error);
            });
    } else {
        console.warn('Push messaging is not supported');
        pushButton.textContent = 'Push Not Supported';
    }
}

/*
import { initialiseState } from 'notifications/initial_state';

if ('serviceWorker' in navigator && 'PushManager' in window) {
    window.addEventListener('load', function() {
        navigator.serviceWorker.register('/service-worker.js').then(function(registration) {
            // Registration was successful
            console.log('ServiceWorker registration successful with scope: ', registration.scope);
            swRegistration = registration;
            initialiseState();
            //askPermission();
            var publicKey = window.messageKey;
            const subscribeOptions = {
                userVisibleOnly: true,
                applicationServerKey: urlBase64ToUint8Array(
                    publicKey
                )
            };

            registration.pushManager.subscribe(subscribeOptions);
        }, function(err) {
            // registration failed :(
            console.log('ServiceWorker registration failed: ', err);
        }).then(function (pushSubscription) {
            console.log('Received PushSubscription: ', JSON.stringify(pushSubscription));

            const subscriptionObject = {
                endpoint: pushSubscription.endpoint,
                keys: {
                    p256dh: pushSubscription.getKeys('p256dh'),
                    auth: pushSubscription.getKeys('auth')
                }
            };

            sendSubscriptionToBackEnd(subscriptionObject);

            return pushSubscription;
        });
    });
} else {
    console.log('PWA functionality is not supported.');
}*/
