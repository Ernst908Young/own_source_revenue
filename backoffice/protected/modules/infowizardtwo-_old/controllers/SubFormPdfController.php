<?php
class SubFormPdfController extends Controller {

    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

	public function actionDownloadCertificate(){
		
		@session_start();
		//$content = $this->renderPartial('subformview', array('aap' => $allActivePages, 'formData' => $formData,'fieldValues'=>$fieldValues2), true);
		$content = $this->renderPartial('downloadcert', array(),true);
		$name = "UK-New_Application_Form_".time().".pdf";		
		Utility::generateHindiPdfApp($content,$name);  
		exit;
	}
	
	public function actionDownloadFilmCertificate(){
		
		@session_start();
		$content = $this->renderPartial('permission_form', array(),true);
		$name = "UK-Film_Permission_Letter_".time().".pdf";		
		UtilityFilm::generateHindiPdfApp($content,$name);  
		exit;
	}
	
	public function actionDownloadFilmCertificate3(){
		
		@session_start();
		$service_id = DefaultUtility::dataSenetize($_GET['service_id']);
		$submission_id = DefaultUtility::dataSenetize($_GET['subID']);
		
		$adddata = $this->getAddMoreData($service_id,$submission_id);
		/* echo "<pre>";
		print_r($adddata); */
		$newAppArr = Yii::app()->db->createCommand("SELECT * FROM bo_new_application_submission where submission_id='$submission_id'")->queryRow();
		
		$AppPdfArr = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_certificate where service_id='$service_id'")->queryRow();
			
		$AppPdfcontent = array();		
		$contAddMore = '';
		preg_match_all('/<!--ADDMORE-->(.*?)<!--ADDMORE-->/si', $AppPdfArr['content'], $matchesadd_more); 
		
		if(!empty($matchesadd_more[0][0]))
		{	
			preg_match_all("/\#(.*?)\#/",$matchesadd_more[0][0], $matchesadd);
			
			$i=1;	
			$html="";
			$new = $matchesadd_more[0][0];
			if(!empty($adddata))
			{
				foreach($adddata as $key=>$val)
				{		
					$matchesadd_more[0][0]	= str_replace("#key#",$i,$matchesadd_more[0][0]);
					foreach($val as $k=>$v)
					{			//echo $v;
						$matchesadd_morenew	= str_replace("#".$k."#",$v,$matchesadd_more[0][0]);
						$matchesadd_more[0][0] = $matchesadd_morenew;	
					}	
					$html = $html." ".$matchesadd_morenew ;
					$i++;	$matchesadd_more[0][0]=$new;
				}
				//print_r($html);die;
				$AppPdfArr['content'] = preg_replace('/<!--ADDMORE-->(.*?)<!--ADDMORE-->/si',$html, $AppPdfArr['content']);
			}	
		}
	
		preg_match_all("/\{(.*?)\}/",$AppPdfArr['content'], $matches);
				
		$fieldValueArr = (array)json_decode($newAppArr['field_value']);
		
		$cont = $AppPdfArr['content'];
				
		setlocale(LC_TIME, "hi_IN");
		$month_name = strftime("%d, %B %Y"); 		
		$cont = str_replace("{CURR_DATE}",$month_name,$cont);	
		
		foreach($matches[1] as $key=>$val)
		{	
			if($val!='CURR_DATE' && $val!='SHOW_MULTIPLE')
			{
				$cont = str_replace("{".$val."}",$fieldValueArr[$val],$cont);
			}	
		}
				
		$content = $cont;
		
		$name = "UK-Film_Permission_Letter_".time().".pdf";		
		UtilityFilm::generateHindiPdfApp($content,$name,DefaultUtility::dataSenetize($_GET['dept_id']));
		die();
	}
	
	
	public function getAddMoreData($service_id,$submission_id)
	{
		
		$service_id = DefaultUtility::dataSenetize($service_id);
		$submission_id = DefaultUtility::dataSenetize($submission_id);
		$arrofIn=array(); 
		$get_selected_field = InfowizardQuestionMasterExt::get_selected_field($service_id);
		$allData23 = InfowizardQuestionMasterExt::getsubmittedvalues($service_id,$submission_id);
		
		$btnArray=array();
		$allDataMappedWithButton=array();
		foreach($get_selected_field as $gsf){

			$btnArray[]=$gsf['button_id'];
			$btnID=$gsf['button_id'];
			$sfArray[]=$gsf['selected_field_id'];
			if(!isset($allDataMappedWithButton[$btnID])){
				$allDataMappedWithButton[$btnID]=array();
			}
			$allDataMappedWithButton[$btnID][]=$gsf['formchk_id'];
		}
		$data = array();
	
		foreach($get_selected_field as $key => $valued) {
			//if($fd['id']==$valued['button_id']){
				$fcode=$valued['formchk_id'];
				$btnID=$valued['button_id'];
				
				if(!in_array($valued['button_id'],$arrofIn)){
					$arrofIn[]=$valued['button_id'];
				
					//$data ="<tr>";
					for($k=0; $k<(count($allData23[$fcode]));$k++){		
							
						foreach($allDataMappedWithButton[$btnID] as $key1=>$datag){
							
							if(is_array($allData23[$datag])){ 
								$val = @$allData23[$datag][$k]; 
							}else{
								$val = $allData23[$datag];
							} 
							
							if(is_array($allData23[$datag]))
							{ 
								$title = @$allData23[$datag][$k]; 
							}else{
								$title = $allData23[$datag];
							}
						
							//$data .= "<td>".$val."<td>";
							$data[$k][$datag] = $val;
						} 
										
					}
					//$data .="</tr>";	
					
				}
			//}
		}
	
		if($data){
			return $data;
		}else{
			return "";
		}	
	}		

	private function generateCertificateNumber($processingLevel,$districtId,$user_id,$cafid){
		$processingLevel = DefaultUtility::dataSenetize($processingLevel);
		$districtId = DefaultUtility::dataSenetize($districtId);
		$user_id = DefaultUtility::dataSenetize($user_id);
		$cafid = DefaultUtility::dataSenetize($cafid);
		
		
		$userArr = Yii::app()->db->createCommand("SELECT iuid FROM sso_users where user_id='$user_id'")->queryRow();
		$certificateNumber='';
		if($processingLevel=='State')
			$certificateNumber.='01';
		else
			$certificateNumber.='02';
		$certificateNumber.='-'.$districtId;
		$certificateNumber.='-CAFIP';
		$certificateNumber.='-'.$userArr['iuid'].$cafid;
		return $certificateNumber;
		/**
		* 01-State Application
		* 02 Distt Application
		*/
	}

	public function actionSaveNewApprovalCertificate2_0($service_id=null,$subID=null,$dept_id=null,$reg_no=NULL,$uname=null){
		
		$service_id = DefaultUtility::dataSenetize($service_id);
		$subID = DefaultUtility::dataSenetize($subID);
		$dept_id = DefaultUtility::dataSenetize($dept_id);
		//$utility = DefaultUtility::dataSenetize($utility);
		//echo "sdfsdfsdf"; die;
		extract($_GET);
		@session_start();
		$service_id = base64_decode($service_id);
		$submission_id = base64_decode($subID);
		$reg_no = base64_decode($reg_no);
		$uname = base64_decode($uname);
		
		$adddata = array();
		
		$AppPdfArr = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_certificate where service_id=$service_id and form_type='business_name_related'")->queryRow();
		/* echo "<pre>";
		print_r($AppPdfArr); */				
		$AppArrNew = explode(",",$AppPdfArr['fieldcode']);
		
		extract($AppPdfArr);
		
		$newAppArr = Yii::app()->db->createCommand($querysql.$submission_id)->queryRow();
		$dataAppArr =  Yii::app()->db->createCommand("SELECT bo_infowiz_formbuilder_application_forward_level.comment_date FROM bo_new_application_submission
		Left join bo_infowiz_formbuilder_application_forward_level ON bo_infowiz_formbuilder_application_forward_level.app_Sub_id = bo_new_application_submission.submission_id
		where bo_new_application_submission.submission_id='$submission_id' order by bo_infowiz_formbuilder_application_forward_level.appr_lvl_id ASC")->queryRow();
			
		$fieldValueArr = (array)json_decode($newAppArr['field_value']);		
		$cont = $AppPdfArr['content'];
				
		if(isset($AppArrNew) && !empty($AppArrNew))
		{	
			foreach($AppArrNew as $v)
			{	
				if($v=='current_date')
				{	
					$cont = str_replace("#current_date#",date('d F, Y',strtotime($newAppArr['application_updated_date_time'])),$cont);
				}
				if($v=='state_name')
				{	
					$state=$fieldValueArr['UK-FCL-00060_0'];
					$stateName = Yii::app()->db->createCommand("SELECT * FROM bo_landregion where lr_id='$state'")->queryRow();
					$cont = str_replace("#state_name#",$stateName['lr_name'],$cont);
				}
				if($v=='country_name')
				{	
					$country=$fieldValueArr['UK-FCL-00059_0'];
					$countryName = Yii::app()->db->createCommand("SELECT * FROM bo_landregion where lr_id='$country'")->queryRow();
					$cont = str_replace("#country_name#",$countryName['lr_name'],$cont);
				}
				if($v=='number')
				{
					$cont = str_replace("#number#",$reg_no,$cont);
				}
				if($v=='week_name')
				{
					$cont = str_replace("#week_name#",date('l',strtotime($newAppArr['application_updated_date_time'])),$cont);
				}
				if($v=='received_week_day')
				{
					$cont = str_replace("#received_week_day#",date('l',strtotime($dataAppArr['comment_date'])),$cont);
				}
				if($v=='registrar_name')
				{					
					$cont = str_replace("#registrar_name#",$uname,$cont);
				}
				if($v=='received_date')
				{					
					$cont = str_replace("#received_date#",date('d F, Y',strtotime($dataAppArr['comment_date'])),$cont);
				}
			}	
		} 		
		$cont = str_replace('{UK-FCL-00056_0}', $fieldValueArr['UK-FCL-00056_0'], $cont);
		$cont = str_replace('{UK-FCL-00062_0}', $fieldValueArr['UK-FCL-00062_0'], $cont);
		$cont = str_replace('{UK-FCL-00329_0}', $fieldValueArr['UK-FCL-00329_0'], $cont);
		$cont = str_replace('{UK-FCL-00330_0}', $fieldValueArr['UK-FCL-00330_0'], $cont);
		$cont = str_replace('{UK-FCL-00061_0}', $fieldValueArr['UK-FCL-00061_0'], $cont);
		
						
		/* echo $cont;
		 die;  */
		$content = $cont;
		
		$name = "Name_Related_".time().".pdf";	
		Utility2_0c::generateNewCafPdfApp($content,$name,$submission_id,$dept_id);	
		die(); 
	}
	
	public function actionSaveExternalCompanyApprovalCertificate2_0($service_id=null,$subID=null,$dept_id=null,$approved_name=NULL,$reg_no=NULL,$uname=null){
		$service_id = DefaultUtility::dataSenetize($service_id);
		$subID = DefaultUtility::dataSenetize($subID);
		$dept_id = DefaultUtility::dataSenetize($dept_id);
		$approved_name = DefaultUtility::dataSenetize($approved_name);
		$reg_no = DefaultUtility::dataSenetize($reg_no);
		//echo "sdfsdfsdf"; die;
		extract($_GET);
		@session_start();
		$service_id = base64_decode($service_id);
		$submission_id = base64_decode($subID);
		$uname = base64_decode($uname);
		$adddata = array();
		
		$AppPdfArr = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_certificate where service_id=$service_id and form_type='comany_name_related'")->queryRow();
		/* echo "<pre>";
		print_r($AppPdfArr); */				
		$AppArrNew = explode(",",$AppPdfArr['fieldcode']);
		
		extract($AppPdfArr);
		
		$newAppArr = Yii::app()->db->createCommand($querysql.$submission_id)->queryRow();
		$fieldValueArr = (array)json_decode($newAppArr['field_value']);		
		$cont = $AppPdfArr['content'];
				
		if(isset($AppArrNew) && !empty($AppArrNew))
		{	
			foreach($AppArrNew as $v)
			{	
				if($v=='current_date')
				{	
					$cont = str_replace("#current_date#",date('d F, Y',strtotime($newAppArr['application_updated_date_time'])),$cont);
				}
				if($v=='state_name')
				{	
					$state=$fieldValueArr['UK-FCL-00060_0'];
					$stateName = Yii::app()->db->createCommand("SELECT * FROM bo_landregion where lr_id='$state'")->queryRow();
					$cont = str_replace("#state_name#",$stateName['lr_name'],$cont);
				}
				if($v=='country_name')
				{	
					$country=$fieldValueArr['UK-FCL-00059_0'];
					$countryName = Yii::app()->db->createCommand("SELECT * FROM bo_landregion where lr_id='$country'")->queryRow();
					$cont = str_replace("#country_name#",$countryName['lr_name'],$cont);
				}
				if($v=='number')
				{
					$cont = str_replace("#number#",$submission_id,$cont);
				}
				if($v=='week_name')
				{
					$cont = str_replace("#week_name#",date('l',strtotime($newAppArr['application_updated_date_time'])),$cont);
				}
				if($v=='registrar_name')
				{					
					$cont = str_replace("#registrar_name#",$uname,$cont);
				}
			}	
		} 	
		
		$externalData = Yii::app()->db->createCommand("select bo_company_details.created_on,bo_company_details.srn_no,bo_new_application_submission.application_created_date from bo_company_details LEFT JOIN bo_new_application_submission ON bo_new_application_submission.submission_id=bo_company_details.srn_no where reg_no='$reg_no'")->queryRow();
		
		if(isset($externalData['created_on']) && !empty($externalData['created_on']))
		{
			$externalDate = date('l, d F, Y',strtotime($externalData['created_on']));
			$application_created_date = date('l, d F, Y',strtotime($externalData['application_created_date']));
			
		}else{
			$externalDate = date('l, d F, Y',strtotime(date('d-m-Y')));
			$application_created_date = date('l, d F, Y',strtotime(date('d-m-Y')));
		}
		
		$cont = str_replace('{UK-FCL-00019_0}', $fieldValueArr['UK-FCL-00019_0'], $cont);
		$cont = str_replace('#WEEK#',$externalDate, $cont);
		$cont = str_replace('#OLD_APP_RECEIVED_DATE#',$application_created_date, $cont);
		$cont = str_replace('#APPROVED_NAME#', base64_decode(@$approved_name), $cont);
		$cont = str_replace('#APPROVED_DATE#',date('l, d F, Y',strtotime(date('d-m-Y'))), $cont);
		
		$content = $cont;
		
		$name = "Name_Related_".time().".pdf";	
		Utility2_0c::generateNewCafPdfApp($content,$name,$submission_id,$dept_id,'external');	
		die(); 
	}
	
	public function actionSaveRevokeApprovalCertificate2_0($service_id=null,$subID=null,$dept_id=null,$companynewname=NULL,$company_no=NULL,$uname=null){
		
		$service_id = DefaultUtility::dataSenetize($service_id);
		$subID = DefaultUtility::dataSenetize($subID);
		$dept_id = DefaultUtility::dataSenetize($dept_id);
		$companynewname = DefaultUtility::dataSenetize($companynewname);
		//echo "sdfsdfsdf"; die;
		extract($_GET);
		@session_start();
		$service_id = base64_decode($service_id);
		$submission_id = base64_decode($subID);
		$uname = base64_decode($uname);
		
		$adddata = array();
		
		$AppPdfArr = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_certificate where service_id=$service_id and form_type='revoke_name_related'")->queryRow();
		/* echo "<pre>";
		print_r($AppPdfArr); */				
		$AppArrNew = explode(",",$AppPdfArr['fieldcode']);
		
		extract($AppPdfArr);
		
		$newAppArr = Yii::app()->db->createCommand($querysql.$submission_id)->queryRow();

			
		$fieldValueArr = (array)json_decode($newAppArr['field_value']);		
		$cont = $AppPdfArr['content'];
				
		if(isset($AppArrNew) && !empty($AppArrNew))
		{	
			foreach($AppArrNew as $v)
			{	
				if($v=='current_date')
				{	
					$cont = str_replace("#current_date#",date('d F, Y',strtotime($newAppArr['application_updated_date_time'])),$cont);
				}
				if($v=='company_new_name')
				{	
					$cont = str_replace("#company_new_name#",$companynewname,$cont);
				}
				if($v=='company_no')
				{	
					$cont = str_replace("#company_no#",$company_no,$cont);
				}
				if($v=='registrar')
				{	
					$cont = str_replace("#registrar#",$uname,$cont);
				}
			}	
		} 		
		
						
		 /* echo $cont;
		 die;   */
		$content = $cont;
		
		$name = "Name_Related_".time().".pdf";	
		Utility2_0c::generateNewCafPdfApp($content,$name,$submission_id,$dept_id,'revoke');	
		die(); 
	}

/* This action is make by aamir for certificate PDF format form 3
* this format use in incorporation of company and NCP service id (4.0, 5.0)
*/
	public function actionSaveNewApprovalCertificate4_0($service_id=null,$subID=null,$dept_id=null,$utility=NULL){
		$service_id = DefaultUtility::dataSenetize($service_id);
		$subID = DefaultUtility::dataSenetize($subID);
		$dept_id = DefaultUtility::dataSenetize($dept_id);
		$utility = DefaultUtility::dataSenetize($utility);
		//echo "sdfsdfsdf"; die;
		extract($_GET);
		@session_start();
		$service_id = base64_decode($service_id);
		$submission_id = base64_decode($subID);
		/*$service_id = ($service_id);
		$submission_id = ($subID);*/
		$adddata = array();
		/* print_r($_GET);
		die; */
		
		$AppPdfArr = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_certificate where service_id=$service_id")->queryRow();
		$fetchcompanydetails = Yii::app()->db->createCommand("SELECT * FROM bo_company_details WHERE srn_no=$submission_id AND service_id='".$service_id."'")->queryRow();
		$reg_no = $fetchcompanydetails['reg_no'];
		$company_name = $fetchcompanydetails['company_name'];
		$created_on = $fetchcompanydetails['created_on'];
		$user_profile = Yii::app()->db->createCommand("SELECT * FROM bo_user where uid=".$fetchcompanydetails['approved_by'])->queryRow();
		$content = str_replace('{reg_no}', $reg_no, $AppPdfArr['content']);
		$content = str_replace('{company_name}', $company_name, $content);

		//$content = str_replace('{user_id}', ($user_profile['full_name'].' '.$user_profile['middle_name'].' '.$user_profile['last_name']), $content);

		$content = str_replace('{user_id}', "TAMIESHA ROCHESTER", $content);

		$content = str_replace('{created_on}', date('d F, Y',strtotime($created_on)), $content);

		/*echo $content;
		die();*/
		
		$name = "Project_Approval_".time().".pdf";	
		if($utility){
			$utility::generateNewCafPdfApp($content,$name,$submission_id,$dept_id);
		}	else{
			Utility2_0::generateNewCafPdfApp($content,$name,1);
		}	
		die(); 
	}




	public function actionSaveNewApprovalCertificate5_0($service_id=null,$subID=null,$dept_id=null,$utility=NULL){
		
		//echo "sdfsdfsdf"; die;
		extract($_GET);
		@session_start();
		$service_id = base64_decode($service_id);
		$submission_id = base64_decode($subID);
		/*$service_id = ($service_id);
		$submission_id = ($subID);*/
		$adddata = array();
		/* print_r($_GET);
		die; */
		
		$AppPdfArr = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_certificate where service_id=$service_id")->queryRow();
		$fetchcompanydetails = Yii::app()->db->createCommand("SELECT * FROM bo_company_details WHERE srn_no=$submission_id AND service_id='".$service_id."'")->queryRow();
		$reg_no = $fetchcompanydetails['reg_no'];
		$company_name = $fetchcompanydetails['company_name'];
		$created_on = $fetchcompanydetails['created_on'];
		$user_profile = Yii::app()->db->createCommand("SELECT * FROM bo_user where uid=".$fetchcompanydetails['approved_by'])->queryRow();
		$content = str_replace('{reg_no}', $reg_no, $AppPdfArr['content']);
		$content = str_replace('{company_name}', $company_name, $content);

		/*$content = str_replace('{user_id}', ($user_profile['full_name'].' '.$user_profile['middle_name'].' '.$user_profile['last_name']), $content);*/
		$content = str_replace('{user_id}', "TAMIESHA ROCHESTER", $content);

		$content = str_replace('{created_on}', date('d F, Y',strtotime($created_on)), $content);

		/*echo $content;
		die();*/
		
		$name = "Project_Approval_".time().".pdf";	
		if($utility){
			$utility::generateNewCafPdfApp($content,$name,$submission_id,$dept_id);
		}	else{
			Utility2_0::generateNewCafPdfApp($content,$name,1);
		}	
		die(); 
	}

	public function actionSaveNewApprovalCertificate6_0($service_id=null,$subID=null,$dept_id=null,$utility=NULL){
		$service_id = DefaultUtility::dataSenetize($service_id);
		$subID = DefaultUtility::dataSenetize($subID);
		$dept_id = DefaultUtility::dataSenetize($dept_id);
		$utility = DefaultUtility::dataSenetize($utility);
		//echo "sdfsdfsdf"; die;
		extract($_GET);
		@session_start();
		$service_id = base64_decode($service_id);
		$submission_id = base64_decode($subID);
		/*$service_id = ($service_id);
		$submission_id = ($subID);*/
		$adddata = array();
		/* print_r($_GET);
		die; */
		
		$AppPdfArr = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_certificate where service_id=$service_id AND form_type='certificate'")->queryRow();

		$fetchcompanydetails = Yii::app()->db->createCommand("SELECT * FROM bo_company_details WHERE srn_no=$submission_id AND service_id='".$service_id."'")->queryRow();

		$reg_no = $fetchcompanydetails['reg_no'];
		$company_name = $fetchcompanydetails['company_name'];
		$created_on = $fetchcompanydetails['created_on'];

		$user_profile = Yii::app()->db->createCommand("SELECT * FROM bo_user where uid=".$fetchcompanydetails['approved_by'])->queryRow();

		 $fetchsrnRecords = Yii::app()->db->createCommand("SELECT  application_created_date FROM bo_new_application_submission where submission_id=$submission_id")->queryRow();

		$content = str_replace('{reg_no}', $reg_no, $AppPdfArr['content']);
		$content = str_replace('{company_name}', $company_name, $content);
		/*$content = str_replace('{user_id}', ($user_profile['full_name'].' '.$user_profile['middle_name'].' '.$user_profile['last_name']), $content);*/
		$content = str_replace('{user_id}', "TAMIESHA ROCHESTER", $content);
		$content = str_replace('{app_date}', date('l d F, Y',strtotime($fetchsrnRecords['application_created_date'])), $content);
		$content = str_replace('{created_on}', date('l d F, Y',strtotime($created_on)), $content);

		/*echo $content;
		die();*/

			$AppPdfArr_letter = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_certificate where service_id=$service_id AND form_type='letter'")->queryRow();
			$content_letter = str_replace('{reg_no}', $reg_no, $AppPdfArr_letter['content']);
			$content_letter = str_replace('{company_name}', $company_name, $content_letter);
			$content_letter = str_replace('{created_on}', date('F d, Y',strtotime($created_on)), $content_letter);

			/*$content_letter = str_replace('{user_id}', ($user_profile['full_name'].' '.$user_profile['middle_name'].' '.$user_profile['last_name']), $content_letter);*/
				$content_letter = str_replace('{user_id}', "TAMIESHA ROCHESTER", $content_letter);
		
		$name = "Project_Approval_".time().".pdf";	
		if($utility){
			$utility::generateNewCafPdfApp($content,$name,$submission_id,$dept_id,$content_letter);
		}	else{
			Utility2_0::generateNewCafPdfApp($content,$name,1);
		}	
		die(); 
	}

public function actionSaveNewApprovalCertificate7_0($service_id=null,$subID=null,$dept_id=null,$utility=NULL){
		$service_id = DefaultUtility::dataSenetize($service_id);
		$subID = DefaultUtility::dataSenetize($subID);
		$dept_id = DefaultUtility::dataSenetize($dept_id);
		$utility = DefaultUtility::dataSenetize($utility);
		//echo "sdfsdfsdf"; die;
		extract($_GET);
		@session_start();
		$service_id = base64_decode($service_id);
		$submission_id = base64_decode($subID);
		/*$service_id = ($service_id);
		$submission_id = ($subID);*/
		$adddata = array();
		/* print_r($_GET);
		die; */
		
		$AppPdfArr = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_certificate where service_id=$service_id")->queryRow();
		
		/* $enity_detail = Yii::app()->db->createCommand("SELECT * FROM bo_banned_words where app_id=$submission_id")->queryRow();*/

		  $fetchsrnRecords = Yii::app()->db->createCommand("SELECT  service_id,submission_id,user_id,field_value,application_updated_date_time,application_created_date FROM bo_new_application_submission where submission_id=$submission_id")->queryRow();

		  $farr = (array) json_decode($fetchsrnRecords['field_value']);
		  $c_no = $farr['UK-FCL-00307_0'];
		  $c_name = $farr['UK-FCL-00187_0'];

		  $findc = Yii::app()->db->createCommand("SELECT * FROM bo_company_details WHERE reg_no='".$c_no."'")->queryRow();
		  if($findc){
		  	 $c_date = $findc['created_on'];
		  }else{
		  	 $c_date = '';
		  }
		 

$fetchcompanydetails = Yii::app()->db->createCommand("SELECT * FROM bo_company_details WHERE srn_no=$submission_id AND service_id='".$service_id."'")->queryRow();

		$reg_no = $fetchcompanydetails['reg_no'];
		$company_name = $fetchcompanydetails['company_name'];
		$created_on = $fetchcompanydetails['created_on'];
		$user_profile = Yii::app()->db->createCommand("SELECT * FROM bo_user where uid=".$fetchcompanydetails['approved_by'])->queryRow();




		/*$reg_no = 'NA';
		$company_name = $enity_detail['banned_words_name'];
		$created_on = $enity_detail['created'];
		$user_profile = Yii::app()->db->createCommand("SELECT * FROM sso_profiles where user_id=".$fetchsrnRecords['user_id'])->queryRow();*/

		$content = str_replace('{reg_no}', $reg_no, $AppPdfArr['content']);
		$content = str_replace('{c_no}', $c_no, $content);
		$content = str_replace('{c_name}', $c_name, $content);

		if($c_date){
				$content = str_replace('{c_word}', 'on ', $content);
		}else{
			$content = str_replace('{c_word}', '', $content);
		}
		$content = str_replace('{c_date}', ($c_date ? date('l d F, Y',strtotime($c_date)) : ''), $content);

		$content = str_replace('{company_name}', $company_name, $content);
		/*$content = str_replace('{user_id}', ($user_profile['full_name'].' '.$user_profile['middle_name'].' '.$user_profile['last_name']), $content);*/
			$content = str_replace('{user_id}', "TAMIESHA ROCHESTER", $content);
		$content = str_replace('{app_date}', date('l d F, Y',strtotime($fetchsrnRecords['application_created_date'])), $content);
		$content = str_replace('{created_on}', date('l, d F, Y',strtotime($created_on)), $content);

		/*echo $content;
		die();*/
		
		$name = "Project_Approval_".time().".pdf";	

			$utility::generateNewCafPdfApp($content,$name,$submission_id,$dept_id);
			
		die(); 
	}
	

	/* This action is make by aamir for certificate PDF format form 3
* this format use in incorporation of company and NCP service id (4.0, 5.0)
*/
	public function actionSaveNewApprovalCertificate8_0($service_id=null,$subID=null,$dept_id=null,$utility=NULL){
		$service_id = DefaultUtility::dataSenetize($service_id);
		$subID = DefaultUtility::dataSenetize($subID);
		$dept_id = DefaultUtility::dataSenetize($dept_id);
		$utility = DefaultUtility::dataSenetize($utility);
		//echo "sdfsdfsdf"; die;
		extract($_GET);
		@session_start();
		$service_id = base64_decode($service_id);
		$submission_id = base64_decode($subID);
		/*$service_id = ($service_id);
		$submission_id = ($subID);*/
		$adddata = array();
		/* print_r($_GET);
		die; */
		
		$AppPdfArr = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_certificate where service_id=$service_id")->queryRow();
		$fetchcompanydetails = Yii::app()->db->createCommand("SELECT * FROM bo_company_details WHERE srn_no=$submission_id AND service_id='".$service_id."'")->queryRow();
		$reg_no = $fetchcompanydetails['reg_no'];
		$company_name = $fetchcompanydetails['company_name'];
		$created_on = $fetchcompanydetails['created_on'];
		$user_profile = Yii::app()->db->createCommand("SELECT * FROM bo_user where uid=".$fetchcompanydetails['approved_by'])->queryRow();
		$content = str_replace('{reg_no}', $reg_no, $AppPdfArr['content']);
		$content = str_replace('{company_name}', $company_name, $content);
		/*$content = str_replace('{user_id}', ($user_profile['full_name'].' '.$user_profile['middle_name'].' '.$user_profile['last_name']), $content);*/
			$content = str_replace('{user_id}', "TAMIESHA ROCHESTER", $content);
		$content = str_replace('{created_on}', date('d F, Y',strtotime($created_on)), $content);

		/*echo $content;
		die();*/
		
		$name = "Project_Approval_".time().".pdf";	
		if($utility){
			$utility::generateNewCafPdfApp($content,$name,$submission_id,$dept_id);
		}	else{
			Utility2_0::generateNewCafPdfApp($content,$name,1);
		}	
		die(); 
	}

	public function actionSaveNewApprovalCertificate9_0($service_id=null,$subID=null,$dept_id=null,$utility=NULL){
		$service_id = DefaultUtility::dataSenetize($service_id);
		$subID = DefaultUtility::dataSenetize($subID);
		$dept_id = DefaultUtility::dataSenetize($dept_id);
		$utility = DefaultUtility::dataSenetize($utility);
		//echo "sdfsdfsdf"; die;
		extract($_GET);
		@session_start();
		$service_id = base64_decode($service_id);
		$submission_id = base64_decode($subID);
		/*$service_id = ($service_id);
		$submission_id = ($subID);*/
		$adddata = array();
		/* print_r($_GET);
		die; */
		
		$AppPdfArr = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_certificate where service_id=$service_id")->queryRow();
		$fetchcompanydetails = Yii::app()->db->createCommand("SELECT * FROM bo_company_details WHERE srn_no=$submission_id AND service_id='".$service_id."'")->queryRow();
		$reg_no = $fetchcompanydetails['reg_no'];
		$company_name = $fetchcompanydetails['company_name'];
		$created_on = $fetchcompanydetails['created_on'];

		$user_profile = Yii::app()->db->createCommand("SELECT * FROM bo_user where uid=".$fetchcompanydetails['approved_by'])->queryRow();

		$content = str_replace('{reg_no}', $reg_no, $AppPdfArr['content']);
		$content = str_replace('{company_name}', $company_name, $content);
		/*$content = str_replace('{user_id}', ($user_profile['full_name'].' '.$user_profile['middle_name'].' '.$user_profile['last_name']), $content);*/
		$content = str_replace('{user_id}', "TAMIESHA ROCHESTER", $content);

		$content = str_replace('{created_on}', date('d M, Y',strtotime($created_on)), $content);

		/*echo $content;
		die();*/
		
		$name = "Project_Approval_".time().".pdf";	
		if($utility){
			$utility::generateNewCafPdfApp($content,$name,$submission_id,$dept_id);
		}	else{
			Utility2_0::generateNewCafPdfApp($content,$name,1);
		}	
		die(); 
	}


	public function actionSaveNewApprovalCertificate10_0($service_id=null,$subID=null,$dept_id=null,$utility=NULL){
		$service_id = DefaultUtility::dataSenetize($service_id);
		$subID = DefaultUtility::dataSenetize($subID);
		$dept_id = DefaultUtility::dataSenetize($dept_id);
		$utility = DefaultUtility::dataSenetize($utility);
		//echo "sdfsdfsdf"; die;
		extract($_GET);
		@session_start();
		$service_id = base64_decode($service_id);
		$submission_id = base64_decode($subID);
		/*$service_id = ($service_id);
		$submission_id = ($subID);*/
		$adddata = array();
		/* print_r($_GET);
		die; */
		
		$AppPdfArr = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_certificate where service_id=$service_id")->queryRow();
		$fetchcompanydetails = Yii::app()->db->createCommand("SELECT * FROM bo_company_details WHERE srn_no=$submission_id AND service_id='".$service_id."'")->queryRow();

		  $fetchsrnRecords = Yii::app()->db->createCommand("SELECT  service_id,submission_id,user_id,field_value,application_updated_date_time,application_created_date FROM bo_new_application_submission where submission_id=$submission_id")->queryRow();

		$reg_no = $fetchcompanydetails['reg_no'];
		$company_name = $fetchcompanydetails['company_name'];
		$created_on = $fetchcompanydetails['created_on'];

		$user_profile = Yii::app()->db->createCommand("SELECT * FROM bo_user where uid=".$fetchcompanydetails['approved_by'])->queryRow();

		$content = str_replace('{reg_no}', $reg_no, $AppPdfArr['content']);
		$content = str_replace('{company_name}', $company_name, $content);
		/*$content = str_replace('{user_id}', ($user_profile['full_name'].' '.$user_profile['middle_name'].' '.$user_profile['last_name']), $content);*/

		$content = str_replace('{user_id}', "TAMIESHA ROCHESTER", $content);
		$content = str_replace('{app_date}', date('l, d F, Y',strtotime($fetchsrnRecords['application_created_date'])), $content);
		$content = str_replace('{created_on}', date('l, d F, Y',strtotime($created_on)), $content);

		/*echo $content;
		die();*/
		
		$name = "Project_Approval_".time().".pdf";	
		if($utility){
			$utility::generateNewCafPdfApp($content,$name,$submission_id,$dept_id);
		}	else{
			Utility2_0::generateNewCafPdfApp($content,$name,1);
		}	
		die(); 
	}
	
	
	public function actionSaveLegalMetrologyCertificate($service_id=null,$subID=null,$dept_id=null,$licenceN=null){
		$service_id = DefaultUtility::dataSenetize($service_id);
		$subID = DefaultUtility::dataSenetize($subID);
		$dept_id = DefaultUtility::dataSenetize($dept_id);
		$licenceN = DefaultUtility::dataSenetize($licenceN);
		//echo "sdfsdfsdf"; die;
		extract($_GET);
		@session_start();
		$service_id = base64_decode($service_id);
		$submission_id = base64_decode($subID);
		$adddata = array();
		$adddata = $this->getAddMoreData($service_id,$submission_id);
		/* echo "<pre>";
		print_r($adddata); die;  */
		$AppPdfArr = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_certificate where service_id='$service_id'")->queryRow();
		
		$AppArrNew = explode(",",$AppPdfArr['fieldcode']);
		
		extract($AppPdfArr);
		/* echo "<pre>";
		print_r($AppPdfArr);  */
		$newAppArr  = array();
	
			//echo $querysql.$submission_id;die;
		$newAppArr = Yii::app()->db->createCommand($querysql.$submission_id)->queryRow();
		
		$AppPdfcontent = array();		
		$contAddMore = '';
		preg_match_all('/<!--ADDMORE-->(.*?)<!--ADDMORE-->/si', $AppPdfArr['content'], $matchesadd_more); 
	/* 	echo "<pre>";
		print_r($matchesadd_more); */
		if(isset($matchesadd_more[0][0]) && !empty($matchesadd_more[0][0]))
		{	
			preg_match_all("/\#(.*?)\#/",$matchesadd_more[0][0], $matchesadd);
			
			$i=1;	
			$html="";
			$new = $matchesadd_more[0][0];
			if(!empty($adddata))
			{
				foreach($adddata as $key=>$val)
				{		
					$matchesadd_more[0][0]	= str_replace("#key#",$i,$matchesadd_more[0][0]);
					foreach($val as $k=>$v)
					{			//echo $v;
						$matchesadd_morenew	= str_replace("#".$k."#",$v,$matchesadd_more[0][0]);
						$matchesadd_more[0][0] = $matchesadd_morenew;	
					}	
					$html = $html." ".$matchesadd_morenew ;
					$i++;	$matchesadd_more[0][0]=$new;
				}
				//print_r($html);die;
				$AppPdfArr['content'] = preg_replace('/<!--ADDMORE-->(.*?)<!--ADDMORE-->/si',$html, $AppPdfArr['content']);
			}	
		}
	
		preg_match_all("/\{(.*?)\}/",$AppPdfArr['content'], $matches);
		
				
		$fieldValueArr = (array)json_decode($newAppArr['field_value']);	
		
		$cont = $AppPdfArr['content'];
		/* echo "<pre>";
		print_r($newAppArr);die; */
		foreach($AppArrNew as $v)
		{	
			if($v=='licence_number')
			{		
				/* $servId = explode(".",$newAppArr['service_id']);
				$ltype = "";
				if($servId[0]=='119'){
					$ltype="LR";	
				}elseif($servId[0]=='226'){
					$ltype="LM";	
				}elseif($servId[0]=='227'){
					$ltype="LD";	
				}elseif($servId[0]=='228'){
					$ltype="LR";	
				}	
				$iuid = mt_rand(10000000, 99999999);
				$licenceN = $ltype.'/'.$iuid.$newAppArr['user_id'].'/'.$newAppArr['circle_name'].'/'.date('Y'); */
				$cont = str_replace("#licence_number#",$licenceN,$cont);
			}
			if($v=='registration_number')
			{		
				$iuid = mt_rand(10000000, 99999999);
				$registerN = 'REG/'.$iuid.$newAppArr['user_id'].'/'.$newAppArr['circle_name'].'/'.date('Y');
				$cont = str_replace("#registration_number#",$registerN,$cont);
			}			
			if($v=='year')
			{					
				$cont = str_replace("#year#",date('Y'),$cont);
			}	
			if($v=='current_date')
			{					
				$cont = str_replace("#current_date#",date('d-m-Y', strtotime('Dec 31')),$cont);
			}	
			
			if(isset($newAppArr[$v]) && !empty($newAppArr[$v])){	
				if($v=='updated_on')
				{	
					$cont = str_replace("#updated_on#",date('d-m-Y',strtotime($newAppArr[$v])),$cont);
				}
				$cont = str_replace("#".$v."#",$newAppArr[$v],$cont);	
			}	
		}			
		
		if(isset($matches[1]) && !empty($matches[1]))
		{	
			foreach($matches[1] as $key=>$val)
			{	
				if($val!='CURR_DATE' && $val!='SHOW_MULTIPLE')
				{		
					if(isset($fieldValueArr[$val]) && !empty($fieldValueArr[$val])){	
						$masterValues = InfowizardQuestionMasterExt::getFieldValueFormBuilder_LM("$val",$fieldValueArr[$val],$service_id);		
						
						if(isset($masterValues) && !empty($masterValues)){
							$cont = str_replace("{".$val."}",$masterValues,$cont);	
						}
					}else{
						$cont = str_replace("{".$val."}","",$cont);
					}	
				}	
			}
		}		
		$content = $cont;
		//die;
		$name = "Legal_metrology_".time().".pdf";		
	
		UtilityFilm::generateLMCertPdfApp($content,$name,21);//,$newAppArr
	
		die();
	}
	
	public function actionSaveFilmCertificate($service_id=null,$subID=null,$dept_id=null)
	{		
		$service_id = DefaultUtility::dataSenetize($service_id);
		$subID = DefaultUtility::dataSenetize($subID);
		$dept_id = DefaultUtility::dataSenetize($dept_id);
		extract($_GET);
		@session_start();
		$service_id = base64_decode($service_id);
		$submission_id = base64_decode($subID);
		$adddata = array();
		$adddata = $this->getAddMoreData($service_id,$submission_id);
		/* echo "<pre>";
		print_r($adddata); die;  */
		$AppPdfArr = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_certificate where service_id='$service_id'")->queryRow();
		
		$AppArrNew = explode(",",$AppPdfArr['fieldcode']);
		
		extract($AppPdfArr);
		 
		
		$newAppArr = Yii::app()->db->createCommand($querysql.$submission_id)->queryRow();
		
		$AppPdfcontent = array();		
		$contAddMore = '';
		preg_match_all('/<!--ADDMORE-->(.*?)<!--ADDMORE-->/si', $AppPdfArr['content'], $matchesadd_more); 
	/* 	echo "<pre>";
		print_r($matchesadd_more); */
		if(isset($matchesadd_more[0][0]) && !empty($matchesadd_more[0][0]))
		{	
			preg_match_all("/\#(.*?)\#/",$matchesadd_more[0][0], $matchesadd);
			
			$i=1;	
			$html="";
			$new = $matchesadd_more[0][0];
			if(!empty($adddata))
			{
				foreach($adddata as $key=>$val)
				{		
					$matchesadd_more[0][0]	= str_replace("#key#",$i,$matchesadd_more[0][0]);
					foreach($val as $k=>$v)
					{			//echo $v;
						$matchesadd_morenew	= str_replace("#".$k."#",$v,$matchesadd_more[0][0]);
						$matchesadd_more[0][0] = $matchesadd_morenew;	
					}	
					$html = $html." ".$matchesadd_morenew ;
					$i++;	$matchesadd_more[0][0]=$new;
				}
				//print_r($html);die;
				$AppPdfArr['content'] = preg_replace('/<!--ADDMORE-->(.*?)<!--ADDMORE-->/si',$html, $AppPdfArr['content']);
			}	
		}
	
		preg_match_all("/\{(.*?)\}/",$AppPdfArr['content'], $matches);
				
		$fieldValueArr = (array)json_decode($newAppArr['field_value']);		
		$cont = $AppPdfArr['content'];
		/* echo "<pre>";
		print_r($newAppArr);die; */
		foreach($AppArrNew as $v)
		{	
			if($v=='licence_number')
			{					
				$cont = str_replace("#licence_number#",'1',$cont);
			}
			if($v=='year')
			{					
				$cont = str_replace("#year#",date('Y'),$cont);
			}	
			if($v=='current_date')
			{					
				$cont = str_replace("#current_date#",date('d-m-Y'),$cont);
			}	
			
			if(isset($newAppArr[$v]) && !empty($newAppArr[$v])){	
				if($v=='updated_on')
				{	
					$cont = str_replace("#updated_on#",date('d-m-Y',strtotime($newAppArr[$v])),$cont);
				}
				$cont = str_replace("#".$v."#",$newAppArr[$v],$cont);	
			}	
		}	
		
		 /* echo $cont;
		die;  */ 
		setlocale(LC_TIME, "hi_IN");
		$month_name = strftime("%d, %B %Y"); 		
		$cont = str_replace("{CURR_DATE}",$month_name,$cont);
		
		//echo "<pre>";
		//print_r($fieldValueArr);
		//print_r($matches);
		//die;
		if(isset($matches[1]) && !empty($matches[1]))
		{	
			foreach($matches[1] as $key=>$val)
			{	
				if($val!='CURR_DATE' && $val!='SHOW_MULTIPLE')
				{		
					if(isset($fieldValueArr[$val]) && !empty($fieldValueArr[$val])){	
						$masterValues = InfowizardQuestionMasterExt::getFieldValueFormBuilder("$val",$fieldValueArr[$val],$service_id);		
						
						if(isset($masterValues) && !empty($masterValues)){
							$cont = str_replace("{".$val."}",$masterValues,$cont);	
						}
					}else{
						$cont = str_replace("{".$val."}","",$cont);
					}	
				}	
			}
		}		
		$content = $cont;
		
		$name = "film_shooting_".time().".pdf";		
	
		UtilityFilm::generateNewCafPdfApp($content,$name,54);//,$newAppArr
	
		die();
	}
	
}
