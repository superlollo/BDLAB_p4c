<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registration system PHP and MySQL</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link href="//cdn.muicss.com/mui-0.9.41/css/mui.min.css" rel="stylesheet" type="text/css" />
  <script src="//cdn.muicss.com/mui-0.9.41/js/mui.min.js"></script>

</head>
<body>
  <div class="header_login">
  	<h2>Login</h2>
  </div>

  <form method="post" action="login.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="username" >
  		<label>Password</label>
    	<input type="password" name="password">
    </div>
    	<button type="submit" class="mui-btn mui-btn--primary" name="login_user">Login</button>
    <p>
      Not yet register? <a href="register_w.php">Sign in</a>
    </p>
  </form>

</body>
</html>
