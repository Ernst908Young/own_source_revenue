<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>Please wait...</title>
    <style type="text/css">
      body, html{
        background-color:#dedede;
      }
    </style>
  </head>
  <body>
    <h1>Please wait...</h1>
    <div>
    <?php
      // print_r($caf_application_id);die;

       $cafId = DefaultUtility::getEncryption($caf_application_id);
       $CafFields=json_decode($CAFFields);
       $company_name=DefaultUtility::getEncryption($CafFields->company_name);
       $firstName=DefaultUtility::getEncryption($_SESSION['RESPONSE']['first_name']);
       $lastName=DefaultUtility::getEncryption($_SESSION['RESPONSE']['last_name']);
       $mobileNumber=DefaultUtility::getEncryption($_SESSION['RESPONSE']['mobile_number']);
       $emailId=DefaultUtility::getEncryption($_SESSION['RESPONSE']['email']);
       $panNumber=DefaultUtility::getEncryption($_SESSION['RESPONSE']['pan_card']);
       $projectAddress=DefaultUtility::getEncryption($CafFields->Address);
       $projectPinCode=DefaultUtility::getEncryption($_SESSION['RESPONSE']['pin_code']);
       $serviceCode=DefaultUtility::getEncryption($service_id);

    ?>
    <form id='formid' method="post" action="<?=$CALL_BACK_URL ?>" >
      <input name="full_name" type="hidden" value="<?php if(isset($Profiles)) echo $Profiles['full_name'] ;?>" >
      <input name="email" type="hidden" value="<?php if(isset($Users)) echo $Users['email'] ;?>" >
      <input name="mobile" type="hidden" value="<?php if(isset($Profiles)) echo $Profiles['mobile_number'] ;?>" >
      <p><input type="hidden" value="<?=$message?>" name="SSO_MESSAGE" /></p>
      <p><input type="hidden" value="<?=$status_code?>" name="SSO_STATUS_CODE" /></p>
      <p><input type="hidden" value="<?=$token?>" name="SSO_TOKEN" /></p>
      <p><input type="hidden" value="<?=$href?>" name="SSO_HREF" /></p>
      <p><input type="hidden" value='<?=@$CAFFields?>' name="CAFFields" /></p>
      <p><input type="hidden" value="<?=@$CAFFieldStatus?>" name="CAFFieldStatus" /></p>
      <p><input type="hidden" value="<?=@$service_name?>" name="service_name" /></p>
      <p><input type="hidden" value="<?=@$service_id?>" name="service_id" /></p>
      <p><input type="hidden" value="<?=@$cafId?>" name="swsUserId" /></p>
      <p><input type="hidden" value="<?=@$company_name?>" name="organizationName" /></p>
      <p><input type="hidden" value="<?=@$firstName?>" name="firstName" /></p>
      <p><input type="hidden" value="<?=@$lastName?>" name="lastName" /></p>
      <p><input type="hidden" value="<?=@$mobileNumber?>" name="mobileNumber" /></p>
      <p><input type="hidden" value="<?=@$emailId?>" name="emailId" /></p>
      <p><input type="hidden" value="<?=@$panNumber?>" name="panNumber" /></p>
      <p><input type="hidden" value="<?=@$projectPinCode?>" name="projectPinCode" /></p>
      <p><input type="hidden" value="<?=@$projectAddress?>" name="projectAddress" /></p>
      <p><input type="hidden" value="<?=@$serviceCode?>" name="serviceCode" /></p>

      <input type="submit" value="Click me if you are stuck on this page" >
    </form>
    </div>
    <script type="text/javascript">
       document.getElementById('formid').submit();
    </script>
  </body>
</html>