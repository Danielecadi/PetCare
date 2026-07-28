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
        ];

        foreach ($speciesMap as $legacyName => $newName) {
            $species = Species::where('name', $legacyName)->first();

            if ($species) {
                $species->name = $newName;
                $species->save();
            } else {
                Species::firstOrCreate(['name' => $newName]);
            }
        }

        foreach (['Gatto', 'Cane'] as $allowedName) {
            Species::firstOrCreate(['name' => $allowedName]);
        }
    }
}