google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

// Set Data
const data = google.visualization.arrayToDataTable([
  ['Agua', 'Mhl'],
  ['Energia',55],
  ['Supermercado',49],
  ['arroz',44],
  ['feijao',24],
  ['chocolate',15]
]);

// Set Options
const options = {
  title:'Visão dos últimos 30 dias'
};

// Draw
const chart = new google.visualization.BarChart(document.getElementById('myChart'));
chart.draw(data, options);

}
