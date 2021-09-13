<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Profiles;
use Illuminate\Http\Request;

class ProfileController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Profiles  $profiles
     * @return \Illuminate\Http\Response
     */
    public function show(Profiles $profiles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profiles  $profiles
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profiles  $profiles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $profile = Profiles::Where([
            'user_id' => auth()->user()->id,
        ])->first();

       // print(auth()->user()->id);
        //return response($profile);
        

        if($request -> has('surname')){
            $profile->surname = $request->surname;
        }

        if($request -> has('caste')){
            $profile->caste = $request->caste;
        }

        if($request -> has('date_of_birth')){
            $profile->date_of_birth = $request->date_of_birth;
        }

        if($request -> has('alcholic')){
            $profile->alcholic = $request->alcholic;
        }

        if($request->has('weight')){
            $profile->weight =$request->weight;
        }

        if($request->has('height')){
            $profile->height =$request->height;
        }

        if($request->has('vegetarian')){
            $profile->vegetarian =$request->vegetarian;
        }

        if($request->has('state')){
            $profile->state =$request->state;
        }

        if($request->has('city')){
            $profile->city =$request->city;
        }

        if($request->has('home_town')){
            $profile->home_town =$request->home_town;
        }

        if($request->has('father_name')){
            $profile->father_name =$request->father_name;
        }

        if($request->has('father_occupation')){
            $profile->father_occupation =$request->father_occupation;
        }

        if($request->has('grand_father_name')){
            $profile->grand_father_name =$request->grand_father_name;
        }

        if($request->has('mother_name')){
            $profile->mother_name =$request->mother_name;
        }

        if($request->has('mother_occupation')){
            $profile->mother_occupation =$request->mother_occupation;
        }

        if($request->has('mother_from')){
            $profile->mother_from =$request->mother_from;
        }

        if($request->has('brothers')){
            $profile->brothers =$request->brothers;
        }

        if($request->has('sisters')){
            $profile->sisters =$request->sisters;
        }

        if($request->has('brothers_married')){
            $profile->brothers_married =$request->brothers_married;
        }

        if($request->has('sisters_married')){
            $profile->sisters_married =$request->sisters_married;
        }

        if($request->has('highest_education')){
            $profile->highest_education =$request->highest_education;
        }

        if($request->has('occupation')){
            $profile->occupation =$request->occupation;
        }

        if($request->has('highest_education')){
            $profile->highest_education =$request->highest_education;
        }

        if($request->has('salary')){
            $profile->salary =$request->salary;
        }

        if($request->has('highest_education')){
            $profile->highest_education =$request->highest_education;
        }


        if(!$profile->isDirty()){
            return $this->errorResponse('You Need to Specify Different Value to Update',422);
        }

        $profile->save();

        //return response()->json(['data'=> $user],200);
        return $this->showOne($profile);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profiles  $profiles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profiles $profiles)
    {
        //
    }
}
