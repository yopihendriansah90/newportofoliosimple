<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Skill extends Model
{
    protected $fillable = ['skill_category_id', 'name', 'sort_order', 'is_active'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(SkillCategory::class, 'skill_category_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(SkillCategory::class, 'skill_category_skill')
            ->withPivot('sort_order')
            ->orderByPivot('sort_order');
    }
}
