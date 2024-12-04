<?php

require __DIR__ . '/../../config/bootstrap.php';

use App\Models\Equipment;
use Core\Database\Database;
use Database\Populate\EquipmentsPopulate;
use Database\Populate\UsersPopulate;

Database::migrate();
UsersPopulate::populate();
EquipmentsPopulate::populate();