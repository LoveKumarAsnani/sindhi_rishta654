<?php

namespace App\Http\Controllers\Favorite;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Friends;
use App\Models\UserFavorites;
use Illuminate\Http\Request;

class FavoriteController extends ApiController
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
        return $this->showAll($friends);
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
       
        
        $friend = Friends::create([
            'user_id' => auth()->user()->id,
            'fav_user_id' => $request->friend_user_id,
        ]);

        return $this->showOne($friend,200,'Favorite Succeed');
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
        

        $friend = Friends::firstWhere([
            'user_id' => auth()->user()->id,
            'fav_user_id' => $request->friend_user_id,
        ])->delete();

        return $this->successResponse('Un Favorite',200);
    }
}
