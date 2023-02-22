<?php extract($_GET);
$getSubMissionData = Yii::app()->db->createCommand("SELECT app_id FROM bo_sp_applications where sno='$sno'")->queryRow();
$uid = $_SESSION['RESPONSE']['user_id'];
$iuid = $_SESSION['RESPONSE']['iuid'];
$applicationID = $getSubMissionData['app_id'];
$ReferenceKey = ($iuid + $applicationID) * $uid;
$PaymentReferenceKey = base64_encode($ReferenceKey);
?>


<form action="/backoffice/infowizard/payment/VerifyPayment/dev/Y" method="post" id="VerificationRedirect">
    <input type="hidden" id="PrKey" name="Payment[PrKey]" value="<?php echo $PaymentReferenceKey; ?>">
    <input type="hidden" class="csrftoken" name="Payment[YII_CSRF_TOKEN_SUBMIT]" value="<?php echo Yii::app()->request->csrfToken; ?>">	
</form>


<script  type="text/javascript">
	$(document).ready(function(){
            $("#VerificationRedirect").submit();
        });        
</script>