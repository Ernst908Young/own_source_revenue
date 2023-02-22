<?php extract(@$pre_field);?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />


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
            <h3>Common Application Form</h3>
            <p> </p>
        </div>
        <div class="portlet light bordered" id="form_wizard_1">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" icon-layers font-red"></i>
                    <span class="caption-subject font-red bold uppercase">Fields With * are Mandtory  -
                        <span class="step-title"> Step 1 of 5 </span>
                    </span>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal caf_form_submission_wizard" action="#" id="submit_form" method="POST">
                    <input type="hidden" class="csrftoken" name="YII_CSRF_TOKEN" value="<?=Yii::app()->getRequest()->getCsrfToken()?>" />
                    <input type="hidden" value="<?=Yii::app()->createAbsoluteUrl('frontuser/existing/saveCAFPartially')?>" id='caf_form_url'>
                    <div class="form-wizard">
                        <div class="form-body">
                            <ul class="nav nav-pills nav-justified steps">
                                <li <?php if($document==1) echo 'class="done"'?>>
                                    <a href="#tab1" data-toggle="tab" class="step">
                                        <span class="number"> 1 </span>
										<br />
                                        <span class="desc">
                                            <i class="fa fa-check"></i> Enterprise Detail </span>
                                    </a>
                                </li>
                                <li <?php if($document==1) echo 'class="done"'?>>
                                    <a href="#tab2" data-toggle="tab" class="step">
                                        <span class="number"> 2 </span>
										<br />
                                        <span class="desc">
                                            <i class="fa fa-check"></i> Investment Detail </span>
                                    </a>
                                </li>
                                <li <?php if($document==1) echo 'class="done"'?>>
                                    <a href="#tab3" data-toggle="tab" class="step">
                                        <span class="number"> 3 </span>
										<br />
                                        <span class="desc">
                                            <i class="fa fa-check"></i> Factors of Production </span>
                                    </a>
                                </li>
								 <li <?php if($document==1) echo 'class="done"'?>>
                                    <a href="#tab4" data-toggle="tab" class="step">
                                        <span class="number"> 4 </span>
										<br />
                                        <span class="desc">
                                            <i class="fa fa-check"></i> Existing Registration Details </span>
                                    </a>
                                </li>
                                <li <?php if($document==1) echo 'class="active"'?>>
                                    <a href="#tab5" data-toggle="tab" class="step">
                                        <span class="number"> 5 </span>
										<br />
                                        <span class="desc">
                                            <i class="fa fa-check"></i>  Checklist </span>
                                    </a>
                                </li>
                            </ul>
                            <div id="bar" class="progress progress-striped" role="progressbar">
                                <div class="progress-bar progress-bar-success"> </div>
                            </div>
                            <div class="tab-content">
                                <div class="alert alert-danger alert-message-error display-none">
                                    <button class="close" data-dismiss="alert"></button> You have some form errors. Please check below. </div>
                                <div class="alert alert-success alert-message-success display-none">
                                    <button class="close" data-dismiss="alert"></button> Your form validation is successful!
                               </div>
                               <?php 
                                  foreach(Yii::app()->user->getFlashes() as $key => $message) {
                                        echo '<div class="alert alert-success"><button class="close" data-dismiss="alert"></button> 
                                               ' . $message . 
                                              '</div>';
                                        }
                                  ?>
                                <div class="tab-pane <?php if($document!=1) echo 'active'?>" id="tab1">
                                    <div class="portlet box green">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-gift"></i>CAF Application -Step 1 </div>
                                            <div class="tools">
                                                <a href="javascript:;" class="collapse"> </a>
                                                <a href="javascript:;" class="reload"> </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body form">
                                            <!-- BEGIN FORM-->
                                                <div class="form-body">
												
												
												
												
												
                                                    <h3 class="form-section">Enterprise Details</h3>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">IUID<span class="required" aria-required="true"> * </span></label>
                                                                <div class="col-md-9">
                                                                    <input type="text"  id="IUID" class="form-control" name='IUID' value="<?=@$iuid?>" readonly placeholder="IUID">
                                                                    <span class="help-block"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Name<span class="required" aria-required="true"> * </span></label>
                                                                <div class="col-md-9">
                                                                  <input type="text"  id="company_name" maxlength="100" class="form-control alphanumeric_name_with_space" value="<?=@$incmplt_fields->company_name?>" name="company_name" placeholder="*  Name of the Company / Unit">                                                                   
                                                                  <span class="help-block">  </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                    </div>
                                                    <!--/row-->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Corresponding Address<span class="required" aria-required="true"> * </span></label>
                                                                <div class="col-md-9">
                                                                   <textarea  id="Address" rows="3" class="form-control address_field_with_space" maxlength="100" name="Address"  placeholder="*  Correspondence Address"><?=@$incmplt_fields->Address?></textarea>
                                                                    <span class="help-block"> </span> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Pin Code<span class="required" aria-required="true"> * </span></label>
                                                                <div class="col-md-9">
                                                                    <input type="text"  id="pin_code" class="form-control six_digit_zip_code"  value="<?=@$incmplt_fields->pin_code?>"  name="pin_code" placeholder="*  Pin Code">
                                                                    <span class="help-block"> </span>

                                                                 </div>
                                                            </div>
                                                         </div>
                                                        <!--/span-->
                                                    </div>
                                                    <!--/row-->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Mobile<span class="required" aria-required="true"> * </span></label>
                                                                <div class="col-md-9">
                                                                  <input type="text"  id="mob_number" class="form-control mobile_number_ten_digit_only"  value="<?=@$incmplt_fields->mob_number?>"  name="mob_number" placeholder="Mobile Number">
                                                                     
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Telephone</label>
                                                                <div class="col-md-9">
                                                                     <input type="text"  id="tel_phone" class="form-control telephone_numbers" value="<?=@$incmplt_fields->tel_phone?>"  name="tel_phone" placeholder="Telephone Number">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Email<span class="required" aria-required="true"> * </span></label>
                                                                <div class="col-md-9">
                                                                
                                                                   <input type="text"  id="email" class="form-control email"   maxlength="250" value="<?=@$incmplt_fields->email?>"  name="email" placeholder="*  Email">
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Fax</label>
                                                                <div class="col-md-9">
                                                                   <input type="text"  id="fax" class="form-control telephone_numbers" value="<?=@$incmplt_fields->fax?>"  name="fax" placeholder="Fax">
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
														 </div>
                                                        <!--/span-->
														<div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Name of Company<span class="required" aria-required="true"> * </span></label>
                                                                <div class="col-md-9">
                                                                
                                                                   <input type="text"  id="name_of_ompany" class="form-control alphanumeric_name_with_space"   maxlength="250" value="<?=@$incmplt_fields->name_of_ompany?>"  name="name_of_ompany" placeholder="*  Name of Company">
                                                                   
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/span-->  
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Registered Headquarters</label>
                                                                <div class="col-md-9">
                                                                   <input type="text"  id="registered_headquarters" class="form-control address_field_with_space" value="<?=@$incmplt_fields->registered_headquarters?>"  name="registered_headquarters" placeholder="Registered Headquarters">
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
														</div>
                                                   
                                                    <h3 class="form-section">Details of M.D/Managing Partner/CEO / Lead Promoter/ Proprietor</h3>
                                                    <!--/row-->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Name<span class="required" aria-required="true"> * </span></label>
                                                                <div class="col-md-9">
                                                                   <input type="text"  id="md_name" class="form-control name_with_space" maxlength="100"  value="<?=@$incmplt_fields->md_name?>" name="md_name" placeholder="*  Name of the M.D/Managing Partner/CEO /Lead Promoter/Proprietor">
                                                                   <span class="help-block"></span>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                           <div class="form-group">
                                                              <label class='control-label col-md-3'><span class="required" aria-required="true">*</span>Designation</label>
                                                              <div class=" col-md-9">
                                                              <select name="designation" class="form-control" id="md_designation">
                                                                 <option value="">*  Please Select Designation</option>
                                                                 <option value="MD" <?php if(isset($incmplt_fields->designation)) if($incmplt_fields->designation=='MD') echo "selected";?> >MD</option>
                                                                 <option value="Managing Partner" <?php if(isset($incmplt_fields->designation)) if($incmplt_fields->designation=='Managing Partner') echo "selected";?>>Managing Partner</option>
                                                                 <option value="CEO" <?php if(isset($incmplt_fields->designation)) if($incmplt_fields->designation=='CEO') echo "selected";?>>CEO</option>
                                                                 <option value="Lead Promoter" <?php if(isset($incmplt_fields->designation)) if($incmplt_fields->designation=='Lead Promoter') echo "selected";?>>Lead Promoter</option>
                                                                 <option value="Proprietor" <?php if(isset($incmplt_fields->designation)) if($incmplt_fields->designation=='Proprietor') echo "selected";?> >Proprietor</option>
                                                              </select>
                                                              </div>
                                                           </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Mobile<span class="required" aria-required="true"> * </span></label>
                                                                <div class="col-md-9">
                                                                     <input type="text"  id="md_mob" class="form-control mobile_number_ten_digit_only"  value="<?=@$incmplt_fields->md_mob?>" name="md_mob" placeholder="Mobile Number">
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-6">
                                                            <div class="form-group"> 
                                                               <label class='control-label col-md-3'>Email<span class="required" aria-required="true"> * </span></label>
                                                               <div class="col-md-9">
                                                                  <input type="text"  id="md_email" class="form-control email" value="<?=@$incmplt_fields->md_email?>"  name="md_email" placeholder="*  Email">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                    </div>
                                                    <!--/row-->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Telephone</label>
                                                                <div class="col-md-9">
                                                                     <input type="text"  id="md_tel" class="form-control telephone_numbers"  value="<?=@$incmplt_fields->md_tel?>" name="md_tel" placeholder="Telephone Number">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Fax</label>
                                                                <div class="col-md-9">
                                                                   <input type="text"  id="md_fax" class="form-control telephone_numbers"  value="<?=@$incmplt_fields->md_fax?>" name="md_fax" placeholder="FAX">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Category</label>
                                                                <div class="col-md-9">
                                                                    <select name="org_category" class="form-control" id="org_category">
                                                                       <option value="">*  Please Select Category</option>
                                                                       <option value="SC" <?php if(isset($incmplt_fields->org_category)) if($incmplt_fields->org_category=='SC') echo "selected";?> >SC</option>
                                                                       <option value="ST" <?php if(isset($incmplt_fields->org_category)) if($incmplt_fields->org_category=='ST') echo "selected";?>>ST</option>
                                                                       <option value="OBC" <?php if(isset($incmplt_fields->org_category)) if($incmplt_fields->org_category=='OBC') echo "selected";?>>OBC</option>
                                                                       <option value="GENERAL" <?php if(isset($incmplt_fields->org_category)) if($incmplt_fields->org_category=='GENERAL') echo "selected";?>>General</option>
                                                                       <option value="WOMEN" <?php if(isset($incmplt_fields->org_category)) if($incmplt_fields->org_category=='WOMEN') echo "selected";?> >Women</option>
                                                                       <option value="Ex-Serviceman" <?php if(isset($incmplt_fields->org_category)) if($incmplt_fields->org_category=='Ex-Serviceman') echo "selected";?> >Ex-Serviceman</option>
                                                                       <option value="Physically Challenged" <?php if(isset($incmplt_fields->org_category)) if($incmplt_fields->org_category=='Physically Challenged') echo "selected";?> >Physically Challenged</option>
                                                                       <option value="Other" <?php if(isset($incmplt_fields->org_category)) if($incmplt_fields->org_category=='Other') echo "selected";?> >Other</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/row-->
                                                    <h3 class="form-section">Details of Authorized Coordinator/Person   </h3>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Name<span class="required" aria-required="true"> * </span></label>
                                                                <div class="col-md-9">
                                                                     <input type="text"  id="auth_name" class="form-control" name="auth_name"  value="<?=@$first_name." ".@$last_name?>" readonly placeholder="Name of Authorized Coordinator/Person">
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Designation</label>
                                                                <div class="col-md-9">
                                                                      <input type="text"  id="auth_designation" class="form-control name_with_space" maxlength="100" value="<?=@$incmplt_fields->auth_designation?>" name="auth_designation" placeholder="*  Designation">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                    </div>
                                                    <!--/row-->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Email<span class="required" aria-required="true"> * </span></label>
                                                                <div class="col-md-9">
                                                                     <input type="text"  id="auth_email" class="form-control email" value="<?=@$email?>" readonly name="auth_email" placeholder="Email">
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Mobile</label>
                                                                <div class="col-md-9">
                                                                     <input type="text"  id="auth_mob" class="form-control mobile_number_ten_digit_only" value="<?=@$mobile_number?>" readonly name="auth_mob" placeholder="Mobile Number">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                    </div>
                                                    <!--/row-->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Telephone</label>
                                                                <div class="col-md-9">
                                                                  <input type="text"  id="auth_tel" class="form-control telephone_numbers"value="<?=@$incmplt_fields->auth_tel?>" name="auth_tel" placeholder="Telephone Number">
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Fax</label>
                                                                <div class="col-md-9">
                                                                   <input type="text"  id="auth_fax" class="form-control telephone_numbers" value="<?=@$incmplt_fields->auth_fax?>" name="auth_fax" placeholder="Fax Number">
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                    </div>
                                                    <!--/row-->
                                                    <h3 class="form-section">Financial Indicators of the Enterprise / Firm for Last 3 Finacial Years in INR Lakhs (if any)</h3>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                               <div class="row">
                                                                   <label class="control-label col-md-2" style="text-align: center;">Financial Year</label>
                                                                   <label class="control-label col-md-2" style="text-align: center;">Turn Over</label>
                                                                   <label class="control-label col-md-2" style="text-align: center;">Profit before Tax</label>
                                                                   <label class="control-label col-md-2" style="text-align: center;">Net Worth</label>
                                                                   <label class="control-label col-md-2" style="text-align: center;">Reserves &amp; Surplus</label>
                                                                   <label class="control-label col-md-2" style="text-align: center;">Share Capital</label>
                                                               </div></div>
                                                               <div class="row">
                                                               <div class="form-group">
                                                                    <div class="col-md-12">
                                                                         <div class="col-md-2">
                                                                             <input type="text"  id="fnc_year1" class="form-control year" maxlength="10" value="<?=@$incmplt_fields->fnc_year[0]?>" name="fnc_year[]" placeholder="Year">
                                                                         </div>
                                                                         <div class="col-md-2">
                                                                             <input type="text"  id="fnc_turnover1" class="form-control decimal" maxlength="10" value="<?=@$incmplt_fields->fnc_turnover[0]?>" name="fnc_turnover[]" placeholder="Turn Over">
                                                                         </div>
                                                                         <div class="col-md-2">
                                                                            <input type="text"  id="fnc_prftBfrTax1" class="form-control decimal"  maxlength="10" value="<?=@$incmplt_fields->fnc_prftBfrTax[0]?>" name="fnc_prftBfrTax[]" placeholder="Profit before Tax">
                                                                         </div>
                                                                         <div class="col-md-2">
                                                                            <input type="text"  id="fnc_netWrth1" class="form-control decimal" maxlength="10" value="<?=@$incmplt_fields->fnc_netWrth[0]?>" name="fnc_netWrth[]" placeholder="Net Worth">
                                                                         </div>
                                                                         <div class="col-md-2">
                                                                            <input type="text"  id="fnc_rsrvSrpls1" class="form-control decimal" maxlength="10" value="<?=@$incmplt_fields->fnc_rsrvSrpls[0]?>" name="fnc_rsrvSrpls[]" placeholder="Reserves & Surplus">
                                                                         </div>
                                                                         <div class="col-md-2">
                                                                            <input type="text"  id="fnc_sharCaps1" class="form-control decimal" maxlength="10" value="<?=@$incmplt_fields->fnc_sharCaps[0]?>" name="fnc_sharCaps[]" placeholder="Share Capital">
                                                                         </div>
                                                                     </div>
                                                                     </div>
                                                               </div>
                                                               <div class="row">
                                                               <div class="form-group">
                                                                    <div class="col-md-12">
                                                                         <div class="col-md-2">
                                                                             <input type="text"  id="fnc_year1" class="form-control year" maxlength="10" value="<?=@$incmplt_fields->fnc_year[1]?>" name="fnc_year[]" placeholder="Year">
                                                                         </div>
                                                                         <div class="col-md-2">
                                                                             <input type="text"  id="fnc_turnover1" class="form-control decimal" maxlength="10" value="<?=@$incmplt_fields->fnc_turnover[1]?>" name="fnc_turnover[]" placeholder="Turn Over">
                                                                         </div>
                                                                         <div class="col-md-2">
                                                                            <input type="text"  id="fnc_prftBfrTax1" class="form-control decimal"  maxlength="10" value="<?=@$incmplt_fields->fnc_prftBfrTax[1]?>" name="fnc_prftBfrTax[]" placeholder="Profit before Tax">
                                                                         </div>
                                                                         <div class="col-md-2">
                                                                            <input type="text"  id="fnc_netWrth1" class="form-control decimal" maxlength="10" value="<?=@$incmplt_fields->fnc_netWrth[1]?>" name="fnc_netWrth[]" placeholder="Net Worth">
                                                                         </div>
                                                                         <div class="col-md-2">
                                                                            <input type="text"  id="fnc_rsrvSrpls1" class="form-control decimal" maxlength="10" value="<?=@$incmplt_fields->fnc_rsrvSrpls[1]?>" name="fnc_rsrvSrpls[]" placeholder="Reserves & Surplus">
                                                                         </div>
                                                                         <div class="col-md-2">
                                                                            <input type="text"  id="fnc_sharCaps1" class="form-control decimal" maxlength="10" value="<?=@$incmplt_fields->fnc_sharCaps[1]?>" name="fnc_sharCaps[]" placeholder="Share Capital">
                                                                         </div>
                                                                    </div>
                                                               </div></div>
                                                               <div class="row">
                                                               <div class="form-group">
                                                                    <div class="col-md-12">
                                                                         <div class="col-md-2">
                                                                             <input type="text"  id="fnc_year1" class="form-control year" maxlength="10" value="<?=@$incmplt_fields->fnc_year[2]?>" name="fnc_year[]" placeholder="Year">
                                                                         </div>
                                                                         <div class="col-md-2">
                                                                             <input type="text"  id="fnc_turnover1" class="form-control decimal" maxlength="10" value="<?=@$incmplt_fields->fnc_turnover[2]?>" name="fnc_turnover[]" placeholder="Turn Over">
                                                                         </div>
                                                                         <div class="col-md-2">
                                                                            <input type="text"  id="fnc_prftBfrTax1" class="form-control decimal"  maxlength="10" value="<?=@$incmplt_fields->fnc_prftBfrTax[2]?>" name="fnc_prftBfrTax[]" placeholder="Profit before Tax">
                                                                         </div>
                                                                         <div class="col-md-2">
                                                                            <input type="text"  id="fnc_netWrth1" class="form-control decimal" maxlength="10" value="<?=@$incmplt_fields->fnc_netWrth[2]?>" name="fnc_netWrth[]" placeholder="Net Worth">
                                                                         </div>
                                                                         <div class="col-md-2">
                                                                            <input type="text"  id="fnc_rsrvSrpls1" class="form-control decimal" maxlength="10" value="<?=@$incmplt_fields->fnc_rsrvSrpls[2]?>" name="fnc_rsrvSrpls[]" placeholder="Reserves & Surplus">
                                                                         </div>
                                                                         <div class="col-md-2">
                                                                            <input type="text"  id="fnc_sharCaps1" class="form-control decimal" maxlength="10" value="<?=@$incmplt_fields->fnc_sharCaps[2]?>" name="fnc_sharCaps[]" placeholder="Share Capital">
                                                                         </div>
                                                                    </div>
                                                                    </div>
                                                               </div>
                                                            
                                                        </div>
                                                        <!--/span-->
                                                       
                                                    </div>
                                                    <!--/row-->
                                                    <h3 class="form-section">Organisation Details</h3>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Nature<span class="required" aria-required="true"> * </span></label>
                                                                <div class="col-md-9">
                                                                  <select name="noforg" id="noforg" class="form-control">
                                                                     <option value=""> Nature of your Organization</option>
                                                                     <option value="Proprietary" <?php if(isset($incmplt_fields->noforg)) if($incmplt_fields->noforg=='Proprietary') echo "selected";?> >Proprietary</option>
                                                                     <option value="Partnership" <?php if(isset($incmplt_fields->noforg)) if($incmplt_fields->noforg=='Partnership') echo "selected";?> >Partnership</option>
                                                                     <option value="Private Limited" <?php if(isset($incmplt_fields->noforg)) if($incmplt_fields->noforg=='Private Limited') echo "selected";?>>Private Limited</option>
                                                                     <option value="Public Limited" <?php if(isset($incmplt_fields->noforg)) if($incmplt_fields->noforg=='Public Limited') echo "selected";?>>Public Limited</option>
                                                                     <option value="Co-Operative" <?php if(isset($incmplt_fields->noforg)) if($incmplt_fields->noforg=='Co-Operative') echo "selected";?>>Co-Operative</option>
                                                                     <option value="Other" <?php if(isset($incmplt_fields->noforg)) if($incmplt_fields->noforg=='Other') echo "selected";?> >Other</option>
                                                                  </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                        <?php /*?><div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Project Status <span class="required" aria-required="true"> * </span></label>
                                                                <div class="col-md-9">
                                                                  <select name="project_status" id="project_status" class="form-control">
                                                                     <option value="">---Please Select---</option>
                                                                     <option value="New" <?php if(isset($incmplt_fields->project_status)) if($incmplt_fields->project_status=='New') echo "selected";?> >New</option>
                                                                     <option value="Expansion" <?php if(isset($incmplt_fields->project_status)) if($incmplt_fields->project_status=='Expansion') echo "selected";?> >Expansion</option>
                                                                     <option value="Diversification" <?php if(isset($incmplt_fields->project_status)) if($incmplt_fields->project_status=='Diversification') echo "selected";?>>Diversification</option>
                                                                  </select>                                                                    
                                                                </div>
                                                            </div>
                                                        </div><?php */?>


                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Do You Covered Under <span class="required" aria-required="true"> * </span></label>
                                                                <div class="col-md-9">
                                                                  <select name="start_up" id="start_up" class="form-control">
                                                                     <option value="">---Please Select---</option>
                                                                     <option value="Startup" <?php if(isset($incmplt_fields->start_up)) if($incmplt_fields->start_up=='Startup') echo "selected";?> >START-UP INDIA</option>
                                                                     <option value="Standup" <?php if(isset($incmplt_fields->start_up)) if($incmplt_fields->start_up=='Standup') echo "selected";?> >STAND-UP INDIA</option>
                                                                     <option value="NA" <?php if(isset($incmplt_fields->start_up)) if($incmplt_fields->start_up=='NA') echo "selected";?>>NOT APPLICABLE</option>
                                                                  </select>                                                                    
                                                                </div>
                                                            </div>
                                                        </div>



                                                        <!--/span-->
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2" style="text-align: center;">Description<span class="required" aria-required="true"> * </span></label>
                                                                <div class="col-md-10 description_detail">
                                                                  <textarea  id="activity_of_company" class="form-control" rows="4"  name="activity_of_company" placeholder="*  Brief Description (Activities of the Enterprise)"><?=@$incmplt_fields->activity_of_company?></textarea>
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
                                                <i class="fa fa-gift"></i>CAF Application -Step 2 </div>
                                            <div class="tools">
                                                <a href="javascript:;" class="collapse"> </a>
                                                <a href="javascript:;" class="reload"> </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body form">
                                            <!-- BEGIN FORM-->
                                                <div class="form-body">
                                                    <h3 class="form-section">Unit Details</h3>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Nature of unit<span class="required" aria-required="true"> * </span></label>
                                                                <div class="col-md-9">
                                                                    <select name="ntrofunit" id="ntrofunit" class="form-control">
                                                                       <option value="">--Nature of unit--</option>
                                                                       <option value="Manufacturing" <?php if(isset($incmplt_fields->ntrofunit)) if($incmplt_fields->ntrofunit=='Manufacturing') echo "selected";?> >Manufacturing</option>
                                                                       <option value="Services" <?php if(isset($incmplt_fields->ntrofunit)) if($incmplt_fields->ntrofunit=='Services') echo "selected";?>>Services</option>
                                                                    </select>
                                                                    <span class="help-block"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Unit Type<span class="required" aria-required="true"> * </span></label>
                                                                <div class="col-md-9">
                                                                  <select name="ntrofunittype" id="ntrofunittype" class="form-control">
                                                                    <option value="">---Please Select Nature of Unit---</option>
                                                                    <?php
                                                                        if(isset($incmplt_fields->ntrofunit)) {
                                                                            if($incmplt_fields->ntrofunit=='Manufacturing'){
                                                                                echo "<option value='micro' ";
                                                                                        if(isset($incmplt_fields->ntrofunittype) && $incmplt_fields->ntrofunittype=='micro')
                                                                                            echo " selected ";
                                                                                echo ">Micro (< 25 lakhs)</option>
                                                                                <option value='small'";
                                                                                if(isset($incmplt_fields->ntrofunittype) && $incmplt_fields->ntrofunittype=='small')
                                                                                            echo " selected ";
                                                                                echo ">Small (More than 25 Lakhs < 5 Crore)</option>
                                                                                <option value='medium' ";
                                                                                if(isset($incmplt_fields->ntrofunittype) && $incmplt_fields->ntrofunittype=='medium')
                                                                                            echo " selected ";
                                                                                echo ">Medium (More than 5 Crore < 10 Crore)</option>
                                                                                <option value='large' ";
                                                                                if(isset($incmplt_fields->ntrofunittype) && $incmplt_fields->ntrofunittype=='large')
                                                                                            echo " selected ";
                                                                                echo " >Large(More than 10 Crore)</option>";
                                                                            }
                                                                            if($incmplt_fields->ntrofunit=='Services'){
                                                                                echo "<option value='micro'";
                                                                                 if(isset($incmplt_fields->ntrofunittype) && $incmplt_fields->ntrofunittype=='micro')
                                                                                            echo " selected ";
                                                                                echo ">Micro (< 10 lakhs)</option>
                                                                                      <option value='small' ";
                                                                                       if(isset($incmplt_fields->ntrofunittype) && $incmplt_fields->ntrofunittype=='small')
                                                                                            echo " selected ";
                                                                                echo ">Small (More than 10 Lakhs <2 Crore)</option>
                                                                                      <option value='medium'";
                                                                                       if(isset($incmplt_fields->ntrofunittype) && $incmplt_fields->ntrofunittype=='medium')
                                                                                            echo " selected ";
                                                                                echo ">Medium (More than 2 Crore <5 Crore)</option>
                                                                                      <option value='large' ";
                                                                                       if(isset($incmplt_fields->ntrofunittype) && $incmplt_fields->ntrofunittype=='large')
                                                                                            echo " selected ";
                                                                                echo ">Large (More than 5 Crore)</option>";
                                                                            }
                                                                        }
                                                                    ?>

                                                                  </select>                                                                   
                                                                  <span class="help-block">  </span>
                                                                        
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                    </div>
                                                    <!--/row-->
                                                   
                                                    <?php 
                                                    $display="display:none";
                                                       if(isset($incmplt_fields->ntrofunit)) 
                                                          if($incmplt_fields->ntrofunit=='Manufacturing'){
                                                             $display="display:block";
                                                         } 
                                                    ?>
                                                    <h3 class="form-section raw_material_header" style="<?=$display?>">Raw Material Detail</h3>
                                                    <div class="row manufactiring_detail" style="<?=$display?>">
                                                        <?php
                                                            if(isset($incmplt_fields->ntrofunit) && $incmplt_fields->ntrofunit=='Manufacturing'){
                                                                if(isset($incmplt_fields->Name_of_the_Raw_Material) && !empty($incmplt_fields->Name_of_the_Raw_Material)){
                                                                    foreach ($incmplt_fields->Name_of_the_Raw_Material as $key => $raw_material) {
                                                                        echo '<div class="col-md-12 raw_material_body_class">
                                                                        <div class="form-group mt-repeater">';
                                                                        if($key==0){  
																		  echo '<a href="javascript:;" data-repeater-create class="btn btn-success mt-repeater-add">
                                                                                <i class="fa fa-plus"></i> Add New Material</a>';
																			}	
                                                                            echo '<div data-repeater-list="group-c">
                                                                                <div data-repeater-item class="mt-repeater-item remove_body_part">
                                                                                    <div class="row mt-repeater-row">
                                                                                                <div class="col-md-4">
                                                                                                    <label class="control-label">Name of the Raw Material</label>
                                                                                                    <input type="text" placeholder="Raw Material" name="Name_of_the_Raw_Material[]" value= "'.@$incmplt_fields->Name_of_the_Raw_Material[$key].'" class="form-control" /> </div>
                                                                                                <div class="col-md-3">
                                                                                                    <label class="control-label">Annual Requirement Unit</label>
                                                                                                    <input type="text" placeholder="Requirement Unit" name="Annual_Requirement_Unit[]" value="'.@$incmplt_fields->Annual_Requirement_Unit[$key].'" class="form-control" /> </div>
                                                                                                 <div class="col-md-3">
                                                                                                    <label class="control-label">Quantity</label>
                                                                                                    <input type="text" placeholder="Quantity" name="material_quantity[]" value="'.@$incmplt_fields->material_quantity[$key].'" class="form-control" /> </div>
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
                                                                }
                                                                else{
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
                                                            }else{
                                                        ?>
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
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                    <!-- row -->
                                                    <?php 
                                                        $display="display:none";
                                                       if(isset($incmplt_fields->ntrofunit)) 
                                                          if($incmplt_fields->ntrofunit=='Manufacturing'){
                                                            $display="display:block";
                                                          } 
                                                    ?>
                                                    <h3 class="form-section raw_material_header" style="<?=$display?>">Products to be Manufactured</h3>
                                                    <div class="row manufactiring_detail product_to_be_manufactured" style="<?=$display?>">
                                                        <?php
                                                            if(isset($incmplt_fields->ntrofunit) && $incmplt_fields->ntrofunit=='Manufacturing'){
                                                                if(isset($incmplt_fields->Name_of_the_Raw_Material) && !empty($incmplt_fields->Name_of_the_Raw_Material)){
                                                                    foreach ($incmplt_fields->Name_of_the_Raw_Material as $key => $raw_material) {
                                                                        echo '<div class="col-md-12 product_manufactured_body_class">
                                                            <div class="form-group mt-repeater">';
                                                             if($key==0){
															 echo '<a href="javascript:;" data-repeater-create class="btn btn-success mt-repeater-add">
                                                                    <i class="fa fa-plus"></i> Add New Product</a>';
															}		
                                                               echo  '<div data-repeater-list="group-c">
                                                                    <div data-repeater-item class="mt-repeater-item product_manufactured_body_remove">
                                                                        <div class="row mt-repeater-row">
                                                                                                <div class="col-md-4">
                                                                                                    <label class="control-label">Product Description</label>
                                                                                                    <input type="text" placeholder="Product Description" name="Product_Description[]" value= "'.@$incmplt_fields->Product_Description[$key].'" class="form-control" /> </div>
                                                                                                <div class="col-md-3">
                                                                                                    <label class="control-label">Annual Install Capacity</label>
                                                                                                    <input type="text" placeholder="Annual Install Capacity" name="Annual_Install_Capacity[]" value="'.@$incmplt_fields->Annual_Install_Capacity[$key].'" class="form-control" /> </div>
                                                                                                 <div class="col-md-3">
                                                                                                    <label class="control-label">Quantity</label>
                                                                                                    <input type="text" placeholder="Quantity" name="product_manufactured_Quantity[]" value="'.@$incmplt_fields->product_manufactured_Quantity[$key].'" class="form-control" /> </div>
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
                                                                }
                                                                else{
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
                                                            }else{
                                                        ?>
                                                        <div class="col-md-12 product_manufactured_body_class">
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
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                    <!-- /row -->
                                                    <h3 class="form-section">Process Description</h3>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Type of Industry<span class="required" aria-required="true"> * </span></label>
                                                                <div class="col-md-9">
                                                                    <select name='type_of_industry' id="type_of_industry" class="form-control">
                                                                       <option value="">---Please Select---</option>
                                                                       <option value="green" <?php if(isset($incmplt_fields->type_of_industry)) if($incmplt_fields->type_of_industry=='green') echo "selected";?>>Green</option>
                                                                       <option value="orange" <?php if(isset($incmplt_fields->type_of_industry)) if($incmplt_fields->type_of_industry=='orange') echo "selected";?>>Orange</option>
                                                                       <option value="red" <?php if(isset($incmplt_fields->type_of_industry)) if($incmplt_fields->type_of_industry=='red') echo "selected";?>>Red</option>
                                                                       <option value="white" <?php if(isset($incmplt_fields->type_of_industry)) if($incmplt_fields->type_of_industry=='white') echo "selected";?>>White</option>
                                                                    </select>
                                                                    <span class="help-block"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Date of Commercial Production<span class="required" aria-required="true"> * </span></label>
                                                                <div class="col-md-9">
                                                                    <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                                                        <input type="text"  id="other" class="form-control form-filter input-sm" readonly value="<?=@$incmplt_fields->expected_date_of_commercial_production?>" min="<?php echo date('Y-m-d');?>" name="expected_date_of_commercial_production"
																		 placeholder="Please select the production date">
                                                                         <!-- <input type="text" class="form-control form-filter input-sm" readonly name="product_created_from" placeholder="From"> -->
                                                                        <span class="input-group-btn">
                                                                            <button class="btn btn-sm default" type="button">
                                                                                <i class="fa fa-calendar"></i>
                                                                            </button>
                                                                        </span>
                                                                    </div>
                                                                    <span class="help-block"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /row -->
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Description</label>
                                                                <div class="col-md-9">
                                                                       <textarea  id="Brief_Description_about_Processes" rows="3" class="form-control col-md-12"  name="Brief_Description_about_Processes" placeholder=" Brief_Description_about_Processes"><?=@$incmplt_fields->Brief_Description_about_Processes?></textarea>
                                                                      
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">NIC 5 Digit Code<span class="required" aria-required="true"> * </span></label>
                                                                <div class="col-md-9">
                                                                    <select name="industry_type" id="industry_type" class="form-control select2">
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
                                                                    <span class="help-block"><a href="<?=FRONT_BASEURL?>themes/backend/uploads/New-Categorization-Industries-UEPPCB-January-2014.pdf" target="_blank"><b>Click to know your type of Industry</b></a></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /row -->
                                                    <h3 class="form-section">Details of Investment (INR Crores)</h3>
                                                    <div class="row">
                                                        <label class="control-label col-md-2" style="text-align: center;">Land</label>
                                                        <label class="control-label col-md-2" style="text-align: center;">Building</label>
                                                        <label class="control-label nature_label col-md-2" style="text-align: center;">Equipment</label>
                                                        <label class="control-label col-md-2" style="text-align: center;">Capital Margin</label>
                                                        <label class="control-label col-md-2" style="text-align: center;">Other</label>
                                                        <label class="control-label col-md-2" style="text-align: center;">Total</label>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                          <div class="form-group">
                                                            <div class="col-md-2">
                                                                <input type="text"  id="land0" class="form-control land decimal" maxlength="10" value="<?=@$incmplt_fields->invstmnt_in_land[0]?>" onkeyup="sumupInst(0)" name="invstmnt_in_land[]" placeholder="Land">
                                                                <span class="help-block"></span>
                                                            </div>
                                                             <div class="col-md-2">
                                                                <input type="text"  id="building0" class="form-control building decimal" maxlength="10" value="<?=@$incmplt_fields->invstmnt_in_building[0]?>" onkeyup="sumupInst(0)" name="invstmnt_in_building[]" placeholder="Building">
                                                                <span class="help-block"></span>
                                                            </div>
                                                             <div class="col-md-2">
                                                                <input type="text"  id="plant0" class="form-control  plant_value decimal" maxlength="10" value="<?=@$incmplt_fields->invstmnt_in_plant[0]?>" onkeyup="sumupInst(0)" name="invstmnt_in_plant[]" placeholder="Plant & Machinery/Equipment">
                                                                        <span class="help-block"></span>
                                                            </div>
                                                             <div class="col-md-2">
                                                                <input type="text"  id="wrkcapt0" class="form-control capital_margin decimal" maxlength="10" value="<?=@$incmplt_fields->invstmnt_in_wrkingcapital[0]?>" onkeyup="sumupInst(0)" name="invstmnt_in_wrkingcapital[]" placeholder="Capital Margin">
                                                                <span class="help-block"></span>
                                                            </div>
                                                             <div class="col-md-2">
                                                                <input type="text"  id="other0" class="form-control other_cost decimal" maxlength="10" value="<?=@$incmplt_fields->invstmnt_in_other[0]?>" onkeyup="sumupInst(0)" name="invstmnt_in_other[]" placeholder="Other">
                                                                <span class="help-block"></span>
                                                            </div>
                                                             <div class="col-md-2">
                                                                <input type="text"  id="total0" class="form-control decimal" maxlength="10" value="<?=@$incmplt_fields->invstmnt_in_total[0]?>" readonly="readonly" name="invstmnt_in_total[]" placeholder="0.0">
                                                                <span class="help-block"></span>
                                                            </div>
                                                          </div>
                                                        </div>
                                                    </div>
                                                    <h3 class="form-section">Current Employment as on today</h3>
                                                    <div class="row">
                                                         <div class="table-responsive">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th> Category </th>
                                                                        <th> Skilled </th>
                                                                        <th> Unskilled </th>
                                                                        <th> Supervisory </th>
                                                                        <th> Engineer </th>
                                                                        <th> IT/ITeS Professional </th>
                                                                        <th> Management </th>
                                                                        <th> Total </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                       <td>Male</td>
                                                                       <td>
                                                                           <div class="form-group form-md-line-input">
                                                                               <input type="text"  id="mskl0" class="form-control mskilled decimal" maxlength='10' value="<?=@$incmplt_fields->no_of_emp_mskilled[0]?>" name="no_of_emp_mskilled[]" onkeyup="sumupEmp(0)" placeholder="Skilled">
                                                                               
                                                                               <span class="help-block"></span>
                                                                           </div>
                                                                       </td>
                                                                       <td>
                                                                           <div class="form-group form-md-line-input">
                                                                               <input type="text"  id="munskl0" class="form-control munskilled decimal" maxlength='10' value="<?=@$incmplt_fields->no_of_emp_munskilled[0]?>" name="no_of_emp_munskilled[]" onkeyup="sumupEmp(0)" placeholder="Unskilled">
                                                                               
                                                                               <span class="help-block"></span>
                                                                           </div>
                                                                       </td>
                                                                       <td>
                                                                           <div class="form-group form-md-line-input">
                                                                              <input type="text"  id="msprvsr0" class="form-control msupvsr decimal" maxlength='10' value="<?=@$incmplt_fields->no_of_emp_msupervisory[0]?>" name="no_of_emp_msupervisory[]" onkeyup="sumupEmp(0)" placeholder="Supervisory">
                                                                               
                                                                               <span class="help-block"></span>
                                                                           </div>
                                                                       </td>
                                                                       <td>
                                                                           <div class="form-group form-md-line-input">
                                                                              <input type="text"  id="mengg0" class="form-control mengg decimal" maxlength='10' value="<?=@$incmplt_fields->no_of_emp_mengineer[0]?>" name="no_of_emp_mengineer[]" onkeyup="sumupEmp(0)" placeholder="Engineer">
                                                                               
                                                                               <span class="help-block"></span>
                                                                           </div>
                                                                       </td>
                                                                       <td>
                                                                           <div class="form-group form-md-line-input">
                                                                               <input type="text"  id="mit0" class="form-control mitprof decimal" maxlength='10' value="<?=@$incmplt_fields->no_of_emp_it_mprofessional[0]?>" name="no_of_emp_it_mprofessional[]" onkeyup="sumupEmp(0)" placeholder="IT/ITeS Professional">
                                                                               
                                                                               <span class="help-block"></span>
                                                                           </div>
                                                                       </td>
                                                                       <td>
                                                                           <div class="form-group form-md-line-input">
                                                                               <input type="text"  id="mmngmnt0" class="form-control mmngmt decimal" maxlength='10' value="<?=@$incmplt_fields->no_of_emp_mmanagement[0]?>" name="no_of_emp_mmanagement[]" onkeyup="sumupEmp(0)" placeholder="Management">
                                                                               
                                                                               <span class="help-block"></span>
                                                                           </div>
                                                                       </td>
                                                                       <td>
                                                                           <div class="form-group form-md-line-input">
                                                                               <input type="text"  id="memptotal0" class="form-control" maxlength='10' value="<?=@$incmplt_fields->no_of_emp_mtotal[0]?>" name="no_of_emp_mtotal[]" readonly placeholder="Total">
                                                                               <span class="help-block"></span>
                                                                           </div>
                                                                       </td>

                                                                    </tr>
                                                                    <tr>
                                                                       <td>Female</td>

                                                                       <td>
                                                                           <div class="form-group form-md-line-input">
                                                                                <input type="text"  id="fskl0" class="form-control fskilled decimal" maxlength='10' value="<?=@$incmplt_fields->no_of_emp_fskilled[0]?>" name="no_of_emp_fskilled[]" onkeyup="fsumupEmp(0)" placeholder="Skilled">
                                                                               
                                                                               <span class="help-block"></span>
                                                                           </div>
                                                                       </td>
                                                                       <td>
                                                                           <div class="form-group form-md-line-input">
                                                                              <input type="text"  id="funskl0" class="form-control funskilled decimal" maxlength='10' value="<?=@$incmplt_fields->no_of_emp_funskilled[0]?>" name="no_of_emp_funskilled[]" onkeyup="fsumupEmp(0)" placeholder="Unskilled">
                                                                               
                                                                               <span class="help-block"></span>
                                                                           </div>
                                                                       </td>
                                                                       <td>
                                                                           <div class="form-group form-md-line-input">
                                                                             <input type="text"  id="fsprvsr0" class="form-control mfupvsr decimal" maxlength='10' value="<?=@$incmplt_fields->no_of_emp_fsupervisory[0]?>" name="no_of_emp_fsupervisory[]" onkeyup="fsumupEmp(0)" placeholder="Supervisory">
                                                                               
                                                                               <span class="help-block"></span>
                                                                           </div>
                                                                       </td>
                                                                       <td>
                                                                           <div class="form-group form-md-line-input">
                                                                              <input type="text"  id="fengg0" class="form-control feggg decimal" maxlength='10' value="<?=@$incmplt_fields->no_of_emp_fengineer[0]?>" name="no_of_emp_fengineer[]" onkeyup="fsumupEmp(0)" placeholder="Engineer">
                                                                               
                                                                               <span class="help-block"></span>
                                                                           </div>
                                                                       </td>
                                                                       <td>
                                                                           <div class="form-group form-md-line-input">
                                                                               <input type="text"  id="fit0" class="form-control fitprof decimal" maxlength='10' value="<?=@$incmplt_fields->no_of_emp_it_fprofessional[0]?>" name="no_of_emp_it_fprofessional[]" onkeyup="fsumupEmp(0)" placeholder="IT/ITeS Professional">
                                                                               
                                                                               <span class="help-block"></span>
                                                                           </div>
                                                                       </td>
                                                                       <td>
                                                                           <div class="form-group form-md-line-input">
                                                                               <input type="text"  id="fmngmnt0" class="form-control fmngmt decimal" maxlength='10' value="<?=@$incmplt_fields->no_of_emp_fmanagement[0]?>" name="no_of_emp_fmanagement[]" onkeyup="fsumupEmp(0)" placeholder="Management">    
                                                                               
                                                                               <span class="help-block"></span>
                                                                           </div>
                                                                       </td>
                                                                       <td>
                                                                           <div class="form-group form-md-line-input">
                                                                              <input type="text"  id="femptotal0" class="form-control" maxlength='10' value="<?=@$incmplt_fields->no_of_emp_ftotal[0]?>" name="no_of_emp_ftotal[]" readonly placeholder="Total">
                                                                               <span class="help-block"></span>
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
                                                <i class="fa fa-gift"></i>CAF Application -Step 3 </div>
                                            <div class="tools">
                                                <a href="javascript:;" class="collapse"> </a>
                                                <a href="javascript:;" class="reload"> </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body form">
                                            <!-- BEGIN FORM-->
                                                <div class="form-body">
                                                    <h3 class="form-section">Proposed Land</h3>
                                                    <div class="row">
                                                        <?php /*?><div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Do you have land?<span class="required" aria-required="true"> * </span></label>
                                                                <div class="col-md-9">
                                                                    <select name="have_own_land" id='have_own_land' class="form-control">
                                                                       <option value="">Do you have land</option>
                                                                       <option value="Yes" <?php if(isset($incmplt_fields->have_own_land)) if($incmplt_fields->have_own_land=='Yes') echo "selected";?> >Yes</option>
                                                                       <option value="No" <?php if(isset($incmplt_fields->have_own_land)) if($incmplt_fields->have_own_land=='No') echo "selected";?> >No</option>
                                                                    </select>
                                                                    <span class="help-block"></span>
                                                                </div>
                                                            </div>
                                                        </div><?php */?>
                                                        <!--/span-->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Land Details<span class="required" aria-required="true"> * </span></label>
                                                                <div class="col-md-9">
                                                                  <select name="Proposed_details_of_Land" id='Proposed_details_of_Land' class="form-control">
                                                                     <option value="">* Land Details</option>
                                                                     <option value="Notified Land" <?php if(isset($incmplt_fields->Proposed_details_of_Land)) if($incmplt_fields->Proposed_details_of_Land=='Notified Land') echo "selected";?>>Notified Land</option>
                                                                     <option value="SIIDCUL Land" <?php if(isset($incmplt_fields->Proposed_details_of_Land)) if($incmplt_fields->Proposed_details_of_Land=='SIIDCUL Land') echo "selected";?> >SIIDCUL Land</option>
                                                                     <option value="DI Land" <?php if(isset($incmplt_fields->Proposed_details_of_Land)) if($incmplt_fields->Proposed_details_of_Land=='DI Land') echo "selected";?>>DI Land</option>
                                                                     <option value="Rented Space" <?php if(isset($incmplt_fields->Proposed_details_of_Land)) if($incmplt_fields->Proposed_details_of_Land=='Rented Space') echo "selected";?>>Rented Space</option>
                                                                     <option value="Own Land/Space" <?php if(isset($incmplt_fields->Proposed_details_of_Land)) if($incmplt_fields->Proposed_details_of_Land=='Own Land/Space') echo "selected";?>>Own Land/Space</option>
                                                                     <option value="Other" <?php if(isset($incmplt_fields->Proposed_details_of_Land)) if($incmplt_fields->Proposed_details_of_Land=='Other') echo "selected";?>>Other/Purchase</option>
                                                                  </select>                                                                
                                                                  <span class="help-block">  </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                    </div>
                                                    <!--/row-->
                                                    <h3 class="form-section">Detail of Land</h3>
                                                    <div class="row">
                                                        <div class="col-md-6 land_leased_other">
                                                            <div class="form-group">
                                                                <label class="control-label check_no_own_land_lable col-md-3">Land in Sq. Meters<span class="required" aria-required="true"> * </span></label>
                                                                <div class="col-md-9">
                                                                    <input type="text"  name="Land_in_Hectares" id="Land_in_Heetares" class="form-control decimal"  value="<?=@$incmplt_fields->Land_in_Hectares?>"  placeholder="* Area">
                                                                    <span class="help-block"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Address<span class="required" aria-required="true"> * </span></label>
                                                                <div class="col-md-9">
                                                                  <input type="text"  id="land_address" class="form-control address_field_with_space" maxlength="100" value="<?=@$incmplt_fields->land_address?>" name="land_address" placeholder="* Street Name/City">                                               
                                                                  <span class="help-block">  </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                    </div>
                                                    <!-- /row -->
                                                    <div class="append_later">
                                                        <div class="row">
                                                            <?php
                                                                if(isset($incmplt_fields->land_area_pin_code)){
                                                            ?>
                                                            <div class="col-md-6 land_leased_other">
                                                                <div class="form-group">
                                                                    <label class="control-label check_no_own_land_lable col-md-3">Pin Code<span class="required" aria-required="true"> * </span></label>
                                                                    <div class="col-md-9">
                                                                         <input type="text"  name="land_area_pin_code" id="land_area_pin_code" class="six_digit_zip_code form-control" value="<?=@$incmplt_fields->land_area_pin_code?>" placeholder="* Pincode">
                                                                        <span class="help-block"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--/span-->
                                                             <?php }
                                                            if(isset($incmplt_fields->Khasra_no)){
                                                             ?>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">Plot/Khasra No<span class="required" aria-required="true"> * </span></label>
                                                                    <div class="col-md-9">
                                                                      <input type="text"  id="Khasra_no" class="form-control address_field_with_space" maxlength="100" value="<?=@$incmplt_fields->Khasra_no?>" name="Khasra_no" placeholder="* Plot/Khasra_no">                                            
                                                                      <span class="help-block">  </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php }?>
                                                            <!--/span-->
                                                        </div>
                                                        <!-- /row -->
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6 land_leased_other">
                                                            <div class="form-group">
                                                                <label class="control-label check_no_own_land_lable col-md-3">Tehsil<span class="required" aria-required="true"> * </span></label>
                                                                <div class="col-md-9">
                                                                    <input type="text"  id="Location" class="form-control name_with_space" value="<?=@$incmplt_fields->tehsil?>" maxlength="100" name="tehsil" placeholder="* Tehsil">
                                                                    <span class="help-block"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">District<span class="required" aria-required="true"> * </span></label>
                                                                <div class="col-md-9">
                                                                  <select name='land_leased_disctric' id="land_leased_disctric" class="form-control">
                                                                     <option value="">---Please Select District---</option>
                                                                     <?php
                                                                        $criteria=new CDbCriteria;
                                                                        $criteria->select="district_id,distric_name";
                                                                        $criteria->condition="is_active=:active";
                                                                        $criteria->params=array(":active"=>"Y");
                                                                        $district=District::model()->findAll($criteria);
                                                                        if(!empty($district)){
                                                                            foreach ($district as $key => $dist) {
                                                                              echo '<option value="'.$dist->district_id.'"';
                                                                              if(isset($incmplt_fields->land_leased_disctric)) 
                                                                                  if($incmplt_fields->land_leased_disctric==$dist->district_id) 
                                                                                      echo "selected";
                                                                                echo '>'.$dist->distric_name.'</option>';
                                                                            }
                                                                        }
                                                                        ?>
                                                                  </select>                                             
                                                                  <span class="help-block">  </span>
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
                                                                    <label class="control-label check_no_own_land_lable col-md-3">Area In sq Meters<span class="required" aria-required="true"> * </span></label>
                                                                    <div class="col-md-9">
                                                                        <input type="text"  id="detail_of_leased_space_area_in_sq_meters" class="form-control decimal" value="<?=@$incmplt_fields->detail_of_leased_space_area_in_sq_meters?>" name="detail_of_leased_space_area_in_sq_meters" placeholder="* Area in Sq. Meters">
                                                                        <span class="help-block"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--/span-->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label check_no_own_land_lable col-md-3">Address<span class="required" aria-required="true"> * </span></label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" id="detail_of_leased_address" class="form-control address_field_with_space" maxlength="100" value="<?=@$incmplt_fields->detail_of_leased_address?>" name="detail_of_leased_address" placeholder="* Address">
                                                                        <span class="help-block"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--/span-->
                                                        </div>
                                                        <!-- /row -->
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label check_no_own_land_lable col-md-3">Tehsil<span class="required" aria-required="true"> * </span></label>
                                                                    <div class="col-md-9">
                                                                        <input type="text"  id="detail_of_leased_space_tehsil" class="form-control name_with_space" maxlength="100" value="<?=@$incmplt_fields->detail_of_leased_space_tehsil?>" name="detail_of_leased_space_tehsil" placeholder="* Tehsil">
                                                                        <span class="help-block"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--/span-->
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label check_no_own_land_lable col-md-3">District<span class="required" aria-required="true"> * </span></label>
                                                                    <div class="col-md-9">
                                                                        <select name='land_disctric' id="land_disctric" class="form-control">
                                                                           <option value="">* Please Select District</option>
                                                                           <?php
                                                                              if(!empty($district)){
                                                                                   foreach ($district as $key => $dist) {
                                                                                     echo '<option value="'.$dist->district_id.'"';
                                                                                     if(isset($incmplt_fields->land_leased_disctric)) 
                                                                                         if($incmplt_fields->land_leased_disctric==$dist->district_id) 
                                                                                             echo "selected";
                                                                                       echo '>'.$dist->distric_name.'</option>';
                                                                                   }
                                                                               }
                                                                              ?>
                                                                        </select>
                                                                        <span class="help-block"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--/span-->
                                                        </div>
                                                        <!-- /row -->
                                                    </div>
                                                    <h3 class="form-section">Other Requirements</h3>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="table-responsive">
                                                               <table class="table table-bordered">
                                                                   <thead>
                                                                       <tr>
                                                                           <th> Water Requirement </th>
                                                                           <th> Quality </th>
                                                                           <th> Unit </th>
                                                                       </tr>
                                                                   </thead>
                                                                   <tbody>
                                                                        <tr>    
                                                                            <td>
                                                                                <div class="form-group form-md-line-input">
                                                                                    <label class="control-label check_no_own_land_lable">Industrial</label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group form-md-line-input">
                                                                                    <input type="text" name="industrial_water" value="<?=@$incmplt_fields->industrial_water?>" class="decimal form-control">
                                                                                    <span class="help-block"></span>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group form-md-line-input">
                                                                                    <label class="control-label check_no_own_land_lable">Liters/Year</label>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <div class="form-group form-md-line-input">
                                                                                    <label class="control-label check_no_own_land_lable">Domestic</label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group form-md-line-input">
                                                                                    <input type="text" name="domestic_water" value="<?=@$incmplt_fields->domestic_water?>" class="decimal form-control">
                                                                                    <span class="help-block"></span>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group form-md-line-input">
                                                                                    <label class="control-label check_no_own_land_lable">Liters/Year</label>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <div class="form-group form-md-line-input">
                                                                                    <label class="control-label check_no_own_land_lable">Source of water</label>
                                                                                </div>
                                                                            </td>
                                                                            <td colspan="2"> 
                                                                                <div class="form-group form-md-line-input">
                                                                                    <input type="text" name="source_of_water" value="<?=@$incmplt_fields->source_of_water?>" class="form-control name_with_space">
                                                                                    <span class="help-block"></span>
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
                                                                           <th> Source of Power </th>
                                                                           <th> Quantity </th>
                                                                           <th> Unit </th>
                                                                       </tr>
                                                                   </thead>
                                                                   <tbody>
                                                                        <tr>    
                                                                            <td>
                                                                                <div class="form-group form-md-line-input">
                                                                                    <label class="control-label">Coal</label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group form-md-line-input">
                                                                                    <input type="text" name="coal" value="<?=@$incmplt_fields->coal?>" class="decimal form-control">
                                                                                    <span class="help-block"></span>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group form-md-line-input">
                                                                                    <label class="control-label">TONNES</label>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <div class="form-group form-md-line-input">
                                                                                    <label class="control-label ">Liquid Petrolium Gas</label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group form-md-line-input">
                                                                                    <input type="text" name="lpg" value="<?=@$incmplt_fields->lpg?>"  class="decimal form-control">
                                                                                    <span class="help-block"></span>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group form-md-line-input">
                                                                                    <label class="control-label">KILOGRAM</label>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <div class="form-group form-md-line-input">
                                                                                    <label class="control-label">Electricity</label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group form-md-line-input">
                                                                                    <input type="text" name="electricity" value="<?=@$incmplt_fields->electricity?>" class="decimal form-control">
                                                                                    <span class="help-block"></span>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group form-md-line-input">
                                                                                    <label class="control-label">KVA</label>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>    
                                                                                <div class="form-group form-md-line-input">
                                                                                    <label class="control-label">Solar</label>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group form-md-line-input">
                                                                                    <input type="text" name="solar" value="<?=@$incmplt_fields->solar?>"  class="decimal form-control">
                                                                                    <span class="help-block"></span>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="form-group form-md-line-input">
                                                                                    <label class="control-label">KW</label>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                   </tbody>
                                                                </table>
                                                            
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <!-- /row -->
                                                 
                                                    <!-- /row -->
                                                        

                                                </div>
                                             
                                        </div>
                                    </div>
                                </div>
								<!----------------------------------------------------------------------------------------------------------------------->
								<div class="tab-pane" id="tab4" >
                                   <!-- <h3 class="block">Requirements</h3>-->
                                    <div class="portlet box green">
													<div class="portlet-title">
														<div class="caption">
															<i class="fa fa-gift"></i>CAF Application -Step 4 </div>
														<div class="tools">
															<a href="javascript:;" class="collapse"> </a>
															<a href="javascript:;" class="reload"> </a>
														</div>
													</div>
                                        <div class="portlet-body form">
										 <!-- BEGIN FORM-->
                                                <div class="form-body">
                                                    <h3 class="form-section">Existing Registration Details </h3>
													<div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">EM Part-2 Details<span class="required" aria-required="true"> * </span></label>
                                                                <div class="col-md-9">
                                                                    
							<input type="text"  id="em_detail" class="form-control" name='em_detail' value="<?=@$incmplt_fields->em_detail?>"  placeholder="EM Part-2 Details">
                                                                    <span class="help-block"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
														</div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">IEM data<span class="required" aria-required="true"> * </span></label>
                                                                <div class="col-md-9">
                                                                    
																	 <input type="text"  id="iem_data" class="form-control" name='iem_data' value="<?=@$incmplt_fields->iem_data?>"  placeholder="IEM data">
                                                                    <span class="help-block"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">PCB Id<span class="required" aria-required="true"> * </span></label>
                                                                <div class="col-md-9">
                                                                   
																   <input type="text"  id="pcb_id" class="form-control" name='pcb_id' value="<?=@$incmplt_fields->pcb_id?>"  placeholder="PCB Id">                                                              
                                                                  <span class="help-block">  </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                    </div>
                                                    <!--/row-->
												<!----------------------------------------------------------------------------------------------------------------------->
													<h3 class="form-section ">Renewable Details</h3>
													<?php //print_r(count($incmplt_fields->department_id)); 
													if(isset($incmplt_fields->department_id) && !empty($incmplt_fields->department_id)){
                                                    foreach ($incmplt_fields->department_id as $key => $hgsfjfjsdgf) { 
													 $dddkey=$incmplt_fields->department_id[$key]; 
													  $ssskey=$incmplt_fields->service_id[$key]; 
													  $vvvkey=$incmplt_fields->valid_upto[$key]; ?>
													<div class="row">
													<div class="col-md-12 ">
                                                            <div class="form-group mt-repeater">
															<?php if($key==0){ ?>
                                                              <a href="javascript:;" data-repeater-create class="btn btn-success mt-repeater-add addservice" rel="0">
                                                                    <i class="fa fa-plus"></i> Add New </a><?php } ?>
																	
                                                                <div data-repeater-list="group-c">
                                                                    <div data-repeater-item class="mt-repeater-item remove_body_part">
                                                                        <div class="row mt-repeater-row">
                                                                            <div class="col-md-3">
                                                                                <label class="control-label">Department <?php //echo $dddkey; ?></label>
          <select name="department_id[]" id="department_id0" class="form-control depty " onchange="showUser(this.value,this.getAttribute('rel'))" rel="0">
                                                                       <option value="">---Please Select---</option>
                                                                       <?php   
														
						   $sql="SELECT bo_infowizard_issuerby_master.issuerby_id,bo_infowizard_issuerby_master.name 
						   FROM bo_infowizard_issuerby_master 
						   LEFT JOIN bo_information_wizard_service_master ON bo_infowizard_issuerby_master.issuerby_id=bo_information_wizard_service_master.issuerby_id
						   where bo_infowizard_issuerby_master.issuer_id=2 and bo_infowizard_issuerby_master.is_issuerby_active='Y'
						    and bo_information_wizard_service_master.to_be_used_in_iw='Y' 
						   group by bo_infowizard_issuerby_master.issuerby_id"; 
						  
  
																				$connection=Yii::app()->db;
																				$command=$connection->createCommand($sql);
																				$deptDAta=$command->queryAll();
                                                                          if(isset($deptDAta) && !empty($deptDAta)){
                                                                             foreach ($deptDAta as $key => $deptdataa) {
                                                                                echo "<option value='".$deptdataa['issuerby_id']."'";
                                                                   if($dddkey==$deptdataa['issuerby_id'])
                                                                                      echo " selected ";
                                                                                echo ">".$deptdataa['name']."</option>";
                                                                             }
                                                                            
                                                                          }
                                                                       ?>      
                                                                    </select> </div> 
																	
                                                                            <div class="col-md-3">
                                                                                <label class="control-label">Service Name <?php //echo $ssskey; ?></label>
													<?php if(!empty($ssskey)) {    ?>
			
<select name="service_id[]" id="service_id0" class="form-control" >

<?php  $sql="SELECT bo_information_wizard_service_parameters.service_id,bo_information_wizard_service_parameters.core_service_name 
  FROM  bo_information_wizard_service_master 
  LEFT JOIN bo_information_wizard_service_parameters ON bo_information_wizard_service_master.id=bo_information_wizard_service_parameters.service_id
  where bo_information_wizard_service_parameters.servicetype_additionalsubservice=6 and bo_information_wizard_service_master.issuerby_id=$dddkey";
$connection = Yii::app()->db;
$command = $connection->createCommand($sql);
$AllIssuerBy = $command->queryAll();
echo "<option value=''><-----Select-----></option>";
if (isset($AllIssuerBy)) {
foreach ($AllIssuerBy as $vs) { ?>
<option value="<?php echo $vs['service_id']; ?>" <?php if($ssskey==$vs['service_id']) echo "selected"; ?> ><?php echo $vs['core_service_name']; ?></option>
<?php 
}
}

?>
</select>
			
	<?php	} else { ?>

	<select class="form-control servy"  name="service_id[]" id="service_id0" ></select>
	<?php  } ?>
																				
                                                                              
																			   </div>
																			  
                                                                             <div class="col-md-3">
                                                                              
						<label class="control-label">Valide Upto</label> 
																			 <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
       <input type="text"  id="valid_upto0" name="valid_upto[]" class="form-control form-filter input-sm" readonly 
	   min="<?php echo date('Y-m-d');?>"  placeholder="Valide Upto" value="<?php echo $vvvkey;?>">
                                                                        <span class="input-group-btn">
                                                                            <button class="btn btn-sm default" type="button">
                                                                                <i class="fa fa-calendar"></i>
                                                                            </button>
                                                                        </span>
																																
																				</div>
                                                                            
                                                                            </div>
																		<div class="col-md-1">
                                                                                <a href="javascript:;" data-repeater-delete class="btn btn-danger mt-repeater-delete">
                                                                                    <i class="fa fa-close"></i>
                                                                                </a>
                                                                            </div>
																		
                                                                    </div>
                                                                </div>
																 
                                                            </div>
                                                        </div>
                                                      
                                                   </div>
												  <?php } 
												  } else {  ?>
						
													<div class="row">
													<div class="col-md-12 ">
                                                            <div class="form-group mt-repeater">
															
                                                              <a href="javascript:;" data-repeater-create class="btn btn-success mt-repeater-add addservice" rel="0">
                                                                    <i class="fa fa-plus"></i> Add New jhgj</a>
																	
                                                                <div data-repeater-list="group-c">
                                                                    <div data-repeater-item class="mt-repeater-item remove_body_part">
                                                                        <div class="row mt-repeater-row">
                                                                            <div class="col-md-3">
                                                                                <label class="control-label">Department</label>
          <select name="department_id[]" id="department_id0" class="form-control depty " onchange="showUser(this.value,this.getAttribute('rel'))" rel="0">
                                                                       <option value="">---Please Select---</option>
                                                                       <?php   
														
						   $sql="SELECT bo_infowizard_issuerby_master.issuerby_id,bo_infowizard_issuerby_master.name 
						   FROM bo_infowizard_issuerby_master 
						   LEFT JOIN bo_information_wizard_service_master ON bo_infowizard_issuerby_master.issuerby_id=bo_information_wizard_service_master.issuerby_id
						   where bo_infowizard_issuerby_master.issuer_id=2 and bo_infowizard_issuerby_master.is_issuerby_active='Y'
						    and bo_information_wizard_service_master.to_be_used_in_iw='Y' 
						   group by bo_infowizard_issuerby_master.issuerby_id"; 
						  
  
																				$connection=Yii::app()->db;
																				$command=$connection->createCommand($sql);
																				$deptDAta=$command->queryAll();
                                                                          if(isset($deptDAta) && !empty($deptDAta)){
                                                                             foreach ($deptDAta as $key => $deptdataa) {
                                                                                echo "<option value='".$deptdataa['issuerby_id']."'";
                                                                   
                                                                                echo ">".$deptdataa['name']."</option>";
                                                                             }
                                                                            
                                                                          }
                                                                       ?>      
                                                                    </select> </div>
                                                                            <div class="col-md-3">
                                                                                <label class="control-label">Service Name</label>
																				<select class="form-control servy"  name="service_id[]" id="service_id0" ></select>
                                                                               <!-- <input type="text" placeholder="Service Name" name="service_id[]" class="form-control" /> -->
																			   </div>
                                                                             <div class="col-md-3">
                                                                              
						<label class="control-label">Valide Upto</label> 
																			 <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
       <input type="text"  id="valid_upto0" name="valid_upto[]" class="form-control form-filter input-sm" readonly  
	   min="<?php echo date('Y-m-d');?>"  placeholder="Valide Upto">
                                                                        <span class="input-group-btn">
                                                                            <button class="btn btn-sm default" type="button">
                                                                                <i class="fa fa-calendar"></i>
                                                                            </button>
                                                                        </span>
																																
																				</div>
                                                                        </div>
																		 <div class="col-md-1">
                                                                                <a href="javascript:;" data-repeater-delete class="btn btn-danger mt-repeater-delete">
                                                                                    <i class="fa fa-close"></i>
                                                                                </a>
                                                                            </div>
                                                                    </div>
                                                                </div>
																 
                                                         
                                                        </div>
                                                      </div> 
                                                   </div>
												   <?php } ?>
												   <!----------------------------------------------------------------------------------------------------------------------->
										 </div>          
                                      <!-- row --> 
                                               </div>
								</div>
								</div>
							</div></div>
								 </form>
								
								<!----------------------------------------------------------------------------------------------------------------------->
                                <div class="tab-pane <?php if($document==1) echo 'active'?>" id="tab5">
                                    <!--<h3 class="block">Checklist</h3>-->
                                    <div class="portlet box green">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-gift"></i>CAF Application -Step 5- Checklist </div>
                                            <div class="tools">
                                                <a href="javascript:;" class="collapse"> </a>
                                                <a href="javascript:;" class="reload"> </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body form">
                                            <div class="form-body">
                                                <h3 class="form-section">Upload Documents</h3>
                                                <div class="row">  
                                                    <?php
                                                    $docUploadPening=false;
                                                    $count=1;
                                                    $docModel=new ApplicationCdnMappingExt;
                                                    $docs=$docModel::getApplicationDocumentOnly($app['application_id']);
                                                    $userAlreadyUploadedDocs=$docModel::isDocAlreadyUploadedByUser($pre_field['user_id']);
                                                  //   echo "<!--<pre>";print_r($docs);print_r($userAlreadyUploadedDocs);echo "-->";
                                                    if($docs){
                                                        echo '<div class="table-responsive" style="overflow-x:hidden">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th> Document Type </th>
                                                                            <th> Document Name </th>
                                                                            <th> File Type </th>
                                                                            <th> Document Size </th>
                                                                            <th> Document Status </th>
                                                                            <th> Action </th>

                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>';
                                                                    // echo "<pre>";print_r($app);die;
$docNeedToUpload=0;
                                                                 $flg1=0;   foreach ($docs as $doc) {
                                                                        $docInfo=$docModel::isDocAlreadyUploadedByUser($pre_field['user_id'],$doc['doc_id']);
                                                                   ?>   <?php //echo "<tr><td colspan='6'><!-- Doc Info".print_r($docInfo)."--></td></tr>"; ?>
                                                                <?php  if(!empty($docInfo)){
                                                                    if($docInfo['parent_doc_id']=='1'){
                                                                
                                                                                  $flg1=$flg1+1; 
                                                                               }
                                                                                if($docInfo['parent_doc_id']=='3'){
                                                                                  $flg1=$flg1+1; 
                                                                               }
                                                                                if($docInfo['parent_doc_id']=='7'){
                                                                                  $flg1=$flg1+1; 
                                                                               }
                                                                     
                                                                }
                                                                         // echo "<!--User Already Uploaded".print_r($userAlreadyUploadedDocs)."-->";
                                                                        if(in_array($doc['doc_id'], $userAlreadyUploadedDocs)){
                                                                            
                                                                            // $docInfo=$docModel::isDocAlreadyUploadedByUser($pre_field['user_id'],$doc['doc_id']);
                                                                           if(($docInfo['doc_status']=='R' || ($doc['is_doc_req_everytime']=='Y') && $docInfo['doc_status']=='V' && $appStatus=='I')){
                                                                             // if($docInfo['doc_status']=='R' || ($doc['is_doc_req_everytime']=='Y')){
                                                                                $docUploadPening=true;
                                                                                // echo "true for <pre>".$doc['doc_id'];print_r($docInfo);print_r($doc);echo "app status ".$appStatus;die("check 1");

                                                                                echo "<tr><td><form action='".Yii::app()->createAbsoluteUrl('frontuser/existing/uploadInvestorDocs')."' method='POST' enctype='multipart/form-data'>";
                                                                                        if($doc['is_doc_mendatory']=='Y'){
                                                                                            $docUploadPening=true;
                                                                                            // echo "true for ".$doc['doc_id'];die("check 2");;
                                                                                              if($docNeedToUpload==0){
                                                                                        $docNeedToUpload=1;
                                                                                    }
                                                                                        }
                                                                                            

                                                                                      $name=$doc['doc_name'];
                                                                                      if (preg_match('/_/',$doc['doc_name']))
                                                                                            $doc['doc_name']=str_replace('_', ' ', $doc['doc_name']);
                                                                                         echo ucwords($doc["doc_name"]);
                                                                                         echo "</td>";
                                                                                       if($name=='* Identity_Proof'){
                                                                                            echo "<td>";
                                                                                            echo "<select required class='form-control' name='selected_doc_id_card'>
                                                                                                  <option value='PAN Card'>PAN Card</option>
                                                                                                  <option value='Aadhaar Card'>Aadhaar Card</option>
                                                                                                  </select></td>";
                                                                                         }
                                                                                         elseif($name=='Document_Related_to_Firm_(as_applicable)'){
                                                                                            echo "<td>";
                                                                                            echo "<select required class='form-control' name='selected_partnership_deed'>
                                                                                            <option value=''>Please select</option>
                                                                                                  <option value='partnership_deed'>Partnership Deed</option>
                                                                                                  <option value='Firm_registration_certificate'>Firm registration certificate</option>
                                                                                                  <option value='Society_registration_certificate'>Society registration certificate</option>
                                                                                                  <option value='Memorandum_of_Article'>Memorandum of Article</option>
                                                                                                  <option value='Certificate_of-Incorporation'>Certificate of Incorporation</option>
                                                                                                  </select></td>";
                                                                                         }
                                                                                         elseif($name=='Expansion(if any)'){
                                                                                          echo "<td>";
                                                                                          echo "<select required class='form-control' name='selected_expension'>
                                                                                          <option value=''>Please select</option>
                                                                                                <option value='iem_part'>IEM Part B</option>
                                                                                                <option value='UAM'>UAM</option>
                                                                                                <option value='EM2'>EM2</option>
                                                                                                </select></td>";
                                                                                         }
                                                                                         else
                                                                                          echo "<td>&nbsp;</td>";
                                                                                       echo "<td>
                                                                                          <select class='form-control' required name='selected_doc_type'>
                                                                                                  <option value=''>File Type</option>
                                                                                                  <option value='application/pdf'>PDF</option>
                                                                                                  <option value='image/jpeg'>Image</option>
                                                                                          </select>
                                                                                       </td><td>".$doc["doc_min_size"]."-".$doc["doc_max_size"]." Kb"."</td>
                                                                                    <td>";
                                                                                     echo '<div class="fileinput fileinput-new" data-provides="fileinput">
                                                                                              <span class="btn green btn-file">
                                                                                                  <i class="fa fa-folder-open-o"></i>
                                                                                                  <span class="fileinput-new"> Select file </span>
                                                                                                  <span class="fileinput-exists"> Change </span>
                                                                                                     <input type="file" name="caf_applications_uploads"';
                                                                                                     if($name=='*id_card')
                                                                                                        echo " required ";
                                                                                                      if($name=='*address_proof')
                                                                                                        echo " required ";
                                                                                                      if($name=='*brief_project_report')
                                                                                                        echo " required ";
                                                                                                  echo'/> </span>
                                                                                                  <input type="hidden" name="caf_applications_uploads[doc_id]" value="'.$doc["doc_id"].'">
                                                                                                  <input type="hidden" name="caf_applications_uploads[app_id]" value="'.$app["application_id"].'">
                                                                                                  <input type="hidden" name="caf_applications_uploads[YII_CSRF_TOKEN]" value="'.Yii::app()->getRequest()->getCsrfToken().'" />

                                                                                              <span class="fileinput-filename"> </span> &nbsp;
                                                                                              <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"> </a>
                                                                                          </div>';
                                                                                    echo "</td>
                                                                                    <td><input type='submit' value='Upload' class='btn Blue'></td></tr></form>";
                                                                         
                                                                                   
                                                                                    
                                                                                         }
                                                                            else{
                                                                                echo "<tr><td>";
                                                                                        $name=$doc['doc_name'];
                                                                                        if (preg_match('/_/',$doc['doc_name']))
                                                                                              $doc['doc_name']=str_replace('_', ' ', $doc['doc_name']);
                                                                                           echo ucwords($doc["doc_name"]);
                                                                                           echo "</td>
                                                                                         <td>".$docInfo['document_name']."</td><td>".$docInfo["document_mime_type"]."</td><td>".$doc["doc_min_size"]."-".$doc["doc_max_size"]."</td>
                                                                                      <td>
                                                                                         <span class='label label-info'>";
                                                                                             if($docInfo['doc_status']=='P')
                                                                                               echo  "Verification pending at department Level";
                                                                                             elseif($docInfo['doc_status']=='V')
                                                                                               echo "Verified by department";
                                                                                             elseif($docInfo['doc_status']=='R')
                                                                                               echo "Rejected by department";
                                                                                         
                                                                                         echo "</span>
                                                                                      </td>
                                                                                      <td>No Action Required</td>
                                                                                   </tr>";
                                                                            }
                                                                           
                                                                        }
                                                                        else{
                                                                            if($doc['is_doc_mendatory']=='Y'){
                                                                                 $docUploadPening=true;
                                                                                // echo "true for ".$doc['doc_id'];die("check 3");;
                                                                            }
                                                                               

                                                                            echo "<tr><td><form action='".Yii::app()->createAbsoluteUrl('frontuser/existing/uploadInvestorDocs')."' method='POST' enctype='multipart/form-data'>";
                                                                                  $name=$doc['doc_name'];
                                                                                  if (preg_match('/_/',$doc['doc_name']))
                                                                                        $doc['doc_name']=str_replace('_', ' ', $doc['doc_name']);
                                                                                     echo ucwords($doc["doc_name"]);
                                                                                     echo "</td>";
                                                                                   if($name=='* Identity_Proof'){
                                                                                        echo "<td>";
                                                                                        echo "<select required class='form-control' name='selected_doc_id_card'>
                                                                                              <option value='PAN Card'>PAN Card</option>
                                                                                              <option value='Aadhaar Card'>Aadhaar Card</option>
                                                                                              </select></td>";
                                                                                     }
                                                                                     elseif($name=='Document_Related_to_Firm_(as_applicable)'){
                                                                                        echo "<td>";
                                                                                        echo "<select required class='form-control' name='selected_partnership_deed'>
                                                                                        <option value=''>Please select</option>
                                                                                              <option value='partnership_deed'>Partnership Deed</option>
                                                                                              <option value='Firm_registration_certificate'>Firm registration certificate</option>
                                                                                              <option value='Society_registration_certificate'>Society registration certificate</option>
                                                                                              <option value='Memorandum_of_Article'>Memorandum of Article</option>
                                                                                              <option value='Certificate_of-Incorporation'>Certificate of Incorporation</option>
                                                                                              </select></td>";
                                                                                     }
                                                                                     elseif($name=='Expansion(if any)'){
                                                                                      echo "<td>";
                                                                                      echo "<select required class='form-control' name='selected_expension'>
                                                                                      <option value=''>Please select</option>
                                                                                            <option value='iem_part'>IEM Part B</option>
                                                                                            <option value='UAM'>UAM</option>
                                                                                            <option value='EM2'>EM2</option>
                                                                                            </select></td>";
                                                                                     }
                                                                                     else
                                                                                      echo "<td>&nbsp;</td>";
                                                                                   echo "<td>
                                                                                      <select class='form-control' required name='selected_doc_type'>
                                                                                              <option value=''>File Type</option>
                                                                                              <option value='application/pdf'>PDF</option>
                                                                                              <option value='image/jpeg'>Image</option>
                                                                                      </select>
                                                                                   </td><td>".$doc["doc_min_size"]."-".$doc["doc_max_size"]." Kb"."</td>
                                                                                <td>";
                                                                                 echo '<div class="fileinput fileinput-new" data-provides="fileinput">
                                                                                          <span class="btn green btn-file">
                                                                                              <i class="fa fa-folder-open-o"></i>
                                                                                              <span class="fileinput-new"> Select file </span>
                                                                                              <span class="fileinput-exists"> Change </span>
                                                                                                 <input type="file" name="caf_applications_uploads"';
                                                                                                 if($name=='*id_card')
                                                                                                    echo " required ";
                                                                                                  if($name=='*address_proof')
                                                                                                    echo " required ";
                                                                                                  if($name=='*brief_project_report')
                                                                                                    echo " required ";
                                                                                              echo'/> </span>
                                                                                              <input type="hidden" name="caf_applications_uploads[doc_id]" value="'.$doc["doc_id"].'">
                                                                                              <input type="hidden" name="caf_applications_uploads[app_id]" value="'.$app["application_id"].'">
                                                                                              <input type="hidden" name="caf_applications_uploads[YII_CSRF_TOKEN]" value="'.Yii::app()->getRequest()->getCsrfToken().'" />

                                                                                          <span class="fileinput-filename"> </span> &nbsp;
                                                                                          <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"> </a>
                                                                                      </div>';
                                                                                echo "</td>
                                                                                <td><input type='submit' value='Upload' class='btn Blue'></td></tr></form>";
                                                                        }
                                                                }
                                                             echo '</tbody></table>';
                                                    }

                                                    ?>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <a href="javascript:;" class="btn default button-previous btn_prev">
                                        <i class="fa fa-angle-left"></i> Back </a>
                                    <a href="javascript:;" class="btn btn-outline green btn_continue button-next"> Continue
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                    <?php echo "<!--CHECK DOC REQUIRED: ".$docNeedToUpload."-->";
                                    if($docNeedToUpload==0){ ?>
                                  
                                    <form action="<?=Yii::app()->createAbsoluteUrl('frontuser/existing/submitCafApplication')?>" style="display: inline" id="finalCAFSubmit" method="post">
                                        <input type="hidden" class="csrftoken" name="YII_CSRF_TOKEN_SUBMIT" value="<?=Yii::app()->getRequest()->getCsrfToken()?>" />

                                 <?php if($flg1==0){ ?>    <button type="submit" class="btn green button-submit btn_submit"> Submit
                                        <i class="fa fa-check"></i>
                                 </button> <?php } ?>
                                    </form>
                                <?php }
                                ?>
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
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?=Yii::app()->theme->baseUrl?>/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=Yii::app()->theme->baseUrl?>/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
      <!-- END PAGE LEVEL SCRIPTS -->


<!-- END PAGE LEVEL SCRIPTS -->

<!-- move this code in separte file to make this page neat and clean -->
<script>
$(document).ready(function(){
$(".addservice").click(function(){
var hu=$(this).attr('rel');
$(this).attr('rel',parseInt(hu)+1);
$(".depty").each(function(e){
$(this).attr('id','department_id'+e);
$(this).attr('rel',e);
});

$(".servy").each(function(e){
$(this).attr('id','service_id'+e);
});
});
});

function showUser(str,rel) { //alert(str+"=="+rel); 
//alert("<?php echo Yii::app()->request->baseUrl; ?>/frontuser/existing/deptservicemapping"); 
//$(".deptserv").change(function(){
//var str=$(this).val();
//alert(str);
$.ajax({
                type: "POST",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/frontuser/existing/deptservicemapping",
				dataType:'json',
			    data:
                {
                post_deptid: str
                },
			   
               success:  function(data) { //alert(data);
			   var $select = $('#service_id'+rel);
			   $select.html('');
                $.each(data, function(index, element) {
           	
					$select.append('<option value="' + element.service_id + '">' + element.core_service_name + '</option>');
        		});
				//alert(data);
				},
			
            error:function(jqXHR, textStatus, errorThrown){
                alert('error::'+errorThrown);
            }
            });
}
</script>
<script type="text/javascript">
    $("#ntrofunit").change(function(){
       var natur=$("#ntrofunit").val();
       var content='';
       if(natur=='Services'){
              content="<option value='micro'>Micro (< 10 lakhs)</option><option value='small'>Small (More than 10 Lakhs <2 Crore)</option><option value='medium'>Medium (More than 2 Crore <5 Crore)</option><option value='large'>Large (More than 5 Crore)</option>";
             $(".nature_label").text("Equip - ment"); 
             $(".manufactiring_detail").hide();   
             $(".raw_material_header").hide();   
             $(".remove_body_part").remove();    
             $(".product_manufactured_body_remove").remove();   
             $('.product_to_be_manufactured').hide();
             $(".service_detail").show();             
       }
       else if(natur=="Manufacturing"){
              content="<option value='micro'>Micro (< 25 lakhs)</option><option value='small'>Small (More than 25 Lakhs < 5 Crore)</option><option value='medium'>Medium (More than 5 Crore < 10 Crore)</option><option value='large'>Large(More than 10 Crore)</option>";
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
*/       else{
          content='None';
       }
       //console.log(content);
       $('#ntrofunittype').empty();
       $('#ntrofunittype').append('<option  value="">---Please Select Unit Type---</option>');
       $('#ntrofunittype').append(content);
    
    })
    $('#Proposed_details_of_Land').change(function(){
         var sel_val=$('#Proposed_details_of_Land').val();
         var have_own_land=$("#have_own_land").val();
         $('.append_later').empty();
         if(sel_val=='Rented Space'){
            $('.dt_land').empty();
            $('.dt_land').text('Details of Leased/Rented Space');
             if(have_own_land=='No'){
                 $('.check_no_own_land_lable').html("<sup>*</sup>*Land in Hectares");
             }
            $('.land_leased_other').hide();
            $('.land_leased').show();
            $('#detail_of_leased_space_area_in_sq_meters').val("");
            $('#detail_of_leased_space_detail_of_space').val("");
            $('#detail_of_leased_space_location').val("");
         }
         else{
             if(have_own_land=='No'){
                 $('.check_no_own_land_lable').html("<sup>*</sup>Land in Sq Meter");
             }
             else{
                 var append_string='<div class="land_leased_other col-md-6">'+
                              '<div class="form-group">'+
                                 '<label class="control-label col-md-3 check_no_own_land_lable">Pin Code <span class="required" aria-required="true"> * </span></label>'+
                                 '<div class="col-md-9">'+
                                     '<input type="text"  name="land_area_pin_code" id="land_area_pin_code" class="six_digit_zip_code form-control" placeholder="* Value">'+
                                     '<span class="help-block">  </span>'+
                                  '</div>'+
                              '</div>'+
                           '</div>'+
                           '<div class="col-md-6">'+
                              '<div class="form-group">'+
                                 ' <label class="control-label col-md-3">Plot/Khasra No</label>'+
                                 '<div class="col-md-9">'+
                                 '<input type="text"  id="Khasra_no" class="form-control address_field_with_space" maxlength="100" value="" name="Khasra_no" placeholder="* Khasra_no">'+
                                ' <span class="help-block">  </span>'+
                                '</div>'+
                              '</div>'+
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
            
      
       })
    function sumupInst(id){
               var sum=0;
            var land=$('#land'+id).val();
            if(isNaN(parseFloat(land)))
              land=0.0;
            var building=$('#building'+id).val();
            if(isNaN(parseFloat(building)))
              building=0.0;
            var plant=$('#plant'+id).val();
            if(isNaN(parseFloat(plant)))
              plant=0.0;
            var wrkcapt=$('#wrkcapt'+id).val();
            if(isNaN(parseFloat(wrkcapt)))
              wrkcapt=0.0;
            var other=$('#other'+id).val();
            if(isNaN(parseFloat(other)))
              other=0.0;
            sum=(parseFloat(land) + parseFloat(building) + parseFloat(plant) + parseFloat(wrkcapt) +parseFloat(other)).toFixed(2);
            $("#total"+id).val(sum);
       }
       function sumupEmp(id){
             var sum=0;
          var skl=$('#mskl'+id).val();
          var unskl=$('#munskl'+id).val();
          var mngmnt=$('#mmngmnt'+id).val();
          var sprvsr=$('#msprvsr'+id).val();
          var engg=$('#mengg'+id).val();
          var it=$('#mit'+id).val();
          if(isNaN(parseFloat(skl)))
            skl=0.0;
          if(isNaN(parseFloat(unskl)))
            unskl=0.0;
          if(isNaN(parseFloat(mngmnt)))
            mngmnt=0.0;
          if(isNaN(parseFloat(sprvsr)))
            sprvsr=0.0;
          if(isNaN(parseFloat(engg)))
            engg=0.0;
          if(isNaN(parseFloat(it)))
            it=0.0;
          sum=parseFloat(skl) + parseFloat(unskl) + parseFloat(mngmnt) + parseFloat(sprvsr) +parseFloat(engg)+parseFloat(it);
          $('#memptotal'+id).val(sum);

       }
       function fsumupEmp(id){
             var sum=0;
          var skl=$('#fskl'+id).val();
          var unskl=$('#funskl'+id).val();
          var mngmnt=$('#fmngmnt'+id).val();
          var sprvsr=$('#fsprvsr'+id).val();
          var engg=$('#fengg'+id).val();
          var it=$('#it'+id).val();
          if(isNaN(parseFloat(skl)))
            skl=0.0;
          if(isNaN(parseFloat(unskl)))
            unskl=0.0;
          if(isNaN(parseFloat(mngmnt)))
            mngmnt=0.0;
          if(isNaN(parseFloat(sprvsr)))
            sprvsr=0.0;
          if(isNaN(parseFloat(engg)))
            engg=0.0;
          if(isNaN(parseFloat(it)))
            it=0.0;
          sum=parseFloat(skl) + parseFloat(unskl) + parseFloat(mngmnt) + parseFloat(sprvsr) +parseFloat(engg)+parseFloat(it);
          $('#femptotal'+id).val(sum);
          
       }
       function sumMaleFemale(){
          var sum=0;
          var female=$('#empFemale').val();
          var male=$('#empMale').val();
          if(isNaN(parseFloat(female)))
            female=0.0;
          if(isNaN(parseFloat(male)))
            male=0.0;
          sum=parseFloat(male) + parseFloat(female);
          $('#empMaleFemaleTotal').val(sum);
       }
    $("document").ready(function(){
         <?php
            if($document==1){
            ?>
                $('.btn_prev').css({
                    display:'inline-block'
                })
                $('.btn_continue').css({
                    display:'none'
                })
                $('.btn_submit').css({
                    display:'inline-block'
                })
            <?php } ?>
            $(".date-picker").datepicker({
                rtl: App.isRTL(),
                autoclose: !0,
                startDate: "dateToday",
                format: 'd-MM-yyyy',
                useCurrent: false,
              /*  defaultDate: moment().startOf('day').add(2, 'd'),
                minDate: moment().startOf('day').add(1, 'd'),*/
                // maxDate: moment().startOf('day').add(3, 'd')
            })
             $(".date-picker2").datepicker({
                rtl: App.isRTL(),
                autoclose: !0,
                endDate: "dateToday",
                format: 'd-MM-yyyy',
                useCurrent: false,
              /*  defaultDate: moment().startOf('day').add(2, 'd'),
                minDate: moment().startOf('day').add(1, 'd'),*/
                // maxDate: moment().startOf('day').add(3, 'd')
            })
    })

</script>