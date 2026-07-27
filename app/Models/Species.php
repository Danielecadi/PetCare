<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static where(string $string, string $string1, string $string2)
 */
class Species extends Model
{
    use HasFactory;

    private const ITALIAN_NAMES = [
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

	protected $table = 'species';

	protected $fillable = [
		'name',
	];

    public function getNameAttribute(string $value): string
    {
        return self::ITALIAN_NAMES[$value] ?? $value;
    }

	public function pet(): BelongsTo
	{
		return $this->belongsTo(Pet::class);
	}

	public function breeds(): HasMany
	{
		return $this->hasMany(Breed::class);
	}
}
