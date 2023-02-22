<style>
.errorSummary { clear:red }
</style>
<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>Update Question and Answer</div>
    <div class='tools'>
	
	</div>
	
</div>
<div class="portlet-body">

<div class="site-min-height">
<div class="form form-horizontal" role="form">

            <form name="form" action="" method="POST">
<?php  if(!empty($Fields)) { ?>
			<div class="row">
	<div class="form-group col-md-12">
			<label class="col-lg-3 col-sm-3 control-label" for="application_name" >Question <?php echo $Fields[0]['question_id']; ?> :</label>
			<div class="col-md-8"><?php $question=InfowizardQuesansMappingController::getListofQuestion($Fields[0]['question_id']); ?> 
			<textarea name="questionID" disabled="disabled" class="form-control" ><?php echo $question['name']; ?></textarea>
 		   	</div></div></div>

			
			<div class="row">
	        <div class="form-group col-md-12">
			<label class="col-lg-3 col-sm-3 control-label" for="application_name" >Select Answer Category <span class="required">*</span></label>
			<div class="col-md-8">
		<select name="anscat_id" id="anscat_id" class="form-control" required >	<?php foreach($anscatdata as $r){ ?>
		<option value="<?php echo $r['anscat_id'];?>" <?php if($Fields[0]['anscat_id']==$r['anscat_id']) { echo "selected"; } ?> ><?php echo $r['name'];?></option>
		<?php }
		?></select>	
	</div></div></div>
	
	
<?php } foreach ($Fields as $key => $apps) {  ?>
         <div class="row">
	        <div class="form-group col-md-12">
			<label class="col-lg-3 col-sm-3 control-label" for="application_name" ><?php echo $apps['priority']; ?><span class="required">*</span></label>
			<div class="col-md-8"><input type="text" name="answer[]" value="<?php echo $apps['answer_detail']; ?>" class="form-control" required />
			<input type="hidden" name="queans_mapp_id[]" value="<?php echo $apps['queans_mapp_id']; ?>" class="form-control" />
			</div></div></div>
  <?php } ?>     
		
		
		<div class="row">
		<div class="form-group col-md-12">
			<label class="col-lg-3 col-sm-3 control-label" for="application_name" >
			Add Answers <span class="required">*</span></label>
                   
		<div class="col-lg-8 col-sm-8 input_fields" >
        <div><input type="text" name="answer[]" size="70px" style="margin-bottom:10px;"  />&nbsp;&nbsp;&nbsp;<button class="add_button" style="margin-bottom:10px; float:right; ">Add</button></div>
	    </div>
			
                                  
 
			<script>
		$(document).ready(function() {
    var max_fields      = 100; //maximum input boxes allowed
    var wrapper         = $(".input_fields"); //Fields wrapper
    var add_button      = $(".add_button"); //Add button ID
   
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input type="text" name="answer[]" size="70px" style="margin-bottom:10px;" required />&nbsp;&nbsp;&nbsp;<a href="#" class="remove_field" style="margin-bottom:10px; float:right;">Remove</a></div>'); //add input box
        }
    });
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});

</script>
			</div></div>            
                                
    <div class="row">
	<div class="form-group col-md-12">
	<label class="col-lg-3 col-sm-3 control-label" for="application_name" >Is Active ? <span class="required">*</span></label>
			<div class="col-md-8">
		<select name="is_quesans_active" required >
		<option value="Y">Y</option>
		<option value="N">N</option>
		</select>
	</div></div></div>
	
	          
    <div class="row buttons" align="center">
	<input type="submit" value="Save" class="btn btn-primary" >
	</div>          
                
                
            </form>
       </div></div></div></div><!-- form -->
