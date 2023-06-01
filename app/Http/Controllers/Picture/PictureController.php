<?php

namespace App\Http\Controllers\Picture;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Pictures;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $count = Pictures::where('user_id', '=', auth()->user()->id)->count();

        if ($count <= 4) {

            $pictures = $request->pictures;
            $picturesArray = json_decode($pictures, true);


            foreach ($picturesArray as $key => $picture) {
                $tempName = time() . $picture['filename'];
                $response = file_put_contents('pictures/' . $tempName, base64_decode($picture['file']));

                $record = Pictures::create([
                    'user_id' => auth()->user()->id,
                    'image_name' => $tempName
                ]);
            }

            // if ($record) {
            return  $this->successResponse('Pictures Uploaded Successfully', 200);
            // } else {
            //     return  $this->errorResponse('Something Went Wrong', 400);
            // }
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
        $image_path = public_path("\pictures\\") . $picture->image_name;
        $picture->delete();

        if (File::exists($image_path)) {
            File::delete($image_path);;
        }

        if ($picture) {
            return $this->successResponse('Picture Deleted Successfully', 200);
        } else {
            return $this->errorResponse('Could not find', 400);
        }
    }
}