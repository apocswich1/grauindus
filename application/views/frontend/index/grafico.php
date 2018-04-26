  <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Gráfico</h1>
                    
                  <!-- Gráfico -->
                  <div id="piechart" style="width: 900px; height: 500px;"></div>
                  <!-- /Gráfico -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
        <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['PHP',     11],
          ['Node.js',      2],
          ['Ruby on Rails',  2],
          ['.NET', 2],
          ['Java',    7]
        ]);

        var options = {
          title: 'Lenguajes de Programación'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>