<?php

namespace App\Controllers;

use App\Models\Equipment;
use Core\Http\Controllers\Controller;
use Core\Http\Request;
use Lib\Authentication\Auth;
use Lib\FlashMessage;

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

    public function index(): void
    {
        $equipment = new \App\Models\Equipment();
        $equipments = $equipment->getAllEquipments();

        $this->render('equipments/index', ['equipments' => $equipments]);
    }

    public function new(): void
    {
        $this->render('equipments/new');
    }

    public function create(Request $request): void
    {

        $params = $request->getParams();
        $equipment = new Equipment($params['equipment']);

        if ($equipment->save()) {
            FlashMessage::success('Equipment created successfully');
            $this->redirectTo(route('equipments.index'));
        } else {
            FlashMessage::danger('Failed to create equipment');
            $this->redirectTo(route('equipments.new'));
        }
    }

    public function show(Request $request): void
    {
        $params = $request->getParams();
        $equipment = new \App\Models\Equipment();
        $equipment = $equipment->findById($params['id']);

        $this->render('equipments/show', ['equipment' => $equipment]);
    }

    public function edit(Request $request): void
    {
        $params = $request->getParams();
        $equipment = new \App\Models\Equipment();
        $equipment = $equipment->findById($params['id']);

        $this->render('equipments/edit', ['equipment' => $equipment]);
    }

    public function update(Request $request): void
    {
        $params = $request->getParams();
        $equipmentData = $params['equipment'] ?? [];


        $equipment = Equipment::findById($params['id']);

        foreach ($equipmentData as $key => $value) {
            if ($value !== '') {
                $equipment->$key = $value;
            }
        }

        $equipment->serial_number = $equipment->serial_number;


        if ($equipment->save()) {
            FlashMessage::success('Equipment updated successfully');
            $this->redirectTo(route('equipments.index'));
        } else {
            FlashMessage::danger('Failed to update equipment');
            $this->redirectTo(route('equipments.edit', ['id' => $params['id']]));
        }
    }


    public function destroy(Request $request): void
    {
        $params = $request->getParams();
        $equipment = new \App\Models\Equipment();
        $equipment = $equipment->findById($params['id']);


        if ($equipment->destroy()) {
            FlashMessage::success('Equipment deleted successfully');
            $this->redirectTo(route('equipments.index'));
        } else {
            FlashMessage::danger('Failed to delete equipment');
            $this->redirectTo(route('equipments.index'));
        }
    }
}
