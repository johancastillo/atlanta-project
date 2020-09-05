<?php

  if(isset($_POST["credito"])){
    $credito = floatval($_POST["credito"]);
    $anos = floatval($_POST["anos"]);
    $intereses = floatval($_POST["intereses"]);
    $downpayment = floatval($_POST['downpayment']);
    $totalin = 0;

    //Calculos
    $downpayment = $downpayment * $credito / 100;
    $credito = $credito - $downpayment;
    $capitalInicial = $credito + $downpayment;
    $intereses = ($intereses / 100) / 12;
    $m = ($credito * $intereses * ( (1+$intereses) ** ($anos*12) ) ) / (((1+$intereses)**($anos*12))-1);

    //Convertir resultados a formato moneda
    $downpayment = number_format($downpayment,2,',','.').'$';
    $capitalInicial = number_format($capitalInicial,2,',','.').'$';
    $cuotaMensual = number_format($m,2,',','.').'$';


    //JSON
    $results = [
      'downpayment' => $downpayment,
      'capitalInicial' => $capitalInicial,
      'cuotaMensual' => $cuotaMensual
    ];

    $json1 = json_encode($results);



    //echo $downpayment;
    echo $json1;

  }

?>
