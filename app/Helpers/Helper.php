<?php

namespace App\Helpers;

class Helper
{
    public static function is_super_admin()
    {
        if (auth()->check() && auth()->user()->role == "superadmin"){
            return true;
        }
        return false;
    }
}