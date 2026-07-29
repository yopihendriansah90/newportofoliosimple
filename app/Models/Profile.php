<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['name', 'headline', 'bio', 'location', 'email', 'phone', 'photo_path', 'cv_path', 'is_available'];

    protected function casts(): array
    {
        return ['is_available' => 'boolean'];
    }
}
