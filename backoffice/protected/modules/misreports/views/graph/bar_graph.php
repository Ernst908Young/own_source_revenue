<h5>Chart Type - Bar Graph</h5>
<div style="width: 100%; overflow-x: auto; overflow-y: hidden">
	<div style="width: 2000px; height: 500px">
	  <canvas id="bargraph" height="500" width="0"></canvas>   
	</div>
</div>
<!-- <img src="" id="barshow"/> -->
<script type="text/javascript">
	var xValues = <?= $services ?>;
  var yValues = <?= $net_revenues ?>; 
	var barColors = <?= $colors ?>; 

var bargraph = new Chart("bargraph", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: { 
    legend: {display: false},
    title: {
      display: true,
      text: "Services Net Revenue"
    },
    scales: {
           yAxes: [ {
          display: true,
          scaleLabel: {
            display: true,
            labelString: 'Net Revenue (BBD) '
          }
        } ]
          },
           animation: {
      onComplete: function() {       
       // console.log(bargraph.toBase64Image());
        $("#bargraphdata").val(bargraph.toBase64Image());       
        
      /*  document.getElementById('barshow').src = bargraph.toBase64Image();*/
      }
    }
  }
});
</script>

 <br>