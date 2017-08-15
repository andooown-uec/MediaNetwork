<?php
  $is_login = isset($_COOKIE['user_name']);   // ログインの有無
?>

<html>
  <head>
    <meta charset="UTF-8" />
    <title>アンケート一覧</title>
    <link rel="stylesheet" type="text/css" href="css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="css/chart.css" />
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/list.css" />
  </head>
  <body>
    <div class="container">
      <div class="menuContainer">
<?php if ($is_login): ?>
        <a class="floatingButton listPageButton" href="list.php">アンケートを作成</a>
<?php else: ?>
        <a class="floatingButton listPageButton" href="list.php">ログイン</a>
<?php endif; ?>
      </div>
      <div id="listBox" class="box">
        <div id="list"><div class="loading"><i class="fa fa-spinner fa-spin"></i></div></div>
      </div>
    </div>

    <script type="text/javascript" src="js/jquery.min.1.9.1.js"></script>
    <script type="text/javascript" src="js/jquery.periodicalupdater.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/linq.js/2.2.0.2/jquery.linq.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/linq.js/2.2.0.2/linq.min.js"></script>
    <script type="text/javascript" src="js/list.js"></script>
  </body>
</html>