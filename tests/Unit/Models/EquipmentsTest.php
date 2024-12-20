<?php

namespace Tests\Unit\Models;

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

    public function test_get_equipment_by_id(): void
    {
        $equipment = Equipment::getEquipmentById(1);

        if ($equipment !== null) {
            $this->assertArrayHasKey('id', $equipment);
            $this->assertArrayHasKey('name', $equipment);
            $this->assertArrayHasKey('description', $equipment);
            $this->assertArrayHasKey('category', $equipment);
            $this->assertArrayHasKey('status', $equipment);
            $this->assertArrayHasKey('rental_price', $equipment);
            $this->assertArrayHasKey('location', $equipment);
            $this->assertArrayHasKey('serial_number', $equipment);
            $this->assertArrayHasKey('image_path', $equipment);
        } else {
            $this->assertNull($equipment);
        }
    }

    public function test_to_object(): void
    {
        $data = [
            'name' => 'Excavator',
            'description' => 'Heavy duty excavator',
            'category' => 'Construction',
            'status' => 'Available',
            'rental_price' => 150.0,
            'location' => 'Warehouse 1',
            'serial_number' => '12345',
            'image_path' => '/images/excavator.jpg'
        ];

        $equipment = Equipment::toObject($data);

        $this->assertInstanceOf(Equipment::class, $equipment);
        $this->assertEquals('Excavator', $equipment->name);
        $this->assertEquals('Heavy duty excavator', $equipment->description);
        $this->assertEquals('Construction', $equipment->category);
        $this->assertEquals('Available', $equipment->status);
        $this->assertEquals(150.0, $equipment->rental_price);
        $this->assertEquals('Warehouse 1', $equipment->location);
        $this->assertEquals('12345', $equipment->serial_number);
        $this->assertEquals('/images/excavator.jpg', $equipment->image_path);
    }

    public function test_get_errors(): void
    {
        $equipment = new Equipment();
        $errors = $equipment->getErrors();

        $this->assertIsArray($errors);
    }

    public function test_create_equipment_success(): void
    {
        $equipment = new Equipment();
        $equipment->name = 'Bulldozer';
        $equipment->description = 'Powerful bulldozer';
        $equipment->category = 'Construction';
        $equipment->status = 'Available';
        $equipment->rental_price = 200.0;
        $equipment->location = 'Yard';
        $equipment->serial_number = '67890';
        $equipment->image_path = '/images/bulldozer.jpg';

        $result = $equipment->save();
        $this->assertTrue($result);
    }

    public function test_create_equipment_failure(): void
    {
        $equipment = new Equipment();
        $equipment->name = '';
        $equipment->description = 'Invalid Equipment';
        $equipment->category = '';
        $equipment->status = 'Available';
        $equipment->rental_price = -10;
        $equipment->location = '';
        $equipment->serial_number = '';
        $equipment->image_path = '';

        $result = $equipment->save();
        $this->assertFalse($result);
        $this->assertNotEmpty($equipment->getErrors());
    }

    public function test_update_equipment_success(): void
    {
        $equipment = Equipment::toObject(Equipment::getEquipmentById(1));
        $this->assertNotNull($equipment);

        $equipment->name = 'Updated Name';
        $result = $equipment->save();
        $this->assertTrue($result);

        $updatedEquipment = Equipment::toObject(Equipment::getEquipmentById(1));
        $this->assertEquals('Updated Name', $updatedEquipment->name);
    }

    public function test_update_equipment_failure(): void
    {
        $equipment = Equipment::toObject(Equipment::getEquipmentById(1));
        $this->assertNotNull($equipment);

        $equipment->rental_price = -10;
        $result = $equipment->save();
        $this->assertFalse($result);
        $this->assertNotEmpty($equipment->getErrors());
    }

    public function test_delete_equipment(): void
    {
        $equipment = Equipment::toObject(Equipment::getEquipmentById(1));
        $this->assertNotNull($equipment);

        $result = $equipment->destroy();
        $this->assertTrue($result);

        $deletedEquipment = Equipment::getEquipmentById(1);
        $this->assertNull($deletedEquipment);
    }
}
