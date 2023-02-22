<?php $basePath="/themes/investuk"; 

$total_icon =$open_icon = $close_icon =$rever_icon =$reopen_icon =$esc_icon ='';

if($sub_category=='tickets'){
  $total_icon = "tickets/total-tickets.png";
  $open_icon = "tickets/open-tickets.png"; 
  $close_icon = "tickets/resolved-closed-tickets.png";
  $rever_icon = "tickets/reverted-tickets.png";
  $reopen_icon = "tickets/Re-opened-tickets.png";
  $esc_icon = "tickets/Escalated-tickets.png";
}
if($sub_category=='grievances'){
  $total_icon = "grievances/total-grievances.png";
  $open_icon = "grievances/Open-grievances.png";
  $close_icon = "grievances/resolved-Closed-grievances.png";
  $rever_icon = "grievances/Reverted-grievances.png";
  $reopen_icon = "grievances/Re-opened-grievances.png";
  $esc_icon = "grievances/Escalated-grievances.png";
}
if($sub_category=='queries'){
  $total_icon = "queries/total-queries.png";
  $open_icon = "queries/Open-queries.png";
  $close_icon = "queries/Closed-queries.png";  
}
?>
<div class="form-row row">
    <div class="col-md-4 form-group">
            <div class="counter-item bord-3" style=" box-shadow: 2px 2px 5px #1683c6;">         
              <div class="data-counter">
                  <div class="counter-left">
                      <span>Total No. <?= $sub_category ?></span>
                      <span class="counter-number font-montserrat">
                         <?= $data_array['count'] ?>
                      </span>
                      <div class="counter-icon">
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/<?= $total_icon ?>">
                      </div>
                  </div>
              </div>         
          </div>
        </div>
        <div class="col-md-4 form-group">
            <div class="counter-item bord-3" style=" box-shadow: 2px 2px 5px #1683c6;">         
              <div class="data-counter">
                  <div class="counter-left">
                      <span>Total No. of Open <?= $sub_category ?></span>
                      <span class="counter-number font-montserrat">
                          <?= $data_array['open'] ?>
                      </span>
                      <div class="counter-icon">
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/<?= $open_icon ?>">
                      </div>
                  </div>
              </div>         
          </div>
        </div>
        <div class="col-md-4 form-group">
            <div class="counter-item bord-3" style=" box-shadow: 2px 2px 5px #1683c6;">         
              <div class="data-counter">
                  <div class="counter-left">
                      <span>Total No. of Resolved/Closed <?= $sub_category ?></span>
                      <span class="counter-number font-montserrat">
                         <?= $data_array['resol_close'] ?>
                      </span>
                      <div class="counter-icon">
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/<?= $close_icon ?>">
                      </div>
                  </div>
              </div>         
          </div>
        </div>
        <?php if($sub_category!='queries'){ ?>
        <div class="col-md-4 form-group">
            <div class="counter-item bord-3" style=" box-shadow: 2px 2px 5px #1683c6;">         
              <div class="data-counter">
                  <div class="counter-left">
                      <span>Total of Reverted <?= $sub_category ?></span>
                      <span class="counter-number font-montserrat">
                         <?= $data_array['rever'] ?>
                      </span>
                      <div class="counter-icon">
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/<?= $rever_icon ?>">
                      </div>
                  </div>
              </div>         
          </div>
        </div>

        <div class="col-md-4 form-group">
            <div class="counter-item bord-3" style=" box-shadow: 2px 2px 5px #1683c6;">         
              <div class="data-counter">
                  <div class="counter-left">
                      <span>Total No. of Re-opened <?= $sub_category ?></span>
                      <span class="counter-number font-montserrat">
                         <?= $data_array['reopen'] ?>
                      </span>
                      <div class="counter-icon">
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/<?= $reopen_icon ?>">
                      </div>
                  </div>
              </div>         
          </div>
        </div>
        <div class="col-md-4 form-group">
            <div class="counter-item bord-3" style=" box-shadow: 2px 2px 5px #1683c6;">         
              <div class="data-counter">
                  <div class="counter-left">
                      <span>Total No. of Escalated <?= $sub_category ?></span>
                      <span class="counter-number font-montserrat">
                         <?= $data_array['esc'] ?>
                      </span>
                      <div class="counter-icon">
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/dss_icons/<?= $esc_icon ?>">
                      </div>
                  </div>
              </div>         
          </div>
        </div>
      <?php } ?>
        
     
      </div>

     
     
        <div class="form-row row">
        <div class="col-md-6">
          <?php
          if($sub_category!='queries'){
              $o_per =  $c_per = $rev_per = $reo_per = $esc_per = 0;
                if($data_array['count']>0){
                  $o_per = round(($data_array['open']/$data_array['count'])*100,2);
                  $c_per = round(($data_array['resol_close']/$data_array['count'])*100,2);
                  $rev_per = round(($data_array['rever']/$data_array['count'])*100,2);
                  $reo_per = round(($data_array['reopen']/$data_array['count'])*100,2);
                  $esc_per = round(($data_array['esc']/$data_array['count'])*100,2);
                 
                }
                
                 $xaxis = ["Total no. of Open","Total no. of Resolved/Closed",'Total no. of Reverted','Total no. of Re-opened','Total no. of Escalated'];

                 $yaxis = [$o_per,$c_per,$rev_per,$reo_per,$esc_per]; 
          }else{
              $o_per =  $c_per = 0;
                if($data_array['count']>0){
                  $o_per = round(($data_array['open']/$data_array['count'])*100,2);           
                 $c_per = round(($data_array['resol_close']/$data_array['count'])*100,2);
                 
                }           

             $xaxis = ["Total no. of Open","Total no. of Resolved/Closed"];
             $yaxis = [$o_per,$c_per]; 
          }

           $this->renderPartial('/graph/pie_graph',['category'=>$category,'xaxis'=>$xaxis,'yaxis'=>$yaxis,'data_array'=>$data_array,'sub_category'=>$sub_category]);

            ?>
        </div>
    
       
     
      </div>
     
      