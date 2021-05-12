<?php

namespace App\Controllers;

class Order extends BaseController
{
   
    public function viewCreateOrder()
    {
        return view('admin/contents/order/view_createorder');
    }
}
