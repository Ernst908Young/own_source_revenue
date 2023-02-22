<?php 
$show_main = true;
if(isset($_GET['is_vpd'])){
  if($_GET['is_vpd']=='yes'){
    $show_main = false;
  }
} ?>
 <style type="text/css">
  .latabv {
    border: 1px solid black;
  }
</style>

<table>
    <tr>
    <td style="text-align:center;">     
        <span style="font-size: 13;">CHARITIES ACT, CAP.243</span> <br><br>
        <span style="font-size: 14;"><strong>APPLICATION FOR REGISTRATION OF A CHARITY</strong></span><br>
        <span style="font-size: 13;"><strong>FORM 1</strong></span><br><br>
     
    </td>
     </tr>
</table>


<!-- <div style="page-break-after:always;"></div> -->

<table style="" width="100%">
    <tr>
      <td width="5%"></td>
      <td width="95%">
        <p><strong>We the undersigned being the Charity Trustees of the Charity called the </strong></p> 
        <p><?php  if(isset($fieldValues['UK-FCL-00111_0'])){ echo $fieldValues['UK-FCL-00111_0'];}?></p>
        <p><strong>HEREBY APPLY to have the said charity registered under the abovementioned Act.</strong></p>
      </td>
    </tr>
    <br>
    <tr>
      <td width="5%"></td>
      <td width="95%"><strong>The following are particulars of the charity:</strong><br>
      </td>
    </tr>
    <tr>
    <td width="10%"></td>
	
      <td width="90%"><strong>(1) Date of establishment:</strong>
         <?php  if(isset($fieldValues['UK-FCL-00117_0'])){ echo $fieldValues['UK-FCL-00117_0'];}?><br><br><strong>(2) Precise Objects:</strong>
      <?php  if(isset($fieldValues['UK-FCL-00136_0'])){            
                echo $fieldValues['UK-FCL-00136_0'];
              }?>
          
          <?php 
 if(isset( $fieldValues['UK-FCL-00404_0'])){
          $parish1 = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00404_0'])->queryRow(); 
        }else{
          $parish1 = [];
        }
    

if(isset($fieldValues['UK-FCL-00401_0'])){
      if($fieldValues['UK-FCL-00401_0']){
         $prases1 = Yii::app()->db->createCommand("SELECT * from bo_postalcode_in_barbados where id=".$fieldValues['UK-FCL-00401_0'])->queryRow(); 
       $pc1 = $prases1['code'];
     }else{
        $pc1 = "";
     }
      
      }else{
        $pc1 = "";
      }

          ?>
          <br><br><strong>(3) Address of Administrative Centre:</strong>
         <?php echo @$fieldValues['UK-FCL-00093_0']; ?> <?php echo @$fieldValues['UK-FCL-00309_0']; ?> <?php echo @$fieldValues['UK-FCL-00310_0']; ?>  <?php echo @$parish1['lr_name']; ?> <?php echo @$fieldValues['UK-FCL-00320_0']; ?> <?php echo @$pc1; ?>

          <br><br><strong>(4) Full names, addresses and occupations or descriptions of the trustees:</strong><br><br>
         
        
              <?php 

			  if(isset($fieldValues['UK-FCL-00301_0'])){			  
          if(is_array($fieldValues['UK-FCL-00301_0'])){ ?>

                  <table style="border-collapse: collapse; padding: 5px;">
                    
                    <?php 
                     $count_td = @$fieldValues['UK-FCL-00452_0'];
                     for ($key = 0; $key < $count_td  ; $key++){
                  
                     
                     ?>
                    <tr nobr="true">   
                      <td class="latabv" width="15%"><b>Name</b></td>               
                      <td class="latabv" width="85%"><?php echo @$fieldValues['UK-FCL-00301_0'][$key]; ?> <?php echo @$fieldValues['UK-FCL-00133_0'][$key]; ?> <?php echo @$fieldValues['UK-FCL-00106_0'][$key]; ?></td>
                    </tr>
                    <tr nobr="true">
                      <th class="latabv" width="15%"><b>Address</b></th>
                      <td class="latabv" width="85%"><?php 
                      if($show_main==true){ 
                      echo @$fieldValues['UK-FCL-00104_0'][$key]; ?> <?php echo @$fieldValues['UK-FCL-00238_0'][$key]; ?> <?php echo @$fieldValues['UK-FCL-00399_0'][$key]; ?> <?php echo @$fieldValues['UK-FCL-00372_0'][$key]; ?> <?php echo @$fieldValues['UK-FCL-00402_0'][$key]; ?> <?php echo @$fieldValues['UK-FCL-00383_0'][$key]; 
                    }else{
                      echo 'XXXXX';
                    }
                      ?>
                      </td>
                    </tr>
                     <tr nobr="true">  
                       <th class="latabv" width="15%"><b>Occupation</b></th>
                      <td class="latabv" width="85%"><?php echo @$fieldValues['UK-FCL-00137_0'][$key] ?></td>
                    </tr>
                    
                    <br>
      			       <?php  } ?> 
               </table> 
       <?php }} ?>
        
          
          
         <br>  <br><strong>(5) Full name, address and occupation or description of the Secretary:</strong>
         <br><br><?php 

        if(isset($fieldValues['UK-FCL-00132_0'])){        
          if(is_array($fieldValues['UK-FCL-00132_0']) && !empty($fieldValues['UK-FCL-00132_0'])){ ?>
                  <table style="border-collapse: collapse; padding: 5px;">                    
                    <?php foreach ($fieldValues['UK-FCL-00132_0'] as $key => $value) {
                      if($value){
                     ?>
                    <tr nobr="true">   
                      <td class="latabv" width="15%"><b>Name</b></td>               
                      <td class="latabv" width="85%"><?php echo $value; ?> <?php echo @$fieldValues['UK-FCL-00105_0'][$key]; ?> <?php echo @$fieldValues['UK-FCL-00317_0'][$key]; ?></td>
                    </tr>
                    <tr nobr="true">
                      <th class="latabv" width="15%"><b>Address</b></th>
                      <td class="latabv" width="85%"><?php 
                       if($show_main==true){ 
                        echo @$fieldValues['UK-FCL-00107_0'][$key]; ?> <?php echo @$fieldValues['UK-FCL-00335_0'][$key]; ?> <?php echo @$fieldValues['UK-FCL-00382_0'][$key]; ?> <?php echo @$fieldValues['UK-FCL-00454_0'][$key]; ?> <?php echo @$fieldValues['UK-FCL-00384_0'][$key]; ?> <?php echo @$fieldValues['UK-FCL-00455_0'][$key]; 
                        }else{
                          echo 'XXXXX';
                        } ?>
                      </td>
                    </tr>
                     <tr nobr="true">  
                       <th class="latabv" width="15%"><b>Occupation</b></th>
                      <td class="latabv" width="85%"><?php echo @$fieldValues['UK-FCL-00304_0'][$key] ?></td>
                    </tr>
                     <tr nobr="true">  
                       <th class="latabv" width="15%"><b>Description</b></th>
                      <td class="latabv" width="85%"><?php echo @$fieldValues['UK-FCL-00456_0'][$key] ?></td>
                    </tr>
                    
                    <br>
                   <?php }else{echo '<tr><td></td></tr>';} } ?> 
               </table> 
       <?php }} ?>

       

         


           <br>  <br><strong>(6) Full name, address and occupation or description of the Treasurer:</strong>
 <br><br><?php 

        if(isset($fieldValues['UK-FCL-00150_0'])){        
          if(is_array($fieldValues['UK-FCL-00150_0'])){ ?>

                  <table style="border-collapse: collapse; padding: 5px;">
                    
                    <?php foreach ($fieldValues['UK-FCL-00150_0'] as $key => $value) {
                      if($value){
                     ?>
                    <tr nobr="true">   
                      <td class="latabv" width="15%"><b>Name</b></td>               
                      <td class="latabv" width="85%"><?php echo $value; ?> <?php echo @$fieldValues['UK-FCL-00316_0'][$key]; ?> <?php echo @$fieldValues['UK-FCL-00324_0'][$key]; ?></td>
                    </tr>
                    <tr nobr="true">
                      <th class="latabv" width="15%"><b>Address</b></th>
                      <td class="latabv" width="85%"><?php 
                       if($show_main==true){ 
                      echo @$fieldValues['UK-FCL-00308_0'][$key]; ?> <?php echo @$fieldValues['UK-FCL-00457_0'][$key]; ?> <?php echo @$fieldValues['UK-FCL-00459_0'][$key]; ?> <?php echo @$fieldValues['UK-FCL-00458_0'][$key]; ?> <?php echo @$fieldValues['UK-FCL-00453_0'][$key]; ?> <?php echo @$fieldValues['UK-FCL-00460_0'][$key];
                       }else{
                          echo 'XXXXX';
                        } ?>
                      </td>
                    </tr>
                     <tr nobr="true">  
                       <th class="latabv" width="15%"><b>Occupation</b></th>
                      <td class="latabv" width="85%"><?php echo @$fieldValues['UK-FCL-00461_0'][$key] ?></td>
                    </tr>
                     <tr nobr="true">  
                       <th class="latabv" width="15%"><b>Description</b></th>
                      <td class="latabv" width="85%"><?php echo @$fieldValues['UK-FCL-00462_0'][$key] ?></td>
                    </tr>
                    
                    <br>
                   <?php }else{echo '<tr><td></td></tr>';} } ?> 
               </table> 
       <?php }} ?>

       


             <br><br><strong>(7) Name and address of the bank or banks at which the account of the charity is kept:</strong>
   <br><br>
           <table style="border-collapse: collapse; padding: 5px;">
         <tr nobr="true">
            <th class="latabv"><strong>Bank Name</strong></th>           
            <th class="latabv"><strong>Address </strong></th>           
         </tr>
         <?php  

          if(isset($fieldValues['UK-FCL-00482_0'])){
            if(is_array($fieldValues['UK-FCL-00482_0'])){
              foreach ($fieldValues['UK-FCL-00482_0'] as $key => $val) {
             $fullbankadd = $fieldValues['UK-FCL-00352_0'][$key].' '.$fieldValues['UK-FCL-00390_0'][$key].' '.$fieldValues['UK-FCL-00463_0'][$key].' '.$fieldValues['UK-FCL-00405_0'][$key].' '.$fieldValues['UK-FCL-00465_0'][$key].' '.$fieldValues['UK-FCL-00464_0'][$key];
              echo '<tr nobr="true">
                      <td class="latabv">'.$val.'</td>
                      <td class="latabv">'.$fullbankadd.'</td>
                    
                  </tr>';
            }
            }
            
          }
         ?>         
      </table><br>
         
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
         
          <p><strong>(8) Name, address, qualification or other description of the auditor of the accounts:  </strong></p>

          <?php if(isset($fieldValues['UK-FCL-00477_0'])){
            if($fieldValues['UK-FCL-00477_0']=='Firm'){ ?>
                <b>Firm Name : </b><?php echo @$fieldValues['UK-FCL-00478_0']; ?>
          <?php  }else{ ?>
            <b>Individual Name : </b><?php echo @$fieldValues['UK-FCL-00172_0'] ?> <?php echo @$fieldValues['UK-FCL-00466_0']; ?> <?php echo @$fieldValues['UK-FCL-00467_0']; ?>
         <?php } } ?>

         

          <p><b>Address :</b> 
          <?php 
             if($show_main==true){ 
          if(isset($fieldValues['UK-FCL-00471_0'])){
            $parish2 = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00471_0'])->queryRow(); 
          }else{
            $parish2 = [];
          }

          if(isset($fieldValues['UK-FCL-00470_0'])){
            $co = Yii::app()->db->createCommand("SELECT lr_id,lr_name from bo_landregion where lr_id=".$fieldValues['UK-FCL-00470_0'])->queryRow(); 
          }else{
            $co = [];
          }

          ?>
          <?php echo @$fieldValues['UK-FCL-00468_0'] ?> <?php echo @$fieldValues['UK-FCL-00469_0'] ?> <?php echo @$fieldValues['UK-FCL-00472_0'] ?> <?php echo @$parish2['lr_name'] ?> <?php echo @$co['lr_name'] ?>  <?php echo @$fieldValues['UK-FCL-00473_0'] ;
        }else{
          echo "XXXXX";
        }
          ?>
           
             
           </p>

          <p><b>Qualification : </b><?php echo @$fieldValues['UK-FCL-00174_0']?></p>

          <p><b>Other description : </b><?php echo @$fieldValues['UK-FCL-00175_0']?></p>


          <p><strong>(9) List of properties owned by the charity:</strong></p>
          <p>
           
              <?php if(isset($fieldValues['UK-FCL-00177_0'])){ 
                if(is_array($fieldValues['UK-FCL-00177_0'])){ ?>
                 <table>
              <?php foreach ($fieldValues['UK-FCL-00177_0'] as $k => $v) {
                
               ?>
              <tr>
                <td  width="10%"><?= $k+1 ?></td>
                <td width="90%"><?php echo $v ;?></td>
              </tr>
			  <?php } ?> 
         </table> <?php } } ?>

          </p>

          <p><strong>(10)Interest Details- Please give details of any applicant, trustee, officer or beneficiary who holds or has held</strong></p>
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
			  if(isset($fieldValues['UK-FCL-00184_0'])){ 
			      if(is_array($fieldValues['UK-FCL-00184_0'])){ ?>
               <?php foreach ($fieldValues['UK-FCL-00184_0'] as $key => $value) {
                
               ?>
               <br>
              <tr>
              
                <td width="100%">
                  <table style="border-collapse: collapse; padding: 5px;">
                    <tr nobr="true">  
                       <th class="latabv" width="40%"><b>Name of the person</b></th>
                      <td class="latabv" width="60%"><?php echo @$value ?></td>
                    </tr>
                     <tr nobr="true">  
                       <th class="latabv" width="40%"><b>Whether the clause applicable or not</b></th>
                      <td class="latabv" width="60%"><?php echo @$fieldValues['UK-FCL-00180_0'][$key] ?></td>
                    </tr>
                    <tr>
                       <th class="latabv" width="40%"><b>Details of office held</b></th>
                      <td class="latabv" width="60%"><?php echo @$fieldValues['UK-FCL-00181_0'][$key] ?></td> </tr>
                     <tr>
                       <th class="latabv" width="40%"><b>Name of Organisation</b></th>
                      <td class="latabv" width="60%"><?php echo @$fieldValues['UK-FCL-00185_0'][$key] ?></td> </tr> 
                      <tr>
                       <th class="latabv" width="40%"><b>Date of appointment</b></th>
                      <td class="latabv" width="60%"><?php echo @$fieldValues['UK-FCL-00182_0'][$key] ?></td> </tr>
                      <tr>
                       <th class="latabv" width="40%"><b>Date of cessation</b></th>
                      <td class="latabv" width="60%"><?php echo @$fieldValues['UK-FCL-00183_0'][$key] ?></td> </tr>
                      <tr>
                       <th class="latabv" width="40%"><b>Additional Inforrmation</b></th>
                      <td class="latabv" width="60%"><?php echo @$fieldValues['UK-FCL-00261_0'][$key] ?></td> </tr>
                  </table>
                </td>
            </tr>
			  <?php } ?>   <?php } } ?>
          </table>
          </p>
      </td>
    </tr>
</table>

<br><br><br>
<?php if($app_status=='A'){ 
   echo $this->renderPartial('/subForm/documents_on_pdf',['app_id'=>$app_id]);
 } ?>

 <br><br><br><br>

<table>
  <tr>
    <td width="5%"></td>
    <td width="95%">
      <table style="border-collapse: collapse; ">
      <tr>
         <td style="text-align:center;">
            <span><strong> SIGNATORY DETAILS</strong></span>           
         </td>
      </tr>
     <br>
       <tr>
         <td>
      <table style="border-collapse: collapse; padding: 5px;">
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
    </td>
  </tr>
</table>
