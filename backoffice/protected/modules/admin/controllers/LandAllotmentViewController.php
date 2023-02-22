<?php

class LandAllotmentViewController extends Controller{

	
	private function GetUserDetail(){
		@session_start();
		return $_SESSION;
		// echo "<pre>"; print_r();die;
		exit;
	}

	public function actionApplicationDetailDateWise(){
		$userDetail = $this->GetUserDetail();
		$user  = UserExt::getUserDistDept($userDetail['uid']);
		$Apps=array();
		$connection=Yii::app()->db;
		$sql="SELECT * FROM bo_application_submission WHERE application_id=8 AND application_status!='I' AND landrigion_id=$user[disctrict_id]";
		$command=$connection->createCommand($sql);
		$Apps=$command->queryAll();
		$this->render('index',array("Apps"=>$Apps));
	}

	public function actionApplicationDetailRankWise(){
		$userDetail = $this->GetUserDetail();
		$user  = UserExt::getUserDistDept($userDetail['uid']);
		$Apps=array();
		$connection=Yii::app()->db;
		$sql="SELECT * FROM bo_application_submission WHERE application_id=8 AND application_status='A' AND landrigion_id=$user[disctrict_id]";
		$command=$connection->createCommand($sql);
		$Apps=$command->queryAll();
		$this->render('rankWise',array("Apps"=>$Apps));
	}

	protected function getEvaluationMarks($key,$option){
	      $totalMarks=0;
	      
	      if($key == "edu_cert_qual"){
	        if($option == "intermediate")
	          $totalMarks=+3;    
	        elseif($option == "graduation")
	          $totalMarks=+4;    
	        elseif($option == "post_grad_or_above")
	          $totalMarks=+5;    
	      }
	      elseif($key == "edu_tech_qual"){
	        if($option == "none")
	          $totalMarks=+2;    
	        elseif($option == "iti")
	          $totalMarks=+3;    
	        elseif($option == "diploma")
	          $totalMarks=+4;
	        elseif($option == "BE_BTech_MCA_MBA_CA")
	          $totalMarks=+5;
	      }
	      elseif($key == "cert_prof_exp"){
	        if($option == "non_similar")
	          $totalMarks=+5;    
	        elseif($option == "similar")
	          $totalMarks=+10;    
	        elseif($option == "none")
	          $totalMarks=+0;    
	      }
	      elseif($key == "cert_equity"){
	      	if($option == "less_then_19")
				$totalMarks=+2;
			elseif($option == "greater_then_12_less_then_29_99")
				$totalMarks=+6;
			elseif($option == "greater_then_30_less_then_39_99")
				$totalMarks=+8;
			elseif($option == "greater_then_40")
				$totalMarks=+10;
	      }
	      elseif($key == "cert_unit_approv_sanct"){
	        if($option == "Yes")
	          $totalMarks=+5;    
	        elseif($option == "none")
	          $totalMarks=+0;    
	      }
	      elseif($key == "cert_project_cost"){
	        if($option == "1cr")
	          $totalMarks=+10;    
	        elseif($option == "50lcs")
	          $totalMarks=+7;    
	        elseif($option == "25lcs")
	          $totalMarks=+5;
	        elseif($option == "below25lcs")
	          $totalMarks=+3;    
	      }
	      elseif($key == "cert_debt_cover_ratio"){
	        if($option == "not_applicable")
	          $totalMarks=+5;    
	        elseif($option == "1.70-2.00")
	          $totalMarks=+4;    
	        elseif($option == "1.50-1.75")
	          $totalMarks=+3;    
	        elseif($option == "1.25-1.50")
	          $totalMarks=+2;    
	        elseif($option == "1.00-1.25")
	          $totalMarks=+1;    
	      }
	      elseif($key == "cert_poll_cat"){
	        if($option == "white")
	          $totalMarks=+5;    
	        elseif($option == "green")
	          $totalMarks=+4;    
	        elseif($option == "orange")
	          $totalMarks=+3;    
	        elseif($option == "red")
	          $totalMarks=+2;    
	      }
	      elseif($key == "cert_adpt_water_system"){
	        if($option == "yes")
	          $totalMarks=+5;    
	        elseif($option == "none")
	          $totalMarks=+0;    
	      }
	      elseif($key == "cert_usage_local_materail"){
	        if($option == "30%")
	          $totalMarks=+2;    
	        elseif($option == "10%")
	          $totalMarks=+1;    
	        elseif($option == "none")
	          $totalMarks=+0;    
	      }
	      elseif($key == "cert_regist_startup"){
	        if($option == "yes")
	          $totalMarks=+10;    
	        elseif($option == "none")
	          $totalMarks=+0;    
	      }
	      elseif($key == "cert_land_acquistion"){
	        if($option == "acquired")
	          $totalMarks=+10;    
	        elseif($option == "none")
	          $totalMarks=+0;    
	      }
	      elseif($key == "cert_enterprenure_type"){
	        if($option == "women")
	          $totalMarks=+5;    
	        elseif($option == "army_fighter")
	          $totalMarks=+5;    
	        elseif($option == "none")
	          $totalMarks=+0;    
	      }
	      elseif($key == "cert_unit_type"){
	        if($option == "vender")
	          $totalMarks=+5;    
	        elseif($option == "none")
	          $totalMarks=+0;    
	      }
	      elseif($key == "cert_unit_benifited"){
	        if($option == "yes")
	          $totalMarks=+5;    
	        elseif($option == "none")
	          $totalMarks=+0;    
	      }
	       return $totalMarks; 
	    }
}