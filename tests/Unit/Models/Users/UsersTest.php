<?php

namespace Tests\Unit\Models\Users;

use PHPUnit\Framework\TestCase;
use App\Models\User;

class UsersTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $data =  [
        'name' => 'TestAdmin',
        'email' => 'test@example.com',
        'role' => 'admin',
        'password' => '123456',
        'password_confirmation' => '123456'
        ];

        $this->user = new User($data);
        $this->user->save();
    }

    public function test_admin_role(): void
    {
        $user = new User();
        $user->role = 'admin';

        $this->assertTrue($user->isAdmin());
    }

    public function test_non_admin_role(): void
    {
        $user = new User();
        $user->role = 'user';

        $this->assertFalse($user->isAdmin());
    }

    public function test_validates_not_empty(): void
    {
        $user = new User();
        $user->name = '';
        $user->email = '';
        $user->validates();

        $this->assertContains('name cannot be empty!', $user->getErrors());
        $this->assertContains('email cannot be empty!', $user->getErrors());
    }

    public function test_validate_uniqueness(): void
    {
        $existingUser = new User();
        $existingUser->email = 'test@example.com';
        $existingUser->save();

        $user = new User();
        $user->email = 'test@example.com';
        $user->validates();

        $this->assertContains('email has already been taken!', $user->getErrors());
    }

    public function test_password_encryption(): void
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

        $this->assertNotEmpty($user->encrypted_password);
        $this->assertNotEquals('123456', $user->encrypted_password);
        $this->assertTrue(password_verify('123456', $user->encrypted_password));
    }

    public function test_authenticate_with_valid_password(): void
    {
        $user = new User();
        $user->encrypted_password = password_hash('secure_password', PASSWORD_DEFAULT);

        $this->assertTrue($user->authenticate('secure_password'));
    }

    public function test_authenticate_with_invalid_password(): void
    {
        $user = new User();
        $user->encrypted_password = password_hash('secure_password', PASSWORD_DEFAULT);

        $this->assertFalse($user->authenticate('wrong_password'));
    }

    public function test_set_password_triggers_encryption(): void
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

        $this->assertNotNull($user->encrypted_password);
        $this->assertTrue(password_verify('123456', $user->encrypted_password));
    }

    public function test_find_by_email_returns_user(): void
    {
        $email = 'test@example.com';

        $user = User::findByEmail($email);

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($email, $user->email);
    }

    public function test_find_by_email_returns_null(): void
    {
        $email = 'nonexistentuser@example.com';

        $user = User::findByEmail($email);

        $this->assertNull($user);
    }
}
