<?php
namespace App\Helpers;

final class generateViewHelper
{
    public static function generatePostingModal($posting, $contentOnly) {
        $postingModal = view('components.postingModal')->with(compact('posting', 'contentOnly'));
        return $postingModal->render();
    }
}
