<?php 
	ini_set('date.timezone','Asia/Shanghai');
	header("content-type:text/html;charset=utf-8");
	ini_set("display_errors", 0);
	ini_set("session.auto_start", 1);
?>

<?php 
//if(!isset($_POST["y"]) && !isset($_POST["n"])) {
//	echo "Permission denied";
//}

require_once("../db/class_mysqlite.php");

$my = MySQLite::getInstance();

if(in_array("点餐", $_POST))
{
	echo "yyyyyyyyyyyyyyyyyy<br/>";
	$my->addRecord($_SESSION['userid'], 1);
	//header("location:../view/index.php");
	echo "<script> {location.href='../view/index.php'} </script>";
}
else if(in_array("取消", $_POST))
{
	echo "nnnnnnnnnnnnnn<br/>";
	$my->addRecord($_SESSION['userid'], 0);
	//header("location:../view/index.php");
	echo "<script> {location.href='../view/index.php'} </script>";
}
else
{
	echo "000000<br/>";
}

?>
