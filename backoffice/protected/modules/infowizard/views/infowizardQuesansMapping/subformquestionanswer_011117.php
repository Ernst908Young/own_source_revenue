



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

<form name="" action="" method="POST">
           <?php print_r($apps);
            if(empty($apps)){

                echo "No Detail Found"; }

              else{

                $count=0;

                foreach ($apps as $key => $apps) {    $count++;
                    ?>
                <table cellpadding="0" cellspacing="0" border="0" class="gridtabledoc1" >

                    <thead>

             <tr><td colspan="8">Q<?php echo $count; ?> > <?php $question=InfowizardQuesansMappingController::getListofQuestion($apps['question_id']); echo $question['name'];?> 
			 </td></tr>                        
                    </thead>
					<tr><th></th></tr>

                    <tbody>
      <?php $rrr=InfowizardQuesansMappingController::getDetailOfQuesAns($apps['question_id']); 
	   $countno=1;

                foreach ($rrr as $key => $ans) {    
                    ?>
            
              <tr>  
              <td align="left" ><?php echo $count.'.'.$countno++; ?>  >&nbsp;&nbsp;
			  <input type="checkbox" name="chkboxservice[]" value="<?php echo $apps['question_id'].','.$ans['queans_mapp_id']; ?>" />
			  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ans['answer_detail']; 
			   ?>
			   </td>
              </tr>
                            
           <?php } ?>

                    </tbody>

                </table> <br /><br />
<?php } }?>  
<div class="row buttons" align="center">
	<input type="submit" value="Save" class="btn btn-primary" >
	</div>          
                
                
            </form> 
<div class="row buttons" align="center">
        <?php //echo CHtml::submitButton('Back',array('class'=>'btn btn-primary','onclick'=>'window.history.back()')); 
        //history.go(-1) ?>
    </div>  
            </div>

        </div>

    </div>

</div>



</section><!--/.panel-->

