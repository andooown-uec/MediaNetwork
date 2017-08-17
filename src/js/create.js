$('#createForm').on('submit', function(event) {console.log('Clicked');
  // 本来のポストを打ち消す
  event.preventDefault();
  // 作成
  $.ajax({
    url: './api/create.php',
    type: 'POST',
    data: {
      'title': $('#title').val(),
      'option1': $('#option1').val(),
      'option2': $('#option2').val()
    }
  }).done(function(data) {
    console.log('done');
    if (data.result == 'error') {
      // エラーのとき、メッセージを表示
      $('#message').text(data.message);
    } else if (data.result == 'success') {
      // 成功したとき
      window.location.href = './list.php';
    }
  }).fail(function(jqXHR, textStatus, errorThrown) {
    console.log("XMLHttpRequest : " + jqXHR.status);
    console.log("textStatus : " + textStatus);
    console.log("errorThrown : " + errorThrown);
  });
});