$(function () {
    google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
         
          ['Google',      7],
          ['Firefox',  2],
          ['Outros', 2],
        ]);

        var options = {
          title: 'Navegadores'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }

})