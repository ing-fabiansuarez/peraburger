<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\OrderModel;
use App\Models\ProductModel;

class Informes extends BaseController
{
    public function generalReport($initialDate, $finalDate)
    {
        return view('admin/contents/informes/general_report', [
            'array_to_grafic' => $this->generateReportQuantitiesCategories($initialDate, $finalDate),
            'initial_date' => $initialDate,
            'final_date' => $finalDate,
            'sales_array'=>$this->generateSalesReport($initialDate, $finalDate)
        ]);
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

    public function generateReportQuantitiesCategories($initialDate, $finalDate)
    {

        $mdlCategory = new CategoryModel();
        $mdlProducts = new ProductModel();
        $mdlOrder = new OrderModel();

        $arrayCategories = array();
        $orders = $mdlOrder->where("date_order >= '" . $initialDate . "' AND date_order <= '" . $finalDate . "'")->findAll();
        foreach ($mdlCategory->findAll() as $category) {
            $arrayGrafic = array();
            $cadena = '';
            $cadenaQuantities = '';
            $productsStadistics = array();
            $totalProductsForCategory = 0;
            foreach ($mdlProducts->where('category_id_category', $category['id_category'])->findAll() as $product) {

                $cadena .= "'" . $product['name_product'] . "',";
                //calcular cuantas veces esta este producto en las ordenes consultadas.
                $quantityProduct = 0;
                foreach ($orders as $order) {
                    $quantityProduct += $order->getQuantityOfProducts($product['id_product']);
                }
                $cadenaQuantities .= "'" . $quantityProduct . "',";
                //total de productos por categoria
                $totalProductsForCategory += $quantityProduct;
                array_push($productsStadistics, [
                    'id_product' => $product['id_product'],
                    'name_product' => $product['name_product'],
                    'quantity_product' => $quantityProduct
                ]);
                //--------------------
            }
            //agregar informacion obtenida en un solo array
            $arrayGrafic = array_merge($arrayGrafic, ['cadenaproducts' => $cadena]);
            $arrayGrafic = array_merge($arrayGrafic, ['cadenaquantities' => $cadenaQuantities]);
            $arrayGrafic = array_merge($arrayGrafic, ['name_category' => $category['name_category']]);
            $arrayGrafic = array_merge($arrayGrafic, ['products_statidistics' => $productsStadistics]);
            $arrayGrafic = array_merge($arrayGrafic, ['totalProductsForCategory' => $totalProductsForCategory]);
            array_push($arrayCategories, $arrayGrafic);
        }

        return $arrayCategories;
    }

    public function generateSalesReport($initialDate, $finalDate)
    {
        $mdlOrder = new OrderModel();
        $orders = $mdlOrder->where("date_order >= '" . $initialDate . "' AND date_order <= '" . $finalDate . "'")->findAll();
        $fechaInicio = strtotime($initialDate);
        $fechaFin = strtotime($finalDate);
        $arrayResult = array();
        $cadena_x = '';
        $cadena_y = '';
        for ($i = $fechaInicio; $i <= $fechaFin; $i += 86400) {
            $dailyArray = array();
            $totalDia = 0;
            $fecha = date("d-m-Y", $i);
            foreach ($orders as $order) {
                if (strtotime($order->date_order) == $i) {
                    $totalDia += $order->getTotalWthitOutDomicilio();
                }
            }
            $cadena_x .= '"'.date("Y-m-d", $i) . '",';
            $cadena_y .= '"'.$totalDia . '",';
        }
        //agregan los datos obtenidos a un array
        $dailyArray = array_merge($dailyArray, ['cadena_x' => $cadena_x]);
        $dailyArray = array_merge($dailyArray, ['cadena_y' => $cadena_y]);
        

        return $dailyArray;
    }
}
