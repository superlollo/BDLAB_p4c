<?php include('server.php') ?>
<?php

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//cdn.muicss.com/mui-0.9.41/css/mui.min.css" rel="stylesheet" type="text/css" />
    <script src="//cdn.muicss.com/mui-0.9.41/js/mui.min.js"></script>
    <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script type="text/javascript" src="sidedrower.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  </head>
  <body>
        <div id="sidedrawer"  class="mui--no-user-select">
          <div id="sidedrawer-brand" class="mui--appbar-line-height">
          <span class="mui--text-title">P4c</span>
          </div>
          <div class="mui-divider"></div>
              <ul>
                <li><a href="index_w.php" style="text-decoration: none; color:black;" ><strong>Home</strong></a></li>
                <li><a href="profilo_w.php" style="text-decoration: none; color:black;" ><strong>Profilo</strong></a></li>
                <li><a href="task.php" style="text-decoration: none; color:black;" ><strong>I tuoi task</strong></a></li>
                <?php  if (isset($_SESSION['username'])) : ?>
                  <li> <a href="index.php?logout='1'" style="text-decoration: none; color:black;"><strong>logout</strong></a> </li>
                <?php endif ?>
              </ul>
        </div>

        <header id="header">
          <div class="mui-appbar mui--appbar-line-height">
            <div class="mui-container-fluid">
              <a class="sidedrawer-toggle mui--hidden-xs mui--hidden-sm js-hide-sidedrawer">☰</a>
              <span class="mui--text-title mui--visible-xs-inline-block">Brand.io</span>
              <div class="topnav-right">
                <a style="text-decoration: none;color:white">
                    Welcome <?php echo $_SESSION['username']; ?></a>
              </div>
            </div>

          </div>
        </header>

        <div id="content-wrapper">
          <div class="mui--appbar-height"></div>
          <div class="mui-container-fluid">

            <br>
            <h1>Registrato: </h1>

            <?php
              $id = $_SESSION['id'];
              $query= "SELECT * from campagna_di_lavoro,registrazione where registrazione.campagna = campagna_di_lavoro.id and registrazione.worker = $id and data_fine >= current_date order by data_fine";
              $mysql= mysqli_query($db,$query);


              while($row=mysqli_fetch_array($mysql)){
                ?>
                <div class="row">
                  <div class="col s12 m6">
                  <div class="card cyan darken-3" >
                    <div class="card-content white-text">
                      <span class="card-title"><?= $row['nome'] ?></span>
                      <a style= "text-decoration: none;color:white">Data Apretura: <?= $row['data_apertura'] ?></a>
                      <a style= "text-decoration: none;color:white">&nbspData Chiusura: <?= $row['data_fine'] ?></a>
                      <a style= "text-decoration: none;color:white">&nbspPeriodo Registrazione: <?= $row['periodo_registrazione'] ?></a>
                    </div>
                    <div class="card-action">
                      <a href="mostraTask.php?id=<?= $row['id'] ?>">Mostra Task</a>
                      <a href="richiediTask.php?id=<?= $row['id']?>">Richiedi task</a>
                      <a href="statistiche.php?id=<?= $row['id'] ?>">Statistiche</a>
                    </div>
                  </div>
                </div>
                </div>

            <?php } ?>

            <?php if(mysqli_num_rows($mysql) == 0){
              echo 'Non sei registrato a nessuna campagna';
            }?>


  </body>
</html>
