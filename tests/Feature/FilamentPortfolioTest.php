<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FilamentPortfolioTest extends TestCase
{
    use RefreshDatabase;

    public function test_portfolio_resources_are_available_to_authenticated_admin(): void
    {
        $this->seed();
        $this->actingAs(User::where('email', 'yopihendriansah90@gmail.com')->first());

        $this->get('/admin')->assertOk()->assertSee('/admin/profiles')->assertSee('Material+Symbols+Outlined');
        $this->get('/admin/profiles')->assertRedirect('/admin/profiles/1/edit');
        $this->get('/admin/profiles/1/edit')->assertOk();

        foreach (['skill-categories', 'skills', 'certifications', 'experiences', 'projects', 'education', 'social-links', 'site-settings'] as $resource) {
            $this->get('/admin/' . $resource)->assertOk();
        }
    }
}
