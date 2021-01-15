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

$class = 'none';

$link = get_connect();

if ( isset($_POST['search']) ) {
  $search = $_POST['search'];
  $select_sql = [
    'where'  => ['search LIKE ?' => [ $search ]] 
  ];
  $product_arr = run_select($link, 'v_search', $select_sql);
} else {
  $select_sql = [
    'column' => ['id', 'name', 'image_id'], 
    'where'  => ['is_active <> ?' => [1]], 
    'order'  => ['updated_at' => 'DESC']
  ];
  $product_arr = run_select($link, 'product', $select_sql);
}

get_close($link);


require_once '../tpl/product/index.php';