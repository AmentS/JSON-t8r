<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProjectUserController extends Controller
{
    private function checkAccess(Project $project)
    {
        abort_if(
            !$project->userCanAccess(Auth::user()),
            Response::HTTP_FORBIDDEN,
            'You cannot access this project'
        );
    }

    public function index(Project $project)
    {
        $this->checkAccess($project);

        return $project->users;
    }

    public function store(Project $project, Request $request)
    {
        $this->checkAccess($project);

        $this->validate($request, [
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user)
            return response(['message' => 'User does not exist'], 404);

        if ($user->isOnProject($project))
            return response(['message' => 'User is already on project'], 409);

        $user->attachProject($project);

        return ['message' => 'success'];
    }
}
