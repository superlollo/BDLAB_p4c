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
              <div class="topnav-right">
                <a  style="text-decoration: none;color:white">
                    Welcome <?php echo $_SESSION['username']; ?></a>
              </div>
            </div>

          </div>
        </header>

        <div id="content-wrapper">
          <div class="mui--appbar-height"></div>
          <div class="mui-container-fluid">


            <br>
            <h1>About Me: </h1>

            <?php
              $id = $_SESSION['id'];
              $query= "SELECT * from worker where id=$id";
              $mysql= mysqli_query($db,$query)or die("Query fail: " . mysqli_error());

              while($row=mysqli_fetch_array($mysql)){
                ?>
                <div class="row">
                  <div class="col s12 m6">
                  <div class="card cyan darken-3" >
                    <div class="card-content white-text">
                      <span class="card-title"><?= $row['username'] ?></span>
                      <a type:"date" style= "text-decoration: none;color:white">Data di nascita: <?= $row['data'] ?></a>
                      <a style= "text-decoration: none;color:white">&nbspEmail: <?= $row['email'] ?></a>
                    </div>
                  </div>
                </div>
                </div>

            <?php  }?>

              <br>
              <h1>Skills: </h1>

                  <div class="row">
                    <div class="col s12 m6">
                    <div class="card cyan darken-3" >
                      <div class="card-content white-text">
                        <span class="card-title">Attitudini\Competenze </span>
                        <?php
                        $id = $_SESSION['id'];
                        $query= "SELECT * from keyword k, skill s where s.keyword = k.id and s.worker = $id";
                        $mysql= mysqli_query($db,$query)or die("Query fail: " . mysqli_error());
                        while ($row=mysqli_fetch_array($mysql)) {
                        ?>
                          <a type:"date" style= "text-decoration: none;color:white">- <?= $row['attitudini'] ?> \</a>
                           <a style= "text-decoration: none;color:white"> <?= $row['competenze'] ?> </a>
                           <a style= "text-decoration: none;color:white">&nbsp <?= $row['grado'] ?> </a>
                           <br>
                        <?php } ?>
                      </div>
                      <?php
                      if(mysqli_num_rows($mysql)<3){ ?>
                      <div class="card-action">
                        <a href="aggiungi_skill.php">Aggiungi Skill</a>
                      </div>
                    <?php } ?>
                    </div>
                  </div>
                  </div>




  </body>
</html>
