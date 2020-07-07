<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

final class commonHelpers
{
    public static function isAdmin($model) {
        return $model->admin_id == Auth::id();
    }
}
