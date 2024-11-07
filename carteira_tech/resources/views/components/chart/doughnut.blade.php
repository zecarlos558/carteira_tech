<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function sanitizeJSON(unsanitized) {
        return unsanitized.replace(/\&quot;/g, "\"");
    }

    objeto = "{{ ($array) }}";
    objeto = JSON.parse(sanitizeJSON(objeto));
    array_doughnut = [['Plano','Percentual']];
    for (let chave in objeto = objeto.doughnut) {
        array_doughnut.push([chave, parseInt(objeto[chave])]);
    }
    function drawChart() {

      var data = google.visualization.arrayToDataTable(array_doughnut);

      var options = {
        'chartArea': {'width': '100%', 'height': '100%', 'left' : '15%'}
        //'legend': {'position': 'top'}
        //title: 'Percentual das Saídas dos Planos',
        //sliceVisibilityThreshold: .2
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechartSaida'));

      chart.draw(data, options);
    }
  </script>

<div id="chartCanvas">
    <div id="piechartSaida"></div>
</div>


{{-- Script feito com chartjs
    <div id="chartCanvas" >
    <canvas id="myChartSaida" ></canvas>
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
    string_nomes_array = "<?php echo $array['nomes']; ?>";
    //transforma esta string em um array próprio do Javascript
    array_nomes = string_nomes_array.split("|");

    //recebe a string com elementos separados, vindos do PHP
    string_numeros_array = "<?php echo $array['percentual']; ?>";
    //transforma esta string em um array próprio do Javascript
    array_numeros = string_numeros_array.split("|");

    new Chart(document.getElementById("myChartSaida"), {
    type: 'doughnut',
    data: {
    labels: array_nomes,
    datasets: [
        {
        label: "Percentual Saida Planos",
        backgroundColor: [chartColors.red, chartColors.orange,
                        chartColors.yellow,chartColors.cyan,
                        chartColors.green,chartColors.blue,
                        chartColors.purple,chartColors.grey],
        data: array_numeros
        }
    ]
    },
    options: {
    title: {
        display: true,
        text: 'Percentual das Saídas dos Planos'
    }
    }
});
</script>
--}}
