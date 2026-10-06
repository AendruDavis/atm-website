<?php

namespace Tests\Feature\Database;

use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Tag;
use App\Models\TeamMember;
use App\Models\Testimonial;
use Database\Seeders\StandingContentSeeder;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class StandingContentSeederTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_standing_content_is_created_for_an_empty_admin(): void
    {
        $this->seed(StandingContentSeeder::class);

        $this->assertSame(1, SiteSetting::query()->count());
        $this->assertSame(6, Service::query()->count());
        $this->assertSame(4, ProjectCategory::query()->count());
        $this->assertSame(1, Project::query()->count());
        $this->assertSame(3, Category::query()->count());
        $this->assertSame(6, Tag::query()->count());
        $this->assertSame(1, Post::query()->count());
        $this->assertSame(1, TeamMember::query()->count());
        $this->assertSame(1, Testimonial::query()->count());
        $this->assertSame(2, Page::query()->count());

        $this->assertDatabaseHas('projects', [
            'slug' => 'sample-boundary-re-establishment-wakiso',
            'is_sample' => true,
        ]);
        $this->assertDatabaseHas('posts', [
            'slug' => 'what-to-prepare-before-a-boundary-survey',
            'is_sample' => true,
        ]);
    }

    public function test_rerunning_standing_content_does_not_overwrite_admin_edits(): void
    {
        $this->seed(StandingContentSeeder::class);
        Service::query()->where('slug', 'cadastral-surveying')->update([
            'summary' => 'An administrator edited this service description.',
        ]);
        SiteSetting::query()->sole()->update([
            'tagline' => 'An administrator edited this tagline.',
        ]);

        $this->seed(StandingContentSeeder::class);

        $this->assertSame(
            'An administrator edited this service description.',
            Service::query()->where('slug', 'cadastral-surveying')->value('summary'),
        );
        $this->assertSame('An administrator edited this tagline.', SiteSetting::query()->value('tagline'));
        $this->assertSame(6, Service::query()->count());
        $this->assertSame(1, SiteSetting::query()->count());
    }
}
