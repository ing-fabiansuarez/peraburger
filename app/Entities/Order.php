<?php

namespace App\Entities;

use App\Models\ClientModel;
use App\Models\DetailorderModel;
use App\Models\DomicilioModel;
use App\Models\EmployeeModel;
use App\Models\OrderModel;
use App\Models\StateModel;
use App\Models\TypeshippingModel;
use CodeIgniter\Entity;

class Order extends Entity
{
    public function setTimeCreation() //llena los atributos de date_order y hour_order
    {
        $this->attributes['date_order'] = date("Y-m-d");
        $this->attributes['hour_order'] = date("H:i:s");
        return $this;
    }
    public function setConsecutiveOfAllOrders() //
    {
        $mdl = new OrderModel();
        $this->attributes['consecutive_order'] = (count($mdl->findAll()) + 1);
        return $this;
    }
    public function setDarlyTurn() //
    {
        $mdl = new OrderModel();
        $this->attributes['darlyturn_order'] = (count($mdl->where('date_order', $this->attributes['date_order'])->findAll()) + 1);
        return $this;
    }
    public function setTurnMachine($turn = null)
    {
        $mdl = new OrderModel();
        switch ($this->attributes['typeshipping_id_typeshipping']) {
            case 1:
                $this->attributes['turnmachine_order'] =  (count($mdl->where('date_order', $this->attributes['date_order'])->where('typeshipping_id_typeshipping', 1)->findAll())) + 1;
                break;
            case 2:
                $this->attributes['turnmachine_order'] =  $turn;
                break;
        }
    }

    public function getListofProducts()
    {
        $mdlDetail = new DetailorderModel();
        return $mdlDetail->getListOrderByReference($this->attributes['id_order']);
    }

    public function getNameClient()
    {
        $mdlClient = new ClientModel();
        return $mdlClient->find($this->id_order)['name_client'] . '<br>' . $mdlClient->find($this->id_order)['surname_client'];
    }
    public function getNameEmployee()
    {
        $mdlEmployee = new EmployeeModel();

        return $mdlEmployee->find($this->attributes['employee_id_employee'])['name_employee'];
    }
    public function getDomicilio()
    {
        $mdlDomicilio = new DomicilioModel();
        return $mdlDomicilio->find($this->attributes['domicilio_id_domicilio']);
    }

    public function getTotalWthitOutDomicilio()
    {
        $adder = 0;
        $discounts = 0;
        foreach ($this->getListofProducts() as $item) {
            $adder += $item['priceunit_detailorder'];
            foreach ($item['whitout'] as $whitout) {
                $discounts += $whitout['discount_hasnot'];
            }
        }
        return $adder - $discounts;
    }
    public function getTypeofShipping()
    {
        $mdl = new TypeshippingModel();
        return $mdl->find($this->typeshipping_id_typeshipping);
    }
    public function getState()
    {
        $mdl = new StateModel();
        return $mdl->find($this->state_id_state);
    }
    public function getQuantityOfProducts($id_product)
    {
        $contador = 0;
        foreach ($this->getListofProducts() as $product) {
            if ($product['product_id_product'] == $id_product) {
                $contador += (1 * $product['quantity_detailorder']);
            }
        }
        return $contador;
    }
}
