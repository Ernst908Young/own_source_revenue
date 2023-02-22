<link href="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />


<style type="text/css">
  .help-block.help-block-error.valid {
      margin: 0 !important;
  }
  .help-block.help-block-error {
    background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
    color: red;
    font-weight: 900;
    margin: 21px 0;
    width: -moz-max-content;
  }
  tr > th {
      text-align: center;
  }
  .portlet.light .form .form-body, .portlet.light .portlet-form .form-body{
    padding: 20px;
  }
  .input-group-btn > button {
      margin: 3px 0 0;
  }
  @media(min-width: 992px){
  .raw_material_body_class,.product_manufactured_body_class{
      margin-left: 60px;
  }

  /*.nature_label{
      margin-left: -26px;
      padding-right: 65px;
  }*/
  }
  @media(min-width: 700px){
  .description_detail{
      margin-left: -50px;
      width: 87.4%;   
  }
  }
  .mt-repeater .mt-repeater-item{
    margin-right: 30px;
  }
  a:hover{
    color: #337ab7;
    text-decoration: none;
  }
  a:visited{
    color: #337ab7;
    text-decoration: none; 
  }
  .form-horizontal .form-group.form-md-line-input{
    margin: 0px 0px 0px 0px;
  }
</style>
<?php 
  // echo "<pre>"; print_r($incmplt_fields->district); die;
?>

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="<?=@Yii::app()->createAbsoluteUrl('/frontuser')?>">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Land Allotment</span>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- <div class="m-heading-1  border-green m-bordered">
            <h3>Land Allotment Form</h3>
        </div> -->
        <div class="portlet light bordered" id="form_wizard_1">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-layers font-red"></i>
                    <span class="caption-subject font-red bold uppercase">Fields With * are Mandtory </span>
                </div>
            </div>
            <div class="tab-pane active" id="tab1">
              <div class="portlet box green">
                  <div class="portlet-title">
                      <div class="caption">
                          <i class="fa fa-gift"></i>Land Allotment Payment
                      </div>
                  </div>
                <div class="portlet-body form">
                  <form class="form-horizontal" action="<?=@Yii::app()->createAbsoluteUrl('/frontuser/landAllotment/stepFive')?>" method="POST" id="submit_form">
                        <input type="hidden" class="csrftoken" name="YII_CSRF_TOKEN" value="<?=Yii::app()->getRequest()->getCsrfToken()?>" />
                        <input type="hidden" class="csrftoken" name="App_subbmission_id" value="<?=@$sub_id?>" />
                        <div class="form-wizard">
                            <div class="form-body">
                              <div class="portlet-body form">
                                <div class="form-body">
                                    <div class="alert alert-danger alert-message-error display-none">
                                              <button class="close" data-dismiss="alert"></button> Please correct the error.
                                          </div>
                                          <div class="alert alert-success alert-message-success display-none">
                                              <button class="close" data-dismiss="alert"></button> Your form validation is successful!
                                          </div>
                                          <?php 
                                          // echo "<pre>"; print_r(Yii::app()->user->getFlashes()); die;
                                          if(Yii::app()->user->getFlashes())
                                            foreach(Yii::app()->user->getFlashes() as $key => $message) {
                                                  echo '<div class="alert alert-'.$key.'"><button class="close" data-dismiss="alert"></button> 
                                                      <ul>
                                                         ' . $message . 
                                                         '</ul>
                                                          </div>';
                                                  }

                                            $estateName = LaEstates::model()->findByPk($incmplt_fields->estate);      
                                            $DistrictName = District::model()->findByPk($incmplt_fields->district);      
                                          ?>
                                          <div class="tab-pane active" id="tab1">
                                            <?php
                                                       if($response!='NONE' && $response!='APD'){?>
                                                     <h3 class="form-section">Payment Detail</h3>
                                                     <div class="row">
                                                        <div class="col-md-12">
                                                        <table class="table table-hover">
                                                           <thead>
                                                              <tr>
                                                                 <th>Order Id</th>
                                                                 <th>Transaction Id</th>
                                                                 <th>Status</th>
                                                                 <th>Amount</th>
                                                                 <th>Date Time</th>
                                                              </tr>
                                                           </thead>
                                                           <tbody>
                                                           <?php
                                                              $amount=$response->getTrnAmt()/100;
                                                              $statusCode=$response->getStatusCode();
                                                           ?>
                                                              <tr>
                                                                 <td>
                                                                    <?=@$response->getOrderId();?>
                                                                 </td>
                                                                  <td>
                                                                    <?=@$response->getPgMeTrnRefNo();?>
                                                                 </td>
                                                                  <td>
                                                                    <?=@$response->getStatusDesc();?>
                                                                 </td>
                                                                  <td>
                                                                    <?=@$amount;?>
                                                                 </td>
                                                                  <td>
                                                                    <?=@$response->getTrnReqDate();?>
                                                                 </td>
                                                              </tr>
                                                           </tbody>
                                                        </table>
                                                        </div>
                                                     </div>
                                                     <?php } 
                                                       if($response=='APD'){?>
                                                     <h3 class="form-section">Payment Detail</h3>
                                                     <div class="row">
                                                        <div class="col-md-12">
                                                        <table class="table table-hover">
                                                           <thead>
                                                              <tr>
                                                                 <th>Order Id</th>
                                                                 <th>Transaction Id</th>
                                                                 <th>Status</th>
                                                                 <th>Amount</th>
                                                                 <th>Date Time</th>
                                                              </tr>
                                                           </thead>
                                                           <tbody>
                                                           <?php
                                                              $amount=$detail->amount/100;
                                                              $statusCode=$detail->statusCode;
                                                           ?>
                                                              <tr>
                                                                 <td>
                                                                    <?=@$detail->orderId;?>
                                                                 </td>
                                                                  <td>
                                                                    <?=@$detail->pgMeTrnRefNo;?>
                                                                 </td>
                                                                  <td>
                                                                    <?=@$detail->status_description;?>
                                                                 </td>
                                                                  <td>
                                                                    <?=@$amount;?>
                                                                 </td>
                                                                  <td>
                                                                    <?=@$detail->trnReqDate;?>
                                                                 </td>
                                                              </tr>
                                                           </tbody>
                                                        </table>
                                                        </div>
                                                     </div>
                                                     <?php }?>
                                          <h3 class="form-section">Declaration</h3>
                                          <div class="row">
                                              <div class="col-md-12">
                                                  <p>
                                                    To,<br>
                                                    General Manager<br>
                                                    District Industries Centre<br>
                                                   <?=@$DistrictName->distric_name;?>, Uttarakhand
                                                  </p>

                                                  <p align="justify">
I/We after carefully reading the integrated Policy for Land / Shed Allotment in state Industrial Estates are hereby submitting our application for allotment in <b> <?=@$estateName->land_estate_name;?> </b> (Estate), <b> <?=@$DistrictName->distric_name;?> </b> (District), Uttarakhand. I / We will establish the Industry as per the schedule mentioned in the guidelines. I also declare that I will abide by the terms and conditions mentioned in Lease Deed to be executed between Allottee and the Allotment Agency.



                                                  
                                                  </p>

                                                 
                                                  <br><br>

<a href="#">Land Allotment Policy</a> &nbsp; &nbsp;&nbsp;&nbsp; <a href="https://caipotesturl.com/themes/backend/uploads/DOI_LAND_LEASE_DEED.pdf" target="_blank">Land Allotment Deed</a>

                                                  <div class="form-group">
                                                    <div class="col-md-12">
                                                      <div class="mt-checkbox-list">
                                                        <label class="mt-checkbox">
                                                          <input type="checkbox" name="accept_term" required>I Agree
                                                          <span></span>
                                                        </label>
                                                      </div>
                                                    </div>
                                                  </div>
                                              </div>
                                          </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                  <a href="<?=@Yii::app()->createAbsoluteUrl('/frontuser/landAllotment/stepThree')?>" class="btn btn-info"><i class="fa fa-reply"></i> Back</a>
                                                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                  </div>       
                              </div>
                          </div>
                        </div>
                    </form>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=Yii::app()->theme->baseUrl?>/assets/pages/scripts/form-wizard.min.js" type="text/javascript"></script>
<!-- form repeater js -->
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/jquery-repeater/jquery.repeater.js" type="text/javascript"></script>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/pages/scripts/form-repeater.min.js" type="text/javascript"></script>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/bootstrap-datepicker/js/moment.min.js" type="text/javascript"></script>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){
        $(".date-picker").datepicker({
            rtl: App.isRTL(),
            autoclose: !0,
            startDate: "dateToday",
            format: 'd-MM-yyyy',
            useCurrent: false,
        })
    });
</script>