<?php

namespace Tests\Models;

use PHPUnit\Framework\TestCase;
use App\Models\Equipment;

class EquipmentsTest extends TestCase
{
    public function testValidates()
    {
        $equipment = new Equipment();
        $equipment->name = '';
        $equipment->description = '';
        $equipment->category = '';
        $equipment->status = '';
        $equipment->rental_price = 0.0;
        $equipment->location = '';
        $equipment->serial_number = '';
        $equipment->image_path = '';

        $equipment->validates();

        $errors = $equipment->getErrors();
        $this->assertNotEmpty($errors);
    }

    public function testGetAllEquipments()
    {
        $equipment = new Equipment();
        $allEquipments = $equipment->getAllEquipments();

        $this->assertIsArray($allEquipments);
    }

    public function testGetEquipmentById()
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

    public function testToObject()
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

    public function testGetErrors()
    {
        $equipment = new Equipment();
        $errors = $equipment->getErrors();

        $this->assertIsArray($errors);
    }
}
