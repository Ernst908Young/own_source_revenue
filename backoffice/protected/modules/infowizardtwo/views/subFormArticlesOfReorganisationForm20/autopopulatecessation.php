
<?php
 $div_id = 3190;
	$count = 0;
	if(isset($fieldValue['UK-FCL-00132_0'])){
      foreach ($fieldValue['UK-FCL-00132_0'] as $key => $flieldVal) {
         //ic
         echo '<tr class="add_more_3190 del1_'.$count.'">
				
				<td><input type="text" id="c_'.@$count.'" name="UK-FCL-00132_0[]" value="'.@$fieldValue['UK-FCL-00132_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00132_0'][$key].'" '. (empty($fieldValue['UK-FCL-00132_0'][$key]) ? ' required ' : ' readonly="" ' ).'></td>
				
				<td><input type="text" id="c_'.@$count.'" name="UK-FCL-00133_0[]" value="'.(empty(@$fieldValue['UK-FCL-00133_0'][$key]) ? "  " : @$fieldValue['UK-FCL-00133_0'][$key]).'" class="form-control" title="'.@$fieldValue['UK-FCL-00133_0'][$key].'" readonly></td>
				
				<td><input type="text" id="c_'.@$count.'"  name="UK-FCL-00134_0[]" value="'.@$fieldValue['UK-FCL-00134_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00134_0'][$key].'" '. (empty($fieldValue['UK-FCL-00134_0'][$key]) ? ' required ' : ' readonly="" ' ).'></td>
				
				<td><input type="text" id="c_'.@$count.'" name="UK-FCL-00093_0[]" value="'.@$fieldValue['UK-FCL-00093_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00093_0'][$key].'" '.@$fieldValue['UK-FCL-00093_0'][$key].' readonly></td>
				
				<td><input type="text" id="c_'.@$count.'" name="UK-FCL-00309_0[]" value="'.@$fieldValue['UK-FCL-00309_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00309_0'][$key].'" readonly></td>
				
				<td><input type="text" id="c_'.@$count.'"  name="UK-FCL-00096_0[]" value="'.@$fieldValue['UK-FCL-00096_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00096_0'][$key].'" readonly></td>
				
				<td><input type="text" id="c_'.@$count.'" name="UK-FCL-00372_0[]" value="'.@$fieldValue['UK-FCL-00372_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00372_0'][$key].'" readonly></td>
				
				<td><input type="text" id="c_'.@$count.'" name="UK-FCL-00310_0[]" value="'.@$fieldValue['UK-FCL-00310_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00310_0'][$key].'" readonly></td>
				
				<td><input type="text" id="c_'.@$count.'" name="UK-FCL-00094_0[]" value="'.@$fieldValue['UK-FCL-00094_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00094_0'][$key].'" readonly></td>
				
				<td><input type="text" id="c_'.@$count.'" name="UK-FCL-00137_0[]" value="'.@$fieldValue['UK-FCL-00137_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00137_0'][$key].'" readonly></td>
				
				<td><input type="text" id="c_'.@$count.'" name="UK-FCL-00480_0[]" value="'.@$fieldValue['UK-FCL-00480_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00480_0'][$key].'" readonly></td>
				
				<td><input type="text" id="c_'.@$count.'" name="UK-FCL-00481_0[]" value="'.@$fieldValue['UK-FCL-00481_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00481_0'][$key].'" readonly></td>
				
              
               <td style="text-align:center;"><a class="btn btn-danger del_1" id="c_'.@$count.'" pi="add_more_'.$div_id.'"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
               
               
               
            </tr>';
			++$count;
      }
	}
		else{
			$count = 0;
			if(isset($fieldValue['UK-FCL-00150_0'])){
				foreach ($fieldValue['UK-FCL-00150_0'] as $key => $flieldVal) {
         //npc
					echo '<tr class="add_more_3190">
				
						<td><input type="text" id="c_'.@$count.'" name="UK-FCL-00150_0[]" value="'.@$fieldValue['UK-FCL-00150_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00150_0'][$key].'" '. (empty($fieldValue['UK-FCL-00150_0'][$key]) ? ' required ' : ' readonly="" ' ).'></td>
						
						<td><input type="text" id="c_'.@$count.'" name="UK-FCL-00133_0[]" value="'.(empty(@$fieldValue['UK-FCL-00133_0'][$key]) ? "  " : @$fieldValue['UK-FCL-00133_0'][$key]).'" class="form-control" title="'.@$fieldValue['UK-FCL-00133_0'][$key].'" readonly></td>
						
						<td><input type="text" id="c_'.@$count.'" name="UK-FCL-00134_0[]" value="'.@$fieldValue['UK-FCL-00134_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00134_0'][$key].'" '. (empty($fieldValue['UK-FCL-00134_0'][$key]) ? ' required ' : ' readonly="" ' ).'></td>
						
						<td><input type="text" id="c_'.@$count.'" name="UK-FCL-00107_0[]" value="'.@$fieldValue['UK-FCL-00107_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00107_0'][$key].'" '.@$fieldValue['UK-FCL-00107_0'][$key].' readonly></td>
						
						<td><input type="text" id="c_'.@$count.'" name="UK-FCL-00390_0[]" value="'.@$fieldValue['UK-FCL-00390_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00390_0'][$key].'" readonly></td>
						
						<td><input type="text" id="c_'.@$count.'" name="UK-FCL-00320_0[]" value="'.@$fieldValue['UK-FCL-00320_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00320_0'][$key].'" readonly></td>
						
						<td><input type="text" id="c_'.@$count.'" name="UK-FCL-00400_0[]" value="'.@$fieldValue['UK-FCL-00400_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00400_0'][$key].'" readonly></td>
						
						<td><input type="text" id="c_'.@$count.'" name="UK-FCL-00463_0[]" value="'.@$fieldValue['UK-FCL-00463_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00463_0'][$key].'" readonly></td>
						
						<td><input type="text" id="c_'.@$count.'" name="UK-FCL-00383_0[]" value="'.@$fieldValue['UK-FCL-00383_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00383_0'][$key].'" readonly></td>
						
						<td><input type="text" id="c_'.@$count.'" name="UK-FCL-00489_0[]" value="'.@$fieldValue['UK-FCL-00489_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00489_0'][$key].'" readonly></td>
						
						<td><input type="text" id="c_'.@$count.'" name="UK-FCL-00480_0[]" value="'.@$fieldValue['UK-FCL-00480_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00480_0'][$key].'" readonly></td>
						
						<td><input type="text" id="c_'.@$count.'" name="UK-FCL-00481_0[]" value="'.@$fieldValue['UK-FCL-00481_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00481_0'][$key].'" readonly></td>
						
					  
					   <td style="text-align:center;"><a class="btn btn-danger del_1" id="c_'.@$count.'" pi="add_more_'.$div_id.'"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
					   
					   
					   
					</tr>';
					++$count;
				}
			}
			
			
		}
            
           

?>


<script type="text/javascript">
	$(document).ready(function(){
 	   $('.del_1').on('click', function () { 
         let inputid = $(this).attr("id"); 
         let myArray = inputid.split("_");

         if(myArray[0]=='a'){
            $('.del_'+myArray[1]).remove();
         }
         else if(myArray[0]=='c'){
          $('.del1_'+myArray[1]).remove();
         }
                                         
   	});
                          
		}); 
	
  	 
</script>
