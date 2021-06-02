<?php

namespace App\Controllers;

use App\Models\DetailorderModel;
use App\Models\OrderModel;

class Listorders extends BaseController
{

    //--------------------------------------------------------------------
    public function view_main($date)
    {
        $mdlOrder = new OrderModel();
     

        $dailyOrders = $mdlOrder->where('date_order', $date)->findAll();

        $lista = array();

        return view('admin/contents/list_order/view_main_list_order', [
            'dailyorders' => dd($mdlOrder->where('date_order', $date)->findAll())
        ]);
    }
}
