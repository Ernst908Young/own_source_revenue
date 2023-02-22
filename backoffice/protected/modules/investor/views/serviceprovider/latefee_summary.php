<?php 
		$baseUrl = Yii::app()->theme->baseUrl;
$basePath="/themes/investuk";
?>
<div class="dashboard-home">
  <div class="applied-status">
    <ul class="breadcrumb">
      <li><a href="/backoffice/admin">Home</a></li>   
      <li>CTSP Late Fee Payment Due</li>
    </ul>
  

  <div id="sample_1_wrapper" class="dataTables_wrappers dataTables_wrapper">
    <table  id="sample_1" width="100%">
       <thead> 
           <tr>
               <th class="text-center">
                <h5>Applicant Entity</h5>
               </th>
               <th class="text-center" width="25%">
                <h5>Applicant Name</h5>
               </th>
                <th class="text-center">
                <h5>CTSP Details</h5>
               </th>
                <th class="text-center">
                <h5>Late Fee</h5>
               </th>
               <th class="text-center">
                <h5>Created On</h5>
               </th>
              
               <th class="text-center">
                <h5>Action</h5>
               </th>
               
           </tr>
       </thead>
           <tbody class="ticket-item">
           <?php
        if($data){
            foreach($data as $key => $value) 
            {   
               
            ?>    
            <tr class="ticket-row tableinside" id="<?php echo $key; ?>">
               <td class="text-center">
                    <?= $value['company_name'] ?>
               </td>
               <td class="text-left">
                   <?= $value['app_name'] ?>
               </td>
                <td class="text-center">
                	<?php 
                		if($value['first_name']){
                			echo $value['first_name'].' '.$value['middle_name'].' '.$value['surname'];
                		}else{
                			$ctsp = Yii::app()->db->createCommand("SELECT *, CONCAT(up.first_name,' ',up.last_name,' ',up.surname) as sp_name
                				FROM sso_users u
						 		INNER JOIN sso_profiles up on u.user_id=up.user_id
						 	     where u.user_id=".$value['agent_user_id'])->queryRow();
                			echo $ctsp['sp_name'];
                		}	
                	?>
               </td>
               <td class="text-center">
                 <?= $value['late_fee'] ?>
               </td>
               <td class="text-center">
                 <?= $value['created_on'] ?  date('d M Y',strtotime($value['created_on'])) :
                 '' ?>
               </td>
               <td class="text-center">
                   <a href='/backoffice/investor/serviceprovider/makepayment/asp_id/<?= base64_encode($value['id']) ?>' style='color:blue;'>
                        View   
                   </a>
               </td>       
           </tr>                                    
            <?php   }
                }
            ?>
         
       </tbody> 
    </table>
</div>
</div>
</div>

<script src="<?=$baseUrl?>/assets/global/scripts/datatable.js" type="text/javascript"></script>

<script src="<?=$baseUrl?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>

<script src="<?=$baseUrl?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>


<script type="text/javascript">  
  function tabchange(id){
    $("#"+id).trigger('click');
  }
  var TableDatatablesButtons = function() {
     var e = function() {

             var e = $("#sample_2");

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
                 order: [

                     [0, "desc"]

                 ],

                 lengthMenu: [

                     [5, 10, 15, 20, -1],

                     [5, 10, 15, 20, "All"]

                 ],

                 pageLength: 10,

                  dom: "<'row'<'col-md-6 col-sm-12 form-group'l><'col-md-6 col-sm-12 form-group'f>r><'mb-3't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"

             })

         },
        t = function() {
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
                order: [
                    [0, "desc"]
                ],
                lengthMenu: [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"]
                ],
                pageLength: 20,

 


                dom: "<'row'<'col-md-6 col-sm-12 form-group'l><'col-md-6 col-sm-12 form-group'f>r><'mb-3't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
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
                       [0, "desc"]
                    ],
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
           jQuery().dataTable && (e(), t(), n())
        }
    }
}();

</script>
<script type="text/javascript">
    jQuery(document).ready(function() {

  

   
 TableDatatablesButtons.init();
    

       
});
</script>

