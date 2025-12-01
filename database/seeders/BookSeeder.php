<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ["title" => "1984", "sinopsis" => "Em um regime totalitário, Winston Smith luta contra a opressão do Grande Irmão enquanto questiona a verdade, a liberdade e a própria sanidade.", "releaseDate" => "1949", "genre" => "Distopia", "author" => "George Orwell"],

            ["title" => "O Senhor dos Anéis: A Sociedade do Anel", "sinopsis" => "Frodo Bolseiro herda um anel capaz de destruir o mundo e inicia uma jornada épica acompanhado por aliados para evitar que ele caia nas mãos do mal.", "releaseDate" => "1954", "genre" => "Fantasia", "author" => "J.R.R. Tolkien"],

            ["title" => "Orgulho e Preconceito", "sinopsis" => "Elizabeth Bennet enfrenta expectativas sociais e julgamentos precipitados enquanto sua relação com o enigmático Sr. Darcy evolui entre conflitos e descobertas.", "releaseDate" => "1813", "genre" => "Romance", "author" => "Jane Austen"],

            ["title" => "O Pequeno Príncipe", "sinopsis" => "Um piloto perdido no deserto encontra um menino vindo de outro planeta e, através de suas histórias, redescobre a beleza, o afeto e o essencial da vida.", "releaseDate" => "1943", "genre" => "Fábula filosófica", "author" => "Antoine de Saint-Exupéry"],

            ["title" => "Dom Quixote", "sinopsis" => "Um fidalgo obcecado por livros de cavalaria decide tornar-se cavaleiro andante, vivendo aventuras cômicas e idealistas ao lado de seu fiel escudeiro Sancho Pança.", "releaseDate" => "1605", "genre" => "Romance clássico", "author" => "Miguel de Cervantes"],

            ["title" => "Admirável Mundo Novo", "sinopsis" => "Em um futuro onde a felicidade é fabricada e a liberdade é sacrificada, Bernard Marx questiona a artificialidade de uma sociedade perfeitamente controlada.", "releaseDate" => "1932", "genre" => "Distopia", "author" => "Aldous Huxley"],

            ["title" => "O Morro dos Ventos Uivantes", "sinopsis" => "A relação intensa e destrutiva entre Heathcliff e Catherine marca gerações enquanto paixões, vinganças e traumas moldam a sombria atmosfera do lugar.", "releaseDate" => "1847", "genre" => "Romance gótico", "author" => "Emily Brontë"],

            ["title" => "Drácula", "sinopsis" => "Jonathan Harker descobre os horrores do Conde Drácula e se une a aliados para impedir que o vampiro espalhe sua maldição pela Inglaterra.", "releaseDate" => "1897", "genre" => "Terror", "author" => "Bram Stoker"],

            ["title" => "O Conto da Aia", "sinopsis" => "Em uma teocracia opressora, Offred é forçada a servir como a 'aia' de uma família poderosa, lutando pela própria identidade e por uma chance de liberdade.", "releaseDate" => "1985", "genre" => "Distopia", "author" => "Margaret Atwood"],

        ];
        $insertData = [];

        foreach ($data as $item) {
            $item['created_at'] = now();
            $item['updated_at'] = now();
            $insertData[] = $item;
        }

        DB::table('books')->insert($insertData);

    }
}
