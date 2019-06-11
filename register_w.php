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
  	<h2>Worker Register</h2>
  </div>

  <form method="post" action="register_w.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
    <div class="input-group">
      <label>Date</label>
      <input type="date" name="date">
    </div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="mui-btn mui-btn--primary" name="reg_w_user">Register</button>
  	</div>
    <p>
      Are you a Requester? <a href="register.php">Sign in</a>
    </p>
  	<p>
  		Already register? <a href="login.php">Log in</a>
  	</p>

  </form>
</body>
</html>
