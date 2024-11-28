<?php

namespace App\Middleware;

use Core\Http\Middleware\Middleware;
use Core\Http\Request;
use Lib\Authentication\Auth;
use Lib\FlashMessage;

class AdminAuthenticate implements Middleware
{
    public function handle(Request $request): void
    {
        $user = Auth::user();
        if ($user === null || !$user->isAdmin()) {
            FlashMessage::danger('You don\'t have permission to access this page');
            $this->redirectTo(route('users.login'));
        }
    }

    private function redirectTo(string $location): void
    {
        header('Location: ' . $location);
        exit;
    }
}
