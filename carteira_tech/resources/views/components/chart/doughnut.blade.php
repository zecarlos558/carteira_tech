<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    //recebe a string com elementos separados, vindos do PHP
    string_nomes_array = "<?php echo $array['nomes']; ?>";
    //transforma esta string em um array próprio do Javascript
    array_nomes = string_nomes_array.split("|");

    //recebe a string com elementos separados, vindos do PHP
    string_numeros_array = "<?php echo $array['percentual']; ?>";
    //transforma esta string em um array próprio do Javascript
    array_numeros = string_numeros_array.split("|");

    tamanho = array_nomes.length;
    // Preenche o array com os valores dos nomes e percentual
    arraySaida = [['Plano','Percentual']];
    for (let index = 0; index < tamanho; index++) {
        arraySaida.push([array_nomes[index], parseInt(array_numeros[index])]);
    }
    function drawChart() {

      var data = google.visualization.arrayToDataTable(arraySaida);

      var options = {
        /*Exibir titulo
        title: 'Percentual das Saídas dos Planos'
        */
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechartSaida'));

      chart.draw(data, options);
    }
  </script>

<div id="chartCanvas">
    <div id="piechartSaida" style="height: 300px"></div>
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
