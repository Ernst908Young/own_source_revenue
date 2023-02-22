<h5>Chart Type - Pie Chart</h5>
<canvas id="piegraph" style="width:1000px; height: 1000px;"></canvas>
<script type="text/javascript">
var xValues = <?= $services ?>;
  var yValues = <?= $net_revenues ?>; 
  var barColors = <?= $colors ?>; 

var piegraph =  new Chart("piegraph", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
     backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {

      /*legend:{
        display:true,
        position:'right',

    },*/
    title: {
      display: true,
      text: "Services Net Revenue"
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