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
<br><br><br>

<table style="padding-top: 10px;" width="100%">
    <tr>
        <td>I, <?php $name = !empty(@$fieldValues['UK-FCL-00105_0']) ? ' '.@$fieldValues['UK-FCL-00105_0']:'';?>
     <?= @$fieldValues['UK-FCL-00132_0'].$name.' '.@$fieldValues['UK-FCL-00106_0'] ?></td>
    </tr>
    <tr>
        <td style="text-align: center;"><strong>Name of Attroney</strong></td>
    </tr>
    <tr>
        <td>of  <?= @$fieldValues['UK-FCL-00093_0'].' '. @$fieldValues['UK-FCL-00309_0'].'  '.@$fieldValues['UK-FCL-00310_0'] .' '.InfowizardQuestionMasterExt::getCountryStateNameByID(@$fieldValues['UK-FCL-00129_0']) .' '. InfowizardQuestionMasterExt::getCountryStateNameByID(@$fieldValues['UK-FCL-00096_0']).'  '.@$fieldValues['UK-FCL-00094_0'] ?></td>
    </tr>
    <tr>
        <td style="text-align: center;"><strong>business Address</strong></td>
    </tr>
    <tr>
        <td><strong>hereby consent to act as the attorney for</strong></td>
    </tr>
    <tr>
        <td><strong>pursuant to the Power of Attorney dated the</strong></td>
    </tr>
    <tr>
        <td><strong>filed herewith.</strong><br><br><br></td>
    </tr>
    <!--tr>
        <td><strong>Dated this day of , </strong></td>
    </tr>
    <tr>
        <td><strong>Witnessed:</strong></td>
    </tr>
    <tr>
        <td width="50%"><strong>Signature:</strong></td>
        <td width="50%"><strong>Signature of Attroney:</strong></td>
    </tr>
    <tr>
        <td><strong>Address:</strong></td>
    </tr>
    <tr>
        <td><strong>Occupation:</strong></td>
    </tr-->
</table>

<style type="text/css">
  .latabv {
    border: 1px solid black;
  }
</style>
<br><br><br>
<?php if($app_status=='A'){ 
   echo $this->renderPartial('/subForm/documents_on_pdf',['app_id'=>$app_id]);
 } ?>
 <br><br><br>

<table style="border-collapse: collapse; ">
      <tr>
         <td style="text-align:center;">
            <span><strong> SIGNATORY DETAILS</strong></span>           
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
