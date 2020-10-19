<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Breed
 * @package App\Models
 */
class Breed extends BaseModel
{
    use HasFactory;
    
    const TYPE_DOG = 'dog';
    const TYPE_CAT = 'cat';

    /**
     * @var array
     */
    protected $fillable = [
        "animal_type",
        "name",
        "temperament",
        "alternative_names",
        "life_span",
        "origin",
        "wikipedia_url",
        "country_code",
        "description",
        "favourite"
    ];

    /**
     * @return array
     */
    public static function getAvailableAnimalypes()
    {
        return [
            self::TYPE_DOG,
            self::TYPE_CAT
        ];
    }
}
