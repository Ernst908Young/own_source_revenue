<?php
$baseUrl=Yii::app()->theme->baseUrl;

?>
<!--BEGIN PAGE LEVEL PLUGINS -->
<link href="<?=$baseUrl?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="<?=$baseUrl?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="index.html">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <a href="#">Investor Detail</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>List Detail</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- END PAGE HEADER-->
<div class="m-heading-1 border-green m-bordered">
    <h3>Investor's Detail</h3>
    <p> </p>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i style="font-size:24px" class="fa fa-eye-slash"></i>
                    <span class="caption-subject bold uppercase">View Data</span>
                </div>
                <div class="tools"> </div>
            </div>
            <div class="portlet-body table-both-scroll">
                <table class="table table-striped table-bordered order-column" id="land_scape_table">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th >Date of Application</th>
                            <th>CAF ID</th>
                            <th>Authorization Co-ord Name</th>
                            <th>District</th>  
                            <th>Mobile Number</th>  
                            <th>Email</th>  
                            <th>Nature of Org</th>  
                            <th>Unit type</th>  
                            <th>Products to be manufactured</th>  
                            <th>Type of Industry</th>  
                            <th>New/Expansion/Diversification</th>  
                            <th>Expected Date of Commercial Production</th>  
                            <th>Total Investment</th>  
                            <th>Existing Approvals(Separated by comma)</th>  
                            <th>Name of Department(Separated by comma) </th>  
                            <th>Name of Approval(Separated by comma)</th>  
                        </tr>
                    </thead>
                    <tbody>
                       <?php 
                       $count=1;
                       // echo "<pre>";print_r($datas);die;
                         foreach ($datas as $key => $data) 
                         {

                            $fields=json_decode($data->field_value);
                       // echo "<pre>";print_r($data->application_created_date);die;
                            $date=explode(" ", $data->application_created_date);
                            // echo "<pre>";print_r($date);die;
                            $userInfo=$this->getInvestorDetail($data->user_id);

                            // echo "<pre>";print_r($userInfo);die;
                            echo "<tr>
                                <td>".$count++."</td>
                                <td>".@$date[0]."</td>
                                <td>".@$data->submission_id."</td>
                                <td>".@$fields->auth_name."</td>
                                <td>".DistrictExt::getDistricNameById($fields->land_disctric)."</td>
                                <td>".@$userInfo['mobile_number']."</td>
                                <td>".@$userInfo['email']."</td>
                                <td>".@$fields->noforg."</td>
                                <td>".@$fields->ntrofunittype."</td>";
                                 echo "<td>";
                                if(isset($fields->Product_Description)){
                                   
                                    foreach ($fields->Product_Description as $key => $prod) {
                                        echo "$prod ,";
                                    }
                                }
                                    echo "</td>";

                                echo "<td>".@$fields->type_of_industry."</td>
                                <td>".@$fields->project_status."</td>
                                <td>".@$fields->expected_date_of_commercial_production."</td>
                                <td>".round($fields->invstmnt_in_total[0],2)."</td>";
                                echo "<td>";
                                if(isset($fields->Name_of_the_Department)){
                                    foreach ($fields->Name_of_the_Department as $key => $dept) {
                                        echo "$dept ,"; 
                                    }
                                }
                                echo "</td>";
                                echo "<td>";
                                if(isset($fields->requried_approval_department)){
                                    foreach ($fields->requried_approval_department as $key => $dept) {
                                        echo "$dept ,"; 
                                    }
                                }
                                echo "</td>";
                                echo "<td>";
                                if(isset($fields->requried_approval_department)){
                                    foreach ($fields->required_approval_name as $key => $apr) {
                                        echo "$apr ,"; 
                                    }
                                }
                                echo "</td>";
                                  
                            "</tr>";
                           
                         }
                         ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=$baseUrl?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="<?=$baseUrl?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="<?=$baseUrl?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="<?=$baseUrl?>/assets/pages/scripts/table-datatables-scroller.min.js" type="text/javascript"></script>

<!-- END PAGE LEVEL PLUGINS