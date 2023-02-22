<title>Representative Report</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<div class="dashboard-home">
    <div class="applied-status" >
        <ul class="breadcrumb">
          <li><a href="/backoffice/admin">Home</a></li>
           <li>Reports</li>
          <li> Representative Report</li>
          </ul>
    

<div class="reservation-form p-0">
<div class="form-part bussiness-det">                          
            <h4 class="form-heading">
		Representative Report
            </h4>
        
         
        
      <form method="get">
        <div class="form-row row">
		<div class="col-lg-3 form-group">
			<label>From Date</label>
			<input type="inputType" autocomplete="off" id="from_date" name="from_date" class="datepicker form-control from_date" labelname="from_date" value="<?= $from_date ?>" readonly required />
		</div>
        <div class="col-lg-3 form-group">
            <label>To Date</label>
            <input type="inputType" autocomplete="off" id="to_date" name="to_date" class="datepicker form-control to_date" labelname="to_date" value="<?= $to_date ?>" readonly required />
        </div>
		  
        <div class="col-lg-6 form-group">
			
            <label>Representative Type</label>
			<select name="sptype"  placeholder="All Entity" class="select2-me" id="services_id" labelname="Services">
                <?php 
					if(isset($_GET['sptype'])){
						$crselects= $_GET['sptype']=='Corporate Representative (CR)'? 'selected':'' ; 
						$ctspselects= $_GET['sptype']=='Corporate Trust Service Provider (CTSP)'? 'selected':'' ;
					}else{
						$crselects= '' ; 
						$ctspselects= '' ;
					}
                ?>
                <option value="">Select</option>
				<option value="Corporate Representative (CR)" <?= $crselects ?>>
				Corporate Representative (CR)
				</option>
				<option value="Corporate Trust Service Provider (CTSP)" <?= $ctspselects ?>>
				Corporate Trust Service Provider (CTSP)
				</option>
            </select>            
        </div>
		
		<div class="col-lg-3 form-group">
			<label>Status</label>
            <select name="sp_status" placeholder="Select Status" class="select2-me" id="sp_status">       
				<?php 
					if(isset($_GET['sp_status'])){
						$nselects= $_GET['sp_status']=='N'? 'selected':'' ; 
						$oselects= $_GET['sp_status']=='O'? 'selected':'' ;
						$rselects= $_GET['sp_status']=='R'? 'selected':'' ;
            $pdselects= $_GET['sp_status']=='PD'? 'selected':'' ;
            $piselects= $_GET['sp_status']=='PI'? 'selected':'' ;
            $nwselects= $_GET['sp_status']=='NW'? 'selected':'' ;
					}else{
						$nselects= '' ; 
						$oselects= '' ;
						$rselects= '' ;
            $pdselects = '';
            $piselects = '';
            $nwselects= '';
					}
                ?>
				<option value="">Select Status</option>
                <option value="N" <?= $nselects ?>>Nominated</option>
                <option value="O" <?= $oselects ?>>Onboarded</option>
                <option value="R" <?= $rselects ?>>Removed</option>
                <option value="PD" <?= $pdselects ?>>Payment Due</option>
                <option value="PI" <?= $piselects ?>>Payment Initiate</option>
                <option value="NW" <?= $nwselects ?>>Nomination withdrawn</option>
            </select>
        </div>
         
    <?php 
    //$pdfurl = "/backoffice/misreports/officerproductivity/level1pdf?from_date=$from_date&to_date=$to_date";
	/*if(isset($_GET['sptype'])){
			if($_GET['sptype']!=''){
				$sp_type = $_GET['sptype'];
			}
			else{
				$sp_type = '';
			}
	}
	else{
		$sp_type = '';
	}
	
	if(isset($_GET['sp_status'])){
			if($_GET['sp_status']!=''){
				$sp_status = $_GET['sp_status'];
			}
			else{
			$sp_status = '';
		}
	}
	else{
		$sp_status = '';
	}*/
	$pdfurl = "/backoffice/misreports/sp/spreportpdf?from_date=$from_date&to_date=$to_date&sptype=$sp_type&sp_status=$sp_status";
			
?>



          <div class="col-lg-6 form-group" style="margin-top: 30px;">
            <button type="submit" class="btn-primary">Search</button>
            <a href="<?= $pdfurl ?>"  target="_blank" class="btn-primary">PDF</a>
          </div>
        </div>
      </form>


</div>       
</div>
<style type="text/css">
      tr:nth-child(even) {
  background-color: #f2f2f2;
}
th, td { white-space: nowrap; }
    </style>
<table  id="sample_1" width="100%">
                       <thead> 
                           <tr>
                               <th class="text-center">
                                <h5>SR. No.</h5>
                               </th>
                                 <th class="text-center">
                                <h5>Representative Name</h5>
                               </th>
                               <th class="text-center">
                                <h5>Type of Representative</h5>
                               </th>
                               <th class="text-center">
                                <h5>Entity Name</h5>
                               </th>
                              <!--   <th class="text-center">
                                <h5>Entity Type</h5>
                               </th>  -->                            
                            <!--    <th class="text-center">
                                <h5>Individual</h5>
                               </th> -->
                                <th class="text-center">
                                <h5>Individual Name/Entity</h5>
                               </th>
                               <th class="text-center">
                                <h5>Status</h5>
                               </th>
                                <th class="text-center">
                                <h5>Action Date</h5>
                               </th>
                               
                          </tr>
                       </thead>
                           <tbody class="ticket-item">
                           <?php
						   
						
    if($records){
      if($sp_type!=''){
        $records_array = [];
          foreach ($records as $key => $value) {

            if($value['agent_user_id']){
              $agent_spdt = Yii::app()->db->createCommand("SELECT u.sp_type FROM sso_users u  WHERE u.user_id=".$value['agent_user_id'])->queryRow();
               $agent_spt = $agent_spdt['sp_type'];
          }else{
            $agent_spt = $value['sp_type'];
          }

            if($agent_spt==$sp_type){
              $records_array[] = $value;
            }
            
          }
      }else{
        $records_array = $records;
      }



		foreach($records_array as $key => $value){ 
          if($value['agent_user_id']){
              $agent_details = Yii::app()->db->createCommand("SELECT u.sp_type, u.entity_type, u.entity_name, p.first_name, p.last_name, p.surname FROM sso_users u INNER JOIN sso_profiles p ON u.user_id=p.user_id WHERE u.user_id=".$value['agent_user_id'])->queryRow();
          }else{
            $agent_details = NULL;
          }
	
                ?>    
            <tr class="ticket-row tableinside text-left" id="<?php echo $key; ?>">
                <td class="text-left">
                  <?= $key+1 ?>
                </td>
				<td>
				  <?php echo $agent_details==NULL ? ($value['first_name'].' '.$value['middle_name'].' '.$value['surname']) : ($agent_details['first_name'].' '.$agent_details['last_name'].' '.$agent_details['surname']); ?>
				</td>
				<td><?php echo $agent_details==NULL ? ($value['sp_type']) : ($agent_details['sp_type']);  ?></td>
				<td>
					<?php echo $agent_details==NULL ? ($value['entity_name']) : ($agent_details['entity_name']); ?>
				</td>

					<!-- 	<td><1?php echo $agent_details==NULL ? ($value['entity_type']) : ($agent_details['entity_type']); ?></td> -->

					<!-- 	<td></td> -->
				<td>
				  <?php echo $value['first_name'].' '.$value['middle_name'].' '.$value['surname']?>
				  /
					   <?php echo $value['company_id'] ? ($value['company_name']) : 'NA' ?>
				</td>
					
				<td><?php 
        switch ($value['sp_status']) {
          case 'N':
            $status = 'Nominated';
            break;
             case 'O':
            $status = 'Onboarded';
            break;
             case 'R':
            $status = 'Removed';
            break;
             case 'PD':
            $status = 'Payment Due';
            break;
             case 'PI':
            $status = 'Payment Initiate';
            break;
             case 'NW':
            $status = 'Nomination withdrawn';
            break;
          
          default:
            $status = '';
            break;
        }
					
						echo $status;?>
              
            </td>
				<td>
					<?= $value['action_date'] ? date('d-m-Y',strtotime($value['action_date'])) : '' ?>
				</td>
            </tr>                                    
         <?php } } ?>
                         
                       </tbody> 
                      
                    </table>

</div>
</div>

  <script type="text/javascript">
    $(document).ready(function () {
      var date = new Date();
  date.setDate(date.getDate());
      $('.datepicker').datepicker({
          changeMonth: true,
          changeYear: true,
            dateFormat: 'dd-mm-yy',
            autoclose:true,
            maxDate: date
            });
    });
  </script>



<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/jquery-repeater/jquery.repeater.js" type="text/javascript">
</script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/pages/scripts/form-repeater.min.js" type="text/javascript">
</script>
<!-- form repeater js -->

<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/css/plugins/select2/select2.css">
<!-- select2 -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/plugins/select2/select2.min.js"></script>
<!-- Theme framework -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/eakroko.min.js"></script>


<script src="<?=$baseUrl?>/assets/global/scripts/datatable.js" type="text/javascript"></script>

<script src="<?=$baseUrl?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>

<script src="<?=$baseUrl?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>


<script type="text/javascript">  
  var TableDatatablesButtons = function() {
   
        t = function() {
            var e = $("#sample_1");
            e.dataTable({
                scrollX: true,
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
                buttons: [ 
               /* {

                     extend: "pdf",

                     className: "mr-1 btn-primary mr-1",


                 }, {

                     extend: "excel",

                     className: "mr-1 btn-primary from-group",
                    

                 }*/
                 ],
                order: [
                    [0, "asc"]
                ],
                lengthMenu: [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"]
                ],
                pageLength: 20,

 


                /*dom: "<'row'<'col-md-2 col-xs-5 form-group'l><'col-md-4 col-xs-5 form-group'B><'col-md-6 col-sm-12 form-group'f>r><'mb-3't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"*/
                 dom: "<'row'r><'mb-3't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
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
                onDataLoad: function(e) {
                       
    
   
    $("#sample_1_filter").find("input").attr("placeholder",'Search by keywords');
   
  
                },
                loadingMessage: "Loading...",
                dataTable: {
                    bStateSave: !0,
                    lengthMenu: [
                        [10, 20, 50, 100, 150, -1],
                        [10, 20, 50, 100, 150, "All"]
                    ],
                    pageLength: 20,
                    ajax: {
                        url: "../demo/table_ajax.php"
                    },
                    order: [
                        [1, "asc"]
                    ],
                   buttons: [  {

                         extend: "pdf",

                         className: "btn-primary"

                     }, {

                         extend: "excel",

                         className: "btn-primary"

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

 

   
 TableDatatablesButtons.init();
  
     
});

</script>