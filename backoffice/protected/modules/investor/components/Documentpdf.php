<?php
	require_once(Yii::app()->basePath.'/extensions/tcpdf/tcpdf/examples/tcpdf_includes.php');
	require_once(Yii::app()->basePath.'/extensions/tcpdf/tcpdf/tcpdf.php');
	require_once(Yii::app()->basePath.'/extensions/fpdi/src/autoload.php');
	require_once(Yii::app()->basePath.'/extensions/fpdi/src/TcpdfFpdi.php');
	

		class MYPDF extends \setasign\Fpdi\TcpdfFpdi {
			public function Footer(){
				$this->SetY(-15);   
		$data='
				        <table>
							<tr>
							  <td width="20%"> </td>
							  <td width="60%">  
							    <table style="font-size: 12; border: 1px blue solid ; border-collapse: collapse;">
							    <tr>
							    <td style="text-align:center; color:blue; ">  
							         <span style="font-size: 10;"><strong>REGISTERED  </strong></span>   <br>
							        <span style="font-size: 9 ;"><strong> CORPORATE AFFAIRS AND INTELLECTUAL PROPERTY OFFICE</strong></span>  
							    </td>
							     </tr>
							</table>
							  </td>
							  <td width="20%"> </td>
							</tr>
							 </table>
				        ';
				        $this->Cell(150, 0, $this->writeHTML($data),  '', 1, 'C');
	}
		}
	
class Documentpdf{

	

	public static function generatePdf($document){ 
		
		$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('BARBADOS');
		$pdf->setPrintFooter(true);
		$pdf->setPrintHeader(false);

		/*$pdf->AddPage();
		$pdf->write(10,$document['name']);*/
		$iuid = @$_SESSION['RESPONSE']['iuid'];

		$allowed = array('pdf','PDF', 'png','PNG','JPG','JPEG','jpeg', 'jpg');
			$filename = $document['document_file_name'];
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			if (!in_array($ext, $allowed)) {
			    throw new Exception("Error Processing Request. document error", 1);		    
		}

		if($iuid || @$_SESSION['role_id']){
			$subID = $document['sno'];
			if($iuid==NULL){
				$user =  Yii::app()->db->createCommand("SELECT u.iuid, a.user_id FROM bo_new_application_submission a 
					INNER JOIN sso_users u on u.user_id=a.user_id
					where submission_id = $subID")->queryRow();
				$iuid = $user['iuid'];
			}
			// header stamp
				     
					$submissiondaterecord =  Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_application_log where app_Sub_id = $subID and action_status='P' order BY id DESC")->queryRow();
					$sdate = date('Y/m/d',strtotime($submissiondaterecord['created']));

				     
					
					$app_log = Yii::app()->db->createCommand("SELECT * FROM bo_infowiz_form_builder_application_log where app_Sub_id = $subID and action_status='A'")->queryRow();
					//print_r($app_log); die();
					$auid = $app_log['department_user_id'];
					$sig_d = Yii::app()->db->createCommand("SELECT * FROM tbl_bo_signature_detail where userid = $auid and isactive=1")->queryRow();
					$image_file2 = $_SERVER['DOCUMENT_ROOT'].Yii::app()->theme->baseUrl.'/img/'.$sig_d['signature'];

					
			        // end header stamp
			$path = Yii::app()->basePath . "/../../themes/backend/mydoc/$iuid/".$document['document_file_name'];
			if($ext=='pdf' || $ext=='PDF'){
				$pages = $pdf->setSourceFile($path);
				for($i=0; $i<$pages; $i++)
					{
				     $pdf->AddPage();
				     $data='<table  style="border: 1px blue solid ; border-collapse: collapse; padding: 0px;">
					    <tr>
						    <td style="color:blue; text-align:center;">  
						         <span style="font-size: 11;"><strong>REGISTERED  </strong></span>   
						    </td>
					    </tr>
				         <tr>
				            <td style="color:blue;">
						         <span style="font-size: 9;"><strong>SIGNATURE  </strong></span>   
						      </td>
					    </tr>
					     <tr>
				            <td style="color:blue;">
						          <span style="font-size: 9; "><strong>DATE  </strong><span style="color:black;">'.$sdate.' </span></span>   
						          </td>
					    </tr>
					      <tr>
				            <td style="color:blue; text-align:center">
						        <span style="font-size: 7;"><strong> CORPORATE AFFAIRS AND </strong></span><br>
						        <span style="font-size: 7;"><strong> INTELLECTUAL PROPERTY OFFICE</strong></span>  
						    </td>
					     </tr>
					</table>';
					$pdf->Image($image_file2, 173, 16, 25, '', '', '', 'T', false, 150, '', false, false, 0, false, false, false);
			         
					$pdf->SetXY(150, 10);
			        $pdf->Cell(40, 0, $pdf->writeHTML($data),  '', 1, 'R');
				     $tplIdx = $pdf->importPage($i+1);
		   			 $pdf->useTemplate($tplIdx, 10, 10, 200);
				    
				}
			}else{
				$pdf->AddPage();
				  $data='<table  style="border: 1px blue solid ; border-collapse: collapse; padding: 0px;">
					    <tr>
						    <td style="color:blue; text-align:center;">  
						         <span style="font-size: 11;"><strong>REGISTERED  </strong></span>   
						    </td>
					    </tr>
				         <tr>
				            <td style="color:blue;">
						         <span style="font-size: 9;"><strong>SIGNATURE  </strong></span>   
						      </td>
					    </tr>
					     <tr>
				            <td style="color:blue;">
						          <span style="font-size: 9; "><strong>DATE  </strong><span style="color:black;">'.$sdate.' </span></span>   
						          </td>
					    </tr>
					      <tr>
				            <td style="color:blue; text-align:center">
						        <span style="font-size: 7;"><strong> CORPORATE AFFAIRS AND </strong></span><br>
						        <span style="font-size: 7;"><strong> INTELLECTUAL PROPERTY OFFICE</strong></span>  
						    </td>
					     </tr>
					</table>';
					$pdf->Image($image_file2, 173, 16, 25, '', '', '', 'T', false, 150, '', false, false, 0, false, false, false);
			         
					$pdf->SetXY(150, 10);
			        $pdf->Cell(40, 0, $pdf->writeHTML($data),  '', 1, 'R');
		 		    $pdf->Image($path, 10, 50, 190, '', '', '', 'T', false, 150, '', false, false, 0, false, false, false);
			}			
				//	$path = Yii::app()->basePath . "/../../themes/backend/mydoc/$iuid/75722846_UK-DCL-13_V1.8.png";
		}else{
			die('Access Denied');
		}
		


	


		$pdf->Output('Approved_'.$document['name'].'.pdf', 'I');
		
	}
	
	

}

?>
