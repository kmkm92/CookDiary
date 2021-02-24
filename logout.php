<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>logout.php</title>
    
  </head>
  <body>
<?php
session_start();
//接続
require 'connect.php';
    
    $tablename = "member2";
    
    
    $_SESSION = array();//セッションの中身をすべて削除
    session_destroy();//セッションを破壊
require 'home.php';

?>

  </body>
</html>