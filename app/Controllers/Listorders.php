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
     

        $dailyOrders = $mdlOrder->where('date_order', $date)->where('typeshipping_id_typeshipping',1)->orderBy('turnmachine_order','desc')->findAll();

        $lista = array();

        return view('admin/contents/list_order/view_main_list_order', [
            'dailyorders' => $dailyOrders
        ]);
    }
}
