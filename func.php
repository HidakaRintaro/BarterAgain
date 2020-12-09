<?php
/**
 * flashメッセージセット関数
 * 
 * @param string $msg flashメッセージ
 */
function flash($msg) {
  $_SESSION['flash']['msg'] = $msg;
  $_SESSION['flash']['class'] = '';
}

/**
 * バリデーションチェック
 * 
 * エラー発生時、連想配列として添字がinputのnameになった配列を返す
 * エラーが無い時はNULLを返す。
 * エラーチェックの値は、空白(blank)、数値(numeric)、文字列長(digit)、max値(max_val)、min値(min_val)、メール形式(email_type)、メールユニーク(email_unique)、一致(match)、カタカナ(kana)
 * 
 * @param  array $data 1次元目の添字をinputのname、2次元目がチェック内容の配列
 * @return array       inputのnameが添字の連想配列
 */
function validation_check($data) {
  foreach ($data as $key => $row) {
    // 空白のチェック(1:空白チェック、2:任意項目)
    if ( isset($row['blank']) ) {
      if ( empty($_REQUEST[$key]) ) {
        if ( $row['blank'] == 2 ) continue; // 任意項目の未入力処理
        $err_list[$key] = 'blank';
        continue;
      }
    }
    
    // 数値のチェック
    if ( isset($row['numeric']) && !is_numeric($_REQUEST[$key]) ) {
      $err_list[$key] = 'numeric';
      continue;
    }
    
    // 文字列長(桁数)チェック
    if ( isset($row['digit']) && !(mb_strlen($_REQUEST[$key]) == $row['digit']) ) {
      $err_list[$key] = 'digit';
      continue;
    }
    
    // 最大値チェック
    if ( isset($row['max_val']) && mb_strlen($_REQUEST[$key]) > $row['max_val'] ) {
      $err_list[$key] = 'max_val';
      continue;
    }
    
    // 最小値チェック
    if ( isset($row['min_val']) && mb_strlen($_REQUEST[$key]) < $row['min_val'] ) {
      $err_list[$key] = 'min_val';
      continue;
    }

    // メール形式チェック
    if ( isset($row['email']) ) {
      $pattern = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/";
      if ( !preg_match($pattern, $_REQUEST[$key]) ) {
        $err_list[$key] = 'email';
        continue;
      }
    }

    // 
    if ( isset($row['unique']) ) {

    }

    // 完全一致チェック
    if ( isset($row['match']) && $_REQUEST[$key] !== $_REQUEST[$row['match']] ) {
      $err_list[$key] = 'match';
      continue;
    }
    
    // カタカナチェック
    if( isset($row['kana']) && !preg_match("/^[ァ-ヾ]+$/u", $_REQUEST[$key]) ){
      $err_list[$key] = 'kana';
    }
  }
  return $err_list;
}

/**
 * ランダム文字列の生成
 * 
 * 引数の長さのランダムな文字列を生成する
 * 
 * @param  string $length 生成する文字列の長さ
 * @return string         ランダムに生成された文字列
 */
function generate_random_string($length){
  $rand_str = '';
  $chars    = array_merge(range('a', 'z'), range('A', 'Z'), array('.', '/'));

  for($i = 0; $i < $length; $i++) {
    $rand_str .= $chars[ random_int( 0, count($chars)-1) ];
  }
  return $rand_str;
}

/** 
 * 暗号化処理
 * 
 * 文字列を$lengthの桁数のソルトで$start～$end回でハッシュして返す
 * 
 * @param  string $pass   元の文字列(平文パスワード)
 * @param  int    $length ソルトの桁数(デフォルト:5)
 * @param  int    $start  ハッシュ回数の最小値(デフォルト:10000)
 * @param  int    $end    ハッシュ回数の最大値(デフォルト:100000)
 * @return array          [ソルト, ハッシュ回数, $passのハッシュ]
 */
function encrypt_info_list($pass, $length = 5, $start = 10000, $end = 100000){
  $solt = generate_random_string($length);  // randStr呼び出し
  $cnt  = random_int($start, $end);         // ハッシュ回数
  return [$solt, $cnt, hash_str($pass, $solt, $cnt)];
}

/**
 * ハッシュ化
 * 
 * 引数の情報からハッシュ化
 * 
 * @param  string $pass ハッシュ対象(平文パスワード)
 * @param  string $solt ソルト
 * @param  int    $cnt  ハッシュ回数
 * @return string       $passのハッシュ
 */
function hash_str($pass, $solt, $cnt) {
  for ($i = 0; $i < $cnt; $i++) { 
    $pass = md5($solt.$pass);  // md5(ソルト+パスワード)
  }
  return $pass;
}

/**
 * DB接続チェック
 * 
 * DBの接続をチェックする。
 * エラー時エラーページへ遷移し処理を終了する
 * 
 * @param  object $link DBの接続情報
 * @return void
 */
function is_connect_normal($link) {
  if ( !$link ) {
    $err_msg = '予期せぬエラーが発生しました。しばらくたってから再度お試しください。';
    require './tpl/error.php';
    exit;
  }
}

/**
 * DBのSQLチェック
 * 
 * SQLのチェックをする。
 * エラー時DBを切断しエラーページへ遷移し処理を終了。
 * 
 * @param  object $link   DBの接続情報
 * @param  object $result SQLの実行結果
 * @return void
 */
function is_sql_normal($link, $result) {
  if (!$result) {
    mysqli_close($link);
    $err_msg = '予期せぬエラーが発生しました。しばらくたってから再度お試しください。';
    require './tpl/error.php';
    exit;
  }
}

/**
 * 新規顧客登録
 * 
 * 新規顧客登録処理。
 * 
 * $data = [nickname, email, last_name, first_name, last_name_kana, first_name_kana, birthday]
 * 
 * @param  object $link DBの接続情報
 * @param  array  $data 顧客の登録データ配列
 * @return void
 */
function db_insert_customer($link, &$customer_info) {
  mysqli_set_charset($link, 'utf8');
  $sql = "INSERT INTO customer(nickname, email, last_name, first_name, last_name_kana, first_name_kana, birthday) 
    VALUES(?, ?, ?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($link, $sql);
  // mysqli_stmt_bind_param($stmt, 'sssssss', $customer_info[0], $customer_info[1], $customer_info[2], $customer_info[3], $customer_info[4], $customer_info[5], $customer_info[6]);
  $array = [$stmt, 'sssssss', $customer_info];
  call_user_func_array("mysqli_stmt_bind_param", $array);
  $result = mysqli_stmt_execute($stmt);
  is_sql_normal($link, $result);
  mysqli_stmt_close($stmt);
  $id = mysqli_insert_id($link);
}

/**
 * 
 * 
 * 
 * @param object $link DBの接続情報
 * @param array  $
 */
// function db_insert($link, ) {

// }

//  TODO: ユーザidの設定
/**
 * パスワード情報の登録
 * 
 * 新規顧客のパスワード情報の登録
 * 
 * @param  object $link DBの接続情報
 * @param  int    $id   会員id
 * @param  string $pass ハッシュパスワード
 * @param  string $solt ソルト文字
 * @param  int    $cnt  ハッシュ回数
 * @return void
 */
function db_insert_password($link, $id, $pass, $solt, $cnt) {
  mysqli_set_charset($link, 'utf8');
  $sql = "INSERT INTO password_info(customer_id, encrypted_password, solt, hash_cnt) 
    VALUES(?, ?, ?, ?)";
  $stmt = mysqli_prepare($link, $sql);
  mysqli_stmt_bind_param($stmt, 'issi', $id, $pass, $solt, $cnt);
  $result = mysqli_stmt_execute($stmt);
  is_sql_normal($link, $result);
  mysqli_stmt_close($stmt);
}

function db_select_product($link, $product_id, $search) {
  
  mysqli_set_charset($link, 'utf8');
  
  
}

function db_select_products($link, $search = NULL) {
  mysqli_set_charset($link, 'utf8');
  $sql = "SELECT name, price, img_id FROM ";  // TODO: 取得カラムの指定をする
  
  if (isset($search)) {
    $sql .= " WEHRE CONCAT(name, body, image1_id, image2_id, image3_id, image4_id) LIKE '%".$search."%'";  // TODO: VIEWでテーブルを作って使用する
  }

  $sql .= " ORDER BY update_at desc";
}

/**
 * SQLに使用する文字列のサニタイズ
 * 
 * $_GETの値をサニタイズし、再代入する。
 * 
 * @param  object $link DBの接続情報
 * @return void
 */
// TODO: getとpostの両方があるときを想定する
function db_escape_str($link) {
  foreach ($_REQUEST as $key => $val) {
    $_REQUEST[$key] = mysqli_real_escape_string($link, $val);
  }
}

/**
 * ログイン会員のセッション登録
 * 
 * ログインしていない場合、引数のURLに遷移する
 * 
 * @param  string $url 遷移先のURL
 * @return void
 */
function is_login($url) {
  if ( empty($_SESSION['login']) ) {
    header('location: '.$url);
    exit;
  }
}

/**
 * ログイン状態のセッション保持
 * 
 * ログインしたらセッションに会員idとログイン時間を保存する。
 * ログイン時間はページ更新時に更新される。
 * 
 * 会員idでエラーが出たらエラーページに遷移する。
 * 
 * @param  int  $id 会員id (初期値：セッション保持中の会員id)
 * @return void
 */
function save_login_session($id) {
  if ( !isset($id) ) require_once 'error.php'; exit;  // TODO: エラーページへ遷移
  $_SESSION['login'] = [
    'customer_id' => $id,
    'login_time'  => date('Ymd')
  ];
}

/**
 * ログイン状態のセッション破棄
 * 
 * ログアウト時のセッション情報を破棄する。
 * 
 * @return void
 */
function discard_login_session() {
  unset($_SESSION['login']);
}

/**
 * ログイン認証処理
 * 
 * ログイン時の情報の認証処理
 * 
 * @param  object $link  DBの接続情報
 * @param  string $email ログイン時のメールアドレス
 * @param  string $pass  ログイン時のパスワード
 * @return void
 */
// booleanをreturnで返すべき？？
function login_authentication($link, $email, $pass) {
  mysqli_set_charset($link, 'utf8');
  $sql = "SELECT * FROM v_auth ORDER BY id ASC";
  $result = mysqli_query($link, $sql);
  is_sql_normal($link, $result);
  while ($row = mysqli_fetch_assoc($result)) {
    $hashes[] = $row;
  }
  
  // 会員の一致検索
  foreach ($hashes as $row) {
    $input_pass = hash_str($pass, $row['solt'], $row['hash_cnt']);
    if ( $input_pass == $row['password'] && $email == $row['email'] ) {
      save_login_session($row['id']);
      break;
    }
  }
}
