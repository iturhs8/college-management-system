<?php
	ob_start();
	session_start();
	if( isset($_SESSION['grade'])!="" ){
		header("Location: facultyhome.php");
	}
	include_once 'dbconnect.php';

	$error = false;
	
	$rno=$_POST['rno'];
	$sname=$_POST['sname'];
	$course=$_POST['course'];
	$marks=$_POST['marks'];
	$grades=$_POST['grades'];
	if ( isset($_POST['btn-add']) ) {
		
		// clean user inputs to prevent sql injections
		$rno = trim($_POST['rno']);
		$rno = strip_tags($rno);
		$rno = htmlspecialchars($rno);
		
		$sname = trim($_POST['sname']);
		$sname = strip_tags($sname);
		$sname = htmlspecialchars($sname);
		
		$course = trim($_POST['course']);
		$course = strip_tags($course);
		$course = htmlspecialchars($course);
		
		$marks = trim($_POST['marks']);
		$marks = strip_tags($marks);
		$marks = htmlspecialchars($marks);
		
		$grades = trim($_POST['grades']);
		$grades = strip_tags($grades);
		$grades = htmlspecialchars($grades);
		
		$query = "SELECT courseno FROM grade WHERE courseno='$course'";
			$result = mysql_query($query);
			$count = mysql_num_rows($result);
			if($count!=0){
			$error = true;
			$sql = "UPDATE grade ". "SET marks = '$marks', grades = '$grades' ". 
               "WHERE rollNo = '$rno' and courseno = '$course'";
            $retval = mysql_query( $sql);
            
            if(! $retval ) {
               die('Could not update data: ' . mysql_error());
            }
            echo "Updated data successfully\n";
            			unset($rno);
				unset($sname);
				unset($course);
				unset($marks);
				unset($grades);
			}
		
		if( !$error ) {
			
			$query = "INSERT INTO grade(sname,courseno,marks,grades,rollNo) VALUES('$sname','$course','$marks','$grades','$rno')";
			$res = mysql_query($query);
				
			if ($res) {
				$errTyp = "success";
				$errMSG = "Successfully updated";
				unset($rno);
				unset($sname);
				unset($course);
				unset($marks);
				unset($grades);
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Attendance</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />
</head><center>
<body background="border.jpg">

<div class="container">

	<div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    
    	<div class="col-md-12">
        
        	<div class="form-group">
            	<font size="20"><h2 class="">Update Attendance</h2></font>
            </div>
            
            <?php
			if ( isset($errMSG) ) {
				
				?>
				<div class="form-group">
            	<div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
				<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
            	</div>
                <?php
			}
			?>
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            	<input type="text" name="rno" class="form-control" placeholder="roll no" maxlength="40" value="<?php echo $rno ?>" />
                </div>
                <span class="text-danger"><?php echo $rnoError; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
            	<input type="text" name="sname" class="form-control" placeholder="s name" maxlength="50" value="<?php echo $sname ?>" />
                </div>
                <span class="text-danger"><?php echo $nameError; ?></span>
            </div>
            
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            	<input type="text" name="course" class="form-control" placeholder="course no" maxlength="15" value="<?php echo $course ?>" />
                </div>
                <span class="text-danger"><?php echo $passError; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            	<input type="float" name="marks" class="form-control" placeholder="marks" maxlength="15" value="<?php echo $marks ?>" />
                </div>
                <span class="text-danger"><?php echo $marksError; ?></span>
            </div>
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            	<input type="text" name="grades" class="form-control" placeholder="grade" maxlength="15" value="<?php echo $grade ?>" />
                </div>
                <span class="text-danger"><?php echo $gradeError; ?></span>
            </div>
            
            <div class="form-group">
            	<button type="submit" class="btn btn-block btn-primary" name="btn-add">Update</button>
            </div>
            
            
            <div class="form-group">
            	<a href="facultyhome.php">Go back</a>
            </div>
        
        </div>
   
    </form>
    </div>	

</div>

</body></center>
</html>
<?php ob_end_flush(); ?>	
