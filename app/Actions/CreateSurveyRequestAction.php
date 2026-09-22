<?php

namespace App\Actions;

use App\Models\SurveyRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateSurveyRequestAction
{
    /**
     * @param  array<string, mixed>  $data
     * @param  array<int, UploadedFile>  $attachments
     */
    public function handle(array $data, array $attachments = []): SurveyRequest
    {
        return DB::transaction(function () use ($data, $attachments): SurveyRequest {
            $surveyRequest = SurveyRequest::create([
                ...Arr::except($data, ['attachments']),
                'reference' => $this->uniqueReference(),
            ]);

            foreach ($attachments as $attachment) {
                $path = $attachment->store('survey-requests/'.$surveyRequest->reference, 'private');

                $surveyRequest->attachments()->create([
                    'disk' => 'private',
                    'path' => $path,
                    'original_name' => $attachment->getClientOriginalName(),
                    'mime_type' => $attachment->getMimeType() ?: 'application/octet-stream',
                    'size_bytes' => $attachment->getSize(),
                ]);
            }

            return $surveyRequest->load('attachments');
        });
    }

    private function uniqueReference(): string
    {
        do {
            $reference = 'ATM-'.now()->format('ymd').'-'.Str::upper(Str::random(6));
        } while (SurveyRequest::query()->where('reference', $reference)->exists());

        return $reference;
    }
}
