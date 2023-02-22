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
.addme{display: block;}
.removeme{display: none;}
</style>

<script type="text/javascript">

  //  var baseUrl = "{{ url('/') }}"

    </script>
<?php $sql="Select distinct exclude_question,question_id,queans_mapp_id,priority from bo_infowizard_quesans_mapping where exclude_question!=''";
        $connection=Yii::app()->db; 
        $command=$connection->createCommand($sql);
        $result = $command->queryAll();
     // echo "<pre>"; 
      $hg=array(); //print_r($result);die;
      foreach($result as $data){
          $hgs=$data['question_id']."-".$data['queans_mapp_id'];
          if(isset($hg["$hgs"])){ 
              $hg["$hgs"]=$hg["$hgs"].",".$data['exclude_question']; 
           }else{
            $hg["$hgs"]=  $data['exclude_question'];
          }
      }
     // print_r($hg);
?>
<div class="container">

<h5>Please answer below questions to get required State approvals for setting up & Starting of a business as per specific details of your Business..</h5>

<a style="float:right; margin-right:65px" href="<?php echo "http://".$_SERVER['HTTP_HOST'];?>/backoffice/infowizard/infowizardQuesansMapping/checkservice" class="btn btn-success">Reset</a>

<form id='questions-form' action="" method="POST">

<!--Question 1-->

		<?php
		//$Question = InfowizardQuestionMasterExt::getQuestionForInfoWizard();
		  $sql="select question_id,name from bo_infowizard_question_master where is_question_active='Y'";
		  $connection=Yii::app()->db; 
		  $command=$connection->createCommand($sql);
		  $Question=$command->queryAll();
        $count=1;
		foreach($Question as $que ){    ?>

		<table width="100%"  class="<?php echo $que['question_id']; ?> " id="<?php echo $que['question_id']; ?>">

		<tbody>

		<tr>



		<td align="left" id="<?php echo 'Q'.$que['question_id']; ?>"><?php echo 'Q'.$count++; ?></td>
                
		<td width="100%" align="left"><?php echo $que['name']; ?></td>



		</tr>

<?php $rrr=InfowizardQuesansMappingController::getDetailOfQuesAns($que['question_id']);  //print_r($rrr);
 $countno=1;
 ?>
 	<tr>
	<td align="left"></td>

        <td align="left"> 
		<?php 
 $i=0; $as=0; $jho=0;
      foreach ($rrr as $key => $ans) {  
          
          $gfd=$que['question_id']."-".$ans['queans_mapp_id']; 
if($key==0 && $ans['anscat_id']==1){ $jho=$key+1;?>	
<span><select name="selectservice_<?php echo $que['question_id']; ?>" id="selectservice_<?php echo $que['question_id']; ?>" class="form-control tb" >
<option  id="" value="0" >----Select----</option>
<option value="<?php echo $ans['queans_mapp_id']; ?>" typ="dropdown" rel ="<?php  echo @$hg["$gfd"]; ?>" id="<?php echo $que['question_id'].".".$jho; ?>" class="uii <?php echo $que['question_id'].".".$jho; ?> <?php  if(!empty($hg["$gfd"])){ ?> hideme<?php } ?>" >  <?php echo $ans['answer_detail']; ?></option>
<?php } ?>
<?php $i++;   if($ans['anscat_id']==1 && $key>0){  $jho=$key+1;//dropdown 
 $as=$ans['anscat_id']; ?>
<option value="<?php echo $ans['queans_mapp_id']; ?>" typ="dropdown"  rel ="<?php  echo @$hg["$gfd"]; ?>" id="<?php echo $que['question_id'].".".$jho; ?>" class="<?php echo $que['question_id'].".".$jho; ?> uii <?php if(!empty($hg["$gfd"])){ ?> hideme<?php } ?>" >  <?php echo  $ans['answer_detail']; ?></option>
<?php if(count($rrr)==$key+1){  ?> </select></span> <?php } ?>
<?php } ?>


<?php if($ans['anscat_id']==2){  $jho=$key+1;// radio ?>		
		<span><input type="radio" name="radioservice_<?php echo $que['question_id']; ?>"  typ="radio"  rel ="<?php  echo @$hg["$gfd"]; ?>" id="<?php echo $que['question_id'].".".$jho; ?>"  value="<?php echo $ans['queans_mapp_id']; ?>" class="<?php echo $que['question_id'].".".$jho; ?> uii <?php  if(!empty($hg["$gfd"])){ ?> hideme<?php } ?>"/>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ans['answer_detail']; ?><br/></span>
	<?php } ?>	
	
	
	<?php if($ans['anscat_id']==3){  $jho=$key+1; // checkbox ?>		
		<span><input type="checkbox" name="chkboxservice_<?php echo $que['question_id']; ?>[]"  typ="checkbox"  id="<?php echo $que['question_id'].".".$jho; ?>" rel ="<?php  echo @$hg["$gfd"]; ?>" value="<?php echo $ans['queans_mapp_id']; ?>" class="<?php echo $que['question_id'].".".$jho; ?> uii <?php  if(!empty($hg["$gfd"])){ ?> hideme<?php } ?>">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ans['answer_detail']; ?> <br/></span>
		
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

		<?php   }  ?>




<input  type="submit" value="submit">

</form>

</div>





<script>
$("document").ready(function(){     
$(".hideme").click(function(){
     var str=$(this).attr("rel");
     var str1=$(this).attr("typ");
     var res = str.split(",");
    $(this).closest('td').find('span').each(function(){
        if(str1=="checkbox")	{}else{	
		$(this).find('input').prop('disabled', true);
		} 
    });
     var i=0;
  for (i = 0; i < res.length; i++) { 
      var curr=res[i];
     $(".uii").each(function(e){
      //   alert($(this).attr('id'));
      if($(this).attr('id')==curr){
      $(this).hide();
      $(this).parent('span').addClass("removeme");
      console.log($(this).parent('span').html());
       }
      });      
      $(".tb option").each(function(){
            var currID=$(this).attr('id');
          if(currID==curr){
           $(this).addClass("removeme");      
        }
      });
      $("table").each(function(){   
          
         var currID1=$(this).attr('id');
          if(currID1==curr){
           $("#".curr).attr("rel","hidden1");
           $(this).addClass("removeme");     
        }
      });  
     }  
   //  arrangeQuestions();
});
 
});


function arrangeQuestions(){
  
    $("table").each(function(e){               
           if(!$(this).hasClass("removeme")){
        // alert($(this).closest('tr').html());
          }
      });  
    
}

 function arrangeQuesIndex(){   
       var qId = 0;
      var tableItem =  $('#questions-form').find('table');
       //  alert(tableItem.html());
      // alert(tableItem.length);
      for(var q = 0 ;q < tableItem.length;q++){ 
          alert('==');
          var item = tableItem[q]; 
          alert(tableItem[q].html());
          if(item.style.display!='none'){
              
              var pk = $(item);
              var dk = $(pk.find('tr')[0]);
             // alert();
              var sk = dk.find('td')[0];
              alert(sk.html());
              var qId = parseInt(qId)+1;
              sk.innerText='Q'+qId;
              sk.innerHtml='Q'+qId;              
          }
      }
   }

</script>

