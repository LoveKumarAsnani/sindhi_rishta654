<?php

use App\Mail\UserCreated;
use App\Models\Friends;
use App\Models\Profiles;
use App\Models\User;
use Facade\FlareClient\View;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Nette\Utils\Html;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/testing', function () {

   Mail::to('sagheerhzardari@gmail.com')->send(new UserCreated(new User));
});


Route::get('/friends/{id}', function ($id) {
   $user = User::find($id);
   $user->friends;
   $user->related_friends;

   $friends = $user->friends->merge($user->related_friends);
   return $friends;
});

// Route::get('/get_image_url', function(){
//    $user = User::find(1);
//    $image = $user->profile_picture;

//    //find path of the image in laravel storage
//    $path = Storage::disk('public')->getDriver()->getAdapter()->applyPathPrefix($image);
//    return $path;
// });

// //route for creating storage:link in serve with artisan command
// Route::get('/storage_link', function () {
//    Artisan::call('storage:link');
// });