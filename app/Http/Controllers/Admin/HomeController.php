<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard()
    {
        $users = User::has('profile')->count();
        //unverified users
        $unverifiedUsers = User::where('status', '0')->has('profile')->count();
        //verified users
        $verifiedUsers = User::where('status', '1')->has('profile')->count();
        //block users
        $blockedUsers = User::where('status', '2')->has('profile')->count();
        return view('dashboard', compact('users', 'unverifiedUsers', 'verifiedUsers', 'blockedUsers'));
    }
}
