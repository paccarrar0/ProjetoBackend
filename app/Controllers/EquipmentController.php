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
        $equipment = $equipment->getEquipmentById($params['id']);

        $this->render('equipments/show', ['equipment' => $equipment]);
    }

    public function edit(Request $request): void
    {
        $params = $request->getParams();
        $equipment = new \App\Models\Equipment();
        $equipment = $equipment->getEquipmentById($params['id']);

        $this->render('equipments/edit', ['equipment' => $equipment]);
    }

    public function update(Request $request): void
    {
        $params = $request->getParams();
        $equipment = new \App\Models\Equipment();
        $equipment = Equipment::toObject($equipment->getEquipmentById($params['id']));

        $params['equipment']['name'] !== '' ?
        $equipment->name = $params['equipment']['name']
        :
        $equipment->name = $equipment->name;
        $params['equipment']['description'] !== '' ?
        $equipment->description = $params['equipment']['description']
        :
        $equipment->description = $equipment->description;
        $params['equipment']['category'] !== '' ?
        $equipment->category = $params['equipment']['category']
        :
        $equipment->category = $equipment->category;
        $params['equipment']['status'] !== '' ?
        $equipment->status = $params['equipment']['status']
        :
        $equipment->status = $equipment->status;
        $params['equipment']['rental_price'] !== '' ?
        $equipment->rental_price = $params['equipment']['rental_price']
        :
        $equipment->rental_price = $equipment->rental_price;
        $params['equipment']['location'] !== '' ?
        $equipment->location = $params['equipment']['location']
        :
        $equipment->location = $equipment->location;

        $equipment->serial_number = $equipment->serial_number;

        $params['equipment']['image_path'] !== '' ?
        $equipment->image_path = $params['equipment']['image_path']
        :
        $equipment->image_path = $equipment->image_path;

        if ($equipment->save()) {
            FlashMessage::success('Equipment updated successfully');
            $this->redirectTo(route('equipments.index'));
        } else {
            FlashMessage::danger('Failed to update equipment');
            $this->redirectTo(route('equipments.edit'));
        }
    }

    public function destroy(Request $request): void
    {
        $params = $request->getParams();
        $equipment = new \App\Models\Equipment();
        $equipment = Equipment::toObject($equipment->getEquipmentById($params['id']));


        if ($equipment->destroy()) {
            FlashMessage::success('Equipment deleted successfully');
            $this->redirectTo(route('equipments.index'));
        } else {
            FlashMessage::danger('Failed to delete equipment');
            $this->redirectTo(route('equipments.index'));
        }
    }
}
