<?php
include("config1.php"); 

$sql = "select name from images1 where id=3";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);

$image = $row['name'];
$image_src = "upload/".$image;

?>

<link href="css/styles.css" rel="stylesheet">
            

<img id="mag" src='<?php echo $image_src;  ?>' alt='<?php echo $image;  ?>' />




            