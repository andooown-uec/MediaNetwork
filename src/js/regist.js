$('#registForm').on('submit', function(event) {console.log('Clicked');
  // 本来のポストを打ち消す
  event.preventDefault();
  // ログイン処理
  var user_id = $('#id').val();
  var user_pw = $('#password').val();
  $.ajax({
    url: './api/regist.php',
    type: 'POST',
    data: {
      'user_id': user_id,
      'user_pw': user_pw
    }
  }).done(function(data) {
    console.log('done');
    if (data.result == 'error') {
      // エラーのとき、メッセージを表示
      $('#message').text(data.message);
    } else if (data.result == 'success') {
      // 成功したとき
      $('#info').html('登録が完了しました<br />ID: <b>' + user_id + '</b><br />パスワード: <b>' + user_pw + '</b><br /><a href="./login.html" target="_self">ログイン画面へ</a>');
    }
  }).fail(function(jqXHR, textStatus, errorThrown) {
    console.log("XMLHttpRequest : " + jqXHR.status);
    console.log("textStatus : " + textStatus);
    console.log("errorThrown : " + errorThrown);
  });
});