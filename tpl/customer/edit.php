<!DOCTYPE html>
<html lang="ja">

<head>
  <title>会員更新</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../tpl/css/header.css">
  <link rel="stylesheet" href="../tpl/css/customer.css">
</head>

<body>
  <!--ヘッダー-->
<?php require_once '../tpl/layout/header.php'; ?>

  <!-- 会員登録 -->
  <div id="torok">
  <!-- ​エラーメッセージ -->
    <div class="<?php echo $class; ?>">
      <ul>
<?php foreach ($err_list as $key => $err) : ?>
        <li><?php echo $form_name[$key].$err_msg[$err]; ?></li>
<?php endforeach; ?>
      </ul>
    </div>
    <form method="post">
      <h2>本人情報更新</h2>
      <p>氏名：<?php echo $customer_info['name']; ?></p>
      <p>フリガナ：<?php echo $customer_info['name_kana']; ?></p>
      <p>生年月日：<?php echo $customer_info['birthday']; ?></p>
      <p>ニックネーム ：<input type="text" value="<?php echo $customer_info['nickname']; ?>" name="nickname"></p>
      <p>メールアドレス : <input type="text" name="email" value="<?php echo $customer_info['email']; ?>"></p>
      <br>
      <h2>発送元・お届け先住所変更</h2>
      <p>郵便番号 : <input type="text" name="postal" value="<?php echo $customer_info['postal_code']; ?>"></p>
      <br>
      <p>都道府県 : 
        <select name="prefectures">
          <option value="">--</option>
<?php foreach ($prefecture_arr as $val) : ?>
          <option value="<?php echo $val['id']; ?>" <?php echo $customer_info['prefecture'] == $val['name'] ? 'selected' : '' ; ?>>
            <?php echo $val['name']; ?>
          </option>
<?php endforeach; ?>
        </select>
      </p>
      <br>
      <p>住所 : <input type="text" name="address" value="<?php echo $customer_info['address']; ?>"></p>
      <br>
      <p>電話番号： <input type="tel" name="telephone" value="<?php echo $customer_info['telephone_number'] ?>"> </p>
      <br>
      <!-- <h2>メールアドレス・パスワード</h2> -->
      <!-- <p>メールアドレス : <input type="text" name="email" value="<?php // echo $customer_info['email']; ?>"></p> -->
      <br>
      <!-- <p>現在のパスワード : <input type="password" name="old_password"></p>
      <br>
      <p>新しいパスワード : <input type="password" name="new_password"></p>
      <br>
      <p>確認パスワード : <input type="password" name="conf_password"></p>
      <br> -->
      <p><button type="submit" name="update" value="update">登録</button></p>
    </form>
  </div>
</body>
</html>