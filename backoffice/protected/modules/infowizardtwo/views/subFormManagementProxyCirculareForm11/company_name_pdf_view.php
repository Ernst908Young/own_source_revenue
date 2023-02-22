
<table style="padding-top: 10px;">
    <tr>
      <td style="text-align:center;">     
        <span style="font-size: 13;">COMPANIES ACT OF BARBADOS</span>
    </td>
     </tr>
       <tr>
        <td style="text-align:center;">
             <span style="font-size: 13;">(Section 140)</span>       
        </td>
     </tr>
       <tr>
         <td style="text-align:center;">
             <span style="font-size: 11;"><strong>MANAGEMENT PROXY CIRCULAR (Form 11)</strong></span>           
        </td>        
        </tr>
</table>
<br><br><br>

<table style="padding-top: 10px; font-size: 12;" width="100%">
    <tr>
      <td width="5%">     
        1. 
      </td>
      <td width="95%"><strong>Name of Company: </strong><br><br><?php  if(isset($fieldValues['UK-FCL-00089_0'])){ echo $fieldValues['UK-FCL-00089_0'];}?>        
      </td>
    </tr>
    
    <tr>
      <td width="5%">  
      2.      
      </td>
      <td width="95%"><strong>Company Number:</strong><br><br><?= $fieldValues['UK-FCL-00403_0'] ?>   
      </td>
    </tr> 
    <tr>
      <td width="5%"> 
      3.        
      </td>
      <td width="95%"><strong>Particulars of Meeting: </strong><br><br><?php echo @$fieldValues['UK-FCL-00550_0']?>

      </td>
    </tr>
    
    
    <tr>
      <td width="5%">    
      4.    
      </td>
      <td width="95%"><strong>Solicitation:</strong><br><br><?php 
          echo @$fieldValues['UK-FCL-00552_0']
        ?>
        
      </td>
    </tr>
    <tr>
      <td width="5%">    
      5.    
      </td>
      <td width="95%"><strong>Any director’s statement submitted pursuant to section 71(2): </strong><br><br><?php 
          echo @$fieldValues['UK-FCL-00617_0']
        ?>
        
      </td>
    </tr>
    <tr>
      <td width="5%">    
      6.    
      </td>
      <td width="95%"><strong>Any auditor’s statement submitted pursuant to section 163(1):</strong><br><br><?php 
          echo @$fieldValues['UK-FCL-00637_0']
        ?>
        
      </td>
    </tr>
    <tr>
      <td width="5%">    
      7.    
      </td>
      <td width="95%"><strong>Any shareholder’s proposal and/or statement submitted pursuant to sections 112(a) and113(2): </strong><br><br><?php 
          echo @$fieldValues['UK-FCL-00636_0']
        ?>
        
      </td>
    </tr>
   

</table>

<style type="text/css">
  .latabv {
    border: 1px solid black;
  }
</style>
<br><br><br><br>

<?php if($app_status=='A'){ 
  echo $this->renderPartial('/subForm/documents_on_pdf',['app_id'=>$app_id]);
 } ?>

 <br><br><br><br>
<table style=" font-size: 12; border-collapse: collapse; ">
      <tr>
         <td style="text-align:center;">
            <span style="font-size: 12;"><strong> SIGNATORY DETAILS</strong></span>           
         </td>
      </tr>
     <br>
       <tr>
         <td>
      <table style="padding-top: 10px; font-size: 12; border: 1px solid black; border-collapse: collapse; padding: 5px;">
         <tr>
            <th class="latabv"><strong>Full Name</strong></th>           
            <th class="latabv"><strong>Designation </strong></th>
            <th class="latabv"><strong>Signature </strong></th>
            <th class="latabv"><strong>Date of Signature </strong></th>
         </tr>
         <?php        
          if(isset($signatoryDetails) && count($signatoryDetails) > 0){
            foreach ($signatoryDetails as $key => $signDetails) {
              $signDate=date('d M,Y',strtotime($signDetails['date_of_signing']));
              echo '<tr>
                      <td class="latabv">'.$signDetails['first_name'].' '.$signDetails['middle_name'].' '.$signDetails['last_name'].'</td>
                      <td class="latabv">'.$signDetails['designation'].'</td>
                      <td class="latabv">Electronically signed</td>
                      <td class="latabv">'.$signDate.'</td>
                  </tr>';
            }
          }
         ?>         
      </table>
    </td>
  </tr>
</table>
