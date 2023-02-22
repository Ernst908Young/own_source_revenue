<style type="text/css">
	.mt-element-step .step-thin .done {background-color:#36c6d3 !important;}
    .mt-step-col{cursor: pointer;}
    .portlet.box .dataTables_wrapper .dt-buttons { margin-top: 14px; }
    @media (min-width: 700px){
        .col-lg-3 { width: 20%;}
    }
    .href_link:hover{ color:#23527c;}
    .href_link1{ color: #ffffff; font-size: 13px; font-family: "Open Sans",sans-serif; font-weight: 300; text-align: center;vertical-align: top; padding: 2px 5px; }        
    .movetoDashboard{ cursor: pointer; }
</style>
<?php 
	$html = '';
	$data_ = InfowizardQuestionMasterExt::getAllServiceFormMapping($_GET['service_id']);
	$controllerName = "subForm";
	$getContollerAccordingToServiceArr = Yii::app()->db->createCommand("SELECT form_action_controller FROM bo_infowiz_form_builder_configuration where service_id=$_GET[service_id] AND current_role_id=0")->queryRow();
	
	if(isset($getContollerAccordingToServiceArr['form_action_controller']) && !empty($getContollerAccordingToServiceArr['form_action_controller']))
	{	
		$controllerName = $getContollerAccordingToServiceArr['form_action_controller'];
	}
	if($data_){

		$i_ =1;
		$cnt_ = count($data_);
		$cunt_d = 12/$cnt_;
		$ser_id_ = $_GET['service_id'];
		
		$flg=1;
		//echo"<pre/>";
		//print_r($data_);
		foreach ($data_ as $key=>$value) {
			$frm_cd_id = $value['form_type_id'];
			$page_id_ = $value['page_name'];
	        if(isset($_GET['subID'])) {
				$subId = $_GET['subID'];
				$flg=0;
			}else if(isset($_GET['sub_id'])) {
				$subId = $_GET['sub_id'];
				$flg=0;
			}
			else{ 
				$subId = ''; 
				$flg=1;
			}


			if($key==0) {
				if($flg==0){
					//$url_ = "/backoffice/infowizard/subForm/updateSubForm/service_id/$ser_id_/pageID/$page_id_/subID/$subId/formCodeID/$frm_cd_id";
					$url_ = "/backoffice/infowizardtwo/$controllerName/departmentFormView/service_id/$ser_id_/pageID/$page_id_/subID/$subId/formCodeID/$frm_cd_id";
					
					$frmCodId=$frm_cd_id;
				}
				else 	
					$url_ ="/backoffice/infowizardtwo/formBuilder/$controllerName/service_id/$ser_id_/pageID/$page_id_/formCodeID/$frm_cd_id";
					$frmCodId=$frm_cd_id;
			}
			else{
				if($flg==0){	
					$url_ ="/backoffice/infowizardtwo/$controllerName/departmentFormView/service_id/$ser_id_/pageID/$page_id_/formCodeID/$frm_cd_id/subID/$subId";
					$frmCodId=$frm_cd_id;
				}	else {		
					$url_ ="/backoffice/infowizardtwo/formBuilder/$controllerName/service_id/$ser_id_/pageID/$page_id_/formCodeID/$frm_cd_id";
					$frmCodId=$frm_cd_id;
				}

			}

			if($frm_cd_id==$_GET['formCodeID']) $cls ="done";
			else $cls='';

			if($cnt_==5)
			{
			?>
				<style type="text/css">
				.col-sm-2 {
					width: 20% !important;
				}
				</style>	
			<?php	
				$class = "col-sm-2";
			}else{
				$class = "col-md-$cunt_d";
			}
			$display = 'block';
			if(isset($_SESSION['RESPONSE']['user_id']) && !empty($_SESSION['RESPONSE']['user_id']) && $frmCodId!=1)
			{
				$display = 'none';
			}
	
			$html .='<a href="'.$url_.'" data-form-id="'.$frmCodId.'" id="tab_'.$frmCodId.'" style="display:'.$display.'"><div class="'.$class.' bg-grey  mt-step-col '.$cls.' " relurl="'.$url_.'" style="cursor: pointer;"><div class="mt-step-number bg-white font-grey">'.$i_.'</div><div class="mt-step-title uppercase font-grey-cascade"></div><div class="mt-step-content font-grey-cascade" title="'.$value['form_name'].'" style="font-size: 16px;" >'.$value['form_name'].'</div></div></a>';
            $i_ ++;
			
		}
	}	
	
?>
<div class="mt-element-step" style="margin-bottom: 20px">
	<div class="row step-thin"><?php echo $html; ?></div>
</div>
