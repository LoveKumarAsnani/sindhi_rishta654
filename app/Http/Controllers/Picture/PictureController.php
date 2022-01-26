<?php

namespace App\Http\Controllers\Picture;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Pictures;
use App\Models\User;
use Illuminate\Http\Request;

class PictureController extends ApiController
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

    public function uploadProfilePicture(Request $request,)
    {

        $id = auth()->user()->id;
        $user = User::findOrFail($id);

        $picture = $request->picture;
        $pictureDecode = json_decode($picture, true);

        $response = file_put_contents('pictures/' . $pictureDecode['filename'], base64_decode($pictureDecode['file']));

        if ($response) {
            $record = $user->profile_picture = $pictureDecode['filename'];
            $user->save();
        }

        if ($record) {
            return  $this->successResponse('Pictures Uploaded Successfully', 200);
        } else {
            return  $this->errorResponse('Something Went Wrong', 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $count = Pictures::where('user_id', '=', auth()->user()->id)->count();

        if ($count >= 4) {

            $pictures = $request->pictures;
            $picturesArray = json_decode($pictures, true);


            foreach ($picturesArray as $key => $picture) {
                $response = file_put_contents('pictures/' . $picture['filename'], base64_decode($picture['file']));

                $record = Pictures::create([
                    'user_id' => auth()->user()->id,
                    'image_name' => $picture['filename'],
                ]);
            }

            if ($record) {
                return  $this->successResponse('Pictures Uploaded Successfully', 200);
            } else {
                return  $this->errorResponse('Something Went Wrong', 400);
            }
        } else {
            return  $this->errorResponse('You Cannot add more than four images.', 400);
        }


        //$response = file_put_contents($uploadPath,base64_decode($request['images']));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pictures  $pictures
     * @return \Illuminate\Http\Response
     */
    public function show(Pictures $pictures)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pictures  $pictures
     * @return \Illuminate\Http\Response
     */
    public function edit(Pictures $pictures)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pictures  $pictures
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pictures $pictures)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pictures  $pictures
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $picture = Pictures::findOrFail($request->id);
        $picture->delete();

        if ($picture) {
            return $this->successResponse('Picture Deleted Successfully', 200);
        } else {
            return $this->errorResponse('Could not find', 400);
        }
    }
}
