<?php include('server.php');
        $id=$_GET['id'];
        $idw=$_SESSION['id'];
        $query="INSERT INTO svolge(task,worker) VALUES($id,$idw)";
        mysqli_query($db,
           $query) or die("Query fail: " . mysqli_error());
         header("location: task.php");
?>
