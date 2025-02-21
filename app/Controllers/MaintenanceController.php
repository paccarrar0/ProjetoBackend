<?php

namespace App\Controllers;

use App\Models\Equipment;
use App\Models\Maintenance;
use Core\Http\Controllers\Controller;
use Core\Http\Request;
use Lib\Authentication\Auth;
use Lib\FlashMessage;

class MaintenanceController extends Controller
{
    protected ?\App\Models\User $current_user;
    protected ?\App\Models\Equipment $maintenance;

    public function __construct()
    {
        $this->current_user = $this->getCurrentUser();
    }

    public function getCurrentUser(): ?\App\Models\User
    {
        return Auth::user();
    }

    public function index(Request $request): void
    {
        $params = $request->getParams();
        $equipment = Equipment::findById($params['id']);

        $maintenance = $equipment->maintenances()->paginate();
        $maintenances = $maintenance->registers();


        $this->render('maintenances/index', ['maintenances' => $maintenances, 'equipment' => $equipment]);
    }

    public function new(Request $request): void
    {
        $params = $request->getParams();
        $equipment = Equipment::findById($params['id']);

        $this->render('maintenances/new', ['equipment' => $equipment]);
    }

    public function create(Request $request): void
    {
        $params = $request->getParams();
        $equipment = Equipment::findById($params['id']);

        $maintenance = $equipment->maintenances()->new($params['maintenance']);
        $description = trim($_POST['maintenance']['description']);
        $maintenance->description = $description;

        if ($maintenance->save()) {
            FlashMessage::success('Maintenance created successfully');
            $this->redirectTo(route('maintenances.index', ['id' => $equipment->id]));
        } else {
            FlashMessage::danger('Failed to create maintenance');
            $this->redirectTo(route('maintenances.new', ['id' => $equipment->id]));
        }
    }

    public function edit(Request $request): void
    {
        $params = $request->getParams();
        $maintenance = new \App\Models\Maintenance();
        $maintenance = $maintenance->findById($params['id']);
        $equipment = Equipment::findById($maintenance->equipment_id);

        $this->render('maintenances/edit', ['maintenance' => $maintenance, 'equipment' => $equipment]);
    }

    public function update(Request $request): void
    {
        $params = $request->getParams();
        $maintenanceData = $params['maintenance'] ?? [];

        $maintenance = Maintenance::findById($params['id']) ?? [];
        $equipment = Equipment::findById($maintenance->equipment_id);

        foreach ($maintenanceData as $key => $value) {
            if ($value !== '') {
                $maintenance->$key = $value;
            }
        }

        if ($maintenance->save()) {
            FlashMessage::success('Maintenance updated successfully');
            $this->redirectTo(route('maintenances.index', ['id' => $equipment->id]));
        } else {
            FlashMessage::danger('Failed to update equipment');
            $this->redirectTo(route('maintenances.edit', ['id' => $maintenance->id]));
        }
    }


    public function destroy(Request $request): void
    {
        $params = $request->getParams();
        $maintenance = new \App\Models\Maintenance();
        $maintenance = $maintenance->findById($params['id']);


        if ($maintenance->destroy()) {
            FlashMessage::success('Maintenance deleted successfully');
            $this->redirectTo(route('maintenances.index', ['id' => $params['equipment_id']]));
        } else {
            FlashMessage::danger('Failed to delete maintenance');
            $this->redirectTo(route('maintenances.index', ['id' => $params['equipment_id']]));
        }
    }
}
