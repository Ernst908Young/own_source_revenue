 <style type="text/css">
.error{
  color:red;
}
 </style>
 <div class="col-lg-12 site-min-height">
                      <!--work progress start-->
                      <section class="panel">
                          <div class="panel-body progress-panel">
                              <div class="task-progress">
                                  <h1>Details</h1>
                                  <p>Please select the Filters to generate the report</p>
                                  <p class='error'></p>
                              </div>
                              <div class="task-option">
                                  <form action="<?php echo Yii::app()->createAbsoluteUrl('admin/adminTasks/ViewFilteredApplications');?>" method="post">
                                  <select required class="styled filter_dept" id="ApplicationsFieldsMapping_dept_id" name='dept_id' onchange="getApplications('<?php echo Yii::app()->createUrl('ajax/DeptApp');?>');">
                                  </select>
                                   <select required class="styled filter_apps" id="ApplicationsFieldsMapping_application_id" name='application_id'>
                                   <option value="">Please Select Dept 1st</option>
                                  </select>
                                  <input class="btn btn-primary" type="submit" value="Import As CSV" />
                                  </form>
                                  
                              </div>
                              <div class="adv-table">
                                  <table  class="display table table-bordered table-striped" id="data-record-table">
                                    <thead>
                                    <tr>
                                        <th>Department Name</th>
                                        <th>User Id</th>
                                        <th>Application Name</th>
                                        <th>Application Status</th>
                                        <th>Submitted On</th>
                                    </tr>
                                    </thead>
                                    <tbody class='table_data'>
                                    
                                    </tbody>
                                  </table>
                              </div>
                          </div>
                          
                      </section>
                      <!--work progress end-->
        </div>
        <script type="text/javascript">
        $('document').ready(function(){
          $('#data-record-table').dataTable( {
              "aaSorting": [[ 4, "desc" ]]
          } );
          var url="<?php echo Yii::app()->createUrl('ajax/alldept');?>";
          getAllDeptAPI(url,'#ApplicationsFieldsMapping_dept_id');

        })
        $('.filter_apps').change(function(){
          var dept_id=$('.filter_dept').val();
          var app_id=$('.filter_apps').val();
          if(dept_id=='' && app_id==''){
            $('.error').empty();
            $('.error').text("Please select the filters value");
          }
           if(dept_id==''){
            $('.error').empty();
            $('.error').text("Please select the Department value");
          }
           if(app_id==''){
            $('.error').empty();
            $('.error').text("Please select the Applications ");
          }
          var url="<?php echo Yii::app()->createAbsoluteUrl('admin/ajax/getApplicationReport');?>";
         getApplicationRecords(dept_id,app_id,url);
        })
      
        </script>