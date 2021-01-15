<!DOCTYPE html>
<html lang="ja">

<head>
  <title>header</title>
  <meta charset="utf-8">

  <!-- フォント -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../tpl/css/header.css">
  <link rel="stylesheet" href="../tpl/css/login.css">
</head>

<body>
  <!--ヘッダー-->
<?php require_once '../tpl/layout/header.php'; ?>

  <!-- 会員ログイン -->
  <div id="log">
    <p>初めてご利用される方</p>
    <form action="./sing_up.php" method="post">
      <input type="submit" value="新規会員登録" class="button1">
    </form>
    <br><br>
    <hr>
    <form action="./sing_up.php" method="post">
      <input type="submit" value="Googleでログイン" class="button2">
      <br><br>
      <input type="submit" value="Twitterでログイン" class="button3">
      <br><br>
      <input type="submit" value="Facebookでログイン" class="button4">
      <br><br>
      <input type="submit" value="LINEでログイン" class="button5">
      <br><br>
    </form>
    <hr>
  <!-- ​エラーメッセージ -->
  <div class="<?php echo $class; ?>">
    <ul>
<?php foreach ($err_list as $key => $err) : ?>
      <li><?php echo $form_name[$key].$err_msg[$err]; ?></li>
<?php endforeach; ?>
    </ul>
  </div>
    <form method="post">
      <div id="text1">
        <input type="text" placeholder="メールアドレス" name="email">
      </div>
      <br><br>
      <div id="text2">
        <input type="password" placeholder="パスワード" name="password">
      </div>
      <br><br>
      <button type="submit" class="button6" name="login_btn" value="login">ログイン</button>
    </form>
  </div>
</body>

</html>