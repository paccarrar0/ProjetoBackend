<?php

namespace Tests\Controllers;

use PHPUnit\Framework\TestCase;
use App\Controllers\EquipmentController;
use App\Models\Equipment;
use Core\Http\Request;
use Lib\Authentication\Auth;
use Lib\FlashMessage;

class EquipmentControllerTest extends TestCase
{
    protected $controller;
    protected $request;
    protected $equipment;

    protected function setUp(): void
    {
        $this->request = $this->createMock(Request::class);
        $this->equipment = $this->createMock(Equipment::class);
        $this->controller = $this->getMockBuilder(EquipmentController::class)
                                 ->disableOriginalConstructor()
                                 ->onlyMethods(['render', 'redirectTo'])
                                 ->getMock();
    }

    public function testIndex()
    {
        $this->equipment->method('getAllEquipments')->willReturn([]);
        $this->controller->expects($this->once())
                         ->method('render')
                         ->with('equipments/index', ['equipments' => []]);

        $this->controller->index();
    }

    public function testNew()
    {
        $this->controller->expects($this->once())
                         ->method('render')
                         ->with('equipments/new');

        $this->controller->new();
    }

    public function testCreateSuccess()
    {
        $params = ['equipment' => ['name' => 'Excavator']];
        $this->request->method('getParams')->willReturn($params);
        $this->equipment->method('save')->willReturn(true);

        $flashMessageMock = $this->createMock(FlashMessage::class);
        $flashMessageMock->expects($this->once())->method('success')->with('Equipment created successfully');
        $this->controller->expects($this->once())->method('redirectTo')->with(route('equipments.index'));

        $this->controller->create($this->request);
    }

    public function testCreateFailure()
    {
        $params = ['equipment' => ['name' => 'Excavator']];
        $this->request->method('getParams')->willReturn($params);
        $this->equipment->method('save')->willReturn(false);

        $flashMessageMock = $this->createMock(FlashMessage::class);
        $flashMessageMock->expects($this->once())->method('danger')->with('Failed to create equipment');
        $this->controller->expects($this->once())->method('redirectTo')->with(route('equipments.new'));

        $this->controller->create($this->request);
    }

    public function testShow()
    {
        $params = ['id' => 1];
        $this->request->method('getParams')->willReturn($params);
        $this->equipment->method('getEquipmentById')->willReturn($this->equipment);

        $this->controller->expects($this->once())
                         ->method('render')
                         ->with('equipments/show', ['equipment' => $this->equipment]);

        $this->controller->show($this->request);
    }

    public function testEdit()
    {
        $params = ['id' => 1];
        $this->request->method('getParams')->willReturn($params);
        $this->equipment->method('getEquipmentById')->willReturn($this->equipment);

        $this->controller->expects($this->once())
                         ->method('render')
                         ->with('equipments/edit', ['equipment' => $this->equipment]);

        $this->controller->edit($this->request);
    }

    public function testUpdateSuccess()
    {
        $params = ['id' => 1, 'equipment' => ['name' => 'Updated Name']];
        $this->request->method('getParams')->willReturn($params);
        $this->equipment->method('getEquipmentById')->willReturn($this->equipment);
        $this->equipment->method('save')->willReturn(true);

        $flashMessageMock = $this->createMock(FlashMessage::class);
        $flashMessageMock->expects($this->once())->method('success')->with('Equipment updated successfully');
        $this->controller->expects($this->once())->method('redirectTo')->with(route('equipments.index'));

        $this->controller->update($this->request);
    }

    public function testUpdateFailure()
    {
        $params = ['id' => 1, 'equipment' => ['name' => 'Updated Name']];
        $this->request->method('getParams')->willReturn($params);
        $this->equipment->method('getEquipmentById')->willReturn($this->equipment);
        $this->equipment->method('save')->willReturn(false);

        $flashMessageMock = $this->createMock(FlashMessage::class);
        $flashMessageMock->expects($this->once())->method('danger')->with('Failed to update equipment');
        $this->controller->expects($this->once())->method('redirectTo')->with(route('equipments.edit', ['id' => 1]));

        $this->controller->update($this->request);
    }

    public function testDestroySuccess()
    {
        $params = ['id' => 1];
        $this->request->method('getParams')->willReturn($params);
        $this->equipment->method('getEquipmentById')->willReturn($this->equipment);
        $this->equipment->method('destroy')->willReturn(true);

        $flashMessageMock = $this->createMock(FlashMessage::class);
        $flashMessageMock->expects($this->once())->method('success')->with('Equipment deleted successfully');
        $this->controller->expects($this->once())->method('redirectTo')->with(route('equipments.index'));

        $this->controller->destroy($this->request);
    }

    public function testDestroyFailure()
    {
        $params = ['id' => 1];
        $this->request->method('getParams')->willReturn($params);
        $this->equipment->method('getEquipmentById')->willReturn($this->equipment);
        $this->equipment->method('destroy')->willReturn(false);

        $flashMessageMock = $this->createMock(FlashMessage::class);
        $flashMessageMock->expects($this->once())->method('danger')->with('Failed to delete equipment');
        $this->controller->expects($this->once())->method('redirectTo')->with(route('equipments.index'));

        $this->controller->destroy($this->request);
    }
}
