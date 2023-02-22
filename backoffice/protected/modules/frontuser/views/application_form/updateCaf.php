<style type="text/css">
   #heading{
   background-color: #006699;
   text-align: center;
   color:#fff;
   padding-top: 7px;
   padding-bottom: 7px;
   margin-bottom: 20px;
   }
   @media (min-width: 992px){
   .no_of_invest .col-md-2{
   width: 14.2%;     
   }
   }
   @media (min-width: 992px){
   .no_of_emp .col-md-2{
   width: 12.2%;     
   }
   }
   @media (min-width: 992px){
   .mean_fin .col-md-2{
   width: 14.2%;     
   }
   }
   .control-label{
   font-size: 0.6em;
   font-weight: 800;
   height: 20px;
   text-align: left;
   }
   ::-webkit-input-placeholder { font-size:.9em;font-weight: bold }
   ::-moz-placeholder { font-size:.9em; font-weight: bold}
   :-ms-input-placeholder { font-size:.9em; font-weight: bold}
   input:-moz-placeholder { font-size:.9em; font-weight: bold}
</style>
<?php extract(@$pre_field);
   // extract(@$incmplt_fields);
   ?>
<div class="site-min-height">
   <!-- page start-->
   <div class="row">
      <div class="col-lg-1"></div>
      <div class="col-lg-10">
         <section class="panel">
            <header class="panel-heading">
               CAF Form Filling
               <?php 
               foreach(Yii::app()->user->getFlashes() as $key => $message) {
               echo '<font color="red"><div class="alert-message error"><p>' . $message . "</font></p></div>\n";
               }
               ?>
               <i class="pull-right alert-danger">&nbsp;&nbsp;Fields With * are Required&nbsp;&nbsp;</i>
            </header>
            <div class="panel-body">
               <div class="stepy-tab">
                  <ul id="default-titles" class="stepy-titles clearfix">
                     <li id="default-title-0" class="current-step">
                        <div>Step 1</div>
                     </li>
                     <li id="default-title-1" class="">
                        <div>Step 2</div>
                     </li>
                     <li id="default-title-2" class="">
                        <div>Step 3</div>
                     </li>
                     <li id="default-title-3" class="">
                        <div>Step 4</div>
                     </li>
                  </ul>
               </div>
               <input type="hidden" value="<?php echo Yii::app()->createAbsoluteUrl('/frontuser/home/cafForm');?>" id='caf_form_url'>
               <form enctype='multipart/form-data' action="<?php echo Yii::app()->createAbsoluteUrl('/frontuser/home/cafFormFinish');?>" method="post" id="default"  width="500px"class="horizontal-form caf_form_submission_wizard" >
                  
                  <fieldset title="Step1" class="step" id="default-step-0">
                     <legend style="display:none">Company Details</legend>
                     <div id="heading">Company Details Part A</div>
                     <div class="row">
                        <div class="col-xs-8 col-sm-6">
                           <div class="form-group">
                              <input type="text"  id="IUID" class="form-control" name='IUID' value="<?=@$iuid?>" readonly placeholder="IUID">
                           </div>
                        </div>
                        <div class="col-xs-4 col-sm-6">
                           <div class="form-group">
                              <input type="text"  id="company_name" class="form-control" value="<?=@$incmplt_fields->company_name?>" name="company_name" placeholder="*  Name of the Company / Unit">
                              <i class="error"></i>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-xs-8 col-sm-6">
                           <div class="form-group">
                              <textarea  id="Address" class="form-control" name="Address" placeholder="*  Correspondence Address"><?=@$incmplt_fields->Address?></textarea>
                              <i class="error"></i>
                           </div>
                        </div>
                        <div class="col-xs-8 col-sm-6">
                           <div class="form-group">
                              <input type="text"  id="pin_code" class="form-control"  value="<?=@$incmplt_fields->pin_code?>"  name="pin_code" placeholder="*  Pin Code">
                              <i class="error"></i>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-xs-4 col-sm-6">
                           <div class="form-group">
                              <input type="text"  id="mob_number" class="form-control"  value="<?=@$incmplt_fields->mob_number?>"  name="mob_number" placeholder="Mobile Number">
                              <i class="error"></i>
                           </div>
                        </div>
                        <div class="col-xs-4 col-sm-6">
                           <div class="form-group">
                              <input type="text"  id="tel_phone" class="form-control" value="<?=@$incmplt_fields->tel_phone?>"  name="tel_phone" placeholder="*  Telephone Number">
                              <i class="error"></i>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-xs-8 col-sm-6">
                           <div class="form-group">
                              <input type="text"  id="email" class="form-control"  value="<?=@$incmplt_fields->email?>"  name="email" placeholder="*  Email">
                              <i class="error"></i>
                           </div>
                        </div>
                        <div class="col-xs-4 col-sm-6">
                           <div class="form-group">
                              <input type="text"  id="fax" class="form-control" value="<?=@$incmplt_fields->fax?>"  name="fax" placeholder="Fax">
                              <i class="error"></i>
                           </div>
                        </div>
                     </div>
                     <div id="heading">Details of M.D/Managing Partner/CEO / Lead   Promoter/ Proprietor</div>
                     <div class="row">
                        <div class="col-xs-8 col-sm-6">
                           <div class="form-group">
                              <input type="text"  id="md_name" class="form-control"  value="<?=@$incmplt_fields->md_name?>" name="md_name" placeholder="*  Name of the M.D/Managing Partner/CEO /Lead Promoter/Proprietor">
                              <i class="error"></i>
                           </div>
                        </div>
                        <div class="col-xs-4 col-sm-6">
                           <div class="form-group"> 
                              <input type="text"  id="md_email" class="form-control" value="<?=@$incmplt_fields->md_email?>"  name="md_email" placeholder="*  Email">
                              <i class="error"></i>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-xs-8 col-sm-6">
                           <div class="form-group">
                              <input type="text"  id="md_mob" class="form-control"  value="<?=@$incmplt_fields->md_mob?>" name="md_mob" placeholder="Mobile Number">
                              <i class="error"></i>
                           </div>
                        </div>
                        <div class="col-xs-4 col-sm-6">
                           <div class="form-group">
                              <input type="text"  id="md_tel" class="form-control"  value="<?=@$incmplt_fields->md_tel?>" name="md_tel" placeholder="Telephone Number">
                              <i class="error"></i>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-xs-4 col-sm-6">
                           <div class="form-group">
                              <input type="text"  id="md_fax" class="form-control"  value="<?=@$incmplt_fields->md_fax?>" name="md_fax" placeholder="FAX">
                              <i class="error"></i>
                           </div>
                        </div>
                        <div class="col-xs-8 col-sm-6">
                           <div class="form-group">
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
                              <i class="error"></i>
                           </div>
                        </div>
                     </div>
                     <div id="heading">Details of Authorized Coordinator/Person</div>
                     <div class="row">
                        <div class="col-xs-8 col-sm-6">
                           <div class="form-group">
                              <input type="text"  id="auth_name" class="form-control" name="auth_name"  value="<?=@$first_name." ".@$last_name?>" readonly placeholder="Name of Authorized Coordinator/Person">
                              <i class="error"></i>
                           </div>
                        </div>
                        <div class="col-xs-8 col-sm-6">
                           <div class="form-group">
                              <input type="text"  id="auth_designation" class="form-control" value="<?=@$incmplt_fields->auth_designation?>" name="auth_designation" placeholder="*  Designation">
                              <i class="error"></i>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-xs-4 col-sm-6">
                           <div class="form-group">
                              <input type="text"  id="auth_email" class="form-control" value="<?=@$email?>" readonly name="auth_email" placeholder="Email">
                              <i class="error"></i>
                           </div>
                        </div>
                        <div class="col-xs-8 col-sm-6">
                           <div class="form-group">
                              <input type="text"  id="auth_mob" class="form-control" value="<?=@$mobile_number?>" readonly name="auth_mob" placeholder="Mobile Number">
                              <i class="error"></i>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-xs-4 col-sm-6">
                           <div class="form-group">
                              <input type="text"  id="auth_tel" class="form-control"value="<?=@$incmplt_fields->auth_tel?>" name="auth_tel" placeholder="Telephone Number">
                              <i class="error"></i>
                           </div>
                        </div>
                        <div class="col-xs-8 col-sm-6">
                           <div class="form-group">
                              <input type="text"  id="auth_fax" class="form-control" value="<?=@$incmplt_fields->auth_fax?>" name="auth_fax" placeholder="Fax Number">
                              <i class="error"></i>
                           </div>
                        </div>
                     </div>
                     <!--    <div id="heading">&nbsp;</div>
                        <div class="row">
                           <div class="col-xs-8 col-sm-6">
                              <div class="form-group">
                                 <input type="text"  id="fname" class="form-control" name="First Name" placeholder="Processing Fees">
                              </div>
                           </div>
                           <div class="col-xs-4 col-sm-6">
                              <div class="form-group">
                                 <input type="text"  id="lname" class="form-control" name="Last Name" placeholder="Amount">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-xs-8 col-sm-6">
                              <div class="form-group">
                                 <input type="date"  id="fname" class="form-control" name="First Name" placeholder="Date">
                              </div>
                           </div>
                           <div class="col-xs-4 col-sm-6">
                              <div class="form-group">
                                 <input type="text"  id="lname" class="form-control" name="Last Name" placeholder="Transaction /Receipt ID">
                              </div>
                           </div>
                        </div> -->
                     <div id="heading"> Financial Indicators of the Company / Firm for Last 3 Years in Rs. Crores (if any)</div>
                     <div class="row">
                        <div class="col-md-2">
                           <div class="form-group">
                              <input type="text"  id="fnc_year1" class="form-control" value="<?=@$incmplt_fields->fnc_year[0]?>" name="fnc_year[]" placeholder="Year">
                              <i class="error"></i>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <input type="text"  id="fnc_turnover1" class="form-control" value="<?=@$incmplt_fields->fnc_turnover[0]?>" name="fnc_turnover[]" placeholder="Turn Over">
                              <i class="error"></i>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <input type="text"  id="fnc_prftBfrTax1" class="form-control" value="<?=@$incmplt_fields->fnc_prftBfrTax[0]?>" name="fnc_prftBfrTax[]" placeholder="Profit before Tax">
                              <i class="error"></i>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <input type="text"  id="fnc_netWrth1" class="form-control" value="<?=@$incmplt_fields->fnc_netWrth[0]?>" name="fnc_netWrth[]" placeholder="Net Worth">
                              <i class="error"></i>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <input type="text"  id="fnc_rsrvSrpls1" class="form-control" value="<?=@$incmplt_fields->fnc_rsrvSrpls[0]?>" name="fnc_rsrvSrpls[]" placeholder="Reserves & Surplus">
                              <i class="error"></i>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <input type="text"  id="fnc_sharCaps1" class="form-control" value="<?=@$incmplt_fields->fnc_sharCaps[0]?>" name="fnc_sharCaps[]" placeholder="Share Capital">
                              <i class="error"></i>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-2">
                           <div class="form-group">
                              <input type="text"  id="fnc_year2" class="form-control" value="<?=@$incmplt_fields->fnc_year[1]?>" name="fnc_year[]" placeholder="Year">
                              <i class="error"></i>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <input type="text"  id="fnc_turnover2" class="form-control" value="<?=@$incmplt_fields->fnc_turnover[1]?>" name="fnc_turnover[]" placeholder="Turn Over">
                              <i class="error"></i>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <input type="text"  id="fnc_prftBfrTax2" class="form-control"  value="<?=@$incmplt_fields->fnc_prftBfrTax[1]?>" name="fnc_prftBfrTax[]" placeholder="Profit before Tax">
                              <i class="error"></i>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <input type="text"  id="fnc_netWrth2" class="form-control" value="<?=@$incmplt_fields->fnc_netWrth[1]?>" name="fnc_netWrth[]" placeholder="Net Worth">
                              <i class="error"></i>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <input type="text"  id="fnc_rsrvSrpls2" class="form-control" value="<?=@$incmplt_fields->fnc_rsrvSrpls[1]?>" name="fnc_rsrvSrpls[]" placeholder="Reserves & Surplus">
                              <i class="error"></i>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <input type="text"  id="fnc_sharCaps2" class="form-control" value="<?=@$incmplt_fields->fnc_sharCaps[1]?>" name="fnc_sharCaps[]" placeholder="Share Capital">
                              <i class="error"></i>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-2">
                           <div class="form-group">
                              <input type="text"  id="fnc_year3" class="form-control" value="<?=@$incmplt_fields->fnc_year[2]?>" name="fnc_year[]" placeholder="Year">
                              <i class="error"></i>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <input type="text"  id="fnc_turnover3" class="form-control" value="<?=@$incmplt_fields->fnc_turnover[2]?>" name="fnc_turnover[]" placeholder="Turn Over">
                              <i class="error"></i>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <input type="text"  id="fnc_prftBfrTax3" class="form-control" value="<?=@$incmplt_fields->fnc_prftBfrTax[2]?>" name="fnc_prftBfrTax[]" placeholder="Profit before Tax">
                              <i class="error"></i>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <input type="text"  id="fnc_netWrth3" class="form-control" value="<?=@$incmplt_fields->fnc_netWrth[2]?>" name="fnc_netWrth[]" placeholder="Net Worth">
                              <i class="error"></i>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <input type="text"  id="fnc_netWrth3" class="form-control" value="<?=@$incmplt_fields->fnc_rsrvSrpls[2]?>" name="fnc_netWrth[]" placeholder="Reserves & Surplus">
                              <i class="error"></i>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="form-group">
                              <input type="text"  id="fnc_sharCaps3" class="form-control"value="<?=@$incmplt_fields->fnc_sharCaps[2]?>"  name="fnc_sharCaps[]" placeholder="Share Capital">
                              <i class="error"></i>
                           </div>
                        </div>
                     </div>
                     <div id="heading">Organisation Details</div>
                     <div class="row">
                        <div class="col-xs-8 col-sm-6">
                           <div class="form-group">
                              <select name="noforg" id="noforg" class="form-control">
                                 <option value="">*  Nature of your Organization</option>
                                 <option value="Proprietary" <?php if(isset($incmplt_fields->noforg)) if($incmplt_fields->noforg=='Proprietary') echo "selected";?> >Proprietary</option>
                                 <option value="Partnership" <?php if(isset($incmplt_fields->noforg)) if($incmplt_fields->noforg=='Partnership') echo "selected";?> >Partnership</option>
                                 <option value="Private Limited" <?php if(isset($incmplt_fields->noforg)) if($incmplt_fields->noforg=='Private Limited') echo "selected";?>>Private Limited</option>
                                 <option value="Public Limited" <?php if(isset($incmplt_fields->noforg)) if($incmplt_fields->noforg=='Public Limited') echo "selected";?>>Public Limited</option>
                                 <option value="Co-Operative" <?php if(isset($incmplt_fields->noforg)) if($incmplt_fields->noforg=='Co-Operative') echo "selected";?>>Co-Operative</option>
                                 <option value="Other" <?php if(isset($incmplt_fields->noforg)) if($incmplt_fields->noforg=='Other') echo "selected";?> >Other</option>
                              </select>
                              <i class="error"></i>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <textarea  id="activity_of_company" class="form-control col-md-12"  name="activity_of_company" placeholder="*  Brief Description (Activities of the Company)"><?=@$incmplt_fields->activity_of_company?></textarea>
                              <i class="error"></i>
                           </div>
                        </div>
                     </div>
                     <div class="row">&nbsp;</div>
                     <div id="heading">Upload your Document</div>
                     <div class="row">&nbsp;</div>
                  </fieldset>
                  <fieldset title="Step 2" class="step" id="default-step-1" >
                     <legend style="display:none"> Investment Details: </legend>
                     <div>&nbsp;</div>
                     <div id="heading">Investment Details:</div>
                     <div class="row">
                        <div class="col-xs-8 col-sm-6">
                           <div class="form-group">
                              <select name="ntrofunit" id="ntrofunit" class="form-control">
                                 <option value="">* Nature of unit</option>
                                 <option value="Manufacturing" <?php if(isset($incmplt_fields->ntrofunit)) if($incmplt_fields->ntrofunit=='Manufacturing') echo "selected";?> >Manufacturing of Electronics ,IT &amp; ITeS</option>
                                 <option value="Services" <?php if(isset($incmplt_fields->ntrofunit)) if($incmplt_fields->ntrofunit=='Services') echo "selected";?>>Services for Electronics ,IT &amp; ITes</option>
                              </select>
                              <i class="error"></i>
                           </div>
                        </div>
                        <div class="col-xs-8 col-sm-6">
                           <div class="form-group">
                              <select name="ntrofunittype" id="ntrofunittype" class="form-control">
                              <?php if(isset($incmplt_fields->ntrofunittype)) if(!empty($incmplt_fields->ntrofunittype)) echo "<option value='".@$incmplt_fields->ntrofunittype."' selected>".@$incmplt_fields->ntrofunittype."</option>";?> 
                              </select>
                              <i class="error"></i>
                           </div>
                        </div>
                     </div>
                     <div class="row">&nbsp;</div>
                     <div id="heading">Proposed Product/Service Name</div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <fieldset style="padding-bottom:0px;">
                                 <table class="table table-hover" width="100%" id="MyTable">
                                    <thead>
                                       <tr>
                                          <th class="text-center" width="10%">S.No.</th>
                                          <th class="text-center" width="100%">Product/Service Name</th>
                                          <th><a href="javascript:addrow();"  class='btn btn-info'><i class='fa fa-plus-square'></i> Add New</a></th>
                                          <th><a class="btn btn-danger" href="javascript:delrow();"><i class="fa fa-ban"> Delete</i></a></th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php 
                                          if(isset($incmplt_fields->psname) && !empty($incmplt_fields->psname)){
                                          for($i=0;$i < count($incmplt_fields->psname);$i++){
                                            echo" <tr id='trplus_".$i."'>
                                                  <td class='text-center' width='10%'><label class='form-control'>".($i + 1)."</label></td>
                                                  <td colspan='3' class='text-center' width='100%'><input type='text' class='form-control' value='".@$incmplt_fields->psname[$i]."' name='psname[]' placeholder='Product/Service1'></td>
                                                  </tr>";
                                                 }
                                              } 
                                           else {
                                              echo"
                                                 <tr id='trplus'>
                                                 <td class='text-center' width='10%'><label class='form-control'>1</label></td>
                                                 <td colspan='3' class='text-center' width='100%'><input type='text' class='form-control' value='".@$incmplt_fields->psname[0]."' name='psname[]' placeholder='Product/Service1'></td>
                                                 </tr>";
                                           }
                                              ?>   
                                    </tbody>
                                 </table>
                              </fieldset>
                           </div>
                        </div>
                     </div>
                     <div id="heading">Investment</div>
                     <div class="row">
                        <div class="col-md-6">
                           <frameset>
                              <label class='control-label'>* Duration of Investment</label>
                              <div class="form-group">
                                 <input type="number"  id="duration_of_investment" min="0" max="10" class="form-control" value="<?=@$incmplt_fields->duration_of_investment?>" name="duration_of_investment" placeholder="* Duration of Investment">
                                 <i class="error"></i>
                              </div>
                           </frameset>
                        </div>
                        <div class="col-md-6">
                           <frameset>
                              <label class='control-label'>* Expected date of commercial production</label>
                              <div class="form-group">
                                 <input type="date"  id="other" class="form-control" value="<?=@$incmplt_fields->expected_date_of_commercial_production?>" name="expected_date_of_commercial_production" placeholder="* Expected date of commercial production(MM/YY)">
                                 <i class="error"></i>
                              </div>
                           </frameset>
                        </div>
                     </div>
                     <div id="heading">Annual details of Investment (Rs in Crores)</div>
                     <div class="row">
                        <div class="col-md-12 no_of_invest">
                           <div class="form-group">
                              <fieldset style="padding-bottom:0px;">
                                 <legend> </legend>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                       <label class="control-label">Year</label>
                                       <input type="text"  id="year" class="form-control" value="<?=@$incmplt_fields->invstmnt_in_year[0]?>" name="invstmnt_in_year[]" placeholder="Year">
                                    </div>
                                 </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                       <label class="control-label">Land</label>
                                       <input type="text"  id="land0" class="form-control" value="<?=@$incmplt_fields->invstmnt_in_land[0]?>" onkeyup="sumupInst(0)" name="invstmnt_in_land[]" placeholder="Land">
                                    </div>
                                 </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                       <label class="control-label">Building</label>
                                       <input type="text"  id="building0" class="form-control" value="<?=@$incmplt_fields->invstmnt_in_building[0]?>" onkeyup="sumupInst(0)" name="invstmnt_in_building[]" placeholder="Building">
                                    </div>
                                 </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                       <label class="nature_label control-label">Plant & Machinery/Equipment</label>
                                       <input type="text"  id="plant0" class="form-control" value="<?=@$incmplt_fields->invstmnt_in_plant[0]?>" onkeyup="sumupInst(0)" name="invstmnt_in_plant[]" placeholder="Plant & Machinery/Equipment">
                                    </div>
                                 </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                       <label class="control-label">Working Capital Margin</label>
                                       <input type="text"  id="wrkcapt0" class="form-control" value="<?=@$incmplt_fields->invstmnt_in_wrkingcapital[0]?>" onkeyup="sumupInst(0)" name="invstmnt_in_wrkingcapital[]" placeholder="Working Capital Margin">
                                    </div>
                                 </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                       <label class="control-label">Other</label>
                                       <input type="text"  id="other0" class="form-control" value="<?=@$incmplt_fields->invstmnt_in_other[0]?>" onkeyup="sumupInst(0)" name="invstmnt_in_other[]" placeholder="Other">
                                    </div>
                                 </div>
                                 <div class="col-md-2">
                                    <div class="form-group">
                                       <label class="control-label">Total</label>
                                       <input type="text"  id="total0" class="form-control" value="<?=@$incmplt_fields->invstmnt_in_total[0]?>" readonly="readonly" name="invstmnt_in_total[]" placeholder="0.0">
                                    </div>
                                 </div>
                              </fieldset>
                           </div>
                        </div>
                     </div>
                     <div class='invst_detail_field'>
                        <?php 
                           if(isset($incmplt_fields->duration_of_investment) && !empty($incmplt_fields->duration_of_investment)){
                              for($i=1;$i<$incmplt_fields->duration_of_investment;$i++){
                                   echo" <div class='row'>
                                       <div class='col-md-12 no_of_invest'>
                                          <div class='form-group'>
                                                <div class='col-md-2'>
                                                   <div class='form-group'>
                                                      <input type='text'  id='year' class='form-control' value='".@$incmplt_fields->invstmnt_in_year[$i]."' name='invstmnt_in_year[]' placeholder='Year'>
                                                   </div>
                                                </div>
                                                <div class='col-md-2'>
                                                   <div class='form-group'>
                                                      <input type='text'  id='land".$i."' class='form-control' value='". @$incmplt_fields->invstmnt_in_land[$i]."' onkeyup='sumupInst(".$i.")' name='invstmnt_in_land[]' placeholder='Land'>
                                                   </div>
                                                </div>
                                                <div class='col-md-2'>
                                                   <div class='form-group'>
                                                      <input type='text'  id='building".$i."' class='form-control' value='".@$incmplt_fields->invstmnt_in_building[$i]."' onkeyup='sumupInst(".$i.")' name='invstmnt_in_building[]' placeholder='Building'>
                                                   </div>
                                                </div>
                                                <div class='col-md-2'>
                                                   <div class='form-group'>
                                                      <input type='text'  id='plant".$i."' class='form-control' value='".@$incmplt_fields->invstmnt_in_plant[$i]."' onkeyup='sumupInst(".$i.")' name='invstmnt_in_plant[]' placeholder='Plant & Machinery/Equipment'>
                                                   </div>
                                                </div>
                                                <div class='col-md-2'>
                                                   <div class='form-group'>
                                                      <input type='text'  id='wrkcapt".$i."' class='form-control' value='".@$incmplt_fields->invstmnt_in_wrkingcapital[$i]."' onkeyup='sumupInst(".$i.")' name='invstmnt_in_wrkingcapital[]' placeholder='Working Capital Margin'>
                                                   </div>
                                                </div>
                                                <div class='col-md-2'>
                                                   <div class='form-group'>
                                                      <input type='text'  id='other".$i."' class='form-control' value='".@$incmplt_fields->invstmnt_in_other[$i]."' onkeyup='sumupInst(".$i.")' name='invstmnt_in_other[]' placeholder='Other'>
                                                   </div>
                                                </div>
                                                <div class='col-md-2'>
                                                   <div class='form-group'>
                                                      <input type='text'  id='total".$i."' class='form-control' value='".@$incmplt_fields->invstmnt_in_total[$i]."' readonly='readonly' name='invstmnt_in_total[]' placeholder='0.0'>
                                                   </div>
                                                </div>
                                          </div>
                                       </div>
                                    </div>";
                              }
                           }
                           ?> 
                     </div>
                     <div id="heading">Annual Proposed Employement</div>
                     <div class="row">
                        <div class="col-md-12 no_of_emp">
                           <frameset>
                              <legend></legend>
                              <div class="col-md-2">
                                 <div class="form-group">
                                    <label class='control-label'>Year</label>
                                    <input type="text"  id="year" class="form-control" value="<?=@$incmplt_fields->no_of_emp_year[0]?>" name="no_of_emp_year[]" placeholder="Year">
                                 </div>
                              </div>
                              <div class="col-md-2">
                                 <div class="form-group">
                                    <label class='control-label'>Skilled</label>
                                    <input type="text"  id="skl0" class="form-control" value="<?=@$incmplt_fields->no_of_emp_skilled[0]?>" name="no_of_emp_skilled[]" onkeyup="sumupEmp(0)" placeholder="Skilled">
                                 </div>
                              </div>
                              <div class="col-md-2">
                                 <div class="form-group">
                                    <label class='control-label'>Unskilled</label>
                                    <input type="text"  id="unskl0" class="form-control" value="<?=@$incmplt_fields->no_of_emp_unskilled[0]?>" name="no_of_emp_unskilled[]" onkeyup="sumupEmp(0)" placeholder="Unskilled">
                                 </div>
                              </div>
                              <div class="col-md-2">
                                 <div class="form-group">
                                    <label class='control-label'>Supervisory</label>
                                    <input type="text"  id="sprvsr0" class="form-control" value="<?=@$incmplt_fields->no_of_emp_supervisory[0]?>" name="no_of_emp_supervisory[]" onkeyup="sumupEmp(0)" placeholder="Supervisory">
                                 </div>
                              </div>
                              <div class="col-md-2">
                                 <div class="form-group">
                                    <label class='control-label'>Engineer</label>
                                    <input type="text"  id="engg0" class="form-control" value="<?=@$incmplt_fields->no_of_emp_engineer[0]?>" name="no_of_emp_engineer[]" onkeyup="sumupEmp(0)" placeholder="Engineer">
                                 </div>
                              </div>
                              <div class="col-md-2">
                                 <div class="form-group">
                                    <label class='control-label'>IT/ITeS Professional</label>
                                    <input type="text"  id="it0" class="form-control" value="<?=@$incmplt_fields->no_of_emp_it_professional[0]?>" name="no_of_emp_it_professional[]" onkeyup="sumupEmp(0)" placeholder="IT/ITeS Professional">
                                 </div>
                              </div>
                              <div class="col-md-2">
                                 <div class="form-group">
                                    <label class='control-label'>Management</label>
                                    <input type="text"  id="mngmnt0" class="form-control" value="<?=@$incmplt_fields->no_of_emp_management[0]?>" name="no_of_emp_management[]" onkeyup="sumupEmp(0)" placeholder="Management">
                                 </div>
                              </div>
                              <div class="col-md-2">
                                 <div class="form-group">
                                    <label class='control-label'>Total</label>
                                    <input type="text"  id="emptotal0" class="form-control" value="<?=@$incmplt_fields->no_of_emp_total[0]?>" name="no_of_emp_total[]" readonly placeholder="Total">
                                 </div>
                              </div>
                           </frameset>
                        </div>
                     </div>
                     <div class='no_emp_other'>
                        <?php 
                           if(isset($incmplt_fields->duration_of_investment) && !empty($incmplt_fields->duration_of_investment)){
                              for($i=1;$i<$incmplt_fields->duration_of_investment;$i++){
                                   echo" <div class='row'>
                                       <div class='col-md-12 no_of_emp'>
                                              <div class='col-md-2'>
                                                   <div class='form-group'>
                                                      <input type='text'  id='year' class='form-control' value='".@$incmplt_fields->no_of_emp_year[$i]."' name='no_of_emp_year[]' placeholder='Year'>
                                                   </div>
                                             </div>
                                             <div class='col-md-2'>
                                                <div class='form-group'>
                                                   <input type='text'  id='skl".$i."' class='form-control' value='".@$incmplt_fields->no_of_emp_skilled[$i]."' name='no_of_emp_skilled[]' onkeyup='sumupEmp(".$i.")' placeholder='Skilled'>
                                                </div>
                                             </div>
                                             <div class='col-md-2'>
                                                <div class='form-group'>
                                                   <input type='text'  id='unskl".$i."' class='form-control' value='".@$incmplt_fields->no_of_emp_unskilled[$i]."' name='no_of_emp_unskilled[]' onkeyup='sumupEmp(".$i.")' placeholder='Unskilled'>
                                                </div>
                                             </div>
                                             <div class='col-md-2'>
                                                <div class='form-group'>
                                                   <input type='text'  id='sprvsr".$i."' class='form-control' value='".@$incmplt_fields->no_of_emp_supervisory[$i]."' name='no_of_emp_supervisory[]' onkeyup='sumupEmp(".$i.")' placeholder='Supervisory'>
                                                </div>
                                             </div>
                                             <div class='col-md-2'>
                                                <div class='form-group'>
                                                   <input type='text'  id='engg".$i."' class='form-control' value='".@$incmplt_fields->no_of_emp_engineer[$i]."' name='no_of_emp_engineer[]' onkeyup='sumupEmp(".$i.")' placeholder='Engineer'>
                                                </div>
                                             </div>
                                             <div class='col-md-2'>
                                                <div class='form-group'>
                                                   <input type='text'  id='it".$i."' class='form-control' value='".@$incmplt_fields->no_of_emp_it_professional[$i]."' name='no_of_emp_it_professional[]' onkeyup='sumupEmp(".$i.")' placeholder='IT/ITeS Professional'>
                                                </div>
                                             </div>
                                             <div class='col-md-2'>
                                                <div class='form-group'>
                                                   <input type='text'  id='mngmnt".$i."' class='form-control' value='".@$incmplt_fields->no_of_emp_management[$i]."' name='no_of_emp_management[]' onkeyup='sumupEmp(".$i.")' placeholder='Management'>
                                                </div>
                                             </div>
                                             <div class='col-md-2'>
                                                <div class='form-group'>
                                                   <input type='text'  id='emptotal".$i."' class='form-control' value='".@$incmplt_fields->no_of_emp_total[$i]."' name='no_of_emp_total[]' readonly placeholder='Total'>
                                                </div>
                                             </div>
                                       </div>      
                           
                                    </div>";
                              }
                           }
                           ?> 
                     </div>
                     <div id="heading">Means of Finance(Rs. in Crores)</div>
                     <div class="row">
                        <div class="col-md-12 mean_fin">
                           <frameset>
                              <legend> </legend>
                              <div class="col-md-2">
                                 <div class="form-group">
                                    <label class='control-label'>Promoter's Equity</label>
                                    <input type="text"  id="peq" class="form-control" value="<?=@$incmplt_fields->means_of_finace_Promoter_equity?>" name="means_of_finace_Promoter_equity" placeholder="Promoter's Equity">
                                 </div>
                              </div>
                              <div class="col-md-2">
                                 <div class="form-group">
                                    <label class='control-label'>Foreign Equity</label>
                                    <input type="text"  id="feq" class="form-control" value="<?=@$incmplt_fields->means_of_finace_Foreign_Equity?>" name="means_of_finace_Foreign_Equity" placeholder="Foreign Equity">
                                 </div>
                              </div>
                              <div class="col-md-2">
                                 <div class="form-group">
                                    <label class='control-label'>Institutions Equity</label>
                                    <input type="text"  id="ieq" class="form-control" value="<?=@$incmplt_fields->means_of_finace_Institutions_Equity?>" name="means_of_finace_Institutions_Equity" placeholder="Institutions Equity">
                                 </div>
                              </div>
                              <div class="col-md-2">
                                 <div class="form-group">
                                    <label class='control-label'>Term Loan from (Bank/FI)</label>
                                    <input type="text"  id="btl" class="form-control" value="<?=@$incmplt_fields->means_of_finace_Bank_terms_Loan?>" name="means_of_finace_Bank_terms_Loan" placeholder="Term Loan from (Bank/FI)">
                                 </div>
                              </div>
                              <!-- <div class="col-md-6">
                                 <div class="form-group">
                                    <label class='control-label'>Bank Funding(Working Capital)</label>
                                    <input type="text"  id="bwc" class="form-control" value="<?=@$incmplt_fields->means_of_finace_bank_funding?>" name="means_of_finace_bank_funding" placeholder="Bank Funding(Working Capital)">
                                 </div>
                                 </div> -->
                              <div class="col-md-2">
                                 <div class="form-group">
                                    <label class='control-label'>Others</label>
                                    <input type="text"  id="fincother" class="form-control" value="<?=@$incmplt_fields->means_of_finace_others?>" name="means_of_finace_others" placeholder="Others">
                                 </div>
                              </div>
                              <!-- <div class="col-md-6">
                                 <div class="form-group">
                                    <label class='control-label'>Seed Capital/Risk Capital</label>
                                    <input type="text"  id="scr" class="form-control" value="<?=@$incmplt_fields->means_of_finace_seed_capital?>" name="means_of_finace_seed_capital" placeholder="Seed Capital/Risk Capital">
                                 </div>
                                 </div> -->
                              <div class="col-md-2">
                                 <div class="form-group">
                                    <label class='control-label'>Subsidy/Grants</label>
                                    <input type="text"  id="sg" class="form-control" value="<?=@$incmplt_fields->means_of_finace_subsidy?>" name="means_of_finace_subsidy" placeholder="Subsidy/Grants">
                                 </div>
                              </div>
                              <div class="col-md-2">
                                 <div class="form-group">
                                    <label class='control-label'>Total</label>
                                    <input type="text"  id="fintotal" class="form-control" value="<?=@$incmplt_fields->means_of_finace_total?>" name="means_of_finace_total" readonly placeholder="Total">
                                 </div>
                              </div>
                           </frameset>
                        </div>
                     </div>
                     <div id="heading">Borrowed Working Capital</div>
                     <div class="row">
                        <div class="col-md-6">
                           <frameset>
                              <label class='control-label'></label>
                              <div class="form-group">
                                 <input type="text"  id="other" class="form-control" value="<?=@$incmplt_fields->borrowed_working_capital?>" name="borrowed_working_capital" placeholder="Borrowed Working Capital">
                              </div>
                           </frameset>
                        </div>
                     </div>
                  </fieldset>
                  <fieldset title="Step 3" class="step" id="default-step-2" >
                  <legend style="display:none">Requirements</legend>
                  <div id="heading">Requirements of Land /Space</div>
                  <div class="row">
                     <div class="col-xs-8 col-sm-6">
                        <div class="form-group">
                           <select name="Proposed_details_of_Land" id='Proposed_details_of_Land' class="form-control">
                              <option value="">* Proposed details of Land/Space</option>
                              <option value="IT Notified Land" <?php if(isset($incmplt_fields->Proposed_details_of_Land)) if($incmplt_fields->Proposed_details_of_Land=='IT Notified Land') echo "selected";?>>IT Notified Land</option>
                              <option value="Own Land/Space" <?php if(isset($incmplt_fields->Proposed_details_of_Land)) if($incmplt_fields->Proposed_details_of_Land=='Own Land/Space') echo "selected";?> >Own Land/Space</option>
                              <option value="Rented Space" <?php if(isset($incmplt_fields->Proposed_details_of_Land)) if($incmplt_fields->Proposed_details_of_Land=='Rented Space') echo "selected";?>>Rented Space</option>
                           </select>
                           <i class="error"></i>
                        </div>
                     </div>
                  </div>
                  <div style="padding-top:10px;"></div>
                  <div id="heading" class='dt_land'>Detail of Land</div>
                  <div class="row">
                     <div class="land_leased_other col-xs-8 col-sm-6">
                        <fieldset>
                           <legend></legend>
                           <div class="form-group">
                              <input type="text"  name="Land_in_Heetares" id="Land_in_Heetares" class="form-control" value="<?=@$incmplt_fields->Land_in_Heetares?>"  placeholder="* Land in Acres">
                              <i class="error"></i>
                           </div>
                           <div class="form-group">
                              <input type="text"  id="detail_of_plot" class="form-control" value="<?=@$incmplt_fields->detail_of_plot?>" name="detail_of_plot" placeholder="* Details of Plot">
                              <i class="error"></i>
                           </div>
                           <div class="form-group">
                              <input type="text"  id="Location" class="form-control" value="<?=@$incmplt_fields->Location?>" name="Location" placeholder="* Location">
                              <i class="error"></i>
                           </div>
                        </fieldset>
                     </div>
                     <div class="land_leased col-xs-8 col-sm-6" style="display:none">
                        <fieldset>
                           <legend></legend>
                           <div class="form-group">
                              <input type="text"  id="detail_of_leased_space_area_in_sq_meters" class="form-control" value="<?=@$incmplt_fields->detail_of_leased_space_area_in_sq_meters?>" name="detail_of_leased_space_area_in_sq_meters" placeholder="* Area in Sq. Meters">
                              <i class="error"></i>
                           </div>
                           <div class="form-group">
                              <input type="text" id="detail_of_leased_space_detail_of_space" class="form-control" value="<?=@$incmplt_fields->detail_of_leased_space_detail_of_space?>" name="detail_of_leased_space_detail_of_space" placeholder="* Details of Space">
                              <i class="error"></i>
                           </div>
                           <div class="form-group">
                              <input type="text"  id="detail_of_leased_space_location" class="form-control" value="<?=@$incmplt_fields->detail_of_leased_space_location?>" name="detail_of_leased_space_location" placeholder="* Location">
                              <i class="error"></i>
                           </div>
                        </fieldset>
                     </div>
                  </div>
                  <div id="heading">Other Requirements</div>
                  <div class="row">
                     <div class="col-xs-8 col-sm-6">
                        <fieldset>
                           <label>Water Requirements</label>
                           <div class="form-group">
                              <input type="text"  id="water_requirement" class="form-control" value="<?=@$incmplt_fields->water_requirement?>" name="water_requirement" placeholder="Water requirement(MCM/Yr)">
                              <i class="error"></i>
                           </div>
                           <div class="form-group">
                              <input type="text"  id="source_of_water" class="form-control" value="<?=@$incmplt_fields->source_of_water?>" name="source_of_water" placeholder="Source of water">
                           </div>
                        </fieldset>
                     </div>
                     <div class="col-xs-8 col-sm-6">
                        <fieldset>
                           <label>Electricity Requirements</label>
                           <div class="form-group">
                              <select name="connection_type" id="connection_type" class="form-control">
                                 <option value="" >Connection type</option>
                                 <option value='HT' <?php if(isset($incmplt_fields->connection_type)) if($incmplt_fields->connection_type=='ht') echo "selected";?>>HT</option>
                                 <option value='LT' <?php if(isset($incmplt_fields->connection_type)) if($incmplt_fields->connection_type=='lt') echo "selected";?>>LT</option>
                              </select>
                              <i class="error"></i>
                           </div>
                           <div class="form-group">
                              <div class='col-md-10 row'>
                                 <input type="text"  id="electricity_required_load" class="form-control" value="<?=@$incmplt_fields->electricity_required_load?>" name="electricity_required_load" placeholder="Required load">
                                 <i class="error"></i>
                              </div>
                              <div class="input-group-btn">
                                 <select name='electricity_unit' id="electricity_unit" class="form-control">
                                    <option value="">Unit</option>
                                    <option value="KW"  <?php if(isset($incmplt_fields->electricity_unit)) if($incmplt_fields->electricity_unit=='KW') echo "selected";?> >KW</option>
                                    <option value="HP"  <?php if(isset($incmplt_fields->electricity_unit)) if($incmplt_fields->electricity_unit=='HP') echo "selected";?>>HP</option>
                                    <option value="MVA"  <?php if(isset($incmplt_fields->electricity_unit)) if($incmplt_fields->electricity_unit=='MVA') echo "selected";?>>MVA</option>
                                 </select>
                                 <i class="error"></i>
                              </div>
                           </div>
                           <frameset >
                              <label>Date of Power Requirement</label>
                              <div class="form-group">
                                 <input type="date"  id="date_of_power_of_requirements" class="form-control" value="<?=@$incmplt_fields->date_of_power_of_requirements?>" name="date_of_power_of_requirements" placeholder="Date of Power Requirement">
                              </div>
                           </frameset>
                           </frameset>
                     </div>
                  </div>
                  <div id="heading">Any Other specific Requirements</div>
                  <textarea class="form-control" name="other_requirements" maxlength="5000" placeholder="Any Other Requirements"><?=@$incmplt_fields->other_requirements?></textarea>
                  <div style="padding-top:25px;"></div>
                  <div id="heading">&nbsp;</div>
                  </fieldset>
                  <fieldset title="Step 4" class="step" id="default-step-3">
                     <legend style="display:none"> Declaration </legend>
                    
                     <!--  <div class="col-md-10 text-justify" style="font-size:1.15em" >
                        <label class="label_check c_on">
                        <input name="agreed" id="" value="1" type="checkbox"> I agree to the terms & conditions.
                        </label>
                        </div> -->
                     <!-- upload documents -->
                     <?php 
                        $docModel=new ApplicationCdnMappingExt;
                        $docs=$docModel->getApplicationDocuments($pre_field['user_id'],$app['application_id']);
                        if($docs){
                           echo "<div class='row'>&nbsp;</div>
                                  <div id='heading'>Upload Documents</div>";
                           foreach ($docs as $doc) {
                              if($doc['status']==204 || ($doc['status']==200 && $doc['doc_status']=='R')){
                                echo "<div class='form-group'>
                                        <label class='control-label col-md-3' style='font-size:9.9px'><big>";
                                          $name=$doc['doc_name'];
                                          if (preg_match('/_/',$doc['doc_name']))
                                                $doc['doc_name']=str_replace('_', ' ', $doc['doc_name']);
                                             echo ucwords($doc["doc_name"]);
                                             echo "</big><small> size ($doc[doc_min_size]-$doc[doc_max_size]) of type $doc[doc_type]</small></label> 
                                        <div class='controls col-md-9'>
                                            <div class='fileupload fileupload-new' data-provides='fileupload'>
                                              <span class='btn btn-white btn-file'>
                                              <span class='fileupload-new'><i class='fa fa-paper-clip'></i> Select file</span>
                                              <span class='fileupload-exists'><i class='fa fa-undo'></i> Change</span>
                                              <input type='hidden' name='caf_applications_uploads[doc_id][]' value='$doc[doc_id]'>
                                              <input type='file' name='caf_applications_uploads[]' class='default' />
                                              </span>
                                                <span class='fileupload-preview' style='margin-left:5px;'></span>
                                                <a href='#' class='close fileupload-exists' data-dismiss='fileupload' style='float: none; margin-left:5px;'></a>";
                                             if($name=='authorization_letters'){
                                                echo "<div class='col-md-4' style='border-left:solid 1px;border-right:solid 1px;padding-right:15px;margin-right:10px;'>";
                                                echo "<select class='form-control' name='authorization_letters_type'>
                                                      <option value='Board Resolution'>Board Resolution</option>
                                                      <option value='Partners Authorisation Letter'>Partners Authorisation Letter</option>
                                                      <option value='Power of Attorney'>Power of Attorney</option>
                                                      <option value='Authorization Letter'>Authorization Letter</option>

                                                      </select></div>";
                                             }
                                            echo "</div>";
                                        echo "</div>
                                    </div>";

                             
                              }
                              else if($doc['status']==200){
                                 echo "<div class='form-group last'>
                                                              <label class='control-label col-md-3'>$doc[doc_name] Already Uploaded</label>
                                                              <div class='col-md-9'>
                                                                  <div class='fileupload fileupload-new'>
                                                                      <div class='fileupload-preview fileupload-exists thumbnail' style='max-width: 200px; max-height: 150px; line-height: 20px;'>
                                                                      <img src='data:".$doc['doc_type'].";base64, $doc[doc_blob_data]' />
                                                                      </div>
                                                                  </div>
                                                                  <span class='label label-danger'>";
                                                                      if($doc['doc_status']=='P')
                                                                        echo "Pending for verification";
                                                                      elseif($doc['doc_status']=='V')
                                                                        echo "Verified";
                                                                      elseif($doc['doc_status']=='R')
                                                                        echo "Rejected";
                        
                                                                  echo "</span>
                                                              </div>
                                                          </div>";
                               }
                             }
                           }  
                        ?>
                     <div class="row">&nbsp;</div>
                     <div class="row">&nbsp;</div>
                     <div id="heading">DECLARATION</div>
                     <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10 text-justify" style="font-size:1.15em" >
                           <p>
                              I, <b> <?=@$first_name." ".@$last_name?> </b> (Designation) <b> <span class='declaration_designation'></span> </b> of M/s <b><span class='declaration_company'></span></b>  having Regd. office at <b><span class='declaration_Ofc_add'></b></span> 
                              hereby declare that the information furnished by me/us to CHiPS, Govt. of Chhattisgarh, by our firm/company in this Application Form for CHiPS are true to the best of my knowledge, belief and is based on the company/firm  records. I/We indemnify the above agencies or any other agency under the jurisdiction of Govt. of Chhattisgarh from liabilities of any nature that may arise due to the decision taken based on the information contained in this application form which may be inadequate, inaccurate, erroneous etc. and the management of my firm/company assumes complete responsibility in this regard.
                           </p>
                           <p>Further, our firm/company undertakes to provide any additional information or clarification as required by CHiPS, Govt. of Chhattisgarh or its agencies during and after processing of our application.
                           </p>
                           <p>
                              I/We undertake to pay the fees/charges payable to CHiPS, Govt. of Chhattisgarh and its agencies as prescribed under the policy for according approval and charges fixed for water, energy, etc. and other charges fixed by the Govt. of Chhattisgarh from time to time.
                           </p>
                           <p> I/We understand that this approval through CHiPS is to assist our firm/company in getting statutory clearances expeditiously. I/We indemnify CHiPS, Govt. of Chhattisgarh and its agencies from any liabilities whatsoever.
                           </p>
                           <p>Place<b> <?=@$city_name?>  </b><br>
                              Date: <b><?php echo date('Y-m-d');?> </b>
                           </p>
                        </div>
                     </div>
                        <div class="row">
                        <div class="col-md-12">
                           <label class="col-md-offset-1">
                           <strong><input type="checkbox" id="terms" style="position:relative;top:3px;" required="">&nbsp;&nbsp;&nbsp;I Accept .</strong>
                           <i class="error"></i>
                           </label>
                        </div>
                     </div>
                     <div class="row">&nbsp;</div>
                     <div class="row">&nbsp;</div>
                     <div id="heading">&nbsp;</div>
                     <div class="col-md-1"></div>
                     <div class="row">&nbsp;</div>
                  </fieldset>
                  <input type="submit" class="finish btn btn-danger" value="Finish"/>
               </form>
            </div>
         </section>
      </div>
      <div class="col-lg-1"></div>
   </div>
   <!-- page end-->
</div>
<!--script for this page-->
<script>
   //step wizard
   
   $(function() {
       $('#default').stepy({
           backLabel: 'Previous',
           block: true,
           nextLabel: 'Save & Next',
           titleClick: true,
           titleTarget: '.stepy-tab'
       });
   });
</script>
<script>
   function addrow(){
   
      var cnt = rowCount = $('#MyTable tbody tr').length;      
         cnt = cnt+1;
      if(cnt > 12 ){
           alert("Can't Add More Rows");
           }
      else{         
      var html="<tr id='trplusid_"+cnt+"'>"+
                  "<td class='text-center' width='10%'><label class='form-control'>"+cnt+"</label></td>"+
                  "<td colspan='3' class='text-center' width='100%'>"+
                     "<input type='text' class='form-control' id='psname"+cnt+"' value='<?=@$incmplt_fields->psname["+cnt+"]?>' name='psname[]' placeholder='Product/Service"+cnt+"'>"+
                  "</td>"+
                  // "<td><a href='javascript:delrow();' class='btn btn-danger'><i class='fa fa-ban'></i></a></td>"+
               "</tr>";
      
      $('#MyTable> tbody:last').append(html);
      }
   }
   function delrow(){
       $('#MyTable tbody>tr:last').remove();
   }
   
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
        sum=parseFloat(land) + parseFloat(building) + parseFloat(plant) + parseFloat(wrkcapt) +parseFloat(other);
        $("#total"+id).val(sum);
   }
   function sumupEmp(id){
         var sum=0;
      var skl=$('#skl'+id).val();
      var unskl=$('#unskl'+id).val();
      var mngmnt=$('#mngmnt'+id).val();
      var sprvsr=$('#sprvsr'+id).val();
      var engg=$('#engg'+id).val();
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
      $('#emptotal'+id).val(sum);
   }
   
   
      $(document).ready(function() {
   
         /*Text area word count limit*/
         var max = 400;
            $('textarea.max').keypress(function(e) {
                if (e.which < 0x20) {
                    // e.which < 0x20, then it's not a printable character
                    // e.which === 0 - Not a character
                    return;     // Do nothing
                }
                if (this.value.length == max) {
                    e.preventDefault();
                } else if (this.value.length > max) {
                    // Maximum exceeded
                    this.value = this.value.substring(0, max);
                }
            });
   
   
   
   
         var natur=$("#ntrofunit").val();
         var content='';
         if(natur=='Services'){
                content="<option value='mic'>Micro (< 10 lakhs)</option><option value='small'>Small (More than 10 Lakhs <2 Crore)</option><option value='med'>Medium (More than 2 Crore <5 Crore)</option><option value='Large'>Large (More than 5 Crore)</option>";
               $(".nature_label").text("Equipment");              
         }
         else if(natur=="Manufacturing"){
                content="<option value='mic'>Micro (< 25 lakhs)</option><option value='small'>Small (More than 25 Lakhs < 5 Crore)</option><option value='med'>Medium (More than 5 Crore < 10 Crore)</option><option value='Large'>Large(More than 10 Crore)</option>";
                 $(".nature_label").text("Plant & Machinery");
         }
   
          var iCnt = 0;
          // CREATE A "DIV" ELEMENT AND DESIGN IT USING JQUERY ".css()" CLASS.
          var container = $(document.createElement('div')).addClass('class="col-md-6 form-group"');
      
              $('#btAdd').click(function(event) {
               event.preventDefault();
              if (iCnt <= 19) {
      
                  iCnt = iCnt + 1;
      
                  // ADD TEXTBOX.
                  $(container).append('<input type=text class="input form-control" id=tb' + iCnt + ' ' +
                              'value="" name="psname[]" placeholder="New Product & service" />');
      
                  // ADD BOTH THE DIV ELEMENTS TO THE "main" CONTAINER.
                  $('#main').after(container);
              }
              // AFTER REACHING THE SPECIFIED LIMIT, DISABLE THE "ADD" BUTTON.
              // (20 IS THE LIMIT WE HAVE SET)
              else {      
                  
                  $(container).append('<label>Reached the limit</label>'); 
                  $('#btAdd').attr('class', 'bt-disable'); 
                  $('#btAdd').attr('disabled', 'disabled');
      
              }
   
          });
          var natur=$("#ntrofunit").val();
          var content='';
          var label = '';
          if(natur=='Services'){
                 content="<option value='mic' <?php if(isset($incmplt_fields->ntrofunittype)) if($incmplt_fields->ntrofunittype=='mic') echo 'selected';?>>Micro (< 10 lakhs)</option><option value='small' <?php if(isset($incmplt_fields->ntrofunittype)) if($incmplt_fields->ntrofunittype=='small') echo 'selected';?>>Small (More than 10 Lakhs <2 Crore)</option><option value='med' <?php if(isset($incmplt_fields->ntrofunittype)) if($incmplt_fields->ntrofunittype=='med') echo 'selected';?>>Medium (More than 2 Crore <5 Crore)</option><option value='Large'<?php if(isset($incmplt_fields->ntrofunittype)) if($incmplt_fields->ntrofunittype=='Large') echo 'selected';?>>Large (More than 5 Crore)</option>";
                 $(".nature_label").text("Equipment");         
          }
          else if(natur=="Manufacturing"){
                 content="<option value='mic' <?php if(isset($incmplt_fields->ntrofunittype)) if($incmplt_fields->ntrofunittype=='mic') echo 'selected';?>>Micro (< 25 lakhs)</option><option value='small' <?php if(isset($incmplt_fields->ntrofunittype)) if($incmplt_fields->ntrofunittype=='small') echo 'selected';?>>Small (More than 25 Lakhs < 5 Crore)</option><option value='med' <?php if(isset($incmplt_fields->ntrofunittype)) if($incmplt_fields->ntrofunittype=='med') echo 'selected';?>>Medium (More than 5 Crore < 10 Crore)</option><option value='Large' <?php if(isset($incmplt_fields->ntrofunittype)) if($incmplt_fields->ntrofunittype=='Large') echo 'selected';?>>Large(More than 10 Crore)</option>";
          }
          else{
             content='None';
          }
          //console.log(content);
          $('#ntrofunittype').empty();
          $('#ntrofunittype').append('<option  value="">* Please Select Unit Type</option>');
          $('#ntrofunittype').append(content);
      
      });
</script>
<script type="text/javascript">
   $('#land,#building,#plant,#wrkcapt,#other').blur(function(){
     var sum=0;
     var land=$('#land').val();
     if(isNaN(parseFloat(land)))
       land=0.0;
     var building=$('#building').val();
     if(isNaN(parseFloat(building)))
       building=0.0;
     var plant=$('#plant').val();
     if(isNaN(parseFloat(plant)))
       plant=0.0;
     var wrkcapt=$('#wrkcapt').val();
     if(isNaN(parseFloat(wrkcapt)))
       wrkcapt=0.0;
     var other=$('#other').val();
     if(isNaN(parseFloat(other)))
       other=0.0;
     sum=parseFloat(land) + parseFloat(building) + parseFloat(plant) + parseFloat(wrkcapt) +parseFloat(other);
     $("#total").val(sum);
   });
   
   $('#peq,#ieq,#feq,#btl,#bwc,#fincother,#scr,#sg').blur(function(){
     var sum=0;
     var peq=$('#peq').val();
     var ieq=$('#ieq').val();
     var btl=$('#btl').val();
     var feq=$('#feq').val();
     var bwc=$('#bwc').val();
     var fincother=$('#fincother').val();
     var scr=$('#scr').val();
     var sg=$('#sg').val();
     if(isNaN(parseFloat(peq)))
       peq=0.0;
     if(isNaN(parseFloat(ieq)))
       ieq=0.0;
     if(isNaN(parseFloat(btl)))
       btl=0.0;
     if(isNaN(parseFloat(feq)))
       feq=0.0;
     if(isNaN(parseFloat(bwc)))
       bwc=0.0;
     if(isNaN(parseFloat(fincother)))
       fincother=0.0;
     if(isNaN(parseFloat(scr)))
       scr=0.0;
     if(isNaN(parseFloat(sg)))
       sg=0.0;
     sum=parseFloat(peq) + parseFloat(ieq) + parseFloat(feq) + parseFloat(btl) +parseFloat(bwc)+parseFloat(fincother)+parseFloat(scr)+parseFloat(sg);
     $('#fintotal').val(sum);
   });
   $('#skl,#unskl,#mngmnt,#sprvsr,#engg,#it').blur(function(){
        var sum=0;
     var skl=$('#skl').val();
     var unskl=$('#unskl').val();
     var mngmnt=$('#mngmnt').val();
     var sprvsr=$('#sprvsr').val();
     var engg=$('#engg').val();
     var it=$('#it').val();
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
     $('#emptotal').val(sum);
   })
   $("#ntrofunit").change(function(){
      var natur=$("#ntrofunit").val();
      var content='';
      if(natur=='Services'){
             content="<option value='mic'>Micro (< 10 lakhs)</option><option value='small'>Small (More than 10 Lakhs <2 Crore)</option><option value='med'>Medium (More than 2 Crore <5 Crore)</option><option value='Large'>Large (More than 5 Crore)</option>";
            $(".nature_label").text("Equipment");              
      }
      else if(natur=="Manufacturing"){
             content="<option value='mic'>Micro (< 25 lakhs)</option><option value='small'>Small (More than 25 Lakhs < 5 Crore)</option><option value='med'>Medium (More than 5 Crore < 10 Crore)</option><option value='Large'>Large(More than 10 Crore)</option>";
              $(".nature_label").text("Plant & Machinery");
      }
      else{
         content='None';
      }
      //console.log(content);
      $('#ntrofunittype').empty();
      $('#ntrofunittype').append('<option  value="">* Please Select Unit Type</option>');
      $('#ntrofunittype').append(content);
   
   })
   $('#duration_of_investment').blur(function(){
      var duration=$('#duration_of_investment').val();
      // console.log(duration);
      var count=1;
       $('.invst_detail_field').empty();
       $('.no_emp_other').empty();
       var str='';
       var emp='';
       if(duration > 10){
         alert("Max Duration of Investment is 10 Years\n Please Enter 10 Or Less Than 10 Years");
         return false;}
         else{
         for(count=1;count < duration;count++){
                      str= '<div class="row">'+
                              '<div class="col-md-12 no_of_invest">'+
                                '<div class="form-group">'+
                                   '<div class="col-md-2">'+
                                          '<div class="form-group">'+
                                             '<input type="text"  id="year'+count+'" class="form-control" value="<?=@$incmplt_fields->invstmnt_in_year[0]?>" name="invstmnt_in_year[]" placeholder="Year">'+
                                          '</div>'+
                                       '</div>'+
                                    '<div class="col-md-2">'+
                                       '<div class="form-group">'+
                                          '<input type="text"  id="land'+count+'" class="form-control"  onkeyup="sumupInst('+count+')" name="invstmnt_in_land[]" placeholder="Land">'+
                                       '</div>'+
                                   '</div>'+
                                   '<div class="col-md-2">'+
                                       '<div class="form-group">'+
                                          '<input type="text"  id="building'+count+'" class="form-control" onkeyup="sumupInst('+count+')"  name="invstmnt_in_building[]" placeholder="Building">'+
                                       '</div>'+
                                    '</div>'+
                                    '<div class="col-md-2">'+
                                       '<div class="form-group">'+
                                          '<input type="text"  id="plant'+count+'" class="form-control"  onkeyup="sumupInst('+count+')" name="invstmnt_in_plant[]" placeholder="Plant & Machinery/Equipment">'+
                                       '</div>'+
                                    '</div>'+
                                    '<div class="col-md-2">'+
                                       '<div class="form-group">'+
                                          '<input type="text"  id="wrkcapt'+count+'" class="form-control" onkeyup="sumupInst('+count+')"  name="invstmnt_in_wrkingcapital[]" placeholder="Working Capital Margin">'+
                                       '</div>'+
                                    '</div>'+
                                    '<div class="col-md-2">'+
                                       '<div class="form-group">'+
                                          '<input type="text"  id="other'+count+'" class="form-control"  onkeyup="sumupInst('+count+')" name="invstmnt_in_other[]" placeholder="Other">'+
                                       '</div>'+
                                    '</div>'+
                                    '<div class="col-md-2">'+
                                       '<div class="form-group">'+
                                          '<input type="text"  id="total'+count+'" class="form-control"  readonly="readonly" name="invstmnt_in_total[]" placeholder="0.0">'+
                                       '</div>'+
                                    '</div></div></div>';
                     emp='<div class="row">'+
                           '<div class="col-md-12 no_of_emp">'+
                                 '<div class="col-md-2">'+
                                             '<div class="form-group">'+
                                                '<input type="text"  id="year'+count+'" class="form-control" value="<?=@$incmplt_fields->no_of_emp_year[0]?>" name="no_of_emp_year[]" placeholder="Year">'+
                                             '</div>'+
                                          '</div>'+
                                 '<div class="col-md-2">'+
                                   ' <div class="form-group">'+
                                       '<input type="text"  id="skl'+count+'" class="form-control"  onkeyup="sumupEmp('+count+')" name="no_of_emp_skilled[]" placeholder="Skilled">'+
                                    '</div>'+
                                 '</div>'+
                                 '<div class="col-md-2">'+
                                    '<div class="form-group">'+
                                       '<input type="text"  id="unskl'+count+'" class="form-control"  onkeyup="sumupEmp('+count+')" name="no_of_emp_unskilled[]" placeholder="Unskilled">'+
                                    '</div>'+
                                 '</div>'+
                                 '<div class="col-md-2">'+
                                   ' <div class="form-group">'+
                                     '  <input type="text"  id="sprvsr'+count+'" class="form-control"  onkeyup="sumupEmp('+count+')" name="no_of_emp_supervisory[]" placeholder="Supervisory">'+
                                   ' </div>'+
                                 '</div>'+
                                 '<div class="col-md-2">'+
                                    '<div class="form-group">'+
                                      ' <input type="text"  id="engg'+count+'" class="form-control" onkeyup="sumupEmp('+count+')" name="no_of_emp_engineer[]" placeholder="Engineer">'+
                                    '</div>'+
                                 '</div>'+
                                ' <div class="col-md-2">'+
                                    '<div class="form-group">'+
                                      ' <input type="text"  id="it'+count+'" class="form-control"  onkeyup="sumupEmp('+count+')" name="no_of_emp_it_professional" placeholder="IT/ITeS Professional">'+
                                   ' </div>'+
                                ' </div>'+
                                 '<div class="col-md-2">'+
                                    '<div class="form-group">'+
                                       '<input type="text"  id="mngmnt'+count+'" class="form-control"  onkeyup="sumupEmp('+count+')" name="no_of_emp_management" placeholder="Management">'+
                                    '</div>'+
                                 '</div>'+
                                 '<div class="col-md-2">'+
                                    '<div class="form-group">'+
                                       '<input type="text"  id="emptotal'+count+'" class="form-control"  name="no_of_emp_total" readonly placeholder="Total">'+
                                    '</div>'+
                                 '</div>'+
                           '</div>'+
                           '</div>';
                $('.invst_detail_field').append(str);
                 $('.no_emp_other').append(emp);
   
          }
    }
       
     })
    $('#Proposed_details_of_Land').change(function(){
      var sel_val=$('#Proposed_details_of_Land').val();
      if(sel_val=='Rented Space'){
         $('.dt_land').empty();
         $('.dt_land').text('Details of Leased/Rented Space');
        $('.land_leased_other').hide();
        $('.land_leased').show();
        $('#detail_of_leased_space_area_in_sq_meters').val("");
         $('#detail_of_leased_space_detail_of_space').val("");
         $('#detail_of_leased_space_location').val("");
      }
      else{
         $('.dt_land').empty();
         $('.dt_land').text('Detail of Land');
          $('.land_leased').hide();
         $('.land_leased_other').show();
         $('#Land_in_Heetares').val("");
         $('#detail_of_plot').val("");
         $('#Location').val("");       
      }
         
   
    })
</script>