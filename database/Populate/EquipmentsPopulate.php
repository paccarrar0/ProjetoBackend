<?php

namespace Database\Populate;

use App\Models\Equipment;

class EquipmentsPopulate
{
  public static function populate()
  {

    $equipments = [
      [
        'name' => 'Parafusadeira',
        'description' => 'Parafusadeira elétrica com controle de torque',
        'category' => 'Ferramentas',
        'status' => 'available',
        'rental_price' => 15.00,
        'location' => 'Rio de Janeiro',
        'serial_number' => '654321',
      ],
      [
        'name' => 'Serra Circular',
        'description' => 'Serra circular portátil 1200W',
        'category' => 'Ferramentas',
        'status' => 'in_use',
        'rental_price' => 20.00,
        'location' => 'Belo Horizonte',
        'serial_number' => '112233',
      ],
      [
        'name' => 'Máquina de Solda',
        'description' => 'Máquina de solda MIG 220V',
        'category' => 'Ferramentas',
        'status' => 'available',
        'rental_price' => 25.00,
        'location' => 'Curitiba',
        'serial_number' => '445566',
      ],
      [
        'name' => 'Cortador de Grama',
        'description' => 'Cortador de grama elétrico 1600W',
        'category' => 'Jardinagem',
        'status' => 'maintenance',
        'rental_price' => 18.00,
        'location' => 'Florianópolis',
        'serial_number' => '778899',
      ],
      [
        'name' => 'Roçadeira',
        'description' => 'Roçadeira a gasolina 42cc',
        'category' => 'Jardinagem',
        'status' => 'available',
        'rental_price' => 22.00,
        'location' => 'Porto Alegre',
        'serial_number' => '998877',
      ],
      [
        'name' => 'Betoneira',
        'description' => 'Betoneira 400L para construção',
        'category' => 'Construção',
        'status' => 'in_use',
        'rental_price' => 35.00,
        'location' => 'Salvador',
        'serial_number' => '223344',
      ],
      [
        'name' => 'Martelete',
        'description' => 'Martelete rompedor 800W',
        'category' => 'Ferramentas',
        'status' => 'available',
        'rental_price' => 28.00,
        'location' => 'Brasília',
        'serial_number' => '667788',
      ],
      [
        'name' => 'Aspirador Industrial',
        'description' => 'Aspirador de pó industrial 2200W',
        'category' => 'Limpeza',
        'status' => 'available',
        'rental_price' => 12.00,
        'location' => 'Fortaleza',
        'serial_number' => '554433',
      ],
      [
        'name' => 'Gerador de Energia',
        'description' => 'Gerador de energia a gasolina 3.5kVA',
        'category' => 'Energia',
        'status' => 'maintenance',
        'rental_price' => 40.00,
        'location' => 'Recife',
        'serial_number' => '334455',
      ]
    ];

    for ($i = 0; $i < count($equipments); $i++) {
      $data = $equipments[$i];

      $equipment = new Equipment($data);
      $equipment->save();
    }

    echo "Equipments populated with " . count($equipments) . "registers\n";
  }
}
