<?php 

 /*echo '<pre>';
   print_r($fieldValues);
   die;*/

 ?>

<table style="padding-top: 10px;">
    <tr>
    <td style="text-align:center;">     
        <span style="font-size: 13;">CHARITIES ACT, CAP.243</span> 
        <span style="font-size: 14;"><strong><p>APPLICATION FOR REGISTRATION OF A CHARITY</p></strong></span>   <br><br>
        <span style="font-size: 13;"><strong>FORM 1</strong></span><br><br><br>
     
    </td>
     </tr>
</table>


<!-- <div style="page-break-after:always;"></div> -->

<table style="padding-top: 10px; font-size: 12;" width="100%">
    <tr>
      <td width="5%"></td>
      <td width="95%">
        <p><strong>We the undersigned being the Charity Trustees of the Charity called the </strong></p> 
        <p><?php  if(isset($fieldValues['UK-FCL-00111_0'])){ echo $fieldValues['UK-FCL-00111_0'];}?></p>
        <p><strong>HEREBY APPLY to have the said charity registered under the abovementioned Act.</strong></p>
      </td>
    </tr>
    <tr>
      <td width="5%"></td>
      <td width="95%">
          <p><strong>The following are particulars of the charity:</strong></p>
      </td>
    </tr>
    <tr>
    <td width="10%"></td>
	
      <td width="90%">
          <p><strong>(1) Date of establishment:</strong></p>
          <p><?php  if(isset($fieldValues['UK-FCL-00117_0'])){ echo $fieldValues['UK-FCL-00117_0'];}?></p>
          <p><strong>(2) Precise Objects:</strong></p>
          <p><?php  if(isset($fieldValues['UK-FCL-00125_0'])){ if(is_array($fieldValues['UK-FCL-00125_0'])){echo $fieldValues['UK-FCL-00125_0'][0];}else{ echo $fieldValues['UK-FCL-00125_0'];}}?></p>
          <p><strong>(3) Address of Administrative Centre:</strong></p>
          <p><?php echo @$fieldValues['UK-FCL-00093_0']; ?> <?php echo @$fieldValues['UK-FCL-00309_0']; ?> City :<?php echo @$fieldValues['UK-FCL-00310_0']; ?>  Parish :<?php echo @$fieldValues['UK-FCL-00404_0']; ?>  Postal Code :<?php echo @$fieldValues['UK-FCL-00401_0']; ?> Country : <?php echo @$fieldValues['UK-FCL-00320_0']; ?></p>
          <p><strong>(4) Full names, addresses and occupations or descriptions of the trustees:</strong></p>
          <p>
        
              <?php 
			  if(isset($fieldValues['UK-FCL-00301_0'])){			  if(is_array($fieldValues['UK-FCL-00301_0'])){ ?>
                  <table>
              <?php foreach ($fieldValues['UK-FCL-00301_0'] as $key => $value) {
                
               ?>
              <tr>
                <td  width="10%"><strong>(a)</strong></td>
                <td width="90%">Name : <?php echo $value; ?> <?php echo @$fieldValues['UK-FCL-00133_0'][$key]; ?> <?php echo @$fieldValues['UK-FCL-00106_0'][$key]; ?></td>
              </tr>

			  <?php } ?>  </table> <?php }} ?>
          </p> 
          <p>
          
              <?php 
			  if(isset($fieldValues['UK-FCL-00104_0'])){
			  if(is_array($fieldValues['UK-FCL-00104_0'])){ ?>
                  <table>
              <?php foreach ($fieldValues['UK-FCL-00104_0'] as $key => $value) {
                
               ?>
              <tr>
                <td  width="10%"><strong>(b)</strong></td>
                <td width="90%">Address : <?php echo $value; ?>  <?php echo @$fieldValues['UK-FCL-00238_0'][$key]; ?> <?php echo @$fieldValues['UK-FCL-00402_0'][$key]; ?>
                  <?php echo @$fieldValues['UK-FCL-00372_0'][$key]; ?> <?php echo @$fieldValues['UK-FCL-00399_0'][$key]; ?> <?php echo @$fieldValues['UK-FCL-00383_0'][$key]; ?>
                </td>
              </tr>
              <?php } ?>  </table> <?php } }
			  ?>
          </p> 
          <p>
         
              <?php 
			  if(isset($fieldValues['UK-FCL-00137_0'])){
			  if(is_array($fieldValues['UK-FCL-00137_0'])) {?>
                   <table>
              <?php foreach ($fieldValues['UK-FCL-00137_0'] as $key => $value) {
                
               ?>
              <tr>
                <td  width="10%"><strong>(c)</strong></td>
                <td width="90%">Occupation : <?php echo $value; ?></td>
              </tr>
              <?php } ?>  </table> <?php }} ?>
          </p> 
         
          
          <p><strong>(5) Full name, address and occupation or description of the Secretary:</strong></p>
          <p>Name : <?php echo @$fieldValues['UK-FCL-00132_0'][0]?> <?php echo @$fieldValues['UK-FCL-00105_0'][0]?> <?php echo @$fieldValues['UK-FCL-00317_0'][0]?></p>

          <p>Address : <?php echo @$fieldValues['UK-FCL-00107_0'][0]?> <?php echo @$fieldValues['UK-FCL-00335_0'][0]?> <?php echo @$fieldValues['UK-FCL-00384_0'][0]?> <?php echo @$fieldValues['UK-FCL-00454_0'][0]?> <?php echo @$fieldValues['UK-FCL-00382_0'][0]?></p>

          <p>Occupation : <?php echo @$fieldValues['UK-FCL-00455_0'][0]?></p>

          <p>Description : <?php echo @$fieldValues['UK-FCL-00304_0'][0]?></p>

          <p><strong>(6) Full name, address and occupation or description of the Treasurer:</strong></p>

          <p>Name : <?php echo @$fieldValues['UK-FCL-00150_0'][0]?> <?php echo @$fieldValues['UK-FCL-00316_0'][0]?> <?php echo @$fieldValues['UK-FCL-00324_0'][0]?></p>

          <p>Address : <?php echo @$fieldValues['UK-FCL-00308_0'][0]?> <?php echo @$fieldValues['UK-FCL-00457_0'][0]?> <?php echo @$fieldValues['UK-FCL-00453_0'][0]?> <?php echo @$fieldValues['UK-FCL-00458_0'][0]?> <?php echo @$fieldValues['UK-FCL-00459_0'][0]?></p>

          <p>Occupation : <?php echo @$fieldValues['UK-FCL-00461_0'][0]?></p>

          <p>Description : <?php echo @$fieldValues['UK-FCL-00462_0'][0]?></p>


          <p><strong>(7) Name and address of the bank or banks at which the account of the charity is kept:</strong></p>
          <p>
            <!-- <table>
              <1?php if(is_array(@$fieldValues['UK-FCL-00168_0'])){ ?>
              <1?php foreach($fieldValues['UK-FCL-00168_0'] as $key => $value) {
                
               ?>
              <tr>
                <td  width="10%">(a)</td>
                <td width="90%">Bank Name :<1?php echo @$value;?> <1?php echo @$fieldValues['UK-FCL-00169_0'][$key]?> <1?php echo @$fieldValues['UK-FCL-00390_0'][$key]?> <1?php echo @$fieldValues['UK-FCL-00463_0'][$key]?> <1?php echo @$fieldValues['UK-FCL-00129_0'][$key]?> <1?php echo @$fieldValues['UK-FCL-00464_0'][$key]?> <1?php echo @$fieldValues['UK-FCL-00465_0'][$key]?></td>
              </tr>
              <1?php } } ?>  
          </table> -->
          </p>
          <p><strong>(8) Name, address, qualification or other description of the auditor of the accounts:  </strong></p>

          <p>Name : <?php echo @$fieldValues['UK-FCL-00172_0'][0]?> <?php echo @$fieldValues['UK-FCL-00466_0'][0]?> <?php echo @$fieldValues['UK-FCL-00467_0'][0]?></p>

          <p>Address : <?php echo @$fieldValues['UK-FCL-00468_0'][0]?> <?php echo @$fieldValues['UK-FCL-00469_0'][0]?> <?php echo @$fieldValues['UK-FCL-00470_0'][0]?> <?php echo @$fieldValues['UK-FCL-00471_0'][0]?> <?php echo @$fieldValues['UK-FCL-00472_0'][0]?></p>

          <p>Qualification : <?php echo @$fieldValues['UK-FCL-00174_0'][0]?></p>

          <p>Other description : <?php echo @$fieldValues['UK-FCL-00175_0'][0]?></p>


          <p><strong>(9) List of properties owned by the charity:</strong></p>
          <p>
           
              <?php if(isset($fieldValues['UK-FCL-00177_0'])){ if(is_array($fieldValues['UK-FCL-00177_0'])){ ?>
                 <table>
              <?php foreach ($fieldValues['UK-FCL-00177_0'] as $k => $v) {
                
               ?>
              <tr>
                <td  width="10%">(a)</td>
                <td width="90%"><?php echo $v ;?></td>
              </tr>
			  <?php } ?>  </table> <?php } } ?>

         
          </p>
          <p><strong>(10) Please give details of any applicant, trustee, officer or beneficiary who holds or has held</strong></p>
          <p>
            <table>
              <tr>
                <td  width="10%"><strong>(a)</strong></td>
                <td width="90%"><strong>a prominent public office, for example, a Head of State, any Judicial Officer, a Permanent Secretary, a Minister or a Chief Executive Officer or director of a state owned enterprise; or</strong></td>
              </tr>  
              <tr>
                <td  width="10%"><strong>(b)</strong></td>
                <td width="90%"><strong>a prominent public office in an international organization, for example, director, deputy director, member of the board or an equivalent function.</strong></td>
              </tr> 
              <?php 
			  if(isset($fieldValues['UK-FCL-00110_0'])){ 
			  if(is_array($fieldValues['UK-FCL-00110_0'])){ ?>
               <?php foreach ($fieldValues['UK-FCL-00110_0'] as $key => $value) {
                
               ?>
              <tr>
              <td  width="10%"></td>
                <td width="90%">
                  <p><?php echo @$value;?></p>
                </td>
            </tr>
			  <?php } ?>   <?php } } ?>
          </table>
          </p>
      </td>
    </tr>
</table>


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
		<td width="50%">Name of Applicant</td>
		<td width="50%">Electronically signed </td>
	</tr><br><br><br>
</table> 