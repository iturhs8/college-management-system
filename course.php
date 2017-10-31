<?php
	ob_start();
	session_start();
	if( isset($_SESSION['course'])!="" ){
		header("Location: home.php");
	}
	
	include_once 'dbconnect.php';

	$error = false;
	
	if ( isset($_POST['btn-signup']) ) {
	$dno = trim($_POST['dno']);
	$dno = strip_tags($dno);
	$dno = htmlspecialchars($dno);
		
	$courseno = trim($_POST['courseno']);
	$courseno = strip_tags($courseno);
	$courseno = htmlspecialchars($courseno);
		
	$coursename = trim($_POST['coursename']);
	$coursename = strip_tags($coursename);
	$coursename = htmlspecialchars($coursename);
	
	$noofcredits= trim($_POST['noofcredits']);
	$noofcredits = strip_tags($noofcredits);
	$noofcredits = htmlspecialchars($noofcredits);
	
	if (empty($dno)) {
			$error = true;
			$dnoError = "Please enter department number";
		} 		
		//basic email validation
		
			$query = "SELECT courseno FROM course WHERE courseno='$courseno'";
			$result = mysql_query($query);
			$count = mysql_num_rows($result);
			if($count!=0){
				$error = true;
				$emailError = "The course already exists";
			}
		if (empty($coursename)) {
			$error = true;
			$nameError = "Please enter the course name";
		} else if (strlen($coursename) < 3) {
			$error = true;
			$nameError = "Name must have atleat 3 characters.";
		} else if (!preg_match("/^[a-zA-Z ]+$/",$coursename)) {
			$error = true;
			$nameError = "Name must contain alphabets and space.";
		}
		if (empty($noofcredits)) {
			$error = true;
			$noofcreditsError = "Please enter number of credits";
		}
	
	if( !$error ) {
			
	$query = "INSERT INTO course(departno,courseno,coursename,credits) VALUES('$dno','$courseno','$coursename','$noofcredits')";
	$res = mysql_query($query);}
				
	if ($res) {
		$errTyp = "success";
		$errMSG = "Successfully entered";
		unset($dno);
		unset($courseno);
		unset($coursename);
		unset($noofcredits);
		} else {
			$errTyp = "danger";
			$errMSG = "Something went wrong, try again later...";	
		       }	
				
		}
	
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Course</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<center><body background = "book.jpg">

<div class="container">

	<div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    
    	<div class="col-md-12">
        
        	<div class="form-group">
            	<font size = "20"><h2 class="">Course</h2></font>
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
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
            	<input type="int" name="dno" class="form-control" placeholder="Depart no" maxlength="50" value="<?php echo $dno ?>" />
                </div>
                <span class="text-danger"><?php echo $nameError; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            	<input type="int" name="courseno" class="form-control" placeholder="Course no" maxlength="40" value="<?php echo $courseno ?>" />
                </div>
                <span class="text-danger"><?php echo $emailError; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            	<input type="text" name="coursename" class="form-control" placeholder="course" maxlength="15" value="<?php echo $coursename ?>" />
                </div>
                <span class="text-danger"><?php echo $passError; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            	<input type="int" name="noofcredits" class="form-control" placeholder="credits" maxlength="15" value="<?php echo $noofcredits ?>" />
                </div>

                <span class="text-danger"><?php echo $passError; ?></span>
            </div>
            
            <div class="form-group">
            	<button type="submit" class="btn btn-block btn-primary" name="btn-signup">Add course</button>
            </div>
            
            <div class="form-group">
            	<a href="home.php"><font size="10">Go Back</font></a>
            </div>
        
        </div>
   
    </form>
    </div>	

</div>

</body></center>
</html>
<?php ob_end_flush(); ?>
