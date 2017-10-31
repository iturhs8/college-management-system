<?php
	ob_start();
	session_start();
	require_once 'dbconnect.php';
	
	// if session is not set this will redirect to login page
	if( !isset($_SESSION['user']) ) {
		header("Location: admin.php");
		exit;
	}
	// select loggedin users detail
	$res=mysql_query("SELECT * FROM users WHERE userId=".$_SESSION['user']);
	$userRow=mysql_fetch_array($res);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['userName']; ?></title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />
<style>
.button {
  display: inline-block;
  border-radius: 4px;
  background-color: #ff9900;
  border: none;
  color: #FFFFFF;
  
  font-size: 15px;
  padding: 20px;
  width: 200px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 25px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}
</style>
</head>
<body background="admin.jpeg">
       
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <center><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <marquee 
 
     direction="left"
     
     scrollamount="4"
     scrolldelay="2"
     behavior="alternate"
     
     
     
     ><font face = "verdana" size = "7"><span class="glyphicon glyphicon-user"></span>&nbsp;Welcome <?php echo $userRow['userName']; ?>&nbsp;<span class="caret"></span></a></center></marquee></font>
	     
              <ul class="dropdown-menu">
               <li><center><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;<button onclick="Sign Out">Sign Out</button></a></center></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 
     <div>
	
    <center><a href="student.php" style="color: #000000"><button class="button" style="align:middle"><span>Make a new Account for student</span></button></a></center>
   
    </div>
    <div>
    
    <center><a href="faculty.php" style="color: #000000"><button class="button" style="align:middle"><span>Make a new account for faculty</span></button></a></center>
    
    </div>
    <div>
    
    <center><a href="department.php" style="color: #000000"><button class="button" style="align:middle"><span>Department Detail</span></button></a></center>
    
    </div>
    <div>
    <center><a href="course.php" style="color: #000000"><button class="button" style="align:middle"><span>Add Course</span></button></a></center>
    </div>
    <div>
   <center><a href="attendance.php" style="color: #000000"><button class="button" style="align:middle"><span>Update Attendance</span></button></a></center>
    </div>

	<div id="wrapper">

     </div>
    <script src="assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    
</body>
</html>
<?php ob_end_flush(); ?>
