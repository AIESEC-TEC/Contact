<?php
//============================================================+
// File name   : example_011.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 011 for TCPDF class
//               Colored Table (very simple table)
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Colored Table
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');
include_once("../../config/conector.php");
include("../../config/conexion.php");
$bd = new conector($server,$username,$usrpassword,$dbname);

// extend TCPF with custom functions
class MYPDF extends TCPDF {

    // Load table data from file
    public function LoadData($file) {
        // Read file lines
        $lines = file($file);
        $data = array();
        foreach($lines as $line) {
            $data[] = explode(';', chop($line));
        }
        return $data;
    }

    // Colored table
    public function ColoredTable($header,$data) {
        // Colors, line width and bold font
        $this->SetFillColor(93,123,139);
        $this->SetTextColor(255);
        $this->SetDrawColor(16, 78, 139);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        // Header
        $w = array(7, 34, 23, 23, 20, 50, 50, 50,40, 30, 50, 20,15);
		//374
		// 259 = 100% de hoja
        $num_headers = count($header);
		$ancho = 0;
        for($i = 0; $i < $num_headers; ++$i) {
			if ($header[$i] == "#" || $header[$i] == "Name") {
	            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
				$ancho+=$w[$i];
			}
			if ($header[$i] == "phone" || $header[$i] == "cellphone") {
	            $this->Cell(23, 7, $header[$i], 1, 0, 'C', 1);
				$ancho+=23;
			}
			if ($header[$i] == "nationality" || $header[$i] == "aiesecposition") {
	            $this->Cell(20, 7, $header[$i], 1, 0, 'C', 1);
				$ancho+=20;
			}
			if ($header[$i] == "email" || $header[$i] == "aiesecemail" || $header[$i] == "outlook") {
	            $this->Cell(50, 7, $header[$i], 1, 0, 'C', 1);
				$ancho+=50;
			}
			if ($header[$i] == "university" ) {
	            $this->Cell(50, 7, $header[$i], 1, 0, 'C', 1);
				$ancho+=50;
			}
			if ( $header[$i] == "area" ) {
	            $this->Cell(15, 7, $header[$i], 1, 0, 'C', 1);
				$ancho+=15;
			}
			if ($header[$i] == "profesion") {
	            $this->Cell(40, 7, $header[$i], 1, 0, 'C', 1);
				$ancho+=40;
			}
			if ($header[$i] == "skype") {
	            $this->Cell(30, 7, $header[$i], 1, 0, 'C', 1);
				$ancho+=30;
			}
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = 0;
		$contador = 2;
        foreach($data as $row) {
			// CONTADOR
            $this->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
			// NAME & LASTNAME
            $this->Cell($w[1], 6, $row[1], 'LR', 0, 'L', $fill);
			// PHONE
			if(in_array("phone",$header)){
            	$this->Cell($w[2], 6, $row[$contador], 'LR', 0, 'R', $fill);
				$contador++;
			}
			// CELLPHONE
			if(in_array("cellphone",$header)){
				$this->Cell($w[3], 6, $row[$contador], 'LR', 0, 'R', $fill);
				$contador++;
			}
			// NATIONALITY
			if(in_array("nationality",$header)){
	            $this->Cell($w[4], 6, $row[$contador], 'LR', 0, 'R', $fill);
				$contador++;
			}
			// AIESEC EMAIL
			if(in_array("aiesecemail",$header)){
				$this->Cell($w[5], 6, $row[$contador], 'LR', 0, 'R', $fill);
				$contador++;
			}
			// EMAIL
			if(in_array("email",$header)){
				$this->Cell($w[6], 6, $row[$contador], 'LR', 0, 'R', $fill);
				$contador++;
			}
			// UNIVERSITY
			if(in_array("university",$header)){
				$universidad = substr($row[$contador],0,15);
				$this->Cell($w[7], 6, utf8_decode($universidad), 'LR', 0, 'R', $fill);
				$contador++;
			}
			// PROFESION
			if(in_array("profesion",$header)){
				$profesion = substr(utf8_decode($row[$contador]),0,22);
				$this->Cell($w[8], 6, $profesion, 'LR', 0, 'R', $fill);
				$contador++;
			}
			// SKYPE
			if(in_array("skype",$header)){
				$this->Cell($w[9], 6, $row[$contador], 'LR', 0, 'R', $fill);
				$contador++;
			}
			// OUTLOOK
			if(in_array("outlook",$header)){
				$this->Cell($w[10], 6, $row[$contador], 'LR', 0, 'R', $fill);
				$contador++;
			}
			// AIESEC POSITION
			if(in_array("aiesecposition",$header)){
				$this->Cell($w[11], 6, $row[$contador], 'LR', 0, 'R', $fill);
				$contador++;
			}
			// AREA
			if(in_array("area",$header)){
				$this->Cell($w[12], 6, $row[$contador], 'LR', 0, 'R', $fill);
				$contador++;
			}
			$contador = 2;
            $this->Ln();
            $fill=!$fill;
        }
		$this->Cell($ancho, 6, "Information exported from aiesectec.org. Date: ".date("d/m/y"), 'LR', 0, 'R', $fill);
		$this->Ln();
		$fill=!$fill;
        $this->Cell($ancho, 0, '', 'T');
    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF Example 011');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 011', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/spa.php')) {
    require_once(dirname(__FILE__).'/lang/spa.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 8);

// add a page
$pdf->AddPage();

$contador = 1;
$consulta="";
$header = array("#","Name");
if( isset($_POST['variablesEx']) && is_array($_POST['variablesEx']) ) {
    foreach($_POST['variablesEx'] as $variable) {
		array_push($header,$variable);
		$consulta=$consulta.$variable.",";
    }
	$consulta = substr($consulta,0,strlen($consulta)-1);
}
// Para realizar consulta
if(count($header) == 2 ) {
	$coma = "";
}
else{
	$coma = ",";
}
$data = array();
$filtro = $_POST["filtro"];
if ($filtro == "all"){
	$filtro = "ORDER BY area";
}
else {
	$filtro = "WHERE area='".$filtro."'";
}
if ($result = $bd->query("SELECT name,lastname".$coma.$consulta." FROM names ".$filtro."")) {
	while ($row = $result->fetch_array(MYSQLI_ASSOC)){
		$temp = array();
		array_push($temp,$contador);
		$contador++;
		$nombreapellido = utf8_decode($row["name"]).' '.utf8_decode($row["lastname"]);
		$nombre = substr($nombreapellido,0,22);
		array_push($temp,$nombre);
		if(in_array("phone",$header)){
			array_push($temp,str_replace(' ', '',$row["phone"]));
		}
		if(in_array("cellphone",$header)){
			array_push($temp,str_replace(' ', '',$row["cellphone"]));
		}
		if(in_array("nationality",$header)){
			array_push($temp,utf8_decode($row["nationality"]));
		}
		if(in_array("aiesecemail",$header)){
			array_push($temp,$row["aiesecemail"]);
		}
		if(in_array("email",$header)){
			array_push($temp,$row["email"]);
		}
		if(in_array("university",$header)){
			array_push($temp,$row["university"]);
		}
		if(in_array("profesion",$header)){
			array_push($temp,$row["profesion"]);
		}
		if(in_array("skype",$header)){
			array_push($temp,$row["skype"]);
		}
		if(in_array("outlook",$header)){
			array_push($temp,$row["outlook"]);
		}
		if(in_array("aiesecposition",$header)){
			array_push($temp,$row["aiesecposition"]);
		}
		if(in_array("area",$header)){
			array_push($temp,$row["area"]);
		}
		array_push($data,$temp);
	}
	/* free result set */
	$result->close();
}

// print colored table
$pdf->ColoredTable($header, $data);

// ---------------------------------------------------------

// close and output PDF document
$pdf->Output('../../pdf/AIESEC-TEC-Members.pdf', 'D');

//============================================================+
// END OF FILE
//============================================================+