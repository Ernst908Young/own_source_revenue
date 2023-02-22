<?php
	require_once(Yii::app()->basePath.'/extensions/tcpdf/tcpdf/tcpdf.php');
	class MYPDF extends TCPDF {

	    //Page header
	   public function Header() { 	        
			$headerData = $this->getHeaderData();
			$this->SetFont('freesans','',10);			
			$this->Cell(0, 15,$this->writeHTML($headerData['string']),  0, false, 'C', 0, '', 0, false, 'M', 'M');
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
						  <th colspan="1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Printed By: '.$uname.'</th colspan="2"><th>Certificate Generated DateTime:'.date('Y-m-d H:i:s').'</th><th>  Page Number:'.$this->getAliasNumPage().'/'.$this->getAliasNbPages().' </th>
						</tr>
					  </table>';
	         

	        // Page number
	        $this->Cell(0, 0, $this->writeHTML($data),  '', 1, 'R');

	    }
	}
	class Utility2_0
	{

		public static function generatePdfApp($content,$name)
		{ 				
			$pdf= new MYPDF('P','cm','A4',true,'UTF-8', false);
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor("BARBADOS");
			$pdf->SetTitle($name."Application Form");
			$pdf->SetSubject($name);
			$pdf->SetKeywords("BARBADOS, Application Form");
			$pdf->setPrintHeader(true);
			$pdf->setHeaderFont(Array('helvetica', '', 10));
			$pdf->setFooterFont(Array('helvetica', '', 10));
			$pdf->SetMargins(2, 2.6, 1);
			// set default header data

			
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
		
		public static function generateNewCafPdfApp($content,$name,$dept_id){

			$headerArr = Yii::app()->db->createCommand("SELECT issuerby.issuerby_id,issuerby.header_content FROM bo_infowizard_issuerby_master as issuerby where issuerby_id='$dept_id'")->queryRow();
			//print_r($headerArr);die();
			$pdf= new MYPDF('L','cm','A4',true,'UTF-8', false);
			
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor("BARBADOS");
			$pdf->SetTitle($name."BARBADOS");
			$pdf->SetSubject($name);
			$pdf->SetKeywords("BARBADOS");
			
			$pdf->setHeaderFont(Array('Cambria', '', 14));
			$pdf->setFooterFont(Array('Cambria', '', 10));
			$pdf->SetMargins(1, 4, 1);
			//echo $headerArr['header_content'];die("asdsad");
			$pdf->SetHeaderData($ln='', $lw=0, $ht='', $hs=$headerArr['header_content'], $tc=array(0,10,0), $lc=array(0,0,0)); 
			//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 018', PDF_HEADER_STRING);
			//$pdf->setHeader(true);
			
			$pdf->setPrintFooter(true);
			
			$pdf->AliasNbPages();
			$pdf->AddPage();
			// set some language dependent data:
			
			$lg = Array();
			$lg['a_meta_charset'] = 'UTF-8';
			$lg['a_meta_dir'] = 'ltr';
			$lg['a_meta_language'] = 'hi';
			$lg['w_page'] = 'page'; 

			// set some language-dependent strings (optional)
			$pdf->setLanguageArray($lg);
			
			$pdf->SetFont("Cambria", "", 12);
			//echo $content;die;
			$pdf->writeHTML($content,  true, 0, true, 0); 
			$pdf->lastPage();
			$pdf->Output($name, "I"); 
		}
	}

?>
