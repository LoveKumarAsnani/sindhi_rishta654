<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Friends;
use App\Models\Pictures;
use App\Models\Profiles;
use App\Models\User;
use App\Models\UserFavorites;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        $userr = User::findOrFail(auth()->user()->id);
        if ($userr->gender == User::MALE) {
            $gender =  User::FEMALE;
        } else {
            $gender = USER::MALE;
        }

        $users  = User::where(['gender' => $gender], ['status', '!=', '2'])->get();

        foreach ($users as $key => $user) {
            //get profile of user
            $user->profile = $user->profile;
            $user->pictures = $user->pictures;
            $user->friend = Friends::where(['friend_user_id' => $user->id], ['user_id' => auth()->user()->id], ['status' => Friends::NEWW])->first();
            $user->favourite = UserFavorites::where(['fav_user_id' => $user->id], ['user_id' => auth()->user()->id])->first();

            // $friends = Friends::where(['friend_user_id' => $user->id])->whereOr(['user_id' => auth()->user()->id])->where(['friend_user_id' => auth()->user()->id])->whereOr(['user_id' => $user->id])->where('status', Friends::ACCEPTED)->get();

            $friends = Friends::where(['friend_user_id' => $user->id])->where(['user_id' => auth()->user()->id])->where(['status' => Friends::ACCEPTED])->first();
            $friendss = Friends::where(['friend_user_id' => auth()->user()->id])->where(['user_id' => $user->id])->where(['status' => Friends::ACCEPTED])->first();


            // return $friendss;
            //remove friend from list of users with id friend_user_id
            if ($friends) {
                $new_users = array();
                $user->friends = $friends ?? null;

                foreach ($users as $key => $user) {
                    if ($user->id != $friends->friend_user_id) {
                        $new_users[] = $user;
                    }
                }

                $users = $new_users;
            }

            //remove friend from list of users with id user_id
            if ($friendss) {
                $new_users = array();
                $user->friends = $friendss ?? null;
                foreach ($users as $key => $user) {
                    if ($user->id == $friends->user_id) {
                        $new_users[] = $user;
                    }
                }

                $users = $new_users;
            }

            if (!$friends && !$friendss) {
                $user->friends = null;
            }
        }

        //remove duplicate users
        $new_users = array();
        foreach ($users as $key => $user) {
            if (!in_array($user, $new_users)) {
                $new_users[] = $user;
            }
        }

        $users = $new_users;




        return response()->json([
            'data' => $users,
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

        $user = User::findOrFail(auth()->user()->id);
        if ($user) {


            if ($request->image_object) {

                $picture = $request->image_object;
                $pictureDecode = json_decode($picture, true);
                // return $pictureDecode;

                $response = file_put_contents('pictures/' . $pictureDecode['imageName'], base64_decode($pictureDecode['image']));

                if ($response) {

                    $user->profile_picture = $pictureDecode['imageName'];
                }
            }

            if ($request->first_name) {
                $user->first_name = $request->first_name;
            }
            if ($request->last_name) {
                $user->last_name = $request->last_name;
            }
            if ($request->nick_name) {
                $user->nick_name = $request->nick_name;
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
    public function destroy(User $user)
    {
        //
    }
}



// SELECT * FROM users,friends WHERE (users.id=friends.user_id AND friends.friend_user_id!=users.id) or (users.id=friends.friend_user_id AND friends.user_id!=users.id);
