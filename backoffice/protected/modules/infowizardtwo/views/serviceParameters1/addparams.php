  <?php $allsubservices=explode(",",$serviceData['additional_sub_service']);?>                 
<style>
    <?php if(!in_array("Amendment - Cancellation",$allsubservices)) { ?> .ac{display: none;}  <?php } ?>
    <?php if(!in_array("Amendment - Surrender",$allsubservices)) { ?> .as{display: none;}  <?php } ?>
    <?php if(!in_array("Amendment - Transfer",$allsubservices)) { ?> .at{display: none;}  <?php } ?>
    <?php if(!in_array("Duplicate Copy",$allsubservices)) { ?> .duplicate{display: none;}  <?php } ?>
    <?php if(!in_array("Renewal",$allsubservices)) { ?> .renewal{display: none;}  <?php } ?>
    <?php if(!in_array("Return",$allsubservices)) { ?> .return{display: none;}  <?php } ?>
    <?php if(!in_array("Maintenance of Register",$allsubservices)) { ?> .maintainence{display: none;}  <?php } ?>
</style>

<style> 
.page-sidebar.navbar-collapse.collapse {
    display: none !important;
}   
    .page-content{margin-left:0px !important    ;}
</style>
<div class="portlet-body">
                                        <div class="mt-element-step">
                                            
                                            <div class="row step-thin">
                                               
                                                <div class="col-md-2 bg-grey  mt-step-col ">
                                                    <div class="mt-step-number bg-white font-grey">1</div>
                                                    <div class="mt-step-title uppercase font-grey-cascade">Master</div>
                                                    <div class="mt-step-content font-grey-cascade"> Form</div>
                                                </div>
                                                <div class="col-md-3 bg-grey  done mt-step-col active">
                                                    <div class="mt-step-number bg-white font-grey">2</div>
                                                    <div class="mt-step-title uppercase font-grey-cascade">Parameter</div>
                                                    <div class="mt-step-content font-grey-cascade"> Form</div>
                                                </div>
                                                <div class="col-md-3 bg-grey  mt-step-col">
                                                    <div class="mt-step-number bg-white font-grey">3</div>
                                                    <div class="mt-step-title uppercase font-grey-cascade">Inspection </div>
                                                    <div class="mt-step-content font-grey-cascade">Form</div>
                                                </div>
                                                <div class="col-md-2 bg-grey mt-step-col ">
                                                    <div class="mt-step-number bg-white font-grey">4</div>
                                                    <div class="mt-step-title uppercase font-grey-cascade">Fee</div>
                                                    <div class="mt-step-content font-grey-cascade">Form</div>
                                                </div>
                                                  <div class="col-md-2 bg-grey mt-step-col">
                                                    <div class="mt-step-number bg-white font-grey">5</div>
                                                    <div class="mt-step-title uppercase font-grey-cascade">Other </div>
                                                    <div class="mt-step-content font-grey-cascade">  Option</div>
                                                </div>
                                                
                                            </div>
                                            
                                           
                                        </div>
                                    </div>

<div class='portlet box green'>
<!--    <div class='portlet-title'>
        <div class='caption'>
            <i style=" font-size:20px;" class='fa fa-plus'></i><b>Sub Form-1 Service Parameter  </b>   Create Service Parameter for <strong><?php echo $serviceData['service_name']?></strong></div>
        <div class='tools'>

        </div>-->

    </div>
    <div class="portlet-body" style="padding:0px;padding-bottom: 15px;">
        <div class="table-scrollable">
            <form name="" action="" method="POST">
                <input type="hidden" name="service_id" value="<?php echo $serviceData['id']?>">
                                <input type="hidden" name="service_type[]" value="<?php echo $serviceData['service_type']?>">
                                            
  <?php foreach ($allsubservices as $subservices) { ?>
                                
                                 <input type="hidden" name="service_type[]" value="<?php echo $subservices; ?>">
                            
                                <?php } ?>
                <table class="table table-striped table-bordered table-advance table-hover">
                    <thead>
                        <tr>
                            <th>
                            </th>
                            <th class="acilppr">
                                <strong> <?php echo $serviceData['service_type']; ?></strong>
                            </th>
                            <th class="ac">
                                <strong>
                                    Amendment<br>Cancellation </strong>
                            </th>
                            <th class="as">
                                <strong>
                                    Amendment<br>Surrender </strong>
                            </th>
                            <th class="at">
                                <strong>
                                    Amendment<br>Transfer </strong>
                            </th>
                           
                            <th class="duplicate"> 
                                <strong>Duplicate Copy</strong>
                                   
                            </th>
                            <th class="renewal"> 
                                <strong>   Renewal</strong>
                                   
                            </th>

                            <th class="return"> 
                                <strong>   Return</strong> 
                                 
                            </th>
                            <th class="maintainence">
                                <strong>    Maintenance of <br> Register </strong>
                                 
                            </th>


                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <strong> Online ?</strong>
                            </td>
                            <td class="acilppr"><select name="acilppr[is_online]" class="acilppr form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="ac"><select name="ac[is_online]" class="ac form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="as"><select name="as[is_online]" class="as form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="at"><select name="at[is_online]" class="at form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="duplicate"><select name="duplicate[is_online]" class="duplicate form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="renewal"><select name="renewal[is_online]" class="renewal form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="return"><select name="return[is_online]" class="return form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="maintainence"><select name="maintainence[is_online]" class="maintainence form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>
                        </tr>
                        <tr>
                            <td>
                                <strong> Integrated With SWCS ? </strong>
                            </td>
                            <td class="acilppr"><select name="acilppr[is_integrated_with_swcs]" class="acilppr form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="ac"><select name="ac[is_integrated_with_swcs]" class="ac form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="as"><select name="as[is_integrated_with_swcs]" class="as form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="at"><select name="at[is_integrated_with_swcs]" class="at form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="duplicate"><select name="duplicate[is_integrated_with_swcs]" class="duplicate form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="renewal"><select name="renewal[is_integrated_with_swcs]" class="renewal form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="return"><select name="return[is_integrated_with_swcs]" class="return form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="maintainence"><select name="maintainence[is_integrated_with_swcs]" class="maintainence form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>

                        </tr>
                        <tr>
                            <td>
                                <strong> In Uttarakhand Right to Services Act ? </strong>
                            </td>
                            <td class="acilppr"><select name="acilppr[is_in_uttarakhand_right_to_service_act ]" class="form-control cri acilppr"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="ac"><select name="ac[is_in_uttarakhand_right_to_service_act ]" class="form-control cri ac"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="as"><select name="as[is_in_uttarakhand_right_to_service_act ]" class="form-control cri as"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="at"><select name="at[is_in_uttarakhand_right_to_service_act ]" class="form-control cri at"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="duplicate"><select name="duplicate[is_in_uttarakhand_right_to_service_act ]" class="form-control cri duplicate"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="renewal"><select name="renewal[is_in_uttarakhand_right_to_service_act ]" class="form-control cri renewal"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="return"><select name="return[is_in_uttarakhand_right_to_service_act ]" class="form-control cri return"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="maintainence"><select name="maintainence[is_in_uttarakhand_right_to_service_act ]" class="form-control cri maintainence"><option value="Y">Yes</option><option value="N">No</option></select></td>

                        </tr>
                                            <tr>
                            <td>
                                <strong> In Uttarakhand Single Window Act ? </strong>
                            </td>
                            <td class="acilppr"><select name="acilppr[is_in_uttarakhand_single_window_act]" class="form-control cri acilppr"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="ac"><select name="ac[is_in_uttarakhand_single_window_act]" class="form-control cri ac"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="as"><select name="as[is_in_uttarakhand_single_window_act]" class="form-control cri as"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="at"><select name="at[is_in_uttarakhand_single_window_act]" class="form-control cri at"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="duplicate"><select name="duplicate[is_in_uttarakhand_single_window_act]" class="form-control cri duplicate"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="renewal"><select name="renewal[is_in_uttarakhand_single_window_act]" class="form-control cri renewal"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="return"><select name="return[is_in_uttarakhand_single_window_act]" class="form-control cri return"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="maintainence"><select name="maintainence[is_in_uttarakhand_single_window_act]" class="form-control cri maintainence"><option value="Y">Yes</option><option value="N">No</option></select></td>

                        </tr>
                        <tr>
                            <td>
                                <strong>Statutory Forms Available</strong>
                            </td>
                            <td class="acilppr"><select onchange='hide("acilppr[statutory_form_upload],acilppr[statutory_form_no]","acilppr[is_statutory_forms_available]")' name="acilppr[is_statutory_forms_available]" class="form-control cri acilppr"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="ac"><select onchange='hide("ac[statutory_form_upload],ac[statutory_form_no]","ac[is_statutory_forms_available]")' name="ac[is_statutory_forms_available]" class="form-control cri ac"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="as"><select onchange='hide("as[statutory_form_upload],as[statutory_form_no]","as[is_statutory_forms_available]")' name="as[is_statutory_forms_available]" class="form-control cri as"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="at"><select onchange='hide("at[statutory_form_upload],at[statutory_form_no]","at[is_statutory_forms_available]")' name="at[is_statutory_forms_available]" class="form-control cri at"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="duplicate"><select onchange='hide("duplicate[statutory_form_upload],duplicate[statutory_form_no]","duplicate[is_statutory_forms_available]")' name="duplicate[is_statutory_forms_available]" class="form-control cri duplicate"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="renewal"><select onchange='hide("renewal[statutory_form_upload],renewal[statutory_form_no]","renewal[is_statutory_forms_available]")' name="renewal[is_statutory_forms_available]" class="form-control cri renewal"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="return"><select onchange='hide("return[statutory_form_upload],return[statutory_form_no]","return[is_statutory_forms_available]")' name="return[is_statutory_forms_available]" class="form-control cri return"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="maintainence"><select onchange='hide("maintainence[statutory_form_upload],maintainence[statutory_form_no]","maintainence[is_statutory_forms_available]")' name="maintainence[is_statutory_forms_available]" class="form-control cri maintainence"><option value="Y">Yes</option><option value="N">No</option></select></td>

                        </tr>

                        <tr>
                            <td>
                                <strong>Statutory Form No </strong>
                            </td>
                            <td class="acilppr"> <input type="text" class="form-control cri acilppr" name="acilppr[statutory_form_no]" placeholder="Statutory Form No"></td>
                            <td class="ac"> <input type="text" class="form-control cri aisct" name="ac[statutory_form_no]" placeholder="Statutory Form No"></td>
                            <td class="as"> <input type="text" class="form-control cri aisct" name="as[statutory_form_no]" placeholder="Statutory Form No"></td>
                            <td class="at"> <input type="text" class="form-control cri aisct" name="at[statutory_form_no]" placeholder="Statutory Form No"></td>
                            <td class="duplicate"><input type="text" class="form-control cri duplicate" name="duplicate[statutory_form_no]" placeholder="Statutory Form No"></td>
                            <td class="renewal"><input type="text" class="form-control cri renewal" name="renewal[statutory_form_no]" placeholder="Statutory Form No"></td>
                            <td class="return"><input type="text" class="form-control cri return" name="return[statutory_form_no]" placeholder="Statutory Form No"></td>
                            <td class="maintainence"><input type="text" class="form-control cri maintainence" name="maintainence[statutory_form_no]" placeholder="Statutory Form No"></td>
                        </tr>

                        <tr>
                            <td>
                                <strong>Statutory Forms Upload </strong>
                            </td>
                            <td class="acilppr"> <input type="file" class="form-control cri acilppr" name="acilppr[statutory_form_upload]" ></td>
                            <td class="ac"> <input type="file" class="form-control cri aisct" name="ac[statutory_form_upload]" ></td>
                            <td class="as"> <input type="file" class="form-control cri aisct" name="as[statutory_form_upload]" ></td>
                            <td class="at"> <input type="file" class="form-control cri aisct" name="at[statutory_form_upload]" ></td>
                            <td class="duplicate"><input type="file" class="form-control cri duplicate" name="duplicate[statutory_form_upload]" ></td>
                            <td class="renewal"><input type="file" class="form-control cri renewal" name="renewal[statutory_form_upload]" ></td>
                            <td class="return"><input type="file" class="form-control cri return" name="return[statutory_form_upload]" ></td>
                            <td class="maintainence"><input type="file" class="form-control cri maintainence" name="maintainence[statutory_form_upload]" ></td>


                        </tr>

                        <tr>
                            <td>
                                <strong>Statutory Forms Creation </strong>
                            </td>
                            <td class="acilppr"> <a href="javascript:;">Sub Form Link </a></td>
                            <td class="ac"> <a href="javascript:;">Sub Form Link </a></td>
                            <td class="as"> <a href="javascript:;">Sub Form Link </a></td>
                            <td class="at"> <a href="javascript:;">Sub Form Link </a></td>
                            <td class="duplicate"> <a href="javascript:;">Sub Form Link </a></td>
                            <td class="renewal"> <a href="javascript:;">Sub Form Link </a></td>
                            <td class="return"> <a href="javascript:;">Sub Form Link </a></td>
                            <td class="maintainence"> <a href="javascript:;">Sub Form Link </a></td>

                        </tr>

                        <tr>
                            <td>
                                <strong> Document CheckList </strong>
                            </td>
                            <td class="acilppr"><select onchange='hide("acilppr[document_checklist_upload],acilppr[document_checklist_creation]","acilppr[is_statutory_forms_available]")' name="acilppr[document_checkList]" name="acilppr[document_checkList]" class="form-control cri acilppr"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="ac"><select onchange='hide("ac[document_checklist_upload],ac[document_checklist_creation]","ac[document_checkList]")' name="ac[document_checkList]" class="form-control cri" ac><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="as"><select onchange='hide("as[document_checklist_upload],as[document_checklist_creation]","as[document_checkList]")' name="as[document_checkList]" class="form-control cri" as><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="at"><select onchange='hide("at[document_checklist_upload],at[document_checklist_creation]","at[document_checkList]")' name="at[document_checkList]" class="form-control cri" at><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="duplicate"><select onchange='hide("duplicate[document_checklist_upload],duplicate[document_checklist_creation]","duplicate[document_checkList]")' name="duplicate[document_checkList]" class="form-control cri duplicate"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="renewal"><select onchange='hide("renewal[document_checklist_upload],renewal[document_checklist_creation]","renewal[document_checkList]")' name="renewal[document_checkList]" class="form-control cri renewal"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="return"><select onchange='hide("return[document_checklist_upload],return[document_checklist_creation]","return[document_checkList]")' name="return[document_checkList]" class="form-control cri return"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="maintainence"><select onchange='hide("maintainence[document_checklist_upload],maintainence[document_checklist_creation]","maintainence[document_checkList]")' name="maintainence[document_checkList]" class="form-control cri maintainence"><option value="Y">Yes</option><option value="N">No</option></select></td>


                        </tr>
                        <tr>
                            <td>
                                <strong> Document Checklist Upload </strong>
                            </td>
                            <td class="acilppr"> <input type="file" class="form-control cri acilppr" name="acilppr[document_checklist_upload]" ></td>
                            <td class="ac"> <input type="file" class="form-control cri ac" name="ac[document_checklist_upload]" ></td>
                            <td class="as"> <input type="file" class="form-control cri as" name="as[document_checklist_upload]" ></td>
                            <td class="at"> <input type="file" class="form-control cri at" name="at[document_checklist_upload]" ></td>
                            <td class="duplicate"><input type="file" class="form-control cri duplicate" name="duplicate[document_checklist_upload]" ></td>
                            <td class="renewal"><input type="file" class="form-control cri renewal" name="renewal[document_checklist_upload]" ></td>
                            <td class="return"><input type="file" class="form-control cri return" name="return[document_checklist_upload]" ></td>
                            <td class="maintainence"><input type="file" class="form-control cri maintainence" name="maintainence[document_checklist_upload]" ></td>


                        </tr>
                        <tr>
                            <td>
                                <strong>Document Checklist Creation </strong>
                            </td>
                            <td class="acilppr">
                             <div id="acilppr_document_checklist_creation">
                                <?php foreach($applications as $app){ ?>
                                                        <label class="mt-checkbox"> <?php echo $app['name']; ?> 
                                                            <input value="<?php echo $app['docchk_id']; ?>" name='acilppr[document_checklist_creation][]' type="checkbox">
                                                            <span></span>
                                                        </label>  </br>                                                     
                                                  
                                  <?php } ?>  
                                                        </div>
                            </td>
                            <td class="ac"> <div id="ac_document_checklist_creation"> <?php foreach($applications as $app){ ?>
                                                        <label class="mt-checkbox"> <?php echo $app['name']; ?> 
                                                            <input value="<?php echo $app['docchk_id']; ?>" name='ac[document_checklist_creation][]' type="checkbox">
                                                            <span></span>
                                                        </label>  </br>  
                            <?php } ?>
                                                   
 </div>                            </td>
                            <td class="as"> <div id="as_document_checklist_creation"> <?php foreach($applications as $app){ ?>
                                                        <label class="mt-checkbox"> <?php echo $app['name']; ?> 
                                                            <input value="<?php echo $app['docchk_id']; ?>" name='as[document_checklist_creation][]' type="checkbox">
                                                            <span></span>
                                                        </label>  </br>  
                            <?php } ?>
                                                   
 </div>                            </td>
                            <td class="at"> <div id="at_document_checklist_creation"> <?php foreach($applications as $app){ ?>
                                                        <label class="mt-checkbox"> <?php echo $app['name']; ?> 
                                                            <input value="<?php echo $app['docchk_id']; ?>" name='at[document_checklist_creation][]' type="checkbox">
                                                            <span></span>
                                                        </label>  </br>  
                            <?php } ?>
                                                   
 </div>                            </td>
                            <td class="duplicate">  <div id="duplicate_document_checklist_creation"> <?php foreach($applications as $app){ ?>
                                                        <label class="mt-checkbox"> <?php echo $app['name']; ?> 
                                                            <input value="<?php echo $app['docchk_id']; ?>" name='duplicate[document_checklist_creation][]' type="checkbox">
                                                            <span></span>
                                                        </label>  </br>                                                     
                                  <?php } ?>                                                    </div>

                            </td>
                            <td class="renewal">
                                <div id="renewal_document_checklist_creation">
 <?php foreach($applications as $app){ ?>
                                                        <label class="mt-checkbox"> <?php echo $app['name']; ?> 
                                                            <input value="<?php echo $app['docchk_id']; ?>" name='renewal[document_checklist_creation][]' type="checkbox">
                                                            <span></span>
                                                        </label>  </br>                                                     
                                                   
                                  <?php } ?> </div>
                            </td>
                            <td class="return">   <div id="return_document_checklist_creation">  <?php foreach($applications as $app){ ?>
                                                        <label class="mt-checkbox"> <?php echo $app['name']; ?> 
                                                            <input value="<?php echo $app['docchk_id']; ?>" name='return[document_checklist_creation][]' type="checkbox">
                                                            <span></span>
                                                        </label>  </br>                                                     
                                                    
                                  <?php } ?>                                                    </div>

                            </td>
                            <td class="maintainence"> <div id="maintainence_document_checklist_creation"> <?php foreach($applications as $app){ ?>
                                <label class="mt-checkbox"> <?php echo $app['name']; ?> 
                                                            <input value="<?php echo $app['docchk_id']; ?>" name='maintainence[document_checklist_creation][]' type="checkbox">
                                                            <span></span>
                                                        </label>   </br>                                                    
                                                   
                                  <?php } ?> </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Comments </strong>
                            </td>
                            <td class="acilppr"><textarea name="acilppr[comment]" class="form-control cri"></textarea></td>
                            <td class="ac"><textarea name="ac[comment]" class="form-control cri"></textarea></td>
                            <td class="as"><textarea name="as[comment]" class="form-control cri"></textarea></td>
                            <td class="at"><textarea name="at[comment]" class="form-control cri"></textarea></td>
                            <td class="duplicate"><textarea name="duplicate[comment]" class="form-control cri"></textarea></td>
                            <td class="renewal"><textarea name="renewal[comment]" class="form-control cri"></textarea></td>
                            <td class="return"><textarea name="return[comment]" class="form-control cri"></textarea></td>
                            <td class="maintainence"><textarea name="maintainence[comment]" class="form-control cri"></textarea></td>

                        </tr>
                    </tbody>
                </table>
                <input type="submit" value="Save" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>

<script>
    
    $(document).ready(function () {
        $(".cri").each(function () {
            var str = $(this).attr("name");
            var res = str.replace("]", "");
            var res1 = res.replace("[", "_");
            $(this).attr("id", res1);
        });
    });

      function hide(nme,frm) {
       var frm1 = frm.replace("]", "");
            var frm2= frm1.replace("[", "_");
         var choosenOption = document.getElementById(frm2).value;           
        var nme1 = nme.split(",");
        for (var i = 0; i <= nme1.length; i++) {
            var res = nme1[i].replace("]", "");
            var res1 = res.replace("[", "_");
            if (choosenOption== "Y") {
                $("#" + res1).css("display", "block");
            } else {
                $("#" + res1).css("display", "none");
            }
         }
    }
 <?php if(!in_array("Amendment - Cancellation",$allsubservices)) { ?> $(".aisct").remove();  <?php } ?>
    <?php if(!in_array("Duplicate Copy",$allsubservices)) { ?> $(".duplicate").remove();   <?php } ?>
    <?php if(!in_array("Renewal",$allsubservices)) { ?> $(".renewal").remove(); <?php } ?>
    <?php if(!in_array("Return",$allsubservices)) { ?> $(".return").remove();  <?php } ?>
    <?php if(!in_array("Maintenance of Register",$allsubservices)) { ?> $(".maintainence").remove();  <?php } ?>


</script>