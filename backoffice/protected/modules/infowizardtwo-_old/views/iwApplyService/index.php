<?php
// @SANTOSH FOR Offline/Online
// Date - 24-10-2017
// 
//@Edited By Rahul Kumar
//Date - 04052018
// Description of Change : New Mapping with sub_service_id 
//echo '<!--<pre>===='; print_r($res_s).'<pre>-->'; 
 // $type ='INC';

if(isset($user_iuid['iuid']) && !empty($user_iuid['iuid'])){
    $iuid=$user_iuid['iuid'];

}
else{
    $iuid='';

}



if (isset($_GET['is']) && $_GET['is'] != '')
    $is = $_GET['is'];
else
    $is = "no";



if (isset($_GET['userid']) && $_GET['userid'] != '')
{
    $userid = $_GET['userid'];
    $get_investor = "SELECT user_id,iuid FROM sso_users where user_id = $userid and is_account_active='Y' order by user_id desc limit 10";
    $connection = Yii::app()->db; 
    $command = $connection->createCommand($get_investor);
    $user_data = $command->queryRow();
    $iuid_val=$user_data['iuid'];
}
    
else{
    $userid = 0;
    $iuid_val=null;
}
   
?>
<style>
	#uldiv {
		margin: -10px 15.2%;
		background: #fff;
		padding: 0px 15px;
		list-style-type: none;
		border: 1px solid #ccc;
		position: absolute;
		z-index: 1;
		width: 24.1%;
	}
	#uldiv li {
		border-bottom: 1px solid #ccc;
		padding: 1px 15px;
		margin: 0 -15px;
	}
	#uldiv li :hover {
		color: orangered;
	}
    a:hover{ color:#000;}
	.dt-buttons {
        margin-top: -52px !important;
	}
	#484_0{display: none;}
	.urlcheckmsg{
		font-size: 14px !important;
		color:#F00;
	}

</style>
<div class='portlet box green'>
    <div class="portlet-body">
       <!-- <div class="row" style="margin:10px 0 10px 0;">
            <label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Select User</label>
            <div class="col-lg-4">  
               <select name="investor_list" class="select2-me" onchange="window.location = '/backoffice/infowizard/IwApplyService/index/userid/' + this.value+'/type/INC'">
                    <option value="">Select User</option>

                         <?php if (isset($investor_data) && !empty($investor_data)) { ?>
                            <option value="<?php echo $investor_data['user_id']; ?>" selected='selected'>
                            <?php echo $investor_data['iuid']; ?>
                            </option>
                        <?php   } ?> 
                </select>
            </div>
        </div>-->
		<div class="row" style="margin:10px 0 10px 0;">
			<label for="inputEmail1" class="col-lg-2 col-sm-2 control-label">Select User</label>
			<div class="col-lg-4">  
			<!-- <select name="investor_list" class="select2-me" onchange="window.location = '/backoffice/infowizard/IwApplyService/index/userid/' + this.value+'/type/INC'">
				<option value="">Select User</option>

					 <?php if (isset($investor_data) && !empty($investor_data)) { ?>
						<option value="<?php echo $investor_data['user_id']; ?>" selected='selected'>
						<?php echo $investor_data['iuid']; ?>
						</option>
					<?php   } ?> 
			</select> -->
			<input type="text" name="investor_list" class="form-control" class="s2id_autogen2_search" id="abc" value='<?= $iuid_val ?>'>
			</div>
        </div>
       <div class="row">
           <div class="col-lg-4" id='uldiv'>
                
            </div>
       </div>
        <div class="row" style="margin:10px 0 10px 0;">
        <?php
            if ($id == 58) {
        ?>
            
                <div class="col-lg-12">
                    <strong>
                        Investors intend to avail "Application for Building Plan Approval/ Consent to Establish" services needs to apply through "Apply for Sectorial Clearances (Beta)". To apply "Application for Building Plan Approval/ Consent to Establish" service now, please <a target="_blank" href="/backoffice/frontuser/applyServiceCP/ServiceListing">click here</a></strong>
                </div>
            
        <?php
        }
        ?>


        <section class="panel site-min-height" style="display:">
            <header class="panel-heading">
                Department Services
            </header>

            <div class="panel-body">
                <div class="table">
                    <table class="table table-bordered" width="100%" id="sample_2">
                        <thead>
                            <tr>
                                <th style="width:5%">ID</th>
                                <th style="width:25%">Service Name</th>
                                <th style="width:25%">Service Incidence</th>
                                <th style="width:10%">Type Of Service</th>
                                <th style="width:15%">Status Of Service</th>
                                <th style="width:10%">CAF</th>
                                <!-- <th style="width:10%">Document Checklist</th> -->
                                <th style="width:10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($res_s)

                                foreach ($res_s as $key => $data_arr) {

                                    
                                    $service_id = $data_arr['service_id'];

                                    $sub_service_id = $data_arr['servicetype_additionalsubservice'];
                                    if ($data_arr['is_integrated_with_swcs'] == 'Y') {
                                        $swcs_department_id = $data_arr['department_id'];
                                        $swcs_service_id = $data_arr['swcs_service_id'];
                                    } else {
                                        $swcs_department_id = false;
                                        $swcs_service_id = false;
                                    }

                                    if ($data_arr['core_service_name'] != '') {
                                        ?>
                                        <?php
                                        //echo $type;
                                        //echo "<pre>";
                                        //print_r($data_arr);
                                        if ((($type == 'PES') && ($data_arr['service_id'] != '484') && ($data_arr['incidence_pre_establishment'] == 1) && $sub_service_id == 0) ||
                                                (($type == 'POS') && ($sub_service_id == 0) && ($data_arr['incidence_pre_operation'] == 1) && (($data_arr['service_type'] != 'Amendment - Others') || ($data_arr['service_type'] != 'Amendment - Surrender') || ($data_arr['service_type'] != 'Amendment - Cancellation') || ($data_arr['service_type'] != 'Amendment - Cancellation'))) ||
                                                (($type == 'PO') && (($sub_service_id != 0))) || ($type == '') ||                                                 
                                                ($type == 'INC' && $data_arr['is_incentive'] == 1)) {
                                            ?>
                                        

                                            <tr id="<?php echo $service_id . "_" . $sub_service_id; ?>">
                                                <td><?php echo $service_id . "." . $sub_service_id; ?>


                                                <form action="/backoffice/infowizard/IwApplyService/DocumentsChecklist/is/<?php echo $is; ?>/type/<?php echo $type; ?>" method="GET" id="services_post" target="_blank">

                                                    <input type="hidden" name="service_id" value='<?php echo $service_id; ?>' />

                                                    <input type="hidden" name="sub_service_id" value='<?php echo $sub_service_id; ?>' />

                                                    <input type="hidden" name="department_id" value='<?php echo $id; ?>' />

                                                    <input type="hidden" name="swcs_department_id" value='<?php echo $swcs_department_id; ?>' />
                                                    <input type="hidden" name="swcs_service_id" value='<?php echo $swcs_service_id; ?>' />
                                                     <input type="hidden" name="user_id" value='<?php echo $user_id; ?>' />
                                                     <input type="hidden" name="iuid" value='<?php echo $iuid; ?>' />
                                                    <input type="hidden" name="new_name" value='<?php echo $data_arr['core_service_name']; ?>' />   
                                                        
                                                        </td>
                                                        <td><?php if($data_arr['core_service_name']=='CAF') { echo "IN-Principle Approval Application"; }else{ echo $data_arr['core_service_name']; } ?></td>
                                                        
                                                        <td><?php
                                                            if ($data_arr['incidence_pre_establishment'] == 1)
                                                                echo "Pre Establishment Service <br> ";
                                                            if ($data_arr['incidence_pre_operation'] == 1)
                                                                echo "Pre Operational Service";
                                                            if ($data_arr['incidence_post_operation'] == 1)
                                                                echo "Post Operational";
                                                            ?></td>


                                                        <td><?php echo $data_arr['service_type']; ?></td>

                                                        <td>
                                                            <?php
                                                            $offline_flag = 0;
                                                            $online_flag = 0;
                                                            $swcs_flag = 0;

                                                            $is_online = $data_arr['is_online'];
                                                            $is_integrated_with_swcs = $data_arr['is_integrated_with_swcs'];
                                                            if ($is_online == 'N') {
                                                                $status_text = "Offline";
                                                                $offline_flag = 1;
                                                                $online_flag = 0;
                                                                $swcs_flag = 0;
                                                            } else if ($is_online == 'Y' && $is_integrated_with_swcs == 'Y') {
                                                                $status_text = "Integrated With SWCS";
                                                                $offline_flag = 0;
                                                                $online_flag = 0;
                                                                $swcs_flag = 1;
                                                            } else if ($is_online == 'Y' && $is_integrated_with_swcs == 'N') {
                                                                $status_text = "Online";
                                                                $offline_flag = 0;
                                                                $online_flag = 1;
                                                                $swcs_flag = 0;
                                                            }
                                                            echo $status_text;
                                                            ?>
                                                        </td>

                                                        <td>
                                                        
                                                            <?php 
                                                            
                                                            $service_idArrWithOutCAF = array('484','3','571','577','591','578','590');
                                                            $abyeance=array();
                                                            
                                                            $landRequirExist = CafMaster2Ext::getCafPartaillySubmitExist($user_id); 
                                                            //echo $landRequirExist;
                                                                                                               
                                                            if($landRequirExist){
                                                                $service_idArrWithOutCAF[]=31;
                                                                $service_idArrWithOutCAF[]=12;
                                                                $service_idArrWithOutCAF[]=198;
                                                                $abyeance = array(31,12,198);
                                                               // echo "$landRequirExist";  print_r($res_caf); 
                                                            }
                                                            
                                                            if(in_array($service_id ,$service_idArrWithOutCAF) && !in_array($service_id,$abyeance)) 
                                                            { 
                                                            ?>
                                                                <input name="caf_id" value="NULL" type="hidden">
                                                          
                                                            <?php   
                                                            }
                                                            if(!in_array($service_id ,$service_idArrWithOutCAF) || in_array($service_id,$abyeance)) {    
                                                                $required_text = '';
                                                                $blank = '0';
                                                                if (($offline_flag == 1 || $swcs_flag == 1)) {
                                                                    $required_text = 'required';
                                                                }
                                                                $siidcul_array = array(12.0,17.0,14.0,15.0,21.0,17.0,22.0,19.0,20.0,12.1);
                                                                $caf_dropdown = '<select name="caf_id" class="form-control" ' . $required_text . '>
                                                                <option value="' . $blank . '">Select Approved CAF</option>';
                                                                if ($res_caf)
                                                                    foreach ($res_caf as $keyc => $caf_arr) {
                                                                        //$caf_dropdown .= '<option value="'.$caf_arr['submission_id'].'">CAF ID - '.$caf_arr['submission_id'].'</option>';                
                                                                        if ($caf_arr['application_id'] == 1) {                          
                                                                            $caf_dropdown .= '<option value="' . $caf_arr['submission_id'] . '">CAF ID - ' . $caf_arr['submission_id'] . '</option>';
                                                                        } else if (($caf_arr['application_id'] == 11)&& (($sub_service_id == '6') || in_array($service_id.'.'.$sub_service_id,$siidcul_array))) { 
                                                                            $caf_dropdown .= '<option value="' . $caf_arr['submission_id'] . '">EU - ' . $caf_arr['submission_id'] . '</option>';
                                                                        }
                                                                    }
                                                                if(in_array($service_id,$abyeance)){                                            
                                                                    $caf_dropdown .= '<option value="' . $landRequirExist . '">CAF ID (Abeyance)- ' . $landRequirExist . '</option>';
                                                                }
                                                                if ($swcs_flag == 1 && $id != 18 && $id != 22) {
                                                                   // $caf_dropdown .= '<option value="NULL">Existing Unit</option>';
                                                                }
                                                                $caf_dropdown .= '</select>';

                                                                if (($offline_flag == 1 || $swcs_flag == 1 )) { // $id != 1 
                                                                    echo $caf_dropdown;
                                                                  }
                                                            }
                                                        ?>
                                                        </td>
                                                            <?php
                                                            $mapped_docs = json_decode($data_arr['document_checklist_creation'], true);
                                                            ?>
                                                        <!-- <td> <a onclick="openDMSPopup('<?php echo $service_id; ?>','<?php echo $sub_service_id; ?>')">View</a><?php //echo '<pre>'; print_r($mapped_docs); ?></td> -->
                                                        <td>
                                                            <?php
                                                            if ($online_flag == 1) {
                                                                if($data_arr['service_url']){
                                                                    $url_status = DefaultUtility::checkUrltatus($data_arr['service_url']);
                                                                    if($url_status=='up'){
                                                                    echo '<a target="_blank" href="' . $data_arr['service_url'] . '">Apply Now</a>';
                                                                }else  echo "<span class='urlcheckmsg'><i><b>(Departmental Portal seems to be down at this time,please try after some time.)</i></b></span>";
                                                                
                                                                    }
                                                            }
                                                            else if ($offline_flag == 1) {
                                                               // echo "N.B";
                                                                echo '<button type="submit" class="btn btn-success">Apply Now</button>';
                                                            } else if ($swcs_flag == 1) {
                                                               // echo "N.A";
                                                                $serId=$service_id.'.'.$sub_service_id;
                                                                if($serId=='591.0')
                                                                {
                                                                ?>
                                                            <a href="/backoffice/infowizard/formBuilder/subform/service_id/591.0/pageID/1/formCodeID/1" class="btn btn-success">Apply Now</a>
                                                                
                                                                <?php   
                                                                }else{
                                                                    echo '<button type="submit" class="btn btn-success">Apply Now</button>';
                                                                }
                                                            }
                                                            ?>

                                                        <input type="hidden" name="type" value='<?php echo $status_text; ?>' />
                                                    <input type="hidden" name="ptype" value='<?php echo $status_text; ?>' />
                                                </form>
                                                </td>


                                            </tr>

                                            
            <?php }
        }
    } ?>

                        </tbody>
                    </table>
                    
                </div>
            </div>
        </section>  
        </div>
    </div>
</div>  
    <script type="text/javascript">
        
        function goToNextPage(service_id, sub_service_id, caf_id) {
            window.location.href = '/backoffice/frontuser/ApplyService/DocumentsChecklist/service_id/' + service_id + '/sub_service_id/' + sub_service_id + '/caf_id/' + caf_id;
        }
        $(document).ready(function () {
            <?php if (@$_GET['is'] != "SE") { ?>
                $("#484_0").hide();
            <?php } ?>
            $(".btn-success").on("click",function(){
                $("#services_post").submit();
            });
        });
        $(window).load(function () {
            <?php if (@$_GET['is'] != "SE") { ?>
                $("#484_0").hide();
            <?php } ?>
        });
    </script>
    <?php
$base=Yii::app()->theme->baseUrl;
?>
 <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?=$base?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="<?=$base?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="<?=$base?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->



   <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?=$base?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/css/plugins/select2/select2.css">
<!-- select2 -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/plugins/select2/select2.min.js"></script>
<!-- Theme framework -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/eakroko.min.js"></script>
<script>
    $(document).ready(function(){
		  /* $('.select2-input').keypress(function(){
			var iuid = $(this).val();
			console.log(iuid)
			$.ajax({
				type: "GET",
				url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/IwApplyService/GetUser",
				data: {iuid: iuid},
				success: function (data) { 
					$('.select2-me').remove().append(data);
				}
			});
		  }); */
		$("#abc").keypress(function(){
			var userid = $('#abc').val();
			$.ajax({
				type: "GET",
				url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/IwApplyService/GetUser",
				data: {userid: userid},
				success: function (data) { 
				 // alert(data);
					$('#uldiv').html(data);
				}
			});
		}); 
    });
</script>
    <script type="text/javascript">
  
  var TableDatatablesButtons = function() {
   
        t = function() {
            var e = $("#sample_2");
            e.dataTable({
                language: {
                    aria: {
                        sortAscending: ": activate to sort column ascending",
                        sortDescending: ": activate to sort column descending"
                    },
                    emptyTable: "No data available in table",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No entries found",
                    infoFiltered: "(filtered1 from _MAX_ total entries)",
                    lengthMenu: "_MENU_ entries",
                    search: "Search:",
                    zeroRecords: "No matching records found"
                },
                buttons: [{
                    extend: "print",
                    className: "btn default"
                },  {
                    extend: "pdf",
                    className: "btn default"
                }, {
                    extend: "excel",
                    className: "btn default"
                }],
                order: [
                    [0, "asc"]
                ],
                lengthMenu: [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"]
                ],
                pageLength: 10,
                dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
            })
        },
        n = function() {
           /*  $(".date-picker").datepicker({
               rtl: App.isRTL(),
                autoclose: !0
            }); */
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
                    order: [
                        [1, "asc"]
                    ],
                    buttons: [{
                        extend: "print",
                        className: "btn default"
                    }, {
                        extend: "copy",
                        className: "btn default"
                    }, {
                        extend: "pdf",
                        className: "btn default"
                    }, {
                        extend: "excel",
                        className: "btn default"
                    }, {
                        extend: "csv",
                        className: "btn default"
                    }, {
                        text: "Reload",
                        className: "btn default",
                        action: function( t, n) {
                            t.ajax.reload(), alert("Datatable reloaded!")
                        }
                    }]
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
            jQuery().dataTable && (t(),n())
        }
    }
}();
jQuery(document).ready(function() {
    TableDatatablesButtons.init()
});
</script>