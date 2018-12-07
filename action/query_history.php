<?php
if(!isset($_POST["query"])) {
	echo "Permission denied";
}

require_once("../db/class_mysqlite.php");

$mysqlite = MySQLite::getInstance();
$begin_date = $_POST["begin_date"];
$end_date = $_POST["end_date"];

echo $begin_date."-".$end_date."<br/>";
$arr = $mysqlite->queryByDate($begin_date, $end_date);

//get all user info
$userIDAndName = array();
$my = MySQLite::getInstance();
$allUserInfo = $my->getAllUserInfo();
for($i = 0; $i < count($allUserInfo); $i ++)
{
   $userIDAndName[$allUserInfo[$i]->getID()] = $allUserInfo[$i]->getUserName();
}

// print user table
for($i = 0; $i < count($arr); $i ++)
{
   $sub = $arr[$i];
   if(count($sub) <= 1)
      continue;
   echo $sub[0].":";
   for($j = 1; $j < count($sub); $j ++)
   {
      echo $userIDAndName[$sub[$j]].",";
   }
   echo "<br/>";
}

?>
