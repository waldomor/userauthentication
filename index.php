<?php

require_once './config.php';
if (isset($_POST["sub"])) {
  require_once "phpmailer/class.phpmailer.php";

  $name = trim($_POST["name"]);
  $pass = trim($_POST["pass1"]);
  $email = trim($_POST["email"]);
  $pass1 = test_input($_POST["name"]);
  $sql = "SELECT COUNT(*) AS count from users where email = :email_id";
  try {
    $stmt = $DB->prepare($sql);
    $stmt->bindValue(":email_id", $email);
    $stmt->execute();
    $result = $stmt->fetchAll();


  	
    if ($result[0]["count"] > 0) {
      $msg = "Email already exist";
      $msgType = "warning";
    } else if(strlen($pass1) < 6)
					 { echo "<script>alert('Your name Must be 6 characters or more!');</script>";
         }   else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $emailErr = "Invalid email format";
}  else  {
      $sql = "INSERT INTO `users` (`name`, `pass`, `email`) VALUES " . "( :name, :pass, :email)";
      $stmt = $DB->prepare($sql);
      $stmt->bindValue(":name", $name);
      $stmt->bindValue(":pass", md5($pass));
      $stmt->bindValue(":email", $email);
      $stmt->execute();
      $result = $stmt->rowCount();


      if ($result > 0) {
       
        $lastID = $DB->lastInsertId();

        $message = '<html><head>
                <title>Email Verification</title>
                </head>
                <body>';
        $message .= '<h1>Hi ' . $name . '!</h1>';
        $message .= '<p><a href="'.SITE_URL.'activate.php?id=' . base64_encode($lastID) . '">CLICK TO ACTIVATE YOUR ACCOUNT</a>';
        $message .= "</body></html>";
        

        $mail = new PHPMailer(true);
        $mail->IsSMTP(); 

        $mail->SMTPAuth = true;                  
        $mail->SMTPSecure = "tls";                
        $mail->Host = "***";      
        $mail->Port = 587;                 
              

        $mail->Username = '**********@gmail.com';
        $mail->Password = '************';

        $mail->SetFrom('**********@gmail.com', 'waldomar');
        $mail->AddAddress($email);

        $mail->Subject = trim("Email Verifcation - ***");
        $mail->MsgHTML($message);

        try {
          $mail->send();
          $msg = "An email has been sent for verfication.";
          $msgType = "success";
        } catch (Exception $ex) {
          $msg = $ex->getMessage();
          $msgType = "warning";
        }
      } else {
        $msg = "Failed to create User";
        $msgType = "warning";
      }
    }
  } catch (Exception $ex) {
    echo $ex->getMessage();
  }
}

include './header.php';
?>
<?php if ($msg <> "") { ?>
  <div class="alert alert-dismissable alert-<?php echo $msgType; ?>">
    <button data-dismiss="alert" class="close" type="button">x</button>
    <p><?php echo $msg; ?></p>
  </div>
<?php } ?>


<link href="css/bootstrap.min.css" rel="stylesheet">
<h3 class="text-center">Sign up</h3>
<link href="css/styles.css" rel="stylesheet"> <hr>
<div class="container">
  <div class="row">
    <div class="col-lg-6">
      <div class="container center_div">                      <center>
               
              
        <form class="form-horizontal contactform" action="index.php" method="post" name="f" onsubmit="return validateForm();">
              <fieldset>
                  

            <div class="form-group">

              <label class="col-lg-12 control-label" for="name">Name:
                <input type="text" placeholder="Your Name" id="name" class="form-control" name="name">
              </label>
            </div>

            <div class="form-group">
              <label class="col-lg-12 control-label" for="email">Email:
                <input type="text" placeholder="Your Email" id="email" class="form-control" name="email">
              </label>
            </div>

            <div class="form-group">
              <label class="col-lg-12 control-label" for="pass1"  style="">Password:
             
                <input type="password" placeholder="Password" id="pass1" class="form-control" name="pass1" >
   </label>
            </div>

            <div class="form-group">
              <label class="col-lg-12 control-label" for="pass1" style=";">Confirm Password:
         <input type="password" placeholder="Password" id="pass2" class="form-control" name="pass2" style="">
              </label>
</div>
            <div style="height: 10px;clear: both"></div>
            <div class="form-group">
              <div class="col-lg-12">
                <button class="btn btn-primary" type="submit" name="sub">Submit</button> 
              </div>
              <br>
            
            </div>
          </fieldset>  </center>
          <br>          <br>

                        <div class="text-center">already a member?  <a href="login2.php">login</a></div>
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

    var your_name = $.trim($("#name").val());
    var your_email = $.trim($("#email").val());
    var pass1 = $.trim($("#pass1").val());
    var pass2 = $.trim($("#pass2").val());



    if (!isValidEmail(your_email)) {
      alert("Enter valid email.");
      $("#email").focus();
      return false;
    }

    if (pass1 == "") {
      alert("Enter password");
      $("#pass1").focus();
      return false;
    } else if (pass1.length < 6) {
      alert("Password must be atleast 6 character.");
      $("#pass1").focus();
      return false;
    }

    if (pass1 != pass2) {
      alert("Password does not matched.");
      $("#pass2").focus();
      return false;
    }

    return true;
  }

  function isValidEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
  }


</script>

<?php
include './footer.php';
?>