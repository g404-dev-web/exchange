<script src="https://www.gstatic.com/firebasejs/5.8.3/firebase.js"></script>
{{-- <script src="https://www.gstatic.com/firebasejs/5.8.2/firebase-messaging.js"></script> --}}

<script>
    // Initialize Firebase
    var config = {
        apiKey: "AIzaSyDXabp3SlbYwZNJWkOEFwR8Y-k4jtAanoM",
        authDomain: "exchange-54a3c.firebaseapp.com",
        databaseURL: "https://exchange-54a3c.firebaseio.com",
        projectId: "exchange-54a3c",
        storageBucket: "exchange-54a3c.appspot.com",
        messagingSenderId: "1026872785103"
    };
    firebase.initializeApp(config);
</script>
<script>

    // Retrieve Firebase Messaging object.
    const messaging = firebase.messaging();

    // Add the public key generated from the console here.
    messaging.usePublicVapidKey("BEEDl4ugMHIFfYCCwONFgM8lJyVP6uyacyxSmB7-2EW_DXG7LfeKSzRVFD4qty5LD6ktvXqszhsWk3MjdKILhrE");

    function enableNotifications(params) {

        let checkboxNotification = document.getElementById('checkboxNotification');

        if(checkboxNotification.checked) {

            messaging.requestPermission().then(function () {
                console.log('Notification permission granted.');
                // TODO(developer): Retrieve an Instance ID token for use with FCM.
                // ...
            }).catch(function (err) {
                console.log('Unable to get permission to notify.', err);
            });

            // Get Instance ID token. Initially this makes a network call, once retrieved
            // subsequent calls to getToken will return from cache.
            messaging.getToken().then(function (currentToken) {
                if (currentToken) {
                    console.log(currentToken, params);
                    sendTokenToServer(currentToken, params);
                } else {
                    // Show permission request.
                    console.log('No Instance ID token available. Request permission to generate one.');
                }
            }).catch(function (err) {
                console.log('An error occurred while retrieving token. ', err);
            });

            // Callback fired if Instance ID token is updated.
            messaging.onTokenRefresh(function () {
                messaging.getToken().then(function (refreshedToken) {
                    console.log('Token refreshed.');

                    // Send Instance ID token to app server.
                    sendTokenToServer(refreshedToken, params);
                    // ...
                }).catch(function (err) {
                    console.log('Unable to retrieve refreshed token ', err);
                });
            });
            // Handle incoming messages. Called when:
            // - a message is received while the app has focus
            // - the user clicks on an app notification created by a service worker
            //   `messaging.setBackgroundMessageHandler` handler.
            messaging.onMessage(function (payload) {
                console.log('Message received. ', payload);
                // ...
            });

        } else {
            let inputToken = document.getElementById('token');

            if(inputToken) {
                inputToken.parentNode.removeChild(inputToken);
                console.log('input token remove');
            }
        }

    }

    function sendTokenToServer(token, params) {

        const tokenInputString = '<input type="hidden" id="token" name="token_firebase" value="'+token+'">';

        if(params.type === "all") {
            $('#registerForm').append(tokenInputString);
        }
        else if (params.type === "question") {
             $('#registerForm').append(tokenInputString);
        } else {

            fetch('/notifications/question/'+params.question_id, {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                method: "POST",
                body: JSON.stringify({token_firebase: token })
            }).then(function (response) {
                return response.json();
            }).then(function (json) {
                if(json.is_subscribed === 1) {
                    console.log("User has been subscribed to notifications.")
                }
                else {
                    console.log("Error while subscribing user to notifications. "+token)
                }
            });
        }
    }

</script>