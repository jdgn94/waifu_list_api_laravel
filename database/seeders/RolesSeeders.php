<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $values = [
            ["id" => 1, "name" => "admin"],
            ["id" => 2, "name" => "moderator"],
            ["id" => 3, "name" => "user"],
        ];

        foreach ($values as $value) {
            Role::updateOrCreate(["id" => $value["id"]], $value);
        }
    }
}
