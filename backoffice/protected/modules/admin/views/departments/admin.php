<?php
$data = DepartmentsExt::getDepartments();
// echo "<pre>"; print_r($data);
?>
<!-- page start-->
<div class="row">
  <div class="col-lg-12">
      <section class="panel">
          <header class="panel-heading">
             <h1>Manage Departments</h1>
          </header>
          <div class="panel-body">
                <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="application">
                      <thead>
                      <tr>
                          <th>Department Id</th>
                          <th>Department Name</th>
                          <th>Department Unique Code</th>
                          <th style="width:100px;">Department Link</th>
                          <th>Department Img</th>
                          <th>Added On</th>
                          <th>Action</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      foreach ($data as $data) {
                        echo "<tr>
                              <td>".$data['dept_id']."</td>
                              <td>".$data['department_name']."</td>
                              <td>".$data['department_unique_code']."</td>
                              <td>".$data['department_link']."</td>
                              <td>".$data['department_img']."</td>
                              <td>".$data['added_on']."</td>
                              <td><a href='".Yii::app()->createAbsoluteUrl("admin/departments/view", array("id"=>$data['dept_id']))."' title='View'><button class='btn btn-success btn-xs'><i class='fa fa-search'></i></button></a>
                              	  <a href='".Yii::app()->createAbsoluteUrl("admin/departments/update", array("id"=>$data['dept_id']))."' title='View'><button class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></button></a>
                                  <a href='".Yii::app()->createAbsoluteUrl("admin/departments/delete", array("id"=>$data['dept_id']))."' title='View'><button class='btn btn-danger btn-xs'><i class='fa fa-trash-o '></i></button></a>
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