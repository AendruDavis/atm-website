<?php

namespace App\Actions;

use App\Models\ContactEnquiry;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

class CreateContactEnquiryAction
{
    /** @param array<string, mixed> $data */
    public function handle(array $data, ?UploadedFile $attachment = null): ContactEnquiry
    {
        $attributes = Arr::except($data, ['attachment']);

        if ($attachment !== null) {
            $attributes['attachment_disk'] = 'private';
            $attributes['attachment_path'] = $attachment->store('contact-enquiries', 'private');
            $attributes['attachment_original_name'] = $attachment->getClientOriginalName();
        }

        return ContactEnquiry::create($attributes);
    }
}
