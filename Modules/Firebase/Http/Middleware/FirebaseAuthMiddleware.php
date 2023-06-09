<?php

namespace Modules\Firebase\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\AuthException as FirebaseException;
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

class FirebaseAuthMiddleware
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

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
