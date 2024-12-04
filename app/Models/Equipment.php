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
        'serial_number'
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
    }

    public function getAllEquipments(): array
    {
        $query = "SELECT * FROM equipments";
        $stmt = Database::getDatabaseConn()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}