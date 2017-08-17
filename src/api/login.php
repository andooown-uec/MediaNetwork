<?php
  include("../functions/utilities.php");

  // 定数
  const USERS_FILE = "../data/users.csv";  // ユーザー一覧のファイル

  // POST データを取得
  $post = get_data_from_post(file_get_contents("php://input"));
  // ユーザーが送信してきた ID とパスワードの取得
  $user_id = htmlspecialchars($post['user_id']);
  $user_pw = htmlspecialchars($post['user_pw']);

  // 空白のチェック
  if (strcmp($user_id, "") == 0 || strcmp($user_pw, "") == 0) {
    // エラー出力
    output_result("error", "IDまたはパスワードが空白です");
    return;
  }

  // ファイルの存在チェック
  if (!file_exists(USERS_FILE)) {
    // エラー出力
    output_result("error", "誰も登録していません");
    return;
  }

  // ファイルを読み込む
  $fp = fopen(USERS_FILE, "r+");
  flock($fp, LOCK_EX);
  // ID とパスワードハッシュ値が一致している行がある場合、フラグを立てる
  $user_exists = false;
  while ($line = fgetcsv($fp)) {
    if (strcmp($line[0], $user_id) == 0
        && strcmp($line[1], hash("sha256", $user_pw)) == 0) {
      $user_exists = true;
      break;
    }
  }
  flock($fp, LOCK_UN);
  fclose($fp);

  if ($user_exists) {
    output_result("success");
  } else {
    output_result("error", "IDまたはパスワードが違います");
  }
?>