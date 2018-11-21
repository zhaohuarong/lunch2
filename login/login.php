<?php header("content-type:text/html;charset=utf-8"); ?>

<?php
if(!isset($_POST["btn_login"])) {
	echo "Permission denied";
}

//echo $_POST["username"].$_POST["password"];

require_once("../db/class_mysqlite.php");

$mysqlite = new MySQLite();
$b = $mysqlite->login($_POST["username"], $_POST["password"]);

if($b == 0)
{
	header("location:../view/main_page.php");
}
else
{
	header("location:../index.php");
}

?>