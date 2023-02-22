<?php
$data = ApplicationsFieldsMappingExt::getApplicationsFieldsMapping();
?>
<!-- page start-->
<div class="row">
  <div class="col-lg-12">
      <section class="panel">
          <header class="panel-heading">
             <h1>Manage Fields Mapping</h1>
          </header>
          <div class="panel-body">
                <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="application">
                      <thead>
                      <tr>
                          <th>Application Map Id</th>
                          <th>Application Name</th>
                          <th>Field Name</th>
                          <th>Field Value</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      foreach ($data as $data) {
                      	$Name = ApplicationExt::getAppNameViaId($data['application_id']);
                        echo "<tr>
                              <td>".$data['app_mapping_id']."</td>
                              <td>".$Name['application_name']."</td>
                              <td>".$data['field_name']."</td>
                              <td>".$data['field_value']."</td>
                              <td>".$data['is_mapping_active']."</td>
                              <td><a href='".Yii::app()->createAbsoluteUrl("admin/applicationsFieldsMapping/view", array("id"=>$data['app_mapping_id']))."' title='View'><button class='btn btn-success btn-xs'><i class='fa fa-search'></i></button></a>
                              	  <a href='".Yii::app()->createAbsoluteUrl("admin/applicationsFieldsMapping/update", array("id"=>$data['app_mapping_id']))."' title='View'><button class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></button></a>
                                  <a href='".Yii::app()->createAbsoluteUrl("admin/filelds/delete", array("id"=>$data['app_mapping_id']))."' title='View'><button class='btn btn-danger btn-xs'><i class='fa fa-trash-o '></i></button></a>
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