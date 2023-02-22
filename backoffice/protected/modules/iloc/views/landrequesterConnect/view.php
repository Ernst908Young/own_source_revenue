<div class='portlet box green'>
<div class='portlet-title'>
    <div class='caption'>
        <i style=" font-size:20px;" class='fa fa-list'></i>View Land Record for Sale/Lease</div>
    <div class='tools'> </div>
</div>
 <div class="portlet-body">
          <table class="table table-striped table-bordered table-hover" id="sample_2" >
            <thead>
            <?php
              if(empty($apps)){
                echo "<tr><td colspan='5'>No applications</td></tr>";

              }
              else{  // print_r($apps); die;
                    ?>
            <tr>
                <th width="40%">Sell / Lease</th> <td width="60%"><?php if(!empty($apps['is_sale']) && $apps['is_sale']==1){ echo 'Sell';  } 
				if($apps['is_sale']==1 && $apps['is_lease']==1){ echo ' , ';} if(!empty($apps['is_lease']) && $apps['is_lease']==1){ echo 'Lease'; } ?></td>
            </tr>   
            <tr>
                <th>District</th> <td><?php echo $allList=LandownerConnectEXT::getMasterName('bo_district',@$apps['district_id'],'distric_name','district_id'); ?></td>
            </tr>
            <tr>
                <th >Village</th> <td><?=@$apps['village']?></td> 
            </tr>
			<tr>
                <th >Khasra/ Khatauni</th> <td><?=@$apps['keshra_khatian']?></td>
            </tr>
			<tr>
                <th >Type of Land</th> <td><?=@$apps['type_of_land']?></td>
            </tr>
			<tr>
                <th >Distance from nearest highway</th> <td><?=@$apps['distance_highway']?></td>
            </tr>
			<tr>
                <th >Name of nearest highway</th> <td><?=@$apps['name_highway']?></td>
            </tr>
			<tr>
                <th >Distance from nearest Airport</th> <td><?=@$apps['distance_airport']?></td>
            </tr>
			<tr>
                <th >Name of nearest Airport</th> <td><?=@$apps['name_airport']?></td>
            </tr>
			<tr>
                <th >Distance from nearest Railway Station</th> <td><?=@$apps['distance_railway']?></td>
            </tr>
			<tr>
                <th >Name of nearest Railway Station</th> <td><?=@$apps['name_railway']?></td>
            </tr>
			<tr>
                <th >Area in Sq. Mt.</th> <td><?=@$apps['area_sqmt']?></td>
            </tr>
			<tr>
                <th >If any existing loan on property</th> <td><?php if($apps['existing_loan']=='Y'){ echo "Yes"; } if($apps['existing_loan']=='N'){ echo "No"; }?></td>
            </tr>
			<tr>
                <th >Comment</th> <td><?=@$apps['comment']?></td>
            </tr>
			<!-- <tr>
                <th >Status</th> <td><?=@$apps['status']?></td>
            </tr>-->
			 <tr>
                <th >Created On</th> <td><?=@$apps['created_date']?></td>
            </tr>
            <tr>
                <th >Modified On</th> <td><?=@$apps['modified_date']?></td>
            </tr>
            </thead>
            <tbody>
            
            <?php
               }
            ?>

            </tbody>
        </table>
        <?php //echo CHtml::submitButton('Back',array('class'=>'btn btn-primary','onclick'=>'window.history.back()')); 
        //history.go(-1) ?>
   
	<div class="row buttons" align="center">
		 <a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('//iloc/landownerConnect/index/')?>"><span>View Land Record for Sale/Lease</span></a>
		<a class="btn btn-success" tabindex="0" href="<?=$this->createUrl('/iloc/landownerConnect/create/')?>"><span>Add New Land Record for Sale/Lease</span></a>
 </div>
</div>
</div>
</div>



