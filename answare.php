<?php include('server.php');
  if(isset($_POST['task_id']) && ($task = $_POST['task_id']) && isset($_POST['worker_id']) && ($worker = $_POST['worker_id']) &&
  isset($_POST['answare']) && ($ans = $_POST['answare']) && isset($_POST['campagne_id']) && $camp = $_POST['campagne_id'] ){
    $query = "INSERT INTO validita_task(task,worker,campagne,risposta) VALUES('$task','$worker','$camp','$ans')";
    mysqli_query($db,$query);
    header("location: task.php");
  }
 ?>
