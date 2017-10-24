<?php
	ob_start();
	session_start();
	if( isset($_SESSION['department'])!="" ){
		header("Location: home.php");
	}
	
	include_once 'dbconnect.php';

	$error = false;
	
	if ( isset($_POST['btn-signup']) ) {
	$departno = trim($_POST['departno']);
	$departno = strip_tags($departno);
	$departno = htmlspecialchars($departno);
		
	$departname = trim($_POST['departname']);
	$departname = strip_tags($departname);
	$departname = htmlspecialchars($departname);
	
	if (empty($departname)) {
		$error = true;
		$nameError = "Please enter department name.";}
	if (empty($departno)) {
		$error = true;
		$nameError = "Please enter department number.";}
	/*else if (!preg_match("/^[a-zA-Z ]+$/",$departname)) {
			$error = true;
			$nameError = "Name must contain alphabets and space.";
		}*/
		
	if( !$error ) {
			
			$query = "INSERT INTO department(Department_No,Department_name) VALUES('$departno','$departname')";
			$res = mysql_query($query);
			if ($res) {
				$errTyp = "success";
				$errMSG = "Successfully Entered";
				unset($departno);
				unset($departname);
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
<title>Department</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body background = "depart.jpg">

<div class="container">

	<div id="register">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    
    	<div class="col-md-12">
        
        	<div class="form-group">
            	<center><h2 class="">Department</h2></center>
            </div>
        
        	<!--<div class="form-group">
            	<hr />
            </div>-->
            
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
            	<center><input type="int" name="Department_No" class="form-control" placeholder="Enter department no" maxlength="50" value="<?php echo $departno ?>" /></center>
                </div>
                <span class="text-danger"><?php echo $nameError; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            	<center><input type="name" name="Department name" class="form-control" placeholder="Enter department name" maxlength="40" value="<?php echo $departname ?>" /></center>
                </div>
                <span class="text-danger"><?php echo $emailError; ?></span>
            </div>
            
            
            
            <div class="form-group">
            	<center><button type="submit" class="btn btn-block btn-primary" >Add</button></center>
            </div>
            
            <div class="form-group">
            	<hr />
            </div>
            <div>
            <center><a href="home.php">Go Back</a></center>
            </div>
            
            <!--<div class="form-group">
            	<a href="index.php">Sign in Here...</a>
            </div>-->
        
        </div>
   
    </form>
    </div>	

</div>

</body>
</html>
<?php ob_end_flush(); ?>
