<?php
require_once(Yii::app()->basePath.'/extensions/mpdf6/mpdf.php');
class MYPDF extends MPDF {

}
class ReportTcpdfUtility1{

	public static function generatePdfApp($content,$name){ 
            date_default_timezone_set('Asia/Calcutta'); 
		$pdf= new MYPDF('c','A4-L','','','25','18','35','18');		
		$logo_url = 'logo.png';
		$sub_heading1 =PDF_HEADER_STRING1;	
		$title_heading = PDF_HEADER_TITLE_CAF;
		$sub_heading2 =PDF_HEADER_STRING2; 
		$image_file = $_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/'.$logo_url; 
		$image_file2 = getcwd() . '/themes/investuk/images/destination_logo_mou.png';
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
				<td width="64%" align="center"><span style="font-size:22pt;">'.$title_heading.'</span><br><span style="font-size:15pt;">'.$sub_heading1.'</span></td>
				<td width="18%" style="text-align: right;"><img style="width:90px;height:85px;" src="'.$image_file2.'" /></td>
				</tr>
				</table><br><br><br>';
		$footer='<hr /><table width="100%">
					<tr>
					<td width="33%">Printed By: '.$uname.'</td>
					<td width="33%" align="center">Printed On : '.date('d-m-Y H:i:s').'</td>
					<td width="33%" style="text-align: right;">  Page {PAGENO} of {nbpg}</td>
					</tr>
				</table>';		
		$pdf->SetHTMLHeader($header);
		$pdf->SetHTMLFooter($footer);
		$pdf->Ln(); 
		$pdf->Ln();
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor("SWCS Uttarakhand");
	    $pdf->SetTitle($name);
	    $pdf->SetSubject($name);
	    $pdf->SetKeywords("SWCS, Application Form");
		$pdf->SetDisplayMode('fullpage');
		$pdf->list_indent_first_level =0;	// 1 or 0 - whether to indent the first level of a list
		$pdf->AddPage('L', 'A4');
		/* $pdf->WriteHTML('<h2>Index</h2>',2);
		$pdf->InsertIndex(); */
		
              //  $pdf->use_kwt = true;
		/* echo "<pre>";	  
		print_r($_SERVER);die;	 */	
		$host = $_SERVER['HTTP_HOST'];
		$stylesheet = file_get_contents("http://$host/backoffice/css/report.css");
		$pdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
		$pdf->WriteHTML($content, 2,true,false);
		//$pdf->lastPage();
		$pdf->Output($name, "I");  
		
		
	}
	
	public static function generatePdfApp2($content,$name){ 
            date_default_timezone_set('Asia/Calcutta'); 
		//$pdf= new MYPDF('c','A4-L','','','15','15','35','18');
		$pdf= new MYPDF('c','A4-L','','','25','18','35','18');
			
		$logo_url = 'logo.png';
		$sub_heading1 =PDF_HEADER_STRING1;	
		$title_heading = PDF_HEADER_TITLE_CAF;
		$sub_heading2 =PDF_HEADER_STRING2; 
		$image_file = $_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/'.$logo_url; 
		$image_file2 = getcwd() . '/themes/investuk/images/destination_logo_mou.png';
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
				<td width="64%" align="center"><span style="font-size:14pt;">'.$title_heading.'</span><br>'.$sub_heading1.'</td>
				<td width="18%" style="text-align: right;"><img style="width:90px;height:85px;" src="'.$image_file2.'" /></td>
				</tr>
				</table>';
		$footer='<hr /><table width="100%">
					<tr>
					<td width="33%">Printed By: '.$uname.'</td>
					<td width="33%" align="center">Printed On : '.date('d-m-Y H:i:s').'</td>
					<td width="33%" style="text-align: right;">  Page {PAGENO} of {nbpg}</td>
					</tr>
				</table>';	
		
		$pdf->SetHTMLHeader($header);
		$pdf->SetHTMLFooter($footer);
		$pdf->Ln(); 
		$pdf->Ln();
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor("SWCS Uttarakhand");
	    $pdf->SetTitle($name);
	    $pdf->SetSubject($name);
	    $pdf->SetKeywords("SWCS, Application Form");
		$pdf->SetDisplayMode('fullpage');
		//$pdf->shrink_tables_to_fit =0;
		//$pdf->ignore_table_width = true;
		//$pdf->list_indent_first_level =0;	// 1 or 0 - whether to indent the first level of a list
		$pdf->AddPage('L', 'A4');
		$host = $_SERVER['HTTP_HOST'];
		$stylesheet = file_get_contents("http://$host/backoffice/css/report1.css");
		$pdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
		
		$pdf->WriteHTML($content, 2,true,false);
		//$pdf->lastPage();
		$pdf->Output($name, "I");  
	}
	
	public static function generatePdfAppHindi($content,$name){ 
            date_default_timezone_set('Asia/Calcutta'); 
		$pdf= new MYPDF('c','A4-L','','','25','18','35','18');		
		$logo_url = 'logo.png';
		$sub_heading1 =PDF_HEADER_STRING1;	
		$title_heading = PDF_HEADER_TITLE_CAF;
		$sub_heading2 =PDF_HEADER_STRING2; 
		$image_file = $_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/'.$logo_url; 
		$image_file2 = getcwd() . '/themes/investuk/images/destination_logo_mou.png';
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
				<td width="64%" align="center"><span style="font-size:22pt;">'.$title_heading.'</span><br><span style="font-size:15pt;">'.$sub_heading1.'</span></td>
				<td width="18%" style="text-align: right;"><img style="width:90px;height:85px;" src="'.$image_file2.'" /></td>
				</tr>
				</table><br><br><br>';
		$footer='<hr /><table width="100%">
					<tr>
					<td width="33%">Printed By: '.$uname.'</td>
					<td width="33%" align="center">Printed On : '.date('d-m-Y H:i:s').'</td>
					<td width="33%" style="text-align: right;">  Page {PAGENO} of {nbpg}</td>
					</tr>
				</table>';		
		$pdf->SetHTMLHeader($header);
		$pdf->SetHTMLFooter($footer);
		$pdf->Ln(); 
		$pdf->Ln();
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor("SWCS Uttarakhand");
	    $pdf->SetTitle($name);
	    $pdf->SetSubject($name);
	    $pdf->SetKeywords("SWCS, Application Form");
		$pdf->SetDisplayMode('fullpage');
		$pdf->list_indent_first_level =0;	// 1 or 0 - whether to indent the first level of a list
		$pdf->AddPage('L', 'A4');
              //  $pdf->use_kwt = true;
		/* echo "<pre>";	  
		print_r($_SERVER);die;	 */	
		$host = $_SERVER['HTTP_HOST'];
		$stylesheet = file_get_contents("http://$host/backoffice/css/report.css");
		$pdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
		$pdf->WriteHTML($content, 2,true,false);
		//$pdf->lastPage();
		$pdf->Output($name, "I");  
	}
	
	
}

?>
