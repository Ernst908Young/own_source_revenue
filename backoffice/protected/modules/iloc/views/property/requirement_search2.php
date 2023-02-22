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
<?php if (!empty($_SESSION['RESPONSE']['user_id'])) {  ?>
	<div class="page-bar">
		<div class="col-md-8">
			<ul class="page-breadcrumb">
				<li>
					<span class="pull-left">
						<a href="/backoffice/frontuser/home/serviceNew" title="Go to Departmental Services : New" class="fa fa-home homeredirect" ></a><b> <?php if(!empty(@$_SESSION['RESPONSE']['user_id']) || (isset($_GET['panel']) && $_GET['panel'] = 'investor')) 
							echo "Search Posted Land Requirement";
						else{
							echo "Search Posted Land Requirement";							
						}?> 
						</b>
					</span> 
				</li>
			</ul>
		</div>
		<div class="col-md-4">
			<span class="pull-right" style="margin-top:5px;"><a href="https://caipotesturl.com/backoffice/frontuser/home/investorWalkthrough" class="btn btn-success"><i class="fa fa-arrow-left"></i>&nbsp; Back</a></span>
		</div>
	</div><br><br>
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
							<li class="pageTitle">serach posted land</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="row" style="margin-top:48px;">
        <div class="col-md-1" style="padding: 0px;">&nbsp;</div>
        <div class="col-md-10" style="padding: 0px;margin-left: -50px;">
    <?php } // WITHOUT LOGIN [CHANGE 2] - EXTRA CODE - ENDS HERE?>
<div class="white-bg-block content-blocks">
	<div class="search-land-pvt-top1">
		<h2><i class="icon-magnifier icons"></i> Search posted Land Requirements</h2>
		<!--<span class="caption-helper">Total Properties : <?php //echo count($propertylisting);?></span>-->
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
				<select name="LandownerConnect[village]" class="form-control vilages" title="Select Village">
					<option value="">All Village</option>
				</select>
			</li>	
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
			<?php 
			foreach($propertylisting as $key => $landProperty) 
			{ 
			?>		
				<div class="search-land-listing">
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-building-o font-yellow-casablanca"></i>
								<span class="caption-subject bold font-yellow-casablanca uppercase"><?php echo $landProperty['land_title']; ?></span>
								<span class="caption-helper"><span class="caption-helper">&nbsp;&nbsp;&nbsp;Requirement ID: ILOC000<?php echo $landProperty['id']; ?></span></span>
							</div>
							<div class="inputs">
								<div class="portlet-input input-inline input-medium text-right">
									
									<?php
										//<span class="btn default red-stripe"><i class="fa fa-eye"></i>$TotalViewed = LandownerConnectEXT::landRelatedCounts(base64_encode($landProperty['id']), "viewed");
										//echo " " . $TotalViewed . " Viewed";
									?>
									</span>
								</div>
							</div>
						</div>
						<div class="portlet-body row">
							<div class="col-md-12">
								<div class="tile image double selected col-md-3">
                                    <!--<div class="tile-body" id="map<?php //echo $key; ?>" style="width:200px;height:200px;"></div>-->
									<?php if (empty($landProperty['latlong'])) {
										$landProperty['latlong'] = LandownerConnectEXT::getDistrictLatLong($landProperty['district_id']);
									} ?>
                                    <!--<script src="http://maps.googleapis.com/maps/api/js"></script> 
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
                                       // google.maps.event.addDomListener(window, 'load', initialize<?php echo $key; ?>);
                                    </script>` 

                                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3VOcg0P61BSjOsA95rVHFFV_VbMLeS4w&callback=initialize<?php echo $key; ?>"></script>
                                    <div class="tile-object"></div>-->
                                </div>
								<div class="col-md-9">                                   
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
                                           
											 <?php
											  if(isset($landProperty['village']) && !empty($landProperty['village'])){

												  $village = LandownerConnectEXT::getMasterName('lg_code_villages',$landProperty['village'],'village_name','village_code');

												}else {
												  $village ='';
												}
											   ?>
                                            <?php echo $village?$village:'N/A'; //address   ?>
										</div>
                                    </div> 
									</br>
									<p class="fn13">
										<?php echo PropertyController::truncate_string($landProperty['comment'], 220); ?>
                                    </p>	
                                    <p class="text-right">
                                      <?php if (empty($_SESSION['RESPONSE']['user_id']) && empty($_SESSION['land_user_id'])) { ?>
                                      <button type="button" relatedMessage="Please Verify your mobile number to view contact details of the owner" data-id="<?php echo $landProperty['id']; ?>" class="btn btn-success pull-10 guestloginpopup"  data-toggle="modal" data-target="#guestLogin"> <i class="fa fa-info"></i> View Contact Detail</button>
                                      <?php } else { ?>
                                      <button type="button" class="btn btn-success pull-10 views_contact_details" data-toggle="modal" data-id="<?php echo $landProperty['id']; ?>" data-target="#myModal"> <i class="fa fa-info"></i> View Contact Detail</button>
                                      <?php } ?>
                                    </p>                                    
                                </div>
							</div>
						</div>
					</div>
				</div>			       
		<?php 
			} 
		?>
	</div>
	</div> 
<?php } ?>
 <?php
    // WITHOUT LOGIN [CHANGE 2]- EXTRA CODE
    if (empty($_SESSION['RESPONSE']['user_id']) && empty($_SESSION['uid'])) {
        ?>
</div></div>
<?php }?>
<div id="guestLogin" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="color:red"><i class="fa fa-desktop"></i> Verify Your Mobile Number</h4>
            </div>
            <form method="POST" id="mobilenumberform" >
                <div class="modal-body">
                    <div class="content">
                            <!-- BEGIN VERIFY MOBILE FORM // 27012018-->
                            <p id="verifyMessage">
                                Verify your mobile number to view land owner's Contact Info / Express Interest Or Report
                            </p>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="input-icon">
                                        <i class="fa fa-mobile"></i>
                                        <input name="lID" type="hidden" value="" >
                                        <input class="form-control placeholder-no-fix" autocomplete="off" placeholder="Enter Mobile Number" name="mobile_number" id="mobileNumber" type="number">
                                    </div>
                                </div>
                            </div>
                            <!-- END Verify Mobile Number FORM // 27012018 -->
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-actions">
                        <button type="button" id="back-btn" class="btn" data-dismiss="modal">
                            <i class="m-icon-swapleft"></i> Back </button>
                        <button type="button" class="btn green-haze pull-right verifymobilenumber" hideit="mobilenumberform" showit="otpform">
                            Send OTP <i class="m-icon-swapright m-icon-white"></i>
                        </button>
                    </div>
                </div>
            </form>
                        <!-- OTP FORM STARTS HERE -->
                        <form  id="otpform"  method="POST" style="display:none;">
                <div class="modal-body">
                    <div class="content">

                        <!-- BEGIN VERIFY MOBILE FORM // 27012018-->

                            <p>
                                Please enter otp sent on your mobile number
                            </p>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="input-icon">
                                        <i class="fa fa-mobile"></i>
                                        <input name="lID" type="hidden" value="" >
                                        <input class="form-control placeholder-no-fix" autocomplete="off" placeholder="Enter OTP" name="mobile_number" id="OTP" type="number">
                                    </div>
                                </div>
                            </div>
                            <!-- END Verify Mobile Number FORM // 27012018 -->
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="form-actions">
                        <button type="button" id="back-btn" class="btn verifymobilenumber" hideit="otpform" showit="mobilenumberform">
                            <i class="m-icon-swapleft"></i> Resend OTP </button>
                        <button type="button"  class="btn green-haze pull-right verifyOtp">
                            Verify OTP <i class="m-icon-swapright m-icon-white"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="portlet-title tabbable-line">
                    <div class="caption caption-md">
                        <i class="fa fa-user theme-font font-blue-madison bold uppercase"></i>
                        <span class="caption-subject font-blue-madison bold uppercase">Contact Detail</span>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="portlet light">

                    <div class="row">
                        <div class="col-md-12" style="margin:10px;">
                            <div class="col-md-6 fn13 requester_name"  > <i class="fa fa-user" aria-hidden="true"></i>   <span class="cption_content">Requester Name : <span id="requester_name"> </span></span> </div>
                            <div class="col-md-6 fn13 requester_contact_no" > <i class="fa fa-mobile-phone" aria-hidden="true"></i> <span class="cption_content">Requester Contact No. : <span id="requester_contact_no"> </span> </span>  </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="margin:10px;">
                            <div class="col-md-6 fn13 requester_email"> <i class="fa fa-user" aria-hidden="true"></i>   <span class="cption_content">Requester Email : <span id="requester_email"> </span></span> </div>
                            <div class="col-md-6 fn13 requester_alternate_no"> <i class="fa fa-mobile-phone" aria-hidden="true"></i> <span class="cption_content">Requester Alternate No. : <span id="requester_alternate_no"> </span></span>  </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="margin:10px;">
                            <div class="col-md-6 fn13 agent_name" style="display:none;"> <i class="fa fa-user" aria-hidden="true"></i>   <span class="cption_content">Agent Name : </span> <span id="agent_name"> </span></div>
                            <div class="col-md-6 fn13 agent_contact_no" style="display:none;"> <i class="fa fa-mobile-phone" aria-hidden="true"></i> <span class="cption_content">Agent Contact No. : </span><span id="agent_contact_no"> </span>  </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="margin:10px;">
                            <div class="col-md-6 fn13 agent_email" style="display:none;"> <i class="fa fa-user" aria-hidden="true"></i>   <span class="cption_content">Agent Email : </span><span id="agent_email"> </span> </div>
                            <div class="col-md-6 fn13 agent_alternate_no" style="display:none;"> <i class="fa fa-mobile-phone" aria-hidden="true"></i> <span class="cption_content">Agent Alternate No. : </span><span id="agent_alternate_no"> </span>  </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3VOcg0P61BSjOsA95rVHFFV_VbMLeS4w&callback=myMap"></script>
<script>
$(document).ready(function () {

		$(".views_contact_details").on('click', function () {
			var landID = $(this).data('id');
			$.ajax({
			  type: "POST",
			  data:{landID:landID},
			  dataType: "json",
			  url: "<?php echo Yii::app()->request->baseUrl; ?>/iloc/property/requester_contact",
			  success: function (result) {
					 console.log(result.data);
					 $('#requester_name').html(result.data.requester_name);
					 $('#requester_email').html(result.data.requester_email);
					 $('#requester_contact_no').html(result.data.requester_contact_no);
					 $('#requester_email').html(result.data.requester_email);
					 if(result.data.agent_name){
							$('#agent_name').html(result.data.agent_name);
							$('#agent_name').show();
					 }

					 if(result.data.agent_email){
							$('#agent_email').html(result.data.agent_email);
							$('#agent_email').show();
					 }

					 if(result.data.agent_contact_no){
							$('#agent_contact_no').html(result.data.agent_contact_no);
							$('#agent_contact_no').show();
					 }
					 if(result.data.agent_alternate_no){
							$('#agent_alternate_no').html(result.data.agent_alternate_no);
							$('#agent_alternate_no').show();
					 }

			  }
			});
		});


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
			window.location.assign("<?php echo Yii::app()->request->baseUrl; ?>/iloc/property/requirementListing/district/"+district +"/tehsil/"+tehsil+"/village/"+vilages);		
	    });
	});

	$(window).load(function(){
		<?php if (!empty($_GET['district'])) { ?> $(".district").val("<?php echo $_GET['district']; ?>");
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
		<?php } ?>
	});
</script>

<script>
    // Added by Rahul Kumar : 29012018
    $(document).ready(function(){

        $(".guestloginpopup").click(function(){
           $("#verifyMessage").html($(this).attr("relatedMessage"));
        });
    //  alert("h");
        $('.verifymobilenumber').click(function(){
           // alert("hi");
            var hideit=$(this).attr('hideit');
            var showit=$(this).attr('showit');
            $("#"+hideit).css('display','none');
            $("#"+showit).css('display','block');

            $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->request->baseUrl; ?>/iloc/property/sentOtp/mobileNumber/"+$("#mobileNumber").val() ,
            success: function (result) {
                if(result==true){
                 } else{

                    }
            }
        });

        });

        $('.verifyOtp').click(function(){
            $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->request->baseUrl; ?>/iloc/property/verifyOtp/otp/"+$("#OTP").val()+"/mobileNumber/"+$("#mobileNumber").val(),
            success: function (result) {
                if(result=="Otp Verified"){
                   location.reload();
                  }else{
                     alert(result);
                  }
            }
        });

        });
    });
</script>
