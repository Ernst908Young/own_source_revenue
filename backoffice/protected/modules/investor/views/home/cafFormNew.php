<?php extract(@$pre_field); ?>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    #emp_fmtotal-error{
        color:red !important;
        font-size:14px !important;
    }
    .has-error{
        color:red !important;
    }
    .help-block-error{
        color:red !important;
    }
    .button-submit{display:none;}
    .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
        background-color: #fff !important;
        opacity: 1;
    }
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
    .applycaf{
        display:none;
    }
    .select2-display-none {
        z-index:10050 !important;
    }
    .select2-dropdown-open .select2-choice{
        background-color:#fff !important;
        background-image:none !important;
    }
    .select2-results .select2-highlighted{
        background-color:#337ab7 !important;
        color:#fff !important;
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
<?php $_GET['type'] = 'CAF';
$cls = "CAF";
//include($_SERVER["DOCUMENT_ROOT"] . '/backoffice/themes/investuk/views/layouts/pageBarService.php'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="m-heading-1  border-green m-bordered">
            <h3>Application for In-Principle Approval (CAF)</h3>
            <p> </p>
        </div>
        <div class="portlet light bordered" id="form_wizard_1">
            <div class="portlet-title">
                <div class="caption">
                    <i class=" icon-layers font-red"></i>
                    <span class="caption-subject font-red bold uppercase">Fields With * are Mandtory  -
                        <span class="step-title"> Step 1 of 4 </span>
                    </span>
                </div>
            </div>
            <div class="portlet-body form">
                <form class="form-horizontal caf_form_submission_wizard" action="#" id="submit_form" method="POST">
                    <input type="hidden" class="csrftoken" name="YII_CSRF_TOKEN" value="<?= Yii::app()->getRequest()->getCsrfToken() ?>" />
                    <input type="hidden" value="<?= Yii::app()->createAbsoluteUrl('frontuser/home/saveCAFPartially') ?>" id='caf_form_url'>
                    <div class="form-wizard">
                        <div class="form-body">
                            <ul class="nav nav-pills nav-justified steps">
                                <li <?php if ($document == 1) echo 'class="done"' ?>>
                                    <a href="#tab1" data-toggle="tab" class="step">
                                        <span class="number"> 1 </span>
                                        <span class="desc">
                                            <i class="fa fa-check"></i> Enterprise Detail </span>
                                    </a>
                                </li>
                                <li <?php if ($document == 1) echo 'class="done"' ?>>
                                    <a href="#tab2" data-toggle="tab" class="step">
                                        <span class="number"> 2 </span>
                                        <span class="desc">
                                            <i class="fa fa-check"></i> Investment Detail </span>
                                    </a>
                                </li>
                                <li <?php if ($document == 1) echo 'class="done"' ?>>
                                    <a href="#tab3" data-toggle="tab" class="step">
                                        <span class="number"> 3 </span>
                                        <span class="desc">
                                            <i class="fa fa-check"></i> Requirements </span>
                                    </a>
                                </li>
                                <li <?php if ($document == 1) echo 'class="active"' ?>>
                                    <a href="#tab4" data-toggle="tab" class="step">
                                        <span class="number"> 4 </span>
                                        <span class="desc">
                                            <i class="fa fa-check"></i> Checklist </span>
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
                                foreach (Yii::app()->user->getFlashes() as $key => $message) {
                                    echo '<div class="alert alert-success"><button class="close" data-dismiss="alert"></button> 
                                               ' . $message .
                                    '</div>';
                                }
                                ?>
                                <div class="tab-pane <?php if ($document != 1) echo 'active' ?>" id="tab1">
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
                                                                <input type="text"  id="IUID" class="form-control" name='IUID' value="<?= @$iuid ?>" readonly placeholder="IUID">
                                                                <span class="help-block"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Name<span class="required" aria-required="true"> * </span></label>
                                                            <div class="col-md-9">
                                                                <input type="text"  id="company_name" maxlength="100" class="form-control alphanumeric_name_with_space" value="<?= @$incmplt_fields->company_name ?>" name="company_name" placeholder="*  Name of the Company / Unit">                                                                   
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
                                                                <textarea  id="Address" rows="3" class="form-control address_field_with_space" maxlength="100" name="Address"  placeholder="*  Correspondence Address"><?= @$incmplt_fields->Address ?></textarea>
                                                                <span class="help-block"> </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Pin Code<span class="required" aria-required="true"> * </span></label>
                                                            <div class="col-md-9">
                                                                <input type="text"  id="pin_code" class="form-control six_digit_zip_code"  value="<?= @$incmplt_fields->pin_code ?>"  name="pin_code" placeholder="*  Pin Code">
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
                                                                <input type="text"  id="mob_number" class="form-control mobile_number_ten_digit_only"  value="<?= @$incmplt_fields->mob_number ?>"  name="mob_number" placeholder="Mobile Number">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Telephone</label>
                                                            <div class="col-md-9">
                                                                <input type="text"  id="tel_phone" class="form-control telephone_numbers" value="<?= @$incmplt_fields->tel_phone ?>"  name="tel_phone" placeholder="Telephone Number">
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

                                                                <input type="text"  id="email" class="form-control email"   maxlength="250" value="<?= @$incmplt_fields->email ?>"  name="email" placeholder="*  Email">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Fax</label>
                                                            <div class="col-md-9">
                                                                <input type="text"  id="fax" class="form-control telephone_numbers" value="<?= @$incmplt_fields->fax ?>"  name="fax" placeholder="Fax">

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
                                                                <input type="text"  id="md_name" class="form-control name_with_space" maxlength="100"  value="<?= @$incmplt_fields->md_name ?>" name="md_name" placeholder="*  Name of the M.D/Managing Partner/CEO /Lead Promoter/Proprietor">
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
                                                                    <option value="MD" <?php if (isset($incmplt_fields->designation)) if ($incmplt_fields->designation == 'MD') echo "selected"; ?> >MD</option>
                                                                    <option value="Managing Partner" <?php if (isset($incmplt_fields->designation)) if ($incmplt_fields->designation == 'Managing Partner') echo "selected"; ?>>Managing Partner</option>
                                                                    <option value="CEO" <?php if (isset($incmplt_fields->designation)) if ($incmplt_fields->designation == 'CEO') echo "selected"; ?>>CEO</option>
                                                                    <option value="Lead Promoter" <?php if (isset($incmplt_fields->designation)) if ($incmplt_fields->designation == 'Lead Promoter') echo "selected"; ?>>Lead Promoter</option>
                                                                    <option value="Proprietor" <?php if (isset($incmplt_fields->designation)) if ($incmplt_fields->designation == 'Proprietor') echo "selected"; ?> >Proprietor</option>
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
                                                                <input type="text"  id="md_mob" class="form-control mobile_number_ten_digit_only"  value="<?= @$incmplt_fields->md_mob ?>" name="md_mob" placeholder="Mobile Number">
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group"> 
                                                            <label class='control-label col-md-3'>Email<span class="required" aria-required="true"> * </span></label>
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
                                                            <label class="control-label col-md-3">Telephone</label>
                                                            <div class="col-md-9">
                                                                <input type="text"  id="md_tel" class="form-control telephone_numbers"  value="<?= @$incmplt_fields->md_tel ?>" name="md_tel" placeholder="Telephone Number">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Fax</label>
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
                                                            <label class="control-label col-md-3">Category</label>
                                                            <div class="col-md-9">
                                                                <select name="org_category" class="form-control" id="org_category">
                                                                    <option value="">*  Please Select Category</option>
                                                                    <option value="SC" <?php if (isset($incmplt_fields->org_category)) if ($incmplt_fields->org_category == 'SC') echo "selected"; ?> >SC</option>
                                                                    <option value="ST" <?php if (isset($incmplt_fields->org_category)) if ($incmplt_fields->org_category == 'ST') echo "selected"; ?>>ST</option>
                                                                    <option value="OBC" <?php if (isset($incmplt_fields->org_category)) if ($incmplt_fields->org_category == 'OBC') echo "selected"; ?>>OBC</option>
                                                                    <option value="GENERAL" <?php if (isset($incmplt_fields->org_category)) if ($incmplt_fields->org_category == 'GENERAL') echo "selected"; ?>>General</option>
                                                                    <option value="WOMEN" <?php if (isset($incmplt_fields->org_category)) if ($incmplt_fields->org_category == 'WOMEN') echo "selected"; ?> >Women</option>
                                                                    <option value="Ex-Serviceman" <?php if (isset($incmplt_fields->org_category)) if ($incmplt_fields->org_category == 'Ex-Serviceman') echo "selected"; ?> >Ex-Serviceman</option>
                                                                    <option value="Physically Challenged" <?php if (isset($incmplt_fields->org_category)) if ($incmplt_fields->org_category == 'Physically Challenged') echo "selected"; ?> >Physically Challenged</option>
                                                                    <!--<option value="Other" <?php if (isset($incmplt_fields->org_category)) if ($incmplt_fields->org_category == 'Other') echo "selected"; ?> >Other</option> -->
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
                                                                <input type="text"  id="auth_name" class="form-control" name="auth_name"  value="<?= @$first_name . " " . @$last_name ?>" readonly placeholder="Name of Authorized Coordinator/Person">
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Designation</label>
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
                                                            <label class="control-label col-md-3">Email<span class="required" aria-required="true"> * </span></label>
                                                            <div class="col-md-9">
                                                                <input type="text"  id="auth_email" class="form-control email" value="<?= @$email ?>" readonly name="auth_email" placeholder="Email">
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Mobile</label>
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
                                                            <label class="control-label col-md-3">Telephone</label>
                                                            <div class="col-md-9">
                                                                <input type="text"  id="auth_tel" class="form-control telephone_numbers"value="<?= @$incmplt_fields->auth_tel ?>" name="auth_tel" placeholder="Telephone Number">
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Fax</label>
                                                            <div class="col-md-9">
                                                                <input type="text"  id="auth_fax" class="form-control telephone_numbers" value="<?= @$incmplt_fields->auth_fax ?>" name="auth_fax" placeholder="Fax Number">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                </div>
                                                <!--/row-->
                                                <h3 class="form-section">Financial Indicators of the Enterprise / Firm for Last 3 Financial Years in INR Lakhs (if any)</h3>

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
                                                                        <input type="text"  id="fnc_year1" class="form-control year" maxlength="10" value="<?= @$incmplt_fields->fnc_year[0] ?>" name="fnc_year[]" placeholder="Year">
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
                                                                        <input type="text"  id="fnc_year1" class="form-control year" maxlength="10" value="<?= @$incmplt_fields->fnc_year[1] ?>" name="fnc_year[]" placeholder="Year">
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
                                                            </div></div>
                                                        <div class="row">
                                                            <div class="form-group">
                                                                <div class="col-md-12">
                                                                    <div class="col-md-2">
                                                                        <input type="text"  id="fnc_year1" class="form-control year" maxlength="10" value="<?= @$incmplt_fields->fnc_year[2] ?>" name="fnc_year[]" placeholder="Year">
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
                                                <!--/row-->
                                                <h3 class="form-section">Organisation Details</h3>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Nature<span class="required" aria-required="true"> * </span></label>
                                                            <div class="col-md-9">
                                                                <select name="noforg" id="noforg" class="form-control">
                                                                    <option value=""> Nature of your Organization</option>
                                                                    <option value="Proprietary" <?php if (isset($incmplt_fields->noforg)) if ($incmplt_fields->noforg == 'Proprietary') echo "selected"; ?> >Proprietary</option>
                                                                    <option value="Partnership" <?php if (isset($incmplt_fields->noforg)) if ($incmplt_fields->noforg == 'Partnership') echo "selected"; ?> >Partnership</option>
                                                                    <option value="Private Limited" <?php if (isset($incmplt_fields->noforg)) if ($incmplt_fields->noforg == 'Private Limited') echo "selected"; ?>>Private Limited</option>
                                                                    <option value="Public Limited" <?php if (isset($incmplt_fields->noforg)) if ($incmplt_fields->noforg == 'Public Limited') echo "selected"; ?>>Public Limited</option>
                                                                    <option value="Co-Operative" <?php if (isset($incmplt_fields->noforg)) if ($incmplt_fields->noforg == 'Co-Operative') echo "selected"; ?>>Co-Operative</option>
                                                                    <option value="Other" <?php if (isset($incmplt_fields->noforg)) if ($incmplt_fields->noforg == 'Other') echo "selected"; ?> >Other</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Project Status <span class="required" aria-required="true"> * </span></label>
                                                            <div class="col-md-9">
                                                                <select name="project_status" id="project_status" class="form-control">
                                                                    <option value="">---Please Select---</option>
                                                                    <option value="New" <?php if (isset($incmplt_fields->project_status)) if ($incmplt_fields->project_status == 'New') echo "selected"; ?> >New</option>
                                                                    <option value="Expansion" <?php if (isset($incmplt_fields->project_status)) if ($incmplt_fields->project_status == 'Expansion') echo "selected"; ?> >Expansion</option>
                                                                    <option value="Diversification" <?php if (isset($incmplt_fields->project_status)) if ($incmplt_fields->project_status == 'Diversification') echo "selected"; ?>>Diversification</option>
                                                                </select>                                                                    
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Are You Covered Under <span class="required" aria-required="true"> * </span></label>
                                                            <div class="col-md-9">
                                                                <select name="start_up" id="start_up" class="form-control">
                                                                    <option value="">---Please Select---</option>
                                                                    <option value="Startup" <?php if (isset($incmplt_fields->start_up)) if ($incmplt_fields->start_up == 'Startup') echo "selected"; ?> >START-UP INDIA</option>
                                                                    <option value="Standup" <?php if (isset($incmplt_fields->start_up)) if ($incmplt_fields->start_up == 'Standup') echo "selected"; ?> >STAND-UP INDIA</option>
                                                                    <option value="NA" <?php if (isset($incmplt_fields->start_up)) if ($incmplt_fields->start_up == 'NA') echo "selected"; ?>>NOT APPLICABLE</option>
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
                                                            <div class="col-md-10 description_detail" style="margin-left: 167px !important;">
                                                                <textarea  id="activity_of_company" class="form-control" rows="4"  name="activity_of_company" placeholder="*  Brief Description (Activities of the Enterprise)"><?= @$incmplt_fields->activity_of_company ?></textarea>
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
                                                                    <option value="Manufacturing" <?php if (isset($incmplt_fields->ntrofunit)) if ($incmplt_fields->ntrofunit == 'Manufacturing') echo "selected"; ?> >Manufacturing</option>
                                                                    <option value="Services" <?php if (isset($incmplt_fields->ntrofunit)) if ($incmplt_fields->ntrofunit == 'Services') echo "selected"; ?>>Services</option>
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
                                                                <span class="help-block">  </span>

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
                                                <h3 class="form-section raw_material_header" style="<?= $display ?>">Raw Material Detail</h3>
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
                                                $display = "display:none";
                                                if (isset($incmplt_fields->ntrofunit))
                                                    if ($incmplt_fields->ntrofunit == 'Manufacturing') {
                                                        $display = "display:block";
                                                    }
                                                ?>
                                                <h3 class="form-section raw_material_header" style="<?= $display ?>">Products to be Manufactured</h3>
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
                                                                    <option value="green" <?php if (isset($incmplt_fields->type_of_industry)) if ($incmplt_fields->type_of_industry == 'green') echo "selected"; ?>>Green</option>
                                                                    <option value="orange" <?php if (isset($incmplt_fields->type_of_industry)) if ($incmplt_fields->type_of_industry == 'orange') echo "selected"; ?>>Orange</option>
                                                                    <option value="red" <?php if (isset($incmplt_fields->type_of_industry)) if ($incmplt_fields->type_of_industry == 'red') echo "selected"; ?>>Red</option>
                                                                    <option value="white" <?php if (isset($incmplt_fields->type_of_industry)) if ($incmplt_fields->type_of_industry == 'white') echo "selected"; ?>>White</option>
                                                                </select>
                                                                <span class="help-block"><a href="<?= FRONT_BASEURL ?>themes/backend/uploads/New-Categorization-Industries-UEPPCB-January-2014.pdf" target="_blank"><b>Click to know your type of Industry</b></a></span>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Expected date of commercial production<span class="required" aria-required="true"> * </span></label>
                                                            <div class="col-md-9">
                                                                <div class="input-group date date-picker margin-bottom-5" data-date-format="dd/mm/yyyy">
                                                                    <input type="text"  id="other" class="form-control form-filter input-sm" readonly value="<?= @$incmplt_fields->expected_date_of_commercial_production ?>" min="<?php echo date('Y-m-d'); ?>" name="expected_date_of_commercial_production" placeholder="Please select the production date">
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
                                                                <textarea  id="Brief_Description_about_Processes" rows="3" class="form-control col-md-12"  name="Brief_Description_about_Processes" placeholder=" Brief_Description_about_Processes"><?= @$incmplt_fields->Brief_Description_about_Processes ?></textarea>

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
                                                                    if (isset($industries) && !empty($industries)) {
                                                                        foreach ($industries as $key => $industry) {
                                                                            echo "<option value='" . $industry['Ans_ID'] . "'";
                                                                            if (isset($incmplt_fields->industry_type) && $incmplt_fields->industry_type == $industry['Ans_ID'])
                                                                                echo " selected ";
                                                                            echo ">" . $industry['Ans_Text'] . "</option>";
                                                                        }
                                                                    }
                                                                    ?>      
                                                                </select>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /row -->
                                                <div class="row" id="CafInvData">
                                                <h3 class="form-section">Details of Investment (INR Crores)</h3>
                                                <div class="row">
                                                    <label class="control-label col-md-2" style="text-align: center;">Land</label>
                                                    <label class="control-label col-md-2" style="text-align: center;">Building</label>
                                                    <label class="control-label nature_label col-md-2" style="text-align: center;">Equipment</label>
                                                    <label class="control-label col-md-2" style="text-align: center;display:none;">Capital Margin</label>
                                                    <label class="control-label col-md-2" style="text-align: center;">Other</label>
                                                    <label class="control-label col-md-2" style="text-align: center;">Total (In Crore)</label>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="col-md-2">

                                                                <input type="text"  id="land0" class="form-control land decimal" maxlength="10" value="<?= @$incmplt_fields->invstmnt_in_land[0] ?>" onkeyup="sumupInst(0)" name="invstmnt_in_land[]" placeholder="Land">
                                                                <select  name="invstmnt_in_land_rs[]" class="form-control in_rs" rel="land0" id="land0_rs" onchange="sumupInst(0)">
                                                                    <option value="Crore" <?php if (isset($incmplt_fields->invstmnt_in_land_rs[0])) if ($incmplt_fields->invstmnt_in_land_rs[0] == 'Crore') echo "selected"; ?>>Crore</option>
                                                                    <option value="Lakh" <?php if (isset($incmplt_fields->invstmnt_in_land_rs[0])) if ($incmplt_fields->invstmnt_in_land_rs[0] == 'Lakh') echo "selected"; ?>>Lakh</option>
                                                                </select>
                                                                <span class="help-block"></span>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="text"  id="building0" class="form-control building decimal" maxlength="10" value="<?= @$incmplt_fields->invstmnt_in_building[0] ?>" onkeyup="sumupInst(0)" name="invstmnt_in_building[]" placeholder="Building">
                                                                <select  name="invstmnt_in_building_rs[]" class="form-control in_rs" rel="building0" id="building0_rs" onchange="sumupInst(0)">
                                                                    <option value="Crore" <?php if (isset($incmplt_fields->invstmnt_in_building_rs[0])) if ($incmplt_fields->invstmnt_in_building_rs[0] == 'Crore') echo "selected"; ?>>Crore</option>
                                                                    <option value="Lakh" <?php if (isset($incmplt_fields->invstmnt_in_building[0])) if ($incmplt_fields->invstmnt_in_building[0] == 'Lakh') echo "selected"; ?>>Lakh</option>
                                                                </select>
                                                                <span class="help-block"></span>
                                                            </div>
                                                            <div class="col-md-2" >
                                                                <input type="text"  id="plant0" class="form-control  plant_value decimal" maxlength="10" value="<?= @$incmplt_fields->invstmnt_in_plant[0] ?>" onkeyup="sumupInst(0)" name="invstmnt_in_plant[]" placeholder="Plant & Machinery/Equipment">
                                                                <select name="invstmnt_in_plant_rs[]" class="form-control in_rs" rel="plant0" id="plant0_rs" onchange="sumupInst(0)">
                                                                    <option value="Crore" <?php if (isset($incmplt_fields->invstmnt_in_plant[0])) if ($incmplt_fields->invstmnt_in_plant[0] == 'Crore') echo "selected"; ?>>Crore</option>
                                                                    <option value="Lakh" <?php if (isset($incmplt_fields->invstmnt_in_plant[0])) if ($incmplt_fields->invstmnt_in_plant[0] == 'Lakh') echo "selected"; ?>>Lakh</option>
                                                                </select>
                                                                <span class="help-block"></span>
                                                            </div>
                                                            <div class="col-md-2" style="display:none;">
                                                                <input type="text"  id="wrkcapt0" class="form-control capital_margin decimal" maxlength="10" value="<?= @$incmplt_fields->invstmnt_in_wrkingcapital[0] ?>" onkeyup="sumupInst(0)" name="invstmnt_in_wrkingcapital[]" placeholder="Capital Margin">
                                                                <select  name="invstmnt_in_wrkingcapital_rs[]" class="form-control in_rs" rel="wrkcapt0" id="wrkcapt0_rs" onchange="sumupInst(0)">
                                                                    <option value="Crore" <?php if (isset($incmplt_fields->invstmnt_in_wrkingcapital_rs[0])) if ($incmplt_fields->invstmnt_in_wrkingcapital_rs[0] == 'Crore') echo "selected"; ?>>Crore</option>
                                                                    <option value="Lakh" <?php if (isset($incmplt_fields->invstmnt_in_wrkingcapital_rs[0])) if ($incmplt_fields->invstmnt_in_wrkingcapital_rs[0] == 'Lakh') echo "selected"; ?>>Lakh</option>
                                                                </select>
                                                                <span class="help-block"></span>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="text"  id="other0" class="form-control other_cost decimal" maxlength="10" value="<?= @$incmplt_fields->invstmnt_in_other[0] ?>" onkeyup="sumupInst(0)" name="invstmnt_in_other[]" placeholder="Other">
                                                                <select  name="invstmnt_in_other_rs[]"  class="form-control in_rs" rel="other0" id="other0_rs" onchange="sumupInst(0)"  >
                                                                    <option value="Crore"  <?php if (isset($incmplt_fields->invstmnt_in_other_rs[0])) if ($incmplt_fields->invstmnt_in_other_rs[0] == 'Crore') echo "selected"; ?>>Crore</option>
                                                                    <option value="Lakh" <?php if (isset($incmplt_fields->invstmnt_in_other_rs[0])) if ($incmplt_fields->invstmnt_in_other_rs[0] == 'Lakh') echo "selected"; ?>>Lakh</option>
                                                                </select>
                                                                <span class="help-block"></span>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="text"  id="total0" class="form-control decimal" maxlength="10" value="<?= @$incmplt_fields->invstmnt_in_total[0] ?>" readonly="readonly" name="invstmnt_in_total[]" placeholder="0.0">
                                                                <span class="help-block"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <h3 class="form-section">Details of Finance</h3>
                                                <div class="row">
                                                    <label class="control-label col-md-2" style="text-align: center;">Capital Margin</label>
                                                    <label class="control-label col-md-2" style="text-align: center;">In Rs </label>
                                                    <label class="control-label nature_label col-md-2" style="text-align: center;">Bank Finance</label>
                                                    <label class="control-label col-md-2" style="text-align: center;">In Rs</label> 
                                                    <label class="control-label col-md-2" style="text-align: center;">Total (In Crore)</label>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="col-md-2">
                                                                    <input type="text"  id="invstmnt_in_capitalmargin_0" class="form-control invstmnt_in_capitalmargin decimal" onkeyup="sumupInst2(0)" maxlength="10" value="<?= @$incmplt_fields->invstmnt_in_capitalmargin[0] ?>" name="invstmnt_in_capitalmargin[]" placeholder="Capital Margin">
                                                               <span class="help-block"></span>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <select  name="invstmnt_in_capitalmargin_0_rs[]" class="form-control in_rs" rel="invstmnt_in_capitalmargin_0" id="invstmnt_in_capitalmargin_rs" onchange="sumupInst2(0)">
                                                                    <option value="Crore" <?php if (isset($incmplt_fields->invstmnt_in_capitalmargin_rs[0])) if ($incmplt_fields->invstmnt_in_capitalmargin_rs[0] == 'Crore') echo "selected"; ?>>Crore</option>
                                                                    <option value="Lakh" <?php if (isset($incmplt_fields->invstmnt_in_capitalmargin_rs[0])) if ($incmplt_fields->invstmnt_in_capitalmargin_rs[0] == 'Lakh') echo "selected"; ?>>Lakh</option>
                                                                </select>
                                                               <span class="help-block"></span>
                                                            </div>
                                                              <div class="col-md-2">
                                                                    <input type="text"  id="invstmnt_in_bankfinance_0" class="form-control invstmnt_in_bankfinance decimal" onkeyup="sumupInst2(0)" maxlength="10" value="<?= @$incmplt_fields->invstmnt_in_bankfinance[0] ?>" name="invstmnt_in_bankfinance[]" placeholder="Bank Finance">
                                                               <span class="help-block"></span>
                                                            </div>
                                                            <div class="col-md-2">
                                                                    <select  name="invstmnt_in_bankfinance_in_rs[]" class="form-control in_rs" rel="invstmnt_in_bankfinance_0" id="invstmnt_in_bankfinance_rs" onchange="sumupInst2(0)">
                                                                    <option value="Crore" <?php if (isset($incmplt_fields->invstmnt_in_bankfinance_in_rs[0])) if ($incmplt_fields->invstmnt_in_bankfinance_in_rs[0] == 'Crore') echo "selected"; ?>>Crore</option>
                                                                    <option value="Lakh" <?php if (isset($incmplt_fields->invstmnt_in_bankfinance_in_rs[0])) if ($incmplt_fields->invstmnt_in_bankfinance_in_rs[0] == 'Lakh') echo "selected"; ?>>Lakh</option>
                                                                </select>
                                                               <span class="help-block"></span>
                                                            </div>
                                                             <div class="col-md-2">
                                                                <input type="text"  id="totalCapitalBankFinance" class="form-control totalCapitalBankFinance decimal"  maxlength="10" value="<?= @$incmplt_fields->totalCapitalBankFinance[0] ?>" name="totalCapitalBankFinance[]" placeholder="Total">
                                                             </div>
                                                            
                                                            
                                                        </div>
                                                    </div>                                                        
                                                 </div>
                                                </div>
                                                <!--   
<h3 class="form-section">Proposed Employment <span id="empError" style="color:red;font-size:15px;"></span>
</h3>
<div class="row">
<div class="col-md-4">
<select class="form-control empfilter" id="domicile">
<option value="">Select Domicile
</option>
<option value="diu">Uttarakhand
</option>
<option value="dios">Other State
</option>
<option value="difn">Foreign Nationalist
</option>
</select>
</div>
<div class="col-md-4">
<select class="form-control empfilter" id="empgender">
<option  value="">Select Gender
</option>
<option value="m">Male
</option>
<option value="f">Female
</option>
</select>
</div>
<div class="col-md-4">
<select class="form-control empfilter" id="empcaste">
<option value="">Select Category
</option>
<option  value="gen">General
</option>
<option  value="sc">Scheduled Caste
</option>
<option  value="st">Schedule Tribe
</option>
<option   value="obc">Other Backward Caste
</option>
</select>
</div>                                                            
</div>

</br>
<div class="row">
<div class="table-responsive">
<table id="<?php echo $domicile = 'diu'; ?>" class="diu categorisedemplyment table table-bordered table-responsive">
<tr class="diu">
<th width="25%">Employment
</th>
<td width="10%"> Skilled 
</td>
<td width="10%">	Unskilled 
</td>
<td width="10%">	Supervisory 
</td>
<td width="10%">Engineer 
</td>
<td width="10%">IT/ ITES Professional
</td>
<td width="10%">Management 
</td>
<td width="10%"> Total Employees 
</td>
</tr>
<tr class="diu_m_gen emporg">
<td>Domiciled In Uttarakhand 
<br> Male - General
</td>
<td>
<input type="text" class="form-control  decimal mskill <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_skilled"; ?>"  value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal mUnskilled <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal mSupervisory <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>  
<td>
<input type="text" class="form-control  decimal mEngineer <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal mProfessional <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen"maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal mManagement <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  empTotal decimal  <?php echo $domicile; ?>_male_gen_total" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
</tr>
<tr class="diu_m_sc emporg">
<td>Domiciled In Uttarakhand 
<br> Male - Scheduled Caste
</td>
<td>
<input type="text" class="form-control  decimal mskill <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal mUnskilled <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal mSupervisory <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>  
<td>
<input type="text" class="form-control  decimal mEngineer <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal mProfessional <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal mManagement <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control empTotal decimal  <?php echo $domicile; ?>_male_sc_total" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>  
</tr>
<tr class="diu_m_st emporg">
<td>Domiciled In Uttarakhand 
<br> Male - Scheduled Tribe
</td>
<td>
<input type="text" class="form-control mskill decimal <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal mUnskilled <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal  mSupervisory <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>  
<td>
<input type="text" class="form-control  decimal mEngineer <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal  mProfessional <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal mManagement  <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control empTotal decimal  <?php echo $domicile; ?>_male_st_total" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>  
</tr> 
<tr class="diu_m_obc emporg">
<td>Domiciled In Uttarakhand 
<br> Male - Other Backward Caste
</td>
<td>
<input type="text" class="form-control mskill decimal <?php echo $domicile; ?>_male_obc"  rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal mUnskilled <?php echo $domicile; ?>_male_obc" rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal mSupervisory <?php echo $domicile; ?>_male_obc" rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>  
<td>
<input type="text" class="form-control  decimal mEngineer <?php echo $domicile; ?>_male_obc" rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal mProfessional <?php echo $domicile; ?>_male_obc" rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal mManagement <?php echo $domicile; ?>_male_obc" rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control empTotal decimal  <?php echo $domicile; ?>_male_obc_total"  maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>  
</tr>
<tr class="diu_f_gen emporg">
<td>Domiciled In Uttarakhand 
<br> Female - General
</td>
<td>
<input type="text" class="form-control fskill decimal <?php echo $domicile; ?>_female_gen" rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal fUnskilled <?php echo $domicile; ?>_female_gen" rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal fSupervisory <?php echo $domicile; ?>_female_gen" rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>  
<td>
<input type="text" class="form-control  decimal fEngineer <?php echo $domicile; ?>_female_gen" rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal fProfessional <?php echo $domicile; ?>_female_gen" rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal fManagement <?php echo $domicile; ?>_female_gen" rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control empTotal decimal  <?php echo $domicile; ?>_female_gen_total"  maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>  
</tr>
<tr class="diu_f_sc emporg">
<td>Domiciled In Uttarakhand 
<br> Female - Scheduled Caste
</td>
<td>
<input type="text" class="form-control   fskill decimal <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal fUnskilled <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal fSupervisory <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>  
<td>
<input type="text" class="form-control  decimal fEngineer <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal fProfessional <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal fManagement <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  empTotal decimal   <?php echo $domicile; ?>_female_sc_total"  maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>  
</tr>
<tr class="diu_f_st emporg">
<td>Domiciled In Uttarakhand 
<br> Female - Scheduled Tribe
</td>
<td>
<input type="text" class="form-control fskill decimal <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal fUnskilled <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal fSupervisory <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>  
<td>
<input type="text" class="form-control  decimal fEngineer <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal fProfessional <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal fManagement <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control empTotal decimal  <?php echo $domicile; ?>_female_st_total"  maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>  
</tr>
<tr class="diu_f_obc emporg">
<td>Domiciled In Uttarakhand 
<br> Female - Other Backward Caste
</td>
<td>
<input type="text" class="form-control fskill decimal <?php echo $domicile; ?>_female_obc" rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal fUnskilled <?php echo $domicile; ?>_female_obc" rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal fSupervisory <?php echo $domicile; ?>_female_obc" rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>  
<td>
<input type="text" class="form-control  decimal fEngineer <?php echo $domicile; ?>_female_obc" rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal fProfessional <?php echo $domicile; ?>_female_obc" rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal fManagement <?php echo $domicile; ?>_female_obc" rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  empTotal decimal  <?php echo $domicile; ?>_female_obc_total"  maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>  
</tr>  
                                                <?php $domicile = 'dios'; ?>                                                            
<tr class="dios_m_gen emporg">
<td>Domiciled In Other State 
<br> Male - General
</td>
<td>
<input type="text" class="form-control mskill decimal <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal mUnskilled <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen"  maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal mSupervisory <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>  
<td>
<input type="text" class="form-control  decimal mEngineer <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal mProfessional <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal mManagement <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control empTotal decimal  <?php echo $domicile; ?>_male_gen_total" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
</tr>
<tr  class="dios_m_sc emporg">
<td>Domiciled In Other State 
<br> Male - Scheduled Caste
</td>
<td>
<input type="text" class="form-control mskill  decimal <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal mUnskilled <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal  mSupervisory <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>  
<td>
<input type="text" class="form-control  decimal mEngineer <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal mProfessional <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal mManagement <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control empTotal decimal  <?php echo $domicile; ?>_male_sc_total" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
</tr>
<tr class="dios_m_st emporg">
<td>Domiciled In Other State 
<br> Male - Scheduled Tribe
</td>
<td>
<input type="text" class="form-control mskill decimal <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal mUnskilled <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal mSupervisory <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>  
<td>
<input type="text" class="form-control   decimal mEngineer <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal mProfessional <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st"maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal mManagement  <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control empTotal  decimal  <?php echo $domicile; ?>_male_st_total" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
</tr>
<tr class="dios_m_obc emporg">
<td>Domiciled In Other State 
<br>Male - Other Backward Caste
</td>
<td>
<input type="text" class="form-control mskill decimal <?php echo $domicile; ?>_male_obc" rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal mUnskilled <?php echo $domicile; ?>_male_obc" rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal mSupervisory <?php echo $domicile; ?>_male_obc" rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>  
<td>
<input type="text" class="form-control  decimal mEngineer <?php echo $domicile; ?>_male_obc" rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal mProfessional <?php echo $domicile; ?>_male_obc" rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal mManagement <?php echo $domicile; ?>_male_obc" rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control empTotal decimal  <?php echo $domicile; ?>_male_obc_total"  maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
</tr>
<tr class="dios_f_gen emporg">	
<td>Domiciled In Other State 
<br>Female - General
</td>
<td>
<input type="text" class="form-control fskill decimal <?php echo $domicile; ?>_female_gen"  rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal fUnskilled <?php echo $domicile; ?>_female_gen"  rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal fSupervisory <?php echo $domicile; ?>_female_gen"  rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>  
<td>
<input type="text" class="form-control  decimal fEngineer <?php echo $domicile; ?>_female_gen"  rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal fProfessional <?php echo $domicile; ?>_female_gen"  rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal  fManagement <?php echo $domicile; ?>_female_gen"  rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  empTotal decimal  <?php echo $domicile; ?>_female_gen_total" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
</tr>
<tr class="dios_f_sc emporg">
<td>Domiciled In Other State 
<br>Female - Scheduled Caste
</td>
<td>
<input type="text" class="form-control fskill decimal <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal fUnskilled <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal fSupervisory <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>  
<td>
<input type="text" class="form-control  decimal fEngineer <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal fProfessional <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal fManagement <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal empTotal  <?php echo $domicile; ?>_female_sc_total" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>  
</tr>
<tr  class="dios_f_st emporg">
<td>Domiciled In Other State 
<br>Female - Scheduled Tribe
</td>
<td>
<input type="text" class="form-control fskill decimal <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal fUnskilled <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal fSupervisory <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>  
<td>
<input type="text" class="form-control  decimal fEngineer <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal fProfessional <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal fManagement <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal empTotal <?php echo $domicile; ?>_female_st_total" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>  
</tr>
<tr class="dios_f_obc emporg">
<td>Domiciled In Other State 
<br>Female - Other Backward Caste
</td>
<td>
<input type="text" class="form-control fskill decimal <?php echo $domicile; ?>_female_obc"  rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal fUnskilled <?php echo $domicile; ?>_female_obc"  rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal fSupervisory <?php echo $domicile; ?>_female_obc"  rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>  
<td>
<input type="text" class="form-control  decimal fEngineer <?php echo $domicile; ?>_female_obc"  rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal fProfessional <?php echo $domicile; ?>_female_obc"  rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal  fManagement <?php echo $domicile; ?>_female_obc"  rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal empTotal <?php echo $domicile; ?>_female_obc_total" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>  
</tr> 
                                                <?php $domicile = 'difn'; ?>
<tr class="difn_m_gen emporg">
<td>Domiciled in Foreign Nationals
<br>Male - General
</td>
<td>
<input type="text" class="form-control mskill decimal <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal mUnskilled <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal  mSupervisory <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>  
<td>
<input type="text" class="form-control  decimal mEngineer <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal mProfessional <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal mManagement <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal  empTotal  <?php echo $domicile; ?>_male_gen_total"  maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
</tr>
<tr class="difn_m_sc emporg">
<td>Domiciled in Foreign Nationals
<br>Male - Scheduled Caste
</td>
<td>
<input type="text" class="form-control mskill  decimal <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal mUnskilled <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal mSupervisory <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>  
<td>
<input type="text" class="form-control  decimal mEngineer <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal mProfessional <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal mManagement <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal empTotal <?php echo $domicile; ?>_male_sc_total" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
</tr>
<tr class="difn_m_st emporg">
<td>Domiciled in Foreign Nationals
<br>Male - Scheduled Tribe
</td>
<td>
<input type="text" class="form-control mskill  decimal <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal mUnskilled <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal mSupervisory <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>  
<td>
<input type="text" class="form-control  decimal mEngineer <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal mProfessional <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal mManagement <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal empTotal <?php echo $domicile; ?>_male_st_total" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
</tr>
<tr class="difn_m_obc emporg">
<td>Domiciled in Foreign Nationals
<br>Male - Other Backward Caste
</td>
<td>
<input type="text" class="form-control mskill decimal <?php echo $domicile; ?>_male_obc"  rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal mUnskilled <?php echo $domicile; ?>_male_obc"  rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal mSupervisory <?php echo $domicile; ?>_male_obc"  rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>  
<td>
<input type="text" class="form-control  decimal  mEngineer <?php echo $domicile; ?>_male_obc"  rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal mProfessional <?php echo $domicile; ?>_male_obc"  rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal mManagement <?php echo $domicile; ?>_male_obc"  rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal empTotal <?php echo $domicile; ?>_male_obc_total" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
</tr> 							
<tr class="difn_f_gen emporg">
<td>Domiciled in Foreign Nationals
<br>Female - General
</td>
<td>
<input type="text" class="form-control fskill decimal <?php echo $domicile; ?>_female_gen" rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal  fUnskilled <?php echo $domicile; ?>_female_gen" rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal  fSupervisory <?php echo $domicile; ?>_female_gen" rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>  
<td>
<input type="text" class="form-control  decimal fEngineer <?php echo $domicile; ?>_female_gen" rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal  fProfessional <?php echo $domicile; ?>_female_gen" rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal  fManagement <?php echo $domicile; ?>_female_gen" rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal empTotal <?php echo $domicile; ?>_female_gen_total" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
</tr>
<tr class="difn_f_sc emporg">
<td>Domiciled in Foreign Nationals
<br>Female - Scheduled Caste
</td>
<td>
<input type="text" class="form-control fskill decimal <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal fUnskilled <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal fSupervisory <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>  
<td>
<input type="text" class="form-control  decimal fEngineer <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal fProfessional <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal fManagement <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal empTotal <?php echo $domicile; ?>_female_sc_total" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
</tr>
<tr class="difn_f_sc emporg">
<td>Domiciled in Foreign Nationals
<br>Female - Scheduled Tribe
</td>
<td>
<input type="text" class="form-control fskill decimal <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal fUnskilled <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal fSupervisory <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>  
<td>
<input type="text" class="form-control  decimal fEngineer <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal fProfessional <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal fManagement <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal empTotal <?php echo $domicile; ?>_female_st_total" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
</tr>
<tr class="difn_f_obc emporg">
<td>Domiciled in Foreign Nationals
<br>Female - Other Backward Caste
</td>
<td>
<input type="text" class="form-control fskill  decimal  <?php echo $domicile; ?>_female_obc" rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal  fUnskilled <?php echo $domicile; ?>_female_obc" rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>
<td>
<input type="text" class="form-control  decimal  fSupervisory <?php echo $domicile; ?>_female_obc" rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td>  
<td>
<input type="text" class="form-control  decimal  fEngineer <?php echo $domicile; ?>_female_obc" rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal  fProfessional <?php echo $domicile; ?>_female_obc" rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal  fManagement <?php echo $domicile; ?>_female_obc" rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
<td>
<input type="text" class="form-control  decimal  empTotal  <?php echo $domicile; ?>_female_obc_total" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
</td> 
</tr> 
<tr style="display:none;">
<td>
<b>Total Male Employment
</b>
</td>
<td>
<input type="text"  id="mskl0" class="form-control mskilled decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_mskilled[0] ?>" name="no_of_emp_mskilled[]" onkeyup="sumupEmp(0)" placeholder="Skilled" readonly="readonly">
<span class="help-block">
</span>
</td>
<td>
<input type="text"  id="munskl0" class="form-control munskilled decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_munskilled[0] ?>" name="no_of_emp_munskilled[]" onkeyup="sumupEmp(0)" placeholder="Unskilled" readonly="readonly">
<span class="help-block">
</span>
</td>
<td>
<input type="text"  id="msprvsr0" class="form-control msupvsr decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_msupervisory[0] ?>" name="no_of_emp_msupervisory[]" onkeyup="sumupEmp(0)" placeholder="Supervisory" readonly="readonly">
<span class="help-block">
</span>
</td>
<td>
<input type="text"  id="mengg0" class="form-control mengg decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_mengineer[0] ?>" name="no_of_emp_mengineer[]" onkeyup="sumupEmp(0)" placeholder="Engineer" readonly="readonly">
<span class="help-block">
</span>
</td>
<td>
<input type="text"  id="mit0" class="form-control mitprof decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_it_mprofessional[0] ?>" name="no_of_emp_it_mprofessional[]"  placeholder="IT/ITeS Professional" readonly="readonly">
<span class="help-block">
</span>
</td>
<td>
<input type="text"  id="mmngmnt0" class="form-control mmngmt decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_mmanagement[0] ?>" name="no_of_emp_mmanagement[]"  placeholder="Management" readonly="readonly">
<span class="help-block">
</span>
</td>
<td>
<input type="text"  id="memptotal0" class="form-control" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_mtotal[0] ?>" name="no_of_emp_mtotal[]"  placeholder="Total" readonly="readonly"> 
<span class="help-block">
</span>
</td>
</tr>
<tr style="display:none;">
<td>
<b>Total Female Employment
</b>
</td>
<td>
<input type="text"  id="fskl0" class="form-control fskilled decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_fskilled[0] ?>" name="no_of_emp_fskilled[]" onkeyup="fsumupEmp(0)" placeholder="Skilled" readonly="readonly">
<span class="help-block">
</span>
</td>
<td>
<input type="text"  id="funskl0" class="form-control funskilled decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_funskilled[0] ?>" name="no_of_emp_funskilled[]" onkeyup="fsumupEmp(0)" placeholder="Unskilled" readonly="readonly">
<span class="help-block">
</span>
</td>
<td>
<input type="text"  id="fsprvsr0" class="form-control mfupvsr decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_fsupervisory[0] ?>" name="no_of_emp_fsupervisory[]" onkeyup="fsumupEmp(0)" placeholder="Supervisory" readonly="readonly">
<span class="help-block">
</span>
</td>
<td>
<input type="text"  id="fengg0" class="form-control feggg decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_fengineer[0] ?>" name="no_of_emp_fengineer[]" onkeyup="fsumupEmp(0)" placeholder="Engineer" readonly="readonly">
<span class="help-block">
</span>
</td>
<td>
<input type="text"  id="fit0" class="form-control fitprof decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_it_fprofessional[0] ?>" name="no_of_emp_it_fprofessional[]" onkeyup="fsumupEmp(0)" placeholder="IT/ITeS Professional" readonly="readonly">
<span class="help-block">
</span>
</td>
<td>
<input type="text"  id="fmngmnt0" class="form-control fmngmt decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_fmanagement[0] ?>" name="no_of_emp_fmanagement[]" onkeyup="fsumupEmp(0)" placeholder="Management" readonly="readonly">    
<span class="help-block">
</span>
</td>
<td>
<input type="text"  id="femptotal0" class="form-control" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_ftotal[0] ?>" name="no_of_emp_ftotal[]" readonly placeholder="Total">
<span class="help-block">
</span>
</td>
</tr>
</tbody>
</table>-->
                                                <h3 class="form-section">Proposed Employment <i class="fa fa-question-circle" style="font-size:15px;" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="To fill the proposed employment details, you are requested to follow below steps:
                                                                                                STEP 1:  Select the Domicile, Gender and Category first and then enter the values of employments under respective heads i.e. Skilled, Unskilled, Supervisory, Engineer, IT/ ITES Professional & Management then click on ADD button 
                                                                                                STEP 2: By clicking on Add Button, same value get displayed as a row in table where Edit and Delete functionality are there for each row item
                                                                                                STEP3 3: After adding one row, you are requested to repeat the STEP 1 for adding multiple rows and so on"></i> &nbsp;&nbsp;<span id="empError" style="color:red;font-size:13px !important;"></span>
                                                                                                <?php $totalmp = (@$incmplt_fields->no_of_emp_ftotal[0]) + (@$incmplt_fields->no_of_emp_mtotal[0]); ?>
                                                    Total Employee: <input type="text" id="emp_fmtotal1" readonly="readonly" style="border:none !important" name="emp_fmtotals1     " value="<?php
                                                    if ($totalmp > 0) {
                                                                                                    echo @$totalmp;
                                                    }
                                                    ?>" />
                                                </h3>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <select class="form-control empfilter" id="domicile">
                                                            <option value="">Select Domicile *
                                                            </option>
                                                            <option value="diu">Uttarakhand
                                                            </option>
                                                            <option value="dios">Other State
                                                            </option>
                                                            <option value="difn">Foreign Nationalist
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <select class="form-control empfilter" id="empgender">
                                                            <option  value="">Select Gender *
                                                            </option>
                                                            <option value="m">Male
                                                            </option>
                                                            <option value="f">Female
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <select class="form-control empfilter" id="empcaste">
                                                            <option value="">Select Category *
                                                            </option>
                                                            <option  value="gen">General
                                                            </option>
                                                            <option  value="sc">Scheduled Caste
                                                            </option>
                                                            <option  value="st">Schedule Tribe
                                                            </option>
                                                            <option   value="obc">Other Backward Caste
                                                            </option>
                                                        </select>
                                                    </div>                                                            
                                                </div>
                                                <div class="row addEmployment"  style="padding-top:10px;">
                                                    <div class="col-md-4" style="text-align:center;"> Skilled <br><input id="empSkilled"  type="text" class=" form-control indemp0"></div> 
                                                    <div class="col-md-4" style="text-align:center;">Unskilled<br><input id="empUnskilled" type="text" class="form-control indemp1"> </div>
                                                   <!-- <div class="col-md-2" style="text-align:center;display:none;">Supervisory <br><input id="empSupervisory" type="text" class=" form-control indemp2"> </div> 
                                                    <div class="col-md-2" style="text-align:center;display:none;">Engineer<input id="empEngineer" type="text" class=" form-control indemp3"> </div>
                                                    <div class="col-md-2" style="text-align:center;display:none;">IT Professional<input id="empProfessional" type="text" class=" form-control indemp4"> </div>
                                                    <div class="col-md-2" style="text-align:center;display:none;">Management<input id="empManagement" type="text" class="form-control indemp5"> </div>-->
                                                    <div class="col-md-4 addEmploymentButton" ><span class="pull-right"><a href="javascript:void(0)" class="btn btn-success"><i class="fa fa-plus"></i> Add</a></span></div>
                                                </div>


                                                </br>
                                                <div class="row">
                                                    <div class="table-responsive">
                                                        <table id="<?php echo $domicile = 'diu'; ?>" class="diu categorisedemplyment table table-bordered table-responsive">
                                                            <tr class="diu ">
                                                                <th width="15%" style="text-align:center;vertical-align: middle;">Employment
                                                                </th>
                                                                <td width="25%" style="text-align:center;vertical-align: middle;"> Skilled 
                                                                </td>
                                                                <td width="25%" style="text-align:center;vertical-align: middle;">	Unskilled 
                                                                </td>
                                                               <!-- <td width="10%" style="text-align:center;vertical-align: middle;display:none;">	Supervisory 
                                                                </td>
                                                                <td width="10%" style="text-align:center;vertical-align: middle;display:none;">Engineer 
                                                                </td>
                                                                <td width="10%" style="text-align:center;vertical-align: middle;display:none;">IT/ ITES Professional
                                                                </td>
                                                                <td width="10%" style="text-align:center;vertical-align: middle;display:none;">Management 
                                                                </td>-->
                                                                <td width="15%" style="text-align:center;vertical-align: middle;"> Total Employees 
                                                                </td>
                                                                <td width="20%" style="text-align:center;vertical-align: middle;"> Action 
                                                                </td>
                                                            </tr>
                                                            <tr class="diu_m_gen emporg">
                                                                <td>Domiciled In Uttarakhand 
                                                                    <br> Male - General
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control  decimal mskill <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_skilled"; ?>"  value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control  decimal mUnskilled <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>


<!-- <td>  </td>  
<td>   </td>
<td>    </td> 
<td>     </td> -->
                                                                <td>
                                                                    <input type="hidden" class="form-control  decimal mSupervisory <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                    <input type="hidden" class="form-control  decimal mEngineer <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                    <input type="hidden" class="form-control  decimal mProfessional <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen"maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                    <input type="hidden" class="form-control  decimal mManagement <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                    <input type="text" class="form-control  empTotal decimal  <?php echo $domicile; ?>_male_gen_total" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td> 
                                                                <td>
                                                                    <a href="javascript:void(0)" class="edit-emp" ><i class="fa fa-pencil"></i> Edit</a></br>
                                                                    <a href="javascript:void(0)" class="delete-emp"><i class="fa fa-trash"></i> Delete</a></br>
                                                                    <a href="javascript:void(0)" class="add-skill"><i class="fa fa-plus"></i> Add Skill</a></br>
                                                                </td>
                                                            </tr>
                                                            <tr class="diu_m_sc emporg">
                                                                <td>Domiciled In Uttarakhand 
                                                                    <br> Male - Scheduled Caste
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control  decimal mskill <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control  decimal mUnskilled <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" class="form-control  decimal mSupervisory <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal mEngineer <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal mProfessional <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal mManagement <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="text" class="form-control empTotal decimal  <?php echo $domicile; ?>_male_sc_total" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>  
                                                                <td>
                                                                    <a href="javascript:void(0)" class="edit-emp" ><i class="fa fa-pencil"></i> Edit</a></br>
                                                                    <a href="javascript:void(0)" class="delete-emp"><i class="fa fa-trash"></i> Delete</a></br>
                                                                    <a href="javascript:void(0)" class="add-skill"><i class="fa fa-plus"></i> Add Skill</a></br>
                                                                </td>
                                                            </tr>
                                                            <tr class="diu_m_st emporg">
                                                                <td>Domiciled In Uttarakhand 
                                                                    <br> Male - Scheduled Tribe
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control mskill decimal <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control  decimal mUnskilled <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal  mSupervisory <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal mEngineer <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal  mProfessional <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal mManagement  <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="text" class="form-control empTotal decimal  <?php echo $domicile; ?>_male_st_total" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>  
                                                                <td>
                                                                    <a href="javascript:void(0)" class="edit-emp" ><i class="fa fa-pencil"></i> Edit</a></br>
                                                                    <a href="javascript:void(0)" class="delete-emp"><i class="fa fa-trash"></i> Delete</a></br>
                                                                    <a href="javascript:void(0)" class="add-skill"><i class="fa fa-plus"></i> Add Skill</a></br>
                                                                </td>
                                                            </tr> 
                                                            <tr class="diu_m_obc emporg">
                                                                <td>Domiciled In Uttarakhand 
                                                                    <br> Male - Other Backward Caste
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control mskill decimal <?php echo $domicile; ?>_male_obc"  rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control  decimal mUnskilled <?php echo $domicile; ?>_male_obc" rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" class="form-control  decimal mSupervisory <?php echo $domicile; ?>_male_obc" rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal mEngineer <?php echo $domicile; ?>_male_obc" rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal mProfessional <?php echo $domicile; ?>_male_obc" rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal mManagement <?php echo $domicile; ?>_male_obc" rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="text" class="form-control empTotal decimal  <?php echo $domicile; ?>_male_obc_total"  maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td> 
                                                                <td>
                                                                    <a href="javascript:void(0)" class="edit-emp" ><i class="fa fa-pencil"></i> Edit</a></br>
                                                                    <a href="javascript:void(0)" class="delete-emp"><i class="fa fa-trash"></i> Delete</a></br>
                                                                    <a href="javascript:void(0)" class="add-skill"><i class="fa fa-plus"></i> Add Skill</a></br>
                                                                </td>
                                                            </tr>
                                                            <tr class="diu_f_gen emporg">
                                                                <td>Domiciled In Uttarakhand 
                                                                    <br> Female - General
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control fskill decimal <?php echo $domicile; ?>_female_gen" rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control  decimal fUnskilled <?php echo $domicile; ?>_female_gen" rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" class="form-control  decimal fSupervisory <?php echo $domicile; ?>_female_gen" rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal fEngineer <?php echo $domicile; ?>_female_gen" rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal fProfessional <?php echo $domicile; ?>_female_gen" rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal fManagement <?php echo $domicile; ?>_female_gen" rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="text" class="form-control fempTotal decimal  <?php echo $domicile; ?>_female_gen_total"  maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>  
                                                                <td>
                                                                    <a href="javascript:void(0)" class="edit-emp" ><i class="fa fa-pencil"></i> Edit</a></br>
                                                                    <a href="javascript:void(0)" class="delete-emp"><i class="fa fa-trash"></i> Delete</a></br>
                                                                    <a href="javascript:void(0)" class="add-skill"><i class="fa fa-plus"></i> Add Skill</a></br>
                                                                </td>
                                                            </tr>
                                                            <tr class="diu_f_sc emporg">
                                                                <td>Domiciled In Uttarakhand 
                                                                    <br> Female - Scheduled Caste
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control   fskill decimal <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control  decimal fUnskilled <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" class="form-control  decimal fSupervisory <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal fEngineer <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal fProfessional <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal fManagement <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="text" class="form-control  fempTotal decimal   <?php echo $domicile; ?>_female_sc_total"  maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td> 
                                                                <td>
                                                                    <a href="javascript:void(0)" class="edit-emp" ><i class="fa fa-pencil"></i> Edit</a></br>
                                                                    <a href="javascript:void(0)" class="delete-emp"><i class="fa fa-trash"></i> Delete</a></br>
                                                                    <a href="javascript:void(0)" class="add-skill"><i class="fa fa-plus"></i> Add Skill</a></br>
                                                                </td>
                                                            </tr>
                                                            <tr class="diu_f_st emporg">
                                                                <td>Domiciled In Uttarakhand 
                                                                    <br> Female - Scheduled Tribe
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control fskill decimal <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control  decimal fUnskilled <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" class="form-control  decimal fSupervisory <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal fEngineer <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal fProfessional <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal fManagement <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="text" class="form-control fempTotal decimal  <?php echo $domicile; ?>_female_st_total"  maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:void(0)" class="edit-emp" ><i class="fa fa-pencil"></i> Edit</a></br>
                                                                    <a href="javascript:void(0)" class="delete-emp"><i class="fa fa-trash"></i> Delete</a></br>
                                                                    <a href="javascript:void(0)" class="add-skill"><i class="fa fa-plus"></i> Add Skill</a></br>
                                                                </td>
                                                            </tr>
                                                            <tr class="diu_f_obc emporg">
                                                                <td>Domiciled In Uttarakhand 
                                                                    <br> Female - Other Backward Caste
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control fskill decimal <?php echo $domicile; ?>_female_obc" rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control  decimal fUnskilled <?php echo $domicile; ?>_female_obc" rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" class="form-control  decimal fSupervisory <?php echo $domicile; ?>_female_obc" rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal fEngineer <?php echo $domicile; ?>_female_obc" rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal fProfessional <?php echo $domicile; ?>_female_obc" rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal fManagement <?php echo $domicile; ?>_female_obc" rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="text" class="form-control  fempTotal decimal  <?php echo $domicile; ?>_female_obc_total"  maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td> 
                                                                <td>
                                                                    <a href="javascript:void(0)" class="edit-emp" ><i class="fa fa-pencil"></i> Edit</a></br>
                                                                    <a href="javascript:void(0)" class="delete-emp"><i class="fa fa-trash"></i> Delete</a></br>
                                                                    <a href="javascript:void(0)" class="add-skill"><i class="fa fa-plus"></i> Add Skill</a></br>
                                                                </td>
                                                            </tr>  
<?php $domicile = 'dios'; ?>             
                                                            <tr class="dios_m_gen emporg">
                                                                <td>Domiciled In Other State 
                                                                    <br> Male - General
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control mskill decimal <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control  decimal mUnskilled <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen"  maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" class="form-control  decimal mSupervisory <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal mEngineer <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal mProfessional <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal mManagement <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="text" class="form-control empTotal decimal  <?php echo $domicile; ?>_male_gen_total" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td> 
                                                                <td>
                                                                    <a href="javascript:void(0)" class="edit-emp" ><i class="fa fa-pencil"></i> Edit</a></br>
                                                                    <a href="javascript:void(0)" class="delete-emp"><i class="fa fa-trash"></i> Delete</a></br>
                                                                    <a href="javascript:void(0)" class="add-skill"><i class="fa fa-plus"></i> Add Skill</a></br>
                                                                </td>
                                                            </tr>
                                                            <tr  class="dios_m_sc emporg">
                                                                <td>Domiciled In Other State 
                                                                    <br> Male - Scheduled Caste
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control mskill  decimal <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control  decimal mUnskilled <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" class="form-control  decimal  mSupervisory <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal mEngineer <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal mProfessional <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal mManagement <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="text" class="form-control empTotal decimal  <?php echo $domicile; ?>_male_sc_total" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td> 
                                                                <td>
                                                                    <a href="javascript:void(0)" class="edit-emp" ><i class="fa fa-pencil"></i> Edit</a></br>
                                                                    <a href="javascript:void(0)" class="delete-emp"><i class="fa fa-trash"></i> Delete</a></br>
                                                                    <a href="javascript:void(0)" class="add-skill"><i class="fa fa-plus"></i> Add Skill</a></br>
                                                                </td>
                                                            </tr>
                                                            <tr class="dios_m_st emporg">
                                                                <td>Domiciled In Other State 
                                                                    <br> Male - Scheduled Tribe
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control mskill decimal <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control  decimal mUnskilled <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" class="form-control  decimal mSupervisory <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control   decimal mEngineer <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal mProfessional <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st"maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal mManagement  <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="text" class="form-control empTotal  decimal  <?php echo $domicile; ?>_male_st_total" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td> 
                                                                <td>
                                                                    <a href="javascript:void(0)" class="edit-emp" ><i class="fa fa-pencil"></i> Edit</a></br>
                                                                    <a href="javascript:void(0)" class="delete-emp"><i class="fa fa-trash"></i> Delete</a></br>
                                                                    <a href="javascript:void(0)" class="add-skill"><i class="fa fa-plus"></i> Add Skill</a></br>
                                                                </td>
                                                            </tr>
                                                            <tr class="dios_m_obc emporg">
                                                                <td>Domiciled In Other State 
                                                                    <br>Male - Other Backward Caste
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control mskill decimal <?php echo $domicile; ?>_male_obc" rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control  decimal mUnskilled <?php echo $domicile; ?>_male_obc" rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" class="form-control  decimal mSupervisory <?php echo $domicile; ?>_male_obc" rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal mEngineer <?php echo $domicile; ?>_male_obc" rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal mProfessional <?php echo $domicile; ?>_male_obc" rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal mManagement <?php echo $domicile; ?>_male_obc" rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="text" class="form-control empTotal decimal  <?php echo $domicile; ?>_male_obc_total"  maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td> 
                                                                <td>
                                                                    <a href="javascript:void(0)" class="edit-emp" ><i class="fa fa-pencil"></i> Edit</a></br>
                                                                    <a href="javascript:void(0)" class="delete-emp"><i class="fa fa-trash"></i> Delete</a></br>
                                                                    <a href="javascript:void(0)" class="add-skill"><i class="fa fa-plus"></i> Add Skill</a></br>
                                                                </td>
                                                            </tr>
                                                            <tr class="dios_f_gen emporg">	
                                                                <td>Domiciled In Other State 
                                                                    <br>Female - General
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control fskill decimal <?php echo $domicile; ?>_female_gen"  rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control  decimal fUnskilled <?php echo $domicile; ?>_female_gen"  rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" class="form-control  decimal fSupervisory <?php echo $domicile; ?>_female_gen"  rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal fEngineer <?php echo $domicile; ?>_female_gen"  rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal fProfessional <?php echo $domicile; ?>_female_gen"  rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal  fManagement <?php echo $domicile; ?>_female_gen"  rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="text" class="form-control  fempTotal decimal  <?php echo $domicile; ?>_female_gen_total" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td> 
                                                                <td>
                                                                    <a href="javascript:void(0)" class="edit-emp" ><i class="fa fa-pencil"></i> Edit</a></br>
                                                                    <a href="javascript:void(0)" class="delete-emp"><i class="fa fa-trash"></i> Delete</a></br>
                                                                    <a href="javascript:void(0)" class="add-skill"><i class="fa fa-plus"></i> Add Skill</a></br>
                                                                </td>
                                                            </tr>
                                                            <tr class="dios_f_sc emporg">
                                                                <td>Domiciled In Other State 
                                                                    <br>Female - Scheduled Caste
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control fskill decimal <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control  decimal fUnskilled <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal fSupervisory <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal fEngineer <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal fProfessional <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal fManagement <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="text" class="form-control  decimal fempTotal  <?php echo $domicile; ?>_female_sc_total" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>  
                                                                <td>
                                                                    <a href="javascript:void(0)" class="edit-emp" ><i class="fa fa-pencil"></i> Edit</a></br>
                                                                    <a href="javascript:void(0)" class="delete-emp"><i class="fa fa-trash"></i> Delete</a></br>
                                                                    <a href="javascript:void(0)" class="add-skill"><i class="fa fa-plus"></i> Add Skill</a></br>
                                                                </td>
                                                            </tr>
                                                            <tr  class="dios_f_st emporg">
                                                                <td>Domiciled In Other State 
                                                                    <br>Female - Scheduled Tribe
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control fskill decimal <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control  decimal fUnskilled <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" class="form-control  decimal fSupervisory <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal fEngineer <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal fProfessional <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal fManagement <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="text" class="form-control  decimal fempTotal <?php echo $domicile; ?>_female_st_total" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td> 
                                                                <td>
                                                                    <a href="javascript:void(0)" class="edit-emp" ><i class="fa fa-pencil"></i> Edit</a></br>
                                                                    <a href="javascript:void(0)" class="delete-emp"><i class="fa fa-trash"></i> Delete</a></br>
                                                                    <a href="javascript:void(0)" class="add-skill"><i class="fa fa-plus"></i> Add Skill</a></br>
                                                                </td>
                                                            </tr>
                                                            <tr class="dios_f_obc emporg">
                                                                <td>Domiciled In Other State 
                                                                    <br>Female - Other Backward Caste
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control fskill decimal <?php echo $domicile; ?>_female_obc"  rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control  decimal fUnskilled <?php echo $domicile; ?>_female_obc"  rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" class="form-control  decimal fSupervisory <?php echo $domicile; ?>_female_obc"  rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal fEngineer <?php echo $domicile; ?>_female_obc"  rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal fProfessional <?php echo $domicile; ?>_female_obc"  rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal  fManagement <?php echo $domicile; ?>_female_obc"  rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="text" class="form-control  decimal fempTotal <?php echo $domicile; ?>_female_obc_total" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td> 
                                                                <td>
                                                                    <a href="javascript:void(0)" class="edit-emp" ><i class="fa fa-pencil"></i> Edit</a></br>
                                                                    <a href="javascript:void(0)" class="delete-emp"><i class="fa fa-trash"></i> Delete</a></br>
                                                                    <a href="javascript:void(0)" class="add-skill"><i class="fa fa-plus"></i> Add Skill</a></br>
                                                                </td>
                                                            </tr> 
<?php $domicile = 'difn'; ?>
                                                            <tr class="difn_m_gen emporg">
                                                                <td>Domiciled in Foreign Nationals
                                                                    <br>Male - General
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control mskill decimal <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control  decimal mUnskilled <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" class="form-control  decimal  mSupervisory <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal mEngineer <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal mProfessional <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal mManagement <?php echo $domicile; ?>_male_gen" rel="<?php echo $domicile; ?>_male_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="text" class="form-control  decimal  empTotal  <?php echo $domicile; ?>_male_gen_total"  maxlength='10' name="<?php echo $fieldName = $domicile . "_male_gen_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td> 
                                                                <td>
                                                                    <a href="javascript:void(0)" class="edit-emp" ><i class="fa fa-pencil"></i> Edit</a></br>
                                                                    <a href="javascript:void(0)" class="delete-emp"><i class="fa fa-trash"></i> Delete</a></br>
                                                                    <a href="javascript:void(0)" class="add-skill"><i class="fa fa-plus"></i> Add Skill</a></br>
                                                                </td>
                                                            </tr>
                                                            <tr class="difn_m_sc emporg">
                                                                <td>Domiciled in Foreign Nationals
                                                                    <br>Male - Scheduled Caste
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control mskill  decimal <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control  decimal mUnskilled <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" class="form-control  decimal mSupervisory <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal mEngineer <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal mProfessional <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal mManagement <?php echo $domicile; ?>_male_sc" rel="<?php echo $domicile; ?>_male_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="text" class="form-control  decimal empTotal <?php echo $domicile; ?>_male_sc_total" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_sc_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td> 
                                                                <td>
                                                                    <a href="javascript:void(0)" class="edit-emp" ><i class="fa fa-pencil"></i> Edit</a></br>
                                                                    <a href="javascript:void(0)" class="delete-emp"><i class="fa fa-trash"></i> Delete</a></br>
                                                                    <a href="javascript:void(0)" class="add-skill"><i class="fa fa-plus"></i> Add Skill</a></br>
                                                                </td>
                                                            </tr>
                                                            <tr class="difn_m_st emporg">
                                                                <td>Domiciled in Foreign Nationals
                                                                    <br>Male - Scheduled Tribe
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control mskill  decimal <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control  decimal mUnskilled <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" class="form-control  decimal mSupervisory <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal mEngineer <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal mProfessional <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal mManagement <?php echo $domicile; ?>_male_st" rel="<?php echo $domicile; ?>_male_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="text" class="form-control  decimal empTotal <?php echo $domicile; ?>_male_st_total" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_st_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <a href="javascript:void(0)" class="edit-emp" ><i class="fa fa-pencil"></i> Edit</a></br>
                                                                    <a href="javascript:void(0)" class="delete-emp"><i class="fa fa-trash"></i> Delete</a></br>
                                                                    <a href="javascript:void(0)" class="add-skill"><i class="fa fa-plus"></i> Add Skill</a></br>
                                                                </td>
                                                            </tr>
                                                            <tr class="difn_m_obc emporg">
                                                                <td>Domiciled in Foreign Nationals
                                                                    <br>Male - Other Backward Caste
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control mskill decimal <?php echo $domicile; ?>_male_obc"  rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control  decimal mUnskilled <?php echo $domicile; ?>_male_obc"  rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" class="form-control  decimal mSupervisory <?php echo $domicile; ?>_male_obc"  rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal  mEngineer <?php echo $domicile; ?>_male_obc"  rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal mProfessional <?php echo $domicile; ?>_male_obc"  rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal mManagement <?php echo $domicile; ?>_male_obc"  rel="<?php echo $domicile; ?>_male_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="text" class="form-control  decimal empTotal <?php echo $domicile; ?>_male_obc_total" maxlength='10' name="<?php echo $fieldName = $domicile . "_male_obc_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td> 
                                                                <td>
                                                                    <a href="javascript:void(0)" class="edit-emp" ><i class="fa fa-pencil"></i> Edit</a></br>
                                                                    <a href="javascript:void(0)" class="delete-emp"><i class="fa fa-trash"></i> Delete</a></br>
                                                                    <a href="javascript:void(0)" class="add-skill"><i class="fa fa-plus"></i> Add Skill</a></br>
                                                                </td>
                                                            </tr> 							
                                                            <tr class="difn_f_gen emporg">
                                                                <td>Domiciled in Foreign Nationals
                                                                    <br>Female - General
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control fskill decimal <?php echo $domicile; ?>_female_gen" rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control  decimal  fUnskilled <?php echo $domicile; ?>_female_gen" rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" class="form-control  decimal  fSupervisory <?php echo $domicile; ?>_female_gen" rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal fEngineer <?php echo $domicile; ?>_female_gen" rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal  fProfessional <?php echo $domicile; ?>_female_gen" rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal  fManagement <?php echo $domicile; ?>_female_gen" rel="<?php echo $domicile; ?>_female_gen" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="text" class="form-control  decimal fempTotal <?php echo $domicile; ?>_female_gen_total" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_gen_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td> 
                                                                <td>
                                                                    <a href="javascript:void(0)" class="edit-emp" ><i class="fa fa-pencil"></i> Edit</a></br>
                                                                    <a href="javascript:void(0)" class="delete-emp"><i class="fa fa-trash"></i> Delete</a></br>
                                                                    <a href="javascript:void(0)" class="add-skill"><i class="fa fa-plus"></i> Add Skill</a></br>
                                                                </td>
                                                            </tr>
                                                            <tr class="difn_f_sc emporg">
                                                                <td>Domiciled in Foreign Nationals
                                                                    <br>Female - Scheduled Caste
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control fskill decimal <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control  decimal fUnskilled <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" class="form-control  decimal fSupervisory <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal fEngineer <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal fProfessional <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal fManagement <?php echo $domicile; ?>_female_sc" rel="<?php echo $domicile; ?>_female_sc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="text" class="form-control  decimal fempTotal <?php echo $domicile; ?>_female_sc_total" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_sc_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td> 
                                                                <td>
                                                                    <a href="javascript:void(0)" class="edit-emp" ><i class="fa fa-pencil"></i> Edit</a></br>
                                                                    <a href="javascript:void(0)" class="delete-emp"><i class="fa fa-trash"></i> Delete</a></br>
                                                                    <a href="javascript:void(0)" class="add-skill"><i class="fa fa-plus"></i> Add Skill</a></br>
                                                                </td>
                                                            </tr>
                                                            <tr class="difn_f_sc emporg">
                                                                <td>Domiciled in Foreign Nationals
                                                                    <br>Female - Scheduled Tribe
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control fskill decimal <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control  decimal fUnskilled <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" class="form-control  decimal fSupervisory <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal fEngineer <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal fProfessional <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal fManagement <?php echo $domicile; ?>_female_st" rel="<?php echo $domicile; ?>_female_st" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="text" class="form-control  decimal fempTotal <?php echo $domicile; ?>_female_st_total" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_st_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td> 
                                                                <td>
                                                                    <a href="javascript:void(0)" class="edit-emp" ><i class="fa fa-pencil"></i> Edit</a></br>
                                                                    <a href="javascript:void(0)" class="delete-emp"><i class="fa fa-trash"></i> Delete</a></br>
                                                                    <a href="javascript:void(0)" class="add-skill"><i class="fa fa-plus"></i> Add Skill</a></br>
                                                                </td>
                                                            </tr>
                                                            <tr class="difn_f_obc emporg">
                                                                <td>Domiciled in Foreign Nationals
                                                                    <br>Female - Other Backward Caste
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control fskill  decimal  <?php echo $domicile; ?>_female_obc" rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_skilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control  decimal  fUnskilled <?php echo $domicile; ?>_female_obc" rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_unskilled"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" class="form-control  decimal  fSupervisory <?php echo $domicile; ?>_female_obc" rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_supervisory"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal  fEngineer <?php echo $domicile; ?>_female_obc" rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_engineer"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal  fProfessional <?php echo $domicile; ?>_female_obc" rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_it_professional"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="hidden" class="form-control  decimal  fManagement <?php echo $domicile; ?>_female_obc" rel="<?php echo $domicile; ?>_female_obc" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_management"; ?>" value="<?php echo @$incmplt_fields->$fieldName; ?>">

                                                                    <input type="text" class="form-control  decimal  fempTotal  <?php echo $domicile; ?>_female_obc_total" maxlength='10' name="<?php echo $fieldName = $domicile . "_female_obc_total"; ?>" readonly="readonly" value="<?php echo @$incmplt_fields->$fieldName; ?>">
                                                                </td> 
                                                                <td>
                                                                    <a href="javascript:void(0)" class="edit-emp" ><i class="fa fa-pencil"></i> Edit</a></br>
                                                                    <a href="javascript:void(0)" class="delete-emp"><i class="fa fa-trash"></i> Delete</a></br>
                                                                    <a href="javascript:void(0)" class="add-skill"><i class="fa fa-plus"></i> Add Skill</a></br>
                                                                </td>
                                                            </tr> 
                                                            <tr style="display:none;">
                                                                <td>
                                                                    <b>Total Male Employment
                                                                    </b>
                                                                </td>
                                                                <td>
                                                                    <input type="text"  id="mskl0" value="<?= @$incmplt_fields->no_of_emp_mskilled[0] ?>" name="no_of_emp_mskilled[]" readonly="readonly">
                                                                    <span class="help-block">
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <input type="text"  id="munskl0" value="<?= @$incmplt_fields->no_of_emp_munskilled[0] ?>" name="no_of_emp_munskilled[]" readonly="readonly">
                                                                    <span class="help-block">
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <input type="hidden"  id="msprvsr0" value="<?= @$incmplt_fields->no_of_emp_msupervisory[0] ?>" name="no_of_emp_msupervisory[]" readonly="readonly">
                                                                    <span class="help-block">
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <input type="hidden"  id="mengg0" value="<?= @$incmplt_fields->no_of_emp_mengineer[0] ?>" name="no_of_emp_mengineer[]" readonly="readonly">
                                                                    <span class="help-block">
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <input type="hidden"  id="mit0" value="<?= @$incmplt_fields->no_of_emp_it_mprofessional[0] ?>" name="no_of_emp_it_mprofessional[]" readonly="readonly">
                                                                    <span class="help-block">
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <input type="text"  id="mmngmnt0" value="<?= @$incmplt_fields->no_of_emp_mmanagement[0] ?>" name="no_of_emp_mmanagement[]" readonly="readonly">
                                                                    <span class="help-block">
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <input type="text"  id="memptotal0" value="<?= @$incmplt_fields->no_of_emp_mtotal[0] ?>" name="no_of_emp_mtotal[]" readonly="readonly"> 
                                                                    <span class="help-block">
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            <tr style="display:none;">
                                                                <td>
                                                                    <b>Total Female Employment
                                                                    </b>
                                                                </td>
                                                                <td>
                                                                    <input type="text"  id="fskl0" value="<?= @$incmplt_fields->no_of_emp_fskilled[0] ?>" name="no_of_emp_fskilled[]" readonly="readonly">
                                                                    <span class="help-block">
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <input type="text"  id="funskl0" value="<?= @$incmplt_fields->no_of_emp_funskilled[0] ?>" name="no_of_emp_funskilled[]" readonly="readonly">
                                                                    <span class="help-block">
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <input type="text"  id="fsprvsr0" value="<?= @$incmplt_fields->no_of_emp_fsupervisory[0] ?>" name="no_of_emp_fsupervisory[]" readonly="readonly">
                                                                    <span class="help-block">
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <input type="text"  id="fengg0" value="<?= @$incmplt_fields->no_of_emp_fengineer[0] ?>" name="no_of_emp_fengineer[]" readonly="readonly">
                                                                    <span class="help-block">
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <input type="text"  id="fit0" value="<?= @$incmplt_fields->no_of_emp_it_fprofessional[0] ?>" name="no_of_emp_it_fprofessional[]" readonly="readonly">
                                                                    <span class="help-block">
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <input type="text"  id="fmngmnt0" value="<?= @$incmplt_fields->no_of_emp_fmanagement[0] ?>" name="no_of_emp_fmanagement[]" readonly="readonly">    
                                                                    <span class="help-block">
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <input type="text"  id="femptotal0" value="<?= @$incmplt_fields->no_of_emp_ftotal[0] ?>" name="no_of_emp_ftotal[]" readonly="readonly">
                                                                    <span class="help-block">
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div> 

                                                <!-- <h3 class="form-section">Details of Proposed Employment</h3>
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
                                                                            <input type="text"  id="mskl0" class="form-control mskilled decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_mskilled[0] ?>" name="no_of_emp_mskilled[]" onkeyup="sumupEmp(0)" placeholder="Skilled">
                                                                            
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group form-md-line-input">
                                                                            <input type="text"  id="munskl0" class="form-control munskilled decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_munskilled[0] ?>" name="no_of_emp_munskilled[]" onkeyup="sumupEmp(0)" placeholder="Unskilled">
                                                                            
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group form-md-line-input">
                                                                           <input type="text"  id="msprvsr0" class="form-control msupvsr decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_msupervisory[0] ?>" name="no_of_emp_msupervisory[]" onkeyup="sumupEmp(0)" placeholder="Supervisory">
                                                                            
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group form-md-line-input">
                                                                           <input type="text"  id="mengg0" class="form-control mengg decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_mengineer[0] ?>" name="no_of_emp_mengineer[]" onkeyup="sumupEmp(0)" placeholder="Engineer">
                                                                            
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group form-md-line-input">
                                                                            <input type="text"  id="mit0" class="form-control mitprof decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_it_mprofessional[0] ?>" name="no_of_emp_it_mprofessional[]" onkeyup="sumupEmp(0)" placeholder="IT/ITeS Professional">
                                                                            
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group form-md-line-input">
                                                                            <input type="text"  id="mmngmnt0" class="form-control mmngmt decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_mmanagement[0] ?>" name="no_of_emp_mmanagement[]" onkeyup="sumupEmp(0)" placeholder="Management">
                                                                            
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group form-md-line-input">
                                                                            <input type="text"  id="memptotal0" class="form-control" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_mtotal[0] ?>" name="no_of_emp_mtotal[]" readonly placeholder="Total">
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </td>

                                                                 </tr>
                                                                 <tr>
                                                                    <td>Female</td>

                                                                    <td>
                                                                        <div class="form-group form-md-line-input">
                                                                             <input type="text"  id="fskl0" class="form-control fskilled decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_fskilled[0] ?>" name="no_of_emp_fskilled[]" onkeyup="fsumupEmp(0)" placeholder="Skilled">
                                                                            
                                                                            <span class="help-block"></span> 
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group form-md-line-input">
                                                                           <input type="text"  id="funskl0" class="form-control funskilled decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_funskilled[0] ?>" name="no_of_emp_funskilled[]" onkeyup="fsumupEmp(0)" placeholder="Unskilled">
                                                                            
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group form-md-line-input">
                                                                          <input type="text"  id="fsprvsr0" class="form-control mfupvsr decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_fsupervisory[0] ?>" name="no_of_emp_fsupervisory[]" onkeyup="fsumupEmp(0)" placeholder="Supervisory">
                                                                            
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group form-md-line-input">
                                                                           <input type="text"  id="fengg0" class="form-control feggg decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_fengineer[0] ?>" name="no_of_emp_fengineer[]" onkeyup="fsumupEmp(0)" placeholder="Engineer">
                                                                            
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group form-md-line-input">
                                                                            <input type="text"  id="fit0" class="form-control fitprof decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_it_fprofessional[0] ?>" name="no_of_emp_it_fprofessional[]" onkeyup="fsumupEmp(0)" placeholder="IT/ITeS Professional">
                                                                            
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group form-md-line-input">
                                                                            <input type="text"  id="fmngmnt0" class="form-control fmngmt decimal" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_fmanagement[0] ?>" name="no_of_emp_fmanagement[]" onkeyup="fsumupEmp(0)" placeholder="Management">    
                                                                            
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="form-group form-md-line-input">
                                                                           <input type="text"  id="femptotal0" class="form-control" maxlength='10' value="<?= @$incmplt_fields->no_of_emp_ftotal[0] ?>" name="no_of_emp_ftotal[]" readonly placeholder="Total">
                                                                            <span class="help-block"></span>
                                                                        </div>
                                                                    </td>

                                                                 </tr>
                                                             </tbody>
                                                         </table>
                                                      </div>
                                                 </div> -->


                                                <div class="row">
                                                    <?php
                                                    if (isset($incmplt_fields->skill_data)) {
                                                        $skilldisplay = '';
                                                    } else {
                                                        $skilldisplay = 'none';
                                                    }
                                                    ?>
                                                    <table class="table table-striped table-bordered table-hover responsive-table skills_tablepopup2" id="" style="display:<?php echo $skilldisplay; ?>">
                                                        <thead>
                                                            <tr>
                                                                <th>Employement</th>
                                                                <th>Nature of Unit</th>
                                                                <th>Sector</th>
                                                                <th>Skill Name</th>
                                                                <th>Total Employment</th>
                                                                <?php if (isset($incmplt_fields->skill_data)) {
                                                                    ?>
                                                                    <th>Action</th>
                                                                <?php } ?>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if (isset($incmplt_fields->skill_data)) {
                                                                $skillarray = json_decode(json_encode($incmplt_fields->skill_data), True);

                                                                foreach ($skillarray as $key => $val) {
                                                                    $parentKey = "";
                                                                    foreach ($val as $key2 => $val2) {
                                                                        ?>
                                                                        <tr class="<?php echo @$key2 . '_tr'; ?>">
                                                                            <td>
                                                                        <?php echo @$val2['skilled_employement']; ?>
                                                                                <input type='hidden' id='skilled_employement'  name="skill_data[<?php echo @$key; ?>][<?php echo @$key2; ?>][skilled_employement]" value="<?php echo @$val2['skilled_employement']; ?>" class="form-control" style="border:0px solid #e7ecf1" readonly>
                                                                            </td>
                                                                            <td>
            <?php echo @$val2['skilled_natureunit']; ?>
                                                                                <input type='hidden' id='skilled_natureunit' name="skill_data[<?php echo @$key; ?>][<?php echo @$key2; ?>][skilled_natureunit]" value="<?php echo @$val2['skilled_natureunit']; ?>" class="form-control" style="border:0px solid #e7ecf1" readonly></td>
                                                                            <td>
                                                                                <?php echo @$val2['skilled_sector']; ?>
                                                                                <input type='hidden' id='skilled_sector' name="skill_data[<?php echo $key; ?>][<?php echo @$key2; ?>][skilled_sector]" value="<?php echo @$val2['skilled_sector']; ?>" class="skilled_sector form-control" style="border:0px solid #e7ecf1" readonly>
                                                                            </td>
                                                                            <td>
            <?php echo @$val2['skilled_name']; ?>
                                                                                <input type='hidden' id='skilled_name' name="skill_data[<?php echo @$key; ?>][<?php echo @$key2; ?>][skilled_name]" value="<?php echo @$val2['skilled_name']; ?>" class="form-control" style="border:0px solid #e7ecf1" readonly>
                                                                            </td>
                                                                            <td>		
                                                                                <input type='text' id='skilled_total' name="skill_data[<?php echo @$key; ?>][<?php echo @$key2; ?>][skilled_total]" value="<?php echo @$val2['skilled_total']; ?>" class="skilltotal form-control <?php echo @$key2; ?>" style="border:0px solid #e7ecf1" readonly rel="<?php echo @$key2; ?>">
                                                                            </td>
                                                                            <td>
                                                                                <a href="javascript:void(0)" class="edit_emp_skill"><i class="fa fa-pencil"></i> Edit</a>
                                                                                <br/>
                                                                                <a href="javascript:void(0)" class="delete_emp_skill" ><i class="fa fa-trash"></i> Delete</a>
                                                                            </td>
                                                                        </tr>
            <?php
        }
    }
}
?>
                                                        </tbody>
                                                    </table>
                                                </div>		
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </form>
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
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Have you identified land?<span class="required" aria-required="true"> * </span></label>
                                                            <div class="col-md-9">
                                                                <select name="have_own_land" id='have_own_land' class="form-control">
                                                                    <option value="">Have you identified land</option>
                                                                    <option value="Yes" <?php if (isset($incmplt_fields->have_own_land)) if ($incmplt_fields->have_own_land == 'Yes') echo "selected"; ?> >Yes</option>
                                                                    <option value="No" <?php if (isset($incmplt_fields->have_own_land)) if ($incmplt_fields->have_own_land == 'No') echo "selected"; ?> >No</option>
                                                                </select>
                                                                <span class="help-block"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Proposed Land /Space Detail<span class="required" aria-required="true"> * </span></label>
                                                            <div class="col-md-9">
                                                                <select name="Proposed_details_of_Land" id='Proposed_details_of_Land' class="form-control">
                                                                    <option value="">* Proposed Land /Space Detail</option>
                                                                    <option value="Notified Land" <?php if (isset($incmplt_fields->Proposed_details_of_Land)) if ($incmplt_fields->Proposed_details_of_Land == 'Notified Land') echo "selected"; ?>>Notified Land</option>
                                                                    <option value="SIIDCUL Land" <?php if (isset($incmplt_fields->Proposed_details_of_Land)) if ($incmplt_fields->Proposed_details_of_Land == 'SIIDCUL Land') echo "selected"; ?> >SIIDCUL Land</option>
                                                                    <option value="DI Land" <?php if (isset($incmplt_fields->Proposed_details_of_Land)) if ($incmplt_fields->Proposed_details_of_Land == 'DI Land') echo "selected"; ?>>DI Land</option>
                                                                    <option value="Rented Space" <?php if (isset($incmplt_fields->Proposed_details_of_Land)) if ($incmplt_fields->Proposed_details_of_Land == 'Rented Space') echo "selected"; ?>>Rented Space</option>
                                                                    <option value="Own Land/Space" <?php if (isset($incmplt_fields->Proposed_details_of_Land)) if ($incmplt_fields->Proposed_details_of_Land == 'Own Land/Space') echo "selected"; ?>>Own Land/Space</option>
                                                                    <option value="Other" <?php if (isset($incmplt_fields->Proposed_details_of_Land)) if ($incmplt_fields->Proposed_details_of_Land == 'Other') echo "selected"; ?>>Other/Purchase</option>
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
                                                                <input type="text"  name="Land_in_Hectares" id="Land_in_Heetares" class="form-control decimal"  value="<?= @$incmplt_fields->Land_in_Hectares ?>"  placeholder="* Area">
                                                                <span class="help-block"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Address<span class="required" aria-required="true"> * </span></label>
                                                            <div class="col-md-9">
                                                                <input type="text"  id="land_address" class="form-control address_field_with_space" maxlength="100" value="<?= @$incmplt_fields->land_address ?>" name="land_address" placeholder="* Street Name/City">                                               
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
if (isset($incmplt_fields->land_area_pin_code)) {
    ?>
                                                            <div class="col-md-6 land_leased_other">
                                                                <div class="form-group">
                                                                    <label class="control-label check_no_own_land_lable col-md-3">Pin Code<span class="required" aria-required="true"> * </span></label>
                                                                    <div class="col-md-9">
                                                                        <input type="text"  name="land_area_pin_code" id="land_area_pin_code" class="six_digit_zip_code form-control" value="<?= @$incmplt_fields->land_area_pin_code ?>" placeholder="* Pincode">
                                                                        <span class="help-block"></span>
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
                                                                    <label class="control-label col-md-3">Plot/Khasra No<span class="required" aria-required="true"> * </span></label>
                                                                    <div class="col-md-9">
                                                                        <input type="text"  id="Khasra_no" class="form-control address_field_with_space" maxlength="100" value="<?= @$incmplt_fields->Khasra_no ?>" name="Khasra_no" placeholder="* Plot/Khasra_no">                                            
                                                                        <span class="help-block">  </span>
                                                                    </div>
                                                                </div>
                                                            </div>
<?php } ?>
                                                        <!--/span-->
                                                    </div>
                                                    <!-- /row -->
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 land_leased_other">
                                                        <div class="form-group">
                                                            <label class="control-label check_no_own_land_lable col-md-3">Tehsil<span class="required" aria-required="true"> * </span></label>
                                                            <div class="col-md-9">
                                                                <input type="text"  id="Location" class="form-control name_with_space" value="<?= @$incmplt_fields->tehsil ?>" maxlength="100" name="tehsil" placeholder="* Tehsil">
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
                                                                    <input type="text"  id="detail_of_leased_space_area_in_sq_meters" class="form-control decimal" value="<?= @$incmplt_fields->detail_of_leased_space_area_in_sq_meters ?>" name="detail_of_leased_space_area_in_sq_meters" placeholder="* Area in Sq. Meters">
                                                                    <span class="help-block"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--/span-->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label check_no_own_land_lable col-md-3">Address<span class="required" aria-required="true"> * </span></label>
                                                                <div class="col-md-9">
                                                                    <input type="text" id="detail_of_leased_address" class="form-control address_field_with_space" maxlength="100" value="<?= @$incmplt_fields->detail_of_leased_address ?>" name="detail_of_leased_address" placeholder="* Address">
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
                                                                    <input type="text"  id="detail_of_leased_space_tehsil" class="form-control name_with_space" maxlength="100" value="<?= @$incmplt_fields->detail_of_leased_space_tehsil ?>" name="detail_of_leased_space_tehsil" placeholder="* Tehsil">
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
                                                                        <th> Quantity </th>
                                                                        <th> Unit </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>    
                                                                        <td>
                                                                            <div class="form-group form-md-line-input">
                                                                                <label class="control-label echeck_no_own_land_lable">Industrial</label>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group form-md-line-input">
                                                                                <input type="text" name="industrial_water" value="<?= @$incmplt_fields->industrial_water ?>" class="decimal form-control">
                                                                                <span class="help-block"></span>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group form-md-line-input">
                                                                                <label class="control-label echeck_no_own_land_lable">Liters/Year</label>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="form-group form-md-line-input">
                                                                                <label class="control-label echeck_no_own_land_lable">Domestic</label>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group form-md-line-input">
                                                                                <input type="text" name="domestic_water" value="<?= @$incmplt_fields->domestic_water ?>" class="decimal form-control">
                                                                                <span class="help-block"></span>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="form-group form-md-line-input">
                                                                                <label class="control-label echeck_no_own_land_lable">Liters/Year</label>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="form-group form-md-line-input">
                                                                                <label class="control-label echeck_no_own_land_lable">Source of water</label>
                                                                            </div>
                                                                        </td>
                                                                        <td colspan="2"> 
                                                                            <div class="form-group form-md-line-input">
                                                                                <input type="text" name="source_of_water" value="<?= @$incmplt_fields->source_of_water ?>" class="form-control name_with_space">
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
                                                                                <input type="text" name="coal" value="<?= @$incmplt_fields->coal ?>" class="decimal form-control">
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
                                                                                <input type="text" name="lpg" value="<?= @$incmplt_fields->lpg ?>"  class="decimal form-control">
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
                                                                                <input type="text" name="electricity" value="<?= @$incmplt_fields->electricity ?>" class="decimal form-control">
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
                                                                                <input type="text" name="solar" value="<?= @$incmplt_fields->solar ?>"  class="decimal form-control">
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
                                                <h3 class="form-section">Existing Approval Details (if any)</h3>
                                                <div class="row">
                                                    <div class="col-md-12 product_manufactured_body_class">
                                                        <div class="form-group mt-repeater">
                                                            <a href="javascript:;" data-repeater-create class="btn btn-success mt-repeater-add">
                                                                <i class="fa fa-plus"></i> Add New Approval</a>
                                                            <div data-repeater-list="group-c">
                                                                <div data-repeater-item class="mt-repeater-item product_manufactured_body_remove">
                                                                    <div class="row mt-repeater-row">
                                                                        <div class="col-md-3">
                                                                            <label class="control-label">Name of the Department</label>
                                                                            <input type="text" placeholder="Name of the Department" name="Name_of_the_Department[]" class="form-control" /> </div>
                                                                        <div class="col-md-3">
                                                                            <label class="control-label">Name of the Approval</label>
                                                                            <input type="text" placeholder="Name of the Approval" name="Name_of_the_Approval[]" class="form-control" /> </div>
                                                                        <div class="col-md-3">
                                                                            <label class="control-label">Reference no of the letter</label>
                                                                            <input type="text" placeholder="Reference no of the letter" name="Reference_no_of_the_letter[]" class="form-control" /> </div>
                                                                        <div class="col-md-2">
                                                                            <label class="control-label">Date of the Approval</label>
                                                                            <input type="date" name = "Date_of_the_Approval[]" class="form-control input-sm custom_text_product_man" >
                                                                             <!-- <input type="text" class="form-control form-filter input-sm" readonly name="product_created_from" placeholder="From"> -->
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
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 product_manufactured_body_class">
                                                        <div class="form-group mt-repeater">
                                                            <div data-repeater-list="group-c">
                                                                <div data-repeater-item class="mt-repeater-item product_manufactured_body_remove">
<?php
// echo "<pre>";echo count($incmplt_fields->Name_of_the_Department);print_r($incmplt_fields);die;
if (isset($incmplt_fields->Name_of_the_Department) && count($incmplt_fields->Name_of_the_Department) > 0) {
    foreach ($incmplt_fields->Name_of_the_Department as $key => $departApprvr) {
        if (!empty($incmplt_fields->Name_of_the_Department[$key])) {
            echo '<div class="row">';
            echo '<div class="col-md-3">
                                                                                            <label class="control-label">Name of the Department</label>
                                                                                            <input type="text" value="' . $incmplt_fields->Name_of_the_Department[$key] . '" name="Name_of_the_Department[]" class="form-control" /> </div>
                                                                                        <div class="col-md-3">
                                                                                            <label class="control-label">Name of the Approval</label>
                                                                                            <input type="text" value="' . $incmplt_fields->Name_of_the_Approval[$key] . '" name="Name_of_the_Approval[]" class="form-control" /> </div>
                                                                                         <div class="col-md-3">
                                                                                            <label class="control-label">Reference no of the letter</label>
                                                                                            <input type="text" value="' . $incmplt_fields->Reference_no_of_the_letter[$key] . '" name="Reference_no_of_the_letter[]" class="form-control" /> </div>
                                                                                         <div class="col-md-2">
                                                                                            <label class="control-label">Date of the Approval</label>
                                                                                                <input type="date" name = "Date_of_the_Approval[]" value="' . $incmplt_fields->Date_of_the_Approval[$key] . '" class="form-control input-sm custom_text_product_man" >
                                                                                                 <!-- <input type="text" class="form-control form-filter input-sm" readonly name="product_created_from" placeholder="From"> -->
                                                                                        </div>
                                                                                        <div class="col-md-1">
                                                                                            <a href="javascript:;" data-repeater-delete class="btn btn-danger mt-repeater-delete">
                                                                                                <i class="fa fa-close"></i>
                                                                                            </a>
                                                                                        </div>';
            echo '</div>';
        }
    }
}
?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /row -->
                                                <h3 class="form-section">Required Approvals (if any)</h3>
                                                <div class="row">
                                                    <div class="col-md-12 product_manufactured_body_class">
                                                        <div class="form-group mt-repeater">
                                                            <a href="javascript:;" data-repeater-create class="btn btn-success mt-repeater-add">
                                                                <i class="fa fa-plus"></i> Add New Approval</a>
                                                            <div data-repeater-list="group-c">
                                                                <div data-repeater-item class="mt-repeater-item product_manufactured_body_remove">
                                                                    <div class="row mt-repeater-row">
                                                                        <div class="col-md-5">
                                                                            <label class="control-label">Name of the Department</label>
                                                                            <input type="text" placeholder="Name of the Department" name="requried_approval_department[]" class="form-control" /> </div>
                                                                        <div class="col-md-6">
                                                                            <label class="control-label">Name of the Approval</label>
                                                                            <input type="text" placeholder="Name of the Approval" name="required_approval_name[]" class="form-control" /> </div>
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
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 product_manufactured_body_class">
                                                        <div class="form-group mt-repeater">
                                                            <div data-repeater-list="group-c">
                                                                <div data-repeater-item class="mt-repeater-item product_manufactured_body_remove">
<?php
if (isset($incmplt_fields->requried_approval_department) && count($incmplt_fields->requried_approval_department) > 0) {
    foreach ($incmplt_fields->requried_approval_department as $key => $departApprvr) {
        if (!empty($incmplt_fields->requried_approval_department[$key])) {
            echo '<div class="row">
                                                                                    <div class="col-md-5">
                                                                                        <label class="control-label">Name of the Department</label>
                                                                                        <input type="text" value="' . $incmplt_fields->requried_approval_department[$key] . '" name="requried_approval_department[]" class="form-control" /> </div>
                                                                                    <div class="col-md-6">
                                                                                        <label class="control-label">Name of the Approval</label>
                                                                                        <input type="text" value="' . $incmplt_fields->required_approval_name[$key] . '" name="required_approval_name[]" class="form-control" /> </div>
                                                                                    <div class="col-md-1">
                                                                                        <a href="javascript:;" data-repeater-delete class="btn btn-danger mt-repeater-delete">
                                                                                            <i class="fa fa-close"></i>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>';
        }
    }
}
?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /row -->


                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane <?php if ($document == 1) echo 'active' ?>" id="tab4">
                                    <!--<h3 class="block">Checklist</h3>-->
                                    <div class="portlet box green">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-gift"></i>CAF Application -Step 4- Checklist </div>
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
$docUploadPening = false;
$count = 1;
$docModel = new ApplicationCdnMappingExt;
$docs = $docModel::getApplicationDocumentOnly($app['application_id']);
$userAlreadyUploadedDocs = $docModel::isDocAlreadyUploadedByUser($pre_field['user_id']);
//   echo "<!--<pre>";print_r($docs);print_r($userAlreadyUploadedDocs);echo "-->";
if ($docs) {
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
    $docNeedToUpload = 0;
    $flg1 = 0;
    foreach ($docs as $doc) {
        $docInfo = $docModel::isDocAlreadyUploadedByUser($pre_field['user_id'], $doc['doc_id']);
        ?>   <?php //echo "<tr><td colspan='6'><!-- Doc Info".print_r($docInfo)."--></td></tr>"; ?>
                                                            <?php
                                                            if (!empty($docInfo)) {
                                                                if ($docInfo['parent_doc_id'] == '1') {

                                                                    $flg1 = $flg1 + 1;
                                                                }
                                                                if ($docInfo['parent_doc_id'] == '3') {
                                                                    $flg1 = $flg1 + 1;
                                                                }
                                                                if ($docInfo['parent_doc_id'] == '7') {
                                                                    $flg1 = $flg1 + 1;
                                                                }
                                                            }
                                                            // echo "<!--User Already Uploaded".print_r($userAlreadyUploadedDocs)."-->";
                                                            if (in_array($doc['doc_id'], $userAlreadyUploadedDocs)) {

                                                                // $docInfo=$docModel::isDocAlreadyUploadedByUser($pre_field['user_id'],$doc['doc_id']);
                                                                if (($docInfo['doc_status'] == 'R' || ($doc['is_doc_req_everytime'] == 'Y') && $docInfo['doc_status'] == 'V' && $appStatus == 'I')) {
                                                                    // if($docInfo['doc_status']=='R' || ($doc['is_doc_req_everytime']=='Y')){
                                                                    $docUploadPening = true;
                                                                    // echo "true for <pre>".$doc['doc_id'];print_r($docInfo);print_r($doc);echo "app status ".$appStatus;die("check 1");

                                                                    echo "<tr><td><form action='" . Yii::app()->createAbsoluteUrl('frontuser/home/uploadInvestorDocs') . "' method='POST' enctype='multipart/form-data'>";
                                                                    if ($doc['is_doc_mendatory'] == 'Y') {
                                                                        $docUploadPening = true;
                                                                        // echo "true for ".$doc['doc_id'];die("check 2");;
                                                                        if ($docNeedToUpload == 0) {
                                                                            $docNeedToUpload = 1;
                                                                        }
                                                                    }


                                                                    $name = $doc['doc_name'];
                                                                    if (preg_match('/_/', $doc['doc_name']))
                                                                        $doc['doc_name'] = str_replace('_', ' ', $doc['doc_name']);
                                                                    echo ucwords($doc["doc_name"]);
                                                                    echo "</td>";
                                                                    if ($name == '* Identity_Proof') {
                                                                        echo "<td>";
                                                                        echo "<select required class='form-control' name='selected_doc_id_card'>
                                                                                                  <option value='PAN Card'>PAN Card</option>
                                                                                                  <option value='Aadhaar Card'>Aadhaar Card</option>
                                                                                                  </select></td>";
                                                                    } elseif ($name == 'Document_Related_to_Firm_(as_applicable)') {
                                                                        echo "<td>";
                                                                        echo "<select required class='form-control' name='selected_partnership_deed'>
                                                                                            <option value=''>Please select</option>
                                                                                                  <option value='partnership_deed'>Partnership Deed</option>
                                                                                                  <option value='Firm_registration_certificate'>Firm registration certificate</option>
                                                                                                  <option value='Society_registration_certificate'>Society registration certificate</option>
                                                                                                  <option value='Memorandum_of_Article'>Memorandum of Article</option>
                                                                                                  <option value='Certificate_of-Incorporation'>Certificate of Incorporation</option>
                                                                                                  </select></td>";
                                                                    } elseif ($name == 'Expansion(if any)') {
                                                                        echo "<td>";
                                                                        echo "<select required class='form-control' name='selected_expension'>
                                                                                          <option value=''>Please select</option>
                                                                                                <option value='iem_part'>IEM Part B</option>
                                                                                                <option value='UAM'>UAM</option>
                                                                                                <option value='EM2'>EM2</option>
                                                                                                </select></td>";
                                                                    } else
                                                                        echo "<td>&nbsp;</td>";
                                                                    echo "<td>
                                                                                          <select class='form-control' required name='selected_doc_type'>
                                                                                                  <option value=''>File Type</option>
                                                                                                  <option value='application/pdf'>PDF</option>
                                                                                                  <option value='image/jpeg'>Image</option>
                                                                                          </select>
                                                                                       </td><td>" . $doc["doc_min_size"] . "-" . $doc["doc_max_size"] . " Kb" . "</td>
                                                                                    <td>";
                                                                    echo '<div class="fileinput fileinput-new" data-provides="fileinput">
                                                                                              <span class="btn green btn-file">
                                                                                                  <i class="fa fa-folder-open-o"></i>
                                                                                                  <span class="fileinput-new"> Select file </span>
                                                                                                  <span class="fileinput-exists"> Change </span>
                                                                                                     <input type="file" name="caf_applications_uploads"';
                                                                    if ($name == '*id_card')
                                                                        echo " required ";
                                                                    if ($name == '*address_proof')
                                                                        echo " required ";
                                                                    if ($name == '*brief_project_report')
                                                                        echo " required ";
                                                                    echo'/> </span>
                                                                                                  <input type="hidden" name="caf_applications_uploads[doc_id]" value="' . $doc["doc_id"] . '">
                                                                                                  <input type="hidden" name="caf_applications_uploads[app_id]" value="' . $app["application_id"] . '">
                                                                                                  <input type="hidden" name="caf_applications_uploads[YII_CSRF_TOKEN]" value="' . Yii::app()->getRequest()->getCsrfToken() . '" />

                                                                                              <span class="fileinput-filename"> </span> &nbsp;
                                                                                              <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"> </a>
                                                                                          </div>';
                                                                    echo "</td>
                                                                                    <td><input type='submit' value='Upload' class='btn Blue'></td></tr></form>";
                                                                }
                                                                else {
                                                                    echo "<tr><td>";
                                                                    $name = $doc['doc_name'];
                                                                    if (preg_match('/_/', $doc['doc_name']))
                                                                        $doc['doc_name'] = str_replace('_', ' ', $doc['doc_name']);
                                                                    echo ucwords($doc["doc_name"]);
                                                                    echo "</td>
                                                                                         <td>" . $docInfo['document_name'] . "</td><td>" . $docInfo["document_mime_type"] . "</td><td>" . $doc["doc_min_size"] . "-" . $doc["doc_max_size"] . "</td>
                                                                                      <td>
                                                                                         <span class='label label-info'>";
                                                                    if ($docInfo['doc_status'] == 'P')
                                                                        echo "Verification pending at department Level";
                                                                    elseif ($docInfo['doc_status'] == 'V')
                                                                        echo "Verified by department";
                                                                    elseif ($docInfo['doc_status'] == 'R')
                                                                        echo "Rejected by department";

                                                                    echo "</span>
                                                                                      </td>
                                                                                      <td>No Action Required</td>
                                                                                   </tr>";
                                                                }
                                                            }
                                                            else {
                                                                if ($doc['is_doc_mendatory'] == 'Y') {
                                                                    $docUploadPening = true;
                                                                    // echo "true for ".$doc['doc_id'];die("check 3");;
                                                                }


                                                                echo "<tr><td><form action='" . Yii::app()->createAbsoluteUrl('frontuser/home/uploadInvestorDocs') . "' method='POST' enctype='multipart/form-data'>";
                                                                $name = $doc['doc_name'];
                                                                if (preg_match('/_/', $doc['doc_name']))
                                                                    $doc['doc_name'] = str_replace('_', ' ', $doc['doc_name']);
                                                                echo ucwords($doc["doc_name"]);
                                                                echo "</td>";
                                                                if ($name == '* Identity_Proof') {
                                                                    echo "<td>";
                                                                    echo "<select required class='form-control' name='selected_doc_id_card'>
                                                                                              <option value='PAN Card'>PAN Card</option>
                                                                                              <option value='Aadhaar Card'>Aadhaar Card</option>
                                                                                              </select></td>";
                                                                } elseif ($name == 'Document_Related_to_Firm_(as_applicable)') {
                                                                    echo "<td>";
                                                                    echo "<select required class='form-control' name='selected_partnership_deed'>
                                                                                        <option value=''>Please select</option>
                                                                                              <option value='partnership_deed'>Partnership Deed</option>
                                                                                              <option value='Firm_registration_certificate'>Firm registration certificate</option>
                                                                                              <option value='Society_registration_certificate'>Society registration certificate</option>
                                                                                              <option value='Memorandum_of_Article'>Memorandum of Article</option>
                                                                                              <option value='Certificate_of-Incorporation'>Certificate of Incorporation</option>
                                                                                              </select></td>";
                                                                } elseif ($name == 'Expansion(if any)') {
                                                                    echo "<td>";
                                                                    echo "<select required class='form-control' name='selected_expension'>
                                                                                      <option value=''>Please select</option>
                                                                                            <option value='iem_part'>IEM Part B</option>
                                                                                            <option value='UAM'>UAM</option>
                                                                                            <option value='EM2'>EM2</option>
                                                                                            </select></td>";
                                                                } else
                                                                    echo "<td>&nbsp;</td>";
                                                                echo "<td>
                                                                                      <select class='form-control' required name='selected_doc_type'>
                                                                                              <option value=''>File Type</option>
                                                                                              <option value='application/pdf'>PDF</option>
                                                                                              <option value='image/jpeg'>Image</option>
                                                                                      </select>
                                                                                   </td><td>" . $doc["doc_min_size"] . "-" . $doc["doc_max_size"] . " Kb" . "</td>
                                                                                <td>";
                                                                echo '<div class="fileinput fileinput-new" data-provides="fileinput">
                                                                                          <span class="btn green btn-file">
                                                                                              <i class="fa fa-folder-open-o"></i>
                                                                                              <span class="fileinput-new"> Select file </span>
                                                                                              <span class="fileinput-exists"> Change </span>
                                                                                                 <input type="file" name="caf_applications_uploads"';
                                                                if ($name == '*id_card')
                                                                    echo " required ";
                                                                if ($name == '*address_proof')
                                                                    echo " required ";
                                                                if ($name == '*brief_project_report')
                                                                    echo " required ";
                                                                echo'/> </span>
                                                                                              <input type="hidden" name="caf_applications_uploads[doc_id]" value="' . $doc["doc_id"] . '">
                                                                                              <input type="hidden" name="caf_applications_uploads[app_id]" value="' . $app["application_id"] . '">
                                                                                              <input type="hidden" name="caf_applications_uploads[YII_CSRF_TOKEN]" value="' . Yii::app()->getRequest()->getCsrfToken() . '" />

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
                                    <?php
                                    echo "<!--CHECK DOC REQUIRED: " . $docNeedToUpload . "-->";
if ($docNeedToUpload == 0) {
    ?>

                                        <form action="<?= Yii::app()->createAbsoluteUrl('frontuser/home/submitCafApplication') ?>" style="display: inline" id="finalCAFSubmit2" method="post">
                                            <input type="hidden" class="csrftoken" name="YII_CSRF_TOKEN_SUBMIT" value="<?= Yii::app()->getRequest()->getCsrfToken() ?>" />

                                            <?php if ($flg1 > 2) { ?>    <button type="button" class="btn green button-submit " id="finalSub" > Submit
                                                  
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
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/pages/scripts/form-wizard.min.new1.js" type="text/javascript"></script>
<!-- form repeater js -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/jquery-repeater/jquery.repeater.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/pages/scripts/form-repeater.min.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/pages/scripts/components-date-time-pickers.min.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-datepicker/js/moment.min.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->


<!-- END PAGE LEVEL SCRIPTS -->

<!-- move this code in separte file to make this page neat and clean -->
<script type="text/javascript">
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
                                                                        else {
                                                                            content = 'None';
                                                                        }
                                                                        //console.log(content);
                                                                        $('#ntrofunittype').empty();
                                                                        $('#ntrofunittype').append('<option  value="">---Please Select Unit Type---</option>');
                                                                        $('#ntrofunittype').append(content);

                                                                    })
                                                                    $('#Proposed_details_of_Land').change(function () {
                                                                        var sel_val = $('#Proposed_details_of_Land').val();
                                                                        var have_own_land = $("#have_own_land").val();
                                                                        $('.append_later').empty();
                                                                        if (sel_val == 'Rented Space') {
                                                                            $('.dt_land').empty();
                                                                            $('.dt_land').text('Details of Leased/Rented Space');
                                                                            if (have_own_land == 'No') {
                                                                               // $('.check_no_own_land_lable').html("<sup>*</sup>*Land in Hectares");
                                                                            }
                                                                            $('.land_leased_other').hide();
                                                                            $('.land_leased').show();
                                                                            $('#detail_of_leased_space_area_in_sq_meters').val("");
                                                                            $('#detail_of_leased_space_detail_of_space').val("");
                                                                            $('#detail_of_leased_space_location').val("");
                                                                        }
                                                                        else {
                                                                            if (have_own_land == 'No') {
                                                                               // $('.check_no_own_land_lable').html("<sup>*</sup>Land in Sq Meter");
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


                                                                    })
                                                                    function sumupInst(id) {
                                                                        var sum = 0;
                                                                        var land = $('#land' + id).val();
                                                                        if (isNaN(parseFloat(land))) {
                                                                            land = 0.0;
                                                                        }
                                                                        // Start From Here Due to Lakh Crore here :Rahul Kumar - 15Dec2018
                                                                        if (land != 0.0) {
                                                                            if ($('#land' + id + "_rs").val() != "Crore") {
                                                                                land = land / 100;
                                                                            }
                                                                        }
                                                                        // End  From Here Due to Lakh Crore here :Rahul Kumar - 15Dec2018


                                                                        var building = $('#building' + id).val();
                                                                        if (isNaN(parseFloat(building))) {
                                                                            building = 0.0;
                                                                        }
                                                                        // End  From Here Due to Lakh Crore here :Rahul Kumar - 15Dec2018

                                                                        // Start From Here Due to Lakh Crore here :Rahul Kumar - 15Dec2018
                                                                        if (building != 0.0) {
                                                                            if ($('#building' + id + "_rs").val() != "Crore") {
                                                                                building = building / 100;
                                                                            }
                                                                        }
                                                                        // End  From Here Due to Lakh Crore here :Rahul Kumar - 15Dec2018

                                                                        var plant = $('#plant' + id).val();
                                                                        if (isNaN(parseFloat(plant))) {
                                                                            plant = 0.0;
                                                                        }

                                                                        // Start From Here Due to Lakh Crore here :Rahul Kumar - 15Dec2018
                                                                        if (plant != 0.0) {
                                                                            if ($('#plant' + id + "_rs").val() != "Crore") {
                                                                                plant = plant / 100;
                                                                            }
                                                                        }
                                                                        // End  From Here Due to Lakh Crore here :Rahul Kumar - 15Dec2018
                                                                        var wrkcapt = $('#wrkcapt' + id).val();
                                                                        if (isNaN(parseFloat(wrkcapt))) {
                                                                            wrkcapt = 0.0;
                                                                        }

                                                                        // Start From Here Due to Lakh Crore here :Rahul Kumar - 15Dec2018
                                                                        if (wrkcapt != 0.0) {
                                                                            if ($('#wrkcapt' + id + "_rs").val() != "Crore") {
                                                                                wrkcapt = wrkcapt / 100;
                                                                            }
                                                                        }
                                                                        // End  From Here Due to Lakh Crore here :Rahul Kumar - 15Dec2018

                                                                        var other = $('#other' + id).val();
                                                                        if (isNaN(parseFloat(other))) {
                                                                            other = 0.0;
                                                                        }

                                                                        // Start From Here Due to Lakh Crore here :Rahul Kumar - 15Dec2018
                                                                        if (other != 0.0) {
                                                                            if ($('#other' + id + "_rs").val() != "Crore") {
                                                                                other = other / 100;
                                                                            }
                                                                        }
                                                                        // End  From Here Due to Lakh Crore here :Rahul Kumar - 15Dec2018
                                                                       // sum = (parseFloat(land) + parseFloat(building) + parseFloat(plant) + parseFloat(wrkcapt) + parseFloat(other)).toFixed(2);
                                                                         sum = (parseFloat(land) + parseFloat(building) + parseFloat(plant)  + parseFloat(other)).toFixed(2);//apoorv removing unused
                                                                        $("#total" + id).val(sum);
                                                                    }


                                                                        // Rahul Kumar : 16 Dec 2018
                                                                        function sumupInst2(id) {
                                                                            var sum = 0;
                                                                            var invstmnt_in_capitalmargin_ = $('#invstmnt_in_capitalmargin_' + id).val();
                                                                            if (isNaN(parseFloat(invstmnt_in_capitalmargin_))) {
                                                                                invstmnt_in_capitalmargin_ = 0.0;
                                                                            }
                                                                            if (invstmnt_in_capitalmargin_ != 0.0) {
                                                                                if ($("#invstmnt_in_capitalmargin_rs").val() != "Crore") {
                                                                                    invstmnt_in_capitalmargin_ = invstmnt_in_capitalmargin_ / 100;
                                                                                }
                                                                            }
                                                                            var invstmnt_in_bankfinance_ = $('#invstmnt_in_bankfinance_' + id).val();
                                                                            if (isNaN(parseFloat(invstmnt_in_bankfinance_))) {
                                                                                invstmnt_in_bankfinance_ = 0.0;
                                                                            }
                                                                            if (invstmnt_in_bankfinance_ != 0.0) {
                                                                                if ($("#invstmnt_in_bankfinance_rs").val() != "Crore") {
                                                                                    invstmnt_in_bankfinance_ = invstmnt_in_bankfinance_ / 100;
                                                                                }
                                                                            }

                                                                            sum = (parseFloat(invstmnt_in_capitalmargin_) + parseFloat(invstmnt_in_bankfinance_)).toFixed(2);
                                                                            $("#totalCapitalBankFinance").val(sum);
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
                                                                        var it = $('#it' + id).val();
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
                                                                          
                                                                             $("#finalSub").click(function(){
                                                                              //  alert("hi"); 
                                                                             $(this).addClass('button-submit1');
                                                                               var replaceIt=$("#CafInvData").html();
                                                                               var res = replaceIt.replace("idsc=", "id=");
                                                                                $("#invConfirmation").html(res);
                                                                              $('#CafInvPopup').modal('show');
                                                                                $("#invConfirmation .form-section").css('font-weight', 'bold');
                                                                                $("#invConfirmation .form-section").css('font-size', '16px');
                                                                                $("#invConfirmation .form-section").css('border-bottom', '1px solid #e5e5e5');
                                                                                $("#invConfirmation .form-section").css('margin-bottom', '20px');
                                                                                $("#invConfirmation .form-section").css('padding', '10px');
                                                                              
                                                                            
                                                                               $("#invConfirmation").find('.form-control').each(function () {
                                                                                    $(this).attr("disabled", true);
                                                                                     $(this).removeAttr("id");
                                                                                });
                                                                            });
   $("#btn_submit_final").click(function () {
   
                    // start preloader
                    $( "#finalCAFSubmit2" ).submit();
                    // alert("hope you like it :)");
                    
                });
<?php
if ($document == 1) {
    ?>
                                                                            $('.btn_prev').css({
                                                                                display: 'inline-block'
                                                                            })
                                                                            $('.btn_continue').css({
                                                                                display: 'none'
                                                                            })
                                                                            $('.btn_submit').css({
                                                                                display: 'inline-block'
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
                                                                        });
                                                                     
                                                                    // Rahul Kumar 24062018
                                                                    $(document).ready(function () {
                                                                        // Hide all employment row while page load
                                                                        $(".emporg").find('td input').each(function () {
                                                                            $(this).css('border', 'none');
                                                                            $(this).css('text-align', 'center');
                                                                        });
                                                                        $(".emporg").hide();
                                                                        $(".diu").hide();
                                                                        $(".dios").hide();
                                                                        $(".difn").hide();
                                                                        $(".addEmployment").hide();
                                                                        // On change of categories Show relevent row of employemnt  
                                                                        $(".empfilter").change(function () {
                                                                            var domicile = $("#domicile").val();
                                                                            var empgender = $("#empgender").val();
                                                                            var empcaste = $("#empcaste").val();
                                                                            if (domicile !== '' && empgender !== '' && empcaste !== '') {
                                                                                $(".addEmployment").show();
                                                                                $("#empError").html("");
                                                                            }
                                                                        });

                                                                        $(".addEmploymentButton").click(function () {
                                                                            // alert("here");
                                                                            var flg = 0;
                                                                            var domicile = $("#domicile").val();
                                                                            var empgender = $("#empgender").val();
                                                                            var empcaste = $("#empcaste").val();
                                                                            if (domicile === '' || empgender === '' || empcaste === '') {
                                                                                //$("#empError").html("Please Fill Category Wise Employment Detail ");
                                                                            } else {
                                                                                // $("#empError").html("");
                                                                            }
                                                                            var domicile = $("#domicile").val();
                                                                            var empgender = $("#empgender").val();
                                                                            var empcaste = $("#empcaste").val();

                                                                            $("." + domicile).show();
                                                                            $("." + domicile + "_" + empgender + "_" + empcaste).show();
                                                                            var totalEmployment = 0;
                                                                            $("." + domicile + "_" + empgender + "_" + empcaste).find('td input').each(function (e) {

                                                                                var putValue = $(".indemp" + e).val();
                                                                                $(".indemp" + e).val("");
                                                                                if (isNaN(parseInt(putValue))) {
                                                                                    putValue = 0;
                                                                                }

                                                                                if (e == 0) {
                                                                                    // alert(e+ ""+putValue);
                                                                                    if (putValue > 0) {
                                                                                        flg = 1;
                                                                                    } else {

                                                                                    }
                                                                                }
                                                                                totalEmployment = parseInt(putValue) + parseInt(totalEmployment);
                                                                                if (e > 5) {
                                                                                    $(this).val(totalEmployment);

                                                                                    $.ajax({
                                                                                        type: 'POST',
                                                                                        url: '/backoffice/frontuser/home2/GetSectorData',
                                                                                        data: 'natureOfUnit=' + $('#ntrofunit').val(),
                                                                                        dataType: 'html'
                                                                                    })
                                                                                            .done(function (data) {
                                                                                                // show the response
                                                                                                console.log(data);

                                                                                                $('#dynamic-content').html(data);
                                                                                                // alert(flg);
                                                                                                if (flg == 1) {
                                                                                                    $('#addEmployeeSkill').modal({backdrop: 'static', keyboard: false});
                                                                                                    $('#addEmployeeSkill').modal('show');
                                                                                                }
                                                                                                var option = '<option value="">--Employment--</option>';
                                                                                                var domiciles = new Array();
                                                                                                $(".mskill,.fskill").each(function (e) {
                                                                                                    if ($(this).val() > 0)
                                                                                                    {
                                                                                                        var skillParent = $(this).attr('name');
                                                                                                        var gh = $(this).parent('td').parent('tr').find('td:eq(0)').html();
                                                                                                        var full = gh.split('<br>');
                                                                                                        domiciles = (full[0].trim() + ' ' + full[1].trim());
                                                                                                        option += '<option value="' + skillParent + '">' + domiciles + '</option>';
                                                                                                    }
                                                                                                });

                                                                                                $('#domicile_other_popup').html(option);

                                                                                            })
                                                                                            .fail(function () {
                                                                                                // just in case posting your form failed
                                                                                                alert("Posting failed.");

                                                                                            });

                                                                                } else {
                                                                                    $(this).val(putValue);
                                                                                    $(this).attr('readonly', 'readonly');
                                                                                }

                                                                            });

                                                                            $(".empfilter").val("");
                                                                            forall();
                                                                        });
                                                                        $('#addEmployeeSkill').on('shown.bs.modal', function () {
                                                                            $('.select2', this).select2();
                                                                        });
                                                                        // Total calculation of employement
                                                                        $(".emporg").find('td input').keyup(function () {
                                                                            var currClass = $(this).attr('rel');
                                                                            var eachFieldValueOfSameCategory = 0;
                                                                            $("." + currClass).each(function () {
                                                                                var tr = $(this).val();
                                                                                if (isNaN(parseInt(tr))) {
                                                                                    tr = 0;
                                                                                }
                                                                                eachFieldValueOfSameCategory = parseInt(eachFieldValueOfSameCategory) + parseInt(tr)
                                                                            }
                                                                            );
                                                                            $("." + currClass + "_total").val(eachFieldValueOfSameCategory);
                                                                            var empFLG = 0;
                                                                            $(".empTotal").each(function () {
                                                                                if ($(this).val() > 0) {
                                                                                    empFLG = 1;
                                                                                }
                                                                                //console.log('==='+$(this).val()+"----"+empFLG); 
                                                                            });
                                                                            if (empFLG == 0) {
                                                                                //$("#empError").html("Please Fill Category Wise Employment Detail ");

                                                                            } else {
                                                                                // $("#empError").html("");
                                                                            }
                                                                        }
                                                                        );
                                                                        // male skill
                                                                        $(".mskill").keyup(function () {
                                                                            updateEmploymentGrandTotal('mskill', 'mskl0');
                                                                            putValue('mskill', 'mskl0');
                                                                        }
                                                                        );
                                                                        // female skill
                                                                        $(".fskill").keyup(function () {
                                                                            updateEmploymentGrandTotal('fskill', 'fskl0');
                                                                            putValue('fskill', 'fskl0');
                                                                        }
                                                                        );
                                                                        // male  unskill
                                                                        $(".mUnskilled").keyup(function () {
                                                                            updateEmploymentGrandTotal('mUnskilled', 'munskl0');
                                                                            putValue('mUnskilled', 'munskl0');
                                                                        }
                                                                        );
                                                                        // female  unskill
                                                                        $(".fUnskilled").keyup(function () {
                                                                            updateEmploymentGrandTotal('fUnskilled', 'funskl0');
                                                                            putValue('fUnskilled', 'funskl0');
                                                                        }
                                                                        );
                                                                        // male skill
                                                                        $(".mSupervisory").keyup(function () {
                                                                            updateEmploymentGrandTotal('mSupervisory', 'msprvsr0');
                                                                            putValue('mSupervisory', 'msprvsr0');
                                                                        }
                                                                        );
                                                                        // female skill
                                                                        $(".fSupervisory").keyup(function () {
                                                                            updateEmploymentGrandTotal('fSupervisory', 'fsprvsr0');
                                                                            putValue('fSupervisory', 'fsprvsr0');
                                                                        }
                                                                        );
                                                                        // Male  Engineer
                                                                        $(".mEngineer").keyup(function () {
                                                                            updateEmploymentGrandTotal('mEngineer', 'mengg0');
                                                                            putValue('mEngineer', 'mengg0');
                                                                        }
                                                                        );
                                                                        // Female Engineer
                                                                        $(".fEngineer").keyup(function () {
                                                                            updateEmploymentGrandTotal('fEngineer', 'fengg0');
                                                                            putValue('fEngineer', 'fengg0');
                                                                        }
                                                                        );
                                                                        // Male  Professional
                                                                        $(".mProfessional").keyup(function () {
                                                                            updateEmploymentGrandTotal('mProfessional', 'mit0');
                                                                            putValue('mProfessional', 'mit0');
                                                                        }
                                                                        );
                                                                        // Female Professional
                                                                        $(".fProfessional").keyup(function () {
                                                                            updateEmploymentGrandTotal('fProfessional', 'fit0');
                                                                            putValue('fProfessional', 'fit0');
                                                                        }
                                                                        );
                                                                        // Male  Professional
                                                                        $(".mManagement").keyup(function () {
                                                                            updateEmploymentGrandTotal('mManagement', 'mmngmnt0');
                                                                            putValue('mManagement', 'mmngmnt0');
                                                                        }
                                                                        );
                                                                        // Female Professional
                                                                        $(".fManagement").keyup(function () {
                                                                            updateEmploymentGrandTotal('fManagement', 'fmngmnt0');
                                                                            putValue('fManagement', 'fmngmnt0');
                                                                        }
                                                                        );
                                                                        // EDIT MODE : Show hidden row if data already added 
                                                                        $(".emporg").find('td input').each(function () {
                                                                            if (isNaN(parseInt($(this).val()))) {
                                                                            } else {
                                                                                if ($(this).val() > 0) {
                                                                                    $(".diu").show();
                                                                                    $(".dios").show();
                                                                                    $(".difn").show();
                                                                                    $(this).closest('tr').show();
                                                                                }
                                                                            }
                                                                        }
                                                                        );
                                                                    });
                                                                    function updateEmploymentGrandTotal(allCls, grandTotalID) {
                                                                        var eachFieldValueOfSameCategory = 0;
                                                                        $("." + allCls).each(function () {
                                                                            var tr = $(this).val();
                                                                            if (isNaN(parseInt(tr))) {
                                                                                tr = 0;
                                                                            }
                                                                            eachFieldValueOfSameCategory = parseInt(eachFieldValueOfSameCategory) + parseInt(tr)
                                                                        }
                                                                        );
                                                                        $("#" + grandTotalID).val(eachFieldValueOfSameCategory);
                                                                        sumupEmp('0');
                                                                        fsumupEmp('0');
                                                                    }
                                                                    $(window).load(function () {
                                                                        var empFLG = 0;
                                                                        $(".empTotal").each(function () {

                                                                            if ($(this).val() > 0) {
                                                                                empFLG = 1;
                                                                            }
                                                                            console.log('===' + $(this).val() + "----" + empFLG);
                                                                        });
                                                                        if (empFLG == 0) {
                                                                            //$("#empError").html("Please Fill Category Wise Employment Detail ");
                                                                        }
                                                                        $(".diu").show();
                                                                    });

                                                                    $(".edit-emp").click(function () {
                                                                        if ($(this).html() == '<i class="fa fa-pencil"></i> Edit') {
                                                                            $(this).html('<i class="fa fa-floppy-o"></i> Save');
                                                                            $(this).attr('rel', 'save');
                                                                            var yu = $(this).closest('tr');
                                                                            yu.find('td input').each(function () {
                                                                                $(this).css('border', '1px solid #e5e5e5');
                                                                                $(this).removeAttr('readonly');
                                                                            });
                                                                        } else {
                                                                            $(this).attr('rel', '');
                                                                            $(this).html('<i class="fa fa-pencil"></i> Edit');
                                                                            var yu = $(this).closest('tr');
                                                                            yu.find('td input').each(function () {
                                                                                $(this).css('border', 'none');
                                                                                $(this).attr('readonly', 'readonly');
                                                                            });
                                                                        }

                                                                    });
                                                                    $(".delete-emp").click(function () {
                                                                        var ui = confirm('Are you sure that you want to delete the Employment Data, deleting this will also delete the entries done of Skilled Manpower Requirements row too.');
                                                                        if (ui === true) {
                                                                            var yu = $(this).closest('tr');
                                                                            var name = yu.find('td:nth-child(2) input').attr('name');
                                                                            yu.find('td input').each(function () {
                                                                                $("." + name + '_tr').remove();
                                                                                $(this).val("");
                                                                            });
                                                                            yu.hide();
                                                                            forall();
                                                                        }
                                                                    });

                                                                    function forall() {
                                                                        putValue('mskill', 'mskl0');
                                                                        putValue('mUnskilled', 'munskl0');
                                                                        putValue('mSupervisory', 'msprvsr0');
                                                                        putValue('mEngineer', 'mengg0');
                                                                        putValue('mProfessional', 'mit0');
                                                                        putValue('mManagement', 'mmngmnt0');
                                                                        putValue('empTotal', 'memptotal0');
                                                                        putValue('fskill', 'fskl0');
                                                                        putValue('fUnskilled', 'funskl0');
                                                                        putValue('fSupervisory', 'fsprvsr0');
                                                                        putValue('fEngineer', 'fengg0');
                                                                        putValue('fProfessional', 'fit0');
                                                                        putValue('fManagement', 'fmngmnt0');
                                                                        putValue('fempTotal', 'femptotal0');
                                                                    }
                                                                    function putValue(from, to) {
                                                                        var overAll = 0;
                                                                        $("." + from).each(function () {
                                                                            var curr = $(this).val();
                                                                            if (isNaN(parseInt(curr))) {
                                                                                curr = 0;
                                                                            }
                                                                            overAll = parseInt(overAll) + parseInt(curr);
                                                                        });
                                                                        $("#" + to).val(overAll);
                                                                        var totalEmployeeMaleFemale = parseInt($('#memptotal0').val()) + parseInt($("#femptotal0").val());
                                                                        if (totalEmployeeMaleFemale > 0) {
                                                                            $('#emp_fmtotal1').val(totalEmployeeMaleFemale);
                                                                        } else {
                                                                            $('#emp_fmtotal1').val("");
                                                                        }
                                                                    }

//--------------Add Skill for proposed employement js ----------------------------------------------------
                                                                    $(".add-skill").click(function () {
                                                                        $.ajax({
                                                                            type: 'POST',
                                                                            url: '/backoffice/frontuser/home2/GetSectorData',
                                                                            data: 'natureOfUnit=' + $('#ntrofunit').val(),
                                                                            dataType: 'html'
                                                                        })
                                                                                .done(function (data) {
                                                                                    // show the response
                                                                                    console.log(data);

                                                                                    $('#dynamic-content').html(data);
                                                                                    $('#addEmployeeSkill').modal({backdrop: 'static', keyboard: false});
                                                                                    //$('.select2-me', this).chosen({width: "350px"});
                                                                                    $('#addEmployeeSkill').modal('show');

                                                                                    var option = '<option value="">--Employment--</option>';
                                                                                    var domiciles = new Array();
                                                                                    $(".mskill,.fskill").each(function (e) {
                                                                                        if ($(this).val() > 0)
                                                                                        {
                                                                                            var skillParent = $(this).attr('name');
                                                                                            var gh = $(this).parent('td').parent('tr').find('td:eq(0)').html();
                                                                                            var full = gh.split('<br>');
                                                                                            domiciles = (full[0].trim() + ' ' + full[1].trim());
                                                                                            option += '<option value="' + skillParent + '">' + domiciles + '</option>';
                                                                                        }
                                                                                    });

                                                                                    $('#domicile_other_popup').html(option);

                                                                                })
                                                                                .fail(function () {
                                                                                    // just in case posting your form failed
                                                                                    alert("Posting failed.");

                                                                                });
                                                                    });
                                                                    $(".edit_emp_skill").click(function () {
                                                                        if ($(this).html() == '<i class="fa fa-pencil"></i> Edit') {
                                                                            $(this).html('<i class="fa fa-floppy-o"></i> Save');
                                                                            $(this).attr('rel', 'save');
                                                                            var yu = $(this).closest('tr');
                                                                            yu.find('td:nth-child(5) input').each(function () {
                                                                                $(this).css('border', '1px solid #e5e5e5');
                                                                                $(this).removeAttr('readonly');
                                                                            });
                                                                        } else {
                                                                            $(this).attr('rel', '');
                                                                            $(this).html('<i class="fa fa-pencil"></i> Edit');
                                                                            var yu = $(this).closest('tr');
                                                                            yu.find('td input').each(function () {
                                                                                $(this).css('border', 'none');
                                                                                $(this).attr('readonly', 'readonly');
                                                                            });

                                                                        }
                                                                    });
                                                                    $(document).ready(function () {
                                                                        $(document).on("click", ".modelclose", function () {
                                                                            $("#errorpop_up").html('');
                                                                            if ($("table.skills_tablepopup tbody tr").length > 0)
                                                                            {
                                                                                var parentSkillKey = $("#skilled_total").attr('rel');
                                                                                var skillMainTotal = $("input[name=" + parentSkillKey + "]").val();
                                                                                var add = 0;
                                                                                $("." + parentSkillKey).each(function () {
                                                                                    add = add + parseInt($(this).val());
                                                                                });

                                                                                var skillGrandTotal = add;
                                                                                if (skillGrandTotal > skillMainTotal)
                                                                                {
                                                                                    $("#errorpop_up").html('Category wise skilled resource value can not be greater than proposed employment details, in case if you want to increase the Skill resource information then please update the employment information of respective category first.');
                                                                                    return false;
                                                                                } else
                                                                                if (skillGrandTotal < skillMainTotal)
                                                                                {
                                                                                    $("#errorpop_up").html('Category wise skilled resource value can not be less than proposed employment details, in case if you want to decrease the Skill resource information then please update the employment information of respective category first.');
                                                                                } else {
                                                                                    var content = $('.skills_tablepopup tbody').html();
                                                                                    $('.skills_tablepopup tbody').remove('');
                                                                                    $(".skills_tablepopup2").show();
                                                                                    $(".skills_tablepopup2 tbody").append(content);
                                                                                    $('#addEmployeeSkill').modal('hide');

                                                                                }
                                                                            } else {
                                                                                $('#addEmployeeSkill').modal('hide');
                                                                            }
                                                                        });
                                                                    });


                                                                    $(".delete_emp_skill").click(function () {
                                                                        var ui = confirm('Are you sure that you want to delete this entry');
                                                                        if (ui === true) {
                                                                            var yu = $(this).closest('tr');
                                                                            yu.remove();
                                                                        }
                                                                    });

                                                                                
                                                                               
                                                                    $(document).ready(function () {

                                       
                                                                        var grandTotal = 0;
                                                                        var Total = 0;
                                                                        $(document).on("blur", ".skilltotal", function () {

                                                                            var rel_id = $(this).attr('rel');

                                                                            $("." + rel_id).each(function () {
                                                                                grandTotal = parseInt(grandTotal) + parseInt($(this).val());
                                                                                Total = $("input[name='" + rel_id + "']").val();
                                                                            });

                                                                            if (grandTotal < Total)
                                                                            {
                                                                                alert('Category wise skilled resource value can not be less than proposed employment details, in case if you want to decrease the Skill resource information then please update the employment information of respective category first.');
                                                                            }
                                                                            if (grandTotal > Total)
                                                                            {
                                                                                alert('Category wise skilled resource value can not be greater than proposed employment details, in case if you want to increase the Skill resource information then please update the employment information of respective category first.');
                                                                                return false;
                                                                            }
                                                                        });
                                                                    });


                                                                    $(document).on('change', '#nature_unit_popup', function () {
                                                                        $.ajax({
                                                                            type: 'POST',
                                                                            url: '/backoffice/frontuser/home2/GetSectorData2',
                                                                            data: 'nature_unit_popupdata=' + $(this).val(),
                                                                            dataType: 'html'
                                                                        })
                                                                                .done(function (data) {
                                                                                    $("#sector_popup").html(data);
                                                                                })
                                                                                .fail(function (data) {
                                                                                    alert("Posting failed.");
                                                                                })
                                                                    });

                                                                    $(document).on('change', '#sector_popup', function () {
                                                                        $.ajax({
                                                                            type: 'POST',
                                                                            url: '/backoffice/frontuser/home2/GetSkillsData3',
                                                                            data: 'sector_popupdata=' + encodeURIComponent($(this).val()),
                                                                            dataType: 'html'
                                                                        })
                                                                                .done(function (data) {
                                                                                    $("#skill_popup").html(data);
                                                                                })
                                                                                .fail(function (data) {
                                                                                    alert("Posting failed.");
                                                                                })
                                                                    });

                                                                    $(document).on('click', "#skill-add-more", function () {
                                                                        $("#errorpop_up").html('');
                                                                        var flag = 0;
                                                                        var parentSkillKey = $("#domicile_other_popup").val();
                                                                        $(".skilled_sector_" + parentSkillKey).each(function () {
                                                                            /* alert($(this).val());
                                                                             alert($("#sector_popup").val()); */
                                                                            var sector = $(this).val();
                                                                            var sector2 = $("#sector_popup").val();
                                                                            if (sector == sector2)
                                                                            {
                                                                                flag = 1;
                                                                            }
                                                                        });

                                                                        if (parentSkillKey != '') {
                                                                            var skillMainTotal = $("input[name=" + parentSkillKey + "]").val();

                                                                            skillGrandTotal = 0;
                                                                            var skillTotal2 = $("." + parentSkillKey).val();

                                                                            if (skillTotal2 != '' && skillTotal2 != undefined)
                                                                            {
                                                                                var add = 0;
                                                                                $("." + parentSkillKey).each(function () {
                                                                                    add = add + parseInt($(this).val());
                                                                                });

                                                                                var skillGrandTotal = parseInt($("#skilltotal_popup").val()) + add;
                                                                            } else {

                                                                                var skillGrandTotal = parseInt($("#skilltotal_popup").val());
                                                                            }

                                                                            if (skillGrandTotal > skillMainTotal)
                                                                            {
                                                                                $("#errorpop_up").html('Category wise skilled resource value can not be greater than proposed employment details, in case if you want to increase the Skill resource information then please update the employment information of respective category first.');
                                                                                return false;
                                                                            }
                                                                            if (skillGrandTotal < skillMainTotal)
                                                                            {
                                                                                $("#errorpop_up").html('Category wise skilled resource value can not be less than proposed employment details, in case if you want to decrease the Skill resource information then please update the employment information of respective category first.');
                                                                            }
                                                                            if (flag == 1)
                                                                            {
                                                                                $("#errorpop_up").html('You have already added skill for this sector please select another.');
                                                                                return false;
                                                                            }
                                                                        }

                                                                        var domicile_other_popupval = $("#domicile_other_popup").val();
                                                                        var domicile_other_popup = $("#domicile_other_popup option:selected").text();
                                                                        var nature_unit_popup = $("#nature_unit_popup").val();
                                                                        var sector_popup = $("#sector_popup").val();
                                                                        var skill_popup = $("#skill_popup").val();
                                                                        var skilltotal_popup = $("#skilltotal_popup").val();

                                                                        if (domicile_other_popupval == '' || domicile_other_popupval == undefined)
                                                                        {
                                                                            $("#domicile_other_popup").prop('required', true);
                                                                            $("#domicile_other_popup").parent('div').addClass('has-error');
                                                                        } else if (nature_unit_popup == '' || nature_unit_popup == undefined)
                                                                        {
                                                                            $("#nature_unit_popup").prop('required', true);
                                                                            $("#nature_unit_popup").parent('div').addClass('has-error');
                                                                        } else if (sector_popup == '' || sector_popup == undefined)
                                                                        {
                                                                            $("#sector_popup").prop('required', true);
                                                                            $("#sector_popup").parent('div').addClass('has-error');
                                                                        } else if (skill_popup == '' || skill_popup == undefined)
                                                                        {
                                                                            $("#skill_popup").prop('required', true);
                                                                            $("#skill_popup").parent('div').addClass('has-error');
                                                                        } else if (skilltotal_popup == '' || skilltotal_popup == undefined)
                                                                        {
                                                                            $("#skilltotal_popup").prop('required', true);
                                                                            $("#skilltotal_popup").parent('div').addClass('has-error');
                                                                        } else {
                                                                            $("#domicile_other_popup").prop('required', false);
                                                                            $("#domicile_other_popup").parent('div').removeClass('has-error');

                                                                            $("#nature_unit_popup").prop('required', false);
                                                                            $("#nature_unit_popup").parent('div').removeClass('has-error');

                                                                            $("#sector_popup").prop('required', false);
                                                                            $("#sector_popup").parent('div').removeClass('has-error');

                                                                            $("#skill_popup").prop('required', false);
                                                                            $("#skill_popup").parent('div').removeClass('has-error');

                                                                            $("#skilltotal_popup").prop('required', false);
                                                                            $("#skilltotal_popup").parent('div').removeClass('has-error');

                                                                            $(".skills_tablepopup").show();

                                                                            var trlen1 = $('.skills_tablepopup tbody tr').length;
                                                                            if (("<?php echo count(@$skillarray) ?>") > 0) {
                                                                                var trlen = parseInt('<?php echo count(@$skillarray) ?>') + parseInt(trlen1);
                                                                            } else {
                                                                                var trlen = trlen1;
                                                                            }

                                                                            var rows = "<tr>"
                                                                                    + "<td><input type='text' id='skilled_employement' name='skill_data[" + trlen + "][" + parentSkillKey + "][skilled_employement]' value='" + domicile_other_popup + "' class='form-control' readonly /></td>"
                                                                                    + "<td><input type='text' id='skilled_natureunit' name='skill_data[" + trlen + "][" + parentSkillKey + "][skilled_natureunit]' value='" + nature_unit_popup + "' class='form-control' readonly/></td>"
                                                                                    + "<td class='sector'><input type='text' class='form-control skilled_sector_" + parentSkillKey + "' id='skilled_sector' name='skill_data[" + trlen + "][" + parentSkillKey + "][skilled_sector]' value='" + sector_popup + "' readonly /></td>"
                                                                                    + "<td><input type='text' id='skilled_name' name='skill_data[" + trlen + "][" + parentSkillKey + "][skilled_name]' value='" + skill_popup + "' class='form-control' readonly /></td>"
                                                                                    + "<td style='text-align:center;'><input type='text' id='skilled_total' name='skill_data[" + trlen + "][" + parentSkillKey + "][skilled_total]' value=" + skilltotal_popup + " class='" + parentSkillKey + " skilltotal form-control' readonly rel='" + parentSkillKey + "'/></td>"
                                                                                    + "</tr>";


                                                                            $('.skills_tablepopup tbody').append(rows);

                                                                            $("#domicile_other_popup").val('');
                                                                            $("#nature_unit_popup").val('');
                                                                            $("#sector_popup").val('');
                                                                            $('#sector_popup').select2();
                                                                            //$("#sector_popup").selectpicker("refresh");			
                                                                            $("#skill_popup").val('');
                                                                            $('#skill_popup').select2();
                                                                            $("#skilltotal_popup").val('');
                                                                        }
                                                                    });

</script>
<div id="addEmployeeSkill" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80% !important;margin:auto;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close modelclose">&times;</button>
                <h4 class="modal-title">Skills Data</h4>
                <span style="color:red;font-size:14px;" id="errorpop_up"></span>	
            </div>
            <div class="modal-body">			
                <div class="copy after-add-more" id="dynamic-content">
                    <!----Content--->
                </div>
                <div>
                    <div class="modal-footer">&nbsp;					
                        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>







<div id="CafInvPopup" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:80%" >
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background-color: #3996bd; color:#fff;font-size:17px">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="background-color: #3996bd;color:#fff;font-size:17px">You are submitting bellow given Investment detail</h4>
            </div>
            <div class="modal-body" id="invConfirmation">			

            </div>
            <div>
                <div class="modal-footer">&nbsp;	
                     <form action="<?= Yii::app()->createAbsoluteUrl('frontuser/home/submitCafApplication') ?>" style="display: inline" id="finalCAFSubmit2" method="post">
                                            <input type="hidden" class="csrftoken" name="YII_CSRF_TOKEN_SUBMIT" value="<?= Yii::app()->getRequest()->getCsrfToken() ?>" />

                                            <?php if ($flg1 > 2) { ?>      <button type="submit" class="btn btn-success" id="btn_submit_final2" >Ok, Submit</button><?php } ?>
                                        </form>
                  
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
</div>

<div id="loading-mask"></div>