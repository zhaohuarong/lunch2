<?php if(!session_id()) session_start(); ?>

<?php 
	ini_set('date.timezone','Asia/Shanghai');
//	header("content-type:text/html;charset=utf-8");

	require_once("../db/class_mysqlite.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	  	<meta charset="utf-8">
		<title>Main Page</title>
	</head>
	<body>

		<?php 
		if(!isset($_SESSION['userid']))
		{
			echo "<form action=\"../action/login.php\" method=\"post\"> <input type=\"text\" name=\"username\"/> <input type=\"password\" name=\"password\"/> <input type=\"submit\" name=\"btn_login\"/> </form>";
		}
		else
		{
			echo "Welcome ".$_SESSION['userid'].",".$_SESSION['username'];
			echo "<form method=\"post\" action=\"../action/logout.php\"> <input type=\"submit\" name=\"btn_logout\" value=\"退出\"> </form>"."<br/>";
			echo "<form method=\"post\" action=\"../action/do_lunch.php\"> <input type=\"submit\" name=\"y\" value=\"点餐\"/> <input type=\"submit\" name=\"n\" value=\"取消\" /> </form>";
		}

		?>
		<br/>
		<?php
			$userIDAndName = array();
			$my = MySQLite::getInstance();
			$allUserInfo = $my->getAllUserInfo();
			$userTableString = "<table border='1'>";
			$countHaveLunch = 0;
			for($i = 0; $i < count($allUserInfo); $i ++)
			{
				$userIDAndName[$allUserInfo[$i]->getID()] = $allUserInfo[$i]->getUserName();
				$status_text = "<font color='red'><B>未点</B></font>";
				//if($allUserInfo[$i]->getStatus() == 1)
				if($my->getUserTodayStatus($allUserInfo[$i]->getID()) == 1)
				{
					$status_text = "<font color='green'><B>已点</B></font>";
					$countHaveLunch ++;
				}
				$userTableString .= "<tr>";
				$userTableString .= "<td>".($i+1)."</td><td>".$allUserInfo[$i]->getUserName()."</td><td>".$status_text."</td>";
				$userTableString .= "</tr>";
			}
			$userTableString .= "</table>";
			echo "<font color=red size=5>总计：".$countHaveLunch."</font>";
			echo $userTableString;


			$allRecord = $my->getLastRecord();
			echo "<br/><h3>最新动态</h3>";

			$RecordString = "<table border='1'>";
			for($i = 0; $i < count($allRecord); $i ++)
			{
				$status = ($allRecord[$i]->getStatus() == 0) ? "取消" : "点餐";
				$RecordString .= "<tr>";
				$RecordString .= "<td>".$userIDAndName[$allRecord[$i]->getUserID()]."</td><td>".$allRecord[$i]->getTime()."</td><td>".$status."</td>";
				$RecordString .= "</tr>";
			}
			$RecordString .= "</table>";
			echo $RecordString;
		?>

	</body>
</html>
