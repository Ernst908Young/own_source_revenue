<style type="text/css">
  .fa-spin-hover {
      animation: fa-spin 2s infinite linear;
  }
  @-webkit-keyframes fa-spin{0%{-webkit-transform:rotate(0deg);transform:rotate(0deg)}100%{-webkit-transform:rotate(359deg);transform:rotate(359deg)}}
  @keyframes fa-spin{0%{-webkit-transform:rotate(0deg);transform:rotate(0deg)}100%{-webkit-transform:rotate(359deg);transform:rotate(359deg)}}
}
</style>
<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>Add New Departmental User</div>
    <div class='tools'>
	
	</div>
</div>
 <div class="portlet-body">
 <?php if(Yii::app()->user->hasFlash('success')):?>
	<div class="info">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
 <?php else: ?>
 <?php 
	$this->renderPartial('_formUser', array('model'=>$model,'model_role'=>$model_role,'action'=>$action)); 
	/* if(count($datas)>0){
	}else{
		echo "All districts have users.";
	} */
	endif;
 ?>
 
 
</div>
</div>


 <?php
$base=Yii::app()->theme->baseUrl;
?>
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
	function resetForm(val){
		$('#User_full_name').val('');
		$('#User_email').val('');
		$('#User_password').val('');
		$('#User_mobile').val('');
	}
	
</script>
