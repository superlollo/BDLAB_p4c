<?php include('server.php') ?>
<!doctype html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="//cdn.muicss.com/mui-0.9.41/css/mui.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="//cdn.muicss.com/mui-0.9.41/js/mui.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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

<form method="post" action="aggiungi_skill.php">

      <?php
      $id= $_SESSION['id'];
      $query = "SELECT *  from keyword where id<> all(select skill.keyword from skill where worker = $id )";
      $result = mysqli_query($db,$query);
      $option= array();
      while($row = mysqli_fetch_array($result)){
         $option[] = $row['attitudini'].' / '.$row['competenze'];
      }
      ?>
        <label>Skill / Grado</label>
        <br>
      <select name="parole_chiave" class="selectpicker">
        <?php
        foreach ($option as $value) {
        echo '<option>'.$value.'</option>';
       }?>
       </select>
      &nbsp&nbsp&nbsp<select name = "grado">
        <?php
        for ($i=1; $i <= 10; $i++) {
          echo '<option value="'.$i.'">'.$i.'</option>';
        }?>
      </select>
      <br>
      <br>

      <button type="submit" name="aggiungi_skill" class="mui-btn mui-btn--raised mui-btn--primary">Aggiungi</button>
      <a style="float: right" href="profilo_w.php"  class="mui-btn mui-btn--raised mui-btn--danger" name="close">CLOSE</a>
</form>



  </body>
</html>
