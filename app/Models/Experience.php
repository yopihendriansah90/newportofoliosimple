<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = ['position', 'company', 'location', 'started_at', 'ended_at', 'is_current', 'description', 'sort_order', 'is_active'];

    protected function casts(): array
    {
        return ['started_at' => 'date', 'ended_at' => 'date', 'is_current' => 'boolean', 'is_active' => 'boolean'];
    }
}
