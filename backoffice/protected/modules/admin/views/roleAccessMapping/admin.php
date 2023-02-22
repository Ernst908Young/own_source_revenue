<?php
$data = RoleAccessMappingExt::getRoleAccessMapping();
?>
<!-- page start-->
<div class="row">
  <div class="col-lg-12">
      <section class="panel">
          <header class="panel-heading">
             <h1>Manage Role Access Mapping</h1>
          </header>
          <div class="panel-body">
                <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="application">
                      <thead>
                      <tr>
                          <th>Map Id</th>
                          <th>Role Name</th>
                          <th>Access</th>
                          <th>Created On</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      foreach ($data as $data) {
                        echo "<tr>
                              <td>".$data['map_id']."</td>
                              <td>".RoleAccessMappingExt::getRoleName($data['role_id'])."</td>
                              <td>".RoleAccessMappingExt::getRoleAccessName($data['access_id'])."</td>
                              <td>".$data['created_on']."</td>
                              <td>".$data['is_active']."</td>
                              <td><a href='".Yii::app()->createAbsoluteUrl("admin/roleAccessMapping/view", array("id"=>$data['map_id']))."' title='View'><button class='btn btn-success btn-xs'><i class='fa fa-search'></i></button></a>
                              	  <a href='".Yii::app()->createAbsoluteUrl("admin/roleAccessMapping/update", array("id"=>$data['map_id']))."' title='View'><button class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></button></a>
                                  <a href='".Yii::app()->createAbsoluteUrl("admin/roleAccessMapping/delete", array("id"=>$data['map_id']))."' title='View'><button class='btn btn-danger btn-xs'><i class='fa fa-trash-o '></i></button></a>
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