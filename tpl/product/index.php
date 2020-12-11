<!DOCTYPE html>
<html lang="ja">

<head>
  <title>header</title>
  <meta charset="utf-8">
  <!-- jQueryの読み込み -->
  <link rel="stylesheet" href="../tpl/css/itiran.css">
</head>

<body>
  <header>
    <h1>
      <a>BarterAgain</a>
    </h1>
    <nav>
      <ul class="hr_ul">
        <li><a>カテゴリー</a></li>
        <li><a>マイページ</a></li>
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

  <!-- 商品一覧 -->
  <h2>商品一覧</h2>

  <div class="float_box">
    <ul>
<?php foreach ($product_arr as $row) : ?>
      <li>
        <a href="./show.php?id=<?php echo $row['id']; ?>">
          <img src="<?php echo FILE_IMG.$row['image_id'] ?>" class="image">
          <p class="name"><?php echo $row['name']; ?></p>
        </a>
      </li>
<?php endforeach; ?>
    </ul>
  </div>

  </div>
  </div>

















</body>

</html>