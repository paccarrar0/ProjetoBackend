<?php

namespace App\Models;

use Core\Database\ActiveRecord\Model;
use Lib\Validations;

/**
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
    protected array $errors = [];
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
        Validations::notEmpty('name', $this);
        Validations::notEmpty('description', $this);
        Validations::notEmpty('category', $this);
        Validations::notEmpty('status', $this);
        Validations::notEmpty('rental_price', $this);
        Validations::notEmpty('location', $this);
        Validations::notEmpty('serial_number', $this);
        Validations::notEmpty('image_path', $this);
    }

    /**
     * @return array<int, array<string, mixed>>
     */

    public function getAllEquipments(): array
    {
        return $this->all();
    }

    /**
     * @param int $id
     * @return array<string, mixed>
     */

    public static function getEquipmentById(int $id): ?array
    {
        $equipment = self::findById($id);

        if ($equipment === null) {
            return null;
        }

        return [
            'id' => $equipment->id,
            'name' => $equipment->name,
            'description' => $equipment->description,
            'category' => $equipment->category,
            'status' => $equipment->status,
            'rental_price' => $equipment->rental_price,
            'location' => $equipment->location,
            'serial_number' => $equipment->serial_number,
            'image_path' => $equipment->image_path
        ];
    }

    /**
     * @param array<string, mixed> $data
     * @return self $equipment
     */

    public static function toObject(array $data): self
    {
        $equipment = new self();
        foreach ($data as $key => $value) {
            if ($key !== 'created_at' && $key !== 'updated_at') {
                $equipment->$key = $value;
            }
        }
        return $equipment;
    }

    /**
     * @return array<string, string>
     */

    public function getErrors(): array
    {
        return $this->errors;
    }
}
