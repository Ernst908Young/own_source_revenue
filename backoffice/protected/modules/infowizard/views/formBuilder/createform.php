<?php 
/* Rahul Kumar  25032018*/
$serviceID=$_GET['service_id'];
$formID=$_GET['formID']; 
$formCodeID=$_GET['formCodeID']; 
?>

<style>
  .red{color:red;padding: 2px;}
  .col-md-3{margin-top: 20px;}
  .col-md-2 {margin-top: 20px;}
  .portlet.box .dataTables_wrapper .dt-buttons { margin-top: -53px !important;}
  .errorSummary{ color:red;}
  .padding2{ padding: 2px !important;}
  .bg-black{background-color: #000 !important; color: #fff !important;}
</style>
<link rel="stylesheet" href="<?=Yii::app()->theme->baseUrl?>/assets/frontend/dashboard/css/plugins/select2/select2.css">
<!-- select2 -->
<script src="<?=Yii::app()->theme->baseUrl?>/assets/frontend/dashboard/js/plugins/select2/select2.min.js"></script>
<!-- Theme framework -->
<script src="<?=Yii::app()->theme->baseUrl?>/assets/frontend/dashboard/js/eakroko.min.js"></script>
<?php  
//echo "<pre/>";  print_r($formData);die;
$sid=array();
foreach ($formData as $key => $fd) {
	$sid[]=$fd['form_field_id']; 
	$pref[]=$fd['preference'];
} 
//print_r($sid);die;
?>
<div class='portlet box green'>
  <div class="portlet-title">
      <div class="caption" >
      <i class="fa fa-plus-square-o font-dark" style="color:#fff !important;">
      </i>
      <span class="caption-subject font-dark bold uppercase" style="color:#fff !important;">Create Service Sub Form 
      </span>
    </div>
  </div>
  <div class="portlet-body">
    <form role="form" id="service">
      <div class="row">
      <div class="col-md-3"> 
            <?php  $allList=InfowizardQuestionMasterExt::getPageNameOfServiceForm(@$_GET[service_id],@$formCodeID); ?>
          <select class="select2-me" id="pagename" name="page_name" required>
            <option value="">Select Page Name</option>		
            <?php if(!empty($allList)){
                $firstPageIDFlag=0;
                foreach($allList as $k=>$v){
                    // Getting First Page for paasing in URL  while genrating Page
                    if($firstPageIDFlag==0){$currentPageID=$k;$firstPageIDFlag=1; }?>
            <option value="<?php echo $k; ?>"><?php echo $v;?></option>  
            <?php } 
			} ?>
          </select>
        </div>
        <div class="col-md-3">
          <select class="select2-me" name="category_id" required id="formCATID">
            <option value="">Select Category </option>           
          </select>
        </div>       
        <div class="col-md-3">
		
          <input type="hidden" name="caption_slug">
          <input type="hidden" name="service_id" value="<?php echo $serviceID; ?>">
          <input type="hidden" name="sub_form" value="2<?php //echo $subform; ?>">
          <input type="hidden" name="form_id" value="<?php echo @$_GET['formCodeID']?>">
          <select class="select2-me" name="form_field_id" id="form_field_id">
            <option value="">Form Field </option>
            <?php $allList=InfowizardQuestionMasterExt::getMasterListTwoValue('bo_infowizard_formvariable_master','formvar_id','formchk_id','is_formvar_active','Y','name');
			?>
            <?php foreach($allList as $k=>$v){ 
                if(!in_array($k, $sid)){ ?>
            <option value="<?php echo $k; ?>"> <?php echo $v; ?></option>  
            <?php }} ?>
          </select> 
        </div>
		<div class="col-md-3">
          <select class="select2-me" name="input_type" required>
            <option value="">Field Type</option>
            <option value="text">Text </option>
            <option value="email">Email </option>
            <option value="url">URL </option>
            <option value="number">Number</option>
            <option value="textarea">Textarea</option>
            <option value="multipleselect">Multiple Select</option>
            <option value="select">Dropdown </option>
            <option value="radio">Radio </option>
            <option value="checkbox">Checkbox </option>
            <option value="password">Password</option>
            <option value="calender">Calendar</option>
			<option value="datetimecalendar">Date Time Calendar</option>
            <option value="button">Button</option>
			<option value="add_more_button">Add more button</option>
          </select>
        </div>		
		</div>
		  <div class="row">
       
        <div class="col-md-3">
          <input type="text" name="helptext" placeholder="Input Field Help Text" class="form-control">
        </div>
          
          <input type="hidden" name="is_with_caf" value='N'>
       <!--  <div class="col-md-3">
          <select class="form-control" name="is_with_caf">
            <option value="N">To be used in CAF-No</option>
            <option value="Y">To be used in CAF-Yes</option>
          </select>
        </div> -->
       
	    <div class="col-md-3">
            <select class="form-control" name="is_required">
                <option value="N">Is Mandatory-No</option>
                <option value="Y">Is Mandatory-Yes</option>
            </select>
        </div>
           <div class="col-md-3">
      <select class="form-control" name="validation_rule">
        <option value="">No Extra Validation</option>                         
        <option value="email">Email </option>
        <option value="number">Number</option>
        <option value="alphanumeric">Alphanumeric</option>
        <option value="date">Date </option>
      </select>
    </div>
    <div class="col-md-3">
      <!--  <input type="number" name="preference" class="form-control" placeholder="Preference">-->
      <select class="form-control" name="preference" id="preferenceUnderCategory">
        <option value="0">Form Field Preference
        </option>  
        <?php $uj=0;for($i=1;$i<=200;$i++) {
            if(!in_array($i, $sid)){  ?>
        <option value="<?php echo $i; ?>" >
          <?php echo $i; ?> 
        </option>
        <?php } }  ?>
      </select>
    </div> 
          
		</div>
		  <div class="row">
       
         <input type="hidden" name="row_type" value='2'>
   
  <!--   <div class="col-md-3">
      <select class="form-control" name="row_type" readonly>
        <option value="">In A Row</option>                         
        <option value="1">1</option>
        <option value="2" selected>2</option>
        <option value="3">3</option>
        <option value="4">4</option>
      </select>
    </div> -->
    <input type="hidden" name="min_length" >
    <input type="hidden" name="max_length" >
   <!--  <div class="col-md-3">
      <input type="number" name="min_length" placeholder="minlength" class="form-control"> 
    </div>
    <div class="col-md-3">
      <input type="number" name="max_length" placeholder="maxlength" class="form-control"> 
    </div> -->
          
         
	</div>
	<div class="row">
   
    
      
	</div>
	<div class="row">	
      <input type="hidden" name="is_editable" value='N'>
    <!-- <div class="col-md-3">
        <select class="form-control" name="is_editable">
              <option value="N">Is Editable - No </option>
              <option value="Y">Is Editable - Yes</option>
        </select>
    </div> -->
          
    <div class="col-md-12" style="margin-top: 10px;">
      <div class="actions">
        <a class="btn btn-primary" href="javascript:void(0);" id="AddMore">
          Save Sub Form Data for Service ID :  <?php echo @$serviceID; ?> 
        </a>
      </div>
        
	</div>
	</div>
</div>
<br>
</form>
</div>
</div>
  <div class='row'>
      <div class="col-md-12" style="margin-bottom:10px;">
        <a href="<?php echo Yii::app()->request->baseUrl; ?>/infowizardtwo/formBuilder/subform/service_id/<?php echo $_GET['service_id']; ?>/pageID/<?php echo @$currentPageID; ?>/formCodeID/<?php echo $_GET['formCodeID'];?>" style="color:#fff;" class="pull-right btn btn-success">
      <b>Generate Form 
        <i class="fa fa-magic">
        </i>
      </b> 
    </a>
  </div>  
  </div>  
<div class="row msg">
</div>
  
<div class='portlet box green'>

<div class='portlet-title'>
 

</div>
<div class="portlet-body">
  <table class="table table-striped table-bordered table-hover" id="sample_2" >
    <thead>
      <tr>
		<th>S.No.</th>
		<th>Page Name</th>
		<th>Category Name</th>
		<th>Form Field ID</th>
		<th>Form Field Name</th>
		<th>Type</th>
		<!-- <th>To Be Used With CAF</th> -->
		<th>Is Required</th>
		<th>Options</th>
   <!--  <th>Action</th>        -->            
        <!--     <th>Plot Status</th><th>Action</th>-->
      </tr>
    </thead>
    <tbody id="epa">
      <style>
        .errorSummary{
          color:red;
        }
      </style>
      <div class="portlet-body">
        <div class="site-min-height">
          <div class="form form-horizontal" role="form">
            <?php
            $rtd = "";
            if (empty($formData)) {
            echo "<tr><td colspan='4'>No Data added for this sub form </td></tr>";
            } else {
            $count = 1;
            foreach ($formData as $key => $fd) {
            ?>
            <tr>
              <td align="center">
                <?= $count++; ?>
              </td>
              <td>
                <?php echo $allList=InfowizardQuestionMasterExt::getMasterName('bo_infowiz_page_master',$fd['page_name'],'page_name','id'); ?>
              </td>
              <td> 
                <?php echo $allList=InfowizardQuestionMasterExt::getMasterName('bo_infowiz_form_categories',$fd['category_id'],'category_name','id'); ?>
              </td>
              <td title="<?php echo $fd['form_field_id'];?>">
                <?php echo $allList=InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master',$fd['form_field_id'],'formchk_id','formvar_id'); ?>
                <br><br>
                 <?php 
                    echo CHtml::link('<i class="fa fa-edit padding2 bg-black"></i>',array('updateFileds','service_id'=>$fd['service_id'],'form_id'=>$fd['form_id'],'id'=>$fd['id'],'formCodeID'=>$_GET['formCodeID']), array());
                  ?>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <a href="javascript:void(0)" class="deleteFileds" rel="<?php echo $fd['id']; ?>"><i class="fa fa-trash padding2 bg-black"></i></a>
              </td>
              <td> 
              <b class="pref_<?php echo $fd['id'];?>"><?php echo $fd['preference'].": "; ?></b>  <?php echo $allList=InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master',$fd['form_field_id'],'name','formvar_id'); ?>
			   <br/>
			  <?php if(isset($_GET['setPref']) && $_GET['setPref']=='Y') { ?>
				<input type="text" name="pref" class="pref" rel="<?php echo $fd['id'];?>">
				<?php }?>
              </td>
              <td>
                <?= $fd['input_type']; ?>
              </td>
            <!--   <td>
                <1?php if($fd['is_with_caf']=="Y"){echo "Yes";}else{echo "No";} ?>
              </td> -->
              <td>
                <?php if($fd['is_required']=="Y"){echo "Yes";}else{echo "No";} ?>
              </td>
              <td>
                <?php $optionsarray=array('checkbox','multipleselect','select','radio');if(in_array($fd['input_type'],$optionsarray)){ ?> 
                <button type="button" class="btn btn-success addOptions" rel="<?php echo $fd['id']; ?>" headingname="<?php echo $allList; ?>" >
                  <i class="fa fa-plus-square-o">
                  </i> Add Options
                </button> 
                <?php } else if($fd['input_type']=='add_more_button'){ ?>
                      <button type="button" class="btn btn-success addMoreOptions" rel="<?php echo $fd['page_name']; ?>" rel1= "<?php echo $fd['id']; ?>"headingname="<?php echo $allList; ?>" ><i class="fa fa-plus-square-o"></i> Add more
                      </button> 
                <?php }
					else{echo "-";} ?>
              </td>
             
            </tr>
            <?php
            }
            }
            ?>
            </tbody>
          </table>
        <?php
            $base = Yii::app()->theme->baseUrl;
            // echo $base;
            ?>
      </div>
    </div>
    </div>
    </div>
    </div>
	
	<!--- pankaj sugara Add more------------------------->
	
	<!-- Modal -->
	<div id="AddMoreModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;
          </button>
          <h4 class="modal-title formfieldheading">Add Options
          </h4>
        </div>
        <div class="modal-body">
          <div id="msg"> 
          </div>
          <form id="select_add_more_form" class="select_add_more_form">
          <div class="form form-horizontal" role="form"> 
            <div class="row">
                <div class="form-group">
					<div class="col-md-12">	
					  <div class="col-md-2" style="text-align:right; margin-bottom:10px;">Select Add More Form Field</div>
					  <div class="col-md-10">
						<select name="add_more_form_field[]" id="add_more_form_field" class="select2-me" multiple="multiple" style="width: 100%;">
						  <option value="0">select from field</option>
						</select>
						<input type="hidden" name="deselected[]" id="deselected" value="">
						<input type="hidden" name="page_id" id="page_id_sub" value="">
						<input type="hidden" name="button_id" id="button_id_sub" value="">
						<input type="hidden" name="service_idds" id="service_idds" value="<?php echo $serviceID; ?>">
					  </div>
					</div>
                </div>
              </div>
               <div class="row">
                <div class="col-md-4 ">&nbsp;</div>
                <div class="col-md-4 ">
                    <input type="submit" class="btn btn-success" value="Save">
                  </div>
               </div>
          </div>
		  </form>
          
			<div id="msgPref"></div>
			<div id="tbl_pref">
			
			</div>
		  </div>
          <hr>         
        </div>       
      </div>
    </div>
	<!--- ADD more end pankaj sugara--->
	
  <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;
          </button>
          <h4 class="modal-title formfieldheading">Add Options
          </h4>
        </div>
        <div class="modal-body">
           <div id="msg2"> 
          </div>
          <div class="form form-horizontal" role="form"> 
            <form id="selectform" class="myform1">
              <input type="hidden" name="formvar_id" id="formvar_id1">
              <input type="hidden" name="type" value="select">
              <div class="row">
                <div class="form-group">
                  <div class="col-lg-4" style="text-align:right; margin-bottom:10px;"> Type & Select 
                  </div>
                  <div class="col-md-4">
                    <input type="text" class="form-control typeahead" data-provide="typeahead" name="title" value="" placeholder="Type & Select" autocomplete="off">
                    <input type="hidden" name="master_table_id" id="master_table_id" value="">
                  </div>
                  <div class="col-md-4 ">
                    <input type="submit" class="btn btn-success" value="Save">
                  </div>
                </div>
              </div>
            </form>
          </div>
          <hr>
          <div class="form form-horizontal" role="form"> 
            <form id="optionform" class="myform2" >
              <input type="hidden" name="formvar_id" id="formvar_id">
              <input type="hidden" name="type" value="radio">
              <div class="col-md-12">  
                <div class="upload_files_row col-md-8">
                </div>					
                <div class="col-md-4">
                  <button class="add_more btn btn-success" style="margin-left:18px">
                    <i class="fa fa-plus-square-o">
                    </i> Add More Options
                  </button>
                </div>
              </div>
              <?php /* <div class="upload_files_row"></div>  */?>
              <div class="row">
                <div class="form-group">
                  <label class="col-md-4  control-label" for="application_name">&nbsp;
                  </label>
                  <div class="col-md-4 ">
                    <input type="submit" class="btn btn-success" value="Save Options">
                  </div>
                </div>
              </div>
            </form>
          </div>
          <!-- form -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close
          </button>
        </div>
      </div>
    </div>
  </div>
  <div id="loading-mask">
  </div>
  <!-- BEGIN PAGE LEVEL PLUGINS -->
  <script src="/backoffice/themes/swcsNewTheme/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript">
  </script>
  <!-- END PAGE LEVEL PLUGINS -->
  <script  type="text/javascript" src="/backoffice/themes/swcsNewTheme/assets/global/scripts/bootstrap3-typeahead.js">
  </script>
  <script>
    $(function () {
		$(document).on('blur', '.setAddMorePref', function(){
			$("#msgPref").html("");	
			var id = $(this).attr('rel');
			var pref = $(this).val();
			$.ajax({
				type: "GET",
				url: "/panchayatiraj/backoffice/infowizard/formBuilder/formFieldPriorityAddmore/pref/"+pref+"/id/"+id,
				success: function (result) {
					//alert(result);
					if(result==1)
					$("#msgPref").html("Update Sucessfully");
					else
					$("#msgPref").html("Not Update Sucessfully");	
				}
			});
		});	
      $(".addOptions").click(function(){
        var id = $(this).attr("rel");
        $("#formvar_id").val(id);
        $("#formvar_id1").val(id);
        $(".formfieldheading").html();
        get_options(id);
        $('#myModal').modal('show');
      }
                            );
      $('.myform2').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
          type: 'post',
          url: '<?php echo Yii::app()->request->baseUrl; ?>/infowizard/formFieldMaster/saveAjax',
          //data: $('form').serialize(),
          data: $('.myform2').serialize(),
          success: function (data) {
            if(data){
              //alert('form was submitted');
              $('#msg2').html('<div class="alert alert-success"><strong>Success!</strong> successful Save</div>');
            }
            else{
              $('#msg2').html('<div class="alert alert-danger"><strong>Danger!</strong> something went wrong .</div>');
            }
          }
        });
      });
	  
	   /* Pankaj Singh to save add more data  form Start  select_add_more_form*/
        
		$('.select_add_more_form').on('submit', function (e) {
			e.preventDefault();
			var page_id = $('#page_id_sub').val();
			var button_id = $('#button_id_sub').val();
			//var button id = $('#button_id').val();
			//console.log($('#select_add_more_form').serialize());
			//console.log($('#select_add_more_form option').not(':selected'));       
			$data = $('#select_add_more_form').serialize();     
			//return false;
			$.ajax({
				type: 'post',
				url: '<?php echo Yii::app()->request->baseUrl; ?>/infowizard/formFieldMaster/saveAddmoreSubformData',
				data: $data,
				success: function (data) {
					if(data){
					  $('#msg').html('<div class="alert alert-success"><strong>Success!</strong> successful Save</div>');
					}
					else{
					  $('#msg').html('<div class="alert alert-danger"><strong>Danger!</strong> something went wrong .</div>');
					}
				}
			});
		});
      /* Pankaj Singh to save add more data  form End */
    
      $('.myform1').on('submit', function (e) {
        e.preventDefault();
        //var id=$(".addOptions").attr("rel");
       // $("#formvar_id1").val(id);
        $.ajax({
          type: 'post',
          url: '<?php echo Yii::app()->request->baseUrl; ?>/infowizard/formFieldMaster/saveAjaxMaster',
          data: $('.myform1').serialize(),
          success: function (data) {
            if(data){
              $('#msg2').html('<div class="alert alert-success"><strong>Success!</strong> successful Save</div>');
            }
            else{
              $('#msg2').html('<div class="alert alert-danger"><strong>Danger!</strong> something went wrong .</div>');
            }
          }
        });
      });
      
    });
    function delete_option(id){
      $.ajax({
        type: "POST",
        dataType: 'json',
        data:{
          "option_id":id}
        ,
        url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/formFieldMaster/deleteAjax",
        success: function (data) {
          if(data.flag){
            //alert('form was submitted');
            $('#msg').html('<div class="alert alert-success"><strong>Success!</strong> successful Delete</div>');
          }
          else{
            $('#msg').html('<div class="alert alert-danger"><strong>Danger!</strong> something went wrong .</div>');
          }
        }
      });
    };
    function get_options(id){
      var wrapper         = $(".upload_files_row");
      //Fields wrapper
      var add_button      = $(".add_more");
      //Add button ID
      $.ajax({
        type: "GET",
        dataType: 'json',
        data:{
          "id":id}
        ,
        url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/formFieldMaster/allFormFieldAjax",
        success: function(data){
          var option_html ='';
          var option_val='';
         // console.log(data.data);
          if((data.data).length>0){
            $(wrapper).empty();
            $.each(data.data, function(idx, obj) {
			//alert(obj.master_table_id);
              if(obj.master_table_id){
                option_val=obj.title;
                $(wrapper).append('<div class="row"><div class="form-group"><div class="col-md-6" style="text-align:right; margin-bottom:10px;"> Option Name</div><div class="col-md-5" style="margin-bottom:10px;"><input type="text" name="options[]" placeholder="Option Name" required class="form-control"></div> <a href="#" class="remove_field"> <i class="fa fa-trash" aria-hidden="true" style="font-size:24px;color:red;margin: 3px;"></i> </a> </div></div>');
                //add input box
              }
              else{
                option_html +='<div class="row"><div class="form-group"><div class="col-lg-6" style="text-align:right; margin-bottom:10px;"> Option Name </div> <div class="col-md-5" style="margin-bottom:10px;"><input type="text" class="form-control" name="options[]" value="'+obj.options+'" placeholder="Option Name" required> </div> <a href="javascript:void(0);" id="'+obj.id+'" class="eremove_field"><i class="fa fa-trash" aria-hidden="true" style="font-size:24px;color:red;margin: 3px;"></i> </a>  </div></div>';
              }
            }
                  );
            $(wrapper).append(option_html);
            $(".typeahead").val(option_val);
          }
          else{
            $(wrapper).empty();
            $(wrapper).append('<div class="row"><div class="form-group"><div class="col-md-6" style="text-align:right; margin-bottom:10px;"> Option Name</div><div class="col-md-5" style="margin-bottom:10px;"><input type="text" name="options[]" placeholder="Option Name" required class="form-control"></div> <a href="#" class="remove_field"> <i class="fa fa-trash" aria-hidden="true" style="font-size:24px;color:red;margin: 3px;"></i> </a> </div></div>');
            //add input box
          }
          add_more();
        }
      });
    };
    function add_more(){
      var max_fields      = 10;
      //maximum input boxes allowed
      var wrapper         = $(".upload_files_row");
      //Fields wrapper
      var add_button      = $(".add_more");
      //Add button ID
      var x = 1;
      //initlal text box count
      $(add_button).click(function(e){
        //on add input button click
        e.preventDefault();
        if(x < max_fields){
          //max input box allowed
          x++;
          //text box increment
          $(wrapper).append('<div class="row"><div class="form-group"><div class="col-md-6" style="text-align:right; margin-bottom:10px;"> Option Name</div><div class="col-md-5" style="margin-bottom:10px;"><input type="text" name="options[]" placeholder="Option Name" required class="form-control"></div> <a href="#" class="remove_field"> <i class="fa fa-trash" aria-hidden="true" style="font-size:24px;color:red;margin: 3px;"></i> </a> </div></div>');
          //add input box
        }
      } );
      $(wrapper).on("click",".remove_field", function(e){
        //user click on remove text
        $('#msg').html('<div class="alert alert-success"><strong>Success!</strong> successful Delete</div>');
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
      }
                   );
      $(wrapper).on("click",".eremove_field", function(e){
        //user click on remove text
        var txt;
        var r =  confirm("Want to delete?");
        if (r == true) {
          txt = "You pressed OK!";
          var option_id =$(this).attr('id');
          delete_option(option_id);
          e.preventDefault();
          $(this).parent('div').remove();
          x--;
        }
        else {
          txt = "You pressed Cancel!";
        }
      }
                   );
    };
 
    $(document).ready(function(){
      $('.typeahead').typeahead({
        displayText: function(item) {
          return item.label
        }
        ,
        afterSelect: function(item) {
          this.$element[0].value = item.label;
          var item_val=item.value;
          $("#master_table_id").val(item_val);
        }
        ,
        source: function (query, process) {
          return $.getJSON('/panchayatiraj/backoffice/infowizard/FormFieldMaster/getMasterList', {
            query: query }
                           , function(data) {
            process(data)
          })
        }
      })
    });
    /*-------------------------------------------*/
  
    $(document).ready(function () {
      // alert("==");
      
      $("#pagename").change(function(){
         var pageID=$(this).val();  
         $.ajax({
          type: "POST",
          url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/formBuilder/getMappedCategoryWithPage/pageID/"+pageID+"/formCodeID/<?php echo $_GET['formCodeID'];?>",
          success: function (data) {
              $("#formCATID").html(data);
             // alert(data);
           // location.reload();
          }
        });
         
      });
      
       $("#formCATID").change(function(){
        var categoryID=$(this).val();  
        var pageID=$("#pagename").val();
         $.ajax({
          type: "POST",
          url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/formBuilder/getRemaingPageCategoryPreference/pageID/"+pageID+"/categoryID/"+categoryID+"/serviceID/<?php echo @$_GET['service_id'];?>/formCodeID/<?php echo @$_GET['formCodeID'];?>",
          success: function (data) {
              $("#preferenceUnderCategory").html(data);             
           }
        });         
      });
	  
	  
	   /* Pankaj Singh Start*/
        $(".addMoreOptions").click(function(){
          var page_id=$(this).attr("rel");
          //alert(page_id);
          $("#page_id_sub").val(page_id);
          $("#button_id_sub").val($(this).attr("rel1"));
          var button_id = $(this).attr("rel1");
          //$(".formfieldheading").html();
          get_page_options(page_id,button_id,"form_field");
          $('#AddMoreModal').modal('show');
		  $.ajax({
				type: "POST",
				url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/formBuilder/SetAddMorePref/button_id/"+button_id,
				success: function (data) {
					$("#tbl_pref").html(data);
				}
			});
        });
        function get_page_options(page_id,button_id){         
          $.ajax({
          type: "GET",
          dataType: 'json',
          data:{"page_id":page_id,'button_id':button_id},
          url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/formFieldMaster/pageOption",
          success: function(data){
              var option_html ='';
              var option_val='';
              $('#add_more_form_field').append(data);              
            }
          });
        }      
      /* Pankaj Singh End*/
      
      $("#AddMore").click(function () {
        $.ajax({
          type: "POST",
          data: $("#service").serialize(),
          url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/formBuilder/createformajax/",
          success: function (data) {
            location.reload();
          }
        });
      });
      $('.deleteFileds').on('click',function(){
        var id = $(this).attr("rel"); 
        //alert(service_id+"--"+form_id+"--"+id+"--"+formCodeID);
        $.ajax({
          type: "POST",
          url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/formBuilder/deleteformafield/id/"+id,
          success: function (data) {
            console.log(data);
            alert('Sucessfully Deleted');
            location.reload();
          }
        });
      });
	  
    });
	
    /* $('select:not(.normal)').each(function () {
      $(this).select2({
        dropdownParent: $(this).parent()
      });
    }); */
                                 
  </script>
  
  <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?=$base?>/assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="<?=$base?>/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="<?=$base?>/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->



   <!-- BEGIN PAGE LEVEL PLUGINS -->
        <link href="<?=$base?>/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$base?>/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->


<script type="text/javascript">
  
  var TableDatatablesButtons = function() {
    var e = function() {
            var e = $("#sample_1");
            e.dataTable({
                language: {
                    aria: {
                        sortAscending: ": activate to sort column ascending",
                        sortDescending: ": activate to sort column descending"
                    },
                    emptyTable: "No data available in table",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No entries found",
                    infoFiltered: "(filtered1 from _MAX_ total entries)",
                    lengthMenu: "_MENU_ entries",
                    search: "Search:",
                    zeroRecords: "No matching records found"
                },
                buttons: [{
                    extend: "print",
                    className: "btn dark btn-outline"
                }, {
                    extend: "copy",
                    className: "btn red btn-outline"
                }, {
                    extend: "pdf",
                    className: "btn green btn-outline"
                }, {
                    extend: "excel",
                    className: "btn yellow btn-outline "
                }, {
                    extend: "csv",
                    className: "btn purple btn-outline "
                }, {
                    extend: "colvis",
                    className: "btn dark btn-outline",
                    text: "Columns"
                }],
                responsive: !0,
                order: [
                    [0, "asc"]
                ],
                lengthMenu: [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"]
                ],
                pageLength: 10,
                dom: "<'row' <'col-md-12'B>><'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r><'table-scrollable't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
            })
        },
        t = function() {
            var e = $("#sample_2");
            e.dataTable({
              scrollX: true,
                language: {
                    aria: {
                        sortAscending: ": activate to sort column ascending",
                        sortDescending: ": activate to sort column descending"
                    },
                    emptyTable: "No data available in table",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    infoEmpty: "No entries found",
                    infoFiltered: "(filtered1 from _MAX_ total entries)",
                    lengthMenu: "_MENU_ entries",
                    search: "Search:",
                    zeroRecords: "No matching records found"
                },
                buttons: [],
                order: [
                    [0, "asc"]
                ],
                lengthMenu: [
                    [5, 10, 15, 500, -1],
                    [5, 10, 15, 500, "All"]
                ],
                pageLength: 500,
                dom: "<'row'r><'mb-3't><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>"
            })
        },
        a = function() {
            var e = $("#sample_3"),
                t = e.dataTable({
                    language: {
                        aria: {
                            sortAscending: ": activate to sort column ascending",
                            sortDescending: ": activate to sort column descending"
                        },
                        emptyTable: "No data available in table",
                        info: "Showing _START_ to _END_ of _TOTAL_ entries",
                        infoEmpty: "No entries found",
                        infoFiltered: "(filtered1 from _MAX_ total entries)",
                        lengthMenu: "_MENU_ entries",
                        search: "Search:",
                        zeroRecords: "No matching records found"
                    },
                    buttons: [{
                        extend: "print",
                        className: "btn dark btn-outline"
                    }, {
                        extend: "copy",
                        className: "btn red btn-outline"
                    }, {
                        extend: "pdf",
                        className: "btn green btn-outline"
                    }, {
                        extend: "excel",
                        className: "btn yellow btn-outline "
                    }, {
                        extend: "csv",
                        className: "btn purple btn-outline "
                    }, {
                        extend: "colvis",
                        className: "btn dark btn-outline",
                        text: "Columns"
                    }],
                    responsive: !0,
                    order: [
                        [0, "asc"]
                    ],
                    lengthMenu: [
                        [5, 10, 15, 20, -1],
                        [5, 10, 15, 20, "All"]
                    ],
                    pageLength: 10
                });
            $("#sample_3_tools > li > a.tool-action").on("click", function() {
                var e = $(this).attr("data-action");
                t.DataTable().button(e).trigger()
            })
        },
        n = function() {
            $(".date-picker").datepicker({
                rtl: App.isRTL(),
                autoclose: !0
            });
            var e = new Datatable;
            e.init({
                src: $("#datatable_ajax"),
                onSuccess: function(e, t) {},
                onError: function(e) {},
                onDataLoad: function(e) {},
                loadingMessage: "Loading...",
                dataTable: {
                    bStateSave: !0,
                    lengthMenu: [
                        [10, 20, 50, 100, 150, -1],
                        [10, 20, 50, 100, 150, "All"]
                    ],
                    pageLength: 10,
                    ajax: {
                        url: "../demo/table_ajax.php"
                    },
                    order: [
                        [1, "asc"]
                    ],
                    buttons: [{
                        extend: "print",
                        className: "btn default"
                    }, {
                        extend: "copy",
                        className: "btn default"
                    }, {
                        extend: "pdf",
                        className: "btn default"
                    }, {
                        extend: "excel",
                        className: "btn default"
                    }, {
                        extend: "csv",
                        className: "btn default"
                    }, {
                        text: "Reload",
                        className: "btn default",
                        action: function(e, t, a, n) {
                            t.ajax.reload(), alert("Datatable reloaded!")
                        }
                    }]
                }
            }), e.getTableWrapper().on("click", ".table-group-action-submit", function(t) {
                t.preventDefault();
                var a = $(".table-group-action-input", e.getTableWrapper());
                "" != a.val() && e.getSelectedRowsCount() > 0 ? (e.setAjaxParam("customActionType", "group_action"), e.setAjaxParam("customActionName", a.val()), e.setAjaxParam("id", e.getSelectedRows()), e.getDataTable().ajax.reload(), e.clearAjaxParams()) : "" == a.val() ? App.alert({
                    type: "danger",
                    icon: "warning",
                    message: "Please select an action",
                    container: e.getTableWrapper(),
                    place: "prepend"
                }) : 0 === e.getSelectedRowsCount() && App.alert({
                    type: "danger",
                    icon: "warning",
                    message: "No record selected",
                    container: e.getTableWrapper(),
                    place: "prepend"
                })
            }), $("#datatable_ajax_tools > li > a.tool-action").on("click", function() {
                var t = $(this).attr("data-action");
                e.getDataTable().button(t).trigger()
            })
        };
    return {
        init: function() {
            jQuery().dataTable && (e(), t(), a(), n())
        }
    }
}();
jQuery(document).ready(function() {
    TableDatatablesButtons.init()
});

$(".pref").on("blur",function(){
	var id = $(this).attr('rel');
	var pref = $(this).val();
	$.ajax({
		type: "GET",
		url: "/panchayatiraj/backoffice/infowizard/formBuilder/formFieldPriority/pref/"+pref+"/id/"+id,
		success: function (result) {
			$(".pref_"+id).html(pref+": ");
		}
	});
});

</script>