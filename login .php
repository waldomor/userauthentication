<?php

include './header.php';

session_start();

include_once("config1.php");

if(isset($_POST['login']))

{

$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

$passo = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
$pass = md5 ($passo);

   $stmt = $con->prepare("SELECT * FROM users WHERE email=? AND pass=? LIMIT 1");
   $stmt->bind_param('ss', $email, $pass);  
    
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    
if (count($user) > 0) 

{   

$id=$user["id"] ;

$name=$user["name"] ;

 if ($user["statuss"] == "pending")

{
	$_SESSION['action1']="Verify your Email Id by clicking  the link In your mailbox";

} else if ( $email === false ) {

$_SESSION['action1']="Invalid email or password";

    } else {

$_SESSION['login']=$email;

$_SESSION['id']=$id ;

$_SESSION['name']=$name ;

$extra="welcome.php";

$host=$_SERVER['HTTP_HOST'];

$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');

header("location:http://$host$uri/$extra");

exit();

      }

}

else

{

$_SESSION['action1']="Invalid email or password";

$extra="login.php";

$host  = $_SERVER['HTTP_HOST'];

$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');

header("location:http://$host$uri/$extra");

exit();

 }
   $stmt->free_result();
    $stmt->close();
}
else 
{   

}
$con->close();

 ?>


<link href="css/bootstrap.min.css" rel="stylesheet">
 <h1 class="text-center"> Session Expired! </h1>
		<h2 class="text-center">Login again please</h2
<link href="css/styles.css" rel="stylesheet"> <hr>
<div class="container">
  <div class="row">
    <div class="col-lg-6">
      <div class="container center_div">                      <center>
                <font color="#FF0000">
                                            <?php echo $_SESSION['action1']; ?>
                                            <?php echo $_SESSION['action1']="";?>
                                        </font>
              
        <form class="form-horizontal contactform" action="login.php" method="post" name="insert" onsubmit="return validateForm();">
              <fieldset>
                  

           

            <div class="form-group">
              <label class="col-lg-12 control-label" for="email">Email:
                <input type="text" placeholder="Your Email" id="email" class="form-control" name="email">
              </label>
            </div>

            <div class="form-group">
              <label class="col-lg-12 control-label" for="pass"  style="">Password:
             
                <input type="password" placeholder="Password" id="pass" class="form-control" name="pass" >
   </label>
            </div>

            
            <div style="height: 10px;clear: both"></div>
            <div class="form-group">
              <div class="col-lg-12">
                <button class="btn btn-primary" type="submit" name="login">Submit</button> 
              </div>
              <br>
            
            </div>
          </fieldset>  </center>
          <br>          <br>

                        <div class="text-center">not yet a member?  <a href="index.php">Sign up</a></div>
           <br>
          
        </form>
      </div>
    </div>
  </div>
</div>
<hr>

 <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
            <script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
  function validateForm() {

    var your_email = $.trim($("#email").val());
    var pass = $.trim($("#pass").val());


   
    if (!isValidEmail(your_email)) {
      alert("Enter valid email.");
      $("#email").focus();
      return false;
    }

    if (pass == "") {
      alert("Enter password");
      $("#pass").focus();
      return false;
    } else if (pass.length < 6) {
      alert("Password must be atleast 6 character.");
      $("#pass").focus();
      return false;
    }


  function isValidEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
  }


</script>
 
<div class="d-flex justify-content-center">

<?php
include './footer.php';
?>
</div>
 