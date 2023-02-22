
<?php 
   $deptModel = new DepartmentsExt;
   $dept      = $deptModel->getDeptbyId($_SESSION['dept_id']);
   
?>

<div style="margin:-7px -20px 0;" class="page-bar">
           <ul class="page-breadcrumb">

              <li>
                 <b>Welcome - Single Window Administrator </b>
              </li>
           </ul>
           <div class="page-toolbar">
              <div id="" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom">
                 <span class="thin uppercase hidden-xs" id="clock"><?=date('d-M Y')?>&nbsp;</span>
                 <span class="thin uppercase hidden-xs"></span>&nbsp;
              </div>
           </div>
        </div>