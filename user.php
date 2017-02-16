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
  	$error = false;
	if ( isset($_POST['btnupdate']) )
	{
		
		// clean user inputs to prevent sql injections
		$schlname = trim($_POST['schl']);
		$schlname = strip_tags($schlname);
		$schlname = htmlspecialchars($schlname);
		
		$admname = trim($_POST['usrname']);
		$admname = strip_tags($admname);
		$admname = htmlspecialchars($admname);
		
		$name = trim($_POST['fullname']);
		$name = strip_tags($name);
		$name = htmlspecialchars($name);
		
		$address = trim($_POST['usraddress']);
		$address = strip_tags($address);
		$address = htmlspecialchars($address);
		
		$city = trim($_POST['usrcity']);
		$city = strip_tags($city);
		$city = htmlspecialchars($city);
		
		$country = trim($_POST['usrcountry']);
		$country = strip_tags($country);
		$country = htmlspecialchars($country);
		
		$zip = trim($_POST['usrzip']);
		$zip = strip_tags($zip);
		$zip = htmlspecialchars($zip);
		
		$about = trim($_POST['usrabout']);
		$about = strip_tags($about);
		$about = htmlspecialchars($about);
		
			// basic name validation
		if (empty($admname)) {
			$error = true;
			$nameError = "Please enter your full name.";
		} else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
			$error = true;
			$nameError = "Name must contain alphabets and space.";
		}
		$admid=$userRow['admid'];
		// if there's no error, continue to update
		if( !$error ) {
			
			$query = "UPDATE admin SET schlname='$schlname', admname='$admname',name='$name', address='$address',city='$city', country='$country',zip='$zip', about='$about' WHERE admid='$admid'";
			$res = mysql_query($query);
				
			if ($conn->$res===true) {
				$errTyp = "success";
				$errMSG = "Successfully updated";

			} else {
				$errTyp = "danger";
				$errMSG = "Something went wrong, try again later...";	
			}	
				
		
		}
		
		
	}


	$error = false;
	if ( isset($_POST['btnpass']) )
	{
		// clean user inputs to prevent sql injections
		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
		
		$pass2 = trim($_POST['pass2']);
		$pass2 = strip_tags($pass2);
		$pass2 = htmlspecialchars($pass2);
		
		// password validation
		
			if (empty($pass)){
				$error = true;
				$passError = "Please enter password.";
			} else if(strlen($pass) < 6) {
				$error = true;
				$passError = "Password must have atleast 6 characters.";
			}
			else if($pass==$pass2)
			{
				$pass3=$pass;
				// password encrypt using SHA256();
				$password = hash('sha256', $pass3);
				
				$admid=$userRow['admid'];
		
		// if there's no error, continue to update
		
			  if( !$error ) 
			  {
			
				$query = "UPDATE admin SET admpass='$password' WHERE admid='$admid'";
				$res = mysql_query($query);
				
				if ($conn->$res===true) 
				{
					$errTyp = "success";
					$errMSG = "Successfully update, you'r password'";
				unset($pass);
				} 
				else 
				{
					$errTyp = "danger";
					$errMSG = "Something went wrong, try again later...";	
				}	
		
			  }
			}
			else{
				$passError = "Password do not match password.";
			}
				
			
	}

?>


<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Light Bootstrap Dashboard by Creative Tim</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="css/light-bootstrap-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="css/demo.css" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='css/font.css' rel='stylesheet' type='text/css'>
    <link href="css/pe-icon-7-stroke.css" rel="stylesheet" />
	
	<script src="js/jquery-1.9.1.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function()
			{
    			$('#btn').click(function()
					{
						if (this.checked) 
						{
							$('#mytxt').removeAttr("disabled");
							$('#mytxt2').removeAttr("disabled");
							$('#mytxt3').removeAttr("disabled");
							$('#mytxt5').removeAttr("disabled");
							$('#mytxt6').removeAttr("disabled");
							$('#mytxt7').removeAttr("disabled");
							$('#mytxt8').removeAttr("disabled");
							$('#mytxt9').removeAttr("disabled");
						} 
						else 
						{
							$("#mytxt").attr("disabled", true);
							$("#mytxt2").attr("disabled", true);
							$("#mytxt3").attr("disabled", true);
							$("#mytxt5").attr("disabled", true);
							$("#mytxt6").attr("disabled", true);
							$("#mytxt7").attr("disabled", true);
							$("#mytxt8").attr("disabled", true);
							$("#mytxt9").attr("disabled", true);
						}
				});
			$('#bttnpass').click(function()
					{
						if (this.checked) 
						{
							$('#pass').removeAttr("disabled");
							$('#pass2').removeAttr("disabled");
						} 
						else 
						{
							$("#pass").attr("disabled", true);
							$("#pass2").attr("disabled", true);
						}
				});
		});
		
	</script>
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
                <li class="active">
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
                    <a class="navbar-brand" href="#">Profile</a>
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
                           			<a href="">
										
									</a>
								 </li>
								  <li><a href="user.php">Account</a></li>
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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Edit Profile</h4>
                            </div>
                            <div class="content">
                                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Name of School / College</label>
                                                <input id="mytxt" name="schl" disabled="disabled" type="text" class="form-control" placeholder="School / College Name" value="<?php echo $userRow['schlname']; ?>">
                                            </div>
                                        </div>
                                        
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input id="mytxt2" name="usrname" disabled="disabled" type="text" class="form-control" placeholder="Username" value="<?php echo $userRow['admname']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Name </label>
                                                <input id="mytxt3" name="fullname" disabled="disabled" type="text" class="form-control" placeholder="Name" value="<?php echo $userRow['name']; ?>">
                                            </div>
                                        </div>
                                    </div>
									<div class="row">
										<div class="col-md-8">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input id="mytxt4" name="usremail" disabled type="email" class="form-control" placeholder="Email" value="<?php echo $userRow['admemail']; ?>">
                                            </div>
                                        </div>
									</div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <input id="mytxt5" name="usraddress" disabled="disabled" type="text" class="form-control" placeholder="Home Address" value="<?php echo $userRow['address']; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>City</label>
                                                <input id="mytxt6" name="usrcity" disabled="disabled" type="text" class="form-control" placeholder="City" value="<?php echo $userRow['city']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Country</label>
                                                <input id="mytxt7" name="usrcountry" disabled="disabled" type="text" class="form-control" placeholder="Country" value="<?php echo $userRow['country']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Postal Code</label>
                                                <input id="mytxt8" name="usrzip" disabled="disabled" type="number" class="form-control" placeholder="ZIP Code" value="<?php echo $userRow['zip']; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>About Me</label>
                                                <input id="mytxt9" name="usrabout" disabled="disabled" type="text" height="50" class="form-control" placeholder="Here can be your description" value="<?php echo $userRow['about']; ?>"></textarea>
                                            </div>
                                        </div>
                                    </div>
									
									<div class="row">
                                        <div class="col-md-3">
                                    		<input type="checkbox" class="btn btn-info btn-fill pull-left" id="btn">
											<p>Edit</p>
										</div>
										<div class="col-md-3">
											<button type="submit" id="btnupdate" name="btnupdate" class="btn btn-info btn-fill pull-right">Update Profile</button>
										</div>
									</div>
								
								
								<hr/>
										<div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input id="pass" name="pass" disabled="disabled" type="password" class="form-control" placeholder="Password" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Re-Enter Password </label>
                                                <input id="pass2" name="pass2" disabled="disabled" type="password" class="form-control" placeholder="Re-Enter Password" value="">
                                            </div>
                                        </div>
											<?php echo $errMSG; ?>
   											<?php echo $passError; ?>

                                    </div>
									<div class="row">
										<div class="col-md-3">
                                    		<input type="checkbox" class="btn btn-info btn-fill pull-left" id="bttnpass">
											<p>Edit Password</p>
										</div>
										<div class="col-md-3">
											<button type="submit" id="btnpass" name="btnpass" class="btn btn-info btn-fill pull-right">Update Password</button>
										</div>
								  </div>
                                    <div class="clearfix"></div>
								
                                </form>
                            </div>
                        </div>
                    </div>
					
                    <div class="col-md-4">
                        <div class="card card-user">
                            <div class="image">
                                <img src="img/cover1.PNG"alt="..."/>
                            </div>
                            <div class="content">
                                <div class="author">
                                     <a href="#">
                                    <img class="avatar border-gray" src="img/icos.png" alt="..."/>

                                      <h4 class="title">Two Bits<br />
                                         <small>---------???</small>
                                      </h4>
                                    </a>
                                </div>
                                <p class="description text-center"> "This used for an education purpose, <br>
                                                    And this developed by <br>
                                                    <b>Anas and Sabeel</b> "
                                </p>
                            </div>
                            <hr>
                            <div class="text-center">
								
                                <button href="#" class="btn btn-simple"><i class="fa fa-facebook" style="font-size:24px;"></i></button>
									
                                <button href="#" class="btn btn-simple"><i class="fa fa-twitter" style="font-size:24px;"></i></button>
								
								<button href="#" class="btn btn-simple"><i class="fa fa-youtube-square" style="font-size:24px;"></i></button>

                            </div>
                        </div>
                    </div>

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
	<script src="assets/js/light-bootstrap-dashboard.js"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="js/demo.js"></script>

</html>
<?php ob_end_flush(); ?>