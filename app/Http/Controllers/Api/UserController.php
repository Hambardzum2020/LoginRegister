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
    private $service;

    function __construct(UserService $userService)
    {
        $this->service = $userService;
    }

    public function register(RegisterRequest $request){
        $this->service->createRegister($request);
        return response()->json($request->all(), 200);
    }

    public function update(UpdateRequest $request)
    {
        $this->service->updateData($request);
        return response()->json($request->all(),200);
    }

    public function login(LoginRequest $request)
    {
       return $this->service->authenticate($request);
    }

    public function user()
    {
        return $this->service->get();
    }

    public function logout()
    {

        return $this->service->logoutUser();
    }



}

