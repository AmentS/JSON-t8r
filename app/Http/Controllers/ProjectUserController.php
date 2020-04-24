<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use Illuminate\Http\Request;

class ProjectUserController extends Controller
{
    public function addUsers(Request $request){

        $this->validate($request, [
            'email' => 'required|email',
            'id' => 'required'
        ]);



        $user = User::where('email', $request->email)->firstOrFail()->id;
        $project = Project::where('id', $request->id)->firstOrFail();
        $project->users()->attach($user);


        return ['message' => 'success'];
    }
}
