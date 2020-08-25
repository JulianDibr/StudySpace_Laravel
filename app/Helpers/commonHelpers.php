<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

final class commonHelpers {
    public static function isAdmin($model) {
        return $model->admin_id == Auth::id();
    }

    public static function checkInvitationStatus($model) {
        $userExists = $model->users->contains(Auth::id());
        if ($userExists) {
            $user = $model->users()->where('user_id', Auth::id())->get()->first();
            return $user->pivot->status;
        }
        return -1;
    }
}
