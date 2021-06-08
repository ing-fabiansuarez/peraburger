<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\ProductModel;

class Informes extends BaseController
{
    public function generalReport($initialDate, $finalDate){
    
        return view('admin/contents/informes/general_report');

    }


    public function dailyBox($date)
    {
        $mdlOrder = new OrderModel();
        $mdlProducts = new ProductModel();

        $list_orders = $mdlOrder->where('date_order', $date)->findAll();
        
        $totalSales = 0;
        $totalDomis = 0;
        $moneyOrdersLocal = 0;
        $moneyOrdersDomis = 0;
        $moneyOrdersDisabled = 0;
        $quantityOrdersLocal = 0;
        $quantityOrdersDomis = 0;
        $quantityOrdersDisabled = 0;

        foreach ($list_orders as $order) {
            if ($order->state_id_state == 3) {
                $totalSales += $order->getTotalWthitOutDomicilio();
                $totalDomis += $order->getDomicilio()['price_domicilio'];

                if ($order->typeshipping_id_typeshipping == 1) {
                    $moneyOrdersDomis += $order->getTotalWthitOutDomicilio();
                    $quantityOrdersDomis += 1;
                } else if ($order->typeshipping_id_typeshipping == 2) {
                    $moneyOrdersLocal += $order->getTotalWthitOutDomicilio();
                    $quantityOrdersLocal += 1;
                }
            } else if ($order->state_id_state == 4) {
                $moneyOrdersDisabled += $order->getTotalWthitOutDomicilio();
                $quantityOrdersDisabled += 1;
            }
        }

        return view('admin/contents/informes/daily_box', [
            'list_orders' => $list_orders,
            'all_products' => $mdlProducts->where('category_id_category', 1)->findAll(),
            'info' => [
                'totalSales' =>            $totalSales,
                'totalDomis' =>            $totalDomis,
                'moneyOrdersLocal' =>      $moneyOrdersLocal,
                'moneyOrdersDomis' =>      $moneyOrdersDomis,
                'moneyOrdersDisabled' =>   $moneyOrdersDisabled,
                'quantityOrdersLocal' =>   $quantityOrdersLocal,
                'quantityOrdersDomis' =>   $quantityOrdersDomis,
                'quantityOrdersDisabled' => $quantityOrdersDisabled,
            ]
        ]);
    }
}
