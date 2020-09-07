<?php

//Datos del formulario
$credito = $_POST['credito'];
$anos = $_POST['anos'];
$downpayment = $_POST['downpayment'];
$intereses = $_POST['intereses'];

//Load dependencies
require __DIR__.'/vendor/autoload.php';

//Namespace of the class
use Spipu\Html2Pdf\Html2Pdf;

//Import file "view.php"
ob_start();
require_once 'pdf.php';
$html = ob_get_clean();

$html2pdf = new Html2Pdf('P','','es','true','UTF-8');
$html2pdf->writeHTML($html);
$html2pdf->output("calculos-hipotecarios.pdf");

?>
