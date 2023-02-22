
<link href="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />


<style type="text/css">
	tr > th ,td{
	    text-align: center;
	}
	.form-control{
		display: none !important;
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

	.form-group {
	    /*background: wheat none repeat scroll 0 0;*/
	    padding: 25px;
	}


@import "compass/css3";
@import url("http://fonts.googleapis.com/css?family=Lato");

$background: #e74c3c;
$file-upload-color: #c0392b;
$file-upload-size: 300px;

.custom-file-upload-hidden {
    display: none;
    visibility: hidden;
    position: absolute;
    left: -9999px;
}
.custom-file-upload {
    display: block;
    width: auto;
    font-size: 16px;
    margin-top: 30px;
    //border: 1px solid #ccc;
    label {
        display: block;
        margin-bottom: 5px;
    }
}

.file-upload-wrapper {
    position: relative; 
    margin-bottom: 5px;
    /*border: 1px solid #ccc;*/
}
.file-upload-input {
    width: $file-upload-size;
	background: #f0f0f0 none repeat scroll 0 0;
	border: medium none;
	color: #2c3542;
	float: left;
	font-size: 16px;
	padding: 11px 17px;
}
.file-upload-button {
    cursor: pointer; 
    display: inline-block; 
    color: #fff;
    font-size: 16px;
    text-transform: uppercase;
    padding: 11px 20px; 
    border: none;
    margin-left: -1px;  
    float: left;
}
</style>
<?php 
	$uid = $_SESSION['RESPONSE']['user_id'];
	$docModel=new ApplicationCdnMappingExt;
	// echo "<pre>"; print_r($incmplt_fields); die;
?>

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
	                        <i class="fa fa-gift"></i>Land Allotment Form - Step 2
	                    </div>
	                </div>
		            <div class="portlet-body form">
		            	<form class="form-horizontal" action="<?=@Yii::app()->createAbsoluteUrl('/frontuser/landAllotment/stepThree')?>" method="POST" id="submit_form" enctype="multipart/form-data">	
		                    <input type="hidden" class="csrftoken" name="YII_CSRF_TOKEN" value="<?=Yii::app()->getRequest()->getCsrfToken()?>" />
		                    <input type="hidden" class="csrftoken" name="IUID" value="<?=@$_SESSION['RESPONSE']['iuid']?>" />
		                    <input type="hidden" class="csrftoken" name="App_subbmission_id" value="<?=@$sub_id?>" />
		                    <div class="form-wizard">
		                        <div class="form-body">
		            	            <div class="portlet-body form">
		                         		<div class="form-body">
											<ul class="nav nav-pills nav-justified steps">
												<li class="done">
													<a data-toggle="tab" class="step">
														<span class="number"> 1 </span>
														<span class="desc">
														<i class="fa fa-check"></i> Land Detail </span>
													</a>
												</li>
												<li class="active">
													<a href="#tab2" data-toggle="tab" class="step">
														<span class="number"> 2 </span>
														<span class="desc">
														<i class="fa fa-check"></i> Evaluation CheckList</span>
													</a>
												</li>
												<li>
													<a data-toggle="tab" class="step">
														<span class="number"> 3 </span>
														<span class="desc">
														<i class="fa fa-check"></i> Checklist of Documents </span>
													</a>
												</li>
												<!-- <li>
													<a data-toggle="tab" class="step">
														<span class="number"> 4 </span>
														<span class="desc">
														<i class="fa fa-check"></i> Checklist </span>
													</a>
												</li> -->
											</ul>
                			            	<div id="bar" class="progress progress-striped" role="progressbar">
                			            	    <div class="progress-bar progress-bar-success"> </div>
                			            	</div>
                			            	<div class="alert alert-danger alert-message-error display-none">
                	                            <button class="close" data-dismiss="alert"></button> You have some form errors. Please check below.
                	                        </div>
                	                        <div class="alert alert-success alert-message-success display-none">
                	                            <button class="close" data-dismiss="alert"></button> Your form validation is successful!
                	                        </div>
                	                        <?php 
                	                          	foreach(Yii::app()->user->getFlashes() as $key => $message) {
                	                                echo '<div class="alert alert-'.$key.'"><button class="close" data-dismiss="alert"></button> 
                	                                       ' . $message . 
                	                                      '</div>';
                	                                }
                	                        ?>
                	                        <div class="tab-pane active" id="tab2">
			                                    <h3 class="form-section">Questionnaire</h3>
			                                    <div class="row-fluid">
			                                        <div class="col-md-12">
			                                            <div >
			                                            	<?php 
			              										//  $disabled = "disabled";
																	// $disabledClass = "radio-inline-disabled";
			                                            		$docsData = $docModel::getAppStatusByID(10,$uid,8);
																// echo "<pre>"; print_r($docsData); die;
																if(isset($docsData['doc_status']) && isset($docsData['doc_id']) && $docsData['doc_status']=="P"){
																	$disabled = "";
																	$disabledClass = "";
																}
	                                                    		elseif(isset($docsData['doc_status']) && isset($docsData['doc_id']) && $docsData['doc_status']=="R"){
	                                                    			$disabled = "";
	                                                    			$disabledClass = "";
	                                                    		}
	                                                    		else{
	                                                    			$disabled = "";
	                                                    			$disabledClass = "";
	                                                    		}
			                                            	?>
			                                                <label class="control-label">1. Educational Qualification<span class="required" aria-required="true"> * </span></label>
			                                                <div class="col-md-12">
																<div>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="edu_cert_qual" <?php if(isset($incmplt_fields->edu_cert_qual) && $incmplt_fields->edu_cert_qual=="intermediate")  echo "checked='checked'";?> value="intermediate"  > Upto Class 12
																	 <span></span>
																	</label>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="edu_cert_qual" <?php if(isset($incmplt_fields->edu_cert_qual) && $incmplt_fields->edu_cert_qual=="graduation")  echo "checked='checked'";?> value="graduation"  >Graduation
																	 <span></span>
																	</label>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="edu_cert_qual" <?php if(isset($incmplt_fields->edu_cert_qual) && $incmplt_fields->edu_cert_qual=="post_grad_or_above")  echo "checked='checked'";?> value="post_grad_or_above"  >Post-Graduation and Above
																	 <span></span>
																	</label>
																</div>
			                                                </div>
			                                            </div>
			                                        </div>

			                                        <div class="col-md-12">
			                                            <div >
			                                            	<?php 
			                                            		$docsData = $docModel::getAppStatusByID(11,$uid,8);
																// echo "<pre>"; print_r($docsData); die;
																if(isset($docsData['doc_status']) && isset($docsData['doc_id']) && $docsData['doc_status']=="P"){
																	$disabled = "";
																	$disabledClass = "";
																}
	                                                    		elseif(isset($docsData['doc_status']) && isset($docsData['doc_id']) && $docsData['doc_status']=="R"){
	                                                    			$disabled = "";
	                                                    			$disabledClass = "";
	                                                    		}
	                                                    		else{
	                                                    			$disabled = "";
	                                                    			$disabledClass = "";
	                                                    		}
			                                            	?>
			                                                <label class="control-label">2. Technical Qualification<span class="required" aria-required="true"> * </span></label>
			                                                <div class="col-md-12">
																<div>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="edu_tech_qual" <?php if(isset($incmplt_fields->edu_tech_qual) && $incmplt_fields->edu_tech_qual=="none")  echo "checked='checked'";?> value="none"  >None
																	 <span></span>
																	</label>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="edu_tech_qual" <?php if(isset($incmplt_fields->edu_tech_qual) && $incmplt_fields->edu_tech_qual=="iti")  echo "checked='checked'";?> value="iti"  >ITI
																	 <span></span>
																	</label>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="edu_tech_qual" <?php if(isset($incmplt_fields->edu_tech_qual) && $incmplt_fields->edu_tech_qual=="diploma")  echo "checked='checked'";?> value="diploma"  >Diploma
																	 <span></span>
																	</label>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="edu_tech_qual" <?php if(isset($incmplt_fields->edu_tech_qual) && $incmplt_fields->edu_tech_qual=="BE_BTech_MCA_MBA_CA")  echo "checked='checked'";?> value="BE_BTech_MCA_MBA_CA"  >BE / B.Tech / MCA / MBA / CA
																	 <span></span>
																	</label>
																</div>
			                                                </div>
			                                            </div>
			                                        </div>

			                                        <div class="col-md-12">
			                                            <div >
			                                            	<?php 
			                                            		$docsData = $docModel::getAppStatusByID(12,$uid,8);
																// echo "<pre>"; print_r($docsData); die;
																if(isset($docsData['doc_status']) && isset($docsData['doc_id']) && $docsData['doc_status']=="P"){
																	$disabled = "";
																	$disabledClass = "";
																}
	                                                    		elseif(isset($docsData['doc_status']) && isset($docsData['doc_id']) && $docsData['doc_status']=="R"){
	                                                    			$disabled = "";
	                                                    			$disabledClass = "";
	                                                    		}
	                                                    		else{
	                                                    			$disabled = "";
	                                                    			$disabledClass = "";
	                                                    		}
			                                            	?>
			                                                <label class="control-label">3. Professional Experience<span class="required" aria-required="true"> * </span></label>
			                                                <div class="col-md-12">
																<div>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="cert_prof_exp" <?php if(isset($incmplt_fields->cert_prof_exp) && $incmplt_fields->cert_prof_exp=="non_similar")  echo "checked='checked'";?> value="non_similar"  >Experience in Non - Similar Line
																	 <span></span>
																	</label>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="cert_prof_exp" <?php if(isset($incmplt_fields->cert_prof_exp) && $incmplt_fields->cert_prof_exp=="similar")  echo "checked='checked'";?> value="similar"  >Experience in Similar Line
																	 <span></span>
																	</label>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="cert_prof_exp" <?php if(isset($incmplt_fields->cert_prof_exp) && $incmplt_fields->cert_prof_exp=="none")  echo "checked='checked'";?> value="none"  >None
																	 <span></span>
																	</label>
																</div>
			                                                </div>
			                                            </div>
			                                        </div>

			                                        <div class="col-md-12">
			                                            <div >
			                                            	<?php 
	                                                    		$checkA=$checkB=$checkC=$checkD="";
	                                                    		$disA=$disB=$disC=$disD="disabled";
	                                                    		$disAss=$disBss=$disCss=$disDss="radio-inline-disabled";
	                                                    		
																if($incmplt_fields->equityPtage < 19.99) {
																	// die("A");
																	$checkA="checked='checked'";
																	$disA="";
																	$disAss="";
																}
																elseif($incmplt_fields->equityPtage >= 20.00 && $incmplt_fields->equityPtage < 29.99){
																	// die("B");
																	$checkB="checked='checked'";
																	$disB="";
																	$disBss="";
																}
																elseif($incmplt_fields->equityPtage >= 30.00 && $incmplt_fields->equityPtage < 39.99){
																	// die("C");
																	$checkC="checked='checked'";
																	$disC="";
																	$disCss="";
																}
																elseif($incmplt_fields->equityPtage >= 40.00){
																	// die("D");
																	$checkD="checked='checked'";
																	$disD="";
																	$disDss="";
																}
			                                            	?>
			                                                <label class="control-label">4. Equity (If any)</label>
			                                                <div class="col-md-12">
																<div>
																	<label class="radio-inline <?=@$disAss?>">
																	 <input type="radio" <?=@$disA?> <?=@$checkA?> name="cert_equity" value="less_then_19"  > < 19.99%
																	 <span></span>
																	</label>
																	<label class="radio-inline <?=@$disBss?>">
																	 <input type="radio" <?=@$disB?> <?=@$checkB?> name="cert_equity" value="greater_then_12_less_then_29_99"  > >= 20.00% to < 29.99%
																	 <span></span>
																	</label>
																	<label class="radio-inline <?=@$disCss?>">
																	 <input type="radio" <?=@$disC?> <?=@$checkC?> name="cert_equity" value="greater_then_30_less_then_39_99"  > >= 30.00% to < 39.99%
																	 <span></span>
																	</label>
																	<label class="radio-inline <?=@$disDss?>">
																	 <input type="radio" <?=@$disD?> <?=@$checkD?> name="cert_equity" value="greater_then_40"  > >= 40.00%
																	 <span></span>
																	</label>
																</div>
			                                                </div>
			                                            </div>
			                                        </div>

			                                        <div class="col-md-12">
			                                            <div >
			                                            	<?php 
			                                            		$docsData = $docModel::getAppStatusByID(14,$uid,8);
																// echo "<pre>"; print_r($docsData); die;
																if(isset($docsData['doc_status']) && isset($docsData['doc_id']) && $docsData['doc_status']=="P"){
																	$disabled = "";
																	$disabledClass = "";
																}
	                                                    		elseif(isset($docsData['doc_status']) && isset($docsData['doc_id']) && $docsData['doc_status']=="R"){
	                                                    			$disabled = "";
	                                                    			$disabledClass = "";
	                                                    		}
	                                                    		else{
	                                                    			$disabled = "";
	                                                    			$disabledClass = "";
	                                                    		}
			                                            	?>
			                                                <label class="control-label">5. Whether unit approved and sanctioned by Financial Institution / NBFC<span class="required" aria-required="true"> * </span></label>
			                                                <div class="col-md-12">
																<div>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="cert_unit_approv_sanct" <?php if(isset($incmplt_fields->cert_unit_approv_sanct) && $incmplt_fields->cert_unit_approv_sanct=="Yes")  echo "checked='checked'";?> value="Yes"  >Yes
																	 <span></span>
																	</label>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="cert_unit_approv_sanct" <?php if(isset($incmplt_fields->cert_unit_approv_sanct) && $incmplt_fields->cert_unit_approv_sanct=="none")  echo "checked='checked'";?> value="none"  >No
																	 <span></span>
																	</label>
																</div>
			                                                </div>
			                                            </div>
			                                        </div>

			                                        <div class="col-md-12">
			                                            <div >
			                                            	<?php 
			                                            		// echo "<pre>"; print_r($incmplt_fields); die;
	                                                    		$checkA=$checkB=$checkC=$checkD="";
	                                                    		$disA=$disB=$disC=$disD="disabled";
	                                                    		$disAss=$disBss=$disCss=$disDss="radio-inline-disabled";
	                                                    		
																if($incmplt_fields->total_investment > 10000000) {
																	// die("A");
																	$checkA="checked='checked'";
																	$disA="";
																	$disAss="";
																}
																elseif($incmplt_fields->total_investment > 5000000){
																	// die("B");
																	$checkB="checked='checked'";
																	$disB="";
																	$disBss="";
																}
																elseif($incmplt_fields->total_investment > 2500000){
																	// die("C");
																	$checkC="checked='checked'";
																	$disC="";
																	$disCss="";
																}
																elseif($incmplt_fields->total_investment < 2500000){
																	// die("D");
																	$checkD="checked='checked'";
																	$disD="";
																	$disDss="";
																}
			                                            	?>
			                                                <label class="control-label">6. Project Cost<span class="required" aria-required="true"> * </span></label>
			                                                <div class="col-md-12">
																<div>
																	<label class="radio-inline <?=@$disAss?>">
																	 <input type="radio" <?=@$disA?> <?=@$checkA?> required name="cert_project_cost" value="1cr"  >Above 1 crore
																	 <span></span>
																	</label>
																	<label class="radio-inline <?=@$disBss?>">
																	 <input type="radio" <?=@$disB?> <?=@$checkB?> required name="cert_project_cost" value="50lcs"  >Above 50 Lakhs
																	 <span></span>
																	</label>
																	<label class="radio-inline <?=@$disCss?>">
																	 <input type="radio" <?=@$disC?> <?=@$checkC?> required name="cert_project_cost" value="25lcs"  >Above 25 Lakhs
																	 <span></span>
																	</label>
																	<label class="radio-inline <?=@$disDss?>">
																	 <input type="radio" <?=@$disD?> <?=@$checkD?> required name="cert_project_cost" value="below25lcs"  >Below 25 Lakhs
																	 <span></span>
																	</label>
																</div>
			                                                </div>
			                                            </div>
			                                        </div>

			                                        <div class="col-md-12">
			                                            <div >
			                                            	<?php 
			                                            		$docsData = $docModel::getAppStatusByID(16,$uid,8);
																// echo "<pre>"; print_r($docsData); die;
																if(isset($docsData['doc_status']) && isset($docsData['doc_id']) && $docsData['doc_status']=="P"){
																	$disabled = "";
																	$disabledClass = "";
																}
	                                                    		elseif(isset($docsData['doc_status']) && isset($docsData['doc_id']) && $docsData['doc_status']=="R"){
	                                                    			$disabled = "";
	                                                    			$disabledClass = "";
	                                                    		}
	                                                    		else{
	                                                    			$disabled = "";
	                                                    			$disabledClass = "";
	                                                    		}
			                                            	?>
			                                                <label class="control-label">7. Debt Coverage Ratio<span class="required" aria-required="true"> * </span></label>
			                                                <div class="col-md-12">
																<div>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="cert_debt_cover_ratio" <?php if(isset($incmplt_fields->cert_debt_cover_ratio) && $incmplt_fields->cert_debt_cover_ratio=="none")  echo "checked='checked'";?> value="none"  >> 2.00 or Zero (when there is no loan)
																	 <span></span>
																	</label>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="cert_debt_cover_ratio" <?php if(isset($incmplt_fields->cert_debt_cover_ratio) && $incmplt_fields->cert_debt_cover_ratio=="1.70-2.00")  echo "checked='checked'";?> value="1.70-2.00"  >> 1.75 to <= 2.00
																	 <span></span>
																	</label>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="cert_debt_cover_ratio" <?php if(isset($incmplt_fields->cert_debt_cover_ratio) && $incmplt_fields->cert_debt_cover_ratio=="1.50-1.75")  echo "checked='checked'";?> value="1.50-1.75"  >> 1.50 to <= 1.75
																	 <span></span>
																	</label>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="cert_debt_cover_ratio" <?php if(isset($incmplt_fields->cert_debt_cover_ratio) && $incmplt_fields->cert_debt_cover_ratio=="1.25-1.50")  echo "checked='checked'";?> value="1.25-1.50"  >> 1.25 to <= 1.50
																	 <span></span>
																	</label>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="cert_debt_cover_ratio" <?php if(isset($incmplt_fields->cert_debt_cover_ratio) && $incmplt_fields->cert_debt_cover_ratio=="1.00-1.25")  echo "checked='checked'";?> value="1.00-1.25"  >> 1.00 to <= 1.25
																	 <span></span>
																	</label>
																</div>
			                                                </div>
			                                            </div>
			                                        </div>

			                                        <div class="col-md-12">
			                                            <div >
			                                            	<?php 
			                                            		$docsData = $docModel::getAppStatusByID(17,$uid,8);
																// echo "<pre>"; print_r($docsData); die;
																if(isset($docsData['doc_status']) && isset($docsData['doc_id']) && $docsData['doc_status']=="P"){
																	$disabled = "";
																	$disabledClass = "";
																}
	                                                    		elseif(isset($docsData['doc_status']) && isset($docsData['doc_id']) && $docsData['doc_status']=="R"){
	                                                    			$disabled = "";
	                                                    			$disabledClass = "";
	                                                    		}
	                                                    		else{
	                                                    			$disabled = "";
	                                                    			$disabledClass = "";
	                                                    		}
			                                            	?>
			                                                <label class="control-label">8. Pollution Category<span class="required" aria-required="true"> * </span></label>
			                                                <div class="col-md-12">
																<div>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="cert_poll_cat" <?php if(isset($incmplt_fields->cert_poll_cat) && $incmplt_fields->cert_poll_cat=="white")  echo "checked='checked'";?> value="white"  >White
																	 <span></span>
																	</label>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="cert_poll_cat" <?php if(isset($incmplt_fields->cert_poll_cat) && $incmplt_fields->cert_poll_cat=="green")  echo "checked='checked'";?> value="green"  >Green
																	 <span></span>
																	</label>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="cert_poll_cat" <?php if(isset($incmplt_fields->cert_poll_cat) && $incmplt_fields->cert_poll_cat=="orange")  echo "checked='checked'";?> value="orange"  >Orange
																	 <span></span>
																	</label>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="cert_poll_cat" <?php if(isset($incmplt_fields->cert_poll_cat) && $incmplt_fields->cert_poll_cat=="red")  echo "checked='checked'";?> value="red"  >Red
																	 <span></span>
																	</label>
																</div>
			                                                </div>
			                                            </div>
			                                        </div>

			                                        <div class="col-md-12">
			                                            <div >
			                                            	<?php 
			                                            		$docsData = $docModel::getAppStatusByID(18,$uid,8);
																// echo "<pre>"; print_r($docsData); die;
																if(isset($docsData['doc_status']) && isset($docsData['doc_id']) && $docsData['doc_status']=="P"){
																	$disabled = "";
																	$disabledClass = "";
																}
	                                                    		elseif(isset($docsData['doc_status']) && isset($docsData['doc_id']) && $docsData['doc_status']=="R"){
	                                                    			$disabled = "";
	                                                    			$disabledClass = "";
	                                                    		}
	                                                    		else{
	                                                    			$disabled = "";
	                                                    			$disabledClass = "";
	                                                    		}
			                                            	?>
			                                                <label class="control-label">9. Adoption of Water Conservation System<span class="required" aria-required="true"> * </span></label>
			                                                <div class="col-md-12">
																<div>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="cert_adpt_water_system" <?php if(isset($incmplt_fields->cert_adpt_water_system) && $incmplt_fields->cert_adpt_water_system=="yes")  echo "checked='checked'";?> value="yes"  >Yes
																	 <span></span>
																	</label>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="cert_adpt_water_system" <?php if(isset($incmplt_fields->cert_adpt_water_system) && $incmplt_fields->cert_adpt_water_system=="none")  echo "checked='checked'";?> value="none"  >No
																	 <span></span>
																	</label>
																</div>
			                                                </div>
			                                            </div>
			                                        </div>
			                                        
			                                        <div class="col-md-12">
			                                            <div >
			                                            	<?php 
			                                            		$docsData = $docModel::getAppStatusByID(19,$uid,8);
																// echo "<pre>"; print_r($docsData); die;
																if(isset($docsData['doc_status']) && isset($docsData['doc_id']) && $docsData['doc_status']=="P"){
																	$disabled = "";
																	$disabledClass = "";
																}
	                                                    		elseif(isset($docsData['doc_status']) && isset($docsData['doc_id']) && $docsData['doc_status']=="R"){
	                                                    			$disabled = "";
	                                                    			$disabledClass = "";
	                                                    		}
	                                                    		else{
	                                                    			$disabled = "";
	                                                    			$disabledClass = "";
	                                                    		}
			                                            	?>
			                                                <label class="control-label">10. Usage of Local Raw Materials<span class="required" aria-required="true"> * </span></label>
			                                                <div class="col-md-12">
																<div>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="cert_usage_local_materail" <?php if(isset($incmplt_fields->cert_usage_local_materail) && $incmplt_fields->cert_usage_local_materail=="30%")  echo "checked='checked'";?> value="30%"  > For 30% of total raw material
																	 <span></span>
																	</label>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="cert_usage_local_materail" <?php if(isset($incmplt_fields->cert_usage_local_materail) && $incmplt_fields->cert_usage_local_materail=="10%")  echo "checked='checked'";?> value="10%"  >For 10% additional, one mark will be given
																	 <span></span>
																	</label>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="cert_usage_local_materail" <?php if(isset($incmplt_fields->cert_usage_local_materail) && $incmplt_fields->cert_usage_local_materail=="none")  echo "checked='checked'";?> value="none"  >None
																	 <span></span>
																	</label>
																</div>
			                                                </div>
			                                            </div>
			                                        </div>

			                                        <div class="col-md-12">
			                                            <div >
			                                            	<?php 
			                                            		$docsData = $docModel::getAppStatusByID(20,$uid,8);
																// echo "<pre>"; print_r($docsData); die;
																if(isset($docsData['doc_status']) && isset($docsData['doc_id']) && $docsData['doc_status']=="P"){
																	$disabled = "";
																	$disabledClass = "";
																}
	                                                    		elseif(isset($docsData['doc_status']) && isset($docsData['doc_id']) && $docsData['doc_status']=="R"){
	                                                    			$disabled = "";
	                                                    			$disabledClass = "";
	                                                    		}
	                                                    		else{
	                                                    			$disabled = "";
	                                                    			$disabledClass = "";
	                                                    		}
			                                            	?>
			                                                <label class="control-label">11. Whether the unit is registered as a Startup with the Ministry of MSME / DIPP, Government of India<span class="required" aria-required="true"> * </span></label>
			                                                <div class="col-md-12">
																<div>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="cert_regist_startup" <?php if(isset($incmplt_fields->cert_regist_startup) && $incmplt_fields->cert_regist_startup=="yes")  echo "checked='checked'";?> value="yes"  >Yes
																	 <span></span>
																	</label>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="cert_regist_startup" <?php if(isset($incmplt_fields->cert_regist_startup) && $incmplt_fields->cert_regist_startup=="none")  echo "checked='checked'";?> value="none"  >No
																	 <span></span>
																	</label>
																</div>
			                                                </div>
			                                            </div>
			                                        </div>

			                                        <div class="col-md-12">
			                                            <div >
			                                            	<?php 
			                                            		$docsData = $docModel::getAppStatusByID(21,$uid,8);
																// echo "<pre>"; print_r($docsData); die;
																if(isset($docsData['doc_status']) && isset($docsData['doc_id']) && $docsData['doc_status']=="P"){
																	$disabled = "";
																	$disabledClass = "";
																}
	                                                    		elseif(isset($docsData['doc_status']) && isset($docsData['doc_id']) && $docsData['doc_status']=="R"){
	                                                    			$disabled = "";
	                                                    			$disabledClass = "";
	                                                    		}
	                                                    		else{
	                                                    			$disabled = "";
	                                                    			$disabledClass = "";
	                                                    		}
			                                            	?>
			                                                <label class="control-label">12. Whether the proposal is from the family, whose land was acquired for the development of the particular land bank<span class="required" aria-required="true"> * </span></label>
			                                                <div class="col-md-12">
																<div>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="cert_land_acquistion" <?php if(isset($incmplt_fields->cert_land_acquistion) && $incmplt_fields->cert_land_acquistion=="acquired")  echo "checked='checked'";?> value="acquired"  >Yes
																	 <span></span>
																	</label>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="cert_land_acquistion" <?php if(isset($incmplt_fields->cert_land_acquistion) && $incmplt_fields->cert_land_acquistion=="none")  echo "checked='checked'";?> value="none"  >No
																	 <span></span>
																	</label>
																</div>
			                                                </div>
			                                            </div>
			                                        </div>

			                                        <div class="col-md-12">
			                                            <div >
			                                            	<?php 
			                                            		$docsData = $docModel::getAppStatusByID(22,$uid,8);
																// echo "<pre>"; print_r($docsData); die;
																if(isset($docsData['doc_status']) && isset($docsData['doc_id']) && $docsData['doc_status']=="P"){
																	$disabled = "";
																	$disabledClass = "";
																}
	                                                    		elseif(isset($docsData['doc_status']) && isset($docsData['doc_id']) && $docsData['doc_status']=="R"){
	                                                    			$disabled = "";
	                                                    			$disabledClass = "";
	                                                    		}
	                                                    		else{
	                                                    			$disabled = "";
	                                                    			$disabledClass = "";
	                                                    		}
			                                            	?>
			                                                <label class="control-label">13. Type of Enterpreneur<span class="required" aria-required="true"> * </span></label>
			                                                <div class="col-md-12">
																<div>
																	<label class="radio-inline <?=@$disabledClass?>">
                                                                                                                                            <input type="radio" <?=@$disabled?> required name="cert_enterprenure_type" <?php if(isset($incmplt_fields->cert_enterprenure_type) && $incmplt_fields->cert_enterprenure_type=="women")  echo "checked='checked'";?> value="women"  >Women
																	 <span></span>
																	</label>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="cert_enterprenure_type" <?php if(isset($incmplt_fields->cert_enterprenure_type) && $incmplt_fields->cert_enterprenure_type=="army_fighter")  echo "checked='checked'";?> value="army_fighter"  >Retired Army professional and / or Freedom fighters
																	 <span></span>
																	</label>
                                                                                                                                    <label class="radio-inline <?=@$disabledClass?>">
                                                                                                                                      
																	 <input type="radio" <?=@$disabled?> required name="cert_enterprenure_type" <?php if(isset($incmplt_fields->category) && $incmplt_fields->category=="SC/ST/Physically Handicapped")  echo "checked='checked'";?> value="SC/ST/Physically Handicapped"  >SC/ST/Physically Handicapped
																	 <span></span>
																	</label>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="cert_enterprenure_type" <?php if(isset($incmplt_fields->cert_enterprenure_type) && $incmplt_fields->cert_enterprenure_type=="none")  echo "checked='checked'";?> value="none"  >None
																	 <span></span>
																	</label>
																</div>
			                                                </div>
			                                            </div>
			                                        </div>

			                                        <div class="col-md-12">
			                                            <div >
			                                            	<?php 
			                                            		$docsData = $docModel::getAppStatusByID(23,$uid,8);
																// echo "<pre>"; print_r($docsData); die;
																if(isset($docsData['doc_status']) && isset($docsData['doc_id']) && $docsData['doc_status']=="P"){
																	$disabled = "";
																	$disabledClass = "";
																}
	                                                    		elseif(isset($docsData['doc_status']) && isset($docsData['doc_id']) && $docsData['doc_status']=="R"){
	                                                    			$disabled = "";
	                                                    			$disabledClass = "";
	                                                    		}
	                                                    		else{
	                                                    			$disabled = "";
	                                                    			$disabledClass = "";
	                                                    		}
			                                            	?>
			                                                <label class="control-label">14. Type of unit<span class="required" aria-required="true"> * </span></label>
			                                                <div class="col-md-12">
																<div>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="cert_unit_type" <?php if(isset($incmplt_fields->cert_unit_type) && $incmplt_fields->cert_unit_type=="vender")  echo "checked='checked'";?> value="vender"  >Export Oriented and Ancillary / Vendor units for Large and Medium Industries
																	 <span></span>
																	</label>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="cert_unit_type" <?php if(isset($incmplt_fields->cert_unit_type) && $incmplt_fields->cert_unit_type=="none")  echo "checked='checked'";?> value="none"  >If not as above
																	 <span></span>
																	</label>
																</div>
			                                                </div>
			                                            </div>
			                                        </div>

			                                        <div class="col-md-12">
			                                            <div >
			                                            	<?php 
			                                            		$docsData = $docModel::getAppStatusByID(24,$uid,8);
																// echo "<pre>"; print_r($docsData); die;
																if(isset($docsData['doc_status']) && isset($docsData['doc_id']) && $docsData['doc_status']=="P"){
																	$disabled = "";
																	$disabledClass = "";
																}
	                                                    		elseif(isset($docsData['doc_status']) && isset($docsData['doc_id']) && $docsData['doc_status']=="R"){
	                                                    			$disabled = "";
	                                                    			$disabledClass = "";
	                                                    		}
	                                                    		else{
	                                                    			$disabled = "";
	                                                    			$disabledClass = "";
	                                                    		}
			                                            	?>
			                                                <label class="control-label">15. Whether unit is benifited through Central / State Sponsored Schemes<span class="required" aria-required="true"> * </span></label>
			                                                <div class="col-md-12">
																<div>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="cert_unit_benifited" <?php if(isset($incmplt_fields->cert_unit_benifited) && $incmplt_fields->cert_unit_benifited=="yes")  echo "checked='checked'";?> value="yes"  >Yes
																	 <span></span>
																	</label>
																	<label class="radio-inline <?=@$disabledClass?>">
																	 <input type="radio" <?=@$disabled?> required name="cert_unit_benifited" <?php if(isset($incmplt_fields->cert_unit_benifited) && $incmplt_fields->cert_unit_benifited=="none")  echo "checked='checked'";?> value="none"  >No
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
				                                        	<a href="<?=@Yii::app()->createAbsoluteUrl('/frontuser/landAllotment/stepOne')?>" class="btn btn-info"><i class="fa fa-reply"></i> Back</a>
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
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/pages/scripts/form-wizard.min.js" type="text/javascript"></script>

<!-- form repeater js -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/jquery-repeater/jquery.repeater.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/pages/scripts/form-repeater.min.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-datepicker/js/moment.min.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>

<script type="text/javascript">
    // $(document).ready(function(){
    // 	if($("#edu_tech_qual").val()!="none")
    // 		$("#edu_tech_qual_doc").attr('required',true);
    // 	else	
    // 		$("#edu_tech_qual_doc").attr('required',false);
    
    // 	if($("#cert_prof_exp").val()!="none")
    // 		$("#cert_prof_exp_doc").attr('required',true);
    // 	else	
    // 		$("#cert_prof_exp_doc").attr('required',false);
    
    // 	if($("#cert_unit_approv_sanct").val()!="No")
    // 		$("#cert_unit_approv_sanct").attr('required',true);
    // 	else	
    // 		$("#cert_unit_approv_sanct_doc").attr('required',false);
    
    // 	if($("#cert_adpt_water_system").val()!="no")
    // 		$("#cert_adpt_water_system").attr('required',true);
    // 	else	
    // 		$("#cert_adpt_water_system_doc").attr('required',false);
    
    // 	if($("#cert_regist_startup").val()!="no")
    // 		$("#cert_regist_startup").attr('required',true);
    // 	else	
    // 		$("#cert_regist_startup_doc").attr('required',false);
    
    // 	if($("#cert_enterprenure_type").val()!="none_above")
    // 		$("#cert_enterprenure_type").attr('required',true);
    // 	else	
    // 		$("#cert_enterprenure_type_doc").attr('required',false);
    
    // 	if($("#cert_unit_type").val()!="not_above")
    // 		$("#cert_unit_type").attr('required',true);
    // 	else	
    // 		$("#cert_unit_type_doc").attr('required',false);

    // 	if($("#cert_unit_benifited").val()!="no")
    // 		$("#cert_unit_benifited").attr('required',true);
    // 	else	
    // 		$("#cert_unit_benifited_doc").attr('required',false);
    // })

    // $("#edu_tech_qual").on("change",function(){
    // 	if($("#edu_tech_qual").val()!="none")
    // 		$("#edu_tech_qual_doc").attr('required',true);
    // 	else	
    // 		$("#edu_tech_qual_doc").attr('required',false);
    // })

    // $("#cert_prof_exp").on("change",function(){
    // 	if($("#cert_prof_exp").val()!="none")
    // 		$("#cert_prof_exp_doc").attr('required',true);
    // 	else	
    // 		$("#cert_prof_exp_doc").attr('required',false);
    // })

    // $("#cert_unit_approv_sanct").on("change",function(){
    // 	if($("#cert_unit_approv_sanct").val()!="No")
    // 		$("#cert_unit_approv_sanct").attr('required',true);
    // 	else	
    // 		$("#cert_unit_approv_sanct_doc").attr('required',false);
    // })

    // $("#cert_adpt_water_system").on("change",function(){
    // 	if($("#cert_adpt_water_system").val()!="no")
    // 		$("#cert_adpt_water_system").attr('required',true);
    // 	else	
    // 		$("#cert_adpt_water_system_doc").attr('required',false);
    // })

    // $("#cert_regist_startup").on("change",function(){
    // 	if($("#cert_regist_startup").val()!="no")
    // 		$("#cert_regist_startup").attr('required',true);
    // 	else	
    // 		$("#cert_regist_startup_doc").attr('required',false);
    // })

    // $("#cert_enterprenure_type").on("change",function(){
    // 	if($("#cert_enterprenure_type").val()!="none_above")
    // 		$("#cert_enterprenure_type").attr('required',true);
    // 	else	
    // 		$("#cert_enterprenure_type_doc").attr('required',false);
    // })

    // $('input[type=radio][name=cert_unit_type]').on("change",function(){
    // 	if($("#cert_unit_type").val()!="not_above")
    // 		$("#cert_unit_type").attr('required',true);
    // 	else	
    // 		$("#cert_unit_type_doc").attr('required',false);
    // })

    // $('input[type=radio][name=cert_unit_benifited]').on("change",function(){
    // 	if($("#cert_unit_benifited").val()!="no")
    // 		$("#cert_unit_benifited").attr('required',true);
    // 	else	
    // 		$("#cert_unit_benifited_doc").attr('required',false);
    // })
    

	;(function($) {

		  // Browser supports HTML5 multiple file?
		  var multipleSupport = typeof $('<input/>')[0].multiple !== 'undefined',
		      isIE = /msie/i.test( navigator.userAgent );

		  $.fn.customFile = function() {

		    return this.each(function() {

		      var $file = $(this).addClass('custom-file-upload-hidden'), // the original file input
		          $wrap = $('<div class="file-upload-wrapper">'),
		          $input = $('<input type="text" class="file-upload-input" placeholder="Upload Document"/>'),
		          // Button that will be used in non-IE browsers
		          $button = $('<button type="button" class="file-upload-button btn-success" >Select a File</button>'),
		          // Hack for IE
		          $label = $('<label class="file-upload-button btn-success" for="'+ $file[0].id +'">Select a File</label>');

		      // Hide by shifting to the left so we
		      // can still trigger events
		      $file.css({
		        position: 'absolute',
		        left: '-9999px'
		      });

		      $wrap.insertAfter( $file )
		        .append( $file, $input, ( isIE ? $label : $button ) );

		      // Prevent focus
		      $file.attr('tabIndex', -1);
		      $button.attr('tabIndex', -1);

		      $button.click(function () {
		        $file.focus().click(); // Open dialog
		      });

		      $file.change(function() {

		        var files = [], fileArr, filename;

		        // If multiple is supported then extract
		        // all filenames from the file array
		        if ( multipleSupport ) {
		          fileArr = $file[0].files;
		          for ( var i = 0, len = fileArr.length; i < len; i++ ) {
		            files.push( fileArr[i].name );
		          }
		          filename = files.join(', ');

		        // If not supported then just take the value
		        // and remove the path to just show the filename
		        } else {
		          filename = $file.val().split('\\').pop();
		        }

		        $input.val( filename ) // Set the value
		          .attr('title', filename) // Show filename in title tootlip
		          .focus(); // Regain focus

		      });

		      $input.on({
		        blur: function() { $file.trigger('blur'); },
		        keydown: function( e ) {
		          if ( e.which === 13 ) { // Enter
		            if ( !isIE ) { $file.trigger('click'); }
		          } else if ( e.which === 8 || e.which === 46 ) { // Backspace & Del
		            // On some browsers the value is read-only
		            // with this trick we remove the old input and add
		            // a clean clone with all the original events attached
		            $file.replaceWith( $file = $file.clone( true ) );
		            $file.trigger('change');
		            $input.val('');
		          } else if ( e.which === 9 ){ // TAB
		            return;
		          } else { // All other keys
		            return false;
		          }
		        }
		      });

		    });

		  };

		  // Old browser fallback
		  if ( !multipleSupport ) {
		    $( document ).on('change', 'input.customfile', function() {

		      var $this = $(this),
		          // Create a unique ID so we
		          // can attach the label to the input
		          uniqId = 'customfile_'+ (new Date()).getTime(),
		          $wrap = $this.parent(),

		          // Filter empty input
		          $inputs = $wrap.siblings().find('.file-upload-input')
		            .filter(function(){ return !this.value }),

		          $file = $('<input type="file" id="'+ uniqId +'" name="'+ $this.attr('name') +'"/>');

		      // 1ms timeout so it runs after all other events
		      // that modify the value have triggered
		      setTimeout(function() {
		        // Add a new input
		        if ( $this.val() ) {
		          // Check for empty fields to prevent
		          // creating new inputs when changing files
		          if ( !$inputs.length ) {
		            $wrap.after( $file );
		            $file.customFile();
		          }
		        // Remove and reorganize inputs
		        } else {
		          $inputs.parent().remove();
		          // Move the input so it's always last on the list
		          $wrap.appendTo( $wrap.parent() );
		          $wrap.find('input').focus();
		        }
		      }, 1);

		    });
		  }

}(jQuery));

$('input[type=file]').customFile();
</script>