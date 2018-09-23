<?php
namespace App\Http\Middleware;

use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\TokenBlacklistedException;

class RefreshToken extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        // Check presence of a token.
        $this->checkForToken($request);

        if ($request->route()->uri() === 'api/auth/refresh') {
            return $next($request);
        }

        try {
            if (!$this->auth->parseToken()->authenticate()) {
                $success = false;
                $data = [];
                $error = ["message" => 'User not found. Please check token.', "code" => 1000];

                return response()->json(compact('success', 'data', 'error'));
            }
            // Token is valid. User logged. Response without any token.

            return $next($request);
        } catch (TokenExpiredException $e) {
            $success = false;
            $data = [];
            $error = ["message" => 'Token expired. Please request with new token.', "code" => 1001];

            return response()->json(compact('success', 'data', 'error'));
        } catch (TokenInvalidException $e) {
            $success = false;
            $data = [];
            $error = ["message" => 'Token invalid. Please request with valid token.', "code" => 1002];

            return response()->json(compact('success', 'data', 'error'));
        } catch (TokenBlacklistedException $e) {
            $success = false;
            $data = [];
            $error = ["message" => 'Token blacklisted. Please request with valid token.', "code" => 1003];

            return response()->json(compact('success', 'data', 'error'));
        } catch (JWTException $e) {
            $success = false;
            $data = [];
            $error = ["message" => 'Token absent. Please request with a token.', "code" => 1004];

            return response()->json(compact('success', 'data', 'error'));
        }
    }
}
