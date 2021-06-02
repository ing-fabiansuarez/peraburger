<?php

namespace App\Controllers;

use App\Models\ClientModel;
use App\Models\DetailorderModel;
use App\Models\OrderModel;
use App\Models\TypeshippingModel;

class Reports extends BaseController
{
    public function printOrder()
    {
        $mdlDetailOrder = new DetailorderModel();
        $mdlClient = new ClientModel();
        $REF = $this->request->getPostGet('reference');
        $list_of_products = $mdlDetailOrder->getListOrderByReference($REF);

        //Se declara la libreria
        $pdf = new \FPDF("P", "mm", array(75, 150));
        $pdf->AddPage();

        //Margenes del archivo
        $pdf->SetMargins(3, 3, 3);
        //Establecemos el margen inferior
        $pdf->SetAutoPageBreak(true, 5);

        $pdf->SetFont('Times', 'B', 9);

        // CONTENIDO DE LA PAGINA
        $pdf->cell(50, 10, '', 0, 1, 'C');
        $pdf->Image(base_url() . '/public/img/peraburgelogo1.png', 13, 1, 50);
        $pdf->cell(69, 4, 'NIT: 901478708-6', 0, 1, 'C');
        $pdf->cell(69, 4, 'CL 5 4 31 BRR CENTRO', 0, 1, 'C');
        $pdf->cell(69, 4, 'Pamplona - Norte de Santander', 0, 1, 'C');
        $pdf->cell(69, 4, 'Agente Responsable de Impuesto al Consumo', 0, 1, 'C');
        $pdf->cell(69, 4, utf8_decode('N° ') . $REF, 0, 1, 'C');
        $pdf->cell(69, 4, '', 0, 1, 'C');
        $client = $mdlClient->find($REF);
        $pdf->SetFont('Times', 'B', 8);
        $pdf->cell(69, 4, utf8_decode('Señ@r: ') . $client['name_client'] . ' ' . $client['surname_client'], 0, 1, 'L');
        $pdf->SetFont('Times', 'B', 9);
        $pdf->cell(69, 4, '', 0, 1, 'C');
        $pdf->cell(10, 4, 'Cant.', 'BT', 0, 'C');
        $pdf->cell(39, 4, utf8_decode('Descripción'), 'BT', 0, 'C');
        $pdf->cell(20, 4, utf8_decode('Precio'), 'BT', 1, 'C');

        $total = 0;
        foreach ($list_of_products as $item_list) {
            $discount = 0;
            foreach ($item_list['whitout'] as $whitout) {
                $discount += ($whitout['price_ingredient'] * $item_list['quantity_detailorder']);
                $total -=  ($whitout['price_ingredient'] * $item_list['quantity_detailorder']);
            }

            $pdf->cell(10, 4, $item_list['quantity_detailorder'], 0, 0, 'C');
            $pdf->cell(39, 4,  $item_list['name_product'], 0, 0, 'L');
            $pdf->cell(20, 4, '$ ' . (($item_list['priceunit_detailorder'] * $item_list['quantity_detailorder']) - $discount), 0, 1, 'R');
            $total += ($item_list['priceunit_detailorder'] * $item_list['quantity_detailorder']);
        }
        $pdf->cell(10, 4, '', 'T', 0, 'C');
        $pdf->cell(39, 4, utf8_decode('TOTAL'), 'T', 0, 'C');
        $pdf->cell(20, 4, '$ ' . number_format($total), 'T', 1, 'R');

        $pdf->cell(10, 4, '', 0, 1, 'C');
        $pdf->cell(39, 4, '', 0, 1, 'C');

        $pdf->cell(35, 4, 'PeRa Burger', 0, 0, 'L');
        $pdf->cell(34, 4, date('Y-m-d g:i a'), 0, 1, 'R');


        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output();
    }

    public function printKitchen()
    {
        //atributo del formularo
        $REF = $this->request->getPostGet('reference');

        //declaracion de los modelos
        $mdlDetailOrder = new DetailorderModel();
        $mdlClient = new ClientModel();
        $mdlOrder = new OrderModel();
        $mdlType = new TypeshippingModel();

        //uso de los modelos
        $client = $mdlClient->find($REF);
        $list_of_products = $mdlDetailOrder->getListOrderByReference($REF);
        $order = $mdlOrder->find($REF);

        //Se declara la libreria
        $pdf = new \FPDF("P", "mm", array(75, 150));
        $pdf->AddPage();

        //Margenes del archivo
        $pdf->SetMargins(3, 3, 3);
        //Establecemos el margen inferior
        $pdf->SetAutoPageBreak(true, 5);

        $pdf->SetFont('Times', 'B', 9);

        // CONTENIDO DE LA PAGINA

        $pdf->Image(base_url() . '/public/img/peraburgelogo1.png', 3, 1, 30);


        $pdf->cell(50, 1, '', 0, 1, 'C');


        $pdf->SetFont('Times', 'B', 12);
        $pdf->cell(20, 4, 'TURNO:', 0, 0, 'L');
        $pdf->cell(10, 4, $order->turnmachine_order, 0, 0, 'L');

        $pdf->cell(39, 4, $mdlType->find($order->typeshipping_id_typeshipping)['name_typeshipping'], 0, 1, 'R');
        $pdf->cell(69, 4, utf8_decode('N° ') . $REF, 0, 1, 'C');
        $pdf->SetFont('Times', 'B', 8);
        $pdf->cell(69, 4, utf8_decode('CLIENTE: ') . $client['name_client'] . ' ' . $client['surname_client'], 0, 1, 'L');
        $pdf->SetFont('Times', 'B', 12);
        $pdf->cell(69, 3, '', 0, 1, 'C');
        $pdf->cell(69, 4, 'Formato de Cocina', 0, 1, 'C');
        $pdf->SetFont('Times', 'B', 9);
        $pdf->cell(69, 4, '', 0, 1, 'C');
        $pdf->cell(10, 4, 'Cant.', 'BT', 0, 'C');
        $pdf->cell(39, 4, utf8_decode('Descripción'), 'BT', 0, 'C');
        $pdf->cell(20, 4, utf8_decode('Hecho'), 'BT', 1, 'C');


        foreach ($list_of_products as $item_list) {
            $pdf->SetFont('Times', 'B', 9);
            $pdf->cell(10, 4, $item_list['quantity_detailorder'], 0, 0, 'C');
            $pdf->cell(39, 4,  $item_list['name_product'], 'R', 1, 'L');


            foreach ($item_list['whitout'] as $whitout) {
                $pdf->SetFont('Times', '', 8);

                $pdf->cell(49, 4, 'Sin ' . $whitout['name_ingredient'], 'R', 1, 'R');
            }
            $pdf->cell(49, 2, '', 'TR', 0, 'R');
            $pdf->cell(20, 2, '', 'T', 1, 'R');
        }


        $pdf->cell(69, 4, ' ', 0, 1, 'R');



        $pdf->cell(35, 4, 'PeRa Burger', 0, 0, 'L');
        $pdf->cell(34, 4, date('Y-m-d g:i a'), 0, 1, 'R');


        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output();
    }
}
