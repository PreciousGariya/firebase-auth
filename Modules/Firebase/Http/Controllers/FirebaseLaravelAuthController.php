<?php

namespace Modules\Firebase\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\AuthException as FirebaseException;

class FirebaseLaravelAuthController extends Controller
{
    protected $auth;

    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount(base_path('/') . '/firebase_credentials.json');

        $this->auth = $factory->createAuth();
    }

    //login pageview method
    public function index()
    {
        return view('firebase::laravel_auth.login');
    }

    //register pageview method

    public function create()
    {
        return view('firebase::laravel_auth.register');
    }

    //resetpassword page view
    public function resetPass()
    {
        return view('firebase::laravel_auth.reset');
    }
    // Registration of user on Server Level
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
                    'name' => $name,
                    'email' => $email,
                    'password' => Hash::make($password),
                    'uid' =>  $uid,
                    'token' => $token
                ]);
                Auth::guard('firebase')->login($user);
                return redirect('firebase/dashboard')->with('success','Registered successfully!');
            }
            // Handle the registered user
        } catch (FirebaseException $e) {
            // Registration failed
            Log::error($e);
            return back()->withErrors([
                'email' => $e->getMessage(),
            ]);
        }
    }

    // Login user on Server Level
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
                return redirect('firebase/dashboard')->with('success','Login successfully!');;;
            }
            // Handle the authenticated user
        } catch (FirebaseException $e) {
            // Authentication failed
            Log::error($e);
            return back()->withErrors([
                'email' => $e->getMessage(),
            ]);
        }
    }

    public function reset(Request $request)
    {
        try {
            $this->auth->sendPasswordResetLink($request->email);
            return redirect('firebase/laravel-auth')->with('success','Reset Password Email Sent successfully!');;;
        } catch (FirebaseException $e) {
            Log::error($e);
            return back()->withErrors([
                'email' => $e->getMessage(),
            ]);
        }
    }

    public function logout()
    {
        try {
            if (Auth::guard('firebase')->check()) {
                $user = User::find(Auth::guard('firebase')->user()->id)->first();
                Auth::guard('firebase')->logout($user);
            }
            return redirect('firebase/laravel-auth');
        } catch (Exception $e) {
            return back()->withErrors([
                'message' => $e->getMessage(),
            ]);
        }
    }
}
