
<?php

	$div_id = 4577;
	echo '
           <div id="popupid_4577">
            <table class="table table-striped table-bordered table-hover responsive-table" i="" id="tbl_'.$div_id.'">
               <thead>
                  <tr class="add_more_4577">
                     <th><b class="ukfcl" style="display:none;" title="3843"> </b>No. of classes of shares  </th>
                     <th><b class="ukfcl" style="display:none;" title="3843"> </b>Type of Share  </th>
                     <th><b class="ukfcl" style="display:none;" title="3843"> </b>Name of class of Share  </th>                     
                     <th><b class="ukfcl" style="display:none;" title="3844"> </b>Maximmum no. of Share</th>
                     <th><b class="ukfcl" style="display:none;" title="3844"> </b>Are these Quota redeemable</th>
                     <th><b class="ukfcl" style="display:none;" title="3844"> </b>Price/formula for calculation of price</th>
                     <th><b class="ukfcl" style="display:none;" title="3844"> </b>Rights & privileges attached to the Share</th>
                     <th><b class="ukfcl" style="display:none;" title="3844"> </b>Are the Share of the Company transferable</th>
                     <th><b class="ukfcl" style="display:none;" title="3844"> </b>Other Restriction on share transfers</th>
                     <th><b class="ukfcl" style="display:none;" title="3844"> </b>Delete</th>
                  </tr>
               </thead>
               <tbody>';
            foreach ($fieldValue['UK-FCL-00095_0'] as $key => $flieldVal) {
               // echo 'pre'; print_r($fieldValue);
               //echo $key.'<br>';
               //die($fieldValue['UK-FCL-00262_0']);
              echo '<tr class="add_more_4577">
               <td><input type="text" name="UK-FCL-00262_0[]" value="'.@$fieldValue['UK-FCL-00262_0'].'" class="form-control" title="'.@$fieldValue['UK-FCL-00262_0'].'" readonly></td>
               <td><input type="text" name="UK-FCL-00095_0[]" value="'.@$fieldValue['UK-FCL-00095_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00095_0'][$key].'" readonly></td>
               <td><input type="text" name="UK-FCL-00263_0[]" value="'.@$fieldValue['UK-FCL-00263_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00263_0'][$key].'" readonly></td>
               <td><input type="text" name="UK-FCL-00264_0[]" value="'.@$fieldValue['UK-FCL-00264_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00264_0'][$key].'" readonly></td>
               <td><input type="text" name="UK-FCL-00265_0[]" value="'.@$fieldValue['UK-FCL-00265_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00265_0'][$key].'" readonly></td>
               <td><input type="text" name="UK-FCL-00266_0[]" value="'.@$fieldValue['UK-FCL-00266_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00266_0'][$key].'" readonly></td>
               <td><input type="text" name="UK-FCL-00113_0[]" value="'.@$fieldValue['UK-FCL-00113_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00113_0'][$key].'" readonly></td>

               <td><input type="text" name="UK-FCL-00334_0[]" value="'.@$fieldValue['UK-FCL-00334_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00334_0'][$key].'" readonly></td>
               <td><input type="text" name="UK-FCL-00116_0[]" value="'.@$fieldValue['UK-FCL-00116_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00116_0'][$key].'" readonly></td>




               <td style="text-align:center;"><a class="btn btn-danger del_1" pi="add_more_+"div_id"+"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
               
               
               
            </tr>';
            }
            echo '
                  </tbody>
               </table>
               </div>
                  
                
            ';

	 
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