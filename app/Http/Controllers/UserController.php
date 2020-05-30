<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        return User::with('projects')->get();
    }

    public function show(User $user)
    {
        return $user->load('projects');
    }
}
