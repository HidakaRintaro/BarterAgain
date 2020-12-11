<?php
session_start();
require_once '../const.php';
require_once '../func/func.php';
require_once '../func/func_db.php';

$class = 'none';
// バリデーションチェックを行うリスト
// $validat = [
//   'email'    => ['blank' => 1, 'email' => 1, 'unique' => 'email'],
//   'password' => ['blank' => 1, 'max_val' => 20, 'min_val' => 8]
// ];

$link = get_connect();

$params = [ 'where' => [ 'id = ?' => [ $_SESSION['login']['customer_id'] ] ] ];
$list = run_select($link, 'v_customer_edit', $params);
get_close($link);
// サインアップボタンを押下したときの処理
if (!empty($_POST) && $_POST['update'] === 'update') {

  $post = $_POST;
  
  // バリデーションチェックをし、cssのclassセット
  // $err_list = validation_check($validat);
  // $class = empty($err_list) ? 'none' : '';
  if (!empty($class)) {
    $link = get_connect();
    $params = [
      'nickname' => ['value' => $post['nickname'], 'type' => 's'], 
      'postal_code' => ['value' => $post['postal'], 'type' => 's'], 
      'prefecture_id' => ['value' => $post['prefectures'], 'type' => 's'], 
      'address' => ['value' => $post['address'], 'type' => 's'], 
      'telephone_number' => ['value' => $post['telephone'], 'type' => 's'], 
      'email' => ['value' => $post['email'], 'type' => 's']
    ];
    run_insert($link, 'customer', $params);

    get_close($link);

    header('location: ../product/index.php');
    exit;
  }

}


require_once '../tpl/customer/edit.php';