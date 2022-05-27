<?php
namespace App\Admin\Helpers;

use App\Admin\Models\Admin;

class AuthHelper
{
    public static function isAdminExist(string $email): bool
    {
        $admin = Admin::findFirst("email = '$email'");

        return !empty($admin);
    }
}
