<?php
namespace App\Helpers;

class DataHelper
{

    public static function clientTypes()
    {
        return [
            1 => 'Free-Trial',
            2 => 'Subscriber',
            3 => 'Enterprise',
            4 => 'Test'
        ];
    }

    public static function statusTypes()
    {
        return [
            1 => 'Posted',
            2 => 'Sent',
            3 => 'Fail'
        ];
    }

    public static function statusTypeColors()
    {
        return [
            1 => 'info',
            2 => 'success',
            3 => 'danger'
        ];
    }

    public static function getStatusTypeColor(int $statusTypeId)
    {
        return self::statusTypeColors()[$statusTypeId] ?? '';
    }

    public static function getStatusTypeId(string $status)
    {
        $statusTypes = array_map('strtolower', self::statusTypes());
        $statusTypes = array_flip($statusTypes);

        return $statusTypes[strtolower($status)] ?? '';
    }
}
