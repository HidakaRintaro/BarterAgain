<?php
session_start();
require_once '../const.php';
require_once '../func/func.php';
require_once '../func/func_db.php';

// ログアウトチェック。セッションの削除
if ( !empty($_GET) && $_GET['logout'] == 'on' ) discard_login_session();

// ログインチェック。未ログイン時ログイン画面に遷移する。
is_login('../customer/login.php');
$customer_id = intval($_SESSION['login']['customer_id']);


$class = 'none';
$form_name = [
  'nickname'    => 'ニックネーム', 
  'email'       => 'メールアドレス', 
  'postal_code' => '郵便番号', 
  'prefectures' => '都道府県', 
  'address'     => '住所', 
  'telephone'   => '電話番号'
];
$validat = [
  'nickname'    => [ 'blank' => 1, 'max_val' => 30 ],
  'email'       => [ 'blank' => 1, 'max_val' => 345, 'email' => 1, 'unique' => 'email' ], 
  'postal_code' => [ 'blank' => 2,                   'digit' => 8 ], 
  'prefectures' => [ 'blank' => 2 ], 
  'address'     => [ 'blank' => 2, 'max_val' => 100 ], 
  'telephone'   => [ 'blank' => 2,                   'digit' => 13 ], 
];
$err_msg = [
  'blank'   => 'が未入力です。',
  'max_val' => '',
  'min_val' => '',
  'email'   => 'を正しい形式で入力してください。',
  'unique'  => 'このメールアドレスはすでに存在します。',
  'digit'   => 'は〇桁で入力してください。'
];


$link = get_connect();


//------------------------------
// 会員情報の更新
//------------------------------

// サインアップボタンを押下したときの処理
if ( !empty($_POST) && $_POST['update'] === 'update' ) {
  $post = $_POST;

  $err_list = validation_check($validat);
  $class = empty($err_list) ? 'none' : '';

  // バリデーションエラーが無い時、DBに会員情報をUPDATEする
  if ( !empty($class) ) {
    $post['prefectures'] = empty($post['prefectures']) ? NULL : $post['prefectures'] ;
    $update_sql = [
      'nickname'         => ['value' => $post['nickname'],    'type' => 's'], 
      'postal_code'      => ['value' => $post['postal'],      'type' => 's'], 
      'prefecture_id'    => ['value' => $post['prefectures'], 'type' => 's'], 
      'address'          => ['value' => $post['address'],     'type' => 's'], 
      'telephone_number' => ['value' => $post['telephone'],   'type' => 's'], 
      'email'            => ['value' => $post['email'],       'type' => 's'], 
      'where'            => [ 'id = ?' => [ $customer_id ] ]
    ];
    run_update($link, 'customer', $update_sql);
    save_login_session($customer_id);
  }
}


//------------------------------
// 会員情報の取得
//------------------------------
$select_sql = [
  'where' => [ 
    'id = ?' => [ $customer_id ] 
  ] 
];
$list = run_select($link, 'v_customer_edit', $select_sql);
$customer_info = $list[0];


//------------------------------
// 都道府県一覧の取得
//------------------------------
$select_sql = [
  'column' => [ 'id', 'name' ], 
  'order'  => [ 'id' => 'ASC' ]
];
$prefecture_arr = run_select($link, 'prefecture', $select_sql);


get_close($link);
require_once '../tpl/customer/edit.php';