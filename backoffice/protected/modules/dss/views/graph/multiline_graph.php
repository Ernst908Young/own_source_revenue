<div> <span style="font-size: 20px;"><?= ucfirst($category) ?>-Line Graph</span>
  <!-- <div style="text-align: right; margin-top: -25px;">
<?php $years_arr = [3=>'3 Years',5=>'5 Years', 10=>'10 Years']; ?>
<label> Time range</label><br>
<select prompt='select years' class="select-2" name="years" onchange="yearssekect($(this).val())">
  <?php foreach($years_arr as $k=>$val){ 
    $select = $year==$k?'selected':'';
    ?>
    <option value="<?= $k ?>" <?= $select ?>> <?= $val ?> </option>
  <?php } ?>
  
</select>
</div> -->
</div>

<?php 
    $colors = Colorpicker::getcolor(sizeof($xaxis));
    $colors = json_encode($colors);
    $xaxis = json_encode($xaxis);
    $t_yaxis = json_encode($t_yaxis);
    $g_yaxis = json_encode($g_yaxis);
    $q_yaxis = json_encode($q_yaxis);

    //echo $q_yaxis;
?>
<!-- <div style="width: 100%; overflow-x: auto; overflow-y: hidden">
  <div style="width: 2000px; height: 500px">
    <canvas id="linegraph" height="500" width="0"></canvas>   
  </div>
</div> -->


    <canvas id="multilinegraph"></canvas>   
 

<script type="text/javascript">
   /*function yearssekect(year) {

                 window.location.href = window.location.href+'&year='+year;
   // alert(year);
  }*/
  
	var xValues = <?= $xaxis ?>;
  var ytValues = <?= $t_yaxis ?>; 
  var ygValues = <?= $g_yaxis ?>; 
  var yqValues = <?= $q_yaxis ?>; 

/*var mychart = new Chart("multilinegraph", {
  type: "line",
  data: {
    labels: xValues,
    datasets: [{
      borderColor: "#ef7b20",
      data: ytValues,
       fill: false,
        pointRadius: 10,
        yAxisID: 'yAxes1',
    },
    {
      borderColor: "#2086ef",
      data: ygValues,
       fill: false,
        pointRadius: 10,
       
    },
    {
      borderColor: "#ef20a6",
      data: yqValues,
       fill: false,
        pointRadius: 10,
       
    },
    ]
  },
  options: { 
    legend: {display: false},
    title: {
      display: true,
      text: ""
    },
    scales: {
      
           yAxes1: [  {
            display: true,
            scaleLabel: {
              display: true,
              labelString: "<1?= ucfirst($category) ?>"+'Summary'
            }
           },

           ],

          },

           animation: {
      onComplete: function() {
        //console.log(mychart.toBase64Image());
        $("#multilinegraph").val(mychart.toBase64Image());
        //document.getElementById('some-image-tag').src = mychart.toBase64Image();
      }
    }
  }
});*/

var speedCanvas = document.getElementById("multilinegraph");



var dataFirst = {
    label: "Tickets",
    data: ytValues,
    lineTension: 0,
    fill: false,
    borderColor: 'red',
     pointRadius: 5,
  };

var dataSecond = {
    label: "Grievances",
    data: ygValues,
    lineTension: 0,
    fill: false,
  borderColor: 'blue',
   pointRadius: 5,
  };
var datathird = {
    label: "Queries",
    data: yqValues,
    lineTension: 0,
    fill: false,
  borderColor: 'green',
   pointRadius: 5,
  };

var speedData = {
  labels: xValues,
  datasets: [dataFirst, dataSecond, datathird]
};



var lineChart = new Chart(speedCanvas, {
  type: 'line',
  data: speedData,
  options: {
    legend: {
    display: true,
    position: 'top',
    labels: {
      boxWidth: 80,
      fontColor: 'black'
    }
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
        $("#multilinegraphdata").val(lineChart.toBase64Image());
        //document.getElementById('some-image-tag').src = mychart.toBase64Image();
      }
    }
  }
});
</script>
 <br>