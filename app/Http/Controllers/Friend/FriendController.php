<?php

namespace App\Http\Controllers\Friend;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Friends;
use App\Models\Pictures;
use App\Models\Profiles;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use PhpParser\ErrorHandler\Collecting;

class FriendController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $friends = Friends::where('friend_user_id', auth()->user()->id)->where('status', Friends::NEWW)->get();


        foreach ($friends as $key => $friend) {
            $requestDate = $friends[$key]->request_date;
            $friends[$key] = User::find($friend->user_id);

            $friends[$key]->profile;
            $friends[$key]->pictures;
            $friends[$key]['request_date'] = $requestDate;
        }
        return $this->showAll($friends);
    }


    //whom i send the requests and status is new
    public function myRequests()
    {
        $friends = Friends::where('user_id', auth()->user()->id)->where('status', Friends::NEWW)->get();

        foreach ($friends as $key => $friend) {
            $friends[$key] = User::find($friend->friend_user_id);

            $friends[$key]->profile;
            $friends[$key]->pictures;
        }
        return $this->showAll($friends);
    }



    //my all friends 

    public function friends()
    {

        // $user = User::find(auth()->user()->id);
        
        $friends = Friends::whereOr(['friend_user_id' => auth()->user()->id], ['user_id' => auth()->user()->id,])->where('status', Friends::ACCEPTED)->get();

        return $this->friendsOrRequests($friends);
    }


    private function friendsOrRequests(Collection $friends)
    {
        $friends = Friends::whereOr(['friend_user_id' => auth()->user()->id], ['user_id' => auth()->user()->id,])->where('status', Friends::ACCEPTED)->get();

        $oppositeUsers = [];

        foreach ($friends as $key => $friend) {
            // $friends[$key] = $friend->user;
            // $friend->profile = $friend->user->profile;
            // $friend->pictures = $friend->user->pictures;
            if ($friend->friend_user_id == auth()->user()->id) {
                // echo $friend->user_id . '<br/>';
                $user = User::find($friend->user_id);
                $user->profile;
                $user->pictures;
                array_push($oppositeUsers, $user);
            }
            if ($friend->user_id == auth()->user()->id) {
                // echo $friend->friend_user_id . '<br/>';
                $user = User::find($friend->friend_user_id);
                $user->profile;
                $user->pictures;
                array_push($oppositeUsers, $user);
            }
        }



        return response()->json([
            'data' => $oppositeUsers,
            'status' => true,
            'message' => 'Successful',
        ], 200);
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
            'friend_user_id' => 'required|integer',
        ]);
        $request->validate([
            'friend_user_id' => [
                Rule::unique('friends')
                    ->where('friend_user_id', $request->input('friend_user_id'))
                    ->where('user_id', auth()->user()->id)
            ],
        ]);
        $friend = Friends::where(['user_id' => $request->friend_user_id, 'friend_user_id' => auth()->user()->id,])->where('status', Friends::NEWW)->first();
        if ($friend) {
            $friend->status = Friends::ACCEPTED;
            $friend->save();
            return  $this->successResponse('Friend Request Accepted.', 200);
        } else {
            $friend = Friends::create([
                'user_id' => auth()->user()->id,
                'friend_user_id' => $request->friend_user_id,
                'request_date' =>  Carbon::now()
            ]);
            if ($friend) {
                return $this->showOne($friend, 200, 'Friend Request Successfully Sent');
            } else {
                return $this->errorResponse("Request Not Sent", 404);
            }
        }



        // $req->validate([
        //     'house_no' => [
        //         Rule::unique('house')
        //           ->where('house_no', $req->input('house_no'))
        //           ->where('ward_no', $req->input('ward_no'))
        //     ],
        // ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Friends  $friends
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return $this->showOne($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Friends  $friends
     * @return \Illuminate\Http\Response
     */
    public function acceptFriendRequest(Request $request)
    {
        $friend = Friends::where('user_id', $request->id)->where('friend_user_id', auth()->user()->id)->where('status', 1)->first();
        // return $this->showOne($friend);
        if ($friend) {
            $friend->status = Friends::ACCEPTED;
            $friend->save();
            return $this->successResponse('Request Accepted', 200);
        } else {
            return $this->errorResponse('Request not found', 404);
        }
    }
    public function removeFriend(Request $request)
    {
        $friend = Friends::where('user_id', $request->id)->orWhere('friend_user_id', auth()->user()->id)->where('user_id', auth()->user()->id)->orWhere('friend_user_id', $request->id)->where('status', Friends::ACCEPTED)->delete();

        if ($friend) {
            return $this->successResponse('SuccessFully Removed From Friend List', 200);
        } else {
            return $this->errorResponse('Friend Not Found', 404);
        }
    }

    public function deniedFriendRequest(Request $request)
    {
        $friend = Friends::where('user_id', $request->id)->where('friend_user_id', auth()->user()->id)->where('status', Friends::NEWW)->first();
        // return $this->showOne($friend);
        if ($friend) {
            $friend->status = Friends::DENIED;
            $friend->save();
            return $this->successResponse('Request Deleted', 200);
        } else {
            return $this->errorResponse('Request not found', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Friends  $friends
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Friends $friends)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Friends  $friends
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'friend_user_id' => 'required|integer',
        ]);

        $friend = Friends::Where([
            'user_id' => auth()->user()->id,
            'friend_user_id' => $request->friend_user_id,
            'status' => Friends::NEWW
        ])->delete();
        if ($friend) {
            return $this->successResponse('Cancel Friend Request', 200);
        } else {
            return $this->errorResponse("Not Found as Friend", 404);
        }
    }
}
