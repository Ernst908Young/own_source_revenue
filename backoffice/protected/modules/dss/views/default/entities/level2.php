<?php $basePath="/themes/investuk"; ?>
<div class="form-row row">
        <div class="col-md-4 form-group">
            <div class="counter-item bord-3" style=" box-shadow: 2px 2px 5px #1683c6;">         
              <div class="data-counter">
                  <div class="counter-left">
                      <span>Total No. of Registered Entities</span>
                      <span class="counter-number font-montserrat">
                         <?php $total = $data_array['active_entity']['count']+$data_array['dissolved_entity']['count']+$data_array['amalgamated_entity']['count']+$data_array['closed_entity']['count'];
                         echo $total ?>
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
                         <?= $data_array['active_entity']['count'] ?>
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
                         <?= $data_array['dissolved_entity']['count'] ?>
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
                         <?= $data_array['amalgamated_entity']['count'] ?>
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
                         <?= $data_array['closed_entity']['count'] ?>
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
        <div class="col-md-6">
           <?php 
         
          $a_per =  $d_per = $am_per = $c_per =0;
          if($total>0){
            $a_per = round(($data_array['active_entity']['count']/$total)*100,2);
            $d_per = round(($data_array['dissolved_entity']['count']/$total)*100,2);
            $am_per = round(($data_array['amalgamated_entity']['count']/$total)*100,2);
            $c_per = round(($data_array['closed_entity']['count']/$total)*100,2);
           
          }
          

           $xaxis = ["Active Entity","Dissolved Entity",'Amalgamated Entity','Closed Entity'];
          $yaxis = [$a_per,$d_per,$am_per,$c_per];  

          $this->renderPartial('/graph/pie_graph',['category'=>$category,'xaxis'=>$xaxis,'yaxis'=>$yaxis,'data_array'=>$data_array,'sub_category'=>$sub_category]); ?>


        </div>
        <div class="col-md-6">
          
        </div>

         
      </div>
   

      