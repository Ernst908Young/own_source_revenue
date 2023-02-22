<?php  //echo "here";die; 

$allDocuments= InfowizardQuestionMasterExt::getDocumentMapping();
  //print_r($_SESSION['ServiceParameter']);die; 


$allsubservices = explode(",", $serviceData['additional_sub_service']); ?>                 
<style>
    <?php if (!in_array("Amendment - Others", $allsubservices)) { ?> .ao{display: none;}  <?php } ?>
    <?php if (!in_array("Amendment - Cancellation", $allsubservices)) { ?> .ac{display: none;}  <?php } ?>
    <?php if (!in_array("Amendment - Surrender", $allsubservices)) { ?> .as{display: none;}  <?php } ?>
    <?php if (!in_array("Amendment - Transfer", $allsubservices)) { ?> .at{display: none;}  <?php } ?>
    <?php if (!in_array("Duplicate Copy", $allsubservices)) { ?> .duplicate{display: none;}  <?php } ?>
    <?php if (!in_array("Renewal", $allsubservices)) { ?> .renewal{display: none;}  <?php } ?>
    <?php if (!in_array("Return", $allsubservices)) { ?> .return{display: none;}  <?php } ?>
    <?php if (!in_array("Maintenance of Register", $allsubservices)) { ?> .maintainence{display: none;}  <?php } ?>
</style>
<?php $allList = InfowizardQuestionMasterExt::getMasterList('bo_information_wizard_additional_sub_service_master', 'id', 'alias'); 
 $allList[0] = "acilppr";
      ksort($allList);
foreach ($allList as $k => $v) {
      if($v=="acilppr"){$serSubType='service'; $SubTypeId=0; $alishname['acilppr']='service';}
    if($v=="ao"){$serSubType='Amendment - Others'; $SubTypeId=1; $alishname['ao']='Amendment - Others'; }
    if($v=="ac"){$serSubType='Amendment - Cancellation'; $SubTypeId=2; $alishname['ac']='Amendment - Cancellation'; }
    if($v=="as"){$serSubType='Amendment - Surrender';  $SubTypeId=3; $alishname['as']='Amendment - Surrender'; }
    if($v=="at"){$serSubType='Amendment - Transfer';  $SubTypeId=4; $alishname['at']='Amendment - Transfer';}
    if($v=="duplicate"){$serSubType='Duplicate Copy'; $SubTypeId=5;  $alishname['duplicate']='Duplicate Copy';}
    if($v=="renewal"){$serSubType='Renewal'; $SubTypeId=6; $alishname['renewal']='Renewal'; }
    if($v=="return"){$serSubType='Return'; $SubTypeId=7; $alishname['return']='Return'; }
    if($v=="maintainence"){$serSubType='Maintenance of Register'; $SubTypeId=8; $alishname['maintainence']='Maintenance of Register';}
	
	}
    ?>

<style> 
    .page-sidebar.navbar-collapse.collapse {
        display: none !important;
    }   
    .page-content{margin-left:0px !important    ;}
    .col-md-1{width:12.50% !important;}
    .uppercase { font-size: 16px !important;

    }
</style>
<?php $serviceData['id'] = $_GET['serviceID']; ?>
<div class="portlet-body">
    <div class="mt-element-step">

        <div class="row step-thin">

            <div class="col-md-1 bg-grey  mt-step-col ">
                <div class="mt-step-number bg-white font-grey">1</div>
                <div class="mt-step-title uppercase font-grey-cascade"><a href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/serviceMaster/serviceupdate/serviceID/' . $serviceData['id'] . '') ?>" >Master</a></div>
                <div class="mt-step-content font-grey-cascade"> Form</div>
            </div>
            <div class="col-md-1 bg-grey  mt-step-col done">
                <div class="mt-step-number bg-white font-grey">2</div>
                <div class="mt-step-title uppercase font-grey-cascade"><a href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/serviceParameters/Addparams/serviceID/' . $serviceData['id'] . '') ?>" >Parameter</a></div>
                <div class="mt-step-content font-grey-cascade"> Form</div>
            </div>
            <div class="col-md-1 bg-grey  mt-step-col">
                <div class="mt-step-number bg-white font-grey">3</div>
                <div class="mt-step-content font-grey-cascade"><a href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/serviceInspection/Adddetails/serviceID/' . $serviceData['id'] . '') ?>" >Inspection </a></div>
                <div class="mt-step-content font-grey-cascade">Form</div>
            </div>
            <div class="col-md-1 bg-grey mt-step-col ">
                <div class="mt-step-number bg-white font-grey">4</div>
                <div class="mt-step-title uppercase font-grey-cascade"><a href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/serviceFee/Adddetails/serviceID/' . $serviceData['id'] . '') ?>" >Fee</a></div>
                <div class="mt-step-content font-grey-cascade">Form</div>
            </div>
            <div class="col-md-1 bg-grey mt-step-col ">
                <div class="mt-step-number bg-white font-grey">5</div>
                <div class="mt-step-title uppercase font-grey-cascade"><a href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/ServiceTimeline/create/serviceID/' . $serviceData['id'] . '') ?>" >Timelines</a></div>
                <div class="mt-step-content font-grey-cascade">Form</div>
            </div>
            <div class="col-md-1 bg-grey  mt-step-col">
                <div class="mt-step-number bg-white font-grey">6</div>
                <div class="mt-step-title uppercase font-grey-cascade"><a href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/ServiceStackholder/create/serviceID/' . $serviceData['id'] . '') ?>" >Stakeholders</a></div>
                <div class="mt-step-content font-grey-cascade">Form</div>
            </div>

            <div class="col-md-1 bg-grey  mt-step-col ">
                <div class="mt-step-number bg-white font-grey">7</div>

                <div class="mt-step-title uppercase font-grey-cascade"><a href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/ServiceValidity/create/serviceID/' . $serviceData['id'] . '') ?>" >Validity</a></div>
                <div class="mt-step-content font-grey-cascade"> Form</div>
            </div>
            <div class="col-md-1 bg-grey  mt-step-col ">
                <div class="mt-step-number bg-white font-grey">8</div>
                <div class="mt-step-title uppercase font-grey-cascade"><a href="<?php echo Yii::app()->createAbsoluteUrl('infowizard/ServiceValidity/other/serviceID/' . $serviceData['id'] . '') ?>" >Other </a></div>
                <div class="mt-step-content font-grey-cascade">  Option</div>
            </div>

        </div>


    </div>
</div>
<div class='portlet box green'>
    <!--    <div class='portlet-title'>
            <div class='caption'>
                <i style=" font-size:20px;" class='fa fa-plus'></i><b>Sub Form-1 Service Parameter  </b>   Create Service Parameter for <strong><?php echo $serviceData['service_name'] ?></strong></div>
            <div class='tools'>
    
            </div>-->

</div>
<div class="portlet-body" style="padding:0px;padding-bottom: 15px;">
    <div class="table-scrollable">
        <form name="" action="" method="POST">
            <input type="hidden" name="service_id" value="<?php echo $serviceData['id'] ?>">
            <input type="hidden" name="service_type[]" value="<?php echo $serviceData['service_type'] ?>">

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
                        <th class="ao">
                            <strong>
                                Amendment<br>Others 
                                <?php
                                $allDepartmentServiceList = InfowizardQuestionMasterExt::getMasterList('bo_sp_all_applications', 'app_id', 'app_name', 'department_name', 'Labour');
                                //   print_r($allDepartmentServiceList);
                                ?>
                            </strong>
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
                            <strong>Service Name <span style="color:red">*</span></strong>
                        </td>
                        <td class="acilppr"><input name="acilppr[core_service_name]" required class="acilppr form-control cri" value="<?php if (!empty($_SESSION['ServiceParameter']['service'])) {
                                    echo $_SESSION['ServiceParameter']['service']['core_service_name'];
                                } ?>"  /></td>
                        <td class="ao"><input name="ao[core_service_name]"  <?php if (in_array("Amendment - Others", $allsubservices)) { ?> required <?php } ?> class="ao form-control cri" value="<?php if (!empty($_SESSION['ServiceParameter']['Amendment - Others'])) {
                                    echo $_SESSION['ServiceParameter']['Amendment - Others']['core_service_name'];
                                } ?>"  /></td>
                        <td class="ac"><input name="ac[core_service_name]"  <?php if (in_array("Amendment - Cancellation", $allsubservices)) { ?> required <?php } ?> class="ac form-control cri" value="<?php if (!empty($_SESSION['ServiceParameter']['Amendment - Cancellation'])) {
                                    echo $_SESSION['ServiceParameter']['Amendment - Cancellation']['core_service_name'];
                                } ?>"  /></td>
                        <td class="as"><input name="as[core_service_name]"  <?php if (in_array("Amendment - Surrender", $allsubservices)) { ?> required <?php } ?> class="as form-control cri" value="<?php if (!empty($_SESSION['ServiceParameter']['Amendment - Surrender'])) {
                                    echo $_SESSION['ServiceParameter']['Amendment - Surrender']['core_service_name'];
                                } ?>"  /></td>
                        <td class="at"><input name="at[core_service_name]"  <?php if (in_array("Amendment - Transfer", $allsubservices)) { ?> required <?php } ?> class="at form-control cri" value="<?php if (!empty($_SESSION['ServiceParameter']['Amendment - Transfer'])) {
                                    echo $_SESSION['ServiceParameter']['Amendment - Transfer']['core_service_name'];
                                } ?>"  /></td>
                        <td class="duplicate"><input name="duplicate[core_service_name]"  <?php if (in_array("Duplicate Copy", $allsubservices)) { ?> required <?php } ?> class="duplicate form-control cri" value="<?php if (!empty($_SESSION['ServiceParameter']['Duplicate Copy'])) {
                                    echo $_SESSION['ServiceParameter']['Duplicate Copy']['core_service_name'];
                                } ?>"  /></td>
                        <td class="renewal"><input name="renewal[core_service_name]"  <?php if (in_array("Renewal", $allsubservices)) { ?> required <?php } ?> class="renewal form-control cri" value="<?php if (!empty($_SESSION['ServiceParameter']['Renewal'])) {
                                    echo $_SESSION['ServiceParameter']['Renewal']['core_service_name'];
                                } ?>"  /></td>
                        <td class="return"><input name="return[core_service_name]"  <?php if (in_array("Return", $allsubservices)) { ?> required <?php } ?> class="return form-control cri" value="<?php if (!empty($_SESSION['ServiceParameter']['Return'])) {
                                    echo $_SESSION['ServiceParameter']['Return']['core_service_name'];
                                } ?>"  /></td>
                        <td class="maintainence"><input name="maintainence[core_service_name]"  <?php if (in_array("Maintenance of Register", $allsubservices)) { ?> required <?php } ?> class="maintainence form-control cri" value="<?php if (!empty($_SESSION['ServiceParameter']['Maintenance of Register'])) {
                                    echo $_SESSION['ServiceParameter']['Maintenance of Register']['core_service_name'];
                                } ?>"  /></td>
                    </tr>
                    <tr>
                        <td>
                            <strong> Online ?</strong>
                        </td>

                        <td class="acilppr">
                            <select name="acilppr[is_online]" class="acilppr form-control cri" onchange='hideit("acilppr[service_url],acilppr[third_party_url]", "acilppr[swcs_service_id],acilppr[department_id]", "acilppr[is_integrated_with_swcs]", "acilppr[is_online]")'>
                                <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['service'])) {
                                    if ($_SESSION['ServiceParameter']['service']['is_online'] == "N") {
                                        echo " selected";
                                    }
                                } ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['service'])) {
                                    if ($_SESSION['ServiceParameter']['service']['is_online'] == "Y") {
                                        echo " selected";
                                    }
                                } ?>>Yes</option>

                            </select></td>
                        <td class="ao">
                            <select name="ao[is_online]" class="ao form-control cri" onchange='hideit("ao[service_url],ao[third_party_url]", "ao[swcs_service_id],ao[department_id]", "ao[is_integrated_with_swcs]", "ao[is_online]")'>
                                <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Others'])) {
                                    if ($_SESSION['ServiceParameter']['Amendment - Others']['is_online'] == "N") {
                                        echo " selected";
                                    }
                                } ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Others'])) {
                                    if ($_SESSION['ServiceParameter']['Amendment - Others']['is_online'] == "Y") {
                                        echo " selected";
                                    }
                                } ?>>Yes</option>


                            </select></td>
                        <td class="ac">
                            <select name="ac[is_online]" class="ac form-control cri" onchange='hideit("ac[service_url],ac[third_party_url]", "ac[swcs_service_id],ac[department_id]", "ac[is_integrated_with_swcs]", "ac[is_online]")'>
                                <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Cancellation'])) {
                                    if ($_SESSION['ServiceParameter']['Amendment - Cancellation']['is_online'] == "N") {
                                        echo " selected";
                                    }
                                } ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Cancellation'])) {
                                    if ($_SESSION['ServiceParameter']['Amendment - Cancellation']['is_online'] == "Y") {
                                        echo " selected";
                                    }
                                } ?>>Yes</option>


                            </select></td>
                        <td class="as">
                            <select name="as[is_online]" class="as form-control cri" onchange='hideit("as[service_url],as[third_party_url]", "as[swcs_service_id],as[department_id]", "as[is_integrated_with_swcs]", "as[is_online]")'>
                                <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Surrender'])) {
                                    if ($_SESSION['ServiceParameter']['Amendment - Surrender']['is_online'] == "N") {
                                        echo " selected";
                                    }
                                } ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Surrender'])) {
                                    if ($_SESSION['ServiceParameter']['Amendment - Surrender']['is_online'] == "Y") {
                                        echo " selected";
                                    }
                                } ?>>Yes</option>


                            </select></td>
                        <td class="at">
                            <select name="at[is_online]" class="at form-control cri" onchange='hideit("at[service_url],at[third_party_url]", "at[swcs_service_id],at[department_id]", "at[is_integrated_with_swcs]", "at[is_online]")'>
                                <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Transfer'])) {
                                    if ($_SESSION['ServiceParameter']['Amendment - Transfer']['is_online'] == "N") {
                                        echo " selected";
                                    }
                                } ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Transfer'])) {
                                    if ($_SESSION['ServiceParameter']['Amendment - Transfer']['is_online'] == "Y") {
                                        echo " selected";
                                    }
                                } ?>>Yes</option>

                            </select></td>
                        <td class="duplicate">
                            <select name="duplicate[is_online]" class="duplicate form-control cri" onchange='hideit("duplicate[service_url],duplicate[third_party_url]", "duplicate[swcs_service_id],duplicate[department_id]", "duplicate[is_integrated_with_swcs]", "duplicate[is_online]")'>
                                <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['Duplicate Copy'])) {
                                    if ($_SESSION['ServiceParameter']['Duplicate Copy']['is_online'] == "N") {
                                        echo " selected";
                                    }
                                } ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Duplicate Copy'])) {
                                    if ($_SESSION['ServiceParameter']['Duplicate Copy']['is_online'] == "Y") {
                                        echo " selected";
                                    }
                                } ?>>Yes</option>

                            </select></td>
                        <td class="renewal"><select name="renewal[is_online]" class="renewal form-control cri" onchange='hideit("renewal[service_url],renewal[third_party_url]", "renewal[swcs_service_id],renewal[department_id]", "renewal[is_integrated_with_swcs]", "renewal[is_online]")'>
                                <option value="N"  <?php if (!empty($_SESSION['ServiceParameter']['Renewal'])) {
                                    if ($_SESSION['ServiceParameter']['Renewal']['is_online'] == "N") {
                                        echo " selected";
                                    }
                                } ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Renewal'])) {
                                if ($_SESSION['ServiceParameter']['Renewal']['is_online'] == "Y") {
                                    echo " selected";
                                }
                            } ?> >Yes</option></select></td>
                        <td class="return">
                            <select name="return[is_online]" class="return form-control cri" onchange='hideit("return[service_url],return[third_party_url]", "return[swcs_service_id],return[department_id]", "return[is_integrated_with_swcs]", "return[is_online]")'>
                                <option value="N"  <?php if (!empty($_SESSION['ServiceParameter']['Return'])) {
                            if ($_SESSION['ServiceParameter']['Return']['is_online'] == "N") {
                                echo " selected";
                            }
                        } ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Return'])) {
                            if ($_SESSION['ServiceParameter']['Return']['is_online'] == "Y") {
                                echo " selected";
                            }
                        } ?> >Yes</option>
                            </select></td>
                        <td class="maintainence">
                            <select name="maintainence[is_online]" class="maintainence form-control cri" onchange='hideit("maintainence[service_url],maintainence[third_party_url]", "maintainence[swcs_service_id],maintainence[department_id]", "maintainence[is_integrated_with_swcs]", "maintainence[is_online]")'>
                                <option value="N"  <?php if (!empty($_SESSION['ServiceParameter']['Maintenance of Register'])) {
                            if ($_SESSION['ServiceParameter']['Maintenance of Register']['is_online'] == "N") {
                                echo " selected";
                            }
                        } ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Maintenance of Register'])) {
                            if ($_SESSION['ServiceParameter']['Maintenance of Register']['is_online'] == "Y") {
                                echo " selected";
                            }
                        } ?> >Yes</option>
                            </select></td>
                    </tr>
                    <tr>
                        <td>
                            <strong> Integrated With SWCS ? </strong>
                        </td>
                        <td class="acilppr">
                            <select name="acilppr[is_integrated_with_swcs]" class="acilppr form-control cri deptser" onchange='hideshow("acilppr[department_id],acilppr[swcs_service_id]", "acilppr[service_url],acilppr[third_party_url]", "acilppr[is_integrated_with_swcs]")'>

                                <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['service'])) {
                            if ($_SESSION['ServiceParameter']['service']['is_integrated_with_swcs'] == "N") {
                                echo " selected";
                            }
                        } ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['service'])) {
                            if ($_SESSION['ServiceParameter']['service']['is_integrated_with_swcs'] == "Y") {
                                echo " selected";
                            }
                        } ?>>Yes</option>

                            </select></td>
                        <td class="ao"><select name="ao[is_integrated_with_swcs]" class="ao form-control cri deptser" onchange='hideshow("ao[department_id],ao[swcs_service_id]", "ao[service_url],ao[third_party_url]", "ao[is_integrated_with_swcs]")'>

                                <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Others'])) {
                            if ($_SESSION['ServiceParameter']['Amendment - Others']['is_integrated_with_swcs'] == "N") {
                                echo " selected";
                            }
                        } ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Others'])) {
                            if ($_SESSION['ServiceParameter']['Amendment - Others']['is_integrated_with_swcs'] == "Y") {
                                echo " selected";
                            }
                        } ?>>Yes</option>
                            </select></td>
                        <td class="ac"><select name="ac[is_integrated_with_swcs]" class="ac form-control cri deptser" onchange='hideshow("ac[department_id],ac[swcs_service_id]", "ac[service_url],ac[third_party_url]", "ac[is_integrated_with_swcs]")'>

                                <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Cancellation'])) {
                            if ($_SESSION['ServiceParameter']['Amendment - Cancellation']['is_integrated_with_swcs'] == "N") {
                                echo " selected";
                            }
                        } ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Cancellation'])) {
                            if ($_SESSION['ServiceParameter']['Amendment - Cancellation']['is_integrated_with_swcs'] == "Y") {
                                echo " selected";
                            }
                        } ?>>Yes</option>
                            </select></td>
                        <td class="as"><select name="as[is_integrated_with_swcs]" class="as form-control cri deptser" onchange='hideshow("as[department_id],as[swcs_service_id]", "as[service_url],as[third_party_url]", "as[is_integrated_with_swcs]")'>

                                <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Surrender'])) {
                            if ($_SESSION['ServiceParameter']['Amendment - Surrender']['is_integrated_with_swcs'] == "N") {
                                echo " selected";
                            }
                        } ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Surrender'])) {
                            if ($_SESSION['ServiceParameter']['Amendment - Surrender']['is_integrated_with_swcs'] == "Y") {
                                echo " selected";
                            }
                        } ?>>Yes</option>
                            </select></td>
                        <td class="at"><select name="at[is_integrated_with_swcs]" class="at form-control cri deptser" onchange='hideshow("at[department_id],at[swcs_service_id]", "at[service_url],at[third_party_url]", "at[is_integrated_with_swcs]")'>

                                <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Transfer'])) {
                            if ($_SESSION['ServiceParameter']['Amendment - Transfer']['is_integrated_with_swcs'] == "N") {
                                echo " selected";
                            }
                        } ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Transfer'])) {
                            if ($_SESSION['ServiceParameter']['Amendment - Transfer']['is_integrated_with_swcs'] == "Y") {
                                echo " selected";
                            }
                        } ?>>Yes</option>
                            </select></td>
                        <td class="duplicate"><select name="duplicate[is_integrated_with_swcs]" class="duplicate form-control cri deptser" onchange='hideshow("duplicate[department_id],duplicate[swcs_service_id]", "duplicate[service_url],duplicate[third_party_url]", "duplicate[is_integrated_with_swcs]")'>

                                <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['Duplicate Copy'])) {
                            if ($_SESSION['ServiceParameter']['Duplicate Copy']['is_integrated_with_swcs'] == "N") {
                                echo " selected";
                            }
                        } ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Duplicate Copy'])) {
                            if ($_SESSION['ServiceParameter']['Duplicate Copy']['is_integrated_with_swcs'] == "Y") {
                                echo " selected";
                            }
                        } ?>>Yes</option>
                            </select></td>
                        <td class="renewal"><select name="renewal[is_integrated_with_swcs]" class="renewal form-control cri deptser" onchange='hideshow("renewal[department_id],renewal[swcs_service_id]", "renewal[service_url],renewal[third_party_url]", "renewal[is_integrated_with_swcs]")'>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Renewal'])) {
                            if ($_SESSION['ServiceParameter']['Renewal']['is_integrated_with_swcs'] == "Y") {
                                echo " selected";
                            }
                        } ?> >Yes</option><option value="N"  <?php if (!empty($_SESSION['ServiceParameter']['Renewal'])) {
                            if ($_SESSION['ServiceParameter']['Renewal']['is_integrated_with_swcs'] == "N") {
                                echo " selected";
                            }
                        } ?>>No</option>
                            </select></td>
                        <td class="return"><select name="return[is_integrated_with_swcs]" class="return form-control cri deptser" onchange='hideshow("return[department_id],return[swcs_service_id]", "return[service_url],return[third_party_url]", "return[is_integrated_with_swcs]")'>
                                <option value="N"  <?php if (!empty($_SESSION['ServiceParameter']['Return'])) {
                            if ($_SESSION['ServiceParameter']['Return']['is_integrated_with_swcs'] == "N") {
                                echo " selected";
                            }
                        } ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Return'])) {
                            if ($_SESSION['ServiceParameter']['Return']['is_integrated_with_swcs'] == "Y") {
                                echo " selected";
                            }
                        } ?> >Yes</option>
                            </select></td>
                        <td class="maintainence"><select name="maintainence[is_integrated_with_swcs]" class="maintainence form-control cri deptser" onchange='hideshow("maintainence[department_id],maintainence[swcs_service_id]", "maintainence[service_url],maintainence[third_party_url]", "maintainence[is_integrated_with_swcs]")'>
                                <option value="N"  <?php if (!empty($_SESSION['ServiceParameter']['Maintenance of Register'])) {
                            if ($_SESSION['ServiceParameter']['Maintenance of Register']['is_integrated_with_swcs'] == "N") {
                                echo " selected";
                            }
                        } ?>>No</option>			
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Maintenance of Register'])) {
                            if ($_SESSION['ServiceParameter']['Maintenance of Register']['is_integrated_with_swcs'] == "Y") {
                                echo " selected";
                            }
                        } ?> >Yes</option>
                            </select></td>
                    </tr>


                   <tr>
                        <td>
                            <strong> Department <?php  ?></strong> </td>
<?php 
$allDepartmentList = InfowizardQuestionMasterExt::getMasterList('sso_service_providers', 'sp_id', 'service_provider_name', 'is_service_provider_active', 'Y'); 
$departments = "";$saved="";
foreach ($allList as $k => $v) { $hgn=$alishname[$v];
if(!empty($_SESSION['ServiceParameter'][$hgn]['department_id'])) {   if(!empty($_SESSION['ServiceParameter'][$hgn]['department_id'])){ $saved=$_SESSION['ServiceParameter'][$hgn]['department_id']; } }
 $departments = $departments . "<option value=''>Select Department</options>";
foreach ($allDepartmentList as $k1 => $valuee) {  
   $n=""; if(!empty($_SESSION['ServiceParameter'][$hgn]) && ($k1==$saved)) { $n=' selected'; }      
   $departments = $departments."<option value='$k1' $n>$valuee</options>";
}
    ?>
                            <td class="<?php echo $v; ?>"><select name="<?php echo $v; ?>[department_id]" class="<?php echo $v; ?> form-control cri serviceDepartment deptser" relDep='<?php echo $v; ?>'>
    <?php echo $departments; ?></select> 
                            </td>  

<?php $departments = ""; $hgn=""; } ?>
                    </tr>


                    <tr>
                        <td>
                            <strong> Service With SWCS
							<?php if(!empty($_SESSION['ServiceParameter']['service']) && ($_SESSION['ServiceParameter']['service']['swcs_service_id']))
							 { echo $_SESSION['ServiceParameter']['service']['swcs_service_id']; } ?></strong>
                        </td>
<?php $allLists = InfowizardQuestionMasterExt::getMasterList('bo_sp_all_applications', 'app_id', 'app_name', 'is_app_active', 'Y'); 

$departments = "";

foreach ($allList as $k => $v) { 
$hgn=$alishname[$v];
if(!empty($_SESSION['ServiceParameter'][$hgn]['swcs_service_id'])) {   $saved=$_SESSION['ServiceParameter'][$hgn]['swcs_service_id']; }
$departments = $departments . "<option value=''>Select</options>";  
foreach ($allLists as $k1 => $valueee) {
   $n=""; if(!empty($_SESSION['ServiceParameter'][$hgn]) && ($k1==$saved)) { $n=' selected'; }  
    $departments = "$departments<option value='$k1' $n >$valueee</options>";
}
    ?>
                            <td class="<?php echo $v; ?>"><select name="<?php echo $v; ?>[swcs_service_id]" class="<?php echo $v; ?> form-control cri deptser">
    <?php echo $departments; ?></select> 
                            </td>  

<?php $departments = ""; $hgn=""; } ?>
                    </tr>
                    <tr>
                        <td>
                            <strong> Service URL</strong>
                        </td>
<?php
foreach ($allList as $k => $v) {
$hgn=$alishname[$v];

    ?>
                            <td class="<?php echo $v; ?>"><input name="<?php echo $v; ?>[service_url]" class="<?php echo $v; ?> form-control cri deptser" 
							value="<?php if(!empty($_SESSION['ServiceParameter'][$hgn]['service_url'])) {  echo $_SESSION['ServiceParameter'][$hgn]['service_url']; }?>"  />

                            </td>  

<?php } ?>
                    </tr> 
                    <tr>
                        <td>
                            <strong> Third Party URL</strong>
                        </td>
<?php
foreach ($allList as $k => $v) {
 $hgn=$alishname[$v];
    ?>
                            <td class="<?php echo $v; ?>"><input name="<?php echo $v; ?>[third_party_url]" class="<?php echo $v; ?> form-control cri deptser"
							value="<?php if(!empty($_SESSION['ServiceParameter'][$hgn]['third_party_url'])) {  echo $_SESSION['ServiceParameter'][$hgn]['third_party_url']; }?>"

                            </td>  

<?php } ?>
                    </tr> 
                    <tr>
                        <td>
                            <strong> In Uttarakhand Right to Services Act ? </strong>
                        </td>
                        <td class="acilppr"><select name="acilppr[is_in_uttarakhand_right_to_service_act]" class="form-control cri acilppr">
                                <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['service'])) {
    if ($_SESSION['ServiceParameter']['service']['is_in_uttarakhand_right_to_service_act'] == "N") {
        echo " selected";
    }
} ?>>No</option>

                                
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['service'])) {
    if ($_SESSION['ServiceParameter']['service']['is_in_uttarakhand_right_to_service_act'] == "Y") {
        echo " selected";
    }
} ?>>Yes</option>
                              
                            </select></td>
                        <td class="ao"><select name="ao[is_in_uttarakhand_right_to_service_act]" class="form-control cri ao">
                                      <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Others'])) {
    if ($_SESSION['ServiceParameter']['Amendment - Others']['is_in_uttarakhand_right_to_service_act'] == "N") {
        echo " selected";
    }
} ?>>No</option>
                                      <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Others'])) {
    if ($_SESSION['ServiceParameter']['Amendment - Others']['is_in_uttarakhand_right_to_service_act'] == "Y") {
        echo " selected";
    }
} ?>>Yes</option>
                         
                            </select></td>
                        <td class="ac"><select name="ac[is_in_uttarakhand_right_to_service_act]" class="form-control cri ac">
                                <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Cancellation'])) {
    if ($_SESSION['ServiceParameter']['Amendment - Cancellation']['is_in_uttarakhand_right_to_service_act'] == "N") {
        echo " selected";
    }
} ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Cancellation'])) {
    if ($_SESSION['ServiceParameter']['Amendment - Cancellation']['is_in_uttarakhand_right_to_service_act'] == "Y") {
        echo " selected";
    }
} ?>>Yes</option>
                           
                            </select></td>
                        <td class="as"><select name="as[is_in_uttarakhand_right_to_service_act]" class="form-control cri as">
                              
                                 <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Surrender'])) {
    if ($_SESSION['ServiceParameter']['Amendment - Surrender']['is_in_uttarakhand_right_to_service_act'] == "N") {
        echo " selected";
    }
} ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Surrender'])) {
    if ($_SESSION['ServiceParameter']['Amendment - Surrender']['is_in_uttarakhand_right_to_service_act'] == "Y") {
        echo " selected";
    }
} ?>>Yes</option>
                               
                            </select></td>
                        <td class="at"><select name="at[is_in_uttarakhand_right_to_service_act]" class="form-control cri at">
                                <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Transfer'])) {
    if ($_SESSION['ServiceParameter']['Amendment - Transfer']['is_in_uttarakhand_right_to_service_act'] == "N") {
        echo " selected";
    }
} ?>>No</option>     <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Transfer'])) {
    if ($_SESSION['ServiceParameter']['Amendment - Transfer']['is_in_uttarakhand_right_to_service_act'] == "Y") {
        echo " selected";
    }
} ?>>Yes</option>
                           
                            </select></td>
                        <td class="duplicate"><select name="duplicate[is_in_uttarakhand_right_to_service_act]" class="form-control cri duplicate">
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Duplicate Copy'])) {
    if ($_SESSION['ServiceParameter']['Duplicate Copy']['is_in_uttarakhand_right_to_service_act'] == "Y") {
        echo " selected";
    }
} ?>>Yes</option>
                                <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['Duplicate Copy'])) {
    if ($_SESSION['ServiceParameter']['Duplicate Copy']['is_in_uttarakhand_right_to_service_act'] == "N") {
        echo " selected";
    }
} ?>>No</option>
                            </select></td>
                        <td class="renewal"><select name="renewal[is_in_uttarakhand_right_to_service_act]" class="form-control cri renewal">
                             <option value="N"  <?php if (!empty($_SESSION['ServiceParameter']['Renewal'])) {
    if ($_SESSION['ServiceParameter']['Renewal']['is_in_uttarakhand_right_to_service_act'] == "N") {
        echo " selected";
    }
} ?>>No</option>
                             <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Renewal'])) {
    if ($_SESSION['ServiceParameter']['Renewal']['is_in_uttarakhand_right_to_service_act'] == "Y") {
        echo " selected";
    }
} ?> >Yes</option>
                            </select></td>
                        <td class="return"><select name="return[is_in_uttarakhand_right_to_service_act]" class="form-control cri return">
                            <option value="N"  <?php if (!empty($_SESSION['ServiceParameter']['Return'])) {
    if ($_SESSION['ServiceParameter']['Return']['is_in_uttarakhand_right_to_service_act'] == "N") {
        echo " selected";
    }
} ?>>No</option>
                            <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Return'])) {
    if ($_SESSION['ServiceParameter']['Return']['is_in_uttarakhand_right_to_service_act'] == "Y") {
        echo " selected";
    }
} ?> >Yes</option>
                            </select></td>
                        <td class="maintainence"><select name="maintainence[is_in_uttarakhand_right_to_service_act]" class="form-control cri maintainence">
                           <option value="N"  <?php if (!empty($_SESSION['ServiceParameter']['Maintenance of Register'])) {
    if ($_SESSION['ServiceParameter']['Maintenance of Register']['is_in_uttarakhand_right_to_service_act'] == "N") {
        echo " selected";
    }
} ?>>No</option>     <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Maintenance of Register'])) {
    if ($_SESSION['ServiceParameter']['Maintenance of Register']['is_in_uttarakhand_right_to_service_act'] == "Y") {
        echo " selected";
    }
} ?> >Yes</option>
                            </select></td>

                    </tr>
                    <tr>
                        <td>
                            <strong> In Uttarakhand Single Window Act ? </strong>
                        </td>
                        <td class="acilppr"><select name="acilppr[is_in_uttarakhand_single_window_act]" class="form-control cri acilppr">
                            
                                     <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['service'])) {
    if ($_SESSION['ServiceParameter']['service']['is_in_uttarakhand_single_window_act'] == "N") {
        echo " selected";
    }
} ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['service'])) {
    if ($_SESSION['ServiceParameter']['service']['is_in_uttarakhand_single_window_act'] == "Y") {
        echo " selected";
    }
} ?>>Yes</option>
                           

                            </select></td>
                        <td class="ao"><select name="ao[is_in_uttarakhand_single_window_act]" class="form-control cri ao">
                                   <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Others'])) {
    if ($_SESSION['ServiceParameter']['Amendment - Others']['is_in_uttarakhand_single_window_act'] == "N") {
        echo " selected";
    }
} ?>>No</option>
                                
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Others'])) {
    if ($_SESSION['ServiceParameter']['Amendment - Others']['is_in_uttarakhand_single_window_act'] == "Y") {
        echo " selected";
    }
} ?>>Yes</option>
                         
                            </select></td>
                        <td class="ac"><select name="ac[is_in_uttarakhand_single_window_act]" class="form-control cri ac">
                            
                                <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Cancellation'])) {
    if ($_SESSION['ServiceParameter']['Amendment - Cancellation']['is_in_uttarakhand_single_window_act'] == "N") {
        echo " selected";
    }
} ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Cancellation'])) {
    if ($_SESSION['ServiceParameter']['Amendment - Cancellation']['is_in_uttarakhand_single_window_act'] == "Y") {
        echo " selected";
    }
} ?>>Yes</option>
                            </select></td>
                        <td class="as"><select name="as[is_in_uttarakhand_single_window_act]" class="form-control cri as">
                               
                                 <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Surrender'])) {
                                        if ($_SESSION['ServiceParameter']['Amendment - Surrender']['is_in_uttarakhand_single_window_act'] == "N") {
                                            echo " selected";
                                        }
                                    } ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Surrender'])) {
                                        if ($_SESSION['ServiceParameter']['Amendment - Surrender']['is_in_uttarakhand_single_window_act'] == "Y") {
                                            echo " selected";
                                        }
                                    } ?>>Yes</option>
                               
                            </select></td>
                        <td class="at"><select name="at[is_in_uttarakhand_single_window_act]" class="form-control cri at">
                                <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Transfer'])) {
                                if ($_SESSION['ServiceParameter']['Amendment - Transfer']['is_in_uttarakhand_single_window_act'] == "N") {
                                    echo " selected";
                                }
                            } ?>>No</option>
                                
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Transfer'])) {
                                if ($_SESSION['ServiceParameter']['Amendment - Transfer']['is_in_uttarakhand_single_window_act'] == "Y") {
                                    echo " selected";
                                }
                            } ?>>Yes</option>
                               
                            </select></td>
                        <td class="duplicate"><select name="duplicate[is_in_uttarakhand_single_window_act]" class="form-control cri duplicate">
                              <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['Duplicate Copy'])) {
                                if ($_SESSION['ServiceParameter']['Duplicate Copy']['is_in_uttarakhand_single_window_act'] == "N") {
                                    echo " selected";
                                }
                            } ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Duplicate Copy'])) {
                                if ($_SESSION['ServiceParameter']['Duplicate Copy']['is_in_uttarakhand_single_window_act'] == "Y") {
                                    echo " selected";
                                }
                            } ?>>Yes</option>
                               
                            </select></td>
                        <td class="renewal"><select name="renewal[is_in_uttarakhand_single_window_act]" class="form-control cri renewal">
                               <option value="N"  <?php if (!empty($_SESSION['ServiceParameter']['Renewal'])) {
    if ($_SESSION['ServiceParameter']['Renewal']['is_in_uttarakhand_single_window_act'] == "N") {
        echo " selected";
    }
} ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Renewal'])) {
                                if ($_SESSION['ServiceParameter']['Renewal']['is_in_uttarakhand_single_window_act'] == "Y") {
                                    echo " selected";
                                }
                            } ?> >Yes</option>
                            </select></td>
                        <td class="return"><select name="return[is_in_uttarakhand_single_window_act]" class="form-control cri return">
                               <option value="N"  <?php if (!empty($_SESSION['ServiceParameter']['Return'])) {
    if ($_SESSION['ServiceParameter']['Return']['is_in_uttarakhand_single_window_act'] == "N") {
        echo " selected";
    }
} ?>>No</option>
                                
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Return'])) {
    if ($_SESSION['ServiceParameter']['Return']['is_in_uttarakhand_single_window_act'] == "Y") {
        echo " selected";
    }
} ?> >Yes</option>
                            </select></td>
                        <td class="maintainence"><select name="maintainence[is_in_uttarakhand_single_window_act]" class="form-control cri maintainence">
                               <option value="N"  <?php if (!empty($_SESSION['ServiceParameter']['Maintenance of Register'])) {
    if ($_SESSION['ServiceParameter']['Maintenance of Register']['is_in_uttarakhand_single_window_act'] == "N") {
        echo " selected";
    }
} ?>>No</option>
                                
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Maintenance of Register'])) {
    if ($_SESSION['ServiceParameter']['Maintenance of Register']['is_in_uttarakhand_single_window_act'] == "Y") {
        echo " selected";
    }
} ?> >Yes</option>
                            </select></td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Statutory Forms Available</strong>
                        </td>
                        <td class="acilppr"><select onchange='hide("acilppr[statutory_form_upload],acilppr[statutory_form_no]", "acilppr[is_statutory_forms_available]")' name="acilppr[is_statutory_forms_available]" class="form-control cri acilppr">
                               <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['service'])) {
    if ($_SESSION['ServiceParameter']['service']['is_statutory_forms_available'] == "N") {
        echo " selected";
    }
} ?>>No</option>
                                
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['service'])) {
    if ($_SESSION['ServiceParameter']['service']['is_statutory_forms_available'] == "Y") {
        echo " selected";
    }
} ?>>Yes</option>
                               

                            </select></td>


                        <td class="ao"><select onchange='hide("ao[statutory_form_upload],ao[statutory_form_no]", "ao[is_statutory_forms_available]")' name="ao[is_statutory_forms_available]" class="form-control cri ao">
                              
                                 <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Others'])) {
    if ($_SESSION['ServiceParameter']['Amendment - Others']['is_statutory_forms_available'] == "N") {
        echo " selected";
    }
} ?>>No</option>	
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Others'])) {
    if ($_SESSION['ServiceParameter']['Amendment - Others']['is_statutory_forms_available'] == "Y") {
        echo " selected";
    }
} ?>>Yes</option>
                               

                            </select></td>

                        <td class="ac"><select onchange='hide("ac[statutory_form_upload],ac[statutory_form_no]", "ac[is_statutory_forms_available]")' name="ac[is_statutory_forms_available]" class="form-control cri ac">
                            
                                     <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Cancellation'])) {
    if ($_SESSION['ServiceParameter']['Amendment - Cancellation']['is_statutory_forms_available'] == "N") {
        echo " selected";
    }
} ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Cancellation'])) {
    if ($_SESSION['ServiceParameter']['Amendment - Cancellation']['is_statutory_forms_available'] == "Y") {
        echo " selected";
    }
} ?>>Yes</option>
                           
                            </select></td>

                        <td class="as"><select onchange='hide("as[statutory_form_upload],as[statutory_form_no]", "as[is_statutory_forms_available]")' name="as[is_statutory_forms_available]" class="form-control cri as">
                               
                                    <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Surrender'])) {
    if ($_SESSION['ServiceParameter']['Amendment - Surrender']['is_statutory_forms_available'] == "N") {
        echo " selected";
    }
} ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Surrender'])) {
    if ($_SESSION['ServiceParameter']['Amendment - Surrender']['is_statutory_forms_available'] == "Y") {
        echo " selected";
    }
} ?>>Yes</option>
                            
                            </select></td>
                        <td class="at"><select onchange='hide("at[statutory_form_upload],at[statutory_form_no]", "at[is_statutory_forms_available]")' name="at[is_statutory_forms_available]" class="form-control cri at">
                            
                                   <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Transfer'])) {
    if ($_SESSION['ServiceParameter']['Amendment - Transfer']['is_statutory_forms_available'] == "N") {
        echo " selected";
    }
} ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Transfer'])) {
    if ($_SESSION['ServiceParameter']['Amendment - Transfer']['is_statutory_forms_available'] == "Y") {
        echo " selected";
    }
} ?>>Yes</option>
                             
                            </select></td>
                        <td class="duplicate"><select onchange='hide("duplicate[statutory_form_upload],duplicate[statutory_form_no]", "duplicate[is_statutory_forms_available]")' name="duplicate[is_statutory_forms_available]" class="form-control cri duplicate">
                            
                                <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['Duplicate Copy'])) {
    if ($_SESSION['ServiceParameter']['Duplicate Copy']['is_statutory_forms_available'] == "N") {
        echo " selected";
    }
} ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Duplicate Copy'])) {
    if ($_SESSION['ServiceParameter']['Duplicate Copy']['is_statutory_forms_available'] == "Y") {
        echo " selected";
    }
} ?>>Yes</option>
                            </select></td>
                        <td class="renewal"><select onchange='hide("renewal[statutory_form_upload],renewal[statutory_form_no]", "renewal[is_statutory_forms_available]")' name="renewal[is_statutory_forms_available]" class="form-control cri renewal">
                              <option value="N"  <?php if (!empty($_SESSION['ServiceParameter']['Renewal'])) {
    if ($_SESSION['ServiceParameter']['Renewal']['is_statutory_forms_available'] == "N") {
        echo " selected";
    }
} ?>>No</option>
                              <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Renewal'])) {
    if ($_SESSION['ServiceParameter']['Renewal']['is_statutory_forms_available'] == "Y") {
        echo " selected";
    }
} ?> >Yes</option>
                            </select></td>
                        <td class="return"><select onchange='hide("return[statutory_form_upload],return[statutory_form_no]", "return[is_statutory_forms_available]")' name="return[is_statutory_forms_available]" class="form-control cri return">
                             
                                <option value="N"  <?php if (!empty($_SESSION['ServiceParameter']['Return'])) {
    if ($_SESSION['ServiceParameter']['Return']['is_statutory_forms_available'] == "N") {
        echo " selected";
    }
} ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Return'])) {
    if ($_SESSION['ServiceParameter']['Return']['is_statutory_forms_available'] == "Y") {
        echo " selected";
    }
} ?> >Yes</option>
                            </select></td>
                        <td class="maintainence"><select onchange='hide("maintainence[statutory_form_upload],maintainence[statutory_form_no]", "maintainence[is_statutory_forms_available]")' name="maintainence[is_statutory_forms_available]" class="form-control cri maintainence">
                              
                                <option value="N"  <?php if (!empty($_SESSION['ServiceParameter']['Maintenance of Register'])) {
    if ($_SESSION['ServiceParameter']['Maintenance of Register']['is_statutory_forms_available'] == "N") {
        echo " selected";
    }
} ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Maintenance of Register'])) {
    if ($_SESSION['ServiceParameter']['Maintenance of Register']['is_statutory_forms_available'] == "Y") {
        echo " selected";
    }
} ?> >Yes</option>
                            </select></td>

                    </tr>

                    <tr>
                        <td>
                            <strong>Statutory Form No </strong>
                        </td>
                        <td class="acilppr"> <input type="text" class="form-control cri popU acilppr" name="acilppr[statutory_form_no]" placeholder="Statutory Form No"></td>
                        <td class="ao"> <input type="text" class="form-control cri ao popU" name="ao[statutory_form_no]" placeholder="Statutory Form No"></td>
                        <td class="ac"> <input type="text" class="form-control cri ac popU" name="ac[statutory_form_no]" placeholder="Statutory Form No"></td>
                        <td class="as"> <input type="text" class="form-control cri as popU" name="as[statutory_form_no]" placeholder="Statutory Form No"></td>
                        <td class="at"> <input type="text" class="form-control cri at popU" name="at[statutory_form_no]" placeholder="Statutory Form No" value=""></td>
                        <td class="duplicate"><input type="text" class="form-control cri popU duplicate" name="duplicate[statutory_form_no]" placeholder="Statutory Form No"></td>
                        <td class="renewal"><input type="text" class="form-control cri popU renewal" name="renewal[statutory_form_no]" placeholder="Statutory Form No"></td>
                        <td class="return"><input type="text" class="form-control cri popU return" name="return[statutory_form_no]" placeholder="Statutory Form No"></td>
                        <td class="maintainence"><input type="text" class="form-control cri popU maintainence" name="maintainence[statutory_form_no]" placeholder="Statutory Form No"></td>
                    </tr>
                    <tr style="display: none;">
<?php
foreach ($allList as $k => $v) {
 $hgn=$alishname[$v];
 ?><td class="<?php echo $v;?>">
                            <input name="<?php echo $v; ?>[statutory_form_upload]" class="<?php echo $v; ?> form-control cri deptser"
							value="<?php if(!empty($_SESSION['ServiceParameter'][$hgn]['statutory_form_upload'])) {  echo $_SESSION['ServiceParameter'][$hgn]['statutory_form_upload']; }?>"

                      </td>

<?php } ?></tr>
                    <tr style="display: none;">
<?php
foreach ($allList as $k => $v) {
 $hgn=$alishname[$v];
 ?><td class="<?php echo $v;?>">
                            <input name="<?php echo $v; ?>[document_checklist_upload]" class="<?php echo $v; ?> form-control cri deptser"
							value="<?php if(!empty($_SESSION['ServiceParameter'][$hgn]['document_checklist_upload'])) {  echo $_SESSION['ServiceParameter'][$hgn]['document_checklist_upload']; }?>"

                      </td>

<?php } ?></tr>
                    <tr style="display: none;">
<?php
foreach ($allList as $k => $v) {
 $hgn=$alishname[$v];
 ?><td class="<?php echo $v;?>">
                            <input name="<?php echo $v; ?>[sop]" class="<?php echo $v; ?> form-control cri deptser"
							value="<?php if(!empty($_SESSION['ServiceParameter'][$hgn]['sop'])) {  echo $_SESSION['ServiceParameter'][$hgn]['sop']; }?>"

                      </td>

<?php } ?></tr>
                    
 <tr style="display: none;">
<?php
foreach ($allList as $k => $v){
 $hgn=$alishname[$v];
 ?><td class="<?php echo $v;?>">
                            <input name="<?php echo $v; ?>[statutory_timeline_upload]" class="<?php echo $v; ?> form-control cri deptser"
							value="<?php if(!empty($_SESSION['ServiceParameter'][$hgn]['statutory_timeline_upload'])) {  echo $_SESSION['ServiceParameter'][$hgn]['statutory_timeline_upload']; }?>"

                      </td>

<?php } ?></tr>
 
                  <!--<tr>
                        <td><strong>Statutory Forms Upload </strong></td>
                        <td class="acilppr"> <input type="file" class="form-control cri acilppr" name="acilppr[statutory_form_upload]" ></td>
                        <td class="ao"> <input type="file" class="form-control cri ao" name="ao[statutory_form_upload]" ></td>
                        <td class="ac"> <input type="file" class="form-control cri ac" name="ac[statutory_form_upload]" ></td>
                        <td class="as"> <input type="file" class="form-control cri as" name="as[statutory_form_upload]" ></td>
                        <td class="at"> <input type="file" class="form-control cri at" name="at[statutory_form_upload]" ></td>
                        <td class="duplicate"><input type="file" class="form-control cri duplicate" name="duplicate[statutory_form_upload]" ></td>
                        <td class="renewal"><input type="file" class="form-control cri renewal" name="renewal[statutory_form_upload]" ></td>
                        <td class="return"><input type="file" class="form-control cri return" name="return[statutory_form_upload]" ></td>
                        <td class="maintainence"><input type="file" class="form-control cri maintainence" name="maintainence[statutory_form_upload]" ></td>
                    </tr>-->

                 <!--   <tr>
                        <td>
                            <strong>Statutory Forms Creation </strong>
                        </td>
                        <td class="acilppr"> <a href="javascript:;">Sub Form Link </a></td>
                        <td class="ao"> <a href="javascript:;">Sub Form Link </a></td>
                        <td class="ac"> <a href="javascript:;">Sub Form Link </a></td>
                        <td class="as"> <a href="javascript:;">Sub Form Link </a></td>
                        <td class="at"> <a href="javascript:;">Sub Form Link </a></td>
                        <td class="duplicate"> <a href="javascript:;">Sub Form Link </a></td>
                        <td class="renewal"> <a href="javascript:;">Sub Form Link </a></td>
                        <td class="return"> <a href="javascript:;">Sub Form Link </a></td>
                        <td class="maintainence"> <a href="javascript:;">Sub Form Link </a></td>

                    </tr>-->

                    <tr>
                        <td>
                            <strong> Document CheckList Available </strong>
                        </td>

                        <td class="acilppr"><select onchange='hide("acilppr[document_checklist_upload],acilppr[document_checklist_creation_pop]", "acilppr[document_checkList]")' name="acilppr[document_checkList]" class="form-control cri acilppr">
                                <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['service'])) {
    if ($_SESSION['ServiceParameter']['service']['document_checkList'] == "N") {
        echo " selected";
    }
} ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['service'])) {
    if ($_SESSION['ServiceParameter']['service']['document_checkList'] == "Y") {
        echo " selected";
    }
} ?>>Yes</option>
                               

                            </select></td>
                        <td class="ao"><select onchange='hide("ao[document_checklist_upload],ao[document_checklist_creation_pop]", "ao[document_checkList]")' name="ao[document_checkList]" class="form-control cri ao">	
                               
                                          <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Others'])) {
    if ($_SESSION['ServiceParameter']['Amendment - Others']['document_checkList'] == "N") {
        echo " selected";
    }
} ?>>No</option>
                                          <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Others'])) {
    if ($_SESSION['ServiceParameter']['Amendment - Others']['document_checkList'] == "Y") {
        echo " selected";
    }
} ?>>Yes</option>
                       </select></td>

                        <td class="ac"><select onchange='hide("ac[document_checklist_upload],ac[document_checklist_creation_pop]", "ac[document_checkList]")' name="ac[document_checkList]" class="form-control cri ac">
                 
                                <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Cancellation'])) {
    if ($_SESSION['ServiceParameter']['Amendment - Cancellation']['document_checkList'] == "N") {
        echo " selected";
    }
} ?>>No</option>
                                               <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Cancellation'])) {
    if ($_SESSION['ServiceParameter']['Amendment - Cancellation']['document_checkList'] == "Y") {
        echo " selected";
    }
} ?>>Yes</option>
                            </select></td>
                        <td class="as"><select onchange='hide("as[document_checklist_upload],as[document_checklist_creation_pop]", "as[document_checkList]")' name="as[document_checkList]" class="form-control cri as">
                               <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Surrender'])) {
    if ($_SESSION['ServiceParameter']['Amendment - Surrender']['document_checkList'] == "N") {
        echo " selected";
    }
} ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Surrender'])) {
    if ($_SESSION['ServiceParameter']['Amendment - Surrender']['document_checkList'] == "Y") {
        echo " selected";
    }
} ?>>Yes</option>
                              
                            </select></td>
                        <td class="at"><select onchange='hide("at[document_checklist_upload],at[document_checklist_creation_pop]", "at[document_checkList]")' name="at[document_checkList]" class="form-control cri at">
                                     <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Transfer'])) {
    if ($_SESSION['ServiceParameter']['Amendment - Transfer']['document_checkList'] == "N") {
        echo " selected";
    }
} ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Amendment - Transfer'])) {
    if ($_SESSION['ServiceParameter']['Amendment - Transfer']['document_checkList'] == "Y") {
        echo " selected";
    }
} ?>>Yes</option>
                      
                            </select></td>
                        <td class="duplicate"><select onchange='hide("duplicate[document_checklist_upload],duplicate[document_checklist_creation_pop]", "duplicate[document_checkList]")' name="duplicate[document_checkList]" class="form-control cri duplicate">
                                      <option value="N" <?php if (!empty($_SESSION['ServiceParameter']['Duplicate Copy'])) {
    if ($_SESSION['ServiceParameter']['Duplicate Copy']['document_checkList'] == "N") {
        echo " selected";
    }
} ?>>No</option>
                                
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Duplicate Copy'])) {
    if ($_SESSION['ServiceParameter']['Duplicate Copy']['document_checkList'] == "Y") {
        echo " selected";
    }
} ?>>Yes</option>
                         
                            </select></td>	
                        <td class="renewal"><select onchange='hide("renewal[document_checklist_upload],renewal[document_checklist_creation_pop]", "renewal[document_checkList]")' name="renewal[document_checkList]" class="form-control cri renewal">
                            <option value="N"  <?php if (!empty($_SESSION['ServiceParameter']['Renewal'])) {
    if ($_SESSION['ServiceParameter']['Renewal']['document_checkList'] == "N") {
        echo " selected";
    }
} ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Renewal'])) {
    if ($_SESSION['ServiceParameter']['Renewal']['document_checkList'] == "Y") {
        echo " selected";
    }
} ?> >Yes</option>
                            </select></td>
                        <td class="return"><select onchange='hide("return[document_checklist_upload],return[document_checklist_creation_pop]", "return[document_checkList]")' name="return[document_checkList]" class="form-control cri return">
                              
                                <option value="N"  <?php if (!empty($_SESSION['ServiceParameter']['Return'])) {
    if ($_SESSION['ServiceParameter']['Return']['document_checkList'] == "N") {
        echo " selected";
    }
} ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Return'])) {
    if ($_SESSION['ServiceParameter']['Return']['document_checkList'] == "Y") {
        echo " selected";
    }
} ?> >Yes</option>
                            </select></td>
                        <td class="maintainence"><select onchange='hide("maintainence[document_checklist_upload],maintainence[document_checklist_creation_pop]", "maintainence[document_checkList]")' name="maintainence[document_checkList]" class="form-control cri maintainence">
                             <option value="N"  <?php if (!empty($_SESSION['ServiceParameter']['Maintenance of Register'])) {
    if ($_SESSION['ServiceParameter']['Maintenance of Register']['document_checkList'] == "N") {
        echo " selected";
    }
} ?>>No</option>
                                <option value="Y" <?php if (!empty($_SESSION['ServiceParameter']['Maintenance of Register'])) {
    if ($_SESSION['ServiceParameter']['Maintenance of Register']['document_checkList'] == "Y") {
        echo " selected";
    }
} ?> >Yes</option>
                            </select></td>


                    </tr>
                    <!--<tr>
                        <td>
                            <strong> Document Checklist Upload </strong>
                        </td>
                        <td class="acilppr"> <input type="file" class="form-control cri acilppr" name="acilppr[document_checklist_upload]" ></td>
                        <td class="ao"> <input type="file" class="form-control cri ao" name="ao[document_checklist_upload]" ></td>
                        <td class="ac"> <input type="file" class="form-control cri ac" name="ac[document_checklist_upload]" ></td>
                        <td class="as"> <input type="file" class="form-control cri as" name="as[document_checklist_upload]" ></td>
                        <td class="at"> <input type="file" class="form-control cri at" name="at[document_checklist_upload]" ></td>
                        <td class="duplicate"><input type="file" class="form-control cri duplicate" name="duplicate[document_checklist_upload]" ></td>
                        <td class="renewal"><input type="file" class="form-control cri renewal" name="renewal[document_checklist_upload]" ></td>
                        <td class="return"><input type="file" class="form-control cri return" name="return[document_checklist_upload]" ></td>
                        <td class="maintainence"><input type="file" class="form-control cri maintainence" name="maintainence[document_checklist_upload]" ></td>


                    </tr>-->
                    <tr>
                        <td>
                            <strong>Document Checklist Creation </strong>  
                        </td>
                        <td class="acilppr">
                            <a href="javascript:void(0)" class="btn btn-success btn-sm cri popU" name="acilppr[document_checklist_creation_pop]" data-toggle="modal" data-target="#acilppr">View Document Checklist</a>
                            <input type="hidden" name="acilppr[document_checklist_creation]" id="acilpprformdc" value='<?php if (!empty($_SESSION['ServiceParameter']['service'])) {
    echo $_SESSION['ServiceParameter']['service']['document_checklist_creation']; } ?>'>								
                        </td>
                        <td class="ao">
                            <a href="javascript:void(0)" class="btn btn-success btn-sm cri popU" name="ao[document_checklist_creation_pop]" data-toggle="modal" data-target="#ao">View Document Checklist</a>
                            <input type="hidden" name="ao[document_checklist_creation]" id="aoformdc" value='<?php if (!empty($_SESSION['ServiceParameter']['Amendment - Others'])) {
    echo $_SESSION['ServiceParameter']['Amendment - Others']['document_checklist_creation'];
} ?>'>								
                        </td>
                        <td class="ac">
                            <a href="javascript:void(0)" class="btn btn-success btn-sm cri popU" name="ac[document_checklist_creation_pop]" data-toggle="modal" data-target="#ac">View Document Checklist</a>
                            <input type="hidden" name="ac[document_checklist_creation]" id="acformdc" value='<?php if (!empty($_SESSION['ServiceParameter']['Amendment - Cancellation'])) {
    echo $_SESSION['ServiceParameter']['Amendment - Cancellation']['document_checklist_creation'];
} ?>'>								
                        </td>
                        <td class="as">
                            <a href="javascript:void(0)" class="btn btn-success btn-sm cri popU" name="as[document_checklist_creation_pop]" data-toggle="modal" data-target="#as">View Document Checklist</a>
                            <input type="hidden" name="as[document_checklist_creation]" id="asformdc" value='<?php if (!empty($_SESSION['ServiceParameter']['Amendment - Surrender'])) {
    echo $_SESSION['ServiceParameter']['Amendment - Surrender']['document_checklist_creation'];
} ?>'>								
                        </td>
                        <td class="at">
                            <a href="javascript:void(0)" class="btn btn-success btn-sm cri popU" data-toggle="modal" name="at[document_checklist_creation_pop]" data-target="#at">View Document Checklist</a>
                            <input type="hidden" name="at[document_checklist_creation]" id="atformdc" value='<?php if (!empty($_SESSION['ServiceParameter']['Amendment - Transfer'])) {
    echo $_SESSION['ServiceParameter']['Amendment - Transfer']['document_checklist_creation'];
} ?>'>								
                        </td>
                        <td class="duplicate">
                            <a href="javascript:void(0)" class="btn btn-success btn-sm cri popU" data-toggle="modal" name="duplicate[document_checklist_creation_pop]" data-target="#duplicate">View Document Checklist</a>
                            <input type="hidden" name="duplicate[document_checklist_creation]" id="duplicateformdc" value='<?php if (!empty($_SESSION['ServiceParameter']['Duplicate Copy'])) {
    echo $_SESSION['ServiceParameter']['Duplicate Copy']['document_checklist_creation'];
} ?>'>								
                        </td>
                        <td class="renewal">
                            <a href="javascript:void(0)" class="btn btn-success btn-sm cri popU" data-toggle="modal" name="renewal[document_checklist_creation_pop]" data-target="#renewal">View Document Checklist</a>
                            <input type="hidden" name="renewal[document_checklist_creation]" id="renewalformdc" value='<?php if (!empty($_SESSION['ServiceParameter']['Renewal'])) {
    echo $_SESSION['ServiceParameter']['Renewal']['document_checklist_creation'];
} ?>'>								
                        </td>
                        <td class="return">
                            <a href="javascript:void(0)" class="btn btn-success btn-sm cri popU" name="return[document_checklist_creation_pop]" data-toggle="modal" data-target="#return">View Document Checklist</a>
                            <input type="hidden" name="return[document_checklist_creation]" id="returnformdc" value='<?php if (!empty($_SESSION['ServiceParameter']['Return'])) {
    echo $_SESSION['ServiceParameter']['Return']['document_checklist_creation'];
} ?>'>								
                        </td>
                        <td class="maintainence">
                            <a href="javascript:void(0)" class="btn btn-success btn-sm cri popU" data-toggle="modal" name="maintainence[document_checklist_creation_pop]" data-target="#maintainence">View Document Checklist</a>
                            <input type="hidden" name="maintainence[document_checklist_creation]" id="maintainenceformdc" value='<?php if (!empty($_SESSION['ServiceParameter']['Maintainence'])) {
    echo $_SESSION['ServiceParameter']['Maintainence']['document_checklist_creation'];
} ?>'>				
                        </td>							
                    </tr>
                    <tr>
                        <td>
                            <strong>Comments </strong>
                        </td>
                        <td class="acilppr"><textarea name="acilppr[comment]" class="form-control cri" ><?php if (!empty($_SESSION['ServiceParameter']['service'])) {
    echo $_SESSION['ServiceParameter']['service']['comment'];
} ?></textarea></td>
                        <td class="ao"><textarea name="ao[comment]" class="form-control cri" ><?php if (!empty($_SESSION['ServiceParameter']['Amendment - Others'])) {
    echo $_SESSION['ServiceParameter']['Amendment - Others']['comment'];
} ?></textarea></td>
                        <td class="ac"><textarea name="ac[comment]" class="form-control cri" ><?php if (!empty($_SESSION['ServiceParameter']['Amendment - Cancellation'])) {
    echo $_SESSION['ServiceParameter']['Amendment - Cancellation']['comment'];
} ?></textarea></td>
                        <td class="as"><textarea name="as[comment]" class="form-control cri" ><?php if (!empty($_SESSION['ServiceParameter']['Amendment - Surrender'])) {
    echo $_SESSION['ServiceParameter']['Amendment - Surrender']['comment'];
} ?></textarea></td>
                        <td class="at"><textarea name="at[comment]" class="form-control cri" ><?php if (!empty($_SESSION['ServiceParameter']['Amendment - Transfer'])) {
    echo $_SESSION['ServiceParameter']['Amendment - Transfer']['comment'];
} ?></textarea></td>
                        <td class="duplicate"><textarea name="duplicate[comment]" class="form-control cri" ><?php if (!empty($_SESSION['ServiceParameter']['Duplicate Copy'])) {
    echo $_SESSION['ServiceParameter']['Duplicate Copy']['comment'];
} ?></textarea></td>
                        <td class="renewal"><textarea name="renewal[comment]" class="form-control cri" ><?php if (!empty($_SESSION['ServiceParameter']['Renewal'])) {
    echo $_SESSION['ServiceParameter']['Renewal']['comment'];
} ?></textarea></td>
                        <td class="return"><textarea name="return[comment]" class="form-control cri" ><?php if (!empty($_SESSION['ServiceParameter']['Return'])) {
    echo $_SESSION['ServiceParameter']['Return']['comment'];
} ?></textarea></td>
                        <td class="maintainence"><textarea name="maintainence[comment]" class="form-control cri" ><?php if (!empty($_SESSION['ServiceParameter']['Maintenance of Register'])) {
    echo $_SESSION['ServiceParameter']['Maintenance of Register']['comment'];
} ?></textarea></td>

                    </tr>
                </tbody>
            </table>
            <input type="submit" value="Save" class="btn btn-primary">
        </form>
    </div>
</div>
</div>

<!------------------------------------------------------------------------------------------------------------------------------------------>
<?php $allListw = InfowizardQuestionMasterExt::getMasterList('bo_information_wizard_additional_sub_service_master', 'id', 'alias'); ?>
<?php $allListw[0] = "acilppr";
foreach ($allListw as $k => $v) {
    $optionsdd=array();
    if($v=="acilppr"){$serSubType='service';}
    if($v=="ao"){$serSubType='Amendment - Others';}
    if($v=="ac"){$serSubType='Amendment - Cancellation';}
    if($v=="as"){$serSubType='Amendment - Surrender';}
    if($v=="at"){$serSubType='Amendment - Transfer';}
    if($v=="duplicate"){$serSubType='Duplicate Copy';}
    if($v=="renewal"){$serSubType='Renewal';}
    if($v=="return"){$serSubType='Return';}
    if($v=="maintainence"){$serSubType='Maintenance of Register';}
    
    

    ?>

    <!-- Modal content for map--> 
    <div class="modal fade" id="<?php echo $v; ?>" role="dialog" data-backdrop="static" data-keyboard="false" >
        <div class="modal-dialog">
            <div class="modal-content" style="width:120%;overflow-y: scroll;height:550px ">
                <div class="modal-header">
                    <button class="btn btn-primary"><i class="fa fa-file-pdf-o"></i>&nbsp; Map Documents with <b><?php echo ucwords($serSubType); ?></b></button>  <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
                <div class="modal-body">
                    <form id="<?php echo $v; ?>form"  action="" method="post">
                        <table class="table table-bordered table-hover table-striped re">
                            <thead>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b>SR NO.</b></td>
                                    <td><b>Document ID</b></td>
                                      <td><b>Document Name</b></td>
                                    <td><b>Issuer</b></td>
                                    <td><b>Issuer By</b></td>
                                   
                                  
                                    <td><b>Is Mandatory</b></td>
                                    <td><b>Comment</b></td>
                                </tr>
                                <tr><td colspan="7"><input class="findmember form-control input-lg" placeholder="Search in documents" type="text"></td></tr>
                                
    <?php
  //echo  $serSubType."=====";
    $count=1;$addedDoc=array();
    if (!empty($_SESSION['ServiceParameter'][$serSubType]['document_checklist_creation'])) {
    $data_s = $_SESSION['ServiceParameter'][$serSubType]['document_checklist_creation'];
         $optionsdd = json_decode($data_s); 
   //  echo "saved Data";   print_r($optionsdd);
         if(!empty($optionsdd)){
foreach($optionsdd as $oa){ 
       $docID=$oa->doc_id;
        $docDatas= InfowizardQuestionMasterExt::getSingleDocumentMapping($docID);
     $docData=$docDatas[0];  ?>
       
    <tr class="userlist <?php echo $docData['chklist_id'];?>" name="<?php echo strtolower($docData['chklist_id']);?>">
                                        <td><?php echo $count++; ?></td>
                                        <td><?php echo  $docData['chklist_id']; ?></td>
                                         <td><input value="<?php $addedDoc[]=$docData['docchk_id']; echo $docData['docchk_id']; ?>" name='document_checklist_creation[<?php echo $count; ?>]' type="checkbox"  checked />
  <?php 
    echo $docData['document_name'];  ?> </td>
                                     <td> <?php echo $docData['issuer_name']; ?>   
                                        </td>
                                        <td> <?php echo $docData['issuerby_name']; ?>  
                                        </td>
                                       
                                        <td><select class="form-control" name="is_required[<?php echo $count; ?>]" id="is_required">
                                                     <option value="N" <?php if(!empty($oa->is_required) && $oa->is_required=="N"){ echo " selected";}?>>NO</option>                               
                                           
                                                <option value="Y" <?php if(!empty($oa->is_required) && $oa->is_required=="Y"){ echo " selected";}?>>YES</option>
                                            </select></td>
                                        <td><input class="form-control" placeholder="Comment" name="doc_comment[<?php echo $count; ?>]" type="text" id="doc_comment" value="<?php if(!empty($oa->doc_comment)){ echo $oa->doc_comment; } ?>"></td>
                                    </tr>
         <?php }         }
         
//  $options = explode(',', $optionsdd);
    }  if(!empty($allDocuments)){
        
    
    foreach($allDocuments as $app) { 
       // print_r($app);die;
        if(!in_array($app['docchk_id'],$addedDoc)){
        ?>  
                  <tr class="userlist <?php echo $app['chklist_id'];?>" name="<?php echo strtolower($app['chklist_id']);?>">

                                        <td><?php echo $count++; ?></td>
                                         <td><?php echo  $app['chklist_id']; ?></td>
                                           <td><input value="<?php echo $app['docchk_id']; ?>" name='document_checklist_creation[<?php echo $count; ?>]' type="checkbox"/>
        <?php echo $app['document_name']; ?> </td>
                                        <td> <?php echo $app['issuer_name']; ?>   
                                        </td>
                                        <td> <?php echo $app['issuerby_name']; ?>  
                                        </td>
                                     
                                        <td><select class="form-control" name="is_required[<?php echo $count; ?>]" id="is_required">
                                                 <option value="N">NO</option>     
                                                <option value="Y">YES</option>
                                                                         
                                            </select></td>
                                        <td><input class="form-control" placeholder="Comment" name="doc_comment[<?php echo $count; ?>]" type="text" id="doc_comment" ></td>
                                    </tr>
    <?php } } } ?>
                                <tr><td colspan="4"><input type="button" value="Save" class="svdoc btn btn-primary" rel="<?php echo $v; ?>form" pec="<?php echo $v; ?>"> </td></tr>
                            </tbody>
                       </table>  

                    </form>
                </div>
            </div>
        </div>
    </div>	
<?php } ?>
<script>
    
    $(document).ready(function () {
        $(".cri").each(function () {
            var str = $(this).attr("name");
            var res = str.replace("]", "");
            var res1 = res.replace("[", "_");
            $(this).attr("id", res1);
        });
    });
    function hide(nme, frm) {
        var frm1 = frm.replace("]", "");
        var frm2 = frm1.replace("[", "_");
        var choosenOption = document.getElementById(frm2).value;
        var nme1 = nme.split(",");
        for (var i = 0; i <= nme1.length; i++) {
            var res = nme1[i].replace("]", "");
            var res1 = res.replace("[", "_");
            if (choosenOption == "Y") {
                $("#" + res1).css("display", "block");
            } else {
                $("#" + res1).css("display", "none");
            }
        }
    }
    /*function hide(nme, frm) {
        var frm1 = frm.replace("]", "");
        var frm2 = frm1.replace("[", "_");
        var choosenOption = document.getElementById(frm2).value;
        var nme1 = nme.split(",");
        for (var i = 0; i <= nme1.length; i++) {
            var res = nme1[i].replace("]", "");
            var res1 = res.replace("[", "_");
            if (choosenOption == "Y") {
                $("#" + res1).css("display", "block");

            } else {
                $("#" + res1).css("display", "none");
            }
        }
    }*/
    function hideshow(nme, nme2, frm) {
        var frm1 = frm.replace("]", "");
        var frm2 = frm1.replace("[", "_");
        var choosenOption = document.getElementById(frm2).value;
        var nme1 = nme.split(",");
        for (var i = 0; i <= nme1.length; i++) {
            var res = nme1[i].replace("]", "");
            var res1 = res.replace("[", "_");

            var nme3 = nme2.split(",");
            var res2 = nme3[i].replace("]", "");
            var res3 = res2.replace("[", "_");
            if (choosenOption == "Y") {
                $("#" + res1).css("display", "block");
                $("#" + res3).css("display", "none");
            } else {
                $("#" + res1).css("display", "none");
                $("#" + res3).css("display", "block");
            }
        }
    }
    function hideit(showme, hideme, iwsw, currentValue) {

        var frm1 = currentValue.replace("]", "");
        var frm2 = frm1.replace("[", "_");
        var choosed = document.getElementById(frm2).value;

        var nrm1 = iwsw.replace("]", "");
        var nrm2 = nrm1.replace("[", "_");
        $("#" + nrm2).css("display", "block");
        var nextCurrentOption = document.getElementById(nrm2).value;

        var nme1 = showme.split(",");
        for (var i = 0; i <= nme1.length; i++) {
            var res = nme1[i].replace("]", "");
            var res1 = res.replace("[", "_");

            var nme3 = hideme.split(",");
            var res2 = nme3[i].replace("]", "");
            var res3 = res2.replace("[", "_");
            if (nextCurrentOption == "N" && choosed == "Y") {
                $("#" + res1).css("display", "block");
                $("#" + res3).css("display", "none");

            } else if (nextCurrentOption == "Y" && choosed == "Y") {
                $("#" + res1).css("display", "none");
                $("#" + res3).css("display", "block");

            } else if (choosed == "N") {
                $("#" + res1).css("display", "none");
                $("#" + res3).css("display", "none");
                $("#" + nrm2).css("display", "none");
            } else {

            }
        }


    }

    $(".svdoc").click(function () {
        $(this).css("background", "#e5e5e5");
        var formID = $(this).attr("rel");
        var modalID = $(this).attr("pec");
        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/ServiceParameters/convertJson",
            data: $("#" + formID).serialize(),
            success: function (result) {
                $("#" + formID + "dc").val(result);
                $('#' + modalID).modal('toggle');
            }
        });
    });


    $(".serviceDepartment").on('change', function () {
        var relDept = $(this).attr("relDep");
        var dept = $(this).find('option:selected').text();
        $.ajax({
            type: "POST",
            url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/ServiceParameters/getDepartmentServiceList/department/" + dept,
            success: function (result) {
                $("#" + relDept + "_swcs_service_id").html(result);
            }
        });
    });
    $(".deptser").css('display', 'none');
    
$(".findmember").keyup(function(){    
var ename=$(this).val().toLowerCase();if(ename.length==0){$(".userlist").show();}else{$(".userlist").hide();}
//$(".re").find("[name="+ename+"]").show();
var ename1=$(this).val();
$(".re").find("."+ename1).show();
});
$(".popU").hide();
</script>