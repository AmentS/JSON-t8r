<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use Illuminate\Http\Request;

class ContactUserController extends Controller
{

    public function index()
    {
        return User::all();

    }


    public function show(User $user)
    {
        return $user->projects;
    }

    /*public function show2(Request $request)
    {
        return Project::where('id', $request)->with('user')->get();
    }*/


}
