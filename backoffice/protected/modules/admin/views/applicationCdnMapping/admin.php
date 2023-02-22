<?php
$data = ApplicationCdnMappingExt::getApplicationCdnMapping();
?>
<!-- page start-->
<div class="row">
  <div class="col-lg-12">
      <section class="panel">
          <header class="panel-heading">
             <h1>Manage Application Cdn Mappings</h1>
          </header>
          <div class="panel-body">
                <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="application">
                      <thead>
                      <tr>
                          <th>Map Id</th>
                          <th>Application Name</th>
                          <th>Document Name</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      foreach ($data as $data) {
                      	$appname=ApplicationExt::getAppNameViaId($data['application_id']);
                        echo "<tr>
                              <td>".$data['map_id']."</td>
                              <td>".$appname['application_name']."</td>
                              <td>".CdnMasterExt::getDocName($data['doc_id'])."</td>
                              <td>".$data['is_mapping_active']."</td>
                              <td><a href='".Yii::app()->createAbsoluteUrl("admin/applicationCdnMapping/view", array("id"=>$data['map_id']))."' title='View'><button class='btn btn-success btn-xs'><i class='fa fa-search'></i></button></a>
                              	  <a href='".Yii::app()->createAbsoluteUrl("admin/applicationCdnMapping/update", array("id"=>$data['map_id']))."' title='View'><button class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></button></a>
                                  <a href='".Yii::app()->createAbsoluteUrl("admin/applicationCdnMapping/delete", array("id"=>$data['map_id']))."' title='View'><button class='btn btn-danger btn-xs'><i class='fa fa-trash-o '></i></button></a>
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