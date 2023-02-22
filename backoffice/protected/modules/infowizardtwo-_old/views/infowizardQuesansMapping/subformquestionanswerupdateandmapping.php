



<style>

    .panel {
        overflow: hidden;
    }

    .panel-body{

        padding: 0px;

    }

    .section-data{

        float: left;

    }

    .section-data li{

        border-left: 1px solid #eee;

        border-bottom: 1px solid #eee;

        padding: 5px 6px;

        text-align: center;

    }

    .header-se{

        height: 50px;

        background: #ccc;

        color: #000;

    }



    .app-head{background-color: rgb(50,197,210) !important;color:#000 !important;}

</style>

<style type="text/css">

    .rsltstatus{color:red;}

    .panel{

        background-color: #FFFFFF;

    }

    table.gridtable {

        font-family: verdana,arial,sans-serif;

        font-size:11px;

        color:#333333;

        width: 100%;

        border-width: 1px;

        border-color: #666666;

        border-collapse: collapse;

    }

    table.gridtable th {

        border-width: 1px;

        padding: 8px;

        border-style: solid;

        border-color: #666666;

        background-color: #dedede;

    }

    table.gridtable td {

        border-width: 1px;

        padding: 8px;

        border-style: solid;

        border-color: #666666;

        background-color: #ffffff;

    }

    table.gridtabledoc {

        font-family: verdana,arial,sans-serif;

        font-size:10px;

        color:#333333;

        width: 100%;

        border-width: 1px;

        border-color: #666666;

        border-collapse: collapse;

    }

    table.gridtabledoc th {

        border-width: 1px;

        padding: 8px;

        border-style: solid;

        border-color: #666666;

        background-color: #dedede;

    }

    table.gridtabledoc td {

        border-width: 1px;

        padding: 8px;

        border-style: solid;

        border-color: #666666;

        background-color: #ffffff;

    }











    table.gridtabledoc1 {



        font-family: verdana,arial,sans-serif;



        font-size:12px;



        color:#333333;



        width: 100%;



        margin-left: 1px;



        border-width: 1px;



        border-color: #666666;



        border-collapse: collapse;



    }



    table.gridtabledoc1 th {



        border-width: 1px;



        padding: 8px;



        text-align: center;



        border-style: solid;



        border-color: #666666;   



        color:#ffffff;



        background-color: darkcyan;



    }



    .totaltd{



        border-width: 1px;



        padding: 8px;



        text-align: center;



        border-style: solid;



        border-color: #666666;   





    }



    table.gridtabledoc1 td {



        border-width: 1px;



        padding: 8px;

        font-weight: bold;



        border-style: solid;



        border-color: #666666;



        background-color: #ffffff;



    }



    .pstyle{

        color: blue;

        font-style: italic;

        font-size: 12px;

        font-weight: bold;

    }

    a:hover{color:#000;}

    .application-heading{  background-color: #e5e5e5 !important;

                           border-color: #000 !important;

                           color: #000 !important;}

</style>

<style>
    .control-label1 {
        text-align: left ;
        margin-bottom: 0;
        padding-top: 7px;
        margin-top: 1px;
        font-weight: 400;
    }
    .required{color:red !important}
</style>
<?php //print_r($apps);die; ?>
<style>
    span.required{color:red}
    .control-label .required, .form-group .required {
        color: #333;
        font-size: 14px;
        padding-left: 2px;
        font-weight: 400;
    }
    .required .required{color:red;} 
    .errorMessage {
        color: red;
    }


    .select2-container .select2-choice {
        -moz-border-radius: 0;
        -webkit-border-radius: 0;
        border-radius: 0;
        background-image: none;
        background: #fff;
        height: 30px;
    }
    .select2-container .select2-choice div {
        border-left: 0;
        background: none;
    }
    .select2-container .select2-choice .select2-arrow {
        background: none;
        border: 0;
    }
    .select2-container.select2-drop-above .select2-choice {
        -moz-border-radius: 0;
        -webkit-border-radius: 0;
        border-radius: 0;
        background-image: none;
    }
    .select2-container .select2-search-choice-close {
        top: 3px;
    }
    .select2-container .select2-choices {
        background-image: none;
    }
    .select2-container.select2-container-multi .select2-choices {
        -moz-box-shadow: none;
        -webkit-box-shadow: none;
        box-shadow: none;
        background: #fff;
    }
    .select2-container.select2-container-multi .select2-choices .select2-search-field input {
        padding: 9px 5px;
    }
    .select2-container.select2-container-multi .select2-choices .select2-search-choice {
        background: #eee;
        -moz-box-shadow: none;
        -webkit-box-shadow: none;
        box-shadow: none;
        -moz-border-radius: 0;
        -webkit-border-radius: 0;
        border-radius: 0;
    }

    .select2-results, .select2-search, .select2-with-searchbox {
        -webkit-border-radius: 0 !important;
        -moz-border-radius: 0 !important;
        border-radius: 0 !important;
    }
    .select2-results .select2-highlighted {
        background: rgb(38,194,129) !important;
        color: #fff;
    }

</style>


<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/css/plugins/select2/select2.css">
<!-- select2 -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/plugins/select2/select2.min.js"></script>

<!-- Theme framework -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/eakroko.min.js"></script>
<!-- Theme scripts -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/application.min.js"></script>
<!-- Just for demonstration -->
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/demonstration.min.js"></script>
<?php
/* @var $this InformationWizardServiceMasterController */
/* @var $model BoInformationWizardServiceMaster */
/* @var $form CActiveForm */
?>
<style>
    span.required{color:red}
    .control-label .required, .form-group .required {
        color: #333;
        font-size: 14px;
        padding-left: 2px;
        font-weight: 400;
    }

    .required .required{color:red;} 
    .errorMessage {
        color: red;
    }

</style>

<style> 

    .col-md-1{width:12.50% !important;}
    .uppercase { font-size: 16px !important;

    }
</style>



<div class="row">

    <div class="col-md-12">

        <!-- BEGIN EXAMPLE TABLE PORTLET-->

        <div class="portlet box green">

            <div class="portlet-title">

                <div class="caption font-dark">

                    <i style="font-size:24px" class="font-dark"></i>
                    <?php 
                    $sql = "select biwsm.id, biwsm.service_name, biwsm.issuerby_id, biim.name from bo_information_wizard_service_master biwsm "
                            . "left join bo_infowizard_issuerby_master biim on biwsm.issuerby_id = biim.issuerby_id where id = $service_ID ";
                    $connection = Yii::app()->db;
                    $command = $connection->createCommand($sql);
                    $serviceData = $command->queryAll();
                    //print_r($serviceData);die;

                    
                    ?>

                    <span class="caption-subject bold uppercase"><?php if(!empty($serviceData)) { echo $serviceData[0]['name'].' - '.'</span>'.$serviceData[0]['service_name'];} ?>

                </div>



            </div>

            <div class="portlet-body">

                <form name="" action="" method="POST">
                    <?php
                    // print_r($data); 
                    $stringArr = array();
                    if (!empty($data)) { //echo "hgjhghjh";
                        foreach ($data as $rstl)
                            $stringArr[] = $rstl['queans_mapp_id'];
                        $var = $implodedString = implode(",", $stringArr);
                        $options = explode(',', $var);
//print_r($var); //print_r($options);
                    } else {
                        $options = array();
                    }
                    if (empty($apps)) {

                        echo "No Detail Found";
                    } else {
                        ?>
                        <div class="row">
                            <div class="form-group col-md-11">
                                <label class="col-lg-3 col-sm-3 control-label" for="application_name" >Condition For And Mapping <?php ?><span class="required"></span></label>
                                <div class="col-md-8">
                                    <select name="and_mapping[]" id="and_mapping" class="select2-me"  multiple="multiple">

                                        <?php
                                        $sql = "select biqs.queans_mapp_id,priority,answer_detail "
                                                . "from bo_infowizard_quesans_serviceform biqs "
                                                . "left join bo_infowizard_quesans_mapping biqm "
                                                . "on biqs.queans_mapp_id = biqm.queans_mapp_id "
                                                . "where service_id = $service_ID and subservice_id= $subserviceID and is_active = 'Y'";
                                        $connection = Yii::app()->db;
                                        $command = $connection->createCommand($sql);
                                        $allData = $command->queryAll();
                                        foreach ($allData as $data) {
                                            $k = $data['queans_mapp_id'];
                                            $listData[$k] = $data['priority'] . '-' . $data['answer_detail'];
                                        }
                                        $a = array();
                                        ?>
                                        <?php foreach ($listData as $k => $v) { ?>
                                            <option value="<?php echo $k; ?>" <?php
                                            if (in_array($v, $a)) {
                                                echo " selected";
                                            }
                                            ?>><?php echo $v; ?></option>  
                                                <?php } ?>

                                    </select>
                                </div></div></div>
                    <?php } ?>  
                    <div class="row buttons" align="center">
                        <input type="submit" value="Save" class="btn btn-primary" >
                    </div>          


                </form> 
                <div class="row buttons" align="center">
                    <?php
                    //echo CHtml::submitButton('Back',array('class'=>'btn btn-primary','onclick'=>'window.history.back()')); 
//history.go(-1) 
                    ?>
                </div>  



                <br><br><br><br>


                <div class="portlet box green">
                    <div class='portlet-title'>
                        <div class='caption'>
                            <i style=" font-size:20px;" class='fa fa-list'></i>Condition for and Mapping</div>
                        <div class='tools'> </div>	
                    </div>
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_2">
                            <thead>
                                <tr>
                                    <th align="center" style="vertical-align:middle; text-align:center; width:10%">S.No.</th>
                                    <th align="center" style="vertical-align:middle; text-align:center; width:10%">Condition ID</th>
                                    <th align="center" style="vertical-align:middle; text-align:center; width:70%">Details</th>
                                    <th align="center" style="vertical-align:middle; text-align:center; width:10%">Action</th>				
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                $case_id_array = array();
                                $sql = "select bc.case_id,bac.* from bo_infowiz_service_quesans_condition_mapping bc
                        left join bo_infowiz_service_conditional_answer_mappping bac on bc.id = bac.condition_id  where service_id = $service_ID and bc.status='Y' and bac.status='Y'";
                                $connection = Yii::app()->db;
                                $command = $connection->createCommand($sql);
                                $all_mapping = $command->queryAll();
                               // print_r($all_mapping);die;
                                if (!empty($all_mapping)) {

                                    foreach ($all_mapping as $mapping) {
                                        if (!empty($mapping)) {
                                            $ans_id = $mapping['answer_id'];
                                            $case_id[] = $mapping['case_id'];
                                        }
                                    }
                                    $unique_cases = array_unique($case_id);
                                //   echo "<pre>"; print_r($unique_cases);die; 
                                    foreach ($unique_cases as $unique_case) {
                                        $sql = "select bc.case_id,bac.* from bo_infowiz_service_quesans_condition_mapping bc
                        left join bo_infowiz_service_conditional_answer_mappping bac on bc.id = bac.condition_id  where service_id = $service_ID and bc.case_id = $unique_case AND bac.status='Y'";
                                        $connection = Yii::app()->db;
                                        $command = $connection->createCommand($sql);
                                        $this_case = $command->queryAll();
//                                        echo '<pre>'; print_r($this_case);die;//
                                        ?>
                                        <tr>    
                                            <td align="center"><?php echo $count++; ?></td>
                                            <td align="center"><?php echo $unique_case; ?></td>
                                            <td align="center"><?php
                                                foreach ($this_case as $case) {
                                                  // print_r($case);die;
                                                    $ans_id = $case['answer_id'];
                                                    $sql = "select answer_detail,priority from bo_infowizard_quesans_mapping where queans_mapp_id = $ans_id  ";
                                                    $connection = Yii::app()->db;
                                                    $command = $connection->createCommand($sql);
                                                    $answer = $command->queryAll();
                                                    echo '<span class="label label-primary">' . $answer[0]['priority'] . '-' . $answer[0]['answer_detail'] . '</span>' . '&nbsp';
                                                }
                                                ?></td>    
                                            <td align="center"><a href="#">Update</a>
                                                
                                                <a href="/backoffice/infowizard/infowizardQuesansMapping/subFormQuestionAnswerMappingDeactivate/conID/<?php echo base64_encode($case['condition_id']); ?>">Delete</a></td>
                                            
                                        </tr>
                                    <?php }
                                } ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>



<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>