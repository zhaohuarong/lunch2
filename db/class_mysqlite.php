<?php if(!session_id()) session_start(); ?>
<?php header("content-type:text/html;charset=utf-8"); ?>
<?php

   require_once("../define/define.php");
   require_once("../db/class_mysqlite.php");

   class MySQLite extends SQLite3
   {

      static private $instance;

      static public function getInstance()
      {
         if(!self::$instance instanceof self)
         {
            self::$instance = new self;
         }
         return self::$instance;
      }

      private function __clone(){}

      function __construct()
      {
         $this->open('../lunch.db');
         //echo "<script language=\"JavaScript\">alert(\"openDB\");</script>";
      }

      function __destruct()
      {
         $this->close();
         //echo "<script language=\"JavaScript\">alert(\"closeDB\");</script>";
      }

      public function login($username, $password)
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

      public function getAllUserInfo()
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

      public function addRecord($userID, $status)
      {
         $t = time();
         $t_string = date("Y-m-d H:i:s",$t);
         $sql =<<<EOF
            INSERT INTO lunch_ret (user_id,time,operation) VALUES ($userID, '$t_string', $status);
EOF;
         $ret = $this->exec($sql);
         if(!$ret)
         {
            echo $this->lastErrorMsg();
         }

         $sql =<<<EOF
            UPDATE lunch_user SET status = $status where ID=$userID;
EOF;
         $ret = $this->exec($sql);
         if(!$ret)
         {
            echo $this->lastErrorMsg();
         }
      }

      public function getLastRecord()
      {
         $arrayRet = array();
         $sql =<<<EOF
            SELECT * FROM lunch_ret ORDER BY time DESC LIMIT 0,16
EOF;
         $ret = $this->query($sql);
         while($row = $ret->fetchArray(SQLITE3_ASSOC) )
         {
            //$history_array[$i] = array($row['id'], $row['user_id'], $row['time'], $row['operation']);
            $record = new LunchInfo($row['id'], $row['user_id'], $row['time'], $row['operation']);
            //echo "--".$record->getUserID().",".$record->getTime().",".$record->getStatus()."<br/>";
            array_push($arrayRet, $record);
         }

         return $arrayRet;
      }
   }
?>