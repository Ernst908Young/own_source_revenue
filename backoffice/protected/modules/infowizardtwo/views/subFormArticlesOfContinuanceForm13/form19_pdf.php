<table style="padding-top: 10px;">
   <tr>
      <td style="text-align:center;">     
         <span style="font-size: 14;">SOCIETIES WITH RESTRICTED LIABILITY ACT OF BARBADOS</span>
      </td>
   </tr>
   <tr>
      <td style="text-align:center;">
         <span style="font-size: 14;">(Section 50)</span><br>       
      </td>
   </tr>
   <tr>
      <td style="text-align:center;">
         <span style="font-size: 14;"><strong>APPOINTMENT OF REGISTERED AGENT</strong></span>           
      </td>
   </tr>
</table>
<br><br><br>

<table style="font-size: 12;" width="100%">
   <tr>
      <td width="100%">
         <strong> Know all men by these presents that</strong> <?php  echo $fieldValues['UK-FCL-00197_0'] ?><br>
      </td>
   </tr>
   <tr>
      <td width="50%"></td>
      <td width="50%">
         <span style="display: block;margin-bottom: 0;text-align: right;">(Name and address of Society)</span>  <br>    
      </td>
   </tr>
   <tr>
      <td width="100%"><strong>(hereinafter called the 'Society')</strong></td>
   </tr>
   <tr>
      <td> 
         Hereby appoints:<br>
         <?php 
            $firstname = !empty($fieldValues['UK-FCL-00150_0']) ? ' '.$fieldValues['UK-FCL-00150_0'] : '';
            $midname = !empty($fieldValues['UK-FCL-00133_0']) ? ' '.$fieldValues['UK-FCL-00133_0'] : '';
            $lastname = !empty($fieldValues['UK-FCL-00324_0']) ? ' '.$fieldValues['UK-FCL-00324_0'] : '';
            ?>
         <?php  echo $firstname.''.$midname.' '.$lastname; ?>
      </td>
   </tr>
   <tr>
      <td width="70%">
      </td>
      <td width="30%">
         As its Registered Agent
      </td>
   </tr>
   <tr>
      <td>
         <span style="display: block;margin-bottom: 0;">(Name and address of registered agent)</span> <br>
      </td>
   </tr>
   <tr>
      <td width="100%" style="text-align: justify;"><strong>to act as such, and as such to sue or be sued, plead and be impleaded in any Court in Barbados, and 
         generally on behalf of the Society within Barbados to accept service of process and to receive all lawful 
         notices and, for the purposes of the Society to do all the acts and to execute all deeds and other 
         instruments relating to the matters within the scope of this appointment. It is hereby declared that 
         service of process in respect of suits and proceedings against the society and of lawful notices on the 
         Registered Agent will be binding on the Society for all purposes.</strong><br><br>
      </td>
   </tr>
</table>
<style type="text/css">
   .latabv {
   border: 1px solid black;
   }
</style>
<?php if($app_status=='A'){ 
   echo $this->renderPartial('/subForm/documents_on_pdf',['app_id'=>$app_id]);
 } ?>
