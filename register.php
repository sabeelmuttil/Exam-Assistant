<?php
  ob_start();
  session_start();
  require_once 'dbconnect.php';
  
  // if session is not set this will redirect to login page
  if( !isset($_SESSION['admi'])!="" ) {
    header("Location: admin.php");
    exit;
  }
  // select loggedin users detail
  $res=mysql_query("SELECT * FROM admin WHERE admid=".$_SESSION['admi']);
  $userRow=mysql_fetch_array($res);


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
        Exam-Assistant
    </title>
	  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	  <meta name="viewport" content="width=device-width" />


	  <link href="css/bootstrap.min.css" rel="stylesheet" />

	  <link href="css/animate.min.css" rel="stylesheet"/>

	  <link href="css/light-bootstrap-dashboard.css" rel="stylesheet"/>


	  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	  
	  <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
	  
	  <link href="css/pe-icon-7-stroke.css" rel="stylesheet" />

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
	  
      <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
      <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

      <link rel="stylesheet" href="css/style.css">
      <script src="js/index.js"></script>
  
  </head>
  <body>
	  
	  <div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="img/sidebar-3.jpg">

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="http://ninjaturtles.tk/" target="_blank" class="simple-text">
                    Two Bits
                </a>
            </div>

            <ul class="nav">
                <li >
                    <a href="dash.php">
                        <i class="pe-7s-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li >
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
				<li class="active">
                    <a href="register.php">
                        <i class="pe-7s-users"></i>
                        <p>Add Admin's</p>
                    </a>
                </li>
				<li>
                    <a href="qtionmangr.php">
                        <i class="pe-7s-pen"></i>
                        <p>Question Manager</p>
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
                    <a class="navbar-brand" href="#">Admin Register</a>
                </div>
                <div class="collapse navbar-collapse">

                    <ul class="nav navbar-nav navbar-right">
						
                        <li class="dropdown">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
								  
                                    <?php echo $userRow['admname']; ?>
                                    <b class="caret"></b>
                              </a>
                              <ul class="dropdown-menu">
								  <li>
									  <a href="user.php">Account</a>
								  </li>
								  
								 <li >
									 <a href="dash.php">
										 
										 <p>Dashboard</p>
									 </a>
								  </li>
								  <li >
									  <a href="user.php">
										  
										  <p>User Profile</p>
									  </a>
								  </li>
								  <li>
									  <a href="table.php">
										  
										  <p>Result</p>
									  </a>
                				  </li>
								  <li>
									  <a href="register.php">
										   
										   <p>Add Admin's</p>
									  </a>
							     </li>
								 <li>
									 <a href="qtionmangr.php">
										
										 <p>Question Manager</p>
									 </a>
								  </li>
								  <li>
									  <a href="logout.php?logout">
                                Log out
									  </a>
								  </li>
                              </ul>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </nav>
										

	 <div class="content"> 
		 <div class="pen-title">
			 <h1>Exam-Assistant</h1>
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
							<input type="email" name="email" required="required"  maxlength="40" />
							<label>Email</label>
							<div class="bar"> <?php echo $emailError; ?></div>
							
						</div>

		  				<div class="input-container">
							<input type="Password" name="pass" required="required"/>
							<label for="lblpsd">Password</label>
							<div class="bar">
								<?php echo $passError; ?>
							</div>
		  				</div>
								<?php echo $errMSG; ?>
		  				<div class="button-container">
		  					<button type="submit" name="btnreg"><span>Next</span></button>
		  				</div>
		   			</form>
				</div>
		 	</div>
		  </div>
	  
		  <footer class="footer">
            <div class="container-fluid">
				<center>
                <p class="copyright pull">
                    &copy; 2017 <a href="http://twobits.tk/" target="_blank">Two Bits</a>, made for an education purpose
                </p>
				</center>
            </div>
        </footer>
		</div>
	  </div>	  
  </body>
	  
	  <!--   Core JS Files   -->
    <script src="js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="js/bootstrap-checkbox-radio-switch.js"></script>

	<!--  Charts Plugin -->
	<script src="js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="js/bootstrap-notify.js"></script>

   
    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="js/light-bootstrap-dashboard.js"></script>


  </html>
<?php ob_end_flush(); ?>