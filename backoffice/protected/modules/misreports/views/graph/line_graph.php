<h5>Chart Type - Line Graph</h5>
<div style="width: 100%; overflow-x: auto; overflow-y: hidden">
  <div style="width: 2000px; height: 500px">
    <canvas id="linegraph" height="500" width="0"></canvas>   
  </div>
</div>

<script type="text/javascript">
	var xValues = <?= $services ?>;
  var yValues = <?= $net_revenues ?>; 


var mychart = new Chart("linegraph", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      borderColor: "#ef7b20",
      data: yValues,
       fill: false
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
            labelString: 'Net Revenue (BBD$) '
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