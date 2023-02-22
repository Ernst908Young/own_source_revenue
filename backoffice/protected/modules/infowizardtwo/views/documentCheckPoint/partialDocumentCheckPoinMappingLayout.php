

<form method='POST'   id="tagmappingmodalform<?=$documentchklist_id?>" class="tagmappingform"/>
<table class="table table-striped table-responsive">
    <thead>
      <tr>
       <th style="vertical-align: left;text-align: left;width: 20%;"><input type="checkbox" id="checkAll">All</th>
       <th style="vertical-align:left;text-align: left;width: 40%;">Document Check PointCode</th>
        <th style="vertical-align:left;text-align: left;width: 40%;">Document Check Point</th>
          
      </tr>
    </thead>
    <tbody>
	
	<?php  if(isset($document_check_point_list) && !empty($document_check_point_list)){ 
	 $arr=array();
	 $arr=$this->getDocumentCheckListMapping($documentchklist_id);
	 //print_r( $arr);
	?> 
	 <input type="hidden" name="documentchklist_master_id" id="documentchklist_master_id" value='<?=$documentchklist_id?>' class="tagmappingform<?=$documentchklist_id?>">
<?php

   foreach ($document_check_point_list as  $key=> $value) { ?> 
 
			<tr>  
				 
                  <td style='text-align:left;width: 20%;'><input type="checkbox" class="tagmappingform<?=$documentchklist_id?>" name="documentCheckListMapping[]" value="<?=$value['id']?>" <?php  if($arr){ if(in_array($value['id'],$arr)) { echo " checked='checked'";}  }?> ></td>
				  <td style='text-align:left;width: 40%;'> <?=$value['code'];?></td>
				  <td style='text-align:left;width: 40%;'> <?=$value['name'];?> </td>
					
			</tr>

   <?php } ?>
   
   <?php
 }else{ ?>
<p>No sub services are mapped with this service</p>
 <?php
 }
?>
   </tbody>
  </table>
 
 <p style='text-align:center'>  <button  type="submit"   data-form_id="<?=$documentchklist_id?>" class="submit_page btn btn-success">Save </button> </p>
  </form>
<script>
$(function () {
	$("#checkAll").click(function () {
     $('input:checkbox').not(this).prop('checked', this.checked);
 });
});
</script>