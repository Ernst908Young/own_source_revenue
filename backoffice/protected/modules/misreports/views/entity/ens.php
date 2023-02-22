<title>Entity Name Summary Report</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<style type="text/css">
  .mr-10{
    margin-right:10px;
  }
</style>
<?php 	$baseUrl = Yii::app()->theme->baseUrl; 
		$basePath="/themes/investuk"; 
		
        $main_array = []; $entity_array =[]; $srn_no_arr=[];
		foreach ($records as $key => $value) {
        $fieldvalue = json_decode($value['field_value'],true);
        if(isset($fieldvalue['UK-FCL-00044_0'])){
          $form_code = $fieldvalue['UK-FCL-00044_0'];
          if($form_code==1 || $form_code==2){
            $main_array[] = $value;
             $entity_array[$value['banned_words_name']] = $value['banned_words_name'];
              $srn_no_arr[$value['submission_id']]=$value['submission_id'];   
            }
          }
        }
?>
<div class="dashboard-home">
    <div class="applied-status" >
        <ul class="breadcrumb">
          <li><a href="/backoffice/admin">Home</a></li>
          <li>Entity Name Summary Report </li>
          </ul>
    

<div class="reservation-form p-0">
<div class="form-part bussiness-det">                          
            <h4 class="form-heading">
            Entity Name Summary Report 
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
          <div class="col-lg-3 form-group">
             <label>Company Type</label>
            <select name="entity_t"  class="select2-me" id="entity_t" labelname="entity_t">
                   <option>
                      All Company Type
                  </option>   
                    <option value="2" <?= $entity_t=='2' ? 'selected' : '' ?>>
                        Company (Form 33)
                      </option>
                      <option value="1" <?= $entity_t=='1' ? 'selected' : '' ?>>
                        Society (Form 15)
                    </option>                    
                </select> 
          </div>
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

          <div class="col-lg-6 form-group">
              <label>Entity Name</label>
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
                   <?php 
    $pdfurl = "/backoffice/misreports/entity/enspdf?from_date=$from_date&to_date=$to_date";

     $url_components = parse_url($_SERVER['REQUEST_URI']);
     if(isset($url_components['query'])){
        parse_str($url_components['query'], $params);
        if(isset($params['entity'])){
           foreach ($params['entity'] as $key => $value) {
           $pdfurl.='&entity[]='.$value;
        }
       } 

       if(isset($params['srn_no'])){
           foreach ($params['srn_no'] as $key => $value) {
           $pdfurl.='&srn_no[]='.$value;
        }
       } 

       if(isset($params['entity_t'])){          
           $pdfurl.='&entity_t='.$params['entity_t'];        
       }       
     }
   
    ?>
          <div class="col-lg-6 form-group" style="margin-top: 35px;">
            <button type="submit" class="btn-primary">Search</button>
            <a href="<?= $pdfurl ?>" target=_blank class="btn-primary">PDF</a>
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

<table  id="sample_1" width="100%">
   <thead> 
       <tr>
           <th class="text-center" width="10%">
            <h5>SR. No.</h5>
           </th>

           <th class="text-center" width="25%">
            <h5>Company type</h5>
           </th>

            <th class="text-center" width="30%">
            <h5>Entity Name</h5>
           </th>
            <th class="text-center" style="min-width: 100px;">
            <h5>SRN</h5>
           </th>

           <th class="text-center">
            <h5>Date of reservation</h5>
           </th>

           <th class="text-center">
            <h5>Date of expiration</h5>
           </th>                               
         
           
       </tr>
   </thead>
     <tbody class="ticket-item">
      <?php
           $i=1;
       foreach ($records as $key => $value) {
        $fieldvalue = json_decode($value['field_value'],true);
        if(isset($fieldvalue['UK-FCL-00044_0'])){
          $form_code = $fieldvalue['UK-FCL-00044_0'];
          if($form_code==1 || $form_code==2){
            if(($entity==NULL || in_array($value['banned_words_name'], $entity)) && ($entity_t==NULL || $entity_t==$form_code) && ($srn_no==NULL || in_array($value['submission_id'], $srn_no))){
            $is_used = Yii::app()->db->createCommand('SELECT submission_id       
                              FROM bo_new_application_submission 
                               WHERE 
                           name_related_srn='.$value['submission_id'])->queryRow();
         ?>

               <tr class="ticket-row tableinside" id="<?php echo $key; ?>">
                   <td class="text-center">
                    <p><?= $i ?></p>
                   </td>

                   <td>
                      <?= $form_code==1 ? "Society (Form 15)" : "Company (Form 33)" ?>          
                   </td>
                   <td class="text-center">
                     <?= $value['banned_words_name'] ?>      
                   </td>
                    <td class="text-center">
                     <?php $printappurl =  $value['print_app_call_back_url'];  ?>
                    <a target="_blank" style="color: blue;" href="<?php echo $printappurl; ?>" title="Print Application">
                        <?php echo $value['submission_id'] ?>    
                    </a>
                    <br>
                   
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

                   <td class="text-center">
                    <?= $value['created'] ? date('d-m-Y',strtotime($value['created'] )) : "" ?>
                   </td>

                   <td class="text-center">
                    <?php 
                    $exp_date = '';
                    if(empty($is_used)){
                         if($value['created']){
                          $cdate = $value['created'];
                            $exp_date = date('d-m-Y',strtotime("$cdate +90 days"));
                            
                         }                         
                    } 
                      echo $exp_date;
                    ?>
                   
                   </td>
                 
                 
               </tr>


     

     <?php
   $i++;
     }}}
      }  ?> 
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