<?php
namespace App\Helpers;

final class generateViewHelper
{
    public static function generatePostingModal($posting) {
        $postingModal = view('components.postingModal')->with('posting', $posting);
        return $postingModal->render();
    }
}
