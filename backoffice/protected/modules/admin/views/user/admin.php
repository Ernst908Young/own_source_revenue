<?php
$data= UserExt::getUsers();
?>
<!-- page start-->
<div class="row">
  <div class="col-lg-12">
      <section class="panel">
          <header class="panel-heading">
             <h1>Manage Users</h1>
          </header>
          <div class="panel-body">
                <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="application">
                      <thead>
                      <tr>
                          <th style="width:100px;">User Id</th>
                          <th>Full Name</th>
                          <th>Email Id</th>
                          <th>Mobile No.</th>
                          <th style="width:100px;">Dept Id</th>
                          <th>Password</th>
                          <th>Status</th>
                          <th>Action</th>

                      </tr>
                      </thead>
                      <tbody>
                      <?php 
                      foreach ($data as $data) {
                        echo "<tr>
                              <td>".$data['uid']."</td>
                              <td>".$data['full_name']."</td>
                              <td>".$data['email']."</td>
                              <td>".$data['mobile']."</td>
                              <td>".$data['dept_id']."</td>
                              <td>".$data['password']."</td>
                              <td>".$data['is_active']."</td>
                              <td><a href='".Yii::app()->createAbsoluteUrl("admin/user/view", array("id"=>$data['uid']))."' title='View'><button class='btn btn-success btn-xs'><i class='fa fa-search'></i></button></a>
                              	  <a href='".Yii::app()->createAbsoluteUrl("admin/user/update", array("id"=>$data['uid']))."' title='View'><button class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></button></a>
                                  <a href='".Yii::app()->createAbsoluteUrl("admin/user/delete", array("id"=>$data['uid']))."' title='View'><button class='btn btn-danger btn-xs'><i class='fa fa-trash-o '></i></button></a>
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