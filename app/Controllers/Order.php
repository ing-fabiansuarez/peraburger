<?php

namespace App\Controllers;

use App\Models\CategoryModel;

class Order extends BaseController
{
   
    public function viewCreateOrder()
    {
        $mdlCategory  = new CategoryModel();
        return view('admin/contents/order/view_createorder',[
            'categories' => $mdlCategory->findAll()
        ]);
    }
}
