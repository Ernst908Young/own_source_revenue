<!-- Custom Css Page Level
    Rahul Kumar
    14012018 -->

<style>
    .cption_content{padding: 0; margin: 0;line-height: 13px;color: #9eacb4; font-size: 13px;font-weight: 400;}
    .fn13{ font-size: 13.4px;  line-height: 18px !important; }
    .fn13 .fa{color: #f2784b; }

    <?php // WITHOUT LOGIN [CHANGE 1]- EXTRA CODE
    if (empty($_SESSION['RESPONSE']['user_id'])) {
        ?>
        .page-sidebar.navbar-collapse.collapse {display: none !important;}   
        .page-content{margin-left:0px !important;}
        .col-md-1{width:12.50% !important;}
        .uppercase { font-size: 16px !important; }
<?php } // WITHOUT LOGIN [CHANGE 1]- EXTRA CODE - ENDS HERE  ?>


</style>

<?php $landProperty = $propertyDetail;    ?>

<div class="row">
    <?php // WITHOUT LOGIN [CHANGE 2]- EXTRA CODE
    if (empty($_SESSION['RESPONSE']['user_id']) || empty($_SESSION['land_user_id'])) {
        ?>
        <div class="col-md-1" style="padding: 0px;">&nbsp;</div>
        <div class="col-md-10" style="padding: 0px;margin-left: -50px;">
            <?php } // WITHOUT LOGIN [CHANGE 2] - EXTRA CODE - ENDS HERE 
            else {
                ?>
            <div class="col-md-12"> 
<?php } ?> 

            <div class="portlet-body">

                <div class="col-md-4" id="map" style="width:300px;height:500px;">
                         <!--<img src="https://www.esm.rochester.edu/uploads/NoPhotoAvailable.jpg" alt="" class="img-responsive">-->
                </div>
                <div class="col-md-8" style="background:#fff;">
                    <div class="row">    
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-building-o font-yellow-casablanca"></i>
                                    <span class="caption-subject bold font-yellow-casablanca uppercase">


<?php echo $landProperty['land_title']; ?>  </span>
                                    <span class="caption-helper">&nbsp;&nbsp;&nbsp;AD ID: ILOC000<?php echo base64_decode($_GET['landID']); ?></span>
                                </div>
                                <div class="inputs">
                                    <div class="portlet-input input-inline input-medium text-right">
                                        <!--										<div class="input-group">
                                                                                                                                <input class="form-control input-circle-left" placeholder="search..." type="text">
                                                                                                                                <span class="input-group-btn">
                                                                                                                                <button class="btn btn-circle-right btn-default" type="submit">Go!</button>
                                                                                                                                </span>
                                                                                                                        </div>-->
                                        <span class="btn default red-stripe"><i class="fa fa-eye"></i> 
                                            <?php
                                            $TotalViewed = LandownerConnectEXT::landRelatedCounts($_GET['landID'], "viewed");
                                            echo " " . $TotalViewed . " Viewed";
                                            ?>
                                        </span>
                                        <span class="btn default green-stripe"><i class="fa fa-thumbs-up"></i> 
                                            <?php
                                            $TotalIntrest = LandownerConnectEXT::landRelatedCounts($_GET['landID'], "intrested");
                                            echo " " . $TotalIntrest . " Intertest";
                                            ?>
                                        </span>
                                    </div>
                                </div>

                            </div>
                            <p>
                            <?php if ($landProperty['is_sale'] == 1) { ?>   <span class="btn default green-stripe"><i class="fa fa-tags"></i> Available for Sale</span> <?php } ?>
                            <?php if ($landProperty['is_lease'] == 1) { ?>  <span class="btn default red-stripe"><i class="fa fa-money"></i> Available for Lease</span> <?php } ?>
                                <span class="btn default red-stripe"><i class="fa fa-map-marker" aria-hidden="true"></i> <span class="cption_content">Land Type</span> <?php echo $landProperty['type_of_land']; //type of land     ?></span>
                            </p>
                            <p><?php echo $landProperty['comment']; ?></p>

                            <!-- Area / District  -->
                            <div class="col-md-12" style="margin:10px;">
                                <div class="col-md-6 fn13"> <i class="fa fa-area-chart" aria-hidden="true"></i> <span class="cption_content">Area</span> <?php echo $landProperty['area_sqmt'] . " Sq. Mt"; //area in sqmt     ?></div>
                                <div class="col-md-6 fn13"> <i class="fa fa-map-pin" aria-hidden="true"></i> <span class="cption_content"> District</span> <?php echo $landProperty['distric_name']; //address     ?> </div>                                                     
                            </div> 
                            <!-- Railway  -->
                            <div class="col-md-12" style="margin:10px;">
                                <div class="col-md-6 fn13" title="<?php echo $landProperty['name_railway']; ?>"> <i class="fa fa-train"></i><span class="cption_content"> From Railway</span> <?php echo $landProperty['distance_railway'] . "Km"; //area in sqmt     ?></div>
                                <div class="col-md-6 fn13"><i class="fa fa-train"></i> <span class="cption_content">Nearest Railway Station</span> <?php echo $landProperty['name_railway']; ?></div>
                            </div>
                            <!-- Airport  -->
                            <div class="col-md-12" style="margin:10px;">
                                <div class="col-md-6 fn13" title="<?php echo $landProperty['name_airport']; ?>"> <i class="fa fa-plane" aria-hidden="true"></i><span class="cption_content"> From Airport </span> <?php echo $landProperty['distance_airport'] . "Km"; //distance from railway in km     ?></b></div>
                                <div class="col-md-6 fn13"><i class="fa fa-plane"></i> <span class="cption_content">Nearest Airport</span> <?php echo $landProperty['name_airport']; ?></div>
                            </div>
                            <!-- Highway  -->
                            <div class="col-md-12" style="margin:10px;">
                                <div class="col-md-6 fn13" title="<?php echo $landProperty['name_highway']; ?>"> <i class="fa fa-road" aria-hidden="true"></i><span class="cption_content"> From Highway </span> <?php echo $landProperty['distance_highway'] . "Km"; //distance from railway in km     ?></b></div>
                                <div class="col-md-6 fn13"><i class="fa fa-road"></i> <span class="cption_content">Nearest Highway</span> <?php echo $landProperty['name_highway']; ?></div>

                            </div>
                            <!-- Address  -->
                            <div class="col-md-12" style="margin:10px;">

                                <div class="col-md-12 fn13"> <i class="fa fa-location-arrow" aria-hidden="true"></i> <span class="cption_content"> Address </span> <?php echo $landProperty['village']; //address     ?></div>
                            </div>


                            <div class="col-md-12" style="margin:20px;"> 
                                <p style="color:red;"><b><i class="fa-gavel fa"></i> Disclaimer: </b>State takes no responsibility for the details submitted by Land Owners and that investors should do their own due diligence  before buying land.</p>
                                <!-- Trigger the modal with a button -->
                                <?php if ($landProperty['share_contact'] == "Y") { ?>
                                        <?php if (empty($_SESSION['RESPONSE']['user_id']) && empty($_SESSION['land_user_id'])) { ?>
                                        <button type="button" class="btn btn-success pull-10"  data-toggle="modal" data-target="#guestLogin"> <i class="fa fa-info"></i> View Contact Detail</button>
                                        <?php } else { ?>
                                        <button type="button" class="btn btn-success pull-10" data-toggle="modal" data-target="#myModal"> <i class="fa fa-info"></i> View Contact Detail</button>
                                        <?php } ?>
                                <?php } ?>
                                          <?php if (empty($_SESSION['RESPONSE']['user_id']) && empty($_SESSION['land_user_id'])) { ?>
                                        <button type="button" class="btn btn-success pull-10"  data-toggle="modal" data-target="#guestLogin"> <i class="fa fa-heart"></i> Express interest</button>
                                        <?php } else { ?>
                                        <a href="<?php echo Yii::app()->createUrl("iloc/property/updateInterest/landID/$_GET[landID]"); ?>" class="btn btn-success pull-10"> <i class="fa fa-heart"></i> Express interest </a>
                                        <?php } ?>
                                          <?php if (empty($_SESSION['RESPONSE']['user_id']) && empty($_SESSION['land_user_id'])) { ?>
                                        <button type="button" class="btn btn-danger pull-right"  data-toggle="modal" data-target="#guestLogin"><i class="fa fa-list-alt"></i> Report As Spam</button>
                                        <?php } else { ?>
                                        <button type="button" class="btn btn-danger pull-right" data-toggle="modal" data-target="#reportModal"><i class="fa fa-list-alt"></i> Report As Spam</button>
                                        <?php  } ?>
                                <?php if ($landProperty['share_contact'] == "N") { ?>
                                    <p> Seller preferred to not to share contact details, you can still contact with seller by expressing interest. </p>
                                <?php } ?>
                            </div>
                        </div>

                        <br>    
                    </div>


                </div>
            </div>

        <?php // WITHOUT LOGIN [CHANGE 3]- EXTRA CODE
        if (empty($_SESSION['RESPONSE']['user_id']) && empty($_SESSION['land_user_id'])) {
            ?>
            </div><div class="col-md-1">&nbsp;</div>
<?php } else { ?> 
        </div>
<?php } // WITHOUT LOGIN [CHANGE 3]- EXTRA CODE- ENDS HERE  ?>
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
                            <div class="col-md-6 fn13"> <i class="fa fa-user" aria-hidden="true"></i>   <span class="cption_content">Owner Name : </span><?php echo $landProperty['owner_name']; ?></div>
                            <div class="col-md-6 fn13"> <i class="fa fa-mobile-phone" aria-hidden="true"></i> <span class="cption_content">Owner Contact No. : </span> <?php echo $landProperty['owner_contact_no']; ?></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="margin:10px;">
                            <div class="col-md-6 fn13"> <i class="fa fa-user" aria-hidden="true"></i>   <span class="cption_content">Owner Email : </span><?php echo $landProperty['owner_email']; ?></div>
                            <div class="col-md-6 fn13"> <i class="fa fa-mobile-phone" aria-hidden="true"></i> <span class="cption_content">Owner Alternate No. : </span> <?php echo $landProperty['owner_alternate_no']; ?></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="margin:10px;">
                            <div class="col-md-6 fn13"> <i class="fa fa-user" aria-hidden="true"></i>   <span class="cption_content">Agent Name : </span><?php echo $landProperty['agent_name']; ?></div>
                            <div class="col-md-6 fn13"> <i class="fa fa-mobile-phone" aria-hidden="true"></i> <span class="cption_content">Agent Contact No. : </span> <?php echo $landProperty['agent_contact_no']; ?></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" style="margin:10px;">
                            <div class="col-md-6 fn13"> <i class="fa fa-user" aria-hidden="true"></i>   <span class="cption_content">Agent Email : </span><?php echo $landProperty['agent_email']; ?></div>
                            <div class="col-md-6 fn13"> <i class="fa fa-mobile-phone" aria-hidden="true"></i> <span class="cption_content">Agent Alternate No. : </span> <?php echo $landProperty['agent_alternate_no']; ?></div>
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


<!-- Modal -->
<div id="reportModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <form action="<?php echo Yii::app()->createUrl("iloc/property/addReportAgainstLand/landID/$_GET[landID]"); ?>"  method='POST'>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> <?php echo $landProperty['land_title']; ?> </h4>
                </div>
                <div class="modal-body">
                    <textarea class="form-control" name="comment" required></textarea> 
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Report Against Land</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>

    </div>

</div>
</div>
<!-- Added By Rahul Kumar : 29012018 -->
<!-- Modal -->
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
                            <p>
                                Verify your mobile number to view land owner's Contact Info / Express Interest Or Report 
                            </p>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="input-icon">
                                        <i class="fa fa-mobile"></i>
                                        <input name="lID" type="hidden" value="<?php echo $_GET['landID'] ?>" >
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
                                        <input name="lID" type="hidden" value="<?php echo $_GET['landID'] ?>" >
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

</div>

<?php if (empty($landProperty['latlong'])) {
    $landProperty['latlong'] = LandownerConnectEXT::getDistrictLatLong($landProperty['district_id']);
} ?>
<!--<script src="http://maps.googleapis.com/maps/api/js"></script>--> 
<script type="text/javascript">
    var map;
    //  var latlong="30.3165, 78.0322";
    function initialize() {

        var myLatlng = new google.maps.LatLng(30.3165, 78.0322);
<?php if (!empty($landProperty['latlong'])) { ?>
            var myLatlng = new google.maps.LatLng<?php echo $landProperty['latlong']; ?>;
<?php } ?>
        var myOptions = {zoom: 12, center: myLatlng};
        map = new google.maps.Map(document.getElementById('map'), myOptions);
        // marker STARTS    
        var marker = new google.maps.Marker({
            position: myLatlng,
            //      title: "Click to view info!"
        });
        marker.setMap(map);
        // marker ENDS
        // Added : Rahul Kumar
        // info-window STARTS   
<?php if (!empty($landProperty['latlong'])) { ?>
            var infowindow = new google.maps.InfoWindow({content: "<div class='map_bg_logo'><span style='color:#1270a2;'><b><?php echo $landProperty['land_title']; ?></b> </span><div style='border-top:1px dotted #ccc; height:1px;  margin:5px 0;'></div><span style='color:#555;font-size:11px;'><b>Area: </b><?php echo $landProperty['area_sqmt'] . " SQMT"; ?></span></div>"});
            google.maps.event.addListener(marker, 'click', function () {
                infowindow.open(map, marker);
            });
<?php } ?>
    }
    google.maps.event.addDomListener(window, 'load', initialize);
   </script>
<script>
    // Added by Rahul Kumar : 29012018
    $(document).ready(function(){        
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
</script>` 

<script>
    // Added by Rahul Kumar : 29012018
    $(document).ready(function(){        
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3VOcg0P61BSjOsA95rVHFFV_VbMLeS4w&callback=initialize"></script>





