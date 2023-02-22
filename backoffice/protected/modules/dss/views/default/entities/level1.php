<?php $basePath="/themes/investuk"; ?>
<div class="form-row row">
        <div class="col-md-4 form-group">
            <div class="counter-item bord-3" style=" box-shadow: 2px 2px 5px #1683c6;">         
              <div class="data-counter">
                  <div class="counter-left">
                      <span>Total no. of registered entities</span>
                      <span class="counter-number font-montserrat">
                         <?php $total =  $data_array['active_entity']+$data_array['dissolved_entity']+$data_array['amalgamated_entity']+$data_array['closed_entity'];
                         echo $total
                          ?>
                      </span>
                      <div class="counter-icon">
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/total-entities-white.png">
                      </div>
                  </div>
              </div>         
          </div>
        </div>
        <div class="col-md-4 form-group">
            <div class="counter-item bord-3" style=" box-shadow: 2px 2px 5px #1683c6;">         
              <div class="data-counter">
                  <div class="counter-left">
                      <span>Total No. of Active Entities</span>
                      <span class="counter-number font-montserrat">
                         <?= $data_array['active_entity'] ?>
                      </span>
                      <div class="counter-icon">
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/active-entities.png">
                      </div>
                  </div>
              </div>         
          </div>
        </div>
        <div class="col-md-4 form-group">
            <div class="counter-item bord-3" style=" box-shadow: 2px 2px 5px #1683c6;">         
              <div class="data-counter">
                  <div class="counter-left">
                      <span>Total No. of Dissolved Entities</span>
                      <span class="counter-number font-montserrat">
                         <?= $data_array['dissolved_entity'] ?>
                      </span>
                      <div class="counter-icon">
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/dissolved-entities.png">
                      </div>
                  </div>
              </div>         
          </div>
        </div>
        <div class="col-md-4 form-group">
            <div class="counter-item bord-3" style=" box-shadow: 2px 2px 5px #1683c6;">         
              <div class="data-counter">
                  <div class="counter-left">
                      <span>Total No. of Amalgamated Entities</span>
                      <span class="counter-number font-montserrat">
                         <?= $data_array['amalgamated_entity'] ?>
                      </span>
                      <div class="counter-icon">
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/amalgamated-entities.png">
                      </div>
                  </div>
              </div>         
          </div>
        </div>
        <div class="col-md-4 form-group">
            <div class="counter-item bord-3" style=" box-shadow: 2px 2px 5px #1683c6;">         
              <div class="data-counter">
                  <div class="counter-left">
                      <span>Total No. of Closed Entities</span>
                      <span class="counter-number font-montserrat">
                         <?= $data_array['closed_entity'] ?>
                      </span>
                      <div class="counter-icon">
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/closed-entities.png">
                      </div>
                  </div>
              </div>         
          </div>
        </div>
      </div>

      
        <div class="form-row row">
        <div class="col-md-4">
         
          <?php 
          $pie_data = $data_array['entity_category_wise'];
          $com_per =  $sco_per = $cha_per = $frm_per =  $bus_per =0;
          if($pie_data['total_reg']>0){
            $com_per = round(($pie_data['reg_comp']/$pie_data['total_reg'])*100,2);
            $sco_per = round(($pie_data['reg_society']/$pie_data['total_reg'])*100,2);
            $cha_per = round(($pie_data['reg_charity']/$pie_data['total_reg'])*100,2);
            $frm_per = round(($pie_data['reg_firm']/$pie_data['total_reg'])*100,2);
            $bus_per = round(($pie_data['reg_bus_name']/$pie_data['total_reg'])*100,2);
          }
          

           $xaxis = ["Companies","Societies",'Charities','Firms','Business Names'];
          $yaxis = [$com_per,$sco_per,$cha_per,$frm_per,$bus_per];  

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
   

      