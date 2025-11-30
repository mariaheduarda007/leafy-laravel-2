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
            ["name" => "book.index"],       // 2
            ["name" => "book.show"],       // 3
            ["name" => "book.edit"],       // 4
            ["name" => "book.delete"],     // 5
            ["name" => "book.search"],     // 6
            ["name" => "profile.index"],   // 7
        ];
        DB::table('resources')->insert($data);
    }
}
