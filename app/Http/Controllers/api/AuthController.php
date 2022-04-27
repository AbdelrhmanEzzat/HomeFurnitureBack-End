<?php

namespace App\Http\Controllers\api;


use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\return\Response;
use illuminate\Support\Facades\Hash;


class AuthController extends Controller
{

    public function register(Request $request){
        $fields = $request->validate([
            'name' => 'required|string',
            'email'=> 'required|string|unique:users,email',
            'password'=>'required|string|confirmed'
        ]);
        $user = User::create([
            'name'=> $fields['name'],
            'email'=> $fields['email'],
            'password'=> bcrypt($fields['password'])


        ]);

        $token = $user -> createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token'=> $token
        ];
        return response($response,201);
    }

    public function login(Request $request){

        // $fields = $request->validate([
        //     'email'   => 'required|string',
        //     'password'=> 'required|string'
        // ]);

        // //cheak email
        // $user = User::where('email',$fields['email'])->first();
        // // cheak password
        // if(!$user || !Hash::check($fields['password'], $user->password)){
        //     return response(
        //         ['message' => 'Bad creds'
        //     ],401);
        // }
        // $user = $this->auth->user();
        // $token = $user->createToken('myapptoken')->plainTextToken;


        // $response = [
        //     'user' => $user,
        //     'token'=> $token

        // ];
        // return response($response,201);
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
            'message' => 'Invalid login details'
                       ], 401);
                   }

            $user = User::where('email', $request['email'])->firstOrFail();

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                       'access_token' => $token,
                       'token_type' => 'Bearer',
            ]);

        }




    // public function login(Request $request){

    //     $fields = $request->validate([
    //         'email'   => 'required|string',
    //         'password'=> 'required|string'
    //     ]);
    //     $credential = request(['email','password']);

    //     if (!Auth::attempt($credential)){
    //         return response()->json(['messeage'=> 'Unauthorized'],401 );

    //     }
    //     $user = $request->user();
    //     $tokenResult = $user-> createToken('Personal access Token ');
    //     $token  = $tokenResult->token;
    //     $token->expires_at = carbon::now()->addWeek(1);
    //     $token->save();

    //     return response()->json(['data'=> [
    //         'user' => Auth::user(),
    //         'access_token'=> $tokenResult->accessToken,
    //         'token_type' => 'Bearer',
    //         'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()

    //     ]]);


    // }




    public function logout(Request $request)
    {
        if ($request->user()) {
            $request->user()->tokens()->delete();
        }

        return response()->json(['message' => 'Successfully logged out'], 200);
    }
}
