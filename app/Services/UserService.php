<?php
/**
 * Created by PhpStorm.
 * User: ngoha
 * Date: 7/21/2020
 * Time: 6:59 PM
 */


namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateRequest;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserService
{

    private $repo;
    private $update;

    public function __construct(UserRepository $repository)
    {
        $this->repo = $repository;
        $this->update = $repository;
    }

    public function createRegister(RegisterRequest $request)
    {
        $params = $request->all();
        $params["password"] = Hash::make($params["password"]);
        return $this->repo->create($params);
    }

    public function updateData(UpdateRequest $request)
    {
        $user = JWTAuth::user();
        $data = $request->all();
        return $this->update->update($data, $user);
    }

    public function authenticate(LoginRequest $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');
        try {
            // attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }

    public function get()
    {
        $user = JWTAuth::user();
        if (count((array)$user) > 0) {
            return response()->json(['status' => 'success', 'user' => $user]);
        } else {
            return response()->json(['status' => 'fail'], 401);
        }
    }

    public function logoutUser()
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['success' => true]);
    }



}
