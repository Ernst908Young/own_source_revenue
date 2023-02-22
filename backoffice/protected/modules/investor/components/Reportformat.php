<?php
	require_once(Yii::app()->basePath.'/extensions/tcpdf/tcpdf/tcpdf.php');
	
	class MYPDF extends TCPDF {

	    //Page header
	    public function Header() {
	        // Logo
	       
	    
	        $sub_heading1 =PDF_HEADER_STRING1;	
	        $title_heading = PDF_HEADER_TITLE_CAF;
	        $sub_heading2 =PDF_HEADER_STRING2; 
	    

	        //$this->SetLineStyle(array('width' => $line_width, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => '#000'));

	      
			//echo base64_decode($_GET['service_id']);die;
			
			
			$image_file = $_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/doi.png';
	        $this->SetFont('times', '', 11);
	       // $heading = 'Report Main heading';
			$data='<br><br>
				<table width="100%" >			
				<tr>					
					<td width="15%">
						<img src="'. $image_file.'" height="60px" width="60px">	
					</td>		
					<td width="85%">
						<h3>'.PDF_HEADER_TITLE_new.'</h3><br>
						From: <b>01-01-2021</b> To: <b>11-08-2021</b> <br>
						Search By: 
					</td>		
					
				</tr>
				</table>';			
	        
			$this->Cell(0, 0, $this->writeHTML($data),  '', 1, 'R');	     
	      
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
		
	        // Position at 15 mm from bottom
	        $this->SetY(-1);
	        // Set font
	        $this->SetFont('helvetica', 'I', 8);
	        $data='<hr /><table class="tbl">
            <tr>
              <th style="text-align:left">
			  Printed By: '.$uname.'</th colspan="2">
			  <th  style="text-align:center;">Printed DateTime:'.date('Y-m-d H:i:s').'</th>
			  <th  style="text-align:right">Page Number:'.$this->getAliasNumPage().'/'.$this->getAliasNbPages().' </th>
            </tr>
          </table>';
	         

	        // Page number
	        $this->Cell(0, 0, $this->writeHTML($data),  '', 1, 'R');

	    }
	}
class Reportformat{

	public static function generatePdf($content,$name,$heading){ 
				
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
		// set default header data

		   define('PDF_HEADER_TITLE_new', $heading);
	
	
		
		$pdf->AliasNbPages();
	
		$pdf->setPrintFooter(true);
		$pdf->SetFont("helvetica", "", 9);
        $params = $pdf->serializeTCPDFtagParameters(array('CODE 39', 'C39', '', '', 80, 40, 0.4, array('position' => 'S', 'border' => true, 'padding' => 4, 'fgcolor' => array(0, 0, 0), 'bgcolor' => array(255, 255, 255), 'text' => true, 'font' => 'helvetica', 'fontsize' => 8, 'stretchtext' => 4), 'N'));
		//echo $content;die;
		$pdf->AddPage();
		$pdf->writeHTML($content, true, 0, 0, 0);
		$pdf->Output($name, "I"); 
		
	}
	
	
	

}

?>
