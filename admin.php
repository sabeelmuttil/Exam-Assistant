<?php
  ob_start();
  session_start();
  require_once 'dbconnect.php';
  
  // it will never let you open index(login) page if session is set
  if ( isset($_SESSION['admi'])!="" ) {
    header("Location: dash.php");
    exit;
  }
  
  $error = false;
  
  if( isset($_POST['bttngo']) ) {  
    
    // prevent sql injections/ clear user invalid inputs
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);
    
    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);
    // prevent sql injections / clear user invalid inputs
    
    if(empty($email)){
      $error = true;
      $emailError = "Please enter your email address.";
    } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
      $error = true;
      $emailError = "Please enter valid email address.";
    }
    
    if(empty($pass)){
      $error = true;
      $passError = "Please enter your password.";
    }
    
    // if there's no error, continue to login
    if (!$error) {
      
      $password = hash('sha256', $pass); // password hashing using SHA256
    
      $res=mysql_query("SELECT admid, admname, admpass FROM admin WHERE admemail='$email'");
      $row=mysql_fetch_array($res);
      $count = mysql_num_rows($res); // if uname/pass correct it returns must be 1 row
      
      if( $count == 1 && $row['admpass']==$password ) {
        $_SESSION['admi'] = $row['admid'];
        header("Location: dash.php");
      } else {
        $errMSG = "Incorrect Credentials, Try again...";
      }
        
    }
    
  }
?>

<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Admin Login</title>
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
  <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

  <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
  
<div class="pen-title">
  <h1>App name</h1>

</div>
<div class="container">
  <div class="card"></div>
  <div class="card">
    <h1 class="title">Login</h1>
	  
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="on">
		
      <div class="input-container">
        <input type="email" name="email" required="required" value="<?php echo $email; ?>" maxlength="40" />
        <label>Email</label>
        <div class="bar"></div>
      </div>
		
      <div class="input-container">
        <input type="password" name="pass" required="required"/>
        <label>Password</label>
        <div class="bar"></div>
      </div>
		
      <div class="button-container">
        <button type="submit" name="bttngo"><span>Go</span></button>
      </div>
    </form>
  </div>

  
</div>

</body>
</html>