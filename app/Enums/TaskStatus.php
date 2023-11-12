<?php

namespace App\Enums;

enum TaskStatus: string {
    case NEW  = 'New';
    case IN_PROGRESS = 'In Progress';
    case ABANDONED = 'Abandoned';
    case COMPLETED = 'Completed';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
    
}
