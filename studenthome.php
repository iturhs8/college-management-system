<?php
	ob_start();
	session_start();
	require_once 'dbconnect.php';
	
	if( !isset($_SESSION['student']) ) {
		$_SESSION['studentName'] = $studentName;
		header("Location:loginstudent.php");
		
		exit;
	}
	
	// select loggedin users detail
	$res1=mysql_query("SELECT * FROM student WHERE studentId=".$_SESSION['student']);
	//print_r($res1);
	$studentRow=mysql_fetch_array($res1);
	
	 
	$query="SELECT * FROM course";
	$res=mysql_query($query);
	$num = mysql_num_rows($res);
	
	$new=$_SESSION['studentName'];
	$newquery = "SELECT * FROM attendance WHERE rno IN(SELECT s.rollNo FROM student s WHERE s.studentname= '$new')";
	$newres=mysql_query($newquery);
	$num2 = mysql_num_rows($newres);
	
	$query2="SELECT * FROM grade g WHERE g.rollNo IN(SELECT s.rollNo FROM student s WHERE s.studentname= '$new')";
	$res2=mysql_query($query2);
	
	$percent = "SELECT percent FROM attendance WHERE rno IN(SELECT * FROM attendance WHERE rno IN(SELECT s.rollNo FROM student s WHERE s.studentname= '$new'))";
	
	
	$query3="SELECT * FROM course WHERE courseno IN (SELECT courseno FROM attendance WHERE rno IN(SELECT s.rollNo FROM student s WHERE s.studentname= '$new'))";
	$res3=mysql_query($query3);
	
	$query4="SELECT * FROM grade WHERE courseno IN (SELECT courseno FROM attendance WHERE rno IN(SELECT s.rollNo FROM student s WHERE s.studentname= '$new'))";
	$res4=mysql_query($query4);
	
	
	$i = 0;
	while($i<$num2){
	$f2=mysql_result($newres,$i,"percent");
	if ($f2 < 75 ){
		$f1 = mysql_result($res3,$i,"coursename");
		echo "Your attendance in $f1 is less than 75%"; echo "<br>";} $i++;}
	
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $studentRow['studentName']; ?></title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<center>
<body background = "homepage.jpg">
<font face = "verdana" size = "7"><span class="glyphicon glyphicon-user"></span>&nbsp;Welcome <?php echo $studentRow['studentName']; ?>&nbsp;<span class="caret"></span></a></center></font>
<table border="2" cellspacing="2" cellpadding="2"><caption >Available Courses</caption>
<tr>
<td>
<font face="Arial, Helvetica, sans-serif">Department No</font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif">Course Number</font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif">Course Name</font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif">Number of credits</font>
</td>

</tr>
<?php
$i=0;
while ($i < $num) {
$f1=mysql_result($res,$i,"departno");
$f2=mysql_result($res,$i,"courseno");
$f3=mysql_result($res,$i,"coursename");
$f4=mysql_result($res,$i,"credits");?>
<tr>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $f1; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $f2; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $f3; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $f4; ?></font>
</td>
</tr>
<?php
$i++;
}?>





<center>

<table border="2" cellspacing="2" cellpadding="2"><caption >Academic Details-<?php echo $_SESSION['studentName']; ?></caption>
<tr>
<td>
<font face="Arial, Helvetica, sans-serif">Course No</font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif">Course Name</font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif">Attendance</font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif">Marks Obtained</font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif">Grade</font>
</td>

</tr>


<?php
$i=0;
while ($i < $num2) {
$f1=mysql_result($newres,$i,"courseno");
$f2=mysql_result($res3,$i,"coursename");
$f3=mysql_result($newres,$i,"percent");
$f4=mysql_result($res4,$i,"marks");
$f5=mysql_result($res4,$i,"grades");?>
<tr>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $f1; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $f2; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $f3; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $f4; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $f5; ?></font>
</td>

</tr>
<?php
$i++;
}?>
</center>


	

               <!--<center><a href="logoutstudent.php?logoutstudent"><span class="glyphicon glyphicon-log-out"></span>&nbsp;<button onclick="Sign Out">Sign Out</button></a></center>-->
               <center><a href="logoutstudent.php?logoutstudent"><button onclick="Sign Out">Sign Out</button></a></center>
              
           
</body></center>
</html>
<?php ob_end_flush(); ?>
