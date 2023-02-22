<!-- Custom Css Page Level
    Rahul Kumar
    14012018 -->
<style>
    .cption_content{padding: 0; margin: 0;line-height: 13px;color: #9eacb4; font-size: 13px;font-weight: 400;}
    .fn13{ font-size: 13.4px;  }
    .fn13 .fa{color: #f2784b; }
    .red{color:red;}
       <?php // WITHOUT LOGIN [CHANGE 1]- EXTRA CODE
    if (empty($_SESSION['RESPONSE']['user_id'])) {  ?>
        .page-sidebar.navbar-collapse.collapse {display: none !important;}   
        .page-content{margin-left:0px !important;}
        .col-md-1{width:12.50% !important;}
        .uppercase { font-size: 16px !important;
        }
      <?php } // WITHOUT LOGIN [CHANGE 1]- EXTRA CODE - ENDS HERE  ?>
</style>


 <?php if (! empty($_SESSION['RESPONSE']['user_id'])) {  ?>
 <br><div class="dashboard-welcome">
	<h2 class="full-width">
		<div class="dashboard-inner-hd-left">
		<p class="dashbrd-inner-hd">
			<?php if(!empty(@$_SESSION['RESPONSE']['user_id']) || (isset($_GET['panel']) && $_GET['panel'] = 'investor')) 
					echo "Welcome to Investor Panel - Uttarakhand";
				else{
					if(isset($iuid) && $iuid != '')
					echo " Details of IUID - ".$iuid ;
				}?> 
		</p>
		</div>
		<div class="dashboard-inner-hd-right"><a href="/backoffice/frontuser/home/investorWalkthrough" class="blue-btn-new"><i class="fa fa-angle-left"></i>Back</a></div>
		<div class="clearfix"></div>
	</h2>
	<div class="welcome-date hidden-xs"><i class="icon-calendar"></i>&nbsp;<?php echo date('d-M-Y'); ?></div>
<div class="clearfix"></div>
</div>
 <?php } ?>
 <?php
    // WITHOUT LOGIN [CHANGE 2]- EXTRA CODE
    if (empty($_SESSION['RESPONSE']['user_id']) && empty($_SESSION['uid'])) {
        ?>
		<link href="https://caipotesturl.com/themes/investuk/assets/global/css/components.min.css" rel="stylesheet">
		<link href="https://caipotesturl.com/themes/investuk/css/dashboard_style.css" rel="stylesheet">
		<div class="inner-header">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<h2 class="pageTitle"></h2>
						<ul class="inner-header-breadcrum">
							<li><a href="#">You are now on</a></li>
							<li class="pageTitle">serach available land</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="row" style="margin-top:48px;">
        <div class="col-md-1" style="padding: 0px;">&nbsp;</div>
        <div class="col-md-10" style="padding: 0px;margin-left: -50px;">
    <?php } // WITHOUT LOGIN [CHANGE 2] - EXTRA CODE - ENDS HERE?>
<div class="are-u-form-top m-b-25">
<label>Are You Looking For</label>
   <select class="form-control" name="LandownerConnect[la_type]" id="LandownerConnect_la_type" >
	 <?php 
	 $type="";
	 if(isset($_GET['AddedBy']) && !empty($_GET['AddedBy'])) { $type="Gov";} ?>
	 <?php if(isset($_GET['landtype']) && !empty($_GET['landtype'])) { $type="Pvt";} ?>
		<option value="Pvt"<?php if($type=="Pvt"){ echo " selected";} ?>>Private Land</option>
		<option value="Gov" <?php if($type=="Gov"){ echo " selected";} ?>>Govt. Land</option>            
		<option value="SIIDCUL">SIIDCUL Land</option>  
		<option value="PrivateIndustrialEstates">Private Industrial Estates</option>  
		<option value="SpecialIndustrialEstates">Special Industrial Estates for Mega Projects</option>  
		<option value="MiniIndustrialEstates">Mini Industrial Estates</option>  		
		<option value="GIS">Industrial Estate - GIS Search</option>  	
	</select>
	<label>(Please select from dropdown)</label>
</div> 
<div class="white-bg-block content-blocks">
	<div class="search-land-pvt-top1">
		<h2><i class="icon-magnifier icons"></i> Search Available Land</h2>
		<span class="caption-helper">Total Properties : <?php echo count($propertylisting);?></span>
		<ul class="search-land-pvt-top1-icons">
			<li>
				<span><?php echo $sale; ?></span>
				<i class="fa fa-building-o"></i>
				<h3>Sale</h3>
			</li>
			<li>
				<span><?php echo $lease; ?></span>
				<i class="fa fa-key"></i>
				<h3>Lease</h3>
			</li>
		</ul>
		<ul class="search-land-pvt-top1-icons search-land-pvt-top-form">
			<li>
				<select name="LandownerConnect[district_id]" class="form-control district" title="Select District" >
					<option value="">All District</option>
					<?php $allList = LandownerConnectEXT::getMasterList('bo_district', 'district_id', 'distric_name'); ?>
					<?php foreach ($allList as $k => $v) { ?>
						<option value="<?php echo $k; ?>"><?php echo $v; ?></option>
					<?php } ?>
				</select>
			</li>
			<li>
				<select name="LandownerConnect[sub_district_id]" class="form-control tehsil" title="All Tehsil">
					<option value="">All Tehsil</option>
					<?php $allList = LandownerConnectEXT::getMasterList('lg_code_sub_disctrct', 'sub_district_code', 'sub_district_name'); ?>
							<?php foreach ($allList as $k => $v) { ?>
						<option value="<?php echo $k; ?>"><?php echo $v; ?></option>
					<?php } ?>
				</select>
			</li>
			<li>
				<select name="LandownerConnect[village]" class="form-control vilages" title="Select Village"  >
					<option value="">All Village</option>
				</select>
			<li>
				<input type="button" value='Search' id="filterSearch" class="btn btn-search"/>
			</li>
		</ul>
	</div>	
	<div class="clearfix"></div>
</div>
<?php
    if(empty($propertylisting)){ ?>
<h3 class="row red text-center" style="background:#fff;padding: 5px">Sorry, Land is not available in selected region. </h3>
  <?php   } ?>
   <?php if (!empty($propertylisting)) { ?>
	   <div class="white-bg-block content-blocks">
			<div class="search-land-pvt-top1">
				<h2><i class="icon-list"></i> All Available Lands</h2>
        <?php foreach ($propertylisting as $key => $landProperty) {?>		
				<div class="search-land-listing">
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-building-o font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase"><?php echo $landProperty['land_title']; ?></span>
								<span class="caption-helper"><span class="caption-helper">&nbsp;&nbsp;&nbsp;AD ID: ILOC000<?php echo $landProperty['id']; ?></span></span>
							</div>
							<div class="inputs">
								<div class="portlet-input input-inline input-medium text-right">
									<span class="btn default red-stripe"><i class="fa fa-eye"></i>
									<?php
										$TotalViewed = LandownerConnectEXT::landRelatedCounts(base64_encode($landProperty['id']), "viewed");
										echo " " . $TotalViewed . " Viewed";
									?>
									</span>
								</div>
							</div>
						</div>
						<div class="portlet-body row">
							<div class="col-md-12">
								<div class="tile image double selected col-md-3">
                                    <div class="tile-body" id="map<?php echo $key; ?>" style="width:200px;height:200px;"></div>
									<?php if (empty($landProperty['latlong'])) {
										$landProperty['latlong'] = LandownerConnectEXT::getDistrictLatLong($landProperty['district_id']);
									} ?>
                                    <script src="http://maps.googleapis.com/maps/api/js"></script> 
                                    <script type="text/javascript">
                                        var map<?php echo $key; ?>;
                                        //  var latlong="30.3165, 78.0322";
                                        function initialize<?php echo $key; ?>() {
                                            var myLatlng<?php echo $key; ?> = new google.maps.LatLng(30.3165, 78.0322);
											<?php if (!empty($landProperty['latlong'])) { ?>
                                                var myLatlng<?php echo $key; ?> = new google.maps.LatLng<?php echo $landProperty['latlong']; ?>;
											<?php } ?>
                                            var myOptions<?php echo $key; ?> = {zoom: 12, center: myLatlng<?php echo $key; ?>};
                                            map<?php echo $key; ?> = new google.maps.Map(document.getElementById('map<?php echo $key; ?>'), myOptions<?php echo $key; ?>);
                                            // marker STARTS    
                                            var marker<?php echo $key; ?> = new google.maps.Marker({
                                                position: myLatlng<?php echo $key; ?>,
                                                //title: "Click to view info!"
                                            });
                                            marker<?php echo $key; ?>.setMap(map<?php echo $key; ?>);
                                            // marker ENDS
                                            // Added : Rahul Kumar
                                            // info-window STARTS   
											<?php if (!empty($landProperty['latlong'])) { ?>
                                                var infowindow<?php echo $key; ?> = new google.maps.InfoWindow({content: "<div class='map_bg_logo'><span style='color:#1270a2;'><b><?php echo $landProperty['land_title']; ?></b> </span><div style='border-top:1px dotted #ccc; height:1px;  margin:5px 0;'></div><span style='color:#555;font-size:11px;'><b>Area: </b><?php echo $landProperty['area_sqmt'] . " SQMT"; ?></span></div>"});
                                                google.maps.event.addListener(marker<?php echo $key; ?>, 'click', function () {
                                                    infowindow<?php echo $key; ?>.open(map<?php echo $key; ?>, marker<?php echo $key; ?>);
                                                });
											<?php } ?>
                                        }
                                        google.maps.event.addDomListener(window, 'load', initialize<?php echo $key; ?>);
                                    </script>` 

                                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3VOcg0P61BSjOsA95rVHFFV_VbMLeS4w&callback=initialize<?php echo $key; ?>"></script>
                                    <div class="tile-object"></div>
                                </div>
								<div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-3 fn13"> 
											<i class="fa fa-area-chart" aria-hidden="true"></i> 
											<span class="cption_content">Area</span> 
											<?php echo $landProperty['area_sqmt'] . " ".$landProperty['area_type']; //area in sqmt   ?>
										</div>
                                        <div class="col-md-3 fn13" title="<?php echo $landProperty['name_railway']; ?>"> 
											<i class="fa fa-train"></i>
											<span class="cption_content"> From Railway</span> 
											<?php echo $landProperty['distance_railway'] . " Km"; //area in sqmt   ?>
										</div>
                                        <div class="col-md-3 fn13" title="<?php echo $landProperty['name_airport']; ?>">
											<i class="fa fa-plane" aria-hidden="true"></i>
											<span class="cption_content"> From Airport </span> 
											<?php echo $landProperty['distance_airport'] . " Km"; //distance from railway in km   ?></b>
										</div>
                                        <div class="col-md-3 fn13" title="<?php echo $landProperty['name_highway']; ?>"> 
											<i class="fa fa-road" aria-hidden="true"></i>
											<span class="cption_content"> From Highway </span> 
											<?php echo $landProperty['distance_highway'] . " Km"; //distance from railway in km   ?></b>
										</div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3 fn13"> 
											<i class="fa fa-map-marker" aria-hidden="true"></i> 
											<span class="cption_content"> Type</span> 
											<?php echo $landProperty['type_of_land']; //type of land   ?>
										</div>
                                        <div class="col-md-3 fn13"> 
											<i class="fa fa-map-pin" aria-hidden="true"></i> 
											<span class="cption_content"> District</span> 
											<?php echo $landProperty['distric_name']; //address   ?> 
										</div>                                                     
                                        <div class="col-md-6 fn13"> 
											<i class="fa fa-location-arrow" aria-hidden="true"></i> 
											<span class="cption_content"> Address </span> 
                                             <?php if(isset($landProperty['village']) && !empty($landProperty['village'])){
													//  $village = ", ". LandownerConnectEXT::getMasterName('lg_code_villages',$landProperty['village'],'village_name','village_code');
													$village ='';
													}else {
													  $village ='';
													}
											?>
                                            <?php  echo $landProperty['address']; 
                                            //echo $village; echo ", ". LandownerConnectEXT::getMasterName('lg_code_sub_disctrct',$landProperty['sub_district_id'],'sub_district_name','sub_district_code');//address    ?>
										</div>
                                    </div>
                                    <br>
                                    <p>
										<span class="badge"> 
											<?php  if($landProperty['la_type']=="Pvt"){echo "Private Land"; }else{echo "Govt. Land";} ?>
										</span>
										<?php 
											if($landProperty['la_type']=="Gov" && $landProperty['department_id']!=""){ 
												echo "&nbsp;<span class='badge danger'>".LandownerConnectEXT::getMasterName('bo_departments',$landProperty['department_id'],'department_name','dept_id')."</span>"; 
											}
										?>
									</p>
                                    <p class="fn13">
										<?php echo PropertyController::truncate_string($landProperty['comment'], 220); ?>
                                    </p>
                                    <p class="">
										<a href="<?php echo Yii::app()->createUrl('/iloc/property/detail', array('landID' => base64_encode($landProperty['id']))); ?>" class="blue-btn-new m-r-10"> View Owner's Contact Detail </a>
                                        <a href="<?php echo Yii::app()->createUrl('/iloc/property/detail', array('landID' => base64_encode($landProperty['id']))); ?>" class="blue-btn-new"> View Land Detail </a>
									</p>
                                </div>
							</div>
						</div>
					</div>
				</div>			       
    <?php } ?>
	</div>
	</div> 
<?php }
?>
 <?php
    // WITHOUT LOGIN [CHANGE 2]- EXTRA CODE
    if (empty($_SESSION['RESPONSE']['user_id']) && empty($_SESSION['uid'])) {
        ?>
</div></div>
<?php }?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3VOcg0P61BSjOsA95rVHFFV_VbMLeS4w&callback=myMap"></script>
<script>
	$(document).ready(function () {
		$(".tehsil").on('change', function () {
			var tehsilValue = $(this).val();
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->request->baseUrl; ?>/iloc/property/getVilagesOfTehsil/subDistCode/" + tehsilValue+"/type/all",
				success: function (result) {
					$(".vilages").html(result);
				}
			});
		});

		$(".district").on('change', function () {
			// alert("hi");
			var districtValue = $(this).val();
			$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->request->baseUrl; ?>/iloc/property/getTehsil/districtID/" + districtValue+"/type/all",
				success: function (result) {
					$(".tehsil").html(result);
				}
			});
		});
							
		$("#filterSearch").click(function(){
			  var district=$(".district").val();
			  var tehsil=$(".tehsil").val();
			  var vilages=$(".vilages").val();
			  // It will redirect with district
			  window.location.assign("<?php echo Yii::app()->request->baseUrl; ?>/iloc/property/listing/district/"+district +"/tehsil/"+tehsil+"/village/"+vilages);
		 });
	});
						
	$(window).load(function(){
		<?php if (!empty($_GET['district'])) { ?> 
		$(".district").val("<?php echo $_GET['district']; ?>");  
			// Getting all Tehseel of selected district - Rahul Kumar - 01022018
		  $.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->request->baseUrl; ?>/iloc/property/getTehsil/districtID/" + <?php echo $_GET['district']; ?>,
				success: function (result) {
					$(".tehsil").html(result);
					// Setting searched Tehsil as sellected in drop down- Rahul Kumar - 01022018
					 <?php if (!empty($_GET['tehsil'])) { ?>   $(".tehsil").val("<?php echo $_GET['tehsil']; ?>");
					  // Getting all Villages of selected Tehsil 
					  $.ajax({
						  type: "POST",
						  url: "<?php echo Yii::app()->request->baseUrl; ?>/iloc/property/getVilagesOfTehsil/subDistCode/<?php echo $_GET['tehsil']; ?>",
						  success: function (result) {
							  $(".vilages").html(result);
							  // Setting searched Village as sellected in drop down- Rahul Kumar - 01022018
							   <?php if (!empty($_GET['village'])) { ?>  $(".vilages").val("<?php echo $_GET['village']; ?>"); <?php } ?>
						  }
					  });                                         
					  <?php } ?>
				}
			});                                  
		<?php 
		} 
		?>
		$("#LandownerConnect_la_type").change(function(){                                    
			if($(this).val()=="Gov"){
				window.location = '/backoffice/iloc/property/advanceSearch';
			}
			if($(this).val()=="Pvt"){
				window.location = '/backoffice/iloc/property/listing/landtype/Pvt';
			}
			if($(this).val()=="SIIDCUL"){
				$(this).val('<?php echo $type; ?>');
				window.open('https://www.siidculsmartcity.com/ViewVacantPlot.aspx','_blank');
			}
			if($(this).val()=="PrivateIndustrialEstates"){
				$(this).val('<?php echo $type; ?>');
				window.open('https://caipotesturl.com/site/PrivateIndustrialEstates','_blank');
			}
			if($(this).val()=="SpecialIndustrialEstates"){
				$(this).val('<?php echo $type; ?>');
				window.open('https://caipotesturl.com/site/specialIndustrialEstates','_blank');
			}
			if($(this).val()=="MiniIndustrialEstates"){
				$(this).val('<?php echo $type; ?>');
				window.open('https://caipotesturl.com/site/miniIndustrialEstates','_blank');
			}
			if($(this).val()=="GIS"){
				$(this).val('<?php echo $type; ?>');
				window.open('https://www.siidculsmartcity.com/GIS/','_blank');
			}
		});
	});
</script>



