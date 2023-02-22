<style type="text/css">
   #heading{
   background-color: #006699;
   text-align: center;
   color:#fff;
   padding-top: 7px;
   padding-bottom: 7px;
   margin-bottom: 20px;
   margin-top: 23px;
   }
</style>
<div class="site-min-height">
   <div class="panel">
      <div class="panel-heading">
         <strong> Welcome::<?php echo $dept['department_name']. " : " .$app['name'] ;?></strong>
      </div>
      <div class="panel-body">
      <?php 
      $val_cnt=1;

      // validation counts
      // echo "<pre>"; print_r($errors); die("here");
      foreach ($dept_field as $field_validation) {
        echo "<input type='hidden' id='validation_$val_cnt' value='$field_validation[filed_type]#$field_validation[field_name]'>";
        $val_cnt++;
      }
      echo"<input type='hidden' id='field_count' value='".count($dept_field)."'>";
      // validation counts End
    echo "<div class='row-fluid'>";
               foreach(Yii::app()->user->getFlashes() as $key => $message) {
                 echo "<div class='panel-heading alert-danger'>$message</div>";
               } 
    echo "</div>";

      if(!$isUpdate) 
        echo "<form method='post' class='form_validate' enctype='multipart/form-data' action='".Yii::app()->createUrl('frontuser/application_form/submitapplication')."'>";
      else
        echo "<form method='post' class='form_validate'  enctype='multipart/form-data' action='".Yii::app()->createUrl('frontuser/application_form/updateapplication')."'>";
      ?>
            <input type="hidden" name="ManageApplication[application_id]" value="<?php echo $app['id'];?>">
            <input type="hidden" name="ManageApplication[dept_id]" value="<?php echo $dept['dept_id'];?>">
            <input type="hidden" name="ManageApplication[user_id]" value="<?php echo @$pre_field['user_id'];?>">
            <?php 
               $appModel= new ApplicationExt;
               $appDetail= $appModel->getApplicationDetail($app['id']);
               if($appDetail['is_custom_css']==='Y')
               	echo "<style type='text/css'>$appDetail[custom_css_val]</style>";
                	if($appDetail['show_default_fields']===false)
                		 echo "<div style='display:none'>";
               /*			 	else{
                			 echo "<div>";
                			echo "<div class='row'>";
                			if(isset($appDetail['show_default_fields']) && !empty($appDetail['show_default_fields'])){
               			 			foreach (json_decode($appDetail['show_default_fields']) as $prefield) {
               		 				echo "
               		 					<div class='col-md-6'>
               		 						<div class='control-group'>	
               		 								<label class='control-label' class='pre_load_field'>".ucwords(str_replace('_', ' ', $prefield)). "</label>
               		 							<div class='controls'>
               		 								<input readonly class='form-control' name='ApplicationField[$prefield] id='full_name' value='".$pre_field[$prefield]."'";
               
               		 								echo"type='text'  />	
               		 							</div>
               		 						</div>	
               		 					</div>	
               		 				";
               		 			}						 				
                			}
               
                			echo "</div>";
                	}*/
               
               ?>
      <div class="row">&nbsp;</div>	
      <!-- <div id="heading">&nbsp;</div> -->
      <div class="row">
      <?php 
      $preVal='';
      if($isUpdate){
        $preVal= json_decode($subVal);
        echo "<input type='hidden' name='ManageApplication[submition_id]' value='".$subId."'>";
        }

        // echo "<pre>";print_r($_SESSION);die;
         $sep_count=1;
         foreach ($dept_field as $dept_field) {
         	if($dept_field['filed_type']=='separator'){
         		if($sep_count%2!=0){
         			echo "<div class='col-md-6'>&nbsp;</div>
         			<div class='row'>&nbsp;</div>";
         		}
         		echo "<div class='row'>&nbsp;</div><div id='heading'>".@$dept_field['field_value']."</div>";
         			  
         	}
         	if(($dept_field['filed_type']==='text')||($dept_field['filed_type']==='email') ||($dept_field['filed_type']==='password')||($dept_field['filed_type']==='file')||($dept_field['filed_type']==='number') || ($dept_field['filed_type']==='date')){
         		echo "
         				<div class='col-md-6'>
         					<div class='control-group'>
         						<label class='control-label'>$dept_field[field_value]</label>
         						<div class='controls'>
         						  
         						<input class='form-control ".@$dept_field['field_class']."' required name='ApplicationField[".$dept_field['field_name']."]' value='";
                      if($isUpdate)
                          echo $preVal->$dept_field['field_name'];
                    echo "' id='".$dept_field['field_name']."' type='".$dept_field['filed_type']."' placeholder='".$dept_field['field_value']."'";
                    if(!empty($dept_field['field_max_length']))
                        echo "maxlength='$dept_field[field_max_length]'";

                    if(!empty($dept_field['field_size']))
                        echo "size='$dept_field[field_size]'";

                    echo "/>
         						</div>
         					</div>
         				</div>
         			  ";
         	}
          if($dept_field['filed_type']==='textarea'){
                echo "
                    <div class='col-md-6'>
                      <div class='control-group'>
                        <label class='control-label'>$dept_field[field_value]</label>
                        <div class='controls'>
                          
                        <textarea class='form-control ".@$dept_field['field_class']."' required name='ApplicationField[".$dept_field['field_name']."]' value='";
                      if($isUpdate){
                          echo $prefield->$dept_field['field_name'];
                      }
                      echo "' id='".$dept_field['field_name']."' type='".$dept_field['filed_type']."' placeholder='".$dept_field['field_value']."'";
                       if(!empty($dept_field['field_max_length']))
                           echo "maxlength='$dept_field[field_max_length]'";

                       if(!empty($dept_field['field_size']))
                           echo "size='$dept_field[field_size]'";

                       echo ">";
                      if($isUpdate){
                          echo $preVal->$dept_field['field_name'];
                      } 
                    echo "</textarea>
                        </div>
                      </div>
                    </div>
                    ";
          }
          if($dept_field['filed_type']==='button'){
              if($sep_count%2!=0){
                  echo "<div class='col-md-6'>&nbsp;</div>
                  <div class='row'>&nbsp;</div>";
              }
                echo "<div class='row'>&nbsp;</div>";
                echo "<div id='heading'>".@$dept_field['field_onclick_field_placeholder']."</div>";
                  echo "
                      <div class='col-md-12'>
                        <div class='control-group'>
                          <label class='control-label'>&nbsp;</label>
                          <div class='controls'>
                          <input class='btn btn-default ".@$dept_field['field_class']."'";
                          if(!empty($dept_field['field_onclick']))
                            echo "onclick='".$dept_field['field_onclick']."(";
                              if(!empty($dept_field['field_onclick_field_name']))
                                echo "\"".$dept_field['field_onclick_field_name']."\",";
                              if(!empty($dept_field['field_onclick_field_placeholder']))
                                echo "\"".$dept_field['field_onclick_field_placeholder']."\",";
                              if(!empty($dept_field['field_onclick_add_no_fields']))
                                echo $dept_field['field_onclick_add_no_fields'];
                            echo ")'";

                           echo "id='btAdd' name='ApplicationField[".$dept_field['field_name']."]' value='".$dept_field['field_value']."' id='".$dept_field['field_name']."' type='".$dept_field['filed_type']."' placeholder='".$dept_field['field_value']."'";
                         echo "/>
                         <div id='main'></div>
                          </div>
                        </div>
                      </div>
                      ";
                      
                echo "<div id='main'></div>";
          }
          if(($dept_field['filed_type']==='radio')){
         
         		echo "
         				<div class='col-md-6'>
         					<div class='control-group'>
         							<label class='control-label'>$dept_field[field_value]</label>";
         					 $radio_field=explode(",", $dept_field['each_field_placeholder']);
         					 $radio_field_value=explode(",",$dept_field['each_field_value']);
         					 echo "<div class='controls'>";
         					 $count=0;
         					 foreach ($radio_field as $rfield) {
         					 echo "<input class='form-control' required name='ApplicationField[".$dept_field['field_name']."]' value='".$radio_field_value[$count]."' id='".$dept_field['field_name']."' type='".$dept_field['filed_type']."' ";
                    if(!empty($dept_field['field_max_length']))
                        echo "maxlength='$dept_field[field_max_length]'";
                    if(!empty($dept_field['field_size']))
                        echo "size='$dept_field[field_size]'";
                    if(!empty($dept_field['field_class']))
                        echo "class='$dept_field[field_class]'"; 
                    if($isUpdate && $preVal->$dept_field['field_name']==$radio_field_value[$count])
                      echo "checked";
                   echo "> ".$rfield;
                   $count++	;
         				 		}
         					echo "</div>
         					</div>
         				</div>";
         	}
         	if(($dept_field['filed_type']==='select')){
         
         		echo "
         				<div class='col-md-6'>
         					<div class='control-group'>
         						<label class='control-label'>$dept_field[field_value]</label>";
         					 $radio_field=explode(",", $dept_field['each_field_placeholder']);
         					 $radio_field_value=explode(",",$dept_field['each_field_value']);
         					 echo "<div class='controls'>";
         					 echo "<select class='form-control' required name='ApplicationField[".$dept_field['field_name']."]'  id='".$dept_field['field_name']."'";
                   if(!empty($dept_field['field_max_length']))
                       echo "maxlength='$dept_field[field_max_length]'";
                   if(!empty($dept_field['field_size']))
                       echo "size='$dept_field[field_size]'";
                   if(!empty($dept_field['field_class']))
                       echo "class='$dept_field[field_class]'"; 
                   echo ">";
         		 			 echo "<option value=''>Please Select ";
         				 $count=0;
         				 foreach ($radio_field as $rfield) {
         				 	echo "<option value='".$radio_field_value[$count]."'"; 
                  if($isUpdate && $preVal->$dept_field['field_name']==$radio_field_value[$count])
                      echo "selected";
                  echo "> ".$rfield."</option>";
                  $count++;
         				 }
         				 	echo "</select>
         				 		  </div>
         				 	</div>
         				</div>";
         	}
         	$sep_count++;
         }
         ?>
      </div>
      <!-- check for fle attachements -->
      <?php 
         $docModel=new ApplicationCdnMappingExt;
         $docs=$docModel->getApplicationDocuments($pre_field['user_id'],$app['id']);
         if($docs){
         	echo "<div class='row'>&nbsp;</div><div id='heading'>Upload Documents</div>";
         	foreach ($docs as $doc) {
         		if($doc['status']==204 || ($doc['status']==200 && $doc['doc_status']=='R')){
         			echo "<div class='row'>
         				  	<div class='col-md-12'>
         				  	  	<frameset><legend>Upload your $doc[doc_name]</legend>
         				  			<div class='col-md-6'>";
         				  				echo "<input type='hidden' name='ApplicationField[doc_id][]' value='$doc[doc_id]'>";
         								echo "<input type='file' class='form-control' name='ApplicationField[]'>"	;
         					  echo "</div>";
         							echo "<div class='col-md-6' style='border-left:solid 1px'>
         									File must be a $doc[doc_type]. Min size : $doc[doc_min_size] & Max Size : $doc[doc_max_size]
         								  </div>";
         				     echo "</frameset>
         				    </div>
         				 </div>";
         		}
         		else if($doc['status']==200){
         			echo "<div class='form-group last'>
                                               <label class='control-label col-md-3'>$doc[doc_name] Already Uploaded</label>
                                               <div class='col-md-9'>
                                                   <div class='fileupload fileupload-new'>
                                                       <div class='fileupload-preview fileupload-exists thumbnail' style='max-width: 200px; max-height: 150px; line-height: 20px;'>
                                                       <img src='data:".$doc['doc_type'].";base64, $doc[doc_blob_data]' />
                                                       </div>
                                                   </div>
                                                   <span class='label label-danger'>";
                                                   	 if($doc['doc_status']=='P')
                                                   	 	echo "Pending for verification";
                                                   	 elseif($doc['doc_status']=='V')
                                                   	 	echo "Verified";
                                                   	 elseif($doc['doc_status']=='R')
                                                   	 	echo "Rejected";
         
                                                   echo "</span>
                                               </div>
                                           </div>";
         		 }
         	  }
         	}	
         ?>
      <div class="row">
      <div class='col-md-6'>
      <div class='control-group'>
      <label class="control-label"></label>
      <div class="controls">
      <input type="submit" class="btn btn-success" value="<?php if($isUpdate ) echo 'Update'; else echo 'Submit';?>" />
      </div>
      </div>
      </div>
      </div>
      </form>
   </div>
</div>
</div>
</div>


 <script src="<?php echo Yii::app()->theme->baseUrl;?>/js/jumbolabs.js"></script>
 <script type="text/javascript">
   $(document).ready(function(){
      var field_count= $('#field_count').val();
      var data='';
      for (var i = 1; i <= field_count; i++) {
          var data = $("#validation_"+i).val();
          var getdata = data.split("#"); 
          var field_type = getdata[0];
          var field_name = "ApplicationField["+getdata[1]+"]";
          // console.log(field_type);
          // console.log(field_name);

          if(field_type=="text"){
                // console.log("text");
                // console.log(field_name); 
              $(".form_validate").validate({  
                 rules: {  
                 field_name: {lettersonly:true,required:true,}, 
                 },
                 messages: {
                     example5: "Just check the box<h5 class='text-error'>You aren't going to read the EULA</h5>"
                 },
                 tooltip_options: {
                     fname: {trigger:'focus'},
                     '_all_': {placement:'top',html:true}
                 },
                 invalidHandler: function(form, validator) {
                     $("#validity_label").html('<div class="row"><div class="alert alert-error">There be '+validator.numberOfInvalids()+' error'+(validator.numberOfInvalids()>1?'s':'')+' here.  OH NOES!!!!!</div></div>');
                 }
              });

             };
          if(field_type=="email"){
            // console.log("email");
              $(".form_validate").validate({  
                 rules: {   
                 field_name: {email:true,}, 
                 },
                 messages: {
                     example5: "Just check the box<h5 class='text-error'>You aren't going to read the EULA</h5>"
                 },
                 tooltip_options: {
                     fname: {trigger:'focus'},
                     '_all_': {placement:'top',html:true}
                 },
                 invalidHandler: function(form, validator) {
                     $("#validity_label").html('<div class="row"><div class="alert alert-error">There be '+validator.numberOfInvalids()+' error'+(validator.numberOfInvalids()>1?'s':'')+' here.  OH NOES!!!!!</div></div>');
                 }
              });

             };   
      };
   });
</script>
<!-- "interest_subsidy[company_name]": {
                    lettersonly:true,
                    nowhitespace:true,
                    required:true,
                    strongpassword:true,
                    alphanumeric:true,
                    digits:true,
                    email:true,
                    number:true,
                  }, -->