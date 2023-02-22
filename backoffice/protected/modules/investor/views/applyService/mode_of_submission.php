<?php
// @SANTOSH FOR Offline/Online
// Date - 24-10-2017

@extract($_GET);
//$service_id = $service_id;
//$sub_service_id = $sub_service_id;
//$caf_id = $caf_id;
$invData = ApplyServiceExt::getInvestorDetails();
?>
<style>
.mt-element-step .step-thin .mt-step-title a{font-size:14px; font-weight:bold;}
.mt-step-number .bg-white .font-grey{font-size:16px;}
.col-md-2{width:20%;}
a:hover{ color:#000;}
</style>
<div class="portlet-body">
<div class="mt-element-step">
	
	<div class="row step-thin">
	   
		<div class="col-md-2 bg-grey  mt-step-col ">
			<div class="mt-step-number bg-white font-grey">1</div>
			<div class="mt-step-title uppercase font-grey-cascade"><a href="#" >Documents</a></div>
			<div class="mt-step-content font-grey-cascade"> Listing</div>
		</div>
		<div class="col-md-2 bg-grey  mt-step-col ">
			<div class="mt-step-number bg-white font-grey">2</div>
			<div class="mt-step-title uppercase font-grey-cascade"><a href="#" >Statutory</a></div>
			<div class="mt-step-content font-grey-cascade"> Form</div>
		</div>
		 <div class="col-md-2 bg-grey  mt-step-col ">
			<div class="mt-step-number bg-white font-grey">3</div>
			<div class="mt-step-title uppercase font-grey-cascade"><a href="#" >Payment</a></div>
			<div class="mt-step-content font-grey-cascade"> Form</div>
		</div>
		 <div class="col-md-2 bg-grey  mt-step-col ">
			<div class="mt-step-number bg-white font-grey">4</div>
			<div class="mt-step-title uppercase font-grey-cascade"><a href="#" >Application</a></div>
			
			<div class="mt-step-content font-grey-cascade"> Preview</div>
		</div>
		 <div class="col-md-2 bg-green  mt-step-col ">
			<div class="mt-step-number bg-white font-grey">5</div>
			<div class="mt-step-title uppercase font-grey-cascade">
<a href="#" >Mode of</a></div>
			<div class="mt-step-content font-grey-cascade"> Submission</div>
		</div>
		 <!--<div class="col-md-2 bg-grey  mt-step-col ">
			<div class="mt-step-number bg-white font-grey">6</div>
			<div class="mt-step-title uppercase font-grey-cascade"><a href="" >Others</a></div>
			<div class="mt-step-content font-grey-cascade"> Form</div>
		</div> -->
		
	</div>
	
   
</div>
</div>
<form action="" name="form" method="POST">
	<input type="hidden" name="service_id" value='<?php echo $service_id; ?>' />
	<input type="hidden" name="sub_service_id" value='<?php echo $sub_service_id; ?>' />
	<input type="hidden" name="appID" value='<?php echo $appID; ?>' />
<section class="panel site-min-height">
 
  
    <div class="panel-body">
	
		<table class="table table-scrollable table-lg mt-lg mb-0" width="100%">
			<tr>
				<td><b>Name</b></td>
				<td><?php echo $invData['first_name']." ".$invData['last_name']; ?></td>
				<td><b>IUID</b></td>
				<td><?php echo $invData['iuid']; ?></td>
			</tr>
			<tr>
				<td><b>Phone number</b></td>
				<td><?php echo $invData['mobile_number']; ?></td>
				<td><b>CAF ID</b></td>
				<td><?php echo $caf_id; ?></td>
			</tr>
			<tr>
				<td><b>Email ID</b></td>
				<td><?php echo $invData['email']; ?></td>
				<td></td>
				<td></td>
			</tr>
		</table>
		<br>
<div class="form form-horizontal" role="form">
<form name="form" action="" method="POST"  >
	
<div class="row">
	<div class="form-group col-md-12">
	<label class="col-lg-4 col-sm-4 control-label" for="mode_of_submission" >Mode of submission of physical copy :<span class="required" aria-required="true"> * </span></label>
                        <div class="col-md-6" style="padding-top:8px;">
<select name="mode_of_submission" class="form-control" id="mode_of_submission" required >
<option value="">-- Select --</option>
<option value="Self">Self</option>
<option value="Courier">Courier</option>
</select>
		</div></div></div>
		
    <div class="row">                   
	<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="tracking_details" >Tracking Details :<span class="required" aria-required="true"> * </span></label>
                        <div class="col-md-6" style="padding-top:8px;">
						<textarea id="tracking_details" name="tracking_details"  class="form-control" required></textarea>
                            
		</div>
		</div>
		
		
		
		 <div class="row">                   
	<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Date of submission of physical copy of application :<span class="required" aria-required="true"> * </span></label>
                        <div class="col-md-6" style="padding-top:8px;">
						<div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-viewmode="years" data-date-end-date="+0d" id="allot_date">
                                                            <input class="form-control" readonly="" type="text" name="date_of_submission" >
                                                            <span class="input-group-btn">
                                                                <button class="btn default" type="button">
                                                                    <i class="fa fa-calendar"></i>
                                                                </button>
                                                            </span>
                                                        </div>
		</div>
		</div>
		</div>
	
	
	 <div class="row">                   
	<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="submitted_to" >Submitted to<span class="required" aria-required="true"> * </span></label>
                        <div class="col-md-6" style="padding-top:8px;">
						<select name="submitted_to" class="form-control" id="submitted_to" onchange="showUser(this.value)" required >
<option value="">-- Select --</option>
<option value="DIC">DIC</option>
<option value="CSC">CSC</option>
<option value="VLE">VLE</option>
<option value="DEPARTMENT">Department</option>
</select>

		</div>
		</div></div>
		
		<div class="row">                   
	<div class="form-group col-md-12">
			<label class="col-lg-4 col-sm-4 control-label" for="submitted_to" >Name of the Office<span class="required" aria-required="true"> * </span></label>
                        <div class="col-md-6" style="padding-top:8px;" id="name_of_office_div">
						<select class="form-control"  name="name_of_office" id="name_of_office"required ></select>

		</div>
		</div></div>
       
	   
	   
	      
		<!--<p id="hg"></p>-->
      
	<div class="row buttons" align="center">
	<input type="submit" value="Save" class="btn btn-primary" >
	</div>    


</form>

</div></div>

		
	</div>
  
</section>
</form>
    
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/clockface/css/clockface.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->

<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/moment.min.js" type="text/javascript"></script>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/clockface/js/clockface.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=Yii::app()->theme->baseUrl?>/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->


<script>
	/*function showUser(str) { //alert(str); alert("<?php echo Yii::app()->request->baseUrl; ?>/frontuser/offline/submittedAddress"); 
        $.ajax({
                type: "POST",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/frontuser/offline/submittedAddress/type/"+str+"/dist/"+<?php echo "1"; ?>,
				 success:  function(data) 
				 {  
			   $("#hg").append(data);
				//alert(data.toSource());
				},
			
          
            });
   }*/
   
   function showUser(str) { //alert(str); //alert("<?php echo Yii::app()->request->baseUrl; ?>/infowizard/infowizarddocumentchklist/issuermapping"); 
        $.ajax({
                type: "POST",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/frontuser/applyService/getRelatedData",
				dataType:'text',
			    data:
                {
                post_data: str
                },
			   
               success:  function(data) { //alert(data);
					$('#name_of_office_div').html(data);
			   
				},
			
            error:function(jqXHR, textStatus, errorThrown){
                alert('error::'+errorThrown);
            }
            });
}
</script>
