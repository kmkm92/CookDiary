<html lang="ja">
<head>
  <meta charset="UTF-8"/>
  <title>MoguLine</title>
  <link rel='stylesheet' href='style.css' type='text/css' media='all' />
</head>
<body>

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

    <!-- ▼タイムラインエリア scrollを外すと高さ固定解除 -->
    <div class="cook__contents ">

      <!-- 記事エリア  -->
<?php
 if(!isset($_SESSION)){
    session_start();
  }
  require "connect.php";
      
//表示
$sql = 'SELECT * FROM toukou2';
$stmt = $pdo->query($sql);
$results = $stmt->fetchAll();


//エスケープfunction
function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

?>
<?php foreach($results as $row): ?>
 <div class="cook__block">
        <figure>
          <img src="<?php echo  "{$row['profile']}" ;?>" />
        </figure>
        <div class="cook__block-text">
          <div class="name"><?php echo  h("{$row['kojinnmei']}") ;?><span class="name_reply">No.<?php echo  h("{$row['id']}") ;?></span></div>
          <div class="date"><?php echo  h("{$row['day']}") ;?>  <?php echo  h("{$row['time']}") ;?></div>
          <div class="text">
            <div class="in-pict">
              <img src="<?php echo h("{$row['filepath']}") ;?>">
            </div>
            <br>
            <font size="6">料理名:<?php echo  h("{$row['dishname']}" );?></font>
            <br><br>
            <?php echo  h("{$row['comment']}") ;?>
          </div>
          <br>
          <div class="cook__icon">
            <span class="cook-bubble"></span>
            <span class="cook-loop"></span>
            <span class="cook-heart"></span>
          </div>
        </div>
      </div>

<div>
    <?php endforeach; ?>


    </div>
    <!--　▲タイムラインエリア ここまで -->
    
  </div>
  <!--　▲ここまで -->

  
  <p style="text-align:right">
    <a href="post.php" class="btn-circle-3d">投稿</a>
    <a href="delete.php" class="btn-circle-3d">削除</a>
    <a href="edit1.php" class="btn-circle-3d">編集</a>
  </p>
  
</body>

</html>
