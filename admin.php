<?php
	ob_start();
	session_start();
	require_once 'dbconnect.php';
	
	if ( isset($_SESSION['users'])!="" ) {
		header("Location: home.php");
		exit;
	}
	
	$error = false;
	
	if( isset($_POST['btn-login']) ) {	
		
		$name = trim($_POST['name']);
		$name = strip_tags($name);
		$name = htmlspecialchars($name);
		
		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
		
		if(empty($name)){
			$error = true;
			$emailError = "Please enter your user name.";
		
		}
		
		if(empty($pass)){
			$error = true;
			$passError = "Please enter your password.";
		}
		
		if (!$error) {
			
			$password = hash('sha256', $pass); 
		
			$res=mysql_query("SELECT userId, userEmail, userPass FROM users WHERE userName='$name'");
			$row=mysql_fetch_array($res);
			$count = mysql_num_rows($res);
			
			if( $count == 1 && $row['userPass']==$password ) {
				$_SESSION['user'] = $row['userId'];
				header("Location: home.php");
			} else {
				$errMSG = "Incorrect Credentials, Try again...";
			}
				
		}
		
	}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Page</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="style.css" type="text/css" />
<style>
.boxed {
   width: 320px;
    padding: 10px;
    border: 5px solid black;
    margin: 500; 
}
</style>
</head>
<center><body background="image2.jpg">

<div class="container">


	<div id="login-form">
    
    <div class="boxed">
    
    	<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    	<div class="col-md-12">
        
        	<div class="form-group">
            	<center><h2 class="">Admin Page</h2></center>
           
            <?php
			if ( isset($errMSG) ) {
				
				?>
				<div class="form-group">
            	<div class="alert alert-danger">
				<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
            	</div>
                <?php
			}
			?>
            <center><img src="icon.png" width="200" height="200"></center>
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            <center>	<input type="text" name="name" class="form-control" placeholder="Your Username" value="<?php echo $name; ?>" maxlength="40" /></center>
                </div>
                <span class="text-danger"><?php echo $emailError; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            	<center><input type="password" name="pass" class="form-control" placeholder="Your Password" maxlength="15" /></center>
                </div>
                <span class="text-danger"><?php echo $passError; ?></span>
            </div>
            
            
            <div class="form-group">
            <center>	<button type="submit" class="btn btn-block btn-primary" name="btn-login">Sign In</button></center>
             
        </div>
   
    </form>
    
    </div>
    	
</div>
</div>
</body>
<div>
            <font face = "Bedrock" color = "#000000" size = "6"><a href="firstpage.php">Go back to the login page</a></font>
            </div></center>
</html>
<?php ob_end_flush();?>
