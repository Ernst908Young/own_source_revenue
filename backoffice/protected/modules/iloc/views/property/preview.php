<!-- Custom Css Page Level
    Rahul Kumar
    14012018 -->

<style>
    .cption_content{padding: 0; margin: 0;line-height: 13px;color: #9eacb4; font-size: 13px;font-weight: 400;}
    .fn13{ font-size: 13.4px;  line-height: 18px !important; }
    .fn13 .fa{color: #f2784b; }

<?php // WITHOUT LOGIN [CHANGE 1]- EXTRA CODE
    if(empty($_SESSION['RESPONSE']['user_id']) && empty($_SESSION['uid'])){ ?>
    .page-sidebar.navbar-collapse.collapse {display: none !important;}
    .page-content{margin-left:0px !important;}
    .col-md-1{width:12.50% !important;}
    .uppercase { font-size: 16px !important; }
<?php } // WITHOUT LOGIN [CHANGE 1]- EXTRA CODE - ENDS HERE ?>


</style>

<?php $landProperty = $propertyDetail; //print_r($landProperty);die;?>

<div class="row">
     <?php // WITHOUT LOGIN [CHANGE 2]- EXTRA CODE
         if(empty($_SESSION['RESPONSE']['user_id']) && empty($_SESSION['uid'])){ ?>
        <div class="col-md-1" style="padding: 0px;">&nbsp;</div>
        <div class="col-md-10" style="padding: 0px;margin-left: -50px;">
       <?php } // WITHOUT LOGIN [CHANGE 2] - EXTRA CODE - ENDS HERE
             else{ ?>
                <div class="col-md-12">
           <?php  } ?>

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
                                <span class="caption-helper"></span>
                            </div>
                            <div class="inputs">
                            <div class="portlet-input input-inline input-medium text-right">
                                <!--<div class="input-group">
                                    <input class="form-control input-circle-left" placeholder="search..." type="text">
                                    <span class="input-group-btn">
                                    <button class="btn btn-circle-right btn-default" type="submit">Go!</button>
                                    </span>
                            </div>-->
                                <span class="btn default green-stripe"><i class="fa fa-eye"></i>
                               <?php echo "AD ID : ILOC000".base64_decode($_GET['landID']);

                                ?>
                                </span>


                            </div>
                        </div>

                        </div>
                        <p>
                            <?php if ($landProperty['is_sale'] == 1) { ?>   <span class="btn default green-stripe"><i class="fa fa-tags"></i> Available for Sale</span> <?php } ?>
                            <?php if ($landProperty['is_lease'] == 1) { ?>  <span class="btn default red-stripe"><i class="fa fa-money"></i> Available for Lease</span> <?php } ?>
                            <span class="btn default red-stripe"><i class="fa fa-map-marker" aria-hidden="true"></i> <span class="cption_content">Land Type</span> <?php echo $landProperty['type_of_land']; //type of land    ?></span>
                        </p>
                        <p><?php echo $landProperty['comment']; ?></p>

                        <!-- Area / District  -->
                        <div class="col-md-12" style="margin:10px;">
                            <div class="col-md-6 fn13"> <i class="fa fa-area-chart" aria-hidden="true"></i> <span class="cption_content">Area</span> <?php echo $landProperty['area_sqmt'] . " ".$landProperty['area_type']; //area in sqmt    ?></div>
                            <div class="col-md-6 fn13"> <i class="fa fa-map-pin" aria-hidden="true"></i> <span class="cption_content"> District</span> <?php echo $landProperty['distric_name']; //address    ?> </div>
                        </div>
                        <!-- Railway  -->
                        <div class="col-md-12" style="margin:10px;">
                            <div class="col-md-6 fn13" title="<?php echo $landProperty['name_railway']; ?>"> <i class="fa fa-train"></i><span class="cption_content"> From Railway</span> <?php echo $landProperty['distance_railway'] . "Km"; //area in sqmt    ?></div>
                            <div class="col-md-6 fn13"><i class="fa fa-train"></i> <span class="cption_content">Nearest Railway Station</span> <?php echo $landProperty['name_railway']; ?></div>
                        </div>
                        <!-- Airport  -->
                        <div class="col-md-12" style="margin:10px;">
                            <div class="col-md-6 fn13" title="<?php echo $landProperty['name_airport']; ?>"> <i class="fa fa-plane" aria-hidden="true"></i><span class="cption_content"> From Airport </span> <?php echo $landProperty['distance_airport'] . "Km"; //distance from railway in km    ?></b></div>
                            <div class="col-md-6 fn13"><i class="fa fa-plane"></i> <span class="cption_content">Nearest Airport</span> <?php echo $landProperty['name_airport']; ?></div>
                        </div>
                        <!-- Highway  -->
                        <div class="col-md-12" style="margin:10px;">
                            <div class="col-md-6 fn13" title="<?php echo $landProperty['name_highway']; ?>"> <i class="fa fa-road" aria-hidden="true"></i><span class="cption_content"> From Highway </span> <?php echo $landProperty['distance_highway'] . "Km"; //distance from railway in km    ?></b></div>
                            <div class="col-md-6 fn13"><i class="fa fa-road"></i> <span class="cption_content">Nearest Highway</span> <?php echo $landProperty['name_highway']; ?></div>

                        </div>
                        <!-- Address  -->
                        <div class="col-md-12" style="margin:10px;">
                          <?php
                          if(isset($landProperty['village']) && !empty($landProperty['village'])){

                              $village = ", ". LandownerConnectEXT::getMasterName('lg_code_villages',$landProperty['village'],'village_name','village_code');

                            }else {
                              $village ='';
                            }
                           ?>

                            <div class="col-md-12 fn13"> <i class="fa fa-location-arrow" aria-hidden="true"></i> <span class="cption_content"> Address </span> <?php  echo $landProperty['address']; echo $village; echo ", ". LandownerConnectEXT::getMasterName('lg_code_sub_disctrct',$landProperty['sub_district_id'],'sub_district_name','sub_district_code');//address    ?></div>
                        </div>
 <div class="col-md-12 fn13"><p><span class="badge"> <?php  if($landProperty['la_type']=="Pvt"){echo "Private Land"; }else{echo "Govt. Land";} ?></span><?php if($landProperty['la_type']=="Gov" && $landProperty['department_id']!=""){ echo "&nbsp;<span class='badge danger'>".LandownerConnectEXT::getMasterName('bo_departments',$landProperty['department_id'],'department_name','dept_id')."</span>"; }?></p></div>


<!--  Download  -->
                            <div class="col-md-12" style="margin:10px;"> 
       
        <?php   
           if($pdfInfo=$this->getLandDocument(base64_decode($_GET['landID']),'pdf')){?>
            <span class="btn default blue-stripe">
                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                <span class="cption_content">

               <a href='<?php echo "https://caipotesturl.com/themes/backend/mydoc/$pdfInfo->document_name"; ?>' target='blank'>View Additional Information</a>                 
          <?php                
              // echo '<a href="'.Yii::app()->createAbsoluteUrl('iloc/property/DownloadDocuments/document/'.base64_encode($pdfInfo->document_name)).'">View Additional Information</a>';
            
           ?>
                        </span>     </span>
         <?php }?>
         <?php  
        if($videoInfo=$this->getLandDocument(base64_decode($_GET['landID']),'mp4')){?> 
                               <span class="btn default blue-stripe">
                <i class="fa fa-file-video-o" aria-hidden="true"></i> 
                 <span class="cption_content">
         
                     <a href="javascript:void(0)" data-toggle="modal" data-target="#videoModal">View Promotional / Project Video</a>
        </span>
        </span>

         <?php }?>
                            </div>
                        <!-- Download end  -->

                    <div class="col-md-12" style="margin:20px;">
                        <p style="color:red;"><b><i class="fa-gavel fa"></i> Disclaimer: </b>State takes no responsibility for the details submitted by Land Owners and that investors should do their own due diligence  before buying land.</p>
                            <!-- Trigger the modal with a button -->

                            </div>
                        <div class="col-md-12"> <div class="portlet light">

                        <div class="row">
                             <div class="col-md-12" style="margin:10px;">
                            <div class="col-md-6 fn13"> <i class="fa fa-user" aria-hidden="true"></i>   <span class="cption_content">Owner Name : </span><?php echo $landProperty['owner_name'];?></div>
                            <div class="col-md-6 fn13"> <i class="fa fa-mobile-phone" aria-hidden="true"></i> <span class="cption_content">Owner Contact No. : </span> <?php echo $landProperty['owner_contact_no'];?></div>
                           </div>
                            </div>
                        <div class="row">
                             <div class="col-md-12" style="margin:10px;">
                            <div class="col-md-6 fn13"> <i class="fa fa-user" aria-hidden="true"></i>   <span class="cption_content">Owner Email : </span><?php echo $landProperty['owner_email'];?></div>
                            <div class="col-md-6 fn13"> <i class="fa fa-mobile-phone" aria-hidden="true"></i> <span class="cption_content">Owner Alternate No. : </span> <?php echo $landProperty['owner_alternate_no'];?></div>
                           </div>
                           </div>
                        <div class="row">
                             <div class="col-md-12" style="margin:10px;">
                            <div class="col-md-6 fn13"> <i class="fa fa-user" aria-hidden="true"></i>   <span class="cption_content">Agent Name : </span><?php echo $landProperty['agent_name'];?></div>
                            <div class="col-md-6 fn13"> <i class="fa fa-mobile-phone" aria-hidden="true"></i> <span class="cption_content">Agent Contact No. : </span> <?php echo $landProperty['agent_contact_no'];?></div>
                           </div>
                           </div>
                        <div class="row">
                             <div class="col-md-12" style="margin:10px;">
                            <div class="col-md-6 fn13"> <i class="fa fa-user" aria-hidden="true"></i>   <span class="cption_content">Agent Email : </span><?php echo $landProperty['agent_email'];?></div>
                            <div class="col-md-6 fn13"> <i class="fa fa-mobile-phone" aria-hidden="true"></i> <span class="cption_content">Agent Alternate No. : </span> <?php echo $landProperty['agent_alternate_no'];?></div>
                           </div>
                           </div>
                         </div>
                        </div>
                          </div>

                <br>
                    </div>


                </div>
            </div>

         <?php // WITHOUT LOGIN [CHANGE 3]- EXTRA CODE
          if(empty($_SESSION['RESPONSE']['user_id']) && empty($_SESSION['uid'])){ ?>
        </div><div class="col-md-1">&nbsp;</div>
       <?php }else{ ?>
            </div>
           <?php } // WITHOUT LOGIN [CHANGE 3]- EXTRA CODE- ENDS HERE ?>
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
                            <div class="col-md-6 fn13"> <i class="fa fa-user" aria-hidden="true"></i>   <span class="cption_content">Owner Name : </span><?php echo $landProperty['owner_name'];?></div>
                            <div class="col-md-6 fn13"> <i class="fa fa-mobile-phone" aria-hidden="true"></i> <span class="cption_content">Owner Contact No. : </span> <?php echo $landProperty['owner_contact_no'];?></div>
                           </div>
                            </div>
                        <div class="row">
                             <div class="col-md-12" style="margin:10px;">
                            <div class="col-md-6 fn13"> <i class="fa fa-user" aria-hidden="true"></i>   <span class="cption_content">Owner Email : </span><?php echo $landProperty['owner_email'];?></div>
                            <div class="col-md-6 fn13"> <i class="fa fa-mobile-phone" aria-hidden="true"></i> <span class="cption_content">Owner Alternate No. : </span> <?php echo $landProperty['owner_alternate_no'];?></div>
                           </div>
                           </div>
                        <div class="row">
                             <div class="col-md-12" style="margin:10px;">
                            <div class="col-md-6 fn13"> <i class="fa fa-user" aria-hidden="true"></i>   <span class="cption_content">Agent Name : </span><?php echo $landProperty['agent_name'];?></div>
                            <div class="col-md-6 fn13"> <i class="fa fa-mobile-phone" aria-hidden="true"></i> <span class="cption_content">Agent Contact No. : </span> <?php echo $landProperty['agent_contact_no'];?></div>
                           </div>
                           </div>
                        <div class="row">
                             <div class="col-md-12" style="margin:10px;">
                            <div class="col-md-6 fn13"> <i class="fa fa-user" aria-hidden="true"></i>   <span class="cption_content">Agent Email : </span><?php echo $landProperty['agent_email'];?></div>
                            <div class="col-md-6 fn13"> <i class="fa fa-mobile-phone" aria-hidden="true"></i> <span class="cption_content">Agent Alternate No. : </span> <?php echo $landProperty['agent_alternate_no'];?></div>
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
<?php if(empty($landProperty['latlong'])){ $landProperty['latlong']= LandownerConnectEXT::getDistrictLatLong($landProperty['district_id']);}?>
<script src="http://maps.googleapis.com/maps/api/js"></script>
            <script type="text/javascript">
                var map;
                //  var latlong="30.3165, 78.0322";
                function initialize() {

                    var myLatlng = new google.maps.LatLng(30.3165, 78.0322);
                     <?php if(!empty($landProperty['latlong'])){ ?>
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
                      <?php if(!empty($landProperty['latlong'])){ ?>
                        var infowindow = new google.maps.InfoWindow({ content: "<div class='map_bg_logo'><span style='color:#1270a2;'><b><?php echo $landProperty['land_title']; ?></b> </span><div style='border-top:1px dotted #ccc; height:1px;  margin:5px 0;'></div><span style='color:#555;font-size:11px;'><b>Area: </b><?php echo $landProperty['area_sqmt']." SQMT"; ?></span></div>" });
                        google.maps.event.addListener(marker, 'click', function() {
                            infowindow.open(map,marker);
                        });
                      <?php } ?>
                }
                google.maps.event.addDomListener(window, 'load', initialize);
            </script>`

            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3VOcg0P61BSjOsA95rVHFFV_VbMLeS4w&callback=initialize"></script>



<!-- Modal -->
<div id="reportModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form action="<?php echo Yii::app()->createUrl("iloc/property/addReportAgainstLand/landID/$_GET[landID]"); ?>" method='POST'>
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

<!-- Modal -->
<div id="videoModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> <?php echo @$landProperty['land_title']; ?><span class="pull-right"><?php if(!empty($videoInfo->document_name) && isset($videoInfo->document_name)){ ?><i class='fa fa-download' style="font-size:12px;"></i> <?php echo '<a href="'.Yii::app()->createAbsoluteUrl('iloc/property/DownloadDocuments/document/'.base64_encode($videoInfo->document_name)).'" style="font-size:12px; margin-right:50px;color:blue;">Download Video </a>'; } ?> </span></h4>
      </div>
        <?php  if($videoInfo=$this->getLandDocument(base64_decode($_GET['landID']),'mp4')){  ?>
                <video width="900" controls>
                    <source src="<?php echo "https://caipotesturl.com/themes/backend/mydoc/$videoInfo->document_name"; ?>" type="video/mp4">
                     Your browser does not support HTML5 video.
                </video>
        <?php }else{
            ?>
        <p> Video Not Available</p>
       <?php } ?>
     </div>

    </div>

  </div>
</div>
