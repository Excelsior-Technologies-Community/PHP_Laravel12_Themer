<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Theme;
use Illuminate\Support\Facades\Session;

class ThemeController extends Controller
{
    public function index()
    {
        $themes = Theme::all();
       return view('themes', compact('themes'));
    }

    public function switch(Request $request)
    {
        $theme = Theme::findOrFail($request->theme_id);
        Session::put('theme', $theme->slug);
        return redirect()->back();
    }
}