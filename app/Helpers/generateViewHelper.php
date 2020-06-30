<?php

namespace App\Helpers;

final class generateViewHelper
{
    public static function generatePostingModal($posting, $contentOnly)
    {
        $postingModal = view('components.postingModal')->with(compact('posting', 'contentOnly'));
        return $postingModal->render();
    }

    public static function generateConversationWindow($conversations, $currentThread = [])
    {
        $conversationWindow = view('messages.show')->with(compact('conversations', 'currentThread'));
        return $conversationWindow->render();
    }

    public static function generateNewConversationWindow($conversations, $receiver)
    {
        $conversationWindow = view('messages.create')->with(compact('conversations', 'receiver'));
        return $conversationWindow->render();
    }
}
