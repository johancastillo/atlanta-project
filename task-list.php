<?php

  include('database.php');

  $query = "SELECT * FROM task";
  $result = mysqli_query($connection, $query);

  //Comprobar si no hay un resultado
  if(!$result){
    die("Query Failed. ".mysqli_error($connection));
  }

  //Convertir los resultados en un JSON
  $json = array();
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
      'name' => $row['name'],
      'description' => $row['description'],
      'id' => $row['id']
    );
  }
  //Codificar a un objeto JSON
  $jsonstring = json_encode($json);
  //Retornar JSON
  echo $jsonstring;

 ?>
