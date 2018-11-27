<?php if(!session_id()) session_start(); ?>
<?php header("content-type:text/html;charset=utf-8"); ?>

<?php
if(!isset($_POST["btn_logout"])) {
	echo "Permission denied";
}

unset($_SESSION['userid']);
unset($_SESSION['username']);
session_destroy();
header("location:../view/index.php");

?>