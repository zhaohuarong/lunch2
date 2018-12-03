<?php 
if(!session_id()) session_start(); 
ini_set("display_errors", 0);
ini_set("session.auto_start", 1);
?>

<?php
if(!isset($_POST["btn_logout"])) {
	echo "Permission denied";
}

unset($_SESSION['userid']);
unset($_SESSION['username']);
session_destroy();
//header("location:../view/index.php");
echo "<script> {location.href='../view/index.php'} </script>";

?>
