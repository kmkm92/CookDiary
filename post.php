<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>post</title>
    <link rel='stylesheet' href='stylepost.css'  type='text/css' media='all' />
  </head>
  <body>
<?php
//接続
session_start();
require "connect.php";

if(isset($_SESSION['id']) || (isset($_POST['btn']) && isset($_SESSION['id']))){
  
if(!empty($_POST)){
//ファイル系以外の変数を定義
$dishname = $_POST['dishname'];
$comment = $_POST['comment'];
$password = $_SESSION['password'];

}



//セッションがあれば
if(isset($_SESSION)){
 $kojinnmei = $_SESSION['name'];
 $profilegazou = $_SESSION['profile'];
}

if(!empty($_FILES['img'])){
   //ファイル系の変数を定義
 $file = $_FILES['img'];
 $filename = basename($file['name']);
 $tmp_path = $file['tmp_name'];
 $file_err = $file['error'];
 $filesize = $file['size'];
 $upload_dir = 'images/';
 $save_filename = date('YmdHis') . $filename;
 $err_msgs = array();
 $save_path = $upload_dir.$save_filename;
  



 //フォームが空でなかったら
 if(empty($_POST['dishname']) || empty($_POST['comment'])) {
     array_push($err_msgs, '未入力のところがあります。');
 }
 //ファイルサイズ確認
 if($filesize > 2097152 || $file_err==2){
     array_push($err_msgs, 'ファイルサイズは2MB未満にしてください。');
 }
     
 //拡張子は？
 $allow_ext = array('jpg','jpeg','png');
 $file_ext = pathinfo($filename,PATHINFO_EXTENSION);
     
 if(!in_array(strtolower($file_ext),$allow_ext)){
         array_push($err_msgs, '画像ファイルを添付してください。');
 }

     if(count($err_msgs) === 0){
         //ファイルはあるか
         if(is_uploaded_file($tmp_path)){
             if(move_uploaded_file($tmp_path, $save_path)){
                         
                     //DBに保存
                     //$result = fileSave($filename, $save_path, $caption);
                     $sql = $pdo -> prepare("INSERT INTO toukou2 (dishname, filename, filepath, comment, passwd, day, time, kojinnmei, profile) VALUES (:dishname, :filename, :filepath, :comment, :passwd, :day, :time, :kojinnmei, :profile)");
                     $sql -> bindValue(':dishname', $dishname, PDO::PARAM_STR);
                     $sql -> bindValue(':filename', $filename, PDO::PARAM_STR);
                     $sql -> bindValue(':filepath', $save_path, PDO::PARAM_STR);
                     $sql -> bindValue(':comment', $comment, PDO::PARAM_STR);
                     $sql -> bindValue(':passwd', $password, PDO::PARAM_STR);
                     $sql -> bindValue(':day', date('Y/m/d'), PDO::PARAM_STR);
                     $sql -> bindValue(':time', date('H:i:s'), PDO::PARAM_STR);
                     $sql -> bindValue(':kojinnmei', $kojinnmei, PDO::PARAM_STR);
                     $sql -> bindValue(':profile', $profilegazou, PDO::PARAM_STR);
                     $sql -> execute();

                     $msg = "投稿しました。";
                     $alert = "<script type='text/javascript'>alert('". $msg. "');</script>";
                     echo $alert;

                     //require "home.php";
                     //include('home.php');
                     header('Location: home.php');
             
             
             }else{
                     echo '投稿できませんでした。(2MB以内)';
                     echo '<a href="home.php" class="btn-circle-3d">戻る</a>';
                 }
                     
         }else{
             echo 'ファイルが選択されていません。';
     }
             
     }else{
         foreach($err_msgs as $msg){
             //echo $msg."<br>";
             if(isset($_POST['btn'])){
             $alert = "<script type='text/javascript'>alert('". $msg. "');</script>";
             echo $alert;
             }
         }
     }
}
}else{
  $alert = "<script type='text/javascript'>alert('ログインしてください。');</script>";
  echo $alert;
  }

 
?>     

      <!-- ▼上の部分ここから -->
  <div class="cook__container">
    <!-- タイトル -->
    <div class="cook__title">
      <span class="cook-logo"></span>
      <?PHP
      if(!isset($_SESSION)){
        session_start();
      }
      if (isset($_SESSION['id'])) {//ログインしているとき
        echo '<a href="logout.php" class="btn-square-shadow">ログアウト</a>';

    } else {//ログインしていない時
      echo '<a href="register_form.php" class="btn-square-shadow">新規登録</a>
      <a href="login_form.php" class="btn-square-shadow">ログイン</a>';
    }
      
      ?>
    </div>
  </div>


    <form enctype="multipart/form-data" action="post.php" method="POST">
        <div class="Form">
            <div class="Form-Item">
                <p class="Form-Item-Label"><span class="Form-Item-Label-Required"></span>料理名</p>
                <input type="text" name="dishname" class="Form-Item-Input" placeholder="例）カレーライス">
                
            </div>
            <div class="Form-Item">
                <p class="Form-Item-Label"><span class="Form-Item-Label-Required"></span>画像ファイル(2MB以内)</p>
        
        <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
        <input name="img" type="file" accept="image/*" class="Form-Item-Input" />
            </div>

            <div class="Form-Item">
                <p class="Form-Item-Label isMsg"><span class="Form-Item-Label-Required"></span>説明</p>
                <textarea class="Form-Item-Textarea" name="comment" placeholder="例）隠し味にチョコレートを入れました。"></textarea>
            </div>
                <input type="submit" name = "btn" class="Form-Btn" value="投稿する">
        </div>
    </form>

    <p style="text-align:right">
    <a href="home.php" class="btn-circle-3d">戻る</a>
  　</p>

  </body>
</html>