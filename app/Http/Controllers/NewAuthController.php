<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\User;
use Auth;
use Validator;

class NewAuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', '=', $request->email)->firstOrFail();
        $status = "error";
        $message = "";
        $data = null;
        $code = 401;
        if($user)
        {
            if(Hash::check($request->password, $user->password))
            {
                $user->generateNewToken();
                $status = 'success';
                $message = 'Login success';
                $data = $user->toArray();
                $code = 200;
            }
            else {
                $message = "Login failed, wrong password";
            }
        }
        else {
            $message = "Login failed, wrong username";
        }

        return response()->json(['status' => $status, 'message' => $message, 'data' => $data], $code);
    }
    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $status = "error";
        $message = "";
        $data = null;
        $code = 400;

        if($validator->fails())
        {
            $errors = $validator->errors();
            $message = $errors;
        }
        else
        {
            $user = \App\User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'roles' => 0,
            ]);
            if($user)
            {
                $user->generateNewToken();
                $status = "success";
                $message = "register successfully";
                $data = $user->toArray();
                $code = 200;
            }
            else
            {
                $message = "register failed";
            }
        }
        return response()->json(['status' => $status, 'message' => $message, 'data' => $data], $code);
    }

    public function logout()
    {
        $user = Auth::user();
        if($user)
        {
            $user->api_token = null;
            $user->save();
        }
        return response()->json(['status' => 'success', 'message'=> 'logout successfully', 'data' => null], 200);
    }
}
