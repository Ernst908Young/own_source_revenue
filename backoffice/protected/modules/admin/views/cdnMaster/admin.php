<?php
$data = CdnMasterExt::getCdnMaster();
?>
<!-- page start-->
<div class="row">
  <div class="col-lg-12">
      <section class="panel">
          <header class="panel-heading">
             <h1>Manage Cdn Masters</h1>
          </header>
          <div class="panel-body">
                <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="application">
                      <thead>
                      <tr>
                          <th>Document Id</th>
                          <th>Document Name</th>
                          <th>Document Type</th>
                          <th>Doc Max Size</th>
                          <th>Doc Min Size</th>
                          <th>Status</th>
                          <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      foreach ($data as $data) {
                        echo "<tr>
                              <td>".$data['doc_id']."</td>
                              <td>".$data['doc_name']."</td>
                              <td>".$data['doc_type']."</td>
                              <td>".$data['doc_max_size']."</td>
                              <td>".$data['doc_min_size']."</td>
                              <td>".$data['is_doc_active']."</td>
                              <td><a href='".Yii::app()->createAbsoluteUrl("admin/cdnMaster/view", array("id"=>$data['doc_id']))."' title='View'><button class='btn btn-success btn-xs'><i class='fa fa-search'></i></button></a>
                              	  <a href='".Yii::app()->createAbsoluteUrl("admin/cdnMaster/update", array("id"=>$data['doc_id']))."' title='View'><button class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></button></a>
                                  <a href='".Yii::app()->createAbsoluteUrl("admin/cdnMaster/delete", array("id"=>$data['doc_id']))."' title='View'><button class='btn btn-danger btn-xs'><i class='fa fa-trash-o '></i></button></a>
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