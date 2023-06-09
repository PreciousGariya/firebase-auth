# Laravel Login Module

The Laravel Login module is a versatile authentication module that enables users to log in using various methods, including email and password, phone number with OTP, and social logins such as Gmail, Facebook, and Twitter. This module simplifies the login process and enhances user experience by offering multiple authentication options.

# Firebase Authentication
- Firebase Authentication is a service provided by Firebase, which is a comprehensive mobile and web application development platform by Google. Firebase Authentication offers a straightforward way to implement user authentication and authorization in your applications, eliminating the need to build your own authentication system from scratch.

## Fetching Firebase credentials.json file

To integrate Firebase authentication with the Laravel Login module, follow these steps to obtain the `credentials.json` file:


1. Go to the [Firebase Console](https://console.firebase.google.com) and sign in with your Google account.

2. Create a new Firebase project or select an existing one.

3. Navigate to the project settings by clicking on the gear icon.

4. Under the "General" tab, scroll down to the "Your apps" section.

5. Click on the "Web" platform (</> icon) to add a new web app to your Firebase project.

6. Provide a name for your app and register it.

7. Firebase will generate a configuration object containing your Firebase credentials. Click on "Continue to console."

8. In the project settings, scroll down to the "Your apps" section again.

9. Find the app you created and click on the "Settings" (gear) icon next to it.

10. Select "Service accounts" from the left menu.

11. Under the "**Firebase Admin SDK**" tab, click on "**Generate new private key.**"

12. This will download the `test-firebase-adminsdk-x6xmu.json` file with similar name that containing your Firebase credentials.
13. open `test-firebase-adminsdk-x6xmu.json` file and `CTRL+A` `CTRL+C` and open 
```
<project-directory>/firebase_credentials.json
```

 file available in root directory `CTRL+V` and **Save**.
 

## Frontend JavaScript SDK Credentials

To use the Firebase JavaScript SDK with Javascript, follow these steps:

1. Go to the [Firebase Console](https://console.firebase.google.com) and sign in with your Google account.

2. Create a new Firebase project or select an existing one.

3. Navigate to the project settings by clicking on the gear icon.

4. Under the "General" tab, scroll down to the "Your apps" section **SDK setup and configuration**
the given configuration details are dummy -
```
const firebaseConfig = {
  apiKey: "AIzaSyAeZq7a_makByAoubBeXGdYi8",
  authDomain: "test-pro-3hhf92.firebaseapp.com",
  projectId: "test-pro-3hhf92",
  storageBucket: "test-pro-3hhf92.appspot.com",
  messagingSenderId: "00000",
  appId: "1:00000:web:9999",
  measurementId: "G-HFATGVDJ"
};
```
- Copy & Paste the respective value to `.env` file like following
```
API_KEY =AIzaSyAeZq7a_makByAoubBeXGdYi8
AUTH_DOMAIN =test-pro-3hhf92.firebaseapp.com
PROJECT_ID =test-pro-3hhf92
STORAGE_BUCKET =test-pro-3hhf92.appspot.com
MESSAGING_SENDER_ID =00000
APP_ID =1:00000:web:9999
MEASUREMENT_ID =G-HFATGVDJ

```

## System Requirements

Ensure your system meets the following requirements before installing Laravel 10 and utilizing the module with nwidart:

- PHP version 8.1 or higher

- Composer (Dependency Manager for PHP)

- Node.js (version 14 or higher) and npm (Node Package Manager)

- MySQL or any other compatible database server

- Laravel Installer (globally installed)

- Git (version control system)

## Laravel Installation Steps

Follow these steps to install Laravel and set up the Laravel Login module:

1. Open your command-line interface.

2. Clone the repo by running the command:

   ```
   git clone <repo>

   ```
3. Install project dependencies by running the following command:

   ```
   composer install

   ```
4. Copy the `.env.example` file and create a new `.env` file:

   ```
   cp .env.example .env

   ```
5. Generate a unique application key by running the command:

   ```
   php artisan key:generate

   ```
6. Configure your database settings in the `.env` file.

7. Run the database migrations to set up the database schema:

   ```
   php artisan migrate

   ```
8. Optionally, install npm dependencies (if applicable) by running:

    ```
    npm install

    ```
9. Creating a Virtual Host for Firebase Authentication:
To integrate Firebase Authentication with your Laravel application, you need to set up a virtual host in Ubuntu that uses a domain name (e.g., firebaseauth.test) instead of the default 127.0.0.1:8000. Here's how you can create a virtual host for Firebase Authentication:

in Windows you can directly acces via localhost/<project-direcoty>/public
- The `sh` file is available on the same directory 
Open terminel in root directory of this project and run

    ```
    sudo sh vhost.sh

    ```
 - After run it will ask name of virtual

   ```
    enter the name of virtual host you want to create
    firebase.test

   ```
    ```
    enter the root path of your project
    /var/www/html/<project-direcoty>/public
    ```
    ```
    set `APP_URL` in `.env` file
    APP_URL=http://firebase.test

   ```
   ```
    set `APP_URL` in `.env` file [windows]
    APP_URL=http://localhost/<project-directory>/public
   ```


9. Access your Laravel application at the virtualhost or localhost/<project-directory>/public URL.:

    ```
    http://firebase.test/

    ```
10. Access your Laravel application at the specified URL.

## Creating a Facebook App for Facebook Login in Firebase Auth
Follow these steps to create a Facebook app and configure Facebook Login for Firebase Authentication:

1. **Go to the Facebook Developers website:** Visit the Facebook Developers website and log in using your Facebook account credentials.

2. **Create a new app:** Click on the "**My Apps**" dropdown menu in the top-right corner and select "**Create App**" from the options.

3. **Choose a platform:** Select the platform that aligns with your project requirements. For this integration, choose "**WWW**."

4. **Provide app details:** Enter an app name in the "**Display Name**" field. Optionally, provide additional information such as a contact email and privacy policy URL.

4. **Create the app:** Click on the "**Create App**" button to create your Facebook app.

5. **Configure the app settings:** Navigate to the "**Settings**" section in the left sidebar. Customize your app settings as needed.

6. **Add Facebook Login product:** Under the "**Products**" section, click on "**Facebook Login**," and then click "**Set Up**" under the "**Web**" category.

7. **Configure Facebook Login settings:** Provide the necessary information to integrate Facebook Login with Firebase Authentication.

- a. *Enter your app's URL in the "**Valid OAuth Redirect URIs**" field using the Firebase-specific redirect URL pattern: `https://<PROJECT_ID>.firebaseapp.com/__/auth/handler`.*

- b. *In the "Client OAuth Settings" section, enter the same redirect URL in the "Valid OAuth Redirect URIs" field.

- c. *Enable "Client OAuth Login" and "Web OAuth Login" options.*

- d. *Save the changes.*

8. **Retrieve App ID and App Secret:** Under "**Settings**" in the "Facebook Login" section, find your App ID and App Secret. Keep these credentials secure.

9. **Configure Facebook Login in Firebase Console:** Open the Firebase console and select your project.

10. **Enable Facebook Login:** In the left sidebar, click on "**Authentication**" and select the "Sign-in method" tab. Enable Facebook as a sign-in provider.

11. **Enter App ID and App Secret in:** In the "**Facebook Login**" section, enter your App ID and App Secret obtained from the Facebook Developers website.

12. **Save the settings:** Click "**Save**" to save the Facebook Login configuration and mention the credentials on `.env`.
 ```
  FACEBOOK_APP_ID = your-facebook-app-id
 ```

## Creating a Twitter App for Twitter Login in Firebase Auth
1. **Go to the Twitter Developer Portal:** Visit the Twitter Developer Portal and sign in using your Twitter account credentials.

2. **Create a new app:** Once logged in, navigate to the "**Apps**" section and click on "Create an app."

3. **Provide app details:** Enter the required information such as the app name, description, website URL, and callback URLs. Make sure to specify the callback URL to handle the authentication response.

4. **Create the app:** Click on the "**Create**" button to create your Twitter app.

5. **Retrieve API key and secret:** On the app details page, you will find the API key and secret. Keep these credentials secure as they will be used to configure Twitter Login in Firebase Authentication.

6. **Configure the app permissions:** In the app settings, navigate to the "**Permissions**" tab and enable the necessary permissions required for your application.

7. **Enable Twitter Login in Firebase Console:** Open the Firebase console and select your project.

8. **Enable Twitter as a sign-in provider:** In the left sidebar, click on "**Authentication**" and then select the "**Sign-in method**" tab. Locate the Twitter provider and click on the "**Enable**" toggle switch.

9. **Enter API key and secret:** In the "**Twitter**" section, `enter your API key and secret`, obtained from the Twitter Developer Portal.

10. **Save the settings:** Click on the "**Save**" button to save the Twitter Login configuration.



## Routes - Laravel firebase authentication.

Routes are grouped under the prefix `'laravel-auth'` and are handled by the `FirebaseLaravelAuthController` class. Here is a description of each route:

1. **GET** `firebase/laravel-auth`

   - This route maps to the `index` method of the `FirebaseLaravelAuthController` and is responsible for rendering the index view.
2. **GET** `firebase/laravel-auth/register`

   - This route maps to the `create` method of the `FirebaseLaravelAuthController` and is used to display the registration form.

3. **GET** `firebase/laravel-auth/reset/password`

   - This route maps to the `resetPass` method of the `FirebaseLaravelAuthController` and renders the password reset page.

4. **POST** `firebase/laravel-auth/auth/register`

   - This route maps to the `register` method of the `FirebaseLaravelAuthController` and handles the form submission for user registration.

5. **POST** `firebase/laravel-auth/auth/login`

   - This route maps to the `login` method of the `FirebaseLaravelAuthController` and handles the form submission for user login.

6. **POST** `firebase/laravel-auth/reset/password`

   - This route maps to the `reset` method of the `FirebaseLaravelAuthController` and handles the form submission for password reset.

7. **POST** `firebase/laravel-auth/auth/logout`

   - This route maps to the `logout` method of the `FirebaseLaravelAuthController` and handles the user logout functionality.

These routes provide the necessary endpoints for user registration, login, password reset, and logout functionality within the Laravel application. They are grouped under the `'laravel-auth'` prefix for better organization and readability. The associated methods in the `FirebaseLaravelAuthController` class handle the logic for each route's functionality.
## views - Laravel firebase authentication.
- Login view - /Modules/Firebase/Resources/views/laravel_auth/login.blade.php
- Register view - /Modules/Firebase/Resources/views/laravel_auth/register.blade.php
- Layout - /Modules/Firebase/Resources/views/laravel_auth/layouts/master.blade.php

## Middleware - For Verify Token

This middleware is responsible for authenticating and authorizing requests using Firebase Authentication. The `FirebaseAuthMiddleware` class is defined within the `Modules\Firebase\Http\Middleware namespace`. It imports necessary dependencies such as User model, Closure, Request, Auth, and Firebase-related classes.
Here's a step-by-step breakdown of the handle method:
```
public function handle(Request $request, Closure $next)
    {
        try {
            $token  = $request->header('token');
            $verifiyToken = $this->auth->verifyIdToken($token);
            $uid = $verifiyToken->claims()->get('sub');
            return response()->json($firebaseuser = $this->auth->getUser($uid));
            $user = User::where('uid', $firebaseuser->uid)->first();
            
            //you can create user
            if (!$user) {
                // User::create([
                //     'name' => $firebaseuser->displayName,

                // ]);
            }
            //custom guard for firebase auth
            Auth::guard('firebase')->login($user);
            return $next($request);
        } catch (FailedToVerifyToken $e) {
            // $e->getMessage()
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
    }
}
```

- It tries to verify the Firebase ID token using the verifyIdToken method of the Firebase authentication instance.
1. If the token is successfully verified, it retrieves the user ID ($uid) from the verified token's claims.
2. It then tries to fetch the Firebase user (`$firebaseuser`) using the retrieved UID.
If the Firebase user exists, it attempts to find a local user with the same UID using the User model.

2. If the local user does not exist, you may `uncomment` the code within the if statement to create a new user in your local database based on the Firebase user's data.
The authenticated user is then logged in using the Auth facade's login method with the `'firebase'` guard.

3. Finally, the middleware passes the request to the next middleware or the final request handler ($next($request)).

4. If any exception of type FailedToVerifyToken is thrown during the process, indicating a failed token verification, the middleware returns a JSON response with an error message and a status code of 401 (Unauthorized)

Usage - 

- To protect your routes or endpoints using the `FirebaseAuthMiddleware`, follow these steps:
1. Open the route file (web.php or api.php) where you define your routes.
2. Apply the `firebase.auth` middleware to the desired routes or route groups:

```
Route::middleware('firebaseAuth')->group(function () {
    // Routes that require Firebase authentication
});
```

3. Within the protected routes, you can access the currently authenticated user using `Auth::guard('firebase')->user()`. Example:
```
$user = Auth::guard('firebase')->user();
if ($user) {
    // Access user properties
}
```
- **Note:** Make sure that your Firebase ID token is included in the request headers with the key 'token' when making requests to the protected routes.


## Routes - Firebase SDK authentication for frontend.

Laravel routes are grouped under the prefix `'firebase'` and are related to frontend Firebase SDK authentication. Here is a description of each route:

1. **GET** `/firebase`
   - This route returns the view for the Firebase authentication login page. It renders the `firebase::auth.login` view.

2. **GET** `/firebase/register`

   - This route returns the view for the Firebase authentication registration page. It renders the `firebase::auth.register` view.

3. **GET** `/firebase/users/profile`

   - This route retrieves the authenticated user's profile information from the Firebase authentication system.

   - It uses the `Auth::guard('firebase')->user()` method to fetch the user's details.

   - The route is named as `'users'` and is protected by the `firebase.auth` middleware, which ensures that only authenticated users can access it.

- These routes are designed to work with the frontend Firebase SDK. Once the user receives an authentication token from Firebase, they can send that token in the header for authentication purposes. The `firebase.auth` middleware checks the validity of the token and allows access to the `/firebase/users/profile` route only if the token is valid and the user is authenticated.

These routes facilitate frontend authentication with Firebase and provide access to the login, registration, and user profile pages.

## views - Firebase SDK authentication for frontend.
- Login view - /Modules/Firebase/Resources/views/auth/login.blade.php
- Register view - /Modules/Firebase/Resources/views/auth/register.blade.php
- Javascript functions for firebase auth and layout file - /Modules/Firebase/Resources/views/layouts/master.blade.php

