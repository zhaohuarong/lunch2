<?php if(!session_id()) session_start(); ?>

<?php
if(!isset($_POST["btn_login"])) {
	echo "Permission denied";
}

require_once("../db/class_mysqlite.php");

$mysqlite = MySQLite::getInstance();
$b = $mysqlite->login($_POST["username"], $_POST["password"]);

if($b == 0)
{
	//header("location:../view/index.php");
	echo "<script> {location.href='../view/index.php'} </script>";
}
else
{
	echo "<script> {window.alert('登录失败');location.href='../view/index.php'} </script>";
}

?>
