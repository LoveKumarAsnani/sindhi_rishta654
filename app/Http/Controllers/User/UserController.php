<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users =User::all();
        // //echo($users[1]->friends()->get());

        // foreach ($users as $key => $user) {
        //     // $friend->user->profile->pictures = $friend->user->pictures;
            
        //     echo json_encode($friend->user->profile);
        // // return $this->showAll($users);

    //    $friends = DB::select(DB::raw('SELECT * FROM friends WHERE user_id != '.auth()->user()->id.' OR friend_user_id != '.auth()->user()->id));
    // SELECT * FROM users LEFT JOIN friends ON users.id == friends.user_id OR users.id == friends.friend_user_id WHERE baki tumhari wali condition   
    // $users = DB::select(DB::raw('SELECT * FROM users WHERE id != (SELECT user_id FROM friends WHERE user_id = '.auth()->user()->id.' OR friend_user_id = '.auth()->user()->id.') AND id != (SELECT friend_user_id FROM friends WHERE user_id = '.auth()->user()->id.' OR friend_user_id = '.auth()->user()->id.')'));
    
        // print_r($users[0]->profile);
       
        $users = User::where(function ($query) {
            $query->select('user_id')
                ->from('friends')
                ->whereColumn('friends.user_id', 'friends.friend_user_id')
                ->limit(1);
        })->get();

        // foreach ($friends as $key => $friend) {
        //     echo json_encode($friend->profile);
        // }
    
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
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
