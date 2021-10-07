<?php

namespace App\Http\Controllers\Friend;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Friends;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FriendController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $friends = Friends::where('user_id', auth()->user()->id)->get();
        //print(auth()->user()->id);
        foreach ($friends as $key => $friend) {
            $friend->user->profile->pictures = $friend->user->pictures;
            
            echo json_encode($friend->user->profile);
            # code...
        }
        // return $this->showAll($friends);
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
            'friend_user_id' => 'required|integer',
        ]); 
       
        
        $friend = Friends::create([
            'user_id' => auth()->user()->id,
            'friend_user_id' => $request->friend_user_id,
            'request_date' =>  Carbon::now()
        ]);

        return $this->showOne($friend,200,'Friend Request Successfully Sent');
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
    public function edit(Friends $friends)
    {
        //
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
        ])->delete();

        return $this->successResponse('Cancel Friend Request',200);
    }
}
