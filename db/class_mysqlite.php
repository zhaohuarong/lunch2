<?php if(!session_id()) session_start(); ?>
<?php header("content-type:text/html;charset=utf-8"); ?>
<?php

   require_once("../define/define.php");

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

      function getAllUserID()
      {
         $arrayRet = array();
         $sql =<<<EOF
         SELECT id FROM lunch_user;
EOF;
         $ret = $this->query($sql);
         while($row = $ret->fetchArray(SQLITE3_ASSOC))
         {
            array_push($arrayRet, $row['id']);
         }
         return $arrayRet;
      }

      function queryUserNameAndStatus($userID)
      {
         $arrayRet = array();
         $sql =<<<EOF
         SELECT name, status FROM lunch_user WHERE id = $userID;
EOF;
         $ret = $this->query($sql);
         while($row = $ret->fetchArray(SQLITE3_ASSOC))
         {
            //array_push($arrayRet, $row['id']);
         }
         return $arrayRet;
      }
   }
?>