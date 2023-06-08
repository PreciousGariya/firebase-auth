<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Auth as FirebaseAuth;
use Kreait\Firebase\Exception\AuthException as FirebaseException;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

class FirebaseAuthController extends Controller
{
    protected $auth;

    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount(base_path('/').'/firebase_credentials.json');

        $this->auth = $factory->createAuth();
    }

    public function register(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $name = $request->input('name');


        try {
            $registration = $this->auth->createUserWithEmailAndPassword($email, $password);
            // Registration successful
            $signInResult = $this->auth->signInWithEmailAndPassword($email, $password);
            $fireuser = $signInResult->data();
            $uid = $fireuser['localId'];
            $token = $fireuser['idToken'];
            if ($signInResult) {
                $user = User::updateOrCreate(['uid' => $uid], [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $request->password,
                    'uid' =>  $uid,
                    'token' => $token
                ]);

                Auth::guard('firebase')->login($user);
                return redirect('/');
            }
            // Handle the registered user
        } catch (FirebaseException $e) {
            // Registration failed
            return back()->withErrors([
                'email' => $e->getMessage(),
            ]);
        }
    }

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        try {
            $signInResult = $this->auth->signInWithEmailAndPassword($email, $password);
            // Authentication successful
            $fireuser = $signInResult->data();
            $uid = $fireuser['localId'];

            $user = User::where('uid', $uid)->first();
            if ($user) {
                $user = User::updateOrCreate(['uid' => $uid], [
                    'remember_token' => $request->token
                ]);
                Auth::guard('firebase')->login($user);
                return redirect('/');
            }
            // Handle the authenticated user
        } catch (FirebaseException $e) {
            // Authentication failed
            return back()->withErrors([
                'email' => $e->getMessage(),
            ]);
        }
    }


    public function verifyRegister(Request $request)
    {
        // verify with token
        // token will come from frontend sdk.

        try {
            $verifiedIdToken = $this->auth->verifyIdToken($request->token);
            $uid = $verifiedIdToken->claims()->get('sub');
            $fireuser = $this->auth->getUser($uid);
            if ($fireuser) {
                $user = User::updateOrCreate(['uid' => $uid], [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => $request->password,
                    'uid' =>  $fireuser->uid,
                    'token' => $request->token
                ]);

                Auth::guard('firebase')->login($user);
                // return redirect()->route('/');
                return response()->json(['status' => true, 'message' => 'Registered Successfully']);
            }
        } catch (FailedToVerifyToken $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }
    public function verifyLogin(Request $request)
    {
        try {
            $verifiedIdToken = $this->auth->verifyIdToken($request->token);
            $uid = $verifiedIdToken->claims()->get('sub');
            $fireuser = $this->auth->getUser($uid);
            $user = User::where('uid', $fireuser->uid)->first();
            if ($user) {
                $user = User::updateOrCreate(['uid' => $fireuser->uid], [
                    'remember_token' => $request->token
                ]);
                Auth::guard('firebase')->login($user);
                return response()->json(['status' => true, 'message' => 'Login Success']);
            }
            return response()->json(['status' => false, 'message' => 'Invalid Details']);
        } catch (FailedToVerifyToken $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    public function logout()
    {
        try {
            if (Auth::guard('firebase')->check()) {
                $user = User::find(Auth::guard('firebase')->user()->id)->first();
                Auth::guard('firebase')->logout($user);
            }

            return response()->json(['status' => true, 'message' => 'logout Success']);
        } catch (FailedToVerifyToken $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    public function registerpage()
    {
        return view('register');
    }
    public function loginpage()
    {
        return view('login');
    }
}
