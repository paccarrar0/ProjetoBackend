<?php

namespace App\Models;

use Core\Database\ActiveRecord\Model;

/**
 * @property int $id
 * @property int $equipment_id
 * @property string $description
 * @property string $status
 */

class Maintenance extends Model
{
    protected static string $table = 'maintenances';
    protected static array $columns = [
        'id',
        'equipment_id',
        'description',
        'status',
    ];

    public function validates(): void {}

    

    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'equipment_id');
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
