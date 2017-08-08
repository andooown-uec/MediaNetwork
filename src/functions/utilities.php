<?php
  function get_data_from_post($value) {
    $data = array();
    foreach (explode("&", $value) as $v) {
      $pair = explode("=", $v);
      $data[$pair[0]] = $pair[1];
    }

    return $data;
  }

  function escape_double_quotations($str) {
    return "\"" . str_replace("\"", "\"\"", $str) . "\"";
  }

  function output_result($result, $message = null) {
    $res = array("result" => $result);
    if ($message != null) {
      $res["message"] = $message;
    }

    header('Content-Type: application/json; charset=UTF-8');
    echo json_xencode($res);
  }

  function array_column($target_data, $column_key, $index_key = null) {
    if (is_array($target_data) === FALSE || count($target_data) === 0) {
      return FALSE;
    }

    $result = array();
    foreach ($target_data as $array) {
      if (array_key_exists($column_key, $array) === FALSE) {
        continue;
      }
      if (is_null($index_key) === FALSE && array_key_exists($index_key, $array) === TRUE) {
        $result[$array[$index_key]] = $array[$column_key];
        continue;
      }
      $result[] = $array[$column_key];
    }

    if (count($result) === 0) {
      return FALSE;
    }

    return $result;
  }
?>