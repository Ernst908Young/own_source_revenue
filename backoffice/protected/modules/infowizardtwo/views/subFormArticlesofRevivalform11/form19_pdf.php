<style type="text/css">
  .latabv {
    border: 1px solid black;
  }
</style>
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
        <span style="font-size: 13;">SOCIETIES WITH RESTRICTED LIABILITY ACT OF BARBADOS</span><br>
        <span style="font-size: 12;">(Sections 50)</span>   <br><br>
     
        <span style="font-size: 14;"><strong>APPOINTMENT OF REGISTERED AGENT (Form 19)</strong></span>  
    </td>
     </tr>
</table>



<br><br>

<table style="padding-top: 10px; font-size: 12;" width="100%">
<tr>
     
      <td><strong>Know all men by these presents that</strong></td>
  </tr>
  <tr>
      <td><?php $sode = Yii::app()->db->createCommand("SELECT * FROM bo_company_details WHERE reg_no=".$fieldValues['UK-FCL-00290_0'])->queryRow(); ?>
      	<?php echo $sode['company_name'].' '.$sode['address'] ?>
      </td>
    </tr>

    <tr>
     
      <td><strong>Hereby appoints:</strong></td>
  </tr>
  <tr>
      <td><?php
      if(isset( $fieldValues['UK-FCL-00355_0'])){
        if($fieldValues['UK-FCL-00355_0']){
          $parish1 = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00355_0'])->queryRow(); 
        }else{
          $parish1 = [];
        }
        }else{
           $parish1 = [];
        }

          
    



      echo @$fieldValues['UK-FCL-00301_0'].' '.@$fieldValues['UK-FCL-00466_0'].' '.@$fieldValues['UK-FCL-00324_0'];?>

		<?php if($show_main==true){ echo @$fieldValues['UK-FCL-00169_0'].' '.@$fieldValues['UK-FCL-00353_0'].@$fieldValues['UK-FCL-00399_0'].'  '.@$parish1['lr_name'].' '.@$fieldValues['UK-FCL-00357_0'].' '.@$fieldValues['UK-FCL-00460_0'];
		}else{
			echo "Not available publicly";
		}?></td>

      
    </tr>
    <tr>
    	<td width="100%">
    		<span style="text-align: justify;">to act as such, and as such to sue or be sued, plead and be impleaded in any Court in Barbados, and generally on behalf of the Society within Barbados to accept service of process and to receive all lawful notices and, for the purposes of the Society to do all the acts and to execute all deeds and other instruments relating to the matters within the scope of this appointment. It is hereby declared that service of process in respect of suits and proceedings against the society and of lawful notices on the Registered Agent will be binding on the Society for all purposes.</span>
    	</td>
    </tr>
</table>
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
      <table style="padding-top: 10px; font-size: 12; border: 1px solid black; border-collapse: collapse; ">
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