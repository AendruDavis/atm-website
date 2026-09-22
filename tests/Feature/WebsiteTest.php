<?php

namespace Tests\Feature;

use App\Models\ContactEnquiry;
use App\Models\SurveyRequest;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class WebsiteTest extends TestCase
{
    use LazilyRefreshDatabase;

    public function test_public_pages_render_successfully(): void
    {
        foreach (['/', '/about', '/services', '/projects', '/insights', '/contact', '/request-a-survey', '/sitemap.xml'] as $uri) {
            $this->get($uri)->assertOk();
        }
    }

    public function test_contact_enquiry_requires_contact_details_and_a_description(): void
    {
        $response = $this->post(route('contact.store'), []);

        $response->assertInvalid([
            'name' => 'The name field is required.',
            'email' => 'The email field is required.',
            'project_description' => 'The project description field is required.',
        ]);
        $this->assertSame(0, ContactEnquiry::query()->count());
    }

    public function test_a_valid_contact_enquiry_is_stored(): void
    {
        $response = $this->post(route('contact.store'), [
            'name' => 'Jane Client',
            'email' => 'jane@example.com',
            'telephone' => '+256700000000',
            'project_description' => 'I need a boundary survey for land in Mukono district.',
        ]);

        $response->assertRedirect(route('contact.create'));
        $response->assertSessionHas('status');
        $this->assertDatabaseHas('contact_enquiries', ['email' => 'jane@example.com']);
    }

    public function test_a_valid_survey_request_gets_a_reference(): void
    {
        Storage::fake('private');

        $response = $this->post(route('survey-requests.store'), [
            'name' => 'John Client',
            'email' => 'john@example.com',
            'telephone' => '+256711111111',
            'project_type' => 'Subdivision',
            'location' => 'Wakiso District',
            'project_description' => 'I need to subdivide a titled parcel into three plots.',
        ]);

        $surveyRequest = SurveyRequest::query()->sole();
        $response->assertRedirect(route('survey-requests.success', $surveyRequest));
        $this->assertStringStartsWith('ATM-', $surveyRequest->reference);
    }
}
