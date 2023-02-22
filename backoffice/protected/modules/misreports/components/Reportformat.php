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
			
			
			$image_file = $_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/Uttar_Pradesh.svg';
	        $this->SetFont('times', '', 11);
	       // $heading = 'Report Main heading';
			$data='<br><br>
				<table width="100%" >			
					<tr>					
						<td style="text-align:center">
							<img src="'. $image_file.'" height="60px" width="80px">	
						</td>
					</tr>
					<tr>			
						<td style="text-align:center">
							<span style="font-size:15; color:#0f6fb5;">Goverment of Uttar Pradesh</span><br>
							Panchayatiraj
						</td>		
					</tr>
					<tr>			
						<td>
							&nbsp;
						</td>		
					</tr>
					<tr>			
						<td style="text-align:center">
							<br>
							<span style="font-size:13;"><strong>'.PDF_HEADER_TITLE_new.'</strong></span>							
						</td>		
					</tr>								
				</table>';

				if(FROM_DATE==NULL && SEARCH_CRITERIA==''){

				}else{
					$data.='<table><tr>			
						<td style="text-align:left">						
							<b><u>Search Criteria</u></b><br>
							'.SEARCH_CRITERIA.'<br>
							<strong>From Date : </strong> '.FROM_DATE.'<br><strong>To Date: </strong>'.TO_DATE.'
						</td>					
					
					</tr></table>';	
				}
						
	        
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
			  <th  style="text-align:center;">Printed DateTime:'.date('Y-M-d H:i:s').'</th>
			  <th  style="text-align:right">Page Number:'.$this->getAliasNumPage().'/'.$this->getAliasNbPages().' </th>
            </tr>
          </table>';
	         

	        // Page number
	        $this->Cell(0, 0, $this->writeHTML($data),  '', 1, 'R');

	    }
	}
class Reportformat{

	public static function generatePdf($content,$name,$heading,$from_date,$to_date,$search_criteria){ 
				
		$pdf= new MYPDF('P','cm','A4',true,'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor("BARBADOS");
	    $pdf->SetTitle($name."Application Form");
	    $pdf->SetSubject($name);
	    $pdf->SetKeywords("BARBADOS, Application Form");
		$pdf->setPrintHeader(true);
		$pdf->setHeaderFont(Array('helvetica', '', 10));
		$pdf->setFooterFont(Array('helvetica', '', 10));
		$pdf->SetMargins(1, 8.5, 1);
		// set default header data

		   define('PDF_HEADER_TITLE_new', $heading);
		   define('FROM_DATE', ($from_date ? date('d-M-Y',strtotime($from_date)) : ""));
		   define('TO_DATE', ($to_date ? date('d-M-Y',strtotime($to_date)) : ""));
		   define('SEARCH_CRITERIA', $search_criteria);
	


	
		
		$pdf->AliasNbPages();
	
		$pdf->setPrintFooter(true);
		$pdf->SetFont("helvetica", "", 10);
        $params = $pdf->serializeTCPDFtagParameters(array('CODE 39', 'C39', '', '', 80, 40, 0.4, array('position' => 'S', 'border' => true, 'padding' => 4, 'fgcolor' => array(0, 0, 0), 'bgcolor' => array(255, 255, 255), 'text' => true, 'font' => 'helvetica', 'fontsize' => 8, 'stretchtext' => 4), 'N'));
		//echo $content;die;
		$pdf->AddPage();
		/*$pdf->writeHTML('<table><tr>			
						<td style="text-align:left">						
							<b>Search Criteria</b><br>
							'.SEARCH_CRITERIA.'
						</td>		
					</tr></table>');*/
		$pdf->writeHTML($content, true, 0, 0, 0);
		$pdf->Output($name, "I"); 
		
	}
	
	
	public static function generatePdf_l_wg($content,$line_graph_data, $bargraphdata, $piechartdata,
 $donutchartdata,$name,$heading,$from_date,$to_date,$search_criteria,$grap_id){ 
				
		$pdf= new MYPDF('L','cm','A4',true,'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor("BARBADOS");
	    $pdf->SetTitle($name."Application Form");
	    $pdf->SetSubject($name);
	    $pdf->SetKeywords("BARBADOS, Application Form");
		$pdf->setPrintHeader(true);
		$pdf->setHeaderFont(Array('helvetica', '', 10));
		$pdf->setFooterFont(Array('helvetica', '', 10));
		$pdf->SetMargins(1, 8, 1);
		// set default header data

		   define('PDF_HEADER_TITLE_new', $heading);
	  define('FROM_DATE', ($from_date ? date('d-M-Y',strtotime($from_date)) : ""));
		   define('TO_DATE', ($to_date ? date('d-M-Y',strtotime($to_date)) : ""));
		         define('SEARCH_CRITERIA', $search_criteria);
	
		
		$pdf->AliasNbPages();
	
		$pdf->setPrintFooter(true);
		$pdf->SetFont("helvetica", "", 10);
        $params = $pdf->serializeTCPDFtagParameters(array('CODE 39', 'C39', '', '', 80, 40, 0.4, array('position' => 'S', 'border' => true, 'padding' => 4, 'fgcolor' => array(0, 0, 0), 'bgcolor' => array(255, 255, 255), 'text' => true, 'font' => 'helvetica', 'fontsize' => 8, 'stretchtext' => 4), 'N'));
	
if($grap_id!==NULL){
	//foreach ($grap_id as $value) {
		if($line_graph_data!=""){
			$pdf->AddPage();
			$base_code = $line_graph_data;
			
				$img='<h4>Chart Type - Line Graph</h4>';
			 $img.= '<img src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $base_code) . '">';
			
			
		    $pdf->writeHTML($img, true, false, true, false, '');
		}

		if($bargraphdata!=""){
			$pdf->AddPage();
			$base_code = $bargraphdata;
			
			$img='<h4>Chart Type - Bar Graph</h4>';			
			$img.= '<img src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $base_code) . '">';
		
		    $pdf->writeHTML($img, true, false, true, false, '');
		}

		if($piechartdata!=""){
			$pdf->AddPage();
			$base_code = $piechartdata;
			
			$img='<h4>Chart Type - Pie Chart</h4>';			
			$img.= '<img style="text-align:center;" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $base_code) . '" height="290">';
		
		    $pdf->writeHTML($img, true, false, true, false, '');
		}

		if($donutchartdata!=""){
			$pdf->AddPage();
			$base_code = $donutchartdata;
			
			$img='<h4>Chart Type - Donut Chart</h4>';			
			$img.= '<img style="text-align:center;" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $base_code) . '" height="290">';
		
		    $pdf->writeHTML($img, true, false, true, false, '');
		}

		/*if($piechartdata!="" || $donutchartdata!=""){
			$pdf->AddPage();
			$img = '<table><tr>';
			if($piechartdata!=""){
				$base_code = $piechartdata;				
				$img.= '<td><h4>Chart Type - Pie Chart</h4><img src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $base_code) . '" height="290"></td>';				
			}
			if($donutchartdata!=""){
				$base_code = $donutchartdata;
				$img.= '<td><h4>Chart Type - Donut Chart</h4><img src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $base_code) . '" height="290"></td>';
		
				}

						$img.="</tr></table>";	
		    $pdf->writeHTML($img, true, false, true, false, '');
		}*/

		/*if($value=='donate'){
			$pdf->AddPage();
			
		    $pdf->writeHTML($img, true, false, true, false, '');
		}*/
//	}   
}
    	$pdf->AddPage();
		
		$pdf->writeHTML($content, true, 0, 0, 0);
		$pdf->Output($name, "I"); 
		
	}

		public static function generatedssPdf_l_wg($content,$line_graph_data, $bargraphdata, $piechartdata,
		$donutchartdata,$multilinegraphdata,$multibargraphdata,$name,$heading,$from_date,$to_date,$search_criteria,$grap_id){ 
				
		$pdf= new MYPDF('L','cm','A4',true,'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor("BARBADOS");
	    $pdf->SetTitle($name."Application Form");
	    $pdf->SetSubject($name);
	    $pdf->SetKeywords("BARBADOS, Application Form");
		$pdf->setPrintHeader(true);
		$pdf->setHeaderFont(Array('helvetica', '', 10));
		$pdf->setFooterFont(Array('helvetica', '', 10));
		$pdf->SetMargins(1, 8, 1);
		// set default header data

		   define('PDF_HEADER_TITLE_new', $heading);
	  define('FROM_DATE', ($from_date ? date('d-M-Y',strtotime($from_date)) : ""));
		   define('TO_DATE', ($to_date ? date('d-M-Y',strtotime($to_date)) : ""));
		         define('SEARCH_CRITERIA', $search_criteria);
	
		
		$pdf->AliasNbPages();
	
		$pdf->setPrintFooter(true);
		$pdf->SetFont("helvetica", "", 10);
        $params = $pdf->serializeTCPDFtagParameters(array('CODE 39', 'C39', '', '', 80, 40, 0.4, array('position' => 'S', 'border' => true, 'padding' => 4, 'fgcolor' => array(0, 0, 0), 'bgcolor' => array(255, 255, 255), 'text' => true, 'font' => 'helvetica', 'fontsize' => 8, 'stretchtext' => 4), 'N'));
	
	$pdf->AddPage();
		
		$pdf->writeHTML($content, true, 0, 0, 0);
if($grap_id!==NULL){
	if($donutchartdata!=""){
			$pdf->AddPage();
			$base_code = $donutchartdata;
			
				$img= '<img style="text-align:center;" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $base_code) . '" height="290">';
			
		    $pdf->writeHTML($img, true, false, true, false, '');
		}
	if($bargraphdata!=""){
			$pdf->AddPage();
			$base_code = $bargraphdata;
			
				$img= '<img src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $base_code) . '">';	
			
		    $pdf->writeHTML($img, true, false, true, false, '');
		}
		if($line_graph_data!=""){
			$pdf->AddPage();
			$base_code = $line_graph_data;
			
				$img= '<img src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $base_code) . '">';	
			
			
		    $pdf->writeHTML($img, true, false, true, false, '');
		}

		if($multibargraphdata!=""){
			$pdf->AddPage();
			$base_code = $multibargraphdata;
			
			$img= '<img src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $base_code) . '">';
			
		    $pdf->writeHTML($img, true, false, true, false, '');
		}
		if($multilinegraphdata!=""){
			$pdf->AddPage();
			$base_code = $multilinegraphdata;
			
			$img= '<img src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $base_code) . '">';
			
		    $pdf->writeHTML($img, true, false, true, false, '');
		}

		

		if($piechartdata!=""){
			$pdf->AddPage();
			$base_code = $piechartdata;
			
				$img= '<img style="text-align:center;" src="@' . preg_replace('#^data:image/[^;]+;base64,#', '', $base_code) . '" height="290">';
			
		    $pdf->writeHTML($img, true, false, true, false, '');
		}

		

  
}
    	
		$pdf->Output($name, "I"); 
		
	}

	public static function generatePdf_l($content,$name,$heading,$from_date,$to_date,$search_criteria){ 
				
		$pdf= new MYPDF('L','cm','A4',true,'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor("BARBADOS");
	    $pdf->SetTitle($name."Application Form");
	    $pdf->SetSubject($name);
	    $pdf->SetKeywords("BARBADOS, Application Form");
		$pdf->setPrintHeader(true);
		$pdf->setHeaderFont(Array('helvetica', '', 10));
		$pdf->setFooterFont(Array('helvetica', '', 10));
		$pdf->SetMargins(1, 7.5, 1);
		// set default header data

		   define('PDF_HEADER_TITLE_new', $heading);
		   define('FROM_DATE', ($from_date ? date('d-M-Y',strtotime($from_date)) : ""));
		   define('TO_DATE', ($to_date ? date('d-M-Y',strtotime($to_date)) : ""));
		   define('SEARCH_CRITERIA', $search_criteria);
	


	
		
		$pdf->AliasNbPages();
	
		$pdf->setPrintFooter(true);
		$pdf->SetFont("helvetica", "", 10);
        $params = $pdf->serializeTCPDFtagParameters(array('CODE 39', 'C39', '', '', 80, 40, 0.4, array('position' => 'S', 'border' => true, 'padding' => 4, 'fgcolor' => array(0, 0, 0), 'bgcolor' => array(255, 255, 255), 'text' => true, 'font' => 'helvetica', 'fontsize' => 8, 'stretchtext' => 4), 'N'));
		//echo $content;die;
		$pdf->AddPage();
		
		$pdf->writeHTML($content, true, 0, 0, 0);
		$pdf->Output($name, "I"); 
		
	}
	
	public static function generatelevel1Pdf($content,$name,$heading,$from_date,$to_date,$search_criteria){ 
				
		$pdf= new MYPDF('P','cm','A4',true,'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor("BARBADOS");
	    $pdf->SetTitle($name."Application Form");
	    $pdf->SetSubject($name);
	    $pdf->SetKeywords("BARBADOS, Application Form");
		$pdf->setPrintHeader(true);
		$pdf->setHeaderFont(Array('helvetica', '', 10));
		$pdf->setFooterFont(Array('helvetica', '', 10));
		$pdf->SetMargins(1, 9, 1);
		// set default header data

		   define('PDF_HEADER_TITLE_new', $heading);
		   define('FROM_DATE', ($from_date ? date('d-M-Y',strtotime($from_date)) : ""));
		   define('TO_DATE', ($to_date ? date('d-M-Y',strtotime($to_date)) : ""));
		   define('SEARCH_CRITERIA', $search_criteria);
	


	
		
		$pdf->AliasNbPages();
	
		$pdf->setPrintFooter(true);
		$pdf->SetFont("helvetica", "", 10);
        $params = $pdf->serializeTCPDFtagParameters(array('CODE 39', 'C39', '', '', 80, 40, 0.4, array('position' => 'S', 'border' => true, 'padding' => 4, 'fgcolor' => array(0, 0, 0), 'bgcolor' => array(255, 255, 255), 'text' => true, 'font' => 'helvetica', 'fontsize' => 8, 'stretchtext' => 4), 'N'));
		//echo $content;die;
		$pdf->AddPage();
		
		$pdf->writeHTML($content, true, 0, 0, 0);
		$pdf->Output($name, "I"); 
		
	}
	
	
	

}

?>
