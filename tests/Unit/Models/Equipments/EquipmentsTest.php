<?php

namespace Tests\Unit\Models\Equipments;

use PHPUnit\Framework\TestCase;
use App\Models\Equipment;

class EquipmentsTest extends TestCase
{
    public function test_get_all_equipments(): void
    {
        $equipment = new Equipment();
        $allEquipments = $equipment->getAllEquipments();

        $this->assertIsArray($allEquipments);
    }

    public function test_get_errors(): void
    {
        $equipment = new Equipment();
        $errors = $equipment->getErrors();

        $this->assertIsArray($errors);
    }
}
