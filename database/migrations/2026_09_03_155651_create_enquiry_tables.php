<?php

use App\Enums\EnquiryStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_enquiries', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('organization')->nullable();
            $table->string('email');
            $table->string('telephone')->nullable();
            $table->string('project_type')->nullable();
            $table->string('location')->nullable();
            $table->foreignId('service_id')->nullable()->constrained('services')->nullOnDelete();
            $table->date('preferred_survey_date')->nullable();
            $table->text('project_description');
            $table->string('attachment_disk')->nullable();
            $table->string('attachment_path')->nullable();
            $table->string('attachment_original_name')->nullable();
            $table->string('status')->default(EnquiryStatus::Unread->value)->index();
            $table->text('internal_notes')->nullable();
            $table->timestamp('submitted_at')->useCurrent();
            $table->timestamps();
        });

        Schema::create('survey_requests', function (Blueprint $table): void {
            $table->id();
            $table->string('reference')->unique();
            $table->string('name');
            $table->string('organization')->nullable();
            $table->string('email');
            $table->string('telephone');
            $table->string('project_type');
            $table->text('location');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->foreignId('service_id')->nullable()->constrained('services')->nullOnDelete();
            $table->date('preferred_survey_date')->nullable();
            $table->text('project_description');
            $table->string('status')->default(EnquiryStatus::Unread->value)->index();
            $table->text('internal_notes')->nullable();
            $table->timestamp('submitted_at')->useCurrent();
            $table->timestamps();
        });

        Schema::create('survey_request_attachments', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('survey_request_id')->constrained()->cascadeOnDelete();
            $table->string('disk')->default('private');
            $table->string('path')->unique();
            $table->string('original_name');
            $table->string('mime_type');
            $table->unsignedBigInteger('size_bytes');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('survey_request_attachments');
        Schema::dropIfExists('survey_requests');
        Schema::dropIfExists('contact_enquiries');
    }
};
