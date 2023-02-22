<?php
	require_once(Yii::app()->basePath.'/extensions/tcpdf/tcpdf/tcpdf.php');
	class MYPDF extends TCPDF {

	    //Page header
	   public function Header() { 	        
			// $line_width = (0.85 / $this->k);
	       /*  $logo_url = PDF_HEADER_LOGO;
	        $sub_heading1 =PDF_HEADER_STRING1;	
	        $title_heading = PDF_HEADER_TITLE_CAF;
	        $sub_heading2 =PDF_HEADER_STRING2;        
	     
	     
	         $image_file2 = $_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/caipo_logo.png';
			$this->Image($image_file2, 13.5, 0.6, 3, '2.8', '', '4', 'T', false, 150, '6', false, false, 0, false, false, false); 

//Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')

			if($this->page == 1){
				$this->Cell(0, 0, 'Form 10', 0, 1, 'R', 0, '', 0);
			}

			

	        
	        $this->Ln(); */
	    }

	    // Page footer
	    public function Footer() {

	    }
	}
	class Utility42_0c
	{

		
		
		public static function generateNewCafPdfApp($content,$name,$submission_id,$dept_id,$approver_profile,$type=null){
			
			//echo $content;die;

			$headerArr = Yii::app()->db->createCommand("SELECT issuerby.issuerby_id,issuerby.header_content FROM bo_infowizard_issuerby_master as issuerby where issuerby_id='$dept_id'")->queryRow();
			//print_r($headerArr);die();
			$pdf= new MYPDF('P','cm','A4',true,'UTF-8', false);
			
			$pdf->SetCreator(PDF_CREATOR);
			$pdf->SetAuthor("BARBADOS");
			$pdf->SetTitle($name."BARBADOS");
			$pdf->SetSubject($name);
			$pdf->SetKeywords("BARBADOS");
			
		//	$pdf->setHeaderFont(Array('Cambria', '', 14));
			
			$pdf->SetMargins(1, 1, 1, true);
			//echo $headerArr['header_content'];die("asdsad");
			//$pdf->SetHeaderData($ln='', $lw=0, $ht='', $hs=$headerArr['header_content'], $tc=array(0,10,0), $lc=array(0,0,0)); 
			//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 018', PDF_HEADER_STRING);
			//$pdf->setHeader(true);
			
		//	$pdf->setPrintFooter(true);
			
		//	$pdf->AliasNbPages();
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
			//$image_file2 = $_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/caipo_logo.png';
			$image_file2 = $_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/Logo_w.jpg';
			
			$pdf->Image($image_file2, 8.3, 2, 4, 3.4, '', '4', 'T', false, 150, '', false, false, 0, false, false, false); 
			$pdf->Ln();
			//$pdf->Image($image_file2, 25, 14.5, 3, '', '', '', 'T', false, 150, '', false, false, 0, false, false, false);	

			
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
				
				$certi_link = BASE_URL."/backoffice/protected/caipo_certificate/CERTIFICATE_" . $submission_id . ".pdf";
			}else{
				$certi_link = BASE_URL.'/';
			}

			$pdf->SetXY(3, 20);
			$pdf->write2DBarcode($certi_link, 'QRCODE,H', '', '', 3, 3, $style, '');
			$pdf->SetFont("Cambria", "B", 12);
			$pdf->SetXY(3, 23);
			$pdf->Cell(13, 0, "Scan to verify",  '', 1, 'L');
			
			$image_file2 = $_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/'.$approver_profile['signature'];
			if($type=='revoke'){
				$pdf->Image($image_file2, 25, 14.5, 3, '', '', '', 'T', false, 150, '', false, false, 0, false, false, false);	
			}else if($type=='external'){
				$pdf->Image($image_file2, 13, 14, 3, '', '', '', 'T', false, 150, '', false, false, 0, false, false, false);	
			}else{
				$pdf->Image($image_file2, 16, 20.5, 3.5, '', '', '', 'T', false, 150, '', false, false, 0, false, false, false);
			}


			if(isset($_GET['is_vpd'])){
						$pdf->SetFont('helvetica', '', 8);
						$vpdcontent='<table style="padding:10px;">
					            <tr>
					              <th bgcolor="yellow">This document is downloaded under View Public Document (VPD) service of CAIPO. In case you wish to obtain a certified true copy of the same, please apply at CAIPO separately.
					              </th>
					            </tr>			            
					          </table>'; 
					    $pdf->SetXY(1, 24);
					    $pdf->writeHTML($vpdcontent,  true, 0, true, 0);
					    
					}


			$pdf->lastPage();
			$pdf->SetLineStyle( array('width'=>0.40,'color'=> array(0,0,0)));
			$pdf->Output($name, "I"); 
		}
	}

?>
