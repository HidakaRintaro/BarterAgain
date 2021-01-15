<!DOCTYPE html>
<html lang="ja">

<head>
   <title>新規会員登録</title>
   <meta charset="utf-8">
   <link rel="stylesheet" href="../tpl/css/header.css">
   <link rel="stylesheet" href="../tpl/css/customer.css">
</head>

<body>
   <!--ヘッダー-->
<?php require_once '../tpl/layout/header.php'; ?>

   <!-- 会員登録 -->
   <div id="torok">
      <h2>新規会員登録</h2>
      <div class="<?php echo $class; ?>">
         <ul>
<?php foreach ($err_list as $key => $err) : ?>
            <li><?php echo $form_name[$key].$err_msg[$err]; ?></li>
<?php endforeach; ?>
         </ul>
      </div>
      <form method="post">
         <p>ニックネーム　　：<input type="text" placeholder="例)まさちゃん" name="nickname"></p>
         <br>
         <p>メールアドレス　：<input type="text" placeholder="半角英数字" name="email"></p>
         <br>
         <p>パスワード　　　：<input type="password" placeholder="8~20文字以内の半角英数字" name="password"></p>
         <p>※数字・アルファベット大・小それぞれ最低1文字以上</p>
         <br>

         <h2>本人確認</h2>
         <p>性　：<input type="text" placeholder="例)勝" name="last_name">
            名　：<input type="text" placeholder="例)太郎" name="first_name"></p>
         <br>

         <p>セイ：<input type="text" placeholder="例)マサル" name="last_name_kana">
            メイ：<input type="text" placeholder="例)タロウ" name="first_name_kana"></p>
         <br>

         <p>生年月日：
            <select name="year">
               <option value="">--</option>
<?php for ($year = 1900; $year <= date('Y'); $year++) : ?>
               <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
<?php endfor; ?>
            </select>
            年
            <select name="month">
               <option value="">--</option>
<?php for ($month = 1; $month <= 12; $month++) : ?>
               <option value="<?php echo $month; ?>"><?php echo $month; ?></option>
<?php endfor; ?>
            </select>
            月
            <select name="day">
               <option value="">--</option>
<?php for ($day = 1; $day <= 31; $day++) : ?>
               <option value="<?php echo $day; ?>"><?php echo $day; ?></option>
<?php endfor; ?>
            </select>
            日 <br>

            <p><button type="submit" name="signup_btn" value="sing_up">登録</button></p>
      </form>

   </div>

</body>

</html>