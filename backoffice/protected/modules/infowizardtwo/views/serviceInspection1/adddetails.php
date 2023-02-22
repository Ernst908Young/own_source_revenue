  <?php $allsubservices=explode(",",$serviceData['additional_sub_service']);?>

                 

<style>

    <?php //if(!in_array("Amendment including cancellation Surrender Transfer",$allsubservices)) { ?> .aisct{display: none;}  <?php //} ?>
    
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

                                                <div class="col-md-3 bg-grey  mt-step-col ">

                                                    <div class="mt-step-number bg-white font-grey">2</div>

                                                    <div class="mt-step-title uppercase font-grey-cascade">Parameter</div>

                                                    <div class="mt-step-content font-grey-cascade"> Form</div>

                                                </div>

                                                <div class="col-md-3 bg-grey  mt-step-col done active">

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

            <i style=" font-size:20px;" class='fa fa-plus'></i><b>Sub Form-2 Inspection </b> <span class="pull-right">&nbsp;&nbsp;&nbsp;&nbsp;Create Service Inspection for <strong><?php echo $serviceData['service_name']?></strong></span></div>

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

                                <strong> Duplicate Copy</strong>

                                   

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

                                <strong>Are Inspections required ?</strong>

                            </td>

                            <td class="acilppr"><select name="acilppr[is_inspection_required]" class="acilppr form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="ac"><select name="ac[is_inspection_required]" class="ac  form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="as"><select name="as[is_inspection_required]" class="as form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="at"><select name="at[is_inspection_required]" class="at form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="duplicate"><select name="duplicate[is_inspection_required]" class="duplicate form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="renewal"><select name="renewal[is_inspection_required]" class="renewal form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="return"><select name="return[is_inspection_required]" class="return form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="maintainence"><select name="maintainence[is_inspection_required]" class="maintainence form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>

                        </tr>

                        <tr>

                            <td>

                                <strong>Is the Inspection Mandatory ? </strong>

                            </td>

                            <td class="acilppr"><select name="acilppr[is_inspection_mandatory]" class="acilppr form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="ac"><select name="ac[is_inspection_mandatory]" class="ac form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="as"><select name="as[is_inspection_mandatory]" class="as form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="at"><select name="at[is_inspection_mandatory]" class="at form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="duplicate"><select name="duplicate[is_inspection_mandatory]" class="duplicate form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="renewal"><select name="renewal[is_inspection_mandatory]" class="renewal form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="return"><select name="return[is_inspection_mandatory]" class="return form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="maintainence"><select name="maintainence[is_inspection_mandatory]" class="maintainence form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>



                        </tr>

                         <tr>

                            <td><strong>Is there a fee required for Inspection ? </strong></td>

                            <td class="acilppr"><select name="acilppr[is_fee_required]" class="acilppr form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="ac"><select name="aisct[is_fee_required]" class="ac form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="as"><select name="aisct[is_fee_required]" class="as form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="at"><select name="aisct[is_fee_required]" class="at form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="duplicate"><select name="duplicate[is_fee_required]" class="duplicate form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="renewal"><select name="renewal[is_fee_required]" class="renewal form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="return"><select name="return[is_fee_required]" class="return form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="maintainence"><select name="maintainence[is_fee_required]" class="maintainence form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>

                        </tr>

                        <tr>

                            <td>

                                <strong>Is Self Certification Allowed in lieu of Inspection ? </strong>

                            </td>

                 <td class="acilppr"><select onchange='hide("acilppr[self_certification_creation],acilppr[self_certification_excerpt_from_act],acilppr[self_certification_format]","acilppr[is_self_creation_allowed_in_lieu_of_inspection]")' name="acilppr[is_self_creation_allowed_in_lieu_of_inspection]" class="acilppr form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="ac"><select onchange='hide("ac[self_certification_creation],ac[self_certification_excerpt_from_act],ac[self_certification_format]","ac[is_self_creation_allowed_in_lieu_of_inspection]")' name="ac[is_self_creation_allowed_in_lieu_of_inspection]" class="ac form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="as"><select onchange='hide("as[self_certification_creation],as[self_certification_excerpt_from_act],as[self_certification_format]","as[is_self_creation_allowed_in_lieu_of_inspection]")' name="as[is_self_creation_allowed_in_lieu_of_inspection]" class="as form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="at"><select onchange='hide("at[self_certification_creation],at[self_certification_excerpt_from_act],at[self_certification_format]","at[is_self_creation_allowed_in_lieu_of_inspection]")' name="at[is_self_creation_allowed_in_lieu_of_inspection]" class="at form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="duplicate"><select onchange='hide("duplicate[self_certification_creation],duplicate[self_certification_excerpt_from_act],duplicate[self_certification_format]","duplicate[is_self_creation_allowed_in_lieu_of_inspection]")'  name="duplicate[is_self_creation_allowed_in_lieu_of_inspection]" class="duplicate form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="renewal"><select onchange='hide("renewal[self_certification_creation],renewal[self_certification_excerpt_from_act],renewal[self_certification_format]","renewal[is_self_creation_allowed_in_lieu_of_inspection]")' name="renewal[is_self_creation_allowed_in_lieu_of_inspection]" class="renewal form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="return"><select onchange='hide("return[self_certification_creation],return[self_certification_excerpt_from_act],return[self_certification_format]","return[is_self_creation_allowed_in_lieu_of_inspection]")' name="return[is_self_creation_allowed_in_lieu_of_inspection]" class="return form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="maintainence"><select onchange='hide("maintainence[self_certification_creation],maintainence[self_certification_excerpt_from_act],maintainence[self_certification_format]","maintainence[is_self_creation_allowed_in_lieu_of_inspection]")'name="maintainence[is_self_creation_allowed_in_lieu_of_inspection]" class="maintainence form-control cri"><option value="Y">Yes</option><option value="N">No</option></select></td>

                       

                        </tr>

                           <tr>

                            <td>

                                <strong>If Y, then upload relevant GO/ Excerpt from Act </strong>

                            </td>

                            <td class="acilppr"> <input type="file" class="form-control cri acilppr" name="acilppr[self_certification_excerpt_from_act]" ></td>

                            <td class="ac"> <input type="file" class="form-control cri ac" name="ac[self_certification_excerpt_from_act]" ></td>
                            <td class="as"> <input type="file" class="form-control cri as" name="as[self_certification_excerpt_from_act]" ></td>
                            <td class="at"> <input type="file" class="form-control cri at" name="at[self_certification_excerpt_from_act]" ></td>

                            <td class="duplicate"><input type="file" class="form-control cri duplicate" name="duplicate[self_certification_excerpt_from_act]" ></td>

                            <td class="renewal"><input type="file" class="form-control cri renewal" name="renewal[self_certification_excerpt_from_act]" ></td>

                            <td class="return"><input type="file" class="form-control cri return" name="return[self_certification_excerpt_from_act]" ></td>

                            <td class="maintainence"><input type="file" class="form-control cri maintainence" name="maintainence[self_certification_excerpt_from_act]" ></td>





                        </tr>

                           <tr>

                            <td>

                                <strong>If Y , then upload Self-certification Format </strong>

                            </td>

                            <td class="acilppr"> <input type="file" class="form-control cri acilppr" name="acilppr[self_certification_format]" ></td>

                            <td class="ac"> <input type="file" class="form-control cri ac" name="ac[self_certification_format]" ></td>
                            <td class="as"> <input type="file" class="form-control cri as" name="as[self_certification_format]" ></td>
                            <td class="at"> <input type="file" class="form-control cri at" name="at[self_certification_format]" ></td>

                            <td class="duplicate"><input type="file" class="form-control cri duplicate" name="duplicate[self_certification_format]" ></td>

                            <td class="renewal"><input type="file" class="form-control cri renewal" name="renewal[self_certification_format]" ></td>

                            <td class="return"><input type="file" class="form-control cri return" name="return[self_certification_format]" ></td>

                            <td class="maintainence"><input type="file" class="form-control cri maintainence" name="maintainence[self_certification_format]" ></td>





                        </tr>

                        <tr>

                            <td>

                                <strong>Self Certification Format Creation</strong>

                            </td>

                            <td class="acilppr"> <a href="javascript:;" class="cri" name="acilppr[self_certification_creation]">Sub Form Link </a></td>

                            <td class="ac"> <a href="javascript:;" class="cri" name="ac[self_certification_creation]">Sub Form Link </a></td>
                            <td class="as"> <a href="javascript:;" class="cri" name="as[self_certification_creation]">Sub Form Link </a></td>
                            <td class="at"> <a href="javascript:;" class="cri" name="at[self_certification_creation]">Sub Form Link </a></td>

                            <td class="duplicate"> <a href="javascript:;" class="cri" name="duplicate[self_certification_creation]">Sub Form Link </a></td>

                            <td class="renewal"> <a href="javascript:;" class="cri" name="renewal[self_certification_creation]">Sub Form Link </a></td>

                            <td class="return"> <a href="javascript:;" class="cri" name="return[self_certification_creation]">Sub Form Link </a></td>

                            <td class="maintainence"> <a href="javascript:;" class="cri" name="maintainence[self_certification_creation]">Sub Form Link </a></td>



                        </tr>



                                            <tr>

                            <td>

                                <strong>Is Third Party Certification allowed in lieu of Departmental Inspection ? </strong>

                            </td>

                            <td class="acilppr"><select onchange='hide("acilppr[third_party_excerpt_from],acilppr[third_party_cettification_format],acilppr[inspecion_report_timeline]","acilppr[is_third_party_certification_allowed]")' name="acilppr[is_third_party_certification_allowed]" class="form-control cri acilppr"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="ac"><select onchange='hide("ac[third_party_excerpt_from],ac[third_party_cettification_format],ac[inspecion_report_timeline]","ac[is_third_party_certification_allowed]")' name="ac[is_third_party_certification_allowed]" class="form-control cri" ac><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="as"><select onchange='hide("as[third_party_excerpt_from],as[third_party_cettification_format],as[inspecion_report_timeline]","as[is_third_party_certification_allowed]")' name="as[is_third_party_certification_allowed]" class="form-control cri" as><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="at"><select onchange='hide("at[third_party_excerpt_from],at[third_party_cettification_format],at[inspecion_report_timeline]","at[is_third_party_certification_allowed]")' name="at[is_third_party_certification_allowed]" class="form-control cri at"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="duplicate"><select onchange='hide("duplicate[third_party_excerpt_from],duplicate[third_party_cettification_format],duplicate[inspecion_report_timeline]","duplicate[is_third_party_certification_allowed]")' name="duplicate[is_third_party_certification_allowed]" class="form-control cri duplicate"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="renewal"><select onchange='hide("renewal[third_party_excerpt_from],renewal[third_party_cettification_format],renewal[inspecion_report_timeline]","renewal[is_third_party_certification_allowed]")' name="renewal[is_third_party_certification_allowed]" class="form-control cri renewal"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="return"><select onchange='hide("return[third_party_excerpt_from],return[third_party_cettification_format],return[inspecion_report_timeline]","return[is_third_party_certification_allowed]")' name="return[is_third_party_certification_allowed]" class="form-control cri return"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="maintainence"><select onchange='hide("acilppr[third_party_excerpt_from],acilppr[third_party_cettification_format],acilppr[inspecion_report_timeline]","acilppr[is_third_party_certification_allowed]")' name="maintainence[is_third_party_certification_allowed]" class="form-control cri maintainence"><option value="Y">Yes</option><option value="N">No</option></select></td>



                        </tr>

                        <tr>

                            <td>

                                <strong>If Y, then upload relevant GO/ Excerpt from Act </strong>

                            </td>

                            <td class="acilppr"> <input type="file" class="form-control cri acilppr" name="acilppr[third_party_excerpt_from]" ></td>

                            <td class="ac"> <input type="file" class="form-control cri" ac name="ac[third_party_excerpt_from]" ></td>
                            <td class="as"> <input type="file" class="form-control cri" as  name="as[third_party_excerpt_from]" ></td>
                            <td class="at"> <input type="file" class="form-control cri" at name="at[third_party_excerpt_from]" ></td>

                            <td class="duplicate"><input type="file" class="form-control cri duplicate" name="duplicate[third_party_excerpt_from]" ></td>

                            <td class="renewal"><input type="file" class="form-control cri renewal" name="renewal[third_party_excerpt_from]" ></td>

                            <td class="return"><input type="file" class="form-control cri return" name="return[third_party_excerpt_from]" ></td>

                            <td class="maintainence"><input type="file" class="form-control cri maintainence" name="maintainence[third_party_excerpt_from]" ></td>





                        </tr>

                           <tr>

                            <td><strong>If Y , then upload Third Party Certification Format</strong></td>

                            <td class="acilppr"> <input type="file" class="form-control cri acilppr" name="acilppr[third_party_cettification_format]" ></td>

                            <td class="ac"> <input type="file" class="form-control cri ac" name="ac[third_party_cettification_format]" ></td>
                            <td class="as"> <input type="file" class="form-control cri as" name="as[third_party_cettification_format]" ></td>
                            <td class="at"> <input type="file" class="form-control cri at" name="at[third_party_cettification_format]" ></td>

                            <td class="duplicate"><input type="file" class="form-control cri duplicate" name="duplicate[third_party_cettification_format]" ></td>

                            <td class="renewal"><input type="file" class="form-control cri renewal" name="renewal[third_party_cettification_format]" ></td>

                            <td class="return"><input type="file" class="form-control cri return" name="return[third_party_cettification_format]" ></td>

                            <td class="maintainence"><input type="file" class="form-control cri maintainence" name="maintainence[third_party_cettification_format]" ></td>

                        </tr>



                            <tr>

                            <td>

                                <strong>Timeline for Inspection Report Submission</strong>

                            </td>

                            <td class="acilppr"> <input type="text" class="form-control cri acilppr" name="acilppr[inspecion_report_timeline]" placeholder="Hours / Days"></td>

                            <td class="ac"> <input type="text" class="form-control cri ac" name="ac[inspecion_report_timeline]" placeholder="Hours / Days"></td>
                            <td class="as"> <input type="text" class="form-control cri as" name="as[inspecion_report_timeline]" placeholder="Hours / Days"></td>
                            <td class="at"> <input type="text" class="form-control cri at" name="at[inspecion_report_timeline]" placeholder="Hours / Days"></td>

                            <td class="duplicate"><input type="text" class="form-control cri duplicate" name="duplicate[inspecion_report_timeline]" placeholder="Hours / Days"></td>

                            <td class="renewal"><input type="text" class="form-control cri renewal" name="renewal[inspecion_report_timeline]" placeholder="Hours / Days"></td>

                            <td class="return"><input type="text" class="form-control cri return" name="return[inspecion_report_timeline]" placeholder="Hours / Days"></td>

                            <td class="maintainence"><input type="text" class="form-control cri maintainence" name="maintainence[inspecion_report_timeline]" placeholder="Hours / Days"></td>

                        </tr>



                                   <tr>

                            <td>

                                <strong>Is the Inspection Checklist Available ?</strong>

                            </td>

                            <td class="acilppr"><select onchange='hide("acilppr[inspection_checklist_format_creation],acilppr[inspection_excerpt_from_act],acilpprs[inspection_checklist_format]","acilppr[is_inspection_checklist_available]")' name="acilppr[is_inspection_checklist_available]"  class="form-control cri acilppr"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="ac"><select onchange='hide("ac[inspection_checklist_format_creation],ac[inspection_excerpt_from_act],ac[inspection_checklist_format]","ac[is_inspection_checklist_available]")' name="ac[is_inspection_checklist_available]" class="form-control cri" aisct><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="as"><select onchange='hide("as[inspection_checklist_format_creation],as[inspection_excerpt_from_act],as[inspection_checklist_format]","as[is_inspection_checklist_available]")' name="as[is_inspection_checklist_available]" class="form-control cri" aisct><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="at"><select onchange='hide("at[inspection_checklist_format_creation],at[inspection_excerpt_from_act],at[inspection_checklist_format]","at[is_inspection_checklist_available]")' name="at[is_inspection_checklist_available]" class="form-control cri" aisct><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="duplicate"><select onchange='hide("duplicate[inspection_checklist_format_creation],duplicate[inspection_excerpt_from_act],duplicate[inspection_checklist_format]","duplicate[is_inspection_checklist_available]")' name="duplicate[is_inspection_checklist_available]" class="form-control cri duplicate"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="renewal"><select onchange='hide("renewal[inspection_checklist_format_creation],renewal[inspection_excerpt_from_act],renewal[inspection_checklist_format]","renewal[is_inspection_checklist_available]")' name="renewal[is_inspection_checklist_available]" class="form-control cri renewal"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="return"><select onchange='hide("return[inspection_checklist_format_creation],return[inspection_excerpt_from_act],return[inspection_checklist_format]","return[is_inspection_checklist_available]")' name="return[is_inspection_checklist_available]" class="form-control cri return"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="maintainence"><select onchange='hide("maintainence[inspection_checklist_format_creation],maintainence[inspection_excerpt_from_act],maintainence[inspection_checklist_format]","maintainence[is_inspection_checklist_available]")' name="maintainence[is_inspection_checklist_available]" class="form-control cri maintainence"><option value="Y">Yes</option><option value="N">No</option></select></td>





                        </tr>

                        <tr>

                            <td>

                                <strong>If Y, then upload relevant GO/ Excerpt from Act ?</strong>

                            </td>

                            <td class="acilppr"> <input type="file" class="form-control cri acilppr" name="acilppr[inspection_excerpt_from_act]" ></td>

                            <td class="ac"> <input type="file" class="form-control cri ac" name="ac[inspection_excerpt_from_act]" ></td>
                            <td class="as"> <input type="file" class="form-control cri as" name="as[inspection_excerpt_from_act]" ></td>
                            <td class="at"> <input type="file" class="form-control cri at" name="at[inspection_excerpt_from_act]" ></td>

                            <td class="duplicate"><input type="file" class="form-control cri duplicate" name="duplicate[inspection_excerpt_from_act]" ></td>

                            <td class="renewal"><input type="file" class="form-control cri renewal" name="renewal[inspection_excerpt_from_act]" ></td>

                            <td class="return"><input type="file" class="form-control cri return" name="return[inspection_excerpt_from_act]" ></td>

                            <td class="maintainence"><input type="file" class="form-control cri maintainence" name="maintainence[inspection_excerpt_from_act]" ></td>

                        

                        </tr>



                        <tr><td><strong>If Y , then upload Inspection Checklist Format</strong></td>

                            <td class="acilppr"> <input type="file" class="form-control cri acilppr" name="acilpprs[inspection_checklist_format]" ></td>

                            <td class="ac"> <input type="file" class="form-control cri ac" name="ac[inspection_checklist_format]" ></td>
                            <td class="as"> <input type="file" class="form-control cri as" name="as[inspection_checklist_format]" ></td>
                            <td class="at"> <input type="file" class="form-control cri at" name="at[inspection_checklist_format]" ></td>

                            <td class="duplicate"><input type="file" class="form-control cri duplicate" name="duplicate[inspection_checklist_format]" ></td>

                            <td class="renewal"><input type="file" class="form-control cri renewal" name="renewal[inspection_checklist_format]" ></td>

                            <td class="return"><input type="file" class="form-control cri return" name="return[inspection_checklist_format]" ></td>

                            <td class="maintainence"><input type="file" class="form-control cri maintainence" name="maintainence[inspection_checklist_format]" ></td>

                         </tr>



                          <tr>

                            <td>

                                <strong>Inspection Checklist Format Creation</strong>

                            </td>

                            <td class="acilppr"> <a href="javascript:;" class="cri" name="acilppr[inspection_checklist_format_creation]">Sub Form Link </a></td>

                            <td class="ac"> <a href="javascript:;" class="cri" name="aisct[inspection_checklist_format_creation]">Sub Form Link </a></td>
                            <td class="as"> <a href="javascript:;" class="cri" name="aisct[inspection_checklist_format_creation]">Sub Form Link </a></td>
                            <td class="at"> <a href="javascript:;" class="cri" name="aisct[inspection_checklist_format_creation]">Sub Form Link </a></td>

                            <td class="duplicate"> <a href="javascript:;" class="cri" name="duplicate[inspection_checklist_format_creation]">Sub Form Link </a></td>

                            <td class="renewal"> <a href="javascript:;" class="cri" name="renewal[inspection_checklist_format_creation]">Sub Form Link </a></td>

                            <td class="return"> <a href="javascript:;" class="cri" name="return[inspection_checklist_format_creation]">Sub Form Link </a></td>

                            <td class="maintainence"> <a href="javascript:;" class="cri" name="maintainence[inspection_checklist_format_creation]">Sub Form Link </a></td>



                        </tr>

   <tr>

                            <td>

                                <strong>Are there Periodic Inspections mandated for the Service ? </strong>

                            </td>

                            <td class="acilppr"><select name="acilppr[periodic_inspection_mandate_for_service]"  class="form-control cri acilppr"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="ac"><select  name="ac[periodic_inspection_mandate_for_service]" class="form-control cri ac"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="as"><select  name="as[periodic_inspection_mandate_for_service]" class="form-control cri as"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="at"><select  name="at[periodic_inspection_mandate_for_service]" class="form-control cri at"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="duplicate"><select name="duplicate[periodic_inspection_mandate_for_service]" class="form-control cri duplicate"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="renewal"><select  name="renewal[periodic_inspection_mandate_for_service]" class="form-control cri renewal"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="return"><select  name="return[periodic_inspection_mandate_for_service]" class="form-control cri return"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="maintainence"><select  name="maintainence[periodic_inspection_mandate_for_service]" class="form-control cri maintainence"><option value="Y">Yes</option><option value="N">No</option></select></td>





                        </tr>



                     

                            <tr><td><strong>Checklist Available for Peridic Inspections</strong></td>

                             <td class="acilppr"><select onchange='hide("acilppr[upload_periodic_checklist_format]","acilppr[checklist_periodic_inspection_avilable]")' name="acilppr[checklist_periodic_inspection_avilable]"  class="form-control cri acilppr"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="ac"><select onchange='hide("ac[upload_periodic_checklist_format]","ac[checklist_periodic_inspection_avilable]")' name="ac[checklist_periodic_inspection_avilable]" class="form-control cri ac"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="as"><select onchange='hide("as[upload_periodic_checklist_format]","as[checklist_periodic_inspection_avilable]")' name="as[checklist_periodic_inspection_avilable]" class="form-control cri as"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="at"><select onchange='hide("at[upload_periodic_checklist_format]","at[checklist_periodic_inspection_avilable]")' name="at[checklist_periodic_inspection_avilable]" class="form-control cri at"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="duplicate"><select onchange='hide("duplicate[upload_periodic_checklist_format]","duplicate[checklist_periodic_inspection_avilable]")' name="duplicate[checklist_periodic_inspection_avilable]" class="form-control cri duplicate"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="renewal"><select onchange='hide("renewal[upload_periodic_checklist_format]","renewal[checklist_periodic_inspection_avilable]")' name="renewal[checklist_periodic_inspection_avilable]" class="form-control cri renewal"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="return"><select onchange='hide("return[upload_periodic_checklist_format]","return[checklist_periodic_inspection_avilable]")' name="return[checklist_periodic_inspection_avilable]" class="form-control cri return"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="maintainence"><select onchange='hide("maintainence[upload_periodic_checklist_format]","maintainence[checklist_periodic_inspection_avilable]")' name="maintainence[checklist_periodic_inspection_avilable]" class="form-control cri maintainence"><option value="Y">Yes</option><option value="N">No</option></select></td>



                         </tr>



                       

                      

                        <tr>

                            <td>

                                <strong>If Yes, Then Upload Periodic Checklist Format</strong>

                            </td>

                            <td class="acilppr"> <input type="file" class="form-control cri acilppr" name="acilppr[upload_periodic_checklist_format]" ></td>

                            <td class="ac"> <input type="file" class="form-control cri ac" name="ac[upload_periodic_checklist_format]" ></td>
                            <td class="as"> <input type="file" class="form-control cri as" name="as[upload_periodic_checklist_format]" ></td>
                            <td class="at"> <input type="file" class="form-control cri at" name="at[upload_periodic_checklist_format]" ></td>

                            <td class="duplicate"><input type="file" class="form-control cri duplicate" name="duplicate[upload_periodic_checklist_format]" ></td>

                            <td class="renewal"><input type="file" class="form-control cri renewal" name="renewal[upload_periodic_checklist_format]" ></td>

                            <td class="return"><input type="file" class="form-control cri return" name="return[upload_periodic_checklist_format]" ></td>

                            <td class="maintainence"><input type="file" class="form-control cri maintainence" name="maintainence[upload_periodic_checklist_format]" ></td>

                        </tr>

                        

                          <tr>

                            <td>

                                <strong>Are Surprise Inspections allowed in the Service ?</strong>

                            </td>

                            <td class="acilppr"><select onchange='hide("acilppr[upload_periodic_checklist_format_sruprise]","acilppr[is_surprise_inspection_allowed_in_service]")' name="acilppr[is_surprise_inspection_allowed_in_service]" class="form-control cri acilppr"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="ac"><select onchange='hide("ac[upload_periodic_checklist_format_sruprise]","ac[is_surprise_inspection_allowed_in_service]")' name="ac[is_surprise_inspection_allowed_in_service]" class="form-control cri ac"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="as"><select onchange='hide("as[upload_periodic_checklist_format_sruprise]","as[is_surprise_inspection_allowed_in_service]")' name="as[is_surprise_inspection_allowed_in_service]" class="form-control cri as"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="at"><select onchange='hide("at[upload_periodic_checklist_format_sruprise]","at[is_surprise_inspection_allowed_in_service]")' name="at[is_surprise_inspection_allowed_in_service]" class="form-control cri at"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="duplicate"><select onchange='hide("duplicate[upload_periodic_checklist_format_sruprise]","duplicate[is_surprise_inspection_allowed_in_service]")' name="duplicate[is_surprise_inspection_allowed_in_service]" class="form-control cri duplicate"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="renewal"><select onchange='hide("renewal[upload_periodic_checklist_format_sruprise]","renewal[is_surprise_inspection_allowed_in_service]")' name="renewal[is_surprise_inspection_allowed_in_service]" class="form-control cri renewal"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="return"><select onchange='hide("return[upload_periodic_checklist_format_sruprise]","return[is_surprise_inspection_allowed_in_service]")' name="return[is_surprise_inspection_allowed_in_service]" class="form-control cri return"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="maintainence"><select onchange='hide("maintainence[upload_periodic_checklist_format_sruprise]","maintainence[is_surprise_inspection_allowed_in_service]")' name="maintainence[is_surprise_inspection_allowed_in_service]" class="form-control cri maintainence"><option value="Y">Yes</option><option value="N">No</option></select></td>





                        </tr>

                    

                        

                          

                        <tr>

                            <td><strong>If Yes, Then Upload Periodic Checklist Format</strong></td>

                            <td class="acilppr"> <input type="file" class="form-control cri acilppr" name="acilppr[upload_periodic_checklist_format_sruprise]" ></td>

                            <td class="ac"> <input type="file" class="form-control cri ac" name="ac[upload_periodic_checklist_format_sruprise]" ></td>
                            <td class="as"> <input type="file" class="form-control cri as" name="as[upload_periodic_checklist_format_sruprise]" ></td>
                            <td class="at"> <input type="file" class="form-control cri at" name="at[upload_periodic_checklist_format_sruprise]" ></td>

                            <td class="duplicate"><input type="file" class="form-control cri duplicate" name="duplicate[upload_periodic_checklist_format_sruprise]" ></td>

                            <td class="renewal"><input type="file" class="form-control cri renewal" name="renewal[upload_periodic_checklist_format_sruprise]" ></td>

                            <td class="return"><input type="file" class="form-control cri return" name="return[upload_periodic_checklist_format_sruprise]" ></td>

                            <td class="maintainence"><input type="file" class="form-control cri maintainence" name="maintainence[upload_periodic_checklist_format_sruprise]" ></td>

     </tr>              <tr>

                            <td>

                                <strong>Checklist Available for Surprise Inspections</strong>

                            </td>

                            <td class="acilppr"><select onchange='hide("acilppr[document_checklist_upload],acilpprs[document_checklist_creation]","acilppr[is_surprise_inspection_allowed_in_service]")' name="acilppr[checklist_avilable_for_surprise]" class="form-control cri acilppr"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="ac"><select onchange='hide("ac[document_checklist_upload],ac[document_checklist_creation]","ac[is_surprise_inspection_allowed_in_service]")' name="ac[checklist_avilable_for_surprise]" class="form-control cri ac"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="as"><select onchange='hide("as[document_checklist_upload],as[document_checklist_creation]","as[is_surprise_inspection_allowed_in_service]")' name="as[checklist_avilable_for_surprise]" class="form-control cri as"><option value="Y">Yes</option><option value="N">No</option></select></td>
                            <td class="at"><select onchange='hide("at[document_checklist_upload],at[document_checklist_creation]","at[is_surprise_inspection_allowed_in_service]")' name="at[checklist_avilable_for_surprise]" class="form-control cri at"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="duplicate"><select onchange='hide("duplicate[document_checklist_upload],duplicate[document_checklist_creation]","duplicate[is_surprise_inspection_allowed_in_service]")' name="duplicate[checklist_avilable_for_surprise]" class="form-control cri duplicate"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="renewal"><select onchange='hide("renewal[document_checklist_upload],renewal[document_checklist_creation]","renewal[is_surprise_inspection_allowed_in_service]")' name="renewal[checklist_avilable_for_surprise]" class="form-control cri renewal"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="return"><select onchange='hide("return[document_checklist_upload],return[document_checklist_creation]","return[is_surprise_inspection_allowed_in_service]")' name="return[checklist_avilable_for_surprise]" class="form-control cri return"><option value="Y">Yes</option><option value="N">No</option></select></td>

                            <td class="maintainence"><select onchange='hide("maintainence[document_checklist_upload],maintainence[document_checklist_creation]","maintainence[is_surprise_inspection_allowed_in_service]")' name="maintainence[checklist_avilable_for_surprise]" class="form-control cri maintainence"><option value="Y">Yes</option><option value="N">No</option></select></td>





                        </tr>

                          <tr>

                            <td>

                                <strong>Basis of Surprise Inspection</strong>

                            </td>

                            <td class="acilppr"><select onchange='hide("acilppr[document_checklist_upload],acilpprs[document_checklist_creation]","acilppr[basic_of_surprise_inspection]")' name="acilppr[basic_of_surprise_inspection]" class="form-control cri acilppr"><option value="Compalaint">Compalaint</option><option value="Other">Other</option></select></td>

                            <td class="ac"><select onchange='hide("ac[document_checklist_upload],ac[document_checklist_creation]","ac[basic_of_surprise_inspection]")' name="ac[basic_of_surprise_inspection]" class="form-control cri ac"><option value="Compalaint">Compalaint</option><option value="Other">Other</option></select></td>
                            <td class="as"><select onchange='hide("as[document_checklist_upload],as[document_checklist_creation]","as[basic_of_surprise_inspection]")' name="as[basic_of_surprise_inspection]" class="form-control cri as"><option value="Compalaint">Compalaint</option><option value="Other">Other</option></select></td>
                            <td class="at"><select onchange='hide("at[document_checklist_upload],at[document_checklist_creation]","at[basic_of_surprise_inspection]")' name="at[basic_of_surprise_inspection]" class="form-control cri at"><option value="Compalaint">Compalaint</option><option value="Other">Other</option></select></td>

                            <td class="duplicate"><select onchange='hide("duplicate[document_checklist_upload],duplicate[document_checklist_creation]","duplicate[basic_of_surprise_inspection]")' name="duplicate[basic_of_surprise_inspection]" class="form-control cri duplicate"><option value="Compalaint">Compalaint</option><option value="Other">Other</option></select></td>

                            <td class="renewal"><select onchange='hide("renewal[document_checklist_upload],renewal[document_checklist_creation]","renewal[basic_of_surprise_inspection]")' name="renewal[basic_of_surprise_inspection]" class="form-control cri renewal"><option value="Compalaint">Compalaint</option><option value="Other">Other</option></select></td>

                            <td class="return"><select onchange='hide("return[document_checklist_upload],return[document_checklist_creation]","return[basic_of_surprise_inspection]")' name="return[basic_of_surprise_inspection]" class="form-control cri return"><option value="Compalaint">Compalaint</option><option value="Other">Other</option></select></td>

                            <td class="maintainence"><select onchange='hide("maintainence[document_checklist_upload],maintainence[document_checklist_creation]","maintainence[basic_of_surprise_inspection]")' name="maintainence[basic_of_surprise_inspection]" class="form-control cri maintainence"><option value="Compalaint">Compalaint</option><option value="Other">Other</option></select></td>





                        </tr>

                        <tr>

                            <td><strong>Comments </strong></td>

                            <td class="acilppr"><textarea name="acilppr[comment]" class="form-control cri"></textarea></td>

                            <td class="ac"><textarea name="aisct[comment]" class="form-control cri"></textarea></td>
                            <td class="as"><textarea name="aisct[comment]" class="form-control cri"></textarea></td>
                            <td class="at"><textarea name="aisct[comment]" class="form-control cri"></textarea></td>

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

         <?php if(!in_array("Amendment - Cancellation",$allsubservices)) { ?> .ac{display: none;}  <?php } ?>
    <?php if(!in_array("Amendment - Surrender",$allsubservices)) { ?> .as{display: none;}  <?php } ?>
    <?php if(!in_array("Amendment - Transfer",$allsubservices)) { ?> .at{display: none;}  <?php } ?>


    <?php if(!in_array("Duplicate Copy",$allsubservices)) { ?> $(".duplicate").remove();   <?php } ?>

    <?php if(!in_array("Renewal",$allsubservices)) { ?> $(".renewal").remove(); <?php } ?>

    <?php if(!in_array("Return",$allsubservices)) { ?> $(".return").remove();  <?php } ?>

    <?php if(!in_array("Maintenance of Register",$allsubservices)) { ?> $(".maintainence").remove();  <?php } ?>





</script>



