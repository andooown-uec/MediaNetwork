<?php
  $is_login = isset($_COOKIE['user_id']);   // ログインの有無

  // クエリを取得
  $id = $_GET['id'];
  // ファイルを読み込む
  $fp = fopen('./data/enquetes.csv', "r+");
  flock($fp, LOCK_EX);
  // ID とパスワードハッシュ値が一致している行がある場合、フラグを立てる
  $enq_exists = false;
  while ($line = fgetcsv($fp)) {
    if (strcmp($line[0], $id) == 0) {
      $enq_exists = true;
      // 情報を取得する
      $title = $line[1];
      $option1 = $line[2];
      $option2 = $line[4];

      break;
    }
  }
  flock($fp, LOCK_UN);
  fclose($fp);
?>

<html>
  <head>
    <meta charset="UTF-8" />
    <title>投票</title>
    <link rel="stylesheet" type="text/css" href="css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="css/chart.css" />
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/vote.css" />
  </head>
  <body>
    <div class="container">
      <div id="voteBox" class="box">
<?php if ($enq_exists): ?>
        <h1>投票</h1>
        <form id="voteForm" action="#" method="POST">
          <table border="0">
            <tr>
              <td><?php echo $title; ?></td>
            </tr>
            <tr>
              <td><input type="radio" name="option" value="op1" checked="checked"><?php echo $option1; ?></td>
            </tr>
            <tr>
              <td><input type="radio" name="option" value="op2"><?php echo $option2; ?></td>
            </tr>
          </table>
          <span id="message"></span><br />
          <input type="submit" value="送信">
        </form>
<?php else: ?>
        <p>
          指定されたアンケートが存在しません<br />
          <a href='list.php'>一覧ページに戻る</a>
        </p>
<?php endif; ?>
      </div>
    </div>

    <script type="text/javascript" src="js/jquery.min.1.9.1.js"></script>
    <script type="text/javascript" src="js/jquery.periodicalupdater.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/linq.js/2.2.0.2/jquery.linq.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/linq.js/2.2.0.2/linq.min.js"></script>
    <script type="text/javascript" src="js/vote.js"></script>
  </body>
</html>