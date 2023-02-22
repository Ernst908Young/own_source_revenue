<?php $basePath="/themes/investuk"; ?>
<div class="form-row row">
        <div class="col-md-4 form-group">
            <div class="counter-item bord-3" style=" box-shadow: 2px 2px 5px #1683c6;">         
              <div class="data-counter">
                  <div class="counter-left">
                      <span>Total number of registered service providers</span>
                      <span class="counter-number font-montserrat">
                          <?php $total = $data_array['sp_user_count']['ctsp_active']+$data_array['sp_user_count']['cr_active']+$data_array['sp_user_count']['ctsp_deactive']+$data_array['sp_user_count']['cr_deactive'];
                            echo $total;
                          ?>
                      </span>
                      <div class="counter-icon">
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/service-providers.png">
                      </div>
                  </div>
              </div>         
          </div>
        </div>
        <div class="col-md-4 form-group">
            <div class="counter-item bord-3" style=" box-shadow: 2px 2px 5px #1683c6;">         
              <div class="data-counter">
                  <div class="counter-left">
                      <span>Total number of active CTSP</span>
                      <span class="counter-number font-montserrat">
                         <?= $data_array['sp_user_count']['ctsp_active'] ? $data_array['sp_user_count']['ctsp_active'] : 0 ?>
                      </span>
                      <div class="counter-icon">
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/CTSP.png">
                      </div>
                  </div>
              </div>         
          </div>
        </div>
        <div class="col-md-4 form-group">
            <div class="counter-item bord-3" style=" box-shadow: 2px 2px 5px #1683c6;">         
              <div class="data-counter">
                  <div class="counter-left">
                      <span>Total number of active CR</span>
                      <span class="counter-number font-montserrat">
                         <?= $data_array['sp_user_count']['cr_active'] ? $data_array['sp_user_count']['cr_active'] : 0 ?>
                      </span>
                      <div class="counter-icon">
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/CR-icon.png">
                      </div>
                  </div>
              </div>         
          </div>
        </div>
        <div class="col-md-4 form-group">
            <div class="counter-item bord-3" style=" box-shadow: 2px 2px 5px #1683c6;">         
              <div class="data-counter">
                  <div class="counter-left">
                      <span>Total number of de-registered CTSP</span>
                      <span class="counter-number font-montserrat">
                         <?= $data_array['sp_user_count']['ctsp_deactive'] ? $data_array['sp_user_count']['ctsp_deactive'] : 0 ?>
                      </span>
                      <div class="counter-icon">
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/de-registered-CTSP.png">
                      </div>
                  </div>
              </div>         
          </div>
        </div>
        <div class="col-md-4 form-group">
            <div class="counter-item bord-3" style=" box-shadow: 2px 2px 5px #1683c6;">         
              <div class="data-counter">
                  <div class="counter-left">
                      <span>Total number of de-registered CR</span>
                      <span class="counter-number font-montserrat">
                         <?= $data_array['sp_user_count']['cr_deactive'] ? $data_array['sp_user_count']['cr_deactive'] : 0 ?>
                      </span>
                      <div class="counter-icon">
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/de-registered-CR.png">
                      </div>
                  </div>
              </div>         
          </div>
        </div>
      </div>

      
        <div class="form-row row">
        <div class="col-md-4">
          <?php

           $ctsp_a_per =  $cr_a_per = $ctsp_dea_per =  $cr_dea_per = 0;
          if($total>0){
               $ctsp_a_per =  round(($data_array['sp_user_count']['ctsp_active']/$total)*100,2);
               $cr_a_per = round(($data_array['sp_user_count']['cr_active']/$total)*100,2);
               $ctsp_dea_per =  round(($data_array['sp_user_count']['ctsp_deactive']/$total)*100,2);
               $cr_dea_per =   round(($data_array['sp_user_count']['cr_deactive']/$total)*100,2);    
          }

            $xaxis = ["Total number of active CTSP","Total number of active CR","Total number of de-registered CTSP","Total number of de-registered CR"];
            $yaxis = [$ctsp_a_per, $cr_a_per, $ctsp_dea_per, $cr_dea_per];

            $this->renderPartial('/graph/donut_graph',['category'=>$category,'xaxis'=>$xaxis,'yaxis'=>$yaxis]); ?>
        </div>
        <?php $year_xaxis = $year_yaxis = []; 
              foreach ($data_array['year_data'] as $key => $value) {
                  $year_xaxis[] = $value['year'];
                  $year_yaxis[] = $value['sp_count'];                  
                }     
         ?>
         <div class="col-md-8">
          <?=  $this->renderPartial('/graph/bar_graph',['category'=>$category,'year'=>$year,'xaxis'=>$year_xaxis,'yaxis'=>$year_yaxis]); ?>
        </div>
        <div class="col-md-12">
          <?=  $this->renderPartial('/graph/line_graph',['category'=>$category,'xaxis'=>$year_xaxis,'yaxis'=>$year_yaxis]); ?>
        </div>
      </div>
   

      