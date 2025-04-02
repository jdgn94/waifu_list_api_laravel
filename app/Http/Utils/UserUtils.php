<?php

namespace App\Http\Utils;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserUtils
{
    public function create(string $name, string $username, string $password)
    {
        try {
            $total_users = User::count();

            $user = new User();
            $user->name = $name;
            $user->username = $username;
            $user->password = Hash::make($password);
            $user->role_id = $total_users == 0 ? 1 : 3;
            $user->save();

            return $user;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}