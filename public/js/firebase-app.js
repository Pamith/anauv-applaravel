
  
      var uiConfig = {
        // signInSuccessUrl: 'http://localhost:6003',
        signInOptions: [
          // Leave the lines as is for the providers you want to offer your users.
          firebase.auth.GoogleAuthProvider.PROVIDER_ID,
          // firebase.auth.FacebookAuthProvider.PROVIDER_ID,
          // firebase.auth.TwitterAuthProvider.PROVIDER_ID,
          // firebase.auth.GithubAuthProvider.PROVIDER_ID,
          // firebase.auth.EmailAuthProvider.PROVIDER_ID,
          {
            provider:firebase.auth.PhoneAuthProvider.PROVIDER_ID,
            defaultCountry: 'IN',
          }
          
        ],
        // Terms of service url.
        tosUrl: 'https://www.google.com'
      };

// Initialize the FirebaseUI Widget using Firebase.
var ui = new firebaseui.auth.AuthUI(firebase.auth());
ui.start('#firebaseui-container', uiConfig);
/**
 * Displays the UI for a signed in user.
 * @param {!firebase.User} user
 */
var handleSignedInUser = function(user) {
  console.log(user);
                  var providerData = user.providerData;

            var processData ={
                 displayName : user.displayName,
                 email : user.email,
                 emailVerified : user.emailVerified,
                 photoURL : user.photoURL,
                 uid : user.uid,
                 phoneNumber : user.phoneNumber,
                 provider : providerData[0].providerId,
            };
            user.getIdToken().then(function(accessToken) {
              $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        })
              $.ajax({
                      url: 'login/social',
                      type: 'post',
                      dataType: 'json',
                      data:processData,
                      success:function(res) {
                       
                         window.location.href =res.url; 
                         firebase.auth().signOut();
                      }
                    });
                      
            });  
};


/**
 * Displays the UI for a signed out user.
 */
var handleSignedOutUser = function() {
  ui.start('#firebaseui-container', uiConfig);
};

/**
 * Initializes the app.
 */
 initApp = function() {
        firebase.auth().onAuthStateChanged(function(user) { 
         
          user ? handleSignedInUser(user) : handleSignedOutUser();
        }, function(error) {
          ui.start('#firebaseui-container', uiConfig);
          
        });
      };

      window.addEventListener('load', function() {
        initApp()
      });


      // const messaging = firebase.messaging();
      // navigator.serviceWorker.register('./js/firebase-messaging-sw.js')
      // .then((registration) => {
      //   messaging.useServiceWorker(registration);
      //   messaging.requestPermission()
      // .then(function() {
      //   console.log('Notification permission granted.');
      //   return messaging.getToken();
      // })
      // .then(function(currentToken) {

      //     if (currentToken) {
      //       console.log(currentToken);
      //     } else {
      //       // Show permission request.
      //       console.log('No Instance ID token available. Request permission to generate one.');
      //       // Show permission UI.
            
      //     }
      //   })
      //   .catch(function(err) {
      //     console.log('An error occurred while retrieving token. ', err);
          
      //   });
      //   messaging.onTokenRefresh(function() {
      //   messaging.getToken()
      //   .then(function(refreshedToken) {
      //       console.log('Token refreshed.');
      //       // Indicate that the new Instance ID token has not yet been sent to the
      //       // app server.
      //       // Send Instance ID token to app server.
      //       // ...
      //     })
      //     .catch(function(err) {
      //     });
      //   });

      //   messaging.onMessage(function(payload) {
      //     console.log("Message received. ", payload);
      //     // ...
      //   });
        
      // });  

       
    