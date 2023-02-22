<style type="text/css">
input[type="radio"]{
	display: none;
}
.mt-repeater .mt-repeater-item {
    border-bottom: none !important;
}
</style>
<?php
	// echo "<pre>"; print_r($data); die;	
	$sql = "SELECT la_auction_detail.auc_id,la_auction_detail.district_id,bo_district.distric_name,bo_district.district_id
			FROM bo_district
			INNER JOIN la_auction_detail
			ON bo_district.district_id=la_auction_detail.district_id
			WHERE la_auction_detail.is_active='Y'
			GROUP BY la_auction_detail.district_id";
	$connection=Yii::app()->db; 
	$command=$connection->createCommand($sql);
	$AustionDistricts=$command->queryAll();
?>
<div class="tab-pane active" id="tab1">
    <div class='row'>&nbsp;</div><div id='heading'>Applicant Details</div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-12">Applicant Name<span class="disabled" aria-disabled="true"> * </span></label>
                <div class="col-md-12">
                  <input type="text"  id="applicant_name" maxlength="100" disabled class="form-control lettersonly" value="<?=@$data->applicant_name?>" name="applicant_name" placeholder="*  Applicant Name">                                                                   
                  <span class="help-block">  </span>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-12">Name of the Firm/Company<span class="disabled" aria-disabled="true"> * </span></label>
                <div class="col-md-12">
                   <input type="text"  id="company_name" maxlength="100" disabled class="form-control lettersonly" value="<?=@$data->company_name?>" name="company_name" placeholder="*  Name of the Company / Unit">
                    <span class="help-block"> </span>
                </div>
            </div>
        </div>
        <!--/span-->
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-12">Constitution of the Firm/Comapany<span class="disabled" aria-disabled="true"> * </span></label>
                <div class="col-md-12">
                    <select class="form-control" disabled name="firm_company_constitution" >
                        <option value="">---Please Select---</option>
                        <option value="proprietorship_id_47" <?php if(isset($data->firm_company_constitution) && $data->firm_company_constitution=="proprietorship_id_47") echo "selected";?>>Proprietorship</option>
                        <option value="partnership_firm_id_48" <?php if(isset($data->firm_company_constitution) && $data->firm_company_constitution=="partnership_firm_id_48") echo "selected";?>>Partnership Firm</option>
                        <option value="limited_liability_partnership_id_49" <?php if(isset($data->firm_company_constitution) && $data->firm_company_constitution=="limited_liability_partnership_id_49") echo "selected";?>>Limited Liability Partnership</option>
                        <option value="private_limited_company_id_50" <?php if(isset($data->firm_company_constitution) && $data->firm_company_constitution=="private_limited_company_id_50") echo "selected";?>>Private Limited Company</option>
                        <option value="public_limited_company_id_51" <?php if(isset($data->firm_company_constitution) && $data->firm_company_constitution=="public_limited_company_id_51") echo "selected";?>>Public Limited Company</option>
                        <option value="cooperative_society_id_52" <?php if(isset($data->firm_company_constitution) && $data->firm_company_constitution=="cooperative_society_id_52") echo "selected";?>>Cooperative Society</option>
                        <option value="self_help_group_id_53" <?php if(isset($data->firm_company_constitution) && $data->firm_company_constitution=="self_help_group_id_53") echo "selected";?>>Self Help Group</option>
                        <option value="section_25_company_id_54" <?php if(isset($data->firm_company_constitution) && $data->firm_company_constitution=="section_25_company_id_54") echo "selected";?>>Section 25 Company</option>
                        <option value="one_man_company_id_55" <?php if(isset($data->firm_company_constitution) && $data->firm_company_constitution=="one_man_company_id_55") echo "selected";?>>One Man Company</option>
                    </select>
                    <span class="help-block"> </span>
                 </div>
            </div>
         </div>
        <!--/span-->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-12">Gender<span class="disabled" aria-disabled="true"> * </span></label>
                <div class="col-md-12">
                    <select class="form-control" disabled name="gender" >
                        <option value="">---Please Select Gender---</option>
                        <option value="M" <?php if(isset($data->gender) && $data->gender=="M") echo "selected";?>>Male</option>
                        <option value="F" <?php if(isset($data->gender) && $data->gender=="F") echo "selected";?>>Female</option>
                        <option value="O" <?php if(isset($data->gender) && $data->gender=="O") echo "selected";?>>Other</option>
                    </select>
                    <span class="help-block"> </span>
                 </div>
            </div>
         </div>
        <!--/span-->
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-12">Mobile<span class="disabled" aria-disabled="true"> * </span></label>
                <div class="col-md-12">
                  <div class="input-group">
                   <div class="input-group-addon">+91</div>
                   <input type="text"  id="mob_number" class="form-control" disabled value="<?=@$data->mob_number?>"  name="mob_number" placeholder="Mobile Number">
                  </div>
                </div>
            </div>
        </div>
        <!--/span-->
        <div class="col-md-6">
            <div class="form-group">
               <label class="control-label col-md-12">Telephone</label>
               <div class="col-md-4">
                    <input type="text"  id="std_code_tel_phone" disabled class="form-control telephone_numbers" value="<?=@$data->std_code_tel_phone?>" name="std_code_tel_phone" placeholder="STD Code">
               </div>
               <div class="col-md-8">
                    <input type="text" id="tel_phone" disabled class="form-control telephone_numbers" value="<?=@$data->tel_phone?>" name="tel_phone" placeholder="Telephone Number">
                </div>
            </div>
        </div>
        <!--/span-->
    </div>
    <div class='row'>&nbsp;</div>
    <div class="row">    
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-12">Email<span class="disabled" aria-disabled="true"> * </span></label>
                <div class="col-md-12">
                   <input type="text"  id="email" class="form-control email" maxlength="250" value="<?=@$data->email?>" disabled name="email" placeholder="*  Email">
                   
                </div>
            </div>
        </div>
        <!--/span-->
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-12">Fax</label>
                <div class="col-md-4">
                    <input type="text"  id="std_code_tel_phone" disabled class="form-control telephone_numbers" value="<?=@$data->std_code_tel_phone?>" name="std_code_fax" placeholder="STD Code">
                </div>
                <div class="col-md-8">
                   <input type="text"  id="fax" disabled class="form-control telephone_numbers" value="<?=@$data->fax?>" name="fax" placeholder="Fax Number">
                </div>
            </div>
        </div>
    </div>

<div class='row'>&nbsp;</div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-12">Physically Handicapped<span class="disabled" aria-disabled="true"> * </span></label>
                <div class="col-md-12">
                   <input type="text"  id="handicapped" disabled class="form-control " value="<?=@$data->handicapped?>" name="handicapped" placeholder="handicapped">
                    <span class="help-block"> </span>
                </div>
            </div>
        </div>

    <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-12">Category<span class="disabled" aria-disabled="true"> * </span></label>
                <div class="col-md-12">
                  <input type="text"  id="category" disabled class="form-control " value="<?=@$data->category?>" name="category" placeholder="category">
                    <span class="help-block"> </span>
                </div>
            </div>
        </div>

        <!--/span-->
    </div>


    <div class='row'>&nbsp;</div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-12">Corresponding Address<span class="disabled" aria-disabled="true"> * </span></label>
                <div class="col-md-12">
                   <textarea  id="Address" rows="3" class="form-control address_field_with_space" disabled maxlength="100" name="Address"  placeholder="*  Correspondence Address"><?=@$data->Address?></textarea>
                    <span class="help-block"> </span>
                </div>
            </div>
        </div>
        <!--/span-->
    </div>

    <div class='row'>&nbsp;</div><div id='heading'>Particulars of Area</div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-12">District<span class="disabled" aria-disabled="true"> * </span></label>
                <div class="col-md-12">
                    <?php 
                        $model = new DistrictExt;
                    ?>
                    <select class="form-control" name="district" id="district" disabled onchange="getDisEstates();">
                        <option value="">---Please Select District---</option>
                        <?php 
                            foreach ($AustionDistricts as $k => $v) {
                                if ($data->district == $v['district_id'])
                                        $select = " selected ";
                                    else 
                                        $select = "";
                                echo "<option $select value='$v[district_id]'>$v[distric_name]</option>";
                            }
                        ?>
                    </select>
                    <span class="help-block"></span>
                </div>
            </div>
        </div>
        <?php 
        if(isset($data->district)){
            $sql = "SELECT la_auction_detail.auc_id,la_estates.land_estate_id,la_estates.land_estate_name,la_estates.estate_area
                    FROM la_estates
                    INNER JOIN la_auction_detail
                    ON la_estates.land_estate_id=la_auction_detail.estate_id
                    WHERE la_auction_detail.is_active='Y' 
                    AND la_auction_detail.auc_status='O'
                    AND la_auction_detail.district_id=$data->district
                    GROUP BY la_auction_detail.estate_id";
            $connection=Yii::app()->db; 
            $command=$connection->createCommand($sql);
            $Plots=$command->queryAll();
            if(!empty($Plots))
                foreach ($Plots as $k => $v)
                    $estates[]=array("land_estate_id" => $v['land_estate_id'],'land_estate_name'=>$v['land_estate_name']);
        }
        ?>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-12">Estates<span class="disabled" aria-disabled="true"> * </span></label>
                <div class="col-md-12">
                    <select class="form-control" name="estate" id="estate" disabled onchange="getDisEstateArea(this.id);getDisEstate(this.id);">
                        <?php 
                            if(isset($estates)){
                                echo '<option value="">---Please Select Estate---</option>';
                                foreach ($estates as $k => $v){ 
                                    if ($data->estate == $v['land_estate_id'])
                                        $select = " selected ";
                                    else 
                                        $select = "";
                                    echo "<option $select value='$v[land_estate_id]'>$v[land_estate_name]</option>";
                                }
                            }
                            else
                            echo '<option value="">---Please Select District---</option>';  
                        ?>
                    </select>
                    <span class="help-block">
                        <a href="" class="help-block col-md-12 badge badge-danger" style="padding: 4px 85px; margin: 5px 0px;color:#fff;font-weight:800" id="estate_linkk" target="_blank" >Estatle Link View</a>
                        <input type="hidden" value="" id="estate_link">
                    </span>
                </div>
            </div>
        </div>
        <!--/span-->
    </div>
    <div class="row-fluid">
        <!--/span-->
        <?php 
            if(isset($data->estate)){
                $sql = "SELECT *
                        FROM la_auction_plots
                        INNER JOIN la_auction_detail
                        ON la_auction_plots.auc_plot_id=la_auction_detail.plot_id
                        WHERE 
                        -- la_auction_detail.is_active='Y' 
                        -- AND la_auction_detail.auc_status='O'
                        -- AND 
                        la_auction_detail.estate_id=$data->estate";
                $connection=Yii::app()->db; 
                $command=$connection->createCommand($sql);
                $PlotsData=$command->queryAll();
                if(!empty($PlotsData))
                    $PlotsArray=array();
                    foreach ($PlotsData as $k => $v){
                        $now = strtotime(date("Y-m-d"));
                        $StartDate = strtotime($v['auc_start_date']);
                        $EndDate = strtotime($v['auc_end_date']);

                        // if($now >= $StartDate && $now <= $EndDate)
                            $PlotsArray[]=array("plot_id" => $v['auc_plot_id'],'area_name'=>$v['area_name'],'plot_area'=>$v['plot_area']);
                    }
            }
        ?>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-12">Available Plots Area in Sq. Meters<span class="disabled" aria-disabled="true"> * </span></label>
                <select id="area_square_meter" class="form-control multi-select" disabled multiple name="area_square_meter[]">
                    <?php 
                        if(isset($PlotsArray)){
                            $areaArray=array();
                            foreach ($data->area_square_meter as $k => $v)
                                $areaArray[]=$v;
                            $select = "";
                            foreach ($PlotsArray as $k => $v){
                                if (in_array($v['plot_id'], $areaArray))
                                    $select = " selected ";
                                else 
                                    $select = "";
                                echo "<option $select value='$v[plot_id]'>$v[area_name] ( $v[plot_area] )</option>";
                            }
                        }
                    ?>
                </select>
            </div>
        </div>
         <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-12">Type of Industry<span class="disabled" aria-disabled="true"> * </span></label>
                <div class="col-md-12">
                  <select class="form-control" name="nature_of_area" disabled id="nature_of_area" >
                    <option value="">---Please Select Nature of Area---</option>
                    <option value="new_unit" <?php if(isset($data->nature_of_area) && $data->nature_of_area=="new_unit") echo "selected";?>>New Unit</option>
                    <option value="expansion" <?php if(isset($data->nature_of_area) && $data->nature_of_area=="expansion") echo "selected";?>>Expansion</option>
                    <option value="modernization" <?php if(isset($data->nature_of_area) && $data->nature_of_area=="modernization") echo "selected";?>>Modernization</option>
                  </select>
                  <span class="help-block">  </span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <!--/span-->
       
        <!--/span-->
        
        <!--/span-->
    </div>

    <div class='row'>&nbsp;</div><div id='heading'>Unit Details</div>
    <div class="row">
        <div class="col-md-12 frm-group mt-repeater">
            <div data-repeater-list="group-c" id="data_pro">
                <?php 
                    if(isset($data->proposed_product)){
                        foreach ($data->proposed_product as $k => $v) {
                            $proposed_product = $data->proposed_product;
                            $proposed_installed_capacity = $data->proposed_installed_capacity;
                            $proposed_product_unit = $data->proposed_product_unit;
                            echo "<div data-repeater-item class='mt-repeater-item product_manufactured_body_remove'>
                                    <div class='row-fluid mt-repeater-row'>
                                        <div class='col-md-4'>
                                            <label class='control-label'>Proposed Product</label>
                                            <input type='text' disabled placeholder='* Proposed Product' value='".$proposed_product[$k]."' name='proposed_product[]' class='form-control lettersonly' />
                                        </div>
                                        <div class='col-md-4'>
                                            <label class='control-label'>Proposed Installed Capacity</label>
                                            <input type='text' disabled placeholder='* Proposed Installed Capacity' value='".$proposed_installed_capacity[$k]."' name='proposed_installed_capacity[]' class='form-control digits' />
                                        </div>
                                        <div class='col-md-4'>
                                            <label class='control-label'>Unit</label>
                                            <input type='text' disabled placeholder='* Unit' name='proposed_product_unit[]' value='".$proposed_product_unit[$k]."' class='form-control lettersonly' />
                                        </div>
                                    </div>
                                </div>";
                        }
                    }
                ?>
            </div>
        </div>
    </div>
       
    <div class="row">
       <!--  <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-12">Pollution Category<span class="disabled" aria-disabled="true"> * </span></label>
                <div class="col-md-12">
                   <select class="form-control" name="pollution_category" disabled id="pollution_category">
                    <option value="">---Please Select---</option>
                    <option value="red" <?php if(isset($data->pollution_category) && $data->pollution_category=="red") echo "selected";?>>Red</option>
                    <option value="green" <?php if(isset($data->pollution_category) && $data->pollution_category=="green") echo "selected";?>>Green</option>
                    <option value="orange" <?php if(isset($data->pollution_category) && $data->pollution_category=="orange") echo "selected";?>>Orange</option>
                    <option value="white" <?php if(isset($data->pollution_category) && $data->pollution_category=="white") echo "selected";?>>White</option>
                   </select>
                </div>
            </div>
        </div>-->
        <!--/span-->

        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-12">Nature of Project<span class="disabled" aria-disabled="true"> * </span></label>
                <div class="col-md-12">
                    <select class="form-control" disabled name="nature_project" >
                        <!--<option value="">---Please Select Nature---</option>-->
                        <option value="manufacturing" <?php if(isset($data->nature_project) && $data->nature_project=="manufacturing") echo "selected";?>>Manufacturing</option>
                        <!-- <option value="service" <?php if(isset($data->nature_project) && $data->nature_project=="service") echo "selected";?>>Service</option> -->
                    </select>
                    <span class="help-block"> </span>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label col-md-12">Projected Sales Unit (1st year) <span class="disabled" aria-disabled="true"> * </span></label>
                <div class="col-md-12">
                   <input type="text" id="projected_sales_unit" class="form-control digits" value="<?=@$data->projected_sales_unit?>" disabled name="projected_sales_unit" placeholder="*  Projected Sales Unit (1st year) ">
                </div>
            </div>
        </div>
        <!--/span-->
    </div>

    <div class='row'>&nbsp;</div><div id='heading'>Project Cost (Rupees <i class="fa fa-inr">&nbsp;</i>)</div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Plant and Machinery <span class="disabled" aria-disabled="true"> * </span></th>
                            <th>Building <span class="disabled" aria-disabled="true"> * </span></th>
                            
                            <th>Others <span class="disabled" aria-disabled="true"> * </span></th>
                            <th>Total Project Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input class="form-control digits" value="<?=@$data->plant_machinery_invst?>" onblur="sumupInvst(this.id)" disabled onkeyup="sumupInvst(this.id)" id="plant_machinery_invst" name="plant_machinery_invst" type="text"></td>
                            <td><input class="form-control digits" value="<?=@$data->building_construction_invst?>" onblur="sumupInvst(this.id)" disabled onkeyup="sumupInvst(this.id)" id="building_construction_invst" name="building_construction_invst" type="text"></td>
                            
                            <td><input class="form-control digits" value="<?=@$data->other_invst?>" onblur="sumupInvst(this.id)" disabled onkeyup="sumupInvst(this.id)" id="other_invst" name="other_invst" type="text"></td>
                            <td><input class="form-control digits" value="<?=@$data->total_investment?>" readonly id="total_investment" disabled name="total_investment" type="text"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!--/span-->
    </div>

    <div class='row'>&nbsp;</div><div id='heading'>Means of Finance (Rupees <i class="fa fa-inr">&nbsp;</i>)</div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Equity <span class="disabled" aria-disabled="true"> * </span></th>
                            <th>Term Loan <span class="disabled" aria-disabled="true"> * </span></th>
                            <th>Assistance From Other Sources <span class="disabled" aria-disabled="true"> * </span></th>
                            <th>Working Capital <span class="disabled" aria-disabled="true"> * </span></th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input class="form-control digits" value="<?=@$data->mean_of_fin_equity?>" id="mean_of_fin_equity" name="mean_of_fin_equity" onblur="sumupMeans(this.id)" disabled onkeyup="sumupMeans(this.id)" type="text"></td>
                            <td><input class="form-control digits" value="<?=@$data->mean_of_fin_term_loan?>" id="mean_of_fin_term_loan" name="mean_of_fin_term_loan" onblur="sumupMeans(this.id)" disabled onkeyup="sumupMeans(this.id)" type="text"></td>
                            <td><input class="form-control digits" value="<?=@$data->mean_of_fin_assistance?>" id="mean_of_fin_assistance" name="mean_of_fin_assistance" onblur="sumupMeans(this.id)" disabled onkeyup="sumupMeans(this.id)" type="text"></td>
                            <td><input class="form-control digits" value="<?=@$data->mean_of_fin_grant?>" id="mean_of_fin_grant" name="mean_of_fin_grant" onblur="sumupMeans(this.id)" disabled onkeyup="sumupMeans(this.id)" type="text"></td>
                            <td><input class="form-control digits" value="<?=@$data->total_means?>" readonly id="total_means" disabled name="total_means" type="text"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!--/span-->
    </div>



    <div class='row'>&nbsp;</div><div id='heading'>Proposed Employment Details</div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="2">Manegerial</th>
                            <th colspan="2">Supervisor</th>
                            <th colspan="2">Skilled</th>
                            <th colspan="2">Unskilled</th>
                            <th colspan="2">Total Employment</th>
                        </tr>
                        <tr>
                            <th>Male <span class="disabled" aria-disabled="true"> * </span></th>
                            <th>Female <span class="disabled" aria-disabled="true"> * </span></th>
                            <th>Male <span class="disabled" aria-disabled="true"> * </span></th>
                            <th>Female <span class="disabled" aria-disabled="true"> * </span></th>
                            <th>Male <span class="disabled" aria-disabled="true"> * </span></th>
                            <th>Female <span class="disabled" aria-disabled="true"> * </span></th>
                            <th>Male <span class="disabled" aria-disabled="true"> * </span></th>
                            <th>Female <span class="disabled" aria-disabled="true"> * </span></th>
                            <th>Male <span class="disabled" aria-disabled="true"> * </span></th>
                            <th>Female <span class="disabled" aria-disabled="true"> * </span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input class="form-control digits" onblur="sumupMaleEmp(this.id)" disabled onkeyup="sumupMaleEmp(this.id)" value="<?=@$data->manegerial_emp_male?>" id="manegerial_emp_male" name="manegerial_emp_male" type="text"></td>
                            <td><input class="form-control digits" onblur="sumupFemaleEmp(this.id)" disabled onkeyup="sumupFemaleEmp(this.id)" value="<?=@$data->manegerial_emp_female?>" id="manegerial_emp_female" name="manegerial_emp_female" type="text"></td>
                            
                            <td><input class="form-control digits" onblur="sumupMaleEmp(this.id)" disabled onkeyup="sumupMaleEmp(this.id)" value="<?=@$data->supervisor_emp_male?>" id="supervisor_emp_male" name="supervisor_emp_male" type="text"></td>
                            <td><input class="form-control digits" onblur="sumupFemaleEmp(this.id)" disabled onkeyup="sumupFemaleEmp(this.id)" value="<?=@$data->supervisor_emp_female?>" id="supervisor_emp_female" name="supervisor_emp_female" type="text"></td>
                            
                            <td><input class="form-control digits" onblur="sumupMaleEmp(this.id)" disabled onkeyup="sumupMaleEmp(this.id)" value="<?=@$data->skilled_emp_male?>" id="skilled_emp_male" name="skilled_emp_male" type="text"></td>
                            <td><input class="form-control digits" onblur="sumupFemaleEmp(this.id)" disabled onkeyup="sumupFemaleEmp(this.id)" value="<?=@$data->skilled_emp_female?>" id="skilled_emp_female" name="skilled_emp_female" type="text"></td>
                            
                            <td><input class="form-control digits" onblur="sumupMaleEmp(this.id)" disabled onkeyup="sumupMaleEmp(this.id)" value="<?=@$data->unskilled_emp_male?>" id="unskilled_emp_male" name="unskilled_emp_male" type="text"></td>
                            <td><input class="form-control digits" onblur="sumupFemaleEmp(this.id)" disabled onkeyup="sumupFemaleEmp(this.id)" value="<?=@$data->unskilled_emp_female?>" id="unskilled_emp_female" name="unskilled_emp_female" type="text"></td>

                            <td><input class="form-control digits" readonly id="total_emp_male" disabled name="total_emp_male" value="<?=@$data->total_emp_male?>" type="text"></td>
                            <td><input class="form-control digits" readonly id="total_emp_female" disabled name="total_emp_female" value="<?=@$data->total_emp_female?>" type="text"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!--/span-->
    </div>

    <div class='row'>&nbsp;</div><div id='heading'>Effluent Details</div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label col-md-12">Solid Wastage (Kg per day)<span class="disabled" aria-disabled="true"> * </span></label>
                <div class="col-md-12">
                   <input type="text" id="solid_waste_per_kg" class="form-control digits" value="<?=@$data->solid_waste_per_kg?>" disabled name="solid_waste_per_kg" placeholder="*  Solid Wastage (Kg per day)">
                </div>
            </div>
        </div>
        <!--/span-->
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label col-md-12">Liquid Wastage (Litres per day)<span class="disabled" aria-disabled="true"> * </span></label>
                <div class="col-md-12">
                   <input type="text" id="liquid_waste_per_kg" class="form-control digits" value="<?=@$data->liquid_waste_per_kg?>" disabled name="liquid_waste_per_kg" placeholder="*  Liquid Wastage (Litres per day)">
                </div>
            </div>
        </div>
        <!--/span-->
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label col-md-12">Gases<span class="disabled" aria-disabled="true"> * </span></label>
                <div class="col-md-12">
                   <input type="text" id="gases" class="form-control digits" value="<?=@$data->gases?>" disabled name="gases" placeholder="*  Gases">
                </div>
            </div>
        </div>
    </div>



    <div class='row'>&nbsp;</div><div id='heading'>Implementation Schedule ( within months from date of land / shed allotment)</div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            
                            <th>Start of Construction <span class="disabled" aria-disabled="true"> * </span></th>
                            <th>Installation / Erection of machine <span class="disabled" aria-disabled="true"> * </span></th>
                            <th>Commercial Production <span class="disabled" aria-disabled="true"> * </span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            
                            <td>
                                <input class="form-control digits" disabled value="<?=@$data->construction_month?>" placeholder="* Month from Date of Land / Shed Allotment" id="construction_month" name="construction_month" type="text">
                            </td>
                            <td>
                                <input class="form-control digits" disabled value="<?=@$data->installation_month?>" placeholder="* Month from Date of Land / Shed Allotment" id="installation_month" name="installation_month" type="text">
                            </td>
                            <td>
                                <input class="form-control digits" disabled value="<?=@$data->commercial_month?>" placeholder="* Month from Date of Land / Shed Allotment" id="commercial_month" name="commercial_month" type="text">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!--/span-->
    </div>
</div>

<div class="tab-pane active" id="tab2">
    <div class='row'>&nbsp;</div><div id='heading'>Questionnaire</div>
    <div class="row-fluid">
        <div class="col-md-12">
            <div >
                <?php 
                         $disabled = "disabled";
                        $disabledClass = "mt-radio-disabled";
                ?>
                <label class="control-label">1. Educational Qualification<span class="required" aria-required="true"> * </span></label>
                <div class="col-md-12">
                    <div class="mt-radio-inline">
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="edu_cert_qual" <?php if(isset($data->edu_cert_qual) && $data->edu_cert_qual=="intermediate")  echo "checked='checked'";?> value="intermediate" class="form-control" > Upto Class 12
                         <span></span>
                        </label>
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="edu_cert_qual" <?php if(isset($data->edu_cert_qual) && $data->edu_cert_qual=="graduation")  echo "checked='checked'";?> value="graduation" class="form-control" >Graduation
                         <span></span>
                        </label>
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="edu_cert_qual" <?php if(isset($data->edu_cert_qual) && $data->edu_cert_qual=="post_grad_or_above")  echo "checked='checked'";?> value="post_grad_or_above" class="form-control" >Post-Graduation and Above
                         <span></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div >
                <label class="control-label">2. Technical Qualification<span class="required" aria-required="true"> * </span></label>
                <div class="col-md-12">
                    <div class="mt-radio-inline">
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="edu_tech_qual" <?php if(isset($data->edu_tech_qual) && $data->edu_tech_qual=="none")  echo "checked='checked'";?> value="none" class="form-control" >None
                         <span></span>
                        </label>
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="edu_tech_qual" <?php if(isset($data->edu_tech_qual) && $data->edu_tech_qual=="iti")  echo "checked='checked'";?> value="iti" class="form-control" >ITI
                         <span></span>
                        </label>
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="edu_tech_qual" <?php if(isset($data->edu_tech_qual) && $data->edu_tech_qual=="diploma")  echo "checked='checked'";?> value="diploma" class="form-control" >Diploma
                         <span></span>
                        </label>
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="edu_tech_qual" <?php if(isset($data->edu_tech_qual) && $data->edu_tech_qual=="BE_BTech_MCA_MBA_CA")  echo "checked='checked'";?> value="BE_BTech_MCA_MBA_CA" class="form-control" >BE / B.Tech / MCA / MBA / CA
                         <span></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div >
                <label class="control-label">3. Professional Experience<span class="required" aria-required="true"> * </span></label>
                <div class="col-md-12">
                    <div class="mt-radio-inline">
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_prof_exp" <?php if(isset($data->cert_prof_exp) && $data->cert_prof_exp=="non_similar")  echo "checked='checked'";?> value="non_similar" class="form-control" >Experience in Non - Similar Line
                         <span></span>
                        </label>
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_prof_exp" <?php if(isset($data->cert_prof_exp) && $data->cert_prof_exp=="similar")  echo "checked='checked'";?> value="similar" class="form-control" >Experience in Similar Line
                         <span></span>
                        </label>
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_prof_exp" <?php if(isset($data->cert_prof_exp) && $data->cert_prof_exp=="none")  echo "checked='checked'";?> value="none" class="form-control" >None
                         <span></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div >
                <?php 
                    // 4    Equity Investment   
                    // a    < 19.99%                4
                    // b    > = 20.00% to < 29.99%  4 + 2
                    // c    > = 30.00% to < 39.99%  4 + 2 + 2
                    // d    > = 40.00%              4 + 2 + 2 + 2
                    // 0.76
                    $checkA=$checkB=$checkC=$checkD="";
                    $disA=$disB=$disC=$disD="disabled";
                    $disAss=$disBss=$disCss=$disDss="mt-radio-disabled";
                    
                    if($data->equityPtage < 19.99) {
                        $checkA="checked='checked'";
                        $disA="";
                        $disAss="";
                    }
                    elseif($data->equityPtage >= 20.00 && $data->equityPtage < 29.99){
                        $checkC="checked='checked'";
                        $disB="";
                        $disBss="";
                    }
                    elseif($data->equityPtage >= 30.00 && $data->equityPtage < 39.99){
                        $checkC="checked='checked'";
                        $disC="";
                        $disCss="";
                    }
                    elseif($data->equityPtage >= 40.00){
                        $checkD="checked='checked'";
                        $disD="";
                        $disDss="";
                    }
                ?>
                <label class="control-label">4. Equity (If any)</label>
                <div class="col-md-12">
                    <div class="mt-radio-inline">
                        <label class="mt-radio <?=@$disAss?> <?=@$disabledClass?>">
                         <input type="radio" <?=@$disA?> <?=@$checkA?> name="cert_equity" <?php if(isset($data->cert_equity) && $data->cert_equity=="less_then_19")  echo "checked='checked'";?> value="less_then_19" class="form-control" >Less than 19.99%
                         <span></span>
                        </label>
                        <label class="mt-radio <?=@$disBss?> <?=@$disabledClass?>">
                         <input type="radio" <?=@$disB?> <?=@$checkB?> name="cert_equity" <?php if(isset($data->cert_equity) && $data->cert_equity=="greater_then_12_less_then_29_99")  echo "checked='checked'";?> value="greater_then_12_less_then_29_99" class="form-control" >Greater than 20.00% to Less than 29.99%
                         <span></span>
                        </label>
                        <label class="mt-radio <?=@$disCss?> <?=@$disabledClass?>">
                         <input type="radio" <?=@$disC?> <?=@$checkC?> name="cert_equity" <?php if(isset($data->cert_equity) && $data->cert_equity=="greater_then_30_less_then_39_99")  echo "checked='checked'";?> value="greater_then_30_less_then_39_99" class="form-control" >Greater than 30.00% to Less than 39.99%
                         <span></span>
                        </label>
                        <label class="mt-radio <?=@$disDss?> <?=@$disabledClass?>">
                         <input type="radio" <?=@$disD?> <?=@$checkD?> name="cert_equity" <?php if(isset($data->cert_equity) && $data->cert_equity=="greater_then_40")  echo "checked='checked'";?> value="greater_then_40" class="form-control" > Greater than 40.00%
                         <span></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div >
                <label class="control-label">5. Whether unit approved and sanctioned by Financial Institution / NBFC<span class="required" aria-required="true"> * </span></label>
                <div class="col-md-12">
                    <div class="mt-radio-inline">
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_unit_approv_sanct" <?php if(isset($data->cert_unit_approv_sanct) && $data->cert_unit_approv_sanct=="Yes")  echo "checked='checked'";?> value="Yes" class="form-control" >Yes
                         <span></span>
                        </label>
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_unit_approv_sanct" <?php if(isset($data->cert_unit_approv_sanct) && $data->cert_unit_approv_sanct=="none")  echo "checked='checked'";?> value="none" class="form-control" >No
                         <span></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div >
                <label class="control-label">6. Project Cost<span class="required" aria-required="true"> * </span></label>
                <div class="col-md-12">
                    <div class="mt-radio-inline">
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_project_cost" <?php if(isset($data->cert_project_cost) && $data->cert_project_cost=="1cr")  echo "checked='checked'";?> value="1cr" class="form-control" >Above 1 crore
                         <span></span>
                        </label>
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_project_cost" <?php if(isset($data->cert_project_cost) && $data->cert_project_cost=="50lcs")  echo "checked='checked'";?> value="50lcs" class="form-control" >Above 50 Lakhs
                         <span></span>
                        </label>
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_project_cost" <?php if(isset($data->cert_project_cost) && $data->cert_project_cost=="25lcs")  echo "checked='checked'";?> value="25lcs" class="form-control" >Above 25 Lakhs
                         <span></span>
                        </label>
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_project_cost" <?php if(isset($data->cert_project_cost) && $data->cert_project_cost=="below25lcs")  echo "checked='checked'";?> value="below25lcs" class="form-control" >Below 25 Lakhs
                         <span></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div >
                <label class="control-label">7. Debt Coverage Ratio<span class="required" aria-required="true"> * </span></label>
                <div class="col-md-12">
                    <div class="mt-radio-inline">
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_debt_cover_ratio" <?php if(isset($data->cert_debt_cover_ratio) && $data->cert_debt_cover_ratio=="none")  echo "checked='checked'";?> value="none" class="form-control" >More than 2.00 or Not applicable in case of No Loans
                         <span></span>
                        </label>
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_debt_cover_ratio" <?php if(isset($data->cert_debt_cover_ratio) && $data->cert_debt_cover_ratio=="1.70-2.00")  echo "checked='checked'";?> value="1.70-2.00" class="form-control" >1.75 to 2.00
                         <span></span>
                        </label>
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_debt_cover_ratio" <?php if(isset($data->cert_debt_cover_ratio) && $data->cert_debt_cover_ratio=="1.50-1.75")  echo "checked='checked'";?> value="1.50-1.75" class="form-control" >1.50 to 1.75
                         <span></span>
                        </label>
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_debt_cover_ratio" <?php if(isset($data->cert_debt_cover_ratio) && $data->cert_debt_cover_ratio=="1.25-1.50")  echo "checked='checked'";?> value="1.25-1.50" class="form-control" >1.25 to 1.50
                         <span></span>
                        </label>
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_debt_cover_ratio" <?php if(isset($data->cert_debt_cover_ratio) && $data->cert_debt_cover_ratio=="1.00-1.25")  echo "checked='checked'";?> value="1.00-1.25" class="form-control" >1.00 to 1.25
                         <span></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div >
                <label class="control-label">8. Pollution Category<span class="required" aria-required="true"> * </span></label>
                <div class="col-md-12">
                    <div class="mt-radio-inline">
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_poll_cat" <?php if(isset($data->cert_poll_cat) && $data->cert_poll_cat=="white")  echo "checked='checked'";?> value="white" class="form-control" >White
                         <span></span>
                        </label>
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_poll_cat" <?php if(isset($data->cert_poll_cat) && $data->cert_poll_cat=="green")  echo "checked='checked'";?> value="green" class="form-control" >Green
                         <span></span>
                        </label>
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_poll_cat" <?php if(isset($data->cert_poll_cat) && $data->cert_poll_cat=="orange")  echo "checked='checked'";?> value="orange" class="form-control" >Orange
                         <span></span>
                        </label>
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_poll_cat" <?php if(isset($data->cert_poll_cat) && $data->cert_poll_cat=="red")  echo "checked='checked'";?> value="red" class="form-control" >Red
                         <span></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div >
                <label class="control-label">9. Adoption of Water Conservation System<span class="required" aria-required="true"> * </span></label>
                <div class="col-md-12">
                    <div class="mt-radio-inline">
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_adpt_water_system" <?php if(isset($data->cert_adpt_water_system) && $data->cert_adpt_water_system=="yes")  echo "checked='checked'";?> value="yes" class="form-control" >Yes
                         <span></span>
                        </label>
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_adpt_water_system" <?php if(isset($data->cert_adpt_water_system) && $data->cert_adpt_water_system=="none")  echo "checked='checked'";?> value="none" class="form-control" >No
                         <span></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-12">
            <div >
                <label class="control-label">10. Usage of Local Raw Materials<span class="required" aria-required="true"> * </span></label>
                <div class="col-md-12">
                    <div class="mt-radio-inline">
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_usage_local_materail" <?php if(isset($data->cert_usage_local_materail) && $data->cert_usage_local_materail=="30%")  echo "checked='checked'";?> value="30%" class="form-control" > For 30% of total raw material
                         <span></span>
                        </label>
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_usage_local_materail" <?php if(isset($data->cert_usage_local_materail) && $data->cert_usage_local_materail=="10%")  echo "checked='checked'";?> value="10%" class="form-control" >For 10% additional, one mark will be given
                         <span></span>
                        </label>
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_usage_local_materail" <?php if(isset($data->cert_usage_local_materail) && $data->cert_usage_local_materail=="none")  echo "checked='checked'";?> value="none" class="form-control" >None
                         <span></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div >
                <label class="control-label">11. Whether the unit is registered as a Startup with the Ministry of MSME / DIPP, Government of India<span class="required" aria-required="true"> * </span></label>
                <div class="col-md-12">
                    <div class="mt-radio-inline">
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_regist_startup" <?php if(isset($data->cert_regist_startup) && $data->cert_regist_startup=="yes")  echo "checked='checked'";?> value="yes" class="form-control" >Yes
                         <span></span>
                        </label>
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_regist_startup" <?php if(isset($data->cert_regist_startup) && $data->cert_regist_startup=="none")  echo "checked='checked'";?> value="none" class="form-control" >No
                         <span></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div >
                <label class="control-label">12. Whether the proposal is from the family, whose land was acquired for the development of the particular land bank<span class="required" aria-required="true"> * </span></label>
                <div class="col-md-12">
                    <div class="mt-radio-inline">
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_land_acquistion" <?php if(isset($data->cert_land_acquistion) && $data->cert_land_acquistion=="acquired")  echo "checked='checked'";?> value="acquired" class="form-control" >Yes
                         <span></span>
                        </label>
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_land_acquistion" <?php if(isset($data->cert_land_acquistion) && $data->cert_land_acquistion=="none")  echo "checked='checked'";?> value="none" class="form-control" >No
                         <span></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div >
                <label class="control-label">13. Type of Enterpreneur<span class="required" aria-required="true"> * </span></label>
                <div class="col-md-12">
                    <div class="mt-radio-inline">
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_enterprenure_type" <?php if(isset($data->cert_enterprenure_type) && $data->cert_enterprenure_type=="women")  echo "checked='checked'";?> value="women" class="form-control" >Women
                         <span></span>
                        </label>
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_enterprenure_type" <?php if(isset($data->cert_enterprenure_type) && $data->cert_enterprenure_type=="army_fighter")  echo "checked='checked'";?> value="army_fighter" class="form-control" >Retired Army professional and / or Freedom fighters
                         <span></span>
                        </label>
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_enterprenure_type" <?php if(isset($data->cert_enterprenure_type) && $data->cert_enterprenure_type=="SC/ST/Physically Handicapped")  echo "checked='checked'";?> value="SC/ST/Physically Handicapped" class="form-control" >SC/ST/Physically Handicapped
                         <span></span>
                        </label>

                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_enterprenure_type" <?php if(isset($data->cert_enterprenure_type) && $data->cert_enterprenure_type=="none")  echo "checked='checked'";?> value="none" class="form-control" >None
                         <span></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div >
                <label class="control-label">14. Type of unit<span class="required" aria-required="true"> * </span></label>
                <div class="col-md-12">
                    <div class="mt-radio-inline">
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_unit_type" <?php if(isset($data->cert_unit_type) && $data->cert_unit_type=="vender")  echo "checked='checked'";?> value="vender" class="form-control" >Export Oriented and Ancillary / Vendor units for Large and Medium Industries
                         <span></span>
                        </label>
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_unit_type" <?php if(isset($data->cert_unit_type) && $data->cert_unit_type=="none")  echo "checked='checked'";?> value="none" class="form-control" >If not as above
                         <span></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div >
                <label class="control-label">15. Whether unit is benifited through Central / State Sponsored Schemes<span class="required" aria-required="true"> * </span></label>
                <div class="col-md-12">
                    <div class="mt-radio-inline">
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_unit_benifited" <?php if(isset($data->cert_unit_benifited) && $data->cert_unit_benifited=="yes")  echo "checked='checked'";?> value="yes" class="form-control" >Yes
                         <span></span>
                        </label>
                        <label class="mt-radio <?=@$disabledClass?>">
                         <input type="radio" <?=@$disabled?> required name="cert_unit_benifited" <?php if(isset($data->cert_unit_benifited) && $data->cert_unit_benifited=="none")  echo "checked='checked'";?> value="none" class="form-control" >No
                         <span></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>                                                  
    </div>
</div>