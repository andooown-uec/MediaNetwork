<?php
  // インクルード
  include("../functions/enquetes.php");
  include("../functions/utilities.php");

  // POST データを取得
  $post = get_data_from_post(file_get_contents("php://input"));
  $title = rawurldecode($post["title"]);
  $option1 = rawurldecode($post["option1"]);
  $option2 = rawurldecode($post["option2"]);

  if (strlen($title) != 0
      && strlen($option1) != 0
      && strlen($option2) != 0) {  // 必要な情報が含まれているとき
    if (is_readable(ENQUETES_FILE) && is_writable(ENQUETES_FILE)) { // ファイルが読み書き可能のとき
      // 現在のアンケートを取得
      $enquetes = get_enquetes();

      // アンケートを追加
      $t = time();
      $enquetes[] = array(
        'id' => count($enquetes) + 1,
        'title' => $title,
        'option1' => $option1,
        'num1' => 0,
        'option2' => $option2,
        'num2' => 0,
        'created_at' => $t,
        'updated_at' => $t
      );
      // 保存
      save_enquetes($enquetes);

      // 出力
      output_result("success");
    } else {
      // エラー出力
      output_result("error", "内部エラーが発生しました");
      return;
    }
  } else {
    // エラー出力
    output_result("error", "必要な情報が含まれていません");
    return;
  }
?>