<?php

namespace App\Entities;

use App\Models\ClientModel;
use App\Models\DetailorderModel;
use App\Models\DomicilioModel;
use App\Models\EmployeeModel;
use App\Models\OrderModel;
use App\Models\PrintModel;
use App\Models\StateModel;
use App\Models\TypeshippingModel;
use App\Models\WhitoutingredientModel;
use App\Models\WithadditionModel;
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
    public function setTurnMachine()
    {
        $mdl = new OrderModel();
        switch ($this->attributes['typeshipping_id_typeshipping']) {
            case 1:
                $this->attributes['turnmachine_order'] =  (count($mdl->where('date_order', $this->attributes['date_order'])->where('typeshipping_id_typeshipping', 1)->findAll())) + 1;
                break;
            case 2:
                $this->attributes['turnmachine_order'] =  ((count($mdl->where('date_order', $this->attributes['date_order'])->where('typeshipping_id_typeshipping', 2)->findAll())) % 15) + 1;
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
        $surcharges = 0;
        foreach ($this->getListofProducts() as $item) {
            $adder += $item['priceunit_detailorder'] * $item['quantity_detailorder'];
            //sin ingredientes
            foreach ($item['whitout'] as $whitout) {
                $discounts += ($whitout['discount_hasnot'] * $item['quantity_detailorder']);
            }
            //adiciones
            foreach ($item['with'] as $with) {
                $surcharges += ($with['price_more_additions'] * $item['quantity_detailorder']);
            }
        }
        return $adder - $discounts + $surcharges;
    }
    public function getPricesOfDetail($id_detail_order)
    { //retorna un array con el recargo, los descuentos y el total del detalle del pedido
        $mdlWithout = new WhitoutingredientModel();
        $mdlWith = new WithadditionModel();
        $mdlDetail = new DetailorderModel();
        $detail = $mdlDetail->find($id_detail_order);
        $discounts = 0;
        $surcharges = 0;
        //descuentos
        foreach ($mdlWithout->getIngredients($id_detail_order) as $without) {
            /* d($mdlWithout->getIngredients($id_detail_order)); */
            $discounts += ($without['discount_hasnot'] * $detail['quantity_detailorder']);
        }
        //recargos
        foreach ($mdlWith->getAdditions($id_detail_order) as $With) {
            /* d($mdlWith->getAdditions($id_detail_order)); */
            $surcharges += ($With['price_more_additions'] * $detail['quantity_detailorder']);
        }
        return [
            'discounts' => $discounts,
            'surcharges' => $surcharges,
            'total' => ($detail['priceunit_detailorder'] * $detail['quantity_detailorder']) + $surcharges - $discounts
        ];
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
    public function hasSticker()
    {
        if ($this->typeshipping_id_typeshipping == 1) {
            if ($this->domicilio_id_domicilio != 1 && $this->domicilio_id_domicilio != 2) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }
    public function isPrint()
    {
        $mdlPrint = new PrintModel();
        if (!$mdlPrint->where('order_id_order', $this->id_order)->first()) {
            return false;
        } else {
            return true;
        }
    }
    public function durationTime()
    {
        $mdlOrder = new OrderModel();
        dd(
            $mdlOrder->db->table('detailorder')
                ->select('*')
                ->join('order', 'order.id_order = detailorder.order_id_order')
                ->where('order.date_order', $this->date_order)
                ->where('order.state_id_state', 2)
                ->orderBy('order.hour_order', 'asc')
                ->get()->getResultArray()
        );
    }
}
