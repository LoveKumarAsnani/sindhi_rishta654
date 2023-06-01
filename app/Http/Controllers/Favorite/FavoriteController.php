<?php

namespace App\Http\Controllers\Favorite;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Friends;
use App\Models\Pictures;
use App\Models\Profiles;
use App\Models\User;
use App\Models\UserFavorites;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class FavoriteController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //     $users = DB::select(DB::raw('select u.id, u.first_name,u.last_name,u.nick_name,u.user_name,u.email,u.phone_number,u.gender,u.profile_fill_by,u.profile_picture,u.profile_picture_active,u.is_email_verified,u.is_phone_number_verified,u.device_notify_token,u.status, f.user_id friend_user_id, f.status as friend_status, fv.user_id fav_user_id from users
        // u left join friends f on u.id = f.friend_user_id left join
        // user_favorites fv on u.id = fv.fav_user_id where (fv.user_id = ' . auth()->user()->id . ') AND (f.user_id = ' . auth()->user()->id . ' or f.user_id is null) AND u.id !=' . auth()->user()->id . ''));

        //     foreach ($users as $key => $user) {
        //         $userProfile = Profiles::Where([
        //             'user_id' => $user->id,
        //         ])->first();
        //         $user->profile = $userProfile;

        //         $userPictures = Pictures::Where([
        //             'user_id' => $user->id,
        //         ])->get();
        //         $user->pictures = $userPictures;
        //     }
        //     return response()->json([
        //         'data' => $users,
        //         'status' => true,
        //         'statusCode' => 200,
        //         'message' => 'successfully Listed'
        //     ]);


        // $gender =  auth()->user()->gender == User::MALE ? User::FEMALE : User::FEMALE;
        $favUsersArray = array();
        $favUsers = UserFavorites::where('user_id', '=', auth()->user()->id)->get();
        foreach ($favUsers as $key => $favUser) {
            $user = User::find($favUser->fav_user_id);
            $user->profile = $user->profile;
            $user->pictures = $user->pictures;
            $friend = Friends::where(function ($query) use ($user) {
                $query->where([
                    ['friend_user_id', '=', auth()->user()->id],
                    ['user_id', '=', $user->id],
                    ['status', '=', Friends::ACCEPTED],
                ]);
            })->orWhere(function ($query) use ($user) {
                $query->where([
                    ['friend_user_id', '=', $user->id],
                    ['user_id', '=', auth()->user()->id],
                    ['status', '=', Friends::ACCEPTED],
                ]);
            })->first();

            $newFriend = Friends::where([
                ['friend_user_id', '=', $user->id],
                ['user_id', '=', auth()->user()->id],
                ['status', '=', Friends::NEWW],
            ])->first();
            if (!$friend) {
                $user->favourite = $favUser;
                $user->friend = $newFriend;
                $favUsersArray[] = $user;
            }
        }


        return response()->json([
            'data' => $favUsersArray,
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
        $request->validate([
            'fav_user_id' => 'required|integer',
        ]);

        $request->validate([
            'fav_user_id' => [
                Rule::unique('user_favorites')
                    ->where('fav_user_id', $request->input('fav_user_id'))
                    ->where('user_id', auth()->user()->id)
            ],
        ]);


        $friend = UserFavorites::create([
            'user_id' => auth()->user()->id,
            'fav_user_id' => $request->fav_user_id,
        ]);
        if ($friend) {
            return $this->showOne($friend, 200, 'Favorite Succeed');
        } else {
            return $this->errorResponse("Favorite Not Succeed", 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserFavorites  $userFavorites
     * @return \Illuminate\Http\Response
     */
    public function show(UserFavorites $userFavorites)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserFavorites  $userFavorites
     * @return \Illuminate\Http\Response
     */
    public function edit(UserFavorites $userFavorites)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserFavorites  $userFavorites
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserFavorites $userFavorites)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserFavorites  $userFavorites
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'fav_user_id' => 'required|integer',
        ]);


        $friend = UserFavorites::firstWhere([
            'user_id' => auth()->user()->id,
            'fav_user_id' => $request->fav_user_id,
        ])->delete();
        if ($friend) {
            return $this->successResponse('Removed from favorite list', 200);
        } else {
            return $this->errorResponse('Un Favorite not Succeed', 404);
        }
    }
}
