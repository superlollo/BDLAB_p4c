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
      <h2>Report: </h2>

    <?php
    $id = $_GET['id'];
    $query = "CALL report($id)";
    $result = mysqli_query($db,
       $query) or die("Query fail: " . mysqli_error());
    if(mysqli_num_rows($result)==0){
      echo "Nessun task creato.";
    }
  //loop the result set
    while ($row = mysqli_fetch_assoc($result)){?>
            <div class="row">
            <div class="col s12 m6">
            <div class="card cyan darken-3" >
              <div class="card-content white-text">
                <span class="card-title"><?=$row['titolo']?>: <?=$row['descrizione']?></span>
                <a style= "text-decoration: none;color:white">&nbspPossibili risposte: <?=$row['possibili_risposte']?></a>
                <a style= "text-decoration: none;color:white">&nbspRisultato: <?=$row['risultato']?></a>
                <a style= "text-decoration: none;color:white">&nbspTask Completati: <?=$row['task_completati']?></a>
                <a style= "text-decoration: none;color:white">&nbspTask In Esecuzione: <?=$row['task_in_eseguzione']?></a>
                <a style= "text-decoration: none;color:white">&nbspPercentuale completamento: <?=$row['perc']?>%</a>
              </div>
            </div>
            </div>
            </div>
      <?php } ?>
      <br>
      <a href="index.php"  class="mui-btn mui-btn--raised mui-btn--danger" name="close">CLOSE</a>
  </body>
</html>
