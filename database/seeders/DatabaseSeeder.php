<?php

namespace Database\Seeders;

use App\Enums\PublicationStatus;
use App\Models\Page;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        SiteSetting::query()->updateOrCreate([], [
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
            'trust_facts' => ['Field-led expertise', 'Clear professional reports', 'Coverage across Uganda'],
            'default_seo_title' => 'ATM Surveyors & Engineering Consultants',
            'default_seo_description' => 'Cadastral, engineering and topographic surveying, land valuation, GIS and environmental consultancy across Uganda.',
        ]);

        $serviceData = [
            ['Engineering Surveying', 'engineering-surveying', 'Setting out, as-built surveys and precise control for infrastructure and construction.', ['Construction setting-out', 'As-built verification', 'Control networks']],
            ['Topographic Surveying', 'topographic-surveying', 'Accurate terrain, feature and level data for confident planning and design.', ['Detail surveys', 'Contour mapping', 'Digital terrain models']],
            ['Cadastral Surveying', 'cadastral-surveying', 'Boundary identification, subdivision and land documentation handled with care.', ['Boundary opening', 'Subdivision surveys', 'Title survey support']],
            ['Land & Property Valuation', 'land-property-valuation', 'Evidence-led valuations for transactions, finance, insurance and planning.', ['Market valuations', 'Asset registers', 'Compensation assessments']],
            ['GIS & Remote Sensing', 'gis-remote-sensing', 'Spatial data, mapping and earth-observation insight for better decisions.', ['GIS databases', 'Satellite analysis', 'Thematic mapping']],
            ['Environmental Consultancy', 'environmental-consultancy', 'Practical environmental guidance integrated into project delivery.', ['Site assessments', 'Compliance support', 'Impact monitoring']],
        ];

        foreach ($serviceData as $index => $data) {
            Service::query()->updateOrCreate(['slug' => $data[1]], [
                'title' => $data[0],
                'eyebrow' => str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT),
                'summary' => $data[2],
                'description' => [$data[2], 'Every commission is planned around the site, the decision it must support and the standard of evidence the client requires.'],
                'deliverables' => $data[3],
                'applications' => ['Development planning', 'Due diligence', 'Project delivery'],
                'is_featured' => $index < 4,
                'sort_order' => $index + 1,
                'status' => PublicationStatus::Published,
                'published_at' => now(),
            ]);
        }

        Testimonial::query()->updateOrCreate(['client_name' => 'Development Project Manager'], [
            'organization' => 'Kampala property developer',
            'testimonial' => 'ATM gave us clear field information, practical advice and documentation our whole project team could rely on.',
            'project_type' => 'Engineering surveying',
            'is_featured' => true,
            'status' => PublicationStatus::Published,
            'published_at' => now(),
        ]);

        foreach (['privacy-policy' => 'Privacy Policy', 'terms-of-service' => 'Terms of Service'] as $slug => $title) {
            Page::query()->updateOrCreate(['slug' => $slug], [
                'title' => $title,
                'summary' => 'How ATM Surveyors & Engineering Consultants handles website use and submitted information.',
                'content' => ['We use information submitted through this website only to respond to enquiries, prepare survey services and meet our professional obligations.', 'Contact us if you would like to access, correct or remove personal information you have supplied.'],
                'status' => PublicationStatus::Published,
                'published_at' => now(),
            ]);
        }
    }
}
