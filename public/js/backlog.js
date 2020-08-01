$(function() {
  var count = 100;
  var tasks = [];
  var apiKey = "uNDofjcPhimOnMQpJufR36GridS7f2sDQWa75uppVvXMeYIPQ9KW6DIv9miUfTDc";
  var url = "https://miyawaki.backlog.com/api/v2/issues?count=" + count + "&apiKey=" + apiKey;
  var canvas = $("canvas");
  var graphDisplay = function () {
    $.ajax({
      type: "GET",
      url: url,
    }).done(function (response) {
      tasks['notStartedCount'] = 0;
      tasks['startCount'] = 0;
      tasks['processedCount'] = 0;
      tasks['doneCount'] = 0;
      for (var i = 0; i < count; i++) {
        if (response[i].status.name === '未対応') {
          tasks['notStartedCount'] += 1
        } else if (response[i].status.name === '処理中') {
          tasks['startCount'] += 1
        } else if (response[i].status.name === '処理済み') {
          tasks['processedCount'] += 1
        } else {
          tasks['doneCount'] += 1
        }
      }
      var myBarChart = new Chart(canvas, {
        type: 'bar',
        data: {
          labels: ["未対応", "処理中", "処理済み", "完了"],
          datasets: [{
            label: ['課題数'],
            data: [tasks['notStartedCount'], tasks['startCount'], tasks['processedCount'], tasks['doneCount']],
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
              'rgba(255,99,132,1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        }
      })
    }).fail(function () {
      alert("取得に失敗しました。");
    });
    return false;
  };
  graphDisplay();
  setInterval(function () {
    graphDisplay()
  }, 30000)
});
