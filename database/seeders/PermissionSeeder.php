<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            
            // USUARIO
            ["role_id" => 1, "resource_id" => 1, "permission" => 0],
            ["role_id" => 1, "resource_id" => 2, "permission" => 1],
            ["role_id" => 1, "resource_id" => 3, "permission" => 0],
            ["role_id" => 1, "resource_id" => 4, "permission" => 0],
            ["role_id" => 1, "resource_id" => 5, "permission" => 1],
            ["role_id" => 1, "resource_id" => 6, "permission" => 1],
        
            // ADMINISTRADOR
            ["role_id" => 2, "resource_id" => 1, "permission" => 1],
            ["role_id" => 2, "resource_id" => 2, "permission" => 1],
            ["role_id" => 2, "resource_id" => 3, "permission" => 1],
            ["role_id" => 2, "resource_id" => 4, "permission" => 1],
            ["role_id" => 2, "resource_id" => 5, "permission" => 1],
            ["role_id" => 2, "resource_id" => 6, "permission" => 1],
        ];

        DB::table('permissions')->insert($data);
    }
}
