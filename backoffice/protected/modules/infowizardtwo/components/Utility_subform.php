<?php
	require_once(Yii::app()->basePath.'/extensions/tcpdf/tcpdf/tcpdf.php');
	class MYPDF extends TCPDF {

	    //Page header
	    public function Header() {
	        // Logo
	        $line_width = (0.85 / $this->k);
	        $logo_url = PDF_HEADER_LOGO;
	        $sub_heading1 =PDF_HEADER_STRING1;	
	        $title_heading = "Panchayati Raj";
	        $sub_heading2 =PDF_HEADER_STRING2;        
	        $this->SetLineStyle(array('width' => $line_width, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => '#000'));

	        /* Pankaj Singh for Dynamic headers */
	        if(isset($_GET['dept'])){
	        	$dept_id = $_GET['dept'];
	        	switch ($dept_id) {
	        		case 1:
	        			$logo_url = 'staymev_jayte.png';	        			
	        			$title_heading = "Film Shooting India";
	        			$sub_heading1 ='Department of film Shooting';
	        			$sub_heading2 ='Govt. of INDIA';
	        			break;
	        		
	        		default:
	        			$logo_url = PDF_HEADER_LOGO;	        			
	        			$title_heading = "Panchayati Raj";
	        			$sub_heading1 =PDF_HEADER_STRING1;
	        			$sub_heading2 =PDF_HEADER_STRING2;
	        			break;
	        	}
	        }
	         //$image_file = $_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/'.$logo_url;
	        $image_file = $_SERVER['DOCUMENT_ROOT'].'/backoffice/themes/investuk/img/AshokStambh.png';
	        //exit(PDF_HEADER_STRING1);
			$this->Image($image_file, 1, 0.2, 2, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false);
	        // Set font
	        $this->SetFont('times', '', 10);
	        $data='<table>
            <tr>
              <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
            </tr>
            <tr>
            <td colspan="8" style="font-weight:900;font-size:1.5em" align="center">'.$title_heading.'</td>
             </tr>
             <tr>
            <td colspan="8" style="font-weight:600;font-size:0.9em" align="center">GOVERNMENT OF UTTAR PRADESH</td>
            </tr>
             <tr><td colspan="8" style="font-weight:600;font-size:0.9em" align="center">  </td>
             </tr>
          </table><br><hr>';

	        // Title
	        $this->Cell(0, -5, $this->writeHTML($data) , 0, '', 'T', 0, 'C');
	       // $image_file2 = $_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/doi.png';
			//$this->Image($image_file2, 18, 0.7, 2, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false);
	         $data='<hr>';
	        $this->Ln();
	    }

	    // Page footer
	    public function Footer() {
	    	@session_start();
	    	$uname='Department User';			
	    	if(isset($_SESSION['uname']) && !empty($_SESSION['uname'])){
	    		$uname=ucwords($_SESSION['uname']);
	    		if(preg_match('/_/', $uname))
	    			$uname=ucwords(str_replace('_', ' ', $uname));
	    	}
			if(isset($_SESSION['RESPONSE']['user_id']) && !empty($_SESSION['RESPONSE']['user_id'])){
	    		$uname=ucwords($_SESSION['RESPONSE']['first_name'].' '.$_SESSION['RESPONSE']['last_name']);
	    		if(preg_match('/_/', $uname))
	    			$uname=ucwords(str_replace('_', ' ', $uname));
	    	}
			$line_width = (0.85 / $this->k);
			$this->SetLineStyle(array('width' => $line_width, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => '#000'));
			//print document barcode
			$barcode = $this->getBarcode();
			if (!empty($barcode)) {
			$this->Ln($line_width);
			$barcode_width = round(($this->w - $this->original_lMargin - $this->original_rMargin) / 3);
			$style = array(
			'position' => $this->rtl?'R':'L',
			'align' => $this->rtl?'R':'L',
			'stretch' => false,
			'fitwidth' => true,
			'cellfitalign' => '',
			'border' => false,
			'padding' => 0,
			'fgcolor' => array(0,0,0),
			'bgcolor' => false,
			'text' => false
			);
			$this->write1DBarcode($barcode, 'C128', '', $cur_y + $line_width, '', (($this->footer_margin / 3) - $line_width), 0.3, $style, '');
			}
			// Position at 15 mm from bottom
			$this->SetY(-1);
			// Set font
			$this->SetFont('helvetica', '', 8);
			$data='<hr/><table class="tbl">
				<tr>
				<th style="text-align:left">Printed On: '.date('d-m-Y H:i:s').'</th>
				<th style="text-align: center;">Printed by: '.$uname.'</th>
				<th style="text-align: right;">Page: '.$this->getAliasNumPage().' of '.$this->getAliasNbPages().' </th>
				</tr>
				</table>';
			// Page number
			$this->Cell(0, 0, $this->writeHTML($data),  '', 1, 'R');

	    }
	}
class Utility_subform{

	public static function generatePdfApp($content,$name){ 
		// echo "<pre>";print_r($content);print_r($name);die("aya");
		// $cnt=count($contentArray);
        // $pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf', 'P', 'cm', 'A4', true, 'UTF-8');		
		$pdf= new MYPDF('P','cm','A4',true,'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor("SWCS Uttar Pradesh");
	    $pdf->SetTitle($name."Application Form");
	    $pdf->SetSubject($name);
	    $pdf->SetKeywords("SWCS, Application Form");
		$pdf->setPrintHeader(true);
		$pdf->setHeaderFont(Array('helvetica', '', 10));
		$pdf->setFooterFont(Array('helvetica', '', 10));
		$pdf->SetMargins(1, 2.6, 1);
		// set default header data

		 
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		//$pdf->setHeader();
		$pdf->setPrintFooter(true);
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont("helvetica", "", 8);
        $params = $pdf->serializeTCPDFtagParameters(array('CODE 39', 'C39', '', '', 80, 40, 0.4, array('position' => 'S', 'border' => true, 'padding' => 4, 'fgcolor' => array(0, 0, 0), 'bgcolor' => array(255, 255, 255), 'text' => true, 'font' => 'helvetica', 'fontsize' => 8, 'stretchtext' => 4), 'N'));
		//echo $content;die;
        
		$pdf->writeHTML($content, true, 0, 0, 0);
		$pdf->lastPage();
		$pdf->Output($name, "I"); 
		
	}

	public static function generateHindiPdfApp($content,$name)
	{ 
		$pdf= new MYPDF('P','cm','A4',true,'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor("SWCS UTTARPRADESH");
	    $pdf->SetTitle($name."SWCS UTTARPRADESH");
	    $pdf->SetSubject($name);
	    $pdf->SetKeywords("SWCS UTTARPRADESH");
		$pdf->SetMargins(1, 7, 1);

		//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 018', PDF_HEADER_STRING);
		//$pdf->setHeader(true);
		$pdf->setPrintFooter(true);
		
		$pdf->AliasNbPages();
		$pdf->AddPage();
		// set some language dependent data:
		
		$lg = Array();
		$l['a_meta_charset'] = 'UTF-8';
		$l['a_meta_dir'] = 'ltr';
		$l['a_meta_language'] = 'hi';
		$lg['w_page'] = 'page';

		// set some language-dependent strings (optional)
		$pdf->setLanguageArray($lg);

		// set font
		$pdf->SetFont('freesans', '', 12);

		// add a page
		//$pdf->AddPage();

		$pdf->writeHTML($content,  true, 0, true, 0); 
		$pdf->lastPage();
		$pdf->Output($name, "I"); 
		
	}
	
	public static function generatePdfNew($content,$name){ 
        date_default_timezone_set('Asia/Calcutta'); 
		$pdf= new MYPDF('c','A4','','','25','18','35','18');		
		$logo_url = 'logo.png';
		$sub_heading1 =PDF_HEADER_STRING1;	
		$title_heading = PDF_HEADER_TITLE_CAF;
		$sub_heading2 =PDF_HEADER_STRING2; 
		$image_file = $_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/'.$logo_url; 
		$image_file2 = getcwd() . '/themes/investuk/images/msme.png';
		@session_start();
		$uname='Department User';			
		if(isset($_SESSION['uname']) && !empty($_SESSION['uname'])){
			$uname=ucwords($_SESSION['uname']);
			if(preg_match('/_/', $uname))
				$uname=ucwords(str_replace('_', ' ', $uname));
		}
		if(isset($_SESSION['RESPONSE']['user_id']) && !empty($_SESSION['RESPONSE']['user_id'])){
			$uname=ucwords($_SESSION['RESPONSE']['first_name'].' '.$_SESSION['RESPONSE']['last_name']);
			if(preg_match('/_/', $uname))
				$uname=ucwords(str_replace('_', ' ', $uname));
		}
		$header='<table width="100%">
				<tr>
				<td width="18%"><img src="'.$image_file.'" /></td>
				<td width="64%" align="center"><span style="font-size:22pt;">E-Judiciary System</span><br><span style="font-size:15pt;">GOVERNMENT OF UTTARPRADESH</span></td>
				<td width="18%" style="text-align: right;"><img style="width:90px;height:85px;" src="'.$image_file2.'" /></td>
				</tr>
				</table><br><br><br>';
		$footer='<hr /><table width="100%">
					<tr>
					<td width="33%">Printed On: '.date('d-m-Y H:i:s').'</td>
					<td width="33%" align="center">Printed by: '.$uname.'</td>
					<td width="33%" style="text-align: right;">  Page {PAGENO} of {nbpg}</td>
					</tr>
				</table>';		
		$pdf->SetHTMLHeader($header);
		$pdf->SetHTMLFooter($footer);
		$pdf->Ln(); 
		$pdf->Ln();
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor("SWCS UTTARPRADESH");
	    $pdf->SetTitle($name);
	    $pdf->SetSubject($name);
	    $pdf->SetKeywords("SWCS, Application Form");
		$pdf->SetDisplayMode('fullpage');
		$pdf->list_indent_first_level =0;	// 1 or 0 - whether to indent the first level of a list
		$pdf->AddPage('L', 'A4');
              //  $pdf->use_kwt = true; 
		$stylesheet = file_get_contents('http://52.172.145.30/backoffice/css/report_covid.css');
		$pdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
		$pdf->WriteHTML($content, 2,true,false);
		//$pdf->lastPage();
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


	public static function generateCmryHindiPdfApp($content,$name)
	{ 
		$pdf= new MYPDF('P','cm','A4',true,'UTF-8', true);
		
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor("SWCS UTTARPRADESH");
	    $pdf->SetTitle($name."SWCS UTTARPRADESH");
	    $pdf->SetSubject($name);
	    $pdf->SetKeywords("SWCS UTTARPRADESH");
		$pdf->SetMargins(1, 7, 1);




		//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 018', PDF_HEADER_STRING);
		//$pdf->setHeader(true);
		$pdf->setPrintFooter(true);
		
		$pdf->AliasNbPages();
		$pdf->AddPage();
		// set some language dependent data:
		
		$lg = Array();
		$l['a_meta_charset'] = 'UTF-8';
		$l['a_meta_dir'] = 'ltr';
		$l['a_meta_language'] = 'IN';
		$lg['w_page'] = 'page';

		// set some language-dependent strings (optional)
		$pdf->setLanguageArray($lg);

		// set font
		$pdf->SetFont('freesans', '', 12);

		// add a page
		//$pdf->AddPage();

		$pdf->writeHTML($content,  true, 0, true, 0); 
		$pdf->lastPage();
		$pdf->Output($name, "I"); 
		
	}
	
	

}

?>
