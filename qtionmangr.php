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

        $qid = trim($_POST['qid']);
        $qid = strip_tags($qid);
        $qid = htmlspecialchars($qid);

        $cmbsbjct1 = trim($_POST['cmbsbjct1']);
        $cmbsbjct1 = strip_tags($cmbsbjct1);
        $cmbsbjct1 = htmlspecialchars($cmbsbjct1);

        $qname = trim($_POST['qname']);
        $qname = strip_tags($qname);
        $qname = htmlspecialchars($qname);

        $qansa = trim($_POST['qansa']);
        $qansa = strip_tags($qansa);
        $qansa = htmlspecialchars($qansa);

        $qansb = trim($_POST['qansb']);
        $qansb = strip_tags($qansb);
        $qansb = htmlspecialchars($qansb);

        $qansc = trim($_POST['qansc']);
        $qansc = strip_tags($qansc);
        $qansc = htmlspecialchars($qansc);

        $qansd = trim($_POST['qansd']);
        $qansd = strip_tags($qansd);
        $qansd = htmlspecialchars($qansd);

        // id validation
        if (empty($qid)) {
            $error = true;
            $idError = "Please enter Question Id.";
        } 
        else 
        {
            
        // check id exist or not
            $query = "SELECT qid FROM $cmbsbjct1 WHERE qid='$qid'";
            $result = mysql_query($query);
            $count = mysql_num_rows($result);

            if($count!=0)
            {
                $error = true;
                $idError = "Provided Id is already in use.";
            }
            
        }

    
        //qname validation
        if ( empty($qname) ) 
        {
            $error = true;
            $qnameError = "Please enter Question.";
        } 
        
        
        // ans validation
        if (empty($qansa)){
            $error = true;
            $qansError = "Please enter Question.";
        }

        if (empty($qansb)){
            $error = true;
            $qansError = "Please enter Question.";
        } 

        if (empty($qansc)){
            $error = true;
            $qansError = "Please enter Question.";
        } 

        if (empty($qansd)){
            $error = true;
            $qansError = "Please enter Question.";
        } 


        if(isset($_POST['Radio']))
        {
            $wans = $_POST['Radio'];

             if ($wans == "1") 
             {
               $wans = "1";
             }
             else if ($wans == "2") {
                 $wans = "2";
             } 
             else if ($wans == "3") {
                $wans = "3";
             } 
             else if ($wans == "4") {
                $wans = "4";
             } 

        }
           
        else{
            $error = true;
            $an= "Please choose any option .";
        }
        if ($cmbsbjct1==1) {
            $error = true;
            $suberr= "Please choose subject .";
        }   

            
        if( !$error ) {
            
            $query = "INSERT INTO $cmbsbjct1(qid,qtion,ans,ans1,ans2,ans3,ans4) VALUES('$qid','$qname','$wans','$qansa','$qansb','$qansc','$qansd')";
            $res = mysql_query($query);
                
            if ($conn->$res===true) {
                $errTyp = "success";
                $errMSG = "Successfully added question";
                unset($qid);
                unset($qname);
                unset($qansa);
                unset($qansb);
                unset($qansc);
                unset($qansd);
            } else {
                $errTyp = "danger";
                $errMSG = "Something went wrong, try again later...";   
            }   
              
        } 
    }

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
    <link href="css/bootstrap-select.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="css/bootstrap-combobox.css">

    <script src="js/bootstrap-combobox.js"></script>

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="css/pe-icon-7-stroke.css" rel="stylesheet" />
        <script language="javascript" src="js/jquery-3.1.1.min.js"></script>
		<script src="js/jquery-1.9.1.js"></script>
		<script src="js/bootstrap-select.min.js"></script>

        
        <style type="text/css">
            /* Adjust feedback icon position */
            #productForm .selectContainer .form-control-feedback,
            #productForm .inputGroupContainer .form-control-feedback {
                right: -15px;
            }
        </style>
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
                <br>
                <br>
                <li>
                    <form method="post" role="form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                                
                    <div class="form-group">
                        <label >Select Subjects To Check Last Value Of Table</label>
                        <br>
                            <div class=" selectContainer ">
                                                
                                <?php 

                                    $conn = mysql_connect('localhost','root','');
                                    mysql_select_db('bookexam',$conn);
                                                        
                                    $subn = "SELECT subname from subject order by id";
                                    $rslt = mysql_query($subn,$conn);
                                                        
                                ?>
                                <select class="form-control" name="cmbsbjct" id="cmbsbjct">

                                    <option value="1">Check Question id</option>
                                        <?php while($row = mysql_fetch_assoc($rslt)) { ?>
                                            <option value="<?php echo $row['subname']; ?>"><?php echo $row['subname']; ?></option>
                                            <?php }  ?>
                                    </select>
                                    <?php mysql_free_result($rslt); ?>
                                    <br>
                                    <div class="form-group">
                                        <span >  Last Question Id is 
                                            <b > 
                                                <?php 
                                                    if ( isset($_POST['btnchk']) ) 
                                                    {
                                                        $cmbsbjct = trim($_POST['cmbsbjct']);
                                                        
                                                        
                                                        $last = mysql_query("SELECT qid from $cmbsbjct order by id desc limit 1;");
                                                        if ($cmbsbjct==1) {
                                                            $maxqid="Must select any option .";
                                                            echo $maxqid;
                                                        }

                                                         else if (mysql_num_rows($last)>0) {
                                                                $maxqid=mysql_fetch_array($last);
                                                                echo $maxqid[0];    
                                                         }
                                                         else{

                                                            $maxqid="No question in here ! add 1st question";
                                                            echo $maxqid;
                                                        }
                                                    
                                                    }                                                 
                                                ?> 
                                            </b> 
                                        </span>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <button type="submit" id="btnchk" name="btnchk" class="btn btn-info btn-fill pull-right">Check</button>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                    </div>
                    </form>
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
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Question Id</label>
                                                <input type="text" class="form-control" value="<?php echo  $idError; ?>" placeholder="Question Id" name="qid">

                                                

                                            </div>

                                        </div>

                                        <div class="col-md-9">
                                          <div class="form-group">
                                            <label >Select subjects</label>
                                            <div class=" selectContainer ">
                                                
                                                    <?php 

                                                        $conn = mysql_connect('localhost','root','');
                                                        mysql_select_db('bookexam',$conn);
                                                        
                                                        $subn = "SELECT subname from subject order by id";
                                                        $rslt = mysql_query($subn,$conn);


                                                        
                                                    ?>
                                                    <select class="form-control" name="cmbsbjct1" id="cmbsbjct">

                                                        <option value="1">Select subject type</option>
                                                        <?php while($row = mysql_fetch_assoc($rslt)) { ?>
                                                            <option value="<?php echo $row['subname']; ?>"><?php echo $row['subname']; ?></option>
                                                        <?php }  ?>
                                                    </select>
                                                    <?php mysql_free_result($rslt); ?>
                                            </div>
                                          </div>
                                        </div>       
                                    </div>
                                        <span style="color: red;"><?php echo $suberr; ?></span>
                                     <div class="row">
										 <div class="col-md-12">
                                            <div class="form-group">
												<label>Question</label>
												<textarea class="form-control" placeholder="Enter Question.." name="qname" id="qname"><?php echo  $output; ?></textarea>
											 </div>
										 </div>
									</div>
                                        <p style="color:red;"> <?php echo "You must be select any options.!    <b> This option is right answer</b>" ?></p>
									<div class="row">
										 <div class="col-md-6">
                                            <div class="form-group">
												<label>Option A</label>
                                                <input type="Radio" class="pull-left" name="Radio" value="1">
            
												<textarea class="form-control" placeholder="Option A" name="qansa"><?php echo  $qansError; ?></textarea>
											 
                                             </div>
										 </div>

                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Option B</label>
                                                <input type="Radio" class="pull-left" name="Radio" value="2">
                                                <textarea class="form-control" placeholder="Option B" name="qansb"><?php echo  $qansError; ?></textarea>
                                             </div>
                                         </div>
                                    </div>

                                    <div class="row">
                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Option C</label>
                                                <input type="Radio" class="pull-left" name="Radio" value="3">
                                                <textarea class="form-control" placeholder="Option C" name="qansc"><?php echo  $qansError; ?></textarea>
                                             </div>
                                         </div>
                                    
                                         <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Option D</label>
                                                <input type="Radio" class="pull-left" name="Radio" value="4">
                                                <textarea class="form-control" placeholder="Option D" " name="qansd"> <?php echo $qansError ?> </textarea>
                                             </div>
                                         </div>
                                    </div>
                                    <span style="color: red;"> <?php echo $an; ?></span>
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
    <script>
$(document).ready(function(){
    $('.action').change(function(){
        if($(this).val() != '')
        {
            var action = $(this).attr("id");
            var query = $(this).val();
            var result = '';
            if(action == "cmbsbjct")
            {
                result = 'qname';
            }
            $.ajax({
                url:"fetch.php",
                method:"POST",
                data:{action:action, query:query},
                success:function(data){
                    $('#'+result).html(data);
                }
            })
        }
    });
});
    </script>
</html>
<?php ob_end_flush(); ?>