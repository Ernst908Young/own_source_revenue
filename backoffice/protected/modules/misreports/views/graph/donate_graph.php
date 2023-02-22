
 <h5>Chart Type - Donut Chart</h5>
 <canvas id="donategraph" style="width:1000px; height: 1000px;"></canvas>

<script type="text/javascript">
  var xValues = <?= $services ?>;
  var yValues = <?= $net_revenues ?>; 
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