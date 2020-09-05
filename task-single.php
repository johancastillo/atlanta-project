<?php

  include('database.php');

  if ($_POST['id']) {
    // code...
  }
  //Recibir ID del frontend
  $id = $_POST['id'];

  $query = "SELECT * FROM task WHERE id = $id";
  $result = mysqli_query($connection, $query);

  //Comprobación
  if(!result){
    die("Query Failed.");
  }

  //Conversión a JSON
  $json = array();

  while ($row = mysqli_fetch_array($result)) {
    $json[] = array(
        "name" => $row['name'],
        "description" => $row['description'],
        "id" => $row['id']
      );
  }

  $jsonstring = json_encode($json[0]);
  //Enviar JSON al Frontend
  echo $jsonstring;

 ?>
