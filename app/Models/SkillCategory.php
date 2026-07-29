<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SkillCategory extends Model
{
    protected $fillable = ['name', 'slug', 'sort_order', 'is_active'];

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'skill_category_skill')
            ->withPivot('sort_order')
            ->orderByPivot('sort_order');
    }
}
