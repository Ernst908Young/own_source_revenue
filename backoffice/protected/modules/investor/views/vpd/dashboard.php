<?php 
 
 $basePath="/themes/investuk";



?>


<div class="dashboard-home">
	 <div class="home-top position-relative">
<div class="home-row d-flex flex-wrap">
    <div class="counter-item bord-3">
          <a href="/backoffice/investor/vpd/cart/tq">
            <div class="data-counter">
                <div class="counter-left">
                        <span>MY CART </span>
                        <span class="counter-number font-montserrat">
                            <?= $cart_count['cart_count'] ?>
                        </span>
                         
                    <div class="counter-icon">
                        <img src="<?php echo $basePath; ?>/assets/applicant/images/ticket-white.png">
                    </div>
                </div>
            </div>
          </a>
    </div>

	<div class="counter-item bord-3">
          <a href="/backoffice/investor/vpd/documents/grv" onclick="statusegchang('Download Pending')">
            <div class="data-counter">
                <div class="counter-left">
                        <span>DOWNLOAD PENDING </span>
                        <span class="counter-number font-montserrat">
                            <?= $doc_count['dp_count'] ?>
                        </span>
                         
                    <div class="counter-icon">
                        <img src="<?php echo $basePath; ?>/assets/applicant/images/icons/pending for approval_hover.png">
                    </div>
                </div>
            </div>
          </a>
    </div>
  
   
      
    <div class="counter-item bord-3">
         <a href="#" onclick="statusegchang('Downloaded')">
        <div class="data-counter">
            <div class="counter-left">
                <span>DOWNLOADED</span>
                <span class="counter-number font-montserrat">
                 <?= $doc_count['d_count'] ?>
                </span>
                <div class="counter-icon">
                     <img src="<?php echo $basePath; ?>/assets/applicant/images/icons/approved_hover.png">

                </div>
            </div>
        </div>
         </a>
    </div>  

     <div class="counter-item bord-3">
         <a href="/backoffice/investor/vpd/cart/tq">
        <div class="data-counter">
            <div class="counter-left">
                <span>PAYMENT DUE</span>
                <span class="counter-number font-montserrat">
                   <?= $cart_count['pd_count'] ?>
                </span>
                <div class="counter-icon">
                    <img src="<?php echo $basePath; ?>/assets/applicant/images/icons/payment due_hover.png">
                </div>
            </div>
        </div>
         </a>
    </div>
  <!-- 
    <div class="counter-item bord-3">
         <a href="#" onclick="statusegchang('Refund Requested')">
        <div class="data-counter">
            <div class="counter-left">
                    <span>REFUND REQUESTED</span>
                    <span class="counter-number font-montserrat">
                       
                    </span>
                <div class="counter-icon">
                    <img src="<1?php echo $basePath; ?>/assets/applicant/images/icons/refund requested_hover.png">
                </div>
            </div>
        </div>
         </a>
    </div>
    <div class="counter-item bord-3">
         <a href="#" onclick="statusegchang('Refund Successful')">
        <div class="data-counter">
            <div class="counter-left">
                <span>REFUND SUCCESSFUL</span>
                <span class="counter-number font-montserrat">
                   
                </span>
            <div class="counter-icon">
                <img src="<1?php echo $basePath; ?>/assets/applicant/images/icons/refund successful_hover.png">
            </div>
            </div>
        </div>
    </a>
    </div>  -->                      
</div>
    </div>

   <div class="applied-status">
        <div class="status-title d-flex flex-wrap align-items-center justify-content-between">
           <h4>Your Documents</h4>
         
        </div>
     <!-- <style type="text/css">
    
th, td { white-space: nowrap; }
    </style> -->
        <div id="sample_2_wrapper" class="dataTables_wrappers dataTables_wrapper">
<table width="100%" id='sample_2'>
					<thead>
						<tr>
							<th width="10%" class="text-center">SR. No.</th>
							<th>Entity Name</th>
							<th>Document Name</th>	
                            <th>Current Status</th>  			      
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody class="ticket-item">
<?php
		
		

						if($records){
							
							$n = 0;
							foreach ($records as $key => $val) { 
								$n++;
							?>                                        

                			 <tr class="ticket-row tableinside" id="<?php echo $key; ?>">
								<td width="8%" class="text-center">
									<p><?php echo $n; ?></p>
								</td>

								<td width="30%">
									<?= $val['company_name'].$val['id'] ?>
								</td>
								<td width="30%">
									<?= $val['ser_name_for_documentname'] ?>
                                    <?php if($val['doc_name']=='certificate'){
                                            echo 'Certificate';
                                        }else{
                                            echo 'Application Form';
                                        }
                                        ?>
								</td>
                                <td width="10%">

                                    <?php
                                    switch ($val['doc_status']) {
                        case 'PD':
                            $s = 'Payment Due';
                            break;
                        case 'PI':
                            $s = 'Payment Initiated';
                            break;
                        case 'P':
                            $s = 'Download Pending';
                            break;
                        case 'D':
                            $s = 'Downloaded';
                            break;
                        case 'E':
                            $s = 'Expired';
                            break;
                        
                        default:
                            $s = $val['doc_status'];
                            break;
                    }
                    echo $s;
                                     ?>    
                                </td>
								<td class="text-center">
                    <?php 
                    if($val['doc_status']=="PD"){ ?>
                        <a href="/backoffice/investor/vpd/payment" style="color: blue;">
                            Make Payment
                        </a>
                    <?php } ?>
                     <?php if($val['doc_status']=='PI'){ ?>
                          <a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl('investor/vpd/printofflinefeeform/vpd_id/'. base64_encode($val['id']));?>" title="Offline Payment Form">  
                          <img src="<?php echo $basePath; ?>/assets/applicant/images/pdf-icon.png">
                      </a>
                      <?php } ?>
                      
                   
                </td>
                                
							</tr>
							<?php 	}
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
      
        <!-- END PAGE LEVEL PLUGINS -->
	<script type="text/javascript">

          

  
  var TableDatatablesButtons = function() {
   
        t = function() {
            var e = $("#sample_2");

            e.dataTable({
                scrollX: true,
                language: {
                    aria: {
                        sortAscending: ": activate to sort column ascending",
                        sortDescending: ": activate to sort column descending"
                    },
                    emptyTable: "No data available in table",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No entries found",
                    infoFiltered: "(filtered1 from _MAX_ total entries)",
                    lengthMenu: "Entries: _MENU_ ",
                    search: "Search:",
                    zeroRecords: "No matching records found"
                },
                buttons: [],
               order: [
                    [0, "asc"]
                ],
                lengthMenu: [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"]
                ],
                pageLength: 10,
                  dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12 form-group'l><'col-md-6 col-sm-12 form-group'f>r><''t><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
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
            jQuery().dataTable && (t(),n())
        }
    }
}();
jQuery(document).ready(function() {
    TableDatatablesButtons.init();
     $("#sample_2_length").find("label").attr('style','font-size:15px; font-weight:100;');
    $("#sample_2_length").find("select").attr("style","width:50px; margin-left:5px;");

    $("#sample_2_filter").find("label").attr('style','font-size:15px; font-weight:100;');
    $("#sample_2_filter").find("input").attr("placeholder",'Search by keywords');
    $("#sample_2_info").attr("style","font-size:15px; margin-top:10px;");
    $("#sample_2_paginate").attr("style",'margin-top:15px;');

   

});


function statusegchang(status){
        //alert(status);
        e = $.Event('keyup');
        e.keyCode= 13; // enter

        $("#sample_2_filter").find('input').val(status).trigger(e);
        $("#status_s").val(status);
    }

</script>