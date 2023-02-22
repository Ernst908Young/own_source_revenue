<div class='portlet box green'>
  <div class='portlet-title'>
    <div class='caption'>
      <i style=" font-size:20px;" class='fa fa-list'>
      </i>Upload In-Principle Approval Letter
    </div>
    <div class='tools'> 
    </div>
  </div>
  <div class="portlet-body">
    <?php
foreach (Yii::app()->user->getFlashes() as $key => $message) {
if ($key == 'Error') {
?>
    <div class="alert alert-block alert-danger fade in">
      <button data-dismiss="alert" class="close close-sm" type="button">
        <i class="fa fa-times">
        </i>
      </button>
      <?php
} else {
echo "<div class='alert alert-info fade in'>
<button data-dismiss='alert' class='close close-sm' type='button'>
<i class='fa fa-times'></i>
</button>";
}
echo $message . "</div>\n";
}
?>
      <table  class="table table-striped table-bordered table-hover" id="sample_2">
        <thead>
          <tr>
            <th>Application ID
            </th>
            <th>Application Name
            </th>
            <!--<th>User ID</th>-->
            <th>Company Name
            </th>
            <th>Department Name
            </th>
            <th>Application Status
            </th>
          </tr>
        </thead>
        <tbody>
          <?php
          $useremail=$_SESSION['email'];
if($useremail=='mpr@doiuk.org')
{
$apps=ApplicationSubmissionExt::getStateAprrovedApplications();
}
else
{
$apps=ApplicationSubmissionExt::getAprrovedApplications();
}
if(!empty($apps)){
foreach ($apps as $app) {
$appname=ApplicationExt::getAppNameViaId($app['application_id']);
$appname=$appname['application_name'];
$dept=DepartmentsExt::getDeptbyId($app['dept_id']);
$dept=$dept['department_name'];
$Fields  = json_decode($app['field_value']);
echo "<tr>
<td><a href='".Yii::app()->createAbsoluteUrl('/admin/uploadDocuments/uploadFiles/app_submission_id/'.base64_encode($app['submission_id']))."' alt='Click to upload file' title='Click to upload file'>$app[submission_id]</a></td>
<td>";
if(preg_match('/_/', $appname))
$appname=str_replace('_', ' ', $appname);
echo $appname;
echo "</td>";
echo "</td>
<td>$Fields->company_name</td>
<td>";  
if(preg_match('/_/', $dept))
$dept=str_replace('_', ' ', $dept);
echo $dept;
echo "</td>";
if($app['application_status']=='A')
echo "<td><span class='label label-success'><i class='fa fa-check'></i>  Approved</span></td>";
if($app['application_status']=='R')
echo "<td><span class='label label-danger'><i class='fa fa-close'></i>  Rejected</span></td>";
echo "</tr>";
}
}
?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<div class='portlet box green'>
  <div class='portlet-title'>
    <div class='caption'>
      <i style=" font-size:20px;" class='fa fa-list'>
      </i>Upload Approval/Rejection Letter for other Integrated Department
    </div>
    <div class='tools'> 
    </div>
  </div>
  <div class="portlet-body">
    <?php
foreach (Yii::app()->user->getFlashes() as $key => $message) {
if ($key == 'Error') {
?>
    <div class="alert alert-block alert-danger fade in">
      <button data-dismiss="alert" class="close close-sm" type="button">
        <i class="fa fa-times">
        </i>
      </button>
      <?php
} else {
echo "<div class='alert alert-info fade in'>
<button data-dismiss='alert' class='close close-sm' type='button'>
<i class='fa fa-times'></i>
</button>";
}
echo $message . "</div>\n";
}
?>
      <table  class="table table-striped table-bordered table-hover" id="sample_3">
        <thead>
          <tr>
            <th>Application ID
            </th>
            <th>Application Name
            </th>
            <th>Department Name
            </th>
            <th>Application Status
            </th>
          </tr>
        </thead>
        <tbody>
          <?php
$apps=ApplicationSubmissionExt::getSSOAprovedRejectApplications();
if(!empty($apps)){
foreach ($apps as $app) {
$appname=$app['app_name'];
$dept=DepartmentsExt::getSSONameFromSPTag($app['sp_tag']);
// $dept=$dept['department_name'];
// echo $dept;die;
echo "<tr>
<td><a href='".Yii::app()->createAbsoluteUrl('/admin/uploadDocuments/uploadSSODeptFiles/app_submission_id/'.base64_encode($app['sno']))."' alt='Click to upload file' title='Click to upload file'>$app[app_id]</a></td>
<td>";
if(preg_match('/_/', $appname))
$appname=str_replace('_', ' ', $appname);
echo $appname;
echo "</td>
<td>";  
if(preg_match('/_/', $dept))
$dept=str_replace('_', ' ', $dept);
echo $dept;
echo "</td>";
if($app['app_status']=='A')
echo "<td><span class='label label-success'><i class='fa fa-check'></i>  Approved</span></td>";
if($app['app_status']=='R')
echo "<td><span class='label label-danger'><i class='fa fa-close'></i>  Rejected</span></td>";
echo "</tr>";
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
<script src="<?=$base?>/assets/global/scripts/datatable.js" type="text/javascript">
</script>
<script src="<?=$base?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript">
</script>
<script src="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript">
</script>
<script src="<?=$base?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript">
</script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<link href="<?=$base?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<script type="text/javascript">
  var TableDatatablesButtons = function() {
    var t = function() {
      var e = $("#sample_2");
      e.dataTable({
        language: {
          aria: {
            sortAscending: ": activate to sort column ascending",
            sortDescending: ": activate to sort column descending"
          }
          ,
          emptyTable: "No data available in table",
          info: "Showing _START_ to _END_ of _TOTAL_ entries",
          infoEmpty: "No entries found",
          infoFiltered: "(filtered1 from _MAX_ total entries)",
          lengthMenu: "_MENU_ entries",
          search: "Search:",
          zeroRecords: "No matching records found"
        }
        ,
        buttons: [{
          extend: "print",
          className: "btn default"
        }
                  ,  {
                    extend: "pdf",
                    className: "btn default"
                  }
                  , {
                    extend: "excel",
                    className: "btn default"
                  }
                 ],
        order: [
          [0, "asc"]
        ],
        lengthMenu: [
          [5, 10, 15, 20, -1],
          [5, 10, 15, 20, "All"]
        ],
        pageLength: 10,
        dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
      }
                 )
    }
    ,
        a = function() {
          var e = $("#sample_3"),
              t = e.dataTable({
                language: {
                  aria: {
                    sortAscending: ": activate to sort column ascending",
                    sortDescending: ": activate to sort column descending"
                  }
                  ,
                  emptyTable: "No data available in table",
                  info: "Showing _START_ to _END_ of _TOTAL_ entries",
                  infoEmpty: "No entries found",
                  infoFiltered: "(filtered1 from _MAX_ total entries)",
                  lengthMenu: "_MENU_ entries",
                  search: "Search:",
                  zeroRecords: "No matching records found"
                }
                ,
                buttons: [{
                  extend: "print",
                  className: "btn dark btn-outline"
                }
                          , {
                            extend: "copy",
                            className: "btn red btn-outline"
                          }
                          , {
                            extend: "pdf",
                            className: "btn green btn-outline"
                          }
                          , {
                            extend: "excel",
                            className: "btn yellow btn-outline "
                          }
                          , {
                            extend: "csv",
                            className: "btn purple btn-outline "
                          }
                          , {
                            extend: "colvis",
                            className: "btn dark btn-outline",
                            text: "Columns"
                          }
                         ],
                responsive: !0,
                order: [
                  [0, "asc"]
                ],
                lengthMenu: [
                  [5, 10, 15, 20, -1],
                  [5, 10, 15, 20, "All"]
                ],
                pageLength: 10
              }
                             );
          $("#sample_3_tools > li > a.tool-action").on("click", function() {
            var e = $(this).attr("data-action");
            t.DataTable().button(e).trigger()
          }
                                                      )
        };
    return {
      init: function() {
        jQuery().dataTable && (t(), a())
      }
    }
  }
  ();
  jQuery(document).ready(function() {
    TableDatatablesButtons.init()
  }
                        );
</script> 
