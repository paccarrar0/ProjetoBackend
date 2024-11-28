<?php

namespace App\Controllers;

use Core\Http\Controllers\Controller;
use Core\Http\Request;
use Lib\Authentication\Auth;
use Lib\FlashMessage;

class HomeController extends Controller
{

    protected $current_user;

    public function __construct()
    {
        $this->current_user = $this->getCurrentUser();
    }

    protected function getCurrentUser()
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
