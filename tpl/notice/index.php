<!DOCTYPE html>
<html lang="ja">

<head>
  <title>header</title>
  <meta charset="utf-8">
  <!-- jQueryの読み込み -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <!-- フォント -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../tpl/css/header.css">
  <link rel="stylesheet" href="../tpl/css/tuuti.css">
</head>

<body>
  <!--ヘッダー-->
<?php require_once '../tpl/layout/header.php'; ?>

  <!-- 通知一覧 -->
  <h2>通知一覧</h2>


  <div id="number_list">
    <div id="nice">
      <table border="1">
<?php foreach ($notice_list as $notice) : ?>
        <tr>
          <td>
            <ul>
              <li><a href="../product/show.php?id=<?php echo $notice['product_id']; ?>"><?php echo $notice['msg']; ?></a></li>
            </ul>
          </td>
        </tr>
<?php endforeach; ?>
      </table>
      <button type=button id="more_btn">もっと見る</button>
      <button type=button id="close_btn">表示数を戻す</button>
    </div>
  </div>

  <!-- jsファイルの読み込み -->
  <script src="../tpl/js/more_show_script_4.js"></script>

</body>

</html>