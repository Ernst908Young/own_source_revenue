<style type="text/css">
    .ukfcl {display:none;}  
    .page-footer-inner { padding: 1px 1px 1px !important; }
    .disabled_dropdown{     
        opacity: 0.6;
        pointer-events: none;
        background-color:#eef1f5;
        color: #555;
    }   
    .td_center{
        text-align:center;
        vertical-align:middle !important; 
    }
    .td_left{
        text-align:left;
        vertical-align:middle !important;
    }
    .btn_doc{
        width:100px;
        vertical-align:middle !important;
    }
    .reserevdname{
        color:red;
        font-size:15px;
        
    }
     .status_butt{
    display: inline !important;
    width: auto;
    margin: 0 10px 0 0;
}
.btn-danger {
 padding: 5px 22px;
    font-size: 14px;
}

</style>

<!-- select2 -->
<?php
$keyy = 0;
$checkv_or_r =0;
?>

<link rel="stylesheet" href="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/css/plugins/select2/select2.css">
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/plugins/select2/select2.min.js"></script>
<script src="<?= Yii::app()->theme->baseUrl ?>/assets/frontend/dashboard/js/eakroko.min.js"></script>



<?php
if (isset($_GET['service_id'])) {
    $ss = explode(".", $_GET['service_id']);
    $basePath = Yii::app()->basePath;
    include_once($basePath . "/modules/infowizardtwo/views/formBuilder/" . $ss[0] . '_' . $ss[1] . "_validation.php");
}
?>
<div class="reservation-form p-0" style="text-align: left;"> 

    <?php
    extract($_GET);
$categoryPreference = array();
    //echo "<pre/>"; print_r($fieldValues);
    //die;
    $categoryPreference = array();
    $arry_a = array();
    $arr_id = array();
    $categoryPreference = array();
    $get_selected_field = InfowizardQuestionMasterExt::get_selected_field($service_id);
    $allData23 = InfowizardQuestionMasterExt::getsubmittedvalues($service_id, $sub_id);

    $sfArray = array();
    $btnArray = array();
    $allDataMappedWithButton = array();
    if (isset($get_selected_field) && !empty($get_selected_field)) {
        foreach ($get_selected_field as $gsf) {
            $btnArray[] = $gsf['button_id'];
            $btnID = $gsf['button_id'];
            $sfArray[] = $gsf['selected_field_id'];

            if (!isset($allDataMappedWithButton[$btnID])) {
                $allDataMappedWithButton[$btnID] = array();
            }
            $allDataMappedWithButton[$btnID][] = $gsf['formchk_id'];
        }
    }
    //echo "<pre>"; print_r($formData); die;
    $printed_id = [];
    foreach ($formData as $key => $fd) {
        if(!in_array($fd['id'], $printed_id)){
        $printed_id[$fd['id']] = $fd['id'];
        $showFlag = 0;
        //print_r($fd); die;
        if (!in_array($fd['id'], $sfArray)) {

            $inputType = $fd['input_type'];
             if(isset($checkseccat)){
                if($checkseccat!=$fd['category_id']){
                    echo '</div></div>';
                }
            }
            if (!in_array($fd['category_id'], $categoryPreference)) {
                $checkseccat = $fd['category_id'];  
                $categoryPreference[] = $fd['category_id'];
                $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
               
                ?>
              
               
                <div class="form-part bussiness-det">
                        <div id="title_<?php echo $tablefieldname;?>">                              <h4 class="form-heading">
                            <?php echo @$formName = InfowizardQuestionMasterExt::getMasterName('bo_infowiz_form_categories', $fd['category_id'], 'category_name', 'id'); ?>
                       </h4>
                    </div>
                    <hr id="hr_<?php echo $tablefieldname;?>" style="height: 0px; margin: 0px;">
                    <div class="form-row row">
            <?php } ?>
            <?php
            if (!in_array($fd['id'], $btnArray)) {  //IF IN ARRAY START
               
                if ($inputType == "text" || $inputType == "number" || $inputType == "password") {

                    @$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
                    ?>
                    <div class="form-group col-md-6" id="div_<?php echo $tablefieldname; ?>">
                        <label class="col-md-12 control-label text-left" for=""  id="label_<?php echo $tablefieldname; ?>">
                            <?php
                            echo @$formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
                            echo " <b class='ukfcl'>(" . @$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
                            ?><?php
                            echo ")</b>";
                            if ($fd['is_required'] == 'Y')
                                echo "<span style='color:red;'> *</span>";
                            if (!empty($fd['helptext'])) {
                                $helptext = $fd['helptext'];
                                echo " <i class='fa fa-question-circle' title='$helptext'></i>";
                            }
                            ?>
                        </label>
                        <div class="col-md-12">
                            <input type="<?php echo $inputType; ?>" id="<?php echo $tablefieldname; ?>" name="<?php echo $tablefieldname; ?>" placeholder='<?php echo $formName ?>' class="form-control"  
                                   <?php if ($fd['is_required'] == 'Y') echo "required"; ?> value="<?php if (!is_array(@$fieldValues[$tablefieldname])) echo @$fieldValues[$tablefieldname]; ?>" readonly>
                        </div>
                    </div>
                    <?php
                }
                 if ($inputType == "select" || $inputType == "multipleselect") {
                    @$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
                    ?>
                    <div class="form-group col-md-6" id="div_<?php echo $tablefieldname; ?>">
                        <label class="col-md-12 control-label text-left" for="" id="label_<?php echo $tablefieldname; ?>">                      
                            <?php
                            echo @$formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
                            echo " <b class='ukfcl'>(" . @$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
                            ?><?php
                            echo ")</b>";

                            if ($fd['is_required'] == 'Y')
                                echo "<span style='color:red;'> </span>";
                            if (!empty($fd['helptext'])) {
                                $helptext = $fd['helptext'];
                                echo " <i class='fa fa-question-circle' title='$helptext'></i>";
                            }
                            ?>                              
                        </label>
                        <?php
                        $options = Yii::app()->db->createCommand("SELECT bo.*, bm.master_table_name, bm.key_id, bm.field_value, bm.is_active_field,
                                bm.is_active_value FROM bo_infowiz_formfield_options AS bo LEFT JOIN bo_master_tables AS bm  
                                ON bo.master_table_id=bm.id WHERE bo.formfield_id=$fd[id] AND bo.master_table_id!=0 AND  
                                 bo.is_active='Y' ORDER BY bo.id DESC")->queryRow();

                        if (isset($options) && !empty($options)) {
                            $table_name = $options['master_table_name'];
                            $key_id = $options['key_id'];
                            $field_value = $options['field_value'];
                            $is_active_field = $options['is_active_field'];
                            $is_active_value = $options['is_active_value'];
                            $allList = InfowizardQuestionMasterExt::getMasterList($table_name, $key_id, $field_value, $is_active_field, $is_active_value);
                            
                            
                            ?>
                            <div class="col-md-12">
                                <?php 
                                if(isset($fieldValues[$tablefieldname]) && $inputType == "multipleselect")
                                {   
                                ?>
                                    <ul class="col-md-6">
                                    <?php
                                    foreach($allList as $key => $val) {
                                    
                                        if ($inputType == "multipleselect" && isset($fieldValues[$tablefieldname]) && !empty($fieldValues[$tablefieldname]) && is_array($fieldValues[$tablefieldname])) {
                                            if (in_array($key, @$fieldValues[$tablefieldname])) {
                                               echo "<li style='list-style-type:decimal;padding:12px;'><b>".$val."</b></li>";
                                            }
                                        } else {
                                            if (@$fieldValues[$tablefieldname] == $key) {
                                               echo "<li style='list-style-type:decimal;padding:12px;'><b>".$val."</b></li>";
                                            }
                                        }
                                    }
                                    ?>
                                    </ul>
                                <?php 
                                }else{
                                ?>
                                <select name="<?php  echo $tablefieldname;
                                if ($inputType != "select") {
                                    echo "[]";
                                }
                                ?>" <?php if($inputType == "multipleselect") echo " multiple='true' style='max-height:120px;'" ?> placeholder='<?php echo $formName; ?>' class="form-control disabled_dropdown"  <?php if ($fd['is_required'] == 'Y') echo "required"; ?> id="<?php echo $tablefieldname; ?>" >
                                    <option value="">Please Select </option>
                                    <?php foreach ($allList as $key => $val) { ?>
                                        <option value="<?php echo $key; ?>" <?php
                                        if ($inputType == "multipleselect" && isset($fieldValues[$tablefieldname]) && !empty($fieldValues[$tablefieldname]) && is_array($fieldValues[$tablefieldname])) {
                                            if (in_array($key, @$fieldValues[$tablefieldname])) {
                                                echo "selected";
                                            }
                                        } else {
                                            if (@$fieldValues[$tablefieldname] == $key) {
                                                echo "selected";
                                            }
                                        }
                                        ?>>
                                                    <?php echo $val; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <?php }?>   
                            </div>
                            <?php
                        } else {
                          
                             $goptions = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_formfield_options WHERE formfield_id=$fd[id] AND is_active='Y' ORDER BY id DESC")->queryAll();
                            
                            ?>                      
                            <div class="col-md-12">
                                <select name="<?php
                                echo $tablefieldname;
                                if ($inputType != "select") {
                                    echo "[]";
                                }
                                ?>" 
                                        <?php
                                        if ($inputType == "multipleselect") {
                                            echo " multiple='true'";
                                        }
                                        ?> placeholder='<?php echo $formName; ?>' class="form-control disabled_dropdown"  <?php if ($fd['is_required'] == 'Y') echo "required"; ?> id="<?php echo $tablefieldname; ?>">

                                    <option value="">Please Select </option>
                                    <?php 

            if(@$fieldValues['UK-FCL-00355_0'] !='' && $tablefieldname == 'UK-FCL-00356_0'){
                if(isset($fieldValues['UK-FCL-00355_0'])){
                    $p_id = $fieldValues['UK-FCL-00355_0'];         
                     $postalcode = Yii::app()->db->createCommand("SELECT * from bo_postalcode_in_barbados where p_id=$p_id")->queryAll();        
                     if($postalcode){               
                        foreach ($postalcode as $key => $value) {
                            $select = $fieldValues['UK-FCL-00356_0']==$value['id'] ? 'selected' : '';
                         echo "<option value='".$value['id']."' $select>".$value['district'].' - '.$value['code']."</option>";
                        }
                     }else{
                        echo "<option>-</option>";
                     }
                }
                
            }
                if(@$fieldValues['UK-FCL-00347_0']!='' && $tablefieldname == 'UK-FCL-00385_0'){
                    if(isset($fieldValues['UK-FCL-00347_0'])){
                        $c_id = $fieldValues['UK-FCL-00347_0'];
                        $options =  Yii::app()->db->createCommand("SELECT lr_id,lr_name FROM bo_landregion where parent_id='$c_id' and lr_type='state' AND is_lr_active='Y'")->queryAll();        
                            foreach ($options as $k => $v) {
                               
                                $select = $fieldValues['UK-FCL-00385_0']==$v['lr_id'] ? 'selected' : '';
                            echo "<option value='".$v['lr_id']."' $select>".$v['lr_name']."</option>";
                            }
                    }
                    
                    }

                    if(@$fieldValues['UK-FCL-00402_0']!='' && $tablefieldname == 'UK-FCL-00400_0'){
                        if(isset($fieldValues['UK-FCL-00402_0'])){
                            $c_id = $fieldValues['UK-FCL-00402_0'];
                        $options =  Yii::app()->db->createCommand("SELECT lr_id,lr_name FROM bo_landregion where parent_id='$c_id' and lr_type='state' AND is_lr_active='Y'")->queryAll();        
                            foreach ($options as $k => $v) {
                               
                                $select = $fieldValues['UK-FCL-00400_0']==$v['lr_id'] ? 'selected' : '';
                            echo "<option value='".$v['lr_id']."' $select>".$v['lr_name']."</option>";
                            }
                        }
                    
                    }
            

             if(is_array($goptions) && !empty($goptions)){
                    foreach ($goptions as $option) {                                   

                                     ?>
                                        <option value="<?php echo $option['options']; ?>" <?php
                                        if ($inputType == "multipleselect") {
                                            if (in_array($option['options'], @$fieldValues[$tablefieldname])) {
                                                echo "selected";
                                            }
                                        } else {
                                            if (@$fieldValues[$tablefieldname] == $option['options']) {
                                                echo "selected";
                                            }
                                        }
                                        ?>><?php echo $option['options']; ?>
                                            
                                        </option>
                                            <?php } } ?>
                                </select>    
                            </div>
                        <?php } ?>
                    </div>
                    <?php
                }
                if ($inputType == "checkbox" || $inputType == "radio") {
                    @$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
                    ?>
                    <div class="pcr" id="div_<?php echo @$tablefieldname; ?>">
<div class="form-group">
                        <label class="col-md-12 control-label text-left" for=""  id="label_<?php echo $tablefieldname; ?>">
                            <?php
                            echo @$formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
                            echo " <b class='ukfcl'>(" . @$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
                            ?><?php
                            echo ")</b>";
                            ;
                            if ($fd['is_required'] == 'Y')
                                echo "<span style='color:red;'> *</span>";
                            ?> 
                            <?php
                            if (!empty($fd['helptext'])) {
                                $helptext = $fd['helptext'];
                                echo " <i class='fa fa-question-circle' title='$helptext'></i>";
                            }
                            ?>
                        </label>
                    </div>
                        <div class="input_UK-FCL<?= $key ?>">
                            <div class="row">
                            <?php
                            $options = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_formfield_options WHERE formfield_id=$fd[id] AND is_active='Y' ORDER BY id DESC")->queryAll();
                            $checkdradio = "";
                            foreach ($options as $option) {
                               /* if ($inputType == "radio") {
                                    if (@$fieldValues[$tablefieldname] == $option['options'])
                                        $checkdradio = "checked";
                                }*/
                                ?>

                                <div class="col-md-6">
                <input disabled  name="<?php echo $tablefieldname;if ($inputType == "checkbox") { echo "[]";}?>" type="<?php echo $inputType; ?>" value="<?php echo $option['options']; ?>" name="<?php echo $fd['id'] ?>" class="chk_<?php echo $tablefieldname ?>"  
                    <?php 
                    if(isset($fieldValues[$tablefieldname])){
                            if($inputType== "checkbox") {    
                            if(is_array($fieldValues[$tablefieldname])){
                                 if(in_array($option['options'],$fieldValues[$tablefieldname])){
                                echo "checked";
                            } 
                            }                         
                           
                        }else{
                            if($fieldValues[$tablefieldname]==$option['options']){
                                echo "checked";
                            }
                        }
                    }
                     ?> >&nbsp;
                        <?php echo $option['options']; ?>
            </div>  


                                
                            <?php } ?> 
                            </div>                                 
                        </div>
                    </div>
                    <?php
                }
                if ($inputType == "textarea") {
                    @$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
                    ?>
                    <div class="form-group col-md-6"  id="div_<?php echo @$tablefieldname; ?>">
                        <label class="col-md-12 control-label text-left" for=""  id="label_<?php echo $tablefieldname; ?>">
                            <?php
                            echo @$formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
                            echo " <b class='ukfcl'>(" . @$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
                            ?><?php
                            echo ")</b>";
                            ;
                            if ($fd['is_required'] == 'Y')
                                echo "<span style='color:red;'> *</span>";
                            if (!empty($fd['helptext'])) {
                                $helptext = $fd['helptext'];
                                echo " <i class='fa fa-question-circle' title='$helptext'></i>";
                            }
                            ?> 
                        </label>
                        <div class="col-md-12">
                            <textarea name="<?php echo $tablefieldname; ?>" class="form-control" row="2" readonly id="<?php echo $tablefieldname; ?>"><?php if (!is_array(@$fieldValues[$tablefieldname])) echo @$fieldValues[$tablefieldname]; ?>
                            </textarea>
                        </div>
                    </div>
                    <?php
                }

                if ($inputType == "calender") {
                    @$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
                    ?>
                    <div class="form-group col-md-6"  id="div_<?php echo @$tablefieldname; ?>">
                        <label class="col-md-12 control-label text-left" for=""  id="label_<?php echo $tablefieldname; ?>">
                            <?php
                            echo @$formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
                            echo " <b class='ukfcl'>(" . @$tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
                            ?><?php
                            echo ")</b>";
                            if ($fd['is_required'] == 'Y')
                                echo "<span style='color:red;'> *</span>";
                            ?>
                            <?php
                            if (!empty($fd['helptext'])) {
                                $helptext = $fd['helptext'];
                                echo " <i class='fa fa-question-circle' title='$helptext'></i>";
                            }
                            ?>
                        </label>
                        <div class="col-md-12">
                            <input type="text" name="<?php echo $tablefieldname; ?>" class="form-control" value="<?php echo @$fieldValues[$tablefieldname]; ?>" readonly id="<?php echo $tablefieldname; ?>">
                        </div>
                    </div>
                    <?php
                }
            } else { //IF IN ARRAY END
                if ($inputType == "add_more_button") {
                    $flagTab = 0;
                    $flagtbl = 0;
                    ?>
                    <div class="form-group col-md-12">
                        <table class="table table-striped table-bordered table-hover responsive-table addmore_tbl  <?php echo $tblID = "tbl_" . $fd['id']; ?>" id="forest_table" style="">
                            <tr>
                                <?php
                                if (isset($get_selected_field) && !empty($get_selected_field)) {
                                    foreach ($get_selected_field as $key => $valued) {
                                        if ($fd['id'] == $valued['button_id']) {
                                            ?>
                                            <th>
                                                <?php echo @$formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $valued['formvar_id'], 'name', 'formvar_id'); ?> 
                                            </th>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </tr>
                            <?php
                            $arrofIn = array();
                            if (isset($get_selected_field) && !empty($get_selected_field)) {
                                foreach ($get_selected_field as $key => $valued) {
                                    if ($fd['id'] == $valued['button_id']) {
                                        $fcode = $valued['formchk_id'];
                                        $btnID = $valued['button_id'];
                                        if (is_array($arrofIn) && !in_array($valued['button_id'], $arrofIn)) {
                                            $arrofIn[] = $valued['button_id'];
                                            if (isset($allData23[$fcode]) && !empty($allData23[$fcode])) {
                                                for ($k = 0; $k < (count($allData23[$fcode])); $k++) {
                                                    ?>
                                                    <tr>
                                                        <?php
                                                        if (isset($allDataMappedWithButton[$btnID]) && !empty($allDataMappedWithButton[$btnID])) {
                                                            $flagtbl = 1;
                                                            $fomFeildMasterArr = array('UK-FCL-00298_0', 'UK-FCL-00299_0');
                                                            foreach ($allDataMappedWithButton[$btnID] as $key1 => $datag) {
                                                                if (isset($allData23[$datag]) && is_array($allData23[$datag])) {
                                                                    $gho = @$allData23[$datag][$k];
                                                                } else {
                                                                    $gho = @$allData23[$datag];
                                                                }

                                                                $approvalval = '';
                                                                if (isset($gho) && in_array($datag, $fomFeildMasterArr) && is_numeric($gho)) {
                                                                    if ($datag == 'UK-FCL-00298_0') {
                                                                        $deptName = Yii::app()->db->createCommand("select department_name from bo_departments where dept_id=$gho")->queryRow();
                                                                        $approvalval = $deptName['department_name'];
                                                                    }
                                                                    if ($datag == 'UK-FCL-00299_0') {
                                                                        $deptName = Yii::app()->db->createCommand("select app_name from bo_sp_all_applications where app_id=$gho")->queryRow();
                                                                        $approvalval = $deptName['app_name'];
                                                                    }
                                                                }
                                                                ?>
                                                                <td>
                                                                    <input class="form-control" type="text" value="<?php
                                                                    if (isset($approvalval) && !empty($approvalval)) {
                                                                        echo $approvalval;
                                                                    } else {
                                                                        if (isset($allData23[$datag]) && is_array($allData23[$datag])) {
                                                                            echo @$allData23[$datag][$k];
                                                                        } else {
                                                                            echo @$allData23[$datag];
                                                                        }
                                                                    }
                                                                    ?>" title="<?php
                                                                           if (isset($allData23[$datag]) && is_array($allData23[$datag])) {
                                                                               echo @$allData23[$datag][$k];
                                                                           } else {
                                                                               echo @$allData23[$datag];
                                                                           }
                                                                           ?>" readonly>
                                                                </td>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            ?>
                        </table>
                        <?php if ($flagtbl == 0) { ?>
                            <script>
                                $(".<?php echo @$tblID; ?>").remove();
                            </script>
                        <?php } ?>
                    </div>

                    <?php
                }//IF IN ARRAY ELSE END
            }
        }
      
    }
}
    ?>  
</div></div>
    <?php
    // document list for Verifier 
    $documents_datas = array();
    $appSubID = $app_Sub_id;
    $sqlspapp = "Select bo_new_application_submission.submission_id as sno,bo_infowizard_issuerby_master.service_provider_tag as sp_tag,bo_new_application_submission.dept_id,bo_new_application_submission.user_id,bo_new_application_submission.processing_level from bo_new_application_submission 
        INNER JOIN bo_infowizard_issuerby_master ON  bo_infowizard_issuerby_master.issuerby_id = bo_new_application_submission.dept_id  Where bo_new_application_submission.submission_id='$appSubID'";
    $result = Yii::app()->db->createCommand($sqlspapp)->queryRow();
    /* echo "<pre>";
      print_r($result);die; */
    if (isset($result)) {
        $role_id = $_SESSION['role_id'];
        $sqlVeriSql = "Select * from bo_new_application_submission 
            INNER JOIN bo_infowiz_form_builder_configuration on bo_infowiz_form_builder_configuration.service_id=bo_new_application_submission.service_id AND bo_new_application_submission.processing_level=bo_infowiz_form_builder_configuration.processing_level AND bo_infowiz_form_builder_configuration.current_role_id='$role_id' AND bo_infowiz_form_builder_configuration.can_revert_to_investor='Y' AND bo_new_application_submission.submission_id='$appSubID'";
        $VeriFyData = Yii::app()->db->createCommand($sqlVeriSql)->queryRow();
        $sqlsupportDoc = "Select * from bo_new_application_submission WHERE bo_new_application_submission.submission_id='$appSubID'";
        $supportDocArr = Yii::app()->db->createCommand($sqlsupportDoc)->queryRow();
        ?>

       <div class="form-part bussiness-det">
                    <div id="title_<?php echo $tablefieldname;?>">                
                        <h4 class="form-heading">
                           Uploaded Documents
                        </h4>
                    </div> 
                    <div class="form-row row">
                        <div class="col-lg-6 form-group">
                            <?php 
                            $doc_status_arr = ['U'=>'Pending / Approved','R'=>'Rejected','ALL'=>'All'];
                            
                            ?>
                            <label>Document Status</label>
                            <select name="doc_status_filter" id="doc_status_filter" class="form-control" onchange="applydocfilter(<?= $result['sno']?>, <?= $result['user_id']?>, $(this).val())">
                                <?php foreach ($doc_status_arr as $key => $value) { ?>
                                    <option value="<?= $key ?>"><?= $value ?></option>
                                <?php } ?>                      
                            </select>  
                        </div>
                    </div>

                     <?php if (isset($supportDocArr['certificate_path']) && !empty($supportDocArr['certificate_path'])) { ?>         
                    <div style="float: left;display: inline-block;padding: 12px 0 8px;"><a href="<?php echo $supportDocArr['certificate_path']; ?>" style="color:#fff;" class="btn btn-primary" target="_blank">Download Supporting Documents</a></div>
                <?php } ?>          
                <?php if (isset($VeriFyData) && !empty($VeriFyData)) { ?>           
                 <!--inline-block;-->   <div style="float: right;display: none; padding: 12px 0 8px;"><a href="/backoffice/dms/DepartmentDMSNew/view/sno/<?php echo base64_encode($result['sno']); ?>/user/<?php echo base64_encode($VeriFyData['user_id']) ?>" style="color:#fff;" class="btn btn-primary" target="_blank">Verify Documents</a></div>
                <?php } ?>                
                    <div class="form-row row">
                        <div class="col-lg-12">
                          
                            <?php
                $AppDmsMapExt = new ApplicationDmsDocumentsMappingExt;
                $status_array['U'] = 'Pending';
                $status_array['V'] = 'Approved';
                $status_array['R'] = 'Rejected';
                $status_array_lb['U'] = 'warning';
                $status_array_lb['V'] = 'success';
                $status_array_lb['R'] = 'danger';
                $list_arr = $AppDmsMapExt::getAllUsedDocumentsOfInvestorServiceWise($result['sno'], $result['user_id'], 'U');
                ?>

                <table id="sample_31" class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th class="td_center">S.N.</th>
                            <th class="td_center">Document Name</th>
                            <th class="td_center">Date</th>
                           <!--  <th class="td_center">Status</th> -->
                          <!--   <th class="td_center">View</th> -->
                            <th class="td_center">Comments by Applicant</th>
                            <th class="td_center" width="25%">Action Details</th>               
                            <th class="td_center" width="25%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $docStatusFlag = array("pending" => false, "rejected" => false);
                        $verifiedDocumentflg = 0;
                        $rejectedDocumentflg = 0;
                        $checkDuplicate = array();
                        if ($list_arr) {
                            $sn = 1; $checkv_or_r =0;
                            foreach ($list_arr as $key => $val_arr) {
                                if ($verifiedDocumentflg == 0) {
                                    
                                }
                               // if (!in_array($val_arr['chklist_id'], $checkDuplicate)) {
                                 //   $checkDuplicate[] = $val_arr['chklist_id'];
                                    if ($val_arr['status'] != "V" && $val_arr['status'] != "R")
                                        $docStatusFlag['pending'] = true;
                                    if ($val_arr['status'] == "R")
                                        $docStatusFlag['rejected'] = true;
                                    ?>
                                    <tr>
                                        <td class="td_center"><?php echo $sn; ?></td>
                                      
                                        <td class="td_center">
                                            <a target="_blank" href="/backoffice/doc/mydoc?view=<?php echo DefaultUtility::getDockey($val_arr['document_file_name']); ?>"style="color:blue;">
                                                <?php echo $val_arr['name']; ?>
                                            </a>                                            
                                        </td>
                                        <td class="td_center">
                                            <?php echo $val_arr['created_on']; ?>
                                        </td>
                                                                      
                                        <td class="td_center">
                                            <?php echo @$val_arr['usercomment'] ?>
                                        </td>

                                      <td class="td_center">  
                                        <div id="vri_rej_details<?= $key ?>">

    <?php $mapping_id = $val_arr['mapping_id'];
        $appList = Yii::app()->db->createCommand("SELECT log.verifier_name,  log.verifier_comments, log.created_time as verified_date_time, log.status, log.dept_user_id,
        (SELECT role_id FROM bo_user_role_mapping r WHERE r.user_id=log.dept_user_id AND r.is_mapping_active='Y' ORDER BY r.mapping_id ASC LIMIT 1)   as role_id      
            FROM bo_application_dms_documents_mapping_logs as log
            
            WHERE log.mapping_id=$mapping_id ORDER BY log.id DESC")->queryAll();
            $l=1;
                $checklatest_user_comment = 'No' ;
                if($appList){
                    if($appList[0]['dept_user_id']==$_SESSION['uid']){
                         $checklatest_user_comment = 'Yes' ;
                    }
                   
                     foreach ($appList as $dulog) {  ?>
                        <b>By :</b> <?php echo $dulog['verifier_name']; ?>  <br>
                        <b>Date :</b> <?php echo $dulog['verified_date_time'] ? (date('d-m-Y h:i a',strtotime($dulog['verified_date_time']))) : 'NA'; ?> <br>
                        <b>Status : </b><?php echo $status_array[$dulog['status']]; ?><br>
                        <b>Comments :</b> <?php echo @$dulog['verifier_comments']; ?>
                            <?php if(sizeof($appList)>$l){ ?>
                              <hr style="color:black; height: 2px;">
                            <?php } ?>
                    <?php  $l++; } 
                }else{
                      $checkv_or_r++;  
                }
                    ?>        

                                        </div>                 
                                         </td>                                        
                                        <td class="td_center">
                                            <div id="vri_rej_btn<?= $key ?>">                                  
                                               <!--?php if($checklatest_user_comment=='No'){ ?-->
                                                <textarea rows="2" id="cmt_<?php echo $val_arr['mapping_id']?>" class="cmt_verifier form-control" name="comments" style ="height: 50px !important;"></textarea> 
                                                      <br>                      
                                                <input type="btn" class="btn btn-primary  verify btn_doc" value="Verify" onclick="actionOnDocument('<?php echo base64_encode($val_arr['mapping_id']); ?>', 'verify', 'Okay',<?php echo $val_arr['mapping_id']; ?>, <?= $key?>)"  >

                                                <input type="btn" class="btn btn-danger reject btn_doc" value="Reject" onclick="actionOnDocument('<?php echo base64_encode($val_arr['mapping_id']); ?>', 'reject','Reject',<?php echo $val_arr['mapping_id']; ?>, <?= $key?>)">      
                                             <!--?php } ?-->
                                             </div>
                                        </td>
                                    </tr>
                                    <?php
                                    ++$sn;
                                //}
                            }
                        } else {
                            echo "<tr><td colspan='6' style='text-align:center;'>No document found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                    <span class="hidden" id="checkv_or_r">
                        <?php 
                            echo $checkv_or_r;
                        ?>
                    </span>   
           </div>
        </div> 
    </div>

    <?php 
      }
        $cm = Yii::app()->db->createCommand("SELECT * FROM bo_declaration_metadata WHERE  service_id=$service_id AND application_id=$sub_id")->queryRow(); 
                            if($cm){ 
                                $sm = Yii::app()->db->createCommand("SELECT * FROM bo_declaration_master WHERE service_id=$service_id")->queryRow(); 
                                ?>
                  <div class="form-part bussiness-det">
                    <div id="title_<?php echo $tablefieldname;?>">                
                        <h4 class="form-heading">
                            Declaration
                        </h4>
                    </div>
                   
                    <div class="form-row row">
                               <div class="col-lg-12">
                          
                            <p><?php echo $sm['declaration_label']; ?></p>
                         
                            <?php $cbnid = 'CP-DCHK-'.$service_id; ?>
                            <input type="checkbox" id="<?php echo $cbnid; ?>" name="<?php echo $cbnid; ?>" checked="" disabled="">

                            <label for="<?php echo $cbnid; ?>"><?php echo $sm['option']; ?></label><br>
                            <span id='dcbox-error' style="color: red;"></span>
                          
                        </div>
                    </div> 
                    </div>   
<?php } ?>



 <div class="form-part bussiness-det">
    <div id="title_<?php echo $tablefieldname;?>">                
        <h4 class="form-heading">
            Signature
        </h4>
    </div>
   
    <div class="form-row row">
        <div class="col-lg-12">          
          <table id="sample_31" class="table table-striped table-bordered" width="100%">
                              <thead>
                                  <tr>
                                      <th class="td_center">Full Name</th>                                   
                                      <th class="td_center">Designation</th>
                                    
                                      <th class="td_center">Signature</th>
                                      <th class="td_center">Date of Signature</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  
                                  <?php
                                      $signatoryDetails=Yii::app()->db->createCommand("SELECT * FROM bo_signature_metadata where submission_id = $sub_id and is_active=1")->queryAll();

                                  $signDate=date('d M,Y');
                                   if(isset($signatoryDetails) && count($signatoryDetails) > 0){
                                     foreach ($signatoryDetails as $key => $signDetails) {
                                       $signDate=date('d M,Y',strtotime($signDetails['date_of_signing']));
                                       echo '<tr>
                                         <td class="td_center">'.$signDetails['first_name'].' '.$signDetails['middle_name'].' '.$signDetails['last_name'].'</td>  
                                         <td class="td_center">'.$signDetails['designation'].'</td>
                                         <td class="td_center">Electronically signed</td>
                                          <td class="td_center">'.$signDate.'</td>
                                  </tr>';
                                     }
                                   }
                                  ?>
                              </tbody>
                          </table>       
        </div>
    </div> 
</div>  
        
    <?php  
        if(isset($_SESSION['role_id']) && $_SESSION['role_id']=='83')
        {
    ?>
        
        <?php } 
        if(isset($_SESSION['role_id']) && $_SESSION['role_id']=='84'){
        ?>
        
        
        <?php }?>
        
    <?php if ($formCodeID != 1 && $is_dept_active != "no") { ?>
        <div class="row deptuseonly">            
            <?php
            $categoryPreference = array();
            foreach ($processingformData as $key => $fd) {
                $inputType = $fd['input_type'];
                if (!in_array($fd['category_id'], $categoryPreference)) {
                    $keyy = -1;
                    $categoryPreference[] = $fd['category_id'];
                    ?>
                  


                   <div id="title_<?php echo $tablefieldname;?>">                
                        <h4 class="form-heading">
                                <?php
                                echo @$formName = InfowizardQuestionMasterExt::getMasterName('bo_infowiz_form_categories', $fd['category_id'], 'category_name', 'id');
                                $catNameDept = $fd['category_id'];
                                ?>
                            </h4>
                        </div>
                       <!--  <div class="actions">
                            <div class="portlet-input input-inline input-small">
                            </div>
                        </div> -->
                 
                    <hr>
                    <?php
                }
                ?>
                <?php
                if ($keyy % 2 == 0) {
                    if (!isset($flg)) {
                        echo "<div class='row'>";
                    }
                }
                $keyy = $keyy + 1;
                ?>
                <?php
                if ($inputType == "text" || $inputType == "number" || $inputType == "password") {
                    $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id')
                    ?>
                    <div class="form-group col-md-6">
                        <label class="col-md-12 control-label text-left" for="" id="label_<?php echo $tablefieldname; ?>" >
                            <?php
                            echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
                            echo " <b class='ukfcl'>(" . $tablefieldname;
                            ?><?php
                            echo ")</b>";
                            if ($fd['is_required'] == 'Y') {
                                echo "<span style='color:red;'> *</span>";
                            }
                            ?>
                            <?php
                            if (!empty($fd['helptext'])) {
                                $helptext = $fd['helptext'];
                                echo " <i class='fa fa-question-circle' title='$helptext'></i>";
                            }
                            ?>
                        </label>
                        <div class="col-md-12">
                            <input type="<?php echo $inputType; ?>" name="<?php echo $tablefieldname; ?>" placeholder='<?php echo $formName ?>' class="form-control"  
                            <?php
                            if ($fd['is_required'] == 'Y') {
                                echo "required";
                            }
                            ?> id="<?php echo $tablefieldname; ?>">
                        </div>
                    </div>
                <?php } ?>                  
                <?php
                if ($inputType == "select" || $inputType == "multipleselect") {
                    $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
                    ?>
                    <div class="form-group col-md-6" id="div_<?php echo $tablefieldname; ?>">
                        <label class="col-md-12 control-label text-left" for="" id="label_<?php echo $tablefieldname; ?>">                      
                            <?php
                            echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
                            echo " <b class='ukfcl'>(" . $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
                            ?><?php
                            echo ")</b>";
                            ;
                            if ($fd['is_required'] == 'Y') {
                                echo "<span style='color:red;'> </span>";
                            }
                            ?> 

                            <?php
                            if (!empty($fd['helptext'])) {
                                $helptext = $fd['helptext'];
                                echo " <i class='fa fa-question-circle' title='$helptext'></i>";
                            }
                            ?>                              
                        </label>
                        <?php
                        $rawquery = "";

                        $configOptions = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_config_values WHERE service_id ='$_GET[service_id]' AND formvar_code='$tablefieldname' AND is_active='Y'")->queryRow();
                        if (!empty($configOptions)) {
                            $rawquery = $configOptions["raw_query"];
                        }
                        $options = Yii::app()->db->createCommand("SELECT bo.*, bm.master_table_name, bm.key_id, bm.field_value, bm.is_active_field,
                                                     bm.is_active_value FROM bo_infowiz_formfield_options as bo
                                                     LEFT JOIN bo_master_tables as bm ON bo.master_table_id=bm.id
                                                     WHERE bo.formfield_id=$fd[id] AND bo.master_table_id!=0 AND bo.is_active='Y' ORDER BY bo.id DESC")->queryRow();
                        if (isset($options) && !empty($options)) {

                            $table_name = $options['master_table_name'];
                            $key_id = $options['key_id'];
                            $field_value = $options['field_value'];
                            $is_active_field = $options['is_active_field'];
                            $is_active_value = $options['is_active_value'];
                            $allList = InfowizardQuestionMasterExt::getMasterList($table_name, $key_id, $field_value, $is_active_field, $is_active_value);
                            if (!empty($rawquery)) {
                                $allList = InfowizardQuestionMasterExt::getConfigList($rawquery);
                            }
                            $selectedDeptArr = array();
                            if (isset($selectedDept) && !empty($selectedDept)) {
                                $selectedDeptArr = array_column($selectedDept, 'dept_id');
                            }
                            ?>
                            <div class="col-md-12">
                                <select name="<?php
                                echo $tablefieldname;
                                if ($inputType != "select") {
                                    echo "[]";
                                }
                                ?>" <?php
                                        if ($inputType == "multipleselect") {
                                            echo " multiple='true' style='max-height:120px;'";
                                        }
                                        ?> placeholder='<?php echo $formName; ?>' class="select2-me" <?php
                                        if ($fd['is_required'] == 'Y') {
                                            echo "required";
                                        }
                                        ?> id="<?php echo $tablefieldname; ?>">
                                    <option value="">Please Select </option>
                                    <?php foreach ($allList as $key => $val) { //UK-FCL-00190_0  ?>
                                        <option value="<?php echo $key; ?>" <?php
                                        if ($tablefieldname == 'UK-FCL-00190_0' && in_array($key, $selectedDeptArr)) {
                                            echo "selected";
                                        }
                                        ?> ><?php echo $val; ?></option>
                                            <?php } ?>
                                </select>    
                            </div>



                            <?php
                        } else {
                            $options = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_formfield_options WHERE formfield_id=$fd[id] AND is_active='Y' ORDER BY id DESC")->queryAll();
                            ?>                      
                            <div class="col-md-12">
                                <select name="<?php
                                echo $tablefieldname;
                                if ($inputType != "select") {
                                    echo "[]";
                                }
                                ?>" <?php
                                        if ($inputType == "multipleselect") {
                                            echo " multiple='true' style='max-height:120px;'";
                                        }
                                        ?> placeholder='<?php echo $formName; ?>' class="select2-me"  <?php
                                        if ($fd['is_required'] == 'Y') {
                                            echo "required";
                                        }
                                        ?> id="<?php echo $tablefieldname; ?>">

                                    <option value="">Please Select </option>
                                    <?php foreach ($options as $option) { ?>
                                        <option value="<?php echo $option['options']; ?>"><?php echo $option['options']; ?></option>
                                    <?php } ?>
                                </select>    
                            </div>                              
                        <?php } ?>      

                    </div>
                <?php } ?>  
                <?php
                // Genrating select field for type select and multiple select
                if ($inputType == "checkbox" || $inputType == "radio") {
                    $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
                    ?>
                    <div class="form-group col-md-6" id="div_<?php echo $tablefieldname; ?>">
                        <label class="col-md-12 control-label text-left" for="<?php echo $tablefieldname; ?>" id="label_<?php echo $tablefieldname; ?>" >
                            <?php
                            echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
                            echo " <b class='ukfcl'>(" . $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
                            ?><?php
                            echo ")</b>";
                            ;
                            if ($fd['is_required'] == 'Y') {
                                echo "<span style='color:red;'> *</span>";
                            }
                            ?> 
                            <?php
                            if (!empty($fd['helptext'])) {
                                $helptext = $fd['helptext'];
                                echo " <i class='fa fa-question-circle' title='$helptext'></i>";
                            }
                            ?>
                        </label>
                        <div class="col-md-12" id="innerdiv_<?php echo $tablefieldname; ?>">
                            <?php
                            $options = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_formfield_options where formfield_id=$fd[id] AND is_active='Y' ORDER BY id DESC")->queryAll();
                            ?>
                            <?php
                            foreach ($options as $option) {
                                ?>
                                <div class="col-md-6">
                                    <input name="<?php
                                    echo $tablefieldname;
                                    if ($inputType == "checkbox") {
                                        echo "[]";
                                    }
                                    ?>" type="<?php echo $inputType; ?>" value="<?php echo $option['options']; ?>" name="<?php echo $fd['id'] ?>" class="<?php echo $tablefieldname; ?>">&nbsp; <?php echo $option['options']; ?>
                                </div> 
                            <?php } ?>

                        </div>
                    </div>
                <?php } ?>
                <?php
                // Genrating textarea
                if ($inputType == "textarea") {
                    $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
                    ?>
                    <div class="form-group col-md-6" id="div_<?php echo $tablefieldname; ?>">
                        <label class="col-md-12 control-label text-left" for=""  id="label_<?php echo $tablefieldname; ?>">
                            <?php
                            echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
                            echo " <b class='ukfcl'>(" . $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
                            ?><?php
                            echo ")</b>";
                            ;
                            if ($fd['is_required'] == 'Y') {
                                echo "<span style='color:red;'> *</span>";
                            }
                            ?>
                            <?php
                            if (!empty($fd['helptext'])) {
                                $helptext = $fd['helptext'];
                                echo " <i class='fa fa-question-circle' title='$helptext'></i>";
                            }
                            ?> 
                        </label>
                        <div class="col-md-12">
                            <textarea name="<?php echo $tablefieldname; ?>" id="<?php echo $tablefieldname; ?>" class="form-control comment" row="2"></textarea>
                        </div>
                    </div>
                <?php } ?>
                <?php
                // Genrating Calender
                if ($inputType == "calender") {
                    $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
                    ?>
                    <div class="form-group col-md-6">
                        <label class="col-md-12 control-label text-left" for="" id="label_<?php echo $tablefieldname; ?>">
                            <?php
                            echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
                            echo " <b class='ukfcl'>(" . $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
                            ?><?php
                            echo ")</b>";

                            if ($fd['is_required'] == 'Y') {
                                echo "<span style='color:red;'> *</span>";
                            }
                            ?>
                            <?php
                            if (!empty($fd['helptext'])) {
                                $helptext = $fd['helptext'];
                                echo " <i class='fa fa-question-circle' title='$helptext'></i>";
                            }
                            ?>
                        </label>
                        <div class="col-md-12">
                            <input type="inputType" name="<?php echo $tablefieldname; ?>" id="<?php echo $tablefieldname; ?>" class="datepicker form-control">
                        </div>
                    </div>

                <?php } ?>
                <?php
                // Genrating date time Calender
                if ($inputType == "datetimecalendar") {
                    $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
                    ?>
                    <div class="form-group col-md-6">
                        <label class="col-md-12 control-label text-left" for="" id="label_<?php echo $tablefieldname; ?>">
                            <?php
                            echo $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
                            echo " <b class='ukfcl'>(" . $tablefieldname = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'formchk_id', 'formvar_id');
                            ?><?php
                            echo ")</b>";

                            if ($fd['is_required'] == 'Y') {
                                echo "<span style='color:red;'> *</span>";
                            }
                            ?>
                            <?php
                            if (!empty($fd['helptext'])) {
                                $helptext = $fd['helptext'];
                                echo " <i class='fa fa-question-circle' title='$helptext'></i>";
                            }
                            ?>
                        </label>
                        <div class="col-md-12">                             
                            <input type="text" name="<?php echo $tablefieldname; ?>" id="<?php echo $tablefieldname; ?>" class="controls form-control date form_datetime" readonly data-date-format="dd-mm-yyyy HH:ii:ss">
                        </div>
                    </div>

                <?php } ?>

                <?php
                if ($inputType == "button") {

                    if (!isset($flg)) {
                        $flg = 0;
                    }

                    if ($flg == 0 && $catNameDept == "5") {
                        if ($formCodeID != 1) {
                            $sshow = "display:block";
                        } else {
                            $sshow = "display:none";
                        }
?>
                       
                       </div><div class="row"><br></div>
                       <div class="row deptuseonly showApprov showReject">
                                            <div class="form-group col-md-6" style="$sshow">
                                                <label class="col-md-12 control-label text-left" for="">
                                                    Upload Supporting Documents
                                                </label>
                                                <div class="col-md-12">                             
                                                    <input type="file" id="supportive_document" name="supportive_document" class="border-0" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row showalways" id="processingButton" style="text-align:center;">
                                            <div class="clear"></div>
                                        </div>
                                           <br>
                       <?php $flg = 1;
                    }
                    if (!isset($flg2)) {
                        $flg2 = 0;
                    }
                    if ($flg2 == 0 && $catNameDept == "141") {
                        if ($formCodeID != 1) {
                            $sshow = "display:block";
                        } else {
                            $sshow = "display:none";
                        }
                        $flg2 = 1;
                    }
                    $formName = InfowizardQuestionMasterExt::getMasterName('bo_infowizard_formvariable_master', $fd['form_field_id'], 'name', 'formvar_id');
                    $status = "";
                    //echo $formName;
                    if ($formName == 'Approve') {
                        $status = "A";
                        $cls = "btn btn-success";
                        $showFlag = 1;
                        //if(!empty($allData['can_approve']) && $allData['can_approve']=='Y') { $showFlag=1;}
                    } elseif ($formName == 'Reject') {
                        $status = "R";
                        $cls = "btn btn-primary";
                        $showFlag = 1;
                        //if(!empty($allData['can_reject']) && $allData['can_reject']=='Y') { $showFlag=1;}
                    } elseif ($formName == 'Revert to Investor') {
                        $status = "H";
                        $cls = "btn btn-primary";

                        $showFlag = 1;
                        //if(!empty($allData['can_revert']) && $allData['can_revert']=='Y') { $showFlag=1;}
                    } elseif ($formName == 'Forward') {
                        $status = "F";
                        $cls = "btn btn-warning ";
                        $showFlag = 1;
                        //if(!empty($allData['can_forward']) && $allData['can_forward']=='Y') { $showFlag=1;}
                    } elseif ($formName == 'Submit') {
                        $status = "V";
                        $cls = "btn btn-primary ";
                        $showFlag = 1;
                        //if(!empty($allData['can_submit']) && $allData['can_submit']=='Y') { $showFlag=1;}else{$showFlag=1;}
                    } elseif ($formName == 'Forward to Approver') {
                        $status = "FA";
                        $cls = "btn btn-primary ";
                        $showFlag = 1;
                        //if(!empty($allData['can_submit']) && $allData['can_submit']=='Y') { $showFlag=1;}else{$showFlag=1;}
                    } elseif ($formName == 'Revert to Nodal') {
                        $status = "P";
                        $cls = "btn btn-primary ";
                        $showFlag = 1;
                        //if(!empty($allData['can_submit']) && $allData['can_submit']=='Y') { $showFlag=1;}else{$showFlag=1;}
                    } elseif ($formName == 'Save Inspection Date') {
                        $status = "INSD";
                        $cls = "btn btn-primary ";
                        $showFlag = 1;
                        //if(!empty($allData['can_submit']) && $allData['can_submit']=='Y') { $showFlag=1;}else{$showFlag=1;}
                    } elseif ($formName == 'Save Inspection Detail') {
                        $status = "SINS";
                        $cls = "btn btn-primary ";
                        $showFlag = 1;
                        //if(!empty($allData['can_submit']) && $allData['can_submit']=='Y') { $showFlag=1;}else{$showFlag=1;}
                    }
                    ?>
                
                    <?php

                    if (isset($formCodeID)) {
                        if ($showFlag == 1) {                           
                            ?>
                            <input type="button"  value="<?php echo $formName; ?>" class="<?php echo $cls; ?> status_butt" rel="<?php echo $status; ?>">
                            <?php
                        }
                    } else {
                        if ($showFlag == 1 && !$docStatusFlag['pending']) {
                            ?>     
                             <a href="<?php echo $_SERVER['REQUEST_URI']; ?>/status/<?php echo $status; ?>" class="<?php echo $cls; ?>">
                                <?php echo $formName; ?>
                            </a>    
                            <?php
                        }
                    }

                    ?>

                   <!--  above code update below -->
                 <!--      <input type="button"  value="<`?php echo $formName; ?>" class="<`?php echo $cls; ?> status_butt" rel="<`?php echo $status; ?>">

                    <`?php if ($showFlag == 1 && !$docStatusFlag['pending']) {
                            ?>     
                             <a href="<`?php echo $_SERVER['REQUEST_URI']; ?>/status/<`?php echo $status; ?>" class="<`?php echo $cls; ?>">
                                <`?php echo $formName; ?>
                            </a>    
                            <`?php
                        } ?> -->

                <?php } ?>
                <?php
                if ($inputType != "button") {
                    if ($keyy % 2 != 0) {
                        echo "</div>";
                    }
                }
                ?>
                <?php
            }
            ?>

            <input type="hidden" name="app_Sub_id" value="<?php echo $sub_id; ?>">
            <input type="hidden" name="app_status" id="app_status" value="">
            <input type="hidden" name="service_id" value="<?php echo $service_id; ?>">
            <input type="hidden" name="form_id" value="<?php echo $formCodeID; ?>">

        </div>
        <!-- Departmental Processing Form End Here1-->  
    <?php } ?>


</div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
             checkmainbuttons();
    }); 

    $(".status_butt").on('click', function () {
        if(confirm('Are you sure?')) 
                    {
        var butt_sttaus = $(this).attr('rel');
        $("#app_status").val(butt_sttaus);
        $("#UK-FCL-00036_0").next('.field-validation-error').remove();
        if($("#UK-FCL-00036_0").val() == '')
        {
            $("#UK-FCL-00036_0").after("<div style='color:red;margin-bottom:20px;' class='field-validation-error'>Please enter comment.</div>");
            return false;
        } else {
            $("#FB_form").submit();
        }
    }else{
         return false;
    }
    });
    
    $("input[rel$='P']").val('Revert to Verifier');
    $("input[rel$='H']").val('Revert to Applicant');
    
    $(".addmore_tbl").each(function () {

    });
    
    $('.form_datetime').datetimepicker({
        minDate: new Date(),
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });

    function openPopup(doc_chk_id, dm, sid) {
        $('#md_cont').load('/backoffice/dms/DepartmentDMS/GetDCP/doc_chk_id/' + doc_chk_id + '/dm/' + dm + '/sid/' + sid);
    }

    function action_dp_fun(idddd) {
        if ($('#' + idddd).val() == 'No') {
            $('#cmt_' + idddd).attr('required', 'required');
        } else {
            $('#cmt_' + idddd).removeAttr('required');
        }
    }
    
   function actionOnDocument(mapid, action,comment,comid, divid) {
       var comments = $('#cmt_' + comid).val();//$('#dms_comment_' + map_new_id).val();
       if (action == 'verify') {
           cnf_msg = "Are you sure you want to verify this document?";
       } else if (action == 'reject') {
           cnf_msg = "Are you sure you want to reject this document?";
       }
       $.ajax({
           type: "POST",
           dataType:'json',
           url: "<?php echo Yii::app()->request->baseUrl; ?>/dms/DepartmentDMS/departmentActionOnDocument/",
           data:
               {
                   mapid: mapid,  action: action, comment: comments
               },
           beforeSend: function(){
               $("#overlay").attr("style",'display:block;');
           },
           success: function (data) {
               if (data.status) {
                 /*  window.location = window.location.href
                   return;*/
                 $('#cmt_' + comid).val("");
                   //$("#vri_rej_btn"+divid).hide();
                   $("#vri_rej_details"+divid).html(data.contenttext);
                   //$("#status"+divid).html(data.status);
                    var checkv_or_r = parseInt($("#checkv_or_r").text());
                   $("#checkv_or_r").text(checkv_or_r-1);
                   checkmainbuttons();
               } else {
                   alert(data.msg);
               }
                $("#overlay").attr("style",'display:none;');
           },

           error: function (jqXHR, textStatus, errorThrown) {
               alert('error::' + errorThrown);
           }
       });
   }

    function checkmainbuttons(){
         var checkv_or_r = parseInt($("#checkv_or_r").text());          
        if(checkv_or_r<=0){
             console.log('button show');
            $(".status_butt").attr('type','button');
        }else{
            $(".status_butt").attr('type','hidden');
        }
    }
     function applydocfilter(srn_no, user_id, doc_status){
        //alert(srn_no + ' ' + user_id + ' ' + doc_status);
         $.ajax({
           type: "POST",
           dataType:'json',
           url: "<?php echo Yii::app()->request->baseUrl; ?>/dms/DepartmentDMS/docstatusfilter/",
           data:
               {
                   srn_no: srn_no,  user_id: user_id, status: doc_status
               },
           beforeSend: function(){
               $("#overlay").attr("style",'display:block;');
           },
           success: function (data) {
                $("#sample_31").html(data.list_data);
                $("#overlay").attr("style",'display:none;');
           },

           error: function (jqXHR, textStatus, errorThrown) {
               alert('error::' + errorThrown);
           }
       });
        
        
    }
</script>
