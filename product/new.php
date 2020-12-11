<?php
session_start();
require_once '../const.php';
require_once '../func/func.php';
require_once '../func/func_db.php';

$class = 'none';
// // バリデーションチェックを行うリスト
// $validat = [
//   'email'    => ['blank' => 1, 'email' => 1, 'unique' => 'email'],
//   'password' => ['blank' => 1, 'max_val' => 20, 'min_val' => 8]
// ];

$link = get_connect();
$params = [
  'column' => ['id', 'name'], 
  'where' => [ 'is_active = ?' => [1] ], 
  'order' => ['id' => 'ASC']
];
$category_arr = run_select($link, 'category', $params);
get_close($link);


if (!empty($_POST) && $_POST['listing_btn'] === 'listing_btn') {

  $post = $_POST;

  // バリデーションチェックをし、cssのclassセット
  // $err_list = validation_check($validat);
  // $class = empty($err_list) ? 'none' : '';

  if (!empty($class)) {
    $link = get_connect();
    $params = [
      'column' => ['id'], 
      'where' => [ 'id LIKE ?' => [ $_SESSION['login']['prefecture_id'].'______'] ]
    ];
    $list = run_select($link, 'customer', $params);
    $max_id = get_product_id($_SESSION['login']['prefecture_id'], $list);

    $params = [
      ''
    ];
    // run_insert($link, 'product', $params);

    get_close($link);
  }


}

require_once '../tpl/product/new.php';
?>