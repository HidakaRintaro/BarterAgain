<!DOCTYPE html>
<html lang="ja">

<head>
  <title>header</title>
  <meta charset="utf-8">

  <!-- フォント -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/header.css">
  <link rel="stylesheet" href="../css/login.css">
</head>

<body>
  <!--ヘッダー-->
  <header>
    <h1>
      <a>BarterAgain</a>
    </h1>
    <nav>
      <ul id="hr_ul">
        <li><a>カテゴリー</a></li>
        <li><a href="../customer/my_pege.php">マイページ</a></li>
      </ul>
    </nav>
  </header>

  <div id="B">
    <br><br>
    <form action="#" method="GET">
      <div id="B1">
        <p><input type="text" placeholder="キーワードを入力" name="search">
          <button type="submit">検索</button></p>
      </div>
    </form>
  </div>

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
    <form action="../product/index.php" method="post">
      <div id="text1">
        <input type="text" placeholder="メールアドレス" name="email">
      </div>
      <br><br>
      <div id="text2">
        <input type="password" placeholder="パスワード" name="password">
      </div>
      <br><br>
      <input type="submit" value="ログイン" class="button6">
    </form>
  </div>
</body>

</html>