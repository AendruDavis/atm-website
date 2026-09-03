<?php

use App\Enums\PublicationStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private function seoFields(Blueprint $table): void
    {
        $table->string('seo_title')->nullable();
        $table->text('seo_description')->nullable();
        $table->string('canonical_url')->nullable();
        $table->foreignId('social_media_id')->nullable()->constrained('media_assets')->nullOnDelete();
        $table->boolean('seo_index')->default(true);
        $table->boolean('seo_follow')->default(true);
    }

    private function publicationFields(Blueprint $table): void
    {
        $table->string('status')->default(PublicationStatus::Draft->value);
        $table->timestamp('published_at')->nullable();
        $table->boolean('is_sample')->default(false);
    }

    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table): void {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('eyebrow')->nullable();
            $table->text('summary')->nullable();
            $table->json('content')->nullable();
            $this->publicationFields($table);
            $this->seoFields($table);
            $table->timestamps();
            $table->softDeletes();
            $table->index(['status', 'published_at']);
        });

        Schema::create('services', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('image_media_id')->nullable()->constrained('media_assets')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('eyebrow')->nullable();
            $table->text('summary');
            $table->json('description')->nullable();
            $table->json('deliverables')->nullable();
            $table->json('applications')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $this->publicationFields($table);
            $this->seoFields($table);
            $table->timestamps();
            $table->softDeletes();
            $table->index(['status', 'published_at']);
        });

        Schema::create('project_categories', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('projects', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('project_category_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('featured_media_id')->nullable()->constrained('media_assets')->nullOnDelete();
            $table->foreignId('download_media_id')->nullable()->constrained('media_assets')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('location')->nullable();
            $table->string('project_type')->nullable();
            $table->string('client_sector')->nullable();
            $table->text('overview');
            $table->json('services_provided')->nullable();
            $table->json('outcomes')->nullable();
            $table->date('project_date')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $this->publicationFields($table);
            $this->seoFields($table);
            $table->timestamps();
            $table->softDeletes();
            $table->index(['status', 'published_at']);
        });

        Schema::create('project_service', function (Blueprint $table): void {
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->primary(['project_id', 'service_id']);
        });

        Schema::create('authors', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('photo_media_id')->nullable()->constrained('media_assets')->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('job_title')->nullable();
            $table->text('biography')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('tags', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('author_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('featured_media_id')->nullable()->constrained('media_assets')->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt');
            $table->json('content')->nullable();
            $table->unsignedSmallInteger('reading_time')->default(1);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_popular')->default(false);
            $table->unsignedInteger('popular_order')->default(0);
            $this->publicationFields($table);
            $this->seoFields($table);
            $table->timestamps();
            $table->softDeletes();
            $table->index(['status', 'published_at']);
            $table->index(['is_featured', 'published_at']);
        });

        Schema::create('post_tag', function (Blueprint $table): void {
            $table->foreignId('post_id')->constrained()->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained()->cascadeOnDelete();
            $table->primary(['post_id', 'tag_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('post_tag');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('authors');
        Schema::dropIfExists('project_service');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('project_categories');
        Schema::dropIfExists('services');
        Schema::dropIfExists('pages');
    }
};
