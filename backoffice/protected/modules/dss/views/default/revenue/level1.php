<?php $basePath="/themes/investuk"; ?>
<div class="form-row row">
  <?php //print_r($data_array); ?>
        <div class="col-md-4 form-group">
            <div class="counter-item bord-3" style=" box-shadow: 2px 2px 5px #1683c6;">         
              <div class="data-counter">
                  <div class="counter-left">
                      <span>Total revenue collected</span>
                      <span class="counter-number font-montserrat">
                         <?php $total = $data_array['service_fee']['service_total_fee']+$data_array['service_fee']['late_fee']+$data_array['service_provider_late_fee']['total_fee']+$data_array['vpd_fee']['total_fee'];
                            echo $total;
                          ?>
                      </span>
                      <div class="counter-icon">
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/revenue-collected.png">
                      </div>
                  </div>
              </div>         
          </div>
        </div>
        <div class="col-md-4 form-group">
            <div class="counter-item bord-3" style=" box-shadow: 2px 2px 5px #1683c6;">         
              <div class="data-counter">
                  <div class="counter-left">
                      <span>Revenue collected as service fee for forms/services</span>
                      <span class="counter-number font-montserrat">
                         <?= $data_array['service_fee']['service_total_fee'] ? $data_array['service_fee']['service_total_fee'] : 0; ?>
                      </span>
                      <div class="counter-icon">
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/revenue-collected-service.png">
                      </div>
                  </div>
              </div>         
          </div>
        </div>
        <div class="col-md-4 form-group">
            <div class="counter-item bord-3" style=" box-shadow: 2px 2px 5px #1683c6;">         
              <div class="data-counter">
                  <div class="counter-left">
                      <span>Revenue collected as penalty/Additional Fee</span>
                      <span class="counter-number font-montserrat">
                          <?php $a_total = $data_array['service_fee']['late_fee']+$data_array['service_provider_late_fee']['total_fee']+$data_array['vpd_fee']['total_fee'];
                            echo $a_total;
                          ?>
                      </span>
                      <div class="counter-icon">
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/revenue-collected-penalty.png">
                      </div>
                  </div>
              </div>         
          </div>
        </div>       
      </div>

      
        <div class="form-row row">
        <div class="col-md-4">
          <?php

           
          $s_per =  $a_per = 0;
          if($total>0){
            $s_per = round(($data_array['service_fee']['service_total_fee']/$total)*100,2);
            $a_per = round(($a_total/$total)*100,2);           
          }

         
          $xaxis = ["Total Services/Form Fees","Total Penalty/Additional Fee"];
           $yaxis = [$s_per,$a_per];
            $this->renderPartial('/graph/donut_graph',['category'=>$category,'xaxis'=>$xaxis,'yaxis'=>$yaxis]); ?>
        </div>

         <?php $year_xaxis = $year_yaxis = []; 
              foreach ($data_array['year_data']['service_fee_year'] as $key => $value) {
                  $year_xaxis[] = $value['year'];
                  $year_yaxis[] = $value['service_total_fee']+$value['late_fee']+
                  (isset($data_array['year_data']['service_provider_late_fee_year'][$key]) ? $data_array['year_data']['service_provider_late_fee_year'][$key]['total_fee'] : 0)+
                  (isset($data_array['year_data']['vpd_fee_year'][$key]) ? $data_array['year_data']['vpd_fee_year'][$key]['total_fee'] : 0);
                  
                }     
         ?>
         <div class="col-md-8">
          <?=  $this->renderPartial('/graph/bar_graph',['category'=>$category,'year'=>$year,'xaxis'=>$year_xaxis,'yaxis'=>$year_yaxis]); ?>
        </div>
        <div class="col-md-12">
          <?=  $this->renderPartial('/graph/line_graph',['category'=>$category,'xaxis'=>$year_xaxis,'yaxis'=>$year_yaxis]); ?>
        </div>
      </div>
   

      