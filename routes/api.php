<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Favorite\FavoriteController;
use App\Models\Friends;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Friend\FriendController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Models\Profiles;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/logout', [AuthController::class,'logout']);
    Route::get('/users',[UserController::class,'index']);


    Route::post('/send-friend-request',[FriendController::class,'store']);
    Route::delete('/unsend-friend-request',[FriendController::class,'destroy']);
    Route::get('/friends', [FriendController::class,'index']);
    Route::get('/friend/{user_id}', [FriendController::class,'show']);


    Route::post('/send-favorite-request',[FavoriteController::class,'store']);
    Route::delete('/unsend-favorite-request',[FavoriteController::class,'destroy']);
    Route::get('/favorites', [FavoriteController::class,'index']);

    
    Route::post('/edit-profile',[ProfileController::class,'update']);
    Route::get('/profile',[ProfileController::class,'show']);


});

// Route::post('/login', function(Request $request){
    
//     $user = User::where("email" , $request->email)->get();

//     if(Hash::check($request->password, $user[0]->password)){
//         $token = $user[0]->createToken($user[0]->email);
//         echo json_encode($token->plainTextToken);
//     }else{
//         echo "pass wrong";
//     }
// });
// Route::post('/signup', function(Request $request){
    
//     $user = new User();

//     $user->name = $request->name;
//     $user->email = $request->email;
//     $user->password = Hash::make($request->password);
//     $user->save();

//     // if(Hash::check($request->password, $user[0]->password)){
//         $token = $user->createToken($user->email);
//         echo json_encode($token->plainTextToken);
//     // }else{
//         // echo "pass wrong";
//     // }
// });
// Route::post('/logout', function(Request $request){
    
//     $user = new User();

//     $user->name = $request->name;
//     $user->email = $request->email;
//     $user->password = Hash::make($request->password);
//     $user->save();


//     // if(Hash::check($request->password, $user[0]->password)){
//         $token = $user->createToken($user->email);
//         echo json_encode($token->plainTextToken);
//     // }else{
//         // echo "pass wrong";
//     // }
// });
