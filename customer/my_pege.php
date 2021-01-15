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

require_once '../tpl/customer/my_pege.php';