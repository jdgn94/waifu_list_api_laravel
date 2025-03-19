<?php

namespace App\Http\Utils;

use App\Models\User;

class UserUtils
{
    public function create(string $name, string $username, string $password)
    {
        $total_users = User::count();

        $new_user = User::create([
            'name' => $name,
            'username' => $username,
            'password' => $password,
            'role_id' => $total_users == 0 ? 1 : null,
        ]);

        return $new_user;
    }
}