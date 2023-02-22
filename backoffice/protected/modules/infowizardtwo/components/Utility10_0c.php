<?php
	require_once(Yii::app()->basePath.'/extensions/tcpdf/tcpdf/tcpdf.php');
	class MYPDF extends TCPDF {

	    //Page header
	   public function Header() { 	        
			$img_file = $_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/watermark_logo.png';

	         
	          $this->SetAlpha(0.09);
        	  $this->Image($img_file, 11.5, 7, NULL, NULL, '', '', '', false, 300, '', false, false, 0);
        	 $this->SetAlpha(1);
	    }

	    // Page footer
	    public function Footer() {

	    }
	}
	class Utility10_0c
	{

		
		
		public static function generateNewCafPdfApp($content,$name,$submission_id,$dept_id,$approver_profile){

			$headerArr = Yii::app()->db->createCommand("SELECT issuerby.issuerby_id,issuerby.header_content FROM bo_infowizard_issuerby_master as issuerby where issuerby_id='$dept_id'")->queryRow();
			//print_r($headerArr);die();
			$pdf= new MYPDF('L','cm','A4',true,'UTF-8', false);
			
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor("BARBADOS");
			$pdf->SetTitle($name."BARBADOS");
			$pdf->SetSubject($name);
			$pdf->SetKeywords("BARBADOS");
			
			//$pdf->setHeaderFont(Array('Cambria', '', 14));
		
			$pdf->SetMargins(1, 1, 1);
		
			//$pdf->AddPage();
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
			$pdf->AddPage();
			$pdf->writeHTML($content,  true, 0, true, 0); 

			$image_file = $_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/Logo_w.jpg';
			
			$pdf->Image($image_file, 12.6, 1.3, 3.6, 3, '', '4', 'T', false, 150, '', false, false, 0, false, false, false); 

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

		$pdf->SetXY(3, 15);
		$pdf->write2DBarcode($certi_link, 'QRCODE,H', '', '', 3, 3, $style, '');
		$pdf->SetFont("Cambria", "B", 12);
		$pdf->SetXY(3, 18);
		$pdf->Cell(13, 0, "Scan to verify",  '', 1, 'L');
			
				 $image_file2 = $_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/'.$approver_profile['signature'];
		$pdf->Image($image_file2, 13.5, 16, 3, '', '', '', 'T', false, 150, '', false, false, 0, false, false, false);
		
		if(isset($_GET['is_vpd'])){
				$pdf->SetFont('helvetica', '', 8);
				$vpdcontent='<table style="padding:10px;">
			            <tr>
			              <th bgcolor="yellow">This document is downloaded under View Public Document (VPD) service of CAIPO. In case you wish to obtain a certified true copy of the same, please apply at CAIPO separately.
			              </th>
			            </tr>			            
			          </table>'; 
			          $pdf->SetXY(1, 15);
			$pdf->writeHTML($vpdcontent,  true, 0, true, 0); 
			    
			}

			

			$pdf->lastPage();
			$pdf->Output($name, "I"); 
		}
	}

?>
