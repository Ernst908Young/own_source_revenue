<?php //echo "<pre>";print_r($row);die;?><div class='portlet box green'>
    <div class='portlet-title'>
        <div class='caption'>
            <i style=" font-size:20px;" class='fa fa-list'></i>Incentive Calculator</div>
        <div class='tools'>
        </div>
    </div>
    <div class="portlet-body">
        <div class="site-min-height">
            <div class="form form-horizontal" role="form">
                <form name="" action="" method="POST">
                    <div class="row" id="div_unit_setup" >
                        <div class="form-group col-md-4">
                            <label class="col-lg-6 col-sm-4 control-label" for="unit_setup" >New/Expansion<span class="required">*</span></label>
                            <div class="col-md-6">
                                <select name="unit_setup" id="unit_setup" class="form-control" >
                                    <option value=''><-----Select-----></option>
                                    <option value='new' <?php if(isset($row['unit_setup']) && $row['unit_setup'] == 'new')echo "selected='selected'";?>>New</option>
                                    <option value='expansion'  <?php if(isset($row['unit_setup']) && $row['unit_setup'] == 'expansion')echo "selected='selected'";?>>Expansion</option>
                                 
                                </select>
                            </div></div>


                        <div class="form-group col-md-4">
                            <label class="col-lg-6 col-sm-4 control-label" for="district" >District<span class="required">*</span></label>
                            <div class="col-md-6">
                                <select name="district" id="disctrict" class="form-control"  onchange="showBlock(this.value)" required  >
                                    <?php
                                    $sql = "select district_id,district_name from lg_code_blocks where is_active = 'Y' group by district_id";
                                    $connection = Yii::app()->db;
                                    $command = $connection->createCommand($sql);
                                    $district = $command->queryAll();
                                    echo "<option value=''><-----Select-----></option>";
                                    if (isset($district)) {
                                        foreach ($district as $v) { ?>
                                            <option value='<?php echo $v['district_id']; ?>' <?php if(isset($row['district']) && $row['district'] == $v['district_id'])echo "selected='selected'";?>><?php echo $v['district_name']; ?></option>";
                                       <?php }
                                    }
                                    ?>
                                </select>
                            </div></div>


                        <div class="form-group col-md-4" id="div_block" >
                            <label class="col-lg-6 col-sm-4 control-label" for="block" >Block<span class="required">*</span></label>
                            <div class="col-md-6">
                                
                                    <?php if(isset($row['district']) && ($row['district'] !="")){
                                        
                                        $sql = "select block_code as id ,block_name as name from lg_code_blocks where district_id=:district_id ";
                                        $connection = Yii::app()->db;
                                        $command = $connection->createCommand($sql);
                                        $command->bindParam(":district_id", $row['district'], PDO::PARAM_INT);
                                        $services = $command->queryAll();
                                        //echo "<pre>";print_r($services);die;
                                        ?>
                                        <select name="block" id="block" class="form-control"  onchange="showCategory(this.value)" required  >
                                        <option value=''><-----Select-----></option>
                                        <?php
                                        foreach($services as $val){ ?><option value='<?php echo $val['id'];?>' <?php if(isset($row['block']) && $row['block'] == $val['id'])echo "selected='selected'";?>><?php echo $val['name'];?></option>
                                        <?php }}else{                             
                                        ?>
                                        <select name="block" id="block" class="form-control"  onchange="showCategory(this.value,'0')" required  >
                                    <option value=''><-----Select-----></option>
                                     
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div></div></div><div class="row">
                        <div class="form-group col-md-4" id="div_height" > 
                            <label class="col-lg-6 col-sm-4 control-label" for="height">Height of industry location(in mts.) <span class="required">*</span></label>
                            <div class="col-md-6">
                                
                                <input type="text" id="height" maxlength="500" class="form-control lettersonly"  value="<?php if(isset($row['height']) && $row['height'] != "")echo $row['height'];?>"  onkeyup="showCategory($('#block').val(),this.value)" name="height" placeholder="* Height of industry location" size="60"
                                       maxlength="500" />
                            </div></div>


                        <div class="form-group col-md-4" id="div_category" >
                            <label class="col-lg-6 col-sm-4 control-label" for="category" >Category<span class="required">*</span></label>
                            <div class="col-md-6">

                                <input type="text" id="category" maxlength="500" class="form-control lettersonly" readonly value="<?php if(isset($row['category']) && $row['category'] != "")echo $row['category'];?>" name="category" placeholder="* Category" size="60"
                                       maxlength="500"  required />
                            </div></div>
                        <div class="form-group col-md-4" id="div_unit_type" >
                            <label class="col-lg-6 col-sm-4 control-label" for="block" >Type of Unit<span class="required">*</span></label>
                            <div class="col-md-6">
                                <select name="unit_type" id="unit_type" class="form-control" required  >
                                    <option value=''><-----Select-----></option>
                                    <option value='Manufacturing' <?php if(isset($row['unit_type']) && $row['unit_type'] == 'Manufacturing') echo "selected='selected'";?>>Manufacturing</option>;
                                    <option value='Service' <?php if(isset($row['unit_type']) && $row['unit_type'] == 'Service') echo "selected='selected'";?>>Service</option>;
                                </select>
                            </div></div></div>
                    <div class="row">
                        <div class="form-group col-md-4" id="div_investment" >
                            <label class="col-lg-6 col-sm-4 control-label" for="application_name" >Investment in Plant & Machinery OR Equipments (in INR)<span >*</span></label>
                            <div class="col-md-6">

                                <input type="text" id="investment" maxlength="500" class="form-control lettersonly" value="<?php if(isset($row['investment']) && $row['investment'] != "")echo $row['investment'];?>" name="investment" placeholder="* like 200000000 for 20 cr." size="60"
                                       maxlength="500"   />
                            </div></div>
                        




                        <div class="form-group col-md-4" id="div_gender"  >
                            <label class="col-lg-6 col-sm-4 control-label" for="gender" >Gender<span class="required">*</span></label>
                            <div class="col-md-6">
                                <select name="gender" id="gender" class="form-control"  >
                                    <option value=''><-----Select-----></option>
                                    <option value='Male' <?php if(isset($row['gender']) && $row['gender'] == 'Male') echo "selected='selected'";?>>Male</option>
                                    <option value='Female' <?php if(isset($row['gender']) && $row['gender'] == 'Female') echo "selected='selected'";?>>Female</option>
                                </select>
                            </div></div>
                        <div class="form-group col-md-4" id="div_operation"  >
                                <label class="col-lg-6 col-sm-4 control-label" for="operation" >Years of Operation<span class="required">*</span></label>
                                <div class="col-md-6">
                                    <select name="operation" id="operation" class="form-control"  >
                                        <option value=''><-----Select-----></option>
                                        <option value='First Five Years of Operations' <?php if(isset($row['operation']) && $row['operation'] == 'First Five Years of Operations') echo "selected='selected'";?>>First Five Years of Operations</option>
                                        <option value='More than Five Years of Operations' <?php if(isset($row['operation']) && $row['operation'] == 'More than Five Years of Operations') echo "selected='selected'";?>>More than Five Years of Operations</option>
                                       
                                    </select>
                                </div></div> 
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4" id="div_electricity"  >
                            <label class="col-lg-6 col-sm-4 control-label" for="electricity" >Electricity Load<span class="required">*</span></label>
                            <div class="col-md-6">
                                <select name="electricity" id="electricity" class="form-control"  >
                                    <option value=''><-----Select-----></option>
                                    <option value='Load upto 100 KVA' <?php if(isset($row['electricity']) && $row['electricity'] == 'Load upto 100 KVA') echo "selected='selected'";?>>Load upto 100 KVA</option>
                                    <option value='Load greater then 100 KVA' <?php if(isset($row['electricity']) && $row['electricity'] == 'Load greater then 100 KVA') echo "selected='selected'";?>>Load greater then 100 KVA</option>
                                </select>
                            </div>
                        </div>


                        <div class="row">
                            
                            <div class="form-group col-md-4" id="div_sector" >
                                <label class="col-lg-6 col-sm-4 control-label" for="sector" > Sector Type <span class="required">*</span></label>
                                <div class="col-md-6">
                                    <select name="sector" id="sector" class="form-control"  >
                                        <?php
                                        $sql = "select id,name from bo_information_wizard_sector";
                                        $connection = Yii::app()->db;
                                        $command = $connection->createCommand($sql);
                                        $AllSector = $command->queryAll();?>
                                        <option value=''><-----Select-----></option>
                                        <?php
                                        
                                        if (isset($AllSector)) {
                                            foreach ($AllSector as $v) { ?>
                                                <option value='<?php echo $v['name'];?>' <?php if(isset($row['sector']) && $row['sector'] == $v['name']) echo "selected='selected'";?> ><?php echo $v['name']; ?></option>
                                         <?php   }
                                        }
                                        ?>
                                    </select>

                                </div></div>
                            <div class="form-group col-md-4" >
                            <label class="col-lg-6 col-sm-4 control-label" for="activity_type" >Type of activity<span class="required">*</span></label>
                            <div class="col-md-6">
                                <select name="activity_type" id="activity_type" class="form-control"  >
                                    <?php
                                    $sql = "SELECT activity_id,activity_name FROM bo_incentive_activity_master where is_active='Y'";
                                    $connection = Yii::app()->db;
                                    $command = $connection->createCommand($sql);
                                    $allactivity = $command->queryAll();
                                    echo "<option value=''><-----Select-----></option>";
                                    if (isset($allactivity)) {
                                        foreach ($allactivity as $v) {?>
                                            <option value='<?php echo $v['activity_name'];?>' <?php if(isset($row['activity_type']) && $row['activity_type'] == $v['activity_name']) echo "selected='selected'";?>><?php echo $v['activity_name'];?></option>
                                       <?php }
                                    }
                                    ?>
                                </select>
                            </div></div>
                        </div>

                        <div class="row buttons" align="center">
                            <input type="submit" value="Find Applicable Incentives" class="btn btn-primary" >
                        </div>   	


                </form>
            </div></div><!-- form --></div></div>
<div class='portlet box green'>       
    <div class='portlet-title'>
        <div class='caption'>
            <i style=" font-size:20px;" class='fa fa-list'></i>Applicable Incentives </div>
        <div class='tools'> </div>

    </div>
    <div class="portlet-body">

        <div class = "row">

            <table class="table table-striped table-bordered table-hover" id="sample_2">
                <thead><tr><th>S.No.</th>
                        <th>Scheme</th>
                        <th>MSME</th>
                        <th>Heavy Industrial</th>
                        <th>MIIP</th>
                        <th>MTTP</th>
                         <th>IDS</th>
                        <th>IT</th>
                        <th>EV</th>
                        <th>Tourism</th>
                        <th>Film</th>
                        <th>Biotech</th>
                        <th>Ayush</th>
                        <th>Aroma Park</th>
                        <th>Solar Power</th>
                        <th>Pine Litter</th>
                        <th>Hydro(upto 2MW)</th>
                        <th>Hydro(2-25MW)</th>
                        <th>Hydro(25-100MW)</th>
                    </tr></thead>
                <tbody><?php
                    $count = 1;
                    if (!isset($condition))
                        $condition = "";
                    $sql = "select * from bo_incentive_master ";
                    $connection = Yii::app()->db;
                    $command = $connection->createCommand($sql);
                    $all_inc = $command->queryAll();
                    if(!isset($row['unit_type'])){$row['unit_type']="";}
                    if (isset($all_inc) && !empty($all_inc)) {
                        foreach ($all_inc as $inc) {
                            ?>
                            <tr><td><?php echo $count++; ?></td>
                                <td><?php ?>
        <?php echo $inc['service_name']; ?></td>
                                <td title="<?php echo htmlentities(ServiceMasterController::getPolicyIncentive(119, $inc['service_id'],$condition, $row['unit_type'])['value']); ?>" ><?php echo ServiceMasterController::getPolicyIncentive(119, $inc['service_id'], $condition, $row['unit_type'])['is']; ?></td>
                                <td title="<?php echo ServiceMasterController::getPolicyIncentive(127, $inc['service_id'],$condition, $row['unit_type'])['value']; ?>" ><?php echo ServiceMasterController::getPolicyIncentive(127, $inc['service_id'], $condition, $row['unit_type'])['is']; ?></td>
                                <td title="<?php echo ServiceMasterController::getPolicyIncentive(104, $inc['service_id'],$condition, $row['unit_type'])['value']; ?>" ><?php echo ServiceMasterController::getPolicyIncentive(104, $inc['service_id'], $condition, $row['unit_type'])['is']; ?></td> 
                                <td title="<?php echo ServiceMasterController::getPolicyIncentive(105, $inc['service_id'],$condition, $row['unit_type'])['value']; ?>" ><?php echo ServiceMasterController::getPolicyIncentive(105, $inc['service_id'], $condition, $row['unit_type'])['is']; ?></td>
                                <td title="<?php echo nl2br(ServiceMasterController::getPolicyIncentive(120, $inc['service_id'],$condition, $row['unit_type'])['value']); ?>" ><?php echo ServiceMasterController::getPolicyIncentive(120, $inc['service_id'], $condition, $row['unit_type'])['is']; //IDS?></td>
                                <td title="<?php echo ServiceMasterController::getPolicyIncentive(111, $inc['service_id'],$condition, $row['unit_type'])['value']; ?>" ><?php echo ServiceMasterController::getPolicyIncentive(111, $inc['service_id'], $condition, $row['unit_type'])['is']; ?></td>
                                <td title="<?php echo ServiceMasterController::getPolicyIncentive(125, $inc['service_id'],$condition, $row['unit_type'])['value']; ?>" ><?php echo ServiceMasterController::getPolicyIncentive(125, $inc['service_id'], $condition, $row['unit_type'])['is']; ?></td>
                                <td title="<?php echo ServiceMasterController::getPolicyIncentive(128, $inc['service_id'],$condition, $row['unit_type'])['value']; ?>" ><?php echo ServiceMasterController::getPolicyIncentive(128, $inc['service_id'], $condition, $row['unit_type'])['is']; ?></td>
                                <td title="<?php echo ServiceMasterController::getPolicyIncentive(129, $inc['service_id'],$condition, $row['unit_type'])['value']; ?>" ><?php echo ServiceMasterController::getPolicyIncentive(129, $inc['service_id'], $condition, $row['unit_type'])['is']; ?></td>
                                <td title="<?php echo ServiceMasterController::getPolicyIncentive(110, $inc['service_id'],$condition, $row['unit_type'])['value']; ?>" ><?php echo ServiceMasterController::getPolicyIncentive(110, $inc['service_id'], $condition, $row['unit_type'])['is']; //biotect ?></td>
                                <td title="<?php echo ServiceMasterController::getPolicyIncentive(109, $inc['service_id'],$condition, $row['unit_type'])['value']; ?>" ><?php echo ServiceMasterController::getPolicyIncentive(109, $inc['service_id'], $condition, $row['unit_type'])['is']; //aayush ?></td>
                                <td title="<?php echo ServiceMasterController::getPolicyIncentive(108, $inc['service_id'],$condition, $row['unit_type'])['value']; ?>" ><?php echo ServiceMasterController::getPolicyIncentive(108, $inc['service_id'], $condition, $row['unit_type'])['is']; //aroma  ?></td>
                                <td title="<?php echo ServiceMasterController::getPolicyIncentive(126, $inc['service_id'],$condition, $row['unit_type'])['value']; ?>" ><?php echo ServiceMasterController::getPolicyIncentive(126, $inc['service_id'], $condition, $row['unit_type'])['is']; //solar ?></td>
                                <td title="<?php echo ServiceMasterController::getPolicyIncentive(124, $inc['service_id'],$condition, $row['unit_type'])['value']; ?>" ><?php echo ServiceMasterController::getPolicyIncentive(124, $inc['service_id'], $condition, $row['unit_type'])['is']; //pine litter ?></td>
                                <td title="<?php echo ServiceMasterController::getPolicyIncentive(130, $inc['service_id'],$condition, $row['unit_type'])['value']; ?>" ><?php echo ServiceMasterController::getPolicyIncentive(130, $inc['service_id'], $condition, $row['unit_type'])['is']; //hydropower uot 2?></td>
                                <td title="<?php echo ServiceMasterController::getPolicyIncentive(133, $inc['service_id'],$condition, $row['unit_type'])['value']; ?>" ><?php echo ServiceMasterController::getPolicyIncentive(133, $inc['service_id'], $condition, $row['unit_type'])['is']; //hydropower 2-25?></td>
                                <td title="<?php echo ServiceMasterController::getPolicyIncentive(132, $inc['service_id'],$condition, $row['unit_type'])['value']; ?>" ><?php echo ServiceMasterController::getPolicyIncentive(132, $inc['service_id'], $condition, $row['unit_type'])['is']; //hydr opower 25-100?></td>
                                 
                            </tr> 
    <?php }
}
?>
                </tbody>
            </table>
        </div></div></div>


<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>

<script>

                                       $(document).ready(function(){
                                            document.getElementById("div_height").style.display = "none";
                                       });

                                    function showIncentive(policy) { //alert(str); //alert("<?php echo Yii::app()->request->baseUrl; ?>/infowizard/infowizarddocumentchklist/issuermapping");
                                        /* document.getElementById("div_block").style.display = "none";
                                         document.getElementById("div_district").style.display = "none";
                                         document.getElementById("div_category").style.display = "none";
                                         document.getElementById("div_electricity").style.display = "none";
                                         document.getElementById("div_operation").style.display = "none";
                                         document.getElementById("div_gender").style.display = "none";
                                         document.getElementById("div_investment").style.display = "none"; 
                                         document.getElementById("div_sector").style.display = "none";*/
                                        $.ajax({
                                            type: "POST",
                                            url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/serviceMaster/getIncentive",
                                            dataType: 'json',
                                            data:
                                                    {
                                                        policy: policy
                                                    },

                                            success: function (data) { //alert(data);
                                                var $select = $('#incentive');
                                                $select.html('');
                                                $.each(data, function (index, element) {

                                                    $select.append('<option value="' + element.service_id + '">' + element.service_name + '</option>');
                                                });
                                                //alert(data);
                                            },

                                            error: function (jqXHR, textStatus, errorThrown) {
                                                alert('error::' + errorThrown);
                                            }
                                        });
                                    }

                                    function showValid(incentive) {

                                        $.ajax({
                                            type: "POST",
                                            url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/serviceMaster/ValidFields",
                                            dataType: 'json',
                                            data:
                                                    {
                                                        incentive: incentive
                                                    },

                                            success: function (data) { //alert(data);
                                                document.getElementById("div_block").style.display = "none";
                                                document.getElementById("div_district").style.display = "none";
                                                document.getElementById("div_category").style.display = "none";
                                                document.getElementById("div_electricity").style.display = "none";
                                                document.getElementById("div_operation").style.display = "none";
                                                document.getElementById("div_gender").style.display = "none";
                                                document.getElementById("div_investment").style.display = "none";
                                                document.getElementById("div_sector").style.display = "none";
                                                if (data.includes("Block")) {

                                                    document.getElementById("div_block").style.display = "block";
                                                    document.getElementById("div_district").style.display = "block";
                                                    document.getElementById("div_category").style.display = "block";
                                                }
                                                if (data.includes("Electricity Load")) {
                                                    document.getElementById("div_electricity").style.display = "block";
                                                }

                                                if (data.includes("Years of Operation")) {
                                                    document.getElementById("div_operation").style.display = "block";
                                                }

                                                if (data.includes("Investment")) {
                                                    document.getElementById("div_investment").style.display = "block";
                                                }

                                                if (data.includes("Gender")) {
                                                    document.getElementById("div_gender").style.display = "block";
                                                }
                                                if (data.includes("Sector")) {
                                                    document.getElementById("div_sector").style.display = "block";
                                                }

                                                //alert(data);
                                            },

                                            error: function (jqXHR, textStatus, errorThrown) {
                                                alert('error::' + errorThrown);
                                            }
                                        });
                                    }

                                    function showBlock(lgdist) {
                                    
                                        $.ajax({
                                            type: "POST",
                                            url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/serviceMaster/GetlgCodeBlock",
                                            dataType: 'json',
                                            data:
                                                    {
                                                        lgdist: lgdist
                                                    },

                                            success: function (data) { //alert(data);
                                                var $select = $('#block');
                                                $select.html('');
                                                $.each(data, function (index, element) {

                                                    $select.append('<option value="' + element.id + '">' + element.name + '</option>');
                                                });
                                                //alert(data);
                                            },

                                            error: function (jqXHR, textStatus, errorThrown) {
                                                alert('error::' + errorThrown);
                                            }
                                        });
                                        document.getElementById("div_height").style.display = "none"; 
                                    }

                                    function showCategory(block,height) {
                                        $.ajax({
                                            type: "POST",
                                            url: "<?php echo Yii::app()->request->baseUrl; ?>/infowizard/serviceMaster/GetBlockCategory",
                                            dataType: 'json',
                                            data:
                                                    {
                                                        block: block,
                                                        height:height
                                                    },

                                            success: function (data) { //alert(data);
                                                $('#category').val(data);

                                                //alert(data);
                                            },

                                            error: function (jqXHR, textStatus, errorThrown) {
                                                alert('error::' + errorThrown);
                                            }
                                        });
                                        if(block=='380' || block=='382' || block=='383' || block=='384'){
                                           document.getElementById("div_height").style.display = "block"; 
                                        }else{
                                          document.getElementById("div_height").style.display = "none";    
                                        }
                                    }

</script>