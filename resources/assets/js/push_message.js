self.addEventListener('push', function(event) {
    const title = 'Farm Attack';
    const options = {
        body: 'Another farmer has been attacked.',
        icon: 'images/icons/icon-512x512.png',
        badge: 'images/icons/icon-128x128.png'
    };

    event.waitUntil(self.registration.showNotification(title, options));
});

self.addEventListener('notificationclick', function(event) {
    console.log('[Service Worker] Notification click Received.');

    event.notification.close();

    event.waitUntil(
        clients.openWindow(window.location.hostname)
    );
});
