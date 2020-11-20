<?php

$class = 'none';
$form_name = [
  'nickname' => 'ニックネーム', 
  'email' => 'メールアドレス', 
  'password' => 'パスワード', 
  'confirmation_password' => '確認パスワード', 
  'last_name' => '姓', 
  'first_name' => '名', 
  'last_name_kana' => 'カナ姓', 
  'first_name_kana' => 'カナ名', 
  'year' => '年', 
  'month' => '月', 
  'day' => '日'
];
// バリデーションチェックを行うリスト
$validat = [
  'nickname' => ['blank' => 1, 'max_val' => 30],
  'email' => ['blank' => 1, '' => 1],
  'price' => ['blank' => 1, 'numeric' => 1],
  'release_date' => ['blank' => 1, 'numeric' => 1, 'digit' => 8],
  'purchase_date' => ['blank' => 2, 'numeric' => 1, 'digit' => 8]
];
// エラーメッセージ一覧
$err_msg = [
  'blank' => 'が未入力です。',
  'numeric' => 'は数値を入力してください。',
  'digit' => '桁で入力してください。'
];