<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Theme;
use Illuminate\Support\Facades\Auth;

class ThemeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $themes = Theme::when($search, function ($q) use ($search) {
            $q->where('name', 'like', "%$search%")
                ->orWhere('slug', 'like', "%$search%");
        })->latest()->paginate(6);

        return view('themes.index', compact('themes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:themes,slug|max:255',
            'primary_color' => 'required|string|max:7',
            'secondary_color' => 'required|string|max:7',
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

        if (Auth::check()) {
            Auth::user()->update(['theme_id' => $theme->id]);
        }

        return back()->with('success', 'Theme Switched Successfully');
    }

    public function destroy(Theme $theme)
    {
        $theme->delete();
        return back()->with('success', 'Theme Deleted Successfully');
    }
}