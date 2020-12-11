<!DOCTYPE html>
<html lang="ja">

<head>
  <title>会員更新</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../tpl/css/header.css">
  <link rel="stylesheet" href="../tpl/css/customer.css">
</head>

<body>
  <!--ヘッダー-->
  <header>
    <h1>BarterAgain</h1>
    <nav>
      <ul id="hr_ul">
        <li><a>カテゴリー</a></li>
        <li><a href="../tpl/customer/my_pege.php">マイページ</a></li>
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

  <!-- 会員登録 -->
  <div id="torok">
    <form method="post">
      <h2>本人情報更新</h2>
      <p>日髙凜太郎</p>
      <p>ニックネーム ：<input type="text" value="<?php echo 2; ?>" name="nickname"></p>

      <h2>発送元・お届け先住所変更</h2>
      <p>郵便番号 : <input type="text" name="postal" value=""></p>
      <br>
      <p>都道府県 : 
        <select name="prefectures">
          <option value="">--</option>
          <option value=""></option>
        </select>
      </p>
      <br>
      <p>住所 : <input type="text" name="address"></p>
      <br>
      <h2>メールアドレス・パスワード</h2>
      <p>メールアドレス : <input type="text" name="email"></p>
      <br>
      <p>現在のパスワード : <input type="password" name="old_password"></p>
      <br>
      <p>新しいパスワード : <input type="password" name="new_password"></p>
      <p>新しいパスワード : <input type="password" name="conf_password"></p>
      <br>
      <p><button type="submit" name="update" value="update">登録</button></p>
    </form>
  </div>
</body>
</html>