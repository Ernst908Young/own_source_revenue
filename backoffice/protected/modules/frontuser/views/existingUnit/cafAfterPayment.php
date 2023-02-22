<?php extract(@$pre_field); ?><link href="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" /><link href="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" /><style type="text/css">  .portlet.light .form .form-body, .portlet.light .portlet-form .form-body{      padding: 20px;  }  .form-horizontal .form-group.form-md-line-input{    margin: 0px 0px 0px 0px;  }  .form-horizontal .form-group{   margin-left: 2px;  }  .help-block{   left: 25px;   top: 20px;   position: absolute;  }</style><div class="page-bar">    <ul class="page-breadcrumb">        <li>            <a href="index.html">Home</a>            <i class="fa fa-circle"></i>        </li>        <li>            <span>Registration Of Existing Unit: Common Application Form </span>        </li>    </ul></div><div class="row">    <div class="col-md-12">        <div class="m-heading-1  border-green m-bordered">            <h3>Registration Of Existing Unit: Common Application Form</h3>            <p> </p>        </div>        <div class="portlet light bordered" id="form_wizard_1">            <div class="portlet-title">                <div class="caption">                    <i class=" icon-layers font-red"></i>                    <span class="caption-subject font-red bold uppercase">Fields With * are Mandtory  -                        <span class="step-title"> Step 5 of 5 </span>                    </span>                </div>                <div class="actions">                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">                        <i class="icon-cloud-upload"></i>                    </a>                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">                        <i class="icon-wrench"></i>                    </a>                    <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">                        <i class="icon-trash"></i>                    </a>                </div>            </div>            <div class="portlet-body form">                <form class="form-horizontal caf_form_submission_wizard" action="<?=Yii::app()->createAbsoluteUrl('frontuser/existing/forwardToDepartment')?>" id="submit_form" method="POST">                    <input type="hidden" class="csrftoken" name="YII_CSRF_TOKEN" value="<?=Yii::app()->getRequest()->getCsrfToken()?>" />                    <input type="hidden" class="csrftoken" name="application_id" value="<?=@$app_sub_id?>" />                    <div class="form-wizard">                        <div class="form-body">                            <ul class="nav nav-pills nav-justified steps">                                <li class="done">                                    <a href="#tab1" data-toggle="tab" class="step">                                        <span class="number"> 1 </span>                                        <span class="desc">                                            <i class="fa fa-check"></i> Enterprise Detail </span>                                    </a>                                </li>                                <li class="done">                                    <a href="#tab2" data-toggle="tab" class="step">                                        <span class="number"> 2 </span>                                        <span class="desc">                                            <i class="fa fa-check"></i> Investment Detail </span>                                    </a>                                </li>                                <li class="done">                                    <a href="#tab3" data-toggle="tab" class="step">                                        <span class="number"> 3 </span>                                        <span class="desc">                                            <i class="fa fa-check"></i> Factors of Production  </span>                                    </a>                                </li>								 <li class="done">                                    <a href="#tab4" data-toggle="tab" class="step">                                        <span class="number"> 4 </span>                                        <span class="desc">                                            <i class="fa fa-check"></i> Existing Registration Details  </span>                                    </a>                                </li>                                <li class="active">                                    <a href="#tab5" data-toggle="tab" class="step">                                        <span class="number"> 5 </span>                                        <span class="desc">                                            <i class="fa fa-check"></i> Checklist </span>                                    </a>                                </li>                            </ul>                            <div id="bar" class="progress progress-striped" role="progressbar">                            <div class="progress-bar progress-bar-success"> </div>                            </div>                            <div class="tab-content">                                <div class="alert alert-danger alert-message-error display-none">                                    <button class="close" data-dismiss="alert"></button> You have some form errors. Please check below. </div>                                <div class="alert alert-success alert-message-success display-none">                                    <button class="close" data-dismiss="alert"></button> Your form validation is successful!                               </div>                               <?php                                   foreach(Yii::app()->user->getFlashes() as $key => $message) {                                        echo '<div class="alert alert-success"><button class="close" data-dismiss="alert"></button>                                                ' . $message .                                               '</div>';                                        }                                  ?>                               <div class="tab-pane" id="tab1">                               </div>                               <div class="tab-pane" id="tab2">                               </div>                               <div class="tab-pane" id="tab3">                               </div>							   <div class="tab-pane" id="tab4">                               </div>                               <div class="tab-pane active" id="tab5">                                    <!--<h3 class="block">Declaration</h3>-->                                    <div class="portlet box green">                                        <div class="portlet-title">                                            <div class="caption">                                                <i class="fa fa-gift"></i>Registration of Existing Unit Application -Step 6 </div>                                            <div class="tools">                                                <a href="javascript:;" class="collapse"> </a>                                                <a href="javascript:;" class="reload"> </a>                                            </div>                                        </div>                                        <div class="portlet-body form">                                            <!-- BEGIN FORM-->                                                <div class="form-body">                                                    <?php                                                                                                           if($statusCode=='S'){ ?>                                                     <h3 class="form-section">DECLARATION</h3>                                                     <div class="row">                                                       <div class="col-md-12">                                                           <p>                                                              I, <b> <?=@$first_name." ".@$last_name?> </b> (<b> <?=@$incmplt_fields->auth_designation?> </b> ) of M/s <b><span class='declaration_company'><?=@$incmplt_fields->company_name?></span></b>  having Regd. office at <b><span class='declaration_Ofc_add'><?=@$incmplt_fields->Address?></b></span>                                                               hereby declare that the information furnished by me/us to Directorate of Industries, Govt. of Uttarakhand, by our firm/enterprise in this Application Form for Directorate of Industries, Govt. of Uttarakhand are true to the best of my knowledge, belief and is based on the company/firm  records. I/We indemnify the above agencies or any other agency under the jurisdiction of Govt. of Uttarakhand from liabilities of any nature that may arise due to the decision taken based on the information contained in this application form which may be inadequate, inaccurate, erroneous etc. and the management of my firm/enterprise assumes complete responsibility in this regard.                                                           </p>                                                           <p>Further, our firm/enterprise undertakes to provide any additional information or clarification as required by Directorate of Industries, Govt. of Uttarakhand or its agencies during and after processing of our application.                                                           </p>                                                           <p>                                                              I/We undertake to pay the fees/charges payable to Directorate of Industries, Govt. of Uttarakhand and its agencies as prescribed under the policy for according approval and charges fixed for water, energy, etc. and other charges fixed by the Govt. of Uttarakhand from time to time.                                                           </p>                                                           <p> I/We understand that this approval through Directorate of Industries, Govt. of Uttarakhand is to assist our firm/enterprise in getting statutory clearances expeditiously. I/We indemnify Directorate of Industries, Govt. of Uttarakhand and its agencies from any liabilities whatsoever.                                                           </p>                                                           <p>Place<b> <?=@$city_name?>  </b><br>                                                              Date: <b><?php echo date('Y-m-d');?> </b>                                                           </p>                                                        </div>                                                     </div>                                                     <!-- /row -->                                                      <div class="form-group">                                                        <div class="md-checkbox ">                                                            <input type="checkbox" id="checkbox10" name="iAgree" required class="md-check" >                                                            <label for="checkbox10">                                                                <span></span>                                                                <span class="check"></span>                                                                <span class="box"></span> I Accept                                                           </label>                                                              <span class="help-block"></span>                                                           </div>                                                        </div>                                                </div>                                        </div>                                    </div>                               </div>                            </div>                        </div>                        <div class="form-actions">                            <div class="row">                                <div class="col-md-offset-3 col-md-9">                                     <button type="submit" class="btn green button-submit btn_submit"> Submit                                        <i class="fa fa-check"></i>                                    </button>                                     <?php } ?>                                    </form>                                </div>                            </div>                        </div>                    </div>                </form>            </div>        </div>    </div></div><!-- BEGIN PAGE LEVEL PLUGINS --><script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script><script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script><script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script><script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js" type="text/javascript"></script><!-- END PAGE LEVEL PLUGINS --><!-- BEGIN PAGE LEVEL SCRIPTS --><script src="<?=Yii::app()->theme->baseUrl?>/assets/pages/scripts/form-wizard.min.js" type="text/javascript"></script><!-- form repeater js --><script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/jquery-repeater/jquery.repeater.js" type="text/javascript"></script><script src="<?=Yii::app()->theme->baseUrl?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script><script src="<?=Yii::app()->theme->baseUrl?>/assets/pages/scripts/form-repeater.min.js" type="text/javascript"></script><script type="text/javascript">   $("document").ready(function(){      $('.btn_submit').css({          display:'inline-block'      })   })</script>