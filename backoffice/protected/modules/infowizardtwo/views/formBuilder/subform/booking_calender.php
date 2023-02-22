
<?php 

	$month_year = $month.'-'.$year;
	$total_days = date('t',strtotime('01-'.$month_year));
	$days_array = [1=>'Mon',2=>'Tue',3=>'Wed',4=>'Thu',5=>'Fri',6=>'Sat',7=>'Sun'];
	$day_one = date('D',strtotime('01-'.$month_year));
	$current_date = date('Y-m-d');


	$booking_array =[];
	if(isset($name_place_id)){
			$sql = "SELECT * FROM bo_service_booking_schedule WHERE DATE(from_date) BETWEEN '".date('Y-m-d',strtotime('01-'.$month.'-'.$year))."' AND '".date('Y-m-d',strtotime($total_days.'-'.$month.'-'.$year))."' AND bo_booking_sub_category_master_id=$name_place_id ";

	//echo $sql;

	$get_booking_details = Yii::app()->db->createCommand($sql)->queryAll();

$booking_datearray = array();

	if(isset($_SESSION['booking'])){
		    $booking_from_date = $_SESSION['booking']['from_date'.$name_place_id];
			$booking_to_date = $_SESSION['booking']['to_date'.$name_place_id];
			
			    $booking_interval = new DateInterval('P1D');
			 
			    $booking_realEnd = new DateTime($booking_to_date);
			    $booking_realEnd->add($booking_interval);
			 
			    $booking_period = new DatePeriod(new DateTime($booking_from_date), $booking_interval, $booking_realEnd);
			 
			    foreach($booking_period as $booking_date) {
			        $booking_datearray[] = $booking_date->format('Y-m-d');
			    }
			$booking_array = $booking_datearray;
	}

	}
	

	$already_booked = [];
	$datearray = array();
	if(isset($get_booking_details) && $get_booking_details){
		foreach ($get_booking_details as $key => $value) {
			$from_date = $value['from_date'];
			$to_date = $value['to_date'];
			
			    $interval = new DateInterval('P1D');
			 
			    $realEnd = new DateTime($to_date);
			    $realEnd->add($interval);
			 
			    $period = new DatePeriod(new DateTime($from_date), $interval, $realEnd);
			 
			    foreach($period as $date) {
			        $datearray[] = $date->format('Y-m-d');
			    }
			$already_booked = $datearray;
		}
	}

	

	
?>

<div class="row">
	<div class="col-md-12">
		<span onclick="changemonth('previous',<?= $month ?>,<?= $year ?>)" style="cursor: pointer;" class="btn-primary"> < previous </span>
		&nbsp;&nbsp;&nbsp;&nbsp;<b><?= date('M-Y',strtotime('01-'.$month_year)) ?></b>&nbsp;&nbsp;&nbsp;&nbsp;
		<span onclick="changemonth('next',<?= $month ?>,<?= $year ?>)" style="cursor: pointer;" class="btn-primary"> next > </span>

		<div style="text-align: right;">
			<?php if(isset($name_place_id)){ ?>
			<span>
				Booking From: <strong id="bfd"><?= @$_SESSION['booking']['from_date'.$name_place_id] ? (date('d-m-Y',strtotime($_SESSION['booking']['from_date'.$name_place_id]))) : '' ?></strong>
				 To: <strong id="bfd"><?= @$_SESSION['booking']['to_date'.$name_place_id] ? (date('d-m-Y',strtotime($_SESSION['booking']['to_date'.$name_place_id]))) : '' ?></strong> 
			</span>
		<?php } ?>
		</div>
	</div>
</div>
<br><br>

<div style="height: 300px; overflow-x: auto;">
<table class="table table-bordered">
	<tr>
		<th>Mon</th>
		<th>Tue</th>
		<th>Wed</th>
		<th>Thu</th>
		<th>Fri</th>
		<th>Sat</th>
		<th>Sun</th>
	</tr>
	<?php  $cell_iteration = 1; $print_start = false;
	
		for($i=1; $i<=6; $i++){
			echo '<tr>';
			for($j=1; $j<=7; $j++){
				/*if($j==7){
					$cell_color = '#e6ffcc';
				}else{
					$cell_color = '';
				}*/

				$cell_color = '';
				$book_link = true;
				$border_color = 'none';		
				
				if($print_start == false && $day_one == $days_array[$j]){
					$print_start = true;
					$dcount = 1;

					$coming_date = date('Y-m-d',strtotime('1-'.$month_year));
					if(in_array($coming_date, $already_booked)){
						$cell_color = '#ffcccc';
						$book_link = false;
					}


					//your booking
					if(in_array($coming_date, $booking_array)){
						$cell_color = '#ccfff0';
						$book_link = true;
					}

					//future date disable condition code
					if(strtotime($coming_date) < strtotime(date('d-m-Y'))){
						$cell_color = '#e0e0e0';
						$book_link = false;
					}

					if(date('d-m-Y',strtotime($dcount.'-'.$month_year)) == date('d-m-Y')){
						$border_color = 'border: 4px solid #CC5801;';
					}
					echo '<td style="background-color:'.$cell_color.'; '.$border_color.'">';
							if($book_link==true){
								echo '<span style="cursor: pointer;" onclick="bookdates('.$dcount.','.$month.','.$year.')">'.$dcount.'</span>';
							}else{
								echo $dcount;
							}
							
					    echo '</td>';
					$dcount++;				
				}else{
					if($print_start==true && $dcount<=$total_days){
						$coming_date = date('Y-m-d',strtotime($dcount.'-'.$month_year));
						if(in_array($coming_date, $already_booked)){
							$cell_color = '#ffcccc';
							$book_link = false;
						}

						//your booking
					if(in_array($coming_date, $booking_array)){
						$cell_color = '#ccfff0';
						$book_link = true;
					}

						//future date disable condition code
							if(strtotime($coming_date) < strtotime(date('d-m-Y'))){
								$cell_color = '#e0e0e0';
								$book_link = false;
							}

						if(date('d-m-Y',strtotime($dcount.'-'.$month_year)) == date('d-m-Y')){
							$border_color = 'border: 4px solid #CC5801;';
						}
						echo '<td style="background-color:'.$cell_color.'; '.$border_color.'">';
							if($book_link==true){

								echo '<span style="cursor: pointer;" onclick="bookdates('.$dcount.','.$month.','.$year.')">'.$dcount.'</span>';
							}else{
								echo $dcount;
							}
							
					    echo '</td>';
						$dcount++;
					}else{					
							echo '<a href=""><td style="background-color:'.$cell_color.'; '.$border_color.'"></td></a>';					
					}					
				}
						
				$cell_iteration++;	
			}
			echo '</tr>';

			if($dcount>=$total_days){
				$i=10;
			}
		}		
	?>
	
</table>
</div>
<div style="text-align: right;">
	<?php if(@$total_fees){ ?>
	Total Booking Amount : <b id="tbamt"><?= $total_fees ?></b>
<?php } ?>
</div>

