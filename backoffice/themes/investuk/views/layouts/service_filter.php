<div class="portlet-body">
	<div class="clearfix">	 
	   <div class="page-bar">
			<?php 
			$display = "none";
			$display1 = "block";
			if(isset($fy) && !empty($fy)){
				$display="block";
				$display1="none";
			}
			?>
		    <form method="get" name="service_post">
				<div class="row">
				<?php 
					$display = "none";
					$display1 = "block";
					if(isset($fy) && !empty($fy)){
						$display="block";
						$display1="none";
					}
					?>
					
					<div class="col-md-12" style="padding-top:12px;">												
						<div id="dept" style="display:<?php echo $display1;?>; margin-top:6px;" class="col-md-4">
							<label style="font-weight:bold;float:left;">Select Date Range</label>                  
							<div class="input-daterange input-group demo-3" id="datepicker" style="width: 71%;   padding-left: 10px; margin-top: -10px; position: relative; z-index: 9991;">
								<input type="text" class="input-lg form-control" name="start" id="startdate" autocomplete="off" value="<?php echo @$start;?>"/>
								<span class="input-group-addon input-lg">to</span>
								<input type="text" class="input-lg form-control" name="end" id="enddate" autocomplete="off" value="<?php echo @$end;?>"/>
							</div>
							<div class="clearfix"></div>
						</div>
							
						<div id="fy_year" style="display:<?php echo $display;?>; margin-top:7px;" class="col-md-4">
							<label style="float:left;font-weight:bold;">Select Financial Year</label>
							<?php
							$m = date('m');
							$yyy = date('Y');
							if ($m > 3) {
								$yyy = $yyy - 1;
							}
							$pp = '2015';
							?>
							<select name="fy" id="fyear" class="fy_select form-control" style="border-color:#aaa;height:40px;float: left; width: 64%;margin-left: 10px;margin-top: -10px;">
								<option value="" 
								<?php
								if ($fy == "ALL") {
									echo "selected='selected'";
								}
								?> >ALL
								</option>
								<?php
								for ($i = $pp; $i <= $yyy + 1; $i++) {
									$j = $i + 1;
									$k = $i . '-' . $j;
									$kv = $i . '-04-01:' . $j . '-03-31';
									?>
									<option value="<?php echo $kv; ?>" 
									<?php
									if ($fy == $kv) {
										echo "selected='selected'";
									}
									?>>
												<?php echo $k; ?>
									</option>
								<?php }
								?>           
							</select>
						</div>							
						<div class="col-md-4">							
							<input type="submit" value="Genrate Report"  name="submit" class="btn btn-success">
						</div>
						<div class="col-md-4" style="float:right;">
							<!--<label class="col-md-3 control-label">Select Date Range</label>-->
							<div class="mt-radio-inline" style="padding-top:3px !important;">
								<label class="mt-radio">
									<input type="radio" name="optionsRadios" id="optionsRadios25" value="date" class="date_range form-control" <?php if($display1=="block"){ echo "checked=checked";}else{ echo "";}?>> Date Range
									<span></span>
								</label>
								<label class="mt-radio">
									<input type="radio" name="optionsRadios" id="optionsRadios26" value="fy"  class="date_range form-control" <?php if($display=="block"){ echo "checked=checked";}else{ echo "";}?>> Financial Year
									<span></span>
								</label>							
							</div>
						</div>							
					</div>					
				</div>	
			</form>		
		</div>		
	</div>
</div>
<?php $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>
<script>
function getRcords(){
	var fy = $('#fyear').val();
	var startdate = $('#startdate').val();
	var enddate = $('#enddate').val();
	var option = $('input[name=optionsRadios]:checked').val();
	alert(option);
	alert(fy);
	alert(startdate);
	alert(enddate);
	if(option=='fy')
	window.location.href="<?php echo $actual_link;?>/option/"+option+"/"+fy+"/"+fy;
	if(option=='date')
	window.location.href="<?php echo $actual_link;?>/option/"+option+"/start/"+startdate+"/end/"+enddate;
}
</script>