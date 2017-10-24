<!DOCTYPE html>
<html>
<head>
<style>
body {
    margin: 0;
    font-family: 'Lato', sans-serif;
}
#background{
    position:absolute;
    z-index:0;
    background:white;
    display:block;
    min-height:50%; 
    min-width:50%;
    color:yellow;
}


#bg-text
{
    color:lightgrey;
    font-size:80px;
    transform:rotate(360deg);
    -webkit-transform:rotate(360deg);
}

.overlay {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0, 0.9);
    overflow-x: hidden;
    transition: 0.5s;
}

.overlay-content {
    position: relative;
    top: 25%;
    width: 100%;
    text-align: center;
    margin-top: 30px;
}

.overlay a {
    padding: 8px;
    text-decoration: none;
    font-size: 36px;
    color: #818181;
    display: block;
    transition: 0.3s;
}

.overlay a:hover, .overlay a:focus {
    color: #f1f1f1;
}

.overlay .closebtn {
    position: absolute;
    top: 20px;
    right: 45px;
    font-size: 60px;
}

@media screen and (max-height: 450px) {
  .overlay a {font-size: 20px}
  .overlay .closebtn {
    font-size: 40px;
    top: 15px;
    right: 35px;
  }
}
</style>
</head>
<body>

<div id="myNav" class="overlay">

  <!-- Button to close the overlay navigation -->
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

  <!-- Overlay content -->
  <div class="overlay-content">
    <a href="index.php">Admin Log In</a>
    <a href="#">Faculty Log In</a>
    <a href="#">Student Log In</a>
    
  </div>

</div>
<marquee 
 
     direction="left"
     
     scrollamount="4"
     scrolldelay="2"
     behavior="alternate"
     
     
     
     ><font face = "verdana" size = "4">
<h1>NATIONAL INSTITUTE OF TECHNOLOGY, KARNATAKA</h1></font></marquee>
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Click to Log In</span>
<center><img src = "nitk_logo.png"></center>
<div id="background">
  <p id="bg-text">COLLEGE MANAGEMENT SYSTEM</p>
	</div>
<script>
function openNav() {
    document.getElementById("myNav").style.width = "100%";
}

function closeNav() {
    document.getElementById("myNav").style.width = "0%";
}

</script>
 
</body>
</html>

