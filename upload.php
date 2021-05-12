<?php include ("header.php"); ?>

<?php

include ("config1.php");
session_start();
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


if (isset($_POST["upload"])) {
    
    $fileinfo = @getimagesize($_FILES["file-input"]["tmp_name"]);
    $width = $fileinfo[0];
    $height = $fileinfo[1];
    
    $allowed_image_extension = array(
        "png",
        "jpg",
        "jpeg",
        "png",
        "gif",
        "mp3",
        "mp4"
    );
    
    
    $file_extension = pathinfo($_FILES["file-input"]["name"], PATHINFO_EXTENSION);
    
   
    if (! file_exists($_FILES["file-input"]["tmp_name"])) {
        $response = array(
            "type" => "error",
            "message" => "Choose image file to upload."
        );
        echo "<script>alert('what are trying to do man! eheh ☠');</script>";
                 echo "<script>window.location = 'upload.php';</script>";;
    }    
    else if (! in_array($file_extension, $allowed_image_extension)) {
        $response = array(
            "type" => "error",
            "message" => "Upload valiid images. Only PNG and JPEG are allowed."
        );
        echo "<script>alert('hacking not allowed so far! nice try eheh ☠');</script>";
                 echo "<script>window.location = 'upload.php';</script>";
        echo $result;
    }   
    else if (($_FILES["file-input"]["size"] > 2000000)) {
        $response = array(
            "type" => "error",
            "message" => "Image size exceeds 2MB"
        ); 
             echo "<script>alert('哦！！！ too much!🐷');</script>";
             echo "<script>window.location = 'upload.php';</script>";
    }     else {
        $name = $_FILES["file-input"]["name"];
        $target = "image/" . basename($_FILES["file-input"]["name"]);
        if (move_uploaded_file($_FILES["file-input"]["tmp_name"], $target)) {
           $response = array(
                "type" => "success",
                "message" => "<br>file uploaded successfully, we'll evaluate your request as soon as possible👮."
            );                
                 $stmt = $con->prepare("INSERT INTO images(name) VALUES (?)");
                 $stmt->bind_param('s', $name);
                 $stmt->execute(); 
                 $stmt->bind_result($name); 
                 $stmt->store_result();       
                 
        } else {
            $response = array(
                "type" => "error",
                "message" => "Problem in uploading image files."
            );
                 echo "<script>alert('what are trying to do man! eheh ☠');</script>";
                 echo "<script>window.location = 'upload.php';</script>";;
        }
        $stmt->close();
    }

}


?>




<html>
<head>

<meta http-equiv="refresh" content="300.07;url=logout.php" />

</head>
<body><center>
    <form id="frm-image-upload" action="upload.php" name='img'
        method="post" enctype="multipart/form-data">
        <div class="form-row">
            <h2>Choose a file (preferably, an image, an audio or a video)</h2>
            <br>
            <div>
                <input type="file" class="file-input" name="file-input" >
            </div>
        </div>

        <div class="button-row">
            <input type="submit" id="btn-submit" name="upload"
                value="Upload" onchange="return fileValidation()">
        </div>
    </form>
    <?php if(!empty($response)) { ?>
    <div class="response <?php echo $response["type"]; ?>"><?php echo $response["message"]; ?></div>
    <?php }?>
</body></center>

</html>

 
<br>
<br>
<br><center>
<div ><font color="#FF0000" style="font-size:30px;"><?php echo $_SESSION['name']; ?></font>   
<a style="font-size:30px;" href="welcome.php"> return to welcome page! </a>
 </div>
</center>
<br>
<br>
<center>
<h3> here your files previews (if approved) and names. others pending as example</h3>
</center>

 <script> 
        function fileValidation() { 
            var fileInput =  
                document.getElementById('submit'); 
              
            var filePath = fileInput.value; 
          
            var allowedExtensions =  
                    /(\.jpg|\.jpeg|\.png|\.gif\.mp3\.mp4)$/i; 
              
            if (!allowedExtensions.exec(filePath)) { 
                fileInput.value = ''; 
                return false; 
            }  
            else  
            { 
              
                if (fileInput.files && fileInput.files[0]) { 
                    var reader = new FileReader(); 
                    reader.onload = function(e) { 
                        document.getElementById( 
                            'imagePreview').innerHTML =  
                            '<img src="' + e.target.result 
                            + '"/>'; 
                    }; 
                      
                    reader.readAsDataURL(fileInput.files[0]); 
                } 
            } 
        } 
    </script> 

<?php include ("upl.php"); ?>

<?php include ("footer.php"); ?>

<?php
} else {
header('location:logout2.php');	
}
?>