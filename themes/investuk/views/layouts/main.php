<?php
/* Rahul Kumar 29062018 */

/* Including Header  */

if(!isset($_SESSION['RESPONSE']['user_id']) && !isset($_SESSION['role_id'])){
	include('/var/www/html/themes/investuk/header.php');
}else{
    include('/var/www/html/backoffice/themes/investuk/header_logged.php');
?>
	<style>
		header.main-header{
			display:none;
		}
		.ps-dashboard-container .panel-heading a{
			color:#fff;
		}
	</style>
<?php
}

/* End Of Adding Header */ ?>
<!--<div class="inner-header">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<h2 class="pageTitle"></h2>
				<ul class="inner-header-breadcrum">
					<li><a href="#">You are now on</a></li>
					<li class="pageTitle"></li>
				</ul>
			</div>
		</div>
	</div>
</div>
<div class="body_section">
	<div class="container">
    <div class="mid-section inner-contents">-->
	<!-- END HEADER & CONTENT DIVIDER -->
	<!-- BEGIN CONTAINER -->
	<!-- END HEADER & CONTENT DIVIDER -->
	<!-- BEGIN CONTAINER -->

	<div class="page-container <?php if(DefaultUtility::is_PRINCIPAL_SECRETARY() || DefaultUtility::is_CHEIF_SECRETARY() || RolesExt::isMISManager() || RolesExt::isMISAdmin() || RolesExt::isAdmin() || (isset($_SESSION['RESPONSE']['user_id']) && DefaultUtility::isInvestorLoggedIn())){	echo "ps-dashboard-container";}?>">
		<?php if(!DefaultUtility::is_PRINCIPAL_SECRETARY() && !DefaultUtility::is_CHEIF_SECRETARY() && !RolesExt::isMISManager() && !RolesExt::isMISAdmin() &&	(!isset($_SESSION['RESPONSE']['user_id']) && !DefaultUtility::isInvestorLoggedIn())){ ?>
		<!--<div class="page-sidebar-wrapper">
           <?php
			/* Including LeftSideBar  */
			// include('/var/www/html/backoffice/themes/investuk/investor.php');
			/* End of LeftSideBar */
			?>
		</div>-->
		<?php } ?>
		<div class="page-content-wrapper">
            <div class="page-content">
			<?php
			/* Including Inner Content */
			echo $content;
			/* End of Adding Inner Content */
			?>
			<?php
            if(!isset($_SESSION['RESPONSE']['user_id']) && !isset($_SESSION['role_id'])){
                include('/var/www/html/themes/investuk/footer.php');
            }else{
				/* Including Footer  */
				include('/var/www/html/backoffice/themes/investuk/footer_logged.php');
				/* End of Adding Footer */
            }
			?>
			</div>
		</div>
    </div>
	</div>
  <!-- </div>
   </div>
   </div> -->
<?php
/* Including Footer  */
//include('/var/www/html/backoffice/themes/investuk/footer_logged.php');
/* End of Adding Footer */
?>

<script>
   /*  $(window).load(function(){
     var pt=  $(".page-title").html();
        $(".pageTitle").html(pt);
        $(".main-header").css('display','none');
    });
    $(document).ready(function(){
     var pt=  $(".page-title").html();
        $(".pageTitle").html(pt);
        $(".main-header").css('display','none');
    }); */
</script>
