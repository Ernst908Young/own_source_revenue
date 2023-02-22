<?php $basePath="/themes/investuk"; ?>
<div class="form-row row">
        <div class="col-md-4 form-group">
            <div class="counter-item bord-3" style=" box-shadow: 2px 2px 5px #1683c6;">         
              <div class="data-counter">
                  <div class="counter-left">
                      <span>Total No. of Tickets</span>
                      <span class="counter-number font-montserrat">
                         14500
                      </span>
                      <div class="counter-icon">
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/icons/payment due_hover.png">
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
                         14500
                      </span>
                      <div class="counter-icon">
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/icons/payment due_hover.png">
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
                         14500
                      </span>
                      <div class="counter-icon">
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/icons/payment due_hover.png">
                      </div>
                  </div>
              </div>         
          </div>
        </div>
     
      </div>

      <?php  
      $colors = Colorpicker::getcolor(5);
      $colors = json_encode($colors);

      if(isset($sub_category)){   ?>
          <div class="form-row row">       
            <div class="col-md-6">
              <?=  $this->renderPartial('/graph/pie_graph',['colors'=>$colors,'category'=>$category,'sub_category'=>$sub_category]); ?>
            </div>
          </div>
     <?php }else{ ?>
        <div class="form-row row">
        <div class="col-md-4">
          <?=  $this->renderPartial('/graph/donut_graph',['colors'=>$colors,'category'=>$category]); ?>
        </div>
         <div class="col-md-8">
          <?=  $this->renderPartial('/graph/bar_graph',['colors'=>$colors,'category'=>$category]); ?>
        </div>
        <div class="col-md-12">
          <?=  $this->renderPartial('/graph/line_graph',['colors'=>$colors,'category'=>$category]); ?>
        </div>
      </div>
      <?php } ?>

      