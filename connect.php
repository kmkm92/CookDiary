<?php

     //サーバーに接続
     $dsn = 'mysql:dbname=    ;host=    ';
     $user = ' ';
     $password = '  ';
     $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

     $sql = "CREATE TABLE IF NOT EXISTS toukou2"
	." ("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
     . "dishname TEXT,"
     . "filename TEXT,"
     . "filepath TEXT,"
     . "comment TEXT,"
     . "passwd char(10),"
     . "day DATE,"
     . "time TIME,"
     . "kojinnmei TEXT,"
     . "profile TEXT"
     .");";
     $stmt = $pdo->query($sql);

     
     
?>