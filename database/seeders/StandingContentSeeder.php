<?php

namespace Database\Seeders;

use App\Enums\PublicationStatus;
use App\Models\Author;
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
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class StandingContentSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $publishedAt = Carbon::parse('2026-09-01 08:00:00');

        $this->seedSiteSettings();
        $services = $this->seedServices($publishedAt);
        $this->seedProjects($services, $publishedAt);
        $this->seedInsights($publishedAt);
        $this->seedPeopleAndTrust($publishedAt);
        $this->seedLegalPages($publishedAt);
    }

    private function seedSiteSettings(): void
    {
        SiteSetting::query()->firstOrCreate([], [
            'company_name' => 'ATM Surveyors & Engineering Consultants',
            'wordmark' => 'ATM',
            'tagline' => 'Equality for all',
            'company_description' => 'Professional surveying, valuation, GIS and engineering consultancy grounded in accuracy, integrity and practical field experience.',
            'phone' => '+256 779 269 784',
            'whatsapp' => '+256 703 063 147',
            'email' => 'info@atmconsultants.ug',
            'enquiry_email' => 'info@atmconsultants.ug',
            'office_address' => 'Kampala, Uganda',
            'areas_served' => 'Kampala and projects across Uganda',
            'social_links' => [],
            'trust_facts' => ['Field-led expertise', 'Clear professional reports', 'Coverage across Uganda'],
            'default_seo_title' => 'ATM Surveyors & Engineering Consultants',
            'default_seo_description' => 'Cadastral, engineering and topographic surveying, land valuation, GIS and environmental consultancy across Uganda.',
        ]);
    }

    /** @return Collection<string, Service> */
    private function seedServices(Carbon $publishedAt): Collection
    {
        $services = collect();
        $serviceData = [
            [
                'title' => 'Engineering Surveying',
                'slug' => 'engineering-surveying',
                'summary' => 'Setting out, as-built surveys and precise control for infrastructure and construction.',
                'deliverables' => ['Construction setting-out', 'As-built verification', 'Control networks'],
            ],
            [
                'title' => 'Topographic Surveying',
                'slug' => 'topographic-surveying',
                'summary' => 'Accurate terrain, feature and level data for confident planning and design.',
                'deliverables' => ['Detail surveys', 'Contour mapping', 'Digital terrain models'],
            ],
            [
                'title' => 'Cadastral Surveying',
                'slug' => 'cadastral-surveying',
                'summary' => 'Boundary identification, subdivision and land documentation handled with care.',
                'deliverables' => ['Boundary opening', 'Subdivision surveys', 'Title survey support'],
            ],
            [
                'title' => 'Land & Property Valuation',
                'slug' => 'land-property-valuation',
                'summary' => 'Evidence-led valuations for transactions, finance, insurance and planning.',
                'deliverables' => ['Market valuations', 'Asset registers', 'Compensation assessments'],
            ],
            [
                'title' => 'GIS & Remote Sensing',
                'slug' => 'gis-remote-sensing',
                'summary' => 'Spatial data, mapping and earth-observation insight for better decisions.',
                'deliverables' => ['GIS databases', 'Satellite analysis', 'Thematic mapping'],
            ],
            [
                'title' => 'Environmental Consultancy',
                'slug' => 'environmental-consultancy',
                'summary' => 'Practical environmental guidance integrated into project delivery.',
                'deliverables' => ['Site assessments', 'Compliance support', 'Impact monitoring'],
            ],
        ];

        foreach ($serviceData as $index => $attributes) {
            $service = Service::query()->withTrashed()->firstOrCreate(
                ['slug' => $attributes['slug']],
                [
                    'title' => $attributes['title'],
                    'eyebrow' => str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT),
                    'summary' => $attributes['summary'],
                    'description' => [
                        $attributes['summary'],
                        'Every commission is planned around the site, the decision it must support and the standard of evidence the client requires.',
                    ],
                    'deliverables' => $attributes['deliverables'],
                    'applications' => ['Development planning', 'Due diligence', 'Project delivery'],
                    'is_featured' => $index < 4,
                    'sort_order' => $index + 1,
                    'status' => PublicationStatus::Published,
                    'published_at' => $publishedAt,
                    'seo_title' => $attributes['title'].' | ATM Surveyors Uganda',
                    'seo_description' => $attributes['summary'],
                ],
            );

            $services->put($attributes['slug'], $service);
        }

        return $services;
    }

    /** @param Collection<string, Service> $services */
    private function seedProjects(Collection $services, Carbon $publishedAt): void
    {
        $categoryData = [
            ['Land & Boundary Surveys', 'land-boundary-surveys', 'Cadastral, boundary, subdivision and land documentation work.'],
            ['Engineering & Construction', 'engineering-construction', 'Survey support for buildings, roads and infrastructure delivery.'],
            ['Property Advisory', 'property-advisory', 'Land and property valuation and due-diligence assignments.'],
            ['GIS & Environment', 'gis-environment', 'Spatial analysis, remote sensing and environmental consultancy.'],
        ];

        foreach ($categoryData as $index => [$name, $slug, $description]) {
            ProjectCategory::query()->firstOrCreate(['slug' => $slug], [
                'name' => $name,
                'description' => $description,
                'sort_order' => $index + 1,
            ]);
        }

        $category = ProjectCategory::query()->where('slug', 'land-boundary-surveys')->firstOrFail();
        $project = Project::query()->withTrashed()->firstOrCreate(
            ['slug' => 'sample-boundary-re-establishment-wakiso'],
            [
                'project_category_id' => $category->getKey(),
                'title' => 'Boundary Re-establishment in Wakiso',
                'location' => 'Wakiso District, Uganda',
                'project_type' => 'Cadastral survey',
                'client_sector' => 'Private landowner',
                'overview' => 'A sample project showing how ATM documents the scope, field approach and practical outcome of a completed boundary assignment.',
                'services_provided' => ['Records review', 'Boundary field survey', 'Client briefing'],
                'outcomes' => ['Boundary evidence documented', 'Clear next steps provided to the client'],
                'project_date' => '2026-08-15',
                'is_featured' => true,
                'sort_order' => 1,
                'status' => PublicationStatus::Draft,
                'published_at' => null,
                'is_sample' => true,
                'seo_index' => false,
            ],
        );

        $project->services()->syncWithoutDetaching([
            $services->get('cadastral-surveying')->getKey(),
            $services->get('topographic-surveying')->getKey(),
        ]);
    }

    private function seedInsights(Carbon $publishedAt): void
    {
        $author = Author::query()->firstOrCreate(['slug' => 'atm-technical-team'], [
            'name' => 'ATM Technical Team',
            'job_title' => 'Surveyors & Engineering Consultants',
            'biography' => 'Practical guidance from the ATM surveying, valuation, GIS and engineering consultancy team.',
        ]);

        $categoryData = [
            ['Surveying Advice', 'surveying-advice', 'Practical guidance for planning and understanding surveys.'],
            ['Land & Property', 'land-property', 'Insights about boundaries, titles, valuation and property decisions.'],
            ['Engineering & GIS', 'engineering-gis', 'Technical notes on construction surveying, GIS and spatial data.'],
        ];

        foreach ($categoryData as [$name, $slug, $description]) {
            Category::query()->firstOrCreate(['slug' => $slug], [
                'name' => $name,
                'description' => $description,
            ]);
        }

        $tags = collect([
            'boundary-surveys' => 'Boundary Surveys',
            'land-titles' => 'Land Titles',
            'construction' => 'Construction',
            'gis' => 'GIS',
            'valuation' => 'Valuation',
            'uganda' => 'Uganda',
        ])->map(fn (string $name, string $slug): Tag => Tag::query()->firstOrCreate(['slug' => $slug], ['name' => $name]));

        $category = Category::query()->where('slug', 'surveying-advice')->firstOrFail();
        $post = Post::query()->withTrashed()->firstOrCreate(
            ['slug' => 'what-to-prepare-before-a-boundary-survey'],
            [
                'author_id' => $author->getKey(),
                'category_id' => $category->getKey(),
                'title' => 'What to Prepare Before a Boundary Survey',
                'excerpt' => 'A simple checklist to help your surveyor understand the land, records and decision you need to make.',
                'content' => [
                    'Gather any title copies, deed plans, previous survey records and sale agreements connected to the land.',
                    'Explain the exact decision the survey must support, such as construction, subdivision, a sale or a boundary discussion.',
                    'Share known access limitations and arrange for relevant neighbours or representatives to be available where appropriate.',
                    'This is sample editorial content. Review and adapt it before relying on it as professional advice.',
                ],
                'reading_time' => 3,
                'is_featured' => true,
                'status' => PublicationStatus::Draft,
                'published_at' => null,
                'is_sample' => true,
                'seo_index' => false,
            ],
        );

        $post->tags()->syncWithoutDetaching([
            $tags->get('boundary-surveys')->getKey(),
            $tags->get('land-titles')->getKey(),
            $tags->get('uganda')->getKey(),
        ]);
    }

    private function seedPeopleAndTrust(Carbon $publishedAt): void
    {
        TeamMember::query()->withTrashed()->firstOrCreate(['slug' => 'atm-surveying-team'], [
            'name' => 'ATM Surveying Team',
            'job_title' => 'Surveyors & Engineering Consultants',
            'qualifications' => ['Update this record with the team’s verified qualifications'],
            'areas_of_expertise' => ['Cadastral surveying', 'Engineering surveying', 'GIS and valuation'],
            'biography' => 'This sample team profile can be replaced with individual professional profiles from the admin area.',
            'is_featured' => true,
            'sort_order' => 1,
            'status' => PublicationStatus::Draft,
            'published_at' => null,
            'is_sample' => true,
        ]);

        Testimonial::query()->withTrashed()->firstOrCreate(['client_name' => 'Development Project Manager'], [
            'organization' => 'Kampala property developer',
            'testimonial' => 'ATM gave us clear field information, practical advice and documentation our whole project team could rely on.',
            'project_type' => 'Engineering surveying',
            'is_featured' => true,
            'sort_order' => 1,
            'status' => PublicationStatus::Draft,
            'published_at' => null,
        ]);
    }

    private function seedLegalPages(Carbon $publishedAt): void
    {
        $pageData = [
            'privacy-policy' => 'Privacy Policy',
            'terms-of-service' => 'Terms of Service',
        ];

        foreach ($pageData as $slug => $title) {
            Page::query()->withTrashed()->firstOrCreate(['slug' => $slug], [
                'title' => $title,
                'summary' => 'How ATM Surveyors & Engineering Consultants handles website use and submitted information.',
                'content' => [
                    'We use information submitted through this website only to respond to enquiries, prepare survey services and meet our professional obligations.',
                    'Contact us if you would like to access, correct or remove personal information you have supplied.',
                    'This starter text must be reviewed for the company’s actual legal and regulatory requirements before launch.',
                ],
                'status' => PublicationStatus::Draft,
                'published_at' => null,
                'is_sample' => true,
                'seo_index' => false,
            ]);
        }
    }
}
