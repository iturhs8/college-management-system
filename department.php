<?php
	ob_start();
	session_start();
	if( isset($_SESSION['department'])!="" ){
		header("Location: home.php");
	}
	include_once 'dbconnect.php';

	$error = false;

	if ( isset($_POST['btn-signup']) ) {
		
		// clean user inputs to prevent sql injections
		$number = trim($_POST['number']);
		$number = strip_tags($number);
		$number = htmlspecialchars($number);
		
		$name = trim($_POST['name']);
		$name = strip_tags($name);
		$name = htmlspecialchars($name);
		
		// basic name validation
		if (empty($number)) {
			$error = true;
			$numberError = "Please enter department number.";}

		if (empty($name)) {
			$error = true;
			$nameError = "Please enter name.";
		} else if (strlen($name) < 2) {
			$error = true;
			$nameError = "Name must have atleat 2 characters.";
		} else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
			$error = true;
			$nameError = "Name must contain alphabets and space.";
		}
		
		//basic email validation
			// check email exist or not
			$query = "SELECT Department_name FROM department WHERE Department_name='$name'";
			$result = mysql_query($query);
			$count = mysql_num_rows($result);
			if($count!=0){
				$error = true;
				$nameError = "Provided Department is already added";
			}
		
		if( !$error ) {
			
			$query = "INSERT INTO department(Department_No,Department_name) VALUES('$number','$name')";
			$res = mysql_query($query);
				
			if ($res) {
				$errTyp = "success";
				$errMSG = "Successfully registered";
				unset($number);
				unset($name);
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

	<div id="login-form">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    
    	<div class="col-md-12">
        
        	<div class="form-group">
            	<center><font size="20"><h2 class="">Department</h2></font></center>
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
            	<center><input type="integer" name="number" class="form-control" placeholder="Enter Number" maxlength="50" value="<?php echo $number ?>" /></center>
                </div>
                <span class="text-danger"><?php echo $numberError; ?></span>
            </div>
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
            	<center><input type="text" name="name" class="form-control" placeholder="Enter Name" maxlength="50" value="<?php echo $name ?>" /></center>
                </div>
                <span class="text-danger"><?php echo $nameError; ?></span>
            </div>
            
            
            <div class="form-group">
            	<center><button type="submit" class="btn btn-block btn-primary" name="btn-signup">Add</button></center>
            </div>
        <div>
            <center><a href="home.php"><font size="8">Go Back</font></a></center>
            </div>
        </div>
   
    </form>
    </div>	

</div>

</body>
</html>
<?php ob_end_flush(); ?>
