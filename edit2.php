<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>edit</title>
    <link rel='stylesheet' href='stylepost.css'  type='text/css' media='all' />
  </head>
  <body>
<?php
//接続
require "connect.php";
session_start();
    
 
  if(!empty($_FILES['img'])){
    $file = $_FILES['img'];
    $filename = basename($file['name']);
    $tmp_path = $file['tmp_name'];
    $file_err = $file['error'];
    $filesize = $file['size'];
    $upload_dir = 'images/';
    $save_filename = date('YmdHis') . $filename;
    //$err_msgs = array();
    $save_path = $upload_dir.$save_filename;
  }

    $id = $_SESSION['editnumber'];
    //画像変更なしの場合
    if (!empty($_POST['editdishname']) && !empty($_POST['editcomment']) && !is_uploaded_file($tmp_path) && isset($_POST['btn'])) {
    $id = $_SESSION['editnumber'];

    $sql = 'UPDATE toukou2 SET dishname=:dishname,comment=:comment,day=:day,time=:time WHERE id=:id';
    $stmt = $pdo->prepare($sql);
    $stmt -> bindValue(':dishname', $_POST['editdishname'], PDO::PARAM_STR);
    $stmt -> bindValue(':comment', $_POST['editcomment'], PDO::PARAM_STR);
    $stmt -> bindValue(':day', date('Y-m-d'), PDO::PARAM_STR);
    $stmt -> bindValue(':time', date('H:i:s'), PDO::PARAM_STR);
    
	  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    //echo $id. "を編集しました。<br>";

    $msg = $id. "を編集しました。";
    $alert = "<script type='text/javascript'>alert('". $msg. "');</script>";
    echo $alert;
    
    header('Location: home.php');

    }

    //画像変更ありの場合
    if (!empty($_POST['editdishname']) && !empty($_POST['editcomment']) && is_uploaded_file($tmp_path) && isset($_POST['btn'])) {
        


        //ファイルサイズ確認
        if($filesize > 2097152 || $file_err==2){
        $err_msgs = 'ファイルサイズは2MB未満にしてください。';
                $alert = "<script type='text/javascript'>alert('". $err_msgs. "');</script>";
                echo $alert;
        }

            //拡張子は？
            $allow_ext = array('jpg','jpeg','png');
            $file_ext = pathinfo($filename,PATHINFO_EXTENSION);
            if(!in_array(strtolower($file_ext),$allow_ext)){
                $err_msgs = '画像ファイルを添付してください。';
                $alert = "<script type='text/javascript'>alert('". $err_msgs. "');</script>";
                echo $alert;
            }

            if(move_uploaded_file($tmp_path, $save_path)){
                            
                //DBに保存
                //$result = fileSave($filename, $save_path, $caption);
                $sql = $pdo -> prepare('UPDATE toukou2 SET dishname=:dishname,filename=:filename,filepath=:filepath,comment=:comment,day=:day,time=:time WHERE id=:id');
                $sql -> bindValue(':dishname', $_POST['editdishname'], PDO::PARAM_STR);
                $sql -> bindValue(':filename', $filename, PDO::PARAM_STR);
                $sql -> bindValue(':filepath', $save_path, PDO::PARAM_STR);
                $sql -> bindValue(':comment', $_POST['editcomment'], PDO::PARAM_STR);
                $sql -> bindValue(':day', date('Y/m/d'), PDO::PARAM_STR);
                $sql -> bindValue(':time', date('H:i:s'), PDO::PARAM_STR);
                $sql->bindParam(':id', $id, PDO::PARAM_INT);
                $sql->execute();

                $msg = $id. "を編集しました。";
                $alert = "<script type='text/javascript'>alert('". $msg. "');</script>";
                echo $alert;
        
                header('Location: home.php');
        
        
            }
    
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


    <form enctype="multipart/form-data" action="edit2.php" method="POST">
        <div class="Form">
            <div class="Form-Item">
                <p class="Form-Item-Label"><span class="Form-Item-Label-Required"></span>料理名</p>
                <input type="text" name="editdishname" class="Form-Item-Input" placeholder="例）カレーライス" value="<?php if(isset($_SESSION['editdishname'])) {echo $_SESSION['editdishname'];}?>">
                
            </div>
            <div class="Form-Item">
                <p class="Form-Item-Label"><span class="Form-Item-Label-Required"></span>画像ファイル(2MB以内)</p>
        <!-- <input name="img" type="file" accept="image/*" /> -->
        <input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
        <input name="img" type="file" accept="image/*" class="Form-Item-Input" />
            </div>

            <div class="Form-Item">
                <p class="Form-Item-Label isMsg"><span class="Form-Item-Label-Required"></span>説明</p>
                <textarea class="Form-Item-Textarea" name="editcomment" placeholder="例）隠し味にチョコレートを入れました。" value=""><?php if(isset($_SESSION['editcomment'])) {echo $_SESSION['editcomment'];} ?></textarea>
            </div>
                <input type="submit" name = "btn" class="Form-Btn" value="投稿する">
        </div>
    </form>

    <p style="text-align:right">
    <a href="home.php" class="btn-circle-3d">戻る</a>
  　</p>

  </body>
</html>