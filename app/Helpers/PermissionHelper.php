<?php
namespace App\Helpers;

use App\Models\Users\User;

class PermissionHelper
{
    public static function isSuperAdmin(User $objUser)
    {
        return (bool) ($objUser->is_admin && config('common.superadmin_id') == $objUser->client_id);
    }

    public static function isClientAdmin(User $objUser)
    {
        return (bool) $objUser->is_admin;
    }
}
