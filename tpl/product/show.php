<!DOCTYPE html>
<html lang="ja">

<head>
  <title>header</title>
  <meta charset="utf-8">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../tpl/css/show.css">
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

  <!-- 商品詳細 -->
  <table>
    <tr>
      <th colspan="2">
        <p><?php echo "商品名"; ?><p>
      </th>
    <tr>

    <tr>
      <td rowspan="4">
        <p><img src="<?php echo FILE_IMG.$product['image_id']; ?>"></p>
      </td>
      <td>
        <p>出品者　　　<?php echo $product['nickname']; ?></p>
      </td>
    </tr>

    <tr>
      <td>
        <p>カテゴリー　<?php echo $product['category']; ?></p>
      </td>
    </tr>

    <tr>
      <td>
        <p>ブランド　　<?php echo $product['brand']; ?></p>
      </td>
    </tr>

    <tr>
      <td>
        <p>商品の状態　<?php echo $status[$product['status']]; ?></p>
      </td>
    </tr>


    <!-- ボタン -->

    <form method="get" action="">
      <tr>
        <th colspan="2"><button class="btn1" type="submit" name="offer" value="offer">交換申請する</button></th>
      </tr>
    </form>

    <tr>
      <td colspan="2">
        <p><?php echo $product['body']; ?></p>
      </td>
    </tr>

    <!-- コメント -->
    <form method="get" action="../notice/index.php">
      <tr>
        <td colspan="2"><textarea name="comment" maxlength="500" rows="10" cols="80">コメント入力</textarea></td>
      </tr>
      <br>
      <tr>
        <th colspan="2"><input class="btn2" name="post_btn" type="submit" value="コメントする"></th>
      </tr>
    </form>
  </table>
</body>

</html>