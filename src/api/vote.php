<?php
  // インクルード
  include("../functions/enquetes.php");
  include("../functions/utilities.php");

  // POST データを取得
  $post = get_data_from_post(file_get_contents("php://input"));

  if (strlen($post["id"]) != 0
      && strlen($post["option"]) != 0) {  // 必要な情報が含まれているとき
    if (is_readable(ENQUETES_FILE) && is_writable(ENQUETES_FILE)) { // ファイルが読み書き可能のとき
      // 現在のアンケートを取得
      $enquetes = get_enquetes();
      // 投票先のアンケートのインデックスを取得
      $key = array_search(intval($post["id"]), array_column($enquetes, 'id'));
      if ($key == FALSE) {
        // エラー出力
        output_result("error", "指定されたIDを持つアンケートはありません");
        return;
      }
      // 投票する
      if ($post['option'] == 'op1') {
        $enquetes[$key]['num1'] = $enquetes[$key]['num1'] + 1;
        $enquetes[$key]['updated_at'] = time();
      } elseif ($post['option'] == 'op2') {
        $enquetes[$key]['num2'] = $enquetes[$key]['num2'] + 1;
        $enquetes[$key]['updated_at'] = time();
      }
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