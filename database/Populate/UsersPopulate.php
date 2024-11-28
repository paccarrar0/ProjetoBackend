<?php

namespace Database\Populate;

use App\Models\User;

class UsersPopulate
{
    public static function populate()
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

        $numberOfUsers = 2;

        for ($i = 1; $i < $numberOfUsers; $i++) {
            $data =  [
                'name' => 'Fulano ' . $i,
                'email' => 'fulano' . $i . '@example.com',
                'role' => 'user',
                'password' => '123456',
                'password_confirmation' => '123456'
            ];

            $user = new User($data);
            $user->save();
        }

        echo "Users populated with $numberOfUsers registers\n";
    }
}
