<div> <span style="font-size: 20px;"><?= ucfirst($category) ?>-Bar Graph</span>
  <div style="text-align: right; margin-top: -25px;">
<?php $years_arr = [3=>'3 Years',5=>'5 Years', 10=>'10 Years']; ?>
<label> Time range</label><br>
<select prompt='select years' class="select-2" name="years" onchange="yearssekect($(this).val())">
  <?php foreach($years_arr as $k=>$val){ 
    $select = $year==$k?'selected':'';
    ?>
    <option value="<?= $k ?>" <?= $select ?>> <?= $val ?> </option>
  <?php } ?>
  
</select>
</div>
</div>

<?php 
//echo $yaxis;
    $colors = Colorpicker::getcolor(sizeof($xaxis));
    $colors = json_encode($colors);
  
?>

	  <canvas id="bargraph"></canvas>   

<script type="text/javascript">
  function yearssekect(year) {

                 window.location.href = window.location.href+'&year='+year;
   // alert(year);
  }
	  var xValues = <?= json_encode($xaxis) ?>;
  var yValues = <?= json_encode($yaxis) ?>; 
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
       // console.log(bargraph.toBase64Image());
        $("#bargraphdata").val(bargraph.toBase64Image());       
        
      /*  document.getElementById('barshow').src = bargraph.toBase64Image();*/
      }
    }
  }
});
</script>

 <br>