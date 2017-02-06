
<?php
  ob_start();
  session_start();
  require_once 'dbconnect.php';
  
  // if session is not set this will redirect to login page
  if( !isset($_SESSION['admi']) ) {
    header("Location: admin.php");
    exit;
  }
  // select loggedin users detail
  $res=mysql_query("SELECT * FROM admin WHERE admid=".$_SESSION['admi']);
  $userRow=mysql_fetch_array($res);
?>

<?php
	ob_start();
	session_start();
	if( isset($_SESSION['user'])!="" ){
		header("Location: dash.php");
	}
	include_once 'dbconnect.php';

	$error = false;

	if ( isset($_POST['btnreg']) ) {
		
		// clean user inputs to prevent sql injections
		$name = trim($_POST['name']);
		$name = strip_tags($name);
		$name = htmlspecialchars($name);
		
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);
		
		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
		
		// basic name validation
		if (empty($name)) {
			$error = true;
			$nameError = "Please enter your full name.";
		} else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
			$error = true;
			$nameError = "Name must contain alphabets and space.";
		}
		
		//basic email validation
		if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) 
		{
			$error = true;
			$emailError = "Please enter valid email address.";
		} 
		
		else 
		{
        // check email exist or not
			$query = "SELECT admemail FROM admin WHERE admemail='$email'";
			$result = mysql_query($query);
			$count = mysql_num_rows($result);
			if($count!=0)
			{
				$error = true;
				$emailError = "Provided Email is already in use.";
			}
		}
		// password validation
		if (empty($pass)){
			$error = true;
			$passError = "Please enter password.";
		} else if(strlen($pass) < 6) {
			$error = true;
			$passError = "Password must have atleast 6 characters.";
		}
		
		// password encrypt using SHA256();
		$password = hash('sha256', $pass);
		
		// if there's no error, continue to signup
		if( !$error ) {
			
			$query = "INSERT INTO admin(admname,admemail,admpass) VALUES('$name','$email','$password')";
			$res = mysql_query($query);
				
			if ($conn->$res===true) {
				$errTyp = "success";
				$errMSG = "Successfully registered, you may login now";
				unset($name);
				unset($email);
				unset($pass);
			} else {
				$errTyp = "danger";
				$errMSG = "Something went wrong, try again later...";	
			}	
				
		}
		
		
	}
?>
  <!DOCTYPE html>
  <html>
  <head>
	  	<meta charset="utf-8" />
		<link rel="icon" type="image/png" href="assets/img/favicon.ico">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	  
    <title>
      Admin Register 
    </title>
	  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	  <meta name="viewport" content="width=device-width" />


	  <link href="css/bootstrap.min.css" rel="stylesheet" />

	  <link href="css/animate.min.css" rel="stylesheet"/>

	  <link href="css/light-bootstrap-dashboard.css" rel="stylesheet"/>

	  <link href="css/demo.css" rel="stylesheet" />

	  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	  <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
	  <link href="css/pe-icon-7-stroke.css" rel="stylesheet" />

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
      <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
      <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/style.css">
      <script src="js/index.js"></script>
  
  </head>
  <body>
	  
	  <div class="wrapper">
		  <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">

    		<div class="sidebar-wrapper">
				<div class="logo">
					<a href="http://www.creative-tim.com" class="simple-text">
						Creative Tim
					</a>
				</div>

				<ul class="nav">
					<li class="active">
						<a href="dash.php">
							<i class="pe-7s-home"></i>
							<p>Dashboard</p>
						</a>
					</li>
					<li>
                    	<a href="user.php">
                        	<i class="pe-7s-user"></i>
                        	<p>User Profile</p>
                    	</a>
					</li>
					<li>
						<a href="table.php">
							<i class="pe-7s-note2"></i>
							<p>Result</p>
						</a>
					</li>
					<li>
						<a href="register.php">
							<i class="pe-7s-bell"></i>
							<p>Add Admin's</p>
						</a>
					</li>
				</ul>
    		</div>
		  </div>


	  <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Dashboard</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        <li>
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-dashboard"></i>
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-globe"></i>
                                    <b class="caret"></b>
                                    <span class="notification">5</span>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Notification 1</a></li>
                                <li><a href="#">Notification 2</a></li>
                                <li><a href="#">Notification 3</a></li>
                                <li><a href="#">Notification 4</a></li>
                                <li><a href="#">Another notification</a></li>
                              </ul>
                        </li>
                        <li>
                           <a href="">
                                <i class="fa fa-search"></i>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                           <a href="">
                               Account
                            </a>
                        </li>
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    Dropdown
                                    <b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Action</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something</a></li>
                                <li><a href="#">Another action</a></li>
                                <li><a href="#">Something</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                              </ul>
                        </li>
                        <li>
                            <a href="logout.php?logout" class="active">
                                Log out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
	 <div class="content"> 
		 <div class="pen-title">
			 <h1>App name</h1>
		 </div>

		 <div class="container">
			<div class="card"></div>
				<div class="card">
		   			<h1 class="title">Register
						<div class="close"></div>
		   			</h1>

		   			<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="on">

      					<div class="input-container">
							<input type="text" name="name" required="required"/>
							<label for="lbltext">Username</label>
							<div class="bar">
								<?php  echo $nameError; ?>
							</div>
		  				</div>

		  				<div class="input-container">
							<input type="txt" name="email" required="required"/>
							<label for="lblemail">Email Id</label>
							<div class="bar">
								<?php echo $emailError; ?>
							</div>
		  				</div>

		  				<div class="input-container">
							<input type="Password" name="pass" required="required"/>
							<label for="lblpsd">Password</label>
							<div class="bar">
								<?php echo $passError; ?>
							</div>
		  				</div>

		  				<div class="button-container">
		  					<button type="submit" name="btnreg"><span>Next</span></button>
		  				</div>
		   			</form>
				</div>
		 	</div>
		  </div>
	  </div>
	  </div>	  
  </body>
  </html>
<?php ob_end_flush(); ?>