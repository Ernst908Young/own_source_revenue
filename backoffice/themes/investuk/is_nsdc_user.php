<style>
    .page-content-wrapper .page-content {
    margin-top: 30px;}
</style>
    <?php 
$appsModel= new ApplicationVerificationLevelExt;
$Pendingapp=$appsModel->getApplication($_SESSION['uid']);
$frdApps=$appsModel->getForwardedApplications($_SESSION['uid']);
?>
<div class="container-fluid main-menu">
	<div class="row">
		<div class="col-xs-12">
			<div class="nav-top">
				<div class="">
					<div id="cssmenu" class="dashboard-header-menu">
						<ul class="main-header-menu ">										
							<li class="main-header-menu-li <?php if(($controller=='default') && ($action=='index')){ echo "active";} ?>"><a href="<?=Yii::app()->createAbsoluteUrl('/admin');?>">Dashboard</a></li>
                                                        <li class="main-header-menu-li"><a href="#">PM Tool</a></li>
                                                        <li class="main-header-menu-li"><a href="#">CRM</a></li>
                                                        <li class="main-header-menu-li"><a href="#" title="Helpdesk" >Helpdesk</a>
                                                            <ul><li class="main-header-menu-li"><a href="#" title="Query" >Query</a></li></ul>
                                                        </li>
                                                </ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('document').ready(function(){
		$('.pBadge').html('<?=@$pCount?>');
		$('.fBadge').html('<?=@$countfw?>');
		$('.oBadge').html('<?=@$countoth?>');
	});
</script>	