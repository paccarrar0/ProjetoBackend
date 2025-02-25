<?php

namespace Tests\Unit\Services;

use App\Models\Equipment;
use PHPUnit\Framework\TestCase;
use App\Services\EquipmentImage;

class EquipmentImageTest extends TestCase
{
    private Equipment $equipment;


    public function setUp(): void
    {
        parent::setUp();
        $this->equipment = new Equipment([
        'name' => 'Parafusadeira',
        'description' => 'Parafusadeira elétrica com controle de torque',
        'category' => 'Ferramentas',
        'status' => 'available',
        'rental_price' => 15.00,
        'location' => 'Rio de Janeiro',
        'serial_number' => '654321',
        'image_path' => null
        ],);
        $this->equipment->save();
    }

    public function test_update_upload_image(): void
    {
        $image = [
        'name' => 'test.png',
        'full_path' => 'test.png',
        'type' => 'image/png',
        'tmp_name' => 'tmp_name',
        'error' => 0,
        'size' => 100
        ];

        $this->assertTrue($this->equipment->equipmentImage()->update($image));
    }

    public function test_delete_image(): void
    {
        $image = [
        'name' => 'test.png',
        'full_path' => 'test.png',
        'type' => 'image/png',
        'tmp_name' => 'tmp_name',
        'error' => 0,
        'size' => 100
        ];

        $this->equipment->equipmentImage()->update($image);
        $this->equipment->equipmentImage()->delete();
        $this->assertNull($this->equipment->image_path);
    }

    public function test_update_invalid_type_image(): void
    {
        $image = [
        'name' => 'test.pdf',
        'full_path' => 'test.pdf',
        'type' => 'application/pdf',
        'tmp_name' => 'tmp_name',
        'error' => 0,
        'size' => 100
        ];

        $this->assertFalse($this->equipment->equipmentImage()->update($image));
    }

    public function test_update_invalid_size_image(): void
    {
        $image = [
        'name' => 'test.png',
        'full_path' => 'test.png',
        'type' => 'image/png',
        'tmp_name' => 'tmp_name',
        'error' => 0,
        'size' => 1000000000
        ];

        $this->assertFalse($this->equipment->equipmentImage()->update($image));
    }
}
