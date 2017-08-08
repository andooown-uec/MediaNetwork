<?php
  // 定数
  const DATA_DIR = "../data/";  // データディレクトリ
  const ENQUETES_FILE = "../data/enquetes.csv";  // アンケート一覧のファイル

  function get_enquetes() {
    // ファイルを CSV モードで開く
    $file = new SplFileObject(ENQUETES_FILE);
    $file->setFlags(SplFileObject::READ_CSV);

    // ファイル内のデータループ
    foreach ($file as $key => $line) {
      if (count($line) == 8) {
        foreach($line as $key2 => $str) {
          if ($key == 0) {
            // キーの読み取り
            $keys[$key2] = $str;
          } else {
            if ($keys[$key2] == "id" || $keys[$key2] == "created_at" || $keys[$key2] == "updated_at"|| $keys[$key2] == "num1"|| $keys[$key2] == "num2") {
              $enquetes[$key - 1][$keys[$key2]] = intval($str);
            } else {
              $enquetes[$key - 1][$keys[$key2]] = $str;
            }
          }
        }
      }
    }

    return $enquetes;
  }

  function save_enquetes($enquetes) {
    // ファイルを開きロックする
    $fp = fopen(ENQUETES_FILE, "w");
    flock($fp, LOCK_EX);

    // キーの読み取り
    $keys = array();
    foreach (current($enquetes) as $key => $value) {
      $keys[] = $key;
    }
    // 書き込む
    fputs($fp, join(",", $keys) . "\n");

    foreach ($enquetes as $enquete) {
      $arr = array();
      foreach ($keys as $key) {
        if (is_string($enquete[$key])) {
          $arr[] = escape_double_quotations($enquete[$key]);
        } else {
          $arr[] = $enquete[$key];
        }
      }

      // 書き込む
      fputs($fp, join(",", $arr) . "\n");
    }

    // ファイルを閉じる
    flock($fp, LOCK_UN);
    fclose($fp);
  }
?>