<?php

namespace App\Controllers;



class Reports extends BaseController
{
    public function printOrder()
    {
        $pdf = new \FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(40, 10, '¡Hola, Mundo!');
        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output();
    }
}
