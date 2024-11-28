<?php

namespace App\Controllers;

use Core\Http\Controllers\Controller;
use Core\Http\Request;
use Lib\Authentication\Auth;
use Lib\FlashMessage;

class HomeController extends Controller
{
    protected ?\App\Models\User $current_user;

    public function __construct()
    {
        $this->current_user = $this->getCurrentUser();
    }

    public function getCurrentUser(): ?\App\Models\User
    {
        return Auth::user();
    }

    public function guestUser(Request $request): void
    {
        $title = 'Guest';
        $this->render('home/guest', compact('title'));
    }

    public function adminUser(Request $request): void
    {
        $title = 'Admin';
        $this->render('home/admin', compact('title'));
    }
}
