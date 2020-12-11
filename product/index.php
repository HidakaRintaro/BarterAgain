<?php
session_start();
require_once '../const.php';
require_once '../func/func.php';
require_once '../func/func_db.php';

$class = 'none';

$link = get_connect();

$params = [
  'column' => ['id', 'name', 'image_id'], 
  'order'  => ['updated_at' => 'DESC']
];
$product_arr = run_select($link, 'product', $params);
get_close($link);


require_once '../tpl/product/index.php';