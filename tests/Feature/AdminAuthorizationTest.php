<?php

namespace Tests\Feature;

use App\Models\AuditLog;
use App\Models\Author;
use App\Models\Category;
use App\Models\ContactEnquiry;
use App\Models\Credential;
use App\Models\MediaAsset;
use App\Models\Page;
use App\Models\Post;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\SurveyRequest;
use App\Models\Tag;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class AdminAuthorizationTest extends TestCase
{
    use LazilyRefreshDatabase;

    /** @var array<class-string> */
    private array $contentModels = [
        Author::class,
        Category::class,
        Credential::class,
        MediaAsset::class,
        Page::class,
        Post::class,
        Project::class,
        ProjectCategory::class,
        Service::class,
        SiteSetting::class,
        Tag::class,
        TeamMember::class,
        Testimonial::class,
    ];

    public function test_content_editor_can_manage_content_but_not_enquiries_users_or_audits(): void
    {
        $user = User::factory()->contentEditor()->create();

        foreach ($this->contentModels as $model) {
            $this->assertTrue(Gate::forUser($user)->allows('viewAny', $model), $model);
        }

        $this->assertFalse(Gate::forUser($user)->allows('viewAny', ContactEnquiry::class));
        $this->assertFalse(Gate::forUser($user)->allows('viewAny', SurveyRequest::class));
        $this->assertFalse(Gate::forUser($user)->allows('viewAny', User::class));
        $this->assertFalse(Gate::forUser($user)->allows('viewAny', AuditLog::class));
    }

    public function test_enquiry_manager_can_process_submissions_but_cannot_create_or_delete_them(): void
    {
        $user = User::factory()->enquiryManager()->create();
        $contactEnquiry = new ContactEnquiry;
        $surveyRequest = new SurveyRequest;

        foreach ([ContactEnquiry::class, SurveyRequest::class] as $model) {
            $this->assertTrue(Gate::forUser($user)->allows('viewAny', $model));
            $this->assertFalse(Gate::forUser($user)->allows('create', $model));
        }

        $this->assertTrue(Gate::forUser($user)->allows('update', $contactEnquiry));
        $this->assertTrue(Gate::forUser($user)->allows('update', $surveyRequest));
        $this->assertFalse(Gate::forUser($user)->allows('delete', $contactEnquiry));
        $this->assertFalse(Gate::forUser($user)->allows('viewAny', Service::class));
    }

    public function test_super_administrator_can_manage_users_and_view_but_not_mutate_audit_logs(): void
    {
        $user = User::factory()->superAdmin()->create();
        $otherUser = User::factory()->create();
        $auditLog = new AuditLog;

        $this->assertTrue(Gate::forUser($user)->allows('viewAny', User::class));
        $this->assertTrue(Gate::forUser($user)->allows('create', User::class));
        $this->assertTrue(Gate::forUser($user)->allows('delete', $otherUser));
        $this->assertFalse(Gate::forUser($user)->allows('delete', $user));
        $this->assertTrue(Gate::forUser($user)->allows('viewAny', AuditLog::class));
        $this->assertFalse(Gate::forUser($user)->allows('create', AuditLog::class));
        $this->assertFalse(Gate::forUser($user)->allows('update', $auditLog));
        $this->assertFalse(Gate::forUser($user)->allows('delete', $auditLog));
    }

    public function test_site_settings_remain_a_single_record(): void
    {
        $user = User::factory()->contentEditor()->create();

        $this->assertTrue(Gate::forUser($user)->allows('create', SiteSetting::class));

        SiteSetting::query()->create(['company_name' => 'ATM Surveyors']);

        $this->assertFalse(Gate::forUser($user)->allows('create', SiteSetting::class));
    }
}
