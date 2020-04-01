<?php

namespace App\Http\Controllers;

use App\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Language[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Language::all();
    }
}
