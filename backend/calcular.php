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



    //echo $downpayment;
    echo $credito;
  }

?>
