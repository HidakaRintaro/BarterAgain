<!DOCTYPE html>
<html lang="ja">

<head>
  <title>header</title>
  <meta charset="utf-8">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&display=swap" rel="stylesheet">
  <!-- jQueryの読み込み -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <link rel="stylesheet" href="../css/header.css">
  <link rel="stylesheet" href="../css/nice.css">
</head>

<body>
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

  <!-- コメント一覧 -->
  <br>
  <h2>コメント一覧</h2>


  <div id="number_list">
    <div id="nice">
      <ul>
        <?php //ループ 
        ?>
        <li><a><?php echo "画像" . "商品名"; ?></a></li>
        <li><a><?php echo "画像" . "商品名"; ?></a></li>
        <li><a><?php echo "画像" . "商品名"; ?></a></li>
        <li><a><?php echo "画像" . "商品名"; ?></a></li>
        <li><a><?php echo "画像" . "商品名"; ?></a></li>
        <li><a><?php echo "画像" . "商品名"; ?></a></li>
        <li><a><?php echo "画像" . "商品名"; ?></a></li>
        <li><a><?php echo "画像" . "商品名"; ?></a></li>
        <li><a><?php echo "画像" . "商品名"; ?></a></li>
        <li><a><?php echo "画像" . "商品名"; ?></a></li>
        <li><a><?php echo "画像" . "商品名"; ?></a></li>
        <li><a><?php echo "画像" . "商品名"; ?></a></li>
        <li><a><?php echo "画像" . "商品名"; ?></a></li>
        <li><a><?php echo "画像" . "商品名"; ?></a></li>
        <li><a><?php echo "画像" . "商品名"; ?></a></li>
        <li><a><?php echo "画像" . "商品名"; ?></a></li>
        <li><a><?php echo "画像" . "商品名"; ?></a></li>
        <li><a><?php echo "画像" . "商品名"; ?></a></li>
        <li><a><?php echo "画像" . "商品名"; ?></a></li>
        <?php //ループとじ 
        ?>
      </ul>

      <button type=button id="more_btn">もっと見る</button>
      <button type=button id="close_btn">表示数を戻す</button>
    </div>
  </div>

  <!-- jsファイルの読み込み -->
  <script src="../js/more_show_script_4.js"></script>

</body>

</html>