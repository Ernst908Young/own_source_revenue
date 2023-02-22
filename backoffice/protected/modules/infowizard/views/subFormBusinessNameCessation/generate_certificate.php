<?php
/* Rahul Kumar  25032018 */
/* $ID = $_GET['service_id'];
$role_id=$_SESSION['role_id'];
$allData = Yii::app()->db->createCommand("SELECT id,service_id,current_role_id,next_role_id,can_forward,can_revert,can_reject,can_approve,can_comment FROM bo_infowiz_form_builder_configuration where service_id=$ID AND current_role_id=$role_id")->queryRow(); */
?>
<style>
.a_cent{
	text-align:center;
	vertical-align:middle !important;
}
.v_a{
	vertical-align:middle !important;
}
.portlet.box .dataTables_wrapper .dt-buttons {
    margin-top: -148px !important;
}
</style>
<form class="form form-horizontal" id="FB_form"	method="POST" enctype= "multipart/form-data" action="<?php echo Yii::app()->createAbsoluteUrl("/infowizard/subForm/generateCertificate/service_id/".$_GET['service_id']."/dept_id/".$_GET['dept_id']); ?>">
<div class="portlet light bordered">	
    <div class="portlet-body form">       
		<!--<textarea name="content" id="myeditor"></textarea>-->
		<!-- The toolbar will be rendered in this container. -->
		<div id="toolbar-container"></div>

		<!-- This container will become the editable. -->
		<div>
		<!--<p id="myeditor" ></p>-->
		<textarea name="content" id="myeditor" class="form-control" style="border:1px solid" rows="20"><?php echo htmlspecialchars($getContentArr['content']);?></textarea>
		</div>
		
    </div>
</div>
			
<div class="row">
	<div class="form-group col-md-12">
		<p style="text-align:center;">
			<input type='submit' class="btn btn-success" value="Submit">
		</p>
	</div>
</div>
</form>   
<!-- datepicker js 

<script src="https://cdn.ckeditor.com/ckeditor5/11.1.1/inline/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/11.1.1/classic/ckeditor.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/11.1.1/decoupled-document/ckeditor.js"></script>-->
<!--<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/ckeditor/decoupled_ckeditor.js" type="text/javascript"></script>-->

<script src="https://cdn.ckeditor.com/4.11.1/full/ckeditor.js"></script>
<script type="text/javascript">
CKEDITOR.replace('myeditor');
 /*ClassicEditor
        .create( document.querySelector( '#myeditor' ) )
        .catch( error => {
            console.error( error );
        } ); 
  DecoupledEditor
	.create( document.querySelector( '#myeditor' ) )
	.then( editor => {
		const toolbarContainer = document.querySelector( '#toolbar-container' );

		toolbarContainer.appendChild( editor.ui.view.toolbar.element );
	} )
	.catch( error => {
		console.error( error );
	} );*/	
</script>