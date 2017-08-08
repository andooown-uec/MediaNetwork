var data = [] // アンケート

// ページ読み込み完了時に実行
$(function() {
  // アンケート一覧を定期的に取得する
  $.PeriodicalUpdater('./api/list.php', {
    method: 'get',
    minTimeout: 3000,
    multiplier: 1,
    maxCalls: 0
  }, function(json) {
    // データを保存
    data = json;
    console.log("Updated enquetes");
    console.log(data);
    // リストを更新
    updateList();
  });
});

// データにもとづいてリストを更新する関数
function updateList() {
  if (data.length > 0) {  // データが存在するとき
    // list 内を空にする
    $('#list').empty();
    // list のスタイルを変更
    $('#list').css('justify-content', 'flex-start')

    // ソートする
    data.sort((a, b) => {
      if (a.updated_at > b.updated_at) return -1;
      if (a.updated_at < b.updated_at) return 1;
      if (a.id < b.id) return -1;
      if (a.id > b.id) return 1;
      return 0;
    });

    // list に要素を追加
    for (var i = 0; i < data.length; i++) {
      // 割合を計算する
      var rate1 = 0, rate2 = 0;
      if (data[i].num1 > 0 || data[i].num2 > 0) {
        rate1 = Math.round(parseFloat(data[i].num1) / parseFloat((data[i].num1 + data[i].num2)) * 100.0);
        rate2 = 100 - rate1;
      }
      // 要素を追加
      $('#list').append(
        '<div class="listItem">' +
          '<span class="itemTitle">' + data[i].title + '</span><br />' +
          '<table class="tableOption">' +
            '<tr>' +
              '<th><span class="textOption">' + data[i].option1 + '</span></th>' +
              '<td class="tdChart"><div class="charts"><div class="charts__chart chart--p' + rate1 + ' chart--red" data-percent></div></div></td>' +
              '<td>' + data[i].num1 + '</td>' +
            '</tr>' +
            '<tr>' +
              '<th><span class="textOption">' + data[i].option2 + '</span></th>' +
              '<td class="tdChart"><div class="charts"><div class="charts__chart chart--p' + rate2 + ' chart--blue" data-percent></div></div></td>' +
              '<td>' + data[i].num2 + '</td>' +
            '</tr>' +
          '</table><br />' +
          '<span class="itemDate">更新日時: ' + dateToString(new Date(data[i].updated_at * 1000)) + '</span>' +
          '<span id="itemId" hidden>' + data[i].id + '</span>' +
        '</div>'
      );

      // 既存のイベントを削除
      $('.listItem').off('click');
      // イベントを登録
      $('.listItem').on('click', function () {
        // 対象のアンケートを取得する
        var id = parseInt($(this).children("#itemId").html());
        console.log(Enumerable.From(data).Where('$.id == ' + id).First());

        console.log("Clicked!(id: " + $(this).children("#itemId").html() + ")");
        // フェードイン
        $('#modalOverlay').fadeIn('slow');
      });
    }
  }
}

function dateToString(date) {
  // Date オブジェクトから取得
  var year  = date.getFullYear();
  var month = date.getMonth() + 1;
  var day   = date.getDate();
  var hour  = date.getHours();
  var min   = date.getMinutes() < 10 ? '0' + date.getMinutes() : date.getMinutes();
  var sec   = date.getSeconds() < 10 ? '0' + date.getSeconds() : date.getSeconds();

  return year + '/' + month + '/' + day + ' ' + hour + ':' + min + ':' + sec;
}