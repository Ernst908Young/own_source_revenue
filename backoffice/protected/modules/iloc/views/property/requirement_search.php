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

<br>
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
							//if(isset($iuid) && $iuid != '')
							//echo " Details of IUID - ".$iuid ;
						}?> 
						</b>
					</span> 
				</li>
			</ul>
		</div>
		<div class="col-md-4">
			<span class="pull-right" style="margin-top:5px;"><a href="https://caipotesturl.com/backoffice/frontuser/home/investorWalkthrough" class="btn btn-success"><i class="fa fa-arrow-left"></i>&nbsp; Back</a></span>
		</div>
	</div>
<?php } ?>
<br><br>
<div class="row">

    <div class="portlet-body">
        <?php // WITHOUT LOGIN [CHANGE 2]- EXTRA CODE
        if (empty($_SESSION['RESPONSE']['user_id'])) {
            ?>
            <div class="col-md-1" style="padding: 0px;">&nbsp;</div>
            <div class="col-md-10" style="padding: 0px;margin-left: -50px;">
                <?php } // WITHOUT LOGIN [CHANGE 2] - EXTRA CODE - ENDS HERE
                else {
                    ?>
                <div class="col-md-12">
                <?php } ?>
                <div class="portlet light bordered">
                    <div class="portlet-title round">
                        <div class="caption font-green-sharp" style="text-align:center;">
                            <i class="fa fa-search font-green-sharp"></i>
                            <span class="caption-subject bold uppercase"> Search posted Land Requirements </span>
                            <span class="caption-helper"></span>
                        </div>
                    </div>
                    <div class="portlet-body" style="min-height:80px;">
                        <div class="col-md-12">
                            <span class="font-yellow-casablanca icon-btn col-md-1">
                                <i class="fa fa-building-o"></i>
                                <div>
                                    Sale
                                </div>
                                <span class="badge badge-danger">
                                <?php echo $sale; ?></span>
                            </span>
                            <span href="javascript:;" class=" font-yellow-casablanca icon-btn col-md-1">
                                <i class="fa fa-map-pin"></i>
                                <div>
                                    Lease
                                </div>
                                <span class="badge badge-danger">
                                <?php echo $lease; ?></span>
                            </span>


                            <div class="form-group col-md-2  font-yellow-casablanca icon-btn" style="padding:2px;">
                                <div class="col-md-12">
                                    <select name="LandownerConnect[district_id]" class="form-control district" title="Select District" >
                                        <option value="">All District</option>
                                        <?php $allList = LandownerConnectEXT::getMasterList('bo_district', 'district_id', 'distric_name'); ?>
                                        <?php foreach ($allList as $k => $v) { ?>
                                            <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
                                        <?php } ?>
                                    </select>

                                </div>
                            </div>


                            <div class="form-group col-md-2  font-yellow-casablanca icon-btn" style="padding:2px;">
                                <div class="col-md-12">
                                    <select name="LandownerConnect[sub_district_id]" class="form-control tehsil" title="All Tehsil">
                                        <option value="">All Tehsil</option>
                                        <?php $allList = LandownerConnectEXT::getMasterList('lg_code_sub_disctrct', 'sub_district_code', 'sub_district_name'); ?>
                                                <?php foreach ($allList as $k => $v) { ?>
                                            <option value="<?php echo $k; ?>"><?php echo $v; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-2  font-yellow-casablanca icon-btn" style="padding:2px;">
                                <div class="col-md-12">
                                    <select name="LandownerConnect[village]" class="form-control vilages" title="Select Village"  >
                                        <option value="">All Village</option>

                                    </select>


                                </div>
                            </div>
                            <div class="form-group col-md-2  font-yellow-casablanca icon-btn" style="padding:2px;">
                                <div class="col-md-12">
                                    <input type="button" value='Search' id="filterSearch" class="btn btn-search">


                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            <?php // WITHOUT LOGIN [CHANGE 3]- EXTRA CODE
            if (empty($_SESSION['RESPONSE']['user_id'])) {
                ?>
                </div><div class="col-md-1">&nbsp;</div>
<?php } else { ?>
            </div>
<?php } // WITHOUT LOGIN [CHANGE 3]- EXTRA CODE- ENDS HERE  ?>
    </div>
</div>




</div>
</div>
    <?php
    if(empty($propertylisting)){ ?>
<h3 class="row red text-center" style="background:#fff;padding: 5px">Sorry, Land is not available in selected region. </h1>
  <?php   } ?>
   <?php if (isset($propertylisting) && !empty($propertylisting)) {
        foreach ($propertylisting as $key => $landProperty) {
            ?>
        <div class="row" style="margin-top: 15px;">
                <?php // WITHOUT LOGIN [CHANGE 4]- EXTRA CODE
                if (empty($_SESSION['RESPONSE']['user_id'])) {
                    ?>
                <div class="col-md-1" style="padding: 0px;">&nbsp;</div>
                <div class="col-md-10" style="padding: 0px;margin-left: -50px;">
        <?php } // WITHOUT LOGIN [CHANGE 4] - EXTRA CODE - ENDS HERE
        else {
            ?>
                    <div class="col-md-12">
        <?php } ?>


                    <!-- BEGIN Portlet PORTLET-->
                    <div class="portlet light">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-building-o font-yellow-casablanca"></i>
                                <span class="caption-subject bold font-yellow-casablanca uppercase">
                                        <?php echo $landProperty['land_title']; ?>  </span>
                                <span class="caption-helper"><span class="caption-helper">&nbsp;&nbsp;&nbsp;Requirement ID: ILOC000<?php echo $landProperty['id']; ?></span></span>
                            </div>

                        </div>
                        <div class="portlet-body row">
                            <div class="col-md-12">


                                <div class="col-md-9">

                                    <br>
                                    <div class="row">

                                      <?php
                                      if(isset($landProperty['village']) && !empty($landProperty['village'])){

                                          $village = LandownerConnectEXT::getMasterName('lg_code_villages',$landProperty['village'],'village_name','village_code');

                                        }else {
                                          $village ='';
                                        }
                                       ?>
                                        <div class="col-md-3 fn13"> <i class="fa fa-map-marker" aria-hidden="true"></i> <span class="cption_content"> Type</span> <?php echo $landProperty['type_of_land']; //type of land   ?></div>
                                        <div class="col-md-3 fn13"> <i class="fa fa-map-pin" aria-hidden="true"></i> <span class="cption_content"> District</span> <?php echo $landProperty['distric_name']; //address   ?> </div>
                                        <div class="col-md-6 fn13"> <i class="fa fa-location-arrow" aria-hidden="true"></i> <span class="cption_content"> Address </span> <?php echo $village?$village:'N/A'; //address   ?></div>
                                    </div>
                                    <br>

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
                    <!-- END Portlet PORTLET-->

        <?php // WITHOUT LOGIN [CHANGE 5]- EXTRA CODE
        if (empty($_SESSION['RESPONSE']['user_id'])) {
            ?>
                    </div><div class="col-md-1">&nbsp;</div>
        <?php } else { ?>
                </div>
        <?php } // WITHOUT LOGIN [CHANGE 5]- EXTRA CODE - ENDS HERE  ?>
        </div>
    <?php }
}
?>



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
                                    //                                  $.ajax({
                                    //                                            type: "POST",
                                    //                                            url: "<?php echo Yii::app()->request->baseUrl; ?>/iloc/property/listing/district/"+district +"/tehsil/"+tehsil+"/village/"+vilages,
                                    //                                            success: function (result) {
                                    //                                             //
                                    //                                            }
                                    //                                        });
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
