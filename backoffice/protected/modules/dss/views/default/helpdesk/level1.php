<?php $basePath="/themes/investuk"; ?>
<div class="form-row row">
        <div class="col-md-4 form-group">
            <div class="counter-item bord-3" style=" box-shadow: 2px 2px 5px #1683c6;">         
              <div class="data-counter">
                  <div class="counter-left">
                      <span>Total No. of Tickets</span>
                      <span class="counter-number font-montserrat">
                         <?= $data_array['t_count'] ?>
                      </span>
                      <div class="counter-icon">
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/Tickets.png">
                      </div>
                  </div>
              </div>         
          </div>
        </div>
        <div class="col-md-4 form-group">
            <div class="counter-item bord-3" style=" box-shadow: 2px 2px 5px #1683c6;">         
              <div class="data-counter">
                  <div class="counter-left">
                      <span>Total No. of Grievances</span>
                      <span class="counter-number font-montserrat">
                         <?= $data_array['g_count'] ?>
                      </span>
                      <div class="counter-icon">
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/grievances-white.png">
                      </div>
                  </div>
              </div>         
          </div>
        </div>
        <div class="col-md-4 form-group">
            <div class="counter-item bord-3" style=" box-shadow: 2px 2px 5px #1683c6;">         
              <div class="data-counter">
                  <div class="counter-left">
                      <span>Total No. of Queries</span>
                      <span class="counter-number font-montserrat">
                         <?= $data_array['q_count'] ?>
                      </span>
                      <div class="counter-icon">
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/queries-total.png">
                      </div>
                  </div>
              </div>         
          </div>
        </div>
     
      </div>

     
       
       <div class="form-row row">
        <div class="col-md-4">
          <?php

          $total_hd = $data_array['t_count'] + $data_array['g_count'] + $data_array['q_count'];
          $t_per =  $g_per = $q_per =0;
          if($total_hd>0){
            $t_per = round(($data_array['t_count']/$total_hd)*100,2);
            $g_per = round(($data_array['g_count']/$total_hd)*100,2);
            $q_per = round(($data_array['q_count']/$total_hd)*100,2);
           
          }
          

          $xaxis = ["Total No. of Tickets","Total No. of Grievances",'Total No. of Queries'];
          $yaxis = [$t_per,$g_per,$q_per];  

            $this->renderPartial('/graph/donut_graph',['category'=>$category,'xaxis'=>$xaxis,'yaxis'=>$yaxis]); ?>
        </div>
        <?php $year_xaxis = $year_t_yaxis = $year_g_yaxis = $year_q_yaxis = [];

        foreach ($data_array['year_data']['t_year_data'] as $key => $value) {
          $year_xaxis[] = $value['year'];
          $year_t_yaxis[] = $value['count'];
          $year_g_yaxis[] = $data_array['year_data']['g_year_data'][$key]['count'];
          $year_q_yaxis[] = $data_array['year_data']['q_year_data'][$key]['count'];
        }

         ?>
        
        <div class="col-md-8">
           <?=  $this->renderPartial('/graph/multibar_graph',['category'=>$category,'xaxis'=>$year_xaxis,'t_yaxis'=>$year_t_yaxis,'g_yaxis'=>$year_g_yaxis,'q_yaxis'=>$year_q_yaxis,'year'=>$year]); ?>
          
        
        </div>
        <div class="col-md-12">
            <?=  $this->renderPartial('/graph/multiline_graph',['category'=>$category,'xaxis'=>$year_xaxis,'t_yaxis'=>$year_t_yaxis,'g_yaxis'=>$year_g_yaxis,'q_yaxis'=>$year_q_yaxis,'year'=>$year]); ?>
        </div>
      </div>
      