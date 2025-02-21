<?php

namespace App\Models;

use Core\Database\ActiveRecord\BelongsTo;
use Core\Database\ActiveRecord\Model;
use Lib\Validations;
use PHPUnit\TextUI\XmlConfiguration\Validator;

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
        'equipment_id',
        'description',
        'status',
    ];
    protected array $errors = [];

    public function validates(): void
    {
        Validations::notEmpty('description', $this);
    }

    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class, 'equipment_id');
    }

    /**
     * @return array<string, string>
     */

    public function getErrors(): array
    {
        return $this->errors;
    }
}
