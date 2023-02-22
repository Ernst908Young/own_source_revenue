<style>

.services-result{

	margin: 20px 0;

}

th {

    background: #444;

    color: #fff;

    padding: 10px;

}

.app{

	margin: 20px auto;

}

tr:nth-child(odd), #comments li:nth-child(odd) {

    color: #000;

    background-color: #FFFFFF;

}

tr, #comments li, #comments input[type="submit"], #comments input[type="reset"] {

    color: #000;

    background-color: #EAEEF2;

}

tr:nth-child(odd), #comments li:nth-child(odd) {

    color: #000;

    background-color: #FFFFFF;

}

table, th, td, #comments .avatar, #comments input, #comments textarea {

    border-color: #D7D7D7;

}

table {

    width: 100%;

    margin-bottom: 15px;

}

table, th, td {

    border: 1px solid #D7D7D7;

    border-collapse: collapse;

    vertical-align: top;

    box-sizing: border-box;

}

th, td {

    padding: 5px 8px;

}

table, th, td {

    border: 1px solid #D7D7D7;

    border-collapse: collapse;

    vertical-align: top;

    box-sizing: border-box;

}

.head{

	background: #eee;

	padding: 10px;

	color: #FFF;

}

</style>



<div class="container">

<h5>Please answer below questions to get required State approvals for setting up & Starting of a business as per specific details of your Business..</h5>
<div align="right"> <input type="button" value="Refresh Page" onClick="window.location.reload()"></div>


<form id='questions-form' action="" method="POST">

<!--Question 1-->

		<?php 
		$Question = InfowizardQuestionMasterExt::getQuestionForInfoWizard();
        //print_r($Question);
		foreach($Question as $que ){    ?>

		<table width="100%" id="a1_1"class="<?php echo $que['question_id']; ?>">

		<tbody>

		<tr>
               <td align="left"><?php echo 'Q'.$que['question_id']; ?></td>

		<td width="100%" align="left"><?php echo $que['name']; ?></td>
               </tr>

<?php $rrr=InfowizardQuesansMappingController::getDetailOfQuesAns($que['question_id']); //echo'<pre/>';print_r($rrr);
 //print_r(count($rrr));  
 ?>
 	<tr class="<?php echo $que['question_id'].'_'.$que['question_id']; ?>">
	<td align="left"></td>

		<td align="left">
		<?php 
 $i=0; $as=0;$count=0;
      foreach ($rrr as $key => $ans) { 
         
         
         
if($key==0 && $ans['anscat_id']==1){ ?>	
<select name="selectservice_<?php echo $que['question_id']; ?>" id="selectservice_<?php echo $que['question_id']; ?>" class="form-control" >
<option  id="" value="0" >----Select----</option>
<option id="<?php echo $ans['queans_mapp_id']; ?>" class="<?php echo $que['question_id'].'.'.$ans['queans_mapp_id']; ?>"  value="<?php echo $ans['queans_mapp_id']; ?>"><?php echo $ans['answer_detail']; ?></option>
<?php } ?>

<?php $i++;   if($ans['anscat_id']==1 && $key>0){  $as=$ans['anscat_id']; ?>
<option id="<?php echo $ans['queans_mapp_id']; ?>" class="<?php echo $que['question_id'].'.'.$ans['queans_mapp_id']; ?>" value="<?php echo $ans['queans_mapp_id']; ?>"><?php echo  $ans['answer_detail']; ?></option>
<?php if(count($rrr)==$key+1){  ?> </select> <?php } ?>
<?php } ?>


<?php if($ans['anscat_id']==2){ // radio ?>
                 <label class="<?php echo $que['question_id'].'.'.$ans['queans_mapp_id']; ?>">   
		<input type="radio" name="radioservice_<?php echo $que['question_id']; ?>"  value="<?php echo $ans['queans_mapp_id']; ?>" >
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ans['answer_detail']; ?></input><br />
                 </label><br>
	<?php } ?>	
	
	<?php if($ans['anscat_id']==3){ // checkbox ?>
                <label class="<?php echo $que['question_id'].'.'.$ans['queans_mapp_id']; ?>"> 
		<input type="checkbox" name="chkboxservice_<?php echo $que['question_id']; ?>[]"  value="<?php echo $ans['queans_mapp_id']; ?>" />
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ans['answer_detail']; ?> </input><br />
                </label> <br>
	<?php } ?>	
	
	<?php /*?><?php if($ans['anscat_id']==4){ // multiselect ?>		
		<input type="checkbox" name="multiselectservice[]" value="<?php echo $apps['question_id'].','.$ans['queans_mapp_id']; ?>" />
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ans['answer_detail']; ?><br />
	<?php } ?>
<?php */?>
		
		<?php }  ?>
		</td>



		</tr>
		
	

		<tr><th colspan="3"></th></tr>

		</tbody>

		</table>

		<?php   } 
               //echo '<pre/>'; print_r($datas);
                //echo '<pre/>'; print_r($include);?>





<input  type="submit" value="submit">

</form>

</div>





<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.js"></script>


<script>

$(document).ready(function(){
$('input').change(function() 
{
    var  arrayFromPHP = <?php echo json_encode($datas); ?>;
    
    var elementItem = $(this)[0].parentElement.className;
    
   for (var i = 0;i<arrayFromPHP.length;i++){
       if(elementItem == arrayFromPHP[i]['val']){  
           
           
           var excludeItem = arrayFromPHP[i]["exclude_question"];
           if(excludeItem){
           var excludeArray = excludeItem.split(',');
      $(this).closest('table').find('input').prop('disabled', true); 
           for(var p = 0 ;p<excludeArray.length;p++){
               var hItms = excludeArray[p];               
               var pk  = $('.'+hItms)[0];
              var pk= document.getElementsByClassName(hItms)[0];
               if(pk){debugger;
               pk.style.display='none';
            }
           }
       }
           
           
       }
   }
   var  arrangeQuesIndex  = function(){
       var qId = 0;
      var tableItem =  $('#questions-form').find('table');
      for(var q = 0 ;q < tableItem.length;q++){
          
          var item = tableItem[q]; 
          if(item.style.display!='none'){
              var pk = $(item);
              var dk = $(pk.find('tr')[0]);
              var sk = dk.find('td')[0];
              var qId = parseInt(qId)+1;
              sk.innerText='Q'+qId;
              sk.innerHtml='Q'+qId;
              
          }
      }
   }
   arrangeQuesIndex();
    

}
);

}
);

</script>