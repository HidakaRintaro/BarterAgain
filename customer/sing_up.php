<?php
require_once '../func.php';
require_once '../const.php';

$class = 'none';
$form_name = [
  'nickname' => 'ニックネーム', 
  'email' => 'メールアドレス', 
  'password' => 'パスワード', 
  'confirmation_password' => '確認パスワード', 
  'last_name' => '姓', 
  'first_name' => '名', 
  'last_name_kana' => 'カナ姓', 
  'first_name_kana' => 'カナ名', 
  'year' => '年', 
  'month' => '月', 
  'day' => '日'
];
// バリデーションチェックを行うリスト
$validat = [
  'nickname'              => ['blank' => 1, 'max_val' => 30],
  'email'                 => ['blank' => 1,                  'email' => 1, 'unique' => 'email'],
  'password'              => ['blank' => 1, 'max_val' => 20, 'min_val' => 8],
  'confirmation_password' => ['blank' => 1,                  'match' => 'password'], 
  'last_name'             => ['blank' => 1, 'max_val' => 20], 
  'first_name'            => ['blank' => 1, 'max_val' => 20], 
  'last_name_kana'        => ['blank' => 1, 'max_val' => 20, 'kana' => 1], 
  'first_name_kana'       => ['blank' => 1, 'max_val' => 20, 'kana' => 1], 
  'year'                  => ['blank' => 1], 
  'month'                 => ['blank' => 1], 
  'day'                   => ['blank' => 1] 
];
// エラーメッセージ一覧
$err_msg = [
  'blank'   => 'が未入力です。',
  'numeric' => 'は数値を入力してください。',
  'digit'   => '桁で入力してください。',
  'max_val' => '',
  'min_val' => '',
  'email'   => '',
  'match'   => '',
  'kana'    => ''
];

// サインアップボタンを押下したときの処理
if (!empty($_POST) && $_POST['btn'] === 'sing_up') {
  
  $post = $_POST;
  
  // バリデーションチェックをし、cssのclassセット
  $err_list = validation_check($validat);
  $class = empty($err_list) ? 'none' : '';
  if (!empty($class)) {
    $link = mysqli_connect(HOST, USER_ID, PASS, DB_NAME);



    mysqli_close($link);
  }

}




require_once './tpl/customer/sing_up.php';