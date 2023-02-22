<?php $basePath="/themes/investuk"; ?>
<div class="form-row row">
        <!-- <div class="col-md-4 form-group">
            <div class="counter-item bord-3" style=" box-shadow: 2px 2px 5px #1683c6;">         
              <div class="data-counter">
                  <div class="counter-left">
                      <span>Total number of forms filed by users</span>
                      <span class="counter-number font-montserrat">
                          <1?php
                          
                          
                          $total = 
                          echo //$data_array['res']['submission_id'] ? $data_array['res']['submission_id'] : 0 ;?>
                      </span>
                      <div class="counter-icon">
                          <img src="<1?php echo $basePath; ?>/assets/applicant/images/icons/payment due_hover.png">
                      </div>
                  </div>
              </div>         
          </div>
        </div> -->
        <div class="col-md-4 form-group">
            <div class="counter-item bord-3" style=" box-shadow: 2px 2px 5px #1683c6;">         
              <div class="data-counter">
                  <div class="counter-left">
                      <span>Total number of forms processed by a BO user</span>
                      <span class="counter-number font-montserrat">
                          <?php  
                          $total_process = $data_array['res']['fa_app']+$data_array['res']['approved_app']+$data_array['res']['rejected_app']+$data_array['res']['reverted_app'];
                            echo $total_process;
                          ?>
                      </span>
                      <div class="counter-icon">
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/user-analysis-white.png">
                      </div>
                  </div>
              </div>         
          </div>
        </div>
        <div class="col-md-4 form-group">
            <div class="counter-item bord-3" style=" box-shadow: 2px 2px 5px #1683c6;">         
              <div class="data-counter">
                  <div class="counter-left">
                      <span>No. of forms forwarded to approver</span>
                      <span class="counter-number font-montserrat">
                          <?= $data_array['res']['fa_app'] ? $data_array['res']['fa_app'] : 0 ?>
                      </span>
                      <div class="counter-icon">
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/forms-forwarded.png">
                      </div>
                  </div>
              </div>         
          </div>
        </div>
        <div class="col-md-4 form-group">
            <div class="counter-item bord-3" style=" box-shadow: 2px 2px 5px #1683c6;">         
              <div class="data-counter">
                  <div class="counter-left">
                      <span>No. of forms approved by a BO user</span>
                      <span class="counter-number font-montserrat">
                          <?= $data_array['res']['approved_app'] ? $data_array['res']['approved_app'] : 0 ?>
                      </span>
                      <div class="counter-icon">
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/forms_approved.png">
                      </div>
                  </div>
              </div>         
          </div>
        </div>
        <div class="col-md-4 form-group">
            <div class="counter-item bord-3" style=" box-shadow: 2px 2px 5px #1683c6;">         
              <div class="data-counter">
                  <div class="counter-left">
                      <span>No. of forms rejected by a BO user</span>
                      <span class="counter-number font-montserrat">
                          <?= $data_array['res']['rejected_app'] ? $data_array['res']['rejected_app'] : 0 ?>
                      </span>
                      <div class="counter-icon">
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/forms-rejected.png">
                      </div>
                  </div>
              </div>         
          </div>
        </div>
        <div class="col-md-4 form-group">
            <div class="counter-item bord-3" style=" box-shadow: 2px 2px 5px #1683c6;">         
              <div class="data-counter">
                  <div class="counter-left">
                      <span>No. of forms reverted by a BO user</span>
                      <span class="counter-number font-montserrat">
                          <?= $data_array['res']['reverted_app'] ? $data_array['res']['reverted_app'] : 0 ?>
                      </span>
                      <div class="counter-icon">
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/forms-reverted.png">
                      </div>
                  </div>
              </div>         
          </div>
        </div>
      </div>

      
        <div class="form-row row">
        <div class="col-md-4">
          <?php 
          $fa_per = $a_per =  $rev_per = $rej_per = 0;
          if($total_process>0){
              $fa_per = round(($data_array['res']['fa_app']/$total_process)*100,2);
               $a_per =  round(($data_array['res']['approved_app']/$total_process)*100,2);
               $rej_per =  round(($data_array['res']['rejected_app']/$total_process)*100,2);
               $rev_per = round(($data_array['res']['reverted_app']/$total_process)*100,2);               
          }
            $xaxis = ["No. of form forwarded to approver","No. of forms approved by a BO user","No. of forms rejected by a BO user","No. of forms reverted by a BO user"];
            $yaxis = [$fa_per,$a_per, $rej_per, $rev_per];
            $this->renderPartial('/graph/donut_graph',['category'=>$category,'xaxis'=>$xaxis,'yaxis'=>$yaxis]); ?>
        </div>
        <?php $year_xaxis = $year_yaxis = []; 
              foreach ($data_array['year_data'] as $key => $value) {
                  $year_xaxis[] = $value['year'];
                  $year_yaxis[] = $value['submission_id'];                  
                }     
         ?>
         <div class="col-md-8">
          <?=  $this->renderPartial('/graph/bar_graph',['category'=>$category,'year'=>$year,'xaxis'=>$year_xaxis,'yaxis'=>$year_yaxis]); ?>
        </div>
        <div class="col-md-12">
          <?=  $this->renderPartial('/graph/line_graph',['category'=>$category,'xaxis'=>$year_xaxis,'yaxis'=>$year_yaxis]); ?>
        </div>
      </div>
   

      