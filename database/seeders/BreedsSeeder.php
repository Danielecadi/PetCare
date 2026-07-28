<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Species;
use App\Models\Breed;

class BreedsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $breeds = [
            'Gatto' => [
                'Ragdoll' => 'Ragdoll',
                'Exotic Shorthair' => 'Exotic Shorthair',
                'British Shorthair' => 'British Shorthair',
                'Persian cat' => 'Persiano',
                'Maine Coon' => 'Maine Coon',
            ],
            'Cane' => [
                'Affenpinscher' => 'Affenpinscher',
                'Afghan Hound' => 'Barbone afgano',
                'Airedale Terrier' => 'Terrier di Airedale',
                'Akita' => 'Akita',
                'Alaskan Klee Kai' => 'Alaskan Klee Kai',
            ],
        ];

        foreach ($breeds as $speciesName => $breedList) {
            $species = Species::where('name', $speciesName)->first();

            if (!$species) {
                continue;
            }

            foreach ($breedList as $legacyName => $translatedName) {
                $breed = Breed::where('species_id', $species->id)
                    ->where('name', $legacyName)
                    ->first();

                if ($breed) {
                    $breed->name = $translatedName;
                    $breed->save();
                } else {
                    Breed::firstOrCreate([
                        'species_id' => $species->id,
                        'name' => $translatedName,
                    ]);
                }
            }
        }
    }
}