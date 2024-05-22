{{-- Script feito com Google Chart--}}
<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    var chartColors = ['red','orange','blue','green','yellow','purple','grey','cyan'];

    //recebe a string com elementos separados, vindos do PHP
    string_valorTotal_array = "<?php echo @$array['valorTotal']; ?>";
    //transforma esta string em um array próprio do Javascript
    array_valorTotal = string_valorTotal_array.split("|");

    //recebe a string com elementos separados, vindos do PHP
    string_mes_array = "<?php echo @$array['mes']; ?>";
    //transforma esta string em um array próprio do Javascript
    array_mes = string_mes_array.split("|");
    tamanho = array_mes.length;
    // Preenche o array com os valores dos meses e valores totais
    arrayBarSaida = [['Mês','Valor Total', { role: "style" }]];
    for (let index = 0; index < tamanho; index++) {
        arrayBarSaida.push([array_mes[index], parseInt(array_valorTotal[index]), chartColors[index]]);
    }
    console.log(arrayBarSaida);
    function drawChart() {
      var data = google.visualization.arrayToDataTable(arrayBarSaida);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  </script>

<div id="chartCanvas">
    <div id="columnchart_values" style="height: 300px"></div>
</div>


{{-- Segundo Script feito com Google Chart
<script type="text/javascript">
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);

    //recebe a string com elementos separados, vindos do PHP
    string_valorTotal_array = "<?php echo $array['valorTotal']; ?>";
    //transforma esta string em um array próprio do Javascript
    array_valorTotal = string_valorTotal_array.split("|");

    //recebe a string com elementos separados, vindos do PHP
    string_mes_array = "<?php echo $array['mes']; ?>";
    //transforma esta string em um array próprio do Javascript
    array_mes = string_mes_array.split("|");
    tamanho = array_mes.length;
    // Preenche o array com os valores dos meses e valores totais
    arrayBarSaida = [['Mês','Valor Total']];
    for (let index = 0; index < tamanho; index++) {
        arrayBarSaida.push([array_mes[index], parseInt(array_valorTotal[index])]);
    }

    function drawChart() {
      var data = google.visualization.arrayToDataTable(arrayBarSaida);

      var options = {
        /*Exibir titulo
        chart: {

          title: 'Evolução de Saídas por Mês'//,
          //subtitle: 'Sales, Expenses, and Profit: 2014-2017',
        }*/
      };

      var chart = new google.charts.Bar(document.getElementById('chartBarSaida'));

      chart.draw(data, google.charts.Bar.convertOptions(options));
    }
  </script>

<div id="chartBarSaida"></div>
--}}


{{-- Script feito com chartjs
<div id="chartCanvas">
    <canvas id="bar-chartSaida"></canvas>
</div>
<script>
    var chartColors = {
        red: 'rgb(255, 99, 132)',
        orange: 'rgb(255, 159, 64)',
        yellow: 'rgb(255, 205, 86)',
        green: 'rgb(75, 192, 192)',
        blue: 'rgb(54, 162, 235)',
        purple: 'rgb(153, 102, 255)',
        grey: 'rgb(201, 203, 207)',
        cyan: 'rgb(0,255,255)'
    };
    //recebe a string com elementos separados, vindos do PHP
    string_valorTotal_array = "<?php echo $array['valorTotal']; ?>";
    //transforma esta string em um array próprio do Javascript
    array_valorTotal = string_valorTotal_array.split("|");

    //recebe a string com elementos separados, vindos do PHP
    string_mes_array = "<?php echo $array['mes']; ?>";
    //transforma esta string em um array próprio do Javascript
    array_mes = string_mes_array.split("|");
    // Bar chart
    new Chart(document.getElementById("bar-chartSaida"), {
        type: 'bar',
        data: {
        labels: array_mes,
        datasets: [
            {
            label: "Mês",
            backgroundColor: [chartColors.red, chartColors.orange,
                            chartColors.yellow,chartColors.cyan,
                            chartColors.green,chartColors.blue,
                            chartColors.purple,chartColors.grey],
            data: array_valorTotal
            }
        ]
        },
        options: {
        legend: { display: false },
        title: {
            display: true,
            text: 'Evolução de Saídas por Mês'
        }
        }
    });
</script>
--}}
