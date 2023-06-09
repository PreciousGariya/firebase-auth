<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Firebase | Auth Module</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    {{-- Laravel Vite - CSS File --}}
    {{-- {{ module_vite('build-firebase', 'Resources/assets/sass/app.scss') }} --}}
    <!-- <script src="https://www.gstatic.com/firebasejs/9.1.3/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.1.3/firebase-auth.js"></script> -->

    <script src="https://www.gstatic.com/firebasejs/7.14.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.14.0/firebase-auth.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // Initialize Firebase
        var firebaseConfig = {
            apiKey: "{{env('API_KEY')}}",
            authDomain: "{{env('AUTH_DOMAIN')}}",
            projectId: "{{env('PROJECT_ID')}}",
            storageBucket: "{{env('STORAGE_BUCKET')}}",
            messagingSenderId: "{{env('API_KEY')}}",
            appId: "{{env('API_ID')}}",
            measurementId: "{{env('MEASUREMENT_ID')}}"
        };

        firebase.initializeApp(firebaseConfig);

        ///facebook configuration
        window.fbAsyncInit = function() {
            FB.init({
                appId: '{{env("FACEBOOK_APP_ID")}}',
                cookie: true,
                xfbml: true,
                version: 'v9.0'
            });
        };
    </script>

    <script>
        //forgotpassword
        function resetPassword() {
            var userEmail = prompt("Please enter your email address:");

            firebase.auth().sendPasswordResetEmail(userEmail)
                .then(function() {
                    // Password reset email sent successfully
                    console.log('Password reset email sent');
                })
                .catch(function(error) {
                    // An error occurred while sending password reset email
                    console.error(error);
                });
        }

        // Phone number verification
        function verifyPhoneNumber() {
            var phoneNumber = document.getElementById('phone-input').value;
            var appVerifier = new firebase.auth.RecaptchaVerifier('user-status');

            firebase.auth().signInWithPhoneNumber(phoneNumber, appVerifier)
                .then(function(confirmationResult) {
                    var verificationCode = prompt('Enter the verification code:');
                    return confirmationResult.confirm(verificationCode);
                })
                .then(function(result) {
                    var user = result.user;
                    // send for verification or store the token
                    console.log('Phone number verification successful:', user);
                    document.getElementById('user-status').textContent = 'Logged in with phone number: ' + user.phoneNumber;
                })
                .catch(function(error) {
                    console.error('Phone number verification error:', error);
                    document.getElementById('user-status').textContent = 'Error: ' + error.message;
                });
        }

        //
        function twitterSignIn() {
            const provider = new firebase.auth.TwitterAuthProvider();
            firebase.auth()
                .signInWithPopup(provider)
                .then((result) => {
                    // Successful sign-in
                    const user = result.user;
                    console.log('Twitter Sign-in successful:', user);
                    // send for verification or store the token

                })
                .catch((error) => {
                    // Error occurred
                    console.error('Twitter Sign-in error:', error);
                });
        }

        //
        function googleSignIn() {
            const provider = new firebase.auth.GoogleAuthProvider();
            firebase.auth()
                .signInWithPopup(provider)
                .then((result) => {
                    // Successful sign-in
                    const user = result.user;
                    console.log('Google Sign-in successful:', user.xa);
                    // send for verification or store the token
                })
                .catch((error) => {
                    // Error occurred
                    console.error('Google Sign-in error:', error);
                });
        }

        function facebookSignIn() {
            const provider = new firebase.auth.FacebookAuthProvider();
            firebase.auth()
                .signInWithPopup(provider)
                .then((result) => {
                    // Successful sign-in
                    const user = result.user;
                    // send for verification or store the token
                    console.log('Facebook Sign-in successful:', user);
                })
                .catch((error) => {
                    // Error occurred
                    console.error('Facebook Sign-in error:', error);
                });
        }

        //google end

        // User Registration
        function register() {

            // Get the input field values
            var name = document.getElementById('name').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;

            // Get the input field error status element
            document.getElementById("name-error").textContent = "";
            document.getElementById("email-error").textContent = "";
            document.getElementById("password-error").textContent = "";


            // Perform validation
            var isValid = true;

            // Validate name
            if (name === "") {
                document.getElementById("name-error").textContent = "Name is required.";
                isValid = false;
            }

            // Validate email
            if (email === "") {
                document.getElementById("email-error").textContent = "Email is required.";
                isValid = false;
            }

            // Validate password
            if (password === "") {
                document.getElementById("password-error").textContent = "Password is required.";
                isValid = false;
            }
            // If all validations pass, proceed with login
            if (isValid) {
                firebase.auth().createUserWithEmailAndPassword(email, password)
                    .then(function(userCredential) {
                         // Registration successful, do something with the user object
                         var user = userCredential.user;
                        console.log("User registered:", user);
                        document.getElementById('user-status').innerHTML = `Register successfully handle the success
                        Registration as per requirements for more details check console. <p>Email:</p>${user.email}<p></p>
                        <button class='btn btn-danger mb-2' onclick=logout()>Logout</button>`;


                        //axios Request to verify Token From Server
                        // axios.post('/firebase/verify/register', {
                        //         token: user.xa,
                        //         'name': name,
                        //         'email': email,
                        //         'password': password

                        //     })
                        //     .then(function(response) {
                        //         // Request successful, do something with the response
                        //         console.log(response.data);
                        //         if (response.data.status == true) {
                        //             window.location.href = "/";
                        //         }
                        //     })
                        //     .catch(function(error) {
                        //         // Request failed, handle the error
                        //         console.error(error);
                        //     });
                        //end axios request to verify Token From Server
                    })
                    .catch(function(error) {
                        // Registration failed, handle the error
                        var errorCode = error.code;
                        var errorMessage = error.message;
                        document.getElementById('error_div').innerHTML = errorMessage;
                        console.error("Registration error:", errorCode, errorMessage);
                    });
            }
        }

        // User Login
        function login() {

            document.getElementById("email-error").textContent = "";
            document.getElementById("password-error").textContent = "";

            // Get the input field values
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;

            // Perform validation
            var isValid = true;

            // Validate email
            if (email === "") {
                document.getElementById("email-error").textContent = "Email is required.";
                isValid = false;
            }

            // Validate password
            if (password === "") {
                document.getElementById("password-error").textContent = "Password is required.";
                isValid = false;
            }
            // If all validations pass, proceed with login
            if (isValid) {
                firebase.auth().signInWithEmailAndPassword(email, password)
                    .then(function(userCredential) {
                        // Login successful, do something with the user object
                        var user = userCredential.user;
                        document.getElementById('user-status').innerHTML = `Logged In success fully handle the success
                        login as per requirements for more details check console. <p>Email:</p><p>${user.email}</p>
                        <button class='btn btn-danger mb-2' onclick=logout()>Logout</button>
                        `
                        console.log("User logged in:", user);
                        //axios request to verify Token From Server
                        // axios.post('/firebase/verify/login', {
                        //         token: user.xa,
                        //     })
                        //     .then(function(response) {
                        //         // Request successful, do something with the response
                        //         console.log(response.data);
                        //         if (response.data.status == true) {
                        //             window.location.href = "/";
                        //         }
                        //     })
                        //     .catch(function(error) {
                        //         // Request failed, handle the error
                        //         console.error(error);
                        //     });
                        // end axios request to verify Token From Server
                    })
                    .catch(function(error) {
                        // Login failed, handle the error
                        var errorCode = error.code;
                        var errorMessage = error.message;
                        document.getElementById('error_div').innerHTML = errorMessage;
                        console.error("Login error:", errorCode, errorMessage);
                    });
            }
        }

        // User Logout
        function logout() {
            firebase.auth().signOut()
                .then(function() {
                    console.log("User logged out");
                    document.getElementById('user-status').innerHTML = `Logout Successfully!</p> `
                    // Logout successful
                    // axios.post('/firebase/verify/logout')
                    //     .then(function(response) {
                    //         // Request successful, do something with the response
                    //         console.log(response.data);
                    //         if (response.data.status == true) {
                    //             window.location.href = "/front/login";
                    //         }
                    //     })
                    //     .catch(function(error) {
                    //         // Request failed, handle the error
                    //         console.error(error);
                    //     });
                })
                .catch(function(error) {
                    // Logout failed, handle the error
                    console.error("Logout error:", error);
                });
        }
    </script>


</head>

<body>
    <div class="row">
        @if ($message = Session::get('success'))
        <div class="alert alert-info alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

    </div>
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Laravel Vite - JS File --}}
    {{-- {{ module_vite('build-firebase', 'Resources/assets/js/app.js') }} --}}

</body>

</html>
