<?php
namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait ApiResponser{
    protected function showOne(Model $model ,$code = 200 ,$message='Successful')
    {
        return response()->json([
            'data' => $model,
            'status' => true,
            'message' => $message,
        ], $code);
    }

    protected function showAll(Collection $collection ,$code =200)
    {
        return response()->json([
            'data' => $collection,
            'status' => true,
            'message' => 'Successful',
        ], $code);
    }

    protected function errorResponse($message ,$code)
    {
        return response()->json([
            'error' => $message,
            'status' => false,
        ],$code);
    }
    protected function successResponse($message ,$code)
    {
        return response()->json([
            'message' => $message,
            'status' => true,
        ],$code);
    }

    protected function showMessage($message ,$code =200)
    {
        return response()->json(['data'=>$message],$code);
    }


}