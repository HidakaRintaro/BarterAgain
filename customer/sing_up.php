<?php
session_start();
require_once '../const.php';
require_once '../func/func.php';
require_once '../func/func_db.php';

// ログインセッションを破棄
discard_login_session();


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
$validat = [
  'nickname'        => [ 'blank' => 1, 'max_val' => 30  ],
  'email'           => [ 'blank' => 1, 'max_val' => 345, 'email' => 1, 'unique' => 'email' ],
  'password'        => [ 'blank' => 1, 'max_val' => 20,  'min_val' => 8 ],
  'last_name'       => [ 'blank' => 1, 'max_val' => 20  ], 
  'first_name'      => [ 'blank' => 1, 'max_val' => 20  ], 
  'last_name_kana'  => [ 'blank' => 1, 'max_val' => 40,  'kana' => 1 ], 
  'first_name_kana' => [ 'blank' => 1, 'max_val' => 40,  'kana' => 1 ], 
  'year'            => [ 'blank' => 1 ], 
  'month'           => [ 'blank' => 1 ], 
  'day'             => [ 'blank' => 1 ] 
];
$err_msg = [
  'blank'   => 'が未入力です。',
  'max_val' => '',
  'min_val' => '',
  'email'   => 'を正しい形式で入力してください。',
  'unique'  => 'このメールアドレスはすでに存在します。',
  'kana'    => 'はカタカナで入力してください。'
];


//------------------------------
// 新規会員の登録
//------------------------------

// 新規会員登録ボタンを押されたとき
if ( !empty($_POST) && $_POST['signup_btn'] === 'sing_up' ) {
  $err_list = validation_check($validat);
  $class = empty($err_list) ? 'none' : '';
  
  // バリデーションエラーが無い時、DBに新規会員情報をINSERTする
  if ( !empty($class) ) {
    $post = $_POST;

    $link = get_connect();

    $insert_sql = [
      'last_name'       => [ 'value'=> $post['last_name'],                                'type' => 's' ], 
      'first_name'      => [ 'value'=> $post['first_name'],                               'type' => 's' ], 
      'last_name_kana'  => [ 'value'=> $post['last_name_kana'],                           'type' => 's' ], 
      'first_name_kana' => [ 'value'=> $post['first_name_kana'],                          'type' => 's' ], 
      'email'           => [ 'value'=> $post['email'],                                    'type' => 's' ], 
      'birthday'        => [ 'value'=> $post['year'].'-'.$post['month'].'-'.$post['day'], 'type' => 's' ], 
      'nickname'        => [ 'value'=> $post['nickname'],                                 'type' => 's' ]
    ];
    run_insert($link, 'customer', $insert_sql);
    $id = mysqli_insert_id($link);

    $enc_arr = encrypt_info_list($post['password']);

    $insert_sql = [];
    $insert_sql = [
      'customer_id'        => [ 'value'=> $id,         'type' => 'i' ], 
      'encrypted_password' => [ 'value'=> $enc_arr[2], 'type' => 's' ], 
      'solt'               => [ 'value'=> $enc_arr[0], 'type' => 's' ], 
      'hash_cnt'           => [ 'value'=> $enc_arr[1], 'type' => 'i' ]
    ];
    run_insert($link, 'password_info', $params);
    get_close($link);

    save_login_session($id);

    header('location: ../product/index.php');
    exit;
  }
}


require_once '../tpl/customer/sing_up.php';