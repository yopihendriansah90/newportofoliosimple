<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\SkillCategory;
use App\Models\SiteSetting;
use App\Models\SocialLink;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function __invoke(): View
    {
        $settings = SiteSetting::query()->pluck('value', 'key');

        return view('portfolio.index', [
            'profile' => Profile::query()->first(),
            'skillCategories' => SkillCategory::query()->where('is_active', true)->with(['skills' => fn ($query) => $query->where('is_active', true)->orderBy('sort_order')])->orderBy('sort_order')->get(),
            'experiences' => Experience::query()->where('is_active', true)->orderBy('sort_order')->orderByDesc('started_at')->get(),
            'projects' => Project::query()->where('is_active', true)->where('is_featured', true)->with(['technologies', 'media'])->orderBy('sort_order')->get(),
            'educations' => Education::query()->where('is_active', true)->orderBy('sort_order')->get(),
            'socialLinks' => SocialLink::query()->where('is_active', true)->orderBy('sort_order')->get(),
            'settings' => $settings,
        ]);
    }
}
