<?php

namespace Tests\Unit\Controllers;

use App\Controllers\HomeController;
use App\Models\User;

class HomeControllerTest extends ControllerTestCase
{
    public function test_guest_user(): void
    {
        $response = $this->get('guestUser', HomeController::class);

        $this->assertStringContainsString('guest', $response);
    }

    public function test_admin_user(): void
    {
        $response = $this->get('adminUser', HomeController::class);

        $this->assertStringContainsString('admin', $response);
    }

    public function test_current_user(): void
    {
        $response = $this->get('getCurrentUser', HomeController::class);

        $this->assertSame('', $response);
    }

    public function test_current_user_authenticated(): void
    {

        $data =  [
        'name' => 'Fulano',
        'email' => 'fulano@example.com',
        'role' => 'admin',
        'password' => '123456',
        'password_confirmation' => '123456'
        ];

        $user = new User($data);
        $user->save();



        if ($user->authenticate('123456')) {
            $response = $this->get('getCurrentUser', HomeController::class);

            $this->assertNotNull($response);
        }
    }
}
