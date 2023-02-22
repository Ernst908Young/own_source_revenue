<style>
    .errorSummary { color:red }
    .control-label{text-align: left !important;}
    #content{margin-top: -38px; }
    <?php // WITHOUT LOGIN [CHANGE 1]- EXTRA CODE
    if (empty($_SESSION['RESPONSE']['user_id'])) {
        ?>
        .page-sidebar.navbar-collapse.collapse {
            display: none !important;
        }   
        .page-content{margin-left:0px !important;}
        .col-md-1{width:12.50% !important;}
        .uppercase { font-size: 16px !important;

        }
<?php } // WITHOUT LOGIN [CHANGE 1] - EXTRA CODE - ENDS HERE ?>
</style>
<?php $requestedProperty1=LandownerConnectEXT::isLandContactAvailable($_GET['landID']);
$urlPostFix="create/landID/$_GET[landID]";
if(!empty($requestedProperty1)){
    $urlPostFix="update/id/$_GET[landID]/landID/$_GET[landID]";
} 

//print_r($requestedProperty);die; ?>

<?php // WITHOUT LOGIN [CHANGE 2]- EXTRA CODE
 if (empty($_SESSION['RESPONSE']['user_id'])) {
    ?>
    <div class="row">
        <div class="col-md-1" style="padding: 0px;">&nbsp;</div>
        <div class="col-md-10" style="padding: 0px;margin-left: -50px;">
        <?php } // WITHOUT LOGIN [CHANGE 2] - EXTRA CODE - ENDS HERE?>
            
            
<div class='portlet box'>
    <div class="col-md-12" style="padding: 0px;">
        <div class="portlet light portlet-fit">

            <div class="portlet-body" style="padding:10px">
                <div class="mt-element-step">

                    <div class="row step-background-thin">   
                        <div class="col-md-4 bg-grey-steel mt-step-col ">
                            <a href="<?php echo Yii::app()->createUrl("/iloc/landownerConnect/update/id/$_GET[landID]"); ?>">
                                <div class="mt-step-number">1</div>
                                <div class="mt-step-title uppercase font-grey-cascade ">Land</div>
                                <div class="mt-step-content font-grey-cascade">Fill your land details</div>
                            </a>
                        </div>
                        <div class="col-md-4 bg-grey-steel mt-step-col ">
                            <a href="<?php echo Yii::app()->createUrl("/iloc/landownerContact/$urlPostFix"); ?>">
                                <div class="mt-step-number">2</div>
                                <div class="mt-step-title uppercase font-grey-cascade">Contact</div>
                                <div class="mt-step-content font-grey-cascade">Fill Contact Person Details</div>
                            </a>
                        </div>
                        <div class="col-md-4 bg-grey-steel mt-step-col active">
                            <a href="<?php echo Yii::app()->createUrl("/iloc/landownerConnect/pinLocation/landID/$_GET[landID]"); ?>">
                                <div class="mt-step-number">3</div>
                                <div class="mt-step-title uppercase font-grey-cascade">Map</div>
                                <div class="mt-step-content font-grey-cascade">Fill Map Details</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <hr>

    <div class="portlet-body">
        <div class="portlet-title" style="">
            <div class="caption">
                <i class="icon-globe font-purple-soft"></i>
                <span class="caption-subject font-purple-soft bold uppercase"> Pin Location & Other Setting</span>
                <!--<span class="caption-heading"> You are publishing this land advertisment As a Owner / On behalf of</span>-->
            </div>

        </div>
        <hr>
      <div class="tab-pane active" id="tab1" style="background-color:#fff;">

            <div id="map" style="width:100%;height:300px;"></div>

            <div class="row" style="margin:10px;">
                <form action="<?php echo Yii::app()->createUrl("iloc/landownerConnect/propertySetting/landID/$_GET[landID]"); ?>" method="POST">
                   <div class="col-md-12"><input type="checkbox" <?php if(!empty($requestedProperty['share_contact']) && $requestedProperty['share_contact']=="Y"){ echo "checked"; }?> name="share_contact" id="share_contact"> &nbsp; Share My Contact Details with Visitors </div>
               <br> <div class="col-md-6"><input type="radio" name="status" value="Y"  class="is_property_active" <?php if(!empty($requestedProperty['status']) && $requestedProperty['status']=="Y"){ echo "checked"; }?>>&nbsp; Property Available for listing </div>
              <div class="col-md-6"> <input type="radio" name="status" value="N" class="is_property_active" <?php if(!empty($requestedProperty['status']) && $requestedProperty['status']=="N"){ echo "checked"; }?>> &nbsp; Property Not Available for listing </div>
               <div class="col-md-6"><input type="radio" name="status" value="D" class="is_property_active" <?php if(!empty($requestedProperty['status']) && $requestedProperty['status']=="D"){ echo "checked"; }?>> &nbsp; Save as Draft </div>
              <div class="col-md-6"> <input type="radio" name="status" value="A" class="is_property_active" <?php if(!empty($requestedProperty['status']) && $requestedProperty['status']=="A"){ echo "checked"; }?>> &nbsp; Mark Archived </div>
              <?php  if(!empty($_SESSION['RESPONSE']['user_id'])){ ?>
              <input type="submit" class="btn btn-success pull-right" value="Submit">
              <?php }else{ ?>
              <input type="submit" class="btn btn-success pull-right" value="Submit">
              <!--<input type="button" class="btn btn-success pull-right" value="Submit" data-toggle="modal" data-target="#myModal">-->
             <?php } ?>
                </form>
        </div>
        </div>
        </div>
    </div>
<?php // WITHOUT LOGIN [CHANGE 3]- EXTRA CODE - STARTS HERE
 if (empty($_SESSION['RESPONSE']['user_id'])) {
    ?>
        </div><div class="col-md-1" style="padding: 0px;">&nbsp;</div></div>
<?php } // WITHOUT LOGIN [CHANGE 3]- EXTRA CODE-  ENDS HERE ?>
   <?php if(empty($requestedProperty['latlong'])){ $requestedProperty['latlong']= LandownerConnectEXT::getDistrictLatLong($requestedProperty['district_id']);}?>
<script src="http://maps.googleapis.com/maps/api/js"></script> 
           <script type="text/javascript">
                var map;
                //  var latlong="30.3165, 78.0322";
                function initialize() {
                   
                    var myLatlng = new google.maps.LatLng(30.3165, 78.0322);
                     <?php if(!empty($requestedProperty['latlong'])){ ?>
                          var myLatlng = new google.maps.LatLng<?php echo $requestedProperty['latlong']; ?>;
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
                      <?php if(!empty($requestedProperty['latlong'])){ ?>
                        var infowindow = new google.maps.InfoWindow({ content: "<div class='map_bg_logo'><span style='color:#1270a2;'><b><?php echo $requestedProperty['land_title']; ?></b> </span><div style='border-top:1px dotted #ccc; height:1px;  margin:5px 0;'></div><span style='color:#555;font-size:11px;'><b>Area: </b><?php echo $requestedProperty['area_sqmt']." SQMT"; ?></span></div>" });
                        google.maps.event.addListener(marker, 'click', function() {
                            infowindow.open(map,marker);
                        });
                      <?php } ?>
                    // info-window ENDS 
                    // Added : Rahul Kumar
                    google.maps.event.addListener(map, "click", function (e) {
                        //lat and lng is available in e object
                        var latLng = e.latLng;
                        //initialize(latLng);
                        var butonpressed=confirm("Mark this location " + latLng + " for this property");
                        if(butonpressed===true){
                          // Send the data using post
                         var url='<?php echo Yii::app()->createUrl("iloc/landownerConnect/locationData/landID/$_GET[landID]"); ?>/latlong/'+latLng;
                         var posting = $.post( url);
                        // Put the results in a div
                        posting.done(function( data ) {
                           // alert(data); 
                           location.reload();
                       });
                   }
                    });
                }
                google.maps.event.addDomListener(window, 'load', initialize);
            </script>` 

            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3VOcg0P61BSjOsA95rVHFFV_VbMLeS4w&callback=initialize"></script>
            

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:red"><i class="fa fa-desktop"></i> Publish your Advertisement</h4>
      </div>
        <form action="<?php echo Yii::app()->createUrl("iloc/landownerConnect/guestAdPublish/landID/$_GET[landID]"); ?>" method="POST">
      <div class="modal-body">
       <div class="content">
	
	<!-- BEGIN VERIFY MOBILE FORM // 27012018-->
	<form class="forget-form" action="index.html" method="post" novalidate="novalidate">
		
		<p>
			 Enter your mobile number to publish this Advertisement
		</p>
                <div class="row">
		<div class="form-group col-md-6">
			<div class="input-icon">
				<i class="fa fa-mobile"></i>
                                <input name="lID" type="hidden" value="<?php echo $_GET['landID']?>" >
				<input class="form-control placeholder-no-fix" autocomplete="off" placeholder="Mobile Number" name="mobile_number" type="number">
			</div>
		</div>
                    </div>
		
	
	<!-- END FORGOT PASSWORD FORM // 27012018 -->
	</div>
      </div>
      <div class="modal-footer">
        <div class="form-actions">
			<button type="button" id="back-btn" class="btn" data-dismiss="modal">
			<i class="m-icon-swapleft"></i> Back </button>
			<button type="submit" class="btn green-haze pull-right">
			Submit <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
      </div>
            </form>
      </div>
    </div>

  </div>

</div>

            
            
            
