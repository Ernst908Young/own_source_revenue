  <?php 
        if($sc_id){
            $wheresc = " AND sc_id=$sc_id";
        }else{
            $wheresc = " ";
        }
         $tablesql =   "SELECT * FROM bo_new_application_submission 
            INNER JOIN bo_information_wizard_service_parameters bosp
            ON bo_new_application_submission.service_id=CONCAT(bosp.service_id,'.',bosp.servicetype_additionalsubservice)
            INNER JOIN bo_information_wizard_service_master 
            ON bo_information_wizard_service_master.id = bosp.service_id
            where  bosp.is_active='Y' $wheresc            
            AND bo_new_application_submission.user_id=$userID ORDER BY submission_id DESC";

 $ra_ser = Yii::app()->db->createCommand($tablesql)->queryAll();
          
                if($ra_ser){ ?>

                              
                    <div class="applied-view" id="service_records">
                  <?php foreach ($ra_ser as $key => $value) { ?>
                        <!-- <div class="applied-item"> -->
                            <div class="item-row">
                                <div class="iteam-td current-status text-center">
                                    <h5>SRN No.</h5>
                                    <p><?php echo $value['submission_id']; ?></p>
                                </div>
                                <div class="iteam-td current-status text-start">
                                    <h5>Service Name</h5>
                                    <p><?php echo $value['app_name']; ?></p>
                                </div>
                                <!-- <div class="iteam-td servoces-type text-center">
                                    <h5>Service Type</h5>
                                    <p>Name Related Service</p>
                                </div> -->
                                <div class="iteam-td current-status text-center">
                                    <h5>Applied On</h5>
                                    <p><?php echo date('d-m-Y H:i:s',strtotime($value['application_created_date'])); ?></p>
                                </div>
                                <div class="iteam-td current-status text-center">
                                    <h5>Current Status</h5>
                                    <p class="pending"><?php 
                                
                                    switch ($value['application_status']) {
                                        case "A":
                                            echo "<td style='vertical-align: top'>Approved</td>";
                                            break;                                      
                                        case "P":
                                            echo "<td style='vertical-align: top;'>Submitted</td>";
                                            break;
                                        case "F":
                                            echo "<td style='vertical-align: top;'> Forward</td>";
                                            break;
                                        case "FA":
                                            echo "<td style='vertical-align: top;'> Forward to Approver</td>";
                                            break;  
                                        case "I":
                                            echo "<td style='vertical-align: top;'>Draft</td>"; 
                                         
                                            break;
                                        case "DP":
                                       /* echo "<td style='vertical-align: top;'>"; 
                                            $app=$value;  
                                            $revertbackUrl=Yii::app()->createAbsoluteUrl("frontuser/home/redirectToServiceProviders/service_id/".base64_encode(@$app['sp_app_id'])."/sp_tag/".base64_encode($app['sp_tag'])."/application_id/".base64_encode($app['submission_id'])."/application_status/".$app['application_status']."/reverted_call_back_url/".base64_encode(base64_encode($app['reverted_call_back_url'])));                                             
                                            echo "<a href='$revertbackUrl'>Draft</a></td>";*/
                                          
                                             echo "<td style='vertical-align: top;'>Draft</td>"; 
                                         
                                          break;
                                        case "RBI":
                                            echo "<td style='vertical-align: top;'>Pending for Resubmission</td>"; 
                                            break;
                                        case "H":
                                            echo "<td style='vertical-align: top;'>Pending for Resubmission</td>"; 
                                           
                                            break;  
                                        case "PD":
                                            echo "<td style='vertical-align: top;'>Draft</td>";
                                         
                                            break;  
                                        case "R":
                                            echo "<td style='vertical-align: top;'>Rejected</td>";
                                            break;
                                        case "W":
                                            echo "<td style='vertical-align: top;'>Withdrawn</td>";
                                            break;  
                                        default:
                                            echo "<td style='vertical-align: top;'>No Status</td>";
                                    }
                                    ?></p>
                                </div>
                                <!-- <div class="toggle-click">
                                </div> -->
                                <div class="iteam-td current-status  text-center">
                                     <h5>Action</h5>
                                     <?php 
                                    // echo $value['print_app_call_back_url'];
 $printappurl = str_replace("infowizardtwo", "infowizard", $value['print_app_call_back_url']); 
                                     ?>
                                    <a target="_blank" href="<?php echo $printappurl; ?>" title="Print Application">
                                       <img src="<?php echo $basePath; ?>/assets/applicant/images/print-icon.png">                           
                                    </a>
                                    &nbsp;
                                     <a href="<?php echo Yii::app()->createAbsoluteUrl('infowizardtwo/subForm/applicationTimeline/subID/'. base64_encode($value['submission_id']));?>" target="_blank" title="View Timeline">
                                        <img src="<?php echo $basePath; ?>/assets/applicant/images/time-icon.png">
                                    
                                     </a>
                                       &nbsp;
                                     <a href="<?php echo Yii::app()->createAbsoluteUrl('ticketing/default/index/srn_no/'. base64_encode($value['submission_id']));?>" target="_blank" title="Raise Ticket">
                                        <img src="<?php echo $basePath; ?>/assets/applicant/images/ticket-grey.png">
                                       
                                     </a>
                                    <!--  <a href="">
                                                 <img src="<1?php echo $basePath; ?>/assets/applicant/images/pdf-icon.png">
                                                 <p>Download<br>Letter / Certificate</p>
                                             </a> -->
                                </div>
                            </div>
                        
                       <!--  </div> -->
                <?php } ?>
          <!--   </div> -->
          <?php  }else{
                    echo 'No Records Found';
                }
            ?>           
            
        </div>