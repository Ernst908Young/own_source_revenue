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

<script type="text/javascript">

  //  var baseUrl = "{{ url('/') }}"

    </script>

<div class="container">

<h5>Please answer below questions to get required State approvals for setting up & Starting of a business as per specific details of your Business..</h5>



<form id='questions-form' action="" method="POST">

<!--Question 1-->

		<?php 
		$Question = InfowizardQuestionMasterExt::getQuestionForInfoWizard();
        //print_r($Question);
		foreach($Question as $que ){    ?>

		<table width="100%" id="a1_1">

		<tbody>

		<tr>
               <td align="left"><?php echo 'Q'.$que['question_id']; ?></td>

		<td width="100%" align="left"><?php echo $que['name']; ?></td>
               </tr>

<?php $rrr=InfowizardQuesansMappingController::getDetailOfQuesAns($que['question_id']); //echo'<pre/>';print_r($rrr);
 //print_r(count($rrr));  
 ?>
 	<tr >
	<td align="left"></td>

		<td align="left">
		<?php 
 $i=0; $as=0;$count=0;
      foreach ($rrr as $key => $ans) { 
         
         
         
if($key==0 && $ans['anscat_id']==1){ ?>	
<select name="selectservice_<?php echo $que['question_id']; ?>" id="selectservice_<?php echo $que['question_id']; ?>" class="form-control" >
<option  id="" value="0" >----Select----</option>
<option id="<?php echo $ans['queans_mapp_id']; ?>"   value="<?php echo $ans['queans_mapp_id']; ?>"><?php echo $ans['answer_detail']; ?></option>
<?php } ?>

<?php $i++;   if($ans['anscat_id']==1 && $key>0){  $as=$ans['anscat_id']; ?>
<option id="<?php echo $ans['queans_mapp_id']; ?>" value="<?php echo $ans['queans_mapp_id']; ?>"><?php echo  $ans['answer_detail']; ?></option>
<?php if(count($rrr)==$key+1){  ?> </select> <?php } ?>
<?php } ?>


<?php if($ans['anscat_id']==2){ // radio ?>
                  
		<input type="radio" name="radioservice_<?php echo $que['question_id']; ?>"  value="<?php echo $ans['queans_mapp_id']; ?>" >
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ans['answer_detail']; ?></input><br />
                
	<?php } ?>	
	
	<?php if($ans['anscat_id']==3){ // checkbox ?>
                
		<input type="checkbox" name="chkboxservice_<?php echo $que['question_id']; ?>[]"  value="<?php echo $ans['queans_mapp_id']; ?>" />
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $ans['answer_detail']; ?> </input><br />
             
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
             ?>




<input  type="submit" value="submit">

</form>

</div>





<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.js"></script>


<script>

$("#question26").change(function () {

    $("#question21").prop('disabled', $(this).prop("checked"));

    $("#question21").removeAttr('checked', $(this).prop("checked"));

    $("#question22").prop('disabled', $(this).prop("checked"));

    $("#question22").removeAttr('checked', $(this).prop("checked"));

    $("#question23").prop('disabled', $(this).prop("checked"));

    $("#question23").removeAttr('checked', $(this).prop("checked"));

    $("#question24").prop('disabled', $(this).prop("checked"));

    $("#question24").removeAttr('checked', $(this).prop("checked"));

    $("#question25").prop('disabled', $(this).prop("checked"));

    $("#question25").removeAttr('checked', $(this).prop("checked"));

    $("#question26").attr('disabled', false); //disable



});





$("#question31").change(function () {

    $("#question27").prop('disabled', $(this).prop("checked"));

    $("#question27").removeAttr('checked', $(this).prop("checked"));

    $("#question28").prop('disabled', $(this).prop("checked"));

    $("#question28").removeAttr('checked', $(this).prop("checked"));

    $("#question29").prop('disabled', $(this).prop("checked"));

    $("#question29").removeAttr('checked', $(this).prop("checked"));

    $("#question30").prop('disabled', $(this).prop("checked"));

    $("#question30").removeAttr('checked', $(this).prop("checked"));

    $("#question31").attr('disabled', false); //disable



});





$("#question40").change(function () {

    $("#question32").prop('disabled', $(this).prop("checked"));

    $("#question32").removeAttr('checked', $(this).prop("checked"));

    $("#question33").prop('disabled', $(this).prop("checked"));

    $("#question33").removeAttr('checked', $(this).prop("checked"));

    $("#question34").prop('disabled', $(this).prop("checked"));

    $("#question34").removeAttr('checked', $(this).prop("checked"));

    $("#question35").prop('disabled', $(this).prop("checked"));

    $("#question35").removeAttr('checked', $(this).prop("checked"));

    $("#question36").prop('disabled', $(this).prop("checked"));

    $("#question36").removeAttr('checked', $(this).prop("checked"));

    $("#question37").prop('disabled', $(this).prop("checked"));

    $("#question37").removeAttr('checked', $(this).prop("checked"));

    $("#question38").prop('disabled', $(this).prop("checked"));

    $("#question38").removeAttr('checked', $(this).prop("checked"));

    $("#question39").prop('disabled', $(this).prop("checked"));

    $("#question39").removeAttr('checked', $(this).prop("checked"));

    $("#question40").attr('disabled', false); //disable



});



$("#question47").change(function () {

    $("#question41").prop('disabled', $(this).prop("checked"));

    $("#question41").removeAttr('checked', $(this).prop("checked"));

    $("#question42").prop('disabled', $(this).prop("checked"));

    $("#question42").removeAttr('checked', $(this).prop("checked"));

    $("#question43").prop('disabled', $(this).prop("checked"));

    $("#question43").removeAttr('checked', $(this).prop("checked"));

    $("#question44").prop('disabled', $(this).prop("checked"));

    $("#question44").removeAttr('checked', $(this).prop("checked"));

    $("#question45").prop('disabled', $(this).prop("checked"));

    $("#question45").removeAttr('checked', $(this).prop("checked"));

    $("#question46").prop('disabled', $(this).prop("checked"));

    $("#question46").removeAttr('checked', $(this).prop("checked"));

    $("#question47").attr('disabled', false); //disable



});



$("#question54").change(function () {

    $("#question48").prop('disabled', $(this).prop("checked"));

    $("#question48").removeAttr('checked', $(this).prop("checked"));

    $("#question49").prop('disabled', $(this).prop("checked"));

    $("#question49").removeAttr('checked', $(this).prop("checked"));

    $("#question50").prop('disabled', $(this).prop("checked"));

    $("#question50").removeAttr('checked', $(this).prop("checked"));

    $("#question51").prop('disabled', $(this).prop("checked"));

    $("#question51").removeAttr('checked', $(this).prop("checked"));

    $("#question52").prop('disabled', $(this).prop("checked"));

    $("#question52").removeAttr('checked', $(this).prop("checked"));

    $("#question53").prop('disabled', $(this).prop("checked"));

    $("#question53").removeAttr('checked', $(this).prop("checked"));

    $("#question54").attr('disabled', false); //disable



});



$("#question60").change(function () {

    $("#question55").prop('disabled', $(this).prop("checked"));

    $("#question55").removeAttr('checked', $(this).prop("checked"));

    $("#question56").prop('disabled', $(this).prop("checked"));

    $("#question56").removeAttr('checked', $(this).prop("checked"));

    $("#question57").prop('disabled', $(this).prop("checked"));

    $("#question57").removeAttr('checked', $(this).prop("checked"));

    $("#question58").prop('disabled', $(this).prop("checked"));

    $("#question58").removeAttr('checked', $(this).prop("checked"));

    $("#question59").prop('disabled', $(this).prop("checked"));

    $("#question59").removeAttr('checked', $(this).prop("checked"));

    $("#question60").attr('disabled', false); //disable



});



$("#question64").change(function () {

    $("#question61").prop('disabled', $(this).prop("checked"));

    $("#question61").removeAttr('checked', $(this).prop("checked"));

    $("#question62").prop('disabled', $(this).prop("checked"));

    $("#question62").removeAttr('checked', $(this).prop("checked"));

    $("#question63").prop('disabled', $(this).prop("checked"));

    $("#question63").removeAttr('checked', $(this).prop("checked"));

    $("#question64").attr('disabled', false); //disable



});



$("#question87").change(function () {

    $("#question85").prop('disabled', $(this).prop("checked"));

    $("#question85").removeAttr('checked', $(this).prop("checked"));

    $("#question86").prop('disabled', $(this).prop("checked"));

    $("#question86").removeAttr('checked', $(this).prop("checked"));

    $("#question87").attr('disabled', false); //disable



});









$("#questiones10").change(function(){

	var val=$("#questiones10").val();

	$('input:radio').removeAttr('checked');



	if(val==13){

		

		$("#question16").attr('checked', true);

		$("#question16").removeAttr('disabled', false);

		$("#question17").attr('disabled', true);

		$("#question17").removeAttr('checked', false);

		$("#question16").attr('checked', true);

		$("#question18").attr('disabled', true);

		$("#question19").attr('disabled', true);

		$("#question20").attr('disabled', true);

		$("#question21").attr('disabled', true);

		$("#question22").attr('disabled', true);

		



	}



	if(val==14){

		

		$("#question17").attr('checked', true);

		$("#question17").removeAttr('disabled', false);

		$("#question16").attr('disabled', true);

		$("#question16").removeAttr('checked', false);

		$("#question17").attr('checked', true);

		$("#question18").attr('disabled', true);

		$("#question19").attr('disabled', true);

		$("#question20").attr('disabled', true);

		$("#question21").attr('disabled', true);

		$("#question22").attr('disabled', true);

		



	}



	if(val==15){



		$("#question16").removeAttr('checked', false);

		$("#question17").removeAttr('checked', false);

		$("#question16").attr('disabled', false);

		$("#question17").attr('disabled', false);

		$("#question18").attr('disabled', false);

		$("#question19").attr('disabled', false);

		$("#question20").attr('disabled', false);

		$("#question21").attr('disabled', false);

		$("#question22").attr('disabled', false);



	}



	if(val==12){



		$("#question16").removeAttr('checked', false);

		$("#question17").removeAttr('checked', false);

		$("#question16").attr('disabled', false);

		$("#question17").attr('disabled', false);

		$("#question18").attr('disabled', false);

		$("#question19").attr('disabled', false);

		$("#question20").attr('disabled', false);

		$("#question21").attr('disabled', false);

		$("#question22").attr('disabled', false);



	}



	if(val==11){



		$("#question16").removeAttr('checked', false);

		$("#question17").removeAttr('checked', false);

		$("#question16").attr('disabled', false);

		$("#question17").attr('disabled', false);

		$("#question18").attr('disabled', false);

		$("#question19").attr('disabled', false);

		$("#question20").attr('disabled', false);

		$("#question21").attr('disabled', false);

		$("#question22").attr('disabled', false);



	}

   

});



$("document").ready(function(){

$('#Cat_ID').on('change', function(e){



    //alert('hi');



  console.log(e);

  var Cat_ID = e.target.value;



  //ajax

  $.get('/investuttarakhand/servicesapp/answermaster/?Cat_ID='+ Cat_ID, function(data){



    alert(Cat_ID);

    //success data

    $('#Ans_ID').empty();

    $.each(data, function(index, ansObj){



      $('#Ans_ID').append('<option value=" '+AnsObj.Asn_ID+' ">'+AnsObj.Ans_Text+'</option>');



    });



  });



});

});//end of document ready function







</script>

