<?php include('server.php');
  if(isset($_GET['mail']) && ($mail = $_GET['mail']) && isset($_GET['token']) && $token = $_GET['token'] ){
    $query= "SELECT * from requester where email='$mail' and verification_token='$token'";
    $res= mysqli_query($db,$query);
    $result= mysqli_num_rows($res);
    if($result == 1){
      echo 'OK';
    }else{
      echo 'NOK';
    }
    if($result>0){
      $query="UPDATE requester set verification_token = null where email='$mail' and verification_token='$token'";
      mysqli_query($db,$query);
    }
  }
 ?>
