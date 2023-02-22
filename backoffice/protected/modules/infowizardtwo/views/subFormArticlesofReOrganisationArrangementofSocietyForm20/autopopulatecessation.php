
<?php
 $div_id = 4593;
 $count = 0;
 
	if(isset($fieldValue['UK-FCL-00397_0'])){
      foreach ($fieldValue['UK-FCL-00397_0'] as $key => $flieldVal) {
         
         echo '<tr class="add_more_4593 del1_'.$count.'">

				
				<td><input type="text" name="UK-FCL-00397_0[]" id="c_'.@$count.'" value="'.@$fieldValue['UK-FCL-00397_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00397_0'][$key].'" readonly></td>
				
				<td><input type="text" name="UK-FCL-00466_0[]" id="c_'.@$count.'" value="'.@$fieldValue['UK-FCL-00466_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00466_0'][$key].'" readonly></td>
				
				<td><input type="text" name="UK-FCL-00398_0[]" id="c_'.@$count.'" value="'.@$fieldValue['UK-FCL-00398_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00398_0'][$key].'" readonly></td>
				
				<td><input type="text" name="UK-FCL-00468_0[]" id="c_'.@$count.'" value="'.@$fieldValue['UK-FCL-00468_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00468_0'][$key].'" readonly></td>
				
				<td><input type="text" name="UK-FCL-00238_0[]" id="c_'.@$count.'" value="'.@$fieldValue['UK-FCL-00238_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00238_0'][$key].'" readonly></td>

				<td><input type="text" name="UK-FCL-00384_0[]" id="c_'.@$count.'" value="'.@$fieldValue['UK-FCL-00384_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00384_0'][$key].'" readonly></td>

				<td><input type="text" name="UK-FCL-00372_0[]" id="c_'.@$count.'" value="'.@$fieldValue['UK-FCL-00372_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00372_0'][$key].'" readonly></td>

				<td><input type="text" name="UK-FCL-00382_0[]" id="c_'.@$count.'" value="'.@$fieldValue['UK-FCL-00382_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00382_0'][$key].'" readonly></td>				
				
				<td><input type="text" name="UK-FCL-00383_0[]" id="c_'.@$count.'" value="'.@$fieldValue['UK-FCL-00383_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00383_0'][$key].'" readonly></td>		
				
				<td><input type="text" name="UK-FCL-00239_0[]" id="c_'.@$count.'" value="'.@$fieldValue['UK-FCL-00239_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00239_0'][$key].'" readonly></td>
				
				
				
              
               <td style="text-align:center;"><a class="btn btn-danger del_1" id="c_'.@$count.'" pi="add_more_'.$div_id.'"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
               
               
               
            </tr>';
            ++$count;
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
