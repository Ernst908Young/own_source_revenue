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

<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>View Service Master Detail</div>
 
	
</div>
<div class="portlet-body">

<div class="site-min-height">
<div class="form form-horizontal" role="form">



<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label  class="col-lg-6 col-sm-6 control-label" >Service Master Id :</label></div>
	<div class="col-md-6">
	<?php //echo $form->error($model,'chklist_id'); 
	echo $model->id; ?>
	</div>
	</div>
</div>
<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Service Incidence :</label></div>
	<div class="col-md-6">
	<?php //echo $form->error($model,'chklist_id'); 
        if($model->incidence_pre_establishment=="1") { echo "Pre Establishment ";  
		if($model->incidence_pre_operation=="1" || $model->incidence_post_operation=="1") echo " ,"; } 
        if($model->incidence_pre_operation=="1") { echo "Pre Operation  ,";  
		if( $model->incidence_post_operation=="1") echo " ,"; } 
        if($model->incidence_post_operation=="1") {echo "Post Operation ";  }?> 
	</div>
	</div>
</div>
    
    <div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Service Sector :</label></div>
	<div class="col-md-6">
	<?php   $sector=explode(',',$model->service_sector); $aa=count($sector); for($i=0; $i<$aa ;$i++) { //echo $sector[$i]; }
				 $sectorname=serviceMasterController::getNameOfSeviceSector($sector[$i]); echo $sectorname['name']; if($i!=($aa-1)) echo " ,"; }?>
	</div>
	</div>
</div>
    
<!--<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Service Type</label></div>
	<div class="col-md-6">
	<?php echo $model->service_type;?>
	</div>
	</div>
</div>
	
<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Additional Sub Service</label></div>
	<div class="col-md-6">
	<?php echo $model->additional_sub_service  ;?>
	</div>
	</div>
</div>

<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Periodic Inspection</label></div>
	<div class="col-md-6">
	<?php echo $model->periodic_inspection ;?>
	</div>
	</div>
</div>
	
<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Checklist Periodic Inspection</label></div>
	<div class="col-md-6">
	<?php echo $model->checklist_periodic_inspection ; ?>
	</div>
	</div>
</div>
	
-->
<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-6">
	<label class="col-lg-6 col-sm-6 control-label" >Created :</label></div>
	<div class="col-md-6">
	<?php //echo $form->error($model,'chklist_id'); 
	echo $model->created; ?>
	</div>
	</div>
</div>



<div class="row">
	<div class="form-group col-md-12">
	<div class="col-md-12" style="margin-left:10px">
<?php
              if(empty($data)){
                echo "<label class='col-lg-6 col-sm-6 control-label'><b>No Question Answer Available</b></label>";

              }
              else{
                $count=0;
                foreach ($data as $key => $ques) { $count++;
                    ?>
<table cellpadding="0" cellspacing="0" border="0" class="gridtabledoc1" >

                    <thead>

             <tr><td colspan="8">Q<?php echo $count; ?> > <?php echo $key;  ?> 
			 </td></tr>                        
                    </thead>
					<tr><th></th></tr>

                    <tbody>
      <?php 
	   $countno=1;  foreach ($ques as $key => $quesanswer) {
                    ?>
            
              <tr>  
              <td align="left" ><?php echo $count.'.'.$countno++; ?>  >
			  <?php echo $quesanswer['answer_detail'];?></td>
              </tr>
                            
           <?php } ?>

                    </tbody>

                </table> <br /><br />
<?php }  }?>
</div></div></div>


 <div class="row buttons" align="center">
		<a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('/infowizard/serviceMaster/listservicepage/')?>"><span>View list of Services</span></a>
		<a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('/infowizard/serviceMaster/servicepage/')?>"><span>Add New Services</span></a>
    </div>

</div></div></div></div>