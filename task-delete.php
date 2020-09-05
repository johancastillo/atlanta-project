<?php

  include('database.php');

  if(isset($_POST['id'])){
    //Recibir ID del frontend
    $id = $_POST['id'];

    $query = "DELETE FROM task WHERE id = $id";
    $result = mysqli_query($connection, $query);

    //Comprobación de un resultado
    if(!$result){
      die("Query Failed.");
    }

    //Si la operacion ha sido exitosa
    echo "Task Delete Successfully";

  }

 ?>
