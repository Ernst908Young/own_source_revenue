<?php $basePath="/themes/investuk"; ?>
<div class="form-row row">
        <div class="col-md-4 form-group">
            <div class="counter-item bord-3" style=" box-shadow: 2px 2px 5px #1683c6;">         
              <div class="data-counter">
                  <div class="counter-left">
                      <span>Total number of forms filed</span>
                      <span class="counter-number font-montserrat">
                         <?php $total = $data_array['app_count']['reverted']+$data_array['app_count']['rejected']+$data_array['app_count']['approved'];
                         echo $total; ?>
                      </span>
                      <div class="counter-icon">
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/filings-white.png">
                      </div>
                  </div>
              </div>         
          </div>
        </div>
        <div class="col-md-4 form-group">
            <div class="counter-item bord-3" style=" box-shadow: 2px 2px 5px #1683c6;">         
              <div class="data-counter">
                  <div class="counter-left">
                      <span>Total number of forms reverted</span>
                      <span class="counter-number font-montserrat">
                         <?= $data_array['app_count']['reverted'] ?>
                      </span>
                      <div class="counter-icon">
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/forms-reverted.png">
                      </div>
                  </div>
              </div>         
          </div>
        </div>
        <div class="col-md-4 form-group">
            <div class="counter-item bord-3" style=" box-shadow: 2px 2px 5px #1683c6;">         
              <div class="data-counter">
                  <div class="counter-left">
                      <span>Total number of forms rejected</span>
                      <span class="counter-number font-montserrat">
                         <?= $data_array['app_count']['rejected'] ?>
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
                      <span>Total number of forms approved</span>
                      <span class="counter-number font-montserrat">
                         <?= $data_array['app_count']['approved'] ?>
                      </span>
                      <div class="counter-icon">
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/forms_approved.png">
                      </div>
                  </div>
              </div>         
          </div>
        </div>
       
      </div>

      
        <div class="form-row row">
        <div class="col-md-4">
          <?php 
          $pie_data = $data_array['app_count'];
          $rev_per =  $rej_per = $app_per = 0;
          if($total>0){
            $rev_per = round(($pie_data['reverted']/$total)*100,2);
            $rej_per = round(($pie_data['rejected']/$total)*100,2);
            $app_per = round(($pie_data['approved']/$total)*100,2);
            
          }
          

          $xaxis = ["Total number of forms reverted","Total number of forms rejected",'Total number of forms approved'];
          $yaxis = [$rev_per,$rej_per,$app_per];  

          $this->renderPartial('/graph/donut_graph',['category'=>$category,'xaxis'=>$xaxis,'yaxis'=>$yaxis,'data_array'=>$data_array]); ?>
        </div>
         <?php $year_xaxis = $year_yaxis = []; 
        foreach ($data_array['year_data'] as $key => $value) {
          $year_xaxis[] = $value['year'];
          $year_yaxis[] = $value['count'];
        }

        
         ?>
         <div class="col-md-8">
          <?=  $this->renderPartial('/graph/bar_graph',['category'=>$category,'year'=>$year,'xaxis'=>$year_xaxis,'yaxis'=>$year_yaxis]); ?>
        </div>
        <div class="col-md-12">
          <?=  $this->renderPartial('/graph/line_graph',['category'=>$category,'xaxis'=>$year_xaxis,'yaxis'=>$year_yaxis]); ?>
        </div>
      </div>
   

      