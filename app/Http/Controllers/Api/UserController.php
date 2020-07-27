<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    private $registerUser;
    private $loginUser;
    private $get;
    private $logoutUser;
    private $updateUserData;

    function __construct(UserService $userService)
    {
        $this->registerUser = $userService;
        $this->loginUser = $userService;
        $this->get = $userService;
        $this->logoutUser = $userService;
        $this->updateUserData = $userService;
    }

    public function register(RegisterRequest $request){
        $this->registerUser->createRegister($request);
        return response()->json($request->all(), 200);
    }

    public function update(UpdateRequest $request)
    {
        $this->updateUserData->updateData($request);
        return response()->json($request->all(),200);
    }

    public function login(LoginRequest $request)
    {
       return $this->loginUser->authenticate($request);
    }

    public function user()
    {
        return $this->get->get();
    }

    public function logout()
    {

        return $this->logoutUser->logoutUser();
    }



}

