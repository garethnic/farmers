<template>
    <main>
        <section>
            <div class="container">
                <div class="row">
                    <button
                            type="button"
                            class="btn btn-sm btn-info"
                            :disabled="toggleButton"
                            v-on:click="buttonClick"
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="Be notified when an attack has occurred">
                        {{ buttonText }}
                    </button>
                </div>
            </div>
        </section>
    </main>
</template>

<script>
    import { urlB64ToUint8Array } from '../functions/convertApplicationKey';

    export default {
        name: "notification",

        data () {
            return {
                isSubscribed: false,
                toggleButton: false,
                swRegistration: null,
                buttonText: 'Receive Notifications',
                applicationKey: urlB64ToUint8Array(window.messageKey),
            }
        },

        mounted () {
            console.log('notifications running')
            this.registerServiceWorker();
        },

        methods: {
            registerServiceWorker () {
                if ('serviceWorker' in navigator && 'PushManager' in window) {
                    console.log('Service Worker and Push is supported');

                    navigator.serviceWorker.register('/service-worker.js')
                        .then(swReg => this.assignServiceWorker(swReg))
                        .catch(function(error) {
                            console.error('Service Worker Error', error);
                        })
                } else {
                    console.warn('Push messaging is not supported');
                    this.buttonText = 'Push Not Supported';
                }
            },
            assignServiceWorker(sw) {
                console.log('Service Worker is registered', sw);
                this.swRegistration = sw;
                this.initializeUI();
            },
            initializeUI () {
                this.swRegistration.pushManager.getSubscription()
                    .then(subscription => {
                        let isSubscribed = !(subscription === null);

                        if (isSubscribed) {
                            this.buttonText = 'Disable Notifications';
                            this.isSubscribed = true;
                        } else {
                            this.buttonText = 'Receive Notifications';
                        }

                        this.updateBtn();
                    })
            },
            updateBtn () {
                if (Notification.permission === 'denied') {
                    this.buttonText = 'Push Messaging Blocked.';
                    this.isSubscribed = false;
                    this.toggleButton = false;
                    this.updateSubscriptionOnServer(null, false);
                    return;
                }

                if (this.isSubscribed) {
                    this.buttonText = 'Disable Notifications';
                    console.log('User IS subscribed.');
                } else {
                    this.buttonText = 'Receive Notifications';
                    console.log('User is NOT subscribed.');
                }

                this.toggleButton = false;
            },
            buttonClick () {
                this.toggleButton = false;

                if (this.isSubscribed) {
                    this.unsubscribeUser();
                } else {
                    this.subscribeUser();
                }
            },
            updateSubscriptionOnServer(subscription, $status) {
                console.log('Performing update on server', subscription);
                if ($status) {
                    window.axios.post('/api/save-subscription/', {
                        body: JSON.stringify(subscription),
                        headers: { 'Content-Type': 'application/json' }
                    })
                    .then(function (response) {
                        console.log('Successful subscription', response)
                    })
                    .catch(function (error) {
                        console.log('Error subscribing', error);
                    });
                } else {
                    window.axios.post('/api/remove-subscription/', {
                        body: JSON.stringify(subscription),
                        headers: { 'Content-Type': 'application/json' }
                    })
                    .then(function (response) {
                        this.updateBtn();
                        console.log('Successful subscription', response)
                    })
                    .catch(function (error) {
                        console.log('Error subscribing', error);
                    });
                }
            },
            subscribeUser () {
                this.swRegistration.pushManager.subscribe({
                    userVisibleOnly: true,
                    applicationServerKey: this.applicationKey
                })
                .then(subscription => this.performSubscribe(subscription))
                .catch(err => {
                    console.log('Failed to subscribe the user', err)

                    this.updateBtn();
                });
            },
            performSubscribe (subscription) {
                console.log('User is subscribed.');

                this.updateSubscriptionOnServer(subscription, true);

                this.isSubscribed = true;

                this.updateBtn();
            },
            unsubscribeUser () {
                this.swRegistration.pushManager.getSubscription()
                    .then(subscription => {
                        if (subscription) {
                            this.performUnsubscribe(subscription);
                            return subscription.unsubscribe();
                        }
                    });
            },
            performUnsubscribe(subscription) {
                this.updateSubscriptionOnServer(subscription, false);

                console.log('User is unsubscribed.');

                this.isSubscribed = false;
                this.updateBtn();
            }
        }
    }
</script>

<style lang="scss" scoped>
    button:hover {
        cursor: pointer;
    }
</style>