<?php if(!session_id()) session_start(); ?>
<?php 
	ini_set('date.timezone','Asia/Shanghai');
	header("content-type:text/html;charset=utf-8");

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

		<?php echo "Welcome ".$_SESSION['userid'].",".$_SESSION['username']."<br/>"; ?>
		<br/>
		<form method="post" action="../action/do_lunch.php">
			<input type="submit" name="y" value="点餐"/>
			<input type="submit" name="n" value="取消" />
		</form>
		<br/>
		<?php
			$my = new MySQLite();
			$allUserInfo = $my->getAllUserInfo();
			echo "<table border='1'>";
			for($i = 0; $i < count($allUserInfo); $i ++)
			{
				$status_text = "<font color='red'><B>未点</B></font>";
				if($allUserInfo[$i]->getStatus() == 1)
				{
					$status_text = "<font color='green'><B>已点</B></font>";
				}
				echo "<tr>";
				echo "<td>$i</td><td>".$allUserInfo[$i]->getUserName()."</td><td>".$status_text."</td>";
				echo "</tr>";
			}
			echo "</table>";
		?>

	</body>
</html>