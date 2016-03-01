<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class ApiController extends Controller
{
    public function __construct()
    {
        // Apply the jwt.auth middleware to all methods in this controller
        // except for the authenticate method. We don't want to prevent
        // the user from retrieving their token if they don't already have it
        $this->middleware('jwt.auth', ['except' => ['login']]);
    }

    public function index($id = null)
    {
        $notes = new \App\Note();
        if ($id == null) {
            $res = $notes->all();
        } else {
            $user = new \App\User();
            $user->id = $id;
            $res = $user->note;
        }
        return json_encode(array(
            'error' => false,
            'notes' => $res,
            'status_code' => 200
        ));
    }

    public function login(Request $request)
    {
        $userName = $request->input('username');
        $password = $request->input('password');

        $c = $request->only('email', 'password');

        if(empty($password)){
            return json_encode(array(
                'error' => true,
                'error_message' => "please provide both, username and password",
                'status_code' => 403
            ));
        }

        try {
            // verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($c)) {
                return response()->json(['error' => 'invalid_credentials'], 401);

            }
        } catch (JWTException $e) {
            // something went wrong
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        // if no errors are encountered we can return a JWT
        return response()->json(compact('token'));

    }
}
