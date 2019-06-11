<?php include('server.php') ?>
<!doctype html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="//cdn.muicss.com/mui-0.9.41/css/mui.min.css" rel="stylesheet" type="text/css" />
    <script src="//cdn.muicss.com/mui-0.9.41/js/mui.min.js"></script>
    <link href="//cdn.muicss.com/mui-0.9.41/css/mui.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

  </head>
  <body>
    <header id="head">
      <div class="mui-appbar">
        <table width="100%">
          <tr style="vertical-align:middle;">
          </tr>
        </table>
      </div>
    </header>
    <br>
    <h3>Task compatibili: </h3>
    <?php
    $id = $_GET['id'];
    $id_w = $_SESSION['id'];
    $query = "CALL assegna_task($id_w,$id)";
    $result = mysqli_query($db,
       $query) or die("Query fail: " . mysqli_error());

  //loop the result set
  while ($row = mysqli_fetch_assoc($result)){
    ?>
          <div class="row">
          <div class="col s12 m6">
          <div class="card cyan darken-3" >
            <div class="card-content white-text">
              <span class="card-title"><?= $row['titolo'] ?></span>
              <a style= "text-decoration: none;color:white"><?= $row['descrizione'] ?></a>
            </div>
          </div>
        </div>
        </div>
  <?php } ?>

  <?php if(mysqli_num_rows($result) == 0){
    echo'Non ci sono task compatibili
        <br>';
  }else{
    echo'
    <br>
    <a href="conferma_registrazione_campagna.php?id='.$id.'"  class="mui-btn mui-btn--raised mui-btn--primary" name="close">Registrati</a>';
  }
  ?>
      <br>
      <a href="index_w.php"  class="mui-btn mui-btn--raised mui-btn--danger" name="close">CLOSE</a>

  </body>
</html>
