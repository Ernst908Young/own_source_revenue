<?php
$base=Yii::app()->theme->baseUrl;
?>

<style>

select[multiple], select[size] {
    height: 500px;
    width: 323px;
    }
    .tr1
    {
    	background-color: "#FF0000";
    }
    select {
  font-size: 20px;
  font-family: 'Averia Libre', cursive;
}
.selectClass {
   font-size: 18px;
   font-family: 'Averia Libre', cursive;
}​
</style>
<link href="<?=$base?>/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
<link href="<?=$base?>/assets/global/plugins/jquery-multi-select/css/multi-select.css" rel="stylesheet" type="text/css" />
<link href="<?=$base?>/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="<?=$base?>/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />	
 <div class="portlet-body form">
     <!-- BEGIN FORM-->
    <form action="<?php Yii::app()->createAbsoluteUrl('admin/sendSMS')?>" method="POST" class="form-horizontal form-row-seperated">
 <?php
        	    	$sql="SELECT DISTINCT CONCAT(full_name,'-',mobile) AS opval, mobile FROM bo_user";
                    $connection=Yii::app()->db; 
                    $command=$connection->createCommand($sql);
                    $users=$command->queryAll();
        	    ?>


    <table border="1" width="100%">
    <tr>
    <td class="bg-blue-madison bg-font-blue-madison" colspan="4" align="center"><h4><b>SEND SMS</b></h4></td></tr>
    <tr>
    	<td width="25%">
  
		    	       		<select class='form-control txt  MasterSelectBox' multiple>
		    	            	<?php
		    	            		foreach ($users as $key => $user) {
		    	            			echo '<option value="'.$user['mobile'].'">'.$user['opval'].'</option>';
		    	            		}
		    	            	?>
		    	            </select>
		    	            </td>
		    	            <td width="5%" align="center">
			    	            <a href='#' class='btn btn-default btn_select' id='btnAdd'><b>></b></a>
			                    <a href='#' class='btn btn-default btn_select' id='btnRemove'><</a>
			                    </td>
			               <td width="25%">
	                    	<select class='PairedSelectBox' required multiple  name="SendSMS[selectedUser][]" style='min-width: 200px;float:left;'>
	                       </select>


    	</td>
    	<td valign="top" align="top">
    	</br>
    		
<table border="1" width="100%" valign="top" align="top">

<tr>
<td class="bg-blue-madison bg-font-blue-madison" align="center"><h5><b>Other Mobile Number</b></h5></td>
</tr>
<tr>
<td><textarea id="" class="form-control" maxlength="300" rows="8" name="SendSMS[otherNumber]" placeholder="Please enter 10 digits mobile numbers separated by commas"></textarea>
<span class="help-block"><i>Separated by comma(,)</i></span></td>
</tr>

<tr>
<td></br></br></td>
</tr>

<tr>
<td class="bg-blue-madison bg-font-blue-madison" align="center"><h5><b>Message Template</b></h5></td>
</tr>
<tr>
<td><textarea id="maxlength_textarea" class="form-control" maxlength="160" rows="5" name="SendSMS[sms]" placeholder="This textarea has a limit of 160 chars."></textarea>
        	        <span class="help-block">Max Length would be 160 Characters</span></td>
</tr>


</table>


    	</td>
    </tr>
    <tr>
<td colspan="4" align="right"><input type="submit" class="btn btn-primary"></td>
    </tr>
    	


</table>

       
    </form>
 </div>
<script src="<?=$base?>/assets/global/scripts/pair-select.min.js" type="text/javascript"></script>
<script src="<?=$base?>/assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
<script src="<?=$base?>/assets/pages/scripts/components-bootstrap-maxlength.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$('.MasterSelectBox').pairMaster();

   $('#btnAdd').click(function(){
     $('.MasterSelectBox').addSelected('.PairedSelectBox');
   });

   $('#btnRemove').click(function(){
     $('.PairedSelectBox').removeSelected('.MasterSelectBox'); 
   });
</script>



