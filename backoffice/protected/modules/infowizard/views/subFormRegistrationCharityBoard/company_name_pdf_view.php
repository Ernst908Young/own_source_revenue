<style type="text/css">
  .latabv {
    border: 1px solid black;
  }
</style>
<table style="padding-top: 10px;">
    <tr>
    <td style="text-align:center;">     
        <span style="font-size: 13;">CHARITIES ACT, CAP.243</span><br>   <br>   
        <span style="font-size: 14;"><strong>APPLICATION FOR INCORPORATION AS A BOARD</strong></span>   <br><br>
        <span style="font-size: 13;">FORM 2</span>   <br><br><br>
     
    </td>
     </tr>
</table>

<table style="padding-top: 10px; font-size: 12;" width="100%">
    <tr>
      <td width="5%">     
        1. 
      </td>
      <td width="95%"><strong>We being Trustees for </strong><?php  if(isset($fieldValues['UK-FCL-00187_0'])){ echo $fieldValues['UK-FCL-00187_0'];}?><strong>hereby apply to be incorporated as a Board under the provisions of the Charities Act Cap. 243.</strong>
      	<br>
      </td>
    </tr>
     <tr>
      <td width="5%">     
        2. 
      </td>
      <td width="95%"><strong>We desire the name of the Board to be </strong> <br><br><?php  if(isset($fieldValues['UK-FCL-00189_0'])){ echo $fieldValues['UK-FCL-00189_0'];}?>
      	<br>
      </td>
    </tr>
    <tr>
      <td width="5%">     
        3. 
      </td>
      <td width="95%"><strong>The registered office of the Board is to be at </strong><br><br>
         <?php   
      $parish1 = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00129_0'])->queryRow(); 

if($fieldValues['UK-FCL-00094_0']){

       $prases1 = Yii::app()->db->createCommand("SELECT * from bo_postalcode_in_barbados where id=".$fieldValues['UK-FCL-00094_0'])->queryRow(); 
       $pc1 = $prases1['code'];
      }else{
        $pc1 = "";
      }

       

      echo @$fieldValues['UK-FCL-00308_0'].' '.@$fieldValues['UK-FCL-00309_0'].' '.@$fieldValues['UK-FCL-00310_0'].' '. @$pc1.' '.@$parish1['lr_name'].' '.@$fieldValues['UK-FCL-00096_0'] ; 
?>
     
        <br><small>(Please state an address with sufficient particularity for service by hand and service by post of documents thereat)</small> 
      	<br>
      </td>
    </tr>
    <tr>
      <td width="5%">     
        4. 
      </td>
      <td width="95%"><strong>This application is made with the authority of </strong><br><br><?php echo $fieldValues['UK-FCL-00193_0']; ?><br><?php echo $fieldValues['UK-FCL-00194_0']; ?><br><small>(State name of society for which the trustees act and mode of authorisation by the society. If there is no such society this should be stated)</small> 
      	<br>
      </td>
    </tr>
    <tr>
      <td width="5%">     
        5. 
      </td>
      <td width="95%"><strong>The said society is registered as a charity but not itself incorporated</strong><br><br><?php echo isset($fieldValues['UK-FCL-00195_0']) ? $fieldValues['UK-FCL-00195_0'] : ''; ?><br>
      	<br>
      </td>
    </tr>
 	<!-- <tr>
      <td width="5%">     
        6. 
      </td>
      <td width="95%"><strong>The particulars of registration are</strong><br><br><br>
      	<br>
      </td>
    </tr> -->
</table>
<!-- <div style="page-break-after:always;"></div> -->

<table style="padding-top: 10px; font-size: 12;" width="100%">
    <tr>
      <td width="5%">     
        6. 
      </td>
      <td width="95%"><strong>Please give details of any applicant, trustee, officer and beneficiary who holds or has held</strong><br><br><table width="100%">
      		<tr>
      			<td width="5%">a)</td>
      			<td width="95%"><span style="text-align: justify;">a prominent public office, for example, a Head of State, any Judicial Officer, a Permanent Secretary, a Minister or a Chief Executive Officer or director of a state owned enterprise; or</span></td>
      		</tr><br>
      		<tr>
      			<td width="5%">b)</td>
      			<td width="95%"><span style="text-align: justify;">a prominent public office in an international organization, for example, director, deputy director, member of the board or an equivalent function.</span></td>
      		</tr>
      	</table>
      	<br>
      </td>
    </tr>  
    <div style="page-break-after:always;"></div> 
      <tr>
  <td width="5%"></td>
  <td width="95%"><table style="padding-top: 10px; font-size: 12; border: 1px solid black; border-collapse: collapse; padding: 5px;">
  <tr>
    <th class="latabv"><strong>Full Name</strong></th>
    <th class="latabv"><strong>Designation</strong></th>
    <th class="latabv"><strong>Details of office held</strong></th>
    <th class="latabv"><strong>Name of Organisation</strong></th>
    <th class="latabv"><strong>Date of appointment</strong></th>
    <th class="latabv"><strong>Date of cessation</strong></th>
    <th class="latabv"><strong>Additional Information</strong></th>   
  </tr>

  <?php 
     if(isset($fieldValues['UK-FCL-00301_0']) && is_array($fieldValues['UK-FCL-00301_0'])){
     $arrayFields = $fieldValues['UK-FCL-00301_0'];
         
     foreach ($arrayFields as $key => $value) {  ?>
  <tr>
      <td class="latabv"><?php echo @$value.' '.@$fieldValues['UK-FCL-00105_0'][$key].' '.@$fieldValues['UK-FCL-00324_0'][$key];?></td>
      <td class="latabv"><?php echo @$fieldValues['UK-FCL-00323_0'][$key];?></td>
      <td class="latabv"><?php echo @$fieldValues['UK-FCL-00181_0'][$key];?></td>
      <td class="latabv"><?php echo @$fieldValues['UK-FCL-00185_0'][$key];?></td>
      <td class="latabv"><?php echo @$fieldValues['UK-FCL-00182_0'][$key];?></td>
      <td class="latabv"><?php echo @$fieldValues['UK-FCL-00183_0'][$key];?></td>
      <td class="latabv"><?php echo @$fieldValues['UK-FCL-00206_0'][$key];?></td>
  </tr>
<?php } } ?>

</table></td>
</tr>
</table>

<br><br><br><br><br><br><br><br><br>


<table style="padding-top: 10px; font-size: 12;" width="100%">
	<tr style="text-align: center;">
		<td width="50%">Name of Applicant</td>
		<td width="50%">Electronically signed </td>
	</tr><br><br><br>
	<tr style="text-align: center;">
		<td width="50%">Name of Applicant</td>
		<td width="50%">Electronically signed </td>
	</tr><br><br><br>
	<tr style="text-align: center;">
		<td colspan="2">Dated this &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; day &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; , &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.</td>		
	</tr>
</table>