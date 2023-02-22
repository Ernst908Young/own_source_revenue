<!-- <1?php 

if(!isset($_SESSION['RESPONSE']['user_id']) && !isset($_SESSION['role_id'])){
    include('/var/www/html/themes/investuk/header.php');
}else{
    include('/var/www/html/backoffice/themes/investuk/header_logged.php');
}
 ?>	
 <div class="page-container <1?php if(DefaultUtility::is_PRINCIPAL_SECRETARY() || DefaultUtility::is_CHEIF_SECRETARY() || RolesExt::isMISManager() || RolesExt::isMISAdmin() || RolesExt::isDMUser() || DefaultUtility::isHODNodal() || DefaultUtility::isSECRETARY() || DefaultUtility::isDisttApproverUser() || DefaultUtility::isNoodalAgency() || DefaultUtility::isStateNodalUser() || DefaultUtility::isStateApproverUser() || DefaultUtility::isDisttCommentLevelUser() || DefaultUtility::isStateCommentLevelUser() || DefaultUtility::isValidDocumentVerifierLogin() || DefaultUtility::isVerifier() || DefaultUtility::isSupport() ||  DefaultUtility::isApprover() || DefaultUtility::isAdmin() || (isset($_SESSION['role_id']) && in_array($_SESSION['role_id'],array('89','90','92'))) || (isset($_SESSION['RESPONSE']['user_id']) && DefaultUtility::isInvestorLoggedIn())){	echo "ps-dashboard-container";}?>"> 

		<1?php if(!DefaultUtility::is_PRINCIPAL_SECRETARY() && !DefaultUtility::is_CHEIF_SECRETARY() && !RolesExt::isMISManager() && !RolesExt::isMISAdmin() && !DefaultUtility::isVerifier() && !DefaultUtility::isApprover() && !RolesExt::isDMUser() && !DefaultUtility::isAdmin() &&	(!isset($_SESSION['RESPONSE']['user_id']) && !DefaultUtility::isInvestorLoggedIn())){ ?>
		
		<1?php } ?>
		<div class="page-content-wrapper">
            <div class="page-content">				
			<1?php echo $content; ?>
			<1?php
			
			if(!isset($_SESSION['RESPONSE']['user_id']) && !isset($_SESSION['role_id'])){
                include('/var/www/html/themes/investuk/footer.php');
            }else{
				
				include('/var/www/html/backoffice/themes/investuk/footer_logged.php');
			
            } 			
			?>
			</div>				
		</div>
    </div>
	</div>	 -->

	<?php if(!isset($_SESSION['RESPONSE']['user_id']) && !isset($_SESSION['role_id']))
	{ 
			
		?>
				<!DOCTYPE html>
				<html>
				<head>
				<style>
				h1 {text-align: center;}
				p {text-align: center;}
				div {text-align: center;}
				a{text-align: center;}
				</style>
				</head>
				<body style="background-color:  #ff00000d;">

				<h1>Session has been expired. Please Login
				
				<a href="/sso/account/signin"> Login Again</a></h1>
				</body>
				</html>
		<!--  -->


		
	<?php header("Location: /sso/account/signin");
			die();
		}else{

			 include('/var/www/html/backoffice/themes/investuk/header_logged.php'); ?>


			 

			 <div class="page-container <?php if(DefaultUtility::is_PRINCIPAL_SECRETARY() || DefaultUtility::is_CHEIF_SECRETARY() || RolesExt::isMISManager() || RolesExt::isMISAdmin() || RolesExt::isDMUser() || DefaultUtility::isHODNodal() || DefaultUtility::isSECRETARY() || DefaultUtility::isDisttApproverUser() || DefaultUtility::isNoodalAgency() || DefaultUtility::isStateNodalUser() || DefaultUtility::isStateApproverUser() || DefaultUtility::isDisttCommentLevelUser() || DefaultUtility::isStateCommentLevelUser() || DefaultUtility::isValidDocumentVerifierLogin() || DefaultUtility::isVerifier() || DefaultUtility::isSupport() ||  DefaultUtility::isApprover() || DefaultUtility::isAdmin() || (isset($_SESSION['role_id']) && in_array($_SESSION['role_id'],array('89','90','92'))) || (isset($_SESSION['RESPONSE']['user_id']) && DefaultUtility::isInvestorLoggedIn())){	echo "ps-dashboard-container";}?>"> 

		<?php if(!DefaultUtility::is_PRINCIPAL_SECRETARY() && !DefaultUtility::is_CHEIF_SECRETARY() && !RolesExt::isMISManager() && !RolesExt::isMISAdmin() && !DefaultUtility::isVerifier() && !DefaultUtility::isApprover() && !RolesExt::isDMUser() && !DefaultUtility::isAdmin() &&	(!isset($_SESSION['RESPONSE']['user_id']) && !DefaultUtility::isInvestorLoggedIn())){ ?>
		
		<?php } ?>
		<div class="page-content-wrapper">
            <div class="page-content">				
			<?php echo $content; ?>
			<?php
			
			if(!isset($_SESSION['RESPONSE']['user_id']) && !isset($_SESSION['role_id'])){
                include('/var/www/html/themes/investuk/footer.php');
            }else{
				
				include('/var/www/html/backoffice/themes/investuk/footer_logged.php');
			
            } 			
			?>
			</div>				
		</div>
    </div>
	</div>

	<?php	} ?>

 