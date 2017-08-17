<?php
  $is_login = isset($_COOKIE['user_id']);   // ログインの有無
?>

<html>
  <head>
    <meta charset="UTF-8" />
    <title>アンケート作成</title>
    <link rel="stylesheet" type="text/css" href="css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="css/chart.css" />
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/create.css" />
  </head>
  <body>
    <div class="container">
      <div id="createBox" class="box">
<?php if ($is_login): ?>
        <h1>アンケート作成</h1>
        <form id="createForm" action="#" method="POST">
          <table border="0">
            <tr>
              <td>アンケート名</td>
              <td><input id='title' type="text" name="title" /></td>
            </tr>
            <tr>
              <td>選択肢1</td>
              <td><input id='option1' type="text" name="option1" /></td>
            </tr><tr>
              <td>選択肢2</td>
              <td><input id='option2' type="text" name="option2" /></td>
            </tr>
          </table>
          <span id="message"></span><br />
          <input type="submit" value="送信">
        </form>
<?php else: ?>
        <p>
          アンケートの作成にはログインが必要です。<br />
          <a href='login.html' target="_self">ログインページ</a>でログインして下さい。
        </p>
<?php endif; ?>
      </div>
    </div>

    <script type="text/javascript" src="js/jquery.min.1.9.1.js"></script>
    <script type="text/javascript" src="js/jquery.periodicalupdater.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/linq.js/2.2.0.2/jquery.linq.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/linq.js/2.2.0.2/linq.min.js"></script>
    <script type="text/javascript" src="js/create.js"></script>
  </body>
</html>