<div class="row">
<div class="dt-buttons" style="margin-bottom: 10px; float:right; margin-right:15px" ><a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('/infowizard/infowizardQuesansMapping/page/')?>"><span>Add Answers </span></a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('/infowizard/infowizardQuesansMapping/excludequestion/')?>"><span>Add/Edit Exclusion</span></a>
</div></div>



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

   

    <div class="row">

    <div class="col-md-12">

        <!-- BEGIN EXAMPLE TABLE PORTLET-->

        <div class="portlet box green">

            <div class="portlet-title">

                <div class="caption font-dark">

                    <i style="font-size:24px" class="font-dark"></i>

                    <span class="caption-subject bold uppercase">List of Question And Answer</span>
                
                </div>
				


            </div>

            <div class="portlet-body">
<!--<div class="row buttons" align="right">
        <?php echo CHtml::submitButton('Back',array('class'=>'btn btn-primary','onclick'=>'window.history.back()')); ?>
    </div> 
	<br />
-->
           <?php
            if(empty($apps)){

                echo "No Detail Found"; }

              else{

               

                foreach ($apps as $key => $apps) {    
                    ?>
                <table cellpadding="0" cellspacing="0" border="0" class="gridtabledoc1" >

                    <thead>

         <tr><td colspan="8">Q<?php echo $quesID=$apps['question_id']; ?>&nbsp;&nbsp; <?php $question=InfowizardQuesansMappingController::getListofQuestion($apps['question_id']); 
			 echo $question['name'];?> 
		<?php 
		$sql="select * from bo_infowizard_quesans_mapping where question_id=$quesID and is_quesans_active='Y'";
		    $connection=Yii::app()->db; 
		    $command=$connection->createCommand($sql);  
			$Fields=$command->queryAll();
			// print_r($Fields); die;
			$countold=count($Fields);
			if($countold>0) { ?>
	<a style="margin-bottom: 10px; float:right; margin-right:15px" href="<?=$this->createUrl('/infowizard/infowizardQuesansMapping/pageupdate/quesID/'.$apps['question_id'])?>"><span>Edit Answer</span></a>
	<?php } ?>
	</td>
			 </td></tr>                        
                    </thead>
					<tr><th></th></tr>

                    <tbody>
      <?php $rrr=InfowizardQuesansMappingController::getDetailOfQuesAns($apps['question_id']); 
	   $countno=1;

                foreach ($rrr as $key => $ans) {    
                    ?>
            
              <tr>  
              <td align="left" ><?php echo $ans['priority']; ?> &nbsp;&nbsp; 
			  <?php echo $ans['answer_detail']; ?></td>
              </tr>
                            
           <?php } ?>

                    </tbody>

                </table> <br /><br />
<?php }  }?>   
 
            </div>

        </div>

    </div>

</div>



</section><!--/.panel-->

