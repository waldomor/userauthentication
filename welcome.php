<br>
<br>
<?php include("header.php"); ?>
<?php
session_start();
include_once("config1.php");
if($_SESSION['login'])
{
    $timeout = 300;
 
if(isset($_SESSION['timeout'])) {
    
    $duration = time() - (int)$_SESSION['timeout'];
    if($duration > $timeout) {
        
        session_destroy();
        session_start();
        header('location:logout.php');
    }
}

$_SESSION['timeout'] = time();


 ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title></title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta http-equiv="refresh" content="300.07;url=logout.php" />

		<link href="css/bootstrap.min.css" rel="stylesheet">
		
		<link href="css/styles.css" rel="stylesheet">
	</head>
	<body>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="navbar-header">
        <a class="navbar-brand" rel="home" href="*****/welcome.php">Home</a>
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
		<span class="sr-only"> </span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		</button>
	</div>
	<div class="collapse navbar-collapse">
		<ul class="nav navbar-nav">
			<li><a href=""></a></li>
			<li><a href=""></a></li>
			<li><a href="">menu</a></li>
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="upload.php">upload a file</a></li>
                <li class="divider"></li>
                <li><a href="#">share</a></li>
                <li class="divider"></li>
                <li><a href="#">about</a></li>
              </ul>
            </li>
		</ul>
		
	</div>
</nav>

  <td width="50%" height=""50%">
       
         </td>
 <td width="50%" height=""50%">
        <?php include("upi.php"); ?>
         </td>
 <td width="50%" height=""50%">
        <?php include("upi2.php"); ?>
         </td>
 <td width="50%" height=""50%">
        <?php include("upi3.php"); ?>
         </td> <td width="50%" height=""50%">
        <?php include("upi4.php"); ?>
         </td>

<div class="container-fluid">
  <div class="col-sm-6">
    <div class="row">
      <div class="col-xs-12">
        <h3></h3>
		<hr >
		<form name="insert" action="" method="post">
     <table width="100%"  border="0">
     <tr><th style="font-size:30px;">Welcome:
    <td ><font color="#FF0000" style="font-size:30px;"><?php echo $_SESSION['name']; ?></font> ||   <a style="font-size:15px;" href="logout2.php">Logout</a></td>
  </tr>
  <tr>
    <th height="62" scope="row"> </th>
    <td ></td>
  </tr>

</table>
 </form>

      </div>
    </div>
    <hr>
    <br>
   
  </div>
</div>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
<?php include("footer.php"); ?>


<?php
} else {
header('location:logout2.php');	
}

?>

