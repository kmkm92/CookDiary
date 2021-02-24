<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>ログイン</title>
    <link rel="stylesheet" type="text/css" href="registerstyle.css" media="all" />
</head>
<body>

      <!-- ▼上の部分ここから -->
      <div class="cook__container">
    <!-- タイトル -->
    <div class="cook__title">
      <span class="cook-logo"></span>

        <a href="home.php" class="btn-square-shadow">ホームへ</a>
        <a href="register_form.php" class="btn-square-shadow">新規登録</a>
    </div>

<div id="form">
    <p class="form-title">ログインページ</p>
    <form action="login.php" method="post">
        <p>メールアドレス</p>
        <p class="mail"><input type="email" name="mail" placeholder="example@example.com" /></p>
        <p>パスワード</p>
        <p class="pass"><input type="password" name="password" placeholder="パスワード" /></p>
        <!-- <p class="check"><input type="checkbox" name="checkbox" />パスワードを保存</p> -->
        <p class="submit"><input type="submit" name="submit" value="ログイン" /></p>
    </form>
</div>

</body>
</html>