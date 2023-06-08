<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\AuthException as FirebaseException;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

class FirebaseAuth
{

    protected $auth;

    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount(base_path('/') . 'firebase_credentials.json');

        $this->auth = $factory->createAuth();
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $token  = $request->header('token');
            $verifiyToken = $this->auth->verifyIdToken($token);
            $uid = $verifiyToken->claims()->get('sub');
            $firebaseuser = $this->auth->getUser($uid);
            $user = User::where('uid', $firebaseuser->uid)->first();

            if ($user) {
            } else {
                // User::create([
                //     'name' => $firebaseuser->displayName,

                // ]);
            }
            Auth::guard('firebase')->login($user);
            return $next($request);
        } catch (FailedToVerifyToken $e) {
            // $e->getMessage()
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
    }
}
