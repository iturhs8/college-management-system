<?php
	ob_start();
	session_start();
	if( isset($_SESSION['attendance'])!="" ){
		header("Location: home.php");
	}
	include_once 'dbconnect.php';

	$error = false;
	
	$rno=$_POST['rno'];
	$sname=$_POST['sname'];
	$course=$_POST['course'];
	$percent=$_POST['percent'];
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
		
		$percent = trim($_POST['percent']);
		$percent = strip_tags($percent);
		$percent = htmlspecialchars($percent);
		
		
		if( !$error ) {
			
			$query = "INSERT INTO attendance(rno,sname,course_no,percent) VALUES('$rno','$sname','$course','$percent')";
			$res = mysql_query($query);
				
			if ($res) {
				$errTyp = "success";
				$errMSG = "Successfully updated";
				unset($rno);
				unset($sname);
				unset($course);
				unset($percent);
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
</head>
<body>

<div class="container">

	<div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    
    	<div class="col-md-12">
        
        	<div class="form-group">
            	<h2 class="">Update Attendance</h2>
            </div>
        
        	<div class="form-group">
            	<hr />
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
            	<input type="int" name="roll_no" class="form-control" placeholder="roll no" maxlength="40" value="<?php echo $rno ?>" />
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
            	<input type="text" name="course no" class="form-control" placeholder="course no" maxlength="15" value="<?php echo $course ?>" />
                </div>
                <span class="text-danger"><?php echo $passError; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            	<input type="int" name="percentage" class="form-control" placeholder="percent" maxlength="15" value="<?php echo $percent ?>" />
                </div>
                <span class="text-danger"><?php echo $passError; ?></span>
            </div>
            <div class="form-group">
            	<hr />
            </div>
            
            <div class="form-group">
            	<button type="submit" class="btn btn-block btn-primary" name="btn-add">Update</button>
            </div>
            
            <div class="form-group">
            	<hr />
            </div>
            
            <div class="form-group">
            	<a href="home.php">Go back</a>
            </div>
        
        </div>
   
    </form>
    </div>	

</div>

</body>
</html>
<?php ob_end_flush(); ?>	
