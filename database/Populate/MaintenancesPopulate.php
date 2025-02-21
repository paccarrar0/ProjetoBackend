<?php

namespace Database\Populate;

use App\Models\Equipment;
use App\Models\Maintenance;

class MaintenancesPopulate
{
  public static function populate()
  {

    $numberOfMaintenances = 10;

    for ($i = 0; $i < $numberOfMaintenances; $i++) {
        $maintenance = new Maintenance([
            'description' => 'Maintenance description ' . $i,
            'status' => 'pending',
            'equipment_id' => rand(1, 9)
        ]);
        $maintenance->save();
    }

    echo "Maintenances populated with $numberOfMaintenances registers\n";
  }
}
