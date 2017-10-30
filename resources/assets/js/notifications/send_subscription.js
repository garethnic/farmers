/*export function sendSubscriptionToServer(subscription) {
    // TODO: Send the subscription.endpoint
    // to your server and save it to send a
    // push message at a later date
    //
    // For compatibly of Chrome 43, get the endpoint via
    // endpointWorkaround(subscription)
    console.log('TODO: Implement sendSubscriptionToServer()');

    var mergedEndpoint = endpointWorkaround(subscription);

    // This is just for demo purposes / an easy to test by
    // generating the appropriate cURL command
    showCurlCommand(mergedEndpoint);
}*/

export function sendSubscriptionToBackEnd(subscription) {
    axios.post('/api/save-subscription/', {
        body: JSON.stringify(subscription),
        headers: { 'Content-Type': 'application/json' }
    })
    .then(function (response) {
        console.log(response)
    })
    .catch(function (error) {
        console.log(error);
    });

    /*return fetch('/api/save-subscription/', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(subscription)
    })
        .then(function(response) {
            if (!response.ok) {
                throw new Error('Bad status code from server.');
            }

            return response.json();
        })
        .then(function(responseData) {
            if (!(responseData.data && responseData.data.success)) {
                throw new Error('Bad response from server.');
            }
        });*/
}