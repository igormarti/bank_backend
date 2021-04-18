<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{

    /**
     * Service Model
     *
     * @var UserService
     */
    private $userService;

    /**
     * Controller Constructor
     *
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    function show($id){

        try {
            $user = $this->userService->getUser($id);

            return response()->json(['status' => true,'user' => $user], Response::HTTP_OK);
        }catch (\Throwable $error){
            return response()->json([
                'success' => false,
                'errors' => $error->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    function update(Request $request, $id){

        try {
            $user = $this->userService->updateUser($request->all(),$id);

            return response()->json(['status' => true, 'user' => $user], Response::HTTP_OK);
        }catch (\Throwable $error){

            return response()->json([
                'success' => false,
                'errors' => $error->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }

    }
}
