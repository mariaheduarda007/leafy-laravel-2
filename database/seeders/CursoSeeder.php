<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CursoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ["nome" => "TÉCNICO EM INFORMÁTICA", "duracao" => 4],
            ["nome" => "TECNÓLOGO EM DESENVOLVIMENTO", "duracao" => 3],
        ];
        DB::table('cursos')->insert($data);
    }
}
