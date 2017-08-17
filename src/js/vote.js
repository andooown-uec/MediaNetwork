$('#voteForm').on('submit', function(event) {console.log('Clicked');
  // 本来のポストを打ち消す
  event.preventDefault();console.log(window.location.search.split('=')[1]);
  // 作成
  $.ajax({
    url: './api/vote.php',
    type: 'POST',
    data: {
      'id': window.location.search.split('=')[1],
      'option': $('input[name=option]:checked').val()
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