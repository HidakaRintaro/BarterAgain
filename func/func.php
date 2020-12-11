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
  $err_list = [];
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

    // ユニークチェック
    // if ( isset($row['unique']) ) {

    // }

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
 * 文字列のサニタイズ
 * 
 * 戻り値無しでエスケープするため、引数の$escape_arr作成時も
 * 参照代入で配列を作成し本来の変数にエスケープをかけに行く。
 * 
 * @param  object $link       DBの接続情報
 * @param  array  $escape_arr エスケープ対象の配列
 * @return void
 */
function escape_str($link, &$escape_arr) {
  foreach ($escape_arr as $key => $val) {
    $escape_arr[$key] = mysqli_real_escape_string($link, $val);
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
// エラーページの設定
function save_login_session($id) {
  if ( !isset($id) ) {
    require_once '../tpl/error.php';
    exit;
  }
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
 * @param  array   $params  DBデータの取得配列
 * @param  string  $email   ログイン時のメールアドレス
 * @param  string  $pass    ログイン時のパスワード
 * @return boolean
 */
function login_authentication($params, $email, $pass) {
  foreach ($params as $row) {
    $input_pass = hash_str($pass, $row['solt'], $row['hash_cnt']);
    if ( $input_pass == $row['encrypted_password'] && $email == $row['email'] ) {
      save_login_session($row['id']);
      return true;
    }
  }
  return false;
}
