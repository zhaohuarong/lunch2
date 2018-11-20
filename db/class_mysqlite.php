<?php header("content-type:text/html;charset=utf-8"); ?>
<?php
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
         SELECT * FROM lunch_user WHERE name='$username'; AND password='$password';
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
   }
?>