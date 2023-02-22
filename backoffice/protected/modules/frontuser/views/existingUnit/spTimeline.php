<?php 
// echo"<pre>"; print_r($app_comments); die("data");
?><!--timeline start-->
<div class="portlet light portlet-fit bordered">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-microphone font-green"></i>
                                    <span class="caption-subject bold font-green uppercase"> Timeline</span>
                                    <span class="caption-helper">Application ID : <?php echo $app_id; ?></span>
                                </div>
                            </div>




          <div class="portlet-body">
                                <div class="mt-timeline-2">
                                    <div class="mt-timeline-line border-grey-steel"></div>
                                    <ul class="mt-container">
              <!-- <span class='timeline-date'>08:25 am</span> -->
              <?php 
                $alt=0;
                // echo "<pre>";print_r($history);die;
                if(!empty($history)){
                    foreach ($history as $app => $data) {
                      $timestamp = strtotime($data['added_date_time']);
                      $day = date('l, d-m-Y', $timestamp);
                      $appStatus="";
                      if(isset($data['application_status'])){
                        if($data['application_status']=='P' ||$data['application_status']=='p')
                          $appStatus="Your application is Pending";
                        elseif($data['application_status']=='A' ||$data['application_status']=='a')
                          $appStatus="Your application has been Approved";
                        elseif($data['application_status']=='R' ||$data['application_status']=='r')
                          $appStatus="Your application has been Rejected";
                        elseif($data['application_status']=='I' ||$data['application_status']=='i')
                          $appStatus="Incompleted Application";
                        else
                          $appStatus=$data['application_status'];
                          
                      }
                      if( $alt % 2 == 0){ ?>
                                            <li class="mt-item">
                                            <div class="mt-timeline-icon bg-blue-chambray bg-font-blue-chambray border-grey-steel">
                                                <i class="icon-bubbles"></i>
                                            </div>
                                            <div class="mt-timeline-content">
                                                <div class="mt-content-container">
                                                    <div class="mt-title">
                                                        <h3 class="mt-content-title">Timeline Request</h3>
                                                    </div>
                                                    <div class="mt-author">
                                                        <div class="mt-avatar">
                                                            <img src="http://keenthemes.com/preview/metronic/theme/assets/pages/media/users/avatar80_1.jpg" />
                                                        </div>
                                                        <div class="mt-author-name">
                                                            <a href="javascript:;" class="font-blue-madison"><?php echo ucwords($data['approver_id'])?></a>
                                                        </div>
                                                        <div class="mt-author-notes font-grey-mint"><?php echo $day ;?></div>
                                                    </div>
                                                    
                                              
                                <?php
                                if($data['comments']===NULL){
                                echo "<div class='mt-content border-grey-salt'><p>". $appStatus."</p></div>";    
                                }
                                else{
                                echo"<div class='mt-content border-grey-salt'>".$data['comments']."</div>";
                                echo '<div class="mt-content border-grey-salt"><p> '. $appStatus.'</p></div>';    
                                   
                                }?>
                               </div>
                                            </div>
                                        </li>
                      <?php }
                      else{ ?>
                          <li class="mt-item">
                                            <div class="mt-timeline-icon bg-blue bg-font-blue border-grey-steel">
                                                <i class="icon-calendar"></i>
                                            </div>
                                            <div class="mt-timeline-content">
                                                <div class="mt-content-container bg-white border-grey-steel">
                                                    <div class="mt-title">
                                                        <h3 class="mt-content-title">Timeline Request</h3>
                                                    </div>
                                                    <div class="mt-author">
                                                        <div class="mt-avatar">
                                                            <img src="http://keenthemes.com/preview/metronic/theme/assets/pages/media/users/avatar80_1.jpg" />
                                                        </div>
                                                        <div class="mt-author-name">
                                                            <a href="javascript:;" class="font-blue-madison"><?php echo ucwords($data['approver_id'])?></a>
                                                        </div>
                                                        <div class="mt-author-notes font-grey-mint"><?php echo $day ;?></div>
                                                    </div>
                                  
                                  <?php 
                                  if($data['comments']===NULL){
                                  // echo"<p> No Additional Comments &hellip; </p>";   
                                  echo "<div class='mt-content border-grey-steel'>". $appStatus."</div>";    

                                 // echo '<div class="notification"><i class=" fa fa-exclamation-sign"></i> '. $appStatus.'</div>';    
                                  }
                                  else{
                                  echo"<div class='mt-content border-grey-steel'>".$data['comments']."</div>";
                                  echo "<div class='mt-content border-grey-steel'>". $appStatus."</div>";    
                                  
                                  }
                                  ?>
 </div>
                                            </div>
                                        </li>
                      <?php }
                      $alt++;
                    }
                }
                else{
                  echo '<div class="notification"><i class=" fa fa-exclamation-sign"></i> No data found with this application.</div>';    

                  // echo "No history Found.";
                }
                ?>
               </ul>
                                </div>
                            </div>
                        
<!--timeline end-->  
