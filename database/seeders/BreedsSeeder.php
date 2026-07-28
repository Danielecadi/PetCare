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

        $breeds = [
            'Cat' => ['Ragdoll', 'Exotic Shorthair', 'British Shorthair', 'Persian cat', 'Maine Coon'],
            'Dog' => ['Affenpinscher', 'Afghan Hound', 'Airedale Terrier', 'Akita', 'Alaskan Klee Kai'],
            'Bird' => ['Ostrich', 'Rhea', 'Cassowary', 'Emu', 'Kiwi'],
            'Rabbit' => ['American', 'Argente Brun', 'Argente de Champagne', 'Argente Noir', 'Argente St Hubert'],
            'Fish' => ['Swordfish', 'Atlantic cod', 'Mackerel', 'Trout', 'Atlantic salmon'],
            'Reptile' => ['American alligator', 'Gopher tortoise', 'California kingsnake', 'Gila monster', 'Dorset sheep'],
            'Horse' => ['American Milking Devon', 'Anatolian Black', 'Andalusian Black', 'Angus', 'Ankole-Watusi'],
            'Cow' => ['American Angus', 'American Brahman', 'American Breed', 'American Milking Devon', 'American White Park'],
            'Sheep' => ['Bannur Sheep', 'Barbados Black Belly', 'Cheviot Sheep', 'Columbia Sheep', 'Corriedale Sheep'],
            'Goat' => ['Alpine Goat', 'Belgian Fawn Goat', 'LaMancha Goat', 'Nigerian Dwarf Goat', 'Oberhasli Goat'],
            'Pig' => ['American Yorkshire', 'Angeln Saddleback', 'Appalachian English', 'Arapawa Island', 'Arikara'],
            'Chicken' => ['Australorp', 'Barnevelder', 'Brahma', 'Cochin', 'Leghorn'],
            'Duck' => ['Abacot Ranger', 'Aylesbury', 'Bali', 'Black East Indian', 'Blue Swedish'],
            'Turkey' => ['Auburn', 'Black', 'Bourbon Red', 'Bronze', 'Narragansett'],
            'Guinea Pig' => ['Abyssinian', 'American', 'Coronet', 'Peruvian', 'Silkie'],
            'Hamster' => ['Campbell\'s Dwarf', 'Chinese', 'Roborovski', 'Syrian', 'Winter White Russian Dwarf'],
            'Ferret' => ['Albino', 'Black Sable', 'Champagne', 'Chocolate', 'Sable'],
            'Chinchilla' => ['Standard Gray', 'Beige', 'Black Velvet', 'Violet', 'White'],
            'Parrot' => ['African Grey', 'Amazon', 'Budgerigar', 'Cockatiel', 'Cockatoo'],
            'Turtle' => ['African Aquatic Sideneck', 'Asian Box', 'Eastern Box', 'Mississippi Map', 'Russian']
        ];

        foreach ($breeds as $legacySpeciesName => $breedList) {
            $species = Species::where('name', $legacySpeciesName)
                ->orWhere('name', $speciesMap[$legacySpeciesName] ?? $legacySpeciesName)
                ->first();

            if (!$species) {
                continue;
            }

            foreach ($breedList as $breedName) {
                Breed::firstOrCreate([
                    'species_id' => $species->id,
                    'name' => $breedName,
                ]);
            }
        }
    }
}