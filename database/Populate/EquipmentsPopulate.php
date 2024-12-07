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
        'image_path' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQmIYAChuB-6OYidyIY3xDOwH-wXncpUwbC5A&s'
      ],
      [
        'name' => 'Serra Circular',
        'description' => 'Serra circular portátil 1200W',
        'category' => 'Ferramentas',
        'status' => 'in_use',
        'rental_price' => 20.00,
        'location' => 'Belo Horizonte',
        'serial_number' => '112233',
        'image_path' => 'https://cdn.awsli.com.br/600x700/767/767489/produto/110450408/1bd2f1341c.jpg'
      ],
      [
        'name' => 'Máquina de Solda',
        'description' => 'Máquina de solda MIG 220V',
        'category' => 'Ferramentas',
        'status' => 'available',
        'rental_price' => 25.00,
        'location' => 'Curitiba',
        'serial_number' => '445566',
        'image_path' => 'https://cdn.awsli.com.br/2500x2500/496/496547/produto/61733232/847991ddb0.jpg'
      ],
      [
        'name' => 'Cortador de Grama',
        'description' => 'Cortador de grama elétrico 1600W',
        'category' => 'Jardinagem',
        'status' => 'maintenance',
        'rental_price' => 18.00,
        'location' => 'Florianópolis',
        'serial_number' => '778899',
        'image_path' => 'https://www.arcdesign.com.br/wp-content/uploads/2023/11/Top-10-Melhores-Cortadores-de-Grama-a-Gasolina-jpg.webp'
      ],
      [
        'name' => 'Roçadeira',
        'description' => 'Roçadeira a gasolina 42cc',
        'category' => 'Jardinagem',
        'status' => 'available',
        'rental_price' => 22.00,
        'location' => 'Porto Alegre',
        'serial_number' => '998877',
        'image_path' => 'https://oleomacbrasil.com.br/wp-content/uploads/2023/09/PFV_8384-scaled.jpg'
      ],
      [
        'name' => 'Betoneira',
        'description' => 'Betoneira 400L para construção',
        'category' => 'Construção',
        'status' => 'in_use',
        'rental_price' => 35.00,
        'location' => 'Salvador',
        'serial_number' => '223344',
        'image_path' => 'https://conecta.fg.com.br/wp-content/uploads/2020/10/Blog-Imagem-Principal-3.png'
      ],
      [
        'name' => 'Martelete',
        'description' => 'Martelete rompedor 800W',
        'category' => 'Ferramentas',
        'status' => 'available',
        'rental_price' => 28.00,
        'location' => 'Brasília',
        'serial_number' => '667788',
        'image_path' => 'https://antferramentas.vtexassets.com/arquivos/ids/171542/Martelete-Perfurador-Rompedor-1500W-Bosch-GBH-8-45-DV-ANT-Ferramentas.jpg?v=637384677886330000'
      ],
      [
        'name' => 'Aspirador Industrial',
        'description' => 'Aspirador de pó industrial 2200W',
        'category' => 'Limpeza',
        'status' => 'available',
        'rental_price' => 12.00,
        'location' => 'Fortaleza',
        'serial_number' => '554433',
        'image_path' => 'https://www.morovacuo.com.br/imagens/produtos/2.jpg'
      ],
      [
        'name' => 'Gerador de Energia',
        'description' => 'Gerador de energia a gasolina 3.5kVA',
        'category' => 'Energia',
        'status' => 'maintenance',
        'rental_price' => 40.00,
        'location' => 'Recife',
        'serial_number' => '334455',
        'image_path' => 'https://toyama.com.br/wp-content/uploads/2022/10/A-importancia-de-um-gerador-de-energia-para-sua-empresa.jpg'
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
