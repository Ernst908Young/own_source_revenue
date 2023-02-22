<span style="font-size: 20px;"><?= ucfirst($category) ?>-Line Graph</span>
<?php 
    $colors = Colorpicker::getcolor(sizeof($xaxis));
    $colors = json_encode($colors);
    $xaxis = json_encode($xaxis);
    $yaxis = json_encode($yaxis);
?>
<!-- <div style="width: 100%; overflow-x: auto; overflow-y: hidden">
  <div style="width: 2000px; height: 500px">
    <canvas id="linegraph" height="500" width="0"></canvas>   
  </div>
</div> -->


    <canvas id="linegraph"></canvas>   
 

<script type="text/javascript">
	var xValues = <?= $xaxis ?>;
  var yValues = <?= $yaxis ?>; 


var mychart = new Chart("linegraph", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      borderColor: "#ef7b20",
      data: yValues,
       fill: false,
        pointRadius: 10,
    }]
  },
  options: { 
    legend: {display: false},
    title: {
      display: true,
      text: ""
    },
    scales: {
           yAxes: [ {
          display: true,
          scaleLabel: {
            display: true,
            labelString: "<?= ucfirst($category) ?>"+' Summary'
          }
        } ]
          },

           animation: {
      onComplete: function() {
        //console.log(mychart.toBase64Image());
        $("#linegraphdata").val(mychart.toBase64Image());
        //document.getElementById('some-image-tag').src = mychart.toBase64Image();
      }
    }
  }
});

</script>
 <br>