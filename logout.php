<?php 

session_start();
$_SESSION['login']=="";
session_unset();
?>
<script language="javascript">
document.location="login .php";
</script>