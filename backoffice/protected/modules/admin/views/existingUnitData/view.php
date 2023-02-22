<div class='portlet box green detail_page'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>View Of Existing Unit Data</div>
    <div class='tools'>
	<div class="dt-buttons">
	     <a class="dt-button buttons-print btn btn-primary hide_me"  href="<?=Yii::app()->createAbsoluteUrl('admin/existingUnitData/index');?>"><span>View List</span></a>
 
	</div>
	</div>
</div>
    
	<?php  include('detail_view.php');   ?>
	
</div>


<script type="text/javascript">

	function printMe(){
		$('.hide_me').hide();
		$('.detail_page').removeClass('box');
		window.print('div_print');
		$('.hide_me').show();
		$('.detail_page').addClass('box');
		
	}

</script>
