<?php
session_start();
require_once '../const.php';
require_once '../func/func.php';
require_once '../func/func_db.php';

$class = 'none';

$status = [
  1 => '新品、未使用', 
  2 => '未使用に近い', 
  3 => '目立った傷や汚れなし', 
  4 => 'やや傷や汚れあり', 
  5 => '傷や汚れあり', 
  6 => '全体的に状態が悪い', 
];

$product_id = $_GET['id'];

$link = get_connect();
$params = [
  'where' => ['id = ?' => [$product_id]]
];

$product = run_select($link, 'v_product_show', $params);
$product = $product[0];

// 申請処理
// if ( isset($_POST) && $_POST['offer'] == 'offer' ) {
//   $params = [
//     'exhibit_id' => ['value' => ,            'type' => 's'], 
//     'barter_id'  => ['value' => $product_id, 'type' => 's'], 
//     'status'     => ['value' => 1,           'type' => 'i']
//   ];
//   run_insert($link, 'transaction', $params);
// }

get_close($link);


require_once '../tpl/product/show.php';