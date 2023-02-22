<link href="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />


<style type="text/css">
	label{
		text-align: left !important;
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
	// $incmplt_fields = json_decode($paymentModal->payment_detail);
	// // echo "<pre>"; print_r($incmplt_fields); die;
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
                	                            <button class="close" data-dismiss="alert"></button> You have some form errors. Please check below.
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
                	                        ?>
                	                        <div class="tab-pane active" id="tab1">
			                                    <h3 class="form-section">Payment Detail</h3>
			                                    <div class="row">
			                                        <div class="col-md-6">
			                                            <div class="form-group">
			                                                <label class="control-label col-md-12">Payment Mode<span class="required" aria-required="true"> * </span></label>
			                                                <div class="col-md-12">
			                                                  <select id="payment_mode" required class="form-control" name="payment_mode">
			                                                  	<option value="">---Please Select Payment Mode---</option>
			                                                  	<option value="DD" <?php if(isset($incmplt_fields->payment_mode) && $incmplt_fields->payment_mode == "DD") echo "selected";?>>Demand Draft</option>
			                                                  	<option value="Cheque" <?php if(isset($incmplt_fields->payment_mode) && $incmplt_fields->payment_mode == "Cheque") echo "selected";?>>Cheque</option>
			                                                  	<option value="Challan" <?php if(isset($incmplt_fields->payment_mode) && $incmplt_fields->payment_mode == "Challan") echo "selected";?>>Challan</option>
			                                                  </select>
			                                                  <span class="help-block">  </span>
			                                                </div>
			                                            </div>
			                                        </div>
			                                        <div class="col-md-6">
			                                            <div class="form-group">
			                                                <label class="control-label col-md-12">Payment Date<span class="required" aria-required="true"> * </span></label>
			                                                <div class="col-md-12">
          	                                                  <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
          		                                               	<span class="input-group-btn">
          	                                                        <button class="btn btn-sm default" type="button">
          	                                                            <i class="fa fa-calendar"></i>
          	                                                        </button>
          	                                                    </span>
          	                                                    <input type="text" id="payment_date" required class="form-control form-filter input-sm" value="<?=@$incmplt_fields->payment_date?>" readonly name="payment_date" placeholder="* Payment Date">
                                                              </div>
			                                                  <span class="help-block">  </span>
			                                                </div>
			                                            </div>
			                                        </div>
			                                    </div>
			                                    <div class="row">
			                                    	<div class="col-md-6">
			                                            <div class="form-group">
			                                                <label class="control-label col-md-12">Chq/DD/Challan Number<span class="required" aria-required="true"> * </span></label>
			                                                <div class="col-md-12">
			                                                  <input type="text" id="chq_dd_challan_number" required class="form-control" value="<?=@$incmplt_fields->chq_dd_challan_number?>" name="chq_dd_challan_number" placeholder="* Chq/DD/Challan number">
			                                                  <span class="help-block">  </span>
			                                                </div>
			                                            </div>
			                                        </div>
			                                        <div class="col-md-6">
			                                            <div class="form-group">
			                                                <label class="control-label col-md-12">Payment Bank Name<span class="required" aria-required="true"> * </span></label>
			                                                <div class="col-md-12">
			                                                  <?php 
																$criteria=new CDbCriteria;
																$criteria->select="bank_id,bank_name";
																$criteria->condition="is_active=:status";
																$criteria->params=array(":status"=>"Y");
																$banks=BankMaster::model()->findAll($criteria);
			                                                  ?>
			                                                  <select id="payment_bank" required class="form-control" name="payment_bank">
			                                                  	<option value="">---Please Select Bank---</option>
			                                                  	 <?php 
			                                                  	 if(!empty($banks))
			                                                  	 	foreach ($banks as $k => $v){
			                                                  	 		if($v->bank_id == $incmplt_fields->payment_bank)
			                                                  	 			$sel = "selected";
			                                                  	 		else
			                                                  	 			$sel = "";
			                                                  	 		echo "<option $sel value='$v->bank_id'>$v->bank_name</option>";
			                                                  	 	}
			                                                  	?>
			                                                  </select>
			                                                  <span class="help-block">  </span>
			                                                </div>
			                                            </div>
			                                        </div>
			                                    </div>
				                                <div class="form-actions">
				                                    <div class="row">
				                                        <div class="col-md-12 text-center">
				                                        	<a href="<?=@Yii::app()->createAbsoluteUrl('/frontuser/landAllotment/stepThree')?>" class="btn btn-info"><i class="fa fa-reply"></i> Back</a>
				                                            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save & Next</button>
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
            // startDate: "dateToday",
            format: 'd-MM-yyyy',
            useCurrent: false,
        })
    });
</script>