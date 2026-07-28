<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Species;

class SpeciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $speciesMap = [
            'Cat' => 'Gatto',
            'Dog' => 'Cane',
            'Bird' => 'Uccello',
            'Rabbit' => 'Coniglio',
            'Fish' => 'Pesce',
            'Reptile' => 'Rettile',
            'Horse' => 'Cavallo',
            'Cow' => 'Mucca',
            'Sheep' => 'Pecora',
            'Goat' => 'Capra',
            'Pig' => 'Maiale',
            'Chicken' => 'Pollo',
            'Duck' => 'Anatra',
            'Turkey' => 'Tacchino',
            'Guinea Pig' => 'Porcellino d\'India',
            'Hamster' => 'Criceto',
            'Ferret' => 'Furetto',
            'Chinchilla' => 'Cincillà',
            'Parrot' => 'Pappagallo',
            'Turtle' => 'Tartaruga',
        ];

        foreach ($speciesMap as $legacyName => $italianName) {
            $species = Species::where('name', $legacyName)->first();

            if ($species) {
                $species->update(['name' => $italianName]);
                continue;
            }

            Species::firstOrCreate(['name' => $italianName]);
        }
    }
}