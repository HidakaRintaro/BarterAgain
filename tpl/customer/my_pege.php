<!DOCTYPE html>
<html lang="ja">

<head>
  <title>header</title>
  <meta charset="utf-8">
  <!-- フォント -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../tpl/css/header.css">
  <link rel="stylesheet" href="../tpl/css/my_pege.css">
</head>

<body>
  <!--ヘッダー-->
<?php require_once '../tpl/layout/header.php'; ?>

  <div id="my_img">
    <table>
      <tr>
        <td><a><img src="../tpl/img/my_pege/my1.JPG"></a>　</td>
        <td><a href="../customer/edit.php"><img src="../tpl/img/my_pege/my2.JPG"></a>　</td>
        <td><a><img src="../tpl/img/my_pege/my3.JPG"></a>　</td>
      </tr>
      <tr>
        <td><a><img src="../tpl/img/my_pege/my4.JPG"></a>　</td>
        <td><a><img src="../tpl/img/my_pege/my5.JPG"></a>　</td>
        <td><a href="../notice/index.php"><img src="../tpl/img/my_pege/my6.JPG"></a>　</td>
      </tr>
      <tr>
        <td><a href="../comment/index.php"><img src="../tpl/img/my_pege/my7.JPG"></a>　</td>
        <td><a href="../nice/index.php"><img src="../tpl/img/my_pege/my8.JPG"></a>　</td>
        <td><a><img src="../tpl/img/my_pege/my9.JPG"></a>　</td>
      </tr>
  </div>
  </table>


  <!-- フッター -->
  <footer>
    <p>© 2020 All rights reserved by BarterAgain.</p>
  </footer>
</body>

</html>