<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ProjectController extends Controller
{
    private function checkAccess(Project $project)
    {
        abort_if(
            !$project->userCanAccess(Auth::user()),
            Response::HTTP_FORBIDDEN,
            'You cannot access this project'
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Auth::user()->projects;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string'
        ]);

        $project = Project::create($request->merge([
            'owner_id' => Auth::user()->id
        ])->all());

        Auth::user()->attachProject($project);

        return ['message' => 'Created successfully'];
        // return redirect('/home'); -
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Project $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $this->checkAccess($project);

        return $project;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Project $project
     * @return array|ResponseFactory|Response
     * @throws ValidationException
     */
    public function update(Request $request, Project $project)
    {
        $this->checkAccess($project);


        $this->validate($request, [
            'name' => 'required|string'
        ]);

        $project->update($request->all());

        return ['message' => 'Updated successfully'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Project $project
     * @return array|ResponseFactory|Response
     * @throws \Exception
     */
    public function destroy(Project $project)
    {
        if (!$project->isOwner(Auth::user()))
            abort(Response::HTTP_FORBIDDEN, 'You cannot manage this project');

        $project->delete();

        return ['message' => 'Deleted successfully'];
    }

    public function users(Project $project)
    {
        $this->checkAccess($project);

        return $project->users;
    }

    public function translations(Project $project)
    {
        $this->checkAccess($project);

        return $project->translations;
    }
}
