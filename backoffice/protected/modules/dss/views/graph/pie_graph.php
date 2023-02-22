<span style="font-size: 20px;"><?= ucfirst($category) ?>-Pie Graph</span>


  <?php 
    $colors = Colorpicker::getcolor(sizeof($xaxis));
    $colors = json_encode($colors);
    $xaxis = json_encode($xaxis);
    $yaxis = json_encode($yaxis);
?>
 <canvas id="piegraph" style="width:150px; height: 150px;"></canvas>

<script type="text/javascript">
  var xValues = <?= $xaxis ?>;
  var yValues = <?= $yaxis ?>; 
  var barColors = <?= $colors ?>; 
  var piegraph = new Chart("piegraph", {
    type: "pie",
    data: {
      labels: xValues,
      datasets: [{
       backgroundColor: barColors,
        data: yValues
      }]
    },
    options: {
      tooltips: {
            callbacks: {
                label: function(tooltipItems, data) {
                    return data.labels[tooltipItems.index] + 
                    " : " + 
                    data.datasets[tooltipItems.datasetIndex].data[tooltipItems.index] +
                    ' %';
                }
            }
        },
      title: {
        display: true,
        text: "<?= ucfirst($sub_category) ?>"
      },
       animation: {
       onComplete: function() {       
        $("#piechartdata").val(piegraph.toBase64Image());       
      }
    }
    }
  });
</script>
 <br>