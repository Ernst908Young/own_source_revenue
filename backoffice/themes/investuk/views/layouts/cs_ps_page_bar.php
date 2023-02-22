<?php 
$FY = "ALL";
extract($_GET);
$controller = Yii::app()->controller->id;	
$action = Yii::app()->controller->action->id;	
$showFixedBar = 0;
/* $rer = "1900-03-03";

if (isset($FY) && !empty($FY)) {
    $financial_year = $FY; 
    if ($financial_year == "ALL") {
        $startdate = date('Y-m-d', strtotime($rer));
        $enddate = date('Y-m-d');
    } else if ($financial_year != "ALL") {
        $data = explode("-", $financial_year);
        $startdate = $data[0] . "-04-01";
        $enddate = $data[1] . "-03-31";
    }
} else {
    $fDate = date('Y-m-d');
    //$fDate = '2015-04-01';
    $keyy = explode("-", $fDate);
    $todayDate = date('Y-m-d', strtotime($fDate));
    $sdate = $keyy[0] . "-04-01";
    $DateBegin = date('Y-m-d', strtotime($sdate));
    $yy = $keyy[0];
    $yy1 = $keyy[0] + 1;
    $yy2 = $keyy[0] - 1;

    if (($todayDate >= $DateBegin)) {
        $financial_year = $yy . "-" . $yy1;
    } else if (($todayDate < $DateBegin)) {
        $financial_year = $yy2 . "-" . $yy;
    }
    $data = explode("-", $financial_year);
    $startdate = $data[0] . "-04-01";
    $enddate = date('Y-m-d');
} 

$enddate = date('Y-m-d', strtotime($enddate . '+1 day'));*/
?>

<div class="fixed-condition-elements">
	<div class="container-fluid">
		
	</div>
</div>
<?php if($controller=='newReport' && $action=='OverallNewReport'){
	if(DefaultUtility::is_PRINCIPAL_SECRETARY() || DefaultUtility::is_CHEIF_SECRETARY()){
?>
<div class="fixed-condition-element1 dashboard-welcome">
    <h2>Welcome to State Monitoring Panel - Uttarakhand</h2>
    <div class="welcome-date hidden-xs"><i class="icon-calendar"></i>&nbsp;<?php echo date('d-M-Y'); ?></div>
    <div class="clearfix"></div>
</div>
<?php }
if(RolesExt::isMISManager()){ ?>

<div class="fixed-condition-element1 dashboard-welcome">
    <h2>Welcome to MIS Manager Panel - Uttarakhand</h2>
    <div class="welcome-date hidden-xs"><i class="icon-calendar"></i>&nbsp;<?php echo date('d-M-Y'); ?></div>
    <div class="clearfix"></div>
</div>

<?php } 
}else { ?>
<div class="fixed-condition-element1 page-bar">
	<ul class="page-breadcrumb">
		<li>
			  <b><span class="pull-left"><a href="<?php echo Yii::app()->createAbsoluteUrl("/backoffice/mis/newReport/OverallNewReport");?>" title="Go to Dashboard " class="fa fa-home homeredirect"></a></span> 
			 <?php 				
				if(DefaultUtility::isHODNodal())
				{ 
					echo "Welcome to Department Monitoring Panel";
				} 
				else if(DefaultUtility::isSECRETARY())
				{ 
					echo "Welcome to Secretariat Monitoring Panel";
				} 
				else if(DefaultUtility::is_PRINCIPAL_SECRETARY()){
					$showFixedBar="1";
					echo "<b>Welcome to State Monitoring Panel : Uttarakhand</b> ";
				}
				else if(DefaultUtility::is_CHEIF_SECRETARY()){
					$showFixedBar="1";
					echo "<b>Welcome to State Monitoring Panel - Uttarakhand</b> ";
				}
				else if(RolesExt::isMISManager()){
					$showFixedBar="1";
					echo "<b>Welcome to MIS Manager Panel - Uttarakhand</b> ";
				}
				else if(RolesExt::isMISAdmin()){
					$showFixedBar="1";
					echo "<b>Welcome to MIS Admin Panel - Uttarakhand</b> ";
				}
				else if(RolesExt::isDMUser()){
					$showFixedBar="1";
					echo "<b>Welcome to DM Panel - Uttarakhand</b> ";
				}
				else{}
				?>			
			 </b>
		</li>
	</ul>
	<div class="page-toolbar" style="padding:0px;">
		<div id="" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom">
			<!--<a href="<?php //echo Yii::app()->createAbsoluteUrl("/backoffice/mis/newReport/OverallNewReport");?>" class="btn btn-success"><i class="fa fa-arrow-left"></i>&nbsp; Back</a>-->
			<?php echo CHtml::link('<i class="fa fa-arrow-left"></i>&nbsp; Back',empty(Yii::app()->request->urlReferrer)? Yii::app()->createAbsoluteUrl("/backoffice/mis/newReport/OverallNewReport") : Yii::app()->request->urlReferrer, array('class'=>'btn btn-success'));?>
			<!--<span class="thin uppercase hidden-xs" id="clock"><i class="icon-calendar"></i>&nbsp;13-Sep 2018&nbsp;</span>
			<span class="thin uppercase hidden-xs"></span>&nbsp;-->
		</div>
	</div>
</div>
<?php }?>
<div class="fixed-condition-element2 portlet-body">
	<div class="clearfix">
		<div class="page-bar">
		<?php echo CHtml::beginForm('','POST',array('enctype'=>'multipart/form-data','id'=>"filterform",'name'=>"form"))?>
			<table>
				<tbody>
				<tr>
				   <!--<tr id="date" style="display:<?php //echo $display1;?>">
							<td><b>Select Date Range &nbsp;</b></td>
							<td>
								<div class="input-daterange input-group demo-3" id="datepicker">
									<input type="text" class="input-lg form-control" name="start" autocomplete="off" value="<?php //echo @$start;?>"/>
									<span class="input-group-addon input-lg">to</span>
									<input type="text" class="input-lg form-control" name="end" autocomplete="off" value="<?php //echo @$end;?>"/>
								</div>
							</td>
						</tr>-->	
					<td><b>Currently you are viewing data for FY "<?php echo $FY;?>", If you want to change then select Financial Year : &nbsp;</b></td>
					<td>						
						<?php 
						$pp = '2015';
						$yyy = '2019';
						$dateArray = array();
						$dateArray['ALL'] = 'ALL';
						for($i = $pp; $i < $yyy; $i++) 
						{
							$j = $i + 1;
							$k = $i . '-' . $j;
							$z = 'd1/' . $i . '-04-01/d2/' . $j . '-03-31';
							$dateArray[$k] = $k;
						}	
						//print_r($_SERVER);
						/* $currentURL = $_SERVER['REDIRECT_URL'];
						$currentURL = explode("/fy/",$_SERVER['REDIRECT_URL']);
						$cURl = $currentURL[0]; */
						if($action=='index')
						{
							$currentURL = Yii::app()->request->getRequestUri().'/'.$action;
						}else{
							$currentURL = Yii::app()->request->getRequestUri();
						}
						if(preg_match("/FY/i",$currentURL)) {
							$currentURL = explode("/FY/",$_SERVER['REQUEST_URI']);
							$cURl = $currentURL[0];
						}
						else if(preg_match("/FY=/i",$currentURL)) {
							$currentURL = explode("FY=",$_SERVER['REQUEST_URI']);
							$cURl = $currentURL[0];
						}
						else if(preg_match("/fy=/i",$currentURL)) {
							$currentURL = explode("fy=",$_SERVER['REQUEST_URI']);
							$cURl = $currentURL[0];
						}
						else if(preg_match("/fy/i",$currentURL)) {
							$currentURL = explode("/fy/",$_SERVER['REQUEST_URI']);
							$cURl = $currentURL[0];
						}
						else{
							$cURl = $currentURL;
						}
						
					
						echo CHtml::dropDownList('FY', $FY,$dateArray, array('id'=>'financial_year','class'=>"form-control fyu")); 
						?>
					</td>
					<?php 
					if(isset($_GET['swcs_status']) && !empty(isset($_GET['swcs_status']))){
					   $swcs_status = $_GET['swcs_status'];
				    }else{
					   $swcs_status= "both"; 
					} 
					
					if($controller=='serviceMapping')
					{
					?>    
					<td><b>Application Type</b></td>
					<td> 
						<?php 
						$swcsArray = array('both'=>'Both','Y'=>'Applied through Single Window','N'=>'Applied through Departmental Native Portal');
						echo CHtml::dropDownList('swcs_status', $swcs_status,$swcsArray, array('id'=>'swcs','class'=>"form-control fyu")); 
						?>
					</td>
					<?php 
					}
					?>
				</tr>
				</tbody>
			</table>
		<?php echo CHtml::endForm()?>
		</div>
	</div>
</div>
<script>
<?php if($showFixedBar=="1"){ ?>
	$(document).ready(function(){
		$(".fixed-condition-elements .container-fluid").append( $(".fixed-condition-element1") );
		$(".fixed-condition-elements .container-fluid").append( $(".fixed-condition-element2") );
	});
<?php } ?>	
	$('.fyu').on('change',function(){
		var swcs = $("#swcs").val();
		if(swcs!='' && typeof swcs != 'undefined')
			var act = "<?php echo $cURl; ?>/FY/" + $("#financial_year").val() + "/swcs_status/" + $("#swcs").val();
		else
			var act = "<?php echo $cURl; ?>/FY/" + $("#financial_year").val();
		
		
		$("#filterform").attr('action', act);
		$("#filterform").submit();
	});
</script>
