<?php

	/**
	*@author Hemant Thakur
	*/
	require_once(Yii::app()->basePath .'/extensions/tcpdf/tcpdf/tcpdf.php');
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
	class InPrincipleAprovalPDF extends TCPDF{
		    public function Header() {
		        // Logo
		        $line_width = (0.85 / $this->k);
		        $this->SetLineStyle(array('width' => $line_width, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => '#000'));
	                $image_file = $_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/PDFLOGO.png';
		        $this->Image($image_file, 'C', 0.5, '2.5', '', 'PNG', '', 'C', false, 300, 'C', false, false, 0, false, false, false);
		      
		        $this->SetFont('times', '', 10);
		    
		         $data='<hr>';
		        $this->Ln();
		    }
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
		                 <th>Certificate Date & Time:'.date('Y-m-d H:m:s').'</th><th> &nbsp;&nbsp;&nbsp;&nbsp;This is system generated certificate</th>
		                </tr>
		              </table>';
		    	         

		    	        // Page number
		    	        $this->Cell(0, 0, $this->writeHTML($data),  '', 1, 'R');

		    	    }
	}
	class Utility{
		/* Function is used to check for super admin role
		* Author : Hemant Thakur
		*@param : int(role_id)
		@return : Boolean(true/false)
		*/
		static function isSuperAdmin(){
			@session_start();
			if(!isset($_SESSION['uid']) && empty($_SESSION['uid']))
				return false;
			$uid=$_SESSION['uid'];
			$rolesModel=new RolesExt;
			$role_id=$rolesModel->getUserRoleViaId($uid);
			if($role_id['role_id']==1)
				return true;
			else
				return false;
		}
		/**
		* This function is used to check the noodles role
		* @author : Hemant Thakur
		* 
		*/
		static function isDeptNoodalOfficer(){
			@session_start();
			if(!isset($_SESSION['uid']) && empty($_SESSION['uid']))
				return false;
			$uid=$_SESSION['uid'];
			$rolesModel=new RolesExt;
			$role_id=$rolesModel->getUserRoleViaId($uid);
			if($role_id['role_id']==3 || $role_id['role_id'] ==5)
				return true;
			else
				return false;
		}

		/* Function is used to Generate Application PDF
		* Author : Gaurav OJHA
		*@param : int(role_id)
		@return : PDF 
		*/
	static function generatePdfApp($content,$name){ 
		$pdf= new MYPDF('P','cm','A4',true,'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor("CAIPO");
	    $pdf->SetTitle($name."Application Form");
	    $pdf->SetSubject($name);
	    $pdf->SetKeywords("CAIPO, Application Form");
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
        $params = $pdf->serializeTCPDFtagParameters(array('CODE 39', 'C39', '', '', 80, 30, 0.4, array('position' => 'S', 'border' => true, 'padding' => 4, 'fgcolor' => array(0, 0, 0), 'bgcolor' => array(255, 255, 255), 'text' => true, 'font' => 'helvetica', 'fontsize' => 8, 'stretchtext' => 4), 'N'));
		/* echo $content;
		die('dsfslf dslfsndflndslfnsdnf'); */
		$pdf->writeHTML($content, true, 0, 0, 0);
		$pdf->lastPage();
		$pdf->Output($name, "I");
		
		ob_end_clean();

	}
	static function generateInPrinciple($content,$name){
			$pdf= new InPrincipleAprovalPDF('P','cm','A4',true,'UTF-8', false);
			$fontname=$pdf->addTTFfont( $_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/fonts/Cambria.ttf', '', '', 32);
			$fontname=$pdf->addTTFfont( $_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/fonts/cambriab.ttf', '', '', 32);
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor("CAIPO");
		    $pdf->SetTitle($name."Application Form");
		    $pdf->SetSubject($name);
		    $pdf->SetKeywords("CAIPO, Application Form");
			$pdf->setPrintHeader(true);
			$pdf->setHeaderFont(Array('Cambria', '', 10));
			$pdf->setFooterFont(Array('Cambria', '', 10));
			$pdf->SetMargins(1, 2.6, 1);
			// set default header data
			$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
			//$pdf->setHeader();
			$pdf->setPrintFooter(true);
			$pdf->AliasNbPages();
			$pdf->AddPage();
			$pdf->SetFont("Cambria", "", 12);
	        $params = $pdf->serializeTCPDFtagParameters(array('CODE 39', 'C39', '', '', 80, 30, 0.4, array('position' => 'S', 'border' => true, 'padding' => 4, 'fgcolor' => array(0, 0, 0), 'bgcolor' => array(255, 255, 255), 'text' => true, 'font' => 'helvetica', 'fontsize' => 8, 'stretchtext' => 4), 'N'));
			$pdf->writeHTML($content, true, 0, 0, 0);
			$pdf->lastPage();
			$pdf->Output($name, "I"); 
			ob_end_clean();
	}
}
?>
