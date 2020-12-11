<?php
session_start();
require_once '../const.php';
require_once '../func/func.php';
require_once '../func/func_db.php';

$class = 'none';
// バリデーションチェックを行うリスト
$validat = [
  'email'    => ['blank' => 1, 'email' => 1, 'unique' => 'email'],
  'password' => ['blank' => 1, 'max_val' => 20, 'min_val' => 8]
];

// サインアップボタンを押下したときの処理
if (!empty($_POST) && $_POST['login_btn'] === 'login') {

  $post = $_POST;
  
  // バリデーションチェックをし、cssのclassセット
  $err_list = validation_check($validat);
  $class = empty($err_list) ? 'none' : '';
  if (!empty($class)) {
    $link = get_connect();
    
    $params = [
      'order' => ['id' => 'ASC']
    ];
    $list = run_select($link, 'v_auth', $params);
    get_close($link);

    if ( login_authentication($list, $post['email'], $post['password']) ) {
      header('location: ../product/index.php');
      exit;
    }
  }

}


require_once '../tpl/customer/login.php';