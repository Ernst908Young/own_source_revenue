
<?php
	 $div_id = 4162;
      foreach ($fieldValue['UK-FCL-00367_0'] as $key => $flieldVal) {
         //ic
         echo '<tr class="add_more_3822">
               <td><input type="text" name="UK-FCL-00367_0[]" value="'.@$fieldValue['UK-FCL-00367_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00367_0'][$key].'" '. (empty($fieldValue['UK-FCL-00367_0'][$key]) ? ' required ' : ' readonly="" ' ).'></td>
               <td><input type="text" name="UK-FCL-00368_0[]" value="'.(empty(@$fieldValue['UK-FCL-00368_0'][$key]) ? "  " : @$fieldValue['UK-FCL-00368_0'][$key]).'" class="form-control" title="'.@$fieldValue['UK-FCL-00368_0'][$key].'" readonly></td>
               <td><input type="text" name="UK-FCL-00369_0[]" value="'.@$fieldValue['UK-FCL-00369_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00369_0'][$key].'" '. (empty($fieldValue['UK-FCL-00369_0'][$key]) ? ' required ' : ' readonly="" ' ).'></td>
               <td><input type="text" name="UK-FCL-00266_0[]" value="'.@$fieldValue['UK-FCL-00266_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00266_0'][$key].'" '.@$fieldValue['UK-FCL-00266_0'][$key].' readonly></td>
               <td><input type="text" name="UK-FCL-00288_0[]" value="'.@$fieldValue['UK-FCL-00288_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00288_0'][$key].'" readonly></td>
               <td><input type="text" name="UK-FCL-00371_0[]" value="'.@$fieldValue['UK-FCL-00371_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00371_0'][$key].'" '. (empty($fieldValue['UK-FCL-00371_0'][$key]) ? ' required ' : ' readonly="" ' ).'></td>
               <td style="text-align:center;"><a class="btn btn-danger del_1" pi="add_more_+"div_id"+"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
               
               
               
            </tr>';
      }
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