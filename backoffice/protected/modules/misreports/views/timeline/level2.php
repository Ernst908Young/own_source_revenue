<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<?php $baseUrl = Yii::app()->theme->baseUrl; $basePath="/themes/investuk";?>
<div class="dashboard-home">
    <div class="applied-status" >
        <ul class="breadcrumb">
          <li><a href="/backoffice/admin">Home</a></li>
           <li>Reports</li>
            <li>
            <a href="<?php echo @$_SESSION['tll1previousurl'] ?>">
             Timeline Report Level 1
            </a>
          </li>
        
            <li>Timeline Report Level 2</li>
          </ul>

 
<div class="reservation-form p-0">
<div class="form-part bussiness-det">                          
            <h4 class="form-heading">
         Timeline Report Level 2
            </h4>
        <div class="form-row">
         <?php $sserd = Yii::app()->db->createCommand("SELECT core_service_name from bo_information_wizard_service_parameters where CONCAT(service_id,'.',servicetype_additionalsubservice) = $service_id")->queryRow(); ?>
        From Date: <strong><?= $from_date ?></strong> | To Date: <strong><?= $to_date ?></strong> | Service: <strong><?= $sserd['core_service_name'] ?></strong>
        <br>
        <?php 
         $status_count = [];  $entity_array = []; $srn_no_arr=[];
          foreach ($records as $key => $value) {
            $status_res = Servicecategory::appstatus($value['application_status']);
            if(array_key_exists($status_res, $status_count)){
              $status_count[$status_res] = 1+$status_count[$status_res];
            }else{
              $status_count[$status_res] = 1;
            }  
             $en = isset($value['company_name'])? $value['company_name'] : 'NA';
              $entity_array[$en]=$en; 
               $srn_no_arr[$value['submission_id']]=$value['submission_id'];  
          }
            $si=1;
       foreach ($status_count as $key => $value) {
          
          echo $key.": <strong>$value</strong> ";
          if(sizeof($status_count)>$si){
            echo ' | ';
          }
           $si++;                  
       }
		$pdfurl = "/backoffice/misreports/timeline/level2pdf?from_date=$from_date&to_date=$to_date&service_id=".$service_id;
		 $url_components = parse_url($_SERVER['REQUEST_URI']);
		 if(isset($url_components['query'])){
			parse_str($url_components['query'], $params);
			if(isset($params['ser_status'])){
				   foreach ($params['ser_status'] as $key => $value) {
				   $pdfurl.='&ser_status[]='.$value;
				}
			}
			if(isset($params['srn_no'])){
				   foreach ($params['srn_no'] as $key => $value) {
				   $pdfurl.='&srn_no[]='.$value;
				}
			}
			if(isset($params['entity'])){
				   foreach ($params['entity'] as $key => $value) {
				   $pdfurl.='&entity[]='.$value;
				}
			}
		   
		 }
        ?>
        <br><br>
       
      </div>

<form method="get">
            <input type="hidden" name="from_date" value="<?= $from_date ?>" />
            <input type="hidden" name="to_date" value="<?= $to_date ?>" />            
            <input type="hidden" name="service_id" value="<?= $service_id ?>" />
             <div class="form-row row">

               <div class="col-lg-3 form-group">
                <label>SRN No.</label>
                 <select name="srn_no[]"  multiple='multiple' placeholder="All SRN No." class="select2-me" id="srn_no">
                    
                   <?php                  
                   foreach($srn_no_arr as $k=>$v){ 
                    $selects = !empty($srn_no)  ? (in_array($k, $srn_no) ? 'selected' : '') : '' ;
                    ?>
                      <option value="<?= $k ?>" <?= $selects ?>>
                        <?php echo $v; ?>
                      </option>
                   <?php } ?>
              </select> 
              </div>
               <div class="col-lg-3 form-group">
                <label>Service Status</label>
                 <select name="ser_status[]"  multiple='multiple' placeholder="All Services Status" class="select2-me" id="ser_status" labelname="Services Status">
                    
                   <?php 
                   $ass = Servicecategory::getallservicestatus();
                   foreach($ass as $k=>$v){ 
                    $selects = !empty($ser_status)  ? (in_array($k, $ser_status) ? 'selected' : '') : '' ;
                    ?>
                      <option value="<?= $k ?>" <?= $selects ?>>
                        <?php echo $v; ?>
                      </option>
                   <?php } ?>
              </select>   
              </div>
              <div class="col-lg-6 form-group">
              <label>Business Entity</label>
             
              <select name="entity[]"  multiple='multiple' placeholder="All Entity" class="select2-me" id="entities" labelname="entities">
                    
  <?php

   foreach($entity_array as $k=>$v){ 
           $selects = !empty($entity)  ? (in_array($v, $entity) ? 'selected' : '') : '' ;
                    ?>
                      <option value="<?= $v ?>" <?= $selects ?>>
                        <?php echo $v; ?>
                      </option>
                   <?php }   ?>
              </select> 
            </div>
             
                 <div class="col-lg-6 form-group">     
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
    </style>

<table  id="sample_2" width="100%">
         <thead> 
             <tr>
                 <th class="text-center">
                  <h5>SR. No.</h5>
                 </th>
                 <th class="text-center">
                  <h5>SRN No</h5>
                 </th>
                 <th class="text-center">
                  <h5>Applicant Name</h5>
                 </th>
                
                  <th class="text-center">
                  <h5>Business Entity</h5>
                 </th>

                 <th class="text-center">
                  <h5>Application Status</h5>
                 </th>
                <th class="text-center">
                  <h5>Action</h5>
                 </th>
             </tr>
         </thead>
             <tbody class="ticket-item">

             	<?php 

$i=1;
              foreach ($records as $key => $value) {
                 if(($entity==NULL || in_array((isset($value['company_name'])? $value['company_name'] : 'NA'), $entity))&&($srn_no==NULL || in_array($value['submission_id'], $srn_no))){

                                ?>

              <tr class="ticket-row tableinside" id="<?php echo $key; ?>">
                 <td class="text-center">
                  <p><?= $i ?></p>
                 </td>
             
                  <td class="text-center">
                      <?php $_SESSION['tll2previousurl'] = $_SERVER['REQUEST_URI']; 
                      $sub_id = $value['submission_id'];
                      ?>
       <p><a href="/backoffice/misreports/timeline/level3/otd/reports?service_id=<?php echo $value['service_id'];?>&from_date=<?php echo $from_date;?>&to_date=<?php echo $to_date; ?>&sub_id=<?php echo $sub_id; ?>" style='color:blue;'>  <?php echo $sub_id ?></a></p>
                   
                 </td>
                
                   <td class="text-center">
                   <?= $value['first_name'].' '.$value['last_name'].' '.$value['surname'] .'<br>'.$value['email']?>
                 </td>
                
                 
                  <td class="text-center">
		<?=  isset($value['company_name'])? $value['company_name'] : 'NA' ?>
                 </td>

              
                  <td class="text-center">
                    <?php  
                  $status_res = Servicecategory::appstatus($value['application_status']);
                  echo $status_res;
                  ?> 
                 </td>
                  <td class="text-center">
      <?php $printappurl =  $value['print_app_call_back_url'];  ?>
      <a target="_blank" href="<?php echo $printappurl; ?>" title="Print Application">
         <img src="<?php echo $basePath; ?>/assets/applicant/images/print-icon.png">     
      </a>
     
       <a href="<?php echo Yii::app()->createAbsoluteUrl('infowizardtwo/subForm/applicationTimeline/subID/'. base64_encode($value['submission_id']));?>" title="  View Timeline">
          <img src="<?php echo $basePath; ?>/assets/applicant/images/time-icon.png">   
      </a>
       


   <?php 
     if($value['application_status']=='A' && $value['is_certificate']==1 && !empty($value['download_certificate_call_back_url'])){ 
          $parse = parse_url($value['download_certificate_call_back_url']);
          $certi_path = isset($parse['path']) ? $parse['path'] : '';
      ?>
       
            <a target="_blank" href="/backoffice/doc/mydoc?view=<?php echo DefaultUtility::getDockey($certi_path); ?>&from=ticket" title="Download Letter / Certificate">
               <img src="<?php echo $basePath; ?>/assets/applicant/images/pdf-icon.png"> 
            </a>
      
      
      <?php } ?>
      <?php 
     if($value['application_status']=='A'){ ?>
      <a href="/backoffice/investor/documentManagement/documentdownload/subID/<?= base64_encode($value['submission_id']) ?>"> 
        <img src="<?php echo $basePath; ?>/assets/applicant/images/doc_list1.png">
      </a>
      <?php } ?>
 
  </td>
           </tr>

          <?php
$i++;
           }} ?>
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