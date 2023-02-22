    <!-- page start-->
    <div class="row site-min-height">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Full Detail
                    <div class="pull-right">
                      <a href="<?php echo Yii::app()->createAbsoluteUrl('admin/adminTasks/downloadAllApplications');?>" title="Export As CSV"><i class="fa fa-2x fa-cloud-download"></i></a>
                    </div>
                </header>
                <div class="panel-body">
                      <div class="adv-table">
                          <table  class="display table table-bordered table-striped" id="data-record-table">
                            <thead>
                            <tr>
                                <th>Department Name</th>
                                <th>Total Pending Apps</th>
                                <th>Total Approve Apps</th>
                                <th>Total Reject Apps</th>
                                <th>Total Incomplete Application</th>
                                <th>Total Applications</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                              if(!empty($applications))
                                foreach ($applications as $apps) {
                                    $pending_app=ApplicationSubmissionExt::getPendingApplicationscount($apps['dept_id']);
                                    $apprev_ap=ApplicationSubmissionExt::getApproveApplicationscount($apps['dept_id']);
                                    $reject_app=ApplicationSubmissionExt::getRejectApplicationscount($apps['dept_id']);
                                    $incmplt_app=ApplicationSubmissionExt::getIncompleteApplicationscount($apps['dept_id']);  
                                  echo "<tr>
                                          <td>$apps[department_name]</td>
                                          <td>$pending_app[pending_app]</td>
                                          <td>$apprev_ap[apprv_app]</td>
                                          <td>$reject_app[reject_app]</td>
                                          <td>$incmplt_app[incmplt_app]</td>
                                          <td>$apps[total_aps]</td>
                                      </tr>";
                                }
                            ?>
                            </tbody>
                          </table>
                      </div>
                </div>
            </section>
        </div>
    </div>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $('#data-record-table').dataTable( {
            "aaSorting": [[ 4, "desc" ]]
        } );
    } );
</script>