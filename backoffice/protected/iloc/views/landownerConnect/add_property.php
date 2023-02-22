<style>
.errorSummary { color:red }
.control-label{text-align: left !important;}
#content{margin-top: -38px; }
</style>
<?php
/* @var $this LandownerConnectController */
/* @var $model LandownerConnect */
/* @var $form CActiveForm */
?>
<div class='portlet box'>
<div class="col-md-12" style="padding: 0px;">
                                <div class="portlet light portlet-fit">
                                  
                                    <div class="portlet-body" style="padding:10px">
                                        <div class="mt-element-step">
                                           
                                            <div class="row step-background-thin">   
                                                <div class="col-md-4 bg-grey-steel mt-step-col ">
                                                   <a href="/ukswcs/backoffice/iloc/landownerConnect/create">
                                                    <div class="mt-step-number">1</div>
                                                    <div class="mt-step-title uppercase font-grey-cascade ">Land</div>
                                                    <div class="mt-step-content font-grey-cascade">Fill your land details</div>
                                                    </a>
                                                </div>
                                                <div class="col-md-4 bg-grey-steel mt-step-col active">
                                                     <a href="/ukswcs/backoffice/iloc/landownerConnect/addProperty">
                                                    <div class="mt-step-number">2</div>
                                                    <div class="mt-step-title uppercase font-grey-cascade">Contact</div>
                                                    <div class="mt-step-content font-grey-cascade">Fill Contact Person Details</div>
                                                    </a>
                                                </div>
                                                <div class="col-md-4 bg-grey-steel mt-step-col ">
                                                      <a href="/ukswcs/backoffice/iloc/landownerConnect/pinLocation">
                                                    <div class="mt-step-number">3</div>
                                                    <div class="mt-step-title uppercase font-grey-cascade">Map</div>
                                                    <div class="mt-step-content font-grey-cascade">Fill Map Details</div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>


<hr>

<div class="portlet-body">
    <div class="portlet-title" style="">
                                        <div class="caption">
                                            <i class="icon-user font-purple-soft"></i>
                                            <span class="caption-subject font-purple-soft bold uppercase">Contact Detail Form
                                       
                                    </div>
    <hr>
    <div class="tab-pane active" id="tab1" style="background-color:#fff;">
        <div class="col-md-12"><input type="radio">&nbsp; Self</div>
 <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-12"> Name<span class="disabled" aria-disabled="true"> * </span></label>
               <div class="col-md-12">
                  <input id="applicant_name" maxlength="100"  class="form-control lettersonly" value="" name="applicant_name" placeholder="*  Applicant Name" type="text">                                                                   
                  <span class="help-block">  </span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-12">Phone number<span class="disabled" aria-disabled="true"> * </span></label>
                <div class="col-md-12">
                   <input id="company_name" maxlength="100"  class="form-control lettersonly" value="" name="company_name" placeholder="Phone Number" type="text">
                    <span class="help-block"> </span>
                </div>
            </div>
        </div>
        <!--/span-->
    </div>
 <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-12"> Email<span class="disabled" aria-disabled="true"> * </span></label>
                <div class="col-md-12">
                  <input id="applicant_name" maxlength="100"  class="form-control lettersonly" value="" name="applicant_name" placeholder="Email" type="text">                                                                   
                  <span class="help-block">  </span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-12">Alternate Number<span class="disabled" aria-disabled="true"> * </span></label>
                <div class="col-md-12">
                   <input id="company_name" maxlength="100"  class="form-control lettersonly" value="" name="company_name" placeholder="Alternate Number" type="text">
                    <span class="help-block"> </span>
                </div>
            </div>
        </div>
        <!--/span-->
    </div>
         <div class="col-md-12"><input type="radio">&nbsp;On Behalf Of</div>
 <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-12"> Name<span class="disabled" aria-disabled="true"> * </span></label>
                <div class="col-md-12">
                  <input id="applicant_name" maxlength="100"  class="form-control lettersonly" value="" name="applicant_name" placeholder="*  Applicant Name" type="text">                                                                   
                  <span class="help-block">  </span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-12">Phone number<span class="disabled" aria-disabled="true"> * </span></label>
                <div class="col-md-12">
                   <input id="company_name" maxlength="100"  class="form-control lettersonly" value="" name="company_name" placeholder="*  Name of the Company / Unit" type="text">
                    <span class="help-block"> </span>
                </div>
            </div>
        </div>
        <!--/span-->
    </div>
 <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-12"> Email<span class="disabled" aria-disabled="true"> * </span></label>
                <div class="col-md-12">
                  <input id="applicant_name" maxlength="100"  class="form-control lettersonly" value="" name="applicant_name" placeholder="Email" type="text">                                                                   
                  <span class="help-block">  </span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-12">Alternate number<span class="disabled" aria-disabled="true"> * </span></label>
                <div class="col-md-12">
                   <input id="company_name" maxlength="100"  class="form-control lettersonly" value="" name="company_name" placeholder="Alternate number" type="text">
                    <span class="help-block"> </span>
                </div>
            </div>
        </div>
        <!--/span-->
    </div>
         <div class="row application_action_options">
		<div class="col-md-12 text-center" style="top:10px;">
			<div class="form-group">
				<a href="#" id="verify_app" class="btn btn-primary">Save and Proceed</a>
			</div>	
		</div>	
	</div>
    </div>
    </div>
