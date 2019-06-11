  <?php include('server.php') ?>
<!doctype html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="//cdn.muicss.com/mui-0.9.41/css/mui.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="//cdn.muicss.com/mui-0.9.41/js/mui.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="//cdn.muicss.com/mui-0.9.41/css/mui.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script defer>
      $(function() {
        $.fn.selectpicker.Constructor.BootstrapVersion = "4.0.0";
        $('.selectpicker').selectpicker();
      });
    </script>

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
    <h1>Task da eseguire: </h1>
    <?php
    $id = $_GET['id'];
    $id_w = $_SESSION['id'];
    $query = "SELECT * from task c, svolge s, contenuti u where c.id = s.task and u.campagne = $id and s.worker = $id_w and u.task = c.id and c.id<> all(select v.task from validita_task v where v.worker = $id_w)";
    $result = mysqli_query($db,
       $query) or die("Query fail: " . mysqli_error());
   if(mysqli_num_rows($result)==0){
     echo 'Nessun task da eseguire, richiedi un task in "Richiedi task"';
   }
  //loop the result set
  while ($row = mysqli_fetch_assoc($result)){?>
    <form method="post" action="answare.php">
      <div class="row">
          <div class="col s12 m6">
          <div class="card cyan darken-3" >

            <div class="card-content white-text">
              <span class="card-title"><?=$row['titolo']?></span>
              <a style= "text-decoration: none;color:white"><?=$row['descrizione']?></a>
              <br>
              <br>
              <select name="answare" value="<?= explode(', ',$row['possibili_risposte'])[0] ?>" class="selectpicker">
                <?php foreach (explode(', ',$row['possibili_risposte']) as $value) { ?>
                  <option value="<?= $value ?>"><?= $value ?></option>
                <?php } ?>

              </select>
              <input type="hidden" name="task_id" value="<?= $row['id'] ?>">
              <input type="hidden" name="worker_id" value="<?= $id_w ?>">
              <input type="hidden" name="campagne_id" value="<?= $id ?>">

            </div>
            <div class="card-action">
              <button type="submit" href="" name = "accetta_task">Esegui Task</button>

            </div>
          </div>
        </div>
        </div>
      </form>

    <?php } ?>
      <br>
      <a href="task.php"  class="mui-btn mui-btn--raised mui-btn--danger" name="close">CLOSE</a>

  </body>
</html>
