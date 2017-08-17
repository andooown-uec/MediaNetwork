<?php
  $is_login = isset($_COOKIE['user_id']);   // ログインの有無
?>

<html>
  <head>
    <meta charset="UTF-8" />
    <title>掲示板</title>
    <link rel="stylesheet" type="text/css" href="css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="css/chart.css" />
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/bbs.css" />
  </head>
  <body>
    <div class="container">
      <div class="menuContainer">
        <a class="floatingButton bbsPageButton" href="list.php">アンケート一覧</a>
<?php if ($is_login): ?>
        <a class="floatingButton bbsPageButton" href="create.php">アンケートを作成</a>
<?php else: ?>
        <a class="floatingButton bbsPageButton" href="login.html">ログイン</a>
<?php endif; ?>
      </div>
      <div id="bbsBox" class="box">
        <div id="bbs">
          <div class="bbsItem">
            <form method="POST" action="./bbs_post.php">
              名前: <input type="text" name="name" /><br />
              本文:<br />
              <textarea name="content" rows="4" cols="40"></textarea><br />
              <input type="submit" value="投稿">
            </form>
          </div>
<?php
  const LOG_FILE = './data/log.csv';

  if (is_file(LOG_FILE)) {  // ログファイルが存在するか
    if (is_readable(LOG_FILE)) {  // ログファイルを読み込めるか
      // ログファイルを開く
      // ファイルを CSV モードで開く
      $file = new SplFileObject(LOG_FILE);
      $file->setFlags(SplFileObject::READ_CSV);
      // ログファイルの中身を出力する
      foreach ($file as $key => $line) {
        if (count($line) == 3) {
          echo '<div class="bbsItem">';
          echo ($key + 1) . ' 名前: <strong>' . $line[0] . '</strong> ';
          echo '投稿日時: <time>' . $line[1] . '</time><br />';
          echo str_replace("\n", "<br />", $line[2]);
          echo '</div>';
        }
      }
    } else {
      echo '<div class="bbsItem">ファイルが開けません</div>';
    }
  } else {
    echo '<div class="bbsItem">誰も投稿していません</div>';
  }
?>
        </div>
      </div>
    </div>

    <script type="text/javascript" src="js/jquery.min.1.9.1.js"></script>
    <script type="text/javascript" src="js/jquery.periodicalupdater.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/linq.js/2.2.0.2/jquery.linq.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/linq.js/2.2.0.2/linq.min.js"></script>
  </body>
</html>