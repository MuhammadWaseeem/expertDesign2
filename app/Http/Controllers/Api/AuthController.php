<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
class AuthController extends Controller
{
    public function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name'=>'required',
            'email' => 'required|email|unique:users',
            'password'  => 'required|min:3',
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => false,
                'errors' => $v->errors()
            ], 200);
        }
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->userRole = 'user';
        $user->password = bcrypt($request->password);
       if( $user->save()):
        return response()->json(['status' => 'success'], 200);
       else:
        return response()->json(['status' => 'false']);
       endif;
    }
    public function login(Request $request)
    {
        $v = Validator::make($request->all(), [
            'email' => 'required|email',
            'password'  => 'required|min:3',
        ]);
        if ($v->fails())
        {
            return response()->json([
                'status' => false,
                'errors' => $v->errors()
            ], 200);
        }
        $credentials = $request->only('email', 'password');
        if ($token = JWTAuth::attempt($credentials)) {
            return response()->json(['status' => true,'user'=>Auth::user(),'accessToken'=>$token], 200)->header('Authorization', $token);
        }
        return response()->json(['status' => false,'error' => 'Email and Password is not matched.'], 200);
    }
    public function logout()
    {
//        $this->guard()->logout();
        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }
    public function user(Request $request)
    {
        $user = User::find(Auth::user()->id);
        return response()->json([
            'status' => 'success',
            'data' => $user
        ]);
    }
    public function refresh(Request $request)
    {
        if ($token = JWTAuth::refresh($request->accessToken)) {
            return response()
                ->json(['status' => true], 200)
                ->header('Authorization', $token);
        }
        return response()->json(['error' => 'refresh_token_error'], 401);
    }
    private function guard()
    {
        return Auth::guard();
    }

    public function users(){
        $users=User::all();
        return response()->json(['users'=>$users]);
    }
}
