		<?php 
		/**
		*@author: Rahul Kumar
		*@date: 02032018
		*/
		extract(@$pre_field); $document=0; 		   
		?>
		<!-- BEGIN PAGE LEVEL PLUGINS -->
		<link href="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
		<link href="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
		<link href="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
		<style type="text/css">
		  .portlet.light .form .form-body, .portlet.light .portlet-form .form-body{
			padding: 20px;
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
		<!-- END PAGE LEVEL PLUGINS -->
		<!--<div class="page-bar">
		<ul class="page-breadcrumb">
		<li>
		<a href="index.html">Home</a>
		<i class="fa fa-circle"></i>
		</li>
		<li>
		<span>CAF Application</span>
		</li>
		</ul>
		</div>-->
		<div class="row">
		  <div class="col-md-12">
			<div class="m-heading-1  border-green m-bordered">
			  <h3>Registration Of Existing Unit: Common Application Form 
			  </h3>
			  <p> 
			  </p>
			</div>
			<div class="portlet light bordered" id="form_wizard_1">
			  <div class="portlet-title">
				<div class="caption">
				  <i class=" icon-layers font-red">
				  </i>
				  <span class="caption-subject font-red bold uppercase">Fields With * are Mandtory  -
					<span class="step-title"> Step 1 of 5 
					</span>
				  </span>
				</div>
			  </div>
			  <div class="portlet-body form">
				<form class="form-horizontal caf_form_submission_wizard" action="#" id="submit_form" method="POST">
				  <input type="hidden" class="csrftoken" name="YII_CSRF_TOKEN" value="<?= Yii::app()->getRequest()->getCsrfToken() ?>" />
				  <input type="hidden" value="<?= Yii::app()->createAbsoluteUrl('frontuser/existingUnit/saveCAFPartially') ?>" id='caf_form_url'>
				  <div class="form-wizard">
					<div class="form-body">
					  <ul class="nav nav-pills nav-justified steps">
						<li <?php if ($document == 1) echo 'class="done"' ?>>
						<a href="#tab1" data-toggle="tab" class="step">
						  <span class="number"> 1 
						  </span>
						  <br>
						  <span class="desc">
							<i class="fa fa-check">
							</i> Enterprise Detail 
						  </span>
						</a>
						</li>
					  <li <?php if ($document == 1) echo 'class="done"' ?>>
					  <a href="#tab2" data-toggle="tab" class="step">
						<span class="number"> 2 
						</span>
						<br>
						<span class="desc">
						  <i class="fa fa-check">
						  </i> Investment Detail 
						</span>
					  </a>
					  </li>
					<li <?php if ($document == 1) echo 'class="done"' ?>>
					<a href="#tab3" data-toggle="tab" class="step">
					  <span class="number"> 3 
					  </span>
					  <br>
					  <span class="desc">
						<i class="fa fa-check">
						</i> Requirements 
					  </span>
					</a>
					</li>
				  <li <?php if ($document == 1) echo 'class="done"' ?>>
				  <a href="#tab4" data-toggle="tab" class="step">
					<span class="number"> 4 
					</span>
					<br>
					<span class="desc">
					  <i class="fa fa-check">
					  </i> Existing Registration Details 
					</span>
				  </a>
				  </li>
				<li <?php if ($document == 1) echo 'class="notactive"' ?>>
				<a href="#tab5" data-toggle="tab" class="step">
				  <span class="number"> 5 
				  </span>
				  <br>
				  <span class="desc">
					<i class="fa fa-check">
					</i>  Checklist 
				  </span>
				</a>
				</li>
			  </ul>
			<div id="bar" class="progress progress-striped" role="progressbar">
			  <div class="progress-bar progress-bar-success"> 
			  </div>
			</div>
			<div class="tab-content">
			  <div class="alert alert-danger alert-message-error display-none">
				<button class="close" data-dismiss="alert">
				</button> You have some form errors. Please check below. 
			  </div>
			  <div class="alert alert-success alert-message-success display-none">
				<button class="close" data-dismiss="alert">
				</button> Your form validation is successful!
			  </div>
			  <?php
			  foreach (Yii::app()->user->getFlashes() as $key => $message) {
			  echo '<div class="alert alert-success"><button class="close" data-dismiss="alert"></button> 
			  ' . $message .
			  '</div>';
			  }
			  ?>
			  <div class="tab-pane <?php //if($document!=1) echo 'active' ?>" id="tab1">
				<div class="portlet box green">
				  <div class="portlet-title">
					<div class="caption">
					  <i class="fa fa-gift">
					  </i>Registration of Existing Unit Application -Step 1 
					</div>
					<div class="tools">
					  <a href="javascript:;" class="collapse"> 
					  </a>
					  <a href="javascript:;" class="reload"> 
					  </a>
					</div>
				  </div>
				  <div class="portlet-body form">
					<!-- BEGIN FORM-->
					<div class="form-body">
					  <h3 class="form-section">Company Details
					  </h3>
					  <div class="row">
						<div class="col-md-6">
						  <div class="form-group">
							<label class="control-label col-md-3">IUID
							  <span class="required" aria-required="true"> * 
							  </span>
							</label>
							<div class="col-md-9">
							  <input type="text"  id="IUID" class="form-control" name='IUID' value="<?= @$iuid ?>" readonly placeholder="IUID">
							  <span class="help-block">
							  </span>
							</div>
						  </div>
						</div>
						<!--/span-->
						<div class="col-md-6">
						  <div class="form-group">
							<label class="control-label col-md-3">Name of Company
							  <span class="required" aria-required="true"> * 
							  </span>
							</label>
							<div class="col-md-9">
							  <input type="text"  id="company_name" class="form-control alphanumeric_name_with_space"   maxlength="250" value="<?= @$incmplt_fields->company_name ?>"  name="company_name" placeholder="*  Name of Company">
							</div>
						  </div>
						</div>                                                    
						<!--/span-->
					  </div>
					  <!--/row-->
					  <div class="row">
						<div class="col-md-6">
						  <div class="form-group">
							<label class="control-label col-md-3">GSTIN of Company
							  <span class="required" aria-required="true"> * 
							  </span>
							</label>
							<div class="col-md-9">
							  <input type="text"  id="company_name" maxlength="100" class="form-control alphanumeric_name_with_space" value="<?= @$incmplt_fields->company_gst ?>" name="company_gst" placeholder="*Company's GST Number">                                                                   
							  <span class="help-block">  
							  </span>
							</div>
						  </div>
						</div>
						<div class="col-md-6">
						  <div class="form-group">
							<label class="control-label col-md-3">Company PAN number
							  <span class="required" aria-required="true"> * 
							  </span>
							</label>
							<div class="col-md-9">
							  <input type="text"  id="company_pan" maxlength="10" class="form-control alphanumeric_name_with_space" value="<?= @$incmplt_fields->company_pan ?>" name="company_pan" placeholder="*Company's PAN number">                                                                   
							  <span class="help-block">  
							  </span>
							</div>
						  </div>
						</div>
					  </div>
					  <div class="row">
						<div class="col-md-6">
						  <div class="form-group">
							<label class="control-label col-md-3">Registration under Companies Act
							</label>
							<div class="col-md-9">
							  <input type="text"  id="roc" class="form-control address_field_with_space" value="<?= @$incmplt_fields->roc ?>"  name="roc" placeholder="ROC">
							</div>
						  </div>
						</div>
						<div class="col-md-6">
						  <div class="form-group">
							<label class="control-label col-md-3">Website Of Company
							</label>
							<div class="col-md-9">
							  <input type="text"  id="website" class="form-control telephone_numbers" value="<?= @$incmplt_fields->website ?>"  name="website" placeholder="Website's URL">
							</div>
						  </div>
						</div>
					  </div>
					  <div class="row">
						<div class="col-md-6">
						  <div class="form-group">
							<label class="control-label col-md-3">Registered Headquarter's Address 
							</label>
							<div class="col-md-9"> 
							<!--<div class="col-md-9">
							  <input type="text"  id="registered_headquarters" class="form-control address_field_with_space" value="<?= @$incmplt_fields->registered_headquarters ?>"  name="registered_headquarters" placeholder="Registered Headquarters">
							</div>-->
							<textarea  id="registered_headquarters" rows="2" class="form-control address_field_with_space"  name="registered_headquarters"><?= @$incmplt_fields->registered_headquarters ?></textarea>
				
						 </div>
						  </div>
						</div>
						<div class="col-md-6">
						  <div class="form-group">
							<label class="col-md-3 control-label" for="">District
							  <span class="required" aria-required="true"> *
							  </span>
							</label>
							<div class="col-md-9">
							  <select name="company_district" class="form-control district" required>
								<option value="">Select District
								</option>
								<?php $allList = InfowizardQuestionMasterExt::getMasterList('bo_district', 'district_id', 'distric_name'); ?>
								<?php foreach ($allList as $k => $v) { ?>
								<option value="<?php echo $k; ?>" 
										<?php
								if (!empty($incmplt_fields->company_district) && $incmplt_fields->company_district == $k) {
								echo " selected";
								}
								?>>
								<?php echo $v; ?>
								</option>
							  <?php } ?>
							  </select>
						  </div>
						</div>
					  </div>
					</div>
					<div class="row">
					  <div class="col-md-6">
						<div class="form-group">
						  <label class="col-md-3 control-label" for="">Tehsil (Sub District) 
						  </label>
						  <div class="col-md-9">
							<select name="company_sub_district_id" class="form-control tehsil">
							  <option value="">Select Tehsil
							  </option>
							  <?php $allList = InfowizardQuestionMasterExt::getMasterList('lg_code_blocks', 'block_code', 'block_name'); ?>
							  <?php foreach ($allList as $k => $v) { ?>
							  <option value="<?php echo $k; ?>" 
									  <?php
							  if (!empty(@$incmplt_fields->company_sub_district_id) && $incmplt_fields->company_sub_district_id == $k) {
							  echo " selected";
							  }
							  ?>>
							  <?php echo $v; ?>
							  </option>
							<?php } ?>
							</select>
						</div>
					  </div>
					</div>
					<div class="col-md-6">
					  <div class="form-group">
						<label class="col-md-3 control-label" for="">Village 
						</label> 
						<div class="col-md-9">
						  <select name="company_village" class="form-control villages">
							<option value="">Select Village
							</option>
							<?php $allList = InfowizardQuestionMasterExt::getMasterList('lg_code_villages', 'village_code', 'village_name'); ?>
							<?php
							$ii = 0;
							foreach ($allList as $k => $v) {
							if ($ii < 30) {
							?>
							<option value="<?php echo $k; ?>" 
									<?php
							if (!empty($incmplt_fields->company_village) && $incmplt_fields->company_village == $k) {
							echo " selected";
							}
							?>>
							<?php echo $v; ?>
							</option>
						  <?php } $ii += 1;
		}
		?>
						  </select>
					  </div>
					</div>
				  </div>
				</div>
				<div class="row"> 
				  <!--/span-->
				  <!--/span-->
				</div>
				<div class="row">
				  <!--/span-->
				  <!--/span-->
				  <!--<div class="col-md-6">
					<div class="form-group">
					  <label class="control-label col-md-3">Company Sector
					  </label> 
					  <div class="col-md-9">
						<input type="text"  id="company_sector" class="form-control address_field_with_space" value="<?= @$incmplt_fields->company_sector ?>"  name="company_sector" placeholder="Company's Sector ">
					  </div>
					</div>
				  </div>-->
				  <div class="col-md-6">
					<div class="form-group">
					  <label class="control-label col-md-3">Registered Headquarter's Pin 
					  </label>
					  <div class="col-md-9">
						<input type="text"  id="registered_headquarters_pin" class="form-control address_field_with_space" value="<?= @$incmplt_fields->registered_headquarters_pin ?>"  name="registered_headquarters_pin" placeholder="Registered Headquarter's pin">
					  </div>
					</div>
				  </div>
				</div>
				<!--/row-->
				<h3 class="form-section">Unit Details
				</h3>
				<div class="row">
				  <div class="col-md-6">
					<div class="form-group">
					  <label class="control-label col-md-3">Name Of Unit
					  </label>
					  <div class="col-md-9">
						<input type="text"  id="name" class="form-control address_field_with_space" value="<?= @$incmplt_fields->name ?>"  name="name" placeholder="Unit Name">
					  </div>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					  <label class="control-label col-md-3">GSTIN Of Unit
					  </label>
					  <div class="col-md-9">
						<input type="text"  id="unit_gst" class="form-control address_field_with_space" value="<?= @$incmplt_fields->unit_gst ?>"  name="unit_gst" placeholder="GSTIN Of Unit">
					  </div>
					</div>
				  </div>
				</div>
				<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					  <label class="control-label col-md-3">Email
						<span class="required" aria-required="true"> * 
						</span>
					  </label>
					  <div class="col-md-9">
						<input type="text"  id="email" class="form-control email"   maxlength="250" value="<?= @$incmplt_fields->email ?>"  name="email" placeholder="*  Email">
					  </div>
					</div>
				  </div>
				 
				 <div class="col-md-6">
					<div class="form-group">
					  <label class="control-label col-md-3">Telephone
					  </label>
					  <div class="col-md-9">
						<input type="text"  id="tel_phone" class="form-control telephone_numbers" value="<?= @$incmplt_fields->tel_phone ?>"  name="tel_phone" placeholder="Telephone Number">
					  </div>
					</div>
				  </div>
				</div>
				<div class="row">
				  <!--/span-->
				   <div class="col-md-6">
					<div class="form-group">
					  <label class="control-label col-md-3">Mobile
						<span class="required" aria-required="true"> * 
						</span>
					  </label>
					  <div class="col-md-9">
						<input type="text"  id="mob_number" class="form-control mobile_number_ten_digit_only"  value="<?= @$incmplt_fields->mob_number ?>"  name="mob_number" placeholder="Mobile Number">
					  </div>
					</div>
				  </div>
				   
				  <div class="col-md-6">
					<div class="form-group">
					  <label class="control-label col-md-3">Fax
					  </label>
					  <div class="col-md-9">
						<input type="text"  id="fax" class="form-control telephone_numbers" value="<?= @$incmplt_fields->fax ?>"  name="fax" placeholder="Fax">
					  </div>
					</div>
				  </div>
				  <!--/span-->
				</div>
				<!--/span-->
				<div class="row">
				  <div class="col-md-6">
					<div class="form-group">
					  <label class="control-label col-md-3">Unit Address
						<span class="required" aria-required="true"> * 
						</span>
					  </label>
					  <div class="col-md-9">
						<textarea  id="Address" rows="3" class="form-control address_field_with_space" maxlength="100" name="Address"  placeholder="*  Correspondence Address"><?= @$incmplt_fields->Address ?></textarea>
						<span class="help-block"> 
						</span> 
					  </div>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					  <label class="col-md-3 control-label" for="">District
						<span class="red"> *
						</span>
					  </label>
					  <div class="col-md-9">
						<select name="unit_district" class="form-control district1" required>
						  <option value="">Select District
						  </option>
						  <?php $allList = InfowizardQuestionMasterExt::getMasterList('bo_district', 'district_id', 'distric_name'); ?>
						  <?php foreach ($allList as $k => $v) { ?>
						  <option value="<?php echo $k; ?>" 
								  <?php
						  if (!empty($incmplt_fields->unit_district) && $incmplt_fields->unit_district == $k) {
						  echo " selected";
						  }
						  ?>>
						  <?php echo $v; ?>
						  </option>
						<?php } ?>
						</select>
					</div>
				  </div>
				</div>
				
				<div class="col-md-6">
				  <div class="form-group">
					<label class="col-md-3 control-label" for="">Tehsil 
					</label>
					<div class="col-md-9">
					  <select name="unit_sub_district_id" class="form-control tehsil1">
						<option value="">Select Tehsil
						</option>
						<?php $allList = InfowizardQuestionMasterExt::getMasterList('lg_code_sub_disctrct', 'sub_district_code', 'sub_district_name'); ?>
						<?php foreach ($allList as $k => $v) { ?>
						<option value="<?php echo $k; ?>" 
								<?php
						if (!empty(@$incmplt_fields->unit_sub_district_id) && $incmplt_fields->unit_sub_district_id == $k) {
						echo " selected";
						}
						?>>
						<?php echo $v; ?>
						</option>
					  <?php } ?>
					  </select>
				  </div>
				</div>
			  </div>
			  
			  
				<!--/span-->
			  </div>
			  <div class="row">
			  
				<div class="col-md-6">
				  <div class="form-group">
					<label class="col-md-3 control-label" for="">Block 
					</label>
					<div class="col-md-9">
					  <!--<select name="unit_block_id" class="form-control tehsil1">
						<option value="">Select Block
						</option>
						<?php $allList = InfowizardQuestionMasterExt::getMasterList('lg_code_blocks', 'block_code', 'block_name'); ?>
						<?php foreach ($allList as $k => $v) { ?>
						<option value="<?php echo $k; ?>" 
								<?php
						if (!empty(@$incmplt_fields->unit_block) && @$incmplt_fields->unit_block == $k) {
						echo " selected";
						}
						?>>
						<?php echo $v; ?>
						</option>
					  <?php } ?>
					  </select>-->
					  <input type="text" name="unit_block_id" class="form-control">
				  </div>
				</div>
			  </div>
			  <div class="col-md-6">
				<div class="form-group">
				  <label class="col-md-3 control-label" for="">Village 
				  </label> 
				  <div class="col-md-9">
					<select name="unit_village" class="form-control villages1"> 
					  <option value="">Select Village
					  </option>
					  <?php $allList = InfowizardQuestionMasterExt::getMasterList('lg_code_villages', 'village_code', 'village_name'); ?>
					  <?php
						$ii = 0;
						foreach ($allList as $k => $v) {
						if ($ii < 30) {
						?>
					  <option value="<?php echo $k; ?>" 
							  <?php
					  if (!empty($incmplt_fields->unit_village) && @$incmplt_fields->company_village == $k) {
					  echo " selected";
					  }
					  ?>>
					  <?php echo $v; ?>
					  </option>
					<?php } $ii += 1;
		}
		?>
					</select>
				</div>
			  </div>
			</div> 
		  </div>
		  <div class="row">
			<div class="col-md-6">
			  <div class="form-group">
				<label class="control-label col-md-3">Unit Sector
				</label>
				<div class="col-md-9">
				  <input type="text"  id="unit_sector" class="form-control address_field_with_space" value="<?= @$incmplt_fields->unit_sector ?>"  name="unit_sector" placeholder="Unit's Sector ">
				</div>
			  </div>
			</div>
			<div class="col-md-6">
			  <div class="form-group">
				<label class="control-label col-md-3">Pin Code
				  <span class="required" aria-required="true"> * 
				  </span>
				</label>
				<div class="col-md-9">
				  <input type="text"  id="pin_code" class="form-control six_digit_zip_code"  value="<?= @$incmplt_fields->pin_code ?>"  name="pin_code" placeholder="*  Pin Code">
				  <span class="help-block"> 
				  </span>
				</div>
			  </div>
			</div>
		  </div>
		  <h3 class="form-section">Details of M.D/Managing Partner/CEO / Lead Promoter/ Proprietor
		  </h3>
		  <!--/row-->
		  <div class="row">
			<div class="col-md-6">
			  <div class="form-group">
				<label class="control-label col-md-3">Name
				  <span class="required" aria-required="true"> * 
				  </span>
				</label>
				<div class="col-md-9">
				  <input type="text"  id="md_name" class="form-control name_with_space" maxlength="100"  value="<?= @$incmplt_fields->md_name ?>" name="md_name" placeholder="*  Name of the M.D/Managing Partner/CEO /Lead Promoter/Proprietor">
				  <span class="help-block">
				  </span>
				</div>
			  </div>
			</div>
			<div class="col-md-6">
			  <div class="form-group">
				<label class='control-label col-md-3'>
				  <span class="required" aria-required="true">*
				  </span>Designation
				</label>
				<div class=" col-md-9">
				  <select name="designation" class="form-control" id="md_designation">
					<option value="">*  Please Select Designation
					</option>
					<option value="MD" 
							<?php if (isset($incmplt_fields->designation)) if ($incmplt_fields->designation == 'MD') echo "selected"; ?> >MD
					</option>
				  <option value="Managing Partner" 
						  <?php if (isset($incmplt_fields->designation)) if ($incmplt_fields->designation == 'Managing Partner') echo "selected"; ?>>Managing Partner
				  </option>
				<option value="CEO" 
						<?php if (isset($incmplt_fields->designation)) if ($incmplt_fields->designation == 'CEO') echo "selected"; ?>>CEO
				</option>
			  <option value="Lead Promoter" 
					  <?php if (isset($incmplt_fields->designation)) if ($incmplt_fields->designation == 'Lead Promoter') echo "selected"; ?>>Lead Promoter
			  </option>
			<option value="Proprietor" 
					<?php if (isset($incmplt_fields->designation)) if ($incmplt_fields->designation == 'Proprietor') echo "selected"; ?> >Proprietor
			</option>
		  </select>
		</div>
		</div>
		</div>
		</div>
		<div class="row">
		  <div class="col-md-6">
			<div class="form-group">
			  <label class="control-label col-md-3">Mobile
				<span class="required" aria-required="true"> * 
				</span>
			  </label>
			  <div class="col-md-9">
				<input type="text"  id="md_mob" class="form-control mobile_number_ten_digit_only"  value="<?= @$incmplt_fields->md_mob ?>" name="md_mob" placeholder="Mobile Number">
			  </div>
			</div>
		  </div>
		  <!--/span-->
		  <div class="col-md-6">
			<div class="form-group"> 
			  <label class='control-label col-md-3'>Email
				<span class="required" aria-required="true"> * 
				</span>
			  </label>
			  <div class="col-md-9">
				<input type="text"  id="md_email" class="form-control email" value="<?= @$incmplt_fields->md_email ?>"  name="md_email" placeholder="*  Email">
			  </div>
			</div>
		  </div>
		  <!--/span-->
		</div>
		<!--/row-->
		<div class="row">
		  <div class="col-md-6">
			<div class="form-group">
			  <label class="control-label col-md-3">Telephone
			  </label>
			  <div class="col-md-9">
				<input type="text"  id="md_tel" class="form-control telephone_numbers"  value="<?= @$incmplt_fields->md_tel ?>" name="md_tel" placeholder="Telephone Number">
			  </div>
			</div>
		  </div>
		  <div class="col-md-6">
			<div class="form-group">
			  <label class="control-label col-md-3">Fax
			  </label>
			  <div class="col-md-9">
				<input type="text"  id="md_fax" class="form-control telephone_numbers"  value="<?= @$incmplt_fields->md_fax ?>" name="md_fax" placeholder="FAX">
			  </div>
			</div>
		  </div>
		  <!--/span-->
		</div>
		<div class="row">
		  <div class="col-md-6">
			<div class="form-group">
			  <label class="control-label col-md-3">Category
			  </label>
			  <div class="col-md-9">
				<select name="org_category" class="form-control" id="org_category">
				  <option value="">*  Please Select Category
				  </option>
				  <option value="SC" 
						  <?php if (isset($incmplt_fields->org_category)) if ($incmplt_fields->org_category == 'SC') echo "selected"; ?> >SC
				  </option>
				<option value="ST" 
						<?php if (isset($incmplt_fields->org_category)) if ($incmplt_fields->org_category == 'ST') echo "selected"; ?>>ST
				</option>
			  <option value="OBC" 
					  <?php if (isset($incmplt_fields->org_category)) if ($incmplt_fields->org_category == 'OBC') echo "selected"; ?>>OBC
			  </option>
			<option value="GENERAL" 
					<?php if (isset($incmplt_fields->org_category)) if ($incmplt_fields->org_category == 'GENERAL') echo "selected"; ?>>General
			</option>
		  <option value="WOMEN" 
				  <?php if (isset($incmplt_fields->org_category)) if ($incmplt_fields->org_category == 'WOMEN') echo "selected"; ?> >Women
		  </option>
		<option value="Ex-Serviceman" 
				<?php if (isset($incmplt_fields->org_category)) if ($incmplt_fields->org_category == 'Ex-Serviceman') echo "selected"; ?> >Ex-Serviceman
		</option>
		<option value="Physically Challenged" 
				<?php if (isset($incmplt_fields->org_category)) if ($incmplt_fields->org_category == 'Physically Challenged') echo "selected"; ?> >Physically Challenged
		</option>
		<!--<option value="Other" <?php if (isset($incmplt_fields->org_category)) if ($incmplt_fields->org_category == 'Other') echo "selected"; ?> >Other</option>-->
		</select>
		</div>
		</div>
		</div>
		</div>
		<!--/row-->
		<h3 class="form-section">Details of Authorized Coordinator/Person   
		</h3>
		<div class="row">
		  <div class="col-md-6">
			<div class="form-group">
			  <label class="control-label col-md-3">Name
				<span class="required" aria-required="true"> * 
				</span>
			  </label>
			  <div class="col-md-9">
				<input type="text"  id="auth_name" class="form-control" name="auth_name"  value="<?= @$first_name . " " . @$last_name ?>" readonly placeholder="Name of Authorized Coordinator/Person">
			  </div>
			</div>
		  </div>
		  <!--/span-->
		  <div class="col-md-6">
			<div class="form-group">
			  <label class="control-label col-md-3">Designation
			  </label>
			  <div class="col-md-9">
				<input type="text"  id="auth_designation" class="form-control name_with_space" maxlength="100" value="<?= @$incmplt_fields->auth_designation ?>" name="auth_designation" placeholder="*  Designation">
			  </div>
			</div>
		  </div>
		  <!--/span-->
		</div>
		<!--/row-->
		<div class="row">
		  <div class="col-md-6">
			<div class="form-group">
			  <label class="control-label col-md-3">Email
				<span class="required" aria-required="true"> * 
				</span>
			  </label>
			  <div class="col-md-9">
				<input type="text"  id="auth_email" class="form-control email" value="<?= @$email ?>" readonly name="auth_email" placeholder="Email">
			  </div>
			</div>
		  </div>
		  <!--/span-->
		  <div class="col-md-6">
			<div class="form-group">
			  <label class="control-label col-md-3">Mobile
			  </label>
			  <div class="col-md-9">
				<input type="text"  id="auth_mob" class="form-control mobile_number_ten_digit_only" value="<?= @$mobile_number ?>" readonly name="auth_mob" placeholder="Mobile Number">
			  </div>
			</div>
		  </div>
		  <!--/span-->
		</div>
		<!--/row-->
		<div class="row">
		  <div class="col-md-6">
			<div class="form-group">
			  <label class="control-label col-md-3">Telephone
			  </label>
			  <div class="col-md-9">
				<input type="text"  id="auth_tel" class="form-control telephone_numbers"value="<?= @$incmplt_fields->auth_tel ?>" name="auth_tel" placeholder="Telephone Number">
			  </div>
			</div>
		  </div>
		  <!--/span-->
		  <div class="col-md-6">
			<div class="form-group">
			  <label class="control-label col-md-3">Fax
			  </label>
			  <div class="col-md-9">
				<input type="text"  id="auth_fax" class="form-control telephone_numbers" value="<?= @$incmplt_fields->auth_fax ?>" name="auth_fax" placeholder="Fax Number">
			  </div>
			</div>
		  </div>
		  <!--/span-->
		</div>
		<!--/row-->
		<h3 class="form-section">Financial Indicators of the Enterprise / Firm for Last 3 Financial Years in INR Lakhs (if any)
		</h3>
		<div class="row">
		  <?php 
		$year=date('Y');
		$month = date('m');
		if($month<4){
		$year= $year-1;
		}
		$yearto=$year-3;// Change number(3) if you need to increase / decrease the no of last FY
		$financialYearDropdown="";
		?>
		  <div class="col-md-12">
			<div class="form-group">
			  <div class="row">
				<label class="control-label col-md-2" style="text-align: center;">Financial Year
				</label>
				<label class="control-label col-md-2" style="text-align: center;">Turn Over
				</label>
				<label class="control-label col-md-2" style="text-align: center;">Profit before Tax
				</label>
				<label class="control-label col-md-2" style="text-align: center;">Net Worth
				</label>
				<label class="control-label col-md-2" style="text-align: center;">Reserves &amp; Surplus
				</label>
				<label class="control-label col-md-2" style="text-align: center;">Share Capital
				</label>
			  </div>
			</div>
			<div class="row">
			  <div class="form-group">
				<div class="col-md-12">
				  <div class="col-md-2">
					<!--<input type="text"  id="fnc_year1" class="form-control year" maxlength="10" value="<?= @$incmplt_fields->fnc_year[0] ?>" name="fnc_year[]" placeholder="Year">-->
					<select name="fnc_year[]" class="form-control">
					  <?php $financialYearDropdown="";
							$name=@$incmplt_fields->fnc_year[0];
							for($i=$year; $i>$yearto;$i--){
							$markSelected="";
							$years=$i."-".($i+1);														  
							if($name==$years){$markSelected="selected";}
							$financialYearDropdown.="<option value=$years $markSelected>FY $years</option>"; 
							}
							echo $financialYearDropdown;
							?>
					</select>
				  </div>
				  <div class="col-md-2">
					<input type="text"  id="fnc_turnover1" class="form-control decimal" maxlength="10" value="<?= @$incmplt_fields->fnc_turnover[0] ?>" name="fnc_turnover[]" placeholder="Turn Over">
				  </div>
				  <div class="col-md-2">
					<input type="text"  id="fnc_prftBfrTax1" class="form-control decimal"  maxlength="10" value="<?= @$incmplt_fields->fnc_prftBfrTax[0] ?>" name="fnc_prftBfrTax[]" placeholder="Profit before Tax">
				  </div>
				  <div class="col-md-2">
					<input type="text"  id="fnc_netWrth1" class="form-control decimal" maxlength="10" value="<?= @$incmplt_fields->fnc_netWrth[0] ?>" name="fnc_netWrth[]" placeholder="Net Worth">
				  </div>
				  <div class="col-md-2">
					<input type="text"  id="fnc_rsrvSrpls1" class="form-control decimal" maxlength="10" value="<?= @$incmplt_fields->fnc_rsrvSrpls[0] ?>" name="fnc_rsrvSrpls[]" placeholder="Reserves & Surplus">
				  </div>
				  <div class="col-md-2">
					<input type="text"  id="fnc_sharCaps1" class="form-control decimal" maxlength="10" value="<?= @$incmplt_fields->fnc_sharCaps[0] ?>" name="fnc_sharCaps[]" placeholder="Share Capital">
				  </div>
				</div>
			  </div>
			</div>
			<div class="row">
			  <div class="form-group">
				<div class="col-md-12">
				  <div class="col-md-2">
					<select name="fnc_year[]" class="form-control">
					  <?php $financialYearDropdown="";
							$name=@$incmplt_fields->fnc_year[1];
							for($i=$year; $i>$yearto;$i--){
							$markSelected="";
							$years=$i."-".($i+1);														  
							if($name==$years){$markSelected="selected";}
							$financialYearDropdown.="<option value=$years $markSelected>FY $years</option>"; 
							}
							echo $financialYearDropdown;
							?>
					</select>
				  </div>
				  <div class="col-md-2">
					<input type="text"  id="fnc_turnover1" class="form-control decimal" maxlength="10" value="<?= @$incmplt_fields->fnc_turnover[1] ?>" name="fnc_turnover[]" placeholder="Turn Over">
				  </div>
				  <div class="col-md-2">
					<input type="text"  id="fnc_prftBfrTax1" class="form-control decimal"  maxlength="10" value="<?= @$incmplt_fields->fnc_prftBfrTax[1] ?>" name="fnc_prftBfrTax[]" placeholder="Profit before Tax">
				  </div>
				  <div class="col-md-2">
					<input type="text"  id="fnc_netWrth1" class="form-control decimal" maxlength="10" value="<?= @$incmplt_fields->fnc_netWrth[1] ?>" name="fnc_netWrth[]" placeholder="Net Worth">
				  </div>
				  <div class="col-md-2">
					<input type="text"  id="fnc_rsrvSrpls1" class="form-control decimal" maxlength="10" value="<?= @$incmplt_fields->fnc_rsrvSrpls[1] ?>" name="fnc_rsrvSrpls[]" placeholder="Reserves & Surplus">
				  </div>
				  <div class="col-md-2">
					<input type="text"  id="fnc_sharCaps1" class="form-control decimal" maxlength="10" value="<?= @$incmplt_fields->fnc_sharCaps[1] ?>" name="fnc_sharCaps[]" placeholder="Share Capital">
				  </div>
				</div>
			  </div>
			</div>
			<div class="row">
			  <div class="form-group">
				<div class="col-md-12">
				  <div class="col-md-2">
					<select name="fnc_year[]" class="form-control">
					  <?php $financialYearDropdown="";
							$name=@$incmplt_fields->fnc_year[2];
							for($i=$year; $i>$yearto;$i--){
							$markSelected="";
							$years=$i."-".($i+1);														  
							if($name==$years){$markSelected="selected";}
							$financialYearDropdown.="<option value=$years $markSelected>FY $years</option>"; 
							}
							echo $financialYearDropdown;
							?>
					</select>
				  </div>
				  <div class="col-md-2">
					<input type="text"  id="fnc_turnover1" class="form-control decimal" maxlength="10" value="<?= @$incmplt_fields->fnc_turnover[2] ?>" name="fnc_turnover[]" placeholder="Turn Over">
				  </div>
				  <div class="col-md-2">
					<input type="text"  id="fnc_prftBfrTax1" class="form-control decimal"  maxlength="10" value="<?= @$incmplt_fields->fnc_prftBfrTax[2] ?>" name="fnc_prftBfrTax[]" placeholder="Profit before Tax">
				  </div>
				  <div class="col-md-2">
					<input type="text"  id="fnc_netWrth1" class="form-control decimal" maxlength="10" value="<?= @$incmplt_fields->fnc_netWrth[2] ?>" name="fnc_netWrth[]" placeholder="Net Worth">
				  </div>
				  <div class="col-md-2">
					<input type="text"  id="fnc_rsrvSrpls1" class="form-control decimal" maxlength="10" value="<?= @$incmplt_fields->fnc_rsrvSrpls[2] ?>" name="fnc_rsrvSrpls[]" placeholder="Reserves & Surplus">
				  </div>
				  <div class="col-md-2">
					<input type="text"  id="fnc_sharCaps1" class="form-control decimal" maxlength="10" value="<?= @$incmplt_fields->fnc_sharCaps[2] ?>" name="fnc_sharCaps[]" placeholder="Share Capital">
				  </div>
				</div>
			  </div>
			</div>
		  </div>
		  <!--/span-->
		</div>
		<h3 class="form-section">Export turnover of Last 3 Financial Year (if any)
		</h3>
		<div class="row">
		  <div class="col-md-12">
			<div class="form-group">  
			  <div class="row">
				<label class="control-label col-md-2" style="text-align: center;">Financial Year
				</label>
				<label class="control-label col-md-2" style="text-align: center;">Turn Over
				</label>
				<label class="control-label col-md-2" style="text-align: center;">Financial Year
				</label>
				<label class="control-label col-md-2" style="text-align: center;">Turn Over
				</label>
				<label class="control-label col-md-2" style="text-align: center;">Financial Year
				</label>
				<label class="control-label col-md-2" style="text-align: center;">Turn Over
				</label>
			  </div>
			</div>
			<div class="row">
			  <div class="form-group">
				<div class="col-md-12">
				  <div class="col-md-2">
					<!-- <input type="text"  id="export_fnc_year1" class="form-control"  value="<?= @$incmplt_fields->export_fnc_year1; ?>" name="export_fnc_year1" placeholder="Financial Year">-->
					<select name="export_fnc_year1" class="form-control">
					  <?php $financialYearDropdown="";
							$name=@$incmplt_fields->export_fnc_year1;
							for($i=$year; $i>$yearto;$i--){
							$markSelected="";
							$years=$i."-".($i+1);														  
							if($name==$years){$markSelected="selected";}
							$financialYearDropdown.="<option value=$years $markSelected>FY $years</option>"; 
							}
							echo $financialYearDropdown;
							?>
					</select>
				  </div>
				  <div class="col-md-2">
					<input type="text"  id="export_turnover1" class="form-control decimal"  value="<?= @$incmplt_fields->export_turnover1 ?>" name="export_turnover1" placeholder="Export Turn Over 1">
				  </div>
				  <div class="col-md-2">
					<!--<input type="text"  id="export_fnc_year2" class="form-control decimal"   value="<?= @$incmplt_fields->export_fnc_year2 ?>" name="export_fnc_year2" placeholder="Financial Year 2">-->
					<select name="export_fnc_year2" class="form-control">
					  <?php $financialYearDropdown="";
							$name=@$incmplt_fields->export_fnc_year2;
							for($i=$year; $i>$yearto;$i--){
							$markSelected="";
							$years=$i."-".($i+1);														  
							if($name==$years){$markSelected="selected";}
							$financialYearDropdown.="<option value=$years $markSelected>FY $years</option>"; 
							}
							echo $financialYearDropdown;
							?>
					</select>
				  </div>
				  <div class="col-md-2"> 
					<input type="text"  id="export_turnover2" class="form-control decimal" maxlength="10" value="<?= @$incmplt_fields->export_turnover2 ?>" name="export_turnover2" placeholder="Export Turn Over 2">
				  </div>
				  <div class="col-md-2">
					<!--<input type="text"  id="export_fnc_year3" class="form-control decimal"  value="<?= @$incmplt_fields->export_fnc_year3 ?>" name="export_fnc_year3" placeholder="Financial Year 3">-->
					<select name="export_fnc_year3" class="form-control">
					  <?php $financialYearDropdown="";
							$name=@$incmplt_fields->export_fnc_year3;
							for($i=$year; $i>$yearto;$i--){
							$markSelected="";
							$years=$i."-".($i+1);														  
							if($name==$years){$markSelected="selected";}
							$financialYearDropdown.="<option value=$years $markSelected>FY $years</option>"; 
							}
							echo $financialYearDropdown;
							?>
					</select>
				  </div>
				  <div class="col-md-2">
					<input type="text"  id="export_turnover3" class="form-control decimal"  value="<?= @$incmplt_fields->export_turnover3 ?>" name="export_turnover3" placeholder="Export Turn Over 3">
				  </div>
				</div>
			  </div>
			</div>
		  </div>
		</div>
		<!--/row-->
		<h3 class="form-section">Organisation Details
		</h3>
		<div class="row">
		  <div class="col-md-6">
			<div class="form-group">
			  <label class="control-label col-md-3">Nature
				<span class="required" aria-required="true"> * 
				</span>
			  </label>
			  <div class="col-md-9">
				<select name="noforg" id="noforg" class="form-control">
				  <option value=""> Nature of your Organization
				  </option>
				  <option value="Proprietary" 
						  <?php if (isset($incmplt_fields->noforg)) if ($incmplt_fields->noforg == 'Proprietary') echo "selected"; ?> >Proprietary
				  </option>
				<option value="Partnership" 
						<?php if (isset($incmplt_fields->noforg)) if ($incmplt_fields->noforg == 'Partnership') echo "selected"; ?> >Partnership
				</option>
			  <option value="Private Limited" 
					  <?php if (isset($incmplt_fields->noforg)) if ($incmplt_fields->noforg == 'Private Limited') echo "selected"; ?>>Private Limited
			  </option>
			<option value="Public Limited" 
					<?php if (isset($incmplt_fields->noforg)) if ($incmplt_fields->noforg == 'Public Limited') echo "selected"; ?>>Public Limited
			</option>
		  <option value="Co-Operative" 
				  <?php if (isset($incmplt_fields->noforg)) if ($incmplt_fields->noforg == 'Co-Operative') echo "selected"; ?>>Co-Operative
		  </option>
		<option value="Other" 
				<?php if (isset($incmplt_fields->noforg)) if ($incmplt_fields->noforg == 'Other') echo "selected"; ?> >Other
		</option>
		</select>
		</div>
		</div>
		</div>
		<!--/span-->
		
		<div class="col-md-6">
		  <div class="form-group">
			<label class="control-label col-md-3">Are You A Startup 
			  <span class="required" aria-required="true"> * 
			  </span>
			</label>
			<div class="col-md-9">
			  <select name="start_up" id="start_up" class="form-control" required>
				<option value="">---Please Select---
				</option>
				<option value="Yes" 
						<?php if (isset($incmplt_fields->start_up)) if ($incmplt_fields->start_up == 'Yes') echo "selected"; ?> >Yes
				</option>
			  <option value="No" 
					  <?php if (isset($incmplt_fields->start_up)) if ($incmplt_fields->start_up == 'No') echo "selected"; ?> >No
			  </option>
		</select>                                                                    
		</div>
		</div>
		</div>
		<!--/span-->
		</div>
		<div class="row">
		  <div class="col-md-6">
			<div class="form-group">
			  <label class="control-label col-md-3 suilable" title="Startup India Registration No">Startup India Registration No.
				<span class="required suilablerequired" aria-required="true" <?php if (isset($incmplt_fields->start_up)) if ($incmplt_fields->start_up != 'Yes'){ echo "style='display:none;'";}?>>*</span>
			  </label>
			  <div class="col-md-9">
				<input type="text"  id="SUI_registration_number" class="form-control alphanumeric_name_with_space"  <?php if (isset($incmplt_fields->start_up)) if ($incmplt_fields->start_up == 'Yes') echo " required"; ?>  maxlength="250" value="<?= @$incmplt_fields->SUI_registration_number ?>"  name="SUI_registration_number" placeholder="Startup India Registration Number">
			  </div>
			</div>
		  </div>
		  <div class="col-md-6">
			<div class="form-group">
			  <label class="control-label col-md-3" title="START-UP UTTARAKHAND Registration No">START-UP UTTARAKHAND Registration No.
				<span class="required" aria-required="true"> 
				</span>
			  </label>
			  <div class="col-md-9">
				<input type="text"  id="SUU_registration_number" class="form-control alphanumeric_name_with_space"   maxlength="250" value="<?= @$incmplt_fields->SUU_registration_number ?>"  name="SUU_registration_number" placeholder="StartupUttarakhand  Registration Number">
			  </div>
			</div>
		  </div>
		</div>
		<div class="row">
		  <div class="col-md-12">
			<div class="form-group">
			  <label class="control-label col-md-2" style="text-align: center;">Description
				<span class="required" aria-required="true"> * 
				</span>
			  </label>
			  <div class="col-md-10 description_detail">
				<textarea  id="activity_of_company1" class="form-control required" rows="4"  name="activity_of_company1" placeholder="*  Brief Description (Activities of the Enterprise)">
				  <?= @$incmplt_fields->activity_of_company1 ?>
				</textarea>
			  </div>
			</div>
		  </div>
		  <!--/span-->
		</div>
		</div>
		</div>
		</div>
		</div>
		<div class="tab-pane" id="tab2">
		  <div class="portlet box green">
			<div class="portlet-title">
			  <div class="caption">
				<i class="fa fa-gift">
				</i>Registration of Existing Unit Application -Step 2 
			  </div>
			  <div class="tools">
				<a href="javascript:;" class="collapse"> 
				</a>
				<a href="javascript:;" class="reload"> 
				</a>
			  </div>
			</div>
			<div class="portlet-body form">
			  <!-- BEGIN FORM-->
			  <div class="form-body">
				<h3 class="form-section">Unit Details
				</h3>
				<div class="row">
				  <div class="col-md-6">
					<div class="form-group">
					  <label class="control-label col-md-3">Nature of unit
						<span class="required" aria-required="true"> * 
						</span>
					  </label>
					  <div class="col-md-9">
						<select name="ntrofunit" id="ntrofunit" class="form-control">
						  <option value="">--Nature of unit--
						  </option>
						  <option value="Manufacturing" 
								  <?php if (isset($incmplt_fields->ntrofunit)) if ($incmplt_fields->ntrofunit == 'Manufacturing') echo "selected"; ?> >Manufacturing
						  </option>
						<option value="Services" 
								<?php if (isset($incmplt_fields->ntrofunit)) if ($incmplt_fields->ntrofunit == 'Services') echo "selected"; ?>>Services
						</option>
					  </select>
					<span class="help-block">
					</span>
				  </div>
				</div>
			  </div>
			  <!--/span-->
			  <div class="col-md-6">
				<div class="form-group">
				  <label class="control-label col-md-3">Unit Type
					<span class="required" aria-required="true"> * 
					</span>
				  </label>
				  <div class="col-md-9">
					<select name="ntrofunittype" id="ntrofunittype" class="form-control">
					  <option value="">---Please Select Nature of Unit---
					  </option>
					  <?php
						if (isset($incmplt_fields->ntrofunit)) {
						if ($incmplt_fields->ntrofunit == 'Manufacturing') {
						echo "<option value='micro' ";
						if (isset($incmplt_fields->ntrofunittype) && $incmplt_fields->ntrofunittype == 'micro')
						echo " selected ";
						echo ">Micro (< 25 lakhs)</option>
						<option value='small'";
						if (isset($incmplt_fields->ntrofunittype) && $incmplt_fields->ntrofunittype == 'small')
						echo " selected ";
						echo ">Small (More than 25 Lakhs < 5 Crore)</option>
						<option value='medium' ";
						if (isset($incmplt_fields->ntrofunittype) && $incmplt_fields->ntrofunittype == 'medium')
						echo " selected ";
						echo ">Medium (More than 5 Crore < 10 Crore)</option>
						<option value='large' ";
						if (isset($incmplt_fields->ntrofunittype) && $incmplt_fields->ntrofunittype == 'large')
						echo " selected ";
						echo " >Large(More than 10 Crore)</option>";
						}
						if ($incmplt_fields->ntrofunit == 'Services') {
						echo "<option value='micro'";
						if (isset($incmplt_fields->ntrofunittype) && $incmplt_fields->ntrofunittype == 'micro')
						echo " selected ";
						echo ">Micro (< 10 lakhs)</option>
						<option value='small' ";
						if (isset($incmplt_fields->ntrofunittype) && $incmplt_fields->ntrofunittype == 'small')
						echo " selected ";
						echo ">Small (More than 10 Lakhs <2 Crore)</option>
						<option value='medium'";
						if (isset($incmplt_fields->ntrofunittype) && $incmplt_fields->ntrofunittype == 'medium')
						echo " selected ";
						echo ">Medium (More than 2 Crore <5 Crore)</option>
						<option value='large' ";
						if (isset($incmplt_fields->ntrofunittype) && $incmplt_fields->ntrofunittype == 'large')
						echo " selected ";
						echo ">Large (More than 5 Crore)</option>";
						}
						}
						?>
					</select>                                                                   
					<span class="help-block">  
					</span>
				  </div>
				</div>
			  </div>
			  <!--/span-->
			</div>
			<!--/row-->
			<?php
				$display = "display:none";
				if (isset($incmplt_fields->ntrofunit))
				if ($incmplt_fields->ntrofunit == 'Manufacturing') {
				$display = "display:block";
				}
				?>
			<h3 class="form-section raw_material_header" style="<?= $display ?>">Raw Material Detail
			</h3>
			<div class="row manufactiring_detail" style="<?= $display ?>">
			  <?php
					if (isset($incmplt_fields->ntrofunit) && $incmplt_fields->ntrofunit == 'Manufacturing') {
					if (isset($incmplt_fields->Name_of_the_Raw_Material) && !empty($incmplt_fields->Name_of_the_Raw_Material)) {
					foreach ($incmplt_fields->Name_of_the_Raw_Material as $key => $raw_material) {
					echo '<div class="col-md-12 raw_material_body_class">
					<div class="form-group mt-repeater">';
					if ($key == 0) {
					echo '<a href="javascript:;" data-repeater-create class="btn btn-success mt-repeater-add">
					<i class="fa fa-plus"></i> Add New Material</a>';
					}
					echo '<div data-repeater-list="group-c">
					<div data-repeater-item class="mt-repeater-item remove_body_part">
					<div class="row mt-repeater-row">
					<div class="col-md-4">
					<label class="control-label">Name of the Raw Material</label>
					<input type="text" placeholder="Raw Material" name="Name_of_the_Raw_Material[]" value= "' . @$incmplt_fields->Name_of_the_Raw_Material[$key] . '" class="form-control" /> </div>
					<div class="col-md-3">
					<label class="control-label">Annual Requirement Unit</label>
					<input type="text" placeholder="Requirement Unit" name="Annual_Requirement_Unit[]" value="' . @$incmplt_fields->Annual_Requirement_Unit[$key] . '" class="form-control" /> </div>
					<div class="col-md-3">
					<label class="control-label">Quantity</label>
					<input type="text" placeholder="Quantity" name="material_quantity[]" value="' . @$incmplt_fields->material_quantity[$key] . '" class="form-control" /> </div>
					<div class="col-md-2">
					<a href="javascript:;" data-repeater-delete class="btn btn-danger mt-repeater-delete">
					<i class="fa fa-close"></i>
					</a>
					</div>
					</div>
					</div>
					</div>
					</div>
					</div>';
					}
					} else {
					echo '
					<div class="col-md-12 raw_material_body_class">
					<div class="form-group mt-repeater">
					<a href="javascript:;" data-repeater-create class="btn btn-success mt-repeater-add">
					<i class="fa fa-plus"></i> Add New Material</a>
					<div data-repeater-list="group-c">
					<div data-repeater-item class="mt-repeater-item remove_body_part">
					<div class="row mt-repeater-row">
					<div class="col-md-4">
					<label class="control-label">Name of the Raw Material</label>
					<input type="text" placeholder="Raw Material" name="Name_of_the_Raw_Material[]" class="form-control" /> </div>
					<div class="col-md-3">
					<label class="control-label">Annual Requirement Unit</label>
					<input type="text" placeholder="Requirement Unit" name="Annual_Requirement_Unit[]" class="form-control" /> </div>
					<div class="col-md-3">
					<label class="control-label">Quantity</label>
					<input type="text" placeholder="Quantity" name="material_quantity[]" class="form-control" /> </div>
					<div class="col-md-2">
					<a href="javascript:;" data-repeater-delete class="btn btn-danger mt-repeater-delete">
					<i class="fa fa-close"></i>
						</a>
						</div>
						</div>
						</div>
						</div>
						</div>
						</div>';
						}
						} else {
						?>
			  <div class="col-md-12 raw_material_body_class">
				<div class="form-group mt-repeater">
				  <a href="javascript:;" data-repeater-create class="btn btn-success mt-repeater-add">
					<i class="fa fa-plus">
					</i> Add New Material
				  </a>
				  <div data-repeater-list="group-c">
					<div data-repeater-item class="mt-repeater-item remove_body_part">
					  <div class="row mt-repeater-row">
						<div class="col-md-4">
						  <label class="control-label">Name of the Raw Material
						  </label>
						  <input type="text" placeholder="Raw Material" name="Name_of_the_Raw_Material[]" class="form-control" /> 
						</div>
						<div class="col-md-3">
						  <label class="control-label">Annual Requirement Unit
						  </label>
						  <input type="text" placeholder="Requirement Unit" name="Annual_Requirement_Unit[]" class="form-control" /> 
						</div>
						<div class="col-md-3">
						  <label class="control-label">Quantity
						  </label>
						  <input type="text" placeholder="Quantity" name="material_quantity[]" class="form-control" /> 
						</div>
						<div class="col-md-2">
						  <a href="javascript:;" data-repeater-delete class="btn btn-danger mt-repeater-delete">
							<i class="fa fa-close">
							</i>
						  </a>
						</div>
					  </div>
					</div>
				  </div>
				</div>
			  </div>
			  <?php } ?>
			</div>
			<!-- row -->
			<?php
		$display = "display:none";
		if (isset($incmplt_fields->ntrofunit))
		if ($incmplt_fields->ntrofunit == 'Manufacturing') {
		$display = "display:block";
		}
		?>
			<h3 class="form-section raw_material_header" style="<?= $display ?>">Products Manufacturing
			</h3>
			<div class="row manufactiring_detail product_to_be_manufactured" style="<?= $display ?>">
			  <?php
					if (isset($incmplt_fields->ntrofunit) && $incmplt_fields->ntrofunit == 'Manufacturing') {
					if (isset($incmplt_fields->Name_of_the_Raw_Material) && !empty($incmplt_fields->Name_of_the_Raw_Material)) {
					foreach ($incmplt_fields->Name_of_the_Raw_Material as $key => $raw_material) {
					echo '<div class="col-md-12 product_manufactured_body_class">
					<div class="form-group mt-repeater">';
					if ($key == 0) {
					echo '<a href="javascript:;" data-repeater-create class="btn btn-success mt-repeater-add">
					<i class="fa fa-plus"></i> Add New Product</a>';
					}
					echo '<div data-repeater-list="group-c">
					<div data-repeater-item class="mt-repeater-item product_manufactured_body_remove">
					<div class="row mt-repeater-row">
					<div class="col-md-4">
					<label class="control-label">Product Description</label>
					<input type="text" placeholder="Product Description" name="Product_Description[]" value= "' . @$incmplt_fields->Product_Description[$key] . '" class="form-control" /> </div>
					<div class="col-md-3">
					<label class="control-label">Annual Install Capacity</label>
					<input type="text" placeholder="Annual Install Capacity" name="Annual_Install_Capacity[]" value="' . @$incmplt_fields->Annual_Install_Capacity[$key] . '" class="form-control" /> </div>
					<div class="col-md-3">
					<label class="control-label">Quantity</label>
					<input type="text" placeholder="Quantity" name="product_manufactured_Quantity[]" value="' . @$incmplt_fields->product_manufactured_Quantity[$key] . '" class="form-control" /> </div>
					<div class="col-md-2">
					<a href="javascript:;" data-repeater-delete class="btn btn-danger mt-repeater-delete">
					<i class="fa fa-close"></i>
					</a>
					</div>
					</div>
					</div>
					</div>
					</div>
					</div>';
					}
					} else {
					echo '<div class="col-md-12 product_manufactured_body_class">
					<div class="form-group mt-repeater">
					<a href="javascript:;" data-repeater-create class="btn btn-success mt-repeater-add">
					<i class="fa fa-plus"></i> Add New Product</a>
					<div data-repeater-list="group-c">
					<div data-repeater-item class="mt-repeater-item product_manufactured_body_remove">
					<div class="row mt-repeater-row">
					<div class="col-md-4">
					<label class="control-label">Product Description</label>
					<input type="text" placeholder="Product Description" name="Product_Description[]" class="form-control" /> </div>
					<div class="col-md-3">
					<label class="control-label">Annual Install Capacity</label>
					<input type="text" placeholder="Requirement Unit" name="Annual_Install_Capacity[]" class="form-control" /> </div>
					<div class="col-md-3">
					<label class="control-label">Quantity</label>
					<input type="text" placeholder="Quantity" name="product_manufactured_Quantity[]" class="form-control" /> </div>
					<div class="col-md-2">
					<a href="javascript:;" data-repeater-delete class="btn btn-danger mt-repeater-delete">
					<i class="fa fa-close"></i>
					</a>
					</div>
					</div>
					</div>
					</div>
					</div>
					</div>';
					}
					} else {
					?>
			  <div class="col-md-12 product_manufactured_body_class">
				<div class="form-group mt-repeater">
				  <a href="javascript:;" data-repeater-create class="btn btn-success mt-repeater-add">
					<i class="fa fa-plus">
					</i> Add New Product
				  </a>
				  <div data-repeater-list="group-c">
					<div data-repeater-item class="mt-repeater-item product_manufactured_body_remove">
					  <div class="row mt-repeater-row">
						<div class="col-md-4">
						  <label class="control-label">Product Description
						  </label>
						  <input type="text" placeholder="Product Description" name="Product_Description[]" class="form-control" /> 
						</div>
						<div class="col-md-3">
						  <label class="control-label">Annual Install Capacity
						  </label>
						  <input type="text" placeholder="Requirement Unit" name="Annual_Install_Capacity[]" class="form-control" /> 
						</div>
						<div class="col-md-3">
						  <label class="control-label">Quantity
						  </label>
						  <input type="text" placeholder="Quantity" name="product_manufactured_Quantity[]" class="form-control" /> 
						</div>
						<div class="col-md-2">
						  <a href="javascript:;" data-repeater-delete class="btn btn-danger mt-repeater-delete">
							<i class="fa fa-close">
							</i>
						  </a>
						</div>
					  </div>
					</div>
				  </div>
				</div>
			  </div>
			  <?php } ?>
			</div>
			<!-- /row -->
			<h3 class="form-section">Process Description
			</h3>
			<div class="row">
			  <div class="col-md-6">
				<div class="form-group">
				  <label class="control-label col-md-3">Type of Industry
					<span class="required" aria-required="true"> * 
					</span>
				  </label>
				  <div class="col-md-9">
					<select name='type_of_industry' id="type_of_industry" class="form-control">
					  <option value="">---Please Select---
					  </option>
					  <option value="green" 
							  <?php if (isset($incmplt_fields->type_of_industry)) if ($incmplt_fields->type_of_industry == 'green') echo "selected"; ?>>Green
					  </option>
					<option value="orange" 
							<?php if (isset($incmplt_fields->type_of_industry)) if ($incmplt_fields->type_of_industry == 'orange') echo "selected"; ?>>Orange
					</option>
				  <option value="red" 
						  <?php if (isset($incmplt_fields->type_of_industry)) if ($incmplt_fields->type_of_industry == 'red') echo "selected"; ?>>Red
				  </option>
				<option value="white" 
						<?php if (isset($incmplt_fields->type_of_industry)) if ($incmplt_fields->type_of_industry == 'white') echo "selected"; ?>>White
				</option>
			  </select>
			<span class="help-block">
			</span>
		  </div>
		</div>
		</div>
		<div class="col-md-6">
		  <div class="form-group">
			<label class="control-label col-md-3">Date of Commercial Production
			  <span class="required" aria-required="true"> * 
			  </span>
			</label>
			<div class="col-md-9">
			  <div class="datedate-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
				<input type="text"  id="datepicker" class="form-control" readonly value="<?= @$incmplt_fields->expected_date_of_commercial_production ?>"  name="expected_date_of_commercial_production"
					   placeholder="Please select the production date">
			  </div>
			  <span class="help-block">
			  </span>
			</div>
		  </div>
		</div>
		</div>
		<!-- /row -->
		<div class="row">
		  <div class="col-md-6">
			<div class="form-group">
			  <label class="control-label col-md-3">Description
			  </label>
			  <div class="col-md-9">
				<textarea  id="Brief_Description_about_Processes" rows="3" class="form-control col-md-12"  name="Brief_Description_about_Processes" placeholder=" Brief_Description_about_Processes">
				  <?= @$incmplt_fields->Brief_Description_about_Processes ?>
				</textarea>
			  </div>
			</div>
		  </div>
		  <div class="col-md-6">
			<div class="form-group">
			  <label class="control-label col-md-3">NIC 5 Digit Code [comma seprated]
				<span class="required" aria-required="true"> * 
				</span>
			  </label>
			  <div class="col-md-9">
				<!--<input type="text" name="industry_type" class="form-control" placeholder="NIC 5 Digit Code - comma seprated" value="<?= @$incmplt_fields->industry_type; ?>">-->
			  <select name="industry_type" id="industry_type" class="form-control c">
                                                                       <option value="">---Please Select---</option>
                                                                       <?php 
                                                                          if(isset($industries) && !empty($industries)){
                                                                             foreach ($industries as $key => $industry) {
                                                                                echo "<option value='".$industry['Ans_ID']."'";
                                                                                  if(isset($incmplt_fields->industry_type) && $incmplt_fields->industry_type==$industry['Ans_ID'])
                                                                                      echo " selected ";
                                                                                echo ">".$industry['Ans_Text']."</option>";
                                                                             }
                                                                            
                                                                          }
                                                                       ?>      
                                                                    </select>
                              <span class="help-block">
				  <a href="<?= FRONT_BASEURL ?>themes/backend/uploads/New-Categorization-Industries-UEPPCB-January-2014.pdf" target="_blank">
					<b>Click to know your type of Industry
					</b>
				  </a>
				</span>
			  </div>
			</div>
		  </div>
		</div>
		<div class="row">
		  <!--/span-->
		  <div class="col-md-6">
			<div class="form-group">
			  <label class="control-label col-md-3">HSN Code(s) [comma seprated]
			  </label>
			  <div class="col-md-9">
				<input type="text"  id="hsn_code" class="form-control address_field_with_space" value="<?= @$incmplt_fields->hsn_code ?>"  name="hsn_code" placeholder="HSN Code(s) - comma seprated">
			  </div>
			</div>
		  </div>
		  <!--/span-->
		  <div class="col-md-6">
			<div class="form-group">
			  <label class="control-label col-md-3">SAC Code(s) [comma seprated]
			  </label>
			  <div class="col-md-9">
				<input type="text"  id="sac_code" class="form-control address_field_with_space" value="<?= @$incmplt_fields->sac_code ?>"  name="sac_code" placeholder="SAC Code(s) - comma seprated">
			  </div>
			</div>
		  </div>
		</div>
		<!-- /row -->
		<h3 class="form-section">Details of Investment (INR Crores)
		</h3>
		<div class="row">
		  <label class="control-label col-md-2" style="text-align: center;">Land
		  </label>
		  <label class="control-label col-md-2" style="text-align: center;">Building
		  </label>
		  <label class="control-label nature_label col-md-2" style="text-align: center;">Equipment
		  </label>
		  <label class="control-label col-md-2" style="text-align: center;">Capital Margin
		  </label>
		  <label class="control-label col-md-2" style="text-align: center;">Other
		  </label>
		  <label class="control-label col-md-2" style="text-align: center;">Total
		  </label>
		</div>
		<div class="row">
		  <div class="col-md-12">
			<div class="form-group">
			  <div class="col-md-2">
				<input type="text"  id="land0" class="form-control land decimal" maxlength="10" value="<?= @$incmplt_fields->invstmnt_in_land[0] ?>" onkeyup="sumupInst(0)" name="invstmnt_in_land[]" placeholder="Land">
				<span class="help-block">
				</span>
			  </div>
			  <div class="col-md-2">
				<input type="text"  id="building0" class="form-control building decimal" maxlength="10" value="<?= @$incmplt_fields->invstmnt_in_building[0] ?>" onkeyup="sumupInst(0)" name="invstmnt_in_building[]" placeholder="Building">
				<span class="help-block">
				</span>
			  </div>
			  <div class="col-md-2">
				<input type="text"  id="plant0" class="form-control  plant_value decimal" maxlength="10" value="<?= @$incmplt_fields->invstmnt_in_plant[0] ?>" onkeyup="sumupInst(0)" name="invstmnt_in_plant[]" placeholder="Plant & Machinery/Equipment">
				<span class="help-block">
				</span>
			  </div>
			  <div class="col-md-2">
				<input type="text"  id="wrkcapt0" class="form-control capital_margin decimal" maxlength="10" value="<?= @$incmplt_fields->invstmnt_in_wrkingcapital[0] ?>" onkeyup="sumupInst(0)" name="invstmnt_in_wrkingcapital[]" placeholder="Capital Margin">
				<span class="help-block">
				</span>
			  </div>
			  <div class="col-md-2">
				<input type="text"  id="other0" class="form-control other_cost decimal" maxlength="10" value="<?= @$incmplt_fields->invstmnt_in_other[0] ?>" onkeyup="sumupInst(0)" name="invstmnt_in_other[]" placeholder="Other">
				<span class="help-block">
				</span>
			  </div>
			  <div class="col-md-2">
				<input type="text"  id="total0" class="form-control decimal" maxlength="10" value="<?= @$incmplt_fields->invstmnt_in_total[0] ?>" readonly="readonly" name="invstmnt_in_total[]" placeholder="0.0">
				<span class="help-block">
				</span>
			  </div>
			</div>
		  </div>
		</div>
		<h3 class="form-section">Current Employment as on today
		</h3>
		<div class="row">
		  <div class="table-responsive">
			<table class="table table-bordered">
			  <thead>
				<tr>
				  <th> Category 
				  </th>
				  <th> Skilled 
				  </th>
				  <th> Unskilled 
				  </th>
				  <th> Supervisory 
				  </th>
				  <th> Engineer 
				  </th>
				  <th> IT/ITeS Professional 
				  </th>
				  <th> Management 
				  </th>
				  <th> Total 
				  </th>
				</tr>
			  </thead>
			  <tbody>
				<tr>
				  <td>Male
				  </td>
				  <td>
					<div class="form-group form-md-line-input">
					  <input type="text"  id="mskl0" class="form-control mskilled decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_mskilled[0] ?>" name="no_of_emp_mskilled[]" onkeyup="sumupEmp(0)" placeholder="Skilled">
					  <span class="help-block">
					  </span>
					</div>
				  </td>
				  <td>
					<div class="form-group form-md-line-input">
					  <input type="text"  id="munskl0" class="form-control munskilled decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_munskilled[0] ?>" name="no_of_emp_munskilled[]" onkeyup="sumupEmp(0)" placeholder="Unskilled">
					  <span class="help-block">
					  </span>
					</div>
				  </td>
				  <td>
					<div class="form-group form-md-line-input">
					  <input type="text"  id="msprvsr0" class="form-control msupvsr decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_msupervisory[0] ?>" name="no_of_emp_msupervisory[]" onkeyup="sumupEmp(0)" placeholder="Supervisory">
					  <span class="help-block">
					  </span>
					</div>
				  </td>
				  <td>
					<div class="form-group form-md-line-input">
					  <input type="text"  id="mengg0" class="form-control mengg decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_mengineer[0] ?>" name="no_of_emp_mengineer[]" onkeyup="sumupEmp(0)" placeholder="Engineer">
					  <span class="help-block">
					  </span>
					</div>
				  </td>
				  <td>
					<div class="form-group form-md-line-input">
					  <input type="text"  id="mit0" class="form-control mitprof decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_it_mprofessional[0] ?>" name="no_of_emp_it_mprofessional[]" onkeyup="sumupEmp(0)" placeholder="IT/ITeS Professional">
					  <span class="help-block">
					  </span>
					</div>
				  </td>
				  <td>
					<div class="form-group form-md-line-input">
					  <input type="text"  id="mmngmnt0" class="form-control mmngmt decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_mmanagement[0] ?>" name="no_of_emp_mmanagement[]" onkeyup="sumupEmp(0)" placeholder="Management">
					  <span class="help-block">
					  </span>
					</div>
				  </td>
				  <td>
					<div class="form-group form-md-line-input">
					  <input type="text"  id="memptotal0" class="form-control" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_mtotal[0] ?>" name="no_of_emp_mtotal[]" readonly placeholder="Total">
					  <span class="help-block">
					  </span>
					</div>
				  </td>
				</tr>
				<tr>
				  <td>Female
				  </td>
				  <td>
					<div class="form-group form-md-line-input">
					  <input type="text"  id="fskl0" class="form-control fskilled decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_fskilled[0] ?>" name="no_of_emp_fskilled[]" onkeyup="fsumupEmp(0)" placeholder="Skilled">
					  <span class="help-block">
					  </span>
					</div>
				  </td>
				  <td>
					<div class="form-group form-md-line-input">
					  <input type="text"  id="funskl0" class="form-control funskilled decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_funskilled[0] ?>" name="no_of_emp_funskilled[]" onkeyup="fsumupEmp(0)" placeholder="Unskilled">
					  <span class="help-block">
					  </span>
					</div>
				  </td>
				  <td>
					<div class="form-group form-md-line-input">
					  <input type="text"  id="fsprvsr0" class="form-control mfupvsr decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_fsupervisory[0] ?>" name="no_of_emp_fsupervisory[]" onkeyup="fsumupEmp(0)" placeholder="Supervisory">
					  <span class="help-block">
					  </span>
					</div>
				  </td>
				  <td>
					<div class="form-group form-md-line-input">
					  <input type="text"  id="fengg0" class="form-control feggg decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_fengineer[0] ?>" name="no_of_emp_fengineer[]" onkeyup="fsumupEmp(0)" placeholder="Engineer">
					  <span class="help-block">
					  </span>
					</div>
				  </td>
				  <td>
					<div class="form-group form-md-line-input">
					  <input type="text"  id="fit0" class="form-control fitprof decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_it_fprofessional[0] ?>" name="no_of_emp_it_fprofessional[]" onkeyup="fsumupEmp(0)" placeholder="IT/ITeS Professional">
					  <span class="help-block">
					  </span>
					</div>
				  </td>
				  <td>
					<div class="form-group form-md-line-input">
					  <input type="text"  id="fmngmnt0" class="form-control fmngmt decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_fmanagement[0] ?>" name="no_of_emp_fmanagement[]" onkeyup="fsumupEmp(0)" placeholder="Management">    
					  <span class="help-block">
					  </span>
					</div>
				  </td>
				  <td>
					<div class="form-group form-md-line-input">
					  <input type="text"  id="femptotal0" class="form-control" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_ftotal[0] ?>" name="no_of_emp_ftotal[]" readonly placeholder="Total">
					  <span class="help-block">
					  </span>
					</div>
				  </td>
				</tr>
			  </tbody>
			</table>
		  </div>
		</div> 
		</div>
		</div>
		</div>
		</div>
		<div class="tab-pane" id="tab3">
		  <!-- <h3 class="block">Requirements</h3>-->
		  <div class="portlet box green">
			<div class="portlet-title">
			  <div class="caption">
				<i class="fa fa-gift">
				</i>Registration of Existing Unit Application -Step 3 
			  </div>
			  <div class="tools">
				<a href="javascript:;" class="collapse"> 
				</a>
				<a href="javascript:;" class="reload"> 
				</a>
			  </div>
			</div>
			<div class="portlet-body form">
			  <!-- BEGIN FORM-->
			  <div class="form-body">
				<h3 class="form-section">Details of Land
				</h3>
				<div class="row">
				  <!--/span-->
				  <div class="col-md-6">
					<div class="form-group">
					  <label class="control-label col-md-3">Land Details
						<span class="required" aria-required="true"> * 
						</span>
					  </label>
					  <div class="col-md-9">
						<select name="Proposed_details_of_Land" id='Proposed_details_of_Land' class="form-control">
						  <option value="">* Land Details
						  </option>
						  <option value="Notified Land" 
								  <?php if (isset($incmplt_fields->Proposed_details_of_Land)) if ($incmplt_fields->Proposed_details_of_Land == 'Notified Land') echo "selected"; ?>>Notified Land
						  </option>
						<option value="SIIDCUL Land" 
								<?php if (isset($incmplt_fields->Proposed_details_of_Land)) if ($incmplt_fields->Proposed_details_of_Land == 'SIIDCUL Land') echo "selected"; ?> >SIIDCUL Land
						</option>
					  <option value="DI Land" 
							  <?php if (isset($incmplt_fields->Proposed_details_of_Land)) if ($incmplt_fields->Proposed_details_of_Land == 'DI Land') echo "selected"; ?>>DI Land
					  </option>
					<option value="Rented Space" 
							<?php if (isset($incmplt_fields->Proposed_details_of_Land)) if ($incmplt_fields->Proposed_details_of_Land == 'Rented Space') echo "selected"; ?>>Rented Space
					</option>
				  <option value="Own Land/Space" 
						  <?php if (isset($incmplt_fields->Proposed_details_of_Land)) if ($incmplt_fields->Proposed_details_of_Land == 'Own Land/Space') echo "selected"; ?>>Own Land/Space
				  </option>
				<option value="Private Industrial Estate" 
						<?php if (isset($incmplt_fields->Proposed_details_of_Land)) if ($incmplt_fields->Proposed_details_of_Land == 'Private Industrial Estate') echo "selected"; ?>>Private Industrial Estate
				</option>
			  <option value="Other" 
					  <?php if (isset($incmplt_fields->Proposed_details_of_Land)) if ($incmplt_fields->Proposed_details_of_Land == 'Other') echo "selected"; ?>>Other/Purchase
			  </option>
			</select>                                                                
		  <span class="help-block">  
		  </span>
		</div>
		</div>
		</div>
		<div class="col-md-6" id="industrial_area1" 
			 <?php if (isset($incmplt_fields->Proposed_details_of_Land)) if ($incmplt_fields->Proposed_details_of_Land == 'SIIDCUL Land'){ ?>style="display:block" 
		<?php }else{  ?> style="display:none" 
		<?php } ?>>
		<div class="form-group">
		  <label class="control-label col-md-3">Industrial Area
			<!--<span class="required" aria-required="true"> * </span>-->
		  </label>
		  <div class="col-md-9">
			<select name="industrial_area" id="industrial_area" class="form-control " >
			  <option value=''>Please Select
			  </option>
			  <?php 
					$sql="select * from bo_industrial_area_master where is_active='Y'";
					$industryAssociationList = Yii::app()->db->createCommand($sql)->queryAll();
					if (isset($industryAssociationList) && !empty($industryAssociationList)) {
					foreach ($industryAssociationList as $key => $ia) {
					echo "<option value='" . $ia['id'] . "'";
					if (@$incmplt_fields->industrial_area == $ia['id'])
					echo " selected ";
					echo ">" . $ia['industrial_area'] . "</option>";
					}
					}
					?>
			</select>
			<span class="help-block">
			</span>
		  </div>
		</div>
		</div>
		<!--/span-->
		</div>
		<!--/row-->
		<!--<h3 class="form-section"></h3>-->
		<div class="row">
		  <div class="col-md-6 land_leased_other">
			<div class="form-group">
			  <label class="control-label check_no_own_land_lable col-md-3">Land in Sq. Meters
				<span class="required" aria-required="true"> * 
				</span>
			  </label>
			  <div class="col-md-9">
				<input type="text"  name="Land_in_Hectares" id="Land_in_Heetares" class="form-control decimal"  value="<?= @$incmplt_fields->Land_in_Hectares ?>"  placeholder="* Area">
				<span class="help-block">
				</span>
			  </div>
			</div>
		  </div>
		  <!--/span-->
		  <div class="col-md-6">
			<div class="form-group">
			  <label class="control-label col-md-3">Address
				<span class="required" aria-required="true"> * 
				</span>
			  </label>
			  <div class="col-md-9">
				<input type="text"  id="land_address" class="form-control address_field_with_space" maxlength="100" value="<?= @$incmplt_fields->land_address ?>" name="land_address" placeholder="* Street Name/City">                                               
				<span class="help-block">  
				</span>
			  </div>
			</div>
		  </div>
		  <!--/span-->
		</div>
		<!-- /row -->
		<div class="append_later">
		  <div class="row">
			<?php
		if (isset($incmplt_fields->land_area_pin_code)) {
		?>
			<div class="col-md-6 land_leased_other">
			  <div class="form-group">
				<label class="control-label check_no_own_land_lable col-md-3">Pin Code
				  <span class="required" aria-required="true"> * 
				  </span>
				</label>
				<div class="col-md-9">
				  <input type="text"  name="land_area_pin_code" id="land_area_pin_code" class="six_digit_zip_code form-control" value="<?= @$incmplt_fields->land_area_pin_code ?>" placeholder="* Pincode">
				  <span class="help-block">
				  </span>
				</div>
			  </div>
			</div>
			<!--/span-->
			<?php
		}
		if (isset($incmplt_fields->Khasra_no)) {
		?>
			<div class="col-md-6">
			  <div class="form-group">
				<label class="control-label col-md-3">Plot/Khasra No
				  <span class="required" aria-required="true"> * 
				  </span>
				</label>
				<div class="col-md-9">
				  <input type="text"  id="Khasra_no" class="form-control address_field_with_space" maxlength="100" value="<?= @$incmplt_fields->Khasra_no ?>" name="Khasra_no" placeholder="* Plot/Khasra_no">                                            
				  <span class="help-block">  
				  </span>
				</div>
			  </div>
			</div>
			<?php } ?>
			<!--/span-->
		  </div>
		  <!-- /row -->
		</div>
		<div class="row">
		 
		  <!--/span-->
		  <div class="col-md-6">
			<div class="form-group">
			  <label class="control-label col-md-3">District
				<span class="required" aria-required="true"> * 
				</span>
			  </label>
			  <div class="col-md-9">
				<select name='land_leased_disctric' id="land_leased_disctric" class="form-control">
				  <option value="">---Please Select District ---
				  </option>
				  <?php
					$criteria = new CDbCriteria;
					$criteria->select = "district_id,distric_name";
					$criteria->condition = "is_active=:active";
					$criteria->params = array(":active" => "Y");
					$district = District::model()->findAll($criteria);
					if (!empty($district)) {
					foreach ($district as $key => $dist) {
					echo '<option value="' . $dist->district_id . '"';
					if (isset($incmplt_fields->land_leased_disctric))
					if ($incmplt_fields->land_leased_disctric == $dist->district_id)
					echo "selected";
					echo '>' . $dist->distric_name . '</option>';
					}
					}
					?>
				</select>                                             
				<span class="help-block">  
				</span>
			  </div>
			</div>
		  </div>
		   <div class="col-md-6 land_leased_other">
			<div class="form-group">
			  <label class="control-label check_no_own_land_lable col-md-3">Tehsil
			  </label>
			  <div class="col-md-9">
				<input type="text"  id="Location" class="form-control name_with_space" value="<?= @$incmplt_fields->tehsil ?>" maxlength="100" name="tehsil" placeholder="Tehsil">
				<span class="help-block">
				</span>
			  </div>
			</div>
		  </div>
		  <!--/span-->
		</div>
		<!-- /row -->
		<div class="land_leased" style="display:none">
		  <div class="row">
			<div class="col-md-6">
			  <div class="form-group">
				<label class="control-label check_no_own_land_lable col-md-3">Area In sq Meters
				  <span class="required" aria-required="true"> * 
				  </span>
				</label>
				<div class="col-md-9">
				  <input type="text"  id="detail_of_leased_space_area_in_sq_meters" class="form-control decimal" value="<?= @$incmplt_fields->detail_of_leased_space_area_in_sq_meters ?>" name="detail_of_leased_space_area_in_sq_meters" placeholder="* Area in Sq. Meters">
				  <span class="help-block">
				  </span>
				</div>
			  </div>
			</div>
			<!--/span-->
			<div class="col-md-6">
			  <div class="form-group">
				<label class="control-label check_no_own_land_lable col-md-3">Address
				  <span class="required" aria-required="true"> * 
				  </span>
				</label>
				<div class="col-md-9">
				  <input type="text" id="detail_of_leased_address" class="form-control address_field_with_space" maxlength="100" value="<?= @$incmplt_fields->detail_of_leased_address ?>" name="detail_of_leased_address" placeholder="* Address">
				  <span class="help-block">
				  </span>
				</div>
			  </div>
			</div>
			<!--/span-->
		  </div>
		  <!-- /row -->
		  <div class="row">
			<div class="col-md-6">
			  <div class="form-group">
				<label class="control-label check_no_own_land_lable col-md-3">Tehsil
				  <span class="required" aria-required="true"> * 
				  </span>
				</label>
				<div class="col-md-9">
				  <input type="text"  id="detail_of_leased_space_tehsil" class="form-control name_with_space" maxlength="100" value="<?= @$incmplt_fields->detail_of_leased_space_tehsil ?>" name="detail_of_leased_space_tehsil" placeholder="* Tehsil">
				  <span class="help-block">
				  </span>
				</div>
			  </div>
			</div>
			<!--/span-->
			<div class="col-md-6">
			  <div class="form-group">
				<label class="control-label check_no_own_land_lable col-md-3">District
				  <span class="required" aria-required="true"> * 
				  </span>
				</label>
				<div class="col-md-9">
				  <select name='land_disctric' id="land_disctric" class="form-control">
					<option value="">* Please Select District
					</option>
					<?php
						if (!empty($district)) {
						foreach ($district as $key => $dist) {
						echo '<option value="' . $dist->district_id . '"';
						if (isset($incmplt_fields->land_leased_disctric))
						if ($incmplt_fields->land_leased_disctric == $dist->district_id)
						echo "selected";
						echo '>' . $dist->distric_name . '</option>';
						}
						}
						?>
				  </select>
				  <span class="help-block">
				  </span>
				</div>
			  </div>
			</div>
			<!--/span-->
		  </div>
		  <!-- /row -->
		</div>
		<h3 class="form-section">Utility Details
		</h3>
		<div class="row">
		  <div class="col-md-6">
			<div class="table-responsive">
			  <table class="table table-bordered">
				<thead>
				  <tr>
					<th> Water Requirement 
					</th>
					<th> Quality 
					</th>
					<th> Unit 
					</th>
				  </tr>
				</thead>
				<tbody>
				  <tr>    
					<td>
					  <div class="form-group form-md-line-input">
						<label class="control-label check_no_own_land_lable">Industrial
						</label>
					  </div>
					</td>
					<td>
					  <div class="form-group form-md-line-input">
						<input type="text" name="industrial_water" value="<?= @$incmplt_fields->industrial_water ?>" class="decimal form-control">
						<span class="help-block">
						</span>
					  </div>
					</td>
					<td>
					  <div class="form-group form-md-line-input">
						<label class="control-label check_no_own_land_lable">Liters/Year
						</label>
					  </div>
					</td>
				  </tr>
				  <tr>
					<td>
					  <div class="form-group form-md-line-input">
						<label class="control-label check_no_own_land_lable">Domestic
						</label>
					  </div>
					</td>
					<td>
					  <div class="form-group form-md-line-input">
						<input type="text" name="domestic_water" value="<?= @$incmplt_fields->domestic_water ?>" class="decimal form-control">
						<span class="help-block">
						</span>
					  </div>
					</td>
					<td>
					  <div class="form-group form-md-line-input">
						<label class="control-label check_no_own_land_lable">Liters/Year
						</label>
					  </div>
					</td>
				  </tr>
				  <tr>
					<td>
					  <div class="form-group form-md-line-input">
						<label class="control-label check_no_own_land_lable">Source of water
						</label>
					  </div>
					</td>
					<td colspan="2"> 
					  <div class="form-group form-md-line-input">
						<input type="text" name="source_of_water" value="<?= @$incmplt_fields->source_of_water ?>" class="form-control name_with_space">
						<span class="help-block">
						</span>
					  </div>
					</td>
				  </tr>
				</tbody>
			  </table>
			</div>
		  </div>
		  <div class="col-md-6">
			<div class="table-responsive">
			  <table class="table table-bordered">
				<thead>
				  <tr>
					<th> Source of Power 
					</th>
					<th> Quantity 
					</th>
					<th> Unit 
					</th>
				  </tr>
				</thead>
				<tbody>
				  <tr>    
					<td>
					  <div class="form-group form-md-line-input">
						<label class="control-label">Coal
						</label>
					  </div>
					</td>
					<td>
					  <div class="form-group form-md-line-input">
						<input type="text" name="coal" value="<?= @$incmplt_fields->coal ?>" class="decimal form-control">
						<span class="help-block">
						</span>
					  </div>
					</td>
					<td>
					  <div class="form-group form-md-line-input">
						<label class="control-label">TONNES
						</label>
					  </div>
					</td>
				  </tr>
				  <tr>
					<td>
					  <div class="form-group form-md-line-input">
						<label class="control-label ">Liquid Petrolium Gas
						</label>
					  </div>
					</td>
					<td>
					  <div class="form-group form-md-line-input">
						<input type="text" name="lpg" value="<?= @$incmplt_fields->lpg ?>"  class="decimal form-control">
						<span class="help-block">
						</span>
					  </div>
					</td>
					<td>
					  <div class="form-group form-md-line-input">
						<label class="control-label">KILOGRAM
						</label>
					  </div>
					</td>
				  </tr>
				  <tr>
					<td>
					  <div class="form-group form-md-line-input">
						<label class="control-label">Electricity
						</label>
					  </div>
					</td>
					<td>
					  <div class="form-group form-md-line-input">
						<input type="text" name="electricity" value="<?= @$incmplt_fields->electricity ?>" class="decimal form-control">
						<span class="help-block">
						</span>
					  </div>
					</td>
					<td>
					  <div class="form-group form-md-line-input">
						<label class="control-label">KVA
						</label>
					  </div>
					</td>
				  </tr>
				  <tr>
					<td>    
					  <div class="form-group form-md-line-input">
						<label class="control-label">Solar
						</label>
					  </div>
					</td>
					<td>
					  <div class="form-group form-md-line-input">
						<input type="text" name="solar" value="<?= @$incmplt_fields->solar ?>"  class="decimal form-control">
						<span class="help-block">
						</span>
					  </div>
					</td>
					<td>
					  <div class="form-group form-md-line-input">
						<label class="control-label">KW
						</label>
					  </div>
					</td>
				  </tr>
				</tbody>
			  </table>
			</div>
		  </div>
		</div>
		<!-- /row -->
		</div>
		</div>
		</div>
		</div>
		<!----------------------------------------------------------------------------------------------------------------------->
		<div class="tab-pane" id="tab4">
		  <!-- <h3 class="block">Requirements</h3>-->
		  <div class="portlet box green">
			<div class="portlet-title">
			  <div class="caption">
				<i class="fa fa-gift">
				</i>Registration of Existing Unit Application -Step 4 
			  </div>
			  <div class="tools">
				<a href="javascript:;" class="collapse"> 
				</a>
				<a href="javascript:;" class="reload"> 
				</a>
			  </div>
			</div>
			<div class="portlet-body form">
			  <!-- BEGIN FORM-->
			  <div class="form-body">
				<h3 class="form-section">Existing Registration Details 
				</h3>
				<div class="row"><div class="col-md-12" style="color:red;padding:5px;"><b>Note:</b> You need to fill atleast one among <b>EM Part-2 Details</b>,<b>UAM</b>, <b>IEM data</b> & <b>PCB Id</b>. </div></div>
				<hr>
				<div class="row">
				  <div class="col-md-6">
					<div class="form-group">
					  <label class="control-label col-md-3">EM Part-2 Details 
						<?php echo @$app_id; ?>
						<!--<span class="required" aria-required="true"> * </span>-->
					  </label>
					  <div class="col-md-9">
						<input type="text"  id="em_detail" title="Entrepreneur Memorandum" class="form-control" name='em_detail' value="<?= @$incmplt_fields->em_detail ?>"  placeholder="Entrepreneur Memorandum Part II Details">
						<span class="help-block">
						</span>
					  </div>
					</div>
				  </div>
				  <div class="col-md-6">
					<div class="form-group">
					  <label class="control-label col-md-3" title="Udhyog Aadhar Memorendum">UAM
						<!--<span class="required" aria-required="true"> * </span>-->
					  </label>
					  <div class="col-md-9">
						<input type="text"  id="uam" class="form-control" name='uam' value="<?= @$incmplt_fields->uam ?>"  placeholder="Udhyog Aadhar Memorendum" >
						<span class="help-block">
						</span>
					  </div>
					</div>
				  </div>
				  <!--/span-->
				</div>
				<div class="row">
				  <div class="col-md-6">
					<div class="form-group">
					  <label class="control-label col-md-3">IEM data
						<!--<span class="required" aria-required="true"> * </span>-->
					  </label>
					  <div class="col-md-9">
						<input type="text" placeholder="Industrial Entrepreneurs' Memorandum" id="iem_data" class="form-control" name='iem_data' value="<?= @$incmplt_fields->iem_data ?>"  placeholder="Industrial Entrepreneurs' Memorandum">
						<span class="help-block">
						</span>
					  </div>
					</div>
				  </div>
				  <!--/span-->
				  <div class="col-md-6">
					<div class="form-group">
					  <label class="control-label col-md-3" title='Pollution Control Borad Id'>PCB Id
						<!--<span class="required" aria-required="true"> * </span>-->
					  </label>
					  <div class="col-md-9">
						<input type="text"  id="pcb_id" class="form-control" name='pcb_id' value="<?= @$incmplt_fields->pcb_id ?>"  placeholder="Pollution Control Board Id">                                                              
						<span class="help-block">  
						</span>
					  </div>
					</div>
				  </div>
				  <!--/span-->
				</div>
				<!--/row-->
				<div class="row">
				  <div class="col-md-6"> 
					<div class="form-group">
					  <label class="control-label col-md-3">Is an Ancillary Unit
						<!--<span class="required" aria-required="true"> * </span>-->
					  </label>
					  <div class="col-md-9">
						<select required name="is_unit_ancillary" id="is_unit_ancillary" class="form-control">
						  <option value="">---Please Select---
						  </option>
						  <option value="Yes" 
								  <?php if(@$incmplt_fields->is_unit_ancillary=="Yes"){ echo " selected";}?>>Yes
						  </option>
						<option value="No" 
								<?php if(@$incmplt_fields->is_unit_ancillary=="No"){ echo " selected";}?>>No
						</option>
					  </select>
					<span class="help-block">
					</span>
				  </div>
				</div>
			  </div>
			  <!--/span-->
			  <div class="col-md-6">
				<div class="form-group">
				  <label class="control-label col-md-3" title='Is Unit Registered Under Factory Act'>Is Unit Registered Under Factory Act
					<!--<span class="required" aria-required="true"> * </span>-->
				  </label>
				  <div class="col-md-9">
					<select required name="is_unit_ancillary_user_factory_act" id="is_unit_ancillary_user_factory_act" class="form-control">
					  <option value="">---Please Select---
					  </option>
					  <option value="Yes" 
							  <?php if(@$incmplt_fields->is_unit_ancillary_user_factory_act=="Yes"){ echo " selected";}?>>Yes
					  </option>
					<option value="No" 
							<?php if(@$incmplt_fields->is_unit_ancillary_user_factory_act=="No"){ echo " selected";}?>>No
					</option>
				  </select>
				<span class="help-block">  
				</span>
			  </div>
			</div>
		  </div>
		  <!--/span-->
		</div>
		<div class="row">
		  <div class="col-md-6">
			<div class="form-group">
			  <label class="control-label col-md-3">Is registered with any Industrial Association
				<!--<span class="required" aria-required="true"> * </span>-->
			  </label>
			  <div class="col-md-9">
				<select name="is_unit_associated_with_ia" id="is_unit_associated_with_ia" class="form-control" required>
				  <option value="">---Please Select---
				  </option>
				  <option value="Yes" 
						  <?php if(@$incmplt_fields->is_unit_associated_with_ia=="Yes"){ echo " selected";}?>>Yes
				  </option>
				<option value="No" 
						<?php if(@$incmplt_fields->is_unit_associated_with_ia=="No"){ echo " selected";}?>>No
				</option>
			  </select>
			<span class="help-block">
			</span>
		  </div>
		</div>
		</div>
		<div class="col-md-6">
		  <div class="form-group">
			<label class="control-label col-md-3">Industry Association
			  <!--<span class="required" aria-required="true"> * </span>-->
			</label>
			<div class="col-md-9">
			  <select name="industory_association" id="industory_association" class="form-control  ">
				<?php 
					$sql="select * from bo_industrial_association where is_active='Y'";
					$industryAssociationList = Yii::app()->db->createCommand($sql)->queryAll();
					if (isset($industryAssociationList) && !empty($industryAssociationList)) {
					foreach ($industryAssociationList as $key => $ia) {
					echo "<option value='" . $ia['id'] . "'";
					if (@$incmplt_fields->industory_association == $ia['id'])
					echo " selected ";
					echo ">" . $ia['association_name'] . "</option>";
					}
					}
					?>
			  </select>
			  <span class="help-block">
			  </span>
			</div>
		  </div>
		</div>
		</div>
		<!----------------------------------------------------------------------------------------------------------------------->
		<h3 class="form-section ">Renewable Details
		</h3>
			<?php
			// echo  "<pre>";print_r(@$incmplt_fields); 
			if (isset($incmplt_fields->department_id) && !empty($incmplt_fields->department_id)) {
			foreach ($incmplt_fields->department_id as $key => $hgsfjfjsdgf) {
			$dddkey = @$incmplt_fields->department_id[$key];
			$ssskey = @$incmplt_fields->service_id[$key];
			$vvvkey = @$incmplt_fields->valid_upto[$key];
			$cern   = @$incmplt_fields->certificate_number[$key];
			?>
		<div class="row">
		  <div class="col-md-12 ">
			<div class="form-group mt-repeater">
			  <?php if ($key == 0) { ?> 
			  <a href="javascript:;" data-repeater-create class="btn btn-success mt-repeater-add addservice" rel="<?php echo $key; ?>">
				<i class="fa fa-plus">
				</i> Add New 
			  </a>
			  <?php } ?>
			  <div data-repeater-list="group-c">
				<div data-repeater-item class="mt-repeater-item remove_body_part">
				  <div class="row mt-repeater-row">
					<div class="col-md-3">
					  <label class="control-label">Department 
						<?php //echo $dddkey;  ?>
					  </label>
					  <select name="department_id[]" id="department_id<?php echo $key; ?>" class="form-control depty " onchange="showUser(this.value, this.getAttribute('rel'))" rel="<?php echo $key; ?>">
						<option value="">---Please Select---
						</option>
						<?php
							$sql = "SELECT bo_infowizard_issuerby_master.issuerby_id,bo_infowizard_issuerby_master.name 
							FROM bo_infowizard_issuerby_master 
							LEFT JOIN bo_information_wizard_service_master ON bo_infowizard_issuerby_master.issuerby_id=bo_information_wizard_service_master.issuerby_id
							where bo_infowizard_issuerby_master.issuer_id=2 and bo_infowizard_issuerby_master.is_issuerby_active='Y'
							and bo_information_wizard_service_master.to_be_used_in_iw='Y' 
							group by bo_infowizard_issuerby_master.issuerby_id";
							$connection = Yii::app()->db;
							$command = $connection->createCommand($sql);
							$deptDAta = $command->queryAll();
							if (isset($deptDAta) && !empty($deptDAta)) {
							foreach ($deptDAta as $key => $deptdataa) {
							echo "<option value='" . $deptdataa['issuerby_id'] . "'";
							if ($dddkey == $deptdataa['issuerby_id'])
							echo " selected ";
							echo ">" . $deptdataa['name'] . "</option>";
							}
							}
							?>      
					  </select> 
					</div> 
					<div class="col-md-3">
					  <label class="control-label">Service Name
						<?php //echo $ssskey;  ?>
					  </label>
					  <?php if (!empty($ssskey) && !empty($dddkey)) {
						$sql = "SELECT bo_information_wizard_service_parameters.service_id,bo_information_wizard_service_parameters.core_service_name,bo_information_wizard_service_parameters.servicetype_additionalsubservice 
						FROM  bo_information_wizard_service_master 
						LEFT JOIN bo_information_wizard_service_parameters ON bo_information_wizard_service_master.id=bo_information_wizard_service_parameters.service_id
						where bo_information_wizard_service_parameters.servicetype_additionalsubservice!=2 and bo_information_wizard_service_master.issuerby_id=$dddkey";
						$connection = Yii::app()->db;
						$command = $connection->createCommand($sql);
						$AllIssuerBy = $command->queryAll();
						?>
					  <select name="service_id[]" id="service_id<?php echo $key; ?>" class="form-control servy" >
						<?php
						echo "<option value=''><-----Select-----></option>";
						if (isset($AllIssuerBy)) {
						foreach ($AllIssuerBy as $vs) {
						?>
						<option value="<?php echo $vs['service_id'].'.'.$vs['servicetype_additionalsubservice']; ?>" 
								<?php if ($ssskey == $vs['service_id'].'.'.$vs['servicetype_additionalsubservice']) echo "selected"; ?> >
						<?php echo $vs['core_service_name']; ?>
						</option>
					  <?php
						}
						}
						?>
					  </select>
					<?php } else { ?>
					<select class="form-control servy"  name="service_id[]" id="service_id<?php echo $key; ?>" >
					</select>
					<?php } ?>
				  </div>
				  <div class="col-md-2">
					<label class="control-label" >Certificate Number
					</label> 
					<input type="text" name="certificate_number[]" class="form-control form-filter input-sm" value="<?php echo @$cern;?>">
				  </div>
				  <div class="col-md-2">
					<label class="control-label">Valid Upto
					</label> 
					<input type="text"  id="datepicker<?php echo $key;?>" name="valid_upto[]" class="form-control form-filter input-sm datepickers" readonly min="<?php echo date('Y-m-d'); ?>"  placeholder="Valid Upto" value="<?php echo $vvvkey; ?>">
				  </div>
				  <div class="col-md-1">
					<a href="javascript:;" data-repeater-delete class="btn btn-danger mt-repeater-delete">
					  <i class="fa fa-close">
					  </i>
					</a>
				  </div>
				</div>
			  </div>
			</div>
		  </div>
		</div>
		</div>
		<?php }
		} else {
		?>
		<div class="row">
		  <div class="col-md-12 ">
			<div class="form-group mt-repeater">
			  <a href="javascript:;" data-repeater-create class="btn btn-success mt-repeater-add addservice" rel="0">
				<i class="fa fa-plus">
				</i> Add New 
			  </a>
			  <div data-repeater-list="group-c">
				<div data-repeater-item class="mt-repeater-item remove_body_part">
				  <div class="row mt-repeater-row">
					<div class="col-md-3">
					  <label class="control-label">Department
					  </label>
					  <select name="department_id[]" id="department_id0" class="form-control depty " onchange="showUser(this.value, this.getAttribute('rel'))" rel="0">
						<option value="">---Please Select---
						</option>
						<?php
							$sql = "SELECT bo_infowizard_issuerby_master.issuerby_id,bo_infowizard_issuerby_master.name 
							FROM bo_infowizard_issuerby_master 
							LEFT JOIN bo_information_wizard_service_master ON bo_infowizard_issuerby_master.issuerby_id=bo_information_wizard_service_master.issuerby_id
							where bo_infowizard_issuerby_master.issuer_id=2 and bo_infowizard_issuerby_master.is_issuerby_active='Y'
							and bo_information_wizard_service_master.to_be_used_in_iw='Y' 
							group by bo_infowizard_issuerby_master.issuerby_id";
							$connection = Yii::app()->db;
							$command = $connection->createCommand($sql);
							$deptDAta = $command->queryAll();
							if (isset($deptDAta) && !empty($deptDAta)) {
							foreach ($deptDAta as $key => $deptdataa) {
							echo "<option value='" . $deptdataa['issuerby_id'] . "'";
							echo ">" . $deptdataa['name'] . "</option>";
							}
							}
							?>      
					  </select> 
					</div>
					<div class="col-md-3">
					  <label class="control-label">Service Name
					  </label>
					  <select class="form-control servy"  name="service_id[]" id="service_id0" >
					  </select>
					  <!-- <input type="text" placeholder="Service Name" name="service_id[]" class="form-control" /> -->
					</div>
					<div class="col-md-2">
					  <label class="control-label" >Certificate Number
					  </label> 
					  <input type="text" name="certificate_number[]" class="form-control form-filter input-sm" >
					</div>
					<div class="col-md-2">
					  <label class="control-label">Valid Upto
					  </label> 
					  <input type="text"  id="datepicker<?php echo $key;?>" name="valid_upto[]" class="form-control form-filter input-sm datepickers" readonly  
							 min="<?php echo date('Y-m-d'); ?>"  placeholder="Valide Upto">
					</div>
					<div class="col-md-1">
					  <a href="javascript:;" data-repeater-delete class="btn btn-danger mt-repeater-delete">
						<i class="fa fa-close">
						</i>
					  </a>
					</div>
				  </div>
				</div>
			  </div>
			</div>
		  </div>
		</div>
		<?php } ?>
		<!----------------------------------------------------------------------------------------------------------------------->
		<!-- row --> 
		</div>             
		</div>   
		</div>
		</div>
		<!----------------------------------------------------------------------------------------------------------------------->
		<div class="tab-pane"  id="tab5">
		  <div class="portlet box green" dis>
			<div class="portlet-title">
			  <div class="caption">
				<i class="fa fa-gift">
				</i>Registration of Existing Unit Application -Step 5- Checklist 
			  </div>
			  <div class="tools">
				<a href="javascript:;" class="collapse"> 
				</a>
				<a href="javascript:;" class="reload"> 
				</a>
			  </div>
			</div>
			<div class="portlet-body form">
			  <div class="form-body">
				<h3 class="form-section">Uploaded Documents
				</h3>
				<div class="row">  
							  <?php // Fetching Uploaded Document
								$docUploadPening = false;
								$userID = $_SESSION['RESPONSE']['user_id'];
								$criteria=new CDbCriteria;                                       
								$criteria->condition="user_id=:uid AND application_id=:app_id AND (application_status='I' || application_status='H' || application_status='B')";
								$criteria->params=array(":uid"=>$_SESSION['RESPONSE']['user_id'],":app_id"=>11);
								$criteria->order="submission_id DESC";
								$model1=ApplicationSubmission::model()->find($criteria);
								$documents_datas = array();$list_arr=array();
								if(!empty($model1)){
								$sqlspapp="Select sno from bo_sp_applications where app_id=$model1->submission_id AND sp_tag='DOI@908#123' LIMIT 1";
								$result = Yii::app()->db->createCommand($sqlspapp)->queryRow();
								if(!empty($result)){ 
								$AppDmsMapExt = new ApplicationDmsDocumentsMappingExt;
								$status_array['U'] = 'Pending';
								$status_array['V'] = 'Approved';
								$status_array['R'] = 'Rejected';
								$status_array_lb['U'] = 'warning';
								$status_array_lb['V'] = 'success';
								$status_array_lb['R'] = 'danger';
								$count_unverified = $AppDmsMapExt->getUsedDocumentsCount(1,'U');
								$list_arr =  $AppDmsMapExt::getAllUsedDocumentsOfInvestorServiceWise($result['sno'],$userID,'U');  
								}
								}
								?>
				  <table id="sample_31" class="table table-striped table-bordered" width="100%">
					<thead>
					  <tr>
						<th class="td_center">S.N.
						</th>
						<th class="td_center">Document Code
						</th>
						<th class="td_left">Document Name
						</th>
						<th class="td_center">Date
						</th>
						<th class="td_center">Status
						</th>
						<th class="td_center">Download
						</th>
						<!--<th class="td_left">Actions</th>-->
					  </tr>
					</thead>
					<tbody>
					  <?php 
						$docNeedToUpload=0;
						//echo '<pre>'; print_r($list_arr); die;
						if($list_arr){
						$sn =1;
						foreach($list_arr as $key=>$val_arr){
						?>
					  <tr>
						<td class="td_center">
						  <?php echo $sn; ?>
						</td>
						<td class="td_center">
						  <?php echo $val_arr['chklist_id']; ?>
						</td> 
						<td class="td_left">
						  <?php echo $val_arr['d_name']; ?>
						</td>
						<td class="td_center">
						  <?php echo $val_arr['created_on']; ?>
						</td>
						<td class="td_center">
						  <span class="label label-<?php echo $status_array_lb[$val_arr['status']]; ?>">
							<i class="fa fa-hourglass-half fa-spin-hover">
							</i>  
							<?php echo $status_array[$val_arr['status']]; ?> 
						  </span>
						</td>
						<td class="td_center">
						  <a target="_blank" href="<?php echo FRONT_BASEURL."themes/backend/mydoc/".$val_arr['iuid']."/".$val_arr['document_name']; ?>">View
						  </a>
						  <!--| <a href="<?php echo Yii::app()->request->baseUrl; ?>/dms/DepartmentDMS/DownloadMyDocument/ref_no/<?php echo base64_encode($val_arr['doc_ref_number']); ?>/iuid/<?php echo base64_encode($val_arr['iuid']); ?>">Download</a>-->
						</td>
					  </tr>
					  <?php ++$sn; }}else{ echo "No document found.";} ?>
					</tbody>
				  </table>
				</div>
			  </div>
			</div>
		  </div>
		</div>
		</div>
		</form>
		</div>
		<div class="form-actions">
		  <div class="row">
			<div class="col-md-offset-3 col-md-9">
			  <a href="javascript:;" class="btn default button-previous btn_prev">
				<i class="fa fa-angle-left">
				</i> Back 
			  </a>
			  <a href="javascript:;" class="btn btn-outline green btn_continue button-next"> Continue
				<i class="fa fa-angle-right">
				</i>
			  </a>
			  <?php echo "<!--CHECK DOC REQUIRED: " . $docNeedToUpload . "-->";
				if ($docNeedToUpload == 0) { ?>
			  			  <form action="<?= Yii::app()->createAbsoluteUrl('frontuser/existingUnit/submitCafApplication') ?>" style="display: inline" id="finalCAFSubmit" method="post">
				<input type="hidden" class="csrftoken" name="YII_CSRF_TOKEN_SUBMIT" value="<?= Yii::app()->getRequest()->getCsrfToken() ?>" />
				<?php //if($flg1>2){  ?>    
				<button type="submit" class="btn green button-submit btn_submit"> Submit
				  <i class="fa fa-check">
				  </i>
				</button> 
				<?php //}  ?>
			  </form>
			  <?php }else{ ?>
			  <script>
				$("document").ready(function () {
				  $("#tab5").css('display','none');
				});
			  </script>       
			  <?php } ?>
			</div>
		  </div>
		</div>
		</div>
		</form>
		</div>
		</div>
		</div>
		</div>
		<!-- BEGIN PAGE LEVEL PLUGINS -->
		<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript">
		</script>
		<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript">
		</script>
		<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript">
		</script>
		<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript">
		</script>
		<!-- END PAGE LEVEL PLUGINS -->
		<!-- BEGIN PAGE LEVEL SCRIPTS -->
		<script src="<?= Yii::app()->theme->baseUrl ?>/assets/pages/scripts/form-wizard.min.js" type="text/javascript">
		</script>
		<!-- form repeater js -->
		<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/jquery-repeater/jquery.repeater.js" type="text/javascript">
		</script>
		<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript">
		</script>
		<script src="<?= Yii::app()->theme->baseUrl ?>/assets/pages/scripts/form-repeater.min.js" type="text/javascript">
		</script>
		<script src="<?= Yii::app()->theme->baseUrl ?>/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript">
		</script>
		<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-datepicker/js/moment.min.js" type="text/javascript">
		</script>
		<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript">
		</script>
		<!-- BEGIN PAGE LEVEL PLUGINS -->
		<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript">
		</script>
		<!-- END PAGE LEVEL PLUGINS -->
		<!-- BEGIN THEME GLOBAL SCRIPTS -->
		<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/scripts/app.min.js" type="text/javascript">
		</script>
		<!-- END THEME GLOBAL SCRIPTS -->
		<!-- BEGIN PAGE LEVEL SCRIPTS -->
		<script src="<?= Yii::app()->theme->baseUrl ?>/assets/pages/scripts/components-select2.min.js" type="text/javascript">
		</script>
		<!-- END PAGE LEVEL SCRIPTS -->
		<!-- END PAGE LEVEL SCRIPTS -->
		<!-- move this code in separte file to make this page neat and clean -->
		<script>
		  $(document).ready(function () {
			$(".addservice").click(function () {
			  var hu = $(this).attr('rel');
			  $(this).attr('rel', parseInt(hu) + 1);
			  $(".depty").each(function (e) {
				$(this).attr('id', 'department_id' + e);
				$(this).attr('rel', e);
			  });
			  $(".servy").each(function (e) {
				$(this).attr('id', 'service_id' + e);
			  } );
			  $(".datepickers").each(function (e) {
				$(this).attr('id', 'datepicker' + e);
				$( "#datepicker"+e ).datepicker({
				  changeMonth: true,
				  changeYear: true
				});
			  });
			});
		  });
		  function showUser(str, rel) {
			$.ajax({
			  type: "POST",
			  url: "<?php echo Yii::app()->request->baseUrl; ?>/frontuser/existingUnit/deptservicemapping",
			  dataType: 'json',
			  data:
			  {
				post_deptid: str
			  }
			  ,
			  success: function (data) {
				//alert(data);
				var $select = $('#service_id' + rel);
				$select.html('');
				$.each(data, function (index, element) {
				  $select.append('<option value="' + element.service_id + '.'+element.servicetype_additionalsubservice+'">' + element.core_service_name + '</option>');
				});
				 },
			  error: function (jqXHR, textStatus, errorThrown) {
				alert('error::' + errorThrown);
			  }
			});
		  }
		
		  $("#ntrofunit").change(function () {
			var natur = $("#ntrofunit").val();
			var content = '';
			if (natur == 'Services') {
			  content = "<option value='micro'>Micro (< 10 lakhs)</option><option value='small'>Small (More than 10 Lakhs <2 Crore)</option><option value='medium'>Medium (More than 2 Crore <5 Crore)</option><option value='large'>Large (More than 5 Crore)</option>";
			  $(".nature_label").text("Equip - ment");
			  $(".manufactiring_detail").hide();
			  $(".raw_material_header").hide();
			  $(".remove_body_part").remove();
			  $(".product_manufactured_body_remove").remove();
			  $('.product_to_be_manufactured').hide();
			  $(".service_detail").show();
			}
			else if (natur == "Manufacturing") {
			  content = "<option value='micro'>Micro (< 25 lakhs)</option><option value='small'>Small (More than 25 Lakhs < 5 Crore)</option><option value='medium'>Medium (More than 5 Crore < 10 Crore)</option><option value='large'>Large(More than 10 Crore)</option>";
			  $(".nature_label").text("Plant & Machinery");
			  $(".service_detail").hide();
			  $(".raw_material_header").show();
			  $('.product_to_be_manufactured').show();
			  $(".manufactiring_detail").show();
			}
			/*	    else if(natur=="Renewable"){
				 content="<option value='micro'>Micro (< 25 lakhs)</option><option value='small'>Small (More than 25 Lakhs < 5 Crore)</option><option value='medium'>Medium (More than 5 Crore < 10 Crore)</option><option value='large'>Large(More than 10 Crore)</option>";
				 $(".nature_label").text("Renewable Details");
				 // $(".service_detail").hide();    
				 $(".department_id").show();   
				 $('.service_id').show();
				 $(".valid_upto").show();             
				 }
				 */       else {
				   content = 'None';
				 }
			//console.log(content);
			$('#ntrofunittype').empty();
			$('#ntrofunittype').append('<option  value="">---Please Select Unit Type---</option>');
			$('#ntrofunittype').append(content);
		  }
								)
		  $('#Proposed_details_of_Land').change(function () {
			var sel_val = $('#Proposed_details_of_Land').val();
			var have_own_land = $("#have_own_land").val();
			$('.append_later').empty();
			if(sel_val=='SIIDCUL Land'){
			  $("#industrial_area1").attr('style','display:block !important');
			  return;
			}
			else{
			  $("#industrial_area1").hide();
			}
			if (sel_val == 'Rented Space') {
			  $('.dt_land').empty();
			  $('.dt_land').text('Details of Leased/Rented Space');
			  if (have_own_land == 'No') {
				$('.check_no_own_land_lable').html("<sup>*</sup>*Land in Hectares");
			  }
			  $('.land_leased_other').hide();
			  $('.land_leased').show();
			  $('#detail_of_leased_space_area_in_sq_meters').val("");
			  $('#detail_of_leased_space_detail_of_space').val("");
			  $('#detail_of_leased_space_location').val("");
			}
			else {
			  if (have_own_land == 'No') {
				$('.check_no_own_land_lable').html("<sup>*</sup>Land in Sq Meter");
			  }
			  else {
				var append_string = '<div class="land_leased_other col-md-6">' +
					'<div class="form-group">' +
					'<label class="control-label col-md-3 check_no_own_land_lable">Pin Code <span class="required" aria-required="true"> * </span></label>' +
					'<div class="col-md-9">' +
					'<input type="text"  name="land_area_pin_code" id="land_area_pin_code" class="six_digit_zip_code form-control" placeholder="* Value">' +
					'<span class="help-block">  </span>' +
					'</div>' +
					'</div>' +
					'</div>' +
					'<div class="col-md-6">' +
					'<div class="form-group">' +
					' <label class="control-label col-md-3">Plot/Khasra No</label>' +
					'<div class="col-md-9">' +
					'<input type="text"  id="Khasra_no" class="form-control address_field_with_space" maxlength="100" value="" name="Khasra_no" placeholder="* Khasra_no">' +
					' <span class="help-block">  </span>' +
					'</div>' +
					'</div>' +
					'</div>';
				$('.append_later').append(append_string);
			  }
			  $('.dt_land').empty();
			  $('.dt_land').text('Detail of Land');
			  $('.land_leased').hide();
			  $('.land_leased_other').show();
			  $('#Land_in_Heetares').val("");
			  $('#detail_of_plot').val("");
			  $('#Location').val("");
			  $('#land_address').val("");
			}
		  }
											   )
		  function sumupInst(id) {
			var sum = 0;
			var land = $('#land' + id).val();
			if (isNaN(parseFloat(land)))
			  land = 0.0;
			var building = $('#building' + id).val();
			if (isNaN(parseFloat(building)))
			  building = 0.0;
			var plant = $('#plant' + id).val();
			if (isNaN(parseFloat(plant)))
			  plant = 0.0;
			var wrkcapt = $('#wrkcapt' + id).val();
			if (isNaN(parseFloat(wrkcapt)))
			  wrkcapt = 0.0;
			var other = $('#other' + id).val();
			if (isNaN(parseFloat(other)))
			  other = 0.0;
			sum = (parseFloat(land) + parseFloat(building) + parseFloat(plant) + parseFloat(wrkcapt) + parseFloat(other)).toFixed(2);
			$("#total" + id).val(sum);
		  }
		  function sumupEmp(id) {
			var sum = 0;
			var skl = $('#mskl' + id).val();
			var unskl = $('#munskl' + id).val();
			var mngmnt = $('#mmngmnt' + id).val();
			var sprvsr = $('#msprvsr' + id).val();
			var engg = $('#mengg' + id).val();
			var it = $('#mit' + id).val();
			if (isNaN(parseFloat(skl)))
			  skl = 0.0;
			if (isNaN(parseFloat(unskl)))
			  unskl = 0.0;
			if (isNaN(parseFloat(mngmnt)))
			  mngmnt = 0.0;
			if (isNaN(parseFloat(sprvsr)))
			  sprvsr = 0.0;
			if (isNaN(parseFloat(engg)))
			  engg = 0.0;
			if (isNaN(parseFloat(it)))
			  it = 0.0;
			sum = parseFloat(skl) + parseFloat(unskl) + parseFloat(mngmnt) + parseFloat(sprvsr) + parseFloat(engg) + parseFloat(it);
			$('#memptotal' + id).val(sum);
		  }
		  function fsumupEmp(id) {
			var sum = 0;
			var skl = $('#fskl' + id).val();
			var unskl = $('#funskl' + id).val();
			var mngmnt = $('#fmngmnt' + id).val();
			var sprvsr = $('#fsprvsr' + id).val();
			var engg = $('#fengg' + id).val();
			var it = $('#fit' + id).val();
			if (isNaN(parseFloat(skl)))
			  skl = 0.0;
			if (isNaN(parseFloat(unskl)))
			  unskl = 0.0;
			if (isNaN(parseFloat(mngmnt)))
			  mngmnt = 0.0;
			if (isNaN(parseFloat(sprvsr)))
			  sprvsr = 0.0;
			if (isNaN(parseFloat(engg)))
			  engg = 0.0;
			if (isNaN(parseFloat(it)))
			  it = 0.0;
			sum = parseFloat(skl) + parseFloat(unskl) + parseFloat(mngmnt) + parseFloat(sprvsr) + parseFloat(engg) + parseFloat(it);
			$('#femptotal' + id).val(sum);
		  }
		  function sumMaleFemale() {
			var sum = 0;
			var female = $('#empFemale').val();
			var male = $('#empMale').val();
			if (isNaN(parseFloat(female)))
			  female = 0.0;
			if (isNaN(parseFloat(male)))
			  male = 0.0;
			sum = parseFloat(male) + parseFloat(female);
			$('#empMaleFemaleTotal').val(sum);
		  }
		  $("document").ready(function () {
			<?php  
			if ($document == 1) {
			  ?>
				$('.btn_prev').css({
				display: 'inline-block'
			  }
								  )
			  $('.btn_continue').css({
				display: 'none'
			  }
									)
			  $('.btn_submit').css({
				display: 'inline-block'
			  }
								  )
				<?php }
			?>
			  $(".date-picker").datepicker({
			  rtl: App.isRTL(),
			  autoclose: !0,
			  startDate: "dateToday",
			  format: 'd-m-yyyy',
			  useCurrent: false,
			}
										  );
			
			$( "#datepicker" ).datepicker({
			  changeMonth: true,
			  changeYear: true
			}
										 );
			$(".tehsil1").on('change', function () {
			  var tehsilValue = $(this).val();
			 $.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->request->baseUrl; ?>/iloc/property/getVilagesOfTehsil/subDistCode/" + tehsilValue,
				success: function (result) {
				 $(".villages1").html(result);
				}
			  }
					);
			}
							);
			$(".district1").on('change', function () {
			  var districtValue = $(this).val();
			  $.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->request->baseUrl; ?>/iloc/property/getTehsil/districtID/" + districtValue,
				success: function (result) {
				  $(".tehsil1").html(result);
				}
			  }
					);
			}
							  );
			$(".tehsil").on('change', function () {
			  var tehsilValue = $(this).val();
			   $.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->request->baseUrl; ?>/iloc/property/getVilagesOfTehsil/subDistCode/" + tehsilValue,
				success: function (result) {
				  $(".villages").html(result);
				}
			  });
			});
			$(".district").on('change', function () {
			  //alert("hi");
			  var districtValue = $(this).val();
			  $.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->request->baseUrl; ?>/iloc/property/getTehsil/districtID/" + districtValue,
				success: function (result) {
				  $(".tehsil").html(result);
				}
			  });
			});
			$("#start_up").change(function(){
			if($(this).val()=="Yes"){	
			$("#SUI_registration_number").attr("required",true);
			$(".suilablerequired").show();
			$(".suilable").css('color','red');
			$("#SUI_registration_number").css('border-color','red'); 
			}else{
			$("#SUI_registration_number").removeAttr("required");
			$(".suilablerequired").hide();
			$("#SUI_registration_number-error").html("");
			$(".suilable").css('color','#000');
			$("#SUI_registration_number").css('border-color','#27a4b0'); 
			
			}	
			});
		  });
		  $(window).load(function(){
			  
			$(".datepickers").each(function (e) {
			  $(this).attr('id', 'datepicker' + e);
			  $( "#datepicker"+e ).datepicker({
				changeMonth: true,
				changeYear: true
			  });
			});
			$(".depty").each(function (e) {
			  $(this).attr('id', 'department_id' + e);
			  $(this).attr('rel', e);
			});
			$(".servy").each(function (e) {
			  $(this).attr('id', 'service_id' + e);
			});
			<?php if (!empty($incmplt_fields->company_district)) {
			  ?> $(".district").val("<?php echo @$incmplt_fields->company_district; ?>");
			  // Getting all Tehseel of selected district - Rahul Kumar - 01022018
			  $.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->request->baseUrl; ?>/iloc/property/getTehsil/districtID/" + <?php echo @$incmplt_fields->company_district;
				?>,
				success: function (result) {
				$(".tehsil").html(result);
				// Setting searched Tehsil as sellected in drop down- Rahul Kumar 
				<?php if (!empty(@$incmplt_fields->company_sub_district_id)) {
				?>   $(".tehsil").val("<?php echo @$incmplt_fields->company_sub_district_id; ?>");
				// Getting all Villages of selected Tehsil
				$.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->request->baseUrl; ?>/iloc/property/getVilagesOfTehsil/subDistCode/<?php echo @$incmplt_fields->company_sub_district_id; ?>",
				success: function (result) {
				$(".villages").html(result);
				// Setting searched Village as sellected in drop down- Rahul Kumar
				<?php if (!empty(@$incmplt_fields->company_village)) {
				?>  $(".villages").val("<?php echo @$incmplt_fields->company_village; ?>");
				<?php }
					 ?>
					 }
					 }
					);
			  <?php }
			?>
		  }
		  }
						);
		  <?php }
			?>
			  <?php if (!empty($incmplt_fields->unit_district)) {
				?> $(".district1").val("<?php echo @$incmplt_fields->unit_district; ?>");
				// Getting all Tehseel of selected district - Rahul Kumar 
				$.ajax({
				  type: "POST",
				  url: "<?php echo Yii::app()->request->baseUrl; ?>/iloc/property/getTehsil/districtID/" + <?php echo @$incmplt_fields->unit_district;
				  ?>,
				  success: function (result) {
				  $(".tehsil1").html(result);
				  // Setting searched Tehsil as sellected in drop down- Rahul Kumar  
				  <?php if (!empty(@$incmplt_fields->unit_sub_district_id)) {
				  ?>   $(".tehsil1").val("<?php echo @$incmplt_fields->unit_sub_district_id; ?>");
				  // Getting all Villages of selected Tehsil
				  $.ajax({
				  type: "POST",
				  url: "<?php echo Yii::app()->request->baseUrl; ?>/iloc/property/getVilagesOfTehsil/subDistCode/<?php echo @$incmplt_fields->unit_sub_district_id; ?>",
				  success: function (result) {
				  $(".villages1").html(result);
				  // Setting searched Village as sellected in drop down- Rahul Kumar
				  <?php if (!empty(@$incmplt_fields->unit_village)) {
				  ?>  $(".villages1").val("<?php echo @$incmplt_fields->unit_village; ?>");
				  <?php }  ?>
					   }
					   });
				<?php } ?>
					}
				});
		  <?php } ?>
		  }
			);
		</script>
                <div id="loading-mask"></div>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js">
		</script>
