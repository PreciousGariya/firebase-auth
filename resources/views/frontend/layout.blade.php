<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Module Auth</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    {{-- Laravel Vite - CSS File --}}
    {{-- {{ module_vite('build-auth', 'Resources/assets/sass/app.scss') }} --}}
    <!-- <script src="https://www.gstatic.com/firebasejs/9.1.3/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.1.3/firebase-auth.js"></script> -->

    <script src="https://www.gstatic.com/firebasejs/7.14.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.14.0/firebase-auth.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // Initialize Firebase
        var firebaseConfig = {
            apiKey: "AIzaSyAeZq7aazZPO7YzK_makByAoubBeXGdYi8",
            authDomain: "laravelauth-3ff92.firebaseapp.com",
            projectId: "laravelauth-3ff92",
            storageBucket: "laravelauth-3ff92.appspot.com",
            messagingSenderId: "962135108251",
            appId: "1:962135108251:web:d378679a4381e23f9c743e",
            measurementId: "G-RCXGCESDCN"
        };

        firebase.initializeApp(firebaseConfig);
    </script>

    <script>
        // User Registration
        function register() {
            var name = document.getElementById('name').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;

            firebase.auth().createUserWithEmailAndPassword(email, password)
                .then(function(userCredential) {
                    // Registration successful, do something with the user object
                    var user = userCredential.user;

                    axios.post('/verify/register', {
                            token: user.xa,
                            'name': name,
                            'email': email,
                            'password': password

                        })
                        .then(function(response) {
                            // Request successful, do something with the response
                            console.log(response.data);
                            if (response.data.status == true) {
                                window.location.href = "/";
                            }
                        })
                        .catch(function(error) {
                            // Request failed, handle the error
                            console.error(error);
                        });
                    console.log("User registered:", user);
                })
                .catch(function(error) {
                    // Registration failed, handle the error
                    var errorCode = error.code;
                    var errorMessage = error.message;
                    document.getElementById('error_div').innerHTML = errorMessage;
                    console.error("Registration error:", errorCode, errorMessage);
                });
        }

        // User Login
        function login() {
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;

            firebase.auth().signInWithEmailAndPassword(email, password)
                .then(function(userCredential) {
                    // Login successful, do something with the user object
                    var user = userCredential.user;
                    // console.log("User logged in:", user);
                    axios.post('/verify/login', {
                            token: user.xa,
                        })
                        .then(function(response) {
                            // Request successful, do something with the response
                            console.log(response.data);
                            if (response.data.status == true) {
                                window.location.href = "/";
                            }
                        })
                        .catch(function(error) {
                            // Request failed, handle the error
                            console.error(error);
                        });
                })
                .catch(function(error) {
                    // Login failed, handle the error
                    var errorCode = error.code;
                    var errorMessage = error.message;
                    document.getElementById('error_div').innerHTML = errorMessage;
                    console.error("Login error:", errorCode, errorMessage);
                });
        }

        // User Logout
        function logout() {
            firebase.auth().signOut()
                .then(function() {
                    console.log("User logged out");
                    // Logout successful
                    axios.post('/verify/logout')
                        .then(function(response) {
                            // Request successful, do something with the response
                            console.log(response.data);
                            if (response.data.status == true) {
                                window.location.href = "/front/login";
                            }
                        })
                        .catch(function(error) {
                            // Request failed, handle the error
                            console.error(error);
                        });
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
    {{-- {{ module_vite('build-auth', 'Resources/assets/js/app.js') }} --}}

</body>

</html>
