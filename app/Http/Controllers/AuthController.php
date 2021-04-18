<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{

    /**
     * Service Model
     *
     * @var UserService
     */
    private $userService;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->middleware('api', ['except' => ['login']]);
    }

    /**
     * Register user and account.
     * @param StoreUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    function create(StoreUserRequest $request){

        try {
            $this->userService->createUser($request->all());

            return response()->json(['status' => true], Response::HTTP_CREATED);
        }catch (\Throwable $error){

            return response()->json([
                'success' => false,
                'errors' => $error->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }

    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {

        if (! $token = auth('api')->attempt($request->only('email','password'))) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['status' => true]);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->createNewToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth('api')->user()
        ]);
    }
}