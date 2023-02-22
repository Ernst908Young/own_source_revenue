
<?php
 $div_id = 4259;
 $count = 0;
 // print_r($fieldValue);die;
   if(isset($fieldValue['UK-FCL-00095_0'])){
      foreach ($fieldValue['UK-FCL-00095_0'] as $key => $flieldVal) {
         //ic
         echo '<tr class="add_more_4167">
				<td><input type="text" id="a_'.@$count.'" name="UK-FCL-00095_0[]" value="'.@$fieldValue['UK-FCL-00095_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00095_0'][$key].'" '. (empty($fieldValue['UK-FCL-00095_0'][$key]) ? ' required ' : ' readonly="" ' ).'></td> 
				<td><input type="text" id="a_'.@$count.'" name="UK-FCL-00263_0[]" value="'.(empty(@$fieldValue['UK-FCL-00263_0'][$key]) ? "  " : @$fieldValue['UK-FCL-00263_0'][$key]).'" class="form-control" title="'.@$fieldValue['UK-FCL-00263_0'][$key].'" readonly></td>
				<td><input type="text" id="a_'.@$count.'" name="UK-FCL-00264_0[]" value="'.@$fieldValue['UK-FCL-00264_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00264_0'][$key].'" '. (empty($fieldValue['UK-FCL-00264_0'][$key]) ? ' required ' : ' readonly="" ' ).'></td>
				<td><input type="text" id="a_'.@$count.'" name="UK-FCL-00266_0[]" value="'.@$fieldValue['UK-FCL-00266_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00266_0'][$key].'" '.@$fieldValue['UK-FCL-00266_0'][$key].' readonly></td>
				<td><input type="text" id="a_'.@$count.'" name="UK-FCL-00113_0[]" value="'.@$fieldValue['UK-FCL-00113_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00113_0'][$key].'" readonly></td>
                            
               <td style="text-align:center;"><a class="btn btn-danger del_1" id="a_'.@$count.'" pi="add_more_+"div_id"+"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
               
               
               
            </tr>';
			++$count;
      }
   }
       else
            //npc
            echo 'npc';

?>


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
