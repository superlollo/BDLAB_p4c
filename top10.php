<?php include('server.php') ?>
<!doctype html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="//cdn.muicss.com/mui-0.9.41/css/mui.min.css" rel="stylesheet" type="text/css" />
    <script src="//cdn.muicss.com/mui-0.9.41/js/mui.min.js"></script>
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
      <h1>Top 10: </h1>

          <div class="row">
          <div class="col s12 m6">
          <div class="card cyan darken-3" >
            <div class="card-content white-text">
              <?php
              $id = $_GET['id'];
              $query = "CALL top10($id)";
              $result = mysqli_query($db,
                 $query) or die("Query fail: " . mysqli_error());
              $i=1;
            //loop the result set
            while ($row = mysqli_fetch_assoc($result)){ ?>
              <a style= "text-decoration: none;color:white"><?= $i ?>. <?= $row['username'] ?>: <?= $row['punteggio'] ?></a>
              <br>
              <?php $i++;
            } ?>
            </div>
          </div>
        </div>
        </div>


      <a href="index.php"  class="mui-btn mui-btn--raised mui-btn--danger" name="close">CLOSE</a>

  </body>
</html>
