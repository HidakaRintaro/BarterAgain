<?php
session_start();
require_once '../const.php';
require_once '../func/func.php';
require_once '../func/func_db.php';

// ログアウトチェック。セッションの削除
if ( !empty($_GET) && $_GET['logout'] == 'on' ) discard_login_session();

// ログインセッションを破棄
discard_login_session();


$class = 'none';
$form_name = [
  'email'    => 'メールアドレス', 
  'password' => 'パスワード', 
  'auth'     => ''
];
$validat = [
  'email'    => [ 'blank' => 1, 'max_val' => 345, 'email' => 1 ],
  'password' => [ 'blank' => 1, 'max_val' => 20,  'min_val' => 8 ]
];
$err_msg = [
  'blank'   => 'が未入力です。',
  'max_val' => '',
  'min_val' => '',
  'email'   => 'を正しい形式で入力してください。',
  'auth'    => ''
];

//------------------------------
// ログイン処理
//------------------------------

// ログインボタンを押されたとき
if ( !empty($_POST) && $_POST['login_btn'] === 'login' ) {
  $err_list = validation_check($validat);
  $class = empty($err_list) ? 'none' : '';

  // バリデーションエラーが無い時、ログイン処理
  if ( !empty($class) ) {
    $post = $_POST;

    $link = get_connect();
    $select_sql = [ 'order' => [ 'id' => 'ASC' ] ];
    $list = run_select($link, 'v_auth', $select_sql);
    get_close($link);

    if ( login_authentication($list, $post['email'], $post['password']) ) {
      header('location: ../product/index.php');
      exit;
    }

    // 値は正しいが一致する会員情報が無い時
    if ( empty($err_list) ) {
      $class = '';
      $err_list['auth'] = 'auth';
      $err_msg['auth'] = 'パスワードがメールアドレスが違います。';
    }
  }
}


require_once '../tpl/customer/login.php';