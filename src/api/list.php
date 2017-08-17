<?php
  // インクルード
  include("../functions/enquetes.php");
  include("../functions/json_xencode.php");

  // タイムゾーンの設定
  date_default_timezone_set('Asia/Tokyo');

  // アンケート一覧の取得
  $enquetes = get_enquetes();
  // 出力データの作成
  $json = array();
  foreach ($enquetes as $enquete) {
    if (count($enquete) == 8) {
      // 追加
      $json[] = $enquete;
    }
  }

  // 出力
  header('Content-Type: application/json; charset=UTF-8');
  echo json_xencode($json);
?>