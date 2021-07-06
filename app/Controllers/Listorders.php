<?php

namespace App\Controllers;

use App\Models\DetailorderModel;
use App\Models\OrderModel;

class Listorders extends BaseController
{

    //--------------------------------------------------------------------
    public function view_main($state, $date)
    {

        $mdlOrder = new OrderModel();
        $dailyOrdersLocal = $mdlOrder->where('date_order', $date)->where('typeshipping_id_typeshipping', 2)->where('state_id_state', $state)->orderBy('hour_order', 'asc')->findAll();
        $dailyOrdersDomicilio = $mdlOrder->where('date_order', $date)->where('typeshipping_id_typeshipping', 1)->where('state_id_state', $state)->orderBy('hour_order', 'asc')->findAll();
        switch ($state) {
            case 1:
                return view('admin/contents/list_order/view_main_state1', [
                    'date' => $date,
                    'dailyOrdersLocal' => $dailyOrdersLocal,
                    'dailyOrdersDomicilio' => $dailyOrdersDomicilio
                ]);
                break;
            case 2:
                return view('admin/contents/list_order/view_main_state2', [
                    'date' => $date,
                    'dailyOrdersLocal' => $dailyOrdersLocal,
                    'dailyOrdersDomicilio' => $dailyOrdersDomicilio
                ]);
                break;
            case 3:
                return view('admin/contents/list_order/view_main_state3', [
                    'date' => $date,
                    'dailyOrdersLocal' => $dailyOrdersLocal,
                    'dailyOrdersDomicilio' => $dailyOrdersDomicilio
                ]);
                break;
            case 4:
                return view('admin/contents/list_order/view_main_state4', [
                    'date' => $date,
                    'dailyOrdersLocal' => $dailyOrdersLocal,
                    'dailyOrdersDomicilio' => $dailyOrdersDomicilio
                ]);
                break;
        }
    }
}
