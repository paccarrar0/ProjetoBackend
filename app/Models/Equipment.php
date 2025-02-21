<?php

namespace App\Models;

use Core\Database\ActiveRecord\HasMany;
use Core\Database\ActiveRecord\Model;
use Lib\Validations;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $category
 * @property string $status
 * @property float $rental_price
 * @property string $location
 * @property string $serial_number
 * @property string $image_path
 */

class Equipment extends Model
{
    protected static string $table = 'equipments';
    protected static array $columns = [
        'name',
        'description',
        'category',
        'status',
        'rental_price',
        'location',
        'serial_number',
        'image_path'
    ];


    public function validates(): void
    {
        if (!is_numeric($this->rental_price)) {
            $this->errors['rental_price'] = 'Price must be a number';
        }

        if ($this->rental_price < 0) {
            $this->errors['rental_price'] = 'Price must be greater than 0';
        }
    }

    /**
     * @return array<int, static>
     */

    public function getAllEquipments(): array
    {
        return self::all();
    }

    /**
     * @param array<string, mixed> $data
     * @return self $equipment
     */

    /**
     * @return array<string, string>
     */

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function maintenances(): HasMany
    {
        return $this->hasMany(Maintenance::class, 'equipment_id');
    }
}
