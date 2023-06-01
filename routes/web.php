<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\UserController as UserUserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
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
Route::get('/privacy-policy', function () {
    return view('privacy-policy');
});

Route::group(['prefix' => 'admin', 'middleware' => ['admin-auth']], function () {

    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/', [HomeController::class, 'dashboard']);

    Route::get('users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('users/{id}', [UserController::class, 'show'])->name('admin.users.show');
    Route::get('users/delete/{id}', [UserController::class, 'destroy'])->name('admin.users.delete');
    Route::post('users/change-status', [UserController::class, 'changeStatus'])->name('admin.users.status-change');
});

require __DIR__ . '/auth.php';
