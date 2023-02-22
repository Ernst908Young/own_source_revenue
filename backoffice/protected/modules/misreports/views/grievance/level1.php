<title>Grievance Redressal Report</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<?php $baseUrl = Yii::app()->theme->baseUrl; ?>
<div class="dashboard-home">
    <div class="applied-status" >
        <ul class="breadcrumb">
          <li><a href="/backoffice/admin">Home</a></li>
          <li>Reports</li>
          <li>Grievance Redressal Report Level 1</li>
        </ul>
    

<div class="reservation-form p-0">
<div class="form-part bussiness-det">                          
            <h4 class="form-heading">
           Grievance Redressal Report Level 1
            </h4>
        
           <?php 
              $ass = Servicecategory::getalltqgstatus();
         $status_count = []; $t_id_arr=[];
          if($Pendency){   
                  $pem_c = [];  
                     foreach ($Pendency as $pk => $pv) {
                       $pem_c[$pv] = $pv;
                     }
                  }
                   $i =0;

          foreach ($records as $key => $value) {
            if($value['status']=='C'){                  
                   $date1 = date_create(date('Y-m-d',strtotime($value['updated_on'])));
                  $date2 = date_create(date('Y-m-d',strtotime($value['created_on'])));
                  $diff  = date_diff($date1,$date2);
                  $ad    = $diff->format("%a");
                }else{
                   $date1 = date_create(date('Y-m-d'));
                  $date2 = date_create(date('Y-m-d',strtotime($value['created_on'])));
                  $diff  = date_diff($date1,$date2);
                  $ad    = $diff->format("%a");
               }  

      $pendecy_check = [
          1=> $ad<=5, 
          2 => $ad>5 && $ad<=10, 
          3 => $ad>10 && $ad<=15,
          4 => $ad>15 && $ad<=20,
          5 => $ad>21 && $ad<=30,
          6 => $ad>30, 
        ];

      if($Pendency){          
        
          $result=array_intersect_key($pendecy_check,$pem_c);
            $pendency_show = in_array('1', $result);
        
      }else{
         $pendency_show = 'All';
      }  
       if($pendency_show=='All' || $pendency_show){
        if($value['status']){
          $status_res = $ass[$value['status']]; 
            if(array_key_exists($status_res, $status_count)){
              $status_count[$status_res] = 1+$status_count[$status_res];
            }else{
              $status_count[$status_res] = 1;
            }  
        }
        
      }

       $t_id_arr[$value['id']]=$value['id'];  
   
          }

            ?>
        
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
            <label>Grievance Id</label>
           <select name="t_id[]"  multiple='multiple' placeholder="All Tickets" class="select2-me" id="t_id">
                    
                   <?php                  
                   foreach($t_id_arr as $k=>$v){ 
                    $selects = !empty($t_id)  ? (in_array($k, $t_id) ? 'selected' : '') : '' ;
                    ?>
                      <option value="<?= $k ?>" <?= $selects ?>>
                        <?php echo $v; ?>
                      </option>
                   <?php } ?>
              </select> 
          </div>
          <div class="col-lg-3 form-group">
            <label>Grievance Type</label>
           
            <select name="t_type"  placeholder="All Grievance Type" class="select2-me" id="t_type" labelname="Grievance type">
                    
                    <?php 
                   $type_ass = ['All Type'=>'All Type','Ticket'=>'Existing Ticket','Query'=>'Existing Query'];
                   foreach($type_ass as $k=>$v){ 
                    $selects = !empty($t_type)  ? ($t_type==$k ? 'selected' : '') : '' ;
                    ?>
                      <option value="<?= $k ?>" <?= $selects ?>>
                        <?php echo $v; ?>
                      </option>
                   <?php } ?>
                  
              </select> 
          </div>
          
          <div class="col-lg-3 form-group">
            <label>Grievance Status</label>

                 <select name="t_status[]"  multiple='multiple' placeholder="All Grievance Status" class="select2-me" id="t_status" labelname="Grievance Status">
                    
                   <?php 
                  
                   foreach($ass as $k=>$v){ 
                    $selects = !empty($t_status)  ? (in_array($k, $t_status) ? 'selected' : '') : '' ;
                    ?>
                      <option value="<?= $k ?>" <?= $selects ?>>
                        <?php echo $v; ?>
                      </option>
                   <?php } ?>
              </select> 
           
          </div>
          <div class="col-lg-3 form-group">
            <label>Priority</label>
           
            <select name="priority[]" multiple='multiple' placeholder="All priority" class="select2-me" id="priority" labelname="priority">
                    
                    <?php 
                   $type_ass = ['Normal'=>'Normal','Medium'=>'Medium','High'=>'High'];
                   foreach($type_ass as $k=>$v){ 
                     $selects = !empty($priority)  ? (in_array($k, $priority) ? 'selected' : '') : '' ;
                    ?>
                      <option value="<?= $k ?>" <?= $selects ?>>
                        <?php echo $v; ?>
                      </option>
                   <?php } ?>
                  
              </select> 
          </div>
           <div class="col-lg-6 form-group">  
                   <label>Pendency</label>
              <select name="Pendency[]"  multiple='multiple' placeHolder="Select Pendency" class="select2-me" id="Pendency">  
                <?php $Pendency_arr = [1=>'Between 1-5 days',2=>'Between 6-10 days',3=>'Between 11-15 days',4=>'Between 16-20 days',5=>'Between 21-30 days',6=>'>30 days',]; ?>
                  
                   <?php foreach($Pendency_arr as $k=>$v){ 
                     $selects = !empty($Pendency)  ? (in_array($k, $Pendency) ? 'selected' : '') : '' ;
                    ?>
                      <option value="<?= $k ?>" <?= $selects ?> >
                        <?php echo $v ?>
                      </option>
                
               
              <?php } ?>
            </select>    
          </div>

         
    <?php 
    $pdfurl = "/backoffice/misreports/grievance/level1pdf?from_date=$from_date&to_date=$to_date";
    $url_components = parse_url($_SERVER['REQUEST_URI']);
 if(isset($url_components['query'])){
    parse_str($url_components['query'], $params);
    if(isset($params['Pendency'])){
		foreach ($params['Pendency'] as $key => $value) {
         $pdfurl.='&Pendency[]='.$value;
      }
    }
	if(isset($params['t_type'])){
		
         $pdfurl.='&t_type='.$params['t_type'];
      
    }
	
	if(isset($params['priority'])){
		foreach ($params['priority'] as $key => $value) {
         $pdfurl.='&priority[]='.$value;
      }
    }
	if(isset($params['t_status'])){
		foreach ($params['t_status'] as $key => $value) {
         $pdfurl.='&t_status[]='.$value;
      }
    }
	if(isset($params['t_id'])){
		foreach ($params['t_id'] as $key => $value) {
         $pdfurl.='&t_id[]='.$value;
      }
    }
   
 }

     


 
    ?>
              <!-- <div class="col-lg-6 form-group">  
                   <label>Pendency</label>
              <select name="Pendency[]" placeHolder="Select Pendency" class="select2-me" id="Pendency" multiple="true">  
                <1?php $Pendency_arr = [1=>'Between 1-5 days',2=>'Between 6-10 days',3=>'Between 11-15 days',4=>'Between 16-20 days',5=>'Between 21-30 days',6=>'>30 days',]; ?>
                  <option value="" disabled>Please Select</option>
                   <1?php foreach($Pendency_arr as $k=>$v){ ?>
                      <option value="<?= $k ?>" <1?php if(is_array($Pendency)){if(in_array($k,$Pendency)){echo 'selected';}}?> >
                        <1?php echo $v ?>
                      </option>
                
               
              <1?php } ?>
            </select>    
          </div> -->

           <div class="col-lg-12 form-group">  
          <?php 
         

             
         
        
            $si=1;
       foreach ($status_count as $key => $value) {
          
          echo $key.": <strong>$value</strong> ";
          if(sizeof($status_count)>$si){
            echo ' | ';
          }
           $si++;                  
       }?>
            </div>
                
          <div class="col-lg-6 form-group">
            <button type="submit" class="btn-primary">Search</button>
            <a href="<?= $pdfurl ?>"  target=_blank class="btn-primary">PDF</a>
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
                               <th class="text-left">
                                <h5>SR. No.</h5>
                               </th>
                               <th class="text-left">
                                <h5>Grievance ID </h5>
                               </th>
                               <th class="text-left">
                                <h5>Grievance Type</h5>
                               </th>
                               <th class="text-left">
                                <h5>Priority</h5>
                               </th>                              
                                <th class="text-left">
                                <h5>Grievance Timestamp</h5>
                               </th>
							   <th class="text-left">
                                <h5>Resolution Due Date</h5>
                               </th>
							   <th class="text-left">
                                <h5>Pendency<br>(days)</h5>
                               </th>
                                <th class="text-left">
                                <h5>Status of Grievance</h5>
                               </th>
							     <th class="text-left">
                                <h5>Resolution Timestamp</h5>
                               </th>
                               <th class="text-left">
                                <h5> Assigned To BO User</h5>
                               </th>
                              
                               
                          </tr>
                       </thead>
                           <tbody class="ticket-item">
                           <?php
						
    if($records){
     
       if($Pendency){   
        $pem_c = [];  
           foreach ($Pendency as $pk => $pv) {
             $pem_c[$pv] = $pv;
           }
        }
$i =0;
        foreach($records as $key => $value){  
           if(($t_id==NULL || in_array($value['id'], $t_id))){ 
            if($value['status']=='C'){                  
                   $date1 = date_create(date('Y-m-d',strtotime($value['updated_on'])));
                  $date2 = date_create(date('Y-m-d',strtotime($value['created_on'])));
                  $diff  = date_diff($date1,$date2);
                  $ad    = $diff->format("%a");
                }else{
                   $date1 = date_create(date('Y-m-d'));
                  $date2 = date_create(date('Y-m-d',strtotime($value['created_on'])));
                  $diff  = date_diff($date1,$date2);
                  $ad    = $diff->format("%a");
               }  

     $pendecy_check = [
          1=> $ad<=5, 
          2 => $ad>5 && $ad<=10, 
          3 => $ad>10 && $ad<=15,
          4 => $ad>15 && $ad<=20,
          5 => $ad>21 && $ad<=30,
          6 => $ad>30, 
        ];

      if($Pendency){          
        
          $result=array_intersect_key($pendecy_check,$pem_c);
            $pendency_show = in_array('1', $result);
        
      }else{
         $pendency_show = 'All';
      }  

        

      if($pendency_show=='All' || $pendency_show){
         $i=$i+1;

        $assign_to = Yii::app()->db->createCommand("
        SELECT s.*,p.full_name,p.middle_name,p.last_name FROM grievance s
          LEFT JOIN bo_user p ON s.currently_assign_to = p.uid
          WHERE s.id='".$value['id']."' ")->queryRow();
            ?>    
              <tr class="ticket-row tableinside text-left" id="<?php echo $key; ?>">
                <td class="text-left">
                  <?= $i ?>
                 </td>
                 <td>
                    <?php $_SESSION['tl1previousurl'] = $_SERVER['REQUEST_URI']; ?>
                                
                  <a href="/backoffice/misreports/grievance/level2/otd/reports?g_id=<?php echo $value['id'];?>" style='color:blue;'>
                   <?= $value['id'] ?></a>   
                 
                 </td>
                 <td class="text-center">
                   <?= ($value['category']=="Ticket" || $value['category']=="Query") ? 'Existing '.$value['category'] : $value['category'] ?>
                 </td>
                <td class="text-left">
                     <?= $value['priority'] ?>                           
                 </td>
                 <td class="text-left">
                    <?= $value['created_on'] ?>                         
                 </td>
				  <td class="text-left">
				  <?php echo date('Y-m-d H:i:s', strtotime($value['created_on'].' + 7 days')); ?>
                                         
                 </td>
				 <td class="text-center">
                      <?= $ad ?>
                </td>
				<td class="text-left">

					<?php 
           $status_res = Servicecategory::tqgstatus($value['status']);
              echo $status_res;

						
					?>
                  
                 </td>
				 <td class="text-left">
                     <?= $value['status']!=1 ? $value['updated_on'] : "-" ?>
                 </td>
                  <td class="text-center">
                     <?php if($assign_to['currently_assign_to']!=0 && $value['status']=='ESC'){
                      echo $assign_to['full_name'].' '.$assign_to['middle_name'].' '.$assign_to['last_name'];
                     } else { echo "-";} ?>
                     
                </td>
                   
              </tr>                                    
            <?php   }
                    }
                  }
                }
            ?>
                         
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