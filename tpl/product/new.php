<!DOCTYPE html>
<html lang="ja">

<head>
  <title>header</title>
  <meta charset="utf-8">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../tpl/css/new.css">
  <link rel="stylesheet" href="../tpl/css/header.css">
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
          <button type="submit" name="serch_btn">検索</button></p>
      </div>
    </form>
  </div>

  <!-- 商品登録 -->
  <h2>商品登録</h2>
  <form method="post" enctype="multipart/form-data">
    <h3>商品画像</h3>
    <p><input type="file" name="product_img"></p>


    <!-- テキストボックス商品名 -->
    <h3>商品名</h3>
    <input name="product_name" type="text" maxlength="40">

    <!-- テキストエリア商品説明 -->
    <h3>商品説明</h3>
    <textarea name="product_text" maxlength="1000" rows="6" cols="40" placeholder="商品説明"></textarea>

    <h2>商品の詳細</h2>
    <!-- セレクトカテゴリー -->
    <h3>カテゴリー</h3>
    <select name="product_category" required>
      <option value="" hidden>---</option>
<?php foreach ($category_arr as $val) : ?>
      <option value="<?php echo $val['id']; ?>"><?php echo $val['name']; ?></option>
<?php endforeach; ?>
    </select>

    <!-- テキストボックスブランド -->
    <h3>ブランド</h3>
    <input name="brand" type="text" maxlength="100">

    <!-- セレクト商品状態 -->
    <h3>商品状態</h3>
    <select name="product_status" required>
      <option value="" hidden>---</option>
      <option value="1">新品、未使用</option>
      <option value="2">未使用に近い</option>
      <option value="3">目立った傷や汚れなし</option>
      <option value="4">やや傷や汚れあり</option>
      <option value="5">傷や汚れあり</option>
      <option value="6">全体的に状態が悪い</option>
    </select>

    <h2>交換について</h2>
    <!-- 欲しい商品テキストエリア -->
    <h3>欲しい商品</h3>
    <textarea name="want_product" maxlength="100" rows="4" cols="40" placeholder="商品説明"></textarea>

    <!-- セレクトカテゴリー-->
    <h3>カテゴリー</h3>
    <select name="want_category" required>
      <option value="" hidden>---</option>
<?php foreach ($category_arr as $val) : ?>
      <option value="<?php echo $val['id']; ?>"><?php echo $val['name']; ?></option>
<?php endforeach; ?>
    </select>

    <!-- ボタン -->
    <p><button name="listing_btn" value="listing_btn">出品ボタン</button></p>
  </form>
</body>

</html>