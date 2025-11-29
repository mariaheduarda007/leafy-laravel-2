<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            // CURSO
            ["name" => "book.create"],     // 1
            ["name" => "book.show"],       // 2
            ["name" => "book.edit"],       // 3
            ["name" => "book.delete"],     // 4
            ["name" => "book.search"],     // 5
            ["name" => "profile.index"],   // 6
        ];
        DB::table('resources')->insert($data);
    }
}
