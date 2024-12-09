<?php

namespace App\Models;

use Core\Database\ActiveRecord\Model;
use Core\Database\Database;
use Lib\Validations;
use PDO;

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
        $query = "SELECT * FROM equipments";
        $stmt = Database::getDatabaseConn()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param int $id
     * @return array<string, mixed>
     */

    public function getEquipmentById(int $id): ?array
    {
        $query = "SELECT * FROM equipments WHERE id = :id";
        $stmt = Database::getDatabaseConn()->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
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
