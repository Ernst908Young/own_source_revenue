<?php 
$show_main = true;
if(isset($_GET['is_vpd'])){
  if($_GET['is_vpd']=='yes'){
    $show_main = false;
  }
} ?>
<table style="padding-top: 10px;">
    <tr>
      <td style="text-align:center;">     
        <span style="font-size: 18;">COMPANIES ACT OF BARBADOS</span>
    </td>
     </tr>
       <tr>
        <td style="text-align:center;">
             <span style="font-size: 18;">(Section 332)</span>       
        </td>
     </tr>
       <tr>
         <td style="text-align:center;">
             <span style="font-size: 14;"><strong>POWER OF ATTORNEY</strong></span>           
        </td>        
        </tr>
</table>
<br><br><br><br>

<table width="100%">
    <tr>
      <td width="100%"><strong>Know all men by these presents that</strong>
        <br><br><?= @$fieldValues['UK-FCL-00403_0'] .' | '.@$fieldValues['UK-FCL-00089_0'] .' | '.@$fieldValues['UK-FCL-00412_0'] ?> 
        <br><span style="color:#777777;display: block;margin-bottom: 0;">(Number Name and address of external companies)</span>
        <br><br><strong>(hereinafter called the “Company”)</strong>
        <br><strong>hereby appoints:</strong><br>
      </td>     
    </tr>
    <tr>
      <td width="100%"><?php $name = !empty(@$fieldValues['UK-FCL-00105_0']) ? @$fieldValues['UK-FCL-00105_0']:'';?><?= @$fieldValues['UK-FCL-00132_0'].$name.' '.@$fieldValues['UK-FCL-00106_0'].' | ' ?><?php 
      if($show_main==true){ 
       echo @$fieldValues['UK-FCL-00093_0'].' '. @$fieldValues['UK-FCL-00309_0'].'  '.@$fieldValues['UK-FCL-00310_0'] .' '.InfowizardQuestionMasterExt::getCountryStateNameByID(@$fieldValues['UK-FCL-00129_0']) .' '. InfowizardQuestionMasterExt::getCountryStateNameByID(@$fieldValues['UK-FCL-00096_0']).'  '.@$fieldValues['UK-FCL-00094_0']; 
      }else{
                    echo 'XXXXX';
              }
              ?>
     <br><span style="color:#777777;display: block;margin-bottom: 0;">(Name and address of attroney)</span> 
     <br><br><strong style="text-align:justify">its true and lawful attorney, to act as such, and as such to sue and be sued, plead and be impleaded in any Court in Barbados, and generally on behalf of the Company within Barbados to accept service of process and to receive all lawful notices and, for the purposes of the Company to do all the acts and to execute all deeds and other instruments relating 
     to the matters within the scope of this power of attorney. It is hereby declared that service of process in respect of suits 
     and proceedings by or against the Company and of lawful notices on the attorney will be binding on the Company for all 
     purposes. Where more than one person is hereby appointed attorney, any one of them, without the others, may act as true and lawful Attorney of the Company. <br> <br>This appointment revokes all previous appointments in so far as such appointment relates to the scope of the powers 
     prescribed by this power.</strong><br><br>
      </td>
    </tr>

</table>
<style type="text/css">
  .latabv {
    border: 1px solid black;
  }
</style>
<br><br>
<br><br>
<table style="border-collapse: collapse; ">
      <tr>
         <td style="text-align:center;">
            <strong> SIGNATORY DETAILS</strong> 
         </td>
      </tr>
     <br>
       <tr>
         <td>
      <table style="padding: 5px;">
         <tr nobr="true">
            <th class="latabv"><strong>Full Name</strong></th>           
            <th class="latabv"><strong>Designation </strong></th>
            <th class="latabv"><strong>Signature </strong></th>
            <th class="latabv"><strong>Date of Signature </strong></th>
         </tr>
         <?php        
          if(isset($signatoryDetails) && count($signatoryDetails) > 0){
            foreach ($signatoryDetails as $key => $signDetails) {
              $signDate=date('d M,Y',strtotime($signDetails['date_of_signing']));
              echo '<tr nobr="true">
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

