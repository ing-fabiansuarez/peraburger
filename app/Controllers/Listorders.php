<?php

namespace App\Controllers;

use App\Models\OrderModel;

class Listorders extends BaseController
{

    //--------------------------------------------------------------------
    public function view_main()
    {
        $mdlOrder = new OrderModel();
        dd($mdlOrder->where('date_order','2021-05-31')->findAll());

        return view('admin/contents/list_order/view_main_list_order',[
        ]);
    }
}
