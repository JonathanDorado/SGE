<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
// Incluimos el archivo fpdf
//require_once APPPATH . "/third_party/fpdf/fpdf.php";
require_once APPPATH . "/third_party/fpdf/FpdfBarcode.php";

//Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
class Pdf extends FpdfBarcode {

    public function __construct() {
        parent::__construct();
    }

// El encabezado del PDF
    public function Header() {
//            $this->SetFont('Arial','',60);
//            $this->Cell(30);
//            $this->MultiCell(50,280,'Jonathan Steven Dorado Suarez',1,0,'C');
//            $this->Ln(20);
//
//            $this->SetFont('Arial','I',25);
//            $this->Cell(30);
////            $this->Cell(150,10,'Fecha: '.date("Y-m-d"),0,0,'R');
//            $this->Ln(25);
    }

    public function getEscarapela($event, $client) {
        $this->Ln(90);
        $this->SetFont('Arial', 'B', 45);
//        $this->MultiCell(0, 20, 'SIMON JOSE ANTONIO DE LA SANTISIMA TRINIDAD BOLIVAR', 0, 'C');
        $this->MultiCell(0, 20, utf8_decode($client[0]->name) . " " . utf8_decode($client[0]->lastname), 0, 'C');
        $this->Ln(5);
        $this->SetFont('Arial', '', 35);
        $this->MultiCell(0, 20, utf8_decode($client[0]->company), 0, 'C');
//        $this->Ln(5);
//        $this->SetFont('Arial', '', 30);
//        $this->MultiCell(0, 20, $event[0]->name, 0, 'C');
        $this->SetXY(90, 180);
//        $this->code128(15, 15, 'HORIZONTAL CODE', 85, 10, false);
        $this->MultiCell(0, 20, $this->Image('uploads/qr_codes/' . $event[0]->event_id . "_" . $client[0]->document_number . ".png", $this->GetX() - 20 + 1, $this->GetY() - 10 + 1, 80, 80), 0, 'C');
    }

    public function getCertificate($event, $client, $event_client_payment) {
        $this->Ln(50);
        $this->SetFont('Arial', 'B', 30);
//        $this->MultiCell(0, 10, 'SIMON JOSE ANTONIO DE LA SANTISIMA TRINIDAD BOLIVAR', 0, 'C');
        $this->MultiCell(0, 20, utf8_decode($client[0]->name) . " " . utf8_decode($client[0]->lastname), 0, 'C');
        $this->Ln(0);
        $this->SetFont('Arial', '', 14);
        $this->MultiCell(0, 10, utf8_decode($client[0]->document_type) . " " . utf8_decode($client[0]->document_number), 0, 'C');
        $this->Ln(10);
        $this->SetFont('Arial', '', 30);
        $this->MultiCell(0, 20, utf8_decode($event[0]->name), 0, 'C');
        $this->SetFont('Arial', '', 14);
        $this->MultiCell(0, 10, 'Realizado en ' . utf8_decode($event[0]->city) . ', Colombia a los ' . date("d", strtotime($event[0]->date_from)) . utf8_decode(' días del mes de ' . translateMonth(date("F", strtotime($event[0]->date_from))) . ' del año ' . date("Y", strtotime($event[0]->date_from))), 0, 'C');
        $this->SetFont('Arial', '', 14);
        $this->MultiCell(0, 8, 'Intensidad Horaria: ' . $event[0]->total_hours . ' Horas', 0, 'C');
    }

    public function getCertificateCurse($event, $client, $event_client_payment, $topic) {
        $this->Ln(50);
        $this->SetFont('Arial', 'B', 30);
//        $this->MultiCell(0, 10, 'SIMON JOSE ANTONIO DE LA SANTISIMA TRINIDAD BOLIVAR', 0, 'C');
        $this->MultiCell(0, 20, utf8_decode($client[0]->name) . " " . utf8_decode($client[0]->lastname), 0, 'C');
        $this->Ln(0);
        $this->SetFont('Arial', '', 14);
        $this->MultiCell(0, 10, utf8_decode($client[0]->document_type) . " " . utf8_decode($client[0]->document_number), 0, 'C');
        $this->Ln(10);
        $this->SetFont('Arial', '', 30);
        $this->MultiCell(0, 20, utf8_decode($topic), 0, 'C');
        $this->SetFont('Arial', '', 14);
        $this->MultiCell(0, 10, 'Realizado en ' . utf8_decode($event[0]->city) . ', Colombia a los ' . date("d", strtotime($event[0]->date_from)) . utf8_decode(' días del mes de ' . translateMonth(date("F", strtotime($event[0]->date_from))) . ' del año ' . date("Y", strtotime($event[0]->date_from))), 0, 'C');
        $this->SetFont('Arial', '', 14);
        $this->MultiCell(0, 8, 'Intensidad Horaria: ' . $event[0]->total_hours . ' Horas', 0, 'C');
    }

    public function getCertificateAssistance($event, $client, $event_client_payment) {
        $this->Ln(50);
        $this->SetFont('Arial', 'B', 14);
        $this->MultiCell(0, 0, utf8_decode('El Consejo Colombiano de Seguridad'), 0, 'C');
        $this->Ln(20);
        $this->MultiCell(0, 0, utf8_decode('CERTIFICA QUE'), 0, 'C');
        $this->Ln(30);
        $this->SetFont('Arial', '', 12);
        $this->SetX(20);
        $this->MultiCell(170, 8, utf8_decode($client[0]->name . ' ' . $client[0]->lastname . ' identificado con la cédula de ciudadanía No. ' . utf8_decode($client[0]->document_number) . ', asistió al evento ' . utf8_decode($event[0]->name) . ', desarrollado a los ' . date("d", strtotime($event[0]->date_from)) . ' días del mes de ' . translateMonth(date("F", strtotime($event[0]->date_from))) . ' del año ' . date("Y", strtotime($event[0]->date_from)) . ' en la ciudad de ' . $event[0]->city . ', Colombia con una intensidad de ' . $event[0]->total_hours . ' horas.'), 0, 'J');
        $this->Ln(10);
        $this->SetX(20);
        $this->MultiCell(0, 8, utf8_decode('Esta certificación se expide a solicitud del interesado(a) el ' . date("d") . ' de ' . translateMonth(date("F")) . ' del ' . date("Y")) . '.', 0, 'J');
        $this->Ln(20);
        $this->SetX(20);
        $this->MultiCell(0, 0, utf8_decode('Cordialmente,'), 0, 'J');
        $this->Ln(65);
        $this->MultiCell(0, 0, utf8_decode('Silvia Marcela Casas Arévalo'), 0, 'C');
        $this->Ln(8);
        $this->SetFont('Arial', '', 12);
        $this->MultiCell(0, 0, utf8_decode('Coordinadora de Capacitaciones y Eventos'), 0, 'C');
    }

//
//    // El pie del pdf
//    public function Footer() {
//        $this->SetY(-15);
//        $this->SetFont('Arial', 'I', 30);
//        //$this->Cell(10,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
//    }
}

function translateMonth($month) {
    switch ($month) {
        case "January":
            $month_spanish = "Enero";
            break;
        case "February":
            $month_spanish = "Febrero";
            break;
        case "March":
            $month_spanish = "Marzo";
            break;
        case "April":
            $month_spanish = "Abril";
            break;
        case "May":
            $month_spanish = "Mayo";
            break;
        case "June":
            $month_spanish = "Junio";
            break;
        case "July":
            $month_spanish = "Julio";
            break;
        case "August":
            $month_spanish = "Agosto";
            break;
        case "September":
            $month_spanish = "Septiembre";
            break;
        case "October":
            $month_spanish = "Ocutbre";
            break;
        case "November":
            $month_spanish = "Noviembre";
            break;
        case "December":
            $month_spanish = "Diciembre";
            break;
    }

    return $month_spanish;
}

?>