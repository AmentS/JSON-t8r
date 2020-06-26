<?php

namespace App\Http\Controllers;

use App\Language;
use App\Project;
use App\Translation;
use Illuminate\Http\Request;

class TranslationController extends Controller
{
    /**
     * @param Project $project
     * @return mixed
     */
    public function index(Project $project)
    {
        return $project->translations()->with('language')->get();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\HasMany|object|null
     */
    public function show(Request $request)
    {
        return Translation::query()
            ->where('language_id', Language::whereCode($request->language_code)->firstOrFail()->id)
            ->where('project_id', Project::findOrFail($request->project_id)->id)
            ->where('filename', $request->filename)
            ->get();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Relations\HasMany|object|null
     * @throws \Illuminate\Validation\ValidationException
     */
    public function storeOrUpdate(Request $request)
    {
        $this->validate($request, [
            'data' => 'required|json',
            'project_id' => 'required|integer|exists:projects,id',
            'language_code' => 'required|string|exists:languages,code',
            'filename' => 'required|string'
        ]);

        $languageId = Language::where('code', $request->language_code)->firstOrFail()->id;

        $translation = Translation::where('project_id', $request->project_id)
            ->where('language_id', $languageId)
            ->where('filename', $request->filename)
            ->first();

        if ($translation)
            $translation->update($request->except('language_code'));
        else
            return Translation::create($request->merge([
                'language_id' => $languageId,
            ])->except('language_code'));

        return $translation;
    }

    /**
     * @param Request $request
     * @return bool|mixed|null
     * @throws \Exception
     */
    public function destroy(Request $request)
    {
        $translation = Translation::where('project_id', $request->project_id)
            ->where('language_id', Language::where('code', $request->language_code)->firstOrFail()->id)
            ->where('filename', $request->filename)
            ->firstOrFail();

        if ($translation->delete())
            return response()->json(['message' => 'Deleted successfully']);
    }
}
