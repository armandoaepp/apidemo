<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class ApiController extends Controller
{
    public function __construct()
    {
       // Apply the jwt.auth middleware to all methods in this controller
       // except for the index method.
       $this->middleware('jwt.auth', ['except' => ['authenticate']]);
       $this->middleware('cors');

    }

	public function authenticate(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        $data = JWTAuth::toUser($token);

        return response()->json([
                'message' => 'Validacion Correcta',
                'error'   => false,
                'errors'  => [],
                'data'    => $data ,
                'token'   => $token ,
            ]);

         dd($user);

        // all good so return the token
        return response()->json(compact('token'));
    }

    public function demo(Request $request)
    {

    	$email    = $request->input('email');
        $password = $request->input('password');
        $token    = null;

        $params = array(
                'email'    => $email,
                'password' => $password,
                // 'estado'   => 1,
            );

        try{
            if (!$token = JWTAuth::attempt($params)) {
                return response()->json([
                    'message' => 'Credenciales Inalidadas ',
                    'error'   => true,
                    'errors'  => [],
                    'data'    => [] ,
                ]);
                // return response()->json(['error' => 'invalid_credentials']);
            }
        }catch(JWTException $ex){
            return response()->json([
                    'message' => 'someting_went_wrong',
                    'error'   => true,
                    'errors'  => [],
                    'data'    => [] ,
                ]);
        }

        $user = JWTAuth::toUser($token);
         dd($user);
    }
}
