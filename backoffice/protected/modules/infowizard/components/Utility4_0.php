<?php
	require_once(Yii::app()->basePath.'/extensions/tcpdf/tcpdf/tcpdf.php');
	
	class MYPDF extends TCPDF {

	    //Page header
	    public function Header() {
	        // Logo
	        $line_width = (0.85 / $this->k);
	        $logo_url = PDF_HEADER_LOGO;
	        $sub_heading1 =PDF_HEADER_STRING1;	
	        $title_heading = PDF_HEADER_TITLE_CAF;
	        $sub_heading2 =PDF_HEADER_STRING2;        
	        $this->SetLineStyle(array('width' => $line_width, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => '#000'));

	     
	         $image_file2 = $_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/doi.png';
			$this->Image($image_file2, 10, 0.6, 1.8, '', '', '', 'T', false, 150, '', false, false, 0, false, false, false);

//Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')

			/*if($this->page == 1){
				$this->Cell(0, 0, 'Form 1', 0, 1, 'R', 0, '', 0);
			}

			if($this->page == 2){
				$this->Cell(0, 0, 'Form 4', 0, 1, 'R', 0, '', 0);
			}

			if($this->page == 3){
				$this->Cell(0, 0, 'Form 9', 0, 1, 'R', 0, '', 0);
			}*/

	        
	        $this->Ln();
	    }

	    // Page footer
	    public function Footer() {
	        $this->SetY(-2);    // Position at 30 mm from bottom
	        $this->SetFont('helvetica', 'I', 8);  // Set font
	        $data='<hr /><table class="tbl">
            <tr>
              <th colspan="2" style="font-size:12"><strong>For Ministry use only</strong>
              </th>
            </tr>
            <tr style="font-size: 12;">
            <th > Company Number: </th><th> Filed: </th></tr>
          </table>';
	         

	        $this->Cell(0, 0, $this->writeHTML($data),  '', 1, 'R');

	    }
	}
	
class Utility4_0{

	public static function generatePdfApp($content,$contentform4,$contentform9,$name){ 
	
		$pdf= new MYPDF('P','cm','A4',true,'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor("BARBADOS");
	    $pdf->SetTitle($name."Application Form");
	    $pdf->SetSubject($name);
	    $pdf->SetKeywords("BARBADOS, Application Form");
		$pdf->setPrintHeader(true);
		$pdf->setHeaderFont(Array('helvetica', '', 10));
		$pdf->setFooterFont(Array('helvetica', '', 10));
		$pdf->SetMargins(1, 2.6, 1);
		// set default header data

		 
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		//$pdf->setHeader();
		
		$pdf->AliasNbPages();
	
		$pdf->setPrintFooter(true);
		$pdf->SetFont("helvetica", "", 8);
        $params = $pdf->serializeTCPDFtagParameters(array('CODE 39', 'C39', '', '', 80, 40, 0.4, array('position' => 'S', 'border' => true, 'padding' => 4, 'fgcolor' => array(0, 0, 0), 'bgcolor' => array(255, 255, 255), 'text' => true, 'font' => 'helvetica', 'fontsize' => 8, 'stretchtext' => 4), 'N'));
		//echo $content;die;
		$pdf->AddPage();
		$pdf->writeHTML($content, true, 0, 0, 0);
	/*$style = array(
		    'border' => true,
		    'vpadding' => 'auto',
		    'hpadding' => 'auto',
		    'fgcolor' => array(0,0,0),
		    'bgcolor' => false, //array(255,255,255)
		    'module_width' => 1, // width of a single module in points
		    'module_height' => 1 // height of a single module in points
			);
			  	if(isset($_SESSION['certi_link']) && !empty($_SESSION['certi_link'])){
			  		$certi_link = $_SESSION['certi_link'];
			  	}else{
			  		$certi_link = BASE_URL.'/';
			  	}
		$pdf->SetXY(18, 24);

		$pdf->write2DBarcode($certi_link, 'QRCODE,H', '', '', 2, 2, $style, '');
		$pdf->SetFont("helvetica", "B", 9);
		$pdf->SetXY(18, 26);
		$pdf->Cell(0, 0, "Scan to verify",  '', 1, 'C');*/
		

		$pdf->AddPage();
		$pdf->writeHTML($contentform4, true, 0, 0, 0);
		

		$pdf->AddPage();
		$pdf->writeHTML($contentform9, true, 0, 0, 0);
		


		
		
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
