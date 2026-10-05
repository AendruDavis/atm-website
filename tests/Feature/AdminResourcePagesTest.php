<?php

namespace Tests\Feature;

use App\Models\ContactEnquiry;
use App\Models\SurveyRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Tests\TestCase;

class AdminResourcePagesTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_super_administrator_can_render_every_resource_index(): void
    {
        $this->actingAs(User::factory()->superAdmin()->create());

        $resourceNames = [
            'audit-logs',
            'authors',
            'categories',
            'contact-enquiries',
            'credentials',
            'media-assets',
            'pages',
            'posts',
            'project-categories',
            'projects',
            'services',
            'site-settings',
            'survey-requests',
            'tags',
            'team-members',
            'testimonials',
            'users',
        ];

        foreach ($resourceNames as $resourceName) {
            $this->get(route('filament.admin.resources.'.$resourceName.'.index'))->assertOk();
        }
    }

    public function test_super_administrator_can_render_every_create_form(): void
    {
        $this->actingAs(User::factory()->superAdmin()->create());

        $resourceNames = [
            'authors',
            'categories',
            'credentials',
            'media-assets',
            'pages',
            'posts',
            'project-categories',
            'projects',
            'services',
            'site-settings',
            'tags',
            'team-members',
            'testimonials',
            'users',
        ];

        foreach ($resourceNames as $resourceName) {
            $this->get(route('filament.admin.resources.'.$resourceName.'.create'))->assertOk();
        }
    }

    public function test_enquiry_manager_can_render_submission_workflow_forms(): void
    {
        $this->actingAs(User::factory()->enquiryManager()->create());

        $contactEnquiry = ContactEnquiry::query()->create([
            'name' => 'Jane Client',
            'email' => 'jane@example.com',
            'project_description' => 'Boundary survey request.',
        ]);
        $surveyRequest = SurveyRequest::query()->create([
            'reference' => 'ATM-TEST-001',
            'name' => 'John Client',
            'email' => 'john@example.com',
            'telephone' => '+256700000001',
            'project_type' => 'Subdivision',
            'location' => 'Wakiso',
            'project_description' => 'Subdivision survey request.',
        ]);

        $this->get(route('filament.admin.resources.contact-enquiries.edit', $contactEnquiry))->assertOk();
        $this->get(route('filament.admin.resources.survey-requests.edit', $surveyRequest))->assertOk();
    }
}
