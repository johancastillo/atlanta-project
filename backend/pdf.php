<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Resultado PDF</title>
    <style>
      /* Tabla */
      table{
        text-align: center;
        margin: auto;
        width: 100%;
        background-color: white;
        border-collapse: collapse;
      }
      th, td{
        padding: 10px;
      }

    </style>
  </head>
  <body>
    <img style="width:100%; height:100px" src="./../assets/img/barra.jpg">
    <h1 style="text-align:center">Calculos Hipotecarios</h1>

    <?php if(isset($_POST['credito'])){
      //Variables
      $credito = floatval($_POST['credito']);
      $anos = floatval($_POST["anos"]);
      $intereses = floatval($_POST["intereses"]);
      $totalintereses = 0;
      $downpayment = "";

      if(isset($_POST['downpayment'])){
        $downpayment = floatval($_POST['downpayment']);
        $downpayment = $downpayment * $credito / 100;
        $credito= $credito - $downpayment;
        $capitalInicial = $credito + $downpayment;
      }


      // hacemos los calculos...
      $intereses = ($intereses / 100) / 12;
      $m = ($credito * $intereses * (pow( (1 + $intereses),($anos*12))))/((pow((1+$intereses),($anos*12)))-1);

      //Mostramos los resultados
      echo '<p style="text-align:center">'.'Capital inicial: '.number_format($capitalInicial,2,',','.').'$
      <br>
      Down Payment: '.number_format($downpayment,2,',','.').'$
      <br>
      Cuota a pagar mensualmente: '.number_format($m,2,',','.').'$
      </p>';
    }?>



  <table cellspacing="0" cellpadding="5" border="1">

      <thead>
        <tr>

            <th>Mes</th>

            <th>Intereses</th>

            <th>Amortización</th>

            <th>Cuota Mensual</th>

            <th>Capital Pendiente</th>

        </tr>
      </thead>
        <tbody>
          <?php

          // mostramos todos los meses...

          for ($i = 1; $i <= $anos * 12 ; $i++) {

              echo "<tr>";

                  echo "<td>".$i."</td>";

                  $totalintereses = $totalintereses + ( $credito * $intereses );

                  //Intereses
                  echo "<td>".number_format($credito * $intereses,2,",",".")."$</td>";

                  //Amortización
                  echo "<td>".number_format($m - ( $credito * $intereses),2,",",".")."$</td>";

                  //Cuot mensual
                  echo "<td>".number_format($m,2,',','.').'$</td>';

                  //Deuda
                  $credito = $credito - ($m - ( $credito * $intereses));

                  if ($credito < 0) {
                      echo "<td>0$</td>";
                  } else {
                      echo "<td>".number_format($credito,2,",",".")."$</td>";
                  }

              echo "</tr>";
          }

          ?>
        </tbody>
    </table>

    <p style="text-align:center">Pago total de intereses: <?php echo number_format($totalintereses,2,",",".")?> $</p>

  </body>
</html>
