<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\Mail\UserCreated;
use App\Models\Profiles;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends ApiController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {

        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'gender' => 'required|string',
            'profile_fill_by' => 'required|string',
            // 'name_visible' => 'required|bool',
            'email' => 'required|email|unique:users',
            'user_name' => 'unique:users',
            'password' => 'required|min:6|confirmed',
            'phone_number' => 'required|min:9|unique:users',
        ], ['status' => false]);

        try {

            $data = $request->all();
            $data['password'] = bcrypt($request->password);
            $data['status'] = User::USER_UN_VERFIED;
            $data['verification_token'] = User::generateVerificationCode();
            $data['phone_number_verified'] = User::PHONE_NUMBER_NOT_VERIFIED;
            $data['email_verified'] = User::EMAIL_NOT_VERIFIED;
            if ($data['gender'] == '1') {
                $data['profile_picture'] = User::MALE_PROFILE_PICTURE;
            } else {
                $data['profile_picture'] = User::FEMALE_PROFILE_PICTURE;
            }
            // $data['profile_picture'] = User::MALE_PROFILE_PICTURE;

            $user = User::create($data);

            if ($user) {
                Profiles::create([
                    'user_id' =>  $user->id
                ]);
            }


            $token = $user->createToken('myapptoken')->plainTextToken;


            $response = [
                'data' => $user,
                'token' => $token,
                'status' => true,
            ];

            return response($response, 201);
        } catch (Exception $e) {
            return $this->errorResponse('Failed to Create Account', 404);
        }
    }


    public function logout(Request $request)
    {
        // return "there";
        //  auth()->user()->tokens->delete();
        //auth()->user()->tokens()->delete();
        $request->user()->currentAccessToken()->delete();

        $response = [
            'data' => [],
            'message' => 'Successfully Logout',
            'status' => true,
        ];

        return response($response, 200);
    }



    public function login(Request $request)
    {

        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $fields['email'])->orWhere('user_name', $fields['email'])->first();
        if (!$user) {
            return response()->json([
                'error' =>
                ['email' => ['Credentials does not match',]]
            ], 401);
        }

        if (!Hash::check($fields['password'], $user->password)) {
            return response()->json([
                'error' =>
                ['password' => ['Credentials does not match',]]
            ], 401);
        }

        if ($request->has('device_notify_token')) {
            $user->device_notify_token = $request->device_notify_token;
            $user->save();
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'data' => $user,
            'token' => $token,
            'status' => true,
        ];

        return response($response, 200);
    }

    //   {headers: {}, original: No Authorized, exception: null}


    public function verify($token)
    {

        $user = User::where('verification_token', $token)->first();
        if ($user) {
            $user->verification_token = '';
            $user->is_email_verified = User::EMAIL_VERIFIED;

            $user->save();
            return $this->showMessage('The account has been verified successfullly');
        } else {
            return $this->errorResponse('No Verification token found', 404);
        }
    }

    public function forgotPassword(Request $request)
    {
        try {

            $request->validate([
                'email' => 'required|email|exists:users',
                
            ]);

            $uniqueId = User::uniqueId();

            // Mail::send('about.emailconfirmation', ['data' => 'Unique id is : '.$uniqueId]);

            Mail::to($request->email)->send(new ResetPassword($uniqueId));

            $response = [
                'unique_id' => $uniqueId,
                'status' => true,
                'message' => 'Token Sent on Your Email Address Please Check'
            ];
        } catch (Exception $ex) {
            return $this->errorResponse('Something Went Wrong.', 404);
        }

        return response($response, 200);
    }

    public function resetPassword(Request $request)
    {

        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:6|confirmed',
        ]);




        $user = User::where('email', $request->email)->first();
        return  $this->modifyPassword($user, $request->password);
    }


    public function changePassword(Request $request)
    {
        $request->validate([

            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::where('id', auth()->user()->id)->first();
        return  $this->modifyPassword($user, $request->password);
    }

    private function modifyPassword(User $user, $password)
    {
        // return $user;

        if (!$user) {
            return $this->errorResponse('User does not exist', 404);
        } else {
            $user->password = bcrypt($password);

            $user->save();
            return $this->successResponse('Reset Password Success', 200);
        }
    }
}