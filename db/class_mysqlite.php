<?php if(!session_id()) session_start(); ?>
<?php header("content-type:text/html;charset=utf-8"); ?>
<?php

   require_once("../define/define.php");
   require_once("../db/class_mysqlite.php");

   class MySQLite extends SQLite3
   {
      function __construct()
      {
         $this->open('../lunch.db');
      }

      function __destruct()
      {
         $this->close();
      }

      function login($username, $password)
      {
         $sql =<<<EOF
         SELECT * FROM lunch_user WHERE name='$username' AND password='$password';
EOF;
         $ret = $this->query($sql);

         $success = -1;
         while($row = $ret->fetchArray(SQLITE3_ASSOC))
         {
            $_SESSION['userid'] = $row['id'];
            $_SESSION['username'] = $row['name'];
            $success = 0;
            break;
         }

         return $success;
      }

      function getAllUserInfo()
      {
         $arrayRet = array();
         $sql =<<<EOF
         SELECT * FROM lunch_user;
EOF;
         $ret = $this->query($sql);
         while($row = $ret->fetchArray(SQLITE3_ASSOC))
         {
            $user = new UserInfo($row['id'], $row['name'], $row['status']);
            //echo $user->getID()."-".$user->getUserName()."-".$user->getStatus()."<br/>";
            array_push($arrayRet, $user);
         }
         return $arrayRet;
      }

      function newRecord($userID, $status)
      {
         $t = time();
         $t_string = date("Y-m-d H:i:s",$t);
         $sql =<<<EOF
            INSERT INTO lunch_ret (user_id,time,operation) VALUES ($userID, '$t_string', $status);
EOF;
         $ret = $this->exec($sql);
         if(!$ret)
         {
            echo $db->lastErrorMsg();
         }
      }

   }
?>