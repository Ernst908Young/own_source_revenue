<title>Processed Application</title>
<?php
$basePath="/themes/investuk";
$role_id = $_SESSION['role_id'];
$userId = $_SESSION['uid'];
$disctrict_id = $_SESSION['dist_id'];

$serviceByUserrole = Yii::app()->db->createCommand("SELECT * FROM tbl_user_service_role WHERE user_id = $userId AND role_id = $role_id AND is_active='Y'")->queryAll(); 
$checkser_arr = [];
foreach ($serviceByUserrole as $key => $value) {
    $checkser_arr[$value['service_id']] = $value['service_id'];
}

$resArr = Yii::app()->db->createCommand("SELECT id,service_id,current_role_id,next_role_id,form_type_id FROM bo_infowiz_form_builder_configuration where current_role_id=$role_id")->queryAll();
$formTypeArr = array();
foreach($resArr as $key=>$val)
{
    $formTypeArr[$val['service_id']] = $val['form_type_id'];
}   
$sql="SELECT 
        bo_new_application_submission.submission_id,
        bo_new_application_submission.field_value,
        bo_information_wizard_service_parameters.service_id as s_id,
        bo_new_application_submission.service_id as serviceID,
        bo_landregion.lr_name as District,
        bo_infowizard_issuerby_master.name as DepartmentName, 
        bo_information_wizard_service_parameters.core_service_name, 
        bo_new_application_submission.unit_name as unitName,
        bo_new_application_submission.application_status as applicationCurrentStatus, 
        bo_new_application_submission.application_created_date as appliedOn, 
        bo_information_wizard_service_parameters.is_certificate,
        bo_new_application_submission.print_app_call_back_url,
        bo_new_application_submission.download_certificate_call_back_url
        FROM bo_infowiz_formbuilder_application_forward_level  
        INNER JOIN bo_new_application_submission  
        ON bo_infowiz_formbuilder_application_forward_level.app_Sub_id=bo_new_application_submission.submission_id  
        LEFT JOIN bo_landregion 
        ON bo_landregion.lr_id=bo_new_application_submission.landrigion_id
        LEFT JOIN sso_users 
        ON sso_users.user_id=bo_new_application_submission.user_id
        LEFT JOIN sso_profiles 
        ON sso_profiles.user_id=sso_users.user_id
        INNER JOIN bo_information_wizard_service_parameters on bo_new_application_submission.service_id=concat(bo_information_wizard_service_parameters.service_id,'.',bo_information_wizard_service_parameters.servicetype_additionalsubservice) 
        INNER JOIN bo_information_wizard_service_master  on bo_information_wizard_service_parameters.service_id=bo_information_wizard_service_master.id
        INNER JOIN bo_infowizard_issuerby_master  ON bo_information_wizard_service_master.issuerby_id=bo_infowizard_issuerby_master.issuerby_id 
        where  
        bo_new_application_submission.application_status IN('A','R','RS','H')
       /* AND bo_infowiz_formbuilder_application_forward_level.next_role_id=$role_id*/
      /* AND bo_new_application_submission.service_id ='49.0'*/
        AND bo_information_wizard_service_parameters.is_active='Y'
        GROUP BY bo_infowiz_formbuilder_application_forward_level.app_Sub_id";
        /* bo_infowiz_formbuilder_application_forward_level.approv_status='P' AND
        bo_infowiz_formbuilder_application_forward_level.forwarded_dept_id=$_SESSION[dept_id]   
        
        AND  bo_infowiz_formbuilder_application_forward_level.verifier_user_comment='' 
        AND bo_new_application_submission.landrigion_id=$disctrict_id */
        $connection=Yii::app()->db; 
        $command=$connection->createCommand($sql);
        $res = $command->queryAll();
?>

<div class="dashboard-home">
   <div class="applied-status">
        <div class="status-title d-flex flex-wrap align-items-center justify-content-between">
            <h4>Processed Applications (<?php $pa=0;    if(!empty($res)) { 
                                
                                foreach($res as $key=>$val){
                                   // if(in_array($val['s_id'], $checkser_arr)){
                                            $pa=$pa+1;
                                   // } ;
                                }
                            } ?><?= $pa ?>)</h4>
        
        </div>

       <?php 
            

       ?>
<div id="sample_1_wrapper" class="dataTables_wrappers dataTables_wrapper">
<table width="100%" id='sample_1'>

    <thead>
        <tr>
            <th class="text-center" width="5%">Sr. No.</th>
           <!--  <th class="text-center" width="15%">Entity Name</th>  -->           
            <th class="text-center" width="20%">Service Name</th>
           <!--  <th class="text-center" width="20%">Proposed Name</th> -->
            <th class="text-center" width="10%">Application Status</th>
            <th class="text-center" width="12%">Applied On</th>
            <th class="text-center" width="13%">Action</th>
        </tr>   
    </thead>
        <?php $statusArray=array('A'=>'Approved','B'=>'Pending For Payment','H'=>'Reverted','I'=>'Incomplete','R'=>'Rejected','F'=>'Forwarded','Z'=>'Archived','P'=>'Pending','FA'=>'Forwarded to Approver','W'=>'Withdrawn')?>
<tbody class="ticket-item">            
    <?php if(!empty($res)) { 
         $legal_ends_sql = Yii::app()->db->createCommand("SELECT id, suffix_name FROM bo_business_entity_type_suffix")->queryAll();
         $legal_ends_arr = [];
         foreach ($legal_ends_sql as $key => $value) {
             $legal_ends_arr[$value['id']] = $value['suffix_name'];
         }
            foreach($res as $key=>$val){
                   // if(in_array($val['s_id'], $checkser_arr)){
                //$formtype_id = $formTypeArr[$val['serviceID']];
                $status=$val['applicationCurrentStatus'];
                
                //$ukd='UK-FCL-00146_0';
        ?>
                <tr class="ticket-row tableinside" id="<?php echo $key; ?>">
                <td class="text-center"><?php echo $key+1;?></td>
                <!-- <td>  -->        
                <!--?php 
                 $entity_name  = "";
                if(isset($val['serviceID'])){
                    if($val['serviceID']=='2.0')
                    {
                        $approvedNameSql = "SELECT  * FROM bo_recomended_name where submission_id='$val[submission_id]' AND role_id IN(84, 83) AND withdrawal_status='0' order by role_id DESC";
                        $approvedData = Yii::app()->db->createCommand($approvedNameSql)->queryRow();
                       
                        if($approvedData['assign_new_name']!=''){
                            //echo $approvedName = "<br><b>Approved Name: </b>".$approvedData['assign_new_name'];
                           $entity_name = $approvedData['assign_new_name'];
                        }else if($approvedData['recomended_value']!='' && $approvedData['assign_new_name']==''){
                           // echo $approvedName = "<br><b>Approved Name: </b>".$approvedData['recomended_value'];
                           $entity_name = $approvedData['recomended_value'];
                        }
                       
                    }else{
                        $approvedIncorp = "SELECT company_name FROM bo_company_details where srn_no='$val[submission_id]' AND is_active='1'";
                        $approvedNameIncorp = Yii::app()->db->createCommand($approvedIncorp)->queryRow();
                        if(isset($approvedNameIncorp['company_name']) && !empty($approvedNameIncorp['company_name'])){
                             $entity_name  = $approvedNameIncorp['company_name'];
                            //echo "<br><b>Entity Name: </b>".$approvedNameIncorp['company_name'];
                        }
                    }
                }
                echo  $entity_name;
                ?-->
                <!-- </td>  -->              
                <td><?php $service_name = @$val['core_service_name']; 
                    $proposed_name = '';
                    if(isset($val['serviceID'])){
                    if($val['serviceID']=='2.0')
                    {
                         $fieldData = json_decode($val['field_value'],true);
                         if(isset($fieldData['UK-FCL-00044_0'])){
                            if(!empty($fieldData['UK-FCL-00044_0'])){
                                switch ($fieldData['UK-FCL-00044_0']) {
                                    case '1':
                                       /* $proposed_name = '<b>Proposed Names: </b><br>1) '.@$fieldData['UK-FCL-00046_0'].' '.@$fieldData['UK-FCL-00475_0']
                                        .'<br>2) '.@$fieldData['UK-FCL-00047_0'].' '.@$fieldData['UK-FCL-00486_0']
                                        .'<br>3) '.@$fieldData['UK-FCL-00048_0'].' '.@$fieldData['UK-FCL-00487_0'];*/
                                         $proposed_name = @$fieldData['UK-FCL-00046_0'].' '.@$fieldData['UK-FCL-00475_0'].', '.@$fieldData['UK-FCL-00047_0'].' '.@$fieldData['UK-FCL-00486_0'].', '.@$fieldData['UK-FCL-00048_0'].' '.@$fieldData['UK-FCL-00487_0'];
                                        $service_name = 'Name Reservation-Society (Form 15)';
                                        break;
                                    case '2':
                                           if(is_array($legal_ends_arr) && !empty($legal_ends_arr)){
                                                $le014 = isset($legal_ends_arr[@$fieldData['UK-FCL-00014_0']]) ? $legal_ends_arr[@$fieldData['UK-FCL-00014_0']] : '';
                                                $le484 = isset($legal_ends_arr[@$fieldData['UK-FCL-00484_0']]) ? $legal_ends_arr[@$fieldData['UK-FCL-00484_0']] : '';
                                                $le485 = isset($legal_ends_arr[@$fieldData['UK-FCL-00485_0']]) ? $legal_ends_arr[@$fieldData['UK-FCL-00485_0']] : '';
                                           }
                                          /* $proposed_name = '<b>Proposed Names: </b><br>1) '.@$fieldData['UK-FCL-00015_0'].' '.$le014
                                           .'<br>2) '.@$fieldData['UK-FCL-00016_0'].' '.$le484
                                           .'<br>3) '.@$fieldData['UK-FCL-00017_0'].' '.$le485;*/
                                            $proposed_name = @$fieldData['UK-FCL-00015_0'].' '.$le014
                                           .', '.@$fieldData['UK-FCL-00016_0'].' '.$le484
                                           .', '.@$fieldData['UK-FCL-00017_0'].' '.$le485;
                                           $service_name = 'Name Reservation-Company (Form 33)';
                                        break;
                                    case '3':
                                          /* $proposed_name = '<b>Proposed Names: </b><br>'.@$fieldData['UK-FCL-00056_0'];*/
                                           $proposed_name = @$fieldData['UK-FCL-00056_0'];
                                           $service_name = 'Business Name Registration (Form 1)';
                                         break;    
                                                                        
                                    default:
                                        $proposed_name = "NA";
                                        break;


                                }
                            }
                        }
                    }

                    }
                    echo $service_name;
                ?>
                        
                    </td>
                <!-- <td>
                   <1?=  $proposed_name ?>
                </td> -->
                <td class="text-center"><?php echo @$statusArray[$status]?></td>
                <td class="text-center"><?php echo date("d-M-y",strtotime($val['appliedOn']));?></td>   
                <?php 
                /*$action = Yii::app()->db->createCommand("SELECT form_action_controller,form_service_js FROM   bo_infowiz_form_builder_configuration where service_id=$val[serviceID]")->queryRow();*/
                ?>
                <td class="text-center">
                    <?php $printappurl =  $val['print_app_call_back_url'];  ?>
                    <a target="_blank" href="<?php echo $printappurl; ?>" title="Print Application">
                       <img src="<?php echo $basePath; ?>/assets/applicant/images/print-icon.png">                           
                    </a>
                    &nbsp;
                     <a href="<?php echo Yii::app()->createAbsoluteUrl('infowizardtwo/subForm/applicationTimeline/subID/'. base64_encode($val['submission_id']));?>" title="View Timeline">
                        <img src="<?php echo $basePath; ?>/assets/applicant/images/time-icon.png">
                    
                     </a>
                     
                <!-- <a href="<1?php echo Yii::app()->createAbsoluteUrl("/infowizardtwo/".$action['form_action_controller']."/departmentFormView/service_id/".$val['serviceID']."/pageID/1/subID/".$val['submission_id']."/formCodeID/$formtype_id");?>" style="color:blue;" title="click to view this application"><i class="fa fa-eye"></i></a> -->

                 <?php 
                   if($status=='A' && $val['is_certificate']==1 && !empty($val['download_certificate_call_back_url'])){ 
                        $parse = parse_url($val['download_certificate_call_back_url']);
                        $certi_path = isset($parse['path']) ? $parse['path'] : '';
                    ?>
                      &nbsp;
                          <a target="_blank" href="/panchayatiraj/backoffice/doc/mydoc?view=<?php echo DefaultUtility::getDockey($certi_path); ?>&from=ticket" title="Download Letter / Certificate">
                               <img src="<?php echo $basePath; ?>/assets/applicant/images/pdf-icon.png"> 
                          </a>
                    
                    
                    <?php } ?>
                    <?php 
                   if($status=='A'){ ?>
                    <a href="/panchayatiraj/backoffice/investor/documentManagement/documentdownload/subID/<?= base64_encode($val['submission_id']) ?>"> <img src="<?php echo $basePath; ?>/assets/applicant/images/doc_list1.png"></a>
                    <?php } ?>
                <!--<br/><br/>
                <a href="<?php echo Yii::app()->createAbsoluteUrl("/infowizard/subForm/applicationTimeline/subID/".base64_encode($val['submission_id'])."");?>" class="btn btn-success">Timeline</a>-->
                </td>       
    </tr>   <?php   
            //}
        }
    }
    ?>
</tbody>
</table>
</div>
</div>
 </div>
<?php

   $base=Yii::app()->theme->baseUrl;

?>

<!-- BEGIN PAGE LEVEL PLUGINS -->

<script src="<?=$base?>/assets/global/scripts/datatable.js" type="text/javascript"></script>

<script src="<?=$base?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>

<script src="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>

<!-- <script src="<?=$base?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script> -->

<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->

<!-- <link href="<?=$base?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />

<link href="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" /> -->

<!-- END PAGE LEVEL PLUGINS -->

<script type="text/javascript">

   var TableDatatablesButtons = function() {

     var e = function() {

             var e = $("#sample_1");

             e.dataTable({

                 language: {

                     aria: {

                         sortAscending: ": activate to sort column ascending",

                         sortDescending: ": activate to sort column descending"

                     },

                     emptyTable: "No data available in table",

                    info: "<span style='font-size:15px'>Showing _START_ to _END_ of _TOTAL_ entries</span>",
                    infoEmpty: "<span style='font-size:15px'>No entries found</span>",
                    infoFiltered: "<span style='font-size:15px'>(filtered1 from _MAX_ total entries)</span>",
                    lengthMenu: "<span style='font-size:15px; font-weight:100; margin-top:5px;'>Entries:</span>  <span style='margin-left:5px;'>_MENU_ </span>",
                    search: "<span style='font-size:15px; font-weight:100; margin-top:5px;'>Search:</span>",

                     zeroRecords: "No matching records found"

                 },

                 buttons: [],

                 responsive: !0,

                 "ordering": false,

                 lengthMenu: [

                     [5, 10, 15, 20, -1],

                     [5, 10, 15, 20, "All"]

                 ],

                 pageLength: 10,

                 dom: "<'row'<'col-md-6 col-sm-12 form-group'l><'col-md-6 col-sm-12 form-group'f>r><'mb-3't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"

             })

         },

     

         n = function() {

            
             var e = new Datatable;

             e.init({

                 src: $("#datatable_ajax"),

                 onSuccess: function(e, t) {},

                 onError: function(e) {},

                 onDataLoad: function(e) {},

                 loadingMessage: "Loading...",

                 dataTable: {

                     bStateSave: !0,

                     lengthMenu: [

                         [10, 20, 50, 100, 150, -1],

                         [10, 20, 50, 100, 150, "All"]

                     ],

                     pageLength: 10,

                     ajax: {

                         url: "../demo/table_ajax.php"

                     },

                     "ordering": false,

                     buttons: []

                 }

             }), e.getTableWrapper().on("click", ".table-group-action-submit", function(t) {

                 t.preventDefault();

                 var a = $(".table-group-action-input", e.getTableWrapper());

                 "" != a.val() && e.getSelectedRowsCount() > 0 ? (e.setAjaxParam("customActionType", "group_action"), e.setAjaxParam("customActionName", a.val()), e.setAjaxParam("id", e.getSelectedRows()), e.getDataTable().ajax.reload(), e.clearAjaxParams()) : "" == a.val() ? App.alert({

                     type: "danger",

                     icon: "warning",

                     message: "Please select an action",

                     container: e.getTableWrapper(),

                     place: "prepend"

                 }) : 0 === e.getSelectedRowsCount() && App.alert({

                     type: "danger",

                     icon: "warning",

                     message: "No record selected",

                     container: e.getTableWrapper(),

                     place: "prepend"

                 })

             }), $("#datatable_ajax_tools > li > a.tool-action").on("click", function() {

                 var t = $(this).attr("data-action");

                 e.getDataTable().button(t).trigger()

             })

         };

     return {

         init: function() {

             jQuery().dataTable && (e(), n())

         }

     }

   }();

   jQuery(document).ready(function() {

     TableDatatablesButtons.init();
   /* $("#sample_1_length").find("label").attr('style','font-size:15px; font-weight:100;');
    $("#sample_1_length").find("select").attr("style","width:50px; margin-left:5px;");

    $("#sample_1_filter").find("label").attr('style','font-size:15px; font-weight:100;');
    $("#sample_1_filter").find("input").attr("placeholder",'Search by keywords');
    $("#sample_1_info").attr("style","font-size:15px; margin-top:10px;");
    $("#sample_1_paginate").attr("style",'margin-top:15px;');*/
   });

</script>   