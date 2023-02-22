<?php
	require_once(Yii::app()->basePath.'/extensions/tcpdf/tcpdf/tcpdf.php');
	
	class MYPDF extends TCPDF {

	    //Page header
	    public function Header() {
	        // Logo
	        $line_width = (0.85 / $this->k);
	        $logo_url = PDF_HEADER_LOGO;
	        $sub_heading1 =PDF_HEADER_STRING1;	
	        $title_heading = PDF_HEADER_TITLE_CAF;
	        $sub_heading2 =PDF_HEADER_STRING2;        
	        $this->SetLineStyle(array('width' => $line_width, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => '#000'));

	      
			//echo base64_decode($_GET['service_id']);die;
			$subID = $_GET['subID'];
			$connection = Yii::app()->db;
			$sql = "SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(bo_new_application_submission.field_value,'\"UK-FCL-00044_0\":\"',-1),'\",',1) as application_for from  bo_new_application_submission where submission_id='$subID'";
			$command = $connection->createCommand($sql);
			$data=$command->queryRow();
			
		    if(isset($_GET['service_id']) && $_GET['service_id']=='2.0' && $data['application_for']==1)
			{
			
				$data =  "<br><span style='font-weight:900;font-size:1.0em;'>SOCIETIES WITH RESTRICTED LIABILITY ACT OF BARBADOS<br><br>
				<b>REQUEST FOR NAME SEARCH AND NAME RESERVATION</b></span>";
				$formName="FORM 15";
			}
		    else if(isset($_GET['service_id']) && $_GET['service_id']=='2.0' && $data['application_for']==2)
			{
			
				$data =  "<br><span style='font-weight:900;font-size:1.0em;'>COMPANIES ACT OF BARBADOS<br><br>
				<b>REQUEST FOR NAME SEARCH AND NAME RESERVATION</b></span>";
				$formName="FORM 33";
			}else if(isset($_GET['service_id']) && $_GET['service_id']=='2.0' && $data['application_for']==3)
			{
			
				$data =  "<br><span style='font-weight:900;font-size:1.0em;'>REGISTRATION OF BUSINESS NAME ACT CHAPTER 317<br>
				<b>FORM 1</b><br><b>FORM OF APPLICATION FOR REGISTRATION </b></span>";
				$formName="";
			}
			$image_file = $_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/doi.png';
	        $this->SetFont('times', '', 11);
			$data='<br><br>
				<table width="90%">
				<tr>
					<td style="font-weight:600;font-size:1.2em;text-align:right;" colspan="3">&nbsp;</td>
				</tr>	
				<tr>
					<td style="text-align:left;" width="15%"></td>
					<td style="text-align:center;" align="center" width="70%">
					<img src="'. $image_file.'" height="60px" width="60px">
					'.$data.'
					</td>
					<td style="font-weight:600;font-size:0.9em;text-align:right;"  width="15%">'.$formName.'</td>
				</tr>
				</table><br>';			
	        
			$this->Cell(0, 0, $this->writeHTML($data),  '', 1, 'R');	     
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

	public static function generatePdfApp($content,$name){ 
				
		$pdf= new MYPDF('L','cm','A4',true,'UTF-8', false);
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor("BARBADOS");
	    $pdf->SetTitle($name."Application Form");
	    $pdf->SetSubject($name);
	    $pdf->SetKeywords("BARBADOS, Application Form");
		$pdf->setPrintHeader(true);
		$pdf->setHeaderFont(Array('helvetica', '', 10));
		$pdf->setFooterFont(Array('helvetica', '', 10));
		$pdf->SetMargins(0.5,4.9, 0.5);
				 
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);		
		$pdf->setPrintFooter(true);
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->SetFont("helvetica", "", 8);
        $params = $pdf->serializeTCPDFtagParameters(array('CODE 39', 'C39', '', '', 80, 40, 0.4, array('position' => 'S', 'border' => true, 'padding' => 4, 'fgcolor' => array(0, 0, 0), 'bgcolor' => array(255, 255, 255), 'text' => true, 'font' => 'helvetica', 'fontsize' => 8, 'stretchtext' => 4), 'N'));
		
		$pdf->writeHTML($content, true, 0, 0, 0);
		$pdf->lastPage();
		$pdf->Output($name, "I"); 
		
	}
	
	
	

}

?>
