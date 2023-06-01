<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Friends;
use App\Models\Pictures;
use App\Models\Profiles;
use App\Models\User;
use App\Models\UserFavorites;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpKernel\Profiler\Profile;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {

    //     $userGender = User::findOrFail(auth()->user()->id);
    //     if ($userGender->gender == User::MALE) {
    //         $userGender =  User::FEMALE;
    //     } else {
    //         $userGender = USER::MALE;
    //     }


    //     $users = DB::select(DB::raw('select u.id, u.first_name,u.last_name,u.nick_name,u.user_name,u.email,u.phone_number,u.gender,u.profile_fill_by,u.profile_picture,u.profile_picture_active,u.is_email_verified,u.is_phone_number_verified,u.device_notify_token,u.status, f.user_id friend_user_id, f.status as friend_status, fv.user_id fav_user_id from users
    //     u left join friends f on u.id = f.friend_user_id left join
    //     user_favorites fv on u.id = fv.fav_user_id where (fv.user_id = ' . auth()->user()->id . ' or fv.user_id is null) AND (f.user_id = ' . auth()->user()->id . ' or f.user_id is null)  AND u.gender = ' . $userGender . ' AND u.status NOT IN (2) AND u.id !=' . auth()->user()->id . ' AND ( f.status = ' . Friends::NEWW . ' OR f.status is null)'));


    //     $friends = Friends::where(['friend_user_id' => auth()->user()->id], ['status', Friends::ACCEPTED])->get();


    //     $filtered = [];
    //     foreach ($users as $user) {
    //         $isFriend = false;
    //         foreach ($friends as $friend) {
    //             if ($user->id == $friend->user_id) {
    //                 $isFriend = true;
    //             }
    //         }
    //         if (!$isFriend) {
    //             $userProfile = Profiles::Where([
    //                 'user_id' => $user->id,
    //             ])->first();
    //             $user->profile = $userProfile;

    //             $userPictures = Pictures::Where([
    //                 'user_id' => $user->id,
    //             ])->get();
    //             $user->pictures = $userPictures;
    //             $filtered[] = $user;
    //         }
    //     }

    //     $users = $filtered;

    //     return response()->json([
    //         'data' => $users,
    //         'status' => true,
    //         'statusCode' => 200,
    //         'message' => 'successfully Listed'
    //     ]);
    // }



    public function index()
    {
        $currentUser = auth()->user();
        $gender =  $currentUser->gender == 1 ? 2 : 1;

        if ($currentUser->status == 0) {
            return response()->json([
                'data' => [],
                'status' => false,
                'statusCode' => 501,
                'title' => 'Not verified',
                'message' => 'You are currently unable to view other matches, because your request is pending for approval.'
            ], 501);
        } else if ($currentUser->status == 2) {
            return response()->json([
                'data' => [],
                'status' => false,
                'statusCode' => 501,
                'title' => 'Blocked',
                'message' => 'Your profile has been blocked due to misconduct'
            ], 501);
        }
        $users = User::where('status', 1)->where("gender", $gender)->get();

        $usersArray = array();

        foreach ($users as $key => $user) {

            $user->profile = $user->profile;
            $user->pictures = $user->pictures;
            $user->favourite =  UserFavorites::where([
                ['fav_user_id', '=', $user->id],
                ['user_id', '=', auth()->user()->id],

            ])->first();

            $newFriend = Friends::where([
                ['friend_user_id', '=', $user->id],
                ['user_id', '=', auth()->user()->id],
                ['status', '=', 1],
            ])->first();

            $friend = Friends::where(function ($query) use ($user) {
                $query->where([
                    ['friend_user_id', '=', auth()->user()->id],
                    ['user_id', '=', $user->id],
                    ['status', '=', 2],
                ]);
            })->orWhere(function ($query) use ($user) {
                $query->where([
                    ['friend_user_id', '=', $user->id],
                    ['user_id', '=', auth()->user()->id],
                    ['status', '=', 2],
                ]);
            })->first();

            if (!$friend) {
                $user->friend = $newFriend;
                $usersArray[] = $user;
            } else {
                unset($users[$key]);
            }
        }

        return response()->json([
            'data' => array_values($users->toArray()),
            'status' => true,
            'statusCode' => 200,
            'message' => 'successfully Listed'
        ]);
    }






    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user = User::findOrFail(auth()->user()->id);
        return $this->showOne($user);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, User $user)
    {
        try {

            $user = User::findOrFail(auth()->user()->id);
            if ($user) {


                if ($request->image_object) {

                    $picture = $request->image_object;
                    $pictureDecode = json_decode($picture, true);

                    $uniqueName = time() . $pictureDecode['imageName'];

                    $response = file_put_contents('pictures/' . $uniqueName, base64_decode($pictureDecode['image']));

                    if ($response) {
                        $image_path = public_path("\pictures\\") . $user->profile_picture;
                        if (File::exists($image_path)) {
                            File::delete($image_path);
                        }

                        $user->profile_picture = $uniqueName;
                    }
                }

                if ($request->first_name) {
                    $user->first_name = $request->first_name;
                }
                if ($request->last_name) {
                    $user->last_name = $request->last_name;
                }

                if ($request->gender) {
                    $user->gender = $request->gender;
                }

                // if (!$user->isDirty()) {
                //     return $this->errorResponse('You Need to Specify Different Value to Update', 422);
                // }


                $user->save();

                return  $this->showOne($user);
            } else {
                return $this->errorResponse('User not found', 404);
            }
        } catch (Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 404);
        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function deleteUser()
    {
        try {

            $user = auth()->user();

            if ($user) {

                $user->delete();
                return response()->json([
                    'data' => $user,
                    'status' => true,
                    'statusCode' => 200,
                    'message' => 'successfully Listed'
                ]);
            } else {
                return $this->errorResponse('User not found', 404);
            }
        } catch (Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 404);
        }
    }
}



// SELECT * FROM users,friends WHERE (users.id=friends.user_id AND friends.friend_user_id!=users.id) or (users.id=friends.friend_user_id AND friends.user_id!=users.id);