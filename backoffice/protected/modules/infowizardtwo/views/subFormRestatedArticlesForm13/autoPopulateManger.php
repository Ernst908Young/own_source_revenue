
<?php
	 $div_id = 4577;

	echo '
			<div id="popupsocid_4577">
            <table class="table table-striped table-bordered table-hover responsive-table" i="" id="tbl_'.$div_id.'">
               <thead>
                  <tr class="add_more_4577">
                     <th><b class="ukfcl" style="display:none;" title="3843"> </b>No. of classes of Quota  </th>
                     <th><b class="ukfcl" style="display:none;" title="3843"> </b>Type of Quota  </th>
                     <th><b class="ukfcl" style="display:none;" title="3843"> </b>Name of class of Quota  </th>                     
                     <th><b class="ukfcl" style="display:none;" title="3844"> </b>Maximmum no. of Quota</th>
                     <th><b class="ukfcl" style="display:none;" title="3844"> </b>Are these Quota redeemable</th>
                     <th><b class="ukfcl" style="display:none;" title="3844"> </b>Price/formula for calculation of price</th>
                     <th><b class="ukfcl" style="display:none;" title="3844"> </b>Rights & privileges attached to the Quota</th>
                     <th><b class="ukfcl" style="display:none;" title="3844"> </b>Are the Quotas of the Society transferable</th>
                     <th><b class="ukfcl" style="display:none;" title="3844"> </b>Other Restriction on quota transfers</th>
                     <th><b class="ukfcl" style="display:none;" title="3844"> </b>Delete</th>
                  </tr>
               </thead>
               <tbody>';
            foreach ($fieldValue['UK-FCL-00367_0'] as $key => $flieldVal) {
              echo '<tr class="add_more_4577">
               <td><input type="text" name="UK-FCL-00365_0[]" value="'.@$fieldValue['UK-FCL-00365_0'].'" class="form-control" title="'.@$fieldValue['UK-FCL-00365_0'].'" readonly></td>
               <td><input type="text" name="UK-FCL-00367_0[]" value="'.@$fieldValue['UK-FCL-00367_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00367_0'][$key].'" readonly></td>
               <td><input type="text" name="UK-FCL-00368_0[]" value="'.@$fieldValue['UK-FCL-00368_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00368_0'][$key].'" readonly></td>
               <td><input type="text" name="UK-FCL-00369_0[]" value="'.@$fieldValue['UK-FCL-00369_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00369_0'][$key].'" readonly></td>
               <td><input type="text" name="UK-FCL-00370_0[]" value="'.@$fieldValue['UK-FCL-00370_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00370_0'][$key].'" readonly></td>
               <td><input type="text" name="UK-FCL-00266_0[]" value="'.@$fieldValue['UK-FCL-00266_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00266_0'][$key].'" readonly></td>
               <td><input type="text" name="UK-FCL-00371_0[]" value="'.@$fieldValue['UK-FCL-00371_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00371_0'][$key].'" readonly></td>

               <td><input type="text" name="UK-FCL-00230_0[]" value="'.@$fieldValue['UK-FCL-00230_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00230_0'][$key].'" readonly></td>
               <td><input type="text" name="UK-FCL-00377_0[]" value="'.@$fieldValue['UK-FCL-00377_0'][$key].'" class="form-control" title="'.@$fieldValue['UK-FCL-00377_0'][$key].'" readonly></td>
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