<!DOCTYPE html>
<html lang="ja">

<head>
  <title>header</title>
  <meta charset="utf-8">
  <!-- jQueryの読み込み -->
  <link rel="stylesheet" href="../tpl/css/itiran.css">
</head>

<body>
  <!--ヘッダー-->
<?php require_once '../tpl/layout/header.php'; ?>

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