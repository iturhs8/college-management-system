<?php
	ob_start();
	session_start();
	require_once 'dbconnect.php';
	
	// if session is not set this will redirect to login page
	if( !isset($_SESSION['faculty']) ) {
		header("Location:loginfaculty.php");
		exit;
	}
	// select loggedin users detail
	$res=mysql_query("SELECT * FROM faculty WHERE facultyId=".$_SESSION['faculty']);
	$facultyRow=mysql_fetch_array($res);
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $facultyRow['facultyName']; ?></title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />

<style>
.button {
    background-color: #008CBA;
    border: none;
    color: white;
    padding: 16px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 20px;
    margin: 4px 2px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    cursor: pointer;
}

.button1 {
    background-color: white; 
    color: black; 
    border: 2px solid  #008CBA;
}

.button1:hover {
    background-color:  #008CBA;
    color: white;
}
</style>
</head>
<body background = "faculty.jpg">
       
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <center><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <marquee 
 
     direction="left"
     
     scrollamount="4"
     scrolldelay="2"
     behavior="alternate"
     
     
     
     ><font face = "verdana" size = "7" color = "black" ><span class="glyphicon glyphicon-user"></span>&nbsp;Welcome <?php echo $facultyRow['facultyName']; ?>&nbsp;<span class="caret"></span></a></center></marquee></font>
	     
              <ul class="dropdown-menu">
               <li><center><a href="logoutfaculty.php?logoutfaculty"><span class="glyphicon glyphicon-log-out"></span>&nbsp;<button onclick="Sign Out">Sign Out</button></a></center></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 
     
    <div>
   <center><font size = "6"><a href="attendance.php" style="color: #000000"><button class="button button1">Update Attendance</button></a></font></center>
    </div>
    
    <div>
   <center><font size = "6"><a href="grade.php" style="color: #000000"><button class="button button1">Update Grade</button></a></font></center>
    </div>

	<div id="wrapper">

     </div>
    <script src="assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    
</body>
</html>
<?php ob_end_flush(); ?>
