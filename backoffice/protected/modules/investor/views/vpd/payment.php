<title>VPD Payment Page</title>
<style type="text/css">
#overlay {
    position: fixed;
  top:0%;
  left:0%;
  width:100%;
  height:100%;  
  background: black;
  opacity: .2;
}
#overlay_text{
   width: 50px;
    height: 57px;
    position: absolute;
    top: 50%;
    left: 50%;
    margin: -28px 0 0 -25px;   
    font-size: 25px;
    opacity: 10;
}
 .form-part.bussiness-det .form-group > div {
    margin-bottom: 0px;
}
.form-control-feedback{
  color: red;
}
</style>

<div id="overlay" style="display: none;">
  <div id="overlay_text" style="color: red;">
      <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
      <span class="sr-only">Loading...</span>
  </div>
</div>

<div class="dashboard-home">
  <div class="applied-status">
    <ul class="breadcrumb">
      <li><a href="/backoffice/investor/home/investorWalkthrough">Home</a></li>   
      <li>VPD</li>
      <li>Payment Form</li>
    </ul>
  </div>
<div class="reservation-form">  
    <div class="form-part bussiness-det">   
        <h4 class="form-heading">VPD Payment Form</h4>
		  <form id="spp_form" method="post" action="<?php echo Yii::app()->createAbsoluteUrl("/investor/vpd/paymentsave"); ?>">
		  	
		  	<div class="form-row row">
		  		
                <div class="form-group col-md-6 text-start mb-3">  
                   <?php 
               $app_details = Yii::app()->db->createCommand("SELECT *, CONCAT(up.first_name,' ',up.last_name,' ',up.surname) as name, u.mobile_no, u.email
  FROM sso_users u 
    INNER JOIN sso_profiles up on u.user_id=up.user_id
       where u.user_id=".$user_id)->queryRow(); 
                   ?>             
                      <label>Applicant Name</label>
                       <?php
                          $app_name = $app_details['name'];
                       ?>
                     <input type="text" class="form-control" readonly value="<?= $app_name ?>">           
                </div>
                <div class="form-group col-md-6 text-start mb-3">                  
                      <label>Applicant Email ID</label>
                      <?php                      
                        $app_email = $app_details['email'];
                       ?>
                      <input type="text" class="form-control" readonly value="<?= $app_email ?>">
                </div>  

                <table class="table table-bordered">
                  <tr>
                    <th>Sr. No.</th>  
                    <th>Entity Name</th>
                    <th>Document Category</th>
                    <th>Document Name</th>
                    <th>Fees (BBD$)</th>
                  </tr>
                  <?php $i = 1;
  foreach($model  as $key => $v){  ?>
      <tr>
        <td>                  
            <?= $key+1 ?>
            <input type="hidden" name="vpd_id[]" value="<?= $v['id'] ?>">
          </td>
          <td>
            <?= $v['company_name'] ?> 
          </td>
          <td>
            <?= $v['core_service_name'] ?>
          </td>
          <td>
            <?= $v['ser_name_for_documentname'] ?>
            <?php if($v['doc_name']=='certificate'){
                  echo 'Certificate';
                }else{
                  echo 'Application Form';
                }
                ?>
          </td>
          <td>
            5
          </td>
        
          
        </tr>       
  <?php   } ?>
  <tr>
    <td colspan="4" style="text-align: right;">
      <b>Total Fees Amount</b>
    </td>
    <td>
      <b><?php echo sizeof($model)*5; ?></b>
    </td>
  </tr>
                </table>
       
		  	
		 	</div>
		 <div class="form-row row"> 
       <div class="d-flex justify-content-center">
     
        <div class="mx-2">
  			    <button type="submit" class="btn btn-secondary" title="Persons can make payment at the Cashier's booth at our Office located at Baobab Tower, Warrens, St. Michael. This facility is available to persons who do not have access to credit card or debit payment facilities. Persons must book an appointment to visit our Office via https://booking.appointy.com/en-US/caiposearch/bookings/service.">
              PAY AT COUNTER                              
            </button>
        </div>
         <div class="mx-2">
            <a class="btn btn-primary backbtn mx-2" href="javascript:;" onclick="window.history.go(-1);">Back</a> 
                     
        </div>        
      </div>
    </div>
		  </form>
		</div>
	</div>
</div>