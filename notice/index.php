<?php
session_start();
require_once '../const.php';
require_once '../func/func.php';
require_once '../func/func_db.php';

// ログアウトチェック。セッションの削除
if ( !empty($_GET) && $_GET['logout'] == 'on' ) discard_login_session();

// ログインチェック。未ログイン時ログイン画面に遷移する。
is_login('../customer/login.php');
$customer_id = $_SESSION['login']['customer_id'];

$link = get_connect();


//------------------------------
// 通知一覧の取得
//------------------------------
$notice_msg = [
  1 => '交換の申請があります。', 
  2 => '取引が成立しました。メールで届いたQRコードで発送してください。', 
  3 => '取引が拒否されました。', 
  4 => '取引が完了しました。'
];

$select_sql = [
  'column' => [ 'id', 'barter_product_id AS product_id', 'status', 'updated_at' ], 
  'where'  => [ 'exhibit_id = ?' => [ $customer_id ] ] 
];
$notice1_arr = run_select($link, 'v_notice1', $select_sql);

$select_sql = [];
$select_sql = [
  'where' => [ 'barter_id = ? OR exhibit_id = ?' => [ $customer_id, $customer_id ] ]
];
$notices2_arr = run_select($link, 'v_notice2', $select_sql);
$notice2_arr = [];
foreach ($notices2_arr as $notices2) {
  $arr = [];
  if ( $notices2['exhibit_id'] == $customer_id ) {
    $arr['id'] = $notices2['id'];
    $arr['product_id'] = $notices2['barter_product_id'];
    $arr['status'] = $notices2['status'];
    $arr['updated_at'] = $notices2['updated_at'];
    $notice2_arr[] = $arr;
  } else {
    $arr['id'] = $notices2['id'];
    $arr['product_id'] = $notices2['exhibit_product_id'];
    $arr['status'] = $notices2['status'];
    $arr['updated_at'] = $notices2['updated_at'];
    $notice2_arr[] = $arr;
  }
}

$select_sql = [];
$select_sql = [
  'column' => [ 'id', 'exhibit_product_id AS product_id', 'status', 'updated_at' ], 
  'where'  => [ 'barter_id = ?' => [ $customer_id ] ]
];
$notice3_arr = run_select($link, 'v_notice3', $select_sql);

$notice_arr = array_merge($notice1_arr, $notice2_arr, $notice3_arr);
foreach ($notice_arr as $key => $val) {
  $key_arr[$key] = $val['updated_at'];
}
array_multisort($key_arr, SORT_DESC, $notice_arr);

$notice_list = [];
$arr = [];
foreach ($notice_arr as $notice) {
  $notice_list[] = [
    'product_id' => $notice['product_id'], 
    'msg'     => $notice_msg[$notice['status']]
  ];
}


get_close($link);
require_once '../tpl/notice/index.php';