<?php
	require_once(Yii::app()->basePath.'/extensions/tcpdf/tcpdf/tcpdf.php');
	class MYPDF extends TCPDF {

	    //Page header
	   public function Header() { 	        
			
	     
	        
	    }

	 
	    public function Footer() {

	    }
	}
	class Utility6_0c
	{

		
		
		public static function generateNewCafPdfApp($content,$name,$submission_id,$dept_id,$content_letter){

			$headerArr = Yii::app()->db->createCommand("SELECT issuerby.issuerby_id,issuerby.header_content FROM bo_infowizard_issuerby_master as issuerby where issuerby_id='$dept_id'")->queryRow();
			//print_r($headerArr);die();
			$pdf= new MYPDF('L','cm','A4',true,'UTF-8', false);
			
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor("BARBADOS");
			$pdf->SetTitle($name."BARBADOS");
			$pdf->SetSubject($name);
			$pdf->SetKeywords("BARBADOS");
			
			$pdf->setHeaderFont(Array('Cambria', '', 14));
		
			$pdf->SetMargins(1, 1, 1);
			//echo $headerArr['header_content'];die("asdsad");
			$pdf->SetHeaderData($ln='', $lw=0, $ht='', $hs=$headerArr['header_content'], $tc=array(0,10,0), $lc=array(0,0,0)); 
			//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 018', PDF_HEADER_STRING);
			//$pdf->setHeader(true);
			
			$pdf->setPrintFooter(true);
			
			$pdf->AliasNbPages();
			//$pdf->AddPage();
			// set some language dependent data:
			
			$lg = Array();
			$lg['a_meta_charset'] = 'UTF-8';
			$lg['a_meta_dir'] = 'ltr';
			$lg['a_meta_language'] = 'hi';
			$lg['w_page'] = 'page'; 

			// set some language-dependent strings (optional)
			$pdf->setLanguageArray($lg);
			$pdf->SetFont("Cambria", "", 13);
			//echo $content;die;
			$pdf->AddPage();

 $image_file2 = $_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/caipo_logo.png';
			$pdf->Image($image_file2, 13.5, 0.6, 3, '2.8', '', '4', 'T', false, 150, '6', false, false, 0, false, false, false); 

			/* $image_file2 = $_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/doi.png';
			$pdf->Image($image_file2, 14, 0.6, 1.8, '', '', '', 'T', false, 150, '', false, false, 0, false, false, false);*/

		 	$pdf->Ln();

		 	$pdf->SetXY(1,4);

			$pdf->writeHTML($content,  true, 0, true, 0); 
			$style = array(
		    'border' => true,
		    'vpadding' => 'auto',
		    'hpadding' => 'auto',
		    'fgcolor' => array(0,0,0),
		    'bgcolor' => false, //array(255,255,255)
		    'module_width' => 1, // width of a single module in points
		    'module_height' => 1 // height of a single module in points
			);
			  	if($submission_id){
			  		$certi_link = BASE_URL.'/backoffice/protected/caipo_certificate/CERTIFICATE_' . $submission_id . '.pdf';
			  	}else{
			  		$certi_link = BASE_URL.'/';
			  	}

		$pdf->SetXY(1, 15);
		$pdf->write2DBarcode($certi_link, 'QRCODE,H', '', '', 3, 3, $style, '');
		$pdf->SetFont("Cambria", "B", 12);
		$pdf->SetXY(1, 18);
		$pdf->Cell(13, 0, "Scan to verify",  '', 1, 'L');

		 $sign_image = $_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/trs.png';
		$pdf->Image($sign_image, 13, 15, 3, '', '', '', 'T', false, 150, '', false, false, 0, false, false, false);	
			
		$pdf->AddPage();
		$pdf->SetFont("Cambria", "", 13);
		 $image_file3 = $_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/mbwb.png';

			$pdf->Image($image_file2, 1, 0.7, 2.5, '3', '', '4', 'T', false, 150, '', false, false, 0, false, false, false);

			$pdf->Image($image_file3, 26, 0.8, 3, '', '', '', 'T', false, 150, '', false, false, 0, false, false, false);
				$pdf->SetXY(1,.5);

				$pdf->writeHTML('<table style="width:100%; text-align:center;"><tr><td style="font-size:20pt;">Corporate Affairs and Intellectual Property Office</td></tr><tr><td>Ground Floor, BAOBAB Tower, Warrens St. Michael, Barbados </td></tr><tr><td>Tel:  (246) 535-2401    Fax:  (246) 535-2444</td></tr><tr><td>Internet: http://www.caipo.gov.bb</td></tr><tr><td>Email :general@caipo.gov.bb</td></tr></table>', true, 0, 0, 0);

			

		$pdf->writeHTML($content_letter, true, 0, 0, 0);
		$pdf->Image($sign_image, 13, 15.5, 3, '', '', '', 'T', false, 150, '', false, false, 0, false, false, false);	

			$pdf->Output($name, "I"); 
		}
	}

?>
