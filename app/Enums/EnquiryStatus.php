<?php

namespace App\Enums;

enum EnquiryStatus: string
{
    case Unread = 'unread';
    case InProgress = 'in_progress';
    case Responded = 'responded';
    case Closed = 'closed';

    public function label(): string
    {
        return match ($this) {
            self::Unread => 'Unread',
            self::InProgress => 'In progress',
            self::Responded => 'Responded',
            self::Closed => 'Closed',
        };
    }
}
