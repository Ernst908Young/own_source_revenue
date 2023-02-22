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
		$service_id = $_GET['service_id'];
		$submission_id = $_GET['subID'];
		
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
		UtilityFilm::generateHindiPdfApp($content,$name,$_GET['dept_id']);
		die();
	}
	
	
	public function getAddMoreData($service_id,$submission_id)
	{
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
	public function actionSaveNewApprovalCertificate($service_id=null,$subID=null,$dept_id=null){

		//echo $service_id; die;
		extract($_GET);
		@session_start();
		$service_id = base64_decode($service_id);
		$submission_id = base64_decode($subID);
		/*$service_id = $service_id;
		$submission_id = $subID;*/
		$adddata = array();
		/* print_r($_GET);
		die; */
		
		$AppPdfArr = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_certificate where service_id=$service_id")->queryRow();
		/* echo "<pre>";
		print_r($AppPdfArr); */				
		$AppArrNew = explode(",",$AppPdfArr['fieldcode']);
		
		extract($AppPdfArr);
		
		$newAppArr = Yii::app()->db->createCommand($querysql.$submission_id)->queryRow();
		
		$AppPdfcontent = array();		
		$contAddMore = '';
		preg_match_all('/<!--ADDMORE-->(.*?)<!--ADDMORE-->/si', $AppPdfArr['content'], $matchesadd_more); 
		
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
					{			
						$matchesadd_morenew	= str_replace("#".$k."#",$v,$matchesadd_more[0][0]);
						$matchesadd_more[0][0] = $matchesadd_morenew;	
					}	
					$html = $html." ".$matchesadd_morenew ;
					$i++;	$matchesadd_more[0][0]=$new;
				}
				
				$AppPdfArr['content'] = preg_replace('/<!--ADDMORE-->(.*?)<!--ADDMORE-->/si',$html, $AppPdfArr['content']);
			}	
		}
	
		preg_match_all("/\{(.*?)\}/",$AppPdfArr['content'], $matches);
				
		$fieldValueArr = (array)json_decode($newAppArr['field_value']);		
		$cont = $AppPdfArr['content'];
				
		if(isset($AppArrNew) && !empty($AppArrNew))
		{	
			foreach($AppArrNew as $v)
			{	
				if($v=='current_date')
				{					
			
					$cont = str_replace("#current_date#",date("d/m/Y",strtotime($newAppArr['application_updated_date_time'])),$cont);
				}
				if(isset($newAppArr[$v])){
						
					if($newAppArr[$v]=='Present_Nationality')
					{					
						$cont = str_replace("#Present_Nationality#",'District Industries Center',$cont);
					}				
					$cont = str_replace("#".$v."#",$newAppArr[$v],$cont);
				}
			}	
		} 
		setlocale(LC_TIME, "hi_IN");
		$month_name = strftime("%d, %B %Y"); 		
		$cont = str_replace("{CURR_DATE}",$month_name,$cont);
		 // echo "<pre>";
		// print_r($matches[1]);
		// print_r($fieldValueArr);
		
		if(isset($matches[1]) && !empty($matches[1]))
		{	
			foreach($matches[1] as $key=>$val)
			{				
				
				if($val!='Present_Nationality')
				{	
					if(isset($fieldValueArr[$val][0]) && !empty($fieldValueArr[$val][0])){	
						//print_r($fieldValueArr[$val]);
						$masterValues = InfowizardQuestionMasterExt::getFieldValueFormBuilder_LM("$val",$fieldValueArr[$val][0],'616.0');
						
						if(isset($masterValues) && !empty($masterValues) && is_array($fieldValueArr[$val])){						
							$cont = str_replace("{".$val."}",$masterValues,$cont);	
						}else{
							$cont = str_replace("{".$val."}",$fieldValueArr[$val],$cont);	
						}	
						
						
					}else if(isset($fieldValueArr[$val]) && !empty($fieldValueArr[$val])){
						//echo $fieldValueArr[$val];
						$masterValues = InfowizardQuestionMasterExt::getFieldValueFormBuilder_LM("$val",$fieldValueArr[$val],'616.0');	
						//echo $masterValues;
						if(isset($masterValues) && !empty($masterValues)){
							//echo $masterValues;die;
							$cont = str_replace("{".$val."}",$masterValues,$cont);							
						}						
					}else{
						$cont = str_replace("{".$val."}","",$cont);
					}		
				}	
				
			}
		}		
		 /* echo $cont;
		 die;  */
		/* echo $content = $cont;
		die; */
		
		$name = "Project_Approval_".time().".pdf";	
		$searr = explode(".",$service_id);	
		$incorpartion_service = ['4.0','7.0','8.0'];

		if(in_array($service_id, $incorpartion_service)){
			Utility2_0::generateNewCafPdfApp($content,$name,$submission_id,1);
		}else{
			Utility2_0::generateNewCafPdfApp($content,$name,$submission_id,1);
		}
		
		
		die(); 
	}
	
	
	public function actionSaveLegalMetrologyCertificate($service_id=null,$subID=null,$dept_id=null,$licenceN=null){
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
