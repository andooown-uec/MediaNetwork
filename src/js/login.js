$('#loginForm').on('submit', function(event) {console.log('Clicked');
  // 本来のポストを打ち消す
  event.preventDefault();
  // ログイン処理
  var user_id = $('#id').val();
  var user_pw = $('#password').val();
  $.ajax({
    url: './api/login.php',
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
      document.cookie = 'user_id=' + encodeURIComponent(user_id);
      window.location.href = './list.php';
    }
  }).fail(function(jqXHR, textStatus, errorThrown) {
    console.log("XMLHttpRequest : " + jqXHR.status);
    console.log("textStatus : " + textStatus);
    console.log("errorThrown : " + errorThrown);
  });
});