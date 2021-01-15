<?php

/**
 * DB接続
 * 
 * DBへの接続情報取得
 * 
 * @return object DBの接続情報
 */
function get_connect() {
  $link = mysqli_connect(HOST, USER_ID, PASS, DB_NAME);
  mysqli_set_charset($link, 'utf8');
  mysqli_set_charset($link, 'utf8');
  return $link;
}

/**
 * DB切断
 * 
 * DBを切断する
 * 
 * @param  object $link DBの接続情報
 * @return void
 */
function get_close($link) {
  mysqli_close($link);
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
    require '../tpl/error.php';
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
    require '../tpl/error.php';
    exit;
  }
}

/**
 * SELECT文の作成
 * 
 * 引数の値からSELECT文を作成する
 * 
 * $paramの例
 * [
 * 'column' => ['id', 'name', 'price'], 
 * 'where'  => [ 'id IN (?, ?, ?)' => [4, 5, 8], 'name LIKE ?' => ['%tanaka%'] ], 
 * 'order'  => [ 'id' => 'DESC', 'price' => 'ASC'],
 * 'limit' => 10
 * ]
 * 
 * @param  string $table  テーブル名
 * @param  array  $params SELECT文に使用する値の配列
 * @return string         SELECT文を返す
 */
function mk_select_sql($table, $params) {
  $sql = "SELECT ";
  $column = $params['column'] ?? ['*'];
  $where  = $params['where']  ?? NULL;
  $order  = $params['order']  ?? NULL;
  $limit  = $params['limit']  ?? NULL;

  // カラムを設定
  foreach ($column as $key => $val) {
    $sql .= $val;
    $sql .= $key === array_key_last($column) ? " " : ", " ;  // 最後の要素だけカンマを省く
  }
  // テーブルの設定
  $sql .= "FROM ".$table." ";
  // 条件の設定
  if ( !empty($where) ) {
    $sql .= "WHERE ";
    foreach ($where as $key => $val) {
      $where_arr = explode('?', $key);
      for ($i = 0; $i < count($where_arr); $i++) {
        $sql .= $where_arr[$i];
        if ( isset($val[$i]) ) {
          $sql .= is_string( $val[$i] ) ? "'".$val[$i]."'" : $val[$i];
        }
      }
      $sql .= $key === array_key_last($where) ? " " : " AND " ;  // 最後の要素だけANDを省く
    }
  }
  // 並び替えの設定
  if ( !empty($order) ) {
    $sql .= "ORDER BY ";
    foreach ($order as $key => $val) {
      $sql .= $key." ".$val;
      $sql .= $key === array_key_last($order) ? " " : ", " ;  // 最後の要素だけカンマを省く
    }
  }
  // 制限の設定
  if ( !empty($limit) ) {
    $sql .= "LIMIT ".$limit;
  }
  return $sql;
}

/**
 * SELECT文の実行
 * 
 * SELECTのSQLを作成し実行する。
 * 
 * SQLの作成は{ @see mk_select_sql }を使用
 * @see mk_select_sql
 * 
 * @param  object $link   DBの接続情報
 * @param  string $table  値の配列 (詳細は)
 * @param  array  $params 
 * @return array          SELECT文の実行結果
 */
function run_select($link, $table, $params) {
  $sql = mk_select_sql($table, $params);
  $result = mysqli_query($link, $sql);
  is_sql_normal($link, $result);
  while ($row = mysqli_fetch_assoc($result)) {
    $list[] = $row;
  }
  if ( !isset($list) ) $list = []; // 値が無い時は空の配列を代入
  return $list;
}

/**
 * INSERT文の実行
 * 
 * INSERTのSQLを作成し実行する
 * 
 * @param  object $link   DBの接続情報
 * @param  string $table  INSERTする対象テーブル名
 * @param  array  $params INSERTする値の2次元配列 [ カラム名 => ['value' => 登録データ, 'type' => 型 ], .... ]
 * @return void
 */
function run_insert($link, $table, &$params) {
  $types = '';
  foreach ($params as $key => $row) {
    $columns[] = $key;
    $binds[]   = '?';
    $types    .= $row['type'];
    $values[]  = $row['value'];
  }
  $column = implode(", ", $columns);  // カラム名の配列を「, 」区切りで連結
  $bind   = implode(", ", $binds);    // ?の配列を「, 」区切りで連結
  $sql    = "INSERT INTO ".$table."(".$column.") VALUES(".$bind.")";
  $stmt = mysqli_prepare($link, $sql);
  // mysqli_stmt_bind_paramの引数の作成
  $bind_params = [$stmt, $types];
  foreach ($values as $val) {
    $bind_params[] = $val;
  }
  
  // 第3引数以降を参照渡し
  for ($i = 2; $i < count($bind_params); $i++) {
    $bind_params[$i] = &$bind_params[$i];
  }
  call_user_func_array("mysqli_stmt_bind_param", $bind_params);  // コールバック関数でmysqli_stmt_bind_paramを呼び出す
  
  $result = mysqli_stmt_execute($stmt);
  is_sql_normal($link, $result);
  mysqli_stmt_close($stmt);
}


function run_update($link, $table, &$params) {
  $types = '';
  $sql = "UPDATE ".$table." SET ";
  foreach ($params as $key => $row) {
    if ( $key === 'where' ) {  // where句があるとき
      $where = "WHERE ";
      foreach ($row as $key => $val) {
        $where_arr = explode('?', $key);
        for ($i = 0; $i < count($where_arr); $i++) {
          $where .= $where_arr[$i];
          if ( isset($val[$i]) ) {
            $where .= is_string( $val[$i] ) ? "'".$val[$i]."'" : $val[$i];
          }
        }
        $where .= $key === array_key_last($row) ? " " : " AND " ;  // 最後の要素だけANDを省く
      }
    } else {  // 通常のUPDATE作成処理
      $columns[] = $key." = ?";
      $values[] = $row['value'];
      $types .= $row['type'];
    }
  }
  $column = implode(", ", $columns);  // カラム名の配列を「, 」区切りで連結
  $sql .= $column." ";
  if ( isset($where) ) $sql .= $where;

  $stmt = mysqli_prepare($link, $sql);
  
  // mysqli_stmt_bind_paramの引数の作成
  $bind_params = [$stmt, $types];
  foreach ($values as $val) {
    $bind_params[] = $val;
  }

  // 第3引数以降を参照渡し
  for ($i = 2; $i < count($bind_params); $i++) {
    $bind_params[$i] = &$bind_params[$i];
  }

  call_user_func_array("mysqli_stmt_bind_param", $bind_params);  // コールバック関数でmysqli_stmt_bind_paramを呼び出す
  
  $result = mysqli_stmt_execute($stmt);
  is_sql_normal($link, $result);
  mysqli_stmt_close($stmt);
}