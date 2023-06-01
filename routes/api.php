<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactUs\ContactUsController;
use App\Http\Controllers\Favorite\FavoriteController;
use App\Models\Friends;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Friend\FriendController;
use App\Http\Controllers\Picture\PictureController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Videos\VideosController;
use App\Models\ContactUs;
use App\Models\Pictures;
use App\Models\Profiles;
use Illuminate\Support\Facades\Artisan;

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

Route::get('/clear', function () {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('route:cache');

    return "Cleared!";
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::name('verify')->get('users/verify/{token}', [AuthController::class, 'verify']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);
Route::post('submit-query', [ContactUsController::class, 'store']);
Route::get('videos', [VideosController::class, 'index']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/change-password', [AuthController::class, 'changePassword']);

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/upload-profile-picture', [PictureController::class, 'uploadProfilePicture']);
    Route::post('/edit-user', [UserController::class, 'edit']);
    Route::get('/user-info', [UserController::class, 'show']);
    Route::get('/user-delete', [UserController::class, 'deleteUser']);


    Route::post('/send-friend-request', [FriendController::class, 'store']);
    Route::post('/unsend-friend-request', [FriendController::class, 'destroy']);
    Route::get('/friend-requests', [FriendController::class, 'index']);
    Route::get('/my-requests', [FriendController::class, 'myRequests']);
    Route::get('/friends', [FriendController::class, 'friends']);
    // Route::get('/friend/{user_id}', [FriendController::class, 'show']);
    Route::post('/accept-friend-request', [FriendController::class, 'acceptFriendRequest']);
    Route::post('/denied-friend-request', [FriendController::class, 'deniedFriendRequest']);
    Route::post('/remove-friend', [FriendController::class, 'removeFriend']);


    Route::post('/send-favorite-request', [FavoriteController::class, 'store']);
    Route::post('/unsend-favorite-request', [FavoriteController::class, 'destroy']);
    Route::get('/favorites', [FavoriteController::class, 'index']);


    Route::post('/edit-profile', [ProfileController::class, 'update']);
    Route::get('/profile', [ProfileController::class, 'show']);

    Route::post('/add-pictures', [PictureController::class, 'store']);
    Route::post('/delete-picture', [PictureController::class, 'destroy']);
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