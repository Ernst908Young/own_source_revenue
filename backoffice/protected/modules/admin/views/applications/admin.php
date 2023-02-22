<?php
  $data = ApplicationExt::getApplications();
?>
<!-- page start-->
<div class="row">
  <div class="col-lg-12">
      <section class="panel">
          <header class="panel-heading">
             <h1>Manage Applications</h1>
          </header>
          <div class="panel-body">
                <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="application">
                      <thead>
                      <tr>
                          <th>Application</th>
                          <th>Application Name</th>
                          <th>Application Desc</th>
                          <th>Dept</th>
                          <th>Is Application Active</th>
                          <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      foreach ($data as $data) {
                        echo "<tr>
                              <td>".$data['application_id']."</td>
                              <td>".$data['application_name']."</td>
                              <td>".$data['application_desc']."</td>
                              <td>".$data['dept_id']."</td>
                              <td>".$data['is_application_active']."</td>
                              <td><a href='".Yii::app()->createAbsoluteUrl("admin/applications/view", array("id"=>$data['application_id']))."' title='View'><button class='btn btn-success btn-xs'><i class='fa fa-search'></i></button></a>
                              	  <a href='".Yii::app()->createAbsoluteUrl("admin/applications/update", array("id"=>$data['application_id']))."' title='View'><button class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></button></a>
                                  <a href='".Yii::app()->createAbsoluteUrl("admin/applications/delete", array("id"=>$data['application_id']))."' title='View'><button class='btn btn-danger btn-xs'><i class='fa fa-trash-o '></i></button></a>
                              </td>
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
<!-- page end-->
<script type="text/javascript" charset="utf-8">
          $(document).ready(function() {
              $('#application').dataTable( {
                  "aaSorting": [[ 4, "desc" ]]
              } );
          } );
</script>