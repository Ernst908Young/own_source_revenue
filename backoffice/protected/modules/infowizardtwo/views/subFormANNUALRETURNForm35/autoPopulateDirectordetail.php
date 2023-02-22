<?php  $div_id = 3822; ?>
<table class="table table-striped table-bordered table-hover responsive-table" i="" id="tbl_3822">
   <thead>
      <tr class="add_more_3822">
         <th><b class="ukfcl" style="display:none;" title="3822"> </b>First Name </th>
         <th><b class="ukfcl" style="display:none;" title="3822"> </b>Middle Name </th>
         <th><b class="ukfcl" style="display:none;" title="3822"> </b>Last Name </th>
         <th><b class="ukfcl" style="display:none;" title="3822"> </b>Address Line 1 </th>
         <th><b class="ukfcl" style="display:none;" title="3822"> </b>Address Line 2 </th>
         <th><b class="ukfcl" style="display:none;" title="3822"> </b>Country </th>
         <th><b class="ukfcl" style="display:none;" title="3822"> </b>State/Parish </th>
         <th><b class="ukfcl" style="display:none;" title="3822"> </b>City </th>
         <th><b class="ukfcl" style="display:none;" title="3822"> </b>Postal Code </th>
         <th><b class="ukfcl" style="display:none;" title="3822"> </b>Occupation </th>
          
      </tr>
   </thead>
   <tbody>
      
      <?php
         if(isset($fieldValue['UK-FCL-00132_0'])){
            foreach ($fieldValue['UK-FCL-00132_0'] as $key => $flieldVal) {
               //ic
               echo '<tr class="add_more_3822">
                     <td><input type="text" name="UK-FCL-00132_0[]" value="'.@$fieldValue['UK-FCL-00132_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00132_0'][$key].'" '. (empty($fieldValue['UK-FCL-00132_0'][$key]) ? ' required ' : ' readonly="" ' ).'></td>
                     <td><input type="text" name="UK-FCL-00105_0[]" value="'.(empty(@$fieldValue['UK-FCL-00133_0'][$key]) ? "  " : @$fieldValue['UK-FCL-00133_0'][$key]).'" class="form-control" title="'.@$fieldValue['UK-FCL-00133_0'][$key].'" readonly></td>
                     <td><input type="text" name="UK-FCL-00317_0[]" value="'.@$fieldValue['UK-FCL-00134_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00134_0'][$key].'" '. (empty($fieldValue['UK-FCL-00134_0'][$key]) ? ' required ' : ' readonly="" ' ).'></td>
                     <td><input type="text" name="UK-FCL-00093_0[]" value="'.@$fieldValue['UK-FCL-00093_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00093_0'][$key].'" '. (empty($fieldValue['UK-FCL-00093_0'][$key]) ? ' required ' : ' readonly="" ' ).'></td>
                     <td><input type="text" name="UK-FCL-00309_0[]" value="'.@$fieldValue['UK-FCL-00309_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00309_0'][$key].'" readonly></td>
                     <td><input type="text" name="UK-FCL-00096_0[]" value="'.@$fieldValue['UK-FCL-00096_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00096_0'][$key].'" '. (empty($fieldValue['UK-FCL-00096_0'][$key]) ? ' required ' : ' readonly="" ' ).'></td>
                     <td><input type="text" name="UK-FCL-00129_0[]" value="'.@$fieldValue['UK-FCL-00372_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00372_0'][$key].'" '. (empty($fieldValue['UK-FCL-00372_0'][$key]) ? ' required ' : ' readonly="" ' ).'></td>
                     <td><input type="text" name="UK-FCL-00310_0[]" value="'.@$fieldValue['UK-FCL-00310_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00310_0'][$key].'" readonly></td>
                     <td><input type="text" name="UK-FCL-00094_0[]" value="'.@$fieldValue['UK-FCL-00094_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00094_0'][$key].'" readonly></td>
                     <td><input type="text" name="UK-FCL-00137_0[]" value="'.@$fieldValue['UK-FCL-00137_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00137_0'][$key].'" '. (empty($fieldValue['UK-FCL-00137_0'][$key]) ? ' required ' : ' readonly="" ' ).'></td>
                     <td style="text-align:center;"><a class="btn btn-danger del_1" pi="add_more_+"div_id"+"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                     
                     
                  </tr>';
            }
         }
         //S
        else if(isset($fieldValue['UK-FCL-00397_0'])){
            foreach ($fieldValue['UK-FCL-00397_0'] as $key => $flieldVal) {
                           echo '<tr class="add_more_3822">
                                 <td><input type="text" name="UK-FCL-00132_0[]" value="'.@$fieldValue['UK-FCL-00397_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00397_0'][$key].'" '. (empty($fieldValue['UK-FCL-00397_0'][$key]) ? ' required ' : ' readonly="" ' ).'></td>
                                 <td><input type="text" name="UK-FCL-00105_0[]" value="'.(empty(@$fieldValue['UK-FCL-00466_0'][$key]) ? "  " : @$fieldValue['UK-FCL-00466_0'][$key]).'" class="form-control" title="'.@$fieldValue['UK-FCL-00466_0'][$key].'" readonly></td>
                                 <td><input type="text" name="UK-FCL-00317_0[]" value="'.@$fieldValue['UK-FCL-00398_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00398_0'][$key].'" '. (empty($fieldValue['UK-FCL-00398_0'][$key]) ? ' required ' : ' readonly="" ' ).'></td>
                                 <td><input type="text" name="UK-FCL-00093_0[]" value="'.@$fieldValue['UK-FCL-00468_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00468_0'][$key].'" '. (empty($fieldValue['UK-FCL-00468_0'][$key]) ? ' required ' : ' readonly="" ' ).'></td>
                                 <td><input type="text" name="UK-FCL-00309_0[]" value="'.@$fieldValue['UK-FCL-00238_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00238_0'][$key].'" readonly></td>
                                 <td><input type="text" name="UK-FCL-00096_0[]" value="'.@$fieldValue['UK-FCL-00384_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00384_0'][$key].'" '. (empty($fieldValue['UK-FCL-00384_0'][$key]) ? ' required ' : ' readonly="" ' ).'></td>
                                 <td><input type="text" name="UK-FCL-00129_0[]" value="'.@$fieldValue['UK-FCL-00372_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00372_0'][$key].'" '. (empty($fieldValue['UK-FCL-00372_0'][$key]) ? ' required ' : ' readonly="" ' ).'></td>
                                 <td><input type="text" name="UK-FCL-00310_0[]" value="'.@$fieldValue['UK-FCL-00382_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00382_0'][$key].'" readonly></td>
                                 <td><input type="text" name="UK-FCL-00094_0[]" value="'.@$fieldValue['UK-FCL-00383_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00383_0'][$key].'" readonly></td>
                                 <td><input type="text" name="UK-FCL-00137_0[]" value="'.@$fieldValue['UK-FCL-00239_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00239_0'][$key].'" '. (empty($fieldValue['UK-FCL-00239_0'][$key]) ? ' required ' : ' readonly="" ' ).'></td>
                                 <td style="text-align:center;"><a class="btn btn-danger del_1" pi="add_more_+"div_id"+"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                 
                                 
                              </tr>';
                        }
                     }
         else {
            //npc

           $count= $index=$fieldValue['UK-FCL-00149_0'];
		   // print_r($fieldValue['UK-FCL-00149_0']);die;
            // for ($i=0; $i < $count; $i++) { 
              
             foreach ($fieldValue['UK-FCL-00150_0'] as $index => $flieldVal) {
                echo '<tr class="add_more_3822">
                      <td><input type="text" name="UK-FCL-00132_0[]" value="'.@$fieldValue['UK-FCL-00150_0'][$index].'" class="form-control" title="'.@$fieldValue['UK-FCL-00150_0'][$index].'" '. (empty($fieldValue['UK-FCL-00150_0'][$index]) ? ' required ' : ' readonly="" ' ).'></td>
                      <td><input type="text" name="UK-FCL-00105_0[]" value="'.(empty(@$fieldValue['UK-FCL-00133_0'][$index]) ? "  " : @$fieldValue['UK-FCL-00133_0'][$index]).'" class="form-control" title="'.@$fieldValue['UK-FCL-00133_0'][$index].'" readonly></td>
                      <td><input type="text" name="UK-FCL-00317_0[]" value="'.@$fieldValue['UK-FCL-00134_0'][$index].'" class="form-control" title="'.@$fieldValue['UK-FCL-00134_0'][$index].'" '. (empty($fieldValue['UK-FCL-00134_0'][$index]) ? ' required ' : ' readonly="" ' ).'></td>
                      <td><input type="text" name="UK-FCL-00093_0[]" value="'.@$fieldValue['UK-FCL-00107_0'][$index].'" class="form-control" title="'.@$fieldValue['UK-FCL-00107_0'][$index].'" '. (empty($fieldValue['UK-FCL-00107_0'][$index]) ? ' required ' : ' readonly="" ' ).'></td>
                      <td><input type="text" name="UK-FCL-00309_0[]" value="'.@$fieldValue['UK-FCL-00390_0'][$index].'" class="form-control" title="'.@$fieldValue['UK-FCL-00390_0'][$index].'" readonly></td>
                      <td><input type="text" name="UK-FCL-00096_0[]" value="'.@$fieldValue['UK-FCL-00320_0'][$index].'" class="form-control" title="'.@$fieldValue['UK-FCL-00320_0'][$index].'" '. (empty($fieldValue['UK-FCL-00320_0'][$index]) ? ' required ' : ' readonly="" ' ).'></td>
                      <td><input type="text" name="UK-FCL-00129_0[]" value="'.@$fieldValue['UK-FCL-00400_0'][$index].'" class="form-control" title="'.@$fieldValue['UK-FCL-00400_0'][$index].'" '. (empty($fieldValue['UK-FCL-00400_0'][$index]) ? ' required ' : ' readonly="" ' ).'></td>
                      <td><input type="text" name="UK-FCL-00310_0[]" value="'.@$fieldValue['UK-FCL-00463_0'][$index].'" class="form-control" title="'.@$fieldValue['UK-FCL-00463_0'][$index].'" readonly></td>
                      <td><input type="text" name="UK-FCL-00094_0[]" value="'.@$fieldValue['UK-FCL-00383_0'][$index].'" class="form-control" title="'.@$fieldValue['UK-FCL-00383_0'][$index].'" readonly></td>
                      <td><input type="text" name="UK-FCL-00137_0[]" value=" " class="form-control" title=" " readonly ></td>
                      <td style="text-align:center;"><a class="btn btn-danger del_1" pi="add_more_+"div_id"+"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                      
                      
                   </tr>';
                  $index++;
             }
          }
            
         
      ?>
   </tbody>
</table>
<script type="text/javascript">
	$(document).ready(function(){
		$('.del_1').on('click', function () {					
			$(this).closest('tr').remove();
			var uio= $(this).attr('pi');
			
			if($("."+uio).length<2){
				$("#"+uio).css('display','none');
			}
                                        
		});
	
	});
</script>
   
 