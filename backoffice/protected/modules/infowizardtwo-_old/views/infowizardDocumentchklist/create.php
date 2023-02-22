<style>
.control-label1 {
	text-align: left ;
	margin-bottom: 0;
    padding-top: 7px;
	margin-top: 1px;
    font-weight: 400;
}
.required{color:red !important}
</style>

<style>
    span.required{color:red}
.control-label .required, .form-group .required {
    color: #333;
    font-size: 14px;
    padding-left: 2px;
     font-weight: 400;
}
.required .required{color:red;} 
.errorMessage {
    color: red;
}
.page-sidebar.navbar-collapse.collapse {
    display: none !important;
}

.select2-container .select2-choice {
  -moz-border-radius: 0;
  -webkit-border-radius: 0;
  border-radius: 0;
  background-image: none;
  background: #fff;
  height: 30px;
}
.select2-container .select2-choice div {
  border-left: 0;
  background: none;
}
.select2-container .select2-choice .select2-arrow {
  background: none;
  border: 0;
}
.select2-container.select2-drop-above .select2-choice {
  -moz-border-radius: 0;
  -webkit-border-radius: 0;
  border-radius: 0;
  background-image: none;
}
.select2-container .select2-search-choice-close {
  top: 3px;
}
.select2-container .select2-choices {
  background-image: none;
}
.select2-container.select2-container-multi .select2-choices {
  -moz-box-shadow: none;
  -webkit-box-shadow: none;
  box-shadow: none;
  background: #fff;
}
.select2-container.select2-container-multi .select2-choices .select2-search-field input {
  padding: 9px 5px;
}
.select2-container.select2-container-multi .select2-choices .select2-search-choice {
  background: #eee;
  -moz-box-shadow: none;
  -webkit-box-shadow: none;
  box-shadow: none;
  -moz-border-radius: 0;
  -webkit-border-radius: 0;
  border-radius: 0;
}

.select2-results, .select2-search, .select2-with-searchbox {
  -webkit-border-radius: 0 !important;
  -moz-border-radius: 0 !important;
  border-radius: 0 !important;
}
.select2-results .select2-highlighted {
    background: rgb(38,194,129) !important;
    color: #fff;
}

</style>

<link rel="stylesheet" href="<?=Yii::app()->theme->baseUrl?>/assets/frontend/dashboard/css/plugins/select2/select2.css">
      <!-- select2 -->
	<script src="<?=Yii::app()->theme->baseUrl?>/assets/frontend/dashboard/js/plugins/select2/select2.min.js"></script>
	
        <!-- Theme framework -->
	<script src="<?=Yii::app()->theme->baseUrl?>/assets/frontend/dashboard/js/eakroko.min.js"></script>
	<!-- Theme scripts -->
	<script src="<?=Yii::app()->theme->baseUrl?>/assets/frontend/dashboard/js/application.min.js"></script>
	<!-- Just for demonstration -->
	<script src="<?=Yii::app()->theme->baseUrl?>/assets/frontend/dashboard/js/demonstration.min.js"></script>
	
<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>Create Document Master</div>
    <div class='tools'>
	
	</div>
	
</div>
<div class="portlet-body">

<div class="site-min-height">
<div class="form form-horizontal" role="form">

<form name="" action="" method="POST">
	
	
	
	 <div class="row">
	<div class="form-group col-md-6">
	<label class="col-lg-4 col-sm-4 control-label" for="application_name" >State/Central<span class="required">*</span></label>
			<div class="col-md-8">
			<select name="issuer_id" id="issuer_id" class="form-control" onchange="showUser(this.value)" required>	
			<?php foreach($Issuerdata as $que){ ?>
		<option value="<?php echo $que['issuer_id'];?>"><?php echo $que['name'];?></option>
		<?php }?>
		</select>	
		
	</div></div></div>
	
	<div class="row">
	<div class="form-group col-md-6">
	<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Select Department <span class="required">*</span></label>
			<div class="col-md-8">
	<select class="form-control"  name="issuerby_id" id="issuerby_id" ></select>
	</div></div></div>

	
	<div class="row">
	<div class="form-group col-md-6">
	<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Type of Document<span class="required" aria-required="true"> * </span></label>
	<div class="col-md-8">
<select name="doc_id[]" id="doc_id" class="select2-me" multiple="multiple" required >
<?php 
$sql = "select doc_id,name from bo_infowizard_docunenttype_master where is_doc_active='Y'";
$connection = Yii::app()->db;
$command = $connection->createCommand($sql);
$AllDocument = $command->queryAll();

if (isset($AllDocument)) {
foreach ($AllDocument as $va) {
?>
<option value="<?php echo $va['doc_id'];?>" > <?php echo $va['name']; ?></option>
<?php
}
}
?>
</select>
	</div>
	</div>
	</div>
     
	 
	 <div class="row">
	<div class="form-group col-md-6">
	<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Checklist ID</label>
	<div class="col-md-8">
	<?php $id=$countid+1; $count='UK-DCL-'.$id; ?>
	<input type="text" id="chklist_id" name="chklist_id" value="<?php echo $count; ?>"  readonly="readonly" class="form-control"/>
	</div>
	</div>
	</div>
	
	<div class="row">
	<div class="form-group col-md-6">
	<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Checklist Document Name<span class="required" aria-required="true"> * </span></label>
	<div class="col-md-8">
	<input type="text" id="name" name="name" value=""  class="form-control"/>
	</div>
	</div>
	</div>

		<?php	/*	@Santosh Kumar	@Date - 01-05-2018	@Credit goes to - Kanhan	*/	?>	<div class="row">	<div class="form-group col-md-6">			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Upload of multiple versions allowed ?<span class="required" aria-required="true"> * </span></label>			<div class="col-md-8">			 <select name="is_multi_version_allowed" id="is_multi_version_allowed" class="form-control"   >		<option value="Y"  >Yes</option>		<option value="N" >No</option>		</select>		</div></div>	</div>	<div class="row">	<div class="form-group col-md-6">			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Validity of document required ?<span class="required" aria-required="true"> * </span></label>			<div class="col-md-8">			 <select name="is_validity_required" id="is_validity_required" class="form-control"   >		<option value="Y"  >Yes</option>		<option value="N" >No</option>		</select>		</div></div>	</div>	<div class="row">	<div class="form-group col-md-6">			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Reference no. of document required ?<span class="required" aria-required="true"> * </span></label>			<div class="col-md-8">			 <select name="is_document_reference_no_required" id="is_document_reference_no_required" class="form-control"   >		<option value="Y"  >Yes</option>		<option value="N" >No</option>		</select>		</div></div>	</div>	<!-- END -->		<div class="row">	<div class="form-group col-md-6">			<label class="col-lg-4 col-sm-4 control-label" for="application_name" >Is Active<span class="required" aria-required="true"> * </span></label>			<div class="col-md-8">			 <select name="is_docchklist_active" id="is_docchklist_active" class="form-control"   >		<option value="Y"  >Yes</option>		<option value="N" >No</option>		</select>		</div></div>	</div>


<div class="row buttons" align="center">
	<input type="submit" value="Save" class="btn btn-primary" >
	</div> 

</form>

</div></div></div></div><!-- form -->
<script>
function showUser(str) { //alert(str); //alert("<?php echo Yii::app()->request->baseUrl; ?>/infowizard/infowizarddocumentchklist/issuermapping"); 
$.ajax({
                type: "POST",
                url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/InfowizardDocumentchklist/issuermappingall",
				dataType:'json',
			    data:
                {
                post_issuerid: str
                },
			   
               success:  function(data) { //alert(data);
			   var $select = $('#issuerby_id');
			   $select.html('');
                $.each(data, function(index, element) {
           	
					$select.append('<option value="' + element.issmap_id + '">' + element.name + '</option>');
        		});
				//alert(data);
				},
			
            error:function(jqXHR, textStatus, errorThrown){
                alert('error::'+errorThrown);
            }
            });
}
</script>