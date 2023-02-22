    <?php
/* @var $this DefaultController */

$this->breadcrumbs = array(
    $this->module->id
);
?>
<style type="text/css">
    .rsltstatus{color:red;}
    .panel{
    	background-color: #FFFFFF;
    }

    table.gridtable {
   font-family: verdana,arial,sans-serif;
   font-size:11px;
   color:#333333;
   width: 100%;
   border-width: 1px;
   border-color: #666666;
   border-collapse: collapse;
}
table.gridtable th {
   border-width: 1px;
   padding: 8px;
   border-style: solid;
   border-color: #666666;
   background-color: #dedede;
}
table.gridtable td {
   border-width: 1px;
   padding: 8px;
   border-style: solid;
   border-color: #666666;
   background-color: #ffffff;
}


table.gridtabledoc {
   font-family: verdana,arial,sans-serif;
   font-size:11px;
   color:#333333;
   width: 100%;
   border-width: 1px;
   border-color: #666666;
   border-collapse: collapse;
}
table.gridtabledoc th {
   border-width: 1px;
   padding: 8px;
   border-style: solid;
   border-color: #666666;
   background-color: #dedede;
}
table.gridtabledoc td {
   border-width: 1px;
   padding: 8px;
   border-style: solid;
   border-color: #666666;
   background-color: #ffffff;
}


table.gridtabledoc1 {
   font-family: verdana,arial,sans-serif;
   font-size:11px;
   color:#333333;
   width: 97%;
   margin-left: 20px;
   border-width: 1px;
   border-color: #666666;
   border-collapse: collapse;
}
table.gridtabledoc1 th {
   border-width: 1px;
   padding: 8px;
   border-style: solid;
   border-color: #666666;
   background-color: #dedede;
}
table.gridtabledoc1 td {
   border-width: 1px;
   padding: 8px;
   border-style: solid;
   border-color: #666666;
   background-color: #ffffff;
}
</style>
<div class="site-min-height">
<?php
if (isset($_SESSION['uid']) && !empty($_SESSION['uid'])) {
    $deptModel = new DepartmentsExt;
    $dept      = $deptModel->getDeptbyId($_SESSION['dept_id']);
    $appsModel = new ApplicationVerificationLevelExt;
    $roleModel = new RolesExt;
    $isNoodal  = Utility::isDeptNoodalOfficer();
    if (!$roleModel->isNodleAgencyUser())
        $Pendingapp = $appsModel->getApplication($_SESSION['uid']);
    else
        $Pendingapp = $appsModel->getNodleApplication($_SESSION['uid']);
    if(RolesExt::isAdminUser())
        echo "";
    else 
        echo " <div class='panel-heading tab-bg-dark-navy-blue hidden-sm wht-color '><h4>Welcome to $dept[department_name]</h4></div>";
    
    echo "<div class='rsltstatus'></div>";
    /*$app_name=ApplicationExt::getAppNameViaId($app['application_id']);
    echo "<h1>Application Name: ". $app_name['application_name'] ."</h1>";*/
    echo "<section class='main-content'>";
    $model = new ApplicationSubmissionExt;
    echo "<div class='panel-body'>";
    foreach (Yii::app()->user->getFlashes() as $key => $message) {
        if ($key == 'Error') {
?>
                        <div class="alert alert-block alert-danger fade in">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="fa fa-times"></i>
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
    echo "</div>";
    $applications = $model->getPendingApplications();

    if(RolesExt::isAdminUser()){
        //require_once('adminDashboard.php');
    }

   /* else if (!$isNoodal) {
        echo "<section id='panel' class='panel'>";
        echo "<header class='panel-heading'>
             <h4>Pending Applications</h4>
          </header>";
         echo "<div class='panel-body'>
                <div class='adv-table'>";
        if (!empty($Pendingapp)) {
            echo "<table class='display table table-bordered table-striped'>
                     <thead><tr><th>ID</th><th>Application Name</th><th>Company Name</th><th>Submission Date</th><th>Department</th><th>Status</th><th>Action</th></tr></thead>";
            $count = 1;
            foreach ($Pendingapp as $app) {
                $Fields  = json_decode($app['field_value']);
                $appName = ApplicationExt::getAppNameViaId($app['application_id']);
                // check if paid application and user already paid for it
                // if(ApplicationExt::checkUSerPaidForApplication(51,$app['application_id'],$app['app_sub_id']))
                    echo "<td>" . $app['app_sub_id'] . "</td><td align='center'>" . $appName['application_name'] . "</td><td>".@$Fields->company_name."</td><td align='center'>" . $app['application_created_date'] . "</td><td align='center'>$dept[department_name]</td><td align='center'>$app[approv_status]</td>
                        <td><a href='" . Yii::app()->createUrl('admin/ApplicationView/applicationfulldetail/app_sub_id/') . "/" . $app['app_sub_id'] . "' title='View Application'>View</a></td>
                         </tr>";
            }
            echo "</table>";
        } else
            echo "No Pending Applications";
            echo" </div></div>";
        echo "</section>";
    }


    
    echo "</section>";*/
    
    /**
    Get All the Forwarded application of this role id
    */
    $uid=$_SESSION['uid'];
    $role_id=RolesExt::getUserRoleViaId($uid);
    $ForwardedApps = $appsModel->getMisAllApprovedApplications($_SESSION['uid'], $role_id);
    $RevertedApps  = $appsModel->getRevertedApplications($_SESSION['uid']);
    $isNodleAgency = RolesExt::isNodleAgencyUser();
    
   $role_id=$role_id['role_id'];
    if ($isNodleAgency) {
        if (!$ForwardedApps)
            echo "<hr><h4>No Forwarded Applications to Other Departments</h4>";
        else {
            
            
            
            echo "<section class='panel'>";
            echo "<table class='gridtabledoc'>

                     <thead><tr><th colspan='9'><h4>Applications That you have Forwarded to other Departments</h4></th></tr>
                     <tr><th>S.No.</th><th>ID</th><th>Application Name</th><th>Forwarded to Department </th><th>Forwarding Date </th><th colspan='3'>Comments from Department</th><th>Comment Date</th></tr></thead>";
            $count    = 1;
            $prev_app = '';
            foreach ($ForwardedApps as $key => $apps) {
                $app_name  = ApplicationExt::getAppNameViaId($apps['application_id']);
                $dept_name = $deptModel->getDeptbyId($apps['forwarded_dept_id']);

                echo "<tr>";
                if ($prev_app != $apps['app_sub_id'])
                    echo "<td>" . $count++ . "</td><td><a href='" . Yii::app()->createAbsoluteUrl('admin/applicationView/viewForwardApplication/application_sub_id/' . $apps['app_sub_id']) . "''>$apps[app_sub_id]</a></td><td>$app_name[application_name]</td><td align='right'>$dept_name[department_name]</td><td>$apps[created_on]</td><td colspan='3'>";

                else
                    echo "<td colspan='4' align='right'>$dept_name[department_name]</td><td>$apps[created_on]</td><td colspan='3'>";
                if (empty($apps['verifier_user_comment']))
                    echo "No comments Yet";
                else
                    echo $apps['verifier_user_comment'];

                echo " 
                    </td><td>$apps[comment_date]</td></tr>";

                $prev_app = $apps['app_sub_id'];
            }

            echo "</table>";
            
            echo "</section>";
        }
       /* if(!$RevertedApps)
             echo "<hr><h4>No reverted Applications</h4>";
        else{
             echo "<hr><h3>Reverted Applications From Departments</h3>";
            echo "<section class='panel'>";
            echo "<table class='display table table-bordered table-striped'>
                     <thead><tr><th>S.No.</th><th>Submission Id</th><th>Application Name</th></tr></thead>";
            $count=1;
            foreach ($RevertedApps as $key => $apps) {
                    $app_name  = ApplicationExt::getAppNameViaId($apps['application_id']);
                    echo "<tr><td>" . $count++ . "</td><td><a href='" . Yii::app()->createAbsoluteUrl('admin/applicationView/viewForwardApplication/application_sub_id/' . $apps['app_Sub_id']) . "/revertedApp/revert'>$apps[app_Sub_id]</a></td><td>$app_name[application_name]</td></tr>";

                # code...
            }
        echo "</table>";
        }*/
    }   
    
    
    /**
    Applications that are forwarded to this role id.
    */
    
   /* if ($isNoodal) {
       // echo "<hr><h4></h4>";
        $ForwardApps = $appsModel->getForwardedAppOfDept($_SESSION['dept_id']);
        if (!$ForwardApps)
            echo "<hr><h4>No applications</h4>";
        else {
            echo "<section class='panel'>";
        
            echo "<table class='gridtabledoc'>
                                 <thead><thead><tr><th colspan='9'><h4>Application forwarded by Other department for Your Comments</h4></th></tr>
                                 <tr><th>S.No.</th><th>Application ID</th><th>Application Name</th><th>Forwarded From Department </th><th colspan='5'>Comments from Department</th></tr></thead>";
            $count    = 1;
            $prev_app = '';
            foreach ($ForwardApps as $key => $apps) {
                $dept_name = $deptModel->getDeptbyId($apps['dept_id']);
                $app_name  = ApplicationExt::getAppNameViaId($apps['application_id']);
                echo "<tr>";
                if ($prev_app != $apps['app_sub_id'])
                    echo "<td>" . $count++ . "</td><td><a href='" . Yii::app()->createAbsoluteUrl('admin/applicationView/forwardedApplication/application_sub_id/' . $apps['app_sub_id']) . "'>$apps[app_sub_id]</a></td><td>$app_name[application_name]</td><td align='right'>$dept_name[department_name]</td><td colspan='5'>";
                else
                    echo "<td colspan='4' align='right'>$dept_name[department_name]</td><td colspan='5'>";
                if (empty($apps['verifier_user_comment']))
                    echo "No comments Yet";
                else
                    echo $apps['verifier_user_comment'];
                echo " 
                                </td></tr>";
                $prev_app = $apps['app_sub_id'];
                
            }
            echo "</table>";
            
        }
        
        echo "</section>";
        
    }*/
}
?>

</div>
<script type="text/javascript" charset="utf-8">
          $(document).ready(function() {
              $('.display').dataTable( {
                  "aaSorting": [[ 4, "desc" ]]
              } );
          } );
</script>
<script type="text/javascript">
    function actionReject(app_id){
        if(app_id!==''){
            var url="<?php
echo Yii::app()->createUrl('/frontuser/ajax/applicationstatus');
?>";
            jQuery.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: "app_id=" + app_id,
            success: function (data) {
                if(data!=''){
                    if(data.status==='SUCCESS'){
                        var crntrow='#'+app_id;
                        $(crntrow).closest("tr").remove();
                        $('.rsltstatus').text('Successfully Rejected');
                    }
                    else
                        $('.rsltstatus').text("Can't update. Please Try again Later");
                }
              
            },
            error: function (data) {
                console.log(data);
            }
        });
        }
    }
    function actionVerify(app_id){
        if(app_id!==''){
            var url="<?php
echo Yii::app()->createUrl('/frontuser/ajax/applicationstatusAccept');
?>";
            jQuery.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: "app_id=" + app_id,
            success: function (data) {
                if(data!=''){
                    if(data.status==='SUCCESS'){
                        var crntrow='#'+app_id;
                        $(crntrow).closest("tr").remove();
                        $('.rsltstatus').text('Successfully Verified');
                    }
                    else
                        $('.rsltstatus').text("Can't update. Please Try again Later");
                }
              
            },
            error: function (data) {
                console.log(data);
            }
        });
        }
    }
        function actionHold(app_id){
        if(app_id!==''){
            var url="<?php
echo Yii::app()->createUrl('/frontuser/ajax/applicationstatusHold');
?>";
            jQuery.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: "app_id=" + app_id,
            success: function (data) {
                if(data!=''){
                    if(data.status==='SUCCESS'){
                        var crntrow='#'+app_id;
                        $(crntrow).closest("tr").remove();
                        $('.rsltstatus').text('Successfully kept on hold');
                    }
                    else
                        $('.rsltstatus').text("Can't update. Please Try again Later");
                }
              
            },
            error: function (data) {
                console.log(data);
            }
        });
        }
    }
</script>


   <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/morris.js-0.4.3/morris.min.js" type="text/javascript"></script>
    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/morris.js-0.4.3/raphael-min.js" type="text/javascript"></script>
   <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/morris-script.js"></script>
   <script src="<?php echo Yii::app()->theme->baseUrl; ?>/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
   <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/easy-pie-chart.js"></script>