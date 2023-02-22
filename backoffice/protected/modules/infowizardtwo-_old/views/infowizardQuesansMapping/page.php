<style>
.errorSummary { clear:red }
</style>
<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>Create Question and Answer</div>
    <div class='tools'>
	
	</div>
	
</div>
<div class="portlet-body">

<div class="site-min-height">
<div class="form form-horizontal" role="form">

            <form name="" action="" method="POST">

			<div class="row">
	<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" > Select Question <span class="required">*</span></label>
			<div class="col-md-8">
			<select name="question_id" id="question_id" class="form-control" required >	<?php foreach($questiondata as $que){ ?>
		<option value="<?php echo $que['question_id'];?>"><?php echo $que['name'];?></option>
		<?php }
		?></select>	
        
	</div></div></div>

			
			<div class="row">
	        <div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Select Answer Category <span class="required">*</span></label>
			<div class="col-md-8">
		<select name="anscat_id" id="anscat_id" class="form-control" required>	<?php foreach($anscatdata as $r){ ?>
		<option value="<?php echo $r['anscat_id'];?>"><?php echo $r['name'];?></option>
		<?php }
		?></select>	
	</div></div></div>

                
		<div class="row">
		<div class="form-group col-md-6">
			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >
			Add Answers <span class="required">*</span></label>
                   
		<div class="col-lg-8 col-sm-8 input_fields" >
        <div><input type="text" name="answer[]" required/><?php echo "  "; ?><button class="add_button">Add</button></div>
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
            $(wrapper).append('<div><input type="text" name="answer[]" required/><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});

</script>
			</div></div>            
                                
    <div class="row">
	<div class="form-group col-md-6">
	<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Is Active ? <span class="required">*</span></label>
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
