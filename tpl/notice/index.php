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
  <link rel="stylesheet" href="../css/header.css">
  <link rel="stylesheet" href="../css/tuuti.css">
</head>

<body>
  <!--ヘッダー-->
<?php require_once '../tpl/layout/header.php'; ?>

  <div id="B">
    <br><br>
    <form action="#" method="GET">
      <div id="B1">
        <p><input type="text" placeholder="キーワードを入力" name="search">
          <button type="submit">検索</button></p>
      </div>
    </form>
  </div>

  <!-- 通知一覧 -->
  <h2>通知一覧</h2>


  <div id="number_list">
    <div id="nice">
      <table border="1">
        <?php //ループ 
        ?>
        <tr>
          <td>
            <ul>
              <li><a><?php echo "画像" . "○○様からメッセージがございます。"; ?></a></li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>
            <ul>
              <li><a><?php echo "画像" . "BarterAgainからのお知らせがございます。"; ?></a></li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>
            <ul>
              <li><a><?php echo "画像" . "□□様から受け取り評価がつきました。"; ?></a></li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>
            <ul>
              <li><a><?php echo "画像" . "△△様から出品した商品にコメントがつきました。"; ?></a></li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>
            <ul>
              <li><a><?php echo "画像" . "商品名"; ?></a></li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>
            <ul>
              <li><a><?php echo "画像" . "○○様からメッセージがございます。"; ?></a></li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>
            <ul>
              <li><a><?php echo "画像" . "BarterAgainからのお知らせがございます。"; ?></a></li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>
            <ul>
              <li><a><?php echo "画像" . "□□様から受け取り評価がつきました。"; ?></a></li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>
            <ul>
              <li><a><?php echo "画像" . "△△様から出品した商品にコメントがつきました。"; ?></a></li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>
            <ul>
              <li><a><?php echo "画像" . "商品名"; ?></a></li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>
            <ul>
              <li><a><?php echo "画像" . "○○様からメッセージがございます。"; ?></a></li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>
            <ul>
              <li><a><?php echo "画像" . "BarterAgainからのお知らせがございます。"; ?></a></li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>
            <ul>
              <li><a><?php echo "画像" . "□□様から受け取り評価がつきました。"; ?></a></li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>
            <ul>
              <li><a><?php echo "画像" . "△△様から出品した商品にコメントがつきました。"; ?></a></li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>
            <ul>
              <li><a><?php echo "画像" . "商品名"; ?></a></li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>
            <ul>
              <li><a><?php echo "画像" . "○○様からメッセージがございます。"; ?></a></li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>
            <ul>
              <li><a><?php echo "画像" . "BarterAgainからのお知らせがございます。"; ?></a></li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>
            <ul>
              <li><a><?php echo "画像" . "□□様から受け取り評価がつきました。"; ?></a></li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>
            <ul>
              <li><a><?php echo "画像" . "△△様から出品した商品にコメントがつきました。"; ?></a></li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>
            <ul>
              <li><a><?php echo "画像" . "商品名"; ?></a></li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>
            <ul>
              <li><a><?php echo "画像" . "○○様からメッセージがございます。"; ?></a></li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>
            <ul>
              <li><a><?php echo "画像" . "BarterAgainからのお知らせがございます。"; ?></a></li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>
            <ul>
              <li><a><?php echo "画像" . "□□様から受け取り評価がつきました。"; ?></a></li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>
            <ul>
              <li><a><?php echo "画像" . "△△様から出品した商品にコメントがつきました。"; ?></a></li>
            </ul>
          </td>
        </tr>
        <tr>
          <td>
            <ul>
              <li><a><?php echo "画像" . "商品名"; ?></a></li>
            </ul>
          </td>
        </tr>
        <?php //ループとじ 
        ?>
      </table>
      <button type=button id="more_btn">もっと見る</button>
      <button type=button id="close_btn">表示数を戻す</button>
    </div>
  </div>

  <!-- jsファイルの読み込み -->
  <script src="../js/more_show_script_4.js"></script>

</body>

</html>