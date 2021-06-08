<?php

namespace App\Controllers;

use App\Models\ClientModel;
use App\Models\DetailorderModel;
use App\Models\DomicilioModel;
use App\Models\InfostateModel;
use App\Models\OrderModel;
use App\Models\TypeshippingModel;
use Exception;
use FFI;
use FPDF;

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

    public function printKitchen($REF)
    {
        //atributo del formularo
        //$REF = $this->request->getPostGet('reference');

        //declaracion de los modelos
        $mdlDetailOrder = new DetailorderModel();
        $mdlClient = new ClientModel();
        $mdlOrder = new OrderModel();
        $mdlType = new TypeshippingModel();
        $mdlInfoStates = new InfostateModel();

        //uso de los modelos
        $client = $mdlClient->find($REF);
        $list_of_products = $mdlDetailOrder->getListOrderByReference($REF);
        $order = $mdlOrder->find($REF);

        //pasar el estado de creado a la cocina
        try {
            $oldState = $order->state_id_state;
        } catch (Exception $e) {
            return redirect()->back()->with('error', [
                'title' => 'Alerta!',
                'body' => 'Problemas con la base de datos. <br> Error: ' . $e->getMessage()
            ]);
        }
        if ($oldState == 1) {
            try {
                $mdlOrder->update($order->id_order, [
                    'state_id_state' => 2
                ]);
                $mdlInfoStates->insert([
                    'id_infostates' => '',
                    'state_id_state' => 2,
                    'order_id_order' => $order->id_order,
                    'dateupdate_infostate' => date("Y-m-d H:i:s")
                ]);
            } catch (Exception $e) {
                return redirect()->back()->with('error', [
                    'title' => 'Alerta!',
                    'body' => 'Problemas con la base de datos. <br> Error: ' . $e->getMessage()
                ]);
            }
        } else {
            return redirect()->back()->with('error', [
                'title' => 'Alerta!',
                'body' => 'No se pudo pasar a la cocina ya que tiene un estado defirente a CREADO'
            ]);
        }


        /* *************************************************************************************
        *************************************************************************************
        CONTENIDO DEL PDF
        **************************************************************************************
        ************************************************************************************** */

        //Se declara la libreria
        $pdf = new PDF_AutoPrint("P", "mm", array(75, 150));
        //$pdf = new \FPDF("P", "mm", array(75, 150));
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
        $pdf->cell(69, 4, 'FORMATO DE COCINA', 'B', 1, 'C');
        $pdf->Ln(2);
        $pdf->cell(20, 4, 'TURNO:', 0, 0, 'L');
        $pdf->cell(10, 4, $order->turnmachine_order, 0, 0, 'L');
        $pdf->cell(39, 4, $mdlType->find($order->typeshipping_id_typeshipping)['name_typeshipping'], 0, 1, 'R');
        $pdf->Ln(2);
        $pdf->SetFont('Times', 'B', 9);
        $pdf->cell(69, 4, utf8_decode('N° ') . $REF, 0, 1, 'L');
        $pdf->SetFont('Times', 'B', 9);
        $pdf->Ln(1);
        $pdf->MultiCell(69, 4, utf8_decode('CLIENTE: ') . $client['name_client'] . ' ' . $client['surname_client'], 0, 'L');
        $pdf->Ln(2);
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
        if ($order->observations_order != '') {
            $pdf->cell(69, 4, utf8_decode('OBSERVACIÓN: '), 'TLR', 1, 'L');
            $pdf->MultiCell(69, 4, utf8_decode($order->observations_order), 'BLR', 'L');
            $pdf->cell(69, 4, ' ', 0, 1, 'R');
        }
        $pdf->cell(35, 4, 'PeRa Burger', 0, 0, 'L');
        $pdf->cell(34, 4, date('Y-m-d g:i a'), 0, 1, 'R');
        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->AutoPrint(true);
        $pdf->Output();

        /* *************************************************************************************
        *************************************************************************************
        FIN DEL CONTENIDO 
        **************************************************************************************
        ************************************************************************************** */
    }
    public function printSticker()
    {
        $mdlOrder = new OrderModel();
        $mdlClient = new ClientModel();
        $REF = $this->request->getPostGet('reference');
        $domicilio = $mdlOrder->find($REF)->getDomicilio();
        $client = $mdlClient->find($REF);

        //Se declara la libreria
        $pdf = new \FPDF("P", "mm", array(279, 216));
        $pdf->AddPage();
        //Margenes del archivo
        $pdf->SetMargins(0, 0, 0);
        //Establecemos el margen inferior
        $pdf->SetAutoPageBreak(true, 0);

        $pdf->SetFont('ZapfDingbats', 'B', 9);

        // CONTENIDO DE LA PAGINA
        $pdf->cell(50, 10, '', 0, 1, 'C');
        $pdf->Image(base_url() . '/public/admin/dist/img/others/stikersdomi1.jpeg', 5, 0, 208);

        //dd($domicilio);

        $pdf->SetFont('Helvetica', 'B', 25);
        $pdf->ln(35);
        $pdf->cell(85, 10, '', 0, 0, 'L');
        $pdf->MultiCell(120, 10, utf8_decode($client['name_client'] . ' ' . $client['surname_client']), 0, 'C');
        $pdf->Ln(3);
        $pdf->cell(90, 10, '', 0, 0, 'L');
        $pdf->MultiCell(115, 10, utf8_decode('Dirección:'), 0, 'L');
        $pdf->Ln(3);
        $pdf->SetFont('Arial', '', 22);
        $pdf->cell(95, 10, '', 0, 0, 'L');
        $pdf->MultiCell(105, 10, utf8_decode($domicilio['address_domicilio']), 'TLR', 'L');
        $pdf->cell(95, 10, '', 0, 0, 'L');
        $pdf->MultiCell(105, 10,  utf8_decode('Barrio ' . $domicilio['neighborhood_domicilio']), 'BLR', 'L');
        $pdf->Ln(8);
        $pdf->SetFont('Helvetica', 'B', 25);
        $pdf->cell(90, 10, '', 0, 0, 'L');
        $pdf->MultiCell(115, 10, utf8_decode('Telefono:'), 0, 'L');
        $pdf->Ln(3);
        $pdf->SetFont('Arial', '', 22);
        $pdf->cell(95, 10, '', 0, 0, 'L');
        $pdf->MultiCell(105, 10,  utf8_decode($domicilio['whatsapp_domicilio']), 1, 'L');

        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output();
    }
}

class PDF_JavaScript extends FPDF
{
    var $javascript;
    var $n_js;
    function IncludeJS($script)
    {
        $this->javascript = $script;
    }
    function _putjavascript()
    {
        $this->_newobj();
        $this->n_js = $this->n;
        $this->_out('<<');
        $this->_out('/Names [(EmbeddedJS) ' . ($this->n + 1) . ' 0 R]');
        $this->_out('>>');
        $this->_out('endobj');
        $this->_newobj();
        $this->_out('<<');
        $this->_out('/S /JavaScript');
        $this->_out('/JS ' . $this->_textstring($this->javascript));
        $this->_out('>>');
        $this->_out('endobj');
    }
    function _putresources()
    {
        parent::_putresources();
        if (!empty($this->javascript)) {
            $this->_putjavascript();
        }
    }
    function _putcatalog()
    {
        parent::_putcatalog();
        if (!empty($this->javascript)) {
            $this->_out('/Names <</JavaScript ' . ($this->n_js) . ' 0 R>>');
        }
    }
}
/****************************************************************/

/*************** Clase PDF_AutoPrint basandose en PDF_JavaScript *************/
class PDF_AutoPrint extends PDF_JavaScript
{
    function AutoPrint($dialog = false)
    {
        $param = ($dialog ? 'true' : 'false');
        $script = "print($param);";
        $this->IncludeJS($script);
    }

    function AutoPrintToPrinter($server, $printer, $dialog = false)
    {
        $script = "var pp = getPrintParams();";
        if ($dialog)
            $script .= "pp.interactive = pp.constants.interactionLevel.full;";
        else
            $script .= "pp.interactive = pp.constants.interactionLevel.automatic;";
        $script .= "pp.printerName = '\\\\\\\\" . $server . "\\\\" . $printer . "';";
        $script .= "print(pp);";
        $this->IncludeJS($script);
    }
}
