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

    if ( isset($_POST['btnadd']) ) 
    {

        $sub = trim($_POST['sub']);
        $sub = strip_tags($sub);
        $sub = htmlspecialchars($sub);

        if (empty($sub)) {
            $error = true;
            $check = "Please enter subject.";
        }
        else{
            $val = mysql_query("SELECT 1 FROM $sub");

            if($val !== FALSE)
            {
                $error = true;
                $check = "subject is already Exists";

            }elseif( !$error ) {
            
                $query = "CREATE TABLE `$sub` (`id` int(100) NOT NULL,`qid` varchar(100) NOT NULL,`qtion` varchar(100) NOT NULL,`ans` varchar(100) NOT NULL,`ans1` varchar(100) NOT NULL,`ans2` varchar(100) NOT NULL,`ans3` varchar(100) NOT NULL,`ans4` varchar(100) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=latin1;";

                $res = mysql_query($query);
                        
                $query1 = "INSERT INTO subject(subname) VALUES('$sub')";
                $res1 = mysql_query($query1);

                if ($conn->$res===true && $conn->$res1===true) {

                    $errTyp = "success";
                    $check = "subject adding problem ! try again after some time";
                    unset($sub);
                
                }else{
                    $check = "succesfuly created";
                }
            }    
        }      
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Exam-Assistant</title>

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
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="css/pe-icon-7-stroke.css" rel="stylesheet" />

    <script type="text/javascript">
        $(".dropdown-menu li a").click(function(){
            var selText = $(this).text();
            $(this).parents('.btn-group').find('.dropdown-toggle').html(selText+' <span class="caret"></span>');
        });

        function blockSpecialChar(e) {
            var k = e.keyCode;
            return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8   || (k >= 48 && k <= 57));
        }
    </script>
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="img/sidebar-3.jpg">

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="http://twobits.tk/" target="_blank" class="simple-text">
                    Two Bits
                </a>
            </div>

            <ul class="nav">
                <li class="active">
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
                    
                    <a class="navbar-brand" href="#">Exam-Assistant</a>
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
            <form method="post" role="form" role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Add Subjects</h4>
                                <p class="category">Enter to add subjects</p>
                            </div>
                            <div class="content">
                                <div class="container">
                                    <div class="btn-group">
                                        <div style="color: #a186d2;" class="btn btn-simple " >

                                            <input class="form-control" type="text" name="sub" value="" onkeypress="return blockSpecialChar(event)"/><?php echo $check ?>
                                            <br>
                                            <span class="category"style="color: red;"><b>*</b> symbols & spaces are not allowed </span>
                                            <br>
                                            <button  type="submit" id="btnadd" name="btnadd" class="btn btn-info btn-fill pull-right">Add</button>

                                        </div>
                                    </div>
  
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Start Exam</h4>
                                <p class="category">Select exam subjects</p>
                            </div>
                            <div class="content">
                                <div class="container">
                                    <div class="btn-group">
                                        <div  >

                                            <span class="category" style="color: red;"><b>*</b> You must select atleast one subject</span>
                                            <br><br>
                                            <?php 

                                                $conn = mysql_connect('localhost','root','');
                                                mysql_select_db('bookexam',$conn);
                                                        
                                                $subn = "SELECT subname from subject order by id";
                                                $rslt = mysql_query($subn,$conn);
                                            ?>
                                            
                                                
                                                    <?php 
                                                        while($row = mysql_fetch_assoc($rslt)) { 
                                                    ?>
                                                            <input type="checkbox" name="subjct" value="<?php echo $row['subname']; ?>">
                                                            <?php echo $row['subname']; ?><br>
                                                            <br>
                                                    <?php 
                                                        }  
                                                    ?>
                                            <?php mysql_free_result($rslt); ?>
                                            
                                            <br>
                                            <div class="row" align="center">

                                                    <div class="col-md-6" >
                                                        <button type="submit" id="start" name="start" class="btn btn-info btn-fill pull-right">Start</button>
                                                    </div>
                                                
                                                    <div class="col-md-6" >
                                                        <button  type="submit" id="stop" name="stop" class="btn btn-info btn-fill pull-right">Stop</button>
                                                    </div>

                                        </div>
                                    </div>
  
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                                <div class="clearfix"></div>


                <div class="row">
                    <div class="col-md-6">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">2014 Sales</h4>
                                <p class="category">All products including Taxes</p>
                            </div>
                            <div class="content">
                                <div id="chartActivity" class="ct-chart"></div>

                                <div class="footer">
                                    <div class="legend">
                                        <i class="fa fa-circle text-info"></i> Tesla Model S
                                        <i class="fa fa-circle text-danger"></i> BMW 5 Series
                                    </div>
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-check"></i> Data information certified
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">Tasks</h4>
                                <p class="category">Backend development</p>
                            </div>
                            <div class="content">
                                <div class="table-full-width">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <label class="checkbox">
                                                        <input type="checkbox" value="" data-toggle="checkbox">
                                                    </label>
                                                </td>
                                                <td>Sign contract for "What are conference organizers afraid of?"</td>
                                                <td class="td-actions text-right">
                                                    <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="checkbox">
                                                        <input type="checkbox" value="" data-toggle="checkbox" checked="">
                                                    </label>
                                                </td>
                                                <td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                                                <td class="td-actions text-right">
                                                    <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="checkbox">
                                                        <input type="checkbox" value="" data-toggle="checkbox" checked="">
                                                    </label>
                                                </td>
                                                <td>Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit
</td>
                                                <td class="td-actions text-right">
                                                    <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="checkbox">
                                                            <input type="checkbox" value="" data-toggle="checkbox">
                                                        </label>
                                                    </td>
                                                    <td>Create 4 Invisible User Experiences you Never Knew About</td>
                                                    <td class="td-actions text-right">
                                                        <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="checkbox">
                                                            <input type="checkbox" value="" data-toggle="checkbox">
                                                        </label>
                                                    </td>
                                                    <td>Read "Following makes Medium better"</td>
                                                    <td class="td-actions text-right">
                                                        <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label class="checkbox">
                                                            <input type="checkbox" value="" data-toggle="checkbox">
                                                        </label>
                                                    </td>
                                                    <td>Unfollow 5 enemies from twitter</td>
                                                    <td class="td-actions text-right">
                                                        <button type="button" rel="tooltip" title="Edit Task" class="btn btn-info btn-simple btn-xs">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-simple btn-xs">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="footer">
                                        <hr>
                                        <div class="stats">
                                            <i class="fa fa-history"></i> Updated 3 minutes ago
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="js/demo.js"></script>

	<script type="text/javascript">
    	$(document).ready(function(){

        	demo.initChartist();

        	$.notify({
            	icon: 'pe-7s-gift',
            	message: "Welcome To <b>Exam-Assistant</b> - Your The Team Leader And The Software Also, <b>All The Best.</b> "

            },{
                type: 'info',
                timer: 4000
            });

    	});
	</script>

</html>
<?php ob_end_flush(); ?>