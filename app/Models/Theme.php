<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return session('theme') === $this->slug;
    }
}