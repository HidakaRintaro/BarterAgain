<?php
session_start();
require_once '../const.php';
require_once '../func/func.php';
require_once '../func/func_db.php';

// ログインチェック。未ログイン時ログイン画面に遷移する。
is_login('../customer/login.php');
$customer_id = $_SESSION['login']['customer_id'];


$product_id = $_GET['id'];
$product_status = [
  1 => '新品、未使用',
  2 => '未使用に近い',
  3 => '目立った傷や汚れなし',
  4 => 'やや傷や汚れあり',
  5 => '傷や汚れあり',
  6 => '全体的に状態が悪い',
];


$link = get_connect();


//------------------------------
// 商品詳細情報の取得
//------------------------------
$select_sql = [ 'where' => [ 'id = ?' => [$product_id] ] ];
$product = run_select($link, 'v_product_show', $select_sql);
$product = $product[0];


// 申請処理
// if ( isset($_POST) && $_POST['offer'] == 'offer' ) {
// $params = [
//   'exhibit_id' => ['value' => ,            'type' => 's'], 
//   'barter_id'  => ['value' => $product_id, 'type' => 's'], 
//   'status'     => ['value' => 1,           'type' => 'i']
// ];
// run_insert($link, 'transaction', $params);
// }


//------------------------------
// 投稿コメントの登録
//------------------------------
$class = 'none';
$form_name = [ 'comment' => 'コメント' ];
$validat   = [ 'comment' => ['blank' => 1, 'max_val' => 500] ];
$err_msg   = [ 
  'blank'   => 'が未入力です。', 
  'max_val' => '' //  TODO: エラーメッセージを考える
];

// コメント投稿ボタンを押されたとき
if ( !empty($_POST['post_btn']) && $_POST['post_btn'] == 'post_btn' ) {
  $err_list = validation_check($validat);
  $class = empty($err_list) ? 'none' : '';
  
  // バリデーションエラーが無い時、DBにコメントをINSERTする
  if ( !empty($class) ) {
    $comment = $_POST['comment'];
    $select_sql = [
      'column' => ['no'],
      'where'  => ['customer_id = ?' => [$customer_id]]
    ];
  
    // 1会員が1商品に対して何回目のコメントなのかを算出(noの算出)
    $no_list = run_select($link, 'comment', $select_sql);
    foreach ($no_list as $no) {
      $no_arr[] = $no['no'];
    }
    $no_max = isset($no_arr) ? max($no_arr) + 1 : 0;
  
    $insert_sql = [
      'product_id'  => ['value' => $product_id,  'type' => 's'],
      'customer_id' => ['value' => $customer_id, 'type' => 's'],
      'no'          => ['value' => $no_max,      'type' => 'i'],
      'comment'     => ['value' => $comment,     'type' => 's']
    ];
    run_insert($link, 'comment', $insert_sql);
  }
}


//------------------------------
// コメント削除日の登録
//------------------------------

// コメント削除ボタンを押されたときコメントを削除する
if ( isset($_POST['comment_del']) && $_POST['comment_del'] == 'comment_del' ) {
  $post = $_POST;
  $update_sql = [
    'deleted_at' => ['value' => date('Y-m-d'), 'type' => 's'], 
    'where' => [
      'product_id = ?'  => [ $post['product_id']  ], 
      'customer_id = ?' => [ $post['customer_id'] ], 
      'no = ?'          => [ $post['no']          ]
    ]
  ];
  run_update($link, 'comment', $update_sql);
}


//------------------------------
// コメント一覧の取得
//------------------------------
$select_sql = [];
$select_sql = [
  'column' => [ 'product_id', 'customer_id', 'no', 'nickname', 'comment' ],
  'where'  => [ 'product_id = ?' => [$product_id] ]
];
$comment_arr = run_select($link, 'v_comment', $select_sql);
$comment_arr = $comment_arr ?? [];


get_close($link);
require_once '../tpl/product/show.php';