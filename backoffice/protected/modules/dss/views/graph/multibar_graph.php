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

<canvas id="multibar"></canvas>
<?php 
    $colors = Colorpicker::getcolor(sizeof($xaxis));
    $colors = json_encode($colors);
    $xaxis = json_encode($xaxis);
    $t_yaxis = json_encode($t_yaxis);
    $g_yaxis = json_encode($g_yaxis);
    $q_yaxis = json_encode($q_yaxis);

    //echo $q_yaxis;
?>
<script type="text/javascript">
  function yearssekect(year) {

                 window.location.href = window.location.href+'&year='+year;
   // alert(year);
  }
    var xValues = <?= $xaxis ?>;
  var ytValues = <?= $t_yaxis ?>; 
  var ygValues = <?= $g_yaxis ?>; 
  var yqValues = <?= $q_yaxis ?>; 

  var multilinechart = new Chart('multibar', {
  type: 'bar',
  /*plugins: [{
    afterDraw: chart => {
      let ctx = chart.chart.ctx;
      ctx.save();    
      let xAxis = chart.scales['x-axis-0'];
      let xCenter = (xAxis.left + xAxis.right) / 2;
      let yBottom = chart.scales['y-axis-0'].bottom;
      ctx.textAlign = 'center';
      ctx.font = '12px Arial';
      ctx.fillText(chart.data.categories[0], (xAxis.left + xCenter) / 2, yBottom + 40);
      ctx.fillText(chart.data.categories[1], (xCenter + xAxis.right) / 2, yBottom + 40);
      ctx.strokeStyle  = 'lightgray';
      [xAxis.left, xCenter, xAxis.right].forEach(x => {
        ctx.beginPath();
        ctx.moveTo(x, yBottom);
        ctx.lineTo(x, yBottom + 40);
        ctx.stroke();
      });
      ctx.restore();
    }
  }],*/
  data: {
    labels: xValues,
   
    datasets: [{
        label: 'Tickets',
        data: ytValues,
        backgroundColor: 'red',
        borderColor: 'red',
        borderWidth: 1
      },
      {
        label: 'Grievances',
        data: ygValues,
        backgroundColor: 'blue',
        borderColor: 'blue',
        borderWidth: 1
      },
      {
        label: 'Queries',
        data: yqValues,
        backgroundColor: 'green',
        borderColor: 'green',
        borderWidth: 1
      }
    ]
  },
  options: {
    legend: {
      position: 'bottom',
      labels: {
        padding: 30,
        usePointStyle: true
      }
    },
    scales: {
      yAxes: [{
       
        scaleLabel: {
          display: true,
          labelString: "<?= ucfirst($category) ?>"+' Summary'
        }
      }],
      xAxes: [{
        gridLines: {
          drawOnChartArea: false
        }
      }]
    },
    animation: {
      onComplete: function() {
        //console.log(mychart.toBase64Image());
        $("#multibargraphdata").val(multilinechart.toBase64Image());
        //document.getElementById('some-image-tag').src = mychart.toBase64Image();
      }
    }
  }
});
</script>