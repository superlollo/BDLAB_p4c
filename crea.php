<?php include('server.php') ?>
<!doctype html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="//cdn.muicss.com/mui-0.9.41/css/mui.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="//cdn.muicss.com/mui-0.9.41/js/mui.min.js"></script>
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
<form method="post" action="crea.php">

      <div class="form-group">
        <label>Nome della Campagna</label>
        <input type="text" class="form-control" name="name">
      </div>

      <div class="form-group">
        <label>Data di Apertura</label>
        <input type="date" class="form-control" name="data_a" min="<?php echo date('Y-m-d'); ?>">
      </div>

      <div class="form-group">
        <label>Data di Chiusura</label>
        <input type="date" class="form-control" name="data_c" min="<?php echo date('Y-m-d'); ?>">
      </div>

      <div class="form-group">
        <label>Periodo di Registrazione</label>
        <input type="date" class="form-control" name="periodo" min="<?php echo date('Y-m-d'); ?>">
      </div>

      <div class="form-group">
        <label>Numero Worker</label>
        <input type="number" class="form-control" name="nr_worker" min="1" max="10">
      </div>

      <div class="form-group">
        <label>Soglia Maggioranza (%)</label>
        <input type="number" class="form-control" name="soglia"  max="100">
      </div>

      <button type="submit" name="submit" class="mui-btn mui-btn--raised mui-btn--primary">Submit</button>
      <a style="float: right" href="index.php"  class="mui-btn mui-btn--raised mui-btn--danger" name="close">CLOSE</a>
</form>

  </body>
</html>
