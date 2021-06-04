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


        $dailyOrdersLocalState1 = $mdlOrder->where('date_order', $date)->where('typeshipping_id_typeshipping', 2)->where('state_id_state', 1)->orderBy('turnmachine_order', 'desc')->findAll();
        $dailyOrdersLocalState2 = $mdlOrder->where('date_order', $date)->where('typeshipping_id_typeshipping', 2)->where('state_id_state', 2)->orderBy('turnmachine_order', 'desc')->findAll();
        $dailyOrdersLocalState3 = $mdlOrder->where('date_order', $date)->where('typeshipping_id_typeshipping', 2)->where('state_id_state', 3)->orderBy('turnmachine_order', 'desc')->findAll();
        $dailyOrdersLocalState4 = $mdlOrder->where('date_order', $date)->where('typeshipping_id_typeshipping', 2)->where('state_id_state', 4)->orderBy('turnmachine_order', 'desc')->findAll();

        $dailyOrdersDomicilioState1 = $mdlOrder->where('date_order', $date)->where('typeshipping_id_typeshipping', 1)->where('state_id_state', 1)->orderBy('turnmachine_order', 'desc')->findAll();
        $dailyOrdersDomicilioState2 = $mdlOrder->where('date_order', $date)->where('typeshipping_id_typeshipping', 1)->where('state_id_state', 2)->orderBy('turnmachine_order', 'desc')->findAll();
        $dailyOrdersDomicilioState3 = $mdlOrder->where('date_order', $date)->where('typeshipping_id_typeshipping', 1)->where('state_id_state', 3)->orderBy('turnmachine_order', 'desc')->findAll();
        $dailyOrdersDomicilioState4 = $mdlOrder->where('date_order', $date)->where('typeshipping_id_typeshipping', 1)->where('state_id_state', 4)->orderBy('turnmachine_order', 'desc')->findAll();

        return view('admin/contents/list_order/view_main_list_order', [
            'dailyOrdersLocalState1' => $dailyOrdersLocalState1,
            'dailyOrdersLocalState2' => $dailyOrdersLocalState2,
            'dailyOrdersLocalState3' => $dailyOrdersLocalState3,
            'dailyOrdersLocalState4' => $dailyOrdersLocalState4,
            'dailyOrdersDomicilioState1' => $dailyOrdersDomicilioState1,
            'dailyOrdersDomicilioState2' => $dailyOrdersDomicilioState2,
            'dailyOrdersDomicilioState3' => $dailyOrdersDomicilioState3,
            'dailyOrdersDomicilioState4' => $dailyOrdersDomicilioState4,
        ]);
    }
}
