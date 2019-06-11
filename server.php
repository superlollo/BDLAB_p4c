 <?php
session_start();

// initializing variables
$id = "";                 $nr_task="";
$username = "";           $nr_worker="";
$email    = "";           $soglia="";
$errors = array();
$worker = false;
$name = "";
$data_a="";
$data_c = "";
$periodo = "";

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'p4c');

 if(isset($_POST['aggiungi_skill'])){
   $grado = $_POST['grado'];
   $keyword = mysqli_real_escape_string($db,$_POST['parole_chiave']);
   $key = explode(' / ',$keyword);
   $id = $_SESSION['id'];
   $query= "SELECT id from keyword where attitudini = '$key[0]' and competenze = '$key[1]'";
   $res = mysqli_query($db, $query);
   $result = mysqli_fetch_assoc($res);
   $id_k = $result['id'];
   $query2 = "INSERT INTO skill(worker, keyword, grado) VALUES('$id','$id_k','$grado')";
   mysqli_query($db, $query2)  or die("Query fail: " . mysqli_error());
   header('location: profilo_w.php');
 }

 if (isset($_POST['submit_task'])) {
  // receive all input values from the form
  $name = mysqli_real_escape_string($db, $_POST['titolo']);
  $data_a = mysqli_real_escape_string($db, $_POST['descrizione']);
  $data_c = mysqli_real_escape_string($db, $_POST['possibili_risposte']);
  $keyword = mysqli_real_escape_string($db,$_POST['parole_chiave']);
  $id_camp = mysqli_real_escape_string($db, $_POST['id_c']);
  $key = explode(' / ',$keyword);
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($name)) { array_push($errors, "Name is required"); }
  // Finally, register user if there are no errors in the form
    $req_id=$_SESSION['id'];
    $query = "INSERT INTO task (titolo, descrizione,possibili_risposte,request)
          VALUES('$name', '$data_a','$data_c','$req_id')";
    mysqli_query($db, $query);
    $query2 = "SELECT id FROM task where titolo = '$name' and descrizione = '$data_a'";
    $result= mysqli_query($db,$query2);
    $id_task1= mysqli_fetch_assoc($result);
      $id_task=$id_task1['id'];
    $query3="INSERT INTO contenuti(campagne, task) VALUES('$id_camp','$id_task')";
    mysqli_query($db, $query3);
    $query4= "SELECT id from keyword where attitudini = '$key[0]' and competenze = '$key[1]'";
    $res = mysqli_query($db, $query4);
    $result = mysqli_fetch_assoc($res);
    $id_k = $result['id'];
    $query5 = "INSERT INTO skill_richieste(task,keyword) VALUES('$id_task','$id_k')";
    mysqli_query($db, $query5)  or die("Query fail: " . mysqli_error());
    header('location: index.php');
}



if (isset($_POST['submit'])) {
  // receive all input values from the form
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $data_a = mysqli_real_escape_string($db, $_POST['data_a']);
  $data_c = mysqli_real_escape_string($db, $_POST['data_c']);
  $periodo = mysqli_real_escape_string($db, $_POST['periodo']);
  $nr_task = mysqli_real_escape_string($db, $_POST['nr_task']);
  $nr_worker = mysqli_real_escape_string($db, $_POST['nr_worker']);
  $soglia = mysqli_real_escape_string($db, $_POST['soglia']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($name)) { array_push($errors, "Name is required"); }
  if (empty($data_a)) { array_push($errors, "Data is required"); }

  // Finally, register user if there are no errors in the form
    $query = "INSERT INTO campagna_di_lavoro (nome, data_apertura,data_fine,periodo_registrazione)
          VALUES('$name', '$data_a','$data_c','$periodo')";
    mysqli_query($db, $query);
    $query2 = "SELECT id FROM campagna_di_lavoro where nome='$name'and data_apertura = '$data_a'";
    $result= mysqli_query($db,$query2);
    $id_campa= mysqli_fetch_assoc($result);
    $id_camp=$id_campa['id'];
    $req_id=$_SESSION['id'];
    $query3="INSERT INTO apre(request, campagne,nr_worker,soglia_maggioranza) VALUES('$req_id','$id_camp','$nr_worker','$soglia')";
    mysqli_query($db, $query3);
    header('location: index.php');
}

//REGISTER WORKER USER
if (isset($_POST['reg_w_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $date = mysqli_real_escape_string($db, $_POST['date']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($date)) { array_push($errors, "Date is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }


  // first check the database to make sure
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM worker  WHERE username='$username' OR email='$email' LIMIT 1";
  $req_check_query = "SELECT * FROM requester where username = '$username' OR  email = '$email' limit 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  $result2 =  mysqli_query($db, $req_check_query);
  $req =  mysqli_fetch_assoc($result2);
  if($req){
    if ($req['username'] == $username) {
      array_push($errors, "Username already exists");
    }

    if($req['email'] == $email){
      array_push($errors, "Email already exists");
    }
  }
  if ($user) { // if user exists
    if ($user['username'] == $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] == $email) {
      array_push($errors, "email already exists");
    }
  }


  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO worker (username, data, email, password)
  			  VALUES('$username', '$date', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: login.php');
    }
  }
// REGISTER REQ USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }


  // first check the database to make sure
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM requester WHERE username='$username' OR email='$email' LIMIT 1";
  $work_check_query = "SELECT * FROM worker WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $result2 = mysqli_query($db, $work_check_query);
  $user = mysqli_fetch_assoc($result);
  $work = mysqli_fetch_assoc($result2);
  if($work){
    if ($work['username'] == $username) {
      array_push($errors, "Username already exists");
    }

    if($work['email'] == $email){
      array_push($errors, "Email already exists");
    }
  }
  if ($user) { // if user exists
    if ($user['username'] == $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] == $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//md5($password_1);//encrypt the password before saving in the database
    $token = base64_encode(openssl_random_pseudo_bytes(16));
  	$query = "INSERT INTO requester (username, email, password,verification_token)
  			  VALUES('$username', '$email', '$password','$token')";
  	mysqli_query($db, $query);
    $my_email='lorenzoleaf@gmail.com';
    $headers = 'From: ' .$my_email . "\r\n".
  'Reply-To: ' . $my_email. "\r\n" .
  'X-Mailer: PHP/' . phpversion();
    mail($my_email,'Approvarione Requester','http://localhost/p4c/approvazione.php?mail='.$email.'&token='.$token,$headers);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: login.php');
    }
  }
// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = md5(mysqli_real_escape_string($db, $_POST['password']));

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$query = "SELECT id,username,email,password FROM requester  WHERE username='$username' AND password='$password' and verification_token is null";
    $query2 ="SELECT id,username,email,password  from worker where username='$username' AND password='$password'";
    $query3 = "SELECT * FROM requester  WHERE username='$username' AND password='$password' ";
  	$results = mysqli_query($db, $query);
    $results2 = mysqli_query($db, $query2);
    $results3 = mysqli_query($db, $query3);
    $id = mysqli_fetch_assoc($results);
    $id2 = mysqli_fetch_assoc($results2);
    $id3 = mysqli_fetch_assoc($results3);
    if (!is_null($id3['verification_token'])){
        array_push($errors, "Account in attesa di approvazione");
    }
    if($username = $id['username']){
    	if (mysqli_num_rows($results) == 1) {
    	  $_SESSION['username'] = $username;
        $_SESSION['id']=$id['id'];
    //	  $_SESSION['success'] = "You are now logged in";
    	  header('location: index.php');
    	}else {
    		array_push($errors, "Wrong username/password combination");
    	}
    }else{
      if($username = $id2['username']){
        if (mysqli_num_rows($results2) == 1) {
          $_SESSION['username'] = $username;
          $_SESSION['id']=$id2['id'];
      //	  $_SESSION['success'] = "You are now logged in";
          header('location: index_w.php');
        }else {
          array_push($errors, "Wrong username/password combination");
        }
      }
    }
  }
}



?>
