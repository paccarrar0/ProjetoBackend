<?php

namespace Database\Populate;

use App\Models\Equipment;
use App\Models\Maintenance;

class MaintenancesPopulate
{
  public static function populate()
  {

    // id INT AUTO_INCREMENT PRIMARY KEY,
    // equipment_id INT NOT NULL,
    // description TEXT DEFAULT NULL,
    // status ENUM('pending', 'in_progress', 'completed') DEFAULT 'pending',
    // created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    // updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    // CONSTRAINT fk_maintenances_equipment FOREIGN KEY (equipment_id) REFERENCES equipments(id) ON DELETE CASCADE

    $maintenances = [
      [
        'equipment_id' => 1,
        'description' => 'Manutenção preventiva',
        'status' => 'pending'
      ],
      [
        'equipment_id' => 2,
        'description' => 'Manutenção corretiva',
        'status' => 'in_progress'
      ],
      [
        'equipment_id' => 3,
        'description' => 'Manutenção preventiva',
        'status' => 'completed'
      ],
      [
        'equipment_id' => 4,
        'description' => 'Manutenção corretiva',
        'status' => 'pending',
      ]
    ];

    for ($i = 0; $i < count($maintenances); $i++) {
      $data = $maintenances[$i];

      $maintenance = new Maintenance($data);
      $maintenance->save();
    }

    echo "maintenances populated with " . count($maintenances) . "registers\n";
  }
}
