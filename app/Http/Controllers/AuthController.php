<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //create user
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|',
            'email' => 'required|string|email|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        if ($user) {
            $success['user'] =  $user;
            $success['token'] =  $user->createToken('token')->accessToken;
            $success['message'] = "Registration successfull..";
            return $this->sendResponse($success);
        } else {
            $error = "Sorry! Registration is not successfull.";
            return $this->sendError($error, 401);
        }
    }

    //login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials)) {
            $error = "Unauthorized";
            return $this->sendError($error, 401);
        }
        $user = $request->user();
        $success['user'] =  $user;
        $success['token'] =  $user->createToken('token')->accessToken;
        return $this->sendResponse($success);
    }

    //logout
    public function logout(Request $request)
    {

        $isUser = $request->user()->token()->revoke();
        if ($isUser) {
            $success['message'] = "Successfully logged out.";
            return $this->sendResponse($success);
        } else {
            $error = "Something went wrong.";
            return $this->sendResponse($error);
        }
    }

    //getuser
    public function getUser(Request $request)
    {
        $id = $request->user;
        if ($request->user) {
            $user = User::find($id);
        } else {
            $user = auth()->user();
        }
        if ($user) {
            return $this->sendResponse($user);
        } else {
            $error = "user not found";
            return $this->sendResponse($error);
        }
    }

    public function search($keyword)
    {
        try {
            $user = User::all();
            $success['data'] = $user;
            $success['success'] = true;
            $success['message'] = "Successfully logged out.";
            return $this->sendResponse($success);
        } catch (\Exception $e) {
            $success['success'] = false;
            $success['error'] = "Successfully logged out.";
            return $this->sendResponse($success, 401);
        }.
    }
}
