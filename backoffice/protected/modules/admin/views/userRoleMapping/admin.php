<?php
$data = UserRoleMappingExt::getUserRoleMapping();
?>        
<!-- page start-->
<div class="row">
  <div class="col-lg-12">
      <section class="panel">
          <header class="panel-heading">
             <h1>Manage Role Mapping</h1>
          </header>
          <div class="panel-body">
                <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="application">
                      <thead>
                      <tr>
                          <th>Mapping Id</th>
                          <th>User Name</th>
                          <th>Role Name</th>
                          <th>Department Name</th>
                          <th>Status</th>
                          <th>Action</th>

                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      foreach ($data as $data) {
                        echo "<tr>
                              <td>".$data['mapping_id']."</td>
                              <td>".UserExt::getUNameviaIdMap($data['user_id'])."</td>
                              <td>".RolesExt::getRolesViaIdMap($data['role_id'])."</td>
                              <td>".DepartmentsExt::DepartmentsExtMap($data['department_id'])."</td>
                              <td>".$data['is_mapping_active']."</td>
                              <td><a href='".Yii::app()->createAbsoluteUrl("admin/userRoleMapping/view", array("id"=>$data['mapping_id']))."' title='View'><button class='btn btn-success btn-xs'><i class='fa fa-search'></i></button></a>
                                  <a href='".Yii::app()->createAbsoluteUrl("admin/userRoleMapping/update", array("id"=>$data['mapping_id']))."' title='View'><button class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></button></a>
                                  <a href='".Yii::app()->createAbsoluteUrl("admin/userRoleMapping/delete", array("id"=>$data['mapping_id']))."' title='View'><button class='btn btn-danger btn-xs'><i class='fa fa-trash-o '></i></button></a>
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