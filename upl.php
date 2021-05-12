<?php
include("config1.php"); 

$sql = "select * from images";
$result = mysqli_query($con,$sql);
//$row = mysqli_fetch_array($result);
while($row = mysqli_fetch_assoc($result)) {

$image = $row['name'];
$image_src = "/image/".$image;
$statuss = ['statuss'];


?>

<center> 

<?php 
    if ($row['statuss']=="approved"){   
echo "<br><img style='border-radius:80%;width: 150px;' src='$image_src' />"; 
    }
 else {
    echo "<br><img alt='$image is pending approval!' />";
}

}

?> 

<div>
<br><br>
<div>


