<?php

class ServiceMasterController extends Controller
{
	public function actionIndex()

	{
		
		$this->render('index');
	}
	
    
    /**
	* 15-10-2017
    * @author: Santosh Kumar
    * @return:
    * @param:
    **/
	public function actionListing($issuer_by=2){
	@session_start();	 
            /* 
		if(!Yii::app()->user->isGuest){
			throw new CHttpException(400, "you can't access this page");
		}
		if(!$_SESSION['LOGGED_IN'])
			$this->redirect(SSO_URL1);
		
		*/
		
		$sql = "SELECT * FROM bo_infowizard_issuerby_master as ibm
				INNER JOIN bo_information_wizard_service_master ON sm.issuerby_id=ibm.issuerby_id
				INNER JOIN bo_information_wizard_service_parameters ON 
		";
		$service_id=6;
		$sql="SELECT * FROM bo_information_wizard_service_parameters WHERE service_id='$service_id'";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$res = $command->queryAll();
		$this->render("service_listing",array('datas'=>$res));
	}
	
	/**
	* 15-10-2017
    * @author: Santosh Kumar
    * @return:
    * @param:
    **/
	
	public function actionRedirectToApplicationWithCaf(){
		@session_start();
		// echo $application;die;
		if(isset($_SESSION['RESPONSE']) && !empty($_SESSION['RESPONSE'])){
		$data=array();
		extract($_POST['PrevCaf']);
		if(isset($_POST['PrevCaf'])){
			    $pre_filed=$_SESSION['RESPONSE'];
				$criteria=new CDbCriteria;
				$criteria->condition="submission_id=:CafID";
				$criteria->params=array(":CafID"=>$CafID);
				$prevCaf=ApplicationSubmission::model()->find($criteria);
				if(!empty($prevCaf)){
					$data['CAFFieldStatus']=200;
					$data['CAFFields']=$prevCaf->field_value;
				}
				else{
					$data['CAFFieldStatus']=204;
					$data['CAFFields']="";
				}

		}
		$data['CALL_BACK_URL']=$CALL_BACK_URL;
		$data['callback_failure_url']=$CALL_BACK_URL;
		$data['callback_success_url']=$CALL_BACK_URL;
		$data['service_name']=$service_name;
		$data['service_id']=$service_id;
		$data['caf_application_id']=$CafID;
		$data['token']=$_SESSION['RESPONSE']['token'];
		$data['status_code']="200";
		$data['message']="SUCCESS";
		$data['Profiles']=$_SESSION['RESPONSE'];
		$data['Profiles']['full_name']=$_SESSION['RESPONSE']['first_name']." ".$_SESSION['RESPONSE']['last_name'];
		/// added here departrmetn
		$data['department_name']=$service_provider;

		$data['Users']=$_SESSION['RESPONSE'];
		$data['href']=$href=TOKEN_API_BASEURL."/apiv1/gettokeninfo/token/".$_SESSION['RESPONSE']['token'];
		if($service_provider=='Pollution'){
			// die("I am her");
			$this->render('redirectPollution',$data);
			exit;
		}
		// echo "<pre>";print_r($data);die;
		$this->render('redirect',$data);
		exit;
		}
		
	}
	
	public function actionGetRequiredDocuments(){
		extract($_REQUEST);
		echo $service_id.$sub_service_id;die;
		$sql_d = "SELECT * FROM bo_information_wizard_service_parameters WHERE service_id='$service_id' AND servicetype_additionalsubservice='$sub_service_id' ORDER BY service_id ASC LIMIT 1";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql_d);
		$res_s = $command->queryRow();
		//echo '<pre>'; print_r($res_s);
		$document_checklist_creation = $res_s['document_checklist_creation'];
		$mapped_documents_array = json_decode($document_checklist_creation,true);
		//echo '<pre>'; print_r($mapped_documents_array); die;
		if(count($mapped_documents_array)>0){
			$table_html ='<table class="table table-bordered table-lg mt-lg mb-0" width="100%"><thead><tr><th width="2%">S.No</th><th width="10%">Document Code</th><th width="15%">Document Type</th><th width="10%">Issued By</th><th width="20%">Document Name</th><th width="2%">Is Required</th><th width="10%">Comment</th></tr></thead>';
			foreach($mapped_documents_array as $key=>$mapped_documents_array_data){
				$doc_datas = $this->getDocumentsDataByID($mapped_documents_array_data['doc_id']);
				$table_html .='<tr><td>'.($key+1).'</td><td>'.$doc_datas['chklist_id'].'</td><td>'.$doc_datas['document_type'].'</td><td>'.$doc_datas['issuerby_name'].'</td><td>'.$doc_datas['document_name'].'</td><td>'.$mapped_documents_array_data['is_required'].'</td><td>'.$mapped_documents_array_data['doc_comment'].'</td></tr>
				<tr>
					<td>--</td>
					<td>hhhh</td>
					<td>hhhh</td>
					<td>hhhh</td>
					<td>hhhh</td>
					<td>hhhh</td>
					<td>hhhh</td>
				</tr>
				';
			}
			echo $table_html .='</table>';
		}else{
			echo "No documents mapped with current service.";
		}
	}
	
	function getDocumentsDataByID($doc_id){
		$sql = "SELECT dc.docchk_id,dc.chklist_id,dtm.name as document_type,im.name as issuer_name,ibm.name as issuerby_name,dc.name as document_name
				FROM bo_infowizard_documentchklist as dc 
				INNER JOIN bo_infowizard_docunenttype_master as dtm ON dtm.doc_id=dc.doc_id
				INNER JOIN bo_infowizard_issuer_mapping as imap ON imap.issmap_id=dc.issmap_id
				INNER JOIN bo_infowizard_issuer_master as im ON im.issuer_id=imap.issuer_id
				INNER JOIN bo_infowizard_issuerby_master as ibm ON ibm.issuerby_id=imap.issuerby_id
				WHERE docchk_id='$doc_id' LIMIT 1";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$res = $command->queryRow();
		return $res;
		
	}
	
	public function actionDocumentCheckList(){
		extract($_POST);
		//echo $service_id.$sub_service_id;
		$sql_d = "SELECT * FROM bo_information_wizard_service_parameters WHERE service_id='$service_id' AND servicetype_additionalsubservice='$sub_service_id' ORDER BY service_id ASC LIMIT 1";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql_d);
		$res_s = $command->queryRow();
		//echo '<pre>'; print_r($res_s);
		$document_checklist_creation = $res_s['document_checklist_creation'];
		$mapped_documents_array = json_decode($document_checklist_creation,true);
		$this->render('docchklist',array('mapped_documents_array'=>$mapped_documents_array));
		
		//echo '<pre>'; print_r($mapped_documents_array); die;
		if(count($mapped_documents_array)>0){
			$table_html ='<table class="table table-bordered table-lg mt-lg mb-0" width="100%"><thead><tr><th width="2%">S.No</th><th width="10%">Document Code</th><th width="15%">Document Type</th><th width="10%">Issued By</th><th width="20%">Document Name</th><th width="2%">Is Required</th><th width="10%">Comment</th></tr></thead>';
			foreach($mapped_documents_array as $key=>$mapped_documents_array_data){
				$doc_datas = $this->getDocumentsDataByID($mapped_documents_array_data['doc_id']);
				$table_html .='<tr><td>'.($key+1).'</td><td>'.$doc_datas['chklist_id'].'</td><td>'.$doc_datas['document_type'].'</td><td>'.$doc_datas['issuerby_name'].'</td><td>'.$doc_datas['document_name'].'</td><td>'.$mapped_documents_array_data['is_required'].'</td><td>'.$mapped_documents_array_data['doc_comment'].'</td></tr>
				
				';
			}
			echo $table_html .='</table>';
		}else{
			echo "No documents mapped with current service.";
		}
	}
	
	function actionGetTimelines(){
		extract($_POST);
		//echo $service_id.$sub_service_id;
		$sql = "SELECT * FROM bo_infowizard_service_timeline WHERE service_id='$service_id' AND servicetype_additionalsubservice='$sub_service_id' ORDER BY id DESC LIMIT 1 ";
		$connection=Yii::app()->db; 
		$command=$connection->createCommand($sql);
		$res = $command->queryRow();
		//echo '<pre>'; print_r($res); die;
		
		if(count($res)<=0){
			echo "There is no timelines exist for this service.";
		}
		
		$exclude_array = array('id','service_id','service_type','servicetype_additionalsubservice','comment','created','modified');
		$data_array_value = array(
								'deemed_approval'=>'Is there provision for Deemed Approval',
								'yes_deemed'=>'',
								'gov_act_first_appellate'=>'',
								'gov_act_first'=>'',
								'gov_act_second_appellate'=>'',
								'gov_act_second'=>'',
								'uksw_act_first_appellate'=>'',
								'uksw_act_first'=>'',
								'uksw_act_second_appellate'=>'',
								'uksw_act_second'=>'',
								'ukrts_act_first_appellate'=>'',
								'yes_deemed'=>'',
								'yes_deemed'=>'',
								'yes_deemed'=>'',
								'yes_deemed'=>'',
								'yes_deemed'=>'',
								'yes_deemed'=>'',
								
								);
		
		foreach($res as $key=>$value){
			//$arr = json_decode($value);
			//echo '';
			if(!in_array($key,$exclude_array)){
				//echo $key."--->".implode(",",json_decode($value,true))."<hr>";
			}
		}
		?>
		<table class="table table-bordered table-lg mt-lg mb-0" width="100%" style="display:;">
			<tr>
				<th  width="10%">S.No</th>
				<th width="50%">Particulars</th>
				<th  width="40%">Particular Details</th>
			</tr>
			<tr>
				<td>1</td>
				<td>Is there provision for Deemed Approval</td>
				<td>
				<?php echo $res['deemed_approval']; ?>
				</td>
			</tr>
			<tr>
				<td>2</td>
				<td>If Yes, Then input Details for Deemed Approval</td>
				<td>
				<?php echo $res['yes_deemed']; ?>
				</td>
			</tr>
			<tr>
				<td>3</td>
				<td>Timeline for the Service In the Governing ACT</td>
				<td><?php $arr = json_decode($res['gov_act'],true); 
							//echo '<pre>'; print_r(json_decode($res['gov_act'],true));  die;
							if(count($arr)>0){
								foreach($arr as $arr_key=>$arr_value){
									if($arr_value['gov_act_dh_no']>0)
									echo $arr_value['gov_act_dh_no']." ".$arr_value['gov_act_dh']." (".$arr_value['gov_act_condition'].")<br>";
								}
							}
						?></td>
			</tr>
			<tr>
				<td>4</td>
				<td>Prevalent Timeline for the Service as per GO / Notification</td>
				<td>
				<?php $arr = json_decode($res['go_notification'],true);
				//echo '<pre>'; print_r(json_decode($res['go_notification'],true));  die;
							if(count($arr)>0){
								foreach($arr as $arr_key=>$arr_value){
									if($arr_value['go_notification_dh_no']>0)
									echo $arr_value['go_notification_dh_no']." ".$arr_value['go_notification_dh']." (".$arr_value['go_notification_condition'].")<br>";
								}
							}
						?>
				</td>
			</tr>
			<tr>
				<td>5</td>
				<td>First Appellate in the Governing Act</td>
				<td>
				<?php echo $res['gov_act_first_appellate'];	?>
				</td>
			</tr>
			<tr>
				<td>6</td>
				<td>Timeline for Disposal of appeal by First Appellate</td>
				<td>
				<?php $arr = json_decode($res['gov_act_first'],true);
				//echo '<pre>'; print_r(json_decode($arr,true));  die;
							if(count($arr)>0){
								foreach($arr as $arr_key=>$arr_value){
									if($arr_value['go_notification_dh_no']>0)
									echo $arr_value['go_notification_dh_no']." ".$arr_value['go_notification_dh']."<br>";
								}
							}
						?>
				</td>
			</tr>
			<tr>
				<td>7</td>
				<td>Second Appellate in the Governing Act</td>
				<td><?php echo $res['gov_act_second_appellate']; ?></td>
			</tr>
			<tr>
				<td>8</td>
				<td>Timeline for Disposal of appeal by Second Appellate</td>
				<td>
				<?php $arr = json_decode($res['gov_act_second'],true);
				//echo '<pre>'; print_r($arr);  die;
							if(count($arr)>0){
								foreach($arr as $arr_key=>$arr_value){
									if($arr_value['go_notification_dh_no']>0)
									echo $arr_value['go_notification_dh_no']." ".$arr_value['go_notification_dh']."<br>";
								}
							}
						?>
				</td>
			</tr>
			<tr>
				<td>9</td>
				<td>Timeline for the Service In Uttarakhand Single Window Act</td>
				<td>
				<?php $arr = json_decode($res['uksw_act'],true);
				//echo '<pre>'; print_r($arr);  die;
							if(count($arr)>0){
								foreach($arr as $arr_key=>$arr_value){
									if($arr_value['uksw_act_dh_no']>0)
									echo $arr_value['uksw_act_dh_no']." ".$arr_value['uksw_act_dh']."<br>";
								}
							}
						?>
				</td>
			</tr>
			
			<tr>
				<td>10</td>
				<td>First Appellate in the UkSWA</td>
				<td><?php echo $res['uksw_act_first_appellate']; ?></td>
			</tr>
			
			<tr>
				<td>11</td>
				<td>Timeline for Disposal of appeal by First Appellate</td>
				<td>
				<?php $arr = json_decode($res['uksw_act_first'],true);
				//echo '<pre>'; print_r($arr);  die;
							if(count($arr)>0){
								foreach($arr as $arr_key=>$arr_value){
									if($arr_value['uksw_act_dh_no']>0)
									echo $arr_value['uksw_act_dh_no']." ".$arr_value['uksw_act_dh']."<br>";
								}
							}
						?>
				</td>
			</tr>
			<tr>
				<td>12</td>
				<td>Second Appellate in the UkSWA</td>
				<td><?php echo $res['uksw_act_second_appellate']; ?></td>
			</tr>
			<tr>
				<td>13</td>
				<td>Timeline for Disposal of appeal by Second Appellate</td>
				<td>
				<?php $arr = json_decode($res['uksw_act_second'],true);
				//echo '<pre>'; print_r($arr);  die;
							if(count($arr)>0){
								foreach($arr as $arr_key=>$arr_value){
									if($arr_value['ukrts_act_dh_no']>0)
									echo $arr_value['ukrts_act_dh_no']." ".$arr_value['ukrts_act_dh']."<br>";
								}
							}
						?>
				</td>
			</tr>
			<tr>
				<td>14</td>
				<td>Timeline for the Service In Uttarakhand Right to Services  Act</td>
				<td>
				<?php $arr = json_decode($res['ukrts_act'],true);
				//echo '<pre>'; print_r($arr);  die;
							if(count($arr)>0){
								foreach($arr as $arr_key=>$arr_value){
									if($arr_value['ukrts_act_dh_no']>0)
									echo $arr_value['ukrts_act_dh_no']." ".$arr_value['ukrts_act_dh']."<br>";
								}
							}
						?>
				</td>
			</tr>
			<tr>
				<td>15</td>
				<td>First Appellate in the UkRTS</td>
				<td><?php echo $res['ukrts_act_first_appellate'];?></td>
			</tr>
			<tr>
				<td>16</td>
				<td>Timeline for Disposal of appeal by First Appellate</td>
				<td>
				<?php $arr = json_decode($res['ukrts_act_first'],true);
				//echo '<pre>'; print_r($arr);  die;
							if(count($arr)>0){
								foreach($arr as $arr_key=>$arr_value){
									if($arr_value['ukrts_act_first_dh_no']>0)
									echo $arr_value['ukrts_act_first_dh_no']." ".$arr_value['ukrts_act_first_dh']."<br>";
								}
							}
						?>
				</td>
			</tr>
			<tr>
				<td>17</td>
				<td>Second Appellate in the UkRTS</td>
				<td><?php echo $res['ukrts_act_second_appellate']; ?></td>
			</tr>
			<tr>
				<td>18</td>
				<td>Timeline for Disposal of appeal by Second Appellate</td>
				<td>
				<?php $arr = json_decode($res['ukrts_act_second'],true);
				//echo '<pre>'; print_r($arr);  die;
							if(count($arr)>0){
								foreach($arr as $arr_key=>$arr_value){
									if($arr_value['ukrts_act_second_dh_no']>0)
									echo $arr_value['ukrts_act_second_dh_no']." ".$arr_value['ukrts_act_second_dh']."<br>";
								}
							}
						?>
				</td>
			</tr>
			

			

		</table>
		<?php
		//$table_html = '<table width="100%"><tr><td>S.No</td><td>Particulares</td><td>Service Name</td></tr></table>';
		//echo $table_html;
	}
	
	
}
?>
