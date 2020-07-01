<?php

namespace App\Helpers;

final class generateViewHelper
{
    public static function generatePostingModal($posting, $contentOnly)
    {
        $postingModal = view('components.postingModal')->with(compact('posting', 'contentOnly'));
        return $postingModal->render();
    }

    public static function generateConversationWindow($currentThread = [])
    {
        $conversationWindow = view('messages.show')->with(compact('currentThread'));
        return $conversationWindow->render();
    }

    public static function generateNewConversationWindow($receiver)
    {
        $conversationWindow = view('messages.show')->with(compact('receiver'));
        return $conversationWindow->render();
    }
}
