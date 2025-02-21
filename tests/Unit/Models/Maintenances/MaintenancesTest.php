<?php

namespace Tests\Unit\Models\Maintenances;

use App\Models\Equipment;
use PHPUnit\Framework\TestCase;
use App\Models\Maintenance;

class MaintenancesTest extends TestCase
{
    private Maintenance $maintenance;
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
          'image_path' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQmIYAChuB-6OYidyIY3xDOwH-wXncpUwbC5A&s'
        ],);
        $this->equipment->save();

        $this->maintenance = new Maintenance([
          'description' => 'Maintenance description ',
          'status' => 'pending',
          'equipment_id' => $this->equipment->id
        ]);
        $this->maintenance->save();
    }

    public function test_get_all_maintenances(): void
    {
        $maintenance = $this->equipment->maintenances()->paginate();
        $maintenances = $maintenance->registers();

        $this->assertIsArray($maintenances);
        $this->assertNotEmpty($maintenances);
        $this->assertCount(1, $maintenances);
    }

    public function test_destroy_maintenance(): void
    {
        $this->maintenance->destroy();

        $maintenance = $this->equipment->maintenances()->paginate();
        $maintenances = $maintenance->registers();

        $this->assertIsArray($maintenances);
        $this->assertEmpty($maintenances);
    }

    public function test_create_maintenance(): void
    {
        $maintenance = new Maintenance([
        'description' => 'Maintenance description 2',
        'status' => 'pending',
        'equipment_id' => $this->equipment->id
        ]);
        $maintenance->save();

        $maintenance = $this->equipment->maintenances()->paginate();
        $maintenances = $maintenance->registers();

        $this->assertIsArray($maintenances);
        $this->assertNotEmpty($maintenances);
        $this->assertCount(2, $maintenances);
    }

    public function test_valid_maintenance(): void
    {
        $maintenance = new Maintenance([
        'description' => 'Maintenance description 2',
        'status' => 'pending',
        'equipment_id' => $this->equipment->id
        ]);

        $this->assertTrue($maintenance->isValid());
    }

    public function test_invalid_maintenance(): void
    {
        $maintenance = new Maintenance([
        'description' => '',
        'status' => 'pending',
        'equipment_id' => $this->equipment->id
        ]);

        $this->assertFalse($maintenance->isValid());
    }
}
