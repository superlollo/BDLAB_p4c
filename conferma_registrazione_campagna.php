<?php include('server.php');
    $id_c = $_GET['id'];
    $id_w = $_SESSION['id'];
    $query = "INSERT INTO registrazione(worker,campagna,score) VALUES('$id_w','$id_c',0)";
    mysqli_query($db,$query);
    header("location: task.php");
  
 ?>
