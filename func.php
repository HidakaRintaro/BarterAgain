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
 * エラーチェックの値は、空白(blank)、数値(numeric)、文字列長(digit)、max値(max_val)、min値(min_val)、メール形式(email)、一致(match)、カタカナ(kana)
 * 
 * @param array $data 1次元目の添字をinputのname、2次元目がチェック内容の配列
 * @return array $err_list inputのnameが添字の連想配列
 */
function validation($data) {
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
    if (isset($row['max_val']) && mb_strlen($_REQUEST[$key]) > $row['max_val']) {
      $err_list[$key] = 'max_val';
      continue;
    }
    
    // 最小値チェック
    if (isset($row['min_val']) && mb_strlen($_REQUEST[$key]) < $row['min_val']) {
      $err_list[$key] = 'min_val';
      continue;
    }

    // メール形式チェック
    if (isset($row['email'])) {
      $pattern = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/";
      if ( !preg_match($pattern, $_REQUEST[$key]) ) {
        $err_list[$key] = 'email';
        continue;
      }
    }
    
    // 完全一致チェック
    if (isset($row['match']) && $_REQUEST[$key] !== $_REQUEST[$row['match']]) {
      $err_list[$key] = 'match';
      continue;
    }
  }

  // カタカナチェック
  if(isset($row['kana']) && !preg_match("/^[ァ-ヾ]+$/u", $_REQUEST[$key])){
    $err_list[$key] = 'kana';
  }

  return $err_list;
}