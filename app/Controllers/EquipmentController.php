<?php

namespace App\Controllers;

use Core\Http\Controllers\Controller;
use Core\Http\Request;
use Lib\Authentication\Auth;

class EquipmentController extends Controller
{

  protected ?\App\Models\User $current_user;
  protected ?\App\Models\Equipment $equipment;

  public function __construct()
  {
    $this->current_user = $this->getCurrentUser();
  }

  public function getCurrentUser(): ?\App\Models\User
  {
    return Auth::user();
  }

  public function index(): void {
    $equipment = new \App\Models\Equipment();
    $equipments = $equipment->getAllEquipments();

    $this->render('equipments/index', ['equipments' => $equipments]);
  }

  public function new(): void
  {
    $this->render('equipments/new');
  }

  public function store(): void
  {
    // Store the equipment
  }

  public function show(): void
  {
    $this->render('equipment/show');
  }

  public function edit(): void
  {
    $this->render('equipment/edit');
  }

  public function update(): void
  {
    // Update the equipment
  }

  public function destroy(): void
  {
    // Destroy the equipment
  }
}
