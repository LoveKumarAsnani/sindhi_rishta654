<?php

namespace App\Providers;

use App\Mail\UserCreated;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::created(function ($user) {
            try {
                Mail::to($user)->send(new UserCreated($user));
            } catch (Exception $e) {
            }
        });
    }
}
