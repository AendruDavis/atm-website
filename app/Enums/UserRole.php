<?php

namespace App\Enums;

enum UserRole: string
{
    case SuperAdmin = 'super_admin';
    case ContentEditor = 'content_editor';
    case EnquiryManager = 'enquiry_manager';

    public function label(): string
    {
        return match ($this) {
            self::SuperAdmin => 'Super administrator',
            self::ContentEditor => 'Content editor',
            self::EnquiryManager => 'Enquiry manager',
        };
    }

    public function canManageContent(): bool
    {
        return in_array($this, [self::SuperAdmin, self::ContentEditor], true);
    }

    public function canManageEnquiries(): bool
    {
        return in_array($this, [self::SuperAdmin, self::EnquiryManager], true);
    }
}
