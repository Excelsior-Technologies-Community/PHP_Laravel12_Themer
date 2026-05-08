<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Theme;

class ThemeController extends Controller
{
    public function index(Request $request)
    {
        if (!session()->has('theme')) {
            session(['theme' => 'light']);
        }

        $search = $request->search;

        $themes = Theme::when($search, function ($q) use ($search) {
            $q->where('name', 'like', "%$search%")
                ->orWhere('slug', 'like', "%$search%");
        })->latest()->paginate(4);

        return view('themes.index', compact('themes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:themes,slug',
        ]);

        Theme::create($request->all());

        return back()->with('success', 'Theme Created Successfully');
    }

    public function switch(Request $request)
    {
        $theme = Theme::findOrFail($request->theme_id);

        session([
            'theme' => $theme->slug,
            'primary_color' => $theme->primary_color,
            'secondary_color' => $theme->secondary_color,
        ]);

        return back()->with('success', 'Theme Switched Successfully');
    }

    public function destroy(Theme $theme)
    {
        $theme->delete();

        return back()->with('success', 'Theme Deleted Successfully');
    }
}