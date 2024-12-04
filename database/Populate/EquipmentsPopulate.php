<?php

namespace Database\Populate;

use App\Models\Equipment;

class EquipmentsPopulate
{
  public static function populate()
  {
    $data = [
      'name' => 'Furadeira',
      'description' => 'Furadeira de impacto',
      'category' => 'Ferramentas',
      'status' => 'Disponível',
      'rental_price' => 10.00,
      'location' => 'São Paulo',
      'serial_number' => '123456'
    ];

    $equipment = new Equipment($data);
    $equipment->save();

    $numberOfEquipments = 50;

    for ($i = 1; $i < $numberOfEquipments; $i++) {
      $data = [
        'name' => 'Furadeira ' . $i,
        'description' => 'Furadeira de impacto ' . $i,
        'category' => 'Ferramentas',
        'status' => 'Disponível',
        'rental_price' => 10.00,
        'location' => 'São Paulo',
        'serial_number' => '123456'
      ];

      $equipment = new Equipment($data);
      $equipment->save();
    }

    echo "Equipments populated with $numberOfEquipments registers\n";
  }
}
