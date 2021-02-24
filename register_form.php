<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>新規登録</title>
    <link rel="stylesheet" type="text/css" href="registerstyle.css" media="all" />
</head>
<body>
  <!-- ▼上の部分ここから -->
  <div class="cook__container">
    <!-- タイトル -->
    <div class="cook__title">
      <span class="cook-logo"></span>

        <a href="home.php" class="btn-square-shadow">ホームへ</a>
        <a href="login_form.php" class="btn-square-shadow">ログイン</a>
    </div>

<div id="form">
    <p class="form-title">新規登録</p>
    <form action="register.php" method="post">
        <p>名前</p>
        <p class="name"><input type="text" name="name" placeholder="山田太郎" /></p>
        <p>メールアドレス</p>
        <p class="mail"><input type="email" name="mail" placeholder="example@example.com" /></p>
        
        <p class="submit"><input type="submit" value="送信" /></p>
    </form>
</div>

</body>
</html>