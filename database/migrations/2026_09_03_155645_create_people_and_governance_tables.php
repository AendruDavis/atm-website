<?php

use App\Enums\PublicationStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('team_members', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('photo_media_id')->nullable()->constrained('media_assets')->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('job_title');
            $table->json('qualifications')->nullable();
            $table->json('areas_of_expertise')->nullable();
            $table->text('biography')->nullable();
            $table->json('professional_memberships')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('status')->default(PublicationStatus::Draft->value);
            $table->timestamp('published_at')->nullable();
            $table->boolean('is_sample')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->index(['status', 'published_at']);
        });

        Schema::create('testimonials', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('photo_media_id')->nullable()->constrained('media_assets')->nullOnDelete();
            $table->string('client_name');
            $table->string('organization')->nullable();
            $table->string('position')->nullable();
            $table->text('testimonial');
            $table->string('project_type')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('status')->default(PublicationStatus::Draft->value);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['status', 'published_at']);
        });

        Schema::create('credentials', function (Blueprint $table): void {
            $table->id();
            $table->string('type');
            $table->string('title');
            $table->string('registration_number')->nullable();
            $table->string('issuing_body')->nullable();
            $table->text('insurance_information')->nullable();
            $table->boolean('is_verified')->default(false)->index();
            $table->foreignId('verified_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('verified_at')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('site_settings', function (Blueprint $table): void {
            $table->id();
            $table->string('company_name')->default('[Company Name]');
            $table->string('wordmark')->default('[Company Name]');
            $table->string('tagline')->default('Precision creates confidence.');
            $table->text('company_description')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('enquiry_email')->nullable();
            $table->text('office_address')->nullable();
            $table->text('areas_served')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->json('social_links')->nullable();
            $table->json('trust_facts')->nullable();
            $table->string('default_seo_title')->nullable();
            $table->text('default_seo_description')->nullable();
            $table->foreignId('default_social_media_id')->nullable()->constrained('media_assets')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('audit_logs', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('event')->index();
            $table->nullableMorphs('auditable');
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('site_settings');
        Schema::dropIfExists('credentials');
        Schema::dropIfExists('testimonials');
        Schema::dropIfExists('team_members');
    }
};
