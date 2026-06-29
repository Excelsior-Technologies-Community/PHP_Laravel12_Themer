<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'primary_color',
        'secondary_color',
    ];

    public function isActive(): bool
    {
        if (Auth::check() && Auth::user()->theme_id) {
            return Auth::user()->theme_id === $this->id;
        }

        return session('theme') === $this->slug;
    }
}