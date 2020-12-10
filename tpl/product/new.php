<!DOCTYPE html>
<html lang="ja">

<head>
  <title>header</title>
  <meta charset="utf-8">
  <!-- jQueryの読み込み -->
  <link rel="stylesheet" href="../css/itiran.css">
</head>

<body>
  <header>
    <h1>
      <a>まさるちゃん</a>
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

  <!-- 商品登録 -->
  <h2>商品登録</h2>
  <!-- イメージ画像 -->
  <h3>商品画像</h3>
  <p><img src="../img/images.jpg" alt="写真" width="96" height="65"></p>
  <!-- イメージ画像 -->
  <!-- テキストボックス商品名 -->
  <h3>商品名</h3>
  <textarea name="example" cols="50" rows="5">

</textarea>
  <!-- テキストボックス商品名 -->
  <!-- テキストエリア商品説明 -->
  <h3>商品説明</h3>
  <div class="setumei">
    <input type="text" placeholder="商品説明">
    <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
  </div>
  <!-- テキストエリア商品説明 -->
  <!-- セレクトカテゴリー -->
  <h3>商品カテゴリー</h3>
  <div class="kategori">
    <select required>
      <option value="" hidden>カテゴリー</option>
      <option value="1">赤</option>
      <option value="2">赤</option>
      <option value="3">赤</option>
      <option value="4">赤</option>
    </select>
  </div>
  <!-- セレクトカテゴリー -->
  <!-- テキストボックスブランド -->
  <h3>商品ブランド名</h3>
  <textarea name="example" cols="50" rows="5">

</textarea>
  <!-- テキストボックスブランド -->
  <!-- セレクト商品状態 -->
  <h3>商品状態</h3>
  <div class="jyoutai">
    <select required>
      <option value="" hidden>商品状態</option>
      <option value="1">紫</option>
      <option value="2">紫</option>
      <option value="3">紫</option>
      <option value="4">紫</option>
    </select>
  </div>
  <!-- セレクト商品状態 -->

  <!-- 欲しい商品テキストエリア -->
  <h3>欲しい商品</h3>
  <div class="hosii">
    <input type="text" placeholder="欲しい商品">
    <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
  </div>
  <!-- 欲しい商品テキストエリア -->
  <!-- セレクトジャンル -->
  <h3>ジャンル</h3>
  <div class="jyannru">
    <select required>
      <option value="" hidden>ジャンル</option>
      <option value="1">青</option>
      <option value="2">青</option>
      <option value="3">青</option>
      <option value="4">青</option>
    </select>
  </div>
  <!-- セレクトジャンル -->



  <button class="botann">出品ボタン</button>

  </div>
  </div>

















</body>

</html>