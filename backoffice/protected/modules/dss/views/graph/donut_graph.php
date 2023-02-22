<span style="font-size: 20px;"><?= ucfirst($category) ?>-Donut Graph</span>

 <?php 
    $colors = Colorpicker::getcolor(sizeof($xaxis));
    $colors = json_encode($colors);
    $xaxis = json_encode($xaxis);
    $yaxis = json_encode($yaxis);
?>
 <canvas id="donategraph" style="width:150px; height: 150px;"></canvas>

<script type="text/javascript">
 var xValues = <?= $xaxis ?>;
  var yValues = <?= $yaxis ?>; 
  var barColors = <?= $colors ?>; 
	var donategraph = new Chart("donategraph", {
	  type: "doughnut",
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
	      text: "Services Net Revenue"
	    },
	     animation: {
      onComplete: function() {        
        $("#donutchartdata").val(donategraph.toBase64Image());       
      }
    }
	  }
	});
</script>
 <br>