<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<div class="dashboard-home">
    <div class="applied-status" >
        <ul class="breadcrumb">
          <li><a href="/backoffice/admin">Home</a></li>
           <li>Reports</li>
         
                  <li>
                    <a href="<?php echo @$_SESSION['drpreviousurl'] ?>">
                     Director’s Cross Reference Report Level 1
                    </a>
                  </li>        
                  <li>Director’s Cross Reference Report Level 2</li>
               


          </ul>

 
<div class="reservation-form p-0">
<div class="form-part bussiness-det">                          
            <h4 class="form-heading">
         Director’s Cross Reference Report Level 2
            </h4>
        <div class="form-row">
         
        From Date: <strong><?= $from_date ?></strong> | To Date: <strong><?= $to_date ?></strong> | Director: <strong><?= $director ?></strong>
        <br>
        <?php 
		$pdfurl = "/backoffice/misreports/users/level2pdf?from_date=$from_date&to_date=$to_date";
		
		$url_components = parse_url($_SERVER['REQUEST_URI']);
     if(isset($url_components['query'])){
        parse_str($url_components['query'], $params);
        if(isset($params['directors'])){
           $pdfurl.='&directors='.$params['directors'];
		}

		if(isset($params['is_active'])){
           $pdfurl.='&is_active='.$params['is_active'];
		}
		if(isset($params['entity'])){
           foreach ($params['entity'] as $key => $value) {
           $pdfurl.='&entity[]='.$value;
        }
       } 
		
     }
	 
        ?>
        <form method="get">    
            <input type="hidden" name="from_date" value="<?= $from_date ?>" />
            <input type="hidden" name="to_date" value="<?= $to_date ?>" />
            <input type="hidden" name="directors" value="<?= base64_encode($director) ?>" />
             <div class="form-row row">
              <div class="col-lg-6 form-group">
                <label>Is Active</label>
                <select name="is_active"   placeholder="Is active ?" class="select2-me" id="is_active" labelname="is_active">
                   <option>
                      All Status
                  </option>   
                    <option value="Yes" <?= $is_active=='Yes' ? 'selected' : '' ?>>
                        Yes
                      </option>
                      <option value="No" <?= $is_active=='No' ? 'selected' : '' ?>>
                        No
                    </option>                    
                </select> 
              </div>
             <div class="col-lg-6 form-group">
              <label>Entity Name</label>
              <select name="entity[]"  multiple='multiple' placeholder="All Entity" class="select2-me" id="entities" labelname="entities">
                    
                   <?php 
                   $main_records = [];
                   foreach($f_record as $k=>$v){ 
                     $comp_detail = Yii::app()->db->createCommand("SELECT cd.*, l.created as registered_on FROM bo_company_details cd
                        INNER JOIN bo_infowiz_form_builder_application_log as l ON ((l.app_Sub_id=cd.srn_no) AND (l.action_status='A')) 
                        WHERE reg_no='".$k."' AND cd.service_id='".$v['service_id']."' ")->queryRow();
                     $entity_name = @$comp_detail['company_name'] ? $comp_detail['company_name'] : "NA" ;

                     $main_records[$k] = array_merge($v, ['entity'=>$entity_name,'address'=>@$comp_detail['address'],'registered_on'=>(@$comp_detail['registered_on'] ? date('d-m-Y',strtotime(@$comp_detail['registered_on'])) : "") ]);

                    $selects = !empty($entity)  ? (in_array($entity_name, $entity) ? 'selected' : '') : '' ;
                    ?>
                      <option value="<?= $entity_name ?>" <?= $selects ?>>
                        <?php echo $entity_name ?>
                      </option>
                   <?php } ?>
              </select> 
            </div>
              <div class="col-lg-6 form-group" style="margin-top: 35px;">
                <button type="submit" class="btn-primary">Search</button>
                <a href="<?= $pdfurl ?>" target="_blank" class="btn-primary">PDF</a>
              </div>
            </div>
          </form>
        
      </div>
     
 
</div>       
</div>
         
     <style type="text/css">
      tr:nth-child(even) {
  background-color: #f2f2f2;
}
th, td { white-space: nowrap; }
    </style>

<table  id="sample_2" width="100%">
 <thead> 
     <tr>
         <th >
          <h5>SR. No.</h5>
         </th>

         <th >
          <h5>Entity reg. no</h5>
         </th>
          <th class="text-center" width="40%">
          <h5>Entity Name</h5>
         </th>
          <th class="text-center" width="40%">
          <h5>Busniess Entity <br>Address</h5>
         </th>
          <th class="text-center" width="20%">
          <h5>Date of <br>Incorporation</h5>
         </th>
         <th class="text-center" width="20%">
          <h5>Currently <br>Active?</h5>
         </th>
     </tr>
 </thead>
       <tbody class="ticket-item">

       	<?php 
           
        $n=1;
        foreach ($main_records as $key => $value) {
          $status = $value['data']=='deactivated' ? 'No' : 'Yes';


          if(($is_active==NULl || $is_active==$status) && ($entity==NULL || in_array($value['entity'], $entity))){
         ?>

        <tr class="ticket-row tableinside" id="<?php echo $key; ?>">
            <td width="10%"><?= $n ?></td>
            <td width="20%"><?= $key ?></td>
            <td width="30%">
              <?=
              $value['entity'];
              ?>
            </td>
              <td width="40%">
                <?= $value['address'] ?>
              </td>
              <td width="20%">
                <?= $value['registered_on'] ?>
              </td>
              <td width="20%" class="text-center">
                <?= $status=='No' ? "<span style='color:red;'>No</span>" : "Yes" ?>
              </td>

       </tr>

 <?php $n++; }} ?>
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
            var e = $("#sample_2");
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