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
            ["name" => "book.index"],       // 1
            ["name" => "book.create"],     // 2
            ["name" => "book.edit"],       // 3
            ["name" => "book.delete"],     // 4
            ["name" => "book.report"],     // 5
        ];
        DB::table('resources')->insert($data);
    }
}
