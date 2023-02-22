<?php
class Utility{
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
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookiejar);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookiejar);
		curl_setopt($ch, CURLOPT_TIMEOUT, 500);
		// echo "<pre>";print_r($ch);die;
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


static function generatePdfApp($content,$name){ 
		// echo "<pre>";print_r($content);print_r($name);die("aya");
		// $cnt=count($contentArray);
        // $pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf', 'P', 'cm', 'A4', true, 'UTF-8');		
		$pdf= new MYPDF('P','cm','A4',true,'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor("SWCS Chhattisgarh");
	    $pdf->SetTitle($name."Application Form");
	    $pdf->SetSubject($name);
	    $pdf->SetKeywords("SWCS, Application Form");
		$pdf->setPrintHeader(true);
		$pdf->setHeaderFont(Array('helvetica', '', 10));
		$pdf->setFooterFont(Array('helvetica', '', 10));
		$pdf->SetMargins(1, 2.6, 1);
		// set default header data

		// echo PDF_HEADER_LOGO_WIDTH;die;
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		//$pdf->setHeader();
		$pdf->setPrintFooter(true);
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont("helvetica", "", 8);
        $params = $pdf->serializeTCPDFtagParameters(array('CODE 39', 'C39', '', '', 80, 40, 0.4, array('position' => 'S', 'border' => true, 'padding' => 4, 'fgcolor' => array(0, 0, 0), 'bgcolor' => array(255, 255, 255), 'text' => true, 'font' => 'helvetica', 'fontsize' => 8, 'stretchtext' => 4), 'N'));
		$pdf->writeHTML($content, true, 0, 0, 0);
		$pdf->lastPage();
		$pdf->Output($name, "I"); 
		
	}



 static function getAllPages($active = true, $render = true, $parent_id = false, $pcat_id = 1) {
        $active = (int) $active;
        if ($parent_id !== false) {
            $parent_id = (int) $parent_id;
            //$sql = "SELECT page_order,page_id,page_stub,page_name,parent_id FROM page_info WHERE pcat_id=$pcat_id AND parent_id=$parent_id AND is_active=$active ORDER BY page_order";
            $sql = "SELECT 
                    bo_page_info.page_id,
                     bo_page_info.new_tab,
                    bo_page_info.page_stub,
                    bo_page_info.page_name,
                    bo_page_info.page_name1,
                    bo_page_info.page_name2,
                    bo_page_info.page_name3,
                    bo_page_info.page_name4,
                    bo_page_info.parent_id,
                    bo_page_info.is_direct_link,
                    bo_page_info.link_address,
                    bo_page_category_relation.relation_id,
                    bo_page_category_relation.page_order,
                    bo_page_category_relation.cat_id FROM bo_page_info 
                    INNER JOIN bo_page_category_relation
                    ON bo_page_info.page_id=bo_page_category_relation.page_id 
                    WHERE 
                    bo_page_category_relation.cat_id=$pcat_id 
                    AND bo_page_info.parent_id=$parent_id 
                    AND bo_page_info.is_active=$active
                    AND bo_page_category_relation.is_active=$active
                    ORDER BY bo_page_category_relation.page_order";
        } else {
            //$sql = "SELECT page_order,page_order,page_id,page_stub,page_name,parent_id FROM page_info WHERE pcat_id=$pcat_id  AND is_active=$active ORDER BY page_order";
            $sql = "SELECT bo_page_info.page_id,
                    bo_page_info.page_stub,
                    bo_page_info.new_tab,
                    bo_page_info.page_name,
                    bo_page_info.page_name1,
                    bo_page_info.page_name2,
                    bo_page_info.page_name3,
                    bo_page_info.page_name4,
                    bo_page_info.parent_id,
                    bo_page_info.is_direct_link,
                    bo_page_info.link_address,
                    bo_page_category_relation.relation_id,
                    bo_page_category_relation.page_order,
                    bo_page_category_relation.cat_id FROM bo_page_info 
                    INNER JOIN page_category_relation
                    ON bo_page_info.page_id=bo_page_category_relation.page_id 
                    WHERE page_category_relation.cat_id = $pcat_id  
                        AND bo_page_info.is_active=$active ORDER BY bo_page_category_relation.page_order";
        }
        // die;
        $connection = Yii::app()->db;
        $command = $connection->createCommand($sql);
        $result = array();
        $rows = $command->queryAll();
        if ($render === TRUE) {
            $result[0] = " (No Parent Page) ";
            foreach ($rows as $row) {
                extract($row);
                $result[$page_id] = "$page_name  -  ($page_stub) ";
            }
        } else {
            foreach ($rows as $row) {
                $result[] = $row;
            }
        }
        return $result;
    }


static function getPageTree($pcat_id = 1) {
        $return = array();
        $pages = Utility::getAllPages(true, false, 0, $pcat_id);
        foreach ($pages as $page) {
            $page_id = $page['page_id'];
            $children = Utility::getAllPages(true, false, $page_id, $pcat_id);
            $children1 = array();
            foreach ($children as $child) {
                $childpage_id = $child['page_id'];
                $sub_child = Utility::getAllPages(true, false, $childpage_id, $pcat_id);
                $child['children'] = $sub_child;
                $children1[] = $child;
            }

            $page['children'] = $children1;
            $return[] = $page;
        }
        return $return;
    }

	
	}
	
	require_once(Yii::app()->basePath.'/extensions/tcpdf/tcpdf/tcpdf.php');
	class MYPDF extends TCPDF {

	    //Page header
	    public function Header() {
	        // Logo
	        $line_width = (0.85 / $this->k);
	        $this->SetLineStyle(array('width' => $line_width, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => '#000'));
	         $image_file = $_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/'.PDF_HEADER_LOGO;
		$this->Image($image_file, 1, 0.2, 2, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false);
	        // Set font
	        $this->SetFont('times', '', 10);
	        $data='<table>
            <tr>
              <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
            </tr>
            <tr>
            <td colspan="8" style="font-weight:900;font-size:1.5em" align="center">'.PDF_HEADER_TITLE_CAF.'</td>
             </tr>
             <tr>
            <td colspan="8" style="font-weight:600;font-size:0.9em" align="center">'.PDF_HEADER_STRING1.'</td>
            </tr>
             <tr><td colspan="8" style="font-weight:600;font-size:0.9em" align="center"> '.PDF_HEADER_STRING2.' </td>
             </tr>
          </table><br><hr>';

	        // Title
	        $this->Cell(0, -5, $this->writeHTML($data) , 0, '', 'T', 0, 'C');
	         $image_file2 = $_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/doi.png';
		$this->Image($image_file2, 18, 0.7, 2, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false);
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
	        $this->SetFont('helvetica', 'I', 8);
	        $data='<hr /><table class="tbl">
            <tr>
              <th colspan="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Printed By: '.$uname.'</th colspan="2"><th>Printed DateTime:'.date('Y-m-d H:m:s').'</th><th>  Page Number:'.$this->getAliasNumPage().'/'.$this->getAliasNbPages().' </th>
            </tr>
          </table>';
	         

	        // Page number
	        $this->Cell(0, 0, $this->writeHTML($data),  '', 1, 'R');

	    }
	}

		




?>
