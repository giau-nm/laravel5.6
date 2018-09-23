<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Resources\User\Register as UserRegisterResource;
use App\Helpers\Util;
use App\Services\AuthService;

class AuthController extends Controller
{

    public function user(Request $request)
    {
        $data = $request->user();
        return response()->json([
            'data' => $data,
        ]);
    }

    /**
     * Register a new user.
     *
     * @SWG\Post(
     *   tags={"Auth"},
     *   path="/auth/register",
     *   summary="Register a new user.",
     *   @SWG\Response(
     *       response=200,
     *       description="successful operation",
     *       @SWG\Schema(
     *           @SWG\Property(
     *               property="success", type="boolean"
     *           ),
     *           @SWG\Property(
     *               property="error",
     *               type="object",
     *               @SWG\Items(ref="#/definitions/Error")
     *           ),
     *           @SWG\Property(
     *               property="data",
     *               type="object"
     *           )
     *       ),
     *   ),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function register(Request $request)
    {
        $success = false;
        $data = [];
        $error = null;

        try {
            $rules = [
                'email' => 'required|email|unique:users,email|max:255',
                'lastname' => 'required|max:255',
                'firstname' => 'required|max:255',
                'password' => 'required|min:6|max:255'
            ];
            $messages = [
                'email.unique' => "Someone's already using that email. "
                . "If that’s you, enter your Email and password here to sign in."
            ];
            $validator = Util::validatorParamsData($request->all(), $rules, $messages);
            if ($validator !== true) {
                $error = ["message" => $validator, "code" => "XXXXX"];

                return compact('success', 'data', 'error');
            }

            $service = new AuthService();
            $user = $service->createUser($request->email, $request->password, $request->lastname, $request->firstname);
            if ($user) {
                $success = true;
            } else {
                $error = ["message" => "Not create user, please try again.", "code" => "XXXXX"];
            }
        } catch (\Exception $ex) {
            $error = ["message" => "Could not register. Please try again.", "code" => "XXXXX"];
        }

        return compact('success', 'data', 'error');
    }

    /**
     * Sign in with email and password of user.
     *
     * @SWG\Post(
     *   tags={"Auth"},
     *   path="/auth/signin",
     *   summary="Sign in with email and password of user.",
     *   @SWG\Response(
     *       response=200,
     *       description="successful operation",
     *       @SWG\Schema(
     *           @SWG\Property(
     *               property="success", type="boolean"
     *           ),
     *           @SWG\Property(
     *               property="error",
     *               type="object",
     *               @SWG\Items(ref="#/definitions/Error")
     *           ),
     *           @SWG\Property(
     *               property="data",
     *               type="object",
     *               @SWG\Property(
     *                   property="token",
     *                   type="string"
     *               ),
     *               @SWG\Property(
     *                   property="expires",
     *                   type="integer"
     *               ),
     *               @SWG\Property(
     *                   property="user",
     *                   type="array",
     *                   @SWG\Items(ref="#/definitions/User")
     *               )
     *           )
     *       ),
     *   ),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function signin(Request $request)
    {
        $success = false;
        $data = [];
        $error = null;

        try {
            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required|min:6|max:255'
            ];
            $validator = Util::validatorParamsData($request->all(), $rules);
            if ($validator !== true) {
                $error = ["message" => $validator, "code" => "XXXXX"];

                return compact('success', 'data', 'error');
            }

            $service = new AuthService();
            $response = $service->getUser($request->email, $request->password);
            if ($response['success']) {
                // grab credentials from the request
                $credentials = $request->only('email', 'password');
                $token = JWTAuth::attempt($credentials);
                // attempt to verify the credentials and create a token for the user
                if (!$token) {
                    $error = ["message" => "Invalid credentials. Please try again.", "code" => "XXXXX"];
                } else {
                    $data['token'] = $token;
                    $data['expires'] = JWTAuth::factory()->getTTL() * 60;
                    $data['user'] = new UserRegisterResource($response['user']);
                    $success = true;
                }
            } else {
                $error = ["message" => $response['message'], "code" => "XXXXX"];
            }
        } catch (JWTException $ex) {
            // something went wrong whilst attempting to encode the token
            $error = ["message" => $ex->getMessage(), "code" => "XXXXX"];
        } catch (\Exception $ex) {
            $error = ["message" => "Could not sign in. Please try again.", "code" => "XXXXX"];
        }

        return compact('success', 'data', 'error');
    }

    /**
     * Get infomation of user logged.
     *
     * @SWG\Get(
     *   tags={"Auth"},
     *   path="/auth/user",
     *   summary="Get infomation of user logged.",
     *   @SWG\Response(
     *       response=200,
     *       description="successful operation",
     *       @SWG\Schema(
     *           @SWG\Property(
     *               property="success", type="boolean"
     *           ),
     *           @SWG\Property(
     *               property="error",
     *               type="object",
     *               @SWG\Items(ref="#/definitions/Error")
     *           ),
     *           @SWG\Property(
     *               property="data",
     *               type="object",
     *               @SWG\Property(
     *                   property="user",
     *                   type="array",
     *                   @SWG\Items(ref="#/definitions/User")
     *               )
     *           )
     *       ),
     *   ),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function getAuthenticatedUser()
    {
        $success = false;
        $data = [];
        $error = null;

        try {
            $user = JWTAuth::parseToken()->authenticate();
            $data['user'] = new UserRegisterResource($user);
            $success = true;
        } catch (JWTException $ex) {
            $error = ["message" => $ex->getMessage(), "code" => "XXXXX"];
        } catch (\Exception $ex) {
            $error = ["message" => "Could not get user infomation. Please try again.", "code" => "XXXXX"];
        }

        return compact('success', 'data', 'error');
    }

    /**
     * Refresh token.
     *
     * @SWG\Post(
     *   tags={"Auth"},
     *   path="/auth/refresh",
     *   summary="Refresh token.",
     *   @SWG\Response(
     *       response=200,
     *       description="successful operation",
     *       @SWG\Schema(
     *           @SWG\Property(
     *               property="success", type="boolean"
     *           ),
     *           @SWG\Property(
     *               property="error",
     *               type="object",
     *               @SWG\Items(ref="#/definitions/Error")
     *           ),
     *           @SWG\Property(
     *               property="data",
     *               type="object",
     *               @SWG\Property(
     *                   property="token",
     *                   type="string"
     *               ),
     *               @SWG\Property(
     *                   property="expires",
     *                   type="integer"
     *               ),
     *               @SWG\Property(
     *                   property="user",
     *                   type="array",
     *                   @SWG\Items(ref="#/definitions/User")
     *               )
     *           )
     *       ),
     *   ),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error")
     * )
     */
    public function refreshToken()
    {
        $success = false;
        $data = [];
        $error = null;

        try {
            // Refresh and get new token.
            $data['token'] = JWTAuth::parseToken()->refresh();
            $data['expires'] = JWTAuth::factory()->getTTL() * 60;
            $user = JWTAuth::parseToken()->authenticate();
            $data['user'] = new UserRegisterResource($user);
            $success = true;
        } catch (JWTException $ex) {
            $error = ["message" => $ex->getMessage(), "code" => "XXXXX"];
        } catch (\Exception $ex) {
            $error = ["message" => "Could not get refresh token. Please try again.", "code" => "XXXXX"];
        }

        return compact('success', 'data', 'error');
    }
}
