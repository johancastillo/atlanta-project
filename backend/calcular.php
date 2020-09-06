<?php

  if(isset($_POST["credito"])){
    $credito = floatval($_POST["credito"]);
    $anos = floatval($_POST["anos"]);
    $intereses = floatval($_POST["intereses"]);
    $downpayment = floatval($_POST['downpayment']);
    $totalIntereses = 0;

    //Calcular el Down Payment y el Capital Inicial
    $capitalInicial = $credito;
    $downpayment = $downpayment * $credito / 100;

    //Nuevo valor de "credito"
    $credito = $credito - $downpayment;

    //Calculando los intereses
    $intereses = ($intereses / 100) / 12;

    $cuotaMensual = ($credito * $intereses * ( (1 + $intereses)**($anos * 12) )) / (( (1 + $intereses)**($anos * 12) ) - 1);


    //Table JSON
    $table = [];

    $capitalPendiente = $credito;

    for ($i = 1; $i <= $anos * 12; $i++) {
      $totalIntereses = $totalIntereses + ($credito * $intereses);
      $mes = $i;
      $intereses2 = $credito * $intereses;
      $amortizacion = ($cuotaMensual - ( $credito * $intereses));
      $credito = $credito - ( $cuotaMensual - ($credito * $intereses));;
      if ($credito<0){
        $capitalPendiente = "0";
      }else{
        $capitalPendiente = $credito;
      }

      if ($capitalPendiente < 0) {
        $capitalPendiente = 0;
        break;
      } else {
        $capitalPendiente = number_format($capitalPendiente,2,",",".")."$";
      }


      $objeto = [
        "mes" => $i,
        "intereses" => number_format($intereses2,2,',','.').'$',
        "amortizacion" => number_format($amortizacion,2,',','.').'$',
        "cuotaMensual" => number_format($cuotaMensual,2,',','.').'$',
        "capitalPendiente" => number_format($capitalPendiente,2,',','.').'$'
      ];

      array_push($table, $objeto);

    }

    //JSON 1
    $results = [
      'downpayment' => number_format($downpayment,2,',','.').'$',
      'capitalInicial' => number_format($capitalInicial,2,',','.').'$',
      'cuotaMensual' => number_format($cuotaMensual,2,',','.').'$',
      'totalIntereses' => number_format($totalIntereses,2,',','.').'$'
    ];

    $response = [
      "data" => $results,
      "table" => $table
    ];

    echo json_encode($response);

  }

?>
