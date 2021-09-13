<?php

namespace App\Http\Controllers;

use App\Models\Profiles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
  public function register(Request $request){
        
    // $rules=[
    //     'first_name' => 'required|string',
    //     'last_name' => 'required|string',
    //     'nick_name' => 'required|string',
    //     'user_name' => 'required|string',
    //     'email' => 'required|email|unique:users',
    //     'password' => 'required|min:6|confirmed',
    //     'phone_number' => 'required|min:11',
    //  ];

    
    // $validated = $request->validate([
    //         'first_name' => 'required|string',
    //     'last_name' => 'required|string',
    //     'nick_name' => 'required|string',
    //     'user_name' => 'required|string',
    //     'email' => 'required|email|unique:users',
    //     'password' => 'required|min:6|confirmed',
    //     'phone_number' => 'required|min:11',
    // ]);
        
     $request->validate([
        'first_name' => 'required|string',
        'last_name' => 'required|string',
        'nick_name' => 'required|string',
        'user_name' => 'required|string',
        'email' => 'required|email|unique:users',
        'user_name' => 'required|unique:users',
        'password' => 'required|min:6|confirmed',
        'phone_number' => 'required|min:11',
    ]);
    

     $data=$request->all();
     $data['password'] =bcrypt($request->password);
     $data['status'] =User::USER_UN_VERFIED;
     $data['verification_token'] = User::generateVerificationCode();
     $data['device_notify_token'] =User::deviceNotificationToken();
     $data['phone_number_verified'] =User::PHONE_NUMBER_NOT_VERIFIED;
     $data['email_verified'] =User::EMAIL_NOT_VERIFIED;

     $user= User::create($data);

    
    Profiles::create([
        'user_id' =>  $user->id
    ]);
    // DB::insert('insert into profiles (user_id) values (?)', [$user->id]);
     

    // return response()->json(['data' => $user],201);

   
    // $user = User::create([
    //     'name' => $fields['name'],
    //     'email' => $fields['email'],
    //     'password' => bcrypt($fields['password']) 
    // ]);

    $token = $user->createToken('myapptoken')->plainTextToken;


    $response =[
        'user' => $user,
        'token'=> $token
    ];

    return response($response, 201);
  }


    public function logout(Request $request){
         auth()->user()->tokens->delete();
         //auth()->user()->tokens()->delete();
        //$user->tokens()->where('id', $tokenId)->delete();

        return [
            'message' => 'Logged Out.'
        ];

    }



    public function login(Request $request){
        $fields =$request->validate([
            'email' => 'required|string',
            'password'=> 'required|string'
        ]);
    
        $user = User::where('email',$fields['email'])->first();

        if(!$user  || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => ' Bad Creds'
            ],401);
        }
    
        $token = $user->createToken('myapptoken')->plainTextToken;
    
        $response =[
            'data' => $user,
            'token'=> $token,
            'status' => true,
        ];
    
        return response($response, 200);
      }

}
