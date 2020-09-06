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


    //JSON 1
    $results = [
      'downpayment' => $downpayment,
      'capitalInicial' => $capitalInicial,
      'cuotaMensual' => $cuotaMensual
    ];

    //Table JSON
    $table = [];

    $capitalPendiente = $credito;

    for ($i = 1; $i <= $anos * 12 ; $i++) {
      $mes = $i;
      $intereses2 = number_format($credito * $intereses,2,",",".")."$";
      $amortizacion = number_format($m - ( $credito * $intereses),2,",",".")."$";

      $capitalPendiente = $capitalPendiente - ($m - ( $capitalPendiente * $intereses2));

      if ($capitalPendiente < 0) {
        $capitalPendiente = 0;
      } else {
        $capitalPendiente = number_format($capitalPendiente,2,",",".")."$";
      }

      $totalint = $totalint + ( $credito * $intereses );
      $totalIntereses = number_format($totalint,2,",",".").'$';

      $objeto = [
        "mes" => $i,
        "intereses" => $intereses2,
        "amortizacion" => $amortizacion,
        "cuotaMensual" => $cuotaMensual,
        "capitalPendiente" => $capitalPendiente
      ];

      array_push($table, $objeto);

    }

    $response = [
      "data" => $results,
      "table" => $table
    ];

    echo json_encode($response);

  }

?>
