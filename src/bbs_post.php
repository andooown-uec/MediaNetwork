<?php
  // POST データを取得
  $post = $_POST;
  // 送信されたデータを取得
  if (strlen($post['name']) != 0) {
    $name = htmlspecialchars(rawurldecode($post['name']));
  } else {
    $name = '名無しさん';
  }
  date_default_timezone_set('Asia/Tokyo');
  $time_str = date('Y/m/j H:i:s');
  $content = htmlspecialchars(rawurldecode($post['content']));

  // ログファイルを開く
  $fp = fopen('./data/log.csv', 'a');
  flock($fp, LOCK_EX);
  // 投稿された内容を書き込む
  fputs($fp, "\"".str_replace("\"", "\"\"", $name)."\",\"".str_replace("\"", "\"\"", $time_str)."\",\"".str_replace("\"", "\"\"", $content)."\"\n");
  // ログファイルを閉じる
  flock($fp, LOCK_UN);
  fclose($fp);
?>

<html>
  <head>
    <meta charset="UTF-8" />
    <title>投稿を受け付けました</title>
    <link rel="stylesheet" type="text/css" href="css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="css/chart.css" />
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/bbs_post.css" />
  </head>
  <body>
    <div class="container">
      <div id="postBox" class="box">
<?php
  echo '名前: ' . $name . '<br />';
  echo '投稿日時: <time>' . $time_str . '</time><br />';
  echo $content . '<br /><br />';
?>
        <a href="./bbs.php" target="_self">掲示板に戻る</a><br />
        <a href="./list.php" target="_self">アンケート一覧に戻る</a>
      </div>
    </div>

    <script type="text/javascript" src="js/jquery.min.1.9.1.js"></script>
    <script type="text/javascript" src="js/jquery.periodicalupdater.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/linq.js/2.2.0.2/jquery.linq.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/linq.js/2.2.0.2/linq.min.js"></script>
    <script type="text/javascript" src="js/create.js"></script>
  </body>
</html>