<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $table = 'educations';

    protected $fillable = ['institution', 'program', 'period', 'description', 'sort_order', 'is_active'];
}
