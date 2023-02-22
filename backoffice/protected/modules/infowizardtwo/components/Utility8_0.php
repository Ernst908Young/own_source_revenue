<?php
	require_once(Yii::app()->basePath.'/extensions/tcpdf/tcpdf/tcpdf.php');
	
	class MYPDF extends TCPDF {
         public $is_approved;
		public $reg_no;
	    //Page header
	    public function Header() {
	        // Logo
	        $line_width = (0.85 / $this->k);
	   
	        $this->SetLineStyle(array('width' => $line_width, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => '#000'));

	     
	         $image_file2 = $_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/doi.png';
			$this->Image($image_file2, 10, 0.6, 1.8, '', '', '', 'T', false, 150, '', false, false, 0, false, false, false);

	        
	        $this->Ln();
	    }

	     public function setData($is_approved,$reg_no){
		    	$this->is_approved = $is_approved;
		    	$this->reg_no = $reg_no;
		  }

	    // Page footer
	   public function Footer() {
	    	
	    	 $this->SetFont('helvetica', 'I', 8);  // Set font
	    	if($this->is_approved==1){
	    		$this->SetY(-3.5);    // Position at 30 mm from bottom
	       
	        $data='
	        <table>
<tr>
  <td width="20%"> </td>
  <td width="60%">  
    <table style="padding-top: 10px; font-size: 12; border: 1px blue solid ; border-collapse: collapse; padding: 5px;">
    <tr>
    <td style="text-align:center; color:blue; ">  
         <span style="font-size: 10;"><strong>REGISTERED  </strong></span>   <br>
        <span style="font-size: 9 ;"><strong> CORPORATE AFFAIRS AND INTELLECTUAL PROPERTY OFFICE</strong></span>  
    </td>
     </tr>
</table>
  </td>
  <td width="20%"> </td>
</tr>
 </table><br>';	
	    	}else{
	    		$this->SetY(-2);    // Position at 30 mm from bottom	       
	        $data='';
	    	}
			if(isset($_GET['is_vpd'])){
				$this->SetFont('helvetica', '', 8);
				$data.='<hr /><table style="padding:5px;">
			            <tr bgcolor="yellow">
			              <th>This document is downloaded under View Public Document (VPD) service of CAIPO. In case you wish to obtain a certified true copy of the same, please apply at CAIPO separately.
			              </th>
			            </tr>			            
			          </table>'; 
			}else{
				$data.='<hr /><table class="tbl">
			            <tr>
			              <th colspan="2"><strong>For CAIPO use only</strong>
			              </th>
			            </tr>
			            <tr>
			            <th >Company Number: '.$this->reg_no.'</th></tr>
			          </table>'; 
			}
	    	
	        
	        $this->Cell(0, 20, $this->writeHTML($data),  '', 1, 'R');

	    }
	}
	
class Utility8_0{

	public static function generatePdfApp($content,$contentform_30pdf,$name,$app_log){ 
	
		$pdf= new MYPDF('P','cm','A4',true,'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor("BARBADOS");
	    $pdf->SetTitle($name."Application Form");
	    $pdf->SetSubject($name);
	    $pdf->SetKeywords("BARBADOS, Application Form");
		$pdf->setPrintHeader(true);
		$pdf->setHeaderFont(Array('helvetica', '', 10));
		$pdf->setFooterFont(Array('helvetica', '', 10));
		$pdf->SetMargins(1, 3, 1);
	  
		$pdf->SetFont("helvetica", "", 10);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);		
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$pdf->setPrintFooter(true);
		$pdf->AddPage();

		$subID = $app_log['app_Sub_id'] ? $app_log['app_Sub_id'] : 0;
		$submissiondaterecord =  Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_application_log where app_Sub_id = $subID and action_status='P' order BY id ASC")->queryRow();

		$cd = Yii::app()->db->createCommand("SELECT * FROM bo_company_details where srn_no = $subID")->queryRow();
		$reg_no = 'NA';
		if($cd){
			if(isset($cd['reg_no'])){
				if($cd['reg_no']!=''){
					$reg_no = $cd['reg_no'];
				}				
			}
		}

		if($app_log['department_user_id'] && $submissiondaterecord['created']){
			$pdf->setData(1,$reg_no);		
			
			$sdate =  date('Y/m/d',strtotime($submissiondaterecord['created']));
			$auid = $app_log['department_user_id'];
			 $sig_d = Yii::app()->db->createCommand("SELECT * FROM tbl_bo_signature_detail where userid = $auid and isactive=1")->queryRow();
			$image_file2 = $_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/'.$sig_d['signature'];
		$data='<table  style="border: 1px blue solid ; border-collapse: collapse; padding: 2px;">
			    <tr>
				    <td style="color:blue; text-align:center;">  
				         <span style="font-size: 11;"><strong>REGISTERED  </strong></span>   
				    </td>
			    </tr>
		         <tr>
		            <td style="color:blue;">
				         <span style="font-size: 9;"><strong>SIGNATURE  </strong></span>   
				      </td>
			    </tr>
			     <tr>
		            <td style="color:blue;">
				          <span style="font-size: 9; "><strong>DATE  </strong><span style="color:black;">'.$sdate.' </span></span>   
				          </td>
			    </tr>
			      <tr>
		            <td style="color:blue; text-align:center">
				           <span style="font-size: 7;"><strong> CORPORATE AFFAIRS AND </strong></span><br>
				        <span style="font-size: 7;"><strong> INTELLECTUAL PROPERTY OFFICE</strong></span>  
				    </td>
			     </tr>
			</table>';
	         
			$pdf->SetXY(15, 3);
	        $pdf->Cell(40, 0, $pdf->writeHTML($data),  '', 1, 'R');

		 
		$pdf->Image($image_file2, 17.5, 3.5, 2, '', '', '', 'T', false, 150, '', false, false, 0, false, false, false);
		$pdf->SetY(3);
		}else{
			$pdf->setData(0,$reg_no);
		}
		$pdf->writeHTML($content, true, 0, 0, 0);

		$pdf->AddPage();
		$pdf->writeHTML($contentform_30pdf, true, 0, 0, 0);

		
		
	//	$pdf->lastPage();
		$pdf->Output($name, "I"); 
		
	}
	public static function IsAuctionOpen(){
		// $criteria=new CDbCriteria;
		// $criteria->condition="is_active=:status AND district_id=:district_id";
		// $criteria->params=array(":status"=>"Y",":district_id"=>1);
		// $auctionDetail=LaAuctionDetail::model()->find($criteria);

		// $now = strtotime(date("Y-m-d"));
		// $StartDate = strtotime($auctionDetail->auc_start_date);
		// $EndDate = strtotime($auctionDetail->auc_end_date);

		// if($now >= $StartDate && $now <= $EndDate)
			return true;
		// else
		// 	return false;
	}

	public static function checkForExist($app_id,$dept_id,$user_id){
		$criteria = new CDbCriteria();
        $criteria->condition = 'user_id=:id AND application_id=:app_id AND dept_id=:dept_id';
        $criteria->order="submission_id DESC";
        $criteria->params = array(':id'=>$user_id,":app_id"=>$app_id,":dept_id"=>$dept_id);
        $modelinfo = ApplicationSubmission::model()->find($criteria);
        if($modelinfo===null)
        	return false;
        return $modelinfo;

	}
	public static function getAllDept(){
			$model = new DepartmentsExt;
			$allDept = $model->getDept();
			return $allDept;
	}
	public static function getDeptById($dept_id){
			$model = new DepartmentsExt;
			$allDept = $model->getDeptbyId($dept_id);
			return $allDept;
	}

	public static function getAppNameFromId($app_id){
			$model=Applications::model()->findByPK($app_id);
			return $model->attributes['application_name'];

	}
	public static function getDeptApp($dept_id){
			$model = new ApplicationExt;
			$dept_id = $model->getAppFromDept($dept_id);
			//print_r($dept_id);die;
			return $dept_id;
	}
	public static function getDeptAppFields($app_id){
			$model = new ApplicationExt;
			$dept_id = $model->getDeptAppFields($app_id);
			//print_r($dept_id);die;
			return $dept_id;
	}
		public static function getViaCurl($url) {
		$url = Utility::sanatizeString($url);
		$cookiejar = "SSO_COOKIE.txt";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1; rv:5.0) Gecko/20100101 Firefox/5.0');
		curl_setopt($ch, CURLOPT_POST, FALSE);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiejar);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiejar);
		curl_setopt($ch, CURLOPT_TIMEOUT, 500);
		$output = curl_exec($ch);
		if ($output === false) {
			$error = array();
			$error['ERROR_MSG'] = curl_error($ch);
			$error['ERROR_CODE'] = curl_errno($ch);
			$error['url'] = $url;
			$return = array();
			$return['STATUS_ID'] = '222';
			$return['STATUS_MSG'] = 'CURL_ERROR';
			$return['RESPONSE'] = $error;

			$error_message = "cURL ERROR: \t " . curl_errno($ch) . " - " . curl_error($ch);
			Yii::log($error_message, 'error', 'system.*');
			return json_encode($return);
		} 
		else {
			return $output;
		}
	}
		public static function sanatizeString($string){
		$string=strip_tags(trim($string));
		
		return $string;
	}
	public static function logout(){
		@session_start();
		session_destroy();
		setcookie('SSO_TOKEN','',time()-1000,"/");
		setcookie('SSO_HREF','',time()-1000,"/");
	}


	

}

?>
