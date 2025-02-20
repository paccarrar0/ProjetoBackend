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
        $equipment = new \App\Models\Equipment();
        $equipment = $equipment->findById($params['id']);

        dd($equipment);

        $maintenance = new \App\Models\Maintenance;
        $maintenances = $equipment->maintenances();

        $this->render('maintenances/index', ['maintenances' => $maintenances]);
    }

    public function new(): void
    {
        $this->render('maintenances/new');
    }

    public function create(Request $request): void
    {

        $params = $request->getParams();
        $maintenance = new Maintenance($params['maintenance']);


        if ($maintenance->save()) {
            FlashMessage::success('maintenance created successfully');
            $this->redirectTo(route('maintenances.index'));
        } else {
            FlashMessage::danger('Failed to create maintenance');
            $this->redirectTo(route('maintenances.new'));
        }
    }

    /*
    public function show(Request $request): void
    {
        $params = $request->getParams();
        $maintenance = new \App\Models\maintenance();
        $maintenance = $maintenance->findById($params['id']);

        $this->render('maintenances/show', ['maintenance' => $maintenance]);
    }
    */

    public function edit(Request $request): void
    {
        $params = $request->getParams();
        $maintenance = new \App\Models\Maintenance();
        $maintenance = $maintenance->findById($params['id']);

        $this->render('maintenances/edit', ['maintenance' => $maintenance]);
    }

    public function update(Request $request): void
    {
        $params = $request->getParams();
        $maintenanceData = $params['maintenance'] ?? [];

        $maintenance = Maintenance::findById($params['id']);

        foreach ($maintenanceData as $key => $value) {
            if ($value !== '') {
                $maintenance->$key = $value;
            }
        }

        $maintenance->serial_number = $maintenance->serial_number;

        if ($maintenance->save()) {
            FlashMessage::success('maintenance updated successfully');
            $this->redirectTo(route('maintenances.index'));
        } else {
            FlashMessage::danger('Failed to update maintenance');
            $this->redirectTo(route('maintenances.edit', ['id' => $params['id']]));
        }
    }


    public function destroy(Request $request): void
    {
        $params = $request->getParams();
        $maintenance = new \App\Models\Maintenance();
        $maintenance = $maintenance->findById($params['id']);


        if ($maintenance->destroy()) {
            FlashMessage::success('maintenance deleted successfully');
            $this->redirectTo(route('maintenances.index'));
        } else {
            FlashMessage::danger('Failed to delete maintenance');
            $this->redirectTo(route('maintenances.index'));
        }
    }
}
