<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class AuditService
{
    public static function getValuesForInfolist(?Model $record, string $type = 'new'): array
    {
        $data = $record->new_values;

        if ($type === 'old') {
            $data = $record->old_values;
        }

        return $data;
    }
}
