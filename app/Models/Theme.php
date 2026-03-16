<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    // Fillable fields allow mass assignment
    protected $fillable = [
        'name',
        'slug',
        'primary_color',
        'secondary_color',
    ];

    /**
     * Optional: You can add helper methods here
     * Example: Check if this theme is active in session
     */
    public function isActive(): bool
    {
        return session('theme') === $this->slug;
    }
}