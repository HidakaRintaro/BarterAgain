<!DOCTYPE html>
<html lang="ja">

<head>
  <title>header</title>
  <meta charset="utf-8">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3/dist/jquery.min.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../tpl/css/show.css">
  <link rel="stylesheet" href="../tpl/css/header.css">
  <script src="../tpl/js/modal_show_script.js"></script>
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
  ​
  <div id="B">
    <br><br>
    <form action="#" method="GET">
      <div id="B1">
        <p><input type="text" placeholder="キーワードを入力" name="search">
          <button type="submit" name="serch_btn">検索</button></p>
      </div>
    </form>
  </div>

  <!-- ​エラーメッセージ -->
  <div class="<?php echo $class; ?>">
    <ul>
<?php foreach ($err_list as $key => $err) : ?>
      <li><?php echo $form_name[$key].$err_msg[$err]; ?></li>
<?php endforeach; ?>
    </ul>
  </div>

  <!-- 商品詳細 -->
  <table>
    <tr>
      <th colspan="2">
        <p><?php echo $product['name']; ?><p>
      </th>
    <tr>
      ​
    <tr>
      <td rowspan="4">
        <p><img src="<?php echo FILE_IMG . $product['image_id']; ?>"></p>
      </td>
      <td>
        <p>出品者　　　<?php echo $product['nickname']; ?></p>
      </td>
    </tr>
    ​
    <tr>
      <td>
        <p>カテゴリー　<?php echo $product['category']; ?></p>
      </td>
    </tr>
    ​
    <tr>
      <td>
        <p>ブランド　　<?php echo $product['brand']; ?></p>
      </td>
    </tr>
    ​
    <tr>
      <td>
        <p>商品の状態　<?php echo $product_status[$product['status']]; ?></p>
      </td>
    </tr>
    ​
    ​
    <!-- ボタン -->
    ​
    <div class="content">
      <tr>
        <th colspan="2"><a class="js-modal-open" href=""><input class="btn1" name="request_btn" type="submit" value="交換申請する"></a></th>
      </tr>
    </div>
    <div class="modal js-modal">
      <div class="modal__bg js-modal-close"></div>
      <div class="modal__content">
        <p>
        <table>
<?php foreach ($barter_list as $row) : ?>
          <tr>
            <td><img src="<?php echo FILE_IMG.$row['image_id'] ?>" class="image"></td>
            <td><?php echo $row['name'] ?></td>
            <td>
              <form method="post"></form>
            </td>
          </tr>
<?php endforeach; ?>
        </table>
        </p>
        <a class="js-modal-close" href="">閉じる</a>
      </div>
      <!--modal__inner-->
    </div>
    <!--modal-->
    ​
    <tr>
      <td colspan="2">
        <p><?php echo $product['body']; ?></p>
      </td>
    </tr>
    ​
    <!-- コメント -->
    <form method="post">
      <tr>
        <td colspan="2"><textarea name="comment" maxlength="500" rows="10" cols="80" placeholder="コメント入力"></textarea></td>
      </tr>
      <br>
      <tr>
        <th colspan="2"><button class="btn2" name="post_btn" value="post_btn" type="submit">コメントする</button></th>
      </tr>
    </form>
    <br>
<?php foreach ($comment_arr as $val) : ?>
      <tr>
        <td><?php echo $val['nickname']; ?></td>
        <td><?php echo $val['comment']; ?></td>
<?php   if ($val['customer_id'] == $customer_id) : ?>
          <td>
            <form method="post">
              <button type="submit" name="comment_del" value="comment_del">削除</button>
              <input type="hidden" name="product_id" value="<?php echo $val['product_id']; ?>">
              <input type="hidden" name="customer_id" value="<?php echo $val['customer_id']; ?>">
              <input type="hidden" name="no" value="<?php echo $val['no']; ?>">
            </form>
          </td>
<?php   endif; ?>
      </tr>
<?php endforeach; ?>
  </table>
</body>

</html>