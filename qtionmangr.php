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

<!doctype html>
<html>
	<head>
		
		<meta charset="utf-8" />
		<link rel="icon" type="image/png" href="img/favicon.ico">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		
		<title>
			Exam-Assistant
		</title>
		
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="css/light-bootstrap-dashboard.css" rel="stylesheet"/>


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="css/pe-icon-7-stroke.css" rel="stylesheet" />
		<script src="js/jquery-1.9.1.js"></script>
		
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
				<li>
                    <a href="register.php">
                        <i class="pe-7s-users"></i>
                        <p>Add Admin's</p>
                    </a>
                </li>
				<li class="active">
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
                    
                    <a class="navbar-brand" href="#">Question Manager</a>
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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
								<h4 class="title">Add Question</h4>
							</div>
							
							<div class="content">
                                <form method="post" role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
									 <div class="row">
										 <div class="col-md-12">
                                            <div class="form-group">
												<label>Question</label>
												<textarea class="form-control" placeholder="Enter Question.."></textarea>
											 </div>
										 </div>
									</div>
									
									<div class="row">
										 <div class="col-md-12">
                                            <div class="form-group">
												<label>Answer</label>
												<textarea class="form-control" placeholder="Enter Corresponding Answers.."></textarea>
											 </div>
										 </div>
									</div>
									<div class="row">
										<div class="col-md-8">
											<button type="submit" id="btnadd" name="btnadd" class="btn btn-info btn-fill pull-right">Add Question</button>
										</div>
								  </div>
									
									<div class="clearfix"></div>
								</form>
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