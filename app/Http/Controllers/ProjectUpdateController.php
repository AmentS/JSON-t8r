<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ProjectUpdateController extends Controller
{
    public function update(Request $request)
    {
        $id = request('id');
        $name = request('name');

        $project = Project::where('id', $id)->update(['name' => $name]);



        return ['message' => 'Updated successfully'];
    }
}
